<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GssPriceHistoryService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('meem.base_url', 'https://meem.com.my/api/v1');
    }

    public function getHistory(): array
    {
        try {
            $response = Http::withHeaders(['Accept' => 'application/json'])
                ->get($this->baseUrl.'/price/gwa-history');
            $historyData = $response->json() ?? [];
        } catch (\Exception $e) {
            Log::error('GssPriceHistory upstream error: '.$e->getMessage());
            return ['status' => 'error', 'data' => []];
        }

        $outputHistory = [];
        if (isset($historyData['data']) && is_array($historyData['data'])) {
            foreach ($historyData['data'] as $value) {
                $outputHistory = $value;
            }
        }

        // Normalize buy_price and sell_price to 2 decimal floats
        foreach ($outputHistory as $key => $value) {
            if (isset($value['buy_price'])) {
                $outputHistory[$key]['buy_price'] = (float) number_format($value['buy_price'], 2, '.', '');
            }
            if (isset($value['sell_price'])) {
                $outputHistory[$key]['sell_price'] = (float) number_format($value['sell_price'], 2, '.', '');
            }
        }

        return ['status' => 'success', 'data' => $outputHistory];
    }
}
