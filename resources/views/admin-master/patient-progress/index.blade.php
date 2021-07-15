@extends('admin-master.base')
@section('content')
    <div class="section-header">
        <h1>Input Perkembangan Pasien</h1>
    </div>
    <div class="row">

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for=""> Nama Pasien </label>

                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ $patient->user->name }}" readonly>
                                <a href="{{ route('patient.show', $patient->id) }}" target="_blank" class="btn btn-primary p-2"> Detail </a>
                            </div>
                        </div>

                        <form action="{{ route('patient.progress.create', $patient->id) }}" method="POST" class="col-md-12">
                            @csrf

                            <div class="form-group col-md-12">
                                <hr>
                                <p class="text-bold text-lg-left"> Tambah Perkembangan Pasien </p>

                                <label class="mt-2"> Deskripsi </label>
                                <textarea class="form-control" name="description" cols="30" rows="10" style="height: 200px"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="mt-2"> Laju Kesembuhan </label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="progress" placeholder="Persentase">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary float-right ml-2" type="submit"> Tambah </button>
                                <button class="btn btn-warning float-right"> Kembali </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <p> Riwayat Pasien </p>
                    <img src="{{ asset('assets/img/medicine.png')}}" alt="" width="auto" height="300" class="m-auto text-center" style="display: flex">

                    <div class="activities">
                        @foreach ($patientprogress as $key => $value)
                            <div class="activity">
                                <div class="activity-icon bg-primary text-white shadow-primary">
                                <i class="fas fa-notes-medical"></i>
                                </div>
                                <div class="activity-detail w-75">
                                <div class="mb-2">
                                    <span class="text-job text-primary">{{ $value->created_at->format('d M Y') }}</span>
                                    <span class="bullet"></span>
                                    <span class="text-job text-black">{{ $value->progress . '%' }}</span>

                                    <div class="float-right dropdown">
                                    <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item has-icon text-danger confirm-delete" data-id="{{ $value->id }}">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </a>
                                    </div>
                                    </div>
                                </div>
                                <p> {{ $value->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modal')
    <div class="modal" tabindex="-1" role="dialog" id="delete-confirm">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus data riwayat pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus data ini ?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('patient.progress.delete') }}" method="POST">
                        @csrf

                        <input type="hidden" id="id_delete" name="id">
                        <input type='hidden' name='_method' value='DELETE'>

                        <button type="submit" class="btn btn-danger btn-shadow" id="">Hapus</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.confirm-delete', function () {
            let id = $(this).data('id');

            $('#id_delete').val(id);
            $('#delete-confirm').modal();
        });
    });
</script>
@endpush
