<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi Kode OTP - SMKN 2 Purwakarta Libraries</title>

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
    .nav-item-link { color:#f1f5f9; font-size:14px; font-weight:600; display:flex; align-items:center; gap:6px; transition:0.2s; padding:6px 0; }
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

    .back-link { display:inline-flex; align-items:center; gap:6px; font-size:13px; color:var(--primary); font-weight:700; margin-bottom:20px; }
    .back-link:hover { text-decoration:underline; }

    /* EMAIL DISPLAY */
    .email-badge { background:#f0fdf4; border:1.5px solid #bbf7d0; border-radius:8px; padding:10px 14px; display:flex; align-items:center; gap:10px; margin-bottom:20px; }
    .email-badge i { color:var(--primary); }
    .email-badge span { font-size:13px; font-weight:700; color:#0f172a; word-break:break-all; }

    /* OTP INPUT BOXES */
    .otp-container { display:flex; gap:10px; justify-content:center; margin:20px 0 24px; }
    .otp-input {
      width:52px; height:60px; text-align:center;
      font-size:24px; font-weight:800; color:var(--primary);
      border:2px solid #cbd5e1; border-radius:12px;
      outline:none; transition:0.2s;
      background:#f8fafc;
    }
    .otp-input:focus { border-color:var(--primary); background:#fff; box-shadow:0 0 0 3px rgba(12,77,45,0.1); }
    .otp-input.filled { border-color:var(--primary); background:#f0fdf4; }
    .otp-input.error { border-color:#ef4444; background:#fef2f2; }

    /* TIMER */
    .timer-wrapper { text-align:center; margin-bottom:20px; }
    .timer-text { font-size:13px; color:#64748b; }
    .timer-count { font-weight:800; color:var(--primary); font-size:15px; }
    .timer-count.warning { color:#ef4444; }
    .resend-link { font-size:13px; font-weight:700; color:var(--primary); cursor:pointer; }
    .resend-link:hover { text-decoration:underline; }
    .resend-link.disabled { color:#94a3b8; pointer-events:none; }

    .btn-submit { width:100%; padding:13px; background-color:var(--primary); color:#fff; border:none; border-radius:8px; font-size:14px; font-weight:700; cursor:pointer; transition:0.2s; display:flex; align-items:center; justify-content:center; gap:8px; }
    .btn-submit:hover { background-color:var(--primary-dark); }
    .btn-submit:disabled { background:#94a3b8; cursor:not-allowed; }

    footer.main-footer { background-color:#052616 !important; color:#94a3b8; padding:24px 0; margin-top:auto; width:100%; }
    .footer-bottom { display:flex; justify-content:center; padding-top:0; font-size:12px; }
    .custom-container { max-width:1200px; margin:0 auto; padding:0 20px; width:100%; }

    @media (max-width:992px) { .auth-banner { display:none; } }
    @media (max-width:480px) {
      .otp-input { width:42px; height:52px; font-size:20px; border-radius:8px; }
      .otp-container { gap:7px; }
    }
  </style>
</head>
<body>

  @include('partials.public_navbar')

  <div class="auth-wrapper">
    <div class="auth-banner">
      <div class="auth-banner-overlay"></div>
      <div class="auth-banner-content">
        <h1>Verifikasi Kode OTP</h1>
        <p>Periksa kotak masuk email Anda dan masukkan kode 6 digit yang baru saja kami kirimkan.</p>
      </div>
    </div>

    <div class="auth-form-side">
      <div class="auth-header-icon"><i class="fa-solid fa-shield-halved"></i></div>
      <h2 class="auth-title">Masukkan Kode</h2>
      <p class="auth-subtitle">Kode 6 digit telah dikirim ke email Anda.</p>

      <div class="auth-card">

        <a href="{{ route('forgot.password') }}" class="back-link">
          <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>

        @if(session('success'))
          <div class="alert-box alert-success">
            <i class="fa-solid fa-circle-check" style="margin-top:2px;flex-shrink:0;"></i>
            <div>{{ session('success') }}</div>
          </div>
        @endif

        @if($errors->any())
          <div class="alert-box alert-error" id="errorBox">
            <i class="fa-solid fa-triangle-exclamation" style="margin-top:2px;flex-shrink:0;"></i>
            <div>{{ $errors->first() }}</div>
          </div>
        @endif

        <!-- Email badge -->
        <div class="email-badge">
          <i class="fa-regular fa-envelope"></i>
          <span>{{ $email }}</span>
        </div>

        <form action="{{ route('verify.otp') }}" method="POST" id="otpForm">
          @csrf
          <input type="hidden" name="encoded_email" value="{{ $encodedEmail }}">
          <input type="hidden" name="otp" id="otpHidden">

          <p style="font-size:13px;color:#64748b;margin-bottom:4px;">Kode verifikasi (6 digit):</p>

          <!-- 6 OTP boxes -->
          <div class="otp-container">
            @for($i = 1; $i <= 6; $i++)
              <input type="text" class="otp-input" maxlength="1"
                     inputmode="numeric" pattern="[0-9]"
                     id="otp{{ $i }}" autocomplete="off">
            @endfor
          </div>

          <!-- Timer -->
          <div class="timer-wrapper">
            <p class="timer-text">
              Kode berlaku selama <span class="timer-count" id="timerCount">10:00</span>
            </p>
            <p style="margin-top:8px;font-size:13px;color:#64748b;">
              Tidak menerima kode?
              <a href="{{ route('forgot.password') }}" class="resend-link" id="resendLink">Kirim ulang</a>
            </p>
          </div>

          <button type="submit" class="btn-submit" id="verifyBtn" disabled>
            <i class="fa-solid fa-circle-check"></i>
            <span>Verifikasi Kode</span>
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
    const inputs    = document.querySelectorAll('.otp-input');
    const otpHidden = document.getElementById('otpHidden');
    const verifyBtn = document.getElementById('verifyBtn');
    @if($errors->any())
    // Mark all boxes as error on invalid OTP
    inputs.forEach(inp => inp.classList.add('error'));
    @endif

    // Auto-focus & navigation between boxes
    inputs.forEach((input, idx) => {
      input.addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1);
        this.classList.toggle('filled', this.value !== '');
        this.classList.remove('error');

        if (this.value && idx < inputs.length - 1) {
          inputs[idx + 1].focus();
        }
        updateHidden();
      });

      input.addEventListener('keydown', function (e) {
        if (e.key === 'Backspace' && !this.value && idx > 0) {
          inputs[idx - 1].focus();
          inputs[idx - 1].value = '';
          inputs[idx - 1].classList.remove('filled');
          updateHidden();
        }
      });

      // Handle paste
      input.addEventListener('paste', function (e) {
        e.preventDefault();
        const pasted = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
        pasted.split('').forEach((ch, i) => {
          if (inputs[i]) {
            inputs[i].value = ch;
            inputs[i].classList.add('filled');
            inputs[i].classList.remove('error');
          }
        });
        const nextEmpty = [...inputs].findIndex(inp => !inp.value);
        if (nextEmpty !== -1) inputs[nextEmpty].focus();
        else inputs[inputs.length - 1].focus();
        updateHidden();
      });
    });

    function updateHidden() {
      const code = [...inputs].map(inp => inp.value).join('');
      otpHidden.value = code;
      verifyBtn.disabled = code.length < 6;
    }

    inputs[0].focus();

    // Countdown Timer (10 minutes)
    let totalSeconds = 10 * 60;
    const timerEl = document.getElementById('timerCount');

    function updateTimer() {
      const m = Math.floor(totalSeconds / 60).toString().padStart(2, '0');
      const s = (totalSeconds % 60).toString().padStart(2, '0');
      timerEl.textContent = `${m}:${s}`;
      if (totalSeconds <= 60) timerEl.classList.add('warning');
      if (totalSeconds <= 0) {
        clearInterval(timerInterval);
        timerEl.textContent = 'Kedaluwarsa';
        verifyBtn.disabled = true;
        inputs.forEach(inp => { inp.disabled = true; inp.classList.add('error'); });
      }
      totalSeconds--;
    }

    updateTimer();
    const timerInterval = setInterval(updateTimer, 1000);

    // Loading state on submit
    document.getElementById('otpForm').addEventListener('submit', function () {
      verifyBtn.disabled = true;
      verifyBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Memverifikasi...</span>';
      clearInterval(timerInterval);
    });
  </script>

</body>
</html>
