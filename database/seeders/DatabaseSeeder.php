<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\SystemLog;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kategori Bawaan Perpustakaan
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

        // 2. Jalankan Seeder Super Admin
        $this->call([
            SuperAdminSeeder::class,
        ]);

        // 3. Akun Admin Utama (Buat jika belum ada)
        $adminEmail    = env('ADMIN_EMAIL', 'admin@smkn2pwk.sch.id');
        $adminUsername = env('ADMIN_USERNAME', 'admin');
        $adminPassword = env('ADMIN_PASSWORD', 'admin123');

        $admin = User::where('role', 'admin')->orWhere('email', $adminEmail)->orWhere('username', $adminUsername)->first();

        if (! $admin) {
            User::create([
                'name'        => 'Administrator',
                'username'    => $adminUsername,
                'email'       => $adminEmail,
                'password'    => $adminPassword,
                'role'        => 'admin',
                'nomor_induk' => '0001',
                'status'      => 'active',
            ]);
        }

        // 4. Akun Demo Guru (Buat jika belum ada)
        $guru = User::where('role', 'guru')->orWhere('username', 'gurusmkn2')->orWhere('email', 'guru@smkn2pwk.sch.id')->first();
        if (! $guru) {
            User::create([
                'name'        => 'Bapak Guru Demo',
                'username'    => 'gurusmkn2',
                'email'       => 'guru@smkn2pwk.sch.id',
                'password'    => 'guru123',
                'role'        => 'guru',
                'nomor_induk' => '198501012010011001',
                'status'      => 'active',
            ]);
        }

        // 5. Akun Demo Siswa (Aisyah) (Buat jika belum ada)
        $siswa = User::where('username', 'aisyah')->orWhere('nomor_induk', '0117148583')->first();
        if (! $siswa) {
            User::create([
                'name'        => 'AISYAH',
                'username'    => 'aisyah',
                'email'       => 'aisyah@smkn2pwk.sch.id',
                'password'    => 'siswa123',
                'role'        => 'murid',
                'nomor_induk' => '0117148583',
                'status'      => 'active',
            ]);
        }

        // 6. Catat Log Awal Inisialisasi
        SystemLog::create([
            'action' => 'System Bootstrapped',
            'user_name' => 'System',
            'ip_address' => '127.0.0.1',
            'details' => 'Database initialized with default categories and default role accounts.'
        ]);
    }
}
