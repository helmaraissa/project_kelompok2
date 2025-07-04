<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top"><img src="assets/img/smanjalogo.png" alt="..." /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="#portfolio">Ekstrakurikuler</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Prestasi</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">Jadwal</a></li>

                @auth
                    {{-- Jika sudah login, tampilkan Dashboard --}}
                    <li class="nav-item"><a class="nav-link" href="{{ url('/index') }}">Dashboard</a></li>
                @else
                    {{-- Jika belum login, tampilkan Sign In --}}
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Sign In</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>