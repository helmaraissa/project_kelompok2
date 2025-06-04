@extends('layouts.v_template2')

@section('content')
  <h1>Halaman Detail Ekstrakurikuler</h1>
  <div class="card card-primary">
    <div class="card-header">
    </div>
    <!-- /.card-header -->

    <!-- form start -->
    <form>

      <div class="form-group">
        <label for="exampleInputPassword1">Nama Ekstrakurikuler :</label>
        {{ $ekskul->nama_ekskul }}
      </div>

      <div class="form-group">
        <label for="exampleInputFile">Pembina :</label>
        {{ $ekskul->pembina->name ?? '-' }}
      </div>      

      <div class="form-group">
        <label for="exampleInputFile">Deskripsi :</label>
        {{ $ekskul->deskripsi }}
      </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <a href="/ekskul"><button type="button" class="btn btn-secondary">Kembali</button></a>
    </div>
    </form>
  </div>
@endsection
