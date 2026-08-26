<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
    }

    .search-form {
      position: relative;
      display: flex;
      align-items: center;
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

    /* ================= STATS BAR ================= */
    .stats-section {
      padding: 15px 0 40px;
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
    .book-card-carousel:hover { transform: translateY(-4px); box-shadow: 0 10px 20px rgba(0,0,0,0.08); }

    .book-thumb-box {
      width: 100%;
      height: 190px;
      background-color: #e2e8f0;
      overflow: hidden;
      position: relative;
    }

    .book-thumb-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
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
    .footer-bottom { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 18px; font-size: 12px; }

    /* ================= KHUSUS HP (MOBILE TUNTAS) ================= */
    @media (max-width: 768px) {
      .custom-container { padding: 0 16px; }
      .nav-toggle { display: block; }
      .nav-menu { display: none; position: absolute; top: 100%; left: 0; width: 100%; background-color: var(--primary); flex-direction: column; padding: 18px; gap: 12px; }
      .nav-menu.show { display: flex; }
      .dropdown-content { position: static; background: rgba(255,255,255,0.1); width: 100%; }
      .dropdown-content.open { display: block; }
      .dropdown-content a { color: #fff; }

      .hero-title { font-size: 24px; }
      .hero-subtitle { font-size: 12.5px; margin-bottom: 20px; }

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

  <!-- HERO SECTION -->
  <section class="hero-section custom-container">
    <h1 class="hero-title">Welcome to the SMKN 2 Purwakarta Libraries</h1>
    <p class="hero-subtitle">{{ $totalBooksCount ?? 37 }}+ koleksi buku untuk mendukung pembelajaran dan mengatasi kebosanan</p>

    <div class="hero-search-wrapper">
      <form action="{{ url('/collections') }}" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Cari judul, penulis, atau kategori..." required>
        <button type="submit" aria-label="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
    </div>
  </section>

  <!-- ================= STATS BAR ================= -->
  <section class="stats-section custom-container">
    <div class="stats-container">
      <div class="stat-box">
        <h2 class="stat-number">{{ $totalBooksCount ?? 37 }}</h2>
        <p class="stat-label">KOLEKSI BUKU</p>
      </div>
      <div class="stat-divider"></div>
      <div class="stat-box">
        <h2 class="stat-number">{{ $totalCategoriesCount ?? 9 }}</h2>
        <p class="stat-label">KATEGORI</p>
      </div>
      <div class="stat-divider"></div>
      <div class="stat-box">
        <h2 class="stat-number">{{ $totalMembersCount ?? 4 }}</h2>
        <p class="stat-label">ANGGOTA AKTIF</p>
      </div>
    </div>
  </section>

  <!-- ================= REKOMENDASI UNTUK ANDA (SLIDER) ================= -->
  <section class="recommendation-section custom-container">
    <div class="section-header-custom">
      <div>
        <h2 class="section-title"><i class="fa-solid fa-fire-flame-curved" style="color:#ea580c;"></i> Rekomendasi Untuk Anda</h2>
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
              <img src="{{ $buku->cover_url }}" alt="{{ $buku->title }}" loading="lazy">
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
  <section class="category-section">
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
    });
  </script>
</body>
</html>
