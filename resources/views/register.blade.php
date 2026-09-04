<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat Akun Baru - SMKN 2 Purwakarta Libraries</title>

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

    /* ANTI RUANG PUTIH & LEAK */
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
      background-color: #f8fafc;
    }

    * { margin:0; padding:0; box-sizing:border-box; font-family:'Plus Jakarta Sans',sans-serif; }
    body { color:#1e293b; line-height:1.5; }
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

    /* AUTH SPLIT */
    .auth-wrapper { flex: 1 0 auto; display:flex; min-height:calc(100vh - 70px); }
    .auth-banner { flex:1; position:relative; background:url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=1600&auto=format&fit=crop&q=80') center/cover no-repeat; display:flex; align-items:center; justify-content:center; padding:40px; color:#ffffff; }
    .auth-banner-overlay { position:absolute; inset:0; background:linear-gradient(180deg, rgba(12,77,45,0.75) 0%, rgba(0,0,0,0.85) 100%); z-index:1; }
    .auth-banner-content { position:relative; z-index:2; max-width:480px; text-align:center; }
    .auth-banner-content h1 { font-size:38px; font-weight:800; margin-bottom:16px; line-height:1.2; }
    .auth-banner-content p { font-size:15px; color:#e2e8f0; line-height:1.6; }

    .auth-form-side { flex:1; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:40px 20px; }
    .auth-header-icon { width:52px; height:52px; background-color:#d1fae5; color:var(--primary); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:24px; margin-bottom:16px; }
    .auth-title { font-size:26px; font-weight:800; margin-bottom:6px; color:#0f172a; }
    .auth-subtitle { font-size:13px; color:#64748b; margin-bottom:24px; text-align:center; max-width:380px; }
    .auth-card { background:#ffffff; border:1px solid #e2e8f0; border-radius:16px; padding:32px; width:100%; max-width:480px; box-shadow:0 10px 25px -5px rgba(0,0,0,0.05); }

    /* ALERT ERROR INSTAN */
    .alert-box { padding:12px 16px; border-radius:8px; font-size:13px; margin-bottom:18px; display:flex; align-items:center; gap:10px; font-weight:600; }
    .alert-error { background-color:#fee2e2; border:1px solid #fecaca; color:#991b1b; }

    .auth-tabs { display:flex; justify-content:space-between; border-bottom:1px solid #e2e8f0; padding-bottom:12px; margin-bottom:20px; }
    .auth-tab-link { font-size:14px; font-weight:700; color:#64748b; position:relative; }
    .auth-tab-link.active { color:var(--primary); }
    .auth-tab-link.active::after { content:''; position:absolute; bottom:-13px; left:0; width:100%; height:2px; background-color:var(--primary); }

    .role-group { margin-bottom:16px; }
    .role-label { font-size:11.5px; font-weight:700; color:#64748b; margin-bottom:8px; text-transform:uppercase; }
    .role-options { display:flex; gap:10px; }
    .role-pill { flex:1; padding:8px 14px; border:1.5px solid #e2e8f0; border-radius:8px; background:#ffffff; font-size:13px; font-weight:700; text-align:center; cursor:pointer; color:#64748b; transition:0.2s; }
    .role-pill.active { border-color:var(--primary); background-color:#ecfdf5; color:var(--primary); }

    .form-group { margin-bottom:12px; position:relative; }
    .form-label { display:block; font-size:12px; font-weight:700; margin-bottom:5px; color:#0f172a; }
    .form-control { width:100%; padding:10px 14px; font-size:13px; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; transition:border-color 0.2s, background-color 0.2s; }
    .form-control:focus { border-color:var(--primary); }

    .form-control.is-invalid { border-color:#ef4444 !important; background-color:#fef2f2; }
    .form-control.is-valid { border-color:#10b981 !important; background-color:#f0fdf4; }
    .form-control.auto-filled { background-color:#f0fdf4; border-color:#86efac; font-weight:700; color:#166534; }

    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    .password-hint { font-size:11px; margin-top:4px; font-weight:700; display:none; }

    .btn-submit { width:100%; padding:12px; background-color:var(--primary); color:#ffffff; border:none; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer; margin-top:8px; transition:0.2s; display:flex; align-items:center; justify-content:center; gap:8px; }
    .btn-submit:hover { background-color:var(--primary-dark); }
    .auth-footer-text { text-align:center; font-size:12.5px; color:#64748b; margin-top:16px; }
    .auth-footer-text a { color:var(--primary); font-weight:700; }

    /* FOOTER */
    footer.main-footer { background-color:#052616 !important; color:#94a3b8; padding:45px 0 20px; margin-top:auto; width:100%; flex-shrink:0; }
    .footer-grid { display:grid; grid-template-columns:2fr 1fr 1fr 1.5fr; gap:32px; margin-bottom:35px; }
    .footer-brand { display:flex; flex-direction:column; gap:10px; }
    .footer-links h4 { color:#fff; font-size:14px; font-weight:700; margin-bottom:12px; }
    .footer-links ul { display:flex; flex-direction:column; gap:8px; }
    .footer-links a:hover { color:var(--accent); }
    .footer-bottom { display:flex; justify-content:space-between; align-items:center; border-top:1px solid rgba(255,255,255,0.1); padding-top:18px; font-size:12px; }

    @media (max-width:992px) { .auth-banner { display:none; } .footer-grid { grid-template-columns:1fr 1fr; } }
    @media (max-width:768px) {
      .custom-container { padding: 0 16px; }
      .nav-toggle { display:block; }
      .nav-menu { display:none; position:absolute; top:100%; left:0; width:100%; background-color:var(--primary); flex-direction:column; padding:18px; gap:12px; }
      .nav-menu.show { display:flex; }
      .dropdown-content { position:static; background:rgba(255,255,255,0.1); width:100%; }
      .dropdown-content.open { display:block; }
      .dropdown-content a { color:#fff; }
      .footer-grid { grid-template-columns: 1fr; gap: 24px; }
      .footer-bottom { flex-direction: column; gap: 8px; text-align: center; }
    }
  </style>
</head>
<body>

  <!-- NAVBAR DINAMIS TERPUSAT -->
  @include('partials.public_navbar')

  <!-- AUTH WRAPPER -->
  <div class="auth-wrapper">
    <div class="auth-banner">
      <div class="auth-banner-overlay"></div>
      <div class="auth-banner-content">
        <h1>Perpustakaan Digital SMKN 2 Purwakarta</h1>
        <p>Akses ribuan koleksi buku digital, jurnal, dan referensi akademik di mana saja dan kapan saja.</p>
      </div>
    </div>

    <div class="auth-form-side">
      <div class="auth-header-icon"><i class="fa-solid fa-book-open-reader"></i></div>
      <h2 class="auth-title">Buat Akun Baru</h2>
      <p class="auth-subtitle">Masukkan NISN Anda untuk mengisi nama lengkap secara otomatis.</p>

      <div class="auth-card">

        <!-- KOTAK ERROR INSTAN -->
        <div id="jsErrorAlert" class="alert-box alert-error" style="display:none;">
          <i class="fa-solid fa-triangle-exclamation"></i>
          <span id="jsErrorMessage">Pesan error</span>
        </div>

        <div class="auth-tabs">
          <a href="{{ url('/login') }}" class="auth-tab-link">Masuk</a>
          <span class="auth-tab-link active">Daftar</span>
        </div>

        <form id="ajaxRegisterForm" action="{{ url('/register') }}" method="POST" autocomplete="off">
          @csrf
          <input type="hidden" name="role" id="roleInput" value="murid">

          <!-- PERAN -->
          <div class="role-group">
            <div class="role-label">Daftar sebagai</div>
            <div class="role-options">
              <div class="role-pill active" data-role="murid">Murid</div>
              <div class="role-pill" data-role="guru">Guru</div>
            </div>
          </div>

          <!-- 1. NISN -->
          <div class="form-group">
            <label class="form-label" id="nisNipLabel">Nomor Induk Siswa Nasional (NISN)</label>
            <div style="position:relative;">
              <input type="text" name="nomor_induk" id="nisNipInput" class="form-control" placeholder="Ketik 10 digit NISN Anda..." autocomplete="off" required>
              <span id="nisnLoading" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); font-size:11.5px; font-weight:700; color:var(--primary); display:none;">
                <i class="fa-solid fa-spinner fa-spin"></i> Mengecek...
              </span>
            </div>
          </div>

          <!-- 2. NAMA LENGKAP -->
          <div class="form-group">
            <label class="form-label">Nama Lengkap <span id="autoFillBadge" style="display:none; color:var(--primary); font-size:11px; font-weight:700;">(Otomatis Terverifikasi)</span></label>
            <input type="text" name="name" id="nameInput" class="form-control" placeholder="Nama akan otomatis muncul saat NISN diketik" autocomplete="off" required>
          </div>

          <!-- 3. EMAIL (OPSIONAL) -->
          <div class="form-group">
            <label class="form-label">Email (Opsional / Boleh Kosong)</label>
            <input type="email" name="email" id="emailInput" class="form-control" placeholder="Email pribadi atau sekolah (opsional)" autocomplete="off">
          </div>

          <!-- 4. USERNAME -->
          <div class="form-group">
            <label class="form-label">Username Login</label>
            <input type="text" name="username" id="usernameInput" class="form-control" placeholder="Buat username untuk login..." autocomplete="off" required>
          </div>

          <!-- 5. PASSWORD & KONFIRMASI -->
          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Kata Sandi</label>
              <input type="password" name="password" id="passwordInput" class="form-control" placeholder="Min. 4 karakter" autocomplete="new-password" required>
            </div>
            <div class="form-group">
              <label class="form-label">Konfirmasi</label>
              <input type="password" name="password_confirmation" id="passwordConfirmInput" class="form-control" placeholder="Ulangi kata sandi" autocomplete="new-password" required>
            </div>
          </div>

          <div id="passwordMismatchText" class="password-hint" style="color:#ef4444; margin-bottom:12px;">
            <i class="fa-solid fa-xmark"></i> Konfirmasi kata sandi tidak cocok!
          </div>
          <div id="passwordMatchText" class="password-hint" style="color:#10b981; margin-bottom:12px;">
            <i class="fa-solid fa-check"></i> Kata sandi cocok.
          </div>

          <button type="submit" id="btnSubmitForm" class="btn-submit">
            <span id="btnSubmitText">Daftar Sekarang</span>
            <i id="btnSubmitSpinner" class="fa-solid fa-spinner fa-spin" style="display:none;"></i>
          </button>
        </form>

        <div class="auth-footer-text">
          Sudah punya akun? <a href="{{ url('/login') }}">Masuk</a>
        </div>
      </div>
    </div>
  </div>

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

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('ajaxRegisterForm');
      const nisNipInput = document.getElementById('nisNipInput');
      const nameInput = document.getElementById('nameInput');
      const passwordInput = document.getElementById('passwordInput');
      const passwordConfirmInput = document.getElementById('passwordConfirmInput');
      const mismatchText = document.getElementById('passwordMismatchText');
      const matchText = document.getElementById('passwordMatchText');
      const errorBox = document.getElementById('jsErrorAlert');
      const errorMsg = document.getElementById('jsErrorMessage');
      const btnText = document.getElementById('btnSubmitText');
      const btnSpinner = document.getElementById('btnSubmitSpinner');
      const btnSubmit = document.getElementById('btnSubmitForm');
      const pills = document.querySelectorAll('.role-pill');
      const roleInp = document.getElementById('roleInput');
      const nisNipLabel = document.getElementById('nisNipLabel');
      const autoFillBadge = document.getElementById('autoFillBadge');

      let nisnTimeout = null;

      // AUTO-FILL NAMA DARI NISN
      nisNipInput.addEventListener('input', function () {
        const nisnVal = this.value.trim();
        const role = roleInp.value;

        if (role === 'murid' && nisnVal.length >= 8) {
          clearTimeout(nisnTimeout);
          document.getElementById('nisnLoading').style.display = 'block';

          nisnTimeout = setTimeout(() => {
            fetch('/api/cek-nisn/' + encodeURIComponent(nisnVal))
              .then(res => res.json())
              .then(data => {
                document.getElementById('nisnLoading').style.display = 'none';
                if (data.found) {
                  nameInput.value = data.name;
                  nameInput.classList.add('auto-filled');
                  autoFillBadge.style.display = 'inline';
                } else {
                  autoFillBadge.style.display = 'none';
                  nameInput.classList.remove('auto-filled');
                }
              })
              .catch(() => {
                document.getElementById('nisnLoading').style.display = 'none';
              });
          }, 350);
        } else {
          document.getElementById('nisnLoading').style.display = 'none';
          autoFillBadge.style.display = 'none';
          nameInput.classList.remove('auto-filled');
        }
      });

      // PENGECEKAN KATA SANDI REAL-TIME
      function checkPasswordMatch() {
        const pass = passwordInput.value;
        const confirmPass = passwordConfirmInput.value;

        if (confirmPass.length === 0) {
          passwordConfirmInput.classList.remove('is-invalid', 'is-valid');
          mismatchText.style.display = 'none';
          matchText.style.display = 'none';
          return true;
        }

        if (pass !== confirmPass) {
          passwordConfirmInput.classList.add('is-invalid');
          passwordConfirmInput.classList.remove('is-valid');
          mismatchText.style.display = 'block';
          matchText.style.display = 'none';
          return false;
        } else {
          passwordConfirmInput.classList.remove('is-invalid');
          passwordConfirmInput.classList.add('is-valid');
          mismatchText.style.display = 'none';
          matchText.style.display = 'block';
          return true;
        }
      }

      passwordInput.addEventListener('keyup', checkPasswordMatch);
      passwordConfirmInput.addEventListener('keyup', checkPasswordMatch);

      // SUBMIT DENGAN AJAX
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        errorBox.style.display = 'none';

        if (passwordInput.value !== passwordConfirmInput.value) {
          errorMsg.textContent = 'Konfirmasi kata sandi tidak cocok!';
          errorBox.style.display = 'flex';
          passwordConfirmInput.focus();
          return;
        }

        if (passwordInput.value.length < 4) {
          errorMsg.textContent = 'Kata sandi minimal 4 karakter!';
          errorBox.style.display = 'flex';
          passwordInput.focus();
          return;
        }

        btnText.textContent = 'Mendaftarkan...';
        btnSpinner.style.display = 'inline-block';
        btnSubmit.disabled = true;

        const formData = new FormData(form);

        fetch(form.action, {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        })
        .then(async (response) => {
          const data = await response.json();

          btnText.textContent = 'Daftar Sekarang';
          btnSpinner.style.display = 'none';
          btnSubmit.disabled = false;

          if (response.ok && data.success) {
            window.location.href = data.redirect || '/';
          } else {
            let message = data.message || 'Terjadi kesalahan pada pengisian data.';
            if (data.errors) {
              const firstKey = Object.keys(data.errors)[0];
              message = data.errors[firstKey][0];
            }
            errorMsg.textContent = message;
            errorBox.style.display = 'flex';
            window.scrollTo({ top: errorBox.offsetTop - 50, behavior: 'smooth' });
          }
        })
        .catch(() => {
          btnText.textContent = 'Daftar Sekarang';
          btnSpinner.style.display = 'none';
          btnSubmit.disabled = false;
          errorMsg.textContent = 'Gagal menghubungi server. Silakan coba lagi.';
          errorBox.style.display = 'flex';
        });
      });

      // TOGGLE PERAN
      pills.forEach(p => {
        p.addEventListener('click', function() {
          pills.forEach(item => item.classList.remove('active'));
          this.classList.add('active');

          const role = this.dataset.role;
          roleInp.value = role;

          if (role === 'guru') {
            nisNipLabel.textContent = 'Nomor Induk Pegawai (NIP)';
            nisNipInput.placeholder = 'Masukkan NIP Anda...';
            nameInput.placeholder = 'Masukkan nama lengkap guru...';
            autoFillBadge.style.display = 'none';
            nameInput.classList.remove('auto-filled');
          } else {
            nisNipLabel.textContent = 'Nomor Induk Siswa Nasional (NISN)';
            nisNipInput.placeholder = 'Ketik 10 digit NISN Anda...';
            nameInput.placeholder = 'Nama akan otomatis muncul saat NISN diketik';
          }
        });
      });
    });
  </script>
</body>
</html>
