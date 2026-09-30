# 01. Autentikasi

Alur masuk ke website dan manajemen akun.

## Register (Daftar Akun)

Halaman: `GET /register` — untuk siswa dan guru.

- Isi NISN — dicek otomatis lewat `/api/cek-nisn/{nisn}` (validasi real-time berbasis data `master_students`).
- Lengkapi nama, username, email, dan password.
- Field email bersifat opsional (`nullable`).

## Login (Masuk)

Halaman: `GET /login` → `POST /login`.

- Login menggunakan **username** atau **email** + password.
- Password di-hash dengan Bcrypt (`casts => 'hashed'`).
- Setelah login diarahkan ke `/` (home); admin bisa menuju `/admin/dashboard`, siswa/guru ke `/siswa/dashboard` dari navbar.
- Logout: `GET /logout` (nama route `logout`).

## Session & Middleware

- Guard default Laravel session.
- Semua form memakai `@csrf` (proteksi CSRF).
- Middleware berlapis:
  - `auth` — halaman yang butuh login (`/pengaturan-akun`, pengajuan pinjam).
  - `admin` — seluruh `/admin/*`.
  - `superadmin` — khusus manajemen administrator.

## Reset Password dengan OTP

Alur reset password memakai kode **OTP 6 digit** yang dikirim ke email pengguna (Gmail API OAuth2, fallback SMTP). Semua halaman berstatus `guest`.

### Alur

1. `GET /forgot-password` (alias `/lupa-password`) — input email (route `forgot.password` / `password.request`).
2. `POST /forgot-password` — kirim kode OTP (route `password.email`, dibatasi `throttle:5,10`).
3. `GET /verify-otp/{encodedEmail}` — halaman input kode OTP (route `verify.otp.form`).
4. `POST /verify-otp` (alias `/verify-otp-submit`) — verifikasi kode (route `verify.otp`, dibatasi `throttle:10,10`).
5. `GET /reset-password/{encodedEmail}` — form password baru (route `reset.password.form`).
6. `POST /reset-password` (alias `/reset-password-update`) — simpan password baru (route `reset.password` / `password.update`).

### Konfigurasi Email (.env)

```dotenv
# Jalur utama: Gmail API (OAuth2)
GMAIL_CLIENT_ID=
GMAIL_CLIENT_SECRET=
GMAIL_REFRESH_TOKEN=
GMAIL_USER_EMAIL=otnielcou@gmail.com
PASSWORD_RESET_VIA_EMAIL=true

# Fallback bila Gmail API gagal: SMTP + app password Gmail
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email-anda@gmail.com
MAIL_PASSWORD=app-password-anda
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=email-anda@gmail.com
MAIL_FROM_NAME="Perpustakaan SMKN 2 Purwakarta"
```

Kode OTP kedaluwarsa setelah batas waktu tertentu dan token batch tidak bisa dipakai ulang setelah password berhasil diganti.

## Pengaturan Akun

Halaman: `GET /pengaturan-akun` (route `user.settings`, wajib login).

- Edit nama, email, password, dan foto profil (avatar).
- Update via `POST /pengaturan-akun` (route `user.settings.update`).

## Lanjutkan

- [Koleksi Buku](02-collections.md)
- [Daftar Route](../03-reference/01-routes.md)