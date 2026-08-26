<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    // 1. SISWA MENGAJUKAN PINJAM BUKU (DURASI 1-7 HARI)
    public function borrow(Request $request, $bookId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors([
                'login' => 'Silakan masuk ke akun Anda terlebih dahulu untuk mengajukan peminjaman buku.'
            ]);
        }

        $request->validate([
            'duration' => 'required|integer|min:1|max:7',
        ], [
            'duration.required' => 'Pilih durasi lama peminjaman buku.',
            'duration.min' => 'Durasi peminjaman minimal 1 hari.',
            'duration.max' => 'Batas maksimal peminjaman adalah 7 hari.',
        ]);

        $duration = (int) $request->input('duration', 7);
        $user = Auth::user();
        $book = Book::findOrFail($bookId);

        if ($book->stock_available < 1) {
            return back()->with('error', 'Maaf, stok buku "' . $book->title . '" saat ini sedang kosong.');
        }

        $existingLoan = Loan::where('user_id', $user->id)
                            ->where('book_id', $book->id)
                            ->whereIn('status', ['pending_borrow', 'borrowed', 'pending_return'])
                            ->first();

        if ($existingLoan) {
            if ($existingLoan->status === 'pending_borrow') {
                return back()->with('error', 'Anda sudah mengajukan peminjaman buku ini. Mohon menunggu persetujuan admin.');
            }
            return back()->with('error', 'Buku ini sedang dalam masa pinjaman Anda.');
        }

        Loan::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'duration' => $duration,
            'status' => 'pending_borrow',
            'loan_date' => now()->toDateString(),
            'due_date' => now()->addDays($duration)->toDateString(),
        ]);

        SystemLog::create([
            'action' => 'Borrow Request',
            'user_name' => $user->name . ' (' . ucfirst($user->role) . ')',
            'ip_address' => $request->ip(),
            'details' => $user->name . ' mengajukan pinjam buku: ' . $book->title . ' selama ' . $duration . ' hari',
        ]);

        return back()->with('success', 'Pengajuan pinjam buku selama ' . $duration . ' hari berhasil dikirim! Silakan temui petugas perpustakaan untuk pengambilan buku.');
    }

    // 2. SISWA MENGAJUKAN PENGEMBALIAN BUKU
    public function returnBook(Request $request, $bookId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $book = Book::findOrFail($bookId);

        $loan = Loan::where('user_id', $user->id)
                    ->where('book_id', $book->id)
                    ->where('status', 'borrowed')
                    ->latest()
                    ->first();

        if (!$loan) {
            return back()->with('error', 'Tidak ditemukan pinjaman aktif untuk buku ini.');
        }

        $loan->update([
            'status' => 'pending_return',
        ]);

        SystemLog::create([
            'action' => 'Return Request',
            'user_name' => $user->name . ' (' . ucfirst($user->role) . ')',
            'ip_address' => $request->ip(),
            'details' => $user->name . ' mengajukan pengembalian buku: ' . $book->title,
        ]);

        return back()->with('success', 'Pengajuan pengembalian buku berhasil dikirim! Silakan serahkan buku fisik ke petugas perpustakaan.');
    }
}
