# 01. Introduction

## Apa itu Website Perpustakaan SMKN 2 Purwakarta?

Website **perpustakaan digital** untuk SMKN 2 Purwakarta yang mengelola kebutuhan perpustakaan secara terpusat:

- Manajemen **koleksi buku** (CRUD lengkap, cover, stok, kategori)
- Manajemen **anggota** (siswa & guru, ban/unban, riwayat pinjam)
- **Peminjaman & pengembalian** dengan alur persetujuan admin
- **Dashboard admin** dengan statistik real-time
- **Dashboard siswa/guru** berisi peminjaman aktif
- **Branding perpustakaan** yang bisa disesuaikan
- **Responsif penuh** — nyaman dipakai di desktop dan mobile

## Platform & Teknologi

| Layer | Teknologi |
|-------|-----------|
| Backend | Laravel 10.x (PHP 8.1+) |
| Frontend | Blade + Custom CSS + Bootstrap 5 (halaman siswa) |
| Font & Ikon | Plus Jakarta Sans, Font Awesome 6 |
| Database | MySQL |
| Auth | Laravel session guard + Bcrypt + CSRF |
| Email | SMTP (untuk reset password — coming soon) |
| Dev Environment | Laragon (Windows) |

## Role Pengguna

| Role | Keterangan |
|------|------------|
| `murid` | Siswa: melihat koleksi, pinjam/kembalikan buku |
| `guru` | Guru: sama seperti murid |
| `admin` | Akses penuh panel admin, kelola data |
| `superadmin` | Admin + kelola akun administrator |

## Fitur Utama

- Live search buku dengan saran real-time (`/api/books/suggest`)
- Validasi NISN real-time saat registrasi (`/api/cek-nisn/{nisn}`)
- Peminjaman dengan durasi **1–7 hari**
- Bulk delete buku & kategori
- Log aktivitas sistem (`system_logs`)

**Coming soon:** verifikasi email dengan kode OTP untuk reset password (halaman `lupa-password` → OTP → password baru sudah tersedia secara tampilan, namun alur email belum diaktifkan).

## Lanjutkan

- Lanjut ke [Installation](02-installation.md)
- Lihat [Quick Start](03-quick-start.md)