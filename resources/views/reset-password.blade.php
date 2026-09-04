<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat Kata Sandi Baru - SMKN 2 Purwakarta Libraries</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --primary: #0c4d2d;
      --primary-dark: #07351e;
      --accent: #eab308;
    }
    html, body {
      width:100%; max-width:100%; overflow-x:hidden !important;
      margin:0; padding:0; min-height:100vh; display:flex; flex-direction:column;
      background-color:#f8fafc; font-family:'Plus Jakarta Sans',sans-serif;
    }
    * { margin:0; padding:0; box-sizing:border-box; font-family:'Plus Jakarta Sans',sans-serif; }
    body { color:#1e293b; line-height:1.5; }
    a { text-decoration:none; color:inherit; }

    /* NAVBAR */
    header.main-header { background-color:var(--primary) !important; padding:14px 0; position:sticky; top:0; z-index:9999; box-shadow:0 2px 10px rgba(0,0,0,0.15); width:100%; }
    .nav-container { max-width:1200px; margin:0 auto; padding:0 20px; display:flex; justify-content:space-between; align-items:center; }
    .logo { display:flex; align-items:center; gap:12px; }
    .nav-menu { display:flex; align-items:center; gap:24px; }
    .nav-item-link { color:#f1f5f9; font-size:14px; font-weight:600; transition:0.2s; padding:6px 0; }
    .nav-item-link:hover { color:var(--accent); }
    .nav-toggle { display:none; background:none; border:none; color:#fff; font-size:24px; cursor:pointer; }

    /* LAYOUT */
    .auth-wrapper { flex:1 0 auto; display:flex; min-height:calc(100vh - 70px); }
    .auth-banner { flex:1; position:relative; background:url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=1600&auto=format&fit=crop&q=80') center/cover no-repeat; display:flex; align-items:center; justify-content:center; padding:40px; color:#fff; }
    .auth-banner-overlay { position:absolute; inset:0; background:linear-gradient(180deg, rgba(12,77,45,0.75) 0%, rgba(0,0,0,0.85) 100%); z-index:1; }
    .auth-banner-content { position:relative; z-index:2; max-width:480px; text-align:center; }
    .auth-banner-content h1 { font-size:38px; font-weight:800; margin-bottom:16px; line-height:1.2; }
    .auth-banner-content p { font-size:15px; color:#e2e8f0; line-height:1.6; }

    .auth-form-side { flex:1; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:40px 20px; }
    .auth-header-icon { width:52px; height:52px; background-color:#d1fae5; color:var(--primary); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:24px; margin-bottom:16px; }
    .auth-title { font-size:26px; font-weight:800; margin-bottom:6px; color:#0f172a; }
    .auth-subtitle { font-size:13px; color:#64748b; margin-bottom:24px; text-align:center; max-width:380px; }
    .auth-card { background:#ffffff; border:1px solid #e2e8f0; border-radius:16px; padding:32px; width:100%; max-width:460px; box-shadow:0 10px 25px -5px rgba(0,0,0,0.05); }

    .alert-box { padding:12px 16px; border-radius:8px; font-size:13px; margin-bottom:18px; display:flex; align-items:flex-start; gap:10px; font-weight:600; }
    .alert-error { background-color:#fee2e2; border:1px solid #fecaca; color:#991b1b; }
    .alert-success { background:#d1fae5; border:1px solid #a7f3d0; color:#065f46; }

    .verified-badge { background:#f0fdf4; border:1.5px solid #bbf7d0; border-radius:8px; padding:10px 14px; display:flex; align-items:center; gap:10px; margin-bottom:20px; }
    .verified-badge i { color:#16a34a; }
    .verified-badge span { font-size:13px; font-weight:700; color:#0f172a; }

    .form-group { margin-bottom:16px; }
    .form-label { display:block; font-size:12px; font-weight:700; margin-bottom:6px; color:#0f172a; }
    .input-icon-wrapper { position:relative; display:flex; align-items:center; }
    .input-icon-wrapper i.input-icon { position:absolute; left:14px; color:#64748b; font-size:14px; }
    .form-control { width:100%; padding:10px 40px 10px 40px; font-size:13px; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; transition:0.2s; }
    .form-control:focus { border-color:var(--primary); box-shadow:0 0 0 3px rgba(12,77,45,0.08); }
    .toggle-password { position:absolute; right:14px; background:none; border:none; color:#64748b; cursor:pointer; }

    /* Password strength */
    .strength-bar { height:4px; border-radius:4px; background:#e2e8f0; margin-top:8px; overflow:hidden; }
    .strength-fill { height:100%; border-radius:4px; transition:0.3s; width:0%; }
    .strength-text { font-size:11px; font-weight:700; margin-top:4px; }

    .requirements { margin-top:10px; padding:12px; background:#f8fafc; border-radius:8px; border:1px solid #e2e8f0; }
    .req-item { font-size:12px; color:#94a3b8; display:flex; align-items:center; gap:7px; margin-bottom:4px; transition:0.2s; }
    .req-item:last-child { margin-bottom:0; }
    .req-item.ok { color:#16a34a; }
    .req-item i { width:14px; }

    .btn-submit { width:100%; padding:13px; background-color:var(--primary); color:#fff; border:none; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer; transition:0.2s; display:flex; align-items:center; justify-content:center; gap:8px; margin-top:4px; }
    .btn-submit:hover { background-color:var(--primary-dark); }

    footer.main-footer { background-color:#052616 !important; color:#94a3b8; padding:24px 0; margin-top:auto; width:100%; }
    .footer-bottom { display:flex; justify-content:center; font-size:12px; }
    .custom-container { max-width:1200px; margin:0 auto; padding:0 20px; width:100%; }

    @media (max-width:992px) { .auth-banner { display:none; } }
  </style>
</head>
<body>

  @include('partials.public_navbar')

  <div class="auth-wrapper">
    <div class="auth-banner">
      <div class="auth-banner-overlay"></div>
      <div class="auth-banner-content">
        <h1>Buat Kata Sandi Baru</h1>
        <p>Identitas Anda sudah terverifikasi. Silakan buat kata sandi yang kuat untuk mengamankan akun.</p>
      </div>
    </div>

    <div class="auth-form-side">
      <div class="auth-header-icon"><i class="fa-solid fa-lock"></i></div>
      <h2 class="auth-title">Kata Sandi Baru</h2>
      <p class="auth-subtitle">Buat kata sandi yang kuat dan mudah diingat oleh Anda.</p>

      <div class="auth-card">

        @if(session('success'))
          <div class="alert-box alert-success">
            <i class="fa-solid fa-circle-check" style="margin-top:2px;flex-shrink:0;"></i>
            <div>{{ session('success') }}</div>
          </div>
        @endif

        @if($errors->any())
          <div class="alert-box alert-error">
            <i class="fa-solid fa-triangle-exclamation" style="margin-top:2px;flex-shrink:0;"></i>
            <div>{{ $errors->first() }}</div>
          </div>
        @endif

        <!-- Verified badge -->
        <div class="verified-badge">
          <i class="fa-solid fa-circle-check"></i>
          <span>Identitas terverifikasi · {{ $email }}</span>
        </div>

        <form action="{{ route('reset.password') }}" method="POST" id="resetForm">
          @csrf
          <input type="hidden" name="encoded_email" value="{{ $encodedEmail }}">

          <!-- Password baru -->
          <div class="form-group">
            <label class="form-label">Kata Sandi Baru</label>
            <div class="input-icon-wrapper">
              <i class="fa-solid fa-lock input-icon"></i>
              <input type="password" name="password" id="newPass" class="form-control"
                     placeholder="Minimal 6 karakter..." autocomplete="new-password" required>
              <button type="button" class="toggle-password" onclick="toggleVis('newPass', this)">
                <i class="fa-regular fa-eye"></i>
              </button>
            </div>
            <!-- Strength bar -->
            <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
            <p class="strength-text" id="strengthText" style="color:#94a3b8;"></p>

            <!-- Requirements -->
            <div class="requirements">
              <div class="req-item" id="req-len"><i class="fa-solid fa-circle-xmark"></i> Minimal 6 karakter</div>
              <div class="req-item" id="req-num"><i class="fa-solid fa-circle-xmark"></i> Mengandung angka</div>
              <div class="req-item" id="req-upper"><i class="fa-solid fa-circle-xmark"></i> Mengandung huruf kapital</div>
            </div>
          </div>

          <!-- Konfirmasi -->
          <div class="form-group">
            <label class="form-label">Konfirmasi Kata Sandi</label>
            <div class="input-icon-wrapper">
              <i class="fa-solid fa-lock input-icon"></i>
              <input type="password" name="password_confirmation" id="confirmPass" class="form-control"
                     placeholder="Ulangi kata sandi..." autocomplete="new-password" required>
              <button type="button" class="toggle-password" onclick="toggleVis('confirmPass', this)">
                <i class="fa-regular fa-eye"></i>
              </button>
            </div>
            <p style="font-size:12px;margin-top:6px;" id="matchText"></p>
          </div>

          <button type="submit" class="btn-submit" id="submitBtn">
            <i class="fa-solid fa-floppy-disk"></i>
            <span>Simpan Kata Sandi Baru</span>
          </button>
        </form>

      </div>
    </div>
  </div>

  <footer class="main-footer">
    <div class="custom-container">
      <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} SMKN 2 Purwakarta Libraries. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script>
    function toggleVis(id, btn) {
      const inp = document.getElementById(id);
      const icon = btn.querySelector('i');
      if (inp.type === 'password') {
        inp.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        inp.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    }

    const newPass    = document.getElementById('newPass');
    const confirmPass= document.getElementById('confirmPass');
    const matchText  = document.getElementById('matchText');
    const strengthFill = document.getElementById('strengthFill');
    const strengthText = document.getElementById('strengthText');

    function checkStrength(pw) {
      let score = 0;
      if (pw.length >= 6) score++;
      if (pw.length >= 10) score++;
      if (/[0-9]/.test(pw)) score++;
      if (/[A-Z]/.test(pw)) score++;
      if (/[^a-zA-Z0-9]/.test(pw)) score++;

      const levels = [
        { pct: 0,   color: '#e2e8f0', label: '' },
        { pct: 20,  color: '#ef4444', label: 'Sangat Lemah' },
        { pct: 40,  color: '#f97316', label: 'Lemah' },
        { pct: 60,  color: '#eab308', label: 'Cukup' },
        { pct: 80,  color: '#22c55e', label: 'Kuat' },
        { pct: 100, color: '#16a34a', label: 'Sangat Kuat' },
      ];
      const lvl = levels[score];
      strengthFill.style.width  = lvl.pct + '%';
      strengthFill.style.background = lvl.color;
      strengthText.textContent  = lvl.label;
      strengthText.style.color  = lvl.color;
    }

    function setReq(id, ok) {
      const el = document.getElementById(id);
      el.classList.toggle('ok', ok);
      el.querySelector('i').className = ok ? 'fa-solid fa-circle-check' : 'fa-solid fa-circle-xmark';
    }

    newPass.addEventListener('input', function () {
      const v = this.value;
      checkStrength(v);
      setReq('req-len',   v.length >= 6);
      setReq('req-num',   /[0-9]/.test(v));
      setReq('req-upper', /[A-Z]/.test(v));
      checkMatch();
    });

    confirmPass.addEventListener('input', checkMatch);

    function checkMatch() {
      const pw  = newPass.value;
      const cpw = confirmPass.value;
      if (!cpw) { matchText.textContent = ''; return; }
      if (pw === cpw) {
        matchText.textContent = '✓ Kata sandi cocok';
        matchText.style.color = '#16a34a';
        matchText.style.fontWeight = '700';
      } else {
        matchText.textContent = '✗ Kata sandi tidak cocok';
        matchText.style.color = '#ef4444';
        matchText.style.fontWeight = '700';
      }
    }

    document.getElementById('resetForm').addEventListener('submit', function (e) {
      if (newPass.value !== confirmPass.value) {
        e.preventDefault();
        confirmPass.focus();
        return;
      }
      const btn = document.getElementById('submitBtn');
      btn.disabled = true;
      btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Menyimpan...</span>';
    });
  </script>

</body>
</html>
