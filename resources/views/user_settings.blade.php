<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Pengaturan Akun - SMKN 2 Purwakarta Libraries</title>

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
    body { background-color:#f8fafc; color:#1e293b; min-height:100vh; display:flex; flex-direction:column; overflow-x:hidden; width:100%; }
    a { text-decoration:none; color:inherit; cursor:pointer; }
    ul { list-style:none; }
    .custom-container { max-width:1200px; margin:0 auto; padding:0 20px; width:100%; }

    /* NAVBAR STYLES */
    header.main-header { background-color:var(--primary) !important; padding:14px 0; position:sticky; top:0; z-index:9999; box-shadow:0 2px 10px rgba(0,0,0,0.15); width:100%; }
    .nav-container { max-width:1200px; margin:0 auto; padding:0 20px; display:flex; justify-content:space-between; align-items:center; }
    .logo { display:flex; align-items:center; gap:10px; }
    .nav-menu { display:flex; align-items:center; gap:20px; }
    .nav-item-link { color:#f1f5f9; font-size:14px; font-weight:600; display:flex; align-items:center; gap:6px; transition:0.2s; padding:6px 0; }
    .nav-item-link:hover, .nav-item-link.active { color:var(--accent); }
    .nav-item-link.active { border-bottom:2px solid var(--accent); }

    .btn-profile { padding:6px 18px; border:1.5px solid rgba(255,255,255,0.5); border-radius:20px; color:#fff; font-size:13px; font-weight:600; display:flex; align-items:center; gap:8px; }
    .btn-profile:hover, .btn-profile-active { background-color:#fff; color:var(--primary) !important; border-color:#fff; }

    .btn-user-pill { display:flex; align-items:center; gap:8px; background:rgba(255,255,255,0.15); padding:4px 12px 4px 6px; border-radius:30px; color:#fff; font-size:13px; font-weight:700; border:1.5px solid rgba(255,255,255,0.3); }
    .btn-user-pill:hover, .btn-user-pill.active-pill { background:#fff; color:var(--primary) !important; border-color:#fff; }
    .nav-avatar-circle { width:28px; height:28px; border-radius:50%; background:var(--accent); color:var(--primary); display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:800; overflow:hidden; }
    .nav-avatar-circle img { width:100%; height:100%; object-fit:cover; }
    .nav-username { max-width:110px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }

    .dropdown-wrapper { position:relative; padding-bottom:6px; margin-bottom:-6px; }
    .dropdown-wrapper .fa-chevron-down { font-size:10px; transition:transform 0.25s ease; }
    .dropdown-content { display:none; position:absolute; top:100%; left:0; background-color:#fff; min-width:200px; box-shadow:0 10px 25px rgba(0,0,0,0.15); border-radius:8px; padding:8px 0; z-index:10000; }
    .dropdown-content a { display:flex; align-items:center; gap:12px; padding:10px 18px; color:#334155; font-size:13px; font-weight:600; transition:0.2s; }
    .dropdown-content a i { width:18px; text-align:center; color:var(--primary); font-size:14px; }
    .dropdown-content a:hover { background-color:#f1f5f9; color:var(--primary); padding-left:22px; }

    @media (min-width:769px) {
      .dropdown-wrapper:hover .dropdown-content { display:block; animation:fadeIn 0.2s ease forwards; }
      .dropdown-wrapper:hover .fa-chevron-down { transform:rotate(180deg); color:var(--accent); }
    }
    @keyframes fadeIn { from{opacity:0; transform:translateY(6px);} to{opacity:1; transform:translateY(0);} }

    .nav-toggle { display:none; background:none; border:none; color:#fff; font-size:22px; cursor:pointer; padding:6px; }

    /* SETTINGS CONTENT */
    .settings-header { padding:30px 0 16px; }
    .settings-header h1 { font-size:26px; font-weight:800; color:#0f172a; line-height:1.2; }
    .settings-header p { font-size:13.5px; color:var(--text-muted); margin-top:4px; }

    .settings-grid { display:grid; grid-template-columns:1fr 1.3fr; gap:28px; padding-bottom:50px; align-items:start; }
    .card-panel { background:#fff; border:1px solid var(--border); border-radius:16px; padding:26px; box-shadow:0 2px 8px rgba(0,0,0,0.03); margin-bottom:20px; }
    .card-panel h3 { font-size:16.5px; font-weight:800; color:#0f172a; margin-bottom:4px; }
    .card-panel p.sub { font-size:12px; color:var(--text-muted); margin-bottom:18px; }

    .avatar-center-wrap { text-align:center; padding:8px 0 18px; border-bottom:1px solid var(--border); margin-bottom:18px; }
    .avatar-preview-box { width:84px; height:84px; border-radius:50%; background:#d1fae5; color:var(--primary); display:inline-flex; align-items:center; justify-content:center; font-size:26px; font-weight:800; overflow:hidden; border:3px solid var(--border); margin-bottom:10px; }
    .avatar-preview-box img { width:100%; height:100%; object-fit:cover; }
    .btn-file-upload { display:inline-block; padding:6px 14px; background:#f1f5f9; border:1px solid var(--border); border-radius:20px; font-size:11.5px; font-weight:700; color:var(--primary); cursor:pointer; }

    .form-group { margin-bottom:14px; }
    .form-group label { display:block; font-size:11.5px; font-weight:700; color:#0f172a; margin-bottom:5px; }
    .form-control { width:100%; padding:10px 12px; font-size:13px; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; }
    .form-control:focus { border-color:var(--primary); }
    .form-control:disabled { background-color:#f8fafc; color:#64748b; cursor:not-allowed; border-color:#e2e8f0; }

    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    .badge-locked { display:inline-flex; align-items:center; gap:4px; font-size:10px; font-weight:700; color:#94a3b8; margin-left:4px; }

    .btn-submit { width:100%; padding:12px; background-color:var(--primary); color:#ffffff; border:none; border-radius:8px; font-size:13.5px; font-weight:700; cursor:pointer; margin-top:6px; }
    .btn-submit:hover { background-color:var(--primary-dark); }

    .alert-box { padding:12px 16px; border-radius:8px; font-size:13px; font-weight:700; margin-bottom:20px; display:flex; align-items:center; gap:10px; }
    .alert-success { background:#d1fae5; border:1px solid #a7f3d0; color:#065f46; }
    .alert-error { background:#fee2e2; border:1px solid #fecaca; color:#991b1b; }

    /* FOOTER */
    footer.main-footer { background-color:#052616 !important; color:#94a3b8; padding:50px 20px 24px; margin-top:auto; width:100%; }
    .footer-grid { display:grid; grid-template-columns:2fr 1fr 1fr 1.5fr; gap:36px; margin-bottom:40px; }
    .footer-brand { display:flex; flex-direction:column; gap:12px; }
    .footer-links h4 { color:#fff; font-size:14.5px; font-weight:700; margin-bottom:14px; }
    .footer-links ul { display:flex; flex-direction:column; gap:9px; }
    .footer-links a { font-size:13px; color:#94a3b8; }
    .footer-links a:hover { color:var(--accent); }
    .footer-bottom { display:flex; justify-content:space-between; align-items:center; border-top:1px solid rgba(255,255,255,0.1); padding-top:20px; font-size:12px; flex-wrap:wrap; gap:10px; }

    /* ================= MOBILE RESPONSIVE ================= */
    @media (max-width: 992px) {
      .settings-grid { grid-template-columns:1fr; gap:20px; }
      .footer-grid { grid-template-columns:1fr 1fr; gap:28px; }
    }
    @media (max-width: 768px) {
      .nav-toggle { display:block !important; }

      .nav-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: var(--primary);
        flex-direction: column;
        align-items: stretch;
        padding: 18px 20px;
        gap: 12px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.35);
      }
      .nav-menu.show { display:flex !important; }

      .dropdown-wrapper { width: 100%; }
      .dropdown-content {
        display: none;
        position: static !important;
        background-color: rgba(255, 255, 255, 0.1) !important;
        box-shadow: none !important;
        border-radius: 8px;
        margin-top: 6px;
        width: 100%;
        padding: 6px 0;
      }
      .dropdown-content.open { display: block !important; }
      .dropdown-content a { color: #f1f5f9 !important; padding: 10px 16px; }

      .btn-profile, .btn-user-pill { width: 100%; justify-content: center; margin-top: 4px; }

      .settings-header h1 { font-size: 22px; }
      .card-panel { padding: 20px 16px; }
      .form-row { grid-template-columns: 1fr; gap: 10px; }

      .footer-grid { grid-template-columns: 1fr; gap: 24px; }
      .footer-bottom { flex-direction: column; text-align: center; gap: 8px; }
    }
  </style>
</head>
<body>

  <!-- NAVBAR DINAMIS TERPUSAT -->
  @include('partials.public_navbar')

  <main class="custom-container">
    <div class="settings-header">
      <h1>Pengaturan Akun Saya</h1>
      <p>Kelola identitas terdaftar, perbarui username, dan kata sandi akun Anda.</p>
    </div>

    @if(session('success'))
      <div class="alert-box alert-success">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert-box alert-error">
        <i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first() }}
      </div>
    @endif

    <div class="settings-grid">

      <!-- SISI KIRI: IDENTITAS RESMI (TERKUNCI) -->
      <div>
        <div class="card-panel">
          <h3>Identitas Resmi Terdaftar</h3>
          <p class="sub">Data resmi yang terdaftar di database sekolah.</p>

          <div class="form-group">
            <label>Nama Lengkap <span class="badge-locked"><i class="fa-solid fa-lock"></i> Terkunci</span></label>
            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label>Nomor Induk (NISN / NIP) <span class="badge-locked"><i class="fa-solid fa-lock"></i> Terkunci</span></label>
              <input type="text" class="form-control" value="{{ $user->nomor_induk ?? '-' }}" disabled>
            </div>
            <div class="form-group">
              <label>Peran Akun <span class="badge-locked"><i class="fa-solid fa-lock"></i> Terkunci</span></label>
              <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" disabled>
            </div>
          </div>

          <div class="form-group">
            <label>Email Terdaftar <span class="badge-locked"><i class="fa-solid fa-lock"></i> Terkunci</span></label>
            <input type="email" class="form-control" value="{{ $user->email ?? 'Tidak ada email terdaftar' }}" disabled>
          </div>

          <p style="font-size:11px; color:#64748b; line-height:1.5; margin-top:8px;">
            <i class="fa-solid fa-circle-info"></i> Data identitas di atas terkunci secara sistem. Jika terdapat kesalahan penulisan nama atau NISN, silakan hubungi bagian administrator perpustakaan.
          </p>
        </div>
      </div>

      <!-- SISI KANAN: FORM EDIT (USERNAME & PASSWORD) -->
      <div class="card-panel">
        <h3>Ubah Data Akun</h3>
        <p class="sub">Anda dapat memperbarui foto profil, username akun, dan kata sandi baru.</p>

        <form action="{{ route('user.settings.update') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- FOTO PROFIL -->
          <div class="avatar-center-wrap">
            <div class="avatar-preview-box" id="avatarBox">
              @if($user->avatar && file_exists(public_path('storage/' . $user->avatar)))
                <img src="{{ asset('storage/' . $user->avatar) }}" id="avatarImg" alt="Avatar">
              @else
                <span id="avatarInitials">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
              @endif
            </div>
            <div>
              <label for="avatarInput" class="btn-file-upload">
                <i class="fa-solid fa-camera"></i> Ganti Foto Profil
              </label>
              <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display:none;" onchange="previewUserAvatar(this)">
            </div>
            <small style="font-size:10.5px; color:#64748b; display:block; margin-top:4px;">Format: PNG, JPG, WebP (Maks. 2MB)</small>
          </div>

          <!-- 1. UBAH USERNAME -->
          <div class="form-group">
            <label>Username Akun (Bisa Diubah)</label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" placeholder="Masukkan username baru..." required>
            <small style="font-size:10.5px; color:#64748b;">Username ini digunakan untuk login/masuk ke perpustakaan.</small>
          </div>

          <!-- 2. UBAH PASSWORD -->
          <div style="border-top:1px solid var(--border); padding-top:14px; margin-top:14px;">
            <label style="font-size:12.5px; font-weight:800; color:#0f172a; margin-bottom:8px; display:block;">
              <i class="fa-solid fa-key"></i> Perbarui Kata Sandi (Opsional)
            </label>

            <div class="form-row">
              <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
              </div>
              <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
              </div>
            </div>
          </div>

          <button type="submit" class="btn-submit">
            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Akun
          </button>
        </form>
      </div>

    </div>
  </main>

  <footer class="main-footer">
    <div class="custom-container footer-bottom" style="border-top:none;">
      <p>&copy; 2026 SMKN 2 Purwakarta Libraries. All rights reserved.</p>
    </div>
  </footer>

  <script>
    function previewUserAvatar(input) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('avatarBox').innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover;">`;
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>
</html>
