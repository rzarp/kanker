@extends('admin-master.base')
@section('content')

    @php
        $user = $user ?? null;
        $action = $user ? route('user.update', $user->id) : route('user.store');
    @endphp

    <div class="section-header">
        <h1> {{ $user ? 'Edit' : 'Tambah' }} User</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ $action }}" class="row" method="POST">
                @csrf

                @if ($user)
                    <input type="hidden" name="_method" value="PUT">
                @endif

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> Nama </label>
                        <input type="text" class="form-control" name="name" id="" value="{{ $user ? $user->name : old('name') }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> Nomor telepon </label>
                        <input type="number" class="form-control" name="phone_number" id="" value="{{ $user ? $user->phone_number : old('name') }}">
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> Role </label>
                        @php
                            $role = ['ADMIN', 'DOKTER'];
                            $currentRole = $user ? $user->role : old('role')
                        @endphp

                        <select name="role" class="form-control">
                            <option value="">-- PILIH ROLE --</option>
                            @foreach ($role as $key => $value)
                                <option value="{{ $value }}" {{ $value == $currentRole ? 'selected' : '' }}> {{ Str::title($value) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> Password </label>
                        <input type="password" class="form-control" name="password" id="">
                    </div>
                </div>

                <div class="col-md-12">
                    <button class="btn btn-primary float-right ml-2" type="submit"> {{ $user ? 'Edit' : 'Tambah' }} </button>
                    <a href="{{ route('user.index') }}" class="btn btn-danger float-right"> Batal </a>
                </div>
            </form>
        </div>
    </div>
@endsection
