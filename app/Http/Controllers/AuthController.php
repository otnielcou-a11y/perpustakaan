<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MasterStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // API Cek NISN & Auto-Fill Nama
    public function checkNisn($nisn)
    {
        $student = MasterStudent::where('nisn', trim($nisn))->first();
        if ($student) {
            return response()->json([
                'found' => true,
                'name' => $student->name,
                'class' => $student->class
            ]);
        }
        return response()->json(['found' => false]);
    }

    public function showLoginForm()
    {
        return view('login');
    }

    // 1. LOGIN (MENDUKUNG AJAX TANPA RELOAD)
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ], [
            'login.required' => 'Masukkan Nama Lengkap, Username, NISN, atau Email!',
            'password.required' => 'Password wajib diisi!',
        ]);

        $loginInput = trim($request->input('login'));
        $password = $request->input('password');

        $user = User::where('email', $loginInput)
                    ->orWhere('username', $loginInput)
                    ->orWhere('nomor_induk', $loginInput)
                    ->orWhere('name', $loginInput)
                    ->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'redirect' => url('/'),
                    'message' => 'Selamat datang kembali, ' . $user->name . '!'
                ]);
            }

            return redirect('/')->with('success', 'Selamat datang kembali, ' . $user->name . '!');
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Identitas (Nama/Username/NISN/Email) atau Password salah!'
            ], 422);
        }

        return back()->withErrors([
            'login' => 'Identitas (Nama/Username/NISN/Email) atau Password salah!',
        ])->withInput($request->only('login'));
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    // 2. REGISTER (MENDUKUNG AJAX TANPA RELOAD)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'nullable|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:4|confirmed',
            'role' => 'required|in:murid,guru',
            'nomor_induk' => 'required|string|max:50|unique:users,nomor_induk',
        ], [
            'name.required' => 'Nama lengkap wajib diisi!',
            'username.required' => 'Username wajib diisi!',
            'username.unique' => 'Username ini sudah digunakan, silakan pilih yang lain.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'nomor_induk.unique' => 'NISN / NIP ini sudah pernah didaftarkan akunnya!',
            'password.required' => 'Kata sandi wajib diisi!',
            'password.min' => 'Kata sandi minimal 4 karakter!',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok!',
        ]);

        // Verifikasi Siswa (Privasi Aman)
        if ($request->role === 'murid') {
            $inputNISN = trim($request->nomor_induk);
            $inputName = strtoupper(trim($request->name));

            $masterStudent = MasterStudent::where('nisn', $inputNISN)->first();

            if (!$masterStudent || ($inputName !== strtoupper(trim($masterStudent->name)))) {
                $errorMsg = 'Data NISN atau Nama Lengkap tidak sesuai dengan data resmi sekolah!';

                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => $errorMsg], 422);
                }

                return back()->withInput()->withErrors(['nomor_induk' => $errorMsg]);
            }
        }

        $user = User::create([
            'name' => strtoupper(trim($request->name)),
            'username' => $request->username,
            'email' => $request->filled('email') ? $request->email : null,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'nomor_induk' => $request->nomor_induk,
        ]);

        Auth::login($user);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'redirect' => url('/'),
                'message' => 'Selamat datang! Akun Anda berhasil didaftarkan.'
            ]);
        }

        return redirect('/')->with('success', 'Selamat datang! Akun Anda berhasil didaftarkan.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Anda telah berhasil keluar.');
    }
}
