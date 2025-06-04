@extends('layouts.v_template2')

@section('title')
Data Pendaftaran
@endsection

@section('page')
Halaman Data Pendaftaran
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pendaftaran Ekstrakurikuler</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (session('pesan'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Success</h5>
                            {{ session('pesan') }}
                        </div>
                    @endif
                    <div align="right">
                        <a href="/datapendaftaran/add" class="btn btn-sm btn-success">Tambah Pendaftaran</a><br>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Email</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Jenis Kelamin</th>
                                <th>Ekstrakurikuler</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach ($pendaftarans as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->nis }}</td>
                                <td>{{ $data->kelas }}</td>
                                <td>{{ $data->jenis_kelamin }}</td>
                                <td>{{ $data->nama_ekskul }}</td>
                                <td>
                                    <form action="{{ route('pendaftaran.update', $data->id) }}" method="POST">
                                        @csrf
                                        <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                            <option value="menunggu" {{ $data->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="diterima" {{ $data->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                            <option value="ditolak" {{ $data->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <a href="/datapendaftaran/edit/{{ $data->id }}" class="btn btn-sm btn-warning">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id }}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @foreach ($pendaftarans as $data)
                    <div class="modal fade" id="delete{{ $data->id }}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h6 class="modal-title">{{ $data->nama }}</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah anda ingin menghapus data ini?</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <a href="/datapendaftaran/delete/{{ $data->id }}" class="btn btn-outline-light">Yes</a>
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    @endforeach

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
