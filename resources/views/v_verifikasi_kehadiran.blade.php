@extends('layouts.v_template2')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Verifikasi Kehadiran</h4>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Tabs --}}
        <ul class="nav nav-tabs" id="kehadiranTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="belum-tab" data-bs-toggle="tab" href="#belum" role="tab">Belum Diverifikasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="sudah-tab" data-bs-toggle="tab" href="#sudah" role="tab">Sudah Diverifikasi</a>
            </li>
        </ul>

        <div class="tab-content mt-3" id="kehadiranTabContent">
            {{-- BELUM --}}
            <div class="tab-pane fade show active" id="belum" role="tabpanel">
                @if($belum->isEmpty())
                    <p class="text-muted">Tidak ada data kehadiran yang belum diverifikasi.</p>
                @else
                <form action="{{ route('kehadiran.mass-verifikasi') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kegiatan</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($belum as $i => $d)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $d->id_kehadiran }}" class="row-checkbox"></td>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->nama_kegiatan }}</td>
                                <td><span class="badge bg-info">{{ ucfirst($d->status) }}</span></td>
                                <td>{{ $d->keterangan ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($d->created_at)->format('d-m-Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-sm btn-success mt-2">Verifikasi Terpilih</button>
                </form>
                @endif
            </div>

            {{-- SUDAH --}}
            <div class="tab-pane fade" id="sudah" role="tabpanel">
                @if($sudah->isEmpty())
                    <p class="text-muted">Belum ada kehadiran yang diverifikasi.</p>
                @else
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kegiatan</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sudah as $i => $d)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->nama_kegiatan }}</td>
                            <td><span class="badge bg-success">Terverifikasi</span></td>
                            <td>{{ $d->keterangan ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($d->created_at)->format('d-m-Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#select-all').on('click', function () {
            $('.row-checkbox').prop('checked', this.checked);
        });

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
