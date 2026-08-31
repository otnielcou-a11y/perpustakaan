<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - Admin SMKN 2 Purwakarta</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('asset/css/admin.css') }}?v={{ time() }}">
</head>
<body>

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-top">
      <div class="sidebar-brand">
        <div class="brand-icon"><i class="fa-solid fa-graduation-cap"></i></div>
        <div class="brand-text">
          <h2>SMKN 2 Purwakarta</h2>
          <span>Library Admin</span>
        </div>
      </div>

      <button class="btn-add-resource" onclick="alert('Form Tambah Sumber Daya')">
        <i class="fa-solid fa-plus"></i> Add New Resource
      </button>

      <nav class="sidebar-nav">
        <a href="{{ url('/admin/dashboard') }}" class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
          <i class="fa-solid fa-table-cells-large"></i> Dashboard
        </a>
        <a href="{{ url('/admin/data-buku') }}" class="nav-item {{ Request::is('admin/data-buku') ? 'active' : '' }}">
          <i class="fa-solid fa-book-open"></i> Book Management
        </a>
        <a href="{{ url('/admin/data-anggota') }}" class="nav-item {{ Request::is('admin/data-anggota') ? 'active' : '' }}">
          <i class="fa-solid fa-users"></i> Member Management
        </a>
        <a href="{{ url('/admin/transaksi') }}" class="nav-item {{ Request::is('admin/transaksi') ? 'active' : '' }}">
          <i class="fa-solid fa-arrow-right-arrow-left"></i> Transactions
        </a>
        <a href="{{ url('/admin/kategori') }}" class="nav-item {{ Request::is('admin/kategori') ? 'active' : '' }}">
          <i class="fa-solid fa-tags"></i> Category Management
        </a>
        @if(auth()->user() && auth()->user()->role === 'superadmin')
        <a href="{{ url('/admin/tambah-admin') }}" class="nav-item {{ Request::is('admin/tambah-admin') ? 'active' : '' }}">
          <i class="fa-solid fa-user-shield"></i> Administrator
        </a>
        @endif
        <a href="{{ url('/admin/tentang-website') }}" class="nav-item {{ Request::is('admin/tentang-website') ? 'active' : '' }}">
          <i class="fa-solid fa-circle-info"></i> About Website
        </a>
      </nav>
    </div>

    <div class="sidebar-bottom">
      <a href="{{ url('/admin/settings') }}" class="nav-item {{ Request::is('admin/settings') ? 'active' : '' }}">
        <i class="fa-solid fa-gear"></i> Settings
      </a>
      <a href="{{ url('/logout') }}" class="nav-item" style="color: #ef4444;">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
      </a>
    </div>
  </aside>

  <!-- MAIN WRAPPER -->
  <div class="main-wrapper">
    <!-- TOP HEADER -->
    <header class="top-header">
      <div class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" id="globalSearch" placeholder="Search books, members...">
      </div>

      <div class="header-actions">
        <button class="icon-btn" aria-label="Notifications">
          <i class="fa-regular fa-bell"></i>
          <span class="badge-dot"></span>
        </button>
        <button class="icon-btn" aria-label="Help">
          <i class="fa-regular fa-circle-question"></i>
        </button>

        <div class="user-profile">
          <a href="{{ url('/login') }}" style="color: var(--text-muted); font-size: 13px; font-weight: 600;">Sign Out</a>
          <div class="avatar-circle">AD</div>
        </div>
      </div>
    </header>

    <!-- CONTENT BODY -->
<main class="content-body">

    <!-- TAMBAHKAN BLOK INI UNTUK MENAMPILKAN PESAN SUKSES/GAGAL -->
    @if(session('success'))
        <div style="padding: 15px; margin-bottom: 20px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="padding: 15px; margin-bottom: 20px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px;">
            <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
        </div>
    @endif
    <!-- ======================================================== -->

    @yield('content')
</main>
  </div>

  <script src="{{ asset('asset/js/admin.js') }}?v={{ time() }}"></script>
</body>
</html>
