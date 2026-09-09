# 03. Quick Start

Setelah website berjalan, berikut langkah cepat untuk langsung mencoba seluruh fitur.

## 1. Jelajahi Halaman Publik

Buka `http://localhost:8000`:

| URL | Halaman |
|-----|---------|
| `/` | Home / landing (statistik, buku rekomendasi, kategori) |
| `/collections` | Koleksi buku + filter kategori + pencarian |
| `/buku/{id}` | Detail buku |
| `/about` | Tentang perpustakaan |
| `/profile` | Profil perpustakaan |
| `/login` , `/register` | Masuk / daftar akun |

## 2. Buat / Masuk Akun

- **Register**: siswa/guru daftar dengan NISN (dicek otomatis via `/api/cek-nisn/{nisn}`), username, dan email.
- **Login**: pakai username atau email + password.

## 3. Sebagai Siswa/Guru — Pinjam Buku

1. Buka **Daftar Buku** (`/collections`), pilih buku.
2. Di halaman **Detail Buku** (`/buku/{id}`), tekan **Pinjam**, pilih durasi 1–7 hari.
3. Cek status di `siswa/dashboard` — pengajuan `pending_borrow` menunggu admin.
4. Setelah disetujui, status menjadi `borrowed`. Saat selesai, tekan **Kembalikan** (status `pending_return`), lalu admin memverifikasi.
5. Update profil (& ganti password) di `/pengaturan-akun`.

## 4. Sebagai Admin

Login dengan akun `admin` / `superadmin`, lalu akses `/admin`:

| Menu | URL |
|------|-----|
| Dashboard | `/admin/dashboard` |
| Book Management | `/admin/data-buku` |
| Member Management | `/admin/data-anggota` |
| Transactions | `/admin/transaksi` |
| Category Management | `/admin/kategori` |
| Administrator (superadmin) | `/admin/tambah-admin` |
| Settings & Branding | `/admin/settings` |
| About Website | `/admin/tentang-website` |

Coba alur lengkap transaksi di [`05-transactions.md`](../02-guides/05-transactions.md).

## 5. Cek Responsif Mobil

Buka salah satu halaman admin dengan **DevTools mobile viewport** — sidebar berubah menjadi **drawer** dengan tombol hamburger, tabel bisa di-scroll horizontal, dan form menumpuk menjadi 1 kolom. Detail lengkap di [`06-responsive-design.md`](../02-guides/06-responsive-design.md).

## Lanjutkan

- [Autentikasi & OTP](../02-guides/01-authentication.md)
- [Panel Admin](../02-guides/03-admin-panel.md)