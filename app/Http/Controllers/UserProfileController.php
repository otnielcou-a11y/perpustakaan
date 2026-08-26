<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors([
                'login' => 'Silakan login terlebih dahulu.'
            ]);
        }

        $user = Auth::user();
        $categories = class_exists(Category::class) ? Category::all() : collect();

        if (view()->exists('user.settings')) {
            return view('user.settings', compact('user', 'categories'));
        }

        return view('user_settings', compact('user', 'categories'));
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
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        // 3. SIMPAN PASSWORD BARU JIKA DIISI
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Refresh sesi pengguna
        Auth::setUser($user->fresh());

        return back()->with('success', 'Username dan pengaturan akun Anda berhasil diperbarui!');
    }
}
