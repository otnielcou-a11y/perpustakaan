# SMKN 2 Purwakarta Libraries

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.1%2B-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
</p>

Aplikasi perpustakaan digital untuk **SMKN 2 Purwakarta**.

Website ini menjadi pintu masuk untuk menjelajahi koleksi, mencari buku, dan mengajukan peminjaman secara daring.

---

## Tentang Aplikasi

Portal perpustakaan daring yang dikembangkan untuk literasi siswa dan tenaga pendidik. Fokusnya ada pada tiga hal: katalog yang mudah ditelusuri, proses peminjaman yang ringkas, dan tampilan yang nyaman diakses dari desktop maupun perangkat seluler.

Aplikasi ini menggantikan pencatatan manual yang sebelumnya dilakukan petugas perpustakaan, sehingga data koleksi dan riwayat peminjaman tercatat rapi dan dapat ditelusuri kembali.

---

## Fitur Publik

Halaman di bawah ini dapat diakses siapa saja tanpa perlu masuk.

**Koleksi Buku** — Direktori lengkap koleksi perpustakaan dengan pencarian berdasarkan kata kunci dan filter kategori. Setiap buku dilengkapi cover, sinopsis, serta informasi ketersediaan stok.

**Detail Buku** — Halaman ringkasan untuk setiap judul, mencakup penulis, penerbit, tahun terbit, dan status ketersediaan.

**Beranda** — Menampilkan ringkasan jumlah koleksi dan kategori, beserta buku-buku yang direkomendasikan.

**Tentang dan Profil Perpustakaan** — Visi, misi, serta informasi layanan perpustakaan SMKN 2 Purwakarta.

**Pencarian Instan** — Saran buku muncul saat pengguna mengetik, sehingga pencarian lebih cepat.

**Panduan Penggunaan** — Tombol bantuan tersedia di halaman publik untuk memandu pengunjung baru.

---

## Teknologi

| Komponen | Keterangan |
|----------|------------|
| Framework | Laravel 10 |
| Bahasa | PHP 8.1 atau lebih baru |
| Basis Data | MySQL |
| Tampilan | Blade dengan CSS khusus, tanpa dependensi UI framework |
| Ikon | Font Awesome 6 |
| Huruf | Plus Jakarta Sans |

## Akun & Hak Akses (Seeder)

Daftar lengkap akun default dan kredensial uji coba tersedia pada file [AKUN_KREDENSIAL.md](AKUN_KREDENSIAL.md).

| Peran (Role) | Username / Identitas | Password Default | Akses Utama |
|---|---|---|---|
| **Super Admin** | `superadmin` / `superadmin@smkn2pwk.sch.id` | `superadmin123` | Full System + Manajemen Admin & Hak Akses |
| **Admin** | `admin` / `admin@smkn2pwk.sch.id` | `admin123` | Kelola Koleksi, Anggota, Transaksi & Pengaturan |
| **Guru** | `gurusmkn2` / `guru@smkn2pwk.sch.id` | `guru123` | Katalog & Pengajuan Peminjaman Guru |
| **Siswa** | `aisyah` / `0117148583` | `siswa123` | Dashboard Siswa & Peminjaman Buku |

---

## Menjalankan Secara Lokal

**Kebutuhan sistem**

- PHP 8.1 atau lebih baru
- Composer
- MySQL
- Laragon, XAMPP, atau WAMP

**Langkah pemasangan**

```bash
git clone https://github.com/otnielcou-a11y/perpustakaan.git
cd perpustakaan

composer install

cp .env.example .env
php artisan key:generate
```

Sesuaikan koneksi basis data pada file `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

Siapkan struktur basis data:

```bash
php artisan migrate
php artisan db:seed
```

Jalankan server:

```bash
php artisan serve
```

Aplikasi kemudian dapat dibuka di `http://localhost:8000`. Pada server produksi, sesuaikan nilai `APP_URL` sesuai domain yang digunakan.

---

## Struktur Direktori

```
perpustakaan/
├── app/                 # Logika aplikasi: controller, model, middleware
├── config/              # Konfigurasi Laravel
├── database/            # Migrasi dan data awal (seeder)
├── docs/                # Dokumentasi lengkap (instalasi, guide, referensi)
├── public/              # Aset yang dapat diakses publik
├── resources/views/     # Tampilan Blade
├── routes/              # Definisi rute
├── storage/             # Berkas unggahan, log, dan cache
└── composer.json        # Dependensi PHP
```

> **Catatan struktur deploy** — Beberapa file juga tersedia di root (`index.php`, `.htaccess`, `manifest.json`, favicon, `asset/`) karena website di-hosting memakai *flat folder* InfintyFree di mana root adalah docroot. Saat `php artisan serve` di komputer lokal, `public/` yang menjadi docroot. Kedua salinan dibutuhkan untuk masing-masing mode hosting.

> **Catatan struktur deploy** — Beberapa file juga tersedia di root (`index.php`, `.htaccess`, `manifest.json`, `sw.js`, favicon, `asset/`) karena website di-hosting memakai *flat folder* InfintyFree di mana root adalah docroot. Saat `php artisan serve` di komputer lokal, `public/` yang menjadi docroot. Kedua salinan dibutuhkan untuk masing-masing mode hosting.

> **Wajib sinkron ulang setelah mengubah aset** — karena `asset()` selalu menunjuk docroot yang sedang aktif, setiap perubahan pada `public/asset`, `public/sw.js`, atau `manifest.json` harus disalin ke root. Kalau tidak, muncul 404 atau "Mixed Content" di InfinityFree.
>
> ```powershell
> # Windows (PowerShell)
> Copy-Item public\asset\css\* asset\css\ -Force
> Copy-Item public\asset\js\*  asset\js\  -Force
> Copy-Item public\sw.js sw.js -Force
> Copy-Item manifest.json public\manifest.json -Force
> ```
>
> Salinan root (`sw.js`, `asset/`) ikut di-commit karena dipakai produksi, sedangkan salinan `public/` hanya untuk lokal dan sudah masuk `.gitignore`. Di server, pastikan `APP_URL` memakai `https://` dan `APP_FORCE_HTTPS=true` agar URL `/storage/` tidak memicu "Mixed Content".

Dokumentasi lebih lengkap ada di folder [`docs/`](docs/index.md).

---

## Lisensi

Proyek ini dikembangkan untuk keperluan **SMKN 2 Purwakarta**.

Laravel berada di bawah lisensi open-source [MIT](https://opensource.org/licenses/MIT).
