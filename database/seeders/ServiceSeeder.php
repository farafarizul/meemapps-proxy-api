<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'About Us', 'icon_path' => 'icons/about_us.png', 'url' => '/webview/about-us', 'sort_order' => 1],
            ['name' => 'Contact Us', 'icon_path' => 'icons/contact_us.png', 'url' => '/webview/contact-us', 'sort_order' => 2],
            ['name' => 'News', 'icon_path' => 'icons/news_gray.png', 'url' => '/webview/coming-soon', 'sort_order' => 3],
            ['name' => 'Resellers', 'icon_path' => 'icons/resellers_gray.png', 'url' => '/webview/coming-soon', 'sort_order' => 4],
            ['name' => 'Shariah Advisor', 'icon_path' => 'icons/shariah_advisor.png', 'url' => '/webview/shariah-advisor', 'sort_order' => 5],
            ['name' => 'Closure', 'icon_path' => 'icons/closure.png', 'url' => '/webview/account-closure', 'sort_order' => 6],
        ];

        foreach ($services as $data) {
            Service::firstOrCreate(['name' => $data['name']], array_merge($data, ['is_active' => true]));
        }
    }
}
