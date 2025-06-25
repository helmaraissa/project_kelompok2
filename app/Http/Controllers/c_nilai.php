<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\m_nilai;

class c_nilai extends Controller
{
    // Menampilkan data nilai tergantung role user (pembina atau siswa)
    public function index(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login
        $role = $user->role;

        if ($role === 'pembina') {
            $id_pembina = $user->id;

            // Ambil daftar kelas dari anggota ekskul yang dibina
            $kelasList = DB::table('anggota')
                ->join('ekskul', 'anggota.id_ekskul', '=', 'ekskul.id_ekskul')
                ->where('ekskul.id_pembina', $id_pembina)
                ->select('anggota.kelas')
                ->distinct()
                ->pluck('kelas');

            $filterKelas = $request->input('kelas'); // Filter kelas dari form

            // Query nilai berdasarkan ekskul yang dibina
            $query = DB::table('nilai')
                ->join('anggota', 'nilai.id_anggota', '=', 'anggota.id')
                ->join('ekskul', 'nilai.id_ekskul', '=', 'ekskul.id_ekskul')
                ->where('ekskul.id_pembina', $id_pembina)
                ->select(
                    'nilai.*',
                    'anggota.id as id_anggota',
                    'anggota.nama as nama_anggota',
                    'anggota.kelas',
                    'ekskul.nama_ekskul'
                );

            // Filter berdasarkan kelas jika ada
            if ($filterKelas) {
                $query->where('anggota.kelas', $filterKelas);
            }

            $nilai = $query->get();
        } elseif ($role === 'siswa') {
            // Jika siswa, tampilkan nilai miliknya sendiri
            $id_user = $user->id;
            $kelasList = [];
            $filterKelas = '';

            $nilai = DB::table('nilai')
                ->join('anggota', 'nilai.id_anggota', '=', 'anggota.id')
                ->join('ekskul', 'nilai.id_ekskul', '=', 'ekskul.id_ekskul')
                ->where('anggota.id_user', $id_user)
                ->select(
                    'nilai.*',
                    'anggota.id as id_anggota',
                    'anggota.nama as nama_anggota',
                    'anggota.kelas',
                    'ekskul.nama_ekskul'
                )
                ->get();
        } else {
            // Role tidak valid
            abort(403);
        }

        // Hitung nilai otomatis (kehadiran & lomba) untuk setiap item
        foreach ($nilai as $item) {
            $totalKegiatan = DB::table('kegiatan')->where('id_ekskul', $item->id_ekskul)->count();
            $totalHadir = DB::table('kehadiran')->where('id_anggota', $item->id_anggota)->where('status', 'Hadir')->count();
            $jumlahLomba = DB::table('lomba')->where('id_anggota', $item->id_anggota)->count();

            $item->nilai_kehadiran = $totalKegiatan > 0 ? round(($totalHadir / $totalKegiatan) * 100) : 0;
            $item->nilai_lomba = $jumlahLomba;
        }

        // Tampilkan ke view
        return view('v_datanilai', compact('nilai', 'kelasList', 'filterKelas'));
    }

    // Menampilkan detail nilai (termasuk kehadiran dan lomba)
    public function detail($id)
    {
        $nilai = m_nilai::with('anggota')->findOrFail($id);

        // Ambil kehadiran berdasarkan anggota
        $kehadiran = DB::table('kehadiran')
            ->join('kegiatan', 'kehadiran.id_kegiatan', '=', 'kegiatan.id')
            ->where('kehadiran.id_anggota', $nilai->id_anggota)
            ->select('kegiatan.nama_kegiatan', 'kegiatan.tanggal', 'kehadiran.status')
            ->orderBy('kegiatan.tanggal', 'asc')
            ->get();

        // Ambil data lomba
        $lomba = DB::table('lomba')
            ->where('id_anggota', $nilai->id_anggota)
            ->select('nama_kegiatan', 'lokasi', 'kejuaraan', 'tanggal')
            ->get();

        // Hitung ringkasan
        $totalKegiatan = DB::table('kegiatan')->where('id_ekskul', $nilai->id_ekskul)->count();
        $totalHadir = DB::table('kehadiran')->where('id_anggota', $nilai->id_anggota)->where('status', 'Hadir')->count();
        $jumlahLomba = DB::table('lomba')->where('id_anggota', $nilai->id_anggota)->count();

        $nilai->nilai_kehadiran = $totalKegiatan > 0 ? round(($totalHadir / $totalKegiatan) * 100) : 0;
        $nilai->jumlah_lomba = $jumlahLomba;

        return view('pembina.v_detailnilai', compact('nilai', 'kehadiran', 'lomba'));
    }

