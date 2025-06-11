@extends('layouts.v_template2')

@section('content')
<div class="container mt-4">
    <h4>Form Kehadiran Siswa</h4>

    <form action="{{ url('/kehadiran/siswa/simpan') }}" method="POST">
        @csrf
        <input type="hidden" name="id_kegiatan" value="{{ $kegiatan->id }}">
        <input type="hidden" name="id_anggota" value="{{ $anggota->id }}">

        <div class="row mb-3">
            <div class="col-md-4">
                <label>Nama Siswa:</label>
                <input type="text" class="form-control" value="{{ $anggota->nama }}" readonly>
            </div>
            <div class="col-md-4">
                <label>NIS:</label>
                <input type="text" class="form-control" value="{{ $anggota->nis }}" readonly>
            </div>
            <div class="col-md-4">
                <label>Kelas:</label>
                <input type="text" class="form-control" value="{{ $anggota->kelas }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Nama Kegiatan:</label>
                <input type="text" class="form-control" value="{{ $kegiatan->nama_kegiatan }}" readonly>
            </div>
            <div class="col-md-3">
                <label>Tanggal:</label>
                <input type="text" class="form-control" value="{{ $kegiatan->tanggal }}" readonly>
            </div>
            <div class="col-md-3">
                <label>Waktu:</label>
                <input type="text" class="form-control" value="{{ $kegiatan->waktu_mulai }} - {{ $kegiatan->waktu_selesai }}" readonly>
            </div>
        </div>

        <div class="mb-3">
            <label>Lokasi:</label>
            <input type="text" class="form-control" value="{{ $kegiatan->lokasi }}" readonly>
        </div>

        <div class="mb-3">
            <label>Status Kehadiran:</label>
            <select name="status" class="form-control" required>
                <option value="">-- Pilih Status --</option>
                <option value="Hadir">Hadir</option>
                <option value="Izin">Izin</option>
                <option value="Alpa">Alpa</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Keterangan (Opsional):</label>
            <input type="text" name="keterangan" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Kirim Kehadiran</button>
    </form>
</div>
@endsection
