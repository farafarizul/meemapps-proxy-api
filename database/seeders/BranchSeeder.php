<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $branches = [
            [
                'type' => 'hq',
                'name' => 'MEEM Gold HQ',
                'state' => 'Selangor',
                'city' => 'Petaling Jaya',
                'phone' => '0355231231',
                'whatsapp_url' => 'https://api.whatsapp.com/send?phone=60355231231',
                'map_url' => 'https://maps.app.goo.gl/M9ewA4ksZ6RvVJ2T9',
                'address' => 'Petaling Jaya, Selangor, Malaysia',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'type' => 'branch',
                'name' => 'MEEM Gold Bangi',
                'state' => 'Selangor',
                'city' => 'Bangi',
                'phone' => null,
                'whatsapp_url' => null,
                'map_url' => null,
                'address' => 'Bangi, Selangor, Malaysia',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'type' => 'branch',
                'name' => 'MEEM Gold Alor Setar',
                'state' => 'Kedah',
                'city' => 'Alor Setar',
                'phone' => null,
                'whatsapp_url' => null,
                'map_url' => null,
                'address' => 'Alor Setar, Kedah, Malaysia',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($branches as $data) {
            Branch::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
