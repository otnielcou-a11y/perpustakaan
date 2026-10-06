@php
  $currentUser = Auth::user() ?? \App\Models\User::whereIn('role', ['admin', 'superadmin'])->first();
  $avatarUrl = $currentUser?->avatar_url;
  $avatarInitials = strtoupper(substr($currentUser->name ?? 'AD', 0, 2));
@endphp

<link rel="stylesheet" href="{{ asset('asset/css/admin-avatar.css') }}?v={{ time() }}">

<style>
  @media (max-width: 768px) {
    .admin-nav-username { display: none !important; }
    .admin-dropdown-menu { right: 0; min-width: 190px; }
  }
</style>

<div class="admin-dropdown-wrapper" id="adminDropdownWrapper" style="position:relative;">
  <!-- AVATAR + USERNAME ADMIN -->
  <div class="admin-user-btn" onclick="toggleAdminMenu(event)" style="display:flex; align-items:center; gap:8px; cursor:pointer; padding:4px 8px; border-radius:30px; user-select:none;">
    <div class="admin-avatar-circle">
      {{-- $avatarUrl hanya terisi bila berkasnya benar-benar ada di disk,
           jadi tidak perlu gambar cadangan yang menumpuk di dalam lingkaran. --}}
      @if($avatarUrl)
        <img src="{{ $avatarUrl }}" class="avatar-circle-img" alt="Avatar {{ $currentUser->name }}">
      @else
        {{ $avatarInitials }}
      @endif
    </div>

    <span class="admin-nav-username" style="font-size:13px; font-weight:700; color:#0f172a;">{{ $currentUser->username ?? $currentUser->name }}</span>
    <i class="fa-solid fa-chevron-down" style="font-size:10px; color:var(--text-muted); transition:0.2s;"></i>
  </div>

  <!-- DROPDOWN ADMIN -->
  <div class="admin-dropdown-menu" id="adminDropdownMenu">
    <div style="padding:12px 18px 8px; border-bottom:1px solid #f1f5f9; background:#f8fafc; border-radius:10px 10px 0 0;">
      <div style="font-size:13.5px; font-weight:800; color:#0f172a; line-height:1.3;">
        {{ $currentUser->name ?? 'Administrator' }}
      </div>
      <div style="font-size:11.5px; font-weight:700; color:var(--primary); margin-top:2px;">
        <i class="fa-solid fa-at" style="font-size:10px;"></i>{{ $currentUser->username ?? 'admin' }}
      </div>
      <div style="font-size:11px; color:#64748b; margin-top:4px; font-weight:600;">
        {{ ($currentUser && $currentUser->role === 'superadmin') ? 'Super Administrator' : 'Administrator Sistem' }}
      </div>
    </div>

    <div style="padding:6px 0;">
      <a href="{{ url('/admin/settings') }}" class="admin-dropdown-item">
        <i class="fa-solid fa-gear"></i> Settings Admin
      </a>
      <a href="{{ url('/logout') }}" class="admin-dropdown-item" style="color:#ef4444; border-top:1px solid #f1f5f9;">
        <i class="fa-solid fa-right-from-bracket"></i> Sign Out (Logout)
      </a>
    </div>
  </div>
</div>

<script>
  function toggleAdminMenu(e) {
    if (window.innerWidth <= 992) {
      e.stopPropagation();
      const menu = document.getElementById('adminDropdownMenu');
      if (menu) {
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
      }
    }
  }

  document.addEventListener('click', function(e) {
    const wrapper = document.getElementById('adminDropdownWrapper');
    const menu = document.getElementById('adminDropdownMenu');
    if (menu && wrapper && !wrapper.contains(e.target)) {
      menu.style.display = '';
    }
  });
</script>
