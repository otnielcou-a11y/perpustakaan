<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    // 1. Halaman Collections (Publik)
    public function index(Request $request)
    {
        $query = Book::query();

        // Filter Kategori Real dari Database
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Pencarian Judul, Penulis, Penerbit, atau ISBN
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('publisher', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        // Pengurutan (Sorting)
        if ($request->get('sort') == 'title_asc') {
            $query->orderBy('title', 'asc');
        } elseif ($request->get('sort') == 'title_desc') {
            $query->orderBy('title', 'desc');
        } elseif ($request->get('sort') == 'popular' || $request->get('sort') == 'stock_desc') {
            $query->orderBy('stock_available', 'desc')->orderBy('stock_total', 'desc');
        } else {
            $query->latest();
        }

        // 12 buku per rak halaman
        $books = $query->paginate(12)->withQueryString();

        // Ambil SEMUA kategori dari database secara urut alfabet
        $categories = Category::orderBy('name', 'asc')->get();

        return view('collections', compact('books', 'categories'));
    }

    // 1.1 Live Search Suggestion API
    public function suggest(Request $request)
    {
        $q = trim($request->get('q', ''));
        if (mb_strlen($q) < 2) {
            return response()->json([]);
        }

        $books = Book::where('title', 'like', "%{$q}%")
            ->orWhere('author', 'like', "%{$q}%")
            ->orWhere('category', 'like', "%{$q}%")
            ->take(5)
            ->get(['id', 'title', 'author', 'category', 'cover_image', 'stock_available']);

        $results = $books->map(function($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'category' => $book->category,
                'cover_url' => $book->cover_url,
                'stock_available' => $book->stock_available,
                'url' => url('/buku/' . $book->id)
            ];
        });

        return response()->json($results);
    }

    // 2. Halaman Detail Buku (Publik)
    public function show($id)
    {
        $book = Book::findOrFail($id);

        // Ambil 4 buku terkait dari kategori yang sama
        $relatedBooks = Book::where('category', $book->category)
                            ->where('id', '!=', $book->id)
                            ->take(4)
                            ->get();

        // Jika buku dalam kategori ini kurang dari 4, lengkapi dengan buku lainnya
        if ($relatedBooks->count() < 4) {
            $extra = Book::where('id', '!=', $book->id)
                         ->whereNotIn('id', $relatedBooks->pluck('id'))
                         ->take(4 - $relatedBooks->count())
                         ->get();
            $relatedBooks = $relatedBooks->concat($extra);
        }

        $categories = Category::all();

        return view('detail-buku', compact('book', 'relatedBooks', 'categories'));
    }

    // 3. Admin Data Buku
    public function adminIndex(Request $request)
    {
        $query = Book::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('publisher', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $books = $query->latest()->paginate(10);
        return view('admin.data_buku', compact('books'));
    }

    // 4. Tambah Buku (Admin)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|numeric',
            'isbn' => 'required|string|unique:books,isbn',
            'category' => 'required|string',
            'stock_total' => 'required|numeric|min:1',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cover_url_input' => 'nullable|url',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        } elseif ($request->filled('cover_url_input')) {
            $coverPath = $request->cover_url_input;
        }

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'pages' => $request->pages ?? rand(200, 320),
            'isbn' => $request->isbn,
            'category' => $request->category,
            'stock_total' => $request->stock_total,
            'stock_available' => $request->stock_total,
            'description' => $request->description,
            'cover_image' => $coverPath,
        ]);

        return redirect()->back()->with('success', 'Buku baru berhasil ditambahkan ke inventaris!');
    }

    // 5. Update Buku (Admin)
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $id,
            'category' => 'required|string',
            'stock_total' => 'required|numeric|min:1',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cover_url_input' => 'nullable|url',
        ]);

        $coverPath = $book->cover_image;
        if ($request->hasFile('cover_image')) {
            if ($book->cover_image && !Str::startsWith($book->cover_image, ['http://', 'https://'])) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        } elseif ($request->filled('cover_url_input')) {
            $coverPath = $request->cover_url_input;
        }

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year ?? $book->year,
            'isbn' => $request->isbn,
            'category' => $request->category,
            'stock_total' => $request->stock_total,
            'description' => $request->description ?? $book->description,
            'cover_image' => $coverPath,
        ]);

        return redirect()->back()->with('success', 'Data buku berhasil diperbarui!');
    }

    // 6. Hapus Single Buku
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if ($book->cover_image && !Str::startsWith($book->cover_image, ['http://', 'https://'])) {
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus!');
    }

    // 7. Hapus Massal (Bulk Delete)
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:books,id',
        ]);

        $books = Book::whereIn('id', $request->ids)->get();
        foreach ($books as $book) {
            if ($book->cover_image && !Str::startsWith($book->cover_image, ['http://', 'https://'])) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $book->delete();
        }

        return redirect()->back()->with('success', count($request->ids) . ' buku berhasil dihapus sekaligus!');
    }
}
