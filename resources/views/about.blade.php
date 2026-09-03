<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>About - SMKN 2 Purwakarta Libraries</title>

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

    /* ANTI RUANG PUTIH MOBILE */
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
      background-color: #ffffff;
    }

    * { margin:0; padding:0; box-sizing:border-box; font-family:'Plus Jakarta Sans',sans-serif; }
    body { color:#1e293b; line-height:1.6; }
    a { text-decoration:none; color:inherit; cursor:pointer; }
    ul { list-style:none; }
    .custom-container { max-width:1200px; margin:0 auto; padding:0 20px; width:100%; }

    /* NAVBAR */
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

    /* BANNER */
    .about-hero { background:#334155; color:#fff; text-align:center; padding:55px 0 50px; width:100%; }
    .about-title { font-size:34px; font-weight:800; margin-bottom:8px; letter-spacing:-0.5px; }
    .about-subtitle { font-size:15px; color:#cbd5e1; }

    /* VISI MISI MAIN */
    main.about-main-wrapper {
      flex: 1 0 auto;
      padding: 55px 0 75px;
    }

    .visi-misi-section { display:grid; grid-template-columns:1fr 1.3fr; gap:50px; align-items:start; width:100%; }
    .section-underlined { font-size:26px; font-weight:800; color:#0f172a; position:relative; display:inline-block; margin-bottom:18px; }
    .section-underlined::after { content:''; position:absolute; bottom:-4px; left:0; width:100%; height:3px; background:var(--accent); }
    .visi-col p { font-size:14px; color:#475569; line-height:1.8; }
    .misi-list li { font-size:13.5px; color:#475569; line-height:1.7; margin-bottom:16px; position:relative; padding-left:20px; }
    .misi-list li::before { content:"•"; color:var(--primary); font-size:22px; position:absolute; left:0; top:-4px; }

    /* FOOTER */
    footer.main-footer { background-color:#052616 !important; color:#94a3b8; padding:45px 0 20px; margin-top:auto; width:100%; flex-shrink:0; }
    .footer-grid { display:grid; grid-template-columns:2fr 1fr 1fr 1.5fr; gap:32px; margin-bottom:35px; }
    .footer-brand { display:flex; flex-direction:column; gap:10px; }
    .footer-links h4 { color:#fff; font-size:14px; font-weight:700; margin-bottom:12px; }
    .footer-links ul { display:flex; flex-direction:column; gap:8px; }
    .footer-links a:hover { color:var(--accent); }
    .footer-bottom { display:flex; justify-content:space-between; align-items:center; border-top:1px solid rgba(255,255,255,0.1); padding-top:18px; font-size:12px; }

    @media (max-width:992px) { .visi-misi-section { grid-template-columns:1fr; gap:36px; } .footer-grid { grid-template-columns:1fr 1fr; } }
    @media (max-width:768px) {
      .custom-container { padding: 0 16px; }
      .nav-toggle { display:block; }
      .nav-menu { display:none; position:absolute; top:100%; left:0; width:100%; background-color:var(--primary); flex-direction:column; padding:18px; gap:12px; }
      .nav-menu.show { display:flex; }
      .dropdown-content { position:static; background:rgba(255,255,255,0.1); width:100%; }
      .dropdown-content.open { display:block; }
      .dropdown-content a { color:#fff; }
      .about-hero { padding: 35px 0 30px; }
      .about-title { font-size: 24px; }
      .about-subtitle { font-size: 13px; }
      main.about-main-wrapper { padding: 35px 0 45px; }
      .footer-grid { grid-template-columns: 1fr; gap: 24px; }
      .footer-bottom { flex-direction: column; gap: 8px; text-align: center; }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  @include('partials.public_navbar')

  <!-- BANNER -->
  <section class="about-hero">
    <div class="custom-container">
      <h1 class="about-title">Tentang Perpustakaan Kami</h1>
      <p class="about-subtitle">Pusat literasi masyarakat SDM tinggi dan melek teknologi</p>
    </div>
  </section>

  <!-- VISI MISI -->
  <main class="custom-container about-main-wrapper">
    <div class="visi-misi-section">
      <div class="visi-col">
        <h2 class="section-underlined">Visi</h2>
        <p>
          Menjadi pusat literasi digital unggulan yang tidak hanya menjadi gudang ilmu pengetahuan, tetapi juga ekosistem pembelajaran inovatif yang mampu menginspirasi, memberdayakan, dan membentuk karakter lulusan SMKN 2 Purwakarta agar memiliki kompetensi global dan adaptif terhadap perkembangan zaman.
        </p>
      </div>

      <div class="misi-col">
        <h2 class="section-underlined">Misi</h2>
        <ul class="misi-list">
          <li>Menyediakan koleksi sumber belajar yang lengkap, berbasis digital, dan relevan dengan kurikulum serta kebutuhan dunia kerja.</li>
          <li>Memberikan layanan perpustakaan yang ramah, inklusif, dan profesional agar pengguna merasa nyaman dan termotivasi untuk belajar.</li>
          <li>Mendukung pengembangan keterampilan vokasi siswa melalui penyediaan referensi teknis, buku praktik, dan akses platform belajar digital sesuai program keahlian.</li>
        </ul>
      </div>
    </div>
  </main>

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
            <li><a href="{{ url('/about') }}" style="color:var(--accent); font-weight:700;">About</a></li>
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
    try { sessionStorage.setItem('last_active_page', window.location.pathname); } catch(e) {}
  </script>
</body>
</html>
