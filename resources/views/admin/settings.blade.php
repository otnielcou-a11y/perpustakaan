<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings - Admin SMKN 2 Purwakarta</title>

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
    .page-header { margin-bottom:28px; }
    .page-title h1 { font-size:26px; font-weight:800; letter-spacing:-0.5px; }
    .page-title p { font-size:13px; color:var(--text-muted); margin-top:4px; }

    /* SETTINGS GRID */
    .settings-grid { display:grid; grid-template-columns:1.2fr 1fr; gap:28px; align-items:start; }
    .setting-card { background:var(--white); border:1px solid var(--border); border-radius:14px; padding:28px; box-shadow:0 2px 4px rgba(0,0,0,0.02); }
    .setting-card h3 { font-size:17px; font-weight:800; margin-bottom:6px; }
    .setting-card p.sub { font-size:12.5px; color:var(--text-muted); margin-bottom:22px; }

    .form-group { margin-bottom:16px; }
    .form-group label { display:block; font-size:12px; font-weight:700; margin-bottom:6px; color:#1e293b; }
    .form-control { width:100%; padding:10px 14px; font-size:13px; border:1.5px solid var(--border); border-radius:8px; outline:none; transition:0.2s; }
    .form-control:focus { border-color:var(--primary); }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; }

    .avatar-upload-wrap { display:flex; align-items:center; gap:20px; margin-bottom:20px; }
    .avatar-preview-box { width:80px; height:80px; border-radius:50%; background:#e2e8f0; overflow:hidden; display:flex; align-items:center; justify-content:center; border:2px solid var(--border); }
    .avatar-preview-box img { width:100%; height:100%; object-fit:cover; }

    /* LIVE PREVIEW LOGO */
    .logo-preview-container { background:#0c4d2d; border-radius:12px; padding:24px; text-align:center; margin-bottom:24px; color:#fff; display:flex; align-items:center; justify-content:center; gap:14px; min-height:120px; }
    .preview-logo-wrapper { display:flex; align-items:center; justify-content:center; }
    .preview-logo-wrapper img { width:auto; height:48px; object-fit:contain; transition:all 0.2s ease; }
    .preview-logo-wrapper .fallback-icon { font-size:32px; color:var(--accent-yellow); }

    .range-wrap { display:flex; align-items:center; gap:12px; }
    .range-wrap input { flex:1; accent-color:var(--primary); }
    .range-val { font-size:13px; font-weight:800; min-width:40px; }

    .btn-save { width:100%; padding:12px; background-color:var(--primary); color:var(--white); border:none; border-radius:8px; font-size:13.5px; font-weight:700; cursor:pointer; transition:0.2s; margin-top:8px; }
    .btn-save:hover { background-color:var(--primary-dark); }

    .alert-success { background:#d1fae5; border:1px solid #a7f3d0; color:#065f46; padding:12px 18px; border-radius:8px; margin-bottom:20px; font-weight:700; font-size:13px; }

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
      .settings-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 640px) {
      .form-row { grid-template-columns: 1fr; }
      .avatar-upload-wrap { flex-direction: column; text-align: center; }
      .hide-mobile-text { display: none; }
      .page-title h1 { font-size: 22px; }
      .logo-preview-container { flex-direction: column; text-align: center; }
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
      <a href="{{ url('/admin/settings') }}" class="nav-item active">
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

      @if($errors->any())
        <div style="background:#fee2e2; border:1px solid #fecaca; color:#991b1b; padding:12px 18px; border-radius:8px; margin-bottom:20px; font-weight:700; font-size:13px;">
          {{ $errors->first() }}
        </div>
      @endif

      <div class="page-header">
        <div class="page-title">
          <h1>Settings & Preferences</h1>
          <p>Kelola profil akun administrator serta upload logo murni SMKN 2 Purwakarta.</p>
        </div>
      </div>

      <div class="settings-grid">

        <!-- PROFIL ADMIN -->
        <div class="setting-card">
          <h3>Profil Administrator</h3>
          <p class="sub">Perbarui data login dan foto profil akun admin Anda.</p>

          <form action="{{ route('admin.settings.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id ?? '' }}">

            <div class="avatar-upload-wrap">
              <div class="avatar-preview-box" id="avatarPreviewBox">
                @if(isset($user) && $user?->avatar && file_exists(public_path('storage/' . $user->avatar)))
                  <img src="{{ asset('storage/' . $user->avatar) }}" id="avatarImgPreview" alt="Avatar">
                @else
                  <span style="font-size:24px; font-weight:800; color:var(--primary);">{{ strtoupper(substr($user->name ?? 'AD', 0, 2)) }}</span>
                @endif
              </div>
              <div style="flex:1;">
                <label style="font-size:12px; font-weight:700; display:block; margin-bottom:4px;">Ganti Foto Profil</label>
                <input type="file" name="avatar" class="form-control" accept="image/*" onchange="previewAvatar(this)">
                <small style="font-size:11px; color:var(--text-muted);">Maks. 2MB (PNG, JPG, WebP)</small>
              </div>
            </div>

            <div class="form-group">
              <label>Nama Lengkap Admin</label>
              <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username', $user->username ?? '') }}" required>
              </div>
              <div class="form-group">
                <label>Email Administrator</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
              </div>
            </div>

            <div class="form-row" style="margin-top:10px;">
              <div class="form-group">
                <label>Password Baru (Opsional)</label>
                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
              </div>
              <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password">
              </div>
            </div>

            <button type="submit" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Simpan Profil</button>
          </form>
        </div>

        <!-- PENGATURAN LOGO -->
        <div class="setting-card">
          <h3>Logo Resmi SMKN 2 Purwakarta</h3>
          <p class="sub">Upload gambar logo sekolah asli tanpa background kotak kuning.</p>

          <div class="logo-preview-container">
            <div class="preview-logo-wrapper" id="liveLogoWrapper">
              @if(!empty($globalLogo))
                <img src="{{ $globalLogo }}" id="liveLogoImg" style="height: {{ $logoSize ?? '44' }}px; object-fit: {{ $logoFit ?? 'contain' }};" alt="Logo">
              @else
                <i class="fa-solid fa-graduation-cap fallback-icon" id="liveLogoIcon"></i>
              @endif
            </div>
            <div style="text-align:left;">
              <div style="font-weight:800; font-size:15px; line-height:1.2;">SMKN 2 PURWAKARTA</div>
              <div style="font-size:10px; color:#cbd5e1; letter-spacing:2px; font-weight:600;">LIBRARIES PREVIEW</div>
            </div>
          </div>

          <form action="{{ route('admin.settings.branding') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label>Upload File Logo Sekolah (PNG Transparan Disarankan)</label>
              <input type="file" name="logo_image" class="form-control" accept="image/*" onchange="previewLogo(this)">
            </div>

            <div class="form-group">
              <label>Tinggi Logo (Slider Pixel)</label>
              <div class="range-wrap">
                <input type="range" name="logo_size" id="logoSizeRange" min="30" max="80" value="{{ $logoSize ?? '44' }}" oninput="updateLogoSize(this.value)">
                <span class="range-val" id="logoSizeVal">{{ $logoSize ?? '44' }}px</span>
              </div>
            </div>

            <div class="form-group">
              <label>Skala Proporsi (Fit Mode)</label>
              <select name="logo_fit" id="logoFitSelect" class="form-control" onchange="updateLogoFit(this.value)">
                <option value="contain" {{ ($logoFit ?? 'contain') == 'contain' ? 'selected' : '' }}>Contain (Pertahankan Rasio Asli / Proporsional)</option>
                <option value="cover" {{ ($logoFit ?? 'contain') == 'cover' ? 'selected' : '' }}>Cover (Isi Penuh)</option>
              </select>
            </div>

            <button type="submit" class="btn-save" style="background:#0f172a;"><i class="fa-solid fa-paintbrush"></i> Terapkan Logo ke Seluruh Web</button>
          </form>
        </div>

      </div>
    </main>
  </div>

  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

  <script>
    function previewAvatar(input) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('avatarPreviewBox').innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover;">`;
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    function previewLogo(input) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const wrapper = document.getElementById('liveLogoWrapper');
          const size = document.getElementById('logoSizeRange').value;
          const fit = document.getElementById('logoFitSelect').value;
          wrapper.innerHTML = `<img src="${e.target.result}" id="liveLogoImg" style="height:${size}px; width:auto; object-fit:${fit};">`;
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    function updateLogoSize(val) {
      document.getElementById('logoSizeVal').textContent = val + 'px';
      const img = document.getElementById('liveLogoImg');
      if (img) img.style.height = val + 'px';
    }

    function updateLogoFit(val) {
      const img = document.getElementById('liveLogoImg');
      if (img) img.style.objectFit = val;
    }

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
