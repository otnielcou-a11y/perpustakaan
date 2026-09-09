<style>
  /* ================= SEMBUNYIKAN SCROLLBAR (TAPI TETAP BISA SCROLL) ================= */
  html, body, * {
    scrollbar-width: none !important;
    -ms-overflow-style: none !important;
  }
  html::-webkit-scrollbar,
  body::-webkit-scrollbar,
  *::-webkit-scrollbar {
    display: none !important;
    width: 0 !important;
    height: 0 !important;
  }

  /* ================= MODAL PETUNJUK PENGGUNAAN ================= */
  .guide-btn-float {
    position: fixed;
    bottom: 88px;
    right: 28px;
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: var(--primary, #0c4d2d);
    color: #ffffff;
    border: none;
    box-shadow: 0 6px 18px rgba(12, 77, 45, 0.4);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    z-index: 998;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
  }
  .guide-btn-float:hover {
    background: var(--primary-dark, #07351e);
    transform: scale(1.1) translateY(-2px);
  }
  .guide-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(3px);
    z-index: 20000;
    align-items: flex-end;
    justify-content: center;
    animation: guideFadeIn 0.25s ease;
  }
  .guide-modal-overlay.show { display: flex; }
  @keyframes guideFadeIn { from { opacity: 0; } to { opacity: 1; } }
  .guide-modal-box {
    background: #ffffff;
    border-radius: 0;
    height: 100%;
    max-height: none;
    width: 100%;
    max-width: 640px;
    display: flex;
    flex-direction: column;
    animation: guideSlideUp 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    overflow: hidden;
  }
  @keyframes guideSlideUp {
    from { transform: translateY(100%); }
    to { transform: translateY(0); }
  }
  .guide-modal-head {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 24px;
    background: linear-gradient(135deg, var(--primary, #0c4d2d), var(--primary-dark, #07351e));
    color: #fff;
  }
  .guide-modal-head .guide-badge {
    width: 48px;
    height: 48px;
    flex-shrink: 0;
    border-radius: 14px;
    background: rgba(255,255,255,0.18);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
  }
  .guide-modal-head h3 { font-size: 20px; font-weight: 800; margin: 0; }
  .guide-modal-head p { font-size: 12.5px; opacity: 0.85; margin: 3px 0 0; }
  .guide-modal-close {
    margin-left: auto;
    width: 34px;
    height: 34px;
    border: none;
    border-radius: 50%;
    background: rgba(255,255,255,0.18);
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.2s;
    flex-shrink: 0;
  }
  .guide-modal-close:hover { background: rgba(255,255,255,0.32); }
  .guide-modal-body {
    padding: 20px 24px 8px;
    overflow-y: auto;
    flex: 1;
    scrollbar-width: none;
    -ms-overflow-style: none;
  }
  .guide-modal-body::-webkit-scrollbar {
    display: none;
  }
  .guide-section-title {
    font-size: 13px;
    font-weight: 800;
    color: var(--primary, #0c4d2d);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 18px 0 10px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .guide-section-title:first-child { margin-top: 0; }
  .guide-step {
    display: flex;
    gap: 14px;
    margin-bottom: 14px;
    align-items: flex-start;
  }
  .guide-step-num {
    width: 26px;
    height: 26px;
    flex-shrink: 0;
    border-radius: 50%;
    background: var(--primary, #0c4d2d);
    color: #fff;
    font-size: 12.5px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 2px;
  }
  .guide-step-txt {
    font-size: 13.5px;
    color: #334155;
    line-height: 1.6;
  }
  .guide-step-txt strong { color: #0f172a; }
  .guide-note {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 12px 14px;
    background: #fef9e7;
    border: 1px solid #fde68a;
    border-radius: 12px;
    font-size: 12.5px;
    color: #92400e;
    line-height: 1.5;
    margin: 6px 0 8px;
  }
  .guide-note i { margin-top: 2px; }
  .guide-modal-foot {
    padding: 14px 24px 22px;
    border-top: 1px solid #f1f5f9;
    text-align: right;
  }
  .guide-modal-foot .guide-done-btn {
    padding: 11px 26px;
    border: none;
    border-radius: 30px;
    background: var(--primary, #0c4d2d);
    color: #fff;
    font-size: 13.5px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s;
  }
  .guide-modal-foot .guide-done-btn:hover { background: var(--primary-dark, #07351e); }

  @media (min-width: 641px) {
    .guide-modal-box { border-radius: 20px; max-height: 92vh; height: auto; }
    .guide-modal-overlay { align-items: center; padding: 20px; }
  }
</style>

<!-- ================= TOMBOL & MODAL PETUNJUK PENGGUNAAN ================= -->
<button type="button" class="guide-btn-float" id="guideOpenBtn" aria-label="Petunjuk Penggunaan" title="Petunjuk Penggunaan">
  <i class="fa-solid fa-circle-question"></i>
</button>

<div class="guide-modal-overlay" id="guideModalOverlay">
  <div class="guide-modal-box" role="dialog" aria-modal="true" aria-labelledby="guideModalTitle">
    <div class="guide-modal-head">
      <div class="guide-badge"><i class="fa-solid fa-circle-question"></i></div>
      <div>
        <h3 id="guideModalTitle">Petunjuk Penggunaan</h3>
        <p>SMKN 2 Purwakarta Libraries — Panduan singkat</p>
      </div>
      <button type="button" class="guide-modal-close" id="guideCloseBtn" aria-label="Tutup"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <div class="guide-modal-body">

      <div class="guide-section-title"><i class="fa-solid fa-magnifying-glass"></i> Mencari Koleksi Buku</div>
      <div class="guide-step">
        <span class="guide-step-num">1</span>
        <div class="guide-step-txt">Gunakan kolom <strong>pencarian</strong> di halaman utama, atau buka menu <strong>Collections</strong> di navbar untuk melihat semua buku.</div>
      </div>
      <div class="guide-step">
        <span class="guide-step-num">2</span>
        <div class="guide-step-txt">Gunakan <strong>filter kategori</strong> (Kuliner, Akuntansi, Fashion, dll.) untuk mempersempit daftar koleksi sesuai jurusan Anda.</div>
      </div>
      <div class="guide-step">
        <span class="guide-step-num">3</span>
        <div class="guide-step-txt">Klik <strong>Details</strong> atau sampul buku untuk melihat sinopsis, penulis, dan ketersediaan stok.</div>
      </div>

      <div class="guide-section-title"><i class="fa-solid fa-right-to-bracket"></i> Membuat Akun &amp; Masuk</div>
      <div class="guide-step">
        <span class="guide-step-num">1</span>
        <div class="guide-step-txt">Klik menu <strong>Login</strong> lalu pilih <strong>Buat Akun Baru</strong> untuk mendaftar sebagai anggota (siswa/guru).</div>
      </div>
      <div class="guide-step">
        <span class="guide-step-num">2</span>
        <div class="guide-step-txt">Isi data diri sesuai NISN/NIP dan identitas Anda, kemudian masuk menggunakan akun tersebut.</div>
      </div>

      <div class="guide-section-title"><i class="fa-solid fa-book-bookmark"></i> Meminjam &amp; Mengembalikan Buku</div>
      <div class="guide-step">
        <span class="guide-step-num">1</span>
        <div class="guide-step-txt">Setelah <strong>masuk akun</strong>, buka halaman detail buku dan tekan tombol <strong>Pinjam</strong> untuk buku yang tersedia.</div>
      </div>
      <div class="guide-step">
        <span class="guide-step-num">2</span>
        <div class="guide-step-txt">Pantau status peminjaman Anda di <strong>Dashboard</strong> dan tombol <strong>Pengaturan Akun</strong>.</div>
      </div>
      <div class="guide-step">
        <span class="guide-step-num">3</span>
        <div class="guide-step-txt">Untuk mengembalikan buku, gunakan tombol <strong>Kembalikan</strong> pada buku yang sedang Anda pinjam.</div>
      </div>

      <div class="guide-note">
        <i class="fa-solid fa-circle-info"></i>
        <span>Untuk aktivasi pinjaman akhir dan pengembalian langsung, silakan hubungi <strong>petugas perpustakaan</strong> agar data transaksi diverifikasi.</span>
      </div>

    </div>

    <div class="guide-modal-foot">
      <button type="button" class="guide-done-btn" id="guideDoneBtn">Siap, Mengerti!</button>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const guideOverlay = document.getElementById('guideModalOverlay');
    const guideOpen = document.getElementById('guideOpenBtn');
    const guideClose = document.getElementById('guideCloseBtn');
    const guideDone = document.getElementById('guideDoneBtn');

    function openGuide() {
      if (guideOverlay) guideOverlay.classList.add('show');
      document.body.style.overflow = 'hidden';
    }
    function closeGuide() {
      if (guideOverlay) guideOverlay.classList.remove('show');
      document.body.style.overflow = '';
    }

    if (guideOpen) guideOpen.addEventListener('click', openGuide);
    if (guideClose) guideClose.addEventListener('click', closeGuide);
    if (guideDone) guideDone.addEventListener('click', closeGuide);

    if (guideOverlay) {
      guideOverlay.addEventListener('click', function (e) {
        if (e.target === guideOverlay) closeGuide();
      });
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && guideOverlay.classList.contains('show')) closeGuide();
      });
    }
  });
</script>
