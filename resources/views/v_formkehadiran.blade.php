@extends('layouts.v_template2')

@section('title', 'Form Absen')

@section('page', 'Form Kehadiran Kegiatan')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Form Kehadiran</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('/kehadiran/siswa/simpan') }}" method="POST">
                @csrf
                <input type="hidden" name="id_kegiatan" value="{{ $kegiatan->id }}">
                <input type="hidden" name="id_anggota" value="{{ $anggota->id }}">

                <div class="mb-3">
                    <label>Nama Kegiatan</label>
                    <input type="text" class="form-control" value="{{ $kegiatan->nama_kegiatan }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Ekstrakurikuler</label>
                    <input type="text" class="form-control" value="{{ $kegiatan->ekskul->nama_ekskul }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Status Kehadiran</label>
                    <select name="status" class="form-select" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="hadir">Hadir</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                        <option value="alfa">Tanpa Keterangan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Keterangan Tambahan</label>
                    <textarea name="keterangan" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Kirim Absen</button>
                <a href="{{ url('/kalender-kegiatan') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
