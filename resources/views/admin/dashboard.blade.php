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
      --bg-app: #f8fafc;
      --sidebar-bg: #f8fafc;
      --text-main: #0f172a;
      --text-muted: #64748b;
      --border: #e2e8f0;
      --white: #ffffff;
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

    /* TOP HEADER: SEJAJAR & FIXED DROPDOWN */
    .top-header { height:70px; background-color:var(--white); border-bottom:1px solid var(--border); display:flex; flex-direction:row; align-items:center; justify-content:space-between; padding:0 36px; position:sticky; top:0; z-index:90; }

    .btn-back-home { display:inline-flex; align-items:center; gap:8px; padding:8px 16px; background:#f8fafc; border:1px solid var(--border); border-radius:8px; font-size:13px; font-weight:700; color:var(--primary); transition:0.2s; }
    .btn-back-home:hover { background:var(--primary); color:#ffffff; border-color:var(--primary); }

    /* DROPDOWN ADMIN HEADER HOVER STYLES */
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

    .admin-dropdown-menu::before {
      content: '';
      position: absolute;
      top: -12px;
      left: 0;
      width: 100%;
      height: 12px;
    }

    .admin-dropdown-wrapper:hover .admin-dropdown-menu {
      display: block;
      animation: fadeInAdmin 0.2s ease forwards;
    }

    @keyframes fadeInAdmin {
      from { opacity: 0; transform: translateY(6px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .admin-dropdown-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 18px;
      font-size: 13px;
      font-weight: 600;
      color: #334155;
      transition: all 0.2s ease;
    }

    .admin-dropdown-item i { width: 16px; text-align: center; }
    .admin-dropdown-item:hover { background-color: #f1f5f9; color: var(--primary); padding-left: 22px; }


    /* CONTENT BODY */
    .content-body { padding:32px 36px; }
    .page-header { display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:28px; }
    .page-title h1 { font-size:26px; font-weight:800; letter-spacing:-0.5px; }
    .page-title p { font-size:13px; color:var(--text-muted); margin-top:4px; }
    .page-buttons { display:flex; gap:12px; }
    .btn-secondary { padding:9px 16px; background:var(--white); border:1px solid var(--border); border-radius:6px; font-size:13px; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:6px; }
    .btn-primary { padding:9px 16px; background:var(--primary); color:var(--white); border:none; border-radius:6px; font-size:13px; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px; }
    .btn-primary:hover { background-color:var(--primary-dark); }

    /* STAT CARDS */
    .stat-cards-grid { display:grid; grid-template-columns:repeat(4, 1fr); gap:20px; margin-bottom:28px; }
    .stat-card { background:var(--white); border-radius:12px; padding:20px; border:1px solid var(--border); position:relative; }
    .stat-card.card-green { border-top:4px solid #10b981; }
    .stat-card.card-yellow { border-top:4px solid var(--accent-yellow); }
    .stat-card.card-gray { border-top:4px solid #94a3b8; }
    .stat-card.card-red { border-top:4px solid #ef4444; }
    .stat-card-top { display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; }
    .stat-icon { width:38px; height:38px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:16px; }
    .icon-green { background-color:#d1fae5; color:#065f46; }
    .icon-yellow { background-color:#fef3c7; color:#92400e; }
    .icon-gray { background-color:#f1f5f9; color:#475569; }
    .icon-red { background-color:#fee2e2; color:#991b1b; }
    .badge-growth { font-size:11px; font-weight:700; padding:4px 8px; border-radius:20px; background:#f1f5f9; color:var(--text-muted); }
    .stat-card h4 { font-size:12px; color:var(--text-muted); font-weight:600; }
    .stat-card .stat-value { font-size:28px; font-weight:800; margin-top:4px; }

    /* DASHBOARD 2 COLUMNS */
    .dashboard-grid { display:grid; grid-template-columns:2fr 1fr; gap:24px; }
    .dashboard-panel { background:var(--white); border:1px solid var(--border); border-radius:12px; padding:24px; margin-bottom:24px; }
    .panel-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
    .panel-header h3 { font-size:16px; font-weight:800; }

    .table-responsive { width:100%; overflow-x:auto; }
    .custom-table { width:100%; border-collapse:collapse; font-size:13px; }
    .custom-table th { text-align:left; padding:12px 14px; color:var(--text-muted); font-size:12px; font-weight:700; border-bottom:1px solid var(--border); }
    .custom-table td { padding:14px; border-bottom:1px solid #f1f5f9; vertical-align:middle; }

    .badge-status { padding:4px 10px; border-radius:20px; font-size:11px; font-weight:800; display:inline-block; }
    .status-completed { background-color:#d1fae5; color:#065f46; }
    .status-active { background-color:#e0f2fe; color:#0369a1; }
    .status-overdue { background-color:#fee2e2; color:#991b1b; }

    .cat-progress-item { margin-bottom:16px; }
    .cat-progress-label { display:flex; justify-content:space-between; font-size:12.5px; font-weight:600; margin-bottom:6px; }
    .progress-bar-bg { width:100%; height:6px; background-color:#f1f5f9; border-radius:10px; overflow:hidden; }
    .progress-bar-fill { height:100%; background-color:var(--primary); border-radius:10px; }

    .system-status-box { background-color:var(--primary); color:var(--white); border-radius:12px; padding:20px; }
    .system-status-box h4 { font-size:14px; margin-bottom:8px; display:flex; align-items:center; gap:8px; }
    .system-status-box p { font-size:12px; color:#a7f3d0; margin-bottom:16px; line-height:1.5; }
    .btn-view-logs { background-color:var(--white); color:var(--primary); border:none; padding:8px 16px; border-radius:6px; font-size:12px; font-weight:700; cursor:pointer; }

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

    .alert-success { background:#d1fae5; border:1px solid #a7f3d0; color:#065f46; padding:12px 18px; border-radius:8px; margin-bottom:20px; font-weight:700; font-size:13px; }



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
    <!-- TOP HEADER DENGAN DROPDOWN ADMIN PAS -->
    <header class="top-header">
      <div style="display:flex; align-items:center; gap:12px;">
        <a href="{{ url('/') }}" class="btn-back-home">
          <i class="fa-solid fa-house"></i> <span>Kembali ke Beranda</span>
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

      <!-- STAT CARDS -->
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

      <!-- DASHBOARD 2 COLUMNS -->
      <div class="dashboard-grid">
        <!-- RECENT TRANSACTIONS TABLE REAL DATABASE -->
        <div class="dashboard-panel">
          <div class="panel-header">
            <h3>Recent Transactions</h3>
            <a href="{{ url('/admin/transaksi') }}" style="color:var(--primary); font-size:12px; font-weight:700;">View All Transactions <i class="fa-solid fa-arrow-right"></i></a>
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

        <!-- DATABASE CATEGORIES -->
        <div>
          <div class="dashboard-panel">
            <div class="panel-header">
              <h3>Database Categories</h3>
              <a href="{{ url('/admin/kategori') }}" style="color:var(--primary); font-size:12px; font-weight:700;">Manage <i class="fa-solid fa-arrow-right"></i></a>
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

  <!-- MODAL ADD MEMBER -->
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

  <!-- MODAL SYSTEM LOGS -->
  <div class="modal-backdrop" id="logsModal">
    <div class="modal-box" style="max-width:650px;">
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
                  <td style="font-size:11.5px; color:var(--text-muted);">{{ $log->created_at->diffForHumans() }}</td>
                  <td><strong style="color:var(--primary);">{{ $log->action }}</strong></td>
                  <td>{{ $log->user_name }}</td>
                  <td style="font-size:12px;">{{ $log->details }}</td>
                </tr>
              @endforeach
            @else
              <tr><td colspan="4" style="text-align:center; padding:20px;">Belum ada log aktivitas.</td></tr>
            @endif
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn-primary" onclick="closeModal('logsModal')">Tutup</button>
      </div>
    </div>
  </div>

  <script>
    function openModal(id) {
      document.getElementById(id).classList.add('show');
    }

    function closeModal(id) {
      document.getElementById(id).classList.remove('show');
    }
  </script>
</body>
</html>
