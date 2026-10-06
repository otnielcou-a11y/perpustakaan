<?php

namespace App\Models;

use App\Support\PublicMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'nomor_induk',
        'avatar',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Accessor otomatis: $user->avatar_url
     *
     * Mengembalikan null ketika tidak ada avatar yang bisa ditampilkan, yaitu
     * kolom kosong, file lokal yang hilang di disk, atau path yang tidak aman.
     * View cukup menulis @if($user->avatar_url) tanpa perlu cek ulang ke disk,
     * sehingga avatar rusak tidak pernah tampil sebagai gambar broken.
     */
    public function getAvatarUrlAttribute(): ?string
    {
        return PublicMedia::url($this->avatar);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class, 'user_id');
    }
}
