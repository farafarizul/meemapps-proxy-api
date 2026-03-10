<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            ['slug' => 'about-us', 'title' => 'About Us', 'subtitle' => 'MEEM Gold', 'hero_text' => 'Welcome to MEEM Gold'],
            ['slug' => 'contact-us', 'title' => 'Contact Us', 'subtitle' => 'Get in touch', 'hero_text' => 'Find our locations across Malaysia'],
            ['slug' => 'account-closure', 'title' => 'Account Closure', 'subtitle' => 'Close your account', 'hero_text' => 'Account Closure Request'],
            ['slug' => 'coming-soon', 'title' => 'Coming Soon', 'subtitle' => 'Stay tuned', 'hero_text' => 'Something great is coming'],
            ['slug' => 'shariah-advisor', 'title' => 'Shariah Advisor', 'subtitle' => 'Our Shariah Advisory', 'hero_text' => 'Shariah Compliance'],
        ];

        foreach ($pages as $data) {
            Page::firstOrCreate(['slug' => $data['slug']], array_merge($data, ['is_published' => true]));
        }
    }
}
