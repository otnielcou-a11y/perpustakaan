<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    // 1. Tampilkan Halaman Input Email
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // 2. Kirim Kode OTP ke Email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak terdaftar di sistem kami.'
        ]);

        // Generate OTP 6 Angka Acak
        $otp = rand(100000, 999999);

        // Simpan/Update Token di Tabel password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $otp,
                'created_at' => Carbon::now()
            ]
        );

        // Kirim Email OTP via Gmail SMTP
        Mail::raw("Kode OTP verifikasi Reset Password Anda adalah: $otp\n\nKode ini berlaku selama 15 menit. Jangan berikan kode ini kepada siapapun.", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Kode Verifikasi Reset Password - SMKN 2 Purwakarta Libraries');
        });

        return redirect()->route('password.verify.form', ['email' => $request->email])
            ->with('success', 'Kode OTP telah dikirimkan ke email Anda!');
    }

    // 3. Tampilkan Halaman Input OTP & Password Baru
    public function showVerifyForm(Request $request)
    {
        return view('auth.verify-otp', ['email' => $request->email]);
    }

    // 4. Proses Eksekusi Reset Password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
        ]);

        // Cek Keberadaan Kode OTP di Database
        $resetData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->otp)
            ->first();

        if (!$resetData) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau tidak valid!']);
        }

        // Cek Kadaluarsa OTP (Lebih dari 15 menit)
        if (Carbon::parse($resetData->created_at)->addMinutes(15)->isPast()) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kadaluarsa. Silakan minta kode baru.']);
        }

        // Update Password User
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Hapus Token Setelah Digunakan
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil diubah! Silakan login.');
    }
}
