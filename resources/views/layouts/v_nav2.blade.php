<ul class="navbar-nav sidebar sidebar-white accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center" href="#">
        <div class="sidebar-brand-icon" style="margin-right: 10px;">
            <img src="{{ asset('assets/img/smanjalogo.png') }}" width="40">
        </div>
        <div class="sidebar-brand-text text-dark">
            <strong>EKSKUL</strong><br>SMANJA
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- ======================== ADMIN ======================== -->
    @if(Auth::user()->role === 'admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Data Pengguna</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('ekskul') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Ekstrakurikuler</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('kegiatan') }}">
                <i class="fas fa-fw fa-calendar-alt"></i>
                <span>Data Kegiatan</span>
            </a>
        </li>
    @endif

    <!-- ======================== PEMBINA ======================== -->
    @if(Auth::user()->role === 'pembina')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pendaftaran') }}">
                <i class="fas fa-fw fa-clipboard-list"></i>
                <span>Data Pendaftaran</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('anggota') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Anggota</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('kegiatan') }}">
                <i class="fas fa-fw fa-calendar-check"></i>
                <span>Jadwal Kegiatan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/kehadiran/verifikasi') }}">
                <i class="fas fa-fw fa-check-square"></i>
                <span>Kehadiran</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('lomba') }}">
                <i class="fas fa-fw fa-trophy"></i>
                <span>Data Lomba</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('nilai') }}">
                <i class="fas fa-fw fa-graduation-cap"></i>
                <span>Data Nilai</span>
            </a>
        </li>
    @endif

    <!-- ======================== SISWA ======================== -->
    @if(Auth::user()->role === 'siswa')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('kalender.kegiatan') }}">
                <i class="fas fa-fw fa-calendar-alt"></i>
                <span>Kalender Kegiatan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('anggota.saya') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Anggota</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/rekap-kehadiran') }}">
                <i class="fas fa-fw fa-check-circle"></i>
                <span>Kehadiran</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('nilai.saya') }}">
                <i class="fas fa-fw fa-graduation-cap"></i>
                <span>Nilai</span>
            </a>
        </li>
    @endif

    <!-- ======================== LOGOUT ======================== -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
