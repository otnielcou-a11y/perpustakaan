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

## Kontroller Legacy (Telah Dirapikan & Dihapus)

File kontroller legacy yang sudah tidak terpakai (`LoginController`, `RegistrasiController`, `DashboardController`, `DashboardsiswaController`, `AnggotaController`, `peminjamanController`, `InputdataController`) **telah dirapikan dan dihapus** agar tidak menimbulkan kebingungan, bentrok kode, atau pemborosan resource. Seluruh fungsi autentikasi, manajemen anggota, dan transaksi kini terpusat secara rapi pada Kontroller Utama di atas.

## Catatan Penting

- **`admin.transactions.return`**: route `POST /admin/transaksi/kembalikan/{id}` menunjuk `TransactionController@approveReturn` (alias dari `terima-kembali`).
- **`SystemLog`** diisi dengan pola berbeda oleh beberapa kontroller, keduanya valid karena kolom `user_id`, `description`, `action`, `user_name`, `ip_address`, `details` sudah tersedia:
  - `LoanController`/`TransactionController` memakai `action, user_name, ip_address, details`.
  - `MemberController@update` memakai `user_id, description`.

## Lanjutkan

- [Database & Model](03-database.md)
- [Daftar Route](01-routes.md)