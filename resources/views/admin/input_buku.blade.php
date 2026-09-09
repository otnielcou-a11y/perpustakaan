@extends('admin.layout')

@section('title', 'Input Data Buku')

@section('content')
@php
  $categories = \App\Models\Category::orderBy('name')->get();
@endphp

<div class="page-header">
  <div class="page-title">
    <h1>Input Data Buku</h1>
    <p>Tambah buku baru ke inventaris perpustakaan.</p>
  </div>
  <div class="page-buttons">
    <a href="{{ route('admin.books') }}" class="btn-secondary">
      <i class="fa-solid fa-arrow-left"></i> Daftar Buku
    </a>
  </div>
</div>

<div class="panel-card">
  <div class="panel-header">
    <h4><i class="fa-solid fa-book-open" style="color: var(--primary); margin-right: 8px;"></i> Form Tambah Buku</h4>
  </div>
  <div class="panel-body">
    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-row">
        <div class="form-group">
          <label for="title">Judul Buku <span style="color:#ef4444;">*</span></label>
          <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
          <label for="author">Nama Penulis <span style="color:#ef4444;">*</span></label>
          <input type="text" name="author" id="author" class="form-control" value="{{ old('author') }}" required>
        </div>
        <div class="form-group">
          <label for="publisher">Penerbit <span style="color:#ef4444;">*</span></label>
          <input type="text" name="publisher" id="publisher" class="form-control" value="{{ old('publisher') }}" required>
        </div>
        <div class="form-group">
          <label for="isbn">ISBN <span style="color:#ef4444;">*</span></label>
          <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn') }}" placeholder="Contoh: 978-602-8519-00-0" required>
        </div>
        <div class="form-group">
          <label for="year">Tahun Terbit <span style="color:#ef4444;">*</span></label>
          <input type="number" name="year" id="year" class="form-control" value="{{ old('year') }}" placeholder="Contoh: 2024" required>
        </div>
        <div class="form-group">
          <label for="category">Kategori</label>
          <select name="category" id="category" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
              <option value="{{ $category->name }}" {{ old('category') === $category->name ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
            <option value="Lainnya" {{ old('category') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
          </select>
        </div>
        <div class="form-group">
          <label for="stock_total">Stok Buku <span style="color:#ef4444;">*</span></label>
          <input type="number" name="stock_total" id="stock_total" class="form-control" value="{{ old('stock_total') }}" min="1" required>
        </div>
        <div class="form-group">
          <label for="pages">Jumlah Halaman</label>
          <input type="number" name="pages" id="pages" class="form-control" value="{{ old('pages') }}">
        </div>
      </div>

      <div class="form-group">
        <label for="cover_image">Foto Sampul (file)</label>
        <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/*">
      </div>

      <div class="form-group">
        <label for="cover_url_input">Atau URL Sampul</label>
        <input type="url" name="cover_url_input" id="cover_url_input" class="form-control" value="{{ old('cover_url_input') }}" placeholder="https://...">
      </div>

      <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Ringkasan singkat isi buku...">{{ old('description') }}</textarea>
      </div>

      <div class="modal-footer" style="margin-top: 12px; padding-top: 16px;">
        <a href="{{ route('admin.books') }}" class="btn-secondary">Batal</a>
        <button type="reset" class="btn-danger">Reset</button>
        <button type="submit" class="btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan Buku</button>
      </div>
    </form>
  </div>
</div>
@endsection