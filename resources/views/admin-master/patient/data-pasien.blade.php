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
          <table class="table table-striped" id="data-table">
            <thead>
              <tr>
                <th class="text-center">
                  #
                </th>
                  <th>Nama Dokter</th>
                  <th>Nama Pasien</th>
                  <th>No Rekam Medis</th>
                  <th>Tanggal Masuk</th>
                  <th>Tanggal Keluar</th>
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
            ajax: "{{ route('patient.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'doctor.name', name: 'doctor.name'},
                {data: 'user.name', name: 'user.name'},
                {data: 'medical_number_record', name: 'medical_number_record'},
                {data: 'date_in', name: 'date_in'},
                {data: 'date_out', name: 'date_out'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endpush
