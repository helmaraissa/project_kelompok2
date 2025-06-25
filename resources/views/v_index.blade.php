@extends('layouts/v_template2')
@section('content')

<div class="container-fluid">

    <!-- Judul dan Tombol -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Dashboard</h1>
        <a href="#" class="btn btn-sm btn-warning shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>

    <!-- Card Statistik -->
    <div class="row">

        @auth
            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'pembina')
                <!-- Jumlah Ekskul -->
                <x-dashboard-card 
                    color="warning" 
                    icon="fas fa-users" 
                    label="Data Ekstrakurikuler" 
                    :value="$jumlahEkskul" />
            @endif
        @endauth

        <!-- Jumlah Anggota -->
        <x-dashboard-card 
            color="info" 
            icon="fas fa-user-friends" 
            label="Data Anggota" 
            :value="$jumlahAnggota" />

        @auth
            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'pembina')
                <!-- Jumlah Pembina -->
                <x-dashboard-card 
                    color="danger" 
                    icon="fas fa-chalkboard-teacher" 
                    label="Data Pembina" 
                    :value="$jumlahPembina" />
            @endif
        @endauth

    </div>

    <!-- Galeri Lomba -->
    @if(count($dataLombaPopup) > 0)
    <div class="row mt-4">
        <div class="col-12">
            <h5 class="font-weight-bold text-dark">Galeri Prestasi Siswa</h5>
        </div>

        @foreach($dataLombaPopup as $lomba)
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <img src="{{ asset('storage/foto_kegiatan/' . $lomba->foto_kegiatan) }}" class="card-img-top" alt="Foto Kegiatan" style="height: 180px; object-fit: cover;">
                <div class="card-body p-3">
                    <h6 class="font-weight-bold text-warning">{{ $lomba->nama_kegiatan }}</h6>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($lomba->tanggal)->format('d M Y') }}</small>
                    <p class="small mb-2 mt-1">
                        <strong>Kejuaraan:</strong> {{ $lomba->kejuaraan }}<br>
                        <strong>Nama:</strong> {{ $lomba->nama_siswa }}<br>
                        <strong>Ekskul:</strong> {{ $lomba->nama_ekskul }}
                    </p>
                    <button class="btn btn-sm btn-outline-primary btn-block" data-toggle="modal" data-target="#detailLomba{{ $lomba->id_lomba }}">
                        Lihat Detail
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Detail -->
        <div class="modal fade" id="detailLomba{{ $lomba->id_lomba }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $lomba->id_lomba }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title" id="modalLabel{{ $lomba->id_lomba }}">{{ $lomba->nama_kegiatan }}</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <img src="{{ asset('storage/foto_kegiatan/' . $lomba->foto_kegiatan) }}" class="img-fluid mb-3 rounded">
                        <p><strong>Nama Siswa:</strong> {{ $lomba->nama_siswa }}</p>
                        <p><strong>Ekskul:</strong> {{ $lomba->nama_ekskul }}</p>
                        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($lomba->tanggal)->format('d M Y') }}</p>
                        <p><strong>Kejuaraan:</strong> {{ $lomba->kejuaraan }}</p>
                        <p><strong>Lokasi:</strong> {{ $lomba->lokasi }}</p>
                        @if($lomba->file_sertifikat)
                            <a href="{{ asset('storage/sertifikat/' . $lomba->file_sertifikat) }}" target="_blank" class="btn btn-sm btn-warning">
                                Lihat Sertifikat
                            </a>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>
@endsection
