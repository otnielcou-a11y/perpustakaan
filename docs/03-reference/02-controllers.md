# 02. Kontroller

Lokasi: `app/Http/Controllers/`. Berikut daftar kontroller beserta tanggung jawabnya.

## Kontroller Aktif (dipakai routes/web.php)

| Kontroller | Fungsi |
|------------|--------|
| `AuthController` | Login (`showLoginForm`, `login`), register (`showRegisterForm`, `register`), logout, dan API cek NISN (`checkNisn`) |
| `BookController` | Koleksi publik (`index`), saran pencarian (`suggest`), detail buku (`show`), serta admin: `adminIndex`, `store`, `update`, `destroy`, `bulkDestroy` |
| `CategoryController` | `index`, `store`, `update`, `destroy`, `bulkDestroy` untuk kategori admin |
| `MemberController` | `index`, `store`, `update`, `ban`, `unban`, `history`, `destroy`, `show` (JSON) |
| `LoanController` | `borrow` (pengajuan pinjam 1–7 hari), `returnBook` (pengajuan kembali) |
| `TransactionController` | `index`, `approveBorrow`, `rejectBorrow`, `approveReturn` |
| `AdminDashboardController` | `index` (dashboard), `storeMember`, `tentangWebsite` |
| `AdminController` | `index`, `store`, `update`, `downgrade`, `destroy` (kelola admin, superadmin) |
| `SettingController` | `index`, `updateProfile`, `updateBranding` |
| `UserProfileController` | `index`, `update` untuk `/pengaturan-akun` |
| `PasswordResetController` | Alur forgot password → OTP → reset (`showForgotForm`, `sendOtp`, `showVerifyForm`, `verifyOtp`, `showResetForm`, `resetPassword`) |

## Kontroller Legacy (Tidak Dipakai Routes)

File berikut masih ada namun **tidak dirujuk** `routes/web.php`:

| Kontroller | Isi | Status |
|------------|-----|--------|
| `LoginController` | Menampilkan view `login`/`registrasi` (gaya lama) | Tidak dipakai — auth memakai `AuthController` |
| `RegistrasiController` | View registrasi gaya lama | Tidak dipakai |
| `DashboardController` | View `admin.dashboard` gaya lama | Tidak dipakai — memakai `AdminDashboardController` |
| `DashboardsiswaController` | View `siswa.dashboard` gaya lama | Tidak dipakai — siswa dashboard via closure route |
| `AnggotaController` | View `admin.inputanggota` | Tidak dipakai — view tersedia, form menunjuk `admin.members.save` |
| `peminjamanController` | View data peminjaman gaya lama | Tidak dipakai |
| `InputdataController` | View input data gaya lama | Tidak dipakai |

## Catatan Penting

- **`admin.transactions.return`**: route `POST /admin/transaksi/kembalikan/{id}` menunjuk `TransactionController@approveReturn` (alias dari `terima-kembali`).
- **`SystemLog`** diisi dengan pola berbeda oleh beberapa kontroller, keduanya valid karena kolom `user_id`, `description`, `action`, `user_name`, `ip_address`, `details` sudah tersedia:
  - `LoanController`/`TransactionController` memakai `action, user_name, ip_address, details`.
  - `MemberController@update` memakai `user_id, description`.

## Lanjutkan

- [Database & Model](03-database.md)
- [Daftar Route](01-routes.md)