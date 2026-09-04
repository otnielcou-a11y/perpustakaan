<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Loan;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = User::whereIn('role', ['murid', 'guru', 'admin']);

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Jika relasi loans ada, kita load dan urutkan dari yang terbaru
        if (method_exists(User::class, 'loans')) {
            $query->with(['loans' => function($q) {
                $q->latest('loan_date')->latest('id');
            }, 'loans.book']);
        }

        // Fitur Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('nomor_induk', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Ambil data dengan pagination
        $members = $query->latest()->paginate(10);
        $totalMembers = User::whereIn('role', ['murid', 'guru', 'admin'])->count();

        // Mengambil data pertama secara aman tanpa method first()
        $selectedMember = count($members->items()) > 0 ? $members->items()[0] : null;

        return view('admin.data_anggota', compact('members', 'totalMembers', 'selectedMember'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'nullable|string|email|max:255|unique:users,email',
            'nomor_induk' => 'required|string|max:50',
            'role' => 'required|in:murid,guru,admin',
            'password' => 'required|min:4',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'nomor_induk' => $request->nomor_induk,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'status' => 'active', // tambahkan status default
        ]);

        return back()->with('success', 'Anggota baru berhasil didaftarkan!');
    }

    /**
     * Update the specified member.
     */
    public function update(Request $request, $id)
    {
        $member = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $id,
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $id,
            'nomor_induk' => 'required|string|max:50',
            'role' => 'required|in:murid,guru,admin,superadmin',
            'status' => 'required|in:active,banned',
        ]);

        $member->name = $request->name;
        $member->username = $request->username;
        $member->email = $request->email;
        $member->nomor_induk = $request->nomor_induk;
        $member->role = $request->role;
        $member->status = $request->status;

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:4',
            ]);
            $member->password = Hash::make($request->password);
        }

        $member->save();

        // Log aktivitas (opsional)
        SystemLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_member',
            'description' => "Memperbarui data anggota: {$member->name}",
        ]);

        return back()->with('success', 'Data anggota berhasil diperbarui!');
    }

    /**
     * Ban a member.
     */
    public function ban($id)
    {
        $member = User::findOrFail($id);

        // Cegah ban admin
        if ($member->role === 'admin') {
            return back()->with('error', 'Tidak dapat meng-ban admin!');
        }

        // Cek apakah member sedang meminjam buku
        if (method_exists(User::class, 'loans')) {
            $activeLoans = $member->loans()->where('status', 'borrowed')->count();
            if ($activeLoans > 0) {
                return back()->with('error', 'Tidak dapat meng-ban anggota yang masih memiliki pinjaman aktif!');
            }
        }

        $member->status = 'banned';
        $member->save();

        // Log aktivitas (opsional)
        SystemLog::create([
            'user_id' => auth()->id(),
            'action' => 'ban_member',
            'description' => "Meng-ban anggota: {$member->name}",
        ]);

        return back()->with('success', "Anggota {$member->name} berhasil di-ban!");
    }

    /**
     * Unban a member.
     */
    public function unban($id)
    {
        $member = User::findOrFail($id);

        $member->status = 'active';
        $member->save();

        // Log aktivitas (opsional)
        SystemLog::create([
            'user_id' => auth()->id(),
            'action' => 'unban_member',
            'description' => "Meng-unban anggota: {$member->name}",
        ]);

        return back()->with('success', "Anggota {$member->name} berhasil di-unban!");
    }

    /**
     * Remove the specified member.
     */
    public function destroy($id)
    {
        $member = User::findOrFail($id);

        // Cegah menghapus admin
        if ($member->role === 'admin') {
            return back()->with('error', 'Tidak dapat menghapus admin!');
        }

        // Cek apakah member sedang meminjam buku
        if (method_exists(User::class, 'loans')) {
            $activeLoans = $member->loans()->where('status', 'borrowed')->count();
            if ($activeLoans > 0) {
                return back()->with('error', 'Tidak dapat menghapus anggota yang masih memiliki pinjaman aktif!');
            }
        }

        $memberName = $member->name;
        $member->delete();

        // Log aktivitas (opsional)
        SystemLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_member',
            'description' => "Menghapus anggota: {$memberName}",
        ]);

        return back()->with('success', "Anggota {$memberName} berhasil dihapus!");
    }

    /**
     * Get member details for AJAX (opsional)
     */
    public function show($id)
    {
        $member = User::with(['loans.book'])->findOrFail($id);
        return response()->json($member);
    }

    /**
     * Get member loan history for AJAX full history modal.
     */
    public function history($id)
    {
        $member = User::findOrFail($id);

        $loans = Loan::with('book')
            ->where('user_id', $id)
            ->latest('loan_date')
            ->latest('id')
            ->get();

        $formattedLoans = $loans->map(function ($loan) {
            $isOverdue = $loan->status === 'overdue' || ($loan->status === 'borrowed' && $loan->due_date && $loan->due_date < now()->toDateString());

            return [
                'id' => $loan->id,
                'book_id' => $loan->book_id,
                'book_title' => $loan->book->title ?? 'Judul Buku Tidak Ditemukan',
                'book_author' => $loan->book->author ?? '-',
                'book_publisher' => $loan->book->publisher ?? '-',
                'book_category' => $loan->book->category ?? '-',
                'book_cover' => $loan->book ? $loan->book->cover_url : null,
                'status' => $loan->status,
                'duration' => $loan->duration ? $loan->duration . ' Hari' : '-',
                'loan_date' => $loan->loan_date ? Carbon::parse($loan->loan_date)->format('d M Y') : '-',
                'due_date' => $loan->due_date ? Carbon::parse($loan->due_date)->format('d M Y') : '-',
                'return_date' => $loan->return_date ? Carbon::parse($loan->return_date)->format('d M Y') : null,
                'is_overdue' => $isOverdue,
                'created_at' => $loan->created_at ? $loan->created_at->format('d M Y H:i') : '-',
            ];
        });

        $stats = [
            'total' => $loans->count(),
            'borrowed' => $loans->where('status', 'borrowed')->count(),
            'returned' => $loans->where('status', 'returned')->count(),
            'overdue' => $formattedLoans->where('is_overdue', true)->count(),
            'pending' => $loans->filter(function($l) {
                return in_array($l->status, ['pending_borrow', 'pending_return']);
            })->count(),
        ];

        return response()->json([
            'success' => true,
            'member' => [
                'id' => $member->id,
                'name' => $member->name,
                'username' => $member->username ?? '-',
                'nomor_induk' => $member->nomor_induk ?? ('LIB-' . str_pad($member->id, 4, '0', STR_PAD_LEFT)),
                'email' => $member->email ?? '-',
                'role' => $member->role,
                'status' => $member->status,
                'avatar_initials' => strtoupper(substr($member->name, 0, 2)),
            ],
            'stats' => $stats,
            'loans' => $formattedLoans,
        ]);
    }
}
