# 03. Database & Model

Lokasi: `database/migrations/` dan `app/Models/`.

## Tabel & Kolom

### `users`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | bigint PK | |
| `name` | string | Nama lengkap |
| `username` | string unik, nullable | Login via username atau email |
| `email` | string, nullable | Dibuat nullable (migrasi `make_email_nullable_in_users_table`) |
| `password` | string | Hash Bcrypt |
| `role` | string | `murid`, `guru`, `admin`, `superadmin` |
| `nomor_induk` | string, nullable | NIS/NIP |
| `avatar` | string, nullable | Path foto profil |
| `status` | string | `active` / `banned` |
| `timestamps` | | |

Model `User` — fillable: `name, username, email, password, role, nomor_induk, avatar, status`. Relasi: `hasMany(Loan)`.

### `books`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | bigint PK | |
| `title` | string | Judul |
| `author` | string | Penulis |
| `publisher` | string | Default `SMKN 2 Press` |
| `year` | year | Default 2024 |
| `pages` | integer | Default 250 |
| `isbn` | string unik | |
| `category` | string | Nama kategori (bukan FK) |
| `stock_total` | integer | Default 10 |
| `stock_available` | integer | Default 10, dikurangi/ditambah saat transaksi |
| `description` | text, nullable | |
| `cover_image` | string, nullable | Path/URL cover |
| `timestamps` | | |

Model `Book` — accessor `cover_url` otomatis: prioritas upload lokal → `asset/img/books/` → fallback Unsplash. Fix khusus: URL `erlangga.co.id` dialihkan ke `www.erlangga.co.id`.

### `categories`

Kolom: `id`, `name` (unik), `slug` (unik), `icon` (default `fa-book`), timestamps.

Model `Category` — relasi `hasMany(Book)` memakai kolom `books.category` = `categories.name`.

### `loans`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | bigint PK | |
| `user_id` | FK → users | cascade |
| `book_id` | FK → books | cascade |
| `status` | enum | `borrowed`, `returned`, `overdue` (migrasi tambahan memperluas set status) |
| `duration` | integer | Ditambahkan migrasi `add_duration_to_loans_table` |
| `loan_date` | date | |
| `due_date` | date | |
| `return_date` | date, nullable | |
| `timestamps` | | |

Status penuh yang dipakai alur: `pending_borrow`, `borrowed`, `pending_return`, `returned`, `rejected`, `overdue` (dihitung dinamis). Model `Loan` — fillable: `user_id, book_id, duration, status, loan_date, due_date, return_date`; relasi `belongsTo(User)` dan `belongsTo(Book)`.

### `master_students`

Kolom: `id`, `nisn`, `name`, `class`, `gender`, `exp`, timestamps.
Model `MasterStudent` — sumber data validasi NISN saat register.

### `app_settings`

Kolom: `id`, `key` (unik), `value`, timestamps.
Model `AppSetting` — helper statis `getVal($key, $default)` untuk membaca branding.

### `system_logs`

Kolom (model): `id`, `action`, `user_name`, `ip_address`, `details`, timestamps.
> Catatan: `MemberController@update` menulis `user_id` & `description` — kolom tersebut tidak ada di model. Perlu diselaraskan.

### `password_reset_tokens`

Tabel Laravel standar + kolom OTP (`add_otp_to_password_reset_tokens_table`): `otp_code`, `otp_expires_at`, `otp_verified`.

## Relasi Ringkas

```
Users 1──N Loans N──1 Books   (books.category = categories.name)
Categories 1──N Books (via name)
```

## Migrasi Terkait

| File | Efek |
|------|------|
| `2026_08_20_010711_add_role_and_details_to_users_table` | Tambah `role`, `username`, `nomor_induk` |
| `2026_08_20_062833_add_avatar_to_users_table` | Tambah `avatar` |
| `2026_08_24_060046_make_email_nullable_in_users_table` | `email` jadi nullable |
| `2026_08_24_040231_update_status_column_in_loans_table` | Perluas status loan |
| `2026_08_24_041411_add_duration_to_loans_table` | Tambah `duration` |
| `2026_08_31_025105_add_status_to_users_table` | Tambah `status` active/banned |
| `2026_09_01_012742_add_otp_to_password_reset_tokens_table` | Kolom OTP |

## Lanjutkan

- [API Endpoints](04-api.md)
- [Alur Transaksi](../02-guides/05-transactions.md)