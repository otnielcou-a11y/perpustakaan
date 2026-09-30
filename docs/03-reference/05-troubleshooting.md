# 05. Troubleshooting

Masalah umum saat mengembangkan/menjalankan website.

## Halaman Admin Tampil Polos / Tanpa Style

Jika memakai `admin.layout.blade.php`, pastikan:

```bash
ls public/asset/css/admin.css
ls public/asset/js/admin.js
```

Kedua file adalah design system resmi panel admin (CSS + JS drawer/modal). Jika hilang, jalankan `git checkout -- public/asset/css/admin.css public/asset/js/admin.js` (atau pull dari repo).

## Gambar Cover / Logo Tidak Muncul

1. Link folder storage: `php artisan storage:link`.
2. Prioritas `cover_url`: upload lokal (`storage/`) → `asset/img/books/` → fallback Unsplash.
3. Pastikan ukuran upload di bawah 2MB dengan tipe jpeg/png/jpg/webp (validasi `BookController`).

## Navbar Tidak Bisa Dibuka di Layar HP

Halaman publik memakai partial `public_navbar.blade.php` yang berisi tombol hamburger. Antisipasi:

- Cek media query `max-width: 768px` ada (tombol `nav-toggle` menampilkan menu dropdown).
- Nonaktifkan cache: `php artisan view:clear`.

## Route Tidak Ditemukan (NotFound / Route Not Defined)

- Route aktual ada di `routes/web.php` — lihat daftar lengkap di [Daftar Route](01-routes.md).
- Halaman legacy (`input_buku`, `editbuku`, `inputanggota`, `data_peminjaman`, `input_datapeminjaman`) **belum memiliki route** — hanya view. Form-nya menunjuk route sungguhan dan siap dipakai bila route ditambahkan.
- Jangan menyebut `route('input_datapeminjaman')` — nama route itu tidak ada.

## `admin.transactions.return`

Route `POST /admin/transaksi/kembalikan/{id}` menunjuk `TransactionController@approveReturn` — alias dari `terima-kembali/{id}`. Aman dipakai.

## Stok Berubah Tak Sesuai

- `stock_available` berkurang saat borrow disetujui (`approveBorrow`), bertambah saat return diverifikasi (`approveReturn`).
- Jika out of sync, cek log `system_logs` dengan action `Borrow Approved` / `Return Verified`.

## Email OTP Tidak Terkirim

Reset password memakai **Gmail API (OAuth2)** sebagai jalur utama dan **SMTP** sebagai fallback.

1. Konfigurasi kredensial Gmail API di `.env` (lihat Authentication Guide):
   `GMAIL_CLIENT_ID`, `GMAIL_CLIENT_SECRET`, `GMAIL_REFRESH_TOKEN`, `GMAIL_USER_EMAIL`.
2. Atau gunakan SMTP + app password Gmail: `MAIL_MAILER=smtp`, `MAIL_HOST=smtp.gmail.com`, `MAIL_PORT=587`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_ENCRYPTION=tls`.
3. `php artisan config:clear`.
4. Cek log `laravel.log` — pesan `reason` dari Gmail API/SMTP akan ditulis (lihat `PasswordResetController@sendOtpEmail`).

## Cache & Key

```bash
php artisan view:cache      # kompilasi semua blade (menemukan error sintaks)
php artisan view:clear
php artisan route:list      # lihat route terdaftar
php artisan migrate:fresh --seed  # reset data (hati-hati)
```

## Lanjutkan

- [Daftar Route](01-routes.md)
- [Kontroller](02-controllers.md)