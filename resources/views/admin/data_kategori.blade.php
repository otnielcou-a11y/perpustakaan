<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Category Management - Admin SMKN 2 Purwakarta</title>

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

    .content-body { padding:32px 36px; }
    .page-header { display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:28px; }
    .page-title h1 { font-size:26px; font-weight:800; letter-spacing:-0.5px; }
    .page-title p { font-size:13px; color:var(--text-muted); margin-top:4px; }

    .page-buttons { display:flex; gap:12px; align-items:center; }
    .btn-primary { padding:10px 18px; background:var(--primary); color:var(--white); border:none; border-radius:6px; font-size:13px; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:8px; }
    .btn-primary:hover { background-color:var(--primary-dark); }
    .btn-secondary { padding:9px 16px; background:var(--white); border:1px solid var(--border); border-radius:6px; font-size:13px; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:6px; }

    .btn-danger-bulk { padding:9px 16px; background:#ef4444; color:var(--white); border:none; border-radius:6px; font-size:13px; font-weight:700; cursor:pointer; display:none; align-items:center; gap:6px; transition:0.2s; }
    .btn-danger-bulk:hover { background:#dc2626; }

    /* PANEL */
    .dashboard-panel { background:var(--white); border:1px solid var(--border); border-radius:12px; padding:24px; }
    .inventory-filter-bar { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; gap:16px; }
    .table-search-input { width:320px; padding:8px 14px; border:1px solid var(--border); border-radius:6px; font-size:13px; outline:none; }

    /* TABLE */
    .table-responsive { width:100%; overflow-x:auto; }
    .custom-table { width:100%; border-collapse:collapse; font-size:13px; }
    .custom-table th { text-align:left; padding:12px 14px; color:var(--text-muted); font-size:12px; font-weight:700; border-bottom:1px solid var(--border); }
    .custom-table td { padding:14px; border-bottom:1px solid #f1f5f9; vertical-align:middle; }

    .icon-btn { background:none; border:none; color:var(--text-muted); font-size:15px; cursor:pointer; padding:4px 6px; }
    .badge-count { background:#d1fae5; color:#065f46; padding:4px 10px; border-radius:20px; font-size:11.5px; font-weight:700; }

    .alert-success { background:#d1fae5; border:1px solid #a7f3d0; color:#065f46; padding:12px 18px; border-radius:8px; margin-bottom:20px; font-weight:700; font-size:13px; }

    /* PAGINATION RAK */
    .pagination-wrapper { display:flex; justify-content:space-between; align-items:center; margin-top:20px; padding-top:16px; border-top:1px solid var(--border); font-size:12.5px; color:var(--text-muted); }
    .pagination-pages { display:flex; align-items:center; gap:6px; }
    .page-btn { width:32px; height:32px; border-radius:6px; border:1px solid var(--border); background:var(--white); color:#334155; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:700; cursor:pointer; transition:0.2s; text-decoration:none; }
    .page-btn:hover:not(.disabled):not(.active) { background:#f1f5f9; color:var(--primary); }
    .page-btn.active { background:var(--primary); color:var(--white); border-color:var(--primary); }
    .page-btn.disabled { color:#cbd5e1; cursor:not-allowed; background:#f8fafc; }
    .page-dots { padding:0 3px; color:var(--text-muted); font-weight:700; }

    /* MODAL */
    .modal-backdrop { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center; padding:20px; }
    .modal-backdrop.show { display:flex; }
    .modal-box { background:#fff; border-radius:12px; width:100%; max-width:440px; padding:28px; }
    .modal-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom:1px solid var(--border); padding-bottom:12px; }
    .modal-header h3 { font-size:17px; font-weight:800; }
    .form-group { margin-bottom:16px; }
    .form-group label { display:block; font-size:12px; font-weight:700; margin-bottom:6px; }
    .form-control { width:100%; padding:10px 14px; font-size:13px; border:1px solid var(--border); border-radius:6px; outline:none; }
    .form-control:focus { border-color:var(--primary); }
    .modal-footer { display:flex; justify-content:flex-end; gap:10px; margin-top:20px; border-top:1px solid var(--border); padding-top:16px; }

    /* RESPONSIVE MOBILE & DRAWER */
    .btn-sidebar-toggle { display: none; background: none; border: 1px solid var(--border); border-radius: 8px; padding: 8px 12px; font-size: 16px; color: var(--text-main); cursor: pointer; align-items: center; justify-content: center; transition: 0.2s; }
    .btn-sidebar-toggle:hover { background: #f1f5f9; }
    .sidebar-backdrop { display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.45); z-index: 998; backdrop-filter: blur(2px); }
    .sidebar-backdrop.show { display: block; }
    .sidebar-close-btn { display: none; background: none; border: none; font-size: 20px; color: var(--text-muted); cursor: pointer; padding: 4px 8px; margin-left: auto; }
    .sidebar-close-btn:hover { color: var(--text-main); }

    @media (max-width: 992px) {
      .sidebar { transform: translateX(-100%); transition: transform 0.3s ease-in-out; z-index: 999; box-shadow: 0 10px 30px rgba(0,0,0,0.15); }
      .sidebar.show { transform: translateX(0); }
      .sidebar-close-btn { display: block; }
      .main-wrapper { margin-left: 0 !important; width: 100% !important; }
      .btn-sidebar-toggle { display: inline-flex; }
      .top-header { padding: 0 16px; gap: 10px; }
      .content-body { padding: 20px 16px; }
      .page-header { flex-direction: column; align-items: stretch; gap: 14px; }
      .page-buttons { width: 100%; flex-wrap: wrap; }
      .page-buttons .btn-primary, .page-buttons .btn-secondary, .page-buttons .btn-danger-bulk { flex: 1; justify-content: center; text-align: center; }
      .inventory-filter-bar { flex-direction: column; align-items: stretch; gap: 12px; }
      .table-search-input { width: 100%; }
      .inventory-filter-bar form { width: 100%; }
    }

    @media (max-width: 640px) {
      .hide-mobile-text { display: none; }
      .page-title h1 { font-size: 22px; }
      .modal-box { width: 95% !important; padding: 18px; }
      .pagination-wrapper { flex-direction: column; align-items: center; gap: 12px; }
    }
  </style>
</head>
<body>

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-top">
      <div class="sidebar-brand">
        @include('partials.logo', ['theme' => 'dark'])
        <button type="button" class="sidebar-close-btn" id="sidebarClose" aria-label="Tutup Menu">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <nav class="sidebar-nav">
        <a href="{{ url('/admin/dashboard') }}" class="nav-item">
          <i class="fa-solid fa-table-cells-large"></i> Dashboard
        </a>
        <a href="{{ url('/admin/data-buku') }}" class="nav-item">
          <i class="fa-solid fa-book-open"></i> Book Management
        </a>
        <a href="{{ url('/admin/data-anggota') }}" class="nav-item">
          <i class="fa-solid fa-users"></i> Member Management
        </a>
        <a href="{{ url('/admin/transaksi') }}" class="nav-item">
          <i class="fa-solid fa-arrow-right-arrow-left"></i> Transactions
        </a>
        <a href="{{ url('/admin/kategori') }}" class="nav-item active">
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
      <div style="display: flex; align-items: center; gap: 10px;">
        <button type="button" class="btn-sidebar-toggle" id="sidebarToggle" aria-label="Menu Navigasi">
          <i class="fa-solid fa-bars"></i>
        </button>
        <a href="{{ url('/') }}" class="btn-back-home">
          <i class="fa-solid fa-house"></i> <span class="hide-mobile-text">Kembali ke Beranda</span>
        </a>
      </div>
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
          <h1>Category Management</h1>
          <p>Kelola seluruh kategori buku yang terhubung ke navbar dan koleksi perpustakaan.</p>
        </div>

        <div class="page-buttons">
          <button type="button" id="btnBulkDelete" class="btn-danger-bulk" onclick="submitBulkDelete()">
            <i class="fa-regular fa-trash-can"></i> Hapus Terpilih (<span id="selectedCount">0</span>)
          </button>
          <button class="btn-primary" onclick="openAddModal()">
            <i class="fa-solid fa-plus"></i> Tambah Kategori
          </button>
        </div>
      </div>

      <div class="dashboard-panel">
        <div class="inventory-filter-bar">
          <form action="{{ url('/admin/kategori') }}" method="GET" style="display:flex; gap:10px;">
            <input type="text" name="search" value="{{ request('search') }}" class="table-search-input" placeholder="Cari nama kategori...">
            <button type="submit" class="btn-secondary"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
          </form>
        </div>

        <form id="bulkDeleteForm" action="{{ route('admin.categories.bulkDestroy') }}" method="POST">
          @csrf
          <div class="table-responsive">
            <table class="custom-table">
              <thead>
                <tr>
                  <th width="30"><input type="checkbox" id="selectAll"></th>
                  <th>Nama Kategori</th>
                  <th>Slug URL</th>
                  <th>Jumlah Koleksi Buku</th>
                  <th width="90">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($categories as $cat)
                  <tr>
                    <td>
                      <input type="checkbox" name="ids[]" value="{{ $cat->id }}" class="cat-check" onchange="updateSelectedCount()">
                    </td>
                    <td>
                      <strong style="color:var(--primary); font-size:14px;">{{ $cat->name }}</strong>
                    </td>
                    <td style="color:var(--text-muted);">{{ $cat->slug }}</td>
                    <td>
                      <span class="badge-count">{{ $cat->books_count ?? 0 }} Buku</span>
                    </td>
                    <td>
                      <button type="button" class="icon-btn" title="Edit" data-category='@json($cat)' onclick="openEditModalFromButton(this)">
                        <i class="fa-regular fa-pen-to-square"></i>
                      </button>

                      <button type="button" class="icon-btn" title="Hapus" style="color:#ef4444;" onclick="deleteCategory({{ $cat->id }})">
                        <i class="fa-regular fa-trash-can"></i>
                      </button>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" style="text-align:center; padding:30px; color:#64748b;">
                      Belum ada data kategori.
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

        <div style="margin-top:20px;">
          {{ $categories->links() }}
        </div>
      </div>
    </main>
  </div>

  <!-- MODAL TAMBAH KATEGORI -->
  <div class="modal-backdrop" id="addModal">
    <div class="modal-box">
      <div class="modal-header">
        <h3>Tambah Kategori Baru</h3>
        <button type="button" class="icon-btn" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button>
      </div>

      <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label>Nama Kategori</label>
          <input type="text" name="name" class="form-control" placeholder="Contoh: Otomotif, Robotika, dll" required autofocus>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-secondary" onclick="closeModal('addModal')">Batal</button>
          <button type="submit" class="btn-primary">Simpan Kategori</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL EDIT KATEGORI -->
  <div class="modal-backdrop" id="editModal">
    <div class="modal-box">
      <div class="modal-header">
        <h3>Edit Kategori</h3>
        <button type="button" class="icon-btn" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button>
      </div>

      <form id="editForm" method="POST">
        @csrf
        <div class="form-group">
          <label>Nama Kategori</label>
          <input type="text" id="edit_name" name="name" class="form-control" required>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-secondary" onclick="closeModal('editModal')">Batal</button>
          <button type="submit" class="btn-primary">Update Kategori</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const selectAll = document.getElementById('selectAll');
    const catCheckboxes = document.querySelectorAll('.cat-check');
    const btnBulk = document.getElementById('btnBulkDelete');
    const countSpan = document.getElementById('selectedCount');

    if (selectAll) {
      selectAll.addEventListener('change', function() {
        catCheckboxes.forEach(cb => cb.checked = selectAll.checked);
        updateSelectedCount();
      });
    }

    function updateSelectedCount() {
      const checked = document.querySelectorAll('.cat-check:checked');
      countSpan.textContent = checked.length;
      btnBulk.style.display = checked.length > 0 ? 'flex' : 'none';
      if (checked.length === 0 && selectAll) selectAll.checked = false;
    }

    function submitBulkDelete() {
      const count = document.querySelectorAll('.cat-check:checked').length;
      if (count === 0) return;
      if (confirm('Hapus ' + count + ' kategori yang dipilih?')) {
        document.getElementById('bulkDeleteForm').submit();
      }
    }

    function deleteCategory(id) {
      if (confirm('Yakin ingin menghapus kategori ini?')) {
        const form = document.getElementById('singleDeleteForm');
        form.action = '/admin/kategori/hapus/' + id;
        form.submit();
      }
    }

    function openAddModal() {
      document.getElementById('addModal').classList.add('show');
    }

    function openEditModalFromButton(btn) {
      try {
        const raw = btn.getAttribute('data-category');
        if (!raw) return;
        const cat = typeof raw === 'string' ? JSON.parse(raw) : raw;
        openEditModal(cat);
      } catch (e) {
        console.error("Error parsing category data:", e);
      }
    }

    function openEditModal(cat) {
      document.getElementById('editForm').action = '/admin/kategori/update/' + cat.id;
      document.getElementById('edit_name').value = cat.name;
      document.getElementById('editModal').classList.add('show');
    }

    function closeModal(id) {
      document.getElementById(id).classList.remove('show');
      document.body.style.overflow = '';
    }

    // Close modal when clicking backdrop
    document.querySelectorAll('.modal-backdrop').forEach(modal => {
      modal.addEventListener('click', function(e) {
        if (e.target === this) {
          closeModal(this.id);
        }
      });
    });

    // Mobile Sidebar Drawer
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');
    const sidebar = document.querySelector('.sidebar');

    if (sidebarToggle && sidebar) {
      sidebarToggle.addEventListener('click', () => {
        sidebar.classList.add('show');
        if (sidebarBackdrop) sidebarBackdrop.classList.add('show');
        document.body.style.overflow = 'hidden';
      });
    }

    function closeMobileSidebar() {
      if (sidebar) sidebar.classList.remove('show');
      if (sidebarBackdrop) sidebarBackdrop.classList.remove('show');
      document.body.style.overflow = '';
    }

    if (sidebarClose) sidebarClose.addEventListener('click', closeMobileSidebar);
    if (sidebarBackdrop) sidebarBackdrop.addEventListener('click', closeMobileSidebar);
  </script>

  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
</body>
</html>
