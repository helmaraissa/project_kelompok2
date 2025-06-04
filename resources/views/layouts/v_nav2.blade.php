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

    <!-- Dashboard (semua role bisa lihat) -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- ADMIN MENU -->
    @if(Auth::user()->role === 'admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/user') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Data Pengguna</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/ekskul') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Ekstrakurikuler</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/kegiatan') }}">
                <i class="fas fa-fw fa-calendar-alt"></i>
                <span>Data Jadwal Kegiatan</span>
            </a>
        </li>
    @endif

    <!-- PEMBINA MENU -->
    @if(Auth::user()->role === 'pembina')
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/pendaftaran') }}">
                <i class="fas fa-fw fa-clipboard-list"></i>
                <span>Data Pendaftaran</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/anggota') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Anggota</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/kegiatan') }}">
                <i class="fas fa-fw fa-calendar-check"></i>
                <span>Jadwal Kegiatan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/lomba') }}">
                <i class="fas fa-fw fa-trophy"></i>
                <span>Data Lomba</span>
            </a>
        </li>
    @endif

    <!-- SISWA MENU -->
    @if(Auth::user()->role === 'siswa')
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/kalender-kegiatan') }}">
                <i class="fas fa-fw fa-calendar-alt"></i>
                <span>Kalender Kegiatan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/anggota-saya') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Anggota</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/absensi-saya') }}">
                <i class="fas fa-fw fa-check-circle"></i>
                <span>Absensi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/nilai-saya') }}">
                <i class="fas fa-fw fa-graduation-cap"></i>
                <span>Nilai</span>
            </a>
        </li>
    @endif

    <!-- Logout -->
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
