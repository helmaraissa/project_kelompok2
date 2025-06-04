@extends('layouts.v_template')

@section('title', 'Pendaftaran Ekstrakurikuler')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="text-uppercase text-center mb-3">Pendaftaran Ekstrakurikuler</h2>
            <p class="text-muted text-center">SMAN 1 Jalancagak</p>
            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

<form action="{{ route('pendaftaran.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label>Ekstrakurikuler</label>
                <select name="id_ekskul" class="form-control" required>
                    <option value="">-- Pilih Ekstrakurikuler --</option>
                    @foreach($ekskul as $eks)
                        <option value="{{ $eks->id_ekskul }}">{{ $eks->nama_ekskul }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email aktif" required>
            </div>

            <div class="form-group mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
            </div>

            <div class="form-group mb-3">
                <label>NIS</label>
                <input type="text" name="nis" class="form-control" placeholder="NIS" required>
            </div>

            <div class="form-group mb-3" style="position: relative;">
              <label>Kelas</label>
              <select name="kelas" class="form-control" required>
                  <option value="">-- Pilih Kelas --</option>
          
                  <optgroup label="Kelas X">
                      @for ($i = 1; $i <= 10; $i++)
                          <option value="X-{{ $i }}">X-{{ $i }}</option>
                      @endfor
                  </optgroup>
          
                  <optgroup label="Kelas XI">
                      @for ($i = 1; $i <= 10; $i++)
                          <option value="XI-{{ $i }}">XI-{{ $i }}</option>
                      @endfor
                  </optgroup>
          
                  <optgroup label="Kelas XII">
                      @for ($i = 1; $i <= 10; $i++)
                          <option value="XII-{{ $i }}">XII-{{ $i }}</option>
                      @endfor
                  </optgroup>
              </select>
          </div>
          

            <div class="form-group mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group mb-4">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat lengkap" required></textarea>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Daftar Sekarang</button>
            </div>
        </form>
    </div>
</div>


</div>
@endsection