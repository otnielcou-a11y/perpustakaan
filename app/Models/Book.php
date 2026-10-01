<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

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
     * Menggunakan Storage facade agar kompatibel dengan InfinityFree shared hosting.
     */
    public function getCoverUrlAttribute()
    {
        if (empty($this->cover_image)) {
            return 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=380&auto=format&fit=crop&q=80';
        }

        if (Str::startsWith($this->cover_image, ['http://', 'https://'])) {
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

        // Gunakan Storage facade (kompatibel dengan InfinityFree)
        if (Storage::disk('public')->exists($this->cover_image)) {
            return Storage::disk('public')->url($this->cover_image);
        }

        // Fallback ke folder asset lokal
        if (file_exists(public_path('asset/img/books/' . $this->cover_image))) {
            return asset('asset/img/books/' . $this->cover_image);
        }

        return 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=380&auto=format&fit=crop&q=80';
    }
}

