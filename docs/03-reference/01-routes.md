# 01. Daftar Route

Semua route didefinisikan di `routes/web.php`.

## Halaman Publik

| Method | URI | Route Name | Controller@Method |
|--------|-----|------------|-------------------|
| GET | `/` | – | Closure (home, data dari DB) |
| GET | `/collections` | `collections` | `BookController@index` |
| GET | `/koleksi-buku` | – | `BookController@index` (alias) |
| GET | `/api/books/suggest` | `books.suggest` | `BookController@suggest` |
| GET | `/buku/{id}` | `buku.detail` | `BookController@show` |
| GET | `/about` | – | Closure (view `about`) |
| GET | `/profile` | – | Closure (view `profile-perpustakaan`) |
| GET | `/api/cek-nisn/{nisn}` | `api.checkNisn` | `AuthController@checkNisn` |

## Pengaturan Akun (wajib login)

| Method | URI | Route Name | Controller@Method |
|--------|-----|------------|-------------------|
| GET | `/pengaturan-akun` | `user.settings` | `UserProfileController@index` |
| POST | `/pengaturan-akun` | `user.settings.update` | `UserProfileController@update` |

## Transaksi Pinjam/Kembali (user)

| Method | URI | Route Name | Controller@Method |
|--------|-----|------------|-------------------|
| POST | `/pinjam/{id}` | `book.borrow` | `LoanController@borrow` |
| POST | `/kembalikan/{id}` | `book.return` | `LoanController@returnBook` |

## Autentikasi

| Method | URI | Route Name | Controller@Method |
|--------|-----|------------|-------------------|
| GET | `/login` | `login` | `AuthController@showLoginForm` |
| POST | `/login` | – | `AuthController@login` |
| GET | `/register` | `register` | `AuthController@showRegisterForm` |
| POST | `/register` | – | `AuthController@register` |
| GET | `/logout` | `logout` | `AuthController@logout` |

## Reset Password OTP (coming soon)

| Method | URI | Route Name | Controller@Method |
|--------|-----|------------|-------------------|
| GET | `/lupa-password` | `forgot.password` | `PasswordResetController@showForgotForm` |
| POST | `/lupa-password/kirim-kode` | `forgot.password.send` | `PasswordResetController@sendOtp` |
| GET | `/verifikasi-kode/{encodedEmail}` | `verify.otp.form` | `PasswordResetController@showVerifyForm` |
| POST | `/verifikasi-kode` | `verify.otp` | `PasswordResetController@verifyOtp` |
| GET | `/reset-password/{encodedEmail}` | `reset.password.form` | `PasswordResetController@showResetForm` |
| POST | `/reset-password` | `reset.password` | `PasswordResetController@resetPassword` |

## Siswa / Guru

| Method | URI | Route Name | Keterangan |
|--------|-----|------------|------------|
| GET | `/siswa/dashboard` | `siswa.dashboard` | Closure; wajib login; memuat loan aktif & riwayat |

## Admin (middleware `auth` + `admin`)

### Dashboard & Anggota

| Method | URI | Route Name | Controller@Method |
|--------|-----|------------|-------------------|
| GET | `/admin/dashboard` | `admin.dashboard` | `AdminDashboardController@index` |
| POST | `/admin/anggota/simpan` | `admin.members.store` | `AdminDashboardController@storeMember` |
| GET | `/admin/data-anggota` | `admin.members` | `MemberController@index` |
| POST | `/admin/data-anggota/save` | `admin.members.save` | `MemberController@store` |
| POST | `/admin/data-anggota/simpan` | – | `MemberController@store` (alias) |
| PUT | `/admin/data-anggota/{id}` | `admin.members.update` | `MemberController@update` |
| PUT | `/admin/data-anggota/{id}/ban` | `admin.members.ban` | `MemberController@ban` |
| PUT | `/admin/data-anggota/{id}/unban` | `admin.members.unban` | `MemberController@unban` |
| GET | `/admin/data-anggota/{id}/history` | `admin.members.history` | `MemberController@history` |
| DELETE | `/admin/data-anggota/{id}` | `admin.members.destroy` | `MemberController@destroy` |

### Buku

| Method | URI | Route Name | Controller@Method |
|--------|-----|------------|-------------------|
| GET | `/admin/data-buku` | `admin.books` | `BookController@adminIndex` |
| POST | `/admin/buku/simpan` | `admin.books.store` | `BookController@store` |
| POST | `/admin/buku/update/{id}` | `admin.books.update` | `BookController@update` |
| DELETE | `/admin/buku/hapus/{id}` | `admin.books.destroy` | `BookController@destroy` |
| POST | `/admin/buku/bulk-delete` | `admin.books.bulkDestroy` | `BookController@bulkDestroy` |

### Transaksi

| Method | URI | Route Name | Controller@Method |
|--------|-----|------------|-------------------|
| GET | `/admin/transaksi` | `admin.transactions` | `TransactionController@index` |
| POST | `/admin/transaksi/setujui-pinjam/{id}` | `admin.transactions.approveBorrow` | `TransactionController@approveBorrow` |
| POST | `/admin/transaksi/tolak-pinjam/{id}` | `admin.transactions.rejectBorrow` | `TransactionController@rejectBorrow` |
| POST | `/admin/transaksi/terima-kembali/{id}` | `admin.transactions.approveReturn` | `TransactionController@approveReturn` |
| POST | `/admin/transaksi/kembalikan/{id}` | `admin.transactions.return` | `TransactionController@returnLoan` (belum ada method) |

> Catatan: route `admin.transactions.return` hanya ada di file route; method `returnLoan` belum didefinisikan di `TransactionController`.

### Kategori

| Method | URI | Route Name | Controller@Method |
|--------|-----|------------|-------------------|
| GET | `/admin/kategori` | `admin.categories` | `CategoryController@index` |
| POST | `/admin/kategori/simpan` | `admin.categories.store` | `CategoryController@store` |
| POST | `/admin/kategori/update/{id}` | `admin.categories.update` | `CategoryController@update` |
| DELETE | `/admin/kategori/hapus/{id}` | `admin.categories.destroy` | `CategoryController@destroy` |
| POST | `/admin/kategori/bulk-delete` | `admin.categories.bulkDestroy` | `CategoryController@bulkDestroy` |

### Lainnya

| Method | URI | Route Name | Controller@Method |
|--------|-----|------------|-------------------|
| GET | `/admin/tentang-website` | – | `AdminDashboardController@tentangWebsite` |
| GET | `/admin/settings` | `admin.settings` | `SettingController@index` |
| POST | `/admin/settings/profile` | `admin.settings.profile` | `SettingController@updateProfile` |
| POST | `/admin/settings/branding` | `admin.settings.branding` | `SettingController@updateBranding` |

### Manajemen Admin (middleware `superadmin`)

| Method | URI | Route Name | Controller@Method |
|--------|-----|------------|-------------------|
| GET | `/admin/tambah-admin` | `admin.index` | `AdminController@index` |
| POST | `/admin/tambah-admin/simpan` | `admin.store` | `AdminController@store` |
| PUT | `/admin/tambah-admin/{id}` | `admin.update` | `AdminController@update` |
| PUT | `/admin/tambah-admin/{id}/downgrade` | `admin.downgrade` | `AdminController@downgrade` |
| DELETE | `/admin/tambah-admin/{id}` | `admin.destroy` | `AdminController@destroy` |

## Lanjutkan

- [Kontroller](02-controllers.md)
- [Database & Model](03-database.md)