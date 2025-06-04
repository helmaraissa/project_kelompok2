@extends('layouts.v_template2')
@section('title', 'Absensi Kehadiran')
@section('content')

<div class="container mt-3">
    <h4>Scan QR untuk Absensi</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('siswa.kehadiran.scan') }}" method="POST">
        @csrf
        <input type="text" name="kode_qr" class="form-control mb-2" placeholder="Scan atau tempel QR Code di sini..." required>
        <button type="submit" class="btn btn-primary">Absen Sekarang</button>
    </form>
</div>

@endsection
