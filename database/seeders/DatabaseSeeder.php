<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kategori Bawaan
        $kategoriList = [
            ['name' => 'Teknologi', 'icon' => 'fa-microchip'],
            ['name' => 'Kuliner', 'icon' => 'fa-utensils'],
            ['name' => 'Akuntansi', 'icon' => 'fa-calculator'],
            ['name' => 'Fashion Design', 'icon' => 'fa-vest-patches'],
            ['name' => 'Hospitality', 'icon' => 'fa-hotel'],
        ];

        foreach ($kategoriList as $kat) {
            Category::updateOrCreate(
                ['name' => $kat['name']],
                ['slug' => Str::slug($kat['name']), 'icon' => $kat['icon']]
            );
        }

        // 2. Akun Admin Utama
        User::updateOrCreate(
            ['email' => 'admin@smkn2pwk.sch.id'],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'nomor_induk' => '0001'
            ]
        );

        // 3. Catat Log Awal
        SystemLog::create([
            'action' => 'System Bootstrapped',
            'user_name' => 'System',
            'ip_address' => '127.0.0.1',
            'details' => 'Database initialized with default categories and admin credentials.'
        ]);
    }
}
