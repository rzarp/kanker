@extends('admin-master.base')
@section('content')
<div class="section-header">
    <h1>Data Pasien</h1>         
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Data Pasien</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="table-1">
            <thead>
              <tr>
                <th class="text-center">
                  #
                </th>
                  <th>Nama Pasien</th>
                  <th>Umur Pasien</th>
                  <th>Alamat Pasien</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  1
                </td>
                <td>Bujang</td>
                <td>
                    20 tahun
                </td>
                <td>
                  Kp.Banjaran Pucung
                </td>
                <td><div class="badge badge-success">Sembuh</div></td>
                <td><a href="#" class="btn btn-primary">Edit</a> | <a href="#" class="btn btn-danger">Delete</a> </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection