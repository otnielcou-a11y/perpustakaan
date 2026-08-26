<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    /**
     * 1. Menampilkan Halaman Settings
     */
    public function index()
    {
        // Ambil data user yang sedang login, fallback ke akun admin pertama jika session kosong
        $user = Auth::user() ?? User::where('role', 'admin')->first() ?? User::first();

        $logoUrl = class_exists(AppSetting::class) ? AppSetting::getVal('site_logo', null) : null;
        $logoSize = class_exists(AppSetting::class) ? AppSetting::getVal('logo_size', '44') : '44';
        $logoShape = class_exists(AppSetting::class) ? AppSetting::getVal('logo_shape', '0px') : '0px';
        $logoFit = class_exists(AppSetting::class) ? AppSetting::getVal('logo_fit', 'contain') : 'contain';

        return view('admin.settings', compact('user', 'logoUrl', 'logoSize', 'logoShape', 'logoFit'));
    }

    /**
     * 2. Memproses Simpan Profil, Username, Email, Foto, & Password Admin
     */
    public function updateProfile(Request $request)
    {
        // Cari user admin yang sedang aktif
        $user = Auth::user();
        if (!$user && $request->filled('user_id')) {
            $user = User::find($request->user_id);
        }
        if (!$user) {
            $user = User::where('role', 'admin')->first() ?? User::first();
        }

        if (!$user) {
            return back()->with('error', 'Akun admin tidak ditemukan di database.');
        }

        // Aturan validasi dasar
        $rules = [
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];

        // Jika kolom password diisi, baru kita validasi (jika kosong, password lama tetap aman)
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

        // Simpan data text
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        // Upload Foto Profil Baru
        if ($request->hasFile('avatar')) {
            // Hapus file avatar lama di storage jika ada
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            // Simpan avatar baru ke storage/app/public/avatars/
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        // Ganti Password Baru jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Paksa perbarui session user login agar langsung sinkron di semua halaman
        if (Auth::check()) {
            Auth::setUser($user->fresh());
        }

        return back()->with('success', 'Profil dan Password Administrator berhasil diperbarui!');
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

        // Upload Logo Baru
        if ($request->hasFile('logo_image')) {
            $oldLogo = AppSetting::getVal('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $logoPath = $request->file('logo_image')->store('branding', 'public');
            AppSetting::updateOrCreate(['key' => 'site_logo'], ['value' => $logoPath]);
        }

        // Simpan Ukuran dan Skala
        AppSetting::updateOrCreate(['key' => 'logo_size'], ['value' => $request->logo_size]);
        AppSetting::updateOrCreate(['key' => 'logo_fit'], ['value' => $request->logo_fit]);

        return back()->with('success', 'Logo resmi SMKN 2 Purwakarta berhasil diperbarui ke seluruh website!');
    }
}
