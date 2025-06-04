@extends('layouts.v_template2')

@section('title', 'Edit Anggota')

@section('page', 'Edit Data Anggota')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Form Edit Data Anggota</h3>
        </div>

        <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
          @csrf
          <div class="card-body">

            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" value="{{ $anggota->nama }}" readonly>
            </div>

            <div class="form-group">
              <label for="nis">NIS</label>
              <input type="text" class="form-control" id="nis" name="nis" value="{{ $anggota->nis }}" readonly>
            </div>

            <div class="form-group">
              <label for="kelas">Kelas</label>
              <input type="text" class="form-control" id="kelas" name="kelas" value="{{ $anggota->kelas }}" readonly>
            </div>

            <div class="form-group">
              <label for="nama_ekskul">Ekstrakurikuler</label>
              <input type="text" class="form-control" id="nama_ekskul" name="nama_ekskul" value="{{ $anggota->nama_ekskul }}" readonly>
            </div>

            <div class="form-group">
              <label for="status_keanggotaan">Status Keanggotaan</label>
              <select name="status_keanggotaan" id="status_keanggotaan" class="form-control">
                <option value="aktif" {{ $anggota->status_keanggotaan == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="tidak aktif" {{ $anggota->status_keanggotaan == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                <option value="keluar" {{ $anggota->status_keanggotaan == 'keluar' ? 'selected' : '' }}>Keluar</option>
              </select>
              <div class="text-danger">@error('status_keanggotaan') {{ $message }} @enderror</div>
            </div>

          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('anggota') }}">
              <button type="button" class="btn btn-secondary">Kembali</button>
            </a>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection
