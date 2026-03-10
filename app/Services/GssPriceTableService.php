<?php

namespace App\Services;

use App\Models\EventCache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GssPriceTableService
{
    private string $baseUrl;
    private string $geminiApiKey;
    private string $geminiApiUrl;

    public function __construct()
    {
        $this->baseUrl = config('meem.base_url', 'https://meem.com.my/api/v1');
        $this->geminiApiKey = config('services.gemini.api_key') ?? '';
        $this->geminiApiUrl = config('services.gemini.api_url', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent');
    }

    public function getPriceTable(string $filter = '7day'): array
    {
        try {
            $response = Http::withHeaders(['Accept' => 'application/json'])
                ->get($this->baseUrl.'/price/gwa-history');
            $historyData = $response->json() ?? [];
        } catch (\Exception $e) {
            Log::error('GssPriceTable upstream error: '.$e->getMessage());
            return ['status' => 'error', 'data' => []];
        }

        $outputHistory = [];
        if (isset($historyData['data']) && is_array($historyData['data'])) {
            foreach ($historyData['data'] as $value) {
                $outputHistory = $value;
            }
        }

        // Normalize sell_price
        foreach ($outputHistory as $key => $value) {
            if (isset($value['sell_price'])) {
                $outputHistory[$key]['sell_price'] = (float) number_format($value['sell_price'], 2, '.', '');
            }
        }

        // Filter by date range
        $currentDate = time();
        $filteredHistory = [];
        foreach ($outputHistory as $value) {
            $dateTimestamp = strtotime(str_replace('/', '-', $value['date']));
            if ($filter === '1day' && $dateTimestamp >= $currentDate - 86400) {
                $filteredHistory[] = $value;
            } elseif ($filter === '7day' && $dateTimestamp >= $currentDate - 604800) {
                $filteredHistory[] = $value;
            } elseif ($filter === '30day' && $dateTimestamp >= $currentDate - 2592000) {
                $filteredHistory[] = $value;
            } elseif (! in_array($filter, ['1day', '7day', '30day'])) {
                $filteredHistory[] = $value;
            }
        }

        // Remove duplicate dates
        $uniqueDates = [];
        foreach ($filteredHistory as $key => $value) {
            if (in_array($value['date'], $uniqueDates)) {
                unset($filteredHistory[$key]);
            } else {
                $uniqueDates[] = $value['date'];
            }
        }
        $filteredHistory = array_values($filteredHistory);

        // Downsample 30-day data (every 4th entry)
        if ($filter === '30day') {
            $downsampled = [];
            $counter = 0;
            foreach ($filteredHistory as $value) {
                if ($counter === 0) {
                    $downsampled[] = $value;
                }
                $counter = ($counter + 1) % 4;
            }
            $filteredHistory = $downsampled;
        }

        // Reverse and limit to 7
        $filteredHistory = array_reverse($filteredHistory);
        if (count($filteredHistory) > 7) {
            $filteredHistory = array_slice($filteredHistory, 0, 7);
        }

        // OHLC calculation
        $openValue = null;
        $highValue = null;
        $lowValue = null;
        $closeValue = null;

        foreach ($filteredHistory as $value) {
            if (isset($value['sell_price'])) {
                if ($openValue === null) {
                    $openValue = $value['sell_price'];
                }
                if ($highValue === null || $value['sell_price'] > $highValue) {
                    $highValue = $value['sell_price'];
                }
                if ($lowValue === null || $value['sell_price'] < $lowValue) {
                    $lowValue = $value['sell_price'];
                }
            }
        }
        foreach (array_reverse($filteredHistory) as $value) {
            if (isset($value['sell_price'])) {
                $closeValue = $value['sell_price'];
                break;
            }
        }

        // Fetch current gold price
        $currentGoldPrice = 0;
        try {
            $goldResponse = Http::withHeaders(['Accept' => 'application/json'])
                ->get($this->baseUrl.'/price/gwa');
            $goldData = $goldResponse->json() ?? [];
            $currentGoldPrice = (float) ($goldData['data']['sell_price'] ?? 0);
        } catch (\Exception $e) {
            Log::error('Gold price fetch error: '.$e->getMessage());
        }

        // Percentage change and indicator
        $percentageChange = 0.0;
        $indicator = 'neutral';

        if (count($filteredHistory) > 1 && isset($filteredHistory[1]['sell_price'])) {
            $secondTopPrice = $filteredHistory[1]['sell_price'];
            if ($secondTopPrice > 0) {
                if ($currentGoldPrice > $secondTopPrice) {
                    $indicator = 'positive';
                    $percentageChange = (($currentGoldPrice - $secondTopPrice) / $secondTopPrice) * 100;
                } elseif ($currentGoldPrice < $secondTopPrice) {
                    $indicator = 'negative';
                    $percentageChange = (($secondTopPrice - $currentGoldPrice) / $secondTopPrice) * 100;
                }
            }
        }

        $percentageChange = (float) number_format($percentageChange, 2, '.', '');

        $indicatorColor = match ($indicator) {
            'positive' => 'green',
            'negative' => 'red',
            default => 'gray',
        };
        $indicatorSymbol = match ($indicator) {
            'positive' => '▲',
            'negative' => '▼',
            default => '-',
        };
        $percentageChangeSymbol = match ($indicator) {
            'positive' => '+',
            'negative' => '-',
            default => '',
        };
        $percentageChangeColor = match ($indicator) {
            'positive' => '#008000',
            'negative' => '#FF0000',
            default => '#808080',
        };

        // Add event explanations
        foreach ($filteredHistory as $key => $value) {
            $date = date('Y-m-d', strtotime(str_replace('/', '-', $value['date'])));
            $filteredHistory[$key]['event_explanation'] = $this->getEventExplanation($date);
        }

        return [
            'status' => 'success',
            'data' => $filteredHistory,
            'open_value' => $openValue,
            'high_value' => $highValue,
            'low_value' => $lowValue,
            'close_value' => $closeValue,
            'current_gold_price' => $currentGoldPrice,
            'percentage_change' => $percentageChange,
            'indicator' => $indicator,
            'indicator_color' => $indicatorColor,
            'indicator_symbol' => $indicatorSymbol,
            'percentage_change_symbol' => $percentageChangeSymbol,
            'percentage_change_color' => $percentageChangeColor,
        ];
    }

    private function getEventExplanation(string $date): ?array
    {
        // Check DB cache first
        $cached = EventCache::where('event_date', $date)->where('is_valid', true)->first();
        if ($cached) {
            return json_decode($cached->explanation, true);
        }

        if (empty($this->geminiApiKey)) {
            return null;
        }

        try {
            $response = Http::withHeaders([
                'x-goog-api-key' => $this->geminiApiKey,
                'Content-Type' => 'application/json',
            ])->post($this->geminiApiUrl, [
                'contents' => [[
                    'parts' => [[
                        'text' => "What is the main event happened on {$date} that affecting up and down gold pricing? give the explanation in less than 100 characters.",
                    ]],
                ]],
            ]);

            $data = $response->json();

            // Never cache quota/error responses
            if (isset($data['error'])) {
                Log::warning('Gemini API error for '.$date.': '.json_encode($data['error']));
                return null;
            }

            EventCache::create([
                'event_date' => $date,
                'explanation' => json_encode($data),
                'source' => 'gemini',
                'is_valid' => true,
            ]);

            return $data;
        } catch (\Exception $e) {
            Log::error('Gemini API failed for '.$date.': '.$e->getMessage());
            return null;
        }
    }
}
