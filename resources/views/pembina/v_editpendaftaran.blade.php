@extends('layouts.v_template2')

@section('title', 'Edit Pendaftaran')

@section('page', 'Edit Data Pendaftaran')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Form Edit Data Pendaftaran</h3>
          </div>
          <form action="/pendaftaran/update/{{ $pendaftaran->id }}" method="POST">
            @csrf
            <div class="card-body">

              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" value="{{ $pendaftaran->nama }}">
                <div class="text-danger">@error('nama') {{ $message }} @enderror</div>
              </div>

              <div class="form-group">
                <label for="nis">NIS</label>
                <input type="text" class="form-control" name="nis" id="nis" placeholder="Masukkan NIS" value="{{ $pendaftaran->nis }}">
                <div class="text-danger">@error('nis') {{ $message }} @enderror</div>
              </div>

              <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="text" class="form-control" name="kelas" id="kelas" placeholder="Masukkan Kelas" value="{{ $pendaftaran->kelas }}">
                <div class="text-danger">@error('kelas') {{ $message }} @enderror</div>
              </div>

              <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" value="{{ $pendaftaran->tgl_lahir }}">
                <div class="text-danger">@error('tgl_lahir') {{ $message }} @enderror</div>
              </div>

              <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                  <option value="Laki-laki" {{ $pendaftaran->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                  <option value="Perempuan" {{ $pendaftaran->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <div class="text-danger">@error('jenis_kelamin') {{ $message }} @enderror</div>
              </div>

              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat">{{ $pendaftaran->alamat }}</textarea>
                <div class="text-danger">@error('alamat') {{ $message }} @enderror</div>
              </div>

              <div class="form-group">
                <label for="ekskul">Ekstrakurikuler</label>
                <input type="text" class="form-control" name="ekskul" id="ekskul" placeholder="Masukkan Ekstrakurikuler" value="{{ $pendaftaran->ekskul }}">
                <div class="text-danger">@error('ekskul') {{ $message }} @enderror</div>
              </div>

              <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                  <option value="menunggu" {{ $pendaftaran->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                  <option value="diterima" {{ $pendaftaran->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                  <option value="ditolak" {{ $pendaftaran->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <div class="text-danger">@error('status') {{ $message }} @enderror</div>
              </div>

            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-warning">Update</button>
              <a href="/pendaftaran" class="btn btn-secondary">Kembali</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
