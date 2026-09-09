<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMKN 2 Purwakarta Libraries - Home</title>

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

    /* ================= RESET & PENCEGAH BOCOR LAYAR (ANTI-OVERFLOW) ================= */
    html, body {
      width: 100%;
      max-width: 100%;
      overflow-x: hidden !important;
      position: relative;
      margin: 0;
      padding: 0;
    }

    * { margin:0; padding:0; box-sizing:border-box; font-family:'Plus Jakarta Sans',sans-serif; }
    body { background-color:#ffffff; color:#1e293b; line-height:1.5; min-height:100vh; display:flex; flex-direction:column; }
    a { text-decoration:none; color:inherit; cursor:pointer; }
    ul { list-style:none; }
    .custom-container { max-width:1200px; margin:0 auto; padding:0 20px; width:100%; }

    /* PEMBUNGKUS UTAMA: RATA TENGAH + BATAS LEBAR + JARAK AMAN SAMPING */
    .site-main { max-width:1200px; margin:0 auto; padding:0 20px; width:100%; flex:1; }

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

    /* ================= HERO SECTION ================= */
    .hero-section {
      padding: 50px 0 20px;
      text-align: center;
      position: relative;
      z-index: 50;
    }

    .hero-title {
      font-size: 36px;
      font-weight: 800;
      color: #0f172a;
      letter-spacing: -0.5px;
      margin-bottom: 10px;
      line-height: 1.2;
    }

    .hero-subtitle {
      font-size: 14.5px;
      color: var(--text-muted);
      margin-bottom: 26px;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    .hero-search-wrapper {
      max-width: 560px;
      margin: 0 auto;
      position: relative;
      z-index: 55;
    }

    .search-form {
      position: relative;
      display: flex;
      align-items: center;
      z-index: 60;
    }

    .search-form input {
      width: 100%;
      padding: 13px 50px 13px 22px;
      font-size: 13.5px;
      border: 1.5px solid #cbd5e1;
      border-radius: 30px;
      outline: none;
      box-shadow: 0 2px 6px rgba(0,0,0,0.04);
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .search-form input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(12, 77, 45, 0.1);
    }

    .search-form button {
      position: absolute;
      right: 5px;
      width: 38px;
      height: 38px;
      background-color: var(--primary);
      color: var(--white);
      border: none;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.2s, transform 0.2s;
    }

    .search-form button:hover {
      background-color: var(--primary-dark);
      transform: scale(1.05);
    }

    /* ================= SEARCH SUGGESTIONS ================= */
    .search-suggestions {
      position: absolute;
      top: calc(100% + 8px);
      left: 0;
      right: 0;
      background: #ffffff !important;
      border: 1px solid #cbd5e1;
      border-radius: 14px;
      box-shadow: 0 20px 45px rgba(0,0,0,0.18);
      z-index: 99999 !important;
      overflow: hidden;
      display: none;
      text-align: left;
      animation: suggestFadeIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes suggestFadeIn {
      from { opacity: 0; transform: translateY(-6px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .suggestion-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 14px;
      text-decoration: none;
      color: #0f172a;
      transition: background-color 0.15s ease;
      border-bottom: 1px solid #f8fafc;
    }
    .suggestion-item:last-child {
      border-bottom: none;
    }
    .suggestion-item:hover, .suggestion-item.active {
      background-color: #f1f8f4;
    }
    .suggestion-thumb {
      width: 36px;
      height: 48px;
      border-radius: 4px;
      object-fit: cover;
      background: #e2e8f0;
      flex-shrink: 0;
    }
    .suggestion-info {
      flex: 1;
      min-width: 0;
    }
    .suggestion-title {
      font-size: 13px;
      font-weight: 700;
      color: #0f172a;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      margin-bottom: 2px;
    }
    .suggestion-meta {
      font-size: 11.5px;
      color: var(--text-muted);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .suggestion-badge {
      font-size: 10.5px;
      font-weight: 700;
      padding: 3px 8px;
      border-radius: 12px;
      flex-shrink: 0;
    }
    .suggestion-badge.avail {
      background: #ecfdf5;
      color: #065f46;
    }
    .suggestion-badge.borrowed {
      background: #fef2f2;
      color: #991b1b;
    }
    .suggestion-footer {
      padding: 10px 14px;
      background: #f8fafc;
      border-top: 1px solid #e2e8f0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 11.5px;
      color: var(--text-muted);
    }
    .suggestion-footer a {
      color: var(--primary);
      font-weight: 700;
      text-decoration: none;
    }
    .suggestion-footer a:hover {
      text-decoration: underline;
    }
    .suggestion-empty {
      padding: 18px 14px;
      text-align: center;
      color: var(--text-muted);
      font-size: 12.5px;
    }

    /* ================= SCROLL REVEAL ANIMATIONS ================= */
    .reveal-on-scroll {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .reveal-on-scroll.is-revealed {
      opacity: 1;
      transform: none !important;
    }

    /* ================= FLOATING BACK TO TOP ================= */
    .back-to-top-btn {
      position: fixed;
      bottom: 28px;
      right: 28px;
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: var(--primary);
      color: #ffffff;
      border: none;
      box-shadow: 0 6px 18px rgba(12, 77, 45, 0.35);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 15px;
      z-index: 999;
      opacity: 0;
      visibility: hidden;
      transform: scale(0.6) translateY(20px);
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .back-to-top-btn.show {
      opacity: 1;
      visibility: visible;
      transform: scale(1) translateY(0);
    }
    .back-to-top-btn:hover {
      background: var(--primary-dark);
      transform: scale(1.1) translateY(-3px);
      box-shadow: 0 10px 24px rgba(12, 77, 45, 0.45);
    }

    /* ================= STATS BAR ================= */
    .stats-section {
      padding: 15px 0 40px;
      position: relative;
      z-index: 20;
    }

    .stats-container {
      display: flex;
      justify-content: center;
      align-items: center;
      max-width: 700px;
      margin: 0 auto;
      gap: 12px;
    }

    .stat-box {
      flex: 1;
      text-align: center;
    }

    .stat-number {
      font-size: 32px;
      font-weight: 800;
      color: var(--primary);
      line-height: 1.1;
      margin-bottom: 4px;
    }

    .stat-label {
      font-size: 11px;
      font-weight: 700;
      color: var(--text-muted);
      letter-spacing: 1px;
    }

    .stat-divider {
      width: 1px;
      height: 35px;
      background-color: #e2e8f0;
    }

    /* ================= REKOMENDASI UNTUK ANDA & SLIDER ================= */
    .recommendation-section {
      padding: 10px 0 50px;
      position: relative;
      width: 100%;
    }

    .section-header-custom {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 18px;
    }

    .section-title { font-size: 22px; font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 6px; }
    .section-desc { font-size: 12.5px; color: var(--text-muted); margin-top: 2px; }
    .see-more-link { font-size: 13px; font-weight: 700; color: var(--primary); display: flex; align-items: center; gap: 6px; white-space: nowrap; }
    .see-more-link:hover { text-decoration: underline; }

    /* WRAPPER SLIDER TERKUNCI DIDALAM CONTAINER (ANTI-LEBAR) */
    .carousel-outer-container {
      position: relative;
      display: flex;
      align-items: center;
      width: 100%;
      overflow: hidden; /* Mencegah panah keluar batas layar */
      padding: 0 4px;
    }

    .slider-nav-btn {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #ffffff;
      border: 1.5px solid var(--border);
      color: var(--primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 15px;
      cursor: pointer;
      z-index: 20;
      box-shadow: 0 4px 14px rgba(0,0,0,0.15);
      transition: all 0.2s ease;
    }

    .slider-nav-btn:hover {
      background: var(--primary);
      color: #ffffff;
      border-color: var(--primary);
      transform: translateY(-50%) scale(1.08);
    }

    .slider-nav-btn.btn-prev { left: 4px; }
    .slider-nav-btn.btn-next { right: 4px; }

    /* TRACK CAROUSEL */
    .books-carousel-track {
      display: flex;
      gap: 16px;
      overflow-x: auto;
      scroll-behavior: smooth;
      scroll-snap-type: x mandatory;
      padding: 10px 4px 18px;
      width: 100%;
      -ms-overflow-style: none;
      scrollbar-width: none;
      -webkit-overflow-scrolling: touch;
    }
    .books-carousel-track::-webkit-scrollbar { display: none; }

    .book-card-carousel {
      flex: 0 0 calc(25% - 12px);
      scroll-snap-align: start;
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 14px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      position: relative;
    }
    .book-card-carousel:hover {
      transform: translateY(-6px);
      box-shadow: 0 16px 30px rgba(12, 77, 45, 0.12);
    }
    .book-card-carousel .btn-detail-link i {
      transition: transform 0.2s ease;
    }
    .book-card-carousel:hover .btn-detail-link i {
      transform: translateX(4px);
    }

    @keyframes skeletonShimmer {
      0% { background-position: -200% 0; }
      100% { background-position: 200% 0; }
    }

    .book-thumb-box {
      width: 100%;
      height: 190px;
      background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
      background-size: 200% 100%;
      animation: skeletonShimmer 1.6s infinite ease-in-out;
      overflow: hidden;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .book-thumb-box::before {
      content: "\f02d";
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
      position: absolute;
      font-size: 32px;
      color: #cbd5e1;
      z-index: 0;
    }

    .book-thumb-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      position: relative;
      z-index: 1;
      opacity: 0;
      color: transparent;
      transition: opacity 0.35s ease-in-out;
    }

    .book-thumb-box img.is-loaded {
      opacity: 1;
    }

    .badge-status-pill { position: absolute; top: 10px; left: 10px; padding: 4px 10px; border-radius: 20px; font-size: 10.5px; font-weight: 800; z-index: 3; }
    .badge-available { background: var(--primary); color: #fff; }
    .badge-out { background: #ef4444; color: #fff; }

    .book-info-box { padding: 14px; display: flex; flex-direction: column; justify-content: space-between; flex: 1; }
    .book-category-tag { font-size: 10.5px; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
    .book-title-text { font-size: 13.5px; font-weight: 800; color: #0f172a; line-height: 1.35; margin-bottom: 4px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .book-author-text { font-size: 11.5px; color: var(--text-muted); }

    .book-card-footer { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 10px; margin-top: 10px; font-size: 12px; }
    .book-copies-text { font-weight: 700; color: #334155; }
    .btn-detail-link { color: var(--primary); font-weight: 700; display: flex; align-items: center; gap: 4px; }

    /* CATEGORIES SECTION */
    .category-section { background-color: var(--primary); padding: 45px 0; text-align: center; color: #ffffff; width: 100%; }
    .category-title { font-size: 20px; font-weight: 800; margin-bottom: 20px; }
    .category-pills { display: flex; justify-content: center; align-items: center; gap: 10px; flex-wrap: wrap; }
    .cat-pill { padding: 8px 20px; background-color: rgba(255,255,255,0.15); color: #fff; border-radius: 30px; font-size: 12.5px; font-weight: 700; transition: all 0.2s ease; display: flex; align-items: center; gap: 8px; }
    .cat-pill:hover { background-color: #fff; color: var(--primary); transform: translateY(-2px); }
    .cat-pill-icon { width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center; border-radius: 50%; }

    /* FOOTER */
    footer.main-footer { background-color: #052616 !important; color: #94a3b8; padding: 45px 0 20px; margin-top: auto; width: 100%; }
    .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 32px; margin-bottom: 35px; }
    .footer-brand { display: flex; flex-direction: column; gap: 10px; }
    .footer-links h4 { color: #fff; font-size: 14px; font-weight: 700; margin-bottom: 12px; }
    .footer-links ul { display: flex; flex-direction: column; gap: 8px; }
    .footer-links a:hover { color: var(--accent); }
    .footer-contact li { display: flex; align-items: center; gap: 8px; font-size: 13px; margin-bottom: 8px; }
    .footer-contact li i { flex-shrink: 0; }
    .footer-bottom { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 18px; font-size: 12px; }

    /* ================= KHUSUS HP (MOBILE TUNTAS) ================= */
    @media (max-width: 992px) {
      /* Tablet: Footer 2 kolom */
      .footer-grid { grid-template-columns: 1fr 1fr; gap: 24px; }
      /* Tablet: Book card lebih lebar */
      .book-card-carousel { flex: 0 0 calc(45% - 8px); }
      /* Tablet: Stats container lebih kompak */
      .stats-container { max-width: 100%; gap: 8px; }
      .stat-number { font-size: 28px; }
    }

    @media (max-width: 768px) {
      .custom-container, .site-main { padding-left: 16px; padding-right: 16px; }
      .nav-toggle { display: block; }
      .nav-menu { display: none; position: absolute; top: 100%; left: 0; width: 100%; background-color: var(--primary); flex-direction: column; padding: 18px; gap: 12px; }
      .nav-menu.show { display: flex; }
      .dropdown-content { position: static; background: rgba(255,255,255,0.1); width: 100%; }
      .dropdown-content.open { display: block; }
      .dropdown-content a { color: #fff; }

      .hero-title { font-size: 24px; }
      .hero-subtitle { font-size: 12.5px; margin-bottom: 20px; }
      .hero-section { padding: 36px 0 16px; }

      /* STATISTIK DI HP TETAP 1 BARIS SEJAJAR */
      .stats-container { gap: 4px; }
      .stat-number { font-size: 22px; }
      .stat-label { font-size: 9px; letter-spacing: 0.5px; }
      .stat-divider { height: 26px; }

      /* HEADER SLIDER */
      .section-header-custom {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
      }
      .section-title { font-size: 16px; }
      .section-desc { display: none; } /* Sembunyikan sub-teks panjang di HP agar bersih */
      .see-more-link { font-size: 12px; }

      /* KARTU SLIDER BERUKURAN PAS DI LAYAR HP */
      .book-card-carousel {
        flex: 0 0 210px;
      }
      .book-thumb-box { height: 160px; }
      .book-info-box { padding: 12px; }

      .slider-nav-btn { display: none !important; } /* Di HP gunakan usapan jari (swipe) */
      .footer-grid { grid-template-columns: 1fr; gap: 24px; }
      .footer-bottom { flex-direction: column; gap: 8px; text-align: center; }
    }
  </style>
</head>
<body>

  <!-- NAVBAR DINAMIS TERPUSAT -->
  @include('partials.public_navbar')

  @if(session('success'))
    <div style="background:#d1fae5; border:1px solid #a7f3d0; color:#065f46; padding:12px 18px; border-radius:8px; margin:16px auto 0; max-width:1200px; font-weight:700; font-size:13px; display:flex; align-items:center; gap:8px;">
      <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
  @endif

  <!-- ================= PEMBUNGKUS UTAMA (RATA TENGAH) ================= -->
  <main class="site-main">

  <!-- HERO SECTION -->
  <section class="hero-section">
    <h1 class="hero-title">Welcome to the SMKN 2 Purwakarta Libraries</h1>
    <p class="hero-subtitle">{{ $totalBooksCount ?? 37 }}+ koleksi buku untuk mendukung pembelajaran dan mengatasi kebosanan</p>

    <div class="hero-search-wrapper">
      <form action="{{ url('/collections') }}" method="GET" class="search-form" id="heroSearchForm" autocomplete="off">
        <input type="text" name="search" id="heroSearchInput" placeholder="Cari judul, penulis, atau kategori..." required autocomplete="off">
        <button type="submit" aria-label="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
        <div class="search-suggestions" id="heroSearchSuggestions"></div>
      </form>
    </div>
  </section>

  <!-- ================= STATS BAR ================= -->
  <section class="stats-section reveal-on-scroll">
    <div class="stats-container">
      <div class="stat-box">
        <h2 class="stat-number count-up" data-target="{{ $totalBooksCount ?? 37 }}">0</h2>
        <p class="stat-label">KOLEKSI BUKU</p>
      </div>
      <div class="stat-divider"></div>
      <div class="stat-box">
        <h2 class="stat-number count-up" data-target="{{ $totalCategoriesCount ?? 9 }}">0</h2>
        <p class="stat-label">KATEGORI</p>
      </div>
      <div class="stat-divider"></div>
      <div class="stat-box">
        <h2 class="stat-number count-up" data-target="{{ $totalMembersCount ?? 4 }}">0</h2>
        <p class="stat-label">ANGGOTA AKTIF</p>
      </div>
    </div>
  </section>

  <!-- ================= REKOMENDASI UNTUK ANDA (SLIDER) ================= -->
  <section class="recommendation-section reveal-on-scroll">
    <div class="section-header-custom">
      <div>
        <h2 class="section-title">Rekomendasi Untuk Anda</h2>
        <p class="section-desc">Pilihan buku acak menarik yang disesuaikan khusus untuk mendukung referensi belajar Anda.</p>
      </div>

      <a href="{{ url('/collections') }}" class="see-more-link">Lihat semua <i class="fa-solid fa-arrow-right"></i></a>
    </div>

    <div class="carousel-outer-container">

      <!-- TOMBOL PANAH DESKTOP -->
      <button type="button" class="slider-nav-btn btn-prev" id="slidePrevBtn" aria-label="Previous">
        <i class="fa-solid fa-chevron-left"></i>
      </button>

      <!-- TRACK BUKU SLIDER -->
      <div class="books-carousel-track" id="booksTrack">
        @forelse($recommendedBooks as $buku)
          <div class="book-card-carousel">
            <div class="book-thumb-box">
              @if($buku->stock_available > 0)
                <span class="badge-status-pill badge-available">Tersedia ({{ $buku->stock_available }})</span>
              @else
                <span class="badge-status-pill badge-out">Dipinjam</span>
              @endif
              <img src="{{ $buku->cover_url }}" alt="{{ $buku->title }}" loading="lazy" onload="this.classList.add('is-loaded')" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500&auto=format&fit=crop&q=80'; this.classList.add('is-loaded');">
            </div>

            <div class="book-info-box">
              <div>
                <span class="book-category-tag">{{ $buku->category }}</span>
                <h3 class="book-title-text" title="{{ $buku->title }}">{{ $buku->title }}</h3>
                <p class="book-author-text">{{ $buku->author }} • <span style="color:#0c4d2d; font-weight:700;">{{ $buku->publisher ?? 'Erlangga' }}</span></p>
              </div>

              <div class="book-card-footer">
                <span class="book-copies-text">{{ $buku->stock_total }} Copies</span>
                <a href="{{ url('/buku/' . $buku->id) }}" class="btn-detail-link">
                  Details <i class="fa-solid fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        @empty
          <p style="text-align:center; width:100%; color:var(--text-muted); padding:30px 0;">Belum ada buku rekomendasi di database.</p>
        @endforelse
      </div>

      <button type="button" class="slider-nav-btn btn-next" id="slideNextBtn" aria-label="Next">
        <i class="fa-solid fa-chevron-right"></i>
      </button>

    </div>
  </section>

  <!-- ================= KATEGORI SECTION ================= -->
  </main>

  <!-- ================= KATEGORI SECTION (BAND HIJAU FULL LEBAR) ================= -->
  <section class="category-section reveal-on-scroll">
    <div class="custom-container">
      <h2 class="category-title">Jelajahi Berdasarkan Kategori Kejuruan</h2>
      <div class="category-pills">
        @if(isset($categories) && count($categories) > 0)
          @foreach($categories->take(6) as $cat)
            <a href="{{ url('/collections?category=' . urlencode($cat->name)) }}" class="cat-pill">
              <i class="fa-solid {{ $cat->icon ?? 'fa-book' }}"></i> {{ $cat->name }}
            </a>
          @endforeach
        @endif
        <a href="{{ url('/collections') }}" class="cat-pill cat-pill-icon" title="Lihat Semua Kategori"><i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
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
            <li><a href="{{ url('/') }}" style="color:var(--accent); font-weight:700;">Home</a></li>
            <li><a href="{{ url('/profile') }}">Profile</a></li>
            <li><a href="{{ url('/collections') }}">Collections</a></li>
            <li><a href="{{ url('/about') }}">About</a></li>
          </ul>
        </div>

        <div class="footer-links">
          <h4>Kategori</h4>
          <ul>
            @if(isset($categories))
              @foreach($categories->take(4) as $cat)
                <li><a href="{{ url('/collections?category=' . urlencode($cat->name)) }}">{{ $cat->name }}</a></li>
              @endforeach
            @endif
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

  <!-- JAVASCRIPT SLIDER -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const track = document.getElementById('booksTrack');
      const prevBtn = document.getElementById('slidePrevBtn');
      const nextBtn = document.getElementById('slideNextBtn');

      if (track && prevBtn && nextBtn) {
        const getScrollAmount = () => {
          const card = track.querySelector('.book-card-carousel');
          return card ? (card.offsetWidth + 16) : 220;
        };

        function slideNext() {
          const maxScrollLeft = track.scrollWidth - track.clientWidth;
          if (track.scrollLeft >= maxScrollLeft - 15) {
            track.scrollTo({ left: 0, behavior: 'smooth' });
          } else {
            track.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
          }
        }

        function slidePrev() {
          if (track.scrollLeft <= 15) {
            track.scrollTo({ left: track.scrollWidth, behavior: 'smooth' });
          } else {
            track.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' });
          }
        }

        nextBtn.addEventListener('click', () => { slideNext(); resetAutoSlide(); });
        prevBtn.addEventListener('click', () => { slidePrev(); resetAutoSlide(); });

        let autoSlideTimer = setInterval(slideNext, 3500);

        function resetAutoSlide() {
          clearInterval(autoSlideTimer);
          autoSlideTimer = setInterval(slideNext, 3500);
        }

        track.addEventListener('mouseenter', () => clearInterval(autoSlideTimer));
        track.addEventListener('mouseleave', () => resetAutoSlide());
        track.addEventListener('touchstart', () => clearInterval(autoSlideTimer), { passive: true });
        track.addEventListener('touchend', () => resetAutoSlide());
      }

      // Check already cached images
      document.querySelectorAll('.book-thumb-box img').forEach(function(img) {
        if (img.complete && img.naturalHeight !== 0) {
          img.classList.add('is-loaded');
        }
      });

      // 1. LIVE SEARCH SUGGESTIONS
      const searchInput = document.getElementById('heroSearchInput');
      const suggestionsBox = document.getElementById('heroSearchSuggestions');
      let debounceTimer = null;

      if (searchInput && suggestionsBox) {
        searchInput.addEventListener('input', function() {
          const q = this.value.trim();
          clearTimeout(debounceTimer);
          if (q.length < 2) {
            suggestionsBox.style.display = 'none';
            suggestionsBox.innerHTML = '';
            return;
          }

          debounceTimer = setTimeout(() => {
            fetch(`{{ url('/api/books/suggest') }}?q=${encodeURIComponent(q)}`)
              .then(res => res.json())
              .then(data => {
                if (!Array.isArray(data) || data.length === 0) {
                  suggestionsBox.innerHTML = `
                    <div class="suggestion-empty">
                      <i class="fa-solid fa-book-open" style="margin-right:6px; opacity:0.6;"></i>
                      Tidak ditemukan buku yang cocok dengan "<strong>${escapeHtml(q)}</strong>"
                    </div>
                  `;
                  suggestionsBox.style.display = 'block';
                  return;
                }

                let html = '';
                data.forEach(book => {
                  const badgeClass = book.stock_available > 0 ? 'avail' : 'borrowed';
                  const badgeText = book.stock_available > 0 ? `Tersedia (${book.stock_available})` : 'Dipinjam';
                  html += `
                    <a href="${book.url}" class="suggestion-item">
                      <img src="${book.cover_url}" class="suggestion-thumb" alt="${escapeHtml(book.title)}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500&auto=format&fit=crop&q=80';">
                      <div class="suggestion-info">
                        <div class="suggestion-title">${escapeHtml(book.title)}</div>
                        <div class="suggestion-meta">${escapeHtml(book.author)} • ${escapeHtml(book.category)}</div>
                      </div>
                      <span class="suggestion-badge ${badgeClass}">${badgeText}</span>
                    </a>
                  `;
                });

                html += `
                  <div class="suggestion-footer">
                    <span>${data.length} buku disarankan</span>
                    <a href="{{ url('/collections') }}?search=${encodeURIComponent(q)}">Lihat semua hasil <i class="fa-solid fa-arrow-right"></i></a>
                  </div>
                `;

                suggestionsBox.innerHTML = html;
                suggestionsBox.style.display = 'block';
              })
              .catch(() => {
                suggestionsBox.style.display = 'none';
              });
          }, 220);
        });

        document.addEventListener('click', function(e) {
          if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.style.display = 'none';
          }
        });

        searchInput.addEventListener('focus', function() {
          if (suggestionsBox.innerHTML.trim() !== '' && this.value.trim().length >= 2) {
            suggestionsBox.style.display = 'block';
          }
        });
      }

      function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
      }

      // 2. COUNTER ANGKA BERJALAN
      const countUpElements = document.querySelectorAll('.count-up');
      if (countUpElements.length > 0) {
        const runCounter = (el) => {
          const target = parseInt(el.getAttribute('data-target'), 10) || 0;
          const duration = 1200;
          const start = performance.now();

          function step(now) {
            const elapsed = now - start;
            const progress = Math.min(elapsed / duration, 1);
            const ease = 1 - Math.pow(1 - progress, 3); // cubic ease-out
            const current = Math.floor(ease * target);
            el.textContent = current.toLocaleString('id-ID');
            if (progress < 1) {
              requestAnimationFrame(step);
            } else {
              el.textContent = target.toLocaleString('id-ID');
            }
          }
          requestAnimationFrame(step);
        };

        const counterObserver = new IntersectionObserver((entries, observer) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              runCounter(entry.target);
              observer.unobserve(entry.target);
            }
          });
        }, { threshold: 0.25 });

        countUpElements.forEach(el => counterObserver.observe(el));
      }

      // 3. SCROLL REVEAL (FADE-UP ON SCROLL)
      const reveals = document.querySelectorAll('.reveal-on-scroll');
      if (reveals.length > 0) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              entry.target.classList.add('is-revealed');
              observer.unobserve(entry.target);
            }
          });
        }, { threshold: 0.1 });

        reveals.forEach(el => revealObserver.observe(el));
      }

      // 4. FLOATING BACK TO TOP
      const backToTopBtn = document.getElementById('backToTopBtn');
      if (backToTopBtn) {
        window.addEventListener('scroll', () => {
          if (window.scrollY > 280) {
            backToTopBtn.classList.add('show');
          } else {
            backToTopBtn.classList.remove('show');
          }
        }, { passive: true });

        backToTopBtn.addEventListener('click', () => {
          window.scrollTo({ top: 0, behavior: 'smooth' });
        });
      }

      // Track active page
      try {
        sessionStorage.setItem('last_active_page', window.location.pathname);
      } catch(e) {}
    });
  </script>

  <!-- FLOATING BACK TO TOP BUTTON -->
  <button type="button" class="back-to-top-btn" id="backToTopBtn" aria-label="Kembali ke atas">
    <i class="fa-solid fa-arrow-up"></i>
  </button>
</body>
</html>
