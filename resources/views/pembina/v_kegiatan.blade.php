@extends('layouts.v_template2')

@section('title')
Data Kegiatan
@endsection

@section('page')
Data Kegiatan
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Kegiatan</h3>
                </div>
                <div class="card-body">
                    @if (session('pesan'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Success</h5>
                            {{ session('pesan') }}
                        </div>
                    @endif

                    <div align="right" class="mb-2">
                        <a href="/kegiatan/add" class="btn btn-sm btn-warning">+ Tambah Kegiatan</a>
                    </div>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Ekstrakurikuler</th>
                                <th>Jenis</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatan as $index => $k)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $k->nama_kegiatan }}</td>
                                <td>{{ $k->nama_ekskul }}</td>
                                <td>{{ $k->jenis_kegiatan }}</td>
                                <td>{{ \Carbon\Carbon::parse($k->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $k->waktu_mulai }} - {{ $k->waktu_selesai }}</td>
                                <td>{{ $k->lokasi }}</td>
                                <td>
                                    <a href="/kegiatan/edit/{{ $k->id }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('kegiatan.delete', $k->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus kegiatan ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col-md-12 -->
    </div> <!-- /.row -->
</div> <!-- /.container-fluid -->
@endsection
