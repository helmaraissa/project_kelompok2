@extends('layouts.v_template2')

@section('content')
<h4>Form Tambah Kehadiran</h4>

<form method="POST" action="{{ route('kehadiran.store') }}">
    @csrf
    <label>Nama Anggota</label>
    <select name="anggota_id">
        @foreach ($anggota as $a)
            <option value="{{ $a->id }}">{{ $a->nama }}</option>
        @endforeach
    </select>

    <label>Nama Kegiatan</label>
    <select name="kegiatan_id">
        @foreach ($kegiatan as $k)
            <option value="{{ $k->id }}">{{ $k->nama_kegiatan }}</option>
        @endforeach
    </select>

    <label>Status</label>
    <select name="status">
        <option value="hadir">Hadir</option>
        <option value="izin">Izin</option>
        <option value="sakit">Sakit</option>
        <option value="alpha">Alpha</option>
    </select>

    <button type="submit">Simpan</button>
</form>
@endsection
