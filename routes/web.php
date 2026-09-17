<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\TransactionController;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\UserProfileController;
// PasswordResetController di-import inline di dalam file (sudah dilakukan di bawah)


// ================= HALAMAN PUBLIK (HOME LANDING DENGAN BUKU ACAK) =================
Route::get('/', function () {
    // 1. Buku Rekomendasi Acak dari DB
    $recommendedBooks = Book::inRandomOrder()->take(10)->get();

    // 2. Kategori Asli dari DB
    $categories = Category::orderBy('name', 'asc')->get();

    // 3. Jumlah Riil dari Database
    $totalBooksCount = Book::count(); // Menghitung total judul buku di DB (e.g. 37)
    $totalCategoriesCount = Category::count(); // Menghitung total kategori di DB (e.g. 9)
    $totalMembersCount = User::whereIn('role', ['murid', 'guru'])->count(); // Menghitung siswa/guru terdaftar (e.g. 3)

    return view('home', compact(
        'recommendedBooks',
        'categories',
        'totalBooksCount',
        'totalCategoriesCount',
        'totalMembersCount'
    ));
});

Route::get('/collections', [BookController::class, 'index'])->name('collections');
Route::get('/koleksi-buku', [BookController::class, 'index']);
Route::get('/api/books/suggest', [BookController::class, 'suggest'])->name('books.suggest');
Route::get('/buku/{id}', [BookController::class, 'show'])->name('buku.detail');
Route::get('/about', function () {
    $categories = Category::orderBy('name', 'asc')->get();
    return view('about', compact('categories'));
});
Route::get('/profile', function () {
    $categories = Category::orderBy('name', 'asc')->get();
    return view('profile-perpustakaan', compact('categories'));
});

// ================= SITEMAP (SITEMAP.DIRNAME) =================
Route::get('/sitemap.xml', function () {
    $urls = [
        '/',
        '/collections',
        '/about',
        '/profile',
    ];
    $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($urls as $url) {
        $content .= '  <url><loc>' . url($url) . '</loc><changefreq>weekly</changefreq><priority>0.8</priority></url>' . "\n";
    }
    $content .= '</urlset>';
    return response($content, 200)->header('Content-Type', 'application/xml');
});

// RUTE PENGATURAN AKUN (BISA DIAKSES SISWA, GURU, MAUPUN ADMIN)
Route::middleware(['auth'])->group(function () {
    Route::get('/pengaturan-akun', [UserProfileController::class, 'index'])->name('user.settings');
    Route::post('/pengaturan-akun', [UserProfileController::class, 'update'])->name('user.settings.update');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
});


// ================= TRANSAKSI PINJAM & KEMBALIKAN (USER) =================
Route::post('/pinjam/{id}', [LoanController::class, 'borrow'])->name('book.borrow');
Route::post('/kembalikan/{id}', [LoanController::class, 'returnBook'])->name('book.return');

// ================= AUTH =================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');

// ================= RESET PASSWORD DENGAN OTP (PasswordResetController) =================
use App\Http\Controllers\PasswordResetController;

// 1. Halaman "Lupa Password"
Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])
    ->name('forgot.password')
    ->middleware('guest');

Route::get('/lupa-password', [PasswordResetController::class, 'showForgotForm'])
    ->name('password.request')
    ->middleware('guest');

// 2. Kirim OTP ke Email
Route::post('/forgot-password', [PasswordResetController::class, 'sendOtp'])
    ->name('password.email')
    ->middleware('guest');

// 3. Halaman Input Kode OTP
Route::get('/verify-otp/{encodedEmail}', [PasswordResetController::class, 'showVerifyForm'])
    ->name('verify.otp.form')
    ->middleware('guest');

// 4. Verifikasi Kode OTP
Route::post('/verify-otp', [PasswordResetController::class, 'verifyOtp'])
    ->name('verify.otp')
    ->middleware('guest');

Route::post('/verify-otp-submit', [PasswordResetController::class, 'verifyOtp'])
    ->name('verify.otp.submit')
    ->middleware('guest');

// 5. Halaman Form Password Baru
Route::get('/reset-password/{encodedEmail}', [PasswordResetController::class, 'showResetForm'])
    ->name('reset.password.form')
    ->middleware('guest');

// 6. Simpan Password Baru
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
    ->name('reset.password')
    ->middleware('guest');

Route::post('/reset-password-update', [PasswordResetController::class, 'resetPassword'])
    ->name('password.update')
    ->middleware('guest');

