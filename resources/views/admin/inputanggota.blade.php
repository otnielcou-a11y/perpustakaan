@extends('admin.layout')
@section('content')
 <div class="col-9">
                <h3>Data Buku</h3>
                <hr>
    <div class="container">
       <div class="row">
          <div class="col-12">
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <h4>Input Buku </h4>
    <a href="{{route('dashboard')}}" class="btn btn-success">Kembali</a>
  </div>
  <div class="card-body">
   <form class="p-3 border d-flex flex-wrap" >
       <div class="mb-3 px-2 col-12">
         <label for="exampleInputEmail1" class="form-label">Nama</label>
           <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
         </div>
         <div class="row">
             <div class="mb-3">
                 <label for="exampleInputPassword1" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="exampleInputPassword1">
                 </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">NIS</label>
                          <input type="number" class="form-control" id="exampleInputPassword1">
                     </div>
                      <div class="mb-3 ">
                      <label for="exampleInputPassword1" class="form-label">No_Hp</label>
                          <input type="date" class="form-control" id="exampleInputPassword1">
                          <div>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="reset" class="btn btn-primary">Submit</button>
                          </div>
                     </div>
         </div>




    </form>

  </div>
</div>
          </div>
       </div>
    </div>
@endsection
