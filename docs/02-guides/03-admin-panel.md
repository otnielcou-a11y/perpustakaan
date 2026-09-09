# 03. Panel Admin

Akses: `/admin/*` — dilindungi middleware `auth` + `admin`. Khusus `superadmin` untuk menu Administrator.

## Struktur Responsif Panel Admin

Panel admin memakai **layout gabungan**:

- Halaman utama (`dashboard`, `data_buku`, `data_anggota`, `transaksi`, `data_kategori`, `settings`, `tambah-admin`, `tentang-website`) memakai CSS inline **standalone pages** dengan drawer sidebar.
- `admin.layout.blade.php` (shell bersama) memakai `public/asset/css/admin.css` + `public/asset/js/admin.js` — dipakai halaman form pendukung (`input_buku`, `editbuku`, `inputanggota`, `data_peminjaman`, `input_datapeminjaman`).

Detail desain sistem: lihat [Desain Responsif](06-responsive-design.md).

## Dashboard (`/admin/dashboard`)

`AdminDashboardController@index` — ringkasan statistik: total buku, kategori, anggota, transaksi terbaru, dan overview aktivitas.

## Book Management (`/admin/data-buku`)

Route utama `admin.books` — `BookController@adminIndex`.

- Tabel buku dengan pencarian (`?search=`) dan filter kategori (`?category=`).
- Tambah buku: modal → `POST /admin/buku/simpan` (route `admin.books.store`).
- Edit buku: modal → `POST /admin/buku/update/{id}` (route `admin.books.update`).
- Hapus 1 buku: `DELETE /admin/buku/hapus/{id}` (route `admin.books.destroy`).
- Hapus massal: `POST /admin/buku/bulk-delete` (route `admin.books.bulkDestroy`).

Field buku yang divalidasi: `title`, `author`, `publisher`, `year`, `isbn` (unik), `category`, `stock_total` (min 1), `cover_image` (file jpeg/png/jpg/webp max 2MB), `cover_url_input` (url), `description`.

## Member Management (`/admin/data-anggota`)

`MemberController@index` (route `admin.members`).

- Tabel anggota dengan pencarian (`?search=`), filter role (`?role=`), pagination 10.
- Tambah anggota: modal → `POST /admin/data-anggota/save` (route `admin.members.save`; ada alias `/admin/anggota/simpan` → `admin.members.store`).
- Edit anggota: `PUT /admin/data-anggota/{id}` (route `admin.members.update`).
- Ban/unban: `PUT .../ban` & `PUT .../unban` (anggota ber status `banned` tak bisa meminjam).
- Riwayat pinjam: `GET /admin/data-anggota/{id}/history` (route `admin.members.history`, JSON).
- Hapus: `DELETE /admin/data-anggota/{id}` (route `admin.members.destroy`; admin tidak bisa dihapus/di-ban).
- `MemberController@show` — JSON detail anggota untuk AJAX.

## Category Management (`/admin/kategori`)

`CategoryController@index` (route `admin.categories`).

- Tambah/ubah/hapus kategori, tanpa `slug` manual.
- Bulk delete.

## Administrator Management (`/admin/tambah-admin`)

Khusus `superadmin` (middleware `superadmin`).

- Tambah admin: `POST /admin/tambah-admin/simpan` (route `admin.store`).
- Edit / downgrade / hapus akun administrator.

## Settings (`/admin/settings`)

`SettingController@index` (route `admin.settings`).

- Profil admin: `POST /admin/settings/profile` (route `admin.settings.profile`).
- Branding perpustakaan: `POST /admin/settings/branding` (route `admin.settings.branding`) — nama, deskripsi, logo.

## About Website (`/admin/tentang-website`)

Dokumentasi lengkap website, informasi sistem/versi/tech stack di sisi admin.

## Halaman Pendukung (View Saja, Belum Ada Route)

File berikut tetap tersedia sebagai view dan memakai `admin.layout`, menunjuk ke route sungguhan yang sudah ada:

| View | Fungsi |
|------|--------|
| `admin.input_buku` | Form tambah buku → `admin.books.store` |
| `admin.editbuku` | Form edit buku → `admin.books.update` (mentoleransi `$buku` kosong) |
| `admin.inputanggota` | Form tambah anggota → `admin.members.save` |
| `admin.data_peminjaman` | Tabel data peminjaman → link ke `admin.transactions` |
| `admin.input_datapeminjaman` | Panduan alur peminjaman → link ke `admin.transactions` |

## Lanjutkan

- [Alur Transaksi](05-transactions.md)
- [Desain Responsif](06-responsive-design.md)