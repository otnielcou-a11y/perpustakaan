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
    <h4>Input peminjam</h4>
    <a href="" class="btn btn-success">Kembali</a>
  </div>
  <div class="card-body">
   <form class="p-3 border d-flex flex-wrap" action="{{route('simpandatapeminjaman)}}" method="post">
    @csrf
       <div class="mb-3 px-2 col-12">
         <label for="exampleInputEmail1" class="form-label">Judul Buku</label>
           <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
         </div>
         <div class="row">
             <div class="mb-3 col-4">
                 <label for="exampleInputPassword1" class="form-label">Peminjaman</label>
                    <input type="text" class="form-control" id="exampleInputPassword1">
                 </div>
                    <div class="mb-3 col-4">
                      <label for="exampleInputPassword1" class="form-label">Tanggal Pinjam</label>
                          <input type="date" class="form-control" id="exampleInputPassword1">
                     </div>
                      <div class="mb-3 col-4">
                      <label for="exampleInputPassword1" class="form-label">Tanggal Kembali</label>
                          <input type="date" class="form-control" id="exampleInputPassword1">
                     </div>
         </div>
                     <div class="mb-3 col-6">
                      <label for="exampleInputPassword1" class="form-label">Action</label>
                          <input type=text class="form-control" id="exampleInputPassword1">
                     </div>
                     
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
   
  </div>
</div>
          </div>
       </div>
    </div>
@endsection