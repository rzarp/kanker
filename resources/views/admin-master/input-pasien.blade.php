@extends('admin-master.base')
@section('content')
    <div class="section-header">
        <h1>Data Pasien</h1>         
    </div>
  
     <div class="card">
        <div class="card-header">
        <h4>Input Data Pasien</h4>
        </div>
        <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-12">
            <label for="inputEmail4">Nama</label>
            <input type="name" class="form-control" id="inputEmail4" placeholder="Nama">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
            <label for="inputEmail4">Umur</label>
            <input type="name" class="form-control" id="inputEmail4" placeholder="Umur">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Alamat</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Alamat">
        </div>
        </div>
        <div class="card-footer">
        <button class="btn btn-primary">Kirim</button>
        </div>
    </div>
@endsection