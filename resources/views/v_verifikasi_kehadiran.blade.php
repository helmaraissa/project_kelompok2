<table class="table">
    <thead>
        <tr>
            <th>Nama Siswa</th>
            <th>Kegiatan</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kehadiran as $k)
        <tr>
            <td>{{ $k->nama }}</td>
            <td>{{ $k->nama_kegiatan }}</td>
            <td>{{ $k->status }}</td>
            <td>{{ $k->keterangan }}</td>
            <td>
                <form action="{{ url('kehadiran/verifikasi/'.$k->id_kehadiran) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-sm btn-success">Verifikasi</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
