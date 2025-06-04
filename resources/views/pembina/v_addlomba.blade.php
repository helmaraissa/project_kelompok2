@extends('layouts.v_template2')

@section('title', 'Tambah Data Lomba')

@section('content')
<div class="container">
    <h3>Tambah Data Lomba</h3>

    <form action="{{ route('lomba.insert') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nama Anggota</label>
            <select name="id_anggota" class="form-control" required>
                <option value="">-- Pilih Anggota --</option>
                @foreach($anggota as $a)
                    <option value="{{ $a->id }}" {{ old('id_anggota') == $a->id ? 'selected' : '' }}>
                        {{ $a->nama }} ({{ $a->nis }})
                    </option>
                @endforeach
            </select>
            @error('id_anggota')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Ekstrakurikuler</label>
            <select name="id_ekskul" class="form-control" required>
                <option value="">-- Pilih Ekstrakurikuler --</option>
                @foreach($ekskul as $e)
                    <option value="{{ $e->id_ekskul }}" {{ old('id_ekskul') == $e->id_ekskul ? 'selected' : '' }}>
                        {{ $e->nama_ekskul }}
                    </option>
                @endforeach
            </select>
            @error('id_ekskul')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan') }}" required>
            @error('nama_kegiatan')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Kejuaraan</label>
            <input type="text" name="kejuaraan" class="form-control" value="{{ old('kejuaraan') }}" required>
            @error('kejuaraan')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
            @error('tanggal')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}" required>
            @error('lokasi')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>File Sertifikat (pdf/jpg/png)</label>
            <input type="file" name="file_sertifikat" class="form-control">
            @error('file_sertifikat')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Foto Kegiatan (jpg/png)</label>
            <input type="file" name="foto_kegiatan" class="form-control">
            @error('foto_kegiatan')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('lomba') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
