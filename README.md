# SMKN 2 Purwakarta Libraries

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Version-0.0.1_Beta-blue?style=for-the-badge" alt="Version">
</p>

Sistem perpustakaan digital berbasis web untuk **SMKN 2 Purwakarta** yang dirancang untuk mengelola koleksi buku secara digital, menyederhanakan proses administrasi, dan memberikan pusat sumber daya pendidikan terintegrasi bagi siswa dan staf.

---

## Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Halaman Website (Public)](#-halaman-website-public)
- [Panel Admin](#-panel-admin)
- [Dashboard Siswa & Guru](#-dashboard-siswa--guru)
- [Autentikasi & Keamanan](#-autentikasi--keamanan)
- [Role & Hak Akses](#-role--hak-akses)
- [Tech Stack](#-tech-stack)
- [Struktur Project](#-struktur-project)
- [Instalasi & Setup](#-instalasi--setup)
- [Database Models](#-database-models)
- [API Endpoints](#-api-endpoints)
- [Roadmap](#-roadmap)
- [Lisensi](#-lisensi)

---

## Fitur Utama

| Fitur | Deskripsi | Status |
|-------|-----------|--------|
|  Manajemen Buku | CRUD buku dengan cover, stok, sinopsis, dan bulk delete | ✅ Aktif |
|  Manajemen Kategori | Kelola kategori buku dengan bulk operations | ✅ Aktif |
|  Manajemen Anggota | Kelola data siswa & guru, ban/unban, lihat riwayat | ✅ Aktif |
|  Peminjaman & Pengembalian | Request pinjam → approval admin → pengembalian | ✅ Beta |
|  Dashboard Admin | Statistik real-time (total buku, anggota, transaksi) | ✅ Aktif |
|  Live Search | Pencarian buku real-time dengan API suggestions | ✅ Aktif |
|  Login & Register | Autentikasi dengan NISN/NIP dan email | ✅ Aktif |
|  Forgot Password (OTP) | Reset password via kode OTP yang dikirim ke email | Menyusul |
|  Role-Based Access | 4 level akses: Superadmin, Admin, Guru, Murid | ✅ Aktif |
|  Library Branding | Kustomisasi nama, deskripsi, dan logo perpustakaan | ✅ Aktif |
|  Pengaturan Akun | Edit profil, email, password, dan foto profil | ✅ Aktif |
|  Responsive Design | Tampilan optimal di desktop & mobile | ✅ Aktif |

---

## Halaman Website (Public)

Halaman-halaman yang bisa diakses oleh semua pengunjung:

### Home (`/`)
Landing page utama yang menampilkan:
- Statistik perpustakaan (total buku, kategori, anggota)
- Rekomendasi buku acak dari database
- Daftar kategori buku
- Navigasi ke seluruh fitur website

### Collections (`/collections`)
- Direktori lengkap semua buku di perpustakaan
- Filter berdasarkan kategori / program keahlian
- Pagination untuk navigasi buku yang banyak
- Pencarian buku dengan keyword

### Detail Buku (`/buku/{id}`)
- Sinopsis dan metadata lengkap buku
- Informasi ketersediaan stok
- Cover buku
- Tombol pinjam (untuk user yang sudah login)

### About (`/about`)
- Visi dan misi perpustakaan SMKN 2 Purwakarta
- Informasi tentang tujuan dan layanan perpustakaan

### Profile Perpustakaan (`/profile`)
- Informasi umum perpustakaan
- Detail kontak
- Overview layanan per program keahlian

### Login (`/login`) & Register (`/register`)
- Form login dengan NISN/NIP atau email
- Registrasi akun baru untuk siswa & guru
- Validasi NISN real-time saat registrasi

### Forgot Password (`/lupa-password`)
- Input email untuk request reset password
- Verifikasi kode OTP (`/verifikasi-kode/{email}`)
- Form reset password baru (`/reset-password/{email}`)

---

## Panel Admin

Diakses melalui `/admin/*` — hanya untuk user dengan role `admin` atau `superadmin`.

### Dashboard (`/admin/dashboard`)
Tampilan ringkasan statistik:
- Total buku, kategori, dan anggota
- Transaksi terbaru
- Grafik & overview aktivitas perpustakaan

### Book Management (`/admin/data-buku`)
- **Tambah buku** baru dengan cover image upload
- **Edit** detail buku (judul, penulis, penerbit, tahun, stok, sinopsis, kategori)
- **Hapus** buku individual atau bulk delete (hapus banyak sekaligus)

### Category Management (`/admin/kategori`)
- **Tambah** kategori baru
- **Edit** nama kategori
- **Hapus** kategori individual atau bulk delete

### Member Management (`/admin/data-anggota`)
- Lihat semua anggota terdaftar (siswa & guru)
- **Tambah** anggota baru secara manual
- **Edit** detail anggota
- **Lihat riwayat** peminjaman per anggota
- **Ban / Unban** anggota yang melanggar

### Transaction Management (`/admin/transaksi`)
- Lihat semua permintaan peminjaman masuk
- **Setujui** atau **tolak** permintaan pinjam
- **Proses pengembalian** buku
- Monitor seluruh riwayat transaksi (aktif & selesai)

### Administrator Management (`/admin/tambah-admin`)
> **Khusus Superadmin**
- Tambah akun admin baru
- Edit profil admin
- Downgrade admin ke role biasa
- Hapus akun admin

### Settings (`/admin/settings`)
- Update profil admin (nama, email, password)
- Kustomisasi branding perpustakaan (nama, deskripsi, logo)

### About Website (`/admin/tentang-website`)
- Dokumentasi lengkap website
- Informasi sistem, versi, dan tech stack

---

## Dashboard Siswa & Guru

Diakses melalui `/siswa/dashboard` — untuk user yang sudah login.

| Fitur | Deskripsi |
|-------|-----------|
|  Pinjaman Aktif | Daftar buku yang sedang dipinjam beserta status dan tanggal |
|  Riwayat Pengembalian | Daftar buku yang sudah dikembalikan |
|  Quick Actions | Akses cepat ke koleksi, pengembalian, dan pengaturan |
|  Pengaturan Akun | Edit nama, email, password, dan foto profil (`/pengaturan-akun`) |

---

## Autentikasi & Keamanan

```
Login / Register ──→ Session-based Auth (Laravel Guard)
        │
        ├── NISN/NIP Validation (real-time API check)
        ├── Bcrypt Password Hashing
        ├── CSRF Protection (semua form)
        ├── Middleware: auth, admin, superadmin
        │
        └── Forgot Password Flow:
            Email ──→ OTP Code ──→ Verify ──→ Reset Password
```

- **Login & Register** — Siswa/guru mendaftar dengan NISN/NIP dan email
- **Forgot Password** — Reset password via OTP yang dikirim ke email (SMTP)
- **Middleware Protection** — `AdminMiddleware` dan `SuperAdminMiddleware` menjaga halaman admin
- **Session Management** — Laravel session guard untuk state management

---

## Role & Hak Akses

| Role | Public Pages | Pinjam/Kembalikan | Dashboard Siswa | Panel Admin | Kelola Admin |
|------|:---:|:---:|:---:|:---:|:---:|
| **Pengunjung** (Guest) | ✅ | ❌ | ❌ | ❌ | ❌ |
| **Murid** (Student) | ✅ | ✅ | ✅ | ❌ | ❌ |
| **Guru** (Teacher) | ✅ | ✅ | ✅ | ❌ | ❌ |
| **Admin** | ✅ | ✅ | ✅ | ✅ | ❌ |
| **Superadmin** | ✅ | ✅ | ✅ | ✅ | ✅ |

---

## Tech Stack

| Layer | Teknologi | Detail |
|-------|-----------|--------|
| **Backend** | Laravel 10.x | PHP 8.1+, MVC architecture, Eloquent ORM, Blade templating |
| **Frontend** | Blade + Custom CSS | Plus Jakarta Sans font, Font Awesome 6 icons, fully responsive |
| **Database** | MySQL | Relational database untuk buku, kategori, users, loans, settings |
| **Auth** | Laravel Auth | Bcrypt hashing, CSRF tokens, session guard, role middleware |
| **Email** | SMTP | OTP-based password reset via email |
| **Dev Environment** | Laragon | Portable development stack untuk Windows |

---

## Struktur Project

```
perpustakaan/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php          # Login, register, logout
│   │   │   ├── PasswordResetController.php # Forgot password & OTP
│   │   │   ├── BookController.php          # CRUD buku (public & admin)
│   │   │   ├── CategoryController.php      # CRUD kategori
│   │   │   ├── MemberController.php        # Kelola anggota
│   │   │   ├── LoanController.php          # Proses pinjam & kembali (user)
│   │   │   ├── TransactionController.php   # Approve/reject transaksi (admin)
│   │   │   ├── AdminDashboardController.php# Dashboard & about website
│   │   │   ├── AdminController.php         # Kelola akun admin (superadmin)
│   │   │   ├── SettingController.php       # Settings & branding
│   │   │   └── UserProfileController.php   # Pengaturan akun user
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php         # Guard halaman admin
│   │       └── SuperAdminMiddleware.php    # Guard halaman superadmin
│   └── Models/
│       ├── User.php                        # Model user (semua role)
│       ├── Book.php                        # Model buku
│       ├── Category.php                    # Model kategori
│       ├── Loan.php                        # Model peminjaman
│       ├── MasterStudent.php               # Data master siswa (validasi NISN)
│       ├── AppSetting.php                  # Pengaturan branding
│       └── SystemLog.php                   # Log aktivitas sistem
│
├── resources/views/
│   ├── home.blade.php                      # Landing page
│   ├── collections.blade.php               # Halaman koleksi buku
│   ├── detail-buku.blade.php               # Detail buku
│   ├── about.blade.php                     # Visi & misi
│   ├── profile-perpustakaan.blade.php      # Profil perpustakaan
│   ├── login.blade.php                     # Halaman login
│   ├── register.blade.php                  # Halaman registrasi
│   ├── forgot-password.blade.php           # Lupa password
│   ├── verify-otp.blade.php                # Verifikasi OTP
│   ├── reset-password.blade.php            # Reset password baru
│   ├── user_settings.blade.php             # Pengaturan akun
│   ├── partials/
│   │   ├── public_navbar.blade.php         # Navbar publik (reusable)
│   │   ├── admin_avatar.blade.php          # Avatar admin header
│   │   └── logo.blade.php                  # Logo komponen
│   ├── siswa/
│   │   ├── dashboard.blade.php             # Dashboard siswa/guru
│   │   ├── layout.blade.php                # Layout siswa
│   │   └── ...                             # Komponen siswa lainnya
│   ├── admin/
│   │   ├── dashboard.blade.php             # Dashboard admin
│   │   ├── data_buku.blade.php             # Manajemen buku
│   │   ├── data_anggota.blade.php          # Manajemen anggota
│   │   ├── data_kategori.blade.php         # Manajemen kategori
│   │   ├── transaksi.blade.php             # Manajemen transaksi
│   │   ├── tambah-admin.blade.php          # Manajemen admin
│   │   ├── settings.blade.php              # Pengaturan admin
│   │   ├── tentang-website.blade.php       # About website
│   │   └── layout.blade.php                # Layout admin
│   └── emails/
│       └── otp_reset.blade.php             # Template email OTP
│
├── routes/
│   └── web.php                             # Semua route definitions
│
├── database/
│   ├── migrations/                         # Schema tabel database
│   └── seeders/                            # Data seeder
│
├── public/                                 # Assets publik (images, css, js)
├── config/                                 # Konfigurasi Laravel
├── .env                                    # Environment variables
├── composer.json                           # PHP dependencies
└── README.md                               # Dokumentasi ini
```

---

## Instalasi & Setup

### Prasyarat
- PHP >= 8.1
- Composer
- MySQL
- Laragon (direkomendasikan) atau XAMPP/WAMP

### Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/otnielcou-a11y/perpustakaan.git
cd perpustakaan

# 2. Install dependencies
composer install

# 3. Copy dan konfigurasi environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi database di file .env
#    DB_DATABASE=perpustakaan
#    DB_USERNAME=root
#    DB_PASSWORD=

# 6. Konfigurasi SMTP email di file .env (untuk fitur OTP)
#    MAIL_MAILER=smtp
#    MAIL_HOST=smtp.gmail.com
#    MAIL_PORT=587
#    MAIL_USERNAME=your-email@gmail.com
#    MAIL_PASSWORD=your-app-password
#    MAIL_ENCRYPTION=tls

# 7. Jalankan migrasi database
php artisan migrate

# 8. (Opsional) Jalankan seeder untuk data awal
php artisan db:seed

# 9. Jalankan server
php artisan serve
```

Akses website di: `http://localhost:8000` atau `http://perpustakaan.test` (Laragon)

---

## Database Models

```
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│    Users     │     │    Books     │     │  Categories  │
├──────────────┤     ├──────────────┤     ├──────────────┤
│ id           │     │ id           │     │ id           │
│ name         │     │ judul        │     │ nama         │
│ email        │     │ penulis      │     │ created_at   │
│ password     │     │ penerbit     │     │ updated_at   │
│ role         │     │ tahun_terbit │     └──────────────┘
│ nisn/nip     │     │ stok         │
│ foto         │     │ sinopsis     │     ┌──────────────┐
│ is_banned    │     │ cover        │     │    Loans     │
│ created_at   │     │ category_id  │──→  ├──────────────┤
└──────┬───────┘     │ created_at   │     │ id           │
       │             └──────────────┘     │ user_id      │──→ Users
       │                                  │ book_id      │──→ Books
       └──────────────────────────────────│ status       │
                                          │ borrowed_at  │
┌──────────────┐     ┌──────────────┐     │ returned_at  │
│ AppSettings  │     │ MasterStudent│     └──────────────┘
├──────────────┤     ├──────────────┤
│ key          │     │ nisn         │
│ value        │     │ nama         │
│ created_at   │     │ kelas        │
└──────────────┘     └──────────────┘
```

---

## API Endpoints

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| `GET` | `/api/books/suggest?q={query}` | Live search suggestions untuk buku |
| `GET` | `/api/cek-nisn/{nisn}` | Validasi NISN saat registrasi |

---

## Roadmap

Fitur yang direncanakan untuk rilis mendatang:

- [ ] **Laporan & Analitik** — Export laporan statistik peminjaman, buku populer, dan aktivitas anggota
- [ ] **Sistem Notifikasi** — Notifikasi email & in-app untuk reminder, approval, dan pengumuman
- [ ] **Digital Book Reader** — Kemampuan baca e-book langsung di website
- [ ] **QR Code Integration** — Generate & scan QR code untuk proses pinjam/kembali lebih cepat

---

## Lisensi

Project ini dikembangkan untuk keperluan **SMKN 2 Purwakarta**.
Framework Laravel adalah software open-source berlisensi [MIT License](https://opensource.org/licenses/MIT).
