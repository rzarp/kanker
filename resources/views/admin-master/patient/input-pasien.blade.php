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
            <form action="{{ $action }}" class="row" method="POST">
                @csrf

                @if ($patient)
                    <input type="hidden" name="_method" value="PUT">
                @endif

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
                        <input type="text" class="form-control" name="name" value="{{ $patient ? $patient->user->name : old('name') }}">
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

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label>Penyakit</label>
                        <input type="text" class="form-control" name="disease" value="{{ $patient ? $patient->disease : old('disease') }}">
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label>Gejala</label>
                        <textarea class="form-control" name="symptoms" cols="50" rows="30">{{ $patient ? $patient->symptoms : old('symptoms') }}</textarea>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="form-group">
                        <label>Stadium</label>
                        <input type="number" class="form-control" name="stadium" value="{{ $patient ? $patient->stadium : old('stadium') }}">
                    </div>
                </div>


                @if (!$patient)
                    <div class="form-group col-md-12">
                        <hr>
                        <p class="font-weight-600"> Tambah User Login </p>

                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="number" class="form-control" name="phone_number" value="{{ old('phone_number') }}">
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                @endif

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
