@extends('layouts.v_template2')

@section('title', 'Ekstrakurikuler')

@section('page', 'Tambah Data Ekstrakurikuler')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Ekstrakurikuler</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form action="/ekskul/insert" method="POST" enctype="multipart/form-data">
                    @csrf

                        <div class="form-group">
                            <label for="nama_ekskul">Nama Ekstrakurikuler</label>
                            <input type="text" name="nama_ekskul" class="form-control" id="nama_ekskul" placeholder="Masukkan Nama Ekstrakurikuler" value="{{ old('nama_ekskul') }}">
                            <div class="text-danger">
                                @error('nama_ekskul') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Pembina</label>
                            <select name="id_pembina" class="form-control">
                                <option value="">-- Pilih Pembina --</option>
                                @foreach ($pembina as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>                        
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" placeholder="Masukkan Deskripsi Ekstrakurikuler">{{ old('deskripsi') }}</textarea>
                        <div class="text-danger">
                            @error('deskripsi') {{ $message }} @enderror
                        </div>
                    </div>
                    
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Simpan</button>
                        <a href="/ekskul"><button type="button" class="btn btn-secondary">Kembali</button></a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
