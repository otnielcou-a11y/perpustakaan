<header class="main-header">
  <div class="nav-container">
    <!-- LOGO SMKN 2 PURWAKARTA -->
    <a href="{{ url('/') }}" class="logo">
      @include('partials.logo', ['theme' => 'light'])
    </a>

    <!-- TOMBOL BURGER HP (MUNCUL DI LAYAR HP) -->
    <button type="button" class="nav-toggle" id="publicNavToggle" aria-label="Toggle Navigation">
      <i class="fa-solid fa-bars"></i>
    </button>

    <!-- MENU UTAMA -->
    <nav class="nav-menu" id="publicNavMenu">
      <a href="{{ url('/') }}" class="nav-item-link {{ Request::is('/') ? 'active' : '' }}">Home</a>

      <!-- DROPDOWN COLLECTIONS -->
      <div class="dropdown-wrapper">
        <a href="javascript:void(0)" class="nav-item-link dropdown-toggle-link {{ Request::is('collections*') || Request::is('koleksi*') || Request::is('buku*') ? 'active' : '' }}">
          Collections <i class="fa-solid fa-chevron-down"></i>
        </a>
        <div class="dropdown-content" style="min-width: 200px;">
          <a href="{{ url('/collections') }}"><i class="fa-solid fa-layer-group"></i> Semua Koleksi</a>
          <a href="{{ url('/collections?category=Kuliner') }}"><i class="fa-solid fa-utensils"></i> Kuliner</a>
          <a href="{{ url('/collections?category=Akuntansi') }}"><i class="fa-solid fa-calculator"></i> Akuntansi</a>
          <a href="{{ url('/collections?category=Fashion Design') }}"><i class="fa-solid fa-vest-patches"></i> Fashion Design</a>
          <a href="{{ url('/collections?category=Hospitality') }}"><i class="fa-solid fa-hotel"></i> Hospitality</a>
          <a href="{{ url('/collections?category=Teknologi') }}"><i class="fa-solid fa-microchip"></i> Teknologi</a>
        </div>
      </div>

      <a href="{{ url('/about') }}" class="nav-item-link {{ Request::is('about') ? 'active' : '' }}">About</a>

      {{-- SEBELUM LOGIN --}}
      @guest
        @if(Request::is('login') || Request::is('register'))
          <a href="{{ url('/login') }}" class="nav-item-link active">Login</a>
        @else
          <div class="dropdown-wrapper">
            <a href="javascript:void(0)" class="nav-item-link dropdown-toggle-link">
              Login <i class="fa-solid fa-chevron-down"></i>
            </a>
            <div class="dropdown-content" style="min-width: 175px;">
              <a href="{{ url('/login') }}"><i class="fa-solid fa-right-to-bracket"></i> Masuk Akun</a>
              <a href="{{ url('/register') }}"><i class="fa-solid fa-user-plus"></i> Buat Akun Baru</a>
            </div>
          </div>
        @endif

        <a href="{{ url('/profile') }}" class="btn-profile {{ Request::is('profile') ? 'btn-profile-active' : '' }}">
          <i class="fa-regular fa-user"></i> Profile
        </a>
      @endguest

      {{-- SETELAH LOGIN --}}
      @auth
        <a href="{{ url('/profile') }}" class="nav-item-link {{ Request::is('profile') ? 'active' : '' }}">
          Profile Perpus
        </a>

        <!-- AVATAR PENGGUNA -->
        <div class="dropdown-wrapper">
          <a href="javascript:void(0)" class="btn-user-pill dropdown-toggle-link {{ Request::is('pengaturan-akun') ? 'active-pill' : '' }}">
            <div class="nav-avatar-circle">
              @if(Auth::user()->avatar && file_exists(public_path('storage/' . Auth::user()->avatar)))
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar">
              @else
                {{ strtoupper(substr(Auth::user()->name ?? 'US', 0, 2)) }}
              @endif
            </div>
            <span class="nav-username">{{ Auth::user()->username ?? Auth::user()->name }}</span>
            <i class="fa-solid fa-chevron-down" style="font-size:10px; margin-left:4px;"></i>
          </a>

          <div class="dropdown-content user-dropdown-box" style="right:0; left:auto; min-width:215px;">
            <div style="padding:12px 18px 8px; border-bottom:1px solid #f1f5f9; background:#f8fafc; border-radius:8px 8px 0 0;">
              <div style="font-size:13.5px; font-weight:800; color:#0f172a; line-height:1.3;">
                {{ Auth::user()->name }}
              </div>
              <div style="font-size:11.5px; font-weight:700; color:var(--primary); margin-top:2px;">
                <i class="fa-solid fa-at" style="font-size:10px;"></i>{{ Auth::user()->username ?? '-' }}
              </div>
              <div style="font-size:11px; color:#64748b; margin-top:4px;">
                {{ ucfirst(Auth::user()->role) }} • {{ Auth::user()->nomor_induk ?? '-' }}
              </div>
            </div>

            @if(in_array(Auth::user()->role, ['admin', 'superadmin']))
              <a href="{{ url('/admin/dashboard') }}" style="color:var(--primary); font-weight:700;">
                <i class="fa-solid fa-table-cells-large" style="color:var(--primary);"></i> Dashboard Admin
              </a>
            @else
              <a href="{{ url('/pengaturan-akun') }}">
                <i class="fa-solid fa-user-gear"></i> Pengaturan Akun
              </a>
            @endif

            <a href="{{ url('/logout') }}" style="color:#ef4444 !important; font-weight:600; border-top:1px solid #f1f5f9;">
              <i class="fa-solid fa-right-from-bracket" style="color:#ef4444 !important;"></i> Keluar (Logout)
            </a>
          </div>
        </div>
      @endauth
    </nav>
  </div>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const navToggle = document.getElementById('publicNavToggle');
    const navMenu = document.getElementById('publicNavMenu');
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle-link');

    if (navToggle && navMenu) {
      navToggle.addEventListener('click', function (e) {
        e.stopPropagation();
        navMenu.classList.toggle('show');
        const icon = navToggle.querySelector('i');
        if (icon) {
          icon.classList.toggle('fa-bars');
          icon.classList.toggle('fa-xmark');
        }
      });
    }

    // Touch Dropdown di HP
    dropdownToggles.forEach(toggle => {
      toggle.addEventListener('click', function (e) {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          e.stopPropagation();
          const parent = this.closest('.dropdown-wrapper');
          const content = parent.querySelector('.dropdown-content');

          document.querySelectorAll('.dropdown-content').forEach(d => {
            if (d !== content) d.classList.remove('open');
          });

          if (content) content.classList.toggle('open');
        }
      });
    });

    // Tutup saat sentuh di luar
    document.addEventListener('click', function (e) {
      if (!e.target.closest('.main-header')) {
        if (navMenu && navMenu.classList.contains('show')) {
          navMenu.classList.remove('show');
          const icon = navToggle?.querySelector('i');
          if (icon) {
            icon.classList.add('fa-bars');
            icon.classList.remove('fa-xmark');
          }
        }
        document.querySelectorAll('.dropdown-content').forEach(d => d.classList.remove('open'));
      }
    });
  });
</script>
