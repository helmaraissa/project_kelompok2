@extends('layouts.v_template2')

@section('title')
Detail Nilai
@endsection

@section('page')
Detail Nilai Anggota
@endsection

@section('content')
<style>
@media print {
    body * {
        visibility: hidden;
    }

    .card, .card * {
        visibility: visible;
    }

    .card {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    .btn, nav, header, footer {
        display: none !important;
    }
}
</style>

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Detail Nilai - {{ $nilai->anggota->nama ?? '-' }}</h3>
            <button onclick="window.print()" class="btn btn-warning btn-sm">🖨 Cetak</button>
        </div>
        <div class="card-body">
            <p><strong>Kelas:</strong> {{ $nilai->anggota->kelas ?? '-' }}</p>
            <p><strong>Semester:</strong> {{ $nilai->semester }}</p>
            <p><strong>Nilai Kehadiran:</strong> {{ $nilai->nilai_kehadiran }}%</p>
            <p><strong>Jumlah Lomba:</strong> {{ $nilai->jumlah_lomba }}</p>
            <p><strong>Nilai Kategori:</strong> {{ $nilai->nilai_kategori }}</p>
            <p><strong>Catatan:</strong> {{ $nilai->catatan_penilaian ?? '-' }}</p>

            <hr>

            <h5>Kehadiran</h5>
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

            <h5>Lomba</h5>
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
        </div>

        {{-- Tombol kembali di bawah --}}
        <div class="card-footer">
            <a href="{{ route('nilai') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
