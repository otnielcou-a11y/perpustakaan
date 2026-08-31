<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Hanya Super Admin yang bisa akses
        if (auth()->user()->role !== 'superadmin') {
            abort(403, 'Akses ditolak! Hanya Super Admin yang diizinkan.');
        }

        return $next($request);
    }
}
