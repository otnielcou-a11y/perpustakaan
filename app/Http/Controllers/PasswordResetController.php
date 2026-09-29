<?php

namespace App\Http\Controllers;

use App\Mail\OtpResetMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class PasswordResetController extends Controller
{
    /**
     * Kirim email OTP.
     * Urutan percobaan: Gmail REST API (OAuth2) -> SMTP Laravel (app password).
     * Mengembalikan array ['sent' => bool, 'reason' => string|null].
     */
    private function sendOtpEmail(string $to, string $otp, string $userName): array
    {
        $htmlContent = view('emails.otp_reset', [
            'otpCode'  => $otp,
            'userName' => $userName,
        ])->render();

        $apiResult = $this->sendViaGmailApi(
            $to,
            'Kode Verifikasi Reset Kata Sandi - SMKN 2 Purwakarta Libraries',
            $htmlContent
        );

        if ($apiResult['sent']) {
            return ['sent' => true, 'reason' => null];
        }

        Log::warning('Gmail API gagal kirim OTP, mencoba SMTP.', [
            'email'  => $to,
            'reason' => $apiResult['reason'],
        ]);

        // Fallback: SMTP Gmail via app password (MAIL_* di .env)
        try {
            Mail::to($to)->send(new OtpResetMail($otp, $userName));
            return ['sent' => true, 'reason' => null];
        } catch (\Throwable $e) {
            Log::error('SMTP gagal kirim OTP.', [
                'email'  => $to,
                'reason' => $e->getMessage(),
            ]);

            return ['sent' => false, 'reason' => $apiResult['reason'] . ' | SMTP: ' . $e->getMessage()];
        }
    }

    /**
     * Helper: Kirim Email via Gmail REST API (OAuth2 refresh token).
     */
    private function sendViaGmailApi($to, $subject, $htmlContent): array
    {
        $clientId     = env('GMAIL_CLIENT_ID');
        $clientSecret = env('GMAIL_CLIENT_SECRET');
        $refreshToken = env('GMAIL_REFRESH_TOKEN');
        $senderEmail  = env('GMAIL_USER_EMAIL', 'otnielcou@gmail.com');

        if (!$clientId || !$clientSecret || !$refreshToken) {
            return ['sent' => false, 'reason' => 'Kredensial Gmail API belum lengkap di .env (GMAIL_CLIENT_ID / GMAIL_CLIENT_SECRET / GMAIL_REFRESH_TOKEN).'];
        }

        try {
            $tokenResponse = Http::asForm()
                ->timeout(20)
                ->post('https://oauth2.googleapis.com/token', [
                    'client_id'     => $clientId,
                    'client_secret' => $clientSecret,
                    'refresh_token' => $refreshToken,
                    'grant_type'    => 'refresh_token',
                ]);

            if (!$tokenResponse->successful()) {
                return ['sent' => false, 'reason' => 'Refresh token ditolak Google (HTTP ' . $tokenResponse->status() . '): ' . $tokenResponse->body()];
            }

            $accessToken = $tokenResponse->json()['access_token'] ?? null;
            if (!$accessToken) {
                return ['sent' => false, 'reason' => 'Access token tidak ditemukan pada respons Google.'];
            }

            $senderName  = config('app.name');
            $rawMessage  = "From: {$senderName} <{$senderEmail}>\r\n";
            $rawMessage .= "To: {$to}\r\n";
            $rawMessage .= "Subject: =?utf-8?B?" . base64_encode($subject) . "?=\r\n";
            $rawMessage .= "MIME-Version: 1.0\r\n";
            $rawMessage .= "Content-Type: text/html; charset=utf-8\r\n\r\n";
            $rawMessage .= $htmlContent;

            $rawMessageBase64 = rtrim(strtr(base64_encode($rawMessage), '+/', '-_'), '=');

            $response = Http::withToken($accessToken)
                ->timeout(20)
                ->post('https://gmail.googleapis.com/gmail/v1/users/' . $senderEmail . '/messages/send', [
                    'raw' => $rawMessageBase64,
                ]);

            if (!$response->successful()) {
                return ['sent' => false, 'reason' => 'Gmail API menolak pengiriman (HTTP ' . $response->status() . '): ' . $response->body()];
            }

            return ['sent' => true, 'reason' => null];
        } catch (\Throwable $e) {
            return ['sent' => false, 'reason' => $e->getMessage()];
        }
    }

    public function showForgotForm()
    {
        return view('forgot-password');
    }

    /**
     * Reset password via email hanya aktif bila PASSWORD_RESET_VIA_EMAIL=true.
     * Selama nonaktif, pemulihan dilakukan manual oleh administrator.
     */
    private function emailResetEnabled(): bool
    {
        return (bool) config('services.password_reset_via_email.enabled', false);
    }

    private function emailResetDisabledMessage(): string
    {
        return 'Reset kata sandi via email sedang dinonaktifkan. Silakan hubungi administrator perpustakaan untuk assistance.';
    }

    public function sendOtp(Request $request)
    {
        // Reset password via email dinonaktifkan sementara.
        // Halaman "Lupa Password" hanya menampilkan panduan menghubungi administrator.
        if (!$this->emailResetEnabled()) {
            return redirect()->route('forgot.password')
                             ->withErrors(['email' => $this->emailResetDisabledMessage()]);
        }

        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
        ]);

        $email = trim(strtolower($request->email));

        try {
            $user = User::whereNotNull('email')
                        ->where('email', $email)
                        ->first();

            if (!$user) {
                return back()->withErrors([
                    'email' => 'Email tidak ditemukan, atau akun dengan email ini tidak terdaftar di sistem.'
                ])->withInput();
            }

            $otp     = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $expires = Carbon::now()->addMinutes(10);

            try {
                DB::table('password_reset_tokens')->updateOrInsert(
                    ['email' => $email],
                    [
                        'token'          => bcrypt($otp),
                        'otp_code'       => $otp,
                        'otp_expires_at' => $expires,
                        'otp_verified'   => 0,
                        'created_at'     => Carbon::now(),
                    ]
                );
            } catch (\Throwable $dbEx) {
                Log::error('Gagal menulis OTP ke password_reset_tokens.', ['error' => $dbEx->getMessage()]);
                return back()->withErrors([
                    'email' => 'Struktur tabel reset password di hosting belum lengkap. Jalankan: php artisan migrate --force'
                ])->withInput();
            }

            $result = $this->sendOtpEmail($email, $otp, $user->name);

            if (!$result['sent']) {
                Log::error('Total gagal kirim OTP via semua kanal.', [
                    'email'  => $email,
                    'reason' => $result['reason'],
                ]);

                DB::table('password_reset_tokens')->where('email', $email)->delete();

                return back()->withErrors([
                    'email' => 'Gagal mengirim email OTP. Silakan coba lagi beberapa saat lagi.'
                ])->withInput();
            }

            return redirect()->route('verify.otp.form', ['encodedEmail' => base64_encode($email)])
                             ->with('success', 'Kode verifikasi OTP 6-digit telah dikirim ke email ' . $email . '! Periksa Kotak Masuk (Inbox) Anda.');

        } catch (\Throwable $e) {
            return back()->withErrors([
                'email' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ])->withInput();
        }
    }

    public function showVerifyForm($encodedEmail)
    {
        if (!$this->emailResetEnabled()) {
            return redirect()->route('forgot.password')
                             ->withErrors(['email' => $this->emailResetDisabledMessage()]);
        }

        $email = base64_decode($encodedEmail);

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

    public function verifyOtp(Request $request)
    {
        if (!$this->emailResetEnabled()) {
            return redirect()->route('forgot.password')
                             ->withErrors(['email' => $this->emailResetDisabledMessage()]);
        }

        $request->validate([
            'encoded_email' => 'required',
            'otp'           => 'required|digits:6',
        ], [
            'otp.required' => 'Kode verifikasi wajib diisi.',
            'otp.digits'   => 'Kode verifikasi harus 6 angka.',
        ]);

        $email    = base64_decode($request->encoded_email);
        $otpInput = trim($request->otp);

        $record = DB::table('password_reset_tokens')
                    ->where('email', $email)
                    ->first();

        if (!$record) {
            return back()->withErrors(['otp' => 'Sesi tidak valid. Silakan ulangi dari awal.']);
        }

        if (Carbon::now()->isAfter(Carbon::parse($record->otp_expires_at))) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return redirect()->route('forgot.password')
                             ->withErrors(['email' => 'Kode verifikasi sudah kedaluwarsa. Silakan minta kode baru.']);
        }

        if ($record->otp_code !== $otpInput) {
            return back()->withErrors(['otp' => 'Kode verifikasi salah. Periksa kembali email Anda.']);
        }

        DB::table('password_reset_tokens')
            ->where('email', $email)
            ->update(['otp_verified' => true]);

        return redirect()->route('reset.password.form', ['encodedEmail' => $request->encoded_email])
                         ->with('success', 'Kode berhasil diverifikasi! Silakan buat kata sandi baru.');
    }

    public function showResetForm($encodedEmail)
    {
        $email = base64_decode($encodedEmail);

        $record = DB::table('password_reset_tokens')
                    ->where('email', $email)
                    ->where('otp_verified', true)
                    ->first();

        if (!$record) {
            return redirect()->route('forgot.password')
                             ->withErrors(['email' => 'Akses tidak diizinkan. Silakan ulangi proses verifikasi.']);
        }

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

    // SIMPAN PASSWORD BARU DENGAN SINKRONISASI DATABASE YANG BENAR
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

        $email = trim(strtolower(base64_decode($request->encoded_email)));

        // Verifikasi kelayakan reset
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

        // Cari User berdasarkan email
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('forgot.password')
                             ->withErrors(['email' => 'User tidak ditemukan.']);
        }

        // Update password secara eksplisit & simpan
        $user->password = Hash::make($request->password);
        $user->save();

        // Bersihkan token dari database setelah sukses
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return redirect()->route('login')
                         ->with('success', 'Kata sandi berhasil direset! Silakan masuk dengan kata sandi baru Anda.');
    }
}
