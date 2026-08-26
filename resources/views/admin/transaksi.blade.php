<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transactions - Admin SMKN 2 Purwakarta</title>

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

    /* STAT MINI CARDS */
    .stat-mini-grid { display:grid; grid-template-columns:repeat(4, 1fr); gap:16px; margin-bottom:24px; }
    .stat-mini-card { background:#fff; border:1px solid var(--border); border-radius:10px; padding:16px 20px; display:flex; justify-content:space-between; align-items:center; }
    .stat-mini-val { font-size:22px; font-weight:800; color:#0f172a; }
    .stat-mini-label { font-size:11.5px; color:var(--text-muted); font-weight:700; margin-top:2px; }

    /* PANEL */
    .dashboard-panel { background:var(--white); border:1px solid var(--border); border-radius:12px; padding:24px; }
    .inventory-filter-bar { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; gap:16px; flex-wrap:wrap; }
    .table-search-input { width:320px; padding:8px 14px; border:1px solid var(--border); border-radius:6px; font-size:13px; outline:none; }
    .btn-secondary { padding:8px 14px; background:var(--white); border:1px solid var(--border); border-radius:6px; font-size:13px; font-weight:600; cursor:pointer; }
    .filter-select { padding:8px 14px; border:1px solid var(--border); border-radius:6px; background-color:var(--white); font-size:13px; outline:none; }

    /* TABLE */
    .table-responsive { width:100%; overflow-x:auto; }
    .custom-table { width:100%; border-collapse:collapse; font-size:13px; }
    .custom-table th { text-align:left; padding:12px 14px; color:var(--text-muted); font-size:12px; font-weight:700; border-bottom:1px solid var(--border); }
    .custom-table td { padding:14px; border-bottom:1px solid #f1f5f9; vertical-align:middle; }

    /* STATUS BADGES */
    .badge-status { padding:4px 10px; border-radius:20px; font-size:11px; font-weight:800; display:inline-block; }
    .status-pending-borrow { background-color:#fef3c7; color:#92400e; }
    .status-pending-return { background-color:#e0f2fe; color:#0369a1; }
    .status-active { background-color:#d1fae5; color:#065f46; }
    .status-completed { background-color:#f1f5f9; color:#475569; }
    .status-overdue { background-color:#fee2e2; color:#991b1b; }
    .status-rejected { background-color:#f3f4f6; color:#9ca3af; text-decoration:line-through; }

    /* ACTION BUTTONS */
    .action-group { display:flex; gap:6px; align-items:center; }
    .btn-action-approve { padding:6px 12px; background:#0c4d2d; color:#fff; border:none; border-radius:6px; font-size:11.5px; font-weight:700; cursor:pointer; display:inline-flex; align-items:center; gap:4px; }
    .btn-action-approve:hover { background:#07351e; }
    .btn-action-reject { padding:6px 10px; background:#ef4444; color:#fff; border:none; border-radius:6px; font-size:11.5px; font-weight:700; cursor:pointer; }
    .btn-action-reject:hover { background:#dc2626; }
    .btn-action-verify { padding:6px 12px; background:#0284c7; color:#fff; border:none; border-radius:6px; font-size:11.5px; font-weight:700; cursor:pointer; display:inline-flex; align-items:center; gap:4px; }
    .btn-action-verify:hover { background:#0369a1; }

    /* PAGINATION RAK */
    .pagination-wrapper { display:flex; justify-content:space-between; align-items:center; margin-top:20px; padding-top:16px; border-top:1px solid var(--border); font-size:12.5px; color:var(--text-muted); }
    .pagination-pages { display:flex; align-items:center; gap:6px; }
    .page-btn { width:32px; height:32px; border-radius:6px; border:1px solid var(--border); background:var(--white); color:#334155; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:700; cursor:pointer; text-decoration:none; }
    .page-btn.active { background:var(--primary); color:var(--white); border-color:var(--primary); }
    .page-btn.disabled { color:#cbd5e1; cursor:not-allowed; background:#f8fafc; }
    .page-dots { padding:0 3px; color:var(--text-muted); font-weight:700; }

    .alert-success { background:#d1fae5; border:1px solid #a7f3d0; color:#065f46; padding:12px 18px; border-radius:8px; margin-bottom:20px; font-weight:700; font-size:13px; }
    .alert-error { background:#fee2e2; border:1px solid #fecaca; color:#991b1b; padding:12px 18px; border-radius:8px; margin-bottom:20px; font-weight:700; font-size:13px; }

    @media (max-width:992px) {
      .stat-mini-grid { grid-template-columns:1fr 1fr; }
    }
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
        <a href="{{ url('/admin/data-buku') }}" class="nav-item">
          <i class="fa-solid fa-book-open"></i> Book Management
        </a>
        <a href="{{ url('/admin/data-anggota') }}" class="nav-item">
          <i class="fa-solid fa-users"></i> Member Management
        </a>
        <a href="{{ url('/admin/transaksi') }}" class="nav-item active">
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

      @if(session('error'))
        <div class="alert-error">
          <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
        </div>
      @endif

      <div class="page-header">
        <div class="page-title">
          <h1>Sirkulasi & Validasi Transaksi</h1>
          <p>Tinjau dan sahkan permintaan peminjaman serta verifikasi pengembalian fisik buku.</p>
        </div>
      </div>

      <!-- STAT MINI CARDS -->
      <div class="stat-mini-grid">
        <div class="stat-mini-card">
          <div>
            <div class="stat-mini-val" style="color:#d97706;">{{ number_format($totalPendingBorrow) }}</div>
            <div class="stat-mini-label">Permintaan Pinjam</div>
          </div>
          <i class="fa-solid fa-hourglass-half" style="font-size:24px; color:#d97706;"></i>
        </div>

        <div class="stat-mini-card">
          <div>
            <div class="stat-mini-val" style="color:#0284c7;">{{ number_format($totalPendingReturn) }}</div>
            <div class="stat-mini-label">Permintaan Kembali</div>
          </div>
          <i class="fa-solid fa-rotate-left" style="font-size:24px; color:#0284c7;"></i>
        </div>

        <div class="stat-mini-card">
          <div>
            <div class="stat-mini-val" style="color:#059669;">{{ number_format($totalBorrowed) }}</div>
            <div class="stat-mini-label">Sedang Dipinjam</div>
          </div>
          <i class="fa-solid fa-book-bookmark" style="font-size:24px; color:#059669;"></i>
        </div>

        <div class="stat-mini-card">
          <div>
            <div class="stat-mini-val" style="color:#dc2626;">{{ number_format($totalOverdue) }}</div>
            <div class="stat-mini-label">Terlambat (Overdue)</div>
          </div>
          <i class="fa-solid fa-triangle-exclamation" style="font-size:24px; color:#dc2626;"></i>
        </div>
      </div>

      <div class="dashboard-panel">
        <!-- FILTER BAR -->
        <div class="inventory-filter-bar">
          <form action="{{ url('/admin/transaksi') }}" method="GET" style="display:flex; gap:10px;">
            <input type="text" name="search" value="{{ request('search') }}" class="table-search-input" placeholder="Cari peminjam, NIS, atau judul buku...">
            <button type="submit" class="btn-secondary"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
          </form>

          <div class="filter-actions">
            <select class="filter-select" onchange="location = this.value;">
              <option value="{{ url('/admin/transaksi') }}">Semua Status ({{ $totalTransactions }})</option>
              <option value="{{ url('/admin/transaksi?status=pending_borrow') }}" {{ request('status') == 'pending_borrow' ? 'selected' : '' }}>Menunggu Persetujuan Pinjam ({{ $totalPendingBorrow }})</option>
              <option value="{{ url('/admin/transaksi?status=pending_return') }}" {{ request('status') == 'pending_return' ? 'selected' : '' }}>Menunggu Verifikasi Kembali ({{ $totalPendingReturn }})</option>
              <option value="{{ url('/admin/transaksi?status=borrowed') }}" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Sedang Dipinjam Aktif ({{ $totalBorrowed }})</option>
              <option value="{{ url('/admin/transaksi?status=returned') }}" {{ request('status') == 'returned' ? 'selected' : '' }}>Selesai / Dikembalikan ({{ $totalReturned }})</option>
              <option value="{{ url('/admin/transaksi?status=overdue') }}" {{ request('status') == 'overdue' ? 'selected' : '' }}>Terlambat ({{ $totalOverdue }})</option>
            </select>
          </div>
        </div>

        <!-- TABEL TRANSAKSI -->
        <div class="table-responsive">
          <table class="custom-table">
            <thead>
              <tr>
                <th>ID PINJAM</th>
                <th>PEMINJAM</th>
                <th>BUKU</th>
                <th>TGL PENGAJUAN</th>
                <th>JATUH TEMPO</th>
                <th>STATUS SAAT INI</th>
                <th width="150">AKSI VALIDASI ADMIN</th>
              </tr>
            </thead>
            <tbody>
              @forelse($transactions as $trx)
                @php
                  $isOverdue = ($trx->status == 'borrowed' && $trx->due_date < now()->toDateString());
                @endphp
                <tr>
                  <td style="font-weight:700; color:var(--text-muted);">#TRX-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</td>
                  <td>
                    <div style="font-weight:700; color:#0f172a;">{{ $trx->user->name ?? 'User Dihapus' }}</div>
                    <div style="font-size:11.5px; color:var(--text-muted);">{{ $trx->user->nomor_induk ?? '-' }} • {{ ucfirst($trx->user->role ?? '-') }}</div>
                  </td>
                  <td>
                    <div style="font-weight:700; color:#0c4d2d;">{{ $trx->book->title ?? 'Buku Dihapus' }}</div>
                    <div style="font-size:11.5px; color:var(--text-muted);">{{ $trx->book->category ?? '-' }} (Tersedia: {{ $trx->book->stock_available ?? 0 }})</div>
                  </td>
                  <td>
                    <div>{{ $trx->loan_date }}</div>
                    <small style="font-size:11px; font-weight:700; color:var(--primary);"><i class="fa-regular fa-clock"></i> {{ $trx->duration ?? 7 }} Hari</small>
                  </td>

                  {{-- KOLOM JATUH TEMPO: HANYA MENAMPILKAN STATUS RAPI TANPA BOCOR --}}
                  <td>
                    @if($trx->status == 'pending_borrow')
                      <span style="color:#92400e; font-size:11.5px; font-weight:700;">Belum Berjalan</span>
                    @elseif($trx->status == 'rejected')
                      <span style="color:#9ca3af; font-size:11.5px;">-</span>
                    @else
                      <span style="color: {{ $isOverdue ? '#dc2626' : '#334155' }}; font-weight: {{ $isOverdue ? '800' : '600' }};">
                        {{ $trx->due_date }}
                      </span>
                    @endif
                  </td>

                  <td>
                    @if($trx->status == 'pending_borrow')
                      <div class="action-group">
                        <form action="{{ route('admin.transactions.approveBorrow', $trx->id) }}" method="POST" onsubmit="return confirm('Sahkan peminjaman buku ini?')">
                          @csrf
                          <button type="submit" class="btn-action-approve" title="Setujui Pinjam">
                            <i class="fa-solid fa-check"></i> Setujui
                          </button>
                        </form>

                        <form action="{{ route('admin.transactions.rejectBorrow', $trx->id) }}" method="POST" onsubmit="return confirm('Tolak pengajuan pinjaman ini?')">
                          @csrf
                          <button type="submit" class="btn-action-reject" title="Tolak">
                            <i class="fa-solid fa-xmark"></i>
                          </button>
                        </form>
                      </div>

                    @elseif($trx->status == 'pending_return')
                      <form action="{{ route('admin.transactions.approveReturn', $trx->id) }}" method="POST" onsubmit="return confirm('Verifikasi bahwa buku fisik sudah diterima dengan baik?')">
                        @csrf
                        <button type="submit" class="btn-action-verify" title="Verifikasi Buku Kembali">
                          <i class="fa-solid fa-box-archive"></i> Terima Buku
                        </button>
                      </form>

                    @elseif($trx->status == 'borrowed')
                      <form action="{{ route('admin.transactions.approveReturn', $trx->id) }}" method="POST" onsubmit="return confirm('Tandai buku sudah kembali sekarang?')">
                        @csrf
                        <button type="submit" class="btn-action-approve" style="background:#0284c7;" title="Tandai Kembali">
                          <i class="fa-solid fa-arrow-rotate-left"></i> Kembali
                        </button>
                      </form>

                    @elseif($trx->status == 'returned')
                      <span class="badge-status status-completed"><i class="fa-solid fa-check"></i> Selesai ({{ $trx->return_date }})</span>
                    @elseif($trx->status == 'rejected')
                      <span class="badge-status status-rejected">Ditolak</span>
                    @endif
                  </td>

                  <td>
                    @if($trx->status == 'returned')
                      <span style="font-size:12px; color:#94a3b8;"><i class="fa-solid fa-check-double"></i> Terverifikasi</span>
                    @elseif($trx->status == 'rejected')
                      <span style="font-size:12px; color:#9ca3af;">Dibatalkan</span>
                    @else
                      <span style="font-size:11.5px; color:#0284c7; font-weight:700;">Menunggu Aksi</span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" style="text-align:center; padding:30px; color:var(--text-muted);">
                    Belum ada riwayat transaksi peminjaman buku.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- PAGINATION RAK -->
        @if ($transactions->hasPages())
          <div class="pagination-wrapper">
            <div>
              Showing <strong>{{ $transactions->firstItem() ?? 0 }}</strong> to <strong>{{ $transactions->lastItem() ?? 0 }}</strong> of <strong>{{ number_format($transactions->total()) }}</strong> entries
            </div>

            <div class="pagination-pages">
              @if ($transactions->onFirstPage())
                <span class="page-btn disabled"><i class="fa-solid fa-chevron-left"></i></span>
              @else
                <a href="{{ $transactions->previousPageUrl() }}" class="page-btn"><i class="fa-solid fa-chevron-left"></i></a>
              @endif

              @foreach ($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                @if ($page == $transactions->currentPage())
                  <span class="page-btn active">{{ $page }}</span>
                @elseif ($page == 1 || $page == $transactions->lastPage() || ($page >= $transactions->currentPage() - 1 && $page <= $transactions->currentPage() + 1))
                  <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                @elseif ($page == 2 || $page == $transactions->lastPage() - 1)
                  <span class="page-dots">...</span>
                @endif
              @endforeach

              @if ($transactions->hasMorePages())
                <a href="{{ $transactions->nextPageUrl() }}" class="page-btn"><i class="fa-solid fa-chevron-right"></i></a>
              @else
                <span class="page-btn disabled"><i class="fa-solid fa-chevron-right"></i></span>
              @endif
            </div>
          </div>
        @endif
      </div>
    </main>
  </div>
</body>
</html>
