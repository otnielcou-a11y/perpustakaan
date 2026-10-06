<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Support\ReplacesMediaFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    use ReplacesMediaFiles;

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors([
                'login' => 'Silakan login terlebih dahulu.'
            ]);
        }

        return view('user_settings', [
            'user' => Auth::user(),
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // VALIDASI: HANYA USERNAME, FOTO PROFIL, DAN PASSWORD (NAMA LENGKAP TERKUNCI)
        $rules = [
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'min:4|confirmed';
        }

        $request->validate($rules, [
            'username.required' => 'Username wajib diisi!',
            'username.unique' => 'Username ini sudah digunakan, silakan pilih username lain.',
            'password.min' => 'Password baru minimal 4 karakter!',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok!',
        ]);

        // 1. HANYA SIMPAN USERNAME
        $user->username = trim($request->username);

        // 2. SIMPAN FOTO PROFIL JIKA DI-UPLOAD
        if ($request->hasFile('avatar')) {
            try {
                $user->avatar = $this->storeMediaFile($request->file('avatar'), 'avatars', $user->avatar);
            } catch (\Throwable $e) {
                return back()->with('error', 'Gagal menyimpan foto profil. Periksa izin folder storage.');
            }
        }

        // 3. SIMPAN PASSWORD BARU JIKA DIISI
        // Cukup nilai mentah: kolom password di-cast 'hashed' oleh model User.
        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        $user->save();

        // Refresh sesi pengguna
        Auth::setUser($user->fresh());

        return back()->with('success', 'Username dan pengaturan akun Anda berhasil diperbarui!');
    }
}
