<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CustomerProfileService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('meem.base_url', 'https://meem.com.my/api/v1');
    }

    public function getProfile(array $headers, array $query = [], array $postData = [], string $method = 'GET'): array
    {
        $url = $this->baseUrl.'/customer/profile';
        $forwardHeaders = $this->extractForwardHeaders($headers);

        try {
            if ($method === 'POST') {
                $response = Http::withHeaders($forwardHeaders)->post($url, $postData);
            } else {
                $response = Http::withHeaders($forwardHeaders)->get($url, $query);
            }
            $data = $response->json() ?? [];
        } catch (\Exception $e) {
            Log::error('CustomerProfile upstream error: '.$e->getMessage());
            return ['error' => true, 'message' => $e->getMessage()];
        }

        // Cast gss_balance numerically
        if (isset($data['data']['gss_balance'])) {
            $data['data']['gss_balance'] = (float) $data['data']['gss_balance'];
        }

        $gssBalance = $data['data']['gss_balance'] ?? 0;

        // Calculate gss_progress from thresholds
        $thresholds = [0.01, 0.1, 0.5, 1, 10, 100, 1000, 2000, 3000, 5000, 10000];
        $progressThreshold = 1;
        foreach ($thresholds as $t) {
            if ($gssBalance < $t) {
                $progressThreshold = $t;
                break;
            }
        }

        $progressValue = (float) number_format($progressThreshold - $gssBalance, 4, '.', '');
        $progressPercentage = $progressThreshold > 0 ? ($gssBalance / $progressThreshold) * 100 : 0;

        $data['data']['gss_progress'] = [
            'balance' => $gssBalance,
            'threshold' => $progressThreshold,
            'progress_value' => $progressValue,
            'progress_percentage' => $progressPercentage,
            'progress_bar_percentage' => $progressPercentage / 100,
        ];

        // Fetch current gold price
        try {
            $goldResponse = Http::withHeaders($forwardHeaders)->get($this->baseUrl.'/price/gwa');
            $goldData = $goldResponse->json() ?? [];

            if (isset($goldData['data']['buy_price'])) {
                $goldPrice = (float) number_format($goldData['data']['buy_price'], 2, '.', '');
                $data['data']['gold_price'] = $goldPrice;
                $data['data']['gss_gold_value'] = (float) number_format($gssBalance * $goldPrice, 2, '.', '');
            }
        } catch (\Exception $e) {
            Log::error('Gold price fetch error: '.$e->getMessage());
        }

        $data['data']['gss_detail'] = [
            'balance' => $gssBalance,
            'gold_price' => $data['data']['gold_price'] ?? 0,
            'gold_value' => $data['data']['gss_gold_value'] ?? 0,
        ];

        return $data;
    }

    private function extractForwardHeaders(array $headers): array
    {
        $forward = ['Accept' => 'application/json'];
        foreach ($headers as $key => $value) {
            $lk = strtolower($key);
            if ($lk === 'authorization') {
                $forward['Authorization'] = is_array($value) ? $value[0] : $value;
            }
            if ($lk === 'content-type') {
                $forward['Content-Type'] = is_array($value) ? $value[0] : $value;
            }
        }
        return $forward;
    }
}
