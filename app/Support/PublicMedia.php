<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Sumber tunggal untuk URL dan keberadaan file media publik (avatar, cover,
 * logo, gambar perpustakaan).
 *
 * Semua file upload disimpan pada disk "public" (storage/app/public) dengan
 * nilai kolom berupa path relatif, misalnya "avatars/abc.png". Build URL untuk
 * media harus selalu lewat kelas ini supaya:
 *
 * 1. Tidak ada lagi campuran asset(), url(), dan Storage::url() yang bisa
 *    menghasilkan host/scheme berbeda antar halaman.
 * 2. Path yang tidak aman (null byte, "..", backslash) ditolak sebelum
 *    dipakai, sehingga tidak bisa dipakai membaca file di luar disk.
 * 3. URL eksternal (http/https) diteruskan apa adanya.
 */
class PublicMedia
{
    /**
     * Folder yang boleh diakses publik. Mencegah file lain di dalam disk
     * (mis. berkas sementara) ikut terekspos lewat URL.
     *
     * @var list<string>
     */
    public const ALLOWED_FOLDERS = ['avatars', 'branding', 'covers', 'img'];

    /**
     * Normalisasi nilai media yang berasal dari database.
     *
     * Mengembalikan null bila kosong atau tidak aman dipakai.
     */
    public static function normalize(mixed $value): ?string
    {
        if (! is_string($value)) {
            return null;
        }

        $path = trim(str_replace('\\', '/', $value));

        if ($path === '' || str_contains($path, "\0")) {
            return null;
        }

        $path = preg_replace('#^/+#', '', $path);

        // Buang prefix yang tidak perlu supaya "storage/avatars/x.png" dan
        // "avatars/x.png" tetap menghasilkan URL yang sama.
        if (Str::startsWith($path, 'storage/')) {
            $path = substr($path, strlen('storage/'));
        }

        if ($path === '') {
            return null;
        }

        foreach (explode('/', $path) as $segment) {
            if ($segment === '' || $segment === '.' || $segment === '..') {
                return null;
            }
        }

        return $path;
    }

    /**
     * True bila nilai media berupa URL absolut milik pihak ketiga.
     */
    public static function isExternal(?string $value): bool
    {
        return is_string($value) && Str::startsWith($value, ['http://', 'https://', '//']);
    }

    /**
     * Path absolut file di dalam disk "public", atau null bila tidak ada.
     */
    public static function path(?string $value): ?string
    {
        $path = self::normalize($value);

        if ($path === null || ! self::isAllowedFolder($path)) {
            return null;
        }

        $disk = Storage::disk('public');

        if (! $disk->exists($path)) {
            return null;
        }

        $absolute = $disk->path($path);

        if (! is_file($absolute)) {
            return null;
        }

        // Penjaga terakhir: pastikan path hasil resolusi benar-benar berada di
        // dalam root disk, bukan hasil symlink atau "../" yang lolos filter.
        $root = realpath($disk->path(''));
        $real = realpath($absolute);

        if ($root === false || $real === false || ! str_starts_with($real, $root . DIRECTORY_SEPARATOR)) {
            return null;
        }

        return $real;
    }

    /**
     * True bila media tersedia untuk ditampilkan (file lokal ada, atau URL
     * eksternal yang valid).
     */
    public static function exists(mixed $value): bool
    {
        if (self::isExternal(is_string($value) ? trim($value) : null)) {
            return true;
        }

        return self::path($value) !== null;
    }

    /**
     * URL siap pakai untuk elemen src, atau null bila tidak ada media.
     *
     * Sengaja memakai Storage::url() (bukan asset()/url()) supaya mengikuti
     * override runtime di AppServiceProvider, yaitu host + scheme request yang
     * sedang diakses. Tanpa itu, gambar bisa memicu "Mixed Content" saat situs
     * dibuka lewat HTTPS.
     */
    public static function url(mixed $value): ?string
    {
        if (self::isExternal(is_string($value) ? trim($value) : null)) {
            return trim((string) $value);
        }

        $path = self::normalize($value);

        if ($path === null || ! self::isAllowedFolder($path)) {
            return null;
        }

        if (! Storage::disk('public')->exists($path)) {
            return null;
        }

        return Storage::disk('public')->url($path);
    }

    /**
     * Sama seperti url(), tetapi selalu mengembalikan string agar aman dipakai
     * di atribut Blade. Nilai kosong berarti "tidak ada gambar".
     */
    public static function urlOrEmpty(mixed $value): string
    {
        return self::url($value) ?? '';
    }

    /**
     * Hanya folder dalam ALLOWED_FOLDERS yang boleh dilayani.
     */
    public static function isAllowedFolder(string $path): bool
    {
        $folder = Str::before($path, '/');

        return $folder !== '' && in_array($folder, self::ALLOWED_FOLDERS, true);
    }
}