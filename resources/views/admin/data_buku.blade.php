<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Inventory - Admin SMKN 2 Purwakarta</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --primary: #0c4d2d;
      --primary-dark: #07351e;
      --accent-yellow: #facc15;
      --bg-app: #f8fafc;
      --sidebar-bg: #f8fafc;
      --text-main: #0f172a;
      --text-muted: #64748b;
      --border: #e2e8f0;
      --white: #ffffff;
    }
    ::-webkit-scrollbar {
        width: 0px;
        background: transparent;
    }

    * {
        scrollbar-width: none;
    }

    * { margin:0; padding:0; box-sizing:border-box; font-family:'Plus Jakarta Sans',sans-serif; }
    body { background-color:var(--bg-app); color:var(--text-main); display:flex; min-height:100vh; overflow-x:hidden; }
    a { text-decoration:none; color:inherit; cursor:pointer; }

    /* SIDEBAR */
    .sidebar { width:260px; background-color:var(--sidebar-bg); border-right:1px solid var(--border); display:flex; flex-direction:column; justify-content:space-between; min-height:100vh; position:fixed; left:0; top:0; z-index:100; }
    .sidebar-top { padding:24px 20px; }
    .sidebar-brand { display:flex; align-items:center; gap:12px; margin-bottom:28px; }

    .sidebar-nav { display:flex; flex-direction:column; gap:4px; }
    .nav-item { display:flex; align-items:center; gap:12px; padding:12px 16px; font-size:13.5px; font-weight:600; color:#334155; border-radius:6px; transition:0.2s; }
    .nav-item:hover { background-color:#f1f5f9; }
    .nav-item.active { background-color:var(--accent-yellow); color:#000; font-weight:700; }
    .sidebar-bottom { padding:20px; border-top:1px solid var(--border); display:flex; flex-direction:column; gap:4px; }

    /* MAIN WRAPPER */
    .main-wrapper { margin-left:260px; flex:1; display:flex; flex-direction:column; min-width:0; }

    /* TOP HEADER & DROPDOWN ADMIN FIX */
    .top-header { height:70px; background-color:var(--white); border-bottom:1px solid var(--border); display:flex; flex-direction:row; align-items:center; justify-content:space-between; padding:0 36px; position:sticky; top:0; z-index:90; }
    .btn-back-home { display:inline-flex; align-items:center; gap:8px; padding:8px 16px; background:#f8fafc; border:1px solid var(--border); border-radius:8px; font-size:13px; font-weight:700; color:var(--primary); transition:0.2s; }
    .btn-back-home:hover { background:var(--primary); color:#ffffff; border-color:var(--primary); }

    .admin-dropdown-wrapper { position:relative; padding-bottom:12px; margin-bottom:-12px; }
    .admin-dropdown-wrapper:hover .fa-chevron-down { transform:rotate(180deg); color:var(--primary); }

    .admin-dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      right: 0;
      background-color: #ffffff;
      min-width: 220px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
      border-radius: 10px;
      border: 1px solid var(--border);
      z-index: 10000;
      margin-top: 6px;
    }
    .admin-dropdown-menu::before { content:''; position:absolute; top:-12px; left:0; width:100%; height:12px; }
    .admin-dropdown-wrapper:hover .admin-dropdown-menu { display:block; animation:fadeInAdmin 0.2s ease forwards; }
    @keyframes fadeInAdmin { from{opacity:0; transform:translateY(6px);} to{opacity:1; transform:translateY(0);} }

    .admin-dropdown-item { display:flex; align-items:center; gap:12px; padding:10px 18px; font-size:13px; font-weight:600; color:#334155; transition:0.2s; }
    .admin-dropdown-item i { width:16px; text-align:center; }
    .admin-dropdown-item:hover { background-color:#f1f5f9; color:var(--primary); padding-left:22px; }

    /* CONTENT BODY */
    .content-body { padding:32px 36px; }
    .page-header { display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:28px; }
    .page-title h1 { font-size:26px; font-weight:800; letter-spacing:-0.5px; }
    .page-title p { font-size:13px; color:var(--text-muted); margin-top:4px; }
    .page-buttons { display:flex; gap:12px; align-items:center; }

    .btn-secondary { padding:9px 16px; background:var(--white); border:1px solid var(--border); border-radius:6px; font-size:13px; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:6px; }
    .btn-primary { padding:9px 16px; background:var(--primary); color:var(--white); border:none; border-radius:6px; font-size:13px; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px; }
    .btn-primary:hover { background-color:var(--primary-dark); }

    .btn-danger-bulk { padding:9px 16px; background:#ef4444; color:var(--white); border:none; border-radius:6px; font-size:13px; font-weight:700; cursor:pointer; display:none; align-items:center; gap:6px; transition:0.2s; }
    .btn-danger-bulk:hover { background:#dc2626; }

    /* PANEL */
    .dashboard-panel { background:var(--white); border:1px solid var(--border); border-radius:12px; padding:24px; }
    .inventory-filter-bar { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; gap:16px; }
    .table-search-input { width:320px; padding:8px 14px; border:1px solid var(--border); border-radius:6px; font-size:13px; outline:none; }
    .filter-actions { display:flex; gap:10px; }
    .filter-select { padding:8px 14px; border:1px solid var(--border); border-radius:6px; background-color:var(--white); font-size:13px; outline:none; }

    /* TABLE */
    .table-responsive { width:100%; overflow-x:auto; }
    .custom-table { width:100%; border-collapse:collapse; font-size:13px; }
    .custom-table th { text-align:left; padding:12px 14px; color:var(--text-muted); font-size:12px; font-weight:700; border-bottom:1px solid var(--border); }
    .custom-table td { padding:14px; border-bottom:1px solid #f1f5f9; vertical-align:middle; }
    .book-thumb-table { width:40px; height:54px; border-radius:4px; object-fit:cover; background-color:#f1f5f9; box-shadow:0 2px 4px rgba(0,0,0,0.1); }

    .badge-status { padding:4px 10px; border-radius:20px; font-size:11px; font-weight:700; }
    .status-available { background-color:#d1fae5; color:#065f46; }
    .status-out { background-color:#fee2e2; color:#991b1b; }
    .status-low { background-color:#e0f2fe; color:#0369a1; }

    .alert-success { background:#d1fae5; border:1px solid #a7f3d0; color:#065f46; padding:12px 18px; border-radius:8px; margin-bottom:20px; font-weight:700; font-size:13px; }

    /* PAGINATION RAK */
    .pagination-wrapper { display:flex; justify-content:space-between; align-items:center; margin-top:24px; padding-top:18px; border-top:1px solid var(--border); font-size:13px; color:var(--text-muted); }
    .pagination-pages { display:flex; align-items:center; gap:6px; }
    .page-btn { width:34px; height:34px; border-radius:6px; border:1px solid var(--border); background:var(--white); color:#334155; display:flex; align-items:center; justify-content:center; font-size:12.5px; font-weight:700; cursor:pointer; transition:0.2s; text-decoration:none; }
    .page-btn:hover:not(.disabled):not(.active) { background:#f1f5f9; border-color:#cbd5e1; color:var(--primary); }
    .page-btn.active { background:var(--primary); color:var(--white); border-color:var(--primary); }
    .page-btn.disabled { color:#cbd5e1; cursor:not-allowed; background:#f8fafc; }
    .page-dots { padding:0 4px; color:var(--text-muted); font-weight:700; }

    /* MODAL */
    .modal-backdrop { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center; padding:20px; }
    .modal-backdrop.show { display:flex; }
    .modal-box { background:#fff; border-radius:12px; width:100%; max-width:560px; max-height:90vh; overflow-y:auto; padding:28px; }
    .modal-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom:1px solid var(--border); padding-bottom:12px; }
    .modal-header h3 { font-size:18px; font-weight:800; }
    .form-group { margin-bottom:14px; }
    .form-group label { display:block; font-size:12px; font-weight:700; margin-bottom:5px; }
    .form-control { width:100%; padding:9px 12px; font-size:13px; border:1px solid var(--border); border-radius:6px; outline:none; }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    .modal-footer { display:flex; justify-content:flex-end; gap:10px; margin-top:20px; border-top:1px solid var(--border); padding-top:16px; }
  </style>
</head>
<body>

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-top">
      <div class="sidebar-brand">
        @include('partials.logo', ['theme' => 'dark'])
      </div>

      <nav class="sidebar-nav">
        <a href="{{ url('/admin/dashboard') }}" class="nav-item">
          <i class="fa-solid fa-table-cells-large"></i> Dashboard
        </a>
        <a href="{{ url('/admin/data-buku') }}" class="nav-item active">
          <i class="fa-solid fa-book-open"></i> Book Management
        </a>
        <a href="{{ url('/admin/data-anggota') }}" class="nav-item">
          <i class="fa-solid fa-users"></i> Member Management
        </a>
        <a href="{{ url('/admin/transaksi') }}" class="nav-item">
          <i class="fa-solid fa-arrow-right-arrow-left"></i> Transactions
        </a>
        <a href="{{ url('/admin/kategori') }}" class="nav-item">
          <i class="fa-solid fa-tags"></i> Category Management
        </a>
        @if(auth()->user() && auth()->user()->role === 'superadmin')
        <a href="{{ url('/admin/tambah-admin') }}" class="nav-item">
          <i class="fa-solid fa-user-shield"></i> Administrator
        </a>
        @endif
        <a href="{{ url('/admin/tentang-website') }}" class="nav-item">
          <i class="fa-solid fa-circle-info"></i> About Website
        </a>
      </nav>
    </div>

    <div class="sidebar-bottom">
      <a href="{{ url('/admin/settings') }}" class="nav-item">
        <i class="fa-solid fa-gear"></i> Settings
      </a>
      <a href="{{ url('/logout') }}" class="nav-item" style="color: #ef4444;">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
      </a>
    </div>
  </aside>

  <!-- MAIN WRAPPER -->
  <div class="main-wrapper">
    <header class="top-header">
      <a href="{{ url('/') }}" class="btn-back-home">
        <i class="fa-solid fa-house"></i> Kembali ke Beranda
      </a>
      @include('partials.admin_avatar')
    </header>

    <main class="content-body">
      @if(session('success'))
        <div class="alert-success">
          <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
      @endif

      <div class="page-header">
        <div class="page-title">
          <h1>Book Inventory</h1>
          <p>Manage, add, and track the library's physical and digital resources.</p>
        </div>

        <div class="page-buttons">
          <button type="button" id="btnBulkDelete" class="btn-danger-bulk" onclick="submitBulkDelete()">
            <i class="fa-regular fa-trash-can"></i> Hapus Terpilih (<span id="selectedCount">0</span>)
          </button>

          <button class="btn-primary" onclick="openAddModal()"><i class="fa-solid fa-plus"></i> Add Book</button>
        </div>
      </div>

      <div class="dashboard-panel">
        <div class="inventory-filter-bar">
          <form action="{{ url('/admin/data-buku') }}" method="GET" style="display:flex; gap:10px;">
            <input type="text" name="search" value="{{ request('search') }}" class="table-search-input" placeholder="Filter by title, author, or ISBN...">
            <button type="submit" class="btn-secondary"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
          </form>

          <div class="filter-actions">
            <select class="filter-select" onchange="location = this.value;">
              <option value="{{ url('/admin/data-buku') }}">All Categories</option>
              <option value="{{ url('/admin/data-buku?category=Kuliner') }}" {{ request('category') == 'Kuliner' ? 'selected' : '' }}>Kuliner</option>
              <option value="{{ url('/admin/data-buku?category=Akuntansi') }}" {{ request('category') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
              <option value="{{ url('/admin/data-buku?category=Fashion Design') }}" {{ request('category') == 'Fashion Design' ? 'selected' : '' }}>Fashion Design</option>
              <option value="{{ url('/admin/data-buku?category=Hospitality') }}" {{ request('category') == 'Hospitality' ? 'selected' : '' }}>Hospitality</option>
              <option value="{{ url('/admin/data-buku?category=Teknologi') }}" {{ request('category') == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
            </select>
          </div>
        </div>

        <form id="bulkDeleteForm" action="{{ route('admin.books.bulkDestroy') }}" method="POST">
          @csrf

          <div class="table-responsive">
            <table class="custom-table">
              <thead>
                <tr>
                  <th width="30"><input type="checkbox" id="selectAll"></th>
                  <th>Title, Author & Publisher</th>
                  <th>ISBN</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th width="90">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($books as $book)
                  <tr>
                    <td>
                      <input type="checkbox" name="ids[]" value="{{ $book->id }}" class="book-check" onchange="updateSelectedCount()">
                    </td>
                    <td>
                      <div style="display:flex; gap:12px; align-items:center;">
                        <img src="{{ $book->cover_url }}" class="book-thumb-table" alt="Cover" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500&auto=format&fit=crop&q=80';">
                        <div>
                          <h4 style="font-size:13.5px; font-weight:700;">{{ $book->title }}</h4>
                          <p style="font-size:11.5px; color:var(--text-muted);">
                            {{ $book->author }} • <span style="color:#0c4d2d; font-weight:600;">{{ $book->publisher }}</span> ({{ $book->year }})
                          </p>
                        </div>
                      </div>
                    </td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->category }}</td>
                    <td>
                      @if($book->stock_available > 2)
                        <span class="badge-status status-available">Available ({{ $book->stock_available }}/{{ $book->stock_total }})</span>
                      @elseif($book->stock_available > 0)
                        <span class="badge-status status-low">Low Stock ({{ $book->stock_available }}/{{ $book->stock_total }})</span>
                      @else
                        <span class="badge-status status-out">Out of Stock (0/{{ $book->stock_total }})</span>
                      @endif
                    </td>
                    <td>
                      <button type="button" class="icon-btn" title="Edit" data-book='@json($book)' onclick="openEditModalFromButton(this)">
                        <i class="fa-regular fa-pen-to-square"></i>
                      </button>

                      <button type="button" class="icon-btn" title="Delete" style="color: #ef4444;" onclick="deleteSingleBook({{ $book->id }})">
                        <i class="fa-regular fa-trash-can"></i>
                      </button>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" style="text-align:center; padding:30px; color:#64748b;">
                      Belum ada data buku di inventaris.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </form>

        <form id="singleDeleteForm" method="POST" style="display:none;">
          @csrf
          @method('DELETE')
        </form>

        @if ($books->hasPages())
          <div class="pagination-wrapper">
            <div>
              Showing <strong>{{ $books->firstItem() ?? 0 }}</strong> to <strong>{{ $books->lastItem() ?? 0 }}</strong> of <strong>{{ number_format($books->total()) }}</strong> entries
            </div>

            <div class="pagination-pages">
              @if ($books->onFirstPage())
                <span class="page-btn disabled"><i class="fa-solid fa-chevron-left"></i></span>
              @else
                <a href="{{ $books->previousPageUrl() }}" class="page-btn"><i class="fa-solid fa-chevron-left"></i></a>
              @endif

              @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                @if ($page == $books->currentPage())
                  <span class="page-btn active">{{ $page }}</span>
                @elseif ($page == 1 || $page == $books->lastPage() || ($page >= $books->currentPage() - 1 && $page <= $books->currentPage() + 1))
                  <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                @elseif ($page == 2 || $page == $books->lastPage() - 1)
                  <span class="page-dots">...</span>
                @endif
              @endforeach

              @if ($books->hasMorePages())
                <a href="{{ $books->nextPageUrl() }}" class="page-btn"><i class="fa-solid fa-chevron-right"></i></a>
              @else
                <span class="page-btn disabled"><i class="fa-solid fa-chevron-right"></i></span>
              @endif
            </div>
          </div>
        @endif
      </div>
    </main>
  </div>

  <!-- MODAL ADD BOOK -->
  <div class="modal-backdrop" id="addBookModal">
    <div class="modal-box">
      <div class="modal-header">
        <h3>Tambah Buku Baru</h3>
        <button type="button" class="icon-btn" onclick="closeModal('addBookModal')"><i class="fa-solid fa-xmark"></i></button>
      </div>

      <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label>Judul Buku</label>
          <input type="text" name="title" class="form-control" placeholder="Masukkan judul buku" required>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Penulis / Author</label>
            <input type="text" name="author" class="form-control" placeholder="Nama penulis" required>
          </div>
          <div class="form-group">
            <label>Penerbit / Publisher</label>
            <input type="text" name="publisher" class="form-control" placeholder="Contoh: Erlangga, Gramedia" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>ISBN</label>
            <input type="text" name="isbn" class="form-control" placeholder="978-602-..." required>
          </div>
          <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="number" name="year" class="form-control" value="{{ date('Y') }}" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Kategori</label>
            <select name="category" class="form-control" required>
              <option value="Kuliner">Kuliner</option>
              <option value="Akuntansi">Akuntansi</option>
              <option value="Fashion Design">Fashion Design</option>
              <option value="Hospitality">Hospitality</option>
              <option value="Teknologi">Teknologi</option>
              <option value="Umum & Muatan Nasional">Umum & Muatan Nasional</option>
              <option value="Bahasa & Seni">Bahasa & Seni</option>
              <option value="Bisnis & Manajemen">Bisnis & Manajemen</option>
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah Total Stok</label>
            <input type="number" name="stock_total" class="form-control" value="10" min="1" required>
          </div>
        </div>

        <div class="form-group">
          <label>Upload Cover File (Opsional)</label>
          <input type="file" name="cover_image" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
          <label>Atau Link URL Cover (Opsi 2)</label>
          <input type="url" name="cover_url_input" class="form-control" placeholder="https://images.unsplash.com/...">
        </div>

        <div class="form-group">
          <label>Deskripsi / Sinopsis Buku</label>
          <textarea name="description" class="form-control" rows="3" placeholder="Ringkasan buku..."></textarea>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-secondary" onclick="closeModal('addBookModal')">Batal</button>
          <button type="submit" class="btn-primary">Simpan Buku</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL EDIT BUKU -->
  <div class="modal-backdrop" id="editBookModal">
    <div class="modal-box">
      <div class="modal-header">
        <h3>Edit Data Buku</h3>
        <button type="button" class="icon-btn" onclick="closeModal('editBookModal')"><i class="fa-solid fa-xmark"></i></button>
      </div>

      <form id="editBookForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label>Judul Buku</label>
          <input type="text" id="edit_title" name="title" class="form-control" required>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Penulis / Author</label>
            <input type="text" id="edit_author" name="author" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Penerbit / Publisher</label>
            <input type="text" id="edit_publisher" name="publisher" class="form-control" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>ISBN</label>
            <input type="text" id="edit_isbn" name="isbn" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="number" id="edit_year" name="year" class="form-control" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Kategori</label>
            <select id="edit_category" name="category" class="form-control" required>
              <option value="Kuliner">Kuliner</option>
              <option value="Akuntansi">Akuntansi</option>
              <option value="Fashion Design">Fashion Design</option>
              <option value="Hospitality">Hospitality</option>
              <option value="Teknologi">Teknologi</option>
              <option value="Umum & Muatan Nasional">Umum & Muatan Nasional</option>
              <option value="Bahasa & Seni">Bahasa & Seni</option>
              <option value="Bisnis & Manajemen">Bisnis & Manajemen</option>
            </select>
          </div>
          <div class="form-group">
            <label>Total Stok</label>
            <input type="number" id="edit_stock" name="stock_total" class="form-control" required>
          </div>
        </div>

        <div class="form-group">
          <label>Ganti File Cover (Opsional)</label>
          <input type="file" name="cover_image" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
          <label>Atau Ganti Link URL Cover</label>
          <input type="url" id="edit_cover_url" name="cover_url_input" class="form-control">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-secondary" onclick="closeModal('editBookModal')">Batal</button>
          <button type="submit" class="btn-primary">Update Buku</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const selectAllCheckbox = document.getElementById('selectAll');
    const bookCheckboxes = document.querySelectorAll('.book-check');
    const btnBulkDelete = document.getElementById('btnBulkDelete');
    const selectedCountSpan = document.getElementById('selectedCount');

    if (selectAllCheckbox) {
      selectAllCheckbox.addEventListener('change', function() {
        bookCheckboxes.forEach(cb => cb.checked = selectAllCheckbox.checked);
        updateSelectedCount();
      });
    }

    function updateSelectedCount() {
      const checkedBoxes = document.querySelectorAll('.book-check:checked');
      const count = checkedBoxes.length;
      selectedCountSpan.textContent = count;

      if (count > 0) {
        btnBulkDelete.style.display = 'flex';
      } else {
        btnBulkDelete.style.display = 'none';
        if (selectAllCheckbox) selectAllCheckbox.checked = false;
      }
    }

    function submitBulkDelete() {
      const count = document.querySelectorAll('.book-check:checked').length;
      if (count === 0) return;

      if (confirm('Hapus ' + count + ' buku yang dipilih sekaligus?')) {
        document.getElementById('bulkDeleteForm').submit();
      }
    }

    function deleteSingleBook(bookId) {
      if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
        const form = document.getElementById('singleDeleteForm');
        form.action = '/admin/buku/hapus/' + bookId;
        form.submit();
      }
    }

    function openAddModal() {
      document.getElementById('addBookModal').classList.add('show');
    }

    function openEditModalFromButton(btn) {
      try {
        const raw = btn.getAttribute('data-book');
        if (!raw) return;
        const book = typeof raw === 'string' ? JSON.parse(raw) : raw;
        openEditModal(book);
      } catch (e) {
        console.error("Error parsing book data:", e);
      }
    }

    function openEditModal(book) {
      document.getElementById('editBookForm').action = "/admin/buku/update/" + book.id;
      document.getElementById('edit_title').value = book.title;
      document.getElementById('edit_author').value = book.author;
      document.getElementById('edit_publisher').value = book.publisher || '';
      document.getElementById('edit_year').value = book.year || new Date().getFullYear();
      document.getElementById('edit_isbn').value = book.isbn;
      document.getElementById('edit_category').value = book.category;
      document.getElementById('edit_stock').value = book.stock_total;
      document.getElementById('edit_cover_url').value = (book.cover_image && book.cover_image.startsWith('http')) ? book.cover_image : '';

      document.getElementById('editBookModal').classList.add('show');
    }

    function closeModal(modalId) {
      document.getElementById(modalId).classList.remove('show');
    }
  </script>
</body>
</html>
