@extends('admin.layout')

@section('title', 'Data Peminjaman')

@section('content')
<div class="page-header">
  <div class="page-title">
    <h1>Data Peminjaman</h1>
    <p>Riwayat peminjaman buku perpustakaan.</p>
  </div>
  <div class="page-buttons">
    <a href="{{ route('admin.transactions') }}" class="btn-primary">
      <i class="fa-solid fa-plus"></i> Tambah Data
    </a>
  </div>
</div>

<div class="panel-card">
  <div class="panel-header">
    <h4><i class="fa-solid fa-arrow-right-arrow-left" style="color: var(--primary); margin-right: 8px;"></i> Daftar Peminjaman</h4>
  </div>
  <div class="panel-body" style="padding: 8px 0 8px 0;">
    <div class="table-responsive">
      <table class="custom-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Status</th>
            <th>Tgl. Pinjam</th>
            <th>Tgl. Kembali</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          @foreach ([
            ['Feby', 'Dipinjam', '01-02-2025', '06-02-2025'],
            ['Rani', 'Dipinjam', '02-02-2025', '07-02-2025'],
            ['Cahaya', 'Dipinjam', '03-02-2025', '08-02-2025'],
            ['Tiara', 'Dipinjam', '03-02-2025', '08-02-2025'],
            ['Roro', 'Dipinjam', '03-02-2025', '08-02-2025'],
            ['Alika', 'Dipinjam', '03-02-2025', '08-02-2025'],
          ] as $i => $row)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $row[0] }}</td>
            <td><span class="badge-status status-active">Meminjam</span></td>
            <td>{{ $row[2] }}</td>
            <td>{{ $row[3] }}</td>
            <td><span class="badge-status status-completed">Tersedia</span></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div style="padding: 16px 24px; border-top: 1px solid var(--border);">
    <a href="{{ route('admin.dashboard') }}" class="btn-secondary">
      <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
  </div>
</div>

<div style="margin-top: 18px;">
  <a href="{{ route('admin.transactions') }}" class="btn-secondary">
    <i class="fa-solid fa-clock-rotate-left"></i> Kelola Persetujuan Peminjaman
  </a>
</div>
@endsection