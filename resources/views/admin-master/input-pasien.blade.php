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
            <label for="inputEmail4">Nama Dokter</label>
            <input type="name" class="form-control" id="inputEmail4" placeholder="Nama Dokter">
            </div>
        </div>
         <div class="form-row">
            <div class="form-group col-md-12">
            <label for="inputEmail4">Nama Pasien</label>
            <input type="name" class="form-control" id="inputEmail4" placeholder="Nama Pasien">
            </div>
        </div>
         <div class="form-row">
            <div class="form-group col-md-12">
            <label for="inputEmail4">No Rekam Medis</label>
            <input type="name" class="form-control" id="inputEmail4" placeholder="No Rekam Medis">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
            <label for="inputEmail4">Tanggal Masuk</label>
            <input type="text" class="form-control datepicker" placeholder="Tanggal Masuk">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
            <label>Tanggal Keluar</label>
                <input type="text" class="form-control datepicker" placeholder="Tanggal Keluar">
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
            <textarea id="inputAddress2" class="form-control" rows="3" name="berita" ></textarea>
        </div>
        <div class="card-footer">
        <button class="btn btn-primary">Kirim</button>
        </div>
    </div>
@endsection
