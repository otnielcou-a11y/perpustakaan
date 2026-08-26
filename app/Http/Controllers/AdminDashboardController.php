<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Loan;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Statistik Real-Time Database
        $totalBooks = class_exists(Book::class) ? (Book::sum('stock_total') ?? 0) : 0;
        $activeMembers = User::whereIn('role', ['murid', 'guru'])->count();

        $booksLoaned = class_exists(Loan::class) ? Loan::where('status', 'borrowed')->count() : 0;
        $overdueReturns = class_exists(Loan::class) ? Loan::where('status', 'borrowed')->where('due_date', '<', now()->toDateString())->count() : 0;

        // 2. Data Kategori, Transaksi Terbaru, & Log
        $categories = class_exists(Category::class) ? Category::withCount('books')->get() : collect();
        $recentTransactions = class_exists(Loan::class) ? Loan::with(['user', 'book'])->latest()->take(5)->get() : collect();
        $systemLogs = class_exists(SystemLog::class) ? SystemLog::latest()->take(10)->get() : collect();

        return view('admin.dashboard', compact(
            'totalBooks',
            'activeMembers',
            'booksLoaned',
            'overdueReturns',
            'categories',
            'recentTransactions',
            'systemLogs'
        ));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => 'fa-book',
        ]);

        SystemLog::create([
            'action' => 'Category Created',
            'user_name' => auth()->user()->name ?? 'Admin',
            'ip_address' => $request->ip(),
            'details' => 'Menambahkan kategori: ' . $request->name,
        ]);

        return back()->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function storeMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'nomor_induk' => 'required|string|max:50',
            'role' => 'required|in:murid,guru',
            'password' => 'required|min:4',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'nomor_induk' => $request->nomor_induk,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        SystemLog::create([
            'action' => 'Member Registered',
            'user_name' => auth()->user()->name ?? 'Admin',
            'ip_address' => $request->ip(),
            'details' => 'Mendaftarkan anggota baru: ' . $request->name,
        ]);

        return back()->with('success', 'Anggota baru berhasil didaftarkan!');
    }
}
