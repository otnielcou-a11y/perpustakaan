<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors([
                'login' => 'Silakan login sebagai Administrator terlebih dahulu.'
            ]);
        }

        // 2. Cek apakah peran (role) pengguna BENAR-BENAR admin / superadmin
        if (!in_array(Auth::user()->role, ['admin', 'superadmin'])) {
            // Jika akun murid/guru mencoba masuk ke area admin -> tolak & lempar ke Home
            return redirect('/')->with('error', 'Akses Ditolak! Akun Anda tidak memiliki izin untuk mengakses Dashboard Admin.');
        }

        // Jika lolos pengecekan, izinkan masuk
        return $next($request);
    }
}
