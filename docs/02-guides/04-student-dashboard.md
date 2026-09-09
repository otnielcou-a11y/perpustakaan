# 04. Dashboard Siswa & Guru

Route: `GET /siswa/dashboard` (route `siswa.dashboard`, wajib login). View: `siswa/dashboard.blade.php` dengan layout `siswa/layout.blade.php` (header + navbar + footer berbasis Bootstrap 5).

## Isi Dashboard

1. **Hero** — banner Librea dengan gradien hijau–kuning (mengganti gambar yang sebelumnya hilang).
2. **Peminjaman Aktif** — tabel buku yang sedang dipinjam:
   - Judul buku, penulis, tanggal pinjam, tenggat pengembalian, status.
   - Sumber data: `Loan::where('status','borrowed')` milik user.

## Navbar Siswa

`siswa/navbar.blade.php` — navigasi Bootstrap yang sudah responsif:

- Tombol **hamburger** (`navbar-toggler`) agar menu collapse terbuka di layar HP.
- Link: Home (`siswa.dashboard`), Pinjaman Buku, Daftar Buku (`collections`).
- Dropdown akun: Pengaturan Akun (`user.settings`) dan Logout (`logout`).

## Catatan Teknis

- CSS Bootstrap dimuat dari `public/asset/css/bootstrap.min.css` (bukan folder `assets`).
- Link `storage` tidak wajib untuk halaman siswa.

## Lanjutkan

- [Alur Transaksi](05-transactions.md)
- [Autentikasi](01-authentication.md)