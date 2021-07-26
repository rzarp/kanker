@extends('admin-master.base')
@section('content')
    <div class="section-header">
        <h1>Detail Data Pasien</h1>
    </div>

    <div class="card">
        <div class="card-body row">

            <div class="col-md-12">
                <h4> Data Pasien </h4>
                <hr>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Nama Dokter</label>
                    <input disabled type="hidden" value="{{ auth()->user()->id }}" name="dokter_id">
                    <input disabled type="text" class="form-control" value="{{ $patient ? $patient->doctor->name : auth()->user()->name }}"  readonly>
                </div>
            </div>


            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Nomor Rekam Medis</label>
                    <input disabled type="text" class="form-control" name="medical_number_record" value="{{ $patient ? $patient->medical_number_record : 'P/' . $medicalNumber }}" readonly>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Nama Pasien</label>
                    <input disabled type="text" class="form-control" name="name" value="{{ $patient ? $patient->name : old('name') }}">
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Ktp</label>
                    <input disabled type="text" class="form-control" name="ktp" value="{{ $patient ? $patient->ktp : old('ktp') }}">
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input disabled type="date" class="form-control" name="birth_date" value="{{ $patient ? $patient->birth_date : old('birth_date') }}">
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input disabled type="text" class="form-control" name="birth_place" value="{{ $patient ? $patient->birth_place : old('birth_place') }}">
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    @php
                        $jenisKelamin = ['Laki-Laki', 'Perempuan'];
                        $currentGender = $patient ? $patient->gender : old('gender');
                    @endphp
                    <select disabled class="form-control" name="gender">
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
                    <input disabled type="text" class="form-control" name="address" value="{{ $patient ? $patient->address : old('address') }}">
                </div>
            </div>

            <div class="col-md-12">
                <h4> Data Penyakit & Riwayat </h4>
                <hr>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label> Lama Inap </label>
                    <input disabled type="number" class="form-control" name="length_of_stay" value="{{ $patient ? $patient->length_of_stay : old('length_of_stay')}}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label> Jenis Stadium </label>

                    @php
                        $stadiumType = ['Dini', 'Lanjut'];
                        $currentStadiumType = $patient ? $patient->stadium_type : old('stadium_type');
                    @endphp

                    <select disabled class="form-control" name="stadium_type">
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
                    <input disabled type="number" class="form-control" name="tumor_size" value="{{ $patient ? $patient->tumor_size : old('tumor_size') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label> Jenis Pengobatan </label>
                    @php
                        $treatmentType = ['KEMOTERAPI', 'RADIOTERAPI'];
                        $currentTreatmentType = $patient ? $patient->treatment_type : old('treatment_type');
                    @endphp

                    <select disabled class="form-control" name="treatment_type">
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

                    <select disabled class="form-control" name="status">
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
                        <input disabled type="radio" name="icu_indikator" value="true" class="custom-switch-input" {{ $currentIcuStatus == true ? 'checked' : '' }}>
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Ya</span>
                    </label>

                    <label class="">
                        <input disabled type="radio" name="icu_indikator" value="false" class="custom-switch-input" {{ $currentIcuStatus == false ? 'checked' : '' }}>
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Tidak</span>
                    </label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label> Berapa lama masuk ruang icu ? (Hari) </label>
                    <input disabled type="number" class="form-control" name="icu_los" value="{{ $patient ? $patient->icu_los : old('icu_los')}} ">
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label> Berapa lama memakai alat ventilator / alat bantu pernapasan ( Jam ) </label>
                    <input disabled type="number" class="form-control" name="vent_hour" value="{{ $patient ? $patient->vent_hour : old('vent_hour')}} ">
                </div>
            </div>


            <div class="form-group col-md-12">
                <a href="{{ route('patient.index') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@endsection
