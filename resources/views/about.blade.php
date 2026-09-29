<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About - SMKN 2 Purwakarta Libraries</title>

  @include('partials.head', [
    'title' => 'About - SMKN 2 Purwakarta Libraries',
    'description' => 'Tentang Perpustakaan Digital SMKN 2 Purwakarta: visi dan misi dalam mendukung literasi dan keterampilan vokasi siswa.',
  ])

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

    /* RESET & ANTI RUANG PUTIH MOBILE */
    html, body {
      width: 100% !important;
      max-width: 100% !important;
      overflow-x: hidden !important;
      position: relative;
      margin: 0 !important;
      padding: 0 !important;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background-color: #f8fafc !important;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box !important;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
    body { color: #1e293b; line-height: 1.6; }
    a { text-decoration: none; color: inherit; cursor: pointer; }
    ul { list-style: none; }

    /* CONTAINER UTAMA (PASTI DIBERI PADDING SUPAYA TIDAK MENTOK PINGGIR) */
    .custom-container {
      max-width: 1200px !important;
      margin: 0 auto !important;
      padding-left: 24px !important;
      padding-right: 24px !important;
      width: 100% !important;
      box-sizing: border-box !important;
    }

    /* NAVBAR */
    header.main-header { background-color: var(--primary) !important; padding: 14px 0; position: sticky; top: 0; z-index: 9999; box-shadow: 0 2px 10px rgba(0,0,0,0.15); width: 100%; }
    .nav-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; }
    .logo { display: flex; align-items: center; gap: 12px; }
    .nav-menu { display: flex; align-items: center; gap: 24px; }
    .nav-item-link { color: #f1f5f9; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 6px; transition: 0.2s; padding: 6px 0; }
    .nav-item-link:hover, .nav-item-link.active { color: var(--accent); }
    .nav-item-link.active { border-bottom: 2px solid var(--accent); }

    .btn-profile { padding: 6px 18px; border: 1.5px solid rgba(255,255,255,0.5); border-radius: 20px; color: #fff; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: 0.2s; }
    .btn-profile:hover, .btn-profile-active { background-color: #fff; color: var(--primary) !important; border-color: #fff; }

    .btn-user-pill { display: flex; align-items: center; gap: 9px; background: rgba(255,255,255,0.15); padding: 4px 14px 4px 6px; border-radius: 30px; color: #fff; font-size: 13px; font-weight: 700; border: 1.5px solid rgba(255,255,255,0.3); transition: 0.2s; }
    .btn-user-pill:hover, .btn-user-pill.active-pill { background: #fff; color: var(--primary) !important; border-color: #fff; }
    .btn-user-pill:hover .nav-avatar-circle, .btn-user-pill.active-pill .nav-avatar-circle { background: var(--primary); color: #fff; }
    .nav-avatar-circle { width: 30px; height: 30px; border-radius: 50%; background: var(--accent); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800; overflow: hidden; }
    .nav-avatar-circle img { width: 100%; height: 100%; object-fit: cover; }
    .nav-username { max-width: 120px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    .dropdown-wrapper { position: relative; padding-bottom: 10px; margin-bottom: -10px; }
    .dropdown-wrapper .fa-chevron-down { font-size: 10px; transition: transform 0.25s ease; }
    .dropdown-content { display: none; position: absolute; top: 100%; left: 0; background-color: #fff; min-width: 205px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border-radius: 8px; padding: 8px 0; z-index: 10000; }
    .dropdown-content::before { content: ''; position: absolute; top: -12px; left: 0; width: 100%; height: 12px; }
    .dropdown-content a { display: flex; align-items: center; gap: 12px; padding: 10px 18px; color: #334155; font-size: 13px; font-weight: 600; transition: 0.2s; }
    .dropdown-content a i { width: 18px; text-align: center; color: var(--primary); font-size: 14px; }
    .dropdown-content a:hover { background-color: #f1f5f9; color: var(--primary); padding-left: 22px; }

    @media (min-width: 769px) {
      .dropdown-wrapper:hover .dropdown-content { display: block; animation: fadeIn 0.2s ease forwards; }
      .dropdown-wrapper:hover .fa-chevron-down { transform: rotate(180deg); color: var(--accent); }
    }
    @keyframes fadeIn { from{opacity:0; transform:translateY(8px);} to{opacity:1; transform:translateY(0);} }

    .nav-toggle { display: none; background: none; border: none; color: #fff; font-size: 24px; cursor: pointer; }

    /* BANNER HERO */
    .about-hero { background: linear-gradient(135deg, var(--primary-dark, #07351e), var(--primary, #0c4d2d)); color: #fff; text-align: center; padding: 50px 16px 45px; width: 100% !important; box-sizing: border-box !important; }
    .about-title { font-size: 32px; font-weight: 800; margin-bottom: 8px; letter-spacing: -0.5px; }
    .about-subtitle { font-size: 14.5px; color: #cbd5e1; }

    /* VISI MISI MAIN LAYOUT */
    main.about-main-wrapper {
      flex: 1 0 auto;
      padding-top: 45px !important;
      padding-bottom: 65px !important;
      width: 100% !important;
      box-sizing: border-box !important;
    }

    .visi-misi-section {
      display: grid;
      grid-template-columns: 1fr 1.2fr;
      gap: 30px;
      align-items: stretch;
      width: 100% !important;
      box-sizing: border-box !important;
    }

    /* CARD STYLING UNTUK VISI & MISI */
    .about-card {
      background: #ffffff;
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 32px 28px;
      box-shadow: 0 4px 16px rgba(12, 77, 45, 0.05);
      width: 100%;
      box-sizing: border-box;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .about-card:hover {
      box-shadow: 0 8px 24px rgba(12, 77, 45, 0.08);
    }
    .card-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 11px;
      font-weight: 800;
      color: var(--primary);
      text-transform: uppercase;
      letter-spacing: 1px;
      background: #ecfdf5;
      padding: 4px 12px;
      border-radius: 20px;
      margin-bottom: 12px;
    }

    .section-underlined {
      font-size: 24px;
      font-weight: 800;
      color: #0f172a;
      position: relative;
      display: block;
      margin-bottom: 16px;
    }
    .section-underlined::after {
      content: '';
      display: block;
      margin-top: 6px;
      width: 42px;
      height: 3px;
      background: var(--accent);
      border-radius: 2px;
    }

    .visi-text {
      font-size: 14.5px;
      color: #475569;
      line-height: 1.8;
    }

    .misi-list {
      display: flex;
      flex-direction: column;
      gap: 14px;
      padding-left: 18px;
      list-style-type: disc;
    }
    .misi-list li {
      font-size: 14px;
      color: #475569;
      line-height: 1.65;
    }

    /* SCROLL REVEAL */
    .reveal-on-scroll {
      opacity: 0;
      transform: translate3d(0, 18px, 0);
      transition: opacity 0.7s cubic-bezier(0.22, 1, 0.36, 1), transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
      will-change: opacity, transform;
    }
    .reveal-on-scroll.is-revealed {
      opacity: 1;
      transform: none !important;
    }

    /* FOOTER */
    footer.main-footer { background-color: #052616 !important; color: #94a3b8; padding: 45px 0 20px; margin-top: auto; width: 100% !important; flex-shrink: 0; }
    .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 32px; margin-bottom: 35px; }
    .footer-brand { display: flex; flex-direction: column; gap: 10px; }
    .footer-links p.footer-heading { color: #fff; font-size: 14px; font-weight: 700; margin-bottom: 12px; }
    .footer-links ul { display: flex; flex-direction: column; gap: 8px; }
    .footer-links a:hover { color: var(--accent); }
    .footer-bottom { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 18px; font-size: 12px; }
    .footer-contact li { display: flex; align-items: center; gap: 8px; font-size: 13px; margin-bottom: 8px; }
    .footer-contact li i { flex-shrink: 0; }

    @media (max-width: 992px) {
      .visi-misi-section { grid-template-columns: 1fr; gap: 24px; }
      .footer-grid { grid-template-columns: 1fr 1fr; }
    }

    /* ========================================================= */
    /* RESPONSIVE LAYAR HP (< 768px)                             */
    /* ========================================================= */
    @media (max-width: 768px) {
      .custom-container {
        padding-left: 18px !important;
        padding-right: 18px !important;
        max-width: 100% !important;
        width: 100% !important;
        box-sizing: border-box !important;
      }

      .nav-toggle { display: block; }
      .nav-menu { display: none; position: absolute; top: 100%; left: 0; width: 100%; background-color: var(--primary); flex-direction: column; padding: 18px; gap: 12px; }
      .nav-menu.show { display: flex; }
      .dropdown-content { position: static; background: rgba(255,255,255,0.1); width: 100%; }
      .dropdown-content.open { display: block; }
      .dropdown-content a { color: #fff; }

      .about-hero { padding: 36px 16px 30px !important; }
      .about-title { font-size: 22px !important; line-height: 1.3 !important; }
      .about-subtitle { font-size: 12.5px !important; margin-top: 4px !important; }

      main.about-main-wrapper {
        padding-top: 24px !important;
        padding-bottom: 40px !important;
        width: 100% !important;
        box-sizing: border-box !important;
      }

      .visi-misi-section {
        display: flex !important;
        flex-direction: column !important;
        width: 100% !important;
        gap: 18px !important;
        box-sizing: border-box !important;
      }

      .about-card {
        padding: 22px 18px !important;
        border-radius: 14px !important;
      }

      .section-underlined {
        font-size: 20px !important;
        margin-bottom: 12px !important;
      }
      .section-underlined::after {
        width: 36px !important;
        height: 3px !important;
      }

      .visi-text {
        font-size: 13.5px !important;
        line-height: 1.7 !important;
        text-align: left !important;
        word-break: break-word !important;
      }

      .misi-list {
        gap: 12px !important;
      }

      .misi-list li {
        font-size: 13.5px !important;
        line-height: 1.6 !important;
      }

      .footer-grid { grid-template-columns: 1fr 1fr; gap: 14px 18px; margin-bottom: 18px; }
      .footer-brand { grid-column: 1 / -1; display: flex; flex-direction: column; align-items: center; text-align: center; }
      .footer-brand p { display: none; }
      .footer-links p.footer-heading, .footer-links h4 { font-size: 12px; margin-bottom: 8px; color: #fff; }
      .footer-links ul { gap: 5px; }
      .footer-contact li { margin-bottom: 6px; }
      footer.main-footer { padding: 30px 0 16px !important; }
      .footer-bottom { flex-direction: column; gap: 8px; text-align: center; }
    }

    @media (prefers-reduced-motion: reduce) {
      .reveal-on-scroll { opacity: 1; transform: none; transition: none; }
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
    <div class="visi-misi-section reveal-on-scroll">

      <!-- KARTU VISI -->
      <div class="about-card visi-col">
        <h2 class="section-underlined">Visi Kami</h2>
        <p class="visi-text">
          Menjadi pusat literasi digital unggulan yang tidak hanya menjadi gudang ilmu pengetahuan, tetapi juga ekosistem pembelajaran inovatif yang mampu menginspirasi, memberdayakan, dan membentuk karakter lulusan SMKN 2 Purwakarta agar memiliki kompetensi global dan adaptif terhadap perkembangan zaman.
        </p>
      </div>

      <!-- KARTU MISI -->
      <div class="about-card misi-col">
        <h2 class="section-underlined">Misi Kami</h2>
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
          <p class="footer-heading">Menu</p>
          <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/profile') }}">Profile</a></li>
            <li><a href="{{ url('/collections') }}">Collections</a></li>
            <li><a href="{{ url('/about') }}" style="color:var(--accent); font-weight:700;">About</a></li>
          </ul>
        </div>

        <div class="footer-links">
          <p class="footer-heading">Kategori</p>
          <ul>
            @include('partials.footer_categories')
          </ul>
        </div>

        <div class="footer-links">
          <p class="footer-heading">Kontak</p>
          <ul class="footer-contact">
            <li><i class="fa-regular fa-envelope"></i> librarysmkn2pwk@gmail.com</li>
            <li><i class="fa-solid fa-globe"></i> librarysmkn2pwk.site.je</li>
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

    (function() {
      try {
        const reveals = document.querySelectorAll('.reveal-on-scroll');
        if (!reveals.length) return;
        const io = new IntersectionObserver((entries, observer) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              entry.target.classList.add('is-revealed');
              observer.unobserve(entry.target);
            }
          });
        }, { threshold: 0.12 });
        reveals.forEach(el => io.observe(el));
      } catch(e) {}
    })();
  </script>
</body>
</html>
