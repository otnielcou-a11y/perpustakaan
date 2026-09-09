# 02. Koleksi Buku (Halaman Publik)

Halaman-halaman yang bisa diakses semua pengunjung tanpa login.

## Home (`/`)

Landing page utama:

- Statistik riil dari database (total buku, kategori, anggota).
- Buku rekomendasi acak (10 buku via `Book::inRandomOrder()`).
- Daftar kategori dari database.
- Navigasi ke seluruh fitur website.

## Koleksi (`/collections`)

Route: `GET /collections` (nama `collections`) — `BookController@index`.

Fitur:

- Pencarian berdasarkan judul, penulis, penerbit, atau ISBN (`?search=`).
- Filter kategori (`?category=`).
- Sorting (`?sort=title_asc`, `title_desc`, `popular`/`stock_desc`).
- Pagination 12 buku per halaman (dengan `withQueryString()`).
- Ada alias URL: `/koleksi-buku`.

## Detail Buku (`/buku/{id}`)

Route: `GET /buku/{id}` (nama `buku.detail`) — `BookController@show`.

- Metadata lengkap buku + cover (sumber: upload lokal, URL, atau fallback).
- Informasi stok tersedia.
- Tombol **Pinjam** untuk user yang sudah login (lihat Alur Transaksi).
- 4 buku terkait dari kategori yang sama (dilengkapi buku lain bila kurang).

## Live Search (`/api/books/suggest`)

Route: `GET /api/books/suggest?q={query}` (nama `books.suggest`).

- Butuh minimal 2 karakter.
- Mengembalikan JSON maksimal 5 buku (id, title, author, category, cover_url, stock_available, url).

Contoh respons:

```json
[
  {
    "id": 1,
    "title": "Akuntansi Dasar",
    "author": "Rudianto",
    "category": "Akuntansi",
    "cover_url": "https://...",
    "stock_available": 4,
    "url": "http://localhost:8000/buku/1"
  }
]
```

## Halaman Lain

| URL | Isi |
|-----|-----|
| `/about` | Tentang / visi misi perpustakaan |
| `/profile` | Profil perpustakaan, kontak, layanan per program keahlian |

## Lanjutkan

- [Panel Admin](03-admin-panel.md)
- [API Endpoints](../03-reference/04-api.md)