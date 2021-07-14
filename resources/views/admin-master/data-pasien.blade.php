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
                  <th>Status</th>
                  <th>Action</th>
              </tr>
            </thead>
            {{-- <tbody>
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
                <td> </td>
              </tr>
            </tbody> --}}
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
                {data: 'docktor.name', name: 'docktor.name'},
                {data: 'user.name', name: 'user.name'},
                {data: 'medical_number_record', name: 'medical_number_record'},
                {data: 'date_in', name: 'date_in'},
                {data: 'date_out', name: 'date_out'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endpush
