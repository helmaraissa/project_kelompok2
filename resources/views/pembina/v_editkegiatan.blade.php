@extends('layouts.v_template2')

@section('title', 'Kegiatan')

@section('page', 'Edit Data Kegiatan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Kegiatan</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form action="/kegiatan/update/{{ $kegiatan->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="id_ekskul">Ekstrakurikuler</label>
                        <select name="id_ekskul" class="form-control">
                            <option value="">-- Pilih Ekstrakurikuler --</option>
                            @foreach ($ekskul as $item)
                                <option value="{{ $item->id_ekskul }}" {{ $kegiatan->id_ekskul == $item->id_ekskul ? 'selected' : '' }}>
                                    {{ $item->nama_ekskul }}
                                </option>
                            @endforeach
                        </select>
                        <div class="text-danger">
                            @error('id_ekskul') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" class="form-control" placeholder="Masukkan Nama Kegiatan" value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}">
                        <div class="text-danger">
                            @error('nama_kegiatan') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kegiatan">Jenis Kegiatan</label>
                        <select name="jenis_kegiatan" class="form-control">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Latihan" {{ (old('jenis_kegiatan', $kegiatan->jenis_kegiatan) == 'Latihan') ? 'selected' : '' }}>Latihan</option>
                            <option value="Lomba" {{ (old('jenis_kegiatan', $kegiatan->jenis_kegiatan) == 'Lomba') ? 'selected' : '' }}>Lomba</option>
                            <option value="Pertemuan" {{ (old('jenis_kegiatan', $kegiatan->jenis_kegiatan) == 'Pertemuan') ? 'selected' : '' }}>Pertemuan</option>
                            <option value="Lainnya" {{ (old('jenis_kegiatan', $kegiatan->jenis_kegiatan) == 'Lainnya') ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        <div class="text-danger">
                            @error('jenis_kegiatan') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control" placeholder="Masukkan Keterangan Tambahan">{{ old('keterangan', $kegiatan->keterangan) }}</textarea>
                        <div class="text-danger">
                            @error('keterangan') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $kegiatan->tanggal) }}">
                        <div class="text-danger">
                            @error('tanggal') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="waktu_mulai">Waktu Mulai</label>
                        <input type="time" name="waktu_mulai" class="form-control" value="{{ old('waktu_mulai', $kegiatan->waktu_mulai) }}">
                        <div class="text-danger">
                            @error('waktu_mulai') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="waktu_selesai">Waktu Selesai</label>
                        <input type="time" name="waktu_selesai" class="form-control" value="{{ old('waktu_selesai', $kegiatan->waktu_selesai) }}">
                        <div class="text-danger">
                            @error('waktu_selesai') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Masukkan Lokasi Kegiatan" value="{{ old('lokasi', $kegiatan->lokasi) }}">
                        <div class="text-danger">
                            @error('lokasi') {{ $message }} @enderror
                        </div>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Update</button>
                        <a href="/kegiatan"><button type="button" class="btn btn-secondary">Kembali</button></a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
