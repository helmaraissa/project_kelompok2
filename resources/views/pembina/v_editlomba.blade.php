@extends('layouts.v_template2')

@section('title', 'Edit Data Lomba')

@section('content')
<div class="container">
    <h3>Edit Data Lomba</h3>

    <form action="{{ route('lomba.update', $lomba->id_lomba) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Anggota</label>
            <select name="id_anggota" class="form-control" required>
                @foreach($anggota as $a)
                    <option value="{{ $a->id }}" {{ $lomba->id_anggota == $a->id ? 'selected' : '' }}>
                        {{ $a->nama }} ({{ $a->nis }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Ekstrakurikuler</label>
            <input type="text" class="form-control" value="{{ $ekskul->nama_ekskul }}" readonly>
            <input type="hidden" name="id_ekskul" value="{{ $ekskul->id_ekskul }}">
        </div>

        <div class="form-group">
            <label>Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control" value="{{ $lomba->nama_kegiatan }}" required>
        </div>

        <div class="form-group">
            <label>Kejuaraan</label>
            <input type="text" name="kejuaraan" class="form-control" value="{{ $lomba->kejuaraan }}" required>
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $lomba->tanggal }}" required>
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ $lomba->lokasi }}" required>
        </div>

        <div class="form-group">
            <label>File Sertifikat Saat Ini:</label>
            @if($lomba->file_sertifikat)
                <a href="{{ asset('storage/sertifikat/' . $lomba->file_sertifikat) }}" target="_blank">{{ $lomba->file_sertifikat }}</a>
            @else
                <span>Tidak ada file</span>
            @endif
        </div>

        <div class="form-group">
            <label>Ganti File Sertifikat (pdf/jpg/png)</label>
            <input type="file" name="file_sertifikat" class="form-control">
        </div>

        <div class="form-group">
            <label>Foto Kegiatan Saat Ini:</label><br>
            @if($lomba->foto_kegiatan)
                <img src="{{ asset('storage/foto_kegiatan/' . $lomba->foto_kegiatan) }}" alt="Foto Kegiatan" width="200px">
            @else
                <span>Tidak ada foto</span>
            @endif
        </div>

        <div class="form-group">
            <label>Ganti Foto Kegiatan (jpg/png)</label>
            <input type="file" name="foto_kegiatan" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('lomba') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