    // Tampilkan form tambah nilai
    public function add()
    {
        $id_pembina = auth()->user()->id;

        // Ambil anggota dari ekskul yang dibina
        $anggota = DB::table('anggota')
            ->join('ekskul', 'anggota.id_ekskul', '=', 'ekskul.id_ekskul')
            ->where('ekskul.id_pembina', $id_pembina)
            ->select('anggota.*')
            ->get();

        return view('pembina.v_addnilai', compact('anggota'));
    }

    // Simpan nilai baru ke database
    public function insert(Request $request)
    {
        $request->validate([
            'id_anggota' => 'required|exists:anggota,id',
            'semester' => 'required|string',
            'catatan_penilaian' => 'nullable|string',
        ]);

        $anggota = DB::table('anggota')->where('id', $request->id_anggota)->first();

        // Hitung nilai kategori otomatis
        $kategori = $this->hitungKategoriOtomatis($anggota->id, $anggota->id_ekskul);

        DB::table('nilai')->insert([
            'id_anggota' => $request->id_anggota,
            'id_ekskul' => $anggota->id_ekskul,
            'semester' => $request->semester,
            'nilai_kategori' => $kategori,
            'catatan_penilaian' => $request->catatan_penilaian,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('nilai')->with('success', 'Nilai berhasil ditambahkan.');
    }

    // Tampilkan form edit nilai
    public function edit($id)
    {
        $nilai = m_nilai::with('anggota')->findOrFail($id);
        return view('pembina.v_editnilai', compact('nilai'));
    }

    // Update nilai
    public function update(Request $r, $id)
    {
        $nilai = m_nilai::findOrFail($id);

        $r->validate([
            'semester' => 'required|string',
            'catatan_penilaian' => 'nullable|string',
        ]);

        $kategori = $this->hitungKategoriOtomatis($nilai->id_anggota, $nilai->id_ekskul);

        $nilai->update([
            'semester' => $r->semester,
            'nilai_kategori' => $kategori,
            'catatan_penilaian' => $r->catatan_penilaian,
            'updated_at' => now(),
        ]);

        return redirect()->route('nilai')->with('success', 'Nilai berhasil diperbarui.');
    }

    // Hapus data nilai
    public function delete($id)
    {
        $nilai = m_nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->route('nilai')->with('success', 'Nilai berhasil dihapus.');
    }

    // Fungsi untuk menghitung kategori nilai secara otomatis
    private function hitungKategoriOtomatis($id_anggota, $id_ekskul)
    {
        $totalKegiatan = DB::table('kegiatan')->where('id_ekskul', $id_ekskul)->count();
        $totalHadir = DB::table('kehadiran')->where('id_anggota', $id_anggota)->where('status', 'Hadir')->count();
        $jumlahLomba = DB::table('lomba')->where('id_anggota', $id_anggota)->count();

        $persentase = $totalKegiatan > 0 ? ($totalHadir / $totalKegiatan) * 100 : 0;

        // Penilaian otomatis berdasarkan ketentuan
        if ($persentase >= 90 && $jumlahLomba >= 2) return 'Sangat Baik';
        if ($persentase >= 75 && $jumlahLomba >= 1) return 'Baik Sekali';
        if ($persentase >= 60) return 'Baik';
        if ($persentase >= 40) return 'Cukup';
        return 'Kurang';
    }

    // Cetak nilai berdasarkan kelas
    public function printByKelas($kelas)
    {
        $user = Auth::user();
        if ($user->role !== 'pembina') abort(403);

        $id_pembina = $user->id;

        $nilai = DB::table('nilai')
            ->join('anggota', 'nilai.id_anggota', '=', 'anggota.id')
            ->join('ekskul', 'nilai.id_ekskul', '=', 'ekskul.id_ekskul')
            ->where('ekskul.id_pembina', $id_pembina)
            ->where('anggota.kelas', $kelas)
            ->select(
                'nilai.*',
                'anggota.nama as nama_anggota',
                'anggota.kelas',
                'ekskul.nama_ekskul'
            )
            ->get();

        // Hitung otomatis untuk tiap nilai
        foreach ($nilai as $item) {
            $totalKegiatan = DB::table('kegiatan')->where('id_ekskul', $item->id_ekskul)->count();
            $totalHadir = DB::table('kehadiran')->where('id_anggota', $item->id_anggota)->where('status', 'Hadir')->count();
            $jumlahLomba = DB::table('lomba')->where('id_anggota', $item->id_anggota)->count();

            $item->nilai_kehadiran = $totalKegiatan > 0 ? round(($totalHadir / $totalKegiatan) * 100) : 0;
            $item->nilai_lomba = $jumlahLomba;
        }

        return view('pembina.v_printnilai', compact('nilai', 'kelas'));
    }
}
