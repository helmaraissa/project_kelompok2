@extends('layouts.v_template2')

@section('title', 'Data Pendaftaran')
@section('page', 'Halaman Data Pendaftaran')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Data Pendaftaran Ekstrakurikuler</h3>
                </div>
                <div class="card-body">
                    @if (session('pesan'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="icon fas fa-check"></i> {{ session('pesan') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Tombol tambah dihapus --}}

                    <form action="{{ route('pendaftaran.mass-update') }}" method="POST">
                        @csrf
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
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
                                @php $no = 1; @endphp
                                @foreach ($pendaftarans as $data)
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="{{ $data->id }}" class="row-checkbox"></td>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->nis }}</td>
                                    <td>{{ $data->kelas }}</td>
                                    <td>{{ $data->jenis_kelamin }}</td>
                                    <td>{{ $data->nama_ekskul }}</td>
                                    <td>
                                        <span class="badge badge-{{ $data->status == 'diterima' ? 'success' : ($data->status == 'ditolak' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($data->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        {{-- Tombol edit dihapus --}}
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id }}">Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3 d-flex">
                            <select name="status_action" class="form-control form-control-sm w-auto mr-2" required>
                                <option value="" disabled selected>Pilih Aksi Massal</option>
                                <option value="diterima">Terima</option>
                                <option value="ditolak">Tolak</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-warning">Proses</button>
                        </div>
                    </form>

                    @foreach ($pendaftarans as $data)
                    <!-- Modal Delete -->
                    <div class="modal fade" id="delete{{ $data->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content bg-danger text-white">
                                <div class="modal-header">
                                    <h6 class="modal-title">Hapus {{ $data->nama }}</h6>
                                    <button type="button" class="close text-white" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus data ini?
                                </div>
                                <div class="modal-footer">
                                    <a href="/datapendaftaran/delete/{{ $data->id }}" class="btn btn-outline-light">Ya</a>
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
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

@section('script')
<script>
    $(document).ready(function () {
        // Fungsi Select All
        $('#select-all').on('click', function () {
            $('.row-checkbox').prop('checked', this.checked);
        });

        // Update status tombol "Select All" jika semua dicentang
        $('.row-checkbox').on('click', function () {
            if (!$(this).prop('checked')) {
                $('#select-all').prop('checked', false);
            } else if ($('.row-checkbox:checked').length === $('.row-checkbox').length) {
                $('#select-all').prop('checked', true);
            }
        });
    });
</script>
@endsection
