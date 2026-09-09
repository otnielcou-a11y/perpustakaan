@extends('admin.layout')

@section('title', 'Edit Data Buku')

@section('content')
@php
  $categories = \App\Models\Category::orderBy('name')->get();
@endphp

@if(!isset($buku))
<div class="page-header">
  <div class="page-title">
    <h1>Edit Data Buku</h1>
    <p>Perbarui informasi buku di inventaris perpustakaan.</p>
  </div>
</div>

<div class="panel-card" style="padding: 32px; text-align: center;">
  <i class="fa-solid fa-circle-info" style="font-size: 28px; color: var(--primary); margin-bottom: 12px; display: block;"></i>
  <h4 style="margin-bottom: 6px;">Belum ada buku yang dipilih</h4>
  <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 20px;">Pilih tombol Edit pada salah satu buku di halaman Daftar Buku untuk mengisi form ini.</p>
  <a href="{{ route('admin.books') }}" class="btn-primary">
    <i class="fa-solid fa-book-open"></i> Ke Daftar Buku
  </a>
</div>
@else
<div class="page-header">
  <div class="page-title">
    <h1>Edit Data Buku</h1>
    <p>Perbarui informasi buku <strong>{{ $buku->title }}</strong>.</p>
  </div>
  <div class="page-buttons">
    <a href="{{ route('admin.books') }}" class="btn-secondary">
      <i class="fa-solid fa-arrow-left"></i> Daftar Buku
    </a>
  </div>
</div>

<div class="panel-card">
  <div class="panel-header">
    <h4><i class="fa-solid fa-pen-to-square" style="color: var(--primary); margin-right: 8px;"></i> Form Edit Buku</h4>
  </div>
  <div class="panel-body">
    <form action="{{ route('admin.books.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-row">
        <div class="form-group">
          <label for="title">Judul Buku <span style="color:#ef4444;">*</span></label>
          <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $buku->title) }}" required>
        </div>
        <div class="form-group">
          <label for="author">Nama Penulis <span style="color:#ef4444;">*</span></label>
          <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $buku->author) }}" required>
        </div>
        <div class="form-group">
          <label for="publisher">Penerbit <span style="color:#ef4444;">*</span></label>
          <input type="text" name="publisher" id="publisher" class="form-control" value="{{ old('publisher', $buku->publisher) }}" required>
        </div>
        <div class="form-group">
          <label for="isbn">ISBN <span style="color:#ef4444;">*</span></label>
          <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn', $buku->isbn) }}" required>
        </div>
        <div class="form-group">
          <label for="year">Tahun Terbit</label>
          <input type="number" name="year" id="year" class="form-control" value="{{ old('year', $buku->year) }}">
        </div>
        <div class="form-group">
          <label for="category">Kategori</label>
          <select name="category" id="category" class="form-control" required>
            @foreach ($categories as $category)
              <option value="{{ $category->name }}" {{ old('category', $buku->category) === $category->name ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="stock_total">Stok Buku <span style="color:#ef4444;">*</span></label>
          <input type="number" name="stock_total" id="stock_total" class="form-control" value="{{ old('stock_total', $buku->stock_total) }}" min="1" required>
        </div>
        <div class="form-group">
          <label for="description">Deskripsi</label>
          <textarea name="description" id="description" class="form-control" rows="5">{{ old('description', $buku->description) }}</textarea>
        </div>
      </div>

      @if($buku->cover_image)
      <div class="form-group">
        <label>Sampul Saat Ini</label>
        @if(\Illuminate\Support\Str::startsWith($buku->cover_image, ['http://', 'https://']))
          <img src="{{ $buku->cover_image }}" alt="Cover {{ $buku->title }}" style="height: 140px; width: auto; border-radius: 8px; border: 1px solid var(--border); display: block;">
        @else
          <img src="{{ asset('storage/' . $buku->cover_image) }}" alt="Cover {{ $buku->title }}" style="height: 140px; width: auto; border-radius: 8px; border: 1px solid var(--border); display: block;">
        @endif
      </div>
      @endif

      <div class="form-group">
        <label for="cover_image">Ganti Foto Sampul (file)</label>
        <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/*">
      </div>

      <div class="form-group">
        <label for="cover_url_input">Atau URL Sampul Baru</label>
        <input type="url" name="cover_url_input" id="cover_url_input" class="form-control" value="{{ old('cover_url_input') }}" placeholder="https://...">
      </div>

      <div class="modal-footer" style="margin-top: 12px; padding-top: 16px;">
        <a href="{{ route('admin.books') }}" class="btn-secondary">Batal</a>
        <button type="reset" class="btn-danger">Reset</button>
        <button type="submit" class="btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
@endif
@endsection