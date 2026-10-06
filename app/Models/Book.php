<?php

namespace App\Models;

use App\Support\PublicMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    /**
     * Cover cadangan dari Unsplash dipakai saat cover kosong, file lokal hilang,
     * atau path tidak bisa diresolusi.
     */
    public const FALLBACK_COVER = 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=380&auto=format&fit=crop&q=80';

    protected $table = 'books';

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'year',
        'pages',
        'isbn',
        'category',
        'stock_total',
        'stock_available',
        'description',
        'cover_image'
    ];

    /**
     * Accessor otomatis: $book->cover_url
     *
     * Menangani tiga sumber cover: file lokal hasil upload, URL eksternal, dan
     * gambar bawaan di public/. Semua URL lokal dibangun lewat
     * App\Support\PublicMedia agar mengikuti host + scheme request yang sedang
     * diakses sehingga tidak memicu "Mixed Content".
     */
    public function getCoverUrlAttribute(): string
    {
        $fallback = self::FALLBACK_COVER;

        if (empty($this->cover_image)) {
            return $fallback;
        }

        if (PublicMedia::isExternal($this->cover_image)) {
            $url = $this->cover_image;
            if (Str::contains($url, '://erlangga.co.id')) {
                $url = str_replace('://erlangga.co.id', '://www.erlangga.co.id', $url);
            }
            // URL cover eksternal bisa tersimpan sebagai http:// sehingga memicu
            // "Mixed Content" saat halaman diakses lewat https. URL::forceScheme()
            // tidak ikut menormalkan nilai ini karena accessor mengembalikan
            // string apa adanya, tanpa lewat URL generator.
            return preg_replace('#^http://#i', 'https://', $url);
        }

        $local = PublicMedia::url($this->cover_image);

        if ($local !== null) {
            return $local;
        }

        // Fallback ke gambar bawaan di folder asset publik.
        $assetPath = 'asset/img/books/' . ltrim((string) $this->cover_image, '/');

        if (file_exists(public_path($assetPath))) {
            return asset($assetPath);
        }

        return $fallback;
    }

    /**
     * Mutator: apa pun sumbernya (form admin, seeder, import), URL cover
     * eksternal dinormalkan ke https:// sebelum disimpan agar kolom
     * books.cover_image tidak pernah lagi tersimpan dengan skema http://.
     * Path lokal hasil upload (mis. "covers/abc.jpg") tidak diubah.
     */
    public function setCoverImageAttribute($value)
    {
        $this->attributes['cover_image'] = is_string($value)
            ? preg_replace('#^http://#i', 'https://', $value)
            : $value;
    }
}

