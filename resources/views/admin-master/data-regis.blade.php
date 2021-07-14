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
                  <th>Nomor Telpon</th>
                  <th>Password</th>
                  <th>Role</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  1
                </td>
                <td>085811747797</td>
                <td>
                    *********
                </td>
                <td>
                 User
                </td>
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