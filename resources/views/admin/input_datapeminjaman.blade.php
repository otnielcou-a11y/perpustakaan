@extends('admin.layout')

@section('title', 'Input Data Peminjaman')

@section('content')
<div class="page-header">
  <div class="page-title">
    <h1>Input Data Peminjaman</h1>
    <p>Alur peminjaman buku dikelola melalui menu Transaksi.</p>
  </div>
  <div class="page-buttons">
    <a href="{{ route('admin.transactions') }}" class="btn-secondary">
      <i class="fa-solid fa-arrow-left"></i> Kelola Transaksi
    </a>
  </div>
</div>

<div class="panel-card">
  <div class="panel-header">
    <h4><i class="fa-solid fa-arrow-right-arrow-left" style="color: var(--primary); margin-right: 8px;"></i> Panduan Pencatatan Peminjaman</h4>
  </div>
  <div class="panel-body">
    <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 24px;">
      Peminjaman tidak dicatat manual oleh admin. Alur berikut yang digunakan perpustakaan SMKN 2 Purwakarta:
    </p>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;" class="step-grid">
      <div style="background: #f8fafc; border: 1px solid var(--border); border-radius: 10px; padding: 20px;">
        <div style="width: 34px; height: 34px; border-radius: 50%; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 800; margin-bottom: 12px;">1</div>
        <h5 style="font-size: 14px; font-weight: 800; margin-bottom: 6px;">Siswa/Guru Mengajukan</h5>
        <p style="font-size: 12px; color: var(--text-muted);">Anggota menekan tombol <strong>Pinjam</strong> pada koleksi buku yang dipilih.</p>
      </div>
      <div style="background: #f8fafc; border: 1px solid var(--border); border-radius: 10px; padding: 20px;">
        <div style="width: 34px; height: 34px; border-radius: 50%; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 800; margin-bottom: 12px;">2</div>
        <h5 style="font-size: 14px; font-weight: 800; margin-bottom: 6px;">Admin Menyetujui</h5>
        <p style="font-size: 12px; color: var(--text-muted);">Di menu <strong>Transaksi</strong>, admin menyetujui atau menolak pengajuan pinjam.</p>
      </div>
      <div style="background: #f8fafc; border: 1px solid var(--border); border-radius: 10px; padding: 20px;">
        <div style="width: 34px; height: 34px; border-radius: 50%; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 800; margin-bottom: 12px;">3</div>
        <h5 style="font-size: 14px; font-weight: 800; margin-bottom: 6px;">Peminjaman Tercatat</h5>
        <p style="font-size: 12px; color: var(--text-muted);">Status buku berubah <strong>Dipinjam</strong> dan riwayat masuk Data Transaksi.</p>
      </div>
    </div>

    <div style="margin-top: 24px; display: flex; gap: 12px; flex-wrap: wrap;">
      <a href="{{ route('admin.transactions') }}" class="btn-primary">
        <i class="fa-solid fa-check-double"></i> Buka Menu Transaksi
      </a>
      <a href="{{ route('admin.dashboard') }}" class="btn-secondary">
        <i class="fa-solid fa-house"></i> Ke Dashboard
      </a>
    </div>
  </div>
</div>

<style>
  @media (max-width: 768px) {
    .step-grid { grid-template-columns: 1fr !important; }
  }
</style>
@endsection