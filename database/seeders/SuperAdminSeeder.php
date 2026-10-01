<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $email    = env('SUPERADMIN_EMAIL', 'superadmin@smkn2pwk.sch.id');
        $username = env('SUPERADMIN_USERNAME', 'superadmin');
        $name     = env('SUPERADMIN_NAME', 'Super Administrator');
        $password = env('SUPERADMIN_PASSWORD', 'superadmin123');

        // Cek apakah akun superadmin sudah ada di database (berdasarkan role, email, atau username)
        $superAdmin = User::where('role', 'superadmin')
            ->orWhere('email', $email)
            ->orWhere('username', $username)
            ->first();

        if ($superAdmin) {
            // Jika akun superadmin sudah ada, JANGAN timpa username/password kustom pengguna.
            // Hanya pastikan role dan status-nya tetap aktif.
            $superAdmin->role = 'superadmin';
            $superAdmin->status = 'active';
            $superAdmin->save();

            if (isset($this->command)) {
                $this->command->info("Super Admin ({$superAdmin->email} | Username: {$superAdmin->username}) sudah ada (konfigurasi kustom dipertahankan).");
            }
        } else {
            // Hanya buat baru jika belum pernah ada akun superadmin
            User::create([
                'name'        => $name,
                'username'    => $username,
                'email'       => $email,
                'password'    => $password,
                'role'        => 'superadmin',
                'status'      => 'active',
                'nomor_induk' => 'SUPER-ADMIN-001',
            ]);

            if (isset($this->command)) {
                $this->command->info("Super Admin ({$email} | Username: {$username}) berhasil dibuat!");
            }
        }
    }
}
