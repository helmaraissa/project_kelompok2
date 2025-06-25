@extends('layouts.v_template2')

@section('title')
Tambah Nilai Ekstrakurikuler
@endsection

@section('page')
Form Tambah Nilai Ekstrakurikuler
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Nilai</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('nilai.insert') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="id_anggota">Nama Anggota</label>
                    <select name="id_anggota" class="form-control" required>
                        <option value="">-- Pilih Anggota --</option>
                        @foreach ($anggota as $a)
                            <option value="{{ $a->id }}">{{ $a->nama }} - {{ $a->kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select name="semester" class="form-control" required>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="catatan_penilaian">Catatan Penilaian (Opsional)</label>
                    <textarea name="catatan_penilaian" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-warning">Simpan</button>
                <a href="{{ route('nilai') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
