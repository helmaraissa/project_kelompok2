<?php

namespace App\Http\Controllers;

use App\Models\m_anggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class c_anggota extends Controller
{
    protected $m_anggota;

    public function __construct()
    {
        $this->m_anggota = new m_anggota();
    }

    public function index()
    {
        $user = Auth::user();
        $id_pembina = $user->id;

        // Ambil pendaftar yang diterima untuk ekskul yang dibina oleh pembina yang login
        $pendaftarans = DB::table('pendaftarans')
            ->join('ekskul', 'pendaftarans.id_ekskul', '=', 'ekskul.id_ekskul')
            ->where('pendaftarans.status', 'diterima')
            ->where('ekskul.id_pembina', $id_pembina)
            ->select('pendaftarans.*') // pastikan field id_user termasuk
            ->get();

        // Looping untuk sinkronisasi ke tabel anggota
        foreach ($pendaftarans as $p) {
            $exists = DB::table('anggota')
                ->where('nis', $p->nis)
                ->where('id_ekskul', $p->id_ekskul)
                ->exists();

            if (!$exists) {
                DB::table('anggota')->insert([
                    'nama' => $p->nama,
                    'nis' => $p->nis,
                    'kelas' => $p->kelas,
                    'tgl_lahir' => $p->tgl_lahir,
                    'jenis_kelamin' => $p->jenis_kelamin,
                    'alamat' => $p->alamat,
                    'id_ekskul' => $p->id_ekskul,
                    'status_keanggotaan' => 'aktif',
                    'tanggal_gabung' => now(),
                    'id_user' => $p->id_user, // ✅ ini yang penting
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Ambil data anggota yang sudah aktif dan sesuai ekskul pembina
        $anggota = DB::table('anggota')
            ->join('ekskul', 'anggota.id_ekskul', '=', 'ekskul.id_ekskul')
            ->leftJoin('users', 'ekskul.id_pembina', '=', 'users.id')
            ->select('anggota.*', 'ekskul.nama_ekskul', 'users.name as nama_pembina')
            ->where('ekskul.id_pembina', $id_pembina)
            ->where('anggota.status_keanggotaan', 'aktif')
            ->get();

        return view('v_dataanggota', ['anggota' => $anggota]);
    }

    public function add()
    {
        $data = [
            'ekskul' => DB::table('ekskul')->get(),
        ];
        return view('pembina.v_addanggota', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:anggota,nis',
            'kelas' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required',
            'id_ekskul' => 'required|exists:ekskul,id_ekskul',
            'status_keanggotaan' => 'required|in:aktif,tidak aktif,keluar',
        ]);

        $data = [
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'id_ekskul' => $request->id_ekskul,
            'tanggal_gabung' => date('Y-m-d'),
            'status_keanggotaan' => $request->status_keanggotaan,
        ];

        $this->m_anggota->addData($data);

        return redirect()->route('anggota')->with('pesan', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $anggota = DB::table('anggota')
            ->join('ekskul', 'anggota.id_ekskul', '=', 'ekskul.id_ekskul')
            ->select('anggota.*', 'ekskul.nama_ekskul')
            ->where('anggota.id', $id)
            ->first();

        if (!$anggota) {
            return redirect()->route('anggota.index')->with('error', 'Data anggota tidak ditemukan');
        }

        return view('pembina.v_editanggota', compact('anggota'));
    }

    public function update(Request $request, $id_anggota)
    {
        $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:anggota,nis,' . $id_anggota,
            'kelas' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required',
            'id_ekskul' => 'required|exists:ekskul,id_ekskul',
            'status_keanggotaan' => 'required|in:aktif,tidak aktif,keluar',
        ]);

        $data = [
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'id_ekskul' => $request->id_ekskul,
            'status_keanggotaan' => $request->status_keanggotaan,
        ];

        $this->m_anggota->editData($id_anggota, $data);

        return redirect()->route('anggota')->with('pesan', 'Data berhasil diupdate!');
    }

    public function delete($id_anggota)
    {
        $this->m_anggota->deleteData($id_anggota);

        return redirect()->route('anggota')->with('pesan', 'Data berhasil dihapus!');
    }

    public function anggotaSiswa()
    {
        $user = auth()->user();

        $anggota = DB::table('anggota')
            ->join('ekskul', 'anggota.id_ekskul', '=', 'ekskul.id_ekskul')
            ->leftJoin('users', 'ekskul.id_pembina', '=', 'users.id')
            ->select('anggota.*', 'ekskul.nama_ekskul', 'users.name as nama_pembina')
            ->where('anggota.id_user', $user->id)
            ->get();

        return view('v_dataanggota', ['anggota' => $anggota]);
    }

    public function nilaiSiswa()
    {
        $id_user = auth()->user()->id;

        $anggota = DB::table('anggota')->where('id_user', $id_user)->first();

        if (!$anggota) {
            return view('siswa.v_nilaisaya', ['nilai' => null, 'kehadiran' => [], 'lomba' => []]);
        }

        $nilai = DB::table('nilai')
            ->join('anggota', 'nilai.id_anggota', '=', 'anggota.id')
            ->join('ekskul', 'nilai.id_ekskul', '=', 'ekskul.id_ekskul')
            ->where('nilai.id_anggota', $anggota->id)
            ->select(
                'nilai.*',
                'anggota.nama as nama_anggota',
                'anggota.kelas',
                'ekskul.nama_ekskul'
            )
            ->first();

        if ($nilai) {
            $totalKegiatan = DB::table('kegiatan')
                ->where('id_ekskul', $nilai->id_ekskul)
                ->count();

            $totalHadir = DB::table('kehadiran')
                ->where('id_anggota', $anggota->id)
                ->where('status', 'Hadir')
                ->count();

            $jumlahLomba = DB::table('lomba')
                ->where('id_anggota', $anggota->id)
                ->count();

            $nilai->nilai_kehadiran = $totalKegiatan > 0 ? round(($totalHadir / $totalKegiatan) * 100) : 0;
            $nilai->nilai_lomba = min($jumlahLomba * 2.5, 5);

            $penguasaan = $nilai->nilai_penguasaan ?? 0;
            $praktek = $nilai->nilai_praktek ?? 0;

            $skor_total = round(($nilai->nilai_kehadiran * 0.4) + ($penguasaan * 0.3) + ($praktek * 0.3) + $nilai->nilai_lomba);

            $nilai->nilai_huruf = $this->konversiHuruf($skor_total);
            $nilai->keterangan = $this->konversiKeterangan($skor_total);
        }

        // ✅ Ambil detail kehadiran
        $kehadiran = DB::table('kehadiran')
            ->join('kegiatan', 'kehadiran.id_kegiatan', '=', 'kegiatan.id')
            ->where('kehadiran.id_anggota', $anggota->id)
            ->select('kehadiran.*', 'kegiatan.nama_kegiatan', 'kegiatan.tanggal')
            ->get();

        // ✅ Ambil riwayat lomba
        $lomba = DB::table('lomba')
            ->where('id_anggota', $anggota->id)
            ->get();

        return view('siswa.v_nilaisaya', compact('nilai', 'kehadiran', 'lomba'));
    }

    private function konversiKeterangan($nilai)
    {
        if ($nilai >= 90) return 'Sangat Aktif';
        if ($nilai >= 80) return 'Aktif Sekali';
        if ($nilai >= 70) return 'Aktif';
        if ($nilai >= 60) return 'Cukup Aktif';
        return 'Kurang Aktif';
    }

    private function konversiHuruf($nilai)
    {
        if ($nilai >= 90) return 'Sangat Baik';
        if ($nilai >= 80) return 'Baik Sekali';
        if ($nilai >= 70) return 'Baik';
        if ($nilai >= 60) return 'Cukup';
        return 'Kurang';
    }
}
