@extends('layouts.v_template2')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h4>Rekap Kehadiran Saya</h4>
    </div>
    <div class="card-body">
        <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Ekstrakurikuler:</strong> {{ $anggota->ekskul->nama_ekskul ?? '-' }}</p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Alfa</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $rekap->total_hadir }}</td>
                    <td>{{ $rekap->total_izin }}</td>
                    <td>{{ $rekap->total_sakit }}</td>
                    <td>{{ $rekap->total_alfa }}</td>
                    <td>{{ $rekap->total_hadir + $rekap->total_izin + $rekap->total_sakit + $rekap->total_alfa }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Riwayat Kehadiran</h5>
    </div>
    <div class="card-body">
        @if($kehadiran_list->isEmpty())
            <p class="text-muted">Belum ada data kehadiran yang diverifikasi.</p>
        @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kehadiran_list as $i => $d)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $d->kegiatan->nama_kegiatan ?? '-' }}</td>
                    <td>
                        <span class="badge badge-{{ 
                            $d->status == 'hadir' ? 'success' : 
                            ($d->status == 'izin' ? 'warning' : 
                            ($d->status == 'sakit' ? 'info' : 'danger')) 
                        }}">
                            {{ ucfirst($d->status) }}
                        </span>
                    </td>
                    <td>{{ $d->keterangan ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($d->created_at)->format('d-m-Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
