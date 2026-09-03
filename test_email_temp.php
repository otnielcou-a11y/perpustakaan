<?php

require __DIR__.'/../../../../../../../laragon/www/perpustakaan/vendor/autoload.php';
$app = require_once __DIR__.'/../../../../../../../laragon/www/perpustakaan/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

try {
    Mail::raw('Test email dari Perpustakaan SMKN 2 Purwakarta. Jika menerima ini berarti konfigurasi email berhasil!', function ($m) {
        $m->to('otnielcou@gmail.com')->subject('Test Email - Perpustakaan SMKN 2 Purwakarta');
    });
    echo "OK Email berhasil dikirim!\n";
} catch (\Exception $e) {
    echo "GAGAL: " . $e->getMessage() . "\n";
}
