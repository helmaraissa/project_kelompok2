@extends('layouts.v_template2')

@section('title', 'Kegiatan')

@section('page', 'Tambah Data Kegiatan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Kegiatan</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('kegiatan.insert') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="id_ekskul">Ekstrakurikuler</label>
                        <select name="id_ekskul" class="form-control">
                            <option value="">-- Pilih Ekstrakurikuler --</option>
                            @foreach ($ekskul as $item)
                                <option value="{{ $item->id_ekskul }}">{{ $item->nama_ekskul }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger">
                            @error('id_ekskul') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" class="form-control" placeholder="Masukkan Nama Kegiatan" value="{{ old('nama_kegiatan') }}">
                        <div class="text-danger">
                            @error('nama_kegiatan') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kegiatan">Jenis Kegiatan</label>
                        <select name="jenis_kegiatan" class="form-control">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Latihan">Latihan</option>
                            <option value="Lomba">Lomba</option>
                            <option value="Pertemuan">Pertemuan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        <div class="text-danger">
                            @error('jenis_kegiatan') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control" placeholder="Masukkan Keterangan Tambahan">{{ old('keterangan') }}</textarea>
                        <div class="text-danger">
                            @error('keterangan') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}">
                        <div class="text-danger">
                            @error('tanggal') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="waktu_mulai">Waktu Mulai</label>
                        <input type="time" name="waktu_mulai" class="form-control" value="{{ old('waktu_mulai') }}">
                        <div class="text-danger">
                            @error('waktu_mulai') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="waktu_selesai">Waktu Selesai</label>
                        <input type="time" name="waktu_selesai" class="form-control" value="{{ old('waktu_selesai') }}">
                        <div class="text-danger">
                            @error('waktu_selesai') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Masukkan Lokasi Kegiatan" value="{{ old('lokasi') }}">
                        <div class="text-danger">
                            @error('lokasi') {{ $message }} @enderror
                        </div>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Simpan</button>
                        <a href="/kegiatan"><button type="button" class="btn btn-secondary">Kembali</button></a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
