<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // 1. Tampilkan Halaman Pengelolaan Kategori
    public function index(Request $request)
    {
        $query = Category::withCount('books');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $categories = $query->latest()->paginate(10);
        $totalCategories = Category::count();
        $totalBooks = Book::count();

        return view('admin.data_kategori', compact('categories', 'totalCategories', 'totalBooks'));
    }

    // 2. Tambah Kategori Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
        ], [
            'name.required' => 'Nama kategori wajib diisi!',
            'name.unique' => 'Kategori ini sudah ada!',
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

    // 3. Edit / Update Kategori
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $id,
        ], [
            'name.required' => 'Nama kategori wajib diisi!',
            'name.unique' => 'Nama kategori sudah digunakan!',
        ]);

        $oldName = $category->name;
        $newName = $request->name;

        // Update buku-buku yang memakai nama kategori lama
        Book::where('category', $oldName)->update(['category' => $newName]);

        $category->update([
            'name' => $newName,
            'slug' => Str::slug($newName),
        ]);

        return back()->with('success', 'Kategori berhasil diperbarui!');
    }

    // 4. Hapus Satu Kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus!');
    }

    // 5. Hapus Sekaligus (Bulk Delete)
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:categories,id',
        ], [
            'ids.required' => 'Pilih minimal satu kategori untuk dihapus!',
        ]);

        Category::whereIn('id', $request->ids)->delete();

        return back()->with('success', count($request->ids) . ' kategori terpilih berhasil dihapus!');
    }
}
