@extends('admin.layout')

@section('title', 'Input Data Anggota')

@section('content')
<div class="page-header">
  <div class="page-title">
    <h1>Input Data Anggota</h1>
    <p>Daftarkan siswa/guru sebagai anggota perpustakaan.</p>
  </div>
  <div class="page-buttons">
    <a href="{{ route('admin.members') }}" class="btn-secondary">
      <i class="fa-solid fa-arrow-left"></i> Daftar Anggota
    </a>
  </div>
</div>

<div class="panel-card">
  <div class="panel-header">
    <h4><i class="fa-solid fa-user-plus" style="color: var(--primary); margin-right: 8px;"></i> Form Tambah Anggota</h4>
  </div>
  <div class="panel-body">
    <form action="{{ route('admin.members.save') }}" method="POST">
      @csrf

      <div class="form-row">
        <div class="form-group">
          <label for="name">Nama Lengkap <span style="color:#ef4444;">*</span></label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
          <label for="username">Username <span style="color:#ef4444;">*</span></label>
          <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
        </div>
        <div class="form-group">
          <label for="nomor_induk">Nomor Induk (NIS/NIP) <span style="color:#ef4444;">*</span></label>
          <input type="text" name="nomor_induk" id="nomor_induk" class="form-control" value="{{ old('nomor_induk') }}" required>
        </div>
        <div class="form-group">
          <label for="role">Peran</label>
          <select name="role" id="role" class="form-control" required>
            <option value="murid">Siswa</option>
            <option value="guru">Guru</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
          <label for="password">Password <span style="color:#ef4444;">*</span></label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>
      </div>

      <div class="modal-footer" style="margin-top: 12px; padding-top: 16px;">
        <a href="{{ route('admin.members') }}" class="btn-secondary">Batal</a>
        <button type="reset" class="btn-danger">Reset</button>
        <button type="submit" class="btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan Anggota</button>
      </div>
    </form>
  </div>
</div>
@endsection