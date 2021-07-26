@extends('admin-master.base')
@section('content')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="row">
      <div class="col-12 mb-4">
        <div class="hero text-white hero-bg-image hero-bg-parallax" data-background="../assets/img/unsplash/andre-benz-1214056-unsplash.jpg">
          <div class="hero-inner">
            <h2>Hy, Admin</h2>
            <p class="lead">Bagaimana hari ini ? Have a great day right ? </p>
            <div class="mt-4">
              <a href="#" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Dashboard</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                <h4>Jumlah Dokter</h4>
                </div>
                <div class="card-body">
                 {{ $count_doctor }}
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                <h4>Jumlah Tenaga Ahli</h4>
                </div>
                <div class="card-body">
                 {{ $count_it }}
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                <h4>Jumlah Pasien</h4>
                </div>
                <div class="card-body">
                 {{ $count_patient }}
                </div>
            </div>
            </div>
        </div>
    </div>


@endsection
