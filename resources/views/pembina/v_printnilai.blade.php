<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Print Data Nilai</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #eee; }
        .btn-print { float: right; margin-bottom: 10px; }

        /* Sembunyikan tombol print saat mencetak */
        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <h2>Data Nilai Ekstrakurikuler</h2>
    @if(isset($kelas))
        <h4>Kelas: {{ $kelas }}</h4>
    @endif
    <button class="btn-print" onclick="window.print()">🖨️ Print</button>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Kelas</th>
                <th>Ekskul</th>
                <th>Semester</th>
                <th>Nilai Kehadiran</th>
                <th>Jumlah Lomba</th>
                <th>Nilai Kategori</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($nilai as $n)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $n->nama_anggota }}</td>
                    <td>{{ $n->kelas }}</td>
                    <td>{{ $n->nama_ekskul }}</td>
                    <td>{{ $n->semester }}</td>
                    <td>{{ $n->nilai_kehadiran }}%</td>
                    <td>{{ $n->nilai_lomba }}</td>
                    <td>{{ $n->nilai_kategori }}</td>
                    <td>{{ $n->catatan_penilaian ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
