<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua user dengan role admin atau superadmin
        $admins = User::whereIn('role', ['admin', 'superadmin'])->get();

        return view('admin.tambah-admin', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'nullable|string|email|max:255|unique:users,email',
            'password' => 'required|min:4|confirmed',
            'role' => 'required|in:admin,superadmin',
        ]);

        // Cek apakah user yang login adalah superadmin
        if (auth()->user()->role !== 'superadmin' && $request->role === 'superadmin') {
            return redirect()->back()->with('error', 'Hanya Super Admin yang bisa membuat Super Admin baru!');
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'active',
            'nomor_induk' => 'ADMIN-' . date('Y') . '-' . rand(1000, 9999),
        ]);

        return redirect()->back()->with('success', 'Admin baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        // Cek izin - hanya superadmin yang bisa update superadmin lain
        if ($admin->role === 'superadmin' && auth()->user()->role !== 'superadmin') {
            return redirect()->back()->with('error', 'Hanya Super Admin yang bisa mengedit Super Admin!');
        }

        // Cegah superadmin mengubah role-nya sendiri
        if ($admin->id === auth()->id() && $request->role !== 'superadmin') {
            return redirect()->back()->with('error', 'Tidak bisa mengubah role sendiri!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $id,
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,superadmin',
        ]);

        // Cek jika user biasa mencoba mengubah ke superadmin
        if (auth()->user()->role !== 'superadmin' && $request->role === 'superadmin') {
            return redirect()->back()->with('error', 'Hanya Super Admin yang bisa menaikkan role menjadi Super Admin!');
        }

        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->role = $request->role;

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:4|confirmed']);
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->back()->with('success', 'Data admin berhasil diperbarui!');
    }

    /**
     * Hapus admin (ubah role menjadi member biasa)
     */
    public function destroy($id)
    {
        $admin = User::findOrFail($id);

        // Cegah menghapus diri sendiri
        if ($admin->id === auth()->id()) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        // Cegah menghapus superadmin terakhir
        $superAdminCount = User::where('role', 'superadmin')->count();
        if ($admin->role === 'superadmin' && $superAdminCount <= 1) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus superadmin terakhir!');
        }

        // Cegah admin biasa menghapus superadmin
        if ($admin->role === 'superadmin' && auth()->user()->role !== 'superadmin') {
            return redirect()->back()->with('error', 'Hanya Super Admin yang bisa menghapus Super Admin!');
        }

        // Simpan nama untuk pesan
        $adminName = $admin->name;

        // Ubah role menjadi member (murid) - BUKAN DIHAPUS
        $admin->update([
            'role' => 'murid',
            'nomor_induk' => 'MEMBER-' . date('Y') . '-' . rand(1000, 9999),
            'status' => 'active',
        ]);

        return redirect()->back()->with('success', "Admin {$adminName} telah diturunkan menjadi member biasa (murid)!");
    }

    /**
     * Turunkan admin ke member dengan pilihan role
     */
    public function downgrade(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        // Cegah menurunkan diri sendiri
        if ($admin->id === auth()->id()) {
            return redirect()->back()->with('error', 'Tidak bisa menurunkan akun sendiri!');
        }

        // Cegah menurunkan superadmin terakhir
        $superAdminCount = User::where('role', 'superadmin')->count();
        if ($admin->role === 'superadmin' && $superAdminCount <= 1) {
            return redirect()->back()->with('error', 'Tidak dapat menurunkan superadmin terakhir!');
        }

        // Cegah admin biasa menurunkan superadmin
        if ($admin->role === 'superadmin' && auth()->user()->role !== 'superadmin') {
            return redirect()->back()->with('error', 'Hanya Super Admin yang bisa menurunkan Super Admin!');
        }

        // Validasi role baru
        $request->validate([
            'role' => 'required|in:murid,guru',
        ]);

        $adminName = $admin->name;
        $newRole = $request->role;

        $admin->update([
            'role' => $newRole,
            'nomor_induk' => 'MEMBER-' . date('Y') . '-' . rand(1000, 9999),
            'status' => 'active',
        ]);

        $roleLabel = $newRole === 'murid' ? 'Murid/Siswa' : 'Guru/Staf';
        return redirect()->back()->with('success', "Admin {$adminName} telah diturunkan menjadi {$roleLabel}!");
    }

    /**
     * Hapus permanen admin dari database (Opsional - Hanya untuk superadmin)
     */
    public function deletePermanent($id)
    {
        $admin = User::findOrFail($id);

        // Cegah menghapus diri sendiri
        if ($admin->id === auth()->id()) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        // Cegah menghapus superadmin terakhir
        $superAdminCount = User::where('role', 'superadmin')->count();
        if ($admin->role === 'superadmin' && $superAdminCount <= 1) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus superadmin terakhir!');
        }

        $adminName = $admin->name;
        $admin->delete();

        return redirect()->back()->with('success', "Admin {$adminName} berhasil dihapus permanen!");
    }
}
