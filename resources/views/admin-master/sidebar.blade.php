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

        @if (auth()->user()->role == 'ADMIN')
        <li class="menu-header">Data Master</li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Data Master</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link beep beep-sidebar" href="{{ route('user.index') }}">User</a></li>
            </ul>
        </li>
        @endif

        <li class="menu-header">Pasien</li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Data Pasien</span></a>
            <ul class="dropdown-menu">
                @if (auth()->user()->role == 'ADMIN')
                    <li><a class="nav-link beep beep-sidebar" href="{{ route('patient.create') }}">Input Data</a></li>
                @endif
                <li><a class="nav-link beep beep-sidebar" href="{{ route('patient.index') }}">Lihat Data</a></li>
            </ul>
        </li>

        <li class="menu-header">Analyze</li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Analyze</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link beep beep-sidebar" href="{{ route('analyze') }}">Dashboard</a></li>
            </ul>
        </li>

    </ul>
</aside>
