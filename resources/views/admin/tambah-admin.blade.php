<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Admin - Admin SMKN 2 Purwakarta</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    /* VARIABEL & RESET DASAR */
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

    /* MAIN WRAPPER & HEADER */
    .main-wrapper { margin-left:260px; flex:1; display:flex; flex-direction:column; min-width:0; }
    .top-header { height:70px; background-color:var(--white); border-bottom:1px solid var(--border); display:flex; flex-direction:row; align-items:center; justify-content:space-between; padding:0 36px; position:sticky; top:0; z-index:90; }

    .btn-back-home { display:inline-flex; align-items:center; gap:8px; padding:8px 16px; background:#f8fafc; border:1px solid var(--border); border-radius:8px; font-size:13px; font-weight:700; color:var(--primary); transition:0.2s; }
    .btn-back-home:hover { background:var(--primary); color:#ffffff; border-color:var(--primary); }

    /* CONTENT BODY */
    .content-body { padding:32px 36px; }
    .page-header { display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:28px; }
    .page-title h1 { font-size:26px; font-weight:800; letter-spacing:-0.5px; }
    .page-title p { font-size:13px; color:var(--text-muted); margin-top:4px; }

    .btn-primary { padding:10px 18px; background:var(--primary); color:var(--white); border:none; border-radius:6px; font-size:13px; font-weight:700; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:6px; transition:0.2s; }
    .btn-primary:hover { background-color:var(--primary-dark); }

    /* GRID & CARDS */
    .admin-grid { display:grid; grid-template-columns:1.6fr 1.4fr; gap:24px; align-items:start; }
    .panel-card { background:var(--white); border:1px solid var(--border); border-radius:14px; padding:24px; }

    .panel-header-custom { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom:1px solid var(--border); padding-bottom:16px; }
    .panel-header-custom h3 { font-size:17px; font-weight:800; display:flex; align-items:center; gap:8px; }
    .badge-count { background:#f1f5f9; color:var(--text-muted); font-size:12px; font-weight:700; padding:4px 10px; border-radius:20px; }

    .modal-backdrop {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.modal-backdrop.show {
    display: flex;
}
.modal-box {
    background: #fff;
    border-radius: 12px;
    width: 100%;
    max-width: 520px;
    max-height: 90vh;
    overflow-y: auto;
    padding: 28px;
}
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    border-bottom: 1px solid var(--border);
    padding-bottom: 12px;
}
.modal-header h3 {
    font-size: 18px;
    font-weight: 800;
}
.close-modal-btn {
    background: none;
    border: none;
    font-size: 24px;
    color: #64748b;
    cursor: pointer;
    padding: 0 8px;
}
.close-modal-btn:hover {
    color: var(--text-main);
}
.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
    border-top: 1px solid var(--border);
    padding-top: 16px;
}
.btn-secondary {
    padding: 9px 16px;
    background: #64748b;
    color: var(--white);
    border: none;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
}
.btn-secondary:hover {
    background: #475569;
}

    /* TABLE */
    .table-responsive { width:100%; overflow-x:auto; }
    .custom-table { width:100%; border-collapse:collapse; font-size:13px; }
    .custom-table th { text-align:left; padding:12px 14px; color:var(--text-muted); font-size:11.5px; font-weight:700; border-bottom:1px solid var(--border); }
    .custom-table td { padding:14px; border-bottom:1px solid #f1f5f9; vertical-align:middle; }

    .admin-cell-info { display:flex; align-items:center; gap:12px; }
    .avatar-sm { width:36px; height:36px; border-radius:50%; background:#dcfce7; color:var(--primary); display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:800; }
    .avatar-super { background:var(--accent-yellow); color:#000; }

    .role-badge { padding:4px 10px; border-radius:20px; font-size:11px; font-weight:700; display:inline-block; }
    .role-super { background:#fef3c7; color:#92400e; }
    .role-admin { background:#e0f2fe; color:#0369a1; }

    /* FORM STYLES */
    .form-group { margin-bottom:16px; }
    .form-group label { display:block; font-size:12.5px; font-weight:700; margin-bottom:6px; color:#334155; }
    .form-control { width:100%; padding:10px 14px; font-size:13px; border:1px solid var(--border); border-radius:8px; outline:none; transition:0.2s; background-color:#f8fafc; }
    .form-control:focus { border-color:var(--primary); background-color:var(--white); box-shadow:0 0 0 3px rgba(12, 77, 45, 0.1); }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
    .form-footer { margin-top:24px; padding-top:20px; border-top:1px solid var(--border); }

    .alert-success { background:#d1fae5; border:1px solid #a7f3d0; color:#065f46; padding:12px 18px; border-radius:8px; margin-bottom:20px; font-weight:700; font-size:13px; display:flex; align-items:center; gap:8px; }

    /* DROPDOWN ADMIN (Reused) */
    .admin-dropdown-wrapper { position:relative; padding-bottom:12px; margin-bottom:-12px; }
    .admin-dropdown-wrapper:hover .fa-chevron-down { transform:rotate(180deg); color:var(--primary); }
    .admin-dropdown-menu { display:none; position:absolute; top:100%; right:0; background-color:#ffffff; min-width:220px; box-shadow:0 12px 30px rgba(0,0,0,0.15); border-radius:10px; border:1px solid var(--border); z-index:10000; margin-top:6px; }
    .admin-dropdown-menu::before { content:''; position:absolute; top:-12px; left:0; width:100%; height:12px; }
    .admin-dropdown-wrapper:hover .admin-dropdown-menu { display:block; }
    .admin-dropdown-item { display:flex; align-items:center; gap:12px; padding:10px 18px; font-size:13px; font-weight:600; color:#334155; transition:0.2s; }
    .admin-dropdown-item:hover { background-color:#f1f5f9; color:var(--primary); padding-left:22px; }

    /* RESPONSIVE MOBILE & DRAWER */
    .btn-sidebar-toggle { display: none; background: none; border: 1px solid var(--border); border-radius: 8px; padding: 8px 12px; font-size: 16px; color: var(--text-main); cursor: pointer; align-items: center; justify-content: center; transition: 0.2s; }
    .btn-sidebar-toggle:hover { background: #f1f5f9; }
    .sidebar-backdrop { display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.45); z-index: 998; backdrop-filter: blur(2px); }
    .sidebar-backdrop.show { display: block; }
    .sidebar-close-btn { display: none; background: none; border: none; font-size: 20px; color: var(--text-muted); cursor: pointer; padding: 4px 8px; margin-left: auto; }
    .sidebar-close-btn:hover { color: var(--text-main); }

    @media (max-width:1024px) {
      .admin-grid { grid-template-columns:1fr; }
    }

    @media (max-width: 992px) {
      .sidebar { transform: translateX(-100%); transition: transform 0.3s ease-in-out; z-index: 999; box-shadow: 0 10px 30px rgba(0,0,0,0.15); }
      .sidebar.show { transform: translateX(0); }
      .sidebar-close-btn { display: block; }
      .main-wrapper { margin-left: 0 !important; width: 100% !important; }
      .btn-sidebar-toggle { display: inline-flex; }
      .top-header { padding: 0 16px; gap: 10px; }
      .content-body { padding: 20px 16px; }
      .page-header { flex-direction: column; align-items: stretch; gap: 14px; }
    }

    @media (max-width: 640px) {
      .form-row { grid-template-columns: 1fr; }
      .hide-mobile-text { display: none; }
      .page-title h1 { font-size: 22px; }
      .modal-box { width: 95% !important; padding: 18px; }
      .action-buttons { flex-direction: row; }
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
        <a href="{{ url('/admin/kategori') }}" class="nav-item">
          <i class="fa-solid fa-tags"></i> Category Management
        </a>
        @if(auth()->user() && auth()->user()->role === 'superadmin')
        <a href="{{ url('/admin/tambah-admin') }}" class="nav-item active">
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

      @if(session('error'))
        <div class="alert-success" style="background:#fee2e2; border-color:#fecaca; color:#991b1b;">
          <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        </div>
      @endif

      @if($errors->any())
        <div class="alert-success" style="background:#fee2e2; border-color:#fecaca; color:#991b1b; display:block;">
          <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px; font-weight:800;">
            <i class="fa-solid fa-circle-exclamation"></i> Gagal Menyimpan Data:
          </div>
          <ul style="margin-left:24px; font-weight:600; font-size:12.5px;">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="page-header">
        <div class="page-title">
          <h1>Administrator Management</h1>
          <p>Kelola data admin yang memiliki akses ke sistem perpustakaan.</p>
        </div>
      </div>

      <!-- GRID LAYOUT -->
      <div class="admin-grid">

        <!-- KIRI: TABEL DAFTAR ADMIN -->
        <div class="panel-card">
    <div class="panel-header-custom">
        <h3><i class="fa-solid fa-users-gear" style="color:var(--primary);"></i> Daftar Administrator</h3>
        <span class="badge-count">Total: {{ isset($admins) ? $admins->count() : 0 }}</span>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>NAMA & EMAIL</th>
                    <th>USERNAME</th>
                    <th>LEVEL</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($admins) && $admins->count() > 0)
                    @foreach($admins as $admin)
                        <tr>
                            <td>
                                <div class="admin-cell-info">
                                    <div class="avatar-sm {{ $admin->role == 'superadmin' ? 'avatar-super' : '' }}">
                                        {{ strtoupper(substr($admin->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight:700; color:var(--text-main);">{{ $admin->name }}</div>
                                        <div style="font-size:11.5px; color:var(--text-muted);">{{ $admin->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-weight:600; color:#334155;">{{ $admin->username }}</td>
                            <td>
                                @if($admin->role == 'superadmin')
                                    <span class="role-badge role-super">Super Admin</span>
                                @else
                                    <span class="role-badge role-admin">Admin</span>
                                @endif
                            </td>
                            <td>
                                <div style="display:flex; gap:4px;">
                                    <button type="button" class="btn-primary" style="padding:6px 10px; font-size:11px; background:#f1f5f9; color:#334155; border:1px solid var(--border);" data-admin='@json($admin)' onclick="openEditModalFromButton(this)">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    @if($admin->role != 'superadmin' || $admins->where('role', 'superadmin')->count() > 1)
                                        <form action="{{ url('/admin/tambah-admin/' . $admin->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus admin ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="padding:6px 10px; font-size:11px; background:#fee2e2; color:#991b1b; border:1px solid #fecaca; border-radius:6px; cursor:pointer;">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" style="text-align:center; padding:30px; color:#64748b;">
                            <i class="fa-solid fa-user-slash" style="font-size:24px; display:block; margin-bottom:8px;"></i>
                            Belum ada admin terdaftar.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<!-- MODAL EDIT ADMIN -->
<div class="modal-backdrop" id="editAdminModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Edit Admin</h3>
            <button class="close-modal-btn" onclick="closeModal('editAdminModal')"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <form id="editAdminForm" action="" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" id="edit_name" class="form-control" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" id="edit_username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="edit_email" class="form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Password Baru (Kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password baru">
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password">
                </div>
            </div>

            <div class="form-group">
                <label>Level / Role Akses</label>
                <select name="role" id="edit_role" class="form-control" required>
                    <option value="admin">Administrator Biasa (Admin)</option>
                    <option value="superadmin">Super Administrator (Super Admin)</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal('editAdminModal')">Batal</button>
                <button type="submit" class="btn-primary"><i class="fa-solid fa-save"></i> Update Admin</button>
            </div>
        </form>
    </div>
</div>
        <!-- KANAN: FORM TAMBAH ADMIN -->
        <div class="panel-card">
          <div class="panel-header-custom">
            <h3><i class="fa-solid fa-user-plus" style="color:var(--primary);"></i> Tambah Admin Baru</h3>
          </div>

          <form action="{{ url('/admin/tambah-admin/simpan') }}" method="POST">
            @csrf

            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" name="name" class="form-control" placeholder="Contoh: Budi Santoso" required>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="budisantoso" required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="budi@smkn2pwk.sch.id" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
              </div>
              <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
              </div>
            </div>

            <div class="form-group">
              <label>Level / Role Akses</label>
              <select name="role" class="form-control" required>
                <option value="admin">Administrator Biasa (Admin)</option>
                <option value="superadmin">Super Administrator (Super Admin)</option>
              </select>
            </div>

            <div class="form-footer">
              <button type="submit" class="btn-primary" style="width:100%;">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Data Admin
              </button>
            </div>
          </form>
        </div>

      </div>
    </main>
  </div>

  <script>
    function openModal(id) {
      document.getElementById(id).classList.add('show');
      document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
      document.getElementById(id).classList.remove('show');
      document.body.style.overflow = '';
    }

    function openEditModalFromButton(btn) {
      try {
        const raw = btn.getAttribute('data-admin');
        if (!raw) return;
        const admin = typeof raw === 'string' ? JSON.parse(raw) : raw;
        openEditModal(admin);
      } catch (e) {
        console.error("Error parsing admin data:", e);
      }
    }

    function openEditModal(admin) {
      document.getElementById('editAdminForm').action = "{{ url('/admin/tambah-admin') }}/" + admin.id;
      document.getElementById('edit_name').value = admin.name || '';
      document.getElementById('edit_username').value = admin.username || '';
      document.getElementById('edit_email').value = admin.email || '';
      document.getElementById('edit_role').value = admin.role || 'admin';
      openModal('editAdminModal');
    }

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
