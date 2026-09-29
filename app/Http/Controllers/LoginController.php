<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan Halaman Login
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Proses Autentikasi Login
     */
    public function autentikasi(Request $request)
    {
        $request->validate([
            'email'    => 'required',
            'password' => 'required',
            'role'     => 'required'
        ], [
            'email.required'    => 'Email / Username wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
            'role.required'     => 'Role wajib dipilih.'
        ]);

        $loginInput = trim(strtolower($request->email));
        $credentials = [
            'email'    => $loginInput,
            'password' => $request->password,
        ];

        // 1. Coba Autentikasi Pengguna
        if (Auth::attempt($credentials, true)) {
            $user = Auth::user();

            // 2. Validasi Role Pengguna
            if ($user->role !== $request->role) {
                // Logout jika role yang dipilih tidak cocok
                Auth::logout();
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->with('info', 'Role yang Anda pilih tidak sesuai dengan hak akses akun ini.');
            }

            // 3. Redireksi Sesuai Role
            $request->session()->regenerate();

            if ($user->role === 'siswa') {
                return redirect()->route('siswa_dashboard');
            } elseif ($user->role === 'admin') {
                return redirect()->route('dashboard');
            }

            return redirect()->back()->with('info', 'Anda login sebagai ' . $user->role);
        }

        // Jika Gagal Login
        return redirect()->route('login')
            ->withInput($request->only('email'))
            ->with('info', 'Username/Email atau Kata Sandi Anda salah.');
    }

    /**
     * Tampilkan Halaman Registrasi
     */
    public function registrasi()
    {
        return view('registrasi');
    }

    /**
     * Simpan Data Registrasi
     */
    public function simpanregistrasi(Request $request)
    {
        $request->validate([
            'nama'                  => 'required',
            'username'              => 'required|unique:users,email',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ], [
            'nama.required'                  => 'Nama lengkap wajib diisi.',
            'username.required'              => 'Username / Email wajib diisi.',
            'username.unique'                => 'Username / Email sudah terdaftar.',
            'password.required'              => 'Kata sandi wajib diisi.',
            'password.min'                   => 'Kata sandi minimal 6 karakter.',
            'password_confirmation.same'     => 'Konfirmasi kata sandi tidak cocok.'
        ]);

        $user = new User();
        $user->name     = trim($request->nama);
        $user->email    = trim(strtolower($request->username));
        $user->password = Hash::make($request->password);
        $user->role     = 'siswa';
        $user->save();

        return redirect()->route('login')->with('info', 'Registrasi berhasil! Silakan login dengan akun Anda.');
    }

    /**
     * Proses Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('info', 'Terima kasih sudah menggunakan aplikasi ini!');
    }
}
