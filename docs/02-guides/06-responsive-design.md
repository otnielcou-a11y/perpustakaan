# 06. Desain Responsif

Seluruh halaman website (publik, siswa, dan admin) responsif. Bagian ini mendokumentasikan sistem desain admin.

## Design Tokens (`public/asset/css/admin.css`)

| Token | Nilai |
|-------|-------|
| `--primary` | `#0c4d2d` (hijau tua) |
| `--primary-dark` | `#07351e` |
| `--accent-yellow` | `#facc15` (kuning) |
| `--bg-app` | `#f8fafc` |
| `--sidebar-bg` | `#f8fafc` |
| `--text-main` | `#0f172a` |
| `--text-muted` | `#64748b` |
| `--border` | `#e2e8f0` |
| `--white` | `#ffffff` |

Font: **Plus Jakarta Sans**. Ikon: **Font Awesome 6**. Layout flex full-height pada `body`.

## Komponen Layout

| Kelas | Fungsi |
|-------|--------|
| `.sidebar` | Sidebar tetap 260px kiri, tinggi penuh, scroll internal |
| `.sidebar-brand`, `.nav-item` | Brand + menu navigasi (`.active` = kuning) |
| `.main-wrapper` | Area konten, margin kiri 260px |
| `.top-header` | Bar atas sticky (70px): tombol hamburger + kiri, profil kanan |
| `.content-body` | Padding konten 32px 36px → mengecil di layar kecil |
| `.page-header` / `.page-title` / `.page-buttons` | Judul halaman + tombol aksi |
| `.panel-card` / `.panel-header` / `.panel-body` | Kartu konten |
| `.custom-table` + `.table-responsive` | Tabel dengan scroll horizontal (min-width 620px) |
| `.form-row` | Grid form 2 kolom (collapse 1 kolom di <640px) |
| `.modal-backdrop` / `.modal-box` | Modal custom (via `admin.js`) |
| `.alert-success` / `.alert-error` | Flash message dari session |
| `.badge-status` + `.status-*` | Status pinjam (aktif, selesai, telat, dll.) |

## Breakpoint

| Breakpoint | Perilaku |
|------------|----------|
| `max-width: 992px` | Sidebar berubah jadi **drawer** (translateX(-100%) → 0), muncul backdrop + tombol tutup; `main-wrapper` margin 0; hamburger tampil; `.page-buttons` tombol lebar penuh |
| `max-width: 640px` | `.form-row` jadi 1 kolom; padding mengecil; teks brand pada tombol disembunyikan (`.hide-mobile-text`) |

## JavaScript (`public/asset/js/admin.js`)

Dimuat di `admin.layout.blade.php`:

- **Drawer**: toggle `#sidebarToggle`, tutup `#sidebarClose`, tutup saat klik backdrop, auto-tutup setelah memilih menu di HP.
- **Modal**: `window.openModal(id)` / `window.closeModal(id)`, tutup via backdrop/klik langsung/Esc.
- **Dropdown**: membuka menu dropdown di layar sentuh (`.admin-dropdown-wrapper`).
- **Global search**: `Enter` di `#globalSearch` → `/admin/data-buku?search=...`.

## Halaman Publik

- Semua halaman publik memakai partial `public_navbar.blade.php` yang berisi hamburger + media query navbar.
- Konten dibatasi `.custom-container` (max-width 1200px, padding `0 20px`) sehingga tidak menempel tepi layar.
- Halaman auth (`login`, `register`, `forgot-password`, `verify-otp`, `reset-password`) memakai kartu `.auth-card` dengan media query untuk layar HP.

## Lanjutkan

- [Panel Admin](03-admin-panel.md)
- [Troubleshooting](../03-reference/05-troubleshooting.md)