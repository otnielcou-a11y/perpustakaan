<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kode Reset Kata Sandi</title>
</head>
<body style="margin:0;padding:0;background-color:#f1f5f9;font-family:'Segoe UI',Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f1f5f9;padding:40px 0;">
    <tr>
      <td align="center">
        <table width="100%" cellpadding="0" cellspacing="0" style="max-width:540px;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.08);">
          
          <!-- HEADER -->
          <tr>
            <td style="background-color:#0c4d2d;padding:32px 40px;text-align:center;">
              <p style="margin:0;font-size:13px;color:rgba(255,255,255,0.7);letter-spacing:1px;text-transform:uppercase;font-weight:600;">Perpustakaan Digital</p>
              <h1 style="margin:6px 0 0;font-size:22px;color:#ffffff;font-weight:800;">SMKN 2 Purwakarta</h1>
            </td>
          </tr>

          <!-- BODY -->
          <tr>
            <td style="padding:40px 40px 32px;">
              <h2 style="margin:0 0 12px;font-size:20px;color:#0f172a;font-weight:700;">Reset Kata Sandi</h2>
              <p style="margin:0 0 24px;font-size:14px;color:#64748b;line-height:1.6;">
                Halo, <strong style="color:#0f172a;">{{ $userName }}</strong>! Kami menerima permintaan reset kata sandi untuk akun Anda. Gunakan kode verifikasi di bawah ini:
              </p>

              <!-- OTP BOX -->
              <div style="background:#f8fafc;border:2px dashed #0c4d2d;border-radius:12px;padding:28px;text-align:center;margin-bottom:28px;">
                <p style="margin:0 0 8px;font-size:12px;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:1px;">Kode Verifikasi Anda</p>
                <p style="margin:0;font-size:48px;font-weight:800;color:#0c4d2d;letter-spacing:12px;">{{ $otpCode }}</p>
                <p style="margin:10px 0 0;font-size:12px;color:#ef4444;font-weight:600;">⏱ Berlaku selama <strong>10 menit</strong></p>
              </div>

              <p style="margin:0 0 16px;font-size:13px;color:#64748b;line-height:1.6;">
                Masukkan kode ini di halaman verifikasi pada website perpustakaan. Jangan bagikan kode ini kepada siapa pun.
              </p>

              <div style="background:#fff7ed;border:1px solid #fed7aa;border-radius:8px;padding:14px 16px;margin-bottom:24px;">
                <p style="margin:0;font-size:12.5px;color:#92400e;line-height:1.5;">
                  <strong>⚠ Penting:</strong> Jika Anda tidak meminta reset kata sandi, abaikan email ini. Kata sandi Anda tetap aman.
                </p>
              </div>
            </td>
          </tr>

          <!-- FOOTER -->
          <tr>
            <td style="background-color:#f8fafc;border-top:1px solid #e2e8f0;padding:20px 40px;text-align:center;">
              <p style="margin:0;font-size:12px;color:#94a3b8;line-height:1.6;">
                Email ini dikirim otomatis oleh sistem. Jangan membalas email ini.<br>
                &copy; {{ date('Y') }} Perpustakaan Digital SMKN 2 Purwakarta
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
