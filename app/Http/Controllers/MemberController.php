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
        $query = User::whereIn('role', ['murid', 'guru']);

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
        $totalMembers = User::whereIn('role', ['murid', 'guru'])->count();

        // Mengambil data pertama secara aman tanpa method first()
        $selectedMember = count($members->items()) > 0 ? $members->items()[0] : null;

        return view('admin.data_anggota', compact('members', 'totalMembers', 'selectedMember'));
    }

    public function store(Request $request)
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

        return back()->with('success', 'Anggota baru berhasil didaftarkan!');
    }
}
