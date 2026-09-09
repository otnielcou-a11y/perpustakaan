# 02. Installation

## Prasyarat

- PHP >= 8.1
- Composer
- MySQL
- Laragon (disarankan) atau XAMPP/WAMP

## Langkah Instalasi

```bash
# 1. Clone repo
git clone https://github.com/otnielcou-a11y/perpustakaan.git
cd perpustakaan

# 2. Install dependency PHP
composer install

# 3. Buat file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Migrasi database
php artisan migrate

# 6. (Opsional) Seeder data awal
php artisan db:seed

# 7. Jalankan server
php artisan serve
```

## Konfigurasi `.env`

### Database

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan
DB_USERNAME=root
DB_PASSWORD=
```

### Storage Link (untuk cover buku)

```bash
php artisan storage:link
```

### Email / SMTP (untuk fitur reset password OTP)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email-anda@gmail.com
MAIL_PASSWORD=app-password-anda
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=email-anda@gmail.com
MAIL_FROM_NAME="Perpustakaan SMKN 2 Purwakarta"
```

## Jalankan Website

```bash
php artisan serve
```

Akses:
- Website publik: `http://localhost:8000` atau `http://perpustakaan.test` (Laragon)
- Panel admin: `http://localhost:8000/admin/dashboard`

## Verifikasi Instalasi

```bash
php artisan --version    # Laravel 10.x
php artisan route:list   # daftar route (lihat Reference > Routes)
php artisan migrate:status
```

## Lanjutkan

- [Quick Start](03-quick-start.md)
- [Daftar Route](../03-reference/01-routes.md)