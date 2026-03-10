<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\EndpointJsonOverride;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_widget_more_services_returns_json(): void
    {
        Service::create([
            'name' => 'Test Service',
            'url' => '/webview/about-us',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->getJson('/api/widget-more-services');
        $response->assertStatus(200)
            ->assertJsonStructure(['status', 'data'])
            ->assertJsonPath('status', 'success');
    }

    public function test_widget_more_services_only_returns_active(): void
    {
        Service::create(['name' => 'Active', 'url' => '/webview/about-us', 'sort_order' => 1, 'is_active' => true]);
        Service::create(['name' => 'Inactive', 'url' => '/webview/about-us', 'sort_order' => 2, 'is_active' => false]);

        $response = $this->getJson('/api/widget-more-services');
        $data = $response->json('data');
        $this->assertCount(1, $data);
        $this->assertEquals('Active', $data[0]['name']);
    }

    public function test_json_override_is_applied(): void
    {
        Service::create(['name' => 'Test', 'url' => '/webview/about-us', 'sort_order' => 1, 'is_active' => true]);
        EndpointJsonOverride::create([
            'endpoint_key' => 'widget-more-services',
            'merge_strategy' => 'merge',
            'override_json' => ['extra_field' => 'override_value'],
            'is_active' => true,
        ]);

        $response = $this->getJson('/api/widget-more-services');
        $response->assertStatus(200)
            ->assertJsonPath('extra_field', 'override_value');
    }

    public function test_gss_price_table_returns_json(): void
    {
        Http::fake([
            'meem.com.my/api/v1/price/gwa-history' => Http::response(['data' => []], 200),
            'meem.com.my/api/v1/price/gwa' => Http::response(['data' => ['sell_price' => 350.00]], 200),
        ]);

        $response = $this->getJson('/api/gss-price-table?filter=7day');
        $response->assertStatus(200)
            ->assertJsonStructure(['status', 'data']);
    }

    public function test_gss_price_history_returns_json(): void
    {
        Http::fake([
            'meem.com.my/api/v1/price/gwa-history' => Http::response(['data' => []], 200),
        ]);

        $response = $this->getJson('/api/gss-price-history');
        $response->assertStatus(200)
            ->assertJsonPath('status', 'success');
    }
}
