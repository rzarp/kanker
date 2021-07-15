@extends('admin-master.base')
@section('content')
<div class="section-header">
    <h1>Data User</h1>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <a href="{{ route('user.create') }}" class="btn btn-success my-2"> Tambah</a>
        <hr>
        <div class="table-responsive">
          <table class="table table-striped" id="data-table">
            <thead>
              <tr>
                <th class="text-center">
                  #
                </th>
                  <th>Nama</th>
                  <th>Nomor Telp</th>
                  <th>Role</th>
                  <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'phone_number', name: 'phone_number'},
                {data: 'role', name: 'role'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endpush
