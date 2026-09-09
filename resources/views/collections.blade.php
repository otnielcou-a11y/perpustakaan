@php
  $referer = request()->header('referer', '');
  $isFromSameCollections = !empty($referer) && (str_contains($referer, '/collections') || str_contains($referer, '/koleksi-buku'));
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Collections - SMKN 2 Purwakarta Libraries</title>

  <script>
    (function() {
      try {
        var ref = document.referrer || '';
        var prev = sessionStorage.getItem('last_active_page') || '';
        var isSameCollections = (ref.indexOf('/collections') !== -1 || ref.indexOf('/koleksi-buku') !== -1) ||
                                (prev === '/collections' || prev === '/koleksi-buku');
        if (isSameCollections) {
          document.documentElement.classList.add('disable-collections-animation');
        }
        sessionStorage.setItem('last_active_page', window.location.pathname);
      } catch(e) {}
    })();
  </script>

  @include('partials.head', [
    'title' => request('search') ? 'Hasil Pencarian: ' . request('search') . ' | SMKN 2 Purwakarta Libraries' : 'Collections - SMKN 2 Purwakarta Libraries',
    'description' => 'Jelajahi koleksi buku kurikulum dan referensi kejuruan di Perpustakaan Digital SMKN 2 Purwakarta.',
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
    body { color:#1e293b; line-height:1.5; }
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

    /* MAIN CONTENT */
    main.collections-main-wrapper {
      flex: 1 0 auto;
      padding-bottom: 50px;
    }

    .page-title-section { padding:40px 0 20px; }
    .page-title-section h1 { font-size:36px; font-weight:800; color:#0f172a; margin-bottom:6px; }
    .page-title-section p { font-size:15px; color:var(--text-muted); }

    .filter-bar {
      display: grid;
      grid-template-columns: 2fr 1.2fr 1fr;
      gap: 16px;
      margin: 24px 0 36px;
      position: relative;
      z-index: 50;
    }
    .search-input-box {
      position: relative;
      display: flex;
      align-items: center;
      z-index: 55;
    }
    .search-input-box i { position:absolute; left:14px; color:var(--text-muted); font-size:14px; }
    .search-input-box input { width:100%; padding:12px 14px 12px 38px; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; font-size:13.5px; }
    .search-input-box input:focus { border-color:var(--primary); }
    .select-custom { width:100%; padding:12px 14px; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; font-size:13.5px; background:#fff; color:#334155; }

    .books-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
      margin-bottom: 40px;
      width: 100%;
      position: relative;
      z-index: 10;
    }
    .book-card-item { background:#ffffff; border:1px solid var(--border); border-radius:14px; overflow:hidden; display:flex; flex-direction:column; transition:transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.25s cubic-bezier(0.16, 1, 0.3, 1); position:relative; }
    .book-card-item:hover {
      transform: translateY(-6px);
      box-shadow: 0 16px 30px rgba(12, 77, 45, 0.12);
    }
    .book-card-item .link-details i {
      transition: transform 0.2s ease;
    }
    .book-card-item:hover .link-details i {
      transform: translateX(4px);
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

    /* KETIKA MASIH DI DALAM CAKUPAN COLLECTIONS (GANTI FILTER / SEARCH / SORT), HAPUS ANIMASI NAIK KE ATAS */
    .disable-collections-animation .reveal-on-scroll,
    body.disable-collections-animation .reveal-on-scroll {
      opacity: 1 !important;
      transform: none !important;
      transition: none !important;
      animation: none !important;
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

    @keyframes skeletonShimmer {
      0% { background-position: -200% 0; }
      100% { background-position: 200% 0; }
    }
    .book-card-img {
      height: 260px;
      overflow: hidden;
      background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
      background-size: 200% 100%;
      animation: skeletonShimmer 1.6s infinite ease-in-out;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .book-card-img::before {
      content: "\f02d";
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
      position: absolute;
      font-size: 36px;
      color: #cbd5e1;
      z-index: 0;
    }
    .book-card-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      position: relative;
      z-index: 1;
      opacity: 0;
      color: transparent;
      transition: opacity 0.35s ease-in-out;
    }
    .book-card-img img.is-loaded {
      opacity: 1;
    }

    .badge-status-book { position:absolute; top:12px; left:12px; padding:4px 10px; border-radius:20px; font-size:11px; font-weight:800; z-index:3 !important; box-shadow:0 2px 6px rgba(0,0,0,0.15); }
    .badge-available { background:var(--primary); color:#ffffff; }
    .badge-borrowed { background:#ef4444; color:#ffffff; }

    .book-card-body { padding:18px; display:flex; flex-direction:column; flex:1; justify-content:space-between; }
    .book-tag { font-size:11px; font-weight:800; color:var(--primary); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px; }
    .book-title { font-size:14.5px; font-weight:800; color:#0f172a; line-height:1.35; margin-bottom:6px; }
    .book-author { font-size:12.5px; color:var(--text-muted); margin-bottom:14px; }
    .book-card-footer { display:flex; justify-content:space-between; align-items:center; border-top:1px solid #f1f5f9; padding-top:12px; font-size:12px; }
    .book-copies { color:#334155; font-weight:700; }
    .link-details { color:var(--primary); font-weight:700; display:flex; align-items:center; gap:4px; }

    .empty-books-state { grid-column:1 / -1; display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:360px; background:#f8fafc; border:2px dashed #cbd5e1; border-radius:16px; text-align:center; padding:40px 20px; width:100%; }
    .empty-books-icon { width:64px; height:64px; border-radius:50%; background:#e2e8f0; display:flex; align-items:center; justify-content:center; font-size:26px; color:#64748b; margin-bottom:14px; }
    .btn-reset-filter { display:inline-flex; align-items:center; gap:8px; padding:10px 24px; background:var(--primary); color:#fff; border-radius:30px; font-size:13px; font-weight:700; }

    .pagination-wrapper { display:flex; justify-content:space-between; align-items:center; margin-bottom:40px; padding-top:20px; border-top:1px solid var(--border); font-size:13px; color:var(--text-muted); }
    .pagination-pages { display:flex; align-items:center; gap:6px; }
    .page-btn { width:34px; height:34px; border-radius:6px; border:1px solid var(--border); background:var(--white); color:#334155; display:flex; align-items:center; justify-content:center; font-size:12.5px; font-weight:700; cursor:pointer; text-decoration:none; }
    .page-btn.active { background:var(--primary); color:var(--white); border-color:var(--primary); }
    .page-btn.disabled { color:#cbd5e1; cursor:not-allowed; background:#f8fafc; }
    .page-dots { padding:0 4px; color:var(--text-muted); font-weight:700; }

    /* FOOTER */
    footer.main-footer { background-color:#052616 !important; color:#94a3b8; padding:45px 0 20px; margin-top:auto; width:100%; flex-shrink:0; }
    .footer-grid { display:grid; grid-template-columns:2fr 1fr 1fr 1.5fr; gap:32px; margin-bottom:35px; }
    .footer-brand { display:flex; flex-direction:column; gap:10px; }
    .footer-links p.footer-heading { color:#fff; font-size:14px; font-weight:700; margin-bottom:12px; }
    .footer-links ul { display:flex; flex-direction:column; gap:8px; }
    .footer-links a:hover { color:var(--accent); }
    .footer-bottom { display:flex; justify-content:space-between; align-items:center; border-top:1px solid rgba(255,255,255,0.1); padding-top:18px; font-size:12px; }
    .footer-contact li { display:flex; align-items:center; gap:8px; font-size:13px; margin-bottom:8px; }
    .footer-contact li i { flex-shrink:0; }

    @media (max-width:992px) { .books-grid { grid-template-columns:repeat(2, 1fr); } .filter-bar { grid-template-columns:1fr; } .footer-grid { grid-template-columns:1fr 1fr; } }
    @media (max-width:768px) {
      .custom-container { padding: 0 16px; }
      .nav-toggle { display:block; }
      .nav-menu { display:none; position:absolute; top:100%; left:0; width:100%; background-color:var(--primary); flex-direction:column; padding:18px; gap:12px; }
      .nav-menu.show { display:flex; }
      .dropdown-content { position:static; background:rgba(255,255,255,0.1); width:100%; }
      .dropdown-content.open { display:block; }
      .dropdown-content a { color:#fff; }
      .books-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
      .book-card-img { height: 200px; }
      .page-title-section { padding: 25px 0 10px; }
      .page-title-section h1 { font-size: 24px; }
      .filter-bar { margin: 16px 0 24px; gap: 10px; }
      .pagination-wrapper { flex-direction: column; align-items: center; gap: 10px; }
      .footer-grid { grid-template-columns: 1fr 1fr; gap: 14px 18px; margin-bottom: 18px; }
      .footer-brand { grid-column: 1 / -1; display:flex; flex-direction:column; align-items:center; text-align:center; }
      .footer-brand p { display:none; }
      .footer-links p.footer-heading, .footer-links h4 { font-size:12px; margin-bottom:8px; color:#fff; }
      .footer-links ul { gap:5px; }
      .footer-contact li { margin-bottom:6px; }
      footer.main-footer { padding: 30px 0 16px; }
      .footer-bottom { flex-direction: column; gap: 8px; text-align: center; }
    }
    @media (max-width: 480px) {
      .books-grid { grid-template-columns: 1fr; }
      .book-card-img { height: 220px; }
    }
  </style>
</head>
<body class="{{ $isFromSameCollections ? 'disable-collections-animation' : '' }}">

  <!-- NAVBAR -->
  @include('partials.public_navbar')

  <main class="custom-container collections-main-wrapper">
    <div class="page-title-section reveal-on-scroll">
      <h1>Collections</h1>
      <p>Jelajahi {{ number_format($books->total()) }}+ koleksi buku kurikulum dan referensi kejuruan SMKN 2 Purwakarta.</p>
    </div>

    <!-- FILTER BAR -->
    <form action="{{ url('/collections') }}" method="GET" class="filter-bar" autocomplete="off">
      <div class="search-input-box" style="position:relative;">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="search" id="collectionsSearchInput" value="{{ request('search') }}" placeholder="Cari judul, penulis, penerbit, atau ISBN..." autocomplete="off">
        <div class="search-suggestions" id="collectionsSearchSuggestions"></div>
      </div>

      <select name="category" class="select-custom" onchange="this.form.submit()">
        <option value="">Semua Kategori ({{ $categories->count() }})</option>
        @if(isset($categories) && count($categories) > 0)
          @foreach($categories as $cat)
            <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>
              {{ $cat->name }}
            </option>
          @endforeach
        @endif
      </select>

      <select name="sort" class="select-custom" onchange="this.form.submit()">
        <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Terbaru</option>
        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Stok Terbanyak</option>
        <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Judul A-Z</option>
        <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Judul Z-A</option>
      </select>
    </form>

    <!-- DAFTAR BUKU -->
    <div class="books-grid" id="booksContainer">
      @forelse($books as $buku)
        <div class="book-card-item reveal-on-scroll">
          <div class="book-card-img">
            @if($buku->stock_available > 0)
              <span class="badge-status-book badge-available">Tersedia ({{ $buku->stock_available }})</span>
            @else
              <span class="badge-status-book badge-borrowed">Dipinjam</span>
            @endif
            <img src="{{ $buku->cover_url }}" alt="{{ $buku->title }}" width="400" height="600" loading="lazy" onload="this.classList.add('is-loaded')" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500&auto=format&fit=crop&q=80'; this.classList.add('is-loaded');">
          </div>

          <div class="book-card-body">
            <div>
              <div class="book-tag">{{ $buku->category }}</div>
              <h2 class="book-title">{{ $buku->title }}</h2>
              <p class="book-author">{{ $buku->author }} • <span style="color:#0c4d2d; font-weight:700;">{{ $buku->publisher ?? 'Erlangga' }}</span></p>
            </div>
            <div class="book-card-footer">
              <span class="book-copies">{{ $buku->stock_total }} Copies</span>
              <a href="{{ url('/buku/' . $buku->id) }}" class="link-details">Details <i class="fa-solid fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      @empty
        <div class="empty-books-state">
          <div class="empty-books-icon"><i class="fa-solid fa-book-open"></i></div>
          <h2 style="color:#0f172a; font-size:18px; font-weight:800; margin-bottom:6px;">Tidak ada buku ditemukan</h2>
          <p style="font-size:13.5px; color:var(--text-muted); max-width:440px; margin-bottom:20px;">
            @if(request('category'))
              Belum ada koleksi buku terdaftar pada kategori "<strong>{{ request('category') }}</strong>".
            @elseif(request('search'))
              Tidak ditemukan buku dengan kata kunci "<strong>{{ request('search') }}</strong>".
            @else
              Belum ada data buku yang tersedia.
            @endif
          </p>
          <a href="{{ url('/collections') }}" class="btn-reset-filter">Tampilkan Semua Koleksi</a>
        </div>
      @endforelse
    </div>

    <!-- PAGINATION -->
    @if ($books->hasPages())
      <div class="pagination-wrapper">
        <div>
          Showing <strong>{{ $books->firstItem() ?? 0 }}</strong> to <strong>{{ $books->lastItem() ?? 0 }}</strong> of <strong>{{ number_format($books->total()) }}</strong> entries
        </div>

        <div class="pagination-pages">
          @if ($books->onFirstPage())
            <span class="page-btn disabled"><i class="fa-solid fa-chevron-left"></i></span>
          @else
            <a href="{{ $books->previousPageUrl() }}" class="page-btn"><i class="fa-solid fa-chevron-left"></i></a>
          @endif

          @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
            @if ($page == $books->currentPage())
              <span class="page-btn active">{{ $page }}</span>
            @elseif ($page == 1 || $page == $books->lastPage() || ($page >= $books->currentPage() - 1 && $page <= $books->currentPage() + 1))
              <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
            @elseif ($page == 2 || $page == $books->lastPage() - 1)
              <span class="page-dots">...</span>
            @endif
          @endforeach

          @if ($books->hasMorePages())
            <a href="{{ $books->nextPageUrl() }}" class="page-btn"><i class="fa-solid fa-chevron-right"></i></a>
          @else
            <span class="page-btn disabled"><i class="fa-solid fa-chevron-right"></i></span>
          @endif
        </div>
      </div>
    @endif
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
            <li><a href="{{ url('/collections') }}" style="color:var(--accent); font-weight:700;">Collections</a></li>
            <li><a href="{{ url('/about') }}">About</a></li>
          </ul>
        </div>

        <div class="footer-links">
          <p class="footer-heading">Kategori</p>
          <ul>
            @if(isset($categories))
              @foreach($categories->take(4) as $cat)
                <li><a href="{{ url('/collections?category=' . urlencode($cat->name)) }}">{{ $cat->name }}</a></li>
              @endforeach
            @endif
          </ul>
        </div>

        <div class="footer-links">
          <p class="footer-heading">Kontak</p>
          <ul class="footer-contact">
            <li><i class="fa-regular fa-envelope"></i> library.smkn2pwk.sch.id</li>
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
    document.addEventListener('DOMContentLoaded', function() {
      // 1. Check already cached images
      document.querySelectorAll('.book-card-img img').forEach(function(img) {
        if (img.complete && img.naturalHeight !== 0) {
          img.classList.add('is-loaded');
        }
      });

      // 2. LIVE SEARCH SUGGESTIONS
      const searchInput = document.getElementById('collectionsSearchInput');
      const suggestionsBox = document.getElementById('collectionsSearchSuggestions');
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
                    <a href="{{ url('/collections') }}?search=${encodeURIComponent(q)}">Terapkan pencarian <i class="fa-solid fa-arrow-right"></i></a>
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

      // 3. SCROLL REVEAL (FADE-UP ON SCROLL)
      const isAnimDisabled = document.documentElement.classList.contains('disable-collections-animation') ||
                             document.body.classList.contains('disable-collections-animation');

      const reveals = document.querySelectorAll('.reveal-on-scroll');
      if (isAnimDisabled) {
        reveals.forEach(el => el.classList.add('is-revealed'));
      } else if (reveals.length > 0) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              entry.target.classList.add('is-revealed');
              observer.unobserve(entry.target);
            }
          });
        }, { threshold: 0.08 });

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
    });
  </script>

  <!-- FLOATING BACK TO TOP BUTTON -->
  <button type="button" class="back-to-top-btn" id="backToTopBtn" aria-label="Kembali ke atas">
    <i class="fa-solid fa-arrow-up"></i>
  </button>
</body>
</html>
