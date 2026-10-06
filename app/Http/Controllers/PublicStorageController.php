<?php

namespace App\Http\Controllers;

use App\Support\PublicMedia;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Menyajikan file pada disk "public" (avatar, cover, logo, gambar perpustakaan).
 *
 * Rute ini adalah cadangan untuk shared hosting yang tidak mendukung symlink
 * (mis. InfinityFree). Bila symlink public/storage berhasil dibuat, web server
 * langsung melayani berkas statis sehingga controller ini tidak dipanggil.
 *
 * Path divalidasi lewat App\Support\PublicMedia: hanya folder yang diizinkan,
 * tanpa segment "..", tanpa null byte, dan hasil resolusi path harus tetap di
 * dalam root disk.
 */
class PublicStorageController extends Controller
{
    public function __invoke(string $path): BinaryFileResponse
    {
        $absolute = PublicMedia::path($path);

        abort_if($absolute === null, 404);

        // Nama berkas hasil upload selalu acak (Laravel mengganti nama berkas
        // saat store()), jadi URL lama tidak pernah menunjuk gambar yang
        // isinya berubah. Aman di-cache lama oleh browser dan CDN.
        return response()->file($absolute)->setPublic();
    }
}