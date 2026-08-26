@extends('admin.layout');
@section('content')
            <div class="col-9">
                <h3>Data Buku</h3>
                <hr>
    <div class="container">
       <div class="row">
          <div class="col-12">
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h4>Data Peminjaman</h4>
        <a href={{ route('input_datapeminjaman')}} class="btn btn-success">Tambah Data</a>

    <a href="" class="btn btn-success">Tambah Data</a>
  </div>
  <div class="card-body">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Judul Buku</th>
      <th scope="col">Peminjaman</th>
      <th scope="col">Tgl-Pinjam</th>
      <th scope="col">Tgl-Kembali</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Feby</td>
      <td>Meminjam</td>
      <td>01-02-2025</td>
      <td>06-02-2025</td>
      <td>Tersedia</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Rani</td>
      <td>Meminjam</td>
      <td>02-02-2025</td>
      <td>07-02-2025</td>
      <td>Tersedia</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Cahaya</td>
      <td>Meminjam</td>
      <td>03-02-2025</td>
      <td>08-02-2025</td>
      <td>Tersedia</td>
    </tr>
    <th scope="row">3</th>
      <td>Tiara</td>
      <td>Meminjam</td>
      <td>03-02-2025</td>
      <td>08-02-2025</td>
      <td>Tersedia</td>
    </tr>
    <th scope="row">3</th>
      <td>Roro</td>
      <td>Meminjam</td>
      <td>03-02-2025</td>
      <td>08-02-2025</td>
      <td>Tersedia</td>
    </tr>
    <th scope="row">3</th>
      <td>Alika</td>
      <td>Meminjam</td>
      <td>03-02-2025</td>
      <td>08-02-2025</td>
      <td>Tersedia</td>


  </tbody>
</table>




    <a href="#" class="btn btn-primary">Kembali</a>
  </div>
</div>


          </div>


       </div>

    </div>

@endsection
