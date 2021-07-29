@extends('admin-master.base')
@section('content')
    <div class="section-header">
        <h1>Input Data Pasien</h1>
    </div>

    @php
        $patient = $patient ?? null;
        $action = $patient ? route('patient.update', $patient->id) : route('patient.store');
    @endphp

    <div class="card">
        <div class="card-body">

            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <form action="{{ $action }}" class="row" method="POST">
                @csrf

                @if ($patient)
                    <input type="hidden" name="_method" value="PUT">
                @endif

                <div class="col-md-12">
                    <h4> Data Pasien </h4>
                    <hr>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label>Nama Dokter</label>
                        <input type="hidden" value="{{ auth()->user()->id }}" name="dokter_id">
                        <input type="text" class="form-control" value="{{ $patient ? $patient->doctor->name : auth()->user()->name }}"  readonly>
                    </div>
                </div>


                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label>Nomor Rekam Medis</label>
                        <input type="text" class="form-control" name="medical_number_record" value="{{ $patient ? $patient->medical_number_record : 'P/' . $medicalNumber }}" readonly>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label>Nama Pasien</label>
                        <input type="text" class="form-control" name="name" value="{{ $patient ? $patient->name : old('name') }}">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label>Ktp</label>
                        <input type="text" class="form-control" name="ktp" value="{{ $patient ? $patient->ktp : old('ktp') }}">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" name="birth_date" value="{{ $patient ? $patient->birth_date : old('birth_date') }}">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" name="birth_place" value="{{ $patient ? $patient->birth_place : old('birth_place') }}">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        @php
                            $jenisKelamin = ['Laki-Laki', 'Perempuan'];
                            $currentGender = $patient ? $patient->gender : old('gender');
                        @endphp
                        <select class="form-control" name="gender">
                            <option value="">-- PILIH JENIS KELAMIN --</option>
                            @foreach ($jenisKelamin as $key => $value)
                                <option value="{{ $value }}" {{ $value == $currentGender ? 'selected' : '' }}> {{ $value }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="address" value="{{ $patient ? $patient->address : old('address') }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <h4> Data Penyakit & Riwayat </h4>
                    <hr>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label> Lama Inap </label>
                        <input type="number" class="form-control" name="length_of_stay" value="{{ $patient ? $patient->length_of_stay : old('length_of_stay')}}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label> Jenis Stadium </label>

                        @php
                            $stadiumType = ['Dini', 'Lanjut'];
                            $currentStadiumType = $patient ? $patient->stadium_type : old('stadium_type');
                        @endphp

                        <select class="form-control" name="stadium_type">
                            <option value="">-- PILIH JENIS STADIUM --</option>
                            @foreach ($stadiumType as $key => $value)
                                <option value="{{ $value }}" {{ $value == $currentStadiumType ? 'selected' : '' }}> {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label> Ukuran Tumor </label>
                        <input type="number" class="form-control" name="tumor_size" value="{{ $patient ? $patient->tumor_size : old('tumor_size') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label> Jenis Pengobatan </label>
                        @php
                            $treatmentType = ['KEMOTERAPI', 'RADIOTERAPI'];
                            $currentTreatmentType = $patient ? $patient->treatment_type : old('treatment_type');
                        @endphp

                        <select class="form-control" name="treatment_type">
                            <option value="">-- PILIH JENIS PENGOBATAN PASIEN --</option>
                            @foreach ($treatmentType as $key => $value)
                                <option value="{{ $value }}" {{ $value == $currentTreatmentType ? 'selected' : '' }}> {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label> Status </label>
                        @php
                            $status = ['HIDUP', 'MENINGGAL'];
                            $currentStatus = $patient ? $patient->status : old('status');
                        @endphp

                        <select class="form-control" name="status">
                            <option value="">-- PILIH STATUS PASIEN --</option>
                            @foreach ($status as $key => $value)
                                <option value="{{ $value }}" {{ $value == $currentStatus ? 'selected' : '' }}> {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="col-md-12">
                    <hr>
                    <label> Masuk Ruang ICU atau Tidak ? </label>
                    <div class="form-group mt-2">

                        @php
                            $currentIcuStatus = $patient ? $patient->icu_indikator : old('icu_indikator');
                        @endphp

                        <label class="">
                            <input type="radio" name="icu_indikator" value="true" class="custom-switch-input" {{ $currentIcuStatus == true ? 'checked' : '' }}>
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Ya</span>
                        </label>

                        <label class="">
                            <input type="radio" name="icu_indikator" value="false" class="custom-switch-input" {{ $currentIcuStatus == false ? 'checked' : '' }}>
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Tidak</span>
                        </label>
                    </div>
                </div>


                <div class="row col-md-12" id="optional" style="display: none">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Berapa lama masuk ruang icu ? (Hari) </label>
                            <input type="number" class="form-control" name="icu_los" value="{{ $patient ? $patient->icu_los : old('icu_los')}}">
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Berapa lama memakai alat ventilator / alat bantu pernapasan ( Jam ) </label>
                            <input type="number" class="form-control" name="vent_hour" value="{{ $patient ? $patient->vent_hour : old('vent_hour')}}">
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12 float-right">
                    <button class="btn btn-primary float-right ml-3" type="submit">
                        {{ $patient ? 'Edit' : 'Tambah'}} Pasien
                    </button>
                    <a href="{{ route('patient.index') }}" class="btn btn-danger float-right">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready( function() {
        $(document).on('change', '.custom-switch-input', function() {
            let value = $(this).val();

            console.log(value);
            if (value == 'true') {
                $('#optional').css('display', '');
            } else {
                $('#optional').css('display', 'none');
            }
        });
    });
</script>

@endpush
