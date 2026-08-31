<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = User::whereIn('role', ['murid', 'guru', 'admin']);

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Jika relasi loans ada, kita load
        if (method_exists(User::class, 'loans')) {
            $query->with(['loans.book']);
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
}
