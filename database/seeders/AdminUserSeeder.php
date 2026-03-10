<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@meem.com.my'],
            [
                'name' => 'Admin',
                'email' => 'admin@meem.com.my',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ]
        );
    }
}
