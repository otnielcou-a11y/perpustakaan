<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    /**
     * 1. Menampilkan Halaman Settings
     */
    public function index()
    {
        $user = Auth::user() ?? User::where('role', 'admin')->first() ?? User::first();

        $logoUrl = class_exists(AppSetting::class) ? AppSetting::getVal('site_logo', null) : null;
        $logoSize = class_exists(AppSetting::class) ? AppSetting::getVal('logo_size', '44') : '44';
        $logoShape = class_exists(AppSetting::class) ? AppSetting::getVal('logo_shape', '0px') : '0px';
        $logoFit = class_exists(AppSetting::class) ? AppSetting::getVal('logo_fit', 'contain') : 'contain';

        return view('admin.settings', compact('user', 'logoUrl', 'logoSize', 'logoShape', 'logoFit'));
    }

    /**
     * 2. Memproses Simpan Profil, Username, Email, Foto, & Password Admin / Superadmin
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user && $request->filled('user_id')) {
            $user = User::find($request->user_id);
        }
        if (!$user) {
            $user = User::whereIn('role', ['superadmin', 'admin'])->first() ?? User::first();
        }

        if (!$user) {
            return back()->with('error', 'Akun administrator tidak ditemukan di database.');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'min:4|confirmed';
        }

        $request->validate($rules, [
            'name.required' => 'Nama lengkap wajib diisi!',
            'username.required' => 'Username wajib diisi!',
            'username.unique' => 'Username ini sudah digunakan, silakan pilih yang lain.',
            'email.required' => 'Email wajib diisi!',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.min' => 'Password minimal 4 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok!',
        ]);

        $user->name = trim($request->name);
        $user->username = trim($request->username);
        $user->email = trim($request->email);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                try {
                    Storage::disk('public')->delete($user->avatar);
                } catch (\Throwable $e) {
                    // ignore
                }
            }
            try {
                $user->avatar = $request->file('avatar')->store('avatars', 'public');
            } catch (\Throwable $e) {
                return back()->with('error', 'Gagal menyimpan foto profil. Periksa izin folder storage.');
            }
        }

        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        $user->save();

        if (Auth::check()) {
            Auth::setUser($user->fresh());
        }

        return back()->with('success', 'Profil dan Password Administrator berhasil diperbarui! Silakan gunakan username/password baru untuk login selanjutnya.');
    }

    /**
     * 3. Memproses Simpan Logo Sekolah & Ukuran Branding
     */
    public function updateBranding(Request $request)
    {
        $request->validate([
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:3072',
            'logo_size' => 'required|numeric|min:24|max:120',
            'logo_fit' => 'required|string',
        ]);

        if ($request->hasFile('logo_image')) {
            $oldLogo = AppSetting::getVal('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                try {
                    Storage::disk('public')->delete($oldLogo);
                } catch (\Throwable $e) {
                    // ignore
                }
            }
            try {
                $logoPath = $request->file('logo_image')->store('branding', 'public');
                AppSetting::updateOrCreate(['key' => 'site_logo'], ['value' => $logoPath]);
            } catch (\Throwable $e) {
                return back()->with('error', 'Gagal menyimpan logo. Periksa izin folder storage.');
            }
        }

        AppSetting::updateOrCreate(['key' => 'logo_size'], ['value' => $request->logo_size]);
        AppSetting::updateOrCreate(['key' => 'logo_fit'], ['value' => $request->logo_fit]);

        return back()->with('success', 'Logo resmi SMKN 2 Purwakarta berhasil diperbarui ke seluruh website!');
    }
}
