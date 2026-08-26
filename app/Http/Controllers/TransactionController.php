<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\SystemLog;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // 1. Tampilkan Halaman Transaksi Admin
    public function index(Request $request)
    {
        $query = Loan::with(['user', 'book'])->latest();

        // Filter Status
        if ($request->filled('status')) {
            if ($request->status == 'overdue') {
                $query->where('status', 'borrowed')->where('due_date', '<', now()->toDateString());
            } else {
                $query->where('status', $request->status);
            }
        }

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($u) use ($search) {
                    $u->where('name', 'like', "%{$search}%")
                      ->orWhere('nomor_induk', 'like', "%{$search}%");
                })->orWhereHas('book', function($b) use ($search) {
                    $b->where('title', 'like', "%{$search}%")
                      ->orWhere('isbn', 'like', "%{$search}%");
                });
            });
        }

        $transactions = $query->paginate(10)->withQueryString();

        $totalTransactions = Loan::count();
        $totalPendingBorrow = Loan::where('status', 'pending_borrow')->count();
        $totalPendingReturn = Loan::where('status', 'pending_return')->count();
        $totalBorrowed = Loan::where('status', 'borrowed')->count();
        $totalReturned = Loan::where('status', 'returned')->count();
        $totalOverdue = Loan::where('status', 'borrowed')->where('due_date', '<', now()->toDateString())->count();

        return view('admin.transaksi', compact(
            'transactions',
            'totalTransactions',
            'totalPendingBorrow',
            'totalPendingReturn',
            'totalBorrowed',
            'totalReturned',
            'totalOverdue'
        ));
    }

    // 2. Admin Menyetujui Peminjaman
    public function approveBorrow(Request $request, $id)
    {
        $loan = Loan::with(['book', 'user'])->findOrFail($id);

        if ($loan->status !== 'pending_borrow') {
            return back()->with('error', 'Status pengajuan tidak valid.');
        }

        if (!$loan->book || $loan->book->stock_available < 1) {
            return back()->with('error', 'Stok buku ini sedang habis, tidak dapat disetujui.');
        }

        $duration = (int) ($loan->duration ?? 7);

        $loan->update([
            'status' => 'borrowed',
            'loan_date' => now()->toDateString(),
            'due_date' => now()->addDays($duration)->toDateString(),
        ]);

        $loan->book->decrement('stock_available');

        SystemLog::create([
            'action' => 'Borrow Approved',
            'user_name' => auth()->user()->name ?? 'Admin',
            'ip_address' => $request->ip(),
            'details' => 'Admin menyetujui pinjaman buku "' . ($loan->book->title ?? '-') . '" selama ' . $duration . ' hari untuk ' . ($loan->user->name ?? '-'),
        ]);

        return back()->with('success', 'Peminjaman buku selama ' . $duration . ' hari resmi disetujui!');
    }

    // 3. Admin Menolak Peminjaman
    public function rejectBorrow(Request $request, $id)
    {
        $loan = Loan::with(['book', 'user'])->findOrFail($id);

        $loan->update([
            'status' => 'rejected',
        ]);

        SystemLog::create([
            'action' => 'Borrow Rejected',
            'user_name' => auth()->user()->name ?? 'Admin',
            'ip_address' => $request->ip(),
            'details' => 'Admin menolak pengajuan pinjam buku "' . ($loan->book->title ?? '-') . '" oleh ' . ($loan->user->name ?? '-'),
        ]);

        return back()->with('success', 'Pengajuan peminjaman telah ditolak.');
    }

    // 4. Admin Menerima & Memverifikasi Pengembalian Buku
    public function approveReturn(Request $request, $id)
    {
        $loan = Loan::with(['book', 'user'])->findOrFail($id);

        if (!in_array($loan->status, ['pending_return', 'borrowed'])) {
            return back()->with('error', 'Transaksi ini sudah selesai sebelumnya.');
        }

        $loan->update([
            'status' => 'returned',
            'return_date' => now()->toDateString(),
        ]);

        if ($loan->book) {
            $loan->book->increment('stock_available');
        }

        SystemLog::create([
            'action' => 'Return Verified',
            'user_name' => auth()->user()->name ?? 'Admin',
            'ip_address' => $request->ip(),
            'details' => 'Admin memverifikasi pengembalian buku "' . ($loan->book->title ?? '-') . '" dari ' . ($loan->user->name ?? '-'),
        ]);

        return back()->with('success', 'Buku telah diterima fisik dan pengembalian diverifikasi sah!');
    }
}
