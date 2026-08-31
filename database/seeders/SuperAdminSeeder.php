<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        // Cek apakah super admin sudah ada
        $superAdmin = User::where('email', 'admin@smkn2pwk.sch.id')->first();

        if (!$superAdmin) {
            User::create([
                'name' => 'Super Administrator',
                'username' => 'superadmin',
                'email' => 'admin@smkn2pwk.sch.id',
                'password' => Hash::make('password123'),
                'role' => 'superadmin',
                'nomor_induk' => 'SUPER-ADMIN-001',
                'status' => 'active',
            ]);

            $this->command->info('Super Admin berhasil dibuat!');
        } else {
            // Update jika sudah ada tapi rolenya bukan superadmin
            if ($superAdmin->role !== 'superadmin') {
                $superAdmin->update([
                    'role' => 'superadmin',
                    'status' => 'active',
                ]);
                $this->command->info('User admin@smkn2pwk.sch.id di-update menjadi Super Admin!');
            }
        }
    }
}
