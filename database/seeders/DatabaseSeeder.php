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
            ['name' => 'Akuntansi', 'icon' => 'fa-calculator'],
            ['name' => 'Bisnis & Manajemen', 'icon' => 'fa-briefcase'],
            ['name' => 'Umum & Muatan Nasional', 'icon' => 'fa-book-open'],
            ['name' => 'Bahasa & Seni', 'icon' => 'fa-language'],
            ['name' => 'Matematika', 'icon' => 'fa-square-root-variable'],
            ['name' => 'Pendidikan Agama Islam', 'icon' => 'fa-mosque'],
            ['name' => 'Pendidikan Pancasila', 'icon' => 'fa-landmark'],
            ['name' => 'Sejarah & Ilmu Sosial', 'icon' => 'fa-landmark-dome'],
        ];

        foreach ($kategoriList as $kat) {
            Category::updateOrCreate(
                ['name' => $kat['name']],
                ['slug' => Str::slug($kat['name']), 'icon' => $kat['icon']]
            );
        }

        // 2. Akun Admin Utama
        // Password berasal dari .env (ADMIN_PASSWORD) supaya tidak ada
        // kredensial default yang tertanam di repository.
        $adminPassword = env('ADMIN_PASSWORD');

        $admin = User::where('email', 'admin@smkn2pwk.sch.id')->first();

        if ($admin) {
            $update = ['role' => 'admin'];

            // Hanya timpa password bila ADMIN_PASSWORD diisi dan berbeda.
            if (! empty($adminPassword) && $admin->password !== Hash::make($adminPassword)) {
                $update['password'] = $adminPassword;
            }

            $admin->update($update);
        } else {
            if (empty($adminPassword)) {
                $this->command->error(
                    'ADMIN_PASSWORD belum diisi di .env. Akun admin tidak dibuat.'
                );
            } else {
                User::create([
                    'name'        => 'Administrator',
                    'username'    => 'admin',
                    'email'       => 'admin@smkn2pwk.sch.id',
                    'password'    => $adminPassword,
                    'role'        => 'admin',
                    'nomor_induk' => '0001',
                    'status'      => 'active',
                ]);
            }
        }

        // 3. Catat Log Awal
        SystemLog::create([
            'action' => 'System Bootstrapped',
            'user_name' => 'System',
            'ip_address' => '127.0.0.1',
            'details' => 'Database initialized with default categories and admin credentials.'
        ]);
    }
}
