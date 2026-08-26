<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
     */
    public function getCoverUrlAttribute()
    {
        if (empty($this->cover_image)) {
            return 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500&auto=format&fit=crop&q=80';
        }

        if (Str::startsWith($this->cover_image, ['http://', 'https://'])) {
            return $this->cover_image;
        }

        if (file_exists(public_path('storage/' . $this->cover_image))) {
            return asset('storage/' . $this->cover_image);
        }

        if (file_exists(public_path('asset/img/books/' . $this->cover_image))) {
            return asset('asset/img/books/' . $this->cover_image);
        }

        return 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500&auto=format&fit=crop&q=80';
    }
}
