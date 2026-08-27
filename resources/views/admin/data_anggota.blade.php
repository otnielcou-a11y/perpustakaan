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

    .member-cell-info { display:flex; align-items:center; gap:12px; }
    .avatar-sm { width:34px; height:34px; border-radius:50%; background:#d1fae5; color:var(--primary); display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:800; }

    .badge-borrowed-count { padding:4px 10px; border-radius:20px; font-size:11px; font-weight:700; display:inline-block; }
    .borrow-active { background:#fee2e2; color:#991b1b; }
    .borrow-none { background:#f1f5f9; color:#64748b; }

    /* PROFILE CARD */
    .profile-card-header { text-align:center; padding-bottom:20px; border-bottom:1px solid var(--border); }
    .avatar-lg { width:72px; height:72px; border-radius:14px; background:#d1fae5; color:var(--primary); display:inline-flex; align-items:center; justify-content:center; font-size:24px; font-weight:800; margin-bottom:12px; }
    .profile-name { font-size:19px; font-weight:800; color:var(--text-main); margin-bottom:4px; }
    .profile-id-sub { font-size:12px; color:var(--text-muted); font-weight:600; margin-bottom:12px; }

    .status-tags { display:flex; justify-content:center; gap:8px; }
    .tag-pill { font-size:11px; font-weight:700; padding:4px 10px; border-radius:6px; }
    .tag-active { background:#dcfce7; color:#15803d; }
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
    .modal-box { background:#fff; border-radius:12px; width:100%; max-width:520px; max-height:90vh; overflow-y:auto; padding:28px; }
    .modal-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom:1px solid var(--border); padding-bottom:12px; }
    .modal-header h3 { font-size:18px; font-weight:800; }
    .form-group { margin-bottom:14px; }
    .form-group label { display:block; font-size:12px; font-weight:700; margin-bottom:5px; }
    .form-control { width:100%; padding:9px 12px; font-size:13px; border:1px solid var(--border); border-radius:6px; outline:none; }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    .modal-footer { display:flex; justify-content:flex-end; gap:10px; margin-top:20px; border-top:1px solid var(--border); padding-top:16px; }

    .alert-success { background:#d1fae5; border:1px solid #a7f3d0; color:#065f46; padding:12px 18px; border-radius:8px; margin-bottom:20px; font-weight:700; font-size:13px; }

    @media (max-width:1024px) {
      .member-grid { grid-template-columns:1fr; }
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
                  <th>BORROWED</th>
                </tr>
              </thead>
              <tbody>
                @forelse($members as $index => $member)
                  @php
                    $initials = strtoupper(substr($member->name, 0, 2));
                    $borrowedCount = $member->loans ? $member->loans->where('status', 'borrowed')->count() : 0;
                    $overdueCount = $member->loans ? $member->loans->where('status', 'borrowed')->where('due_date', '<', now())->count() : 0;
                  @endphp
                  <tr class="member-row {{ $index === 0 ? 'active-row' : '' }}"
                      onclick="showMemberDetail({{ json_encode($member) }}, this)">
                    <td style="font-weight:700; color:#334155;">{{ $member->nomor_induk ?? 'LIB-'.str_pad($member->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>
                      <div class="member-cell-info">
                        <div class="avatar-sm">{{ $initials }}</div>
                        <span style="font-weight:700;">{{ $member->name }}</span>
                      </div>
                    </td>
                    <td style="color:var(--text-muted); font-weight:600;">{{ ucfirst($member->role) }}</td>
                    <td>
                      @if($overdueCount > 0)
                        <span class="badge-borrowed-count borrow-active">{{ $borrowedCount }} ({{ $overdueCount }} Overdue)</span>
                      @elseif($borrowedCount > 0)
                        <span class="badge-borrowed-count" style="background:#e0f2fe; color:#0369a1;">{{ $borrowedCount }} Active</span>
                      @else
                        <span class="badge-borrowed-count borrow-none">0</span>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" style="text-align:center; padding:30px; color:#64748b;">Belum ada anggota terdaftar.</td>
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
            @endphp

            <div class="profile-card-header">
              <div class="avatar-lg" id="detailAvatar">{{ $selInitials }}</div>
              <h2 class="profile-name" id="detailName">{{ $selectedMember->name }}</h2>
              <p class="profile-id-sub" id="detailSub">{{ $selectedMember->nomor_induk ?? 'LIB-'.$selectedMember->id }} • {{ ucfirst($selectedMember->role) }}</p>

              <div class="status-tags">
                <span class="tag-pill tag-active">Active</span>
                @if($activeLoans->count() > 0)
                  <span class="tag-pill tag-action" id="detailActionTag">Has Loan</span>
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
              View Full History
            </button>
          @else
            <div style="text-align:center; padding:40px; color:#64748b;">Pilih salah satu anggota untuk melihat profil lengkap.</div>
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
        <button type="button" class="icon-btn" onclick="closeModal('addMemberModal')"><i class="fa-solid fa-xmark"></i></button>
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
            <label>Email Sekolah</label>
            <input type="email" name="email" class="form-control" placeholder="ahmad@smkn2pwk.sch.id" required>
          </div>
        </div>

        <div class="form-group">
          <label>Password Awal</label>
          <input type="password" name="password" class="form-control" value="password123" required>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-primary" style="background:#64748b;" onclick="closeModal('addMemberModal')">Batal</button>
          <button type="submit" class="btn-primary">Simpan Anggota</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openModal(id) {
      document.getElementById(id).classList.add('show');
    }

    function closeModal(id) {
      document.getElementById(id).classList.remove('show');
    }

    function showMemberDetail(member, rowElement) {
      document.querySelectorAll('.member-row').forEach(r => r.classList.remove('active-row'));
      rowElement.classList.add('active-row');

      const initials = member.name.substring(0, 2).toUpperCase();
      document.getElementById('detailAvatar').textContent = initials;
      document.getElementById('detailName').textContent = member.name;
      document.getElementById('detailSub').textContent = (member.nomor_induk || ('LIB-' + member.id)) + ' • ' + member.role.toUpperCase();
      document.getElementById('detailEmail').textContent = member.email;
      document.getElementById('detailUsername').textContent = member.username || '-';
      document.getElementById('detailNomorInduk').textContent = member.nomor_induk || '-';

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
  </script>
</body>
</html>
