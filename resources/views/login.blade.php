<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk Akun - SMKN 2 Purwakarta Libraries</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --primary: #0c4d2d;
      --primary-dark: #07351e;
      --accent: #eab308;
      --text-dark: #0f172a;
      --text-muted: #64748b;
      --border: #e2e8f0;
      --white: #ffffff;
    }

    /* ANTI RUANG PUTIH & LEAK */
    html, body {
      width: 100%;
      max-width: 100%;
      overflow-x: hidden !important;
      position: relative;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background-color: #f8fafc;
    }

    * { margin:0; padding:0; box-sizing:border-box; font-family:'Plus Jakarta Sans',sans-serif; }
    body { color:#1e293b; line-height:1.5; }
    a { text-decoration:none; color:inherit; cursor:pointer; }
    ul { list-style:none; }
    .custom-container { max-width:1200px; margin:0 auto; padding:0 20px; width:100%; }

    /* NAVBAR STYLES */
    header.main-header { background-color:var(--primary) !important; padding:14px 0; position:sticky; top:0; z-index:9999; box-shadow:0 2px 10px rgba(0,0,0,0.15); width:100%; }
    .nav-container { max-width:1200px; margin:0 auto; padding:0 20px; display:flex; justify-content:space-between; align-items:center; }
    .logo { display:flex; align-items:center; gap:12px; }
    .nav-menu { display:flex; align-items:center; gap:24px; }
    .nav-item-link { color:#f1f5f9; font-size:14px; font-weight:600; display:flex; align-items:center; gap:6px; transition:0.2s; padding:6px 0; }
    .nav-item-link:hover, .nav-item-link.active { color:var(--accent); }
    .nav-item-link.active { border-bottom:2px solid var(--accent); }

    .btn-profile { padding:6px 18px; border:1.5px solid rgba(255,255,255,0.5); border-radius:20px; color:#fff; font-size:13px; font-weight:600; display:flex; align-items:center; gap:8px; transition:0.2s; }
    .btn-profile:hover, .btn-profile-active { background-color:#fff; color:var(--primary) !important; border-color:#fff; }

    .btn-user-pill { display:flex; align-items:center; gap:9px; background:rgba(255,255,255,0.15); padding:4px 14px 4px 6px; border-radius:30px; color:#fff; font-size:13px; font-weight:700; border:1.5px solid rgba(255,255,255,0.3); transition:0.2s; }
    .btn-user-pill:hover, .btn-user-pill.active-pill { background:#fff; color:var(--primary) !important; border-color:#fff; }
    .btn-user-pill:hover .nav-avatar-circle, .btn-user-pill.active-pill .nav-avatar-circle { background:var(--primary); color:#fff; }
    .nav-avatar-circle { width:30px; height:30px; border-radius:50%; background:var(--accent); color:var(--primary); display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:800; overflow:hidden; }
    .nav-avatar-circle img { width:100%; height:100%; object-fit:cover; }
    .nav-username { max-width:120px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }

    /* DROPDOWN */
    .dropdown-wrapper { position:relative; padding-bottom:10px; margin-bottom:-10px; }
    .dropdown-wrapper .fa-chevron-down { font-size:10px; transition:transform 0.25s ease; }
    .dropdown-content { display:none; position:absolute; top:100%; left:0; background-color:#fff; min-width:205px; box-shadow:0 10px 25px rgba(0,0,0,0.15); border-radius:8px; padding:8px 0; z-index:10000; }
    .dropdown-content::before { content:''; position:absolute; top:-12px; left:0; width:100%; height:12px; }
    .dropdown-content a { display:flex; align-items:center; gap:12px; padding:10px 18px; color:#334155; font-size:13px; font-weight:600; transition:0.2s; }
    .dropdown-content a i { width:18px; text-align:center; color:var(--primary); font-size:14px; }
    .dropdown-content a:hover { background-color:#f1f5f9; color:var(--primary); padding-left:22px; }

    @media (min-width:769px) {
      .dropdown-wrapper:hover .dropdown-content { display:block; animation:fadeIn 0.2s ease forwards; }
      .dropdown-wrapper:hover .fa-chevron-down { transform:rotate(180deg); color:var(--accent); }
    }
    @keyframes fadeIn { from{opacity:0; transform:translateY(8px);} to{opacity:1; transform:translateY(0);} }

    .nav-toggle { display:none; background:none; border:none; color:#fff; font-size:24px; cursor:pointer; }

    /* AUTH SPLIT */
    .auth-wrapper { flex: 1 0 auto; display:flex; min-height:calc(100vh - 70px); }
    .auth-banner { flex:1; position:relative; background:url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=1600&auto=format&fit=crop&q=80') center/cover no-repeat; display:flex; align-items:center; justify-content:center; padding:40px; color:#ffffff; }
    .auth-banner-overlay { position:absolute; inset:0; background:linear-gradient(180deg, rgba(12,77,45,0.75) 0%, rgba(0,0,0,0.85) 100%); z-index:1; }
    .auth-banner-content { position:relative; z-index:2; max-width:480px; text-align:center; }
    .auth-banner-content h1 { font-size:38px; font-weight:800; margin-bottom:16px; line-height:1.2; }
    .auth-banner-content p { font-size:15px; color:#e2e8f0; line-height:1.6; }

    .auth-form-side { flex:1; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:40px 20px; }
    .auth-header-icon { width:52px; height:52px; background-color:#d1fae5; color:var(--primary); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:24px; margin-bottom:16px; }
    .auth-title { font-size:26px; font-weight:800; margin-bottom:6px; color:#0f172a; }
    .auth-subtitle { font-size:13px; color:#64748b; margin-bottom:24px; text-align:center; max-width:380px; }
    .auth-card { background:#ffffff; border:1px solid #e2e8f0; border-radius:16px; padding:32px; width:100%; max-width:460px; box-shadow:0 10px 25px -5px rgba(0,0,0,0.05); }

    .alert-box { padding:12px 16px; border-radius:8px; font-size:13px; margin-bottom:18px; display:flex; align-items:center; gap:10px; font-weight:600; }
    .alert-error { background-color:#fee2e2; border:1px solid #fecaca; color:#991b1b; }
    .alert-success { background:#d1fae5; border:1px solid #a7f3d0; color:#065f46; }

    .auth-tabs { display:flex; justify-content:space-between; border-bottom:1px solid #e2e8f0; padding-bottom:12px; margin-bottom:20px; }
    .auth-tab-link { font-size:14px; font-weight:700; color:#64748b; position:relative; }
    .auth-tab-link.active { color:var(--primary); }
    .auth-tab-link.active::after { content:''; position:absolute; bottom:-13px; left:0; width:100%; height:2px; background-color:var(--primary); }

    .form-group { margin-bottom:16px; }
    .form-label { display:block; font-size:12px; font-weight:700; margin-bottom:6px; color:#0f172a; }
    .input-icon-wrapper { position:relative; display:flex; align-items:center; }
    .input-icon-wrapper i.input-icon { position:absolute; left:14px; color:#64748b; font-size:14px; }
    .form-control { width:100%; padding:10px 14px 10px 40px; font-size:13px; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; }
    .form-control:focus { border-color:var(--primary); }
    .toggle-password { position:absolute; right:14px; background:none; border:none; color:#64748b; cursor:pointer; }

    .form-meta { display:flex; justify-content:space-between; align-items:center; font-size:12px; margin-bottom:20px; }
    .remember-me { display:flex; align-items:center; gap:6px; color:#64748b; cursor:pointer; }
    .forgot-link { color:var(--primary); font-weight:700; }

    .btn-submit { width:100%; padding:12px; background-color:var(--primary); color:#ffffff; border:none; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer; transition:0.2s; }
    .btn-submit:hover { background-color:var(--primary-dark); }

    .auth-divider { display:flex; align-items:center; margin:20px 0; color:#64748b; font-size:11.5px; }
    .auth-divider::before, .auth-divider::after { content:''; flex:1; height:1px; background-color:#e2e8f0; }
    .auth-divider span { padding:0 12px; }

    .btn-google { width:100%; padding:10px 14px; background-color:#ffffff; border:1.5px solid #cbd5e1; border-radius:8px; display:flex; align-items:center; justify-content:center; gap:10px; font-size:13px; font-weight:700; cursor:pointer; }
    .google-icon { width:18px; height:18px; }

    /* FOOTER */
    footer.main-footer { background-color:#052616 !important; color:#94a3b8; padding:45px 0 20px; margin-top:auto; width:100%; flex-shrink:0; }
    .footer-grid { display:grid; grid-template-columns:2fr 1fr 1fr 1.5fr; gap:32px; margin-bottom:35px; }
    .footer-brand { display:flex; flex-direction:column; gap:10px; }
    .footer-links h4 { color:#fff; font-size:14px; font-weight:700; margin-bottom:12px; }
    .footer-links ul { display:flex; flex-direction:column; gap:8px; }
    .footer-contact li { display: flex; align-items: center; gap: 8px; font-size: 13px; margin-bottom: 8px; }
    .footer-links a:hover { color:var(--accent); }
    .footer-bottom { display:flex; justify-content:space-between; align-items:center; border-top:1px solid rgba(255,255,255,0.1); padding-top:18px; font-size:12px; }

    @media (max-width:992px) { .auth-banner { display:none; } .footer-grid { grid-template-columns:1fr 1fr; } }
    @media (max-width:768px) {
      .custom-container { padding: 0 16px; }
      .nav-toggle { display:block; }
      .nav-menu { display:none; position:absolute; top:100%; left:0; width:100%; background-color:var(--primary); flex-direction:column; padding:18px; gap:12px; }
      .nav-menu.show { display:flex; }
      .dropdown-content { position:static; background:rgba(255,255,255,0.1); width:100%; }
      .dropdown-content.open { display:block; }
      .dropdown-content a { color:#fff; }
      .footer-grid { grid-template-columns: 1fr; gap: 24px; }
      .footer-bottom { flex-direction: column; gap: 8px; text-align: center; }
    }
  </style>
</head>
<body>

  <!-- NAVBAR DINAMIS TERPUSAT -->
  @include('partials.public_navbar')

  <!-- AUTH WRAPPER -->
  <div class="auth-wrapper">
    <div class="auth-banner">
      <div class="auth-banner-overlay"></div>
      <div class="auth-banner-content">
        <h1>Perpustakaan Digital SMKN 2 Purwakarta</h1>
        <p>Akses ribuan koleksi buku digital, jurnal, dan referensi akademik di mana saja dan kapan saja.</p>
      </div>
    </div>

    <div class="auth-form-side">
      <div class="auth-header-icon"><i class="fa-solid fa-book-open-reader"></i></div>
      <h2 class="auth-title">Selamat Datang</h2>
      <p class="auth-subtitle">Silakan masuk menggunakan Nama, Username, NISN, atau Email.</p>

      <div class="auth-card">
        @if(session('success'))
          <div class="alert-box alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <div>{{ session('success') }}</div>
          </div>
        @endif

        @if($errors->any())
          <div class="alert-box alert-error">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>{{ $errors->first() }}</div>
          </div>
        @endif

        <div class="auth-tabs">
          <span class="auth-tab-link active">Masuk</span>
          <a href="{{ url('/register') }}" class="auth-tab-link">Daftar</a>
        </div>

        <form action="{{ url('/login') }}" method="POST" autocomplete="off">
          @csrf

          <div class="form-group">
            <label class="form-label">Nama Lengkap / Username / NISN / Email</label>
            <div class="input-icon-wrapper">
              <i class="fa-regular fa-user input-icon"></i>
              <input type="text" name="login" value="{{ old('login') }}" class="form-control" placeholder="Ketik nama, username, NISN, atau email..." autocomplete="off" required autofocus>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Password</label>
            <div class="input-icon-wrapper">
              <i class="fa-solid fa-lock input-icon"></i>
              <input type="password" id="passInput" name="password" class="form-control" placeholder="Masukkan password..." autocomplete="new-password" required>
              <button type="button" class="toggle-password" id="togglePass">
                <i class="fa-regular fa-eye"></i>
              </button>
            </div>
          </div>

          <div class="form-meta">
            <label class="remember-me">
              <input type="checkbox" name="remember"> Ingat saya
            </label>
            <a href="{{ route('forgot.password') }}" class="forgot-link">Lupa Password?</a>
          </div>

          <button type="submit" class="btn-submit">Masuk</button>

          <div class="auth-divider"><span>atau masuk dengan</span></div>

        </form>

        <div class="auth-footer-text" style="text-align:center; font-size:12.5px; color:#64748b; margin-top:16px;">
          Belum punya akun? <a href="{{ url('/register') }}" style="color:var(--primary); font-weight:700;">Daftar Sekarang</a>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="main-footer">
    <div class="custom-container">
      <div class="footer-grid">
        <div class="footer-brand">
          @include('partials.logo', ['theme' => 'light'])
          <p style="font-size:13px; line-height:1.6; margin-top:10px;">Layanan perpustakaan digital yang mendukung literasi dan pengembangan keterampilan vokasi siswa.</p>
        </div>

        <div class="footer-links">
          <h4>Menu</h4>
          <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/profile') }}">Profile</a></li>
            <li><a href="{{ url('/collections') }}">Collections</a></li>
            <li><a href="{{ url('/about') }}">About</a></li>
          </ul>
        </div>

        <div class="footer-links">
          <h4>Kategori</h4>
          <ul>
            <li><a href="{{ url('/collections?category=Kuliner') }}">Kuliner</a></li>
            <li><a href="{{ url('/collections?category=Akuntansi') }}">Akuntansi</a></li>
            <li><a href="{{ url('/collections?category=Fashion Design') }}">Fashion Design</a></li>
            <li><a href="{{ url('/collections?category=Hospitality') }}">Hospitality</a></li>
          </ul>
        </div>

        <div class="footer-links">
          <h4>Kontak</h4>
          <ul class="footer-contact">
            <li><i class="fa-regular fa-envelope"></i> smkn2pwklibraries@gmail.com</li>
            <li><i class="fa-solid fa-globe"></i> smkn2pwklibraries.sch.id</li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; 2026 SMKN 2 Purwakarta Libraries. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script>
    const togglePass = document.getElementById('togglePass');
    const passInput = document.getElementById('passInput');
    if (togglePass && passInput) {
      togglePass.addEventListener('click', function() {
        const icon = this.querySelector('i');
        if (passInput.type === 'password') {
          passInput.type = 'text';
          icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
          passInput.type = 'password';
          icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
      });
    }
  </script>
</body>
</html>
