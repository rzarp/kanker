<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="">Kanker</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="/">Kank</a>
  </div>
  <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
        <li><a class="nav-link" href="/"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
      </li>
    <li class="menu-header">Pasien</li>             
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Data Pasien</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link beep beep-sidebar" href="{{route('input.datapasien')}}">Input Data</a></li>
          <li><a class="nav-link beep beep-sidebar" href="{{route('lihat.datapasien')}}">Lihat Data</a></li>
        </ul>

        <li class="menu-header">Registrasi</li>             
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Regist Pasien</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link beep beep-sidebar" href="{{route('input.regispasien')}}">Input Data</a></li>
          <li><a class="nav-link beep beep-sidebar" href="{{route('lihat.regispasien')}}">Lihat Data</a></li>
        </ul>

          <li class="menu-header">Analyze</li>             
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Analyze</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link beep beep-sidebar" href="">Input Data</a></li>
          <li><a class="nav-link beep beep-sidebar" href="">Lihat Data</a></li>
        </ul>
    </ul>
</aside>