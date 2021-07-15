@extends('admin-master.base')
@section('content')
    <div class="section-header">
        <h1>Detail Data Pasien</h1>
    </div>

    <div class="card">
        <div class="card-body row">
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
                    <input type="text" class="form-control" name="name" value="{{ $patient ? $patient->user->name : old('name') }}" readonly>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Ktp</label>
                    <input type="text" class="form-control" name="ktp" value="{{ $patient ? $patient->ktp : old('ktp') }}" readonly>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" name="birth_date" value="{{ $patient ? $patient->birth_date : old('birth_date') }}" readonly>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" class="form-control" name="birth_place" value="{{ $patient ? $patient->birth_place : old('birth_place') }}" readonly>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    @php
                        $jenisKelamin = ['Laki-Laki', 'Perempuan'];
                    @endphp
                    <select class="form-control" name="gender" readonly>
                        <option value="">-- PILIH JENIS KELAMIN --</option>
                        @foreach ($jenisKelamin as $key => $value)
                            <option value="{{ $value }}" readonly {{ $value == $patient->gender ? 'selected' : '' }}> {{ $value }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="address" value="{{ $patient ? $patient->address : old('address') }}" readonly>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Penyakit</label>
                    <input type="text" class="form-control" name="disease" value="{{ $patient ? $patient->disease : old('disease') }}" readonly>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Gejala</label>
                    <textarea class="form-control" name="symptoms" cols="50" rows="30" readonly>{{ $patient ? $patient->symptoms : old('symptoms') }}</textarea>
                </div>
            </div>

            <div class="form-group col-md-6">
                <div class="form-group">
                    <label>Stadium</label>
                    <input type="number" class="form-control" name="stadium" value="{{ $patient ? $patient->stadium : old('stadium') }}" readonly>
                </div>
            </div>


            @if (!$patient)
                <div class="form-group col-md-12">
                    <hr>
                    <p class="font-weight-600"> Tambah User Login </p>

                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="number" class="form-control" name="phone_number" value="{{ old('phone_number') }}" readonly>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
            @endif

            <div class="form-group col-md-12">
                <a href="{{ route('patient.index') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@endsection
