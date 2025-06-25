@extends('layouts.v_template2')

@section('title')
Data Anggota
@endsection

@section('page')
Halaman Data Anggota
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Anggota Ekstrakurikuler</h3>
                </div>

                <div class="card-body">
                    @if(session('pesan'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Sukses</h5>
                            {{ session('pesan') }}
                        </div>
                    @endif

                    @if(Auth::user()->role == 'pembina')
                    <div align="right">
                        <a href="{{ route('anggota.add') }}" class="btn btn-sm btn-success mb-2">Tambah Anggota</a>
                    </div>
                    @endif

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Ekstrakurikuler</th>
                                <th>Pembina</th>
                                <th>Status Keanggotaan</th>
                                <th>Tanggal Gabung</th>
                                @if(Auth::user()->role == 'pembina')
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anggota as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nis }}</td>
                                <td>{{ $item->kelas }}</td>
                                <td>{{ $item->nama_ekskul ?? '-' }}</td>
                                <td>{{ $item->nama_pembina ?? '-' }}</td>
                                <td>
                                    @if(Auth::user()->role == 'pembina')
                                        <form action="{{ route('anggota.update', $item->id) }}" method="POST">
                                            @csrf
                                            <select name="status_keanggotaan" class="form-control form-control-sm" onchange="this.form.submit()">
                                                <option value="aktif" {{ $item->status_keanggotaan == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="tidak aktif" {{ $item->status_keanggotaan == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                                <option value="keluar" {{ $item->status_keanggotaan == 'keluar' ? 'selected' : '' }}>Keluar</option>
                                            </select>
                                        </form>
                                    @else
                                        {{ ucfirst($item->status_keanggotaan) }}
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_gabung)->format('d-m-Y') }}</td>
                                @if(Auth::user()->role == 'pembina')
                                <td>
                                    <a href="{{ route('anggota.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('anggota.delete', $item->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div>
    </div>
</div>
@endsection
