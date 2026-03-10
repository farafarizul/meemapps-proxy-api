<?php

namespace Database\Seeders;

use App\Models\EndpointConfig;
use App\Models\EndpointJsonOverride;
use Illuminate\Database\Seeder;

class EndpointConfigSeeder extends Seeder
{
    public function run(): void
    {
        $baseUrl = config('meem.base_url', 'https://meem.com.my/api/v1');

        $configs = [
            ['key' => 'customer-profile', 'upstream_url' => $baseUrl.'/customer/profile', 'http_method' => 'GET'],
            ['key' => 'gss-price-history', 'upstream_url' => $baseUrl.'/price/gwa-history', 'http_method' => 'GET'],
            ['key' => 'gss-price-table', 'upstream_url' => $baseUrl.'/price/gwa-history', 'http_method' => 'GET'],
            ['key' => 'gold-price', 'upstream_url' => $baseUrl.'/price/gwa', 'http_method' => 'GET'],
            ['key' => 'widget-more-services', 'upstream_url' => '', 'http_method' => 'GET'],
        ];

        foreach ($configs as $data) {
            EndpointConfig::firstOrCreate(['key' => $data['key']], array_merge($data, ['is_active' => true]));
        }

        // Create override records for each endpoint
        foreach (['customer-profile', 'gss-price-history', 'gss-price-table', 'widget-more-services'] as $key) {
            EndpointJsonOverride::firstOrCreate(
                ['endpoint_key' => $key],
                ['merge_strategy' => 'merge', 'override_json' => null, 'is_active' => false]
            );
        }
    }
}
