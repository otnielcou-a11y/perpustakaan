@extends('admin.layout')
@section('content')
<div class="col-9">
<h3>Data Buku</h3>
<hr />
<div class="container">
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header d-flex justify-content-between">
<h4>Input Data Buku</h4>
<a href="{{ route('data_buku') }}" class="btn btn-success">Kembali</a>
</div>
<div class="card-body">
<form action="{{ route('simpanbuku') }}" method="POST" enctype="multipart/form-data">
    @csrf
    </form>
<div class="mb-3 px-2 col-12">
<label for="exampleInputEmail1" class="form-label">Judul Buku</label>
<input type="text" name="judul" class="form-control"
id="exampleInputEmail1"
aria-describedby="emailHelp" />
</div>
<div class="mb-3 col-4 px-2">
<label for="exampleInputPassword1" class="formlabel">Penerbit</label>
<input type="text" name="penerbit" class="form-control"
id="exampleInputPassword1" />
</div>
<div class="mb-3 col-4 px-2">
<label for="exampleInputPassword1" class="form-label">Jumlah
Halaman</label>
<input type="number" name="jml_halaman" class="form-control"
id="exampleInputPassword1" />
</div>
<div class="mb-3 col-4 px-2">
<label for="exampleInputPassword1" class="form-label">Tahun
terbit</label>
<input type="date" name="thn_terbit" class="form-control"
id="exampleInputPassword1" />
</div>
<div class="mb-3 col-4 px-2">
<label for="exampleInputPassword1" class="form-label">Nama
Penulis</label>
<input type="text" name="penulis" class="form-control"
id="exampleInputPassword1" />
</div>
<div class="mb-3 col-4 px-2">
<label for="exampleInputPassword1" class="form-label">Stok</label>
<input type="number" name="stok" class="form-control"
id="exampleInputPassword1" />
</div>
<div class="mb-3 col-4 px-2">
<label for="exampleInputPassword1" class="form-label">Foto
Sampul</label>
<input type="file" name="cover" class="form-control" required
id="exampleInputPassword1" />
</div>
<div class="mb-3 col-12 px-2">
<label for="exampleInputPassword1" class="formlabel">Deskripsi</label>
<textarea name="deskripsi" id="" cols="30" rows="10" class="formcontrol"></textarea>
</div>
<button type="submit" class="btn btn-primary mx-2">
Simpan
</button>
<button type="submit" class="btn btn-danger">Reset</button>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection
