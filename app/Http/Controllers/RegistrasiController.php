<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // 1. Pastikan import Model User di sini
use Illuminate\Support\Facades\Hash; // Untuk keamanan password

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('registrasi');
    }

    public function store(Request $request)
    {
        // 2. Validasi data yang masuk
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|unique:users,email', // Mapping ke kolom email di DB
            'password' => 'required|confirmed|min:6',
        ]);

        // 3. Proses simpan ke database
        User::create([
            'name' => $request->nama, 
            'email' => $request->username, // Simpan input username ke kolom email
            'password' => Hash::make($request->password), 
            'role' => 'siswa', // Default role
        ]);

        // 4. Redirect setelah berhasil
        return redirect()->route('login')->with('info', 'Registrasi berhasil! Silahkan login dengan akun Anda.');
    }
}