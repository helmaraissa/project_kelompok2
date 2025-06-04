@extends('layouts.v_template2')

@section('title')
Form Absensi
@endsection

@section('page')
Form Absensi
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Absensi</h3>
                </div>
                <div class="card-body">
                    @if(session('pesan'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('pesan') }}
                        </div>
                    @endif

                    <form action="{{ route('kehadiran.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="id_kegiatan">Pilih Kegiatan</label>
                            <select name="id_kegiatan" id="id_kegiatan" class="form-control" required>
                                <option value="">-- Pilih Kegiatan --</option>
                                @foreach($kegiatan as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kegiatan }} ({{ \Carbon\Carbon::parse($k->tanggal)->format('d-m-Y') }})</option>
                                @endforeach
                            </select>
                            @error('id_kegiatan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Status Kehadiran</label>
                            <select name="status" class="form-control" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="hadir">Hadir</option>
                                <option value="izin">Izin</option>
                                <option value="alpa">Alpa</option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan (opsional)</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="form-control" placeholder="Isi keterangan jika perlu..."></textarea>
                            @error('keterangan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Submit Absensi</button>
                    </form>

                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col-md-6 -->
    </div> <!-- /.row -->
</div> <!-- /.container-fluid -->
@endsection
