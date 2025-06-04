@extends('layouts.v_template2')

@section('title')
Ekstrakurikuler
@endsection

@section('page')
Halaman Ekstrakurikuler
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Ekstrakurikuler</h3>
                </div>
                <div class="card-body">
                    @if (session('pesan'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Success</h5>
                            {{ session('pesan') }}
                        </div>
                    @endif

                    <div align="right">
                        <a href="/ekskul/add" class="btn btn-sm btn-warning">Add Data</a><br>
                    </div>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ekstrakurikuler</th>
                                <th>Pembina</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($ekskul as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->nama_ekskul }}</td>
                                <td>{{ $data->nama_pembina }}</td>
                                <td>{{ $data->deskripsi }}</td>
                                <td>
                                    <a href="/ekskul/detail/{{ $data->id_ekskul }}" class="btn btn-sm btn-secondary">Detail</a>
                                    <a href="/ekskul/edit/{{ $data->id_ekskul }}" class="btn btn-sm btn-warning">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id_ekskul }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @foreach ($ekskul as $data)
                    <div class="modal fade" id="delete{{ $data->id_ekskul }}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h6 class="modal-title">{{ $data->nama_ekskul }}</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah anda ingin menghapus data ini?</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <a href="/ekskul/delete/{{ $data->id_ekskul }}" class="btn btn-outline-light">Yes</a>
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
