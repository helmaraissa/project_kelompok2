@extends('layouts.v_template2')

@section('title', 'Edit User')

@section('page', 'Edit Data Pengguna')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Form Edit Data Pengguna</h3>
          </div>
          <form action="/user/update/{{ $user->id }}" method="POST">
            @csrf
            <div class="card-body">

              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama" value="{{ $user->name }}">
                <div class="text-danger">@error('name') {{ $message }} @enderror</div>
              </div>

              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" value="{{ $user->username }}">
                <div class="text-danger">@error('username') {{ $message }} @enderror</div>
              </div>

              <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control">
                  <option value="">-- Pilih Role --</option>
                  <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                  <option value="pembina" {{ $user->role == 'pembina' ? 'selected' : '' }}>Pembina</option>
                  <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
                <div class="text-danger">@error('role') {{ $message }} @enderror</div>
              </div>

              <div class="form-group">
                <label for="password">Password <small class="text-muted">(Kosongkan jika tidak ingin diubah)</small></label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password Baru">
                <div class="text-danger">@error('password') {{ $message }} @enderror</div>
              </div>

            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-warning">Update</button>
              <a href="/user"><button type="button" class="btn btn-secondary">Kembali</button></a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
