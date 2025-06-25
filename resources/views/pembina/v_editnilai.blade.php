@extends('layouts.v_template2')

@section('title')
Edit Nilai Ekstrakurikuler
@endsection

@section('page')
Form Edit Nilai Ekstrakurikuler
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Nilai</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Anggota</label>
                    <input type="text" class="form-control" value="{{ $nilai->anggota->nama ?? '-' }} - {{ $nilai->anggota->kelas ?? '-' }}" readonly>
                </div>

                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select name="semester" class="form-control" required>
                        <option value="Ganjil" {{ $nilai->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="Genap" {{ $nilai->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="catatan_penilaian">Catatan Penilaian (Opsional)</label>
                    <textarea name="catatan_penilaian" class="form-control" rows="3">{{ $nilai->catatan_penilaian }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Perbarui</button>
                <a href="{{ route('nilai') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
