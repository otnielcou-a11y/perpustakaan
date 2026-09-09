# 05. Alur Transaksi Peminjaman

Alur peminjaman melibatkan 2 sisi: **siswa/guru** (mengajukan) dan **admin** (menyetujui/memverifikasi).

## Status Loan

| Status | Arti |
|--------|------|
| `pending_borrow` | Pengajuan pinjam oleh anggota, menunggu admin |
| `borrowed` | Disetujui, buku sedang dipinjam |
| `pending_return` | Anggota mengajukan pengembalian, menunggu verifikasi admin |
| `returned` | Sudah dikembalikan (diverifikasi) |
| `rejected` | Pengajuan pinjam ditolak admin |
| `overdue` | Perhitungan transaksi yang lewat tenggat (di-hitung dinamis) |

## 1. Anggota Mengajukan Pinjam

Route: `POST /pinjam/{bookId}` (route `book.borrow`) — `LoanController@borrow`.

- Wajib login (lain: redirect ke `login`).
- Validasi `duration` 1–7 hari.
- Cek stok (`stock_available` >= 1) — ditolak bila kosong.
- Cek duplikat: user sudah punya loan `pending_borrow`/`borrowed`/`pending_return` untuk buku sama.
- Membuat loan `pending_borrow` dengan `loan_date` = hari ini dan `due_date` = hari ini + durasi.
- Mencatat `system_logs` (action `Borrow Request`).

## 2. Admin Menyetujui / Menolak

Halaman: `/admin/transaksi` (route `admin.transactions`) — `TransactionController@index`.

- Filter status (`?status=`) + pencarian (`?search=` untuk nama anggota/nomor induk/judul/isbn), pagination 10.
- Statistik: total, pending borrow, pending return, borrowed, returned, overdue.

Setujui: `POST /admin/transaksi/setujui-pinjam/{id}` (route `admin.transactions.approveBorrow`).

- Wajib status `pending_borrow` dan stok tersedia.
- Ubah status → `borrowed`, atur `loan_date` = hari ini, `due_date` = hari ini + durasi.
- `stock_available` buku dikurangi 1.

Tolak: `POST /admin/transaksi/tolak-pinjam/{id}` (route `admin.transactions.rejectBorrow`).

- Ubah status → `rejected`.

## 3. Anggota Mengajukan Pengembalian

Route: `POST /kembalikan/{bookId}` (route `book.return`) — `LoanController@returnBook`.

- Mengubah loan `borrowed` → `pending_return`.
- Mencatat log `Return Request`.

## 4. Admin Menerima & Memverifikasi

`POST /admin/transaksi/terima-kembali/{id}` (route `admin.transactions.approveReturn`).

- Berlaku untuk status `pending_return` atau `borrowed`.
- Ubah status → `returned`, isi `return_date` = hari ini.
- `stock_available` buku ditambah 1.

## Catatan Overdue

Kolom enum `loans.status` berisi `borrowed/returned/overdue`, namun proses "overdue" dihitung dinamis: loan berstatus `borrowed` dengan `due_date < hari ini` dianggap terlambat (lihat transaksi & riwayat anggota). Tidak ada proses mark otomatis ke `overdue`.

## Lanjutkan

- [Panel Admin](03-admin-panel.md)
- [Database & Model](../03-reference/03-database.md)