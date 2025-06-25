@extends('layouts.v_template2')

@section('title')
Nilai Ekstrakurikuler
@endsection

@section('page')
Halaman Nilai Ekstrakurikuler
@endsection

@section('content')
@php
    $role = Auth::user()->role;
@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Data Nilai Ekstrakurikuler</h3>

                    @if ($role === 'pembina' && count($kelasList))
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-warning dropdown-toggle" data-toggle="dropdown">
                                🖨️ Print Per Kelas
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                @foreach($kelasList as $k)
                                    <a class="dropdown-item" href="{{ route('nilai.print.kelas', $k) }}" target="_blank">
                                        {{ $k }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Sukses</h5>
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Filter untuk Pembina --}}
                    @if ($role == 'pembina')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('nilai') }}">
                                <div class="form-group d-flex align-items-center mb-0">
                                    <label for="kelas" class="mr-2 mb-0">Filter Kelas:</label>
                                    <select name="kelas" onchange="this.form.submit()" class="form-control">
                                        <option value="">-- Semua Kelas --</option>
                                        @foreach($kelasList as $kelas)
                                            <option value="{{ $kelas }}" {{ $filterKelas == $kelas ? 'selected' : '' }}>
                                                {{ $kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('nilai.add') }}" class="btn btn-sm btn-warning">Tambah Data</a>
                        </div>
                    </div>
                    @endif

                    {{-- Tabel Nilai --}}
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Kelas</th>
                                <th>Ekskul</th>
                                <th>Semester</th>
                                <th>Kehadiran</th>
                                <th>Jumlah Lomba</th>
                                <th>Nilai Kategori</th>
                                <th>Catatan Penilaian</th>
                                @if ($role == 'pembina')
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($nilai as $n)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $n->nama_anggota }}</td>
                                    <td>{{ $n->kelas }}</td>
                                    <td>{{ $n->nama_ekskul ?? '-' }}</td>
                                    <td>{{ $n->semester }}</td>
                                    <td>{{ $n->nilai_kehadiran }}%</td>
                                    <td>{{ $n->nilai_lomba }}</td>
                                    <td>{{ $n->nilai_kategori }}</td>
                                    <td>{{ $n->catatan_penilaian ?? '-' }}</td>
                                    @if ($role == 'pembina')
                                        <td>
                                            <a href="{{ route('nilai.detail', $n->id) }}" class="btn btn-sm btn-secondary">Detail</a>
                                            <a href="{{ route('nilai.edit', $n->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $n->id }}">
                                                Hapus
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $role == 'pembina' ? '10' : '9' }}" class="text-center text-muted">
                                        Belum ada data nilai yang tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Modal Hapus --}}
                    @if ($role == 'pembina')
                        @foreach ($nilai as $n)
                        <div class="modal fade" id="delete{{ $n->id }}">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content bg-danger">
                                    <div class="modal-header">
                                        <h6 class="modal-title">{{ $n->nama_anggota }}</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Yakin ingin menghapus nilai ini?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <a href="{{ route('nilai.delete', $n->id) }}" class="btn btn-outline-light">Yes</a>
                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
