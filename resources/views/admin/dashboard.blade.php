<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Overview Dashboard - Admin SMKN 2 Purwakarta</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --primary: #0c4d2d;
      --primary-dark: #07351e;
      --accent-yellow: #facc15;
      --bg-app: #f6f8fb;
      --sidebar-bg: #ffffff;
      --text-main: #0f172a;
      --text-muted: #64748b;
      --border: #e8eef5;
      --white: #ffffff;
    }
    ::-webkit-scrollbar {
        width: 0px;
        background: transparent;
    }

    * {
        scrollbar-width: none;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
    body { background-color:var(--bg-app); color:var(--text-main); display:flex; min-height:100vh; overflow-x:hidden; }

    /* SIDEBAR */
    .sidebar { width: 260px; background-color: var(--sidebar-bg); border-right: 1px solid var(--border); display: flex; flex-direction: column; justify-content: space-between; height: 100vh; position: fixed; left: 0; top: 0; z-index: 100; }
    .sidebar-top { padding: 24px 20px; }
    .sidebar-brand { display: flex; align-items: center; gap: 12px; margin-bottom: 28px; }

    .sidebar-nav { display: flex; flex-direction: column; gap: 4px; }
    .nav-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; font-size: 13.5px; font-weight: 600; color: #334155; border-radius: 8px; transition: 0.2s; text-decoration: none; }
    .nav-item:hover { background-color: #f4f6fa; }
    .nav-item.active { background-color: #ecfdf5; color: var(--primary); font-weight: 800; }
    .sidebar-bottom { padding: 20px; border-top: 1px solid var(--border); display: flex; flex-direction: column; gap: 4px; }

    /* MAIN WRAPPER */
    .main-wrapper { margin-left:260px; flex:1; display:flex; flex-direction:column; min-width:0; }

    /* TOP HEADER (Disamakan persis dengan page lain agar tidak mepet) */
    .top-header { height: 70px; background-color: var(--white); border-bottom: 1px solid var(--border); display: flex; flex-direction: row; align-items: center; justify-content: space-between; padding: 0 36px; position: sticky; top: 0; z-index: 90; }
    .btn-back-home { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; background: #f4f6fa; border: 1px solid var(--border); border-radius: 8px; font-size: 13px; font-weight: 700; color: var(--primary); transition: 0.2s; text-decoration: none; }
    .btn-back-home:hover { background: var(--primary); color: #ffffff; border-color: var(--primary); }

    /* DROPDOWN ADMIN HEADER */
    .admin-dropdown-wrapper { position: relative; padding-bottom: 12px; margin-bottom: -12px; cursor: pointer; }
    .admin-dropdown-wrapper:hover .fa-chevron-down { transform: rotate(180deg); color: var(--primary); transition: 0.3s; }
    .admin-dropdown-menu { display: none; position: absolute; top: 100%; right: 0; background-color: #ffffff; min-width: 220px; box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15); border-radius: 10px; border: 1px solid var(--border); z-index: 10000; margin-top: 6px; }
    .admin-dropdown-menu::before { content: ''; position: absolute; top: -12px; left: 0; width: 100%; height: 12px; }
    .admin-dropdown-wrapper:hover .admin-dropdown-menu { display: block; animation: fadeInAdmin 0.2s ease forwards; }
    @keyframes fadeInAdmin { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
    .admin-dropdown-item { display: flex; align-items: center; gap: 12px; padding: 10px 18px; font-size: 13px; font-weight: 600; color: #334155; transition: all 0.2s ease; text-decoration: none; }
    .admin-dropdown-item i { width: 16px; text-align: center; }
    .admin-dropdown-item:hover { background-color: #f1f5f9; color: var(--primary); padding-left: 22px; }

    /* CONTENT BODY */
    .content-body { padding: 32px 36px; }
    .page-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 28px; }
    .page-title h1 { font-size: 26px; font-weight: 800; letter-spacing: -0.5px; }
    .page-title p { font-size: 13px; color: var(--text-muted); margin-top: 4px; }
    .page-buttons { display: flex; gap: 12px; }

    /* BUTTONS */
    .btn-secondary { padding: 9px 16px; background: var(--white); border: 1px solid var(--border); border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 6px; text-decoration: none; color: var(--text-main); transition: 0.2s; }
    .btn-secondary:hover { background: #f4f6fa; }
    .btn-primary { padding: 9px 16px; background: var(--primary); color: var(--white); border: none; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 6px; transition: 0.2s; }
    .btn-primary:hover { background-color: var(--primary-dark); }

    /* ICON BUTTON (CLOSE MODAL) */
    .icon-btn { background: none; border: none; font-size: 18px; color: var(--text-muted); cursor: pointer; transition: 0.2s; display: flex; align-items: center; justify-content: center; }
    .icon-btn:hover { color: #ef4444; transform: scale(1.1); }

    /* STAT CARDS */
    .stat-cards-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 28px; }
    .stat-card { background: var(--white); border-radius: 10px; padding: 20px; border: 1px solid var(--border); position: relative; }
    .stat-card-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
    .stat-icon { width: 38px; height: 38px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 16px; }
    .icon-green { background-color: #ecfdf5; color: #059669; }
    .icon-yellow { background-color: #fef9c3; color: #ca8a04; }
    .icon-gray { background-color: #f4f6fa; color: #64748b; }
    .icon-red { background-color: #fef2f2; color: #dc2626; }
    .badge-growth { font-size: 11px; font-weight: 700; padding: 4px 8px; border-radius: 20px; background: #f4f6fa; color: var(--text-muted); }
    .stat-card h4 { font-size: 12px; color: var(--text-muted); font-weight: 600; }
    .stat-card .stat-value { font-size: 26px; font-weight: 800; margin-top: 4px; }

    /* DASHBOARD 2 COLUMNS */
    .dashboard-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; }
    .dashboard-panel { background: var(--white); border: 1px solid var(--border); border-radius: 10px; padding: 24px; margin-bottom: 24px; }
    .panel-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .panel-header h3 { font-size: 16px; font-weight: 800; }

    .table-responsive { width: 100%; overflow-x: auto; }
    .custom-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .custom-table th { text-align: left; padding: 12px 14px; color: #94a3b8; font-size: 11.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.4px; border-bottom: 1px solid var(--border); }
    .custom-table td { padding: 14px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .custom-table tbody tr:hover { background: #fafbfd; }

    .badge-status { padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 800; display: inline-block; }
    .status-completed { background-color: #d1fae5; color: #065f46; }
    .status-active { background-color: #e0f2fe; color: #0369a1; }
    .status-overdue { background-color: #fee2e2; color: #991b1b; }

    .cat-progress-item { margin-bottom: 16px; }
    .cat-progress-label { display: flex; justify-content: space-between; font-size: 12.5px; font-weight: 600; margin-bottom: 6px; }
    .progress-bar-bg { width: 100%; height: 6px; background-color: #f4f6fa; border-radius: 10px; overflow: hidden; }
    .progress-bar-fill { height: 100%; background-color: var(--primary); border-radius: 10px; }

    .system-status-box { background-color: #ecfdf5; border: 1px solid #a7f3d0; color: var(--primary); border-radius: 10px; padding: 20px; }
    .system-status-box h4 { font-size: 14px; margin-bottom: 8px; display: flex; align-items: center; gap: 8px; }
    .system-status-box p { font-size: 12px; color: #475569; margin-bottom: 16px; line-height: 1.5; }
    .btn-view-logs { background-color: var(--primary); color: var(--white); border: none; padding: 8px 16px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer; transition: 0.2s; }
    .btn-view-logs:hover { background-color: var(--primary-dark); }

    /* MODAL */
    .modal-backdrop { display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.55); z-index: 9999; align-items: center; justify-content: center; padding: 20px; }
    .modal-backdrop.show { display: flex; }
    .modal-box { background: #fff; border-radius: 12px; width: 100%; max-width: 560px; max-height: 90vh; overflow-y: auto; padding: 28px; border: 1px solid var(--border); }
    .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid var(--border); padding-bottom: 16px; }
    .modal-header h3 { font-size: 18px; font-weight: 800; }
    .form-group { margin-bottom: 16px; }
    .form-group label { display: block; font-size: 12px; font-weight: 700; margin-bottom: 6px; color: #334155; }
    .form-control { width: 100%; padding: 10px 12px; font-size: 13px; border: 1px solid var(--border); border-radius: 8px; outline: none; background: #ffffff; transition: 0.2s; }
    .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(12, 77, 45, 0.08); }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .modal-footer { display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px; border-top: 1px solid var(--border); padding-top: 16px; }

    .alert-success { background: #d1fae5; border: 1px solid #a7f3d0; color: #065f46; padding: 12px 18px; border-radius: 8px; margin-bottom: 20px; font-weight: 700; font-size: 13px; }

    /* RESPONSIVE MOBILE & DRAWER */
    .btn-sidebar-toggle { display: none; background: none; border: 1px solid var(--border); border-radius: 8px; padding: 8px 12px; font-size: 16px; color: var(--text-main); cursor: pointer; align-items: center; justify-content: center; transition: 0.2s; }
    .btn-sidebar-toggle:hover { background: #f1f5f9; }
    .sidebar-backdrop { display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.45); z-index: 998; }
    .sidebar-backdrop.show { display: block; }
    .sidebar-close-btn { display: none; background: none; border: none; font-size: 20px; color: var(--text-muted); cursor: pointer; padding: 4px 8px; margin-left: auto; }
    .sidebar-close-btn:hover { color: var(--text-main); }

    @media (max-width: 1024px) {
      .stat-cards-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
      .dashboard-grid { grid-template-columns: 1fr; }
    }

    /* COMPACT MOBILE: SEMUA ELEMEN KECIL MENYESUAIKAN LAYAR */
    @media (max-width: 767px) {
      .top-header { height: 58px; padding: 0 12px; }
      .content-body { padding: 14px 12px; }
      .page-header { margin-bottom: 16px; }
      .page-title h1 { font-size: 19px; }
      .page-title p { font-size: 12px; margin-top: 2px; }
      .page-buttons { gap: 8px; flex-wrap: wrap; width: 100%; }
      .btn-primary, .btn-secondary { padding: 7px 12px; font-size: 12px; flex: 1; justify-content: center; text-align: center; }
      .btn-back-home { padding: 6px 12px; font-size: 12px; }
      .stat-cards-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; margin-bottom: 16px; }
      .stat-card { padding: 14px; border-radius: 10px; }
      .stat-card-top { margin-bottom: 10px; }
      .stat-icon { width: 30px; height: 30px; font-size: 13px; border-radius: 8px; }
      .badge-growth { font-size: 9.5px; padding: 3px 6px; }
      .stat-card h4 { font-size: 11px; }
      .stat-card .stat-value { font-size: 20px; }
      .dashboard-grid { gap: 14px; }
      .dashboard-panel { padding: 16px; border-radius: 10px; margin-bottom: 16px; }
      .panel-header { margin-bottom: 14px; }
      .panel-header h3 { font-size: 14.5px; }
      .custom-table th { padding: 8px 10px; font-size: 10.5px; }
      .custom-table td { padding: 10px; font-size: 12px; }
      .cat-progress-item { margin-bottom: 12px; }
      .cat-progress-label { font-size: 12px; }
      .system-status-box { padding: 16px; }
      .btn-view-logs { padding: 7px 12px; font-size: 11.5px; }
      .modal-box { padding: 20px; }
      .form-control { padding: 8px 10px; font-size: 12.5px; }
      .alert-success { padding: 10px 14px; font-size: 12px; margin-bottom: 16px; }
      .admin-dropdown-menu { min-width: 190px; }
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
      .page-buttons { width: 100%; flex-wrap: wrap; }
      .page-buttons .btn-primary, .page-buttons .btn-secondary { flex: 1; justify-content: center; text-align: center; }
    }

    @media (max-width: 640px) {
      .stat-cards-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
      .form-row { grid-template-columns: 1fr; }
      .hide-mobile-text { display: none; }
      .page-title h1 { font-size: 18px; }
      .modal-box { width: 95% !important; padding: 18px; }
    }
  </style>
  <link rel="stylesheet" href="{{ asset('asset/css/admin-mobile.css') }}?v={{ time() }}">
</head>
<body>

  <aside class="sidebar">
    <div class="sidebar-top">
      <div class="sidebar-brand">
        @include('partials.logo', ['theme' => 'dark'])
        <button type="button" class="sidebar-close-btn" id="sidebarClose" aria-label="Tutup Menu">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <nav class="sidebar-nav">
        <a href="{{ url('/admin/dashboard') }}" class="nav-item active">
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
          <h1>Overview Dashboard</h1>
          <p>Today's library activity and key metrics.</p>
        </div>
        <div class="page-buttons">
          <a href="{{ url('/admin/kategori') }}" class="btn-secondary"><i class="fa-solid fa-tag"></i> Manage Categories</a>
          <button class="btn-secondary" onclick="openModal('addMemberModal')"><i class="fa-solid fa-user-plus"></i> New Member</button>
          <button class="btn-primary" onclick="openModal('addBookModal')"><i class="fa-solid fa-plus"></i> Add Book</button>
        </div>
      </div>

      <div class="stat-cards-grid">
        <div class="stat-card card-green">
          <div class="stat-card-top">
            <div class="stat-icon icon-green"><i class="fa-solid fa-book"></i></div>
            <span class="badge-growth">Total</span>
          </div>
          <h4>Total Books</h4>
          <div class="stat-value">{{ number_format($totalBooks ?? 0) }}</div>
        </div>

        <div class="stat-card card-yellow">
          <div class="stat-card-top">
            <div class="stat-icon icon-yellow"><i class="fa-solid fa-users"></i></div>
            <span class="badge-growth">Active</span>
          </div>
          <h4>Active Members</h4>
          <div class="stat-value">{{ number_format($activeMembers ?? 0) }}</div>
        </div>

        <div class="stat-card card-gray">
          <div class="stat-card-top">
            <div class="stat-icon icon-gray"><i class="fa-solid fa-book-bookmark"></i></div>
            <span class="badge-growth">Current</span>
          </div>
          <h4>Books Loaned</h4>
          <div class="stat-value">{{ number_format($booksLoaned ?? 0) }}</div>
        </div>

        <div class="stat-card card-red">
          <div class="stat-card-top">
            <div class="stat-icon icon-red"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <span class="badge-growth" style="color:#ef4444;">Overdue</span>
          </div>
          <h4>Overdue Returns</h4>
          <div class="stat-value" style="color:#ef4444;">{{ number_format($overdueReturns ?? 0) }}</div>
        </div>
      </div>

      <div class="dashboard-grid">
        <div class="dashboard-panel">
          <div class="panel-header">
            <h3>Recent Transactions</h3>
            <a href="{{ url('/admin/transaksi') }}" style="color:var(--primary); font-size:12px; font-weight:700; text-decoration:none;">View All Transactions <i class="fa-solid fa-arrow-right"></i></a>
          </div>

          <div class="table-responsive">
            <table class="custom-table">
              <thead>
                <tr>
                  <th>Member</th>
                  <th>Book Title</th>
                  <th>Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @if(isset($recentTransactions) && count($recentTransactions) > 0)
                  @foreach($recentTransactions as $trx)
                    @php
                      $isOverdue = ($trx->status == 'borrowed' && $trx->due_date < now()->toDateString());
                    @endphp
                    <tr>
                      <td>
                        <div style="font-weight:700; color:#0f172a;">{{ $trx->user->name ?? 'User' }}</div>
                        <div style="font-size:11px; color:var(--text-muted);">{{ $trx->user->nomor_induk ?? '-' }}</div>
                      </td>
                      <td>
                        <div style="font-weight:700; color:var(--primary);">{{ $trx->book->title ?? 'Buku' }}</div>
                        <div style="font-size:11px; color:var(--text-muted);">{{ $trx->book->category ?? '-' }}</div>
                      </td>
                      <td>{{ $trx->loan_date }}</td>
                      <td>
                        @if($trx->status == 'returned')
                          <span class="badge-status status-completed">Completed</span>
                        @elseif($isOverdue)
                          <span class="badge-status status-overdue">Overdue</span>
                        @else
                          <span class="badge-status status-active">Active</span>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="4" style="text-align:center; padding:25px; color:var(--text-muted);">Belum ada riwayat transaksi peminjaman.</td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>

        <div>
          <div class="dashboard-panel">
            <div class="panel-header">
              <h3>Database Categories</h3>
              <a href="{{ url('/admin/kategori') }}" style="color:var(--primary); font-size:12px; font-weight:700; text-decoration:none;">Manage <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            @if(isset($categories) && count($categories) > 0)
              @foreach($categories as $cat)
                <div class="cat-progress-item">
                  <div class="cat-progress-label">
                    <span>{{ $cat->name }}</span>
                    <span>{{ $cat->books_count ?? 0 }} Buku</span>
                  </div>
                  <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: {{ ($totalBooks ?? 0) > 0 ? min(100, (($cat->books_count ?? 0) / $totalBooks) * 100) : 0 }}%;"></div>
                  </div>
                </div>
              @endforeach
            @else
              <p style="font-size:12px; color:var(--text-muted); padding:10px 0;">Belum ada kategori terdaftar.</p>
            @endif
          </div>

          <div class="system-status-box">
            <h4><i class="fa-solid fa-cloud"></i> System Status</h4>
            <p>All library systems and databases are operational. Last sync just now.</p>
            <button class="btn-view-logs" onclick="openModal('logsModal')">View Logs</button>
          </div>
        </div>
      </div>
    </main>
  </div>

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
              @if(isset($categories) && count($categories) > 0)
                @foreach($categories as $kat)
                  <option value="{{ $kat->name }}">{{ $kat->name }}</option>
                @endforeach
              @else
                <option value="Umum">Umum</option>
              @endif
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah Total Stok</label>
            <input type="number" name="stock_total" class="form-control" value="10" min="1" required>
          </div>
        </div>

        <div class="form-group">
          <label>Upload File Cover (Opsi 1)</label>
          <input type="file" name="cover_image" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
          <label>Atau Link URL Cover (Opsi 2)</label>
          <input type="url" name="cover_url_input" class="form-control" placeholder="https://images.unsplash.com/...">
        </div>

        <div class="form-group">
          <label>Deskripsi / Sinopsis Buku</label>
          <textarea name="description" class="form-control" rows="3" placeholder="Ringkasan isi buku..."></textarea>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-secondary" onclick="closeModal('addBookModal')">Batal</button>
          <button type="submit" class="btn-primary">Simpan Buku</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal-backdrop" id="addMemberModal">
    <div class="modal-box">
      <div class="modal-header">
        <h3>Daftarkan Anggota Baru</h3>
        <button type="button" class="icon-btn" onclick="closeModal('addMemberModal')"><i class="fa-solid fa-xmark"></i></button>
      </div>

      <form action="{{ route('admin.members.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Peran / Role</label>
            <select name="role" class="form-control">
              <option value="murid">Murid / Siswa</option>
              <option value="guru">Guru / Staf</option>
            </select>
          </div>
          <div class="form-group">
            <label>Nomor Induk (NIS / NIP)</label>
            <input type="text" name="nomor_induk" class="form-control" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
        </div>

        <div class="form-group">
          <label>Password Awal</label>
          <input type="password" name="password" class="form-control" value="password123" required>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-secondary" onclick="closeModal('addMemberModal')">Batal</button>
          <button type="submit" class="btn-primary">Daftarkan Anggota</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal-backdrop" id="logsModal">
    <div class="modal-box" style="max-width: 650px;">
      <div class="modal-header">
        <h3><i class="fa-solid fa-clock-rotate-left"></i> System Activity Logs</h3>
        <button type="button" class="icon-btn" onclick="closeModal('logsModal')"><i class="fa-solid fa-xmark"></i></button>
      </div>

      <div class="table-responsive">
        <table class="custom-table">
          <thead>
            <tr>
              <th>Time</th>
              <th>Action</th>
              <th>Actor</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            @if(isset($systemLogs) && count($systemLogs) > 0)
              @foreach($systemLogs as $log)
                <tr>
                  <td style="font-size: 11.5px; color: var(--text-muted);">{{ $log->created_at->diffForHumans() }}</td>
                  <td><strong style="color: var(--primary);">{{ $log->action }}</strong></td>
                  <td>{{ $log->user_name }}</td>
                  <td style="font-size: 12px;">{{ $log->details }}</td>
                </tr>
              @endforeach
            @else
              <tr><td colspan="4" style="text-align: center; padding: 20px;">Belum ada log aktivitas.</td></tr>
            @endif
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn-primary" onclick="closeModal('logsModal')">Tutup</button>
      </div>
    </div>
  </div>

  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

  <script>
    function openModal(id) {
      document.getElementById(id).classList.add('show');
      document.body.style.overflow = 'hidden';
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
</body>
</html>
