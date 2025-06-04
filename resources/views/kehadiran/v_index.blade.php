@extends('layouts.v_template2')

@section('content')
<h4>Data Kehadiran</h4>
<a href="{{ route('kehadiran.create') }}">+ Tambah Kehadiran</a>
<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kegiatan</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kehadiran as $k)
            <tr>
                <td>{{ $k->anggota->nama }}</td>
                <td>{{ $k->kegiatan->nama_kegiatan }}</td>
                <td>{{ $k->status }}</td>
                <td>{{ $k->created_at->format('d-m-Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
