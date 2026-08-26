<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Perpustakaan - SMKN 2 Purwakarta</title>

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

    * { margin:0; padding:0; box-sizing:border-box; font-family:'Plus Jakarta Sans',sans-serif; }
    body { background-color:#f8fafc; color:#1e293b; min-height:100vh; display:flex; flex-direction:column; overflow-x:hidden; }
    a { text-decoration:none; color:inherit; cursor:pointer; }
    ul { list-style:none; }
    .custom-container { max-width:1200px; margin:0 auto; padding:0 20px; }

    /* NAVBAR STYLES */
    header.main-header { background-color:var(--primary) !important; padding:14px 0; position:sticky; top:0; z-index:9999; box-shadow:0 2px 10px rgba(0,0,0,0.15); }
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

    /* ================= PROFILE PERPUS GRID ================= */
    .profile-top-grid {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 32px;
      padding: 40px 0 32px;
      align-items: stretch;
    }

    /* WADAH FOTO GEDUNG */
    .profile-photo-wrapper {
      width: 100%;
      height: 380px;
      border-radius: 16px;
      overflow: hidden;
      background-color: #e2e8f0;
      box-shadow: 0 10px 25px rgba(0,0,0,0.06);
      border: 1px solid var(--border);
      position: relative;
    }

    .profile-photo-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform 0.3s ease;
    }

    .profile-photo-wrapper:hover .profile-photo-img {
      transform: scale(1.02);
    }

    /* KARTU INFORMASI */
    .info-card {
      background: #ffffff;
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 32px 28px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.03);
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .info-card h3 {
      font-size: 19px;
      font-weight: 800;
      margin-bottom: 22px;
      color: #0f172a;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .info-group {
      margin-bottom: 18px;
    }

    .info-group:last-child {
      margin-bottom: 0;
    }

    .info-group label {
      display: block;
      font-size: 11.5px;
      font-weight: 700;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 4px;
    }

    .info-group p, .info-group a {
      font-size: 14px;
      font-weight: 700;
      color: #0f172a;
    }

    .info-group a {
      color: var(--primary);
    }
    .info-group a:hover {
      text-decoration: underline;
    }

    /* GRID BAWAH (DESKRIPSI & QR CODE) */
    .profile-bottom-grid {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 32px;
      padding-bottom: 70px;
      align-items: start;
    }

    .desc-card {
      background: #ffffff;
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 36px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.03);
    }

    .tag-section {
      display: inline-block;
      font-size: 11px;
      font-weight: 800;
      color: var(--primary);
      text-transform: uppercase;
      letter-spacing: 1px;
      background: #ecfdf5;
      padding: 4px 12px;
      border-radius: 20px;
      margin-bottom: 10px;
    }

    .profile-title {
      font-size: 30px;
      font-weight: 800;
      color: #0f172a;
      margin-bottom: 18px;
      letter-spacing: -0.5px;
      line-height: 1.25;
    }

    .profile-desc h4 {
      font-size: 15px;
      font-weight: 800;
      color: #1e293b;
      margin-bottom: 12px;
      line-height: 1.5;
    }

    .profile-desc p {
      font-size: 14px;
      color: #475569;
      line-height: 1.8;
      margin-bottom: 16px;
    }

    .profile-desc p:last-child {
      margin-bottom: 0;
    }

    /* KARTU QR CODE */
    .qr-card {
      background: #ffffff;
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 32px 24px;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      box-shadow: 0 6px 16px rgba(0,0,0,0.03);
    }

    .qr-img-wrapper {
      width: 170px;
      height: 170px;
      padding: 10px;
      background: #fff;
      border: 1.5px solid var(--border);
      border-radius: 12px;
      margin-bottom: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .qr-img-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .qr-label {
      font-size: 13px;
      font-weight: 800;
      color: #0f172a;
      letter-spacing: 0.5px;
    }

    /* FOOTER */
    footer.main-footer { background-color:#052616 !important; color:#94a3b8; padding:55px 20px 24px; margin-top:auto; }
    .footer-grid { display:grid; grid-template-columns:2fr 1fr 1fr 1.5fr; gap:40px; margin-bottom:45px; }
    .footer-brand { display:flex; flex-direction:column; gap:14px; }
    .footer-links h4 { color:#fff; font-size:15px; font-weight:700; margin-bottom:16px; }
    .footer-links ul { display:flex; flex-direction:column; gap:10px; }
    .footer-links a:hover { color:var(--accent); }
    .footer-bottom { display:flex; justify-content:space-between; align-items:center; border-top:1px solid rgba(255,255,255,0.1); padding-top:22px; font-size:12px; }

    @media (max-width:992px) {
      .profile-top-grid, .profile-bottom-grid { grid-template-columns: 1fr; }
      .footer-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width:768px) {
      .nav-toggle { display:block; }
      .nav-menu { display:none; position:absolute; top:100%; left:0; width:100%; background-color:var(--primary); flex-direction:column; padding:20px; gap:14px; }
      .nav-menu.show { display:flex; }
      .dropdown-content { position:static; background:rgba(255,255,255,0.1); width:100%; }
      .dropdown-content.open { display:block; }
      .dropdown-content a { color:#fff; }
      .profile-title { font-size: 24px; }
      .desc-card { padding: 24px; }
      .footer-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

  <!-- NAVBAR DINAMIS TERPUSAT -->
  @include('partials.public_navbar')

  {{-- DETEKSI OTOMATIS FILE GAMBAR PERPUSTAKAAN --}}
  @php
    $perpusImg = null;
    $possiblePaths = [
        'storage/img/cover/perpus.jpeg',
        'storage/img/cover/perpus.jpg',
        'storage/img/perpus.jpeg',
        'storage/img/perpus.jpg',
        'asset/img/cover/perpus.jpeg',
        'asset/img/cover/perpus.jpg',
        'asset/img/perpus.jpeg',
        'asset/img/perpus.jpg',
        'storage/perpus.jpeg',
        'storage/perpus.jpg',
    ];

    foreach ($possiblePaths as $path) {
        if (file_exists(public_path($path))) {
            $perpusImg = asset($path);
            break;
        }
    }

    // Gambar Cadangan jika file lokal belum ditemukan
    if (!$perpusImg) {
        $perpusImg = 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=1200&auto=format&fit=crop&q=80';
    }
  @endphp

  <main class="custom-container">

    <!-- GRID BAGIAN ATAS (FOTO GEDUNG & KARTU INFORMASI) -->
    <div class="profile-top-grid">

      <!-- WADAH FOTO BERSIH DENGAN AUTO-FALLBACK -->
      <div class="profile-photo-wrapper">
        <img
          src="{{ $perpusImg }}"
          alt="Gedung Perpustakaan SMKN 2 Purwakarta"
          class="profile-photo-img"
          onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=1200&auto=format&fit=crop&q=80';"
          loading="lazy"
        >
      </div>

      <!-- KARTU INFORMASI KONTAK -->
      <div class="info-card">
        <h3><i class="fa-solid fa-circle-info" style="color:var(--primary);"></i> Informasi Perpustakaan</h3>

        <div class="info-group">
          <label>Kepala Perpustakaan</label>
          <p>Otniel Lo Ienta, S.Pd., M.M.</p>
        </div>

        <div class="info-group">
          <label>Website Resmi</label>
          <p><a href="#">smkn2pwklibraries.sch.id</a></p>
        </div>

        <div class="info-group">
          <label>Email Layanan</label>
          <p><a href="mailto:smkn2pwklibraries@gmail.com">smkn2pwklibraries@gmail.com</a></p>
        </div>
      </div>

    </div>

    <!-- GRID BAGIAN BAWAH (DESKRIPSI & QR CODE PORTAL) -->
    <div class="profile-bottom-grid">

      <div class="desc-card">
        <div class="tag-section"><i class="fa-solid fa-book-bookmark"></i> TENTANG LAYANAN</div>
        <h1 class="profile-title">SMKN 2 PURWAKARTA LIBRARIES</h1>

        <div class="profile-desc">
          <h4>Layanan perpustakaan digital unggulan yang mendukung komunitas Sekolah Menengah Kejuruan Negeri 2 Purwakarta.</h4>
          <p>
            Misi kami adalah menyediakan layanan literasi dan akses digital yang unggul untuk mendukung tujuan belajar, mengajar, serta pengembangan kompetensi keahlian vokasi di SMKN 2 Purwakarta, sekaligus menjaga ketersediaan beragam sumber belajar akademik dan praktik kejuruan.
          </p>
          <p>
            Jaringan perpustakaan SMKN 2 Purwakarta Libraries mencakup Perpustakaan Utama sebagai pusat literasi dan referensi siswa, serta terintegrasi dengan berbagai sudut baca program keahlian seperti Manajemen Perkantoran & Layanan Bisnis (MPLB), Pemasaran (PM), Rekayasa Perangkat Lunak (RPL/PPLG), Akuntansi, Kuliner, Tata Busana, dan Perhotelan.
          </p>
        </div>
      </div>

      <!-- KARTU QR CODE DIGITAL PORTAL -->
      <div class="qr-card">
        <div class="qr-img-wrapper">
          <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=SMKN2-PURWAKARTA-LIBRARIES-PORTAL" alt="QR Code Portal Perpustakaan">
        </div>
        <div class="qr-label">SMKN 2 PURWAKARTA</div>
        <span style="font-size:11px; color:var(--text-muted); font-weight:600; margin-top:2px;">KARTU DIGITAL PORTAL</span>
      </div>

    </div>

  </main>

  <!-- FOOTER -->
  <footer class="main-footer">
    <div class="custom-container footer-grid">
      <div class="footer-brand">
        @include('partials.logo', ['theme' => 'light'])
        <p style="font-size:13px; line-height:1.6; margin-top:10px;">Layanan perpustakaan digital yang mendukung literasi dan pengembangan keterampilan vokasi siswa.</p>
      </div>

      <div class="footer-links">
        <h4>Menu</h4>
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('/profile') }}" style="color:var(--accent); font-weight:700;">Profile</a></li>
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
        <ul>
          <li><i class="fa-regular fa-envelope"></i> smkn2pwklibraries@gmail.com</li>
          <li><i class="fa-solid fa-globe"></i> smkn2pwklibraries.sch.id</li>
        </ul>
      </div>
    </div>

    <div class="custom-container footer-bottom">
      <p>&copy; 2026 SMKN 2 Purwakarta Libraries. All rights reserved.</p>
    </div>
  </footer>

</body>
</html>