// Alias lama (agar kompatibel jika ada link lama)
Route::get('/verify-otp', function () {
    return redirect()->route('forgot.password');
})->name('password.verify.form');


// Route API Cek NISN Otomatis saat Siswa Mendaftar
Route::get('/api/cek-nisn/{nisn}', [AuthController::class, 'checkNisn'])->name('api.checkNisn');

// ================= SISWA / GURU =================
Route::prefix('siswa')->group(function () {
    Route::get('/dashboard', function () {
        if (!auth()->check()) return redirect()->route('login');

        $user = auth()->user();
        $activeLoans = \App\Models\Loan::with('book')->where('user_id', $user->id)->where('status', 'borrowed')->latest()->get();
        $returnedLoans = \App\Models\Loan::with('book')->where('user_id', $user->id)->where('status', 'returned')->latest()->take(5)->get();

        return view('siswa.dashboard', compact('user', 'activeLoans', 'returnedLoans'));
    })->name('siswa.dashboard');
});

// ================= HALAMAN ADMIN (DILINDUNGI PENUH) =================
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/anggota/simpan', [AdminDashboardController::class, 'storeMember'])->name('admin.members.store');

    // Data Anggota
    Route::get('/data-anggota', [MemberController::class, 'index'])->name('admin.members');
    Route::post('/data-anggota/save', [MemberController::class, 'store'])->name('admin.members.save');
    Route::post('/data-anggota/simpan', [MemberController::class, 'store']);
    Route::put('/data-anggota/{id}', [MemberController::class, 'update'])->name('admin.members.update');
    Route::put('/data-anggota/{id}/ban', [MemberController::class, 'ban'])->name('admin.members.ban');
    Route::put('/data-anggota/{id}/unban', [MemberController::class, 'unban'])->name('admin.members.unban');
    Route::get('/data-anggota/{id}/history', [MemberController::class, 'history'])->name('admin.members.history');
    Route::delete('/data-anggota/{id}', [MemberController::class, 'destroy'])->name('admin.members.destroy');

    // Data Buku
    Route::get('/data-buku', [BookController::class, 'adminIndex'])->name('admin.books');
    Route::post('/buku/simpan', [BookController::class, 'store'])->name('admin.books.store');
    Route::post('/buku/update/{id}', [BookController::class, 'update'])->name('admin.books.update');
    Route::delete('/buku/hapus/{id}', [BookController::class, 'destroy'])->name('admin.books.destroy');
    Route::post('/buku/bulk-delete', [BookController::class, 'bulkDestroy'])->name('admin.books.bulkDestroy');

    // MENU TRANSAKSI & PERSETUJUAN ADMIN
    Route::get('/transaksi', [TransactionController::class, 'index'])->name('admin.transactions');
    Route::post('/transaksi/setujui-pinjam/{id}', [TransactionController::class, 'approveBorrow'])->name('admin.transactions.approveBorrow');
    Route::post('/transaksi/tolak-pinjam/{id}', [TransactionController::class, 'rejectBorrow'])->name('admin.transactions.rejectBorrow');
    Route::post('/transaksi/terima-kembali/{id}', [TransactionController::class, 'approveReturn'])->name('admin.transactions.approveReturn');
    Route::post('/transaksi/kembalikan/{id}', [TransactionController::class, 'approveReturn'])->name('admin.transactions.return');

    // Kategori
    Route::get('/kategori', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('/kategori/simpan', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::post('/kategori/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/kategori/hapus/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::post('/kategori/bulk-delete', [CategoryController::class, 'bulkDestroy'])->name('admin.categories.bulkDestroy');

    // Tentang Website & Settings
    Route::get('/tentang-website', [AdminDashboardController::class, 'tentangWebsite']);
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::post('/settings/profile', [SettingController::class, 'updateProfile'])->name('admin.settings.profile');
    Route::post('/settings/branding', [SettingController::class, 'updateBranding'])->name('admin.settings.branding');

    // Manajemen Admin (Khusus Super Admin)
    Route::middleware(['superadmin'])->group(function () {
        Route::get('/tambah-admin', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/tambah-admin/simpan', [AdminController::class, 'store'])->name('admin.store');
        Route::put('/tambah-admin/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::put('/tambah-admin/{id}/downgrade', [AdminController::class, 'downgrade'])->name('admin.downgrade');
        Route::delete('/tambah-admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    });
});
