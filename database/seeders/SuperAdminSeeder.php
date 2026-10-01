<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        $email    = env('SUPERADMIN_EMAIL', 'superadmin@smkn2pwk.sch.id');
        $username = env('SUPERADMIN_USERNAME', 'superadmin');
        $name     = env('SUPERADMIN_NAME', 'Super Administrator');
        $password = env('SUPERADMIN_PASSWORD');

        // Password wajib diisi lewat .env. Tidak ada nilai default di repo
        // supaya tidak ada kredensial yang bisa ditebak dari source code.
        if (empty($password)) {
            $this->command->error(
                'SUPERADMIN_PASSWORD belum diisi di .env. Seeder dibatalkan.'
            );

            return;
        }

        // Akun superadmin berdiri sendiri, terpisah dari akun admin bawaan
        // DatabaseSeeder, supaya keduanya tidak saling menimpa role.
        $superAdmin = User::where('email', $email)->first();

        if ($superAdmin) {
            // Password hanya ditulis ulang bila memang diubah di .env.
            $update = [
                'name'        => $name,
                'username'    => $username,
                'role'        => 'superadmin',
                'status'      => 'active',
                'nomor_induk' => $superAdmin->nomor_induk ?: 'SUPER-ADMIN-001',
            ];

            if ($superAdmin->password !== Hash::make($password)) {
                $update['password'] = $password;
            }

            $superAdmin->update($update);

            $this->command->info("Super Admin {$email} berhasil diperbarui!");
        } else {
            User::create([
                'name'        => $name,
                'username'    => $username,
                'email'       => $email,
                'password'    => $password,
                'role'        => 'superadmin',
                'status'      => 'active',
                'nomor_induk' => 'SUPER-ADMIN-001',
            ]);

            $this->command->info('Super Admin berhasil dibuat!');
        }

        // Jaga-jaga: akun lama admin@smkn2pwk.sch.id pernah ikut ter-promote
        // jadi superadmin oleh versi seeder sebelumnya. Turunkan lagi ke admin
        // supaya hanya satu akun superadmin yang berlaku.
        $old = User::where('email', 'admin@smkn2pwk.sch.id')
            ->where('role', 'superadmin')
            ->where('email', '!=', $email)
            ->first();

        if ($old) {
            $old->update(['role' => 'admin']);
            $this->comment("  Akun lama {$old->email} dikembalikan menjadi role admin.");
        }
    }
}
