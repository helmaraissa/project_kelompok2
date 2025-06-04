@extends('layouts.v_template2')

@section('title', 'Edit Ekskul')

@section('page', 'Edit Data Ekstrakurikuler')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Form Edit Data Ekskul</h3>
          </div>

          <form action="/ekskul/update/{{ $ekskul->id_ekskul }}" method="POST">
            @csrf
            <div class="card-body">

              <div class="form-group">
                <label for="nama_ekskul">Nama Ekskul</label>
                <input type="text" class="form-control" name="nama_ekskul" id="nama_ekskul"
                       placeholder="Masukkan Nama Ekskul" value="{{ $ekskul->nama_ekskul }}">
                <div class="text-danger">@error('nama_ekskul') {{ $message }} @enderror</div>
              </div>

              <div class="form-group">
                <label for="id_pembina">Pembina</label>
                <select name="id_pembina" id="id_pembina" class="form-control">
                  <option value="">-- Pilih Pembina --</option>
                  @foreach ($pembina as $p)
                    <option value="{{ $p->id }}"
                      {{ $p->id == $ekskul->id_pembina ? 'selected' : '' }}>
                      {{ $p->name }}
                    </option>
                  @endforeach
                </select>
                <div class="text-danger">@error('id_pembina') {{ $message }} @enderror</div>
              </div>

              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control"
                          placeholder="Masukkan Deskripsi">{{ $ekskul->deskripsi }}</textarea>
                <div class="text-danger">@error('deskripsi') {{ $message }} @enderror</div>
              </div>

            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-warning">Update</button>
              <a href="/ekskul"><button type="button" class="btn btn-secondary">Kembali</button></a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
@endsection
