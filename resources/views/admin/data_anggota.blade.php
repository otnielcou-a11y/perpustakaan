<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Member Management - Admin SMKN 2 Purwakarta</title>

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
      --danger: #ef4444;
      --danger-dark: #dc2626;
      --warning: #f59e0b;
      --success: #10b981;
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
    .btn-primary { padding:9px 16px; background:var(--primary); color:var(--white); border:none; border-radius:6px; font-size:13px; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px; }
    .btn-primary:hover { background-color:var(--primary-dark); }
    .btn-danger { padding:9px 16px; background:var(--danger); color:var(--white); border:none; border-radius:6px; font-size:13px; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px; }
    .btn-danger:hover { background-color:var(--danger-dark); }
    .btn-warning { padding:9px 16px; background:var(--warning); color:var(--white); border:none; border-radius:6px; font-size:13px; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px; }
    .btn-warning:hover { background-color:#d97706; }
    .btn-secondary { padding:9px 16px; background:#64748b; color:var(--white); border:none; border-radius:6px; font-size:13px; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px; }
    .btn-secondary:hover { background-color:#475569; }

    .btn-sm { padding:4px 10px; font-size:12px; }
    .btn-edit { background:#e0f2fe; color:#0369a1; border:1px solid #bae6fd; }
    .btn-edit:hover { background:#bae6fd; }
    .btn-ban { background:#fee2e2; color:#991b1b; border:1px solid #fecaca; }
    .btn-ban:hover { background:#fecaca; }
    .btn-unban { background:#dcfce7; color:#15803d; border:1px solid #bbf7d0; }
    .btn-unban:hover { background:#bbf7d0; }

    /* MEMBER GRID */
    .member-grid { display:grid; grid-template-columns:1.8fr 1.2fr; gap:24px; align-items:start; }
    .panel-card { background:var(--white); border:1px solid var(--border); border-radius:14px; padding:24px; }

    .panel-header-custom { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
    .panel-header-custom h3 { font-size:17px; font-weight:800; }
    .badge-count { background:#f1f5f9; color:var(--text-muted); font-size:12px; font-weight:700; padding:4px 10px; border-radius:20px; }

    /* TABLE */
    .table-responsive { width:100%; overflow-x:auto; }
    .custom-table { width:100%; border-collapse:collapse; font-size:13px; }
    .custom-table th { text-align:left; padding:12px 14px; color:var(--text-muted); font-size:11.5px; font-weight:700; border-bottom:1px solid var(--border); }
    .custom-table td { padding:14px; border-bottom:1px solid #f1f5f9; vertical-align:middle; }

    .member-row { cursor:pointer; transition:background 0.2s; }
    .member-row:hover { background-color:#f8fafc; }
    .member-row.active-row { background-color:#ecfdf5; border-left:4px solid var(--primary); }
    .member-row.banned-row { background-color:#fef2f2; border-left:4px solid var(--danger); opacity:0.7; }

    .member-cell-info { display:flex; align-items:center; gap:12px; }
    .avatar-sm { width:34px; height:34px; border-radius:50%; background:#d1fae5; color:var(--primary); display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:800; }
    .avatar-sm.banned-avatar { background:#fecaca; color:#991b1b; }

    .badge-borrowed-count { padding:4px 10px; border-radius:20px; font-size:11px; font-weight:700; display:inline-block; }
    .borrow-active { background:#fee2e2; color:#991b1b; }
    .borrow-none { background:#f1f5f9; color:#64748b; }

    .status-badge { padding:4px 10px; border-radius:20px; font-size:11px; font-weight:700; display:inline-block; }
    .status-active { background:#dcfce7; color:#15803d; }
    .status-banned { background:#fee2e2; color:#991b1b; }

    .action-buttons { display:flex; gap:4px; flex-wrap:wrap; }

    /* PROFILE CARD */
    .profile-card-header { text-align:center; padding-bottom:20px; border-bottom:1px solid var(--border); }
    .avatar-lg { width:72px; height:72px; border-radius:14px; background:#d1fae5; color:var(--primary); display:inline-flex; align-items:center; justify-content:center; font-size:24px; font-weight:800; margin-bottom:12px; }
    .avatar-lg.banned-avatar-lg { background:#fecaca; color:#991b1b; }
    .profile-name { font-size:19px; font-weight:800; color:var(--text-main); margin-bottom:4px; }
    .profile-id-sub { font-size:12px; color:var(--text-muted); font-weight:600; margin-bottom:12px; }

    .status-tags { display:flex; justify-content:center; gap:8px; flex-wrap:wrap; }
    .tag-pill { font-size:11px; font-weight:700; padding:4px 10px; border-radius:6px; }
    .tag-active { background:#dcfce7; color:#15803d; }
    .tag-banned { background:#fee2e2; color:#991b1b; }
    .tag-action { background:#fee2e2; color:#b91c1c; }

    .section-sub-title { font-size:11px; font-weight:800; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; margin:20px 0 10px; }

    .contact-item { display:flex; align-items:center; gap:10px; font-size:13px; font-weight:600; color:#334155; margin-bottom:10px; }
    .contact-item i { color:var(--text-muted); font-size:14px; width:18px; }

    .activity-card { border:1px solid var(--border); border-radius:10px; padding:12px 14px; margin-bottom:10px; display:flex; align-items:center; gap:12px; }
    .activity-card.overdue-card { border-left:4px solid #ef4444; }
    .activity-card.active-card { border-left:4px solid var(--primary); }
    .activity-icon { font-size:18px; color:var(--primary); }

    .activity-info h5 { font-size:13px; font-weight:700; margin-bottom:2px; }
    .activity-info p { font-size:11px; color:var(--text-muted); font-weight:600; }

    .btn-full-history { width:100%; padding:10px; background:#f8fafc; border:1px solid var(--border); border-radius:8px; font-size:12px; font-weight:700; color:var(--text-main); margin-top:14px; cursor:pointer; }
    .btn-full-history:hover { background:#f1f5f9; }

    /* PAGINATION RAK */
    .pagination-wrapper { display:flex; justify-content:space-between; align-items:center; margin-top:20px; padding-top:16px; border-top:1px solid var(--border); font-size:12.5px; color:var(--text-muted); flex-wrap:wrap; gap:10px; }
    .pagination-pages { display:flex; align-items:center; gap:6px; flex-wrap:wrap; }
    .page-btn { width:32px; height:32px; border-radius:6px; border:1px solid var(--border); background:var(--white); color:#334155; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:700; cursor:pointer; transition:0.2s; text-decoration:none; }
    .page-btn:hover:not(.disabled):not(.active) { background:#f1f5f9; color:var(--primary); }
    .page-btn.active { background:var(--primary); color:var(--white); border-color:var(--primary); }
    .page-btn.disabled { color:#cbd5e1; cursor:not-allowed; background:#f8fafc; }
    .page-dots { padding:0 3px; color:var(--text-muted); font-weight:700; }

    /* MODAL */
    .modal-backdrop { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center; padding:20px; }
    .modal-backdrop.show { display:flex; }
    .modal-box { background:#fff; border-radius:12px; width:100%; max-width:520px; max-height:90vh; overflow-y:auto; padding:28px; }
    .modal-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom:1px solid var(--border); padding-bottom:12px; }
    .modal-header h3 { font-size:18px; font-weight:800; }
    .close-modal-btn { background:none; border:none; font-size:24px; color:#64748b; cursor:pointer; padding:0 8px; }
    .close-modal-btn:hover { color:var(--text-main); }
    .form-group { margin-bottom:14px; }
    .form-group label { display:block; font-size:12px; font-weight:700; margin-bottom:5px; }
    .form-control { width:100%; padding:9px 12px; font-size:13px; border:1px solid var(--border); border-radius:6px; outline:none; transition:0.2s; }
    .form-control:focus { border-color:var(--primary); box-shadow:0 0 0 3px rgba(12,77,45,0.1); }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    .modal-footer { display:flex; justify-content:flex-end; gap:10px; margin-top:20px; border-top:1px solid var(--border); padding-top:16px; flex-wrap:wrap; }

    .alert-success { background:#d1fae5; border:1px solid #a7f3d0; color:#065f46; padding:12px 18px; border-radius:8px; margin-bottom:20px; font-weight:700; font-size:13px; display:flex; align-items:center; gap:10px; }
    .alert-danger { background:#fee2e2; border:1px solid #fecaca; color:#991b1b; padding:12px 18px; border-radius:8px; margin-bottom:20px; font-weight:700; font-size:13px; display:flex; align-items:center; gap:10px; }

    .text-danger { color:var(--danger); }
    .text-success { color:var(--success); }
    .text-muted { color:var(--text-muted); }

    @media (max-width:1024px) {
      .member-grid { grid-template-columns:1fr; }
      .form-row { grid-template-columns:1fr; }
    }
    @media (max-width:768px) {
      .content-body { padding:20px 16px; }
      .top-header { padding:0 16px; }
      .sidebar { width:200px; }
      .main-wrapper { margin-left:200px; }
      .action-buttons { flex-direction:column; }
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
        <a href="{{ url('/admin/data-anggota') }}" class="nav-item active">
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

      @if(session('error'))
        <div class="alert-danger">
          <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        </div>
      @endif

      @if($errors->any())
        <div class="alert-danger" style="display:block;">
          <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
            <i class="fa-solid fa-circle-exclamation"></i> <span>Gagal Menyimpan Data:</span>
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
          <h1>Members</h1>
          <p>Manage library members, view borrowing history, and update details.</p>
        </div>
        <button class="btn-primary" onclick="openModal('addMemberModal')">
          <i class="fa-solid fa-user-plus"></i> New Member
        </button>
      </div>

      <!-- MEMBER 2 COLUMNS SPLIT -->
      <div class="member-grid">

        <!-- SISI KIRI: TABEL -->
        <div class="panel-card">
          <div class="panel-header-custom">
            <h3>Registered Members</h3>
            <span class="badge-count">Total: {{ number_format($totalMembers) }}</span>
          </div>

          <div class="table-responsive">
            <table class="custom-table">
              <thead>
                <tr>
                  <th>MEMBER ID</th>
                  <th>NAME</th>
                  <th>ROLE</th>
                  <th>STATUS</th>
                  <th>BORROWED</th>
                  <th>ACTIONS</th>
                </tr>
              </thead>
              <tbody>
                @forelse($members as $index => $member)
                  @php
                    $initials = strtoupper(substr($member->name, 0, 2));
                    $borrowedCount = $member->loans ? $member->loans->where('status', 'borrowed')->count() : 0;
                    $overdueCount = $member->loans ? $member->loans->where('status', 'borrowed')->where('due_date', '<', now())->count() : 0;
                    $isBanned = $member->status === 'banned';
                    $isAdmin = $member->role === 'admin';
                  @endphp
                  <tr class="member-row {{ $index === 0 && !$selectedMember ? 'active-row' : '' }} {{ $isBanned ? 'banned-row' : '' }}"
                      data-member='@json($member)'
                      onclick="showMemberDetailFromRow(this)">
                    <td style="font-weight:700; color:#334155;">{{ $member->nomor_induk ?? 'LIB-'.str_pad($member->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>
                      <div class="member-cell-info">
                        <div class="avatar-sm {{ $isBanned ? 'banned-avatar' : '' }}">{{ $initials }}</div>
                        <span style="font-weight:700;">{{ $member->name }}</span>
                      </div>
                    </td>
                    <td>
                      @if($member->role === 'admin')
                        <span class="status-badge" style="background:#e0f2fe; color:#0369a1;"><i class="fa-solid fa-user-shield"></i> Admin</span>
                      @elseif($member->role === 'superadmin')
                        <span class="status-badge" style="background:#fef3c7; color:#92400e;"><i class="fa-solid fa-crown"></i> Super Admin</span>
                      @else
                        <span style="color:var(--text-muted); font-weight:600;">{{ ucfirst($member->role) }}</span>
                      @endif
                    </td>
                    <td>
                      @if($isBanned)
                        <span class="status-badge status-banned"><i class="fa-solid fa-ban"></i> Banned</span>
                      @else
                        <span class="status-badge status-active"><i class="fa-solid fa-check-circle"></i> Active</span>
                      @endif
                    </td>
                    <td>
                      @if($overdueCount > 0)
                        <span class="badge-borrowed-count borrow-active">{{ $borrowedCount }} ({{ $overdueCount }} Overdue)</span>
                      @elseif($borrowedCount > 0)
                        <span class="badge-borrowed-count" style="background:#e0f2fe; color:#0369a1;">{{ $borrowedCount }} Active</span>
                      @else
                        <span class="badge-borrowed-count borrow-none">0</span>
                      @endif
                    </td>
                    <td>
                      <div class="action-buttons" onclick="event.stopPropagation();">
                        <button type="button" class="btn-primary btn-sm btn-edit" data-member='@json($member)' onclick="openEditModalFromButton(this)">
                          <i class="fa-solid fa-pen"></i>
                        </button>
                        @if($isBanned)
                          <button class="btn-primary btn-sm btn-unban" onclick="unbanMember({{ $member->id }}, '{{ $member->name }}')">
                            <i class="fa-solid fa-check"></i>
                          </button>
                        @else
                          <button class="btn-primary btn-sm btn-ban" onclick="banMember({{ $member->id }}, '{{ $member->name }}')">
                            <i class="fa-solid fa-ban"></i>
                          </button>
                        @endif
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" style="text-align:center; padding:30px; color:#64748b;">Belum ada anggota terdaftar.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- PAGINATION RAK ANGGOTA -->
          @if ($members->hasPages())
            <div class="pagination-wrapper">
              <div>
                Showing <strong>{{ $members->firstItem() ?? 0 }}</strong> to <strong>{{ $members->lastItem() ?? 0 }}</strong> of <strong>{{ number_format($members->total()) }}</strong> entries
              </div>

              <div class="pagination-pages">
                @if ($members->onFirstPage())
                  <span class="page-btn disabled"><i class="fa-solid fa-chevron-left"></i></span>
                @else
                  <a href="{{ $members->previousPageUrl() }}" class="page-btn"><i class="fa-solid fa-chevron-left"></i></a>
                @endif

                @foreach ($members->getUrlRange(1, $members->lastPage()) as $page => $url)
                  @if ($page == $members->currentPage())
                    <span class="page-btn active">{{ $page }}</span>
                  @elseif ($page == 1 || $page == $members->lastPage() || ($page >= $members->currentPage() - 1 && $page <= $members->currentPage() + 1))
                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                  @elseif ($page == 2 || $page == $members->lastPage() - 1)
                    <span class="page-dots">...</span>
                  @endif
                @endforeach

                @if ($members->hasMorePages())
                  <a href="{{ $members->nextPageUrl() }}" class="page-btn"><i class="fa-solid fa-chevron-right"></i></a>
                @else
                  <span class="page-btn disabled"><i class="fa-solid fa-chevron-right"></i></span>
                @endif
              </div>
            </div>
          @endif
        </div>

        <!-- SISI KANAN: DETAIL PROFIL -->
        <div class="panel-card" id="memberDetailCard">
          @if($selectedMember)
            @php
              $selInitials = strtoupper(substr($selectedMember->name, 0, 2));
              $activeLoans = $selectedMember->loans ? $selectedMember->loans->where('status', 'borrowed') : collect();
              $isSelectedBanned = $selectedMember->status === 'banned';
            @endphp

            <div class="profile-card-header">
              <div class="avatar-lg {{ $isSelectedBanned ? 'banned-avatar-lg' : '' }}" id="detailAvatar">{{ $selInitials }}</div>
              <h2 class="profile-name" id="detailName">{{ $selectedMember->name }}</h2>
              <p class="profile-id-sub" id="detailSub">{{ $selectedMember->nomor_induk ?? 'LIB-'.$selectedMember->id }} • {{ ucfirst($selectedMember->role) }}</p>

              <div class="status-tags">
                @if($isSelectedBanned)
                  <span class="tag-pill tag-banned"><i class="fa-solid fa-ban"></i> Banned</span>
                @else
                  <span class="tag-pill tag-active"><i class="fa-solid fa-check-circle"></i> Active</span>
                @endif
                @if($activeLoans->count() > 0)
                  <span class="tag-pill tag-action" id="detailActionTag">{{ $activeLoans->count() }} Active Loan(s)</span>
                @endif
              </div>
            </div>

            <div class="section-sub-title">MEMBER DETAILS & CONTACT</div>
            <div class="contact-item">
              <i class="fa-regular fa-envelope"></i> <span>Email: <strong id="detailEmail">{{ $selectedMember->email }}</strong></span>
            </div>
            <div class="contact-item">
              <i class="fa-regular fa-user"></i> <span>Username: <strong id="detailUsername">{{ $selectedMember->username ?? '-' }}</strong></span>
            </div>
            <div class="contact-item">
              <i class="fa-solid fa-id-card"></i> <span>Nomor Induk: <strong id="detailNomorInduk">{{ $selectedMember->nomor_induk ?? '-' }}</strong></span>
            </div>
            <div class="contact-item">
              <i class="fa-solid fa-user-tag"></i> <span>Role: <strong id="detailRole">{{ ucfirst($selectedMember->role) }}</strong></span>
            </div>

            <div class="section-sub-title">CURRENT ACTIVITY & LOANS</div>
            <div id="detailLoansContainer">
              @forelse($activeLoans as $loan)
                <div class="activity-card {{ $loan->due_date < now() ? 'overdue-card' : 'active-card' }}">
                  <i class="fa-solid fa-book-bookmark activity-icon"></i>
                  <div class="activity-info">
                    <h5>{{ $loan->book->title ?? 'Judul Buku' }}</h5>
                    <p>{{ $loan->due_date < now() ? 'Overdue since ' . $loan->due_date : 'Due on ' . $loan->due_date }}</p>
                  </div>
                </div>
              @empty
                <p style="font-size:12.5px; color:#64748b; padding:10px 0;">Tidak ada pinjaman buku aktif saat ini.</p>
              @endforelse
            </div>

            <button class="btn-full-history" onclick="alert('Riwayat aktivitas peminjaman buku anggota ini.')">
              <i class="fa-regular fa-clock"></i> View Full History
            </button>

            <div style="margin-top:16px; display:flex; gap:8px; flex-wrap:wrap;">
              <button type="button" class="btn-primary btn-sm" id="btnEditSelectedMember" data-member='@json($selectedMember)' onclick="openEditModalFromButton(this)" style="flex:1; justify-content:center;">
                <i class="fa-solid fa-pen"></i> Edit Member
              </button>
              @if($isSelectedBanned)
                <button class="btn-warning btn-sm" onclick="unbanMember({{ $selectedMember->id }}, '{{ $selectedMember->name }}')" style="flex:1; justify-content:center;">
                  <i class="fa-solid fa-check"></i> Unban
                </button>
              @else
                <button class="btn-danger btn-sm" onclick="banMember({{ $selectedMember->id }}, '{{ $selectedMember->name }}')" style="flex:1; justify-content:center;">
                  <i class="fa-solid fa-ban"></i> Ban Member
                </button>
              @endif
            </div>
          @else
            <div style="text-align:center; padding:40px; color:#64748b;">
              <i class="fa-solid fa-user-circle" style="font-size:48px; margin-bottom:16px; color:#cbd5e1;"></i>
              <p>Pilih salah satu anggota untuk melihat profil lengkap.</p>
            </div>
          @endif
        </div>

      </div>
    </main>
  </div>

  <!-- MODAL ADD MEMBER -->
  <div class="modal-backdrop" id="addMemberModal">
    <div class="modal-box">
      <div class="modal-header">
        <h3>Daftarkan Anggota Baru</h3>
        <button class="close-modal-btn" onclick="closeModal('addMemberModal')"><i class="fa-solid fa-xmark"></i></button>
      </div>

      <form action="{{ route('admin.members.save') }}" method="POST">
        @csrf
        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="name" class="form-control" placeholder="Contoh: Ahmad Saputra" required>
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
            <input type="text" name="nomor_induk" class="form-control" placeholder="Contoh: LIB-23-8182" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="ahmadsaputra" required>
          </div>
          <div class="form-group">
            <label>Email Sekolah (Opsional)</label>
            <input type="email" name="email" class="form-control" placeholder="ahmad@smkn2pwk.sch.id">
          </div>
        </div>

        <div class="form-group">
          <label>Password Awal</label>
          <input type="password" name="password" class="form-control" value="password123" required>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-secondary" onclick="closeModal('addMemberModal')">Batal</button>
          <button type="submit" class="btn-primary"><i class="fa-solid fa-save"></i> Simpan Anggota</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL EDIT MEMBER -->
  <div class="modal-backdrop" id="editMemberModal">
    <div class="modal-box">
      <div class="modal-header">
        <h3>Edit Anggota</h3>
        <button class="close-modal-btn" onclick="closeModal('editMemberModal')"><i class="fa-solid fa-xmark"></i></button>
      </div>

      <form id="editMemberForm" action="" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="name" id="edit_name" class="form-control" required>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Peran / Role</label>
            <select name="role" id="edit_role" class="form-control">
              <option value="murid">Murid / Siswa</option>
              <option value="guru">Guru / Staf</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <div class="form-group">
            <label>Nomor Induk (NIS / NIP)</label>
            <input type="text" name="nomor_induk" id="edit_nomor_induk" class="form-control" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" id="edit_username" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Email (Opsional)</label>
            <input type="email" name="email" id="edit_email" class="form-control" placeholder="Contoh: user@gmail.com">
          </div>
        </div>

        <div class="form-group">
          <label>Password (Kosongkan jika tidak ingin diubah)</label>
          <input type="password" name="password" class="form-control" placeholder="Masukkan password baru jika ingin mengubah">
        </div>

        <div class="form-group">
          <label>Status</label>
          <select name="status" id="edit_status" class="form-control">
            <option value="active">Active</option>
            <option value="banned">Banned</option>
          </select>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-secondary" onclick="closeModal('editMemberModal')">Batal</button>
          <button type="submit" class="btn-primary"><i class="fa-solid fa-save"></i> Update Member</button>
        </div>
      </form>
    </div>
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

    // Close modal when clicking outside
    document.querySelectorAll('.modal-backdrop').forEach(modal => {
      modal.addEventListener('click', function(e) {
        if (e.target === this) {
          closeModal(this.id);
        }
      });
    });

    function openEditModalFromButton(btn) {
      try {
        const raw = btn.getAttribute('data-member');
        if (!raw) return;
        const member = typeof raw === 'string' ? JSON.parse(raw) : raw;
        openEditModal(member);
      } catch (e) {
        console.error("Error parsing member data:", e);
      }
    }

    function showMemberDetailFromRow(trElement) {
      try {
        const raw = trElement.getAttribute('data-member');
        if (!raw) return;
        const member = typeof raw === 'string' ? JSON.parse(raw) : raw;
        showMemberDetail(member, trElement);
      } catch (e) {
        console.error("Error parsing member data from row:", e);
      }
    }

    function showMemberDetail(member, rowElement) {
      document.querySelectorAll('.member-row').forEach(r => r.classList.remove('active-row'));
      rowElement.classList.add('active-row');

      const initials = member.name.substring(0, 2).toUpperCase();
      const isBanned = member.status === 'banned';

      document.getElementById('detailAvatar').textContent = initials;
      document.getElementById('detailAvatar').className = 'avatar-lg' + (isBanned ? ' banned-avatar-lg' : '');
      document.getElementById('detailName').textContent = member.name;
      document.getElementById('detailSub').textContent = (member.nomor_induk || ('LIB-' + member.id)) + ' • ' + member.role.toUpperCase();
      document.getElementById('detailEmail').textContent = member.email;
      document.getElementById('detailUsername').textContent = member.username || '-';
      document.getElementById('detailNomorInduk').textContent = member.nomor_induk || '-';
      document.getElementById('detailRole').textContent = member.role.charAt(0).toUpperCase() + member.role.slice(1);

      // Update status tags in profile
      const statusTagsContainer = document.querySelector('.profile-card-header .status-tags');
      if (statusTagsContainer) {
        let statusHtml = '';
        if (isBanned) {
          statusHtml += `<span class="tag-pill tag-banned"><i class="fa-solid fa-ban"></i> Banned</span>`;
        } else {
          statusHtml += `<span class="tag-pill tag-active"><i class="fa-solid fa-check-circle"></i> Active</span>`;
        }

        const activeLoans = member.loans ? member.loans.filter(l => l.status === 'borrowed') : [];
        if (activeLoans.length > 0) {
          statusHtml += `<span class="tag-pill tag-action">${activeLoans.length} Active Loan(s)</span>`;
        }
        statusTagsContainer.innerHTML = statusHtml;
      }

      window.currentMember = member;
      // Update action buttons in profile
      const profileActions = document.querySelector('.profile-card-header').nextElementSibling?.nextElementSibling?.nextElementSibling?.nextElementSibling;
      if (profileActions && profileActions.tagName === 'DIV' && profileActions.style.marginTop === '16px') {
        const buttonsContainer = profileActions;
        if (isBanned) {
          buttonsContainer.innerHTML = `
            <button class="btn-primary btn-sm" onclick="openEditModal(window.currentMember)" style="flex:1; justify-content:center;">
              <i class="fa-solid fa-pen"></i> Edit Member
            </button>
            <button class="btn-warning btn-sm" onclick="unbanMember(${member.id}, '${member.name}')" style="flex:1; justify-content:center;">
              <i class="fa-solid fa-check"></i> Unban
            </button>
          `;
        } else {
          buttonsContainer.innerHTML = `
            <button class="btn-primary btn-sm" onclick="openEditModal(window.currentMember)" style="flex:1; justify-content:center;">
              <i class="fa-solid fa-pen"></i> Edit Member
            </button>
            <button class="btn-danger btn-sm" onclick="banMember(${member.id}, '${member.name}')" style="flex:1; justify-content:center;">
              <i class="fa-solid fa-ban"></i> Ban Member
            </button>
          `;
        }
      }

      const container = document.getElementById('detailLoansContainer');
      container.innerHTML = '';

      if (member.loans && member.loans.length > 0) {
        const activeLoans = member.loans.filter(l => l.status === 'borrowed');
        if (activeLoans.length > 0) {
          activeLoans.forEach(loan => {
            const isOverdue = new Date(loan.due_date) < new Date();
            container.innerHTML += `
              <div class="activity-card ${isOverdue ? 'overdue-card' : 'active-card'}">
                <i class="fa-solid fa-book-bookmark activity-icon"></i>
                <div class="activity-info">
                  <h5>${loan.book ? loan.book.title : 'Buku Pinjaman'}</h5>
                  <p>${isOverdue ? 'Overdue since ' + loan.due_date : 'Due on ' + loan.due_date}</p>
                </div>
              </div>
            `;
          });
        } else {
          container.innerHTML = '<p style="font-size:12.5px; color:#64748b; padding:10px 0;">Tidak ada pinjaman buku aktif saat ini.</p>';
        }
      } else {
        container.innerHTML = '<p style="font-size:12.5px; color:#64748b; padding:10px 0;">Tidak ada pinjaman buku aktif saat ini.</p>';
      }
    }

    function openEditModal(member) {
      // Set form action URL
      document.getElementById('editMemberForm').action = "{{ url('/admin/data-anggota') }}/" + member.id;

      // Fill form fields
      document.getElementById('edit_name').value = member.name || '';
      document.getElementById('edit_role').value = member.role || 'murid';
      document.getElementById('edit_nomor_induk').value = member.nomor_induk || '';
      document.getElementById('edit_username').value = member.username || '';
      document.getElementById('edit_email').value = member.email || '';
      document.getElementById('edit_status').value = member.status || 'active';

      openModal('editMemberModal');
    }

    function banMember(id, name) {
      if (confirm(`Apakah Anda yakin ingin meng-ban ${name}? Member yang di-ban tidak dapat meminjam buku.`)) {
        // Submit form to ban member
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('/admin/data-anggota') }}/${id}/ban`;
        form.innerHTML = `
          @csrf
          @method('PUT')
        `;
        document.body.appendChild(form);
        form.submit();
      }
    }

    function unbanMember(id, name) {
      if (confirm(`Apakah Anda yakin ingin meng-unban ${name}?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('/admin/data-anggota') }}/${id}/unban`;
        form.innerHTML = `
          @csrf
          @method('PUT')
        `;
        document.body.appendChild(form);
        form.submit();
      }
    }
  </script>
</body>
</html>
