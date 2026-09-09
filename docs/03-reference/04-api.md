# 04. API Endpoints

Endpoint JSON yang tersedia (selain form HTML biasa).

## `GET /api/books/suggest?q={query}`

Route `books.suggest` — `BookController@suggest`. Live search untuk koleksi.

| Parameter | Tipe | Wajib | Keterangan |
|-----------|------|:-----:|------------|
| `q` | string | Ya | Min 2 karakter |

Respons `200` (array):

```json
[
  {
    "id": 12,
    "title": "Akuntansi Dasar",
    "author": "Rudianto",
    "category": "Akuntansi",
    "cover_url": "https://...",
    "stock_available": 4,
    "url": "http://localhost:8000/buku/12"
  }
]
```

Jika `q` kurang dari 2 karakter → `[]`.

## `GET /api/cek-nisn/{nisn}`

Route `api.checkNisn` — `AuthController@checkNisn`. Validasi NISN saat registrasi siswa.

| Parameter | Tipe | Wajib | Keterangan |
|-----------|------|:-----:|------------|
| `{nisn}` | string | Ya | Nomor induk siswa nasional |

Respons jika NISN ditemukan di tabel `master_students`:

```json
{ "found": true, "name": "Nama Siswa", "class": "XII AKL 1" }
```

Jika tidak ditemukan:

```json
{ "found": false }
```

Endpoint dipakai untuk auto-fill nama & kelas dan memvalidasi keanggotaan siswa saat registrasi.

## Catatan

- Endpoint lain (`admin.members.history`, `MemberController@show`) juga mengembalikan JSON, tetapi ditujukan untuk konsumsi internal halaman admin (AJAX modal histori/aktivitas).

## Lanjutkan

- [Daftar Route](01-routes.md)
- [Troubleshooting](05-troubleshooting.md)