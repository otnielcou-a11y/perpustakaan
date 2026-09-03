<?php

namespace App\Http\Controllers;

use App\Mail\OtpResetMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class PasswordResetController extends Controller
{
    // ============================================================
    // 1. Halaman "Lupa Password?"
    // ============================================================
    public function showForgotForm()
    {
        return view('forgot-password');
    }

    // ============================================================
    // 2. Kirim OTP ke Email
    // ============================================================
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
        ]);

        $email = trim(strtolower($request->email));

        // Cek apakah email ada & milik user yang mendaftar dengan email
        $user = User::whereNotNull('email')
                    ->where('email', $email)
                    ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan, atau akun dengan email ini tidak ada. Jika Anda tidak mendaftar menggunakan email, silakan hubungi administrator.'
            ])->withInput();
        }

        // Generate OTP 6 digit
        $otp     = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expires = Carbon::now()->addMinutes(10);

        // Simpan / update ke tabel password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token'          => bcrypt($otp), // simpan hash juga sebagai backup
                'otp_code'       => $otp,
                'otp_expires_at' => $expires,
                'otp_verified'   => false,
                'created_at'     => Carbon::now(),
            ]
        );

        // Kirim email
        try {
            Mail::to($email)->send(new OtpResetMail($otp, $user->name));
        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Gagal mengirim email. Pastikan konfigurasi email sudah benar. (Error: ' . $e->getMessage() . ')'
            ])->withInput();
        }

        return redirect()->route('verify.otp.form', ['email' => base64_encode($email)])
                         ->with('success', 'Kode verifikasi telah dikirim ke email Anda. Periksa kotak masuk atau folder spam.');
    }

    // ============================================================
    // 3. Halaman Input Kode OTP
    // ============================================================
    public function showVerifyForm($encodedEmail)
    {
        $email = base64_decode($encodedEmail);

        // Pastikan ada record OTP untuk email ini
        $record = DB::table('password_reset_tokens')
                    ->where('email', $email)
                    ->whereNotNull('otp_code')
                    ->first();

        if (!$record) {
            return redirect()->route('forgot.password')
                             ->withErrors(['email' => 'Sesi reset tidak valid. Silakan mulai ulang.']);
        }

        return view('verify-otp', [
            'encodedEmail' => $encodedEmail,
            'email'        => $email,
        ]);
    }

    // ============================================================
    // 4. Verifikasi Kode OTP
    // ============================================================
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'encoded_email' => 'required',
            'otp'           => 'required|digits:6',
        ], [
            'otp.required' => 'Kode verifikasi wajib diisi.',
            'otp.digits'   => 'Kode verifikasi harus 6 angka.',
        ]);

        $email     = base64_decode($request->encoded_email);
        $otpInput  = $request->otp;

        $record = DB::table('password_reset_tokens')
                    ->where('email', $email)
                    ->first();

        if (!$record) {
            return back()->withErrors(['otp' => 'Sesi tidak valid. Silakan ulangi dari awal.']);
        }

        // Cek expired
        if (Carbon::now()->isAfter(Carbon::parse($record->otp_expires_at))) {
            // Hapus token expired
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return redirect()->route('forgot.password')
                             ->withErrors(['email' => 'Kode verifikasi sudah kedaluwarsa. Silakan minta kode baru.']);
        }

        // Cek kode cocok
        if ($record->otp_code !== $otpInput) {
            return back()->withErrors(['otp' => 'Kode verifikasi salah. Periksa kembali email Anda.']);
        }

        // Tandai sudah diverifikasi
        DB::table('password_reset_tokens')
            ->where('email', $email)
            ->update(['otp_verified' => true]);

        return redirect()->route('reset.password.form', ['email' => $request->encoded_email])
                         ->with('success', 'Kode berhasil diverifikasi! Silakan buat kata sandi baru.');
    }

    // ============================================================
    // 5. Halaman Form Password Baru
    // ============================================================
    public function showResetForm($encodedEmail)
    {
        $email = base64_decode($encodedEmail);

        // Pastikan sudah diverifikasi OTP-nya
        $record = DB::table('password_reset_tokens')
                    ->where('email', $email)
                    ->where('otp_verified', true)
                    ->first();

        if (!$record) {
            return redirect()->route('forgot.password')
                             ->withErrors(['email' => 'Akses tidak diizinkan. Silakan ulangi proses verifikasi.']);
        }

        // Cek expired lagi (jangan sampai diakses langsung via URL)
        if (Carbon::now()->isAfter(Carbon::parse($record->otp_expires_at))) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return redirect()->route('forgot.password')
                             ->withErrors(['email' => 'Sesi sudah kedaluwarsa. Silakan mulai ulang.']);
        }

        return view('reset-password', [
            'encodedEmail' => $encodedEmail,
            'email'        => $email,
        ]);
    }

    // ============================================================
    // 6. Simpan Password Baru
    // ============================================================
    public function resetPassword(Request $request)
    {
        $request->validate([
            'encoded_email'         => 'required',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ], [
            'password.required'     => 'Kata sandi baru wajib diisi.',
            'password.min'          => 'Kata sandi minimal 6 karakter.',
            'password.confirmed'    => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $email = base64_decode($request->encoded_email);

        // Verifikasi ulang record
        $record = DB::table('password_reset_tokens')
                    ->where('email', $email)
                    ->where('otp_verified', true)
                    ->first();

        if (!$record) {
            return redirect()->route('forgot.password')
                             ->withErrors(['email' => 'Sesi tidak valid. Silakan ulangi proses dari awal.']);
        }

        if (Carbon::now()->isAfter(Carbon::parse($record->otp_expires_at))) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return redirect()->route('forgot.password')
                             ->withErrors(['email' => 'Sesi kedaluwarsa. Silakan ulangi proses dari awal.']);
        }

        // Update password user
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('forgot.password')
                             ->withErrors(['email' => 'User tidak ditemukan.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Hapus token (sudah selesai)
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return redirect()->route('login')
                         ->with('success', 'Kata sandi berhasil direset! Silakan masuk dengan kata sandi baru Anda.');
    }
}
