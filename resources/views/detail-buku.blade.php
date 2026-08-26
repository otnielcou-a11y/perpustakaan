<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>{{ $book->title }} - Detail Buku</title>

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

    /* DETAIL MAIN WRAPPER */
    main.detail-main-wrapper {
      flex: 1 0 auto;
      padding-bottom: 50px;
    }

    .breadcrumb-nav { padding:24px 0 10px; font-size:13px; color:var(--text-muted); display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
    .breadcrumb-nav a:hover { color:var(--primary); font-weight:700; }

    .detail-grid { display:grid; grid-template-columns:360px 1fr; gap:48px; padding:30px 0 50px; align-items:start; width:100%; }
    .book-cover-wrap { background:#f8fafc; border:1px solid var(--border); border-radius:16px; padding:24px; text-align:center; box-shadow:0 10px 25px rgba(0,0,0,0.05); }
    .book-cover-img { width:100%; height:450px; object-fit:cover; border-radius:10px; box-shadow:0 12px 24px rgba(0,0,0,0.12); }

    .tag-category { display:inline-block; padding:5px 14px; background:#ecfdf5; color:var(--primary); font-size:12px; font-weight:800; border-radius:20px; margin-bottom:12px; text-transform:uppercase; }
    .detail-title { font-size:34px; font-weight:800; color:#0f172a; line-height:1.25; margin-bottom:8px; }
    .detail-author { font-size:15px; color:var(--text-muted); margin-bottom:24px; }
    .detail-author strong { color:var(--primary); font-weight:700; }

    .specs-box { display:grid; grid-template-columns:repeat(4, 1fr); background:#f8fafc; border:1px solid var(--border); border-radius:12px; padding:18px 24px; margin-bottom:24px; gap:16px; }
    .spec-item p { font-size:11px; font-weight:700; color:var(--text-muted); text-transform:uppercase; margin-bottom:4px; }
    .spec-item h4 { font-size:14px; font-weight:800; color:#0f172a; }

    .desc-section h3 { font-size:18px; font-weight:800; margin-bottom:12px; color:#0f172a; }
    .desc-section p { font-size:14px; color:#475569; line-height:1.8; margin-bottom:28px; }

    .action-buttons { display:flex; gap:14px; align-items:center; flex-wrap:wrap; }
    .btn-pinjam { padding:13px 28px; background:var(--primary); color:#fff; border:none; border-radius:30px; font-size:13.5px; font-weight:700; display:inline-flex; align-items:center; gap:8px; cursor:pointer; }
    .btn-kembali { padding:13px 28px; background:#fff; color:var(--primary); border:2px solid var(--primary); border-radius:30px; font-size:13.5px; font-weight:700; display:inline-flex; align-items:center; gap:8px; cursor:pointer; }
    .btn-disabled { padding:13px 28px; background:#94a3b8; color:#fff; border:none; border-radius:30px; font-size:13.5px; font-weight:700; cursor:not-allowed; }

    .alert-box { padding:12px 18px; border-radius:10px; font-size:13px; font-weight:700; margin-bottom:20px; display:flex; align-items:center; gap:10px; }
    .alert-success { background:#d1fae5; border:1px solid #a7f3d0; color:#065f46; }
    .alert-error { background:#fee2e2; border:1px solid #fecaca; color:#991b1b; }

    .related-section { border-top:1px solid var(--border); padding:40px 0 20px; width:100%; }
    .related-title { font-size:22px; font-weight:800; margin-bottom:20px; color:#0f172a; }
    .related-grid { display:grid; grid-template-columns:repeat(4, 1fr); gap:20px; }
    .related-card { background:#fff; border:1px solid var(--border); border-radius:12px; overflow:hidden; display:flex; flex-direction:column; }
    .related-card img { width:100%; height:180px; object-fit:cover; background:#f1f5f9; }
    .related-card-body { padding:14px; display:flex; flex-direction:column; justify-content:space-between; flex:1; }

    /* FOOTER */
    footer.main-footer { background-color:#052616 !important; color:#94a3b8; padding:45px 0 20px; margin-top:auto; width:100%; flex-shrink:0; }
    .footer-grid { display:grid; grid-template-columns:2fr 1fr 1fr 1.5fr; gap:32px; margin-bottom:35px; }
    .footer-brand { display:flex; flex-direction:column; gap:10px; }
    .footer-links h4 { color:#fff; font-size:14px; font-weight:700; margin-bottom:12px; }
    .footer-links ul { display:flex; flex-direction:column; gap:8px; }
    .footer-links a:hover { color:var(--accent); }
    .footer-bottom { display:flex; justify-content:space-between; align-items:center; border-top:1px solid rgba(255,255,255,0.1); padding-top:18px; font-size:12px; }

    @media (max-width:992px) { .detail-grid { grid-template-columns:1fr; gap:30px; } .specs-box { grid-template-columns:1fr 1fr; } .related-grid { grid-template-columns:1fr 1fr; } .footer-grid { grid-template-columns:1fr 1fr; } }
    @media (max-width:768px) {
      .custom-container { padding: 0 16px; }
      .nav-toggle { display:block; }
      .nav-menu { display:none; position:absolute; top:100%; left:0; width:100%; background-color:var(--primary); flex-direction:column; padding:18px; gap:12px; }
      .nav-menu.show { display:flex; }
      .dropdown-content { position:static; background:rgba(255,255,255,0.1); width:100%; }
      .dropdown-content.open { display:block; }
      .dropdown-content a { color:#fff; }
      .detail-title { font-size: 24px; }
      .book-cover-img { height: 320px; }
      .specs-box { grid-template-columns: 1fr; gap: 10px; }
      .related-grid { grid-template-columns: 1fr; }
      .footer-grid { grid-template-columns: 1fr; gap: 24px; }
      .footer-bottom { flex-direction: column; gap: 8px; text-align: center; }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  @include('partials.public_navbar')

  <main class="custom-container detail-main-wrapper">
    <div class="breadcrumb-nav">
      <a href="{{ url('/') }}">Home</a> <i class="fa-solid fa-chevron-right" style="font-size:10px;"></i>
      <a href="{{ url('/collections') }}">Collections</a> <i class="fa-solid fa-chevron-right" style="font-size:10px;"></i>
      <span style="color:#0f172a; font-weight:700;">{{ $book->title }}</span>
    </div>

    @if(session('success'))
      <div class="alert-box alert-success">
        <i class="fa-solid fa-circle-check"></i> <div>{{ session('success') }}</div>
      </div>
    @endif

    @if(session('error'))
      <div class="alert-box alert-error">
        <i class="fa-solid fa-triangle-exclamation"></i> <div>{{ session('error') }}</div>
      </div>
    @endif

    <div class="detail-grid">
      <!-- COVER BUKU -->
      <div class="book-cover-wrap">
        <img src="{{ $book->cover_url }}" class="book-cover-img" alt="{{ $book->title }}">
      </div>

      <!-- SPESIFIKASI BUKU -->
      <div>
        <span class="tag-category">{{ $book->category }}</span>
        <h1 class="detail-title">{{ $book->title }}</h1>
        <p class="detail-author">oleh <strong>{{ $book->author }}</strong></p>

        <div class="specs-box">
          <div class="spec-item">
            <p>Penerbit</p>
            <h4>{{ $book->publisher ?? 'Penerbit Erlangga' }}</h4>
          </div>
          <div class="spec-item">
            <p>Tahun Terbit</p>
            <h4>{{ $book->year ?? '2024' }}</h4>
          </div>
          <div class="spec-item">
            <p>Jumlah Halaman</p>
            <h4>{{ $book->pages ?? '240' }} Halaman</h4>
          </div>
          <div class="spec-item">
            <p>Koleksi / Stok</p>
            <h4 style="color: {{ $book->stock_available > 0 ? '#0c4d2d' : '#ef4444' }};">
              {{ $book->stock_available }} / {{ $book->stock_total }} Copies
            </h4>
          </div>
        </div>

        <div style="font-size:13px; color:var(--text-muted); margin-bottom:18px;">
          <i class="fa-solid fa-barcode"></i> ISBN: <strong>{{ $book->isbn }}</strong>
        </div>

        <div class="desc-section">
          <h3>Deskripsi Buku</h3>
          <p>{{ $book->description ?? 'Buku teks pembelajaran resmi Kurikulum Merdeka SMK/MAK untuk mendukung literasi dan kompetensi keahlian siswa SMKN 2 Purwakarta.' }}</p>
        </div>

        @php
          $userLoan = null;
          if (Auth::check()) {
              $userLoan = \App\Models\Loan::where('user_id', Auth::id())
                                          ->where('book_id', $book->id)
                                          ->whereIn('status', ['pending_borrow', 'borrowed', 'pending_return'])
                                          ->latest()
                                          ->first();
          }
        @endphp

        <!-- TOMBOL AKSI -->
        <div class="action-buttons">
          @if($userLoan)
            @if($userLoan->status === 'pending_borrow')
              <button class="btn-disabled" style="background:#d97706;" disabled>
                <i class="fa-solid fa-hourglass-half"></i> Menunggu Persetujuan Admin ({{ $userLoan->duration ?? 7 }} Hari)
              </button>
            @elseif($userLoan->status === 'pending_return')
              <button class="btn-disabled" style="background:#0284c7;" disabled>
                <i class="fa-solid fa-rotate-left"></i> Menunggu Verifikasi Pengembalian
              </button>
            @elseif($userLoan->status === 'borrowed')
              <button class="btn-disabled" style="background:#0c4d2d;" disabled>
                <i class="fa-solid fa-book-bookmark"></i> Sedang Dipinjam (Batas: {{ $userLoan->due_date }})
              </button>

              <form action="{{ route('book.return', $book->id) }}" method="POST" onsubmit="return confirm('Ajukan pengembalian buku ini?')">
                @csrf
                <button type="submit" class="btn-kembali">
                  <i class="fa-solid fa-arrow-rotate-left"></i> Ajukan Pengembalian Buku
                </button>
              </form>
            @endif
          @else
            @if($book->stock_available > 0)
              <form action="{{ route('book.borrow', $book->id) }}" method="POST" onsubmit="return confirm('Ajukan peminjaman buku ini?')" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                @csrf
                <div style="display:flex; align-items:center; gap:6px; background:#f8fafc; border:1.5px solid #cbd5e1; border-radius:30px; padding:6px 14px;">
                  <i class="fa-regular fa-calendar-days" style="color:var(--primary); font-size:13px;"></i>
                  <label for="durationSelect" style="font-size:12px; font-weight:700;">Durasi:</label>
                  <select name="duration" id="durationSelect" style="border:none; background:transparent; font-size:12.5px; font-weight:800; color:var(--primary); outline:none;">
                    <option value="1">1 Hari</option>
                    <option value="2">2 Hari</option>
                    <option value="3">3 Hari</option>
                    <option value="4">4 Hari</option>
                    <option value="5">5 Hari</option>
                    <option value="6">6 Hari</option>
                    <option value="7" selected>7 Hari (Maksimal)</option>
                  </select>
                </div>

                <button type="submit" class="btn-pinjam">
                  <i class="fa-solid fa-bookmark"></i> Ajukan Pinjam
                </button>
              </form>
            @else
              <button class="btn-disabled" disabled>
                <i class="fa-solid fa-ban"></i> Stok Sedang Kosong (0/{{ $book->stock_total }})
              </button>
            @endif
          @endif
        </div>
      </div>
    </div>

    <!-- BUKU TERKAIT -->
    <section class="related-section">
      <h2 class="related-title">Buku Terkait dalam Kategori "{{ $book->category }}"</h2>
      <div class="related-grid">
        @if(isset($relatedBooks))
          @forelse($relatedBooks as $related)
            <a href="{{ url('/buku/' . $related->id) }}" class="related-card">
              <img src="{{ $related->cover_url }}" alt="{{ $related->title }}" loading="lazy">
              <div class="related-card-body">
                <div>
                  <span style="font-size:11px; font-weight:800; color:var(--primary); text-transform:uppercase;">{{ $related->category }}</span>
                  <h4 style="font-size:13.5px; font-weight:700; color:#0f172a; margin:4px 0;">{{ $related->title }}</h4>
                  <p style="font-size:12px; color:var(--text-muted);">{{ $related->author }}</p>
                </div>
                <div style="font-size:11.5px; font-weight:700; color:var(--primary); margin-top:10px;">
                  {{ $related->stock_available > 0 ? $related->stock_available . ' Tersedia' : 'Dipinjam' }}
                </div>
              </div>
            </a>
          @empty
            <p style="grid-column:1/-1; color:var(--text-muted);">Belum ada buku terkait lainnya.</p>
          @endforelse
        @endif
      </div>
    </section>
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

</body>
</html>
