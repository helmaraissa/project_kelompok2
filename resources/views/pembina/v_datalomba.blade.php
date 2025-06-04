@extends('layouts.v_template2')

@section('title')
Data Lomba
@endsection

@section('page')
Halaman Data Lomba
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Lomba</h3>
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
                        <a href="/lomba/add" class="btn btn-sm btn-warning">Add Data</a><br>
                    </div>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Ekstrakurikuler</th>
                                <th>Nama Kegiatan</th>
                                <th>Kejuaraan</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>File Sertifikat</th>
                                <th>Foto Kegiatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($lomba as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->nama_siswa ?? '-' }}</td>
                                <td>{{ $data->nama_ekskul ?? '-' }}</td>
                                <td>{{ $data->nama_kegiatan }}</td>
                                <td>{{ $data->kejuaraan }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $data->lokasi }}</td>
                                <td>
                                    @if($data->file_sertifikat)
                                        <a href="{{ asset('storage/sertifikat/' . $data->file_sertifikat) }}" target="_blank">Lihat File</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($data->foto_kegiatan)
                                        <img src="{{ asset('storage/foto_kegiatan/' . $data->foto_kegiatan) }}" alt="Foto Kegiatan" width="100px" />
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="/lomba/edit/{{ $data->id_lomba }}" class="btn btn-sm btn-warning">Edit</a>

                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id_lomba }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @foreach ($lomba as $data)
                    <div class="modal fade" id="delete{{ $data->id_lomba }}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h6 class="modal-title">{{ $data->nama_kegiatan }}</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah anda ingin menghapus data ini?</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <a href="/lomba/delete/{{ $data->id_lomba }}" class="btn btn-outline-light">Yes</a>
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
