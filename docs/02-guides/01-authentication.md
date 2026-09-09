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
- Setelah login, diarahkan sesuai role (admin ke `/admin/dashboard`, siswa/guru ke `/siswa/dashboard`).
- Logout: `GET /logout` (nama route `logout`).

## Session & Middleware

- Guard default Laravel session.
- Semua form memakai `@csrf` (proteksi CSRF).
- Middleware berlapis:
  - `auth` — halaman yang butuh login (`/pengaturan-akun`, pengajuan pinjam).
  - `admin` — seluruh `/admin/*`.
  - `superadmin` — khusus manajemen administrator.

## Reset Password (Coming Soon)

Halaman `lupa-password` → `verifikasi-kode` → `reset-password` sudah tersedia sebagai tampilan, dengan alur kode **OTP 6 digit** yang dikirim ke email.

> Status: **coming soon** — alur email/OTP belum diaktifkan penuh. Halaman tetap tersedia, namun verifikasi email belum dipakai.

### Alur halaman yang sudah ada

1. `GET /lupa-password` — input email (route `forgot.password`).
2. `GET /verifikasi-kode/{email}` — halaman input kode OTP (route `verify.otp.form`).
3. `POST /verifikasi-kode` — verifikasi kode (route `verify.otp`).
4. `GET /reset-password/{email}` — form password baru (route `reset.password.form`).
5. `POST /reset-password` — simpan password baru (route `reset.password`).

Header `routes/web.php` membunuh akses ulang setelah OTP kedaluwarsa (10 menit) dan setelah password berhasil diganti.

## Pengaturan Akun

Halaman: `GET /pengaturan-akun` (route `user.settings`, wajib login).

- Edit nama, email, password, dan foto profil (avatar).
- Update via `POST /pengaturan-akun` (route `user.settings.update`).

## Lanjutkan

- [Koleksi Buku](02-collections.md)
- [Daftar Route](../03-reference/01-routes.md)