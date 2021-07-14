@extends('admin-master.base')
@section('content')
    <div class="section-header">
        <h1>Registerasi Pasien</h1>         
    </div>
  
  <div class="card">
    <div class="card-header">
      <h4>Registrasi Data Pasien</h4>
    </div>
    <div class="card-body">
      <div class="form-row">
        <div class="form-group col-md-12">
          <label for="inputEmail4">No Telpon</label>
          <input type="tel" class="form-control" id="inputEmail4" placeholder="No Telpon">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <label for="inputEmail4">Passowrd</label>
          <input type="password" class="form-control" id="inputEmail4" placeholder="Password">
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button class="btn btn-primary">Kirim</button>
    </div>
  </div>
@endsection