@extends('layouts.v_template2')

@section('title', 'Pengguna')

@section('page', 'Tambah Data Pengguna')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Pengguna</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('user.insert') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Nama" value="{{ old('name') }}">
                        <div class="text-danger">
                            @error('name') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username" value="{{ old('username') }}">
                        <div class="text-danger">
                            @error('username') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" class="form-control" id="role">
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="siswa">Siswa</option>
                            <option value="pembina">Pembina</option>
                        </select>
                        <div class="text-danger">
                            @error('role') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password">
                        <div class="text-danger">
                            @error('password') {{ $message }} @enderror
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Simpan</button>
                    <a href="{{ route('user') }}">
                        <button type="button" class="btn btn-secondary">Kembali</button>
                    </a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
</div>
@endsection
