@php
  $currentUser = Auth::user() ?? \App\Models\User::whereIn('role', ['admin', 'superadmin'])->first();
@endphp

<div class="admin-dropdown-wrapper" style="position:relative;">
  <!-- AVATAR + USERNAME ADMIN -->
  <div class="admin-user-btn" style="display:flex; align-items:center; gap:10px; cursor:pointer; padding:4px 8px; border-radius:30px;">
    <div class="admin-avatar-circle" style="width:36px; height:36px; border-radius:50%; background-color:#d1fae5; display:flex; align-items:center; justify-content:center; font-size:13px; font-weight:800; color:var(--primary); overflow:hidden; border:1.5px solid var(--border);">
      @if($currentUser && $currentUser->avatar && file_exists(public_path('storage/' . $currentUser->avatar)))
        <img src="{{ asset('storage/' . $currentUser->avatar) }}" alt="Avatar" style="width:100%; height:100%; object-fit:cover;">
      @else
        {{ strtoupper(substr($currentUser->name ?? 'AD', 0, 2)) }}
      @endif
    </div>

    <span class="admin-nav-username" style="font-size:13px; font-weight:700; color:#0f172a;">{{ $currentUser->username ?? $currentUser->name }}</span>
    <i class="fa-solid fa-chevron-down" style="font-size:10px; color:var(--text-muted); transition:0.2s;"></i>
  </div>

  <!-- DROPDOWN ADMIN (HOVER DI DESKTOP / TOUCH DI HP) -->
  <div class="admin-dropdown-menu">
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
