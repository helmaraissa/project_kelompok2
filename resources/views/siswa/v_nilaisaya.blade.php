@extends('layouts.v_template2')

@section('title', 'Nilai Saya')
@section('page', 'Nilai Ekstrakurikuler Saya')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Nilai - {{ $nilai->nama_anggota ?? '-' }}</h3>
        </div>
        <div class="card-body">
            @if($nilai)
                <p><strong>Kelas:</strong> {{ $nilai->kelas ?? '-' }}</p>
                <p><strong>Semester:</strong> {{ $nilai->semester }}</p>
                <p><strong>Ekskul:</strong> {{ $nilai->nama_ekskul }}</p>
                <p><strong>Nilai Kehadiran:</strong> {{ $nilai->nilai_kehadiran }}%</p>
                <p><strong>Jumlah Lomba:</strong> {{ $nilai->nilai_lomba }}</p>
                <p><strong>Nilai Kategori:</strong> {{ $nilai->nilai_kategori }}</p>
                <p><strong>Catatan:</strong> {{ $nilai->catatan_penilaian ?? '-' }}</p>

                <hr>

                <h5>Detail Kehadiran</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kegiatan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kehadiran as $k)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</td>
                                <td>{{ $k->nama_kegiatan }}</td>
                                <td>{{ $k->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr>

                <h5>Riwayat Lomba</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Kegiatan</th>
                            <th>Lokasi</th>
                            <th>Kejuaraan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lomba as $l)
                            <tr>
                                <td>{{ $l->nama_kegiatan }}</td>
                                <td>{{ $l->lokasi }}</td>
                                <td>{{ $l->kejuaraan ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($l->tanggal)->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted text-center">Belum ada data lomba.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <p class="text-muted">Belum ada data nilai.</p>
            @endif
        </div>
    </div>
</div>
@endsection
