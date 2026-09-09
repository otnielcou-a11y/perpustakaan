@php
  // Cek apakah logo dipanggil di tema gelap (admin sidebar putih) atau tema terang (navbar hijau)
  $isDarkTheme = $theme ?? 'light';
  $titleColor = ($isDarkTheme === 'dark') ? '#0f172a' : '#ffffff';
  $subColor = ($isDarkTheme === 'dark') ? '#64748b' : '#cbd5e1';
@endphp

<div style="display:flex; align-items:center; gap:12px;">
  @if(!empty($globalLogo))
    <img src="{{ $globalLogo }}" alt="Logo SMKN 2 Purwakarta" width="70" height="{{ $globalLogoSize ?? '44' }}" style="height:{{ $globalLogoSize ?? '44' }}px; width:auto; max-width:70px; object-fit:{{ $globalLogoFit ?? 'contain' }}; display:block;">
  @else
    <div style="background-color:#eab308; color:#0c4d2d; width:40px; height:40px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:18px;">
      <i class="fa-solid fa-graduation-cap"></i>
    </div>
  @endif
  <div class="logo-text" style="display:flex; flex-direction:column;">
    <span class="title" style="display:block; color:{{ $titleColor }}; font-weight:800; font-size:14px; line-height:1.2; letter-spacing:0.5px;">SMKN 2 PURWAKARTA</span>
    <span class="subtitle" style="display:block; color:{{ $subColor }}; font-size:10px; font-weight:600; letter-spacing:2px;">LIBRARIES</span>
  </div>
</div>
