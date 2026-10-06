<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Pembantu untuk menyimpan berkas upload ke disk "public" dan menghapus berkas
 * lamanya.
 *
 * Dipakai oleh UserProfileController (avatar siswa/guru) dan SettingController
 * (avatar admin + logo sekolah) supaya keduanya memakai aturan yang sama:
 *
 * - URL eksternal tidak pernah ikut dihapus dari disk.
 * - Path dinormalkan lebih dulu, sehingga "../../" tidak bisa dipakai untuk
 *   menghapus berkas di luar disk.
 * - Kegagalan simpan melempar exception, bukan diam-diam menulis string kosong
 *   ke kolom avatar (disk "public" dikonfigurasi throw=false).
 */
trait ReplacesMediaFiles
{
    /**
     * Simpan $file ke folder $folder pada disk "public", lalu hapus $oldPath.
     *
     * @throws \RuntimeException bila penyimpanan gagal.
     */
    protected function storeMediaFile(UploadedFile $file, string $folder, ?string $oldPath = null): string
    {
        $stored = $file->store($folder, 'public');

        if (! is_string($stored) || $stored === '') {
            throw new \RuntimeException("Gagal menyimpan berkas ke folder \"{$folder}\" pada disk public.");
        }

        $this->deleteMediaFile($oldPath);

        return $stored;
    }

    /**
     * Hapus berkas media lama. Diam-diam diabaikan bila path kosong, berupa
     * URL eksternal, atau berkasnya memang sudah tidak ada.
     */
    protected function deleteMediaFile(?string $path): void
    {
        if (PublicMedia::isExternal($path)) {
            return;
        }

        $normalized = PublicMedia::normalize($path);

        if ($normalized === null) {
            return;
        }

        try {
            $disk = Storage::disk('public');

            if ($disk->exists($normalized)) {
                $disk->delete($normalized);
            }
        } catch (\Throwable $e) {
            // Berkas lama yang gagal dihapus tidak boleh membatalkan upload baru.
        }
    }
}