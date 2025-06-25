<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\m_kehadiran;
use App\Models\m_kegiatan;
use App\Models\m_anggota;

class c_kehadiran extends Controller
{
    // Form absensi untuk siswa berdasarkan kegiatan
    public function formSiswa($id_kegiatan)
    {
        $kegiatan = m_kegiatan::with('ekskul')->findOrFail($id_kegiatan);

        // Cek apakah kegiatan sudah lewat tanggal
        if (now()->toDateString() > $kegiatan->tanggal) {
            return redirect('/kalender-kegiatan')->with('error', 'Kegiatan ini sudah lewat. Tidak bisa melakukan absensi.');
        }

        // Cek apakah user adalah anggota ekskul yang sesuai
        $anggota = m_anggota::where('id_user', auth()->user()->id)
                            ->where('id_ekskul', $kegiatan->id_ekskul)
                            ->firstOrFail();

        // Cek apakah sudah absen sebelumnya
        $cek = m_kehadiran::where('id_kegiatan', $id_kegiatan)
                        ->where('id_anggota', $anggota->id)
                        ->first();

        if ($cek) {
            return redirect('/kalender-kegiatan')->with('error', 'Kamu sudah melakukan absensi untuk kegiatan ini.');
        }

        return view('v_formkehadiran', compact('kegiatan', 'anggota'));
    }

    // Simpan absensi siswa ke database
    public function simpanSiswa(Request $request)
    {
        $request->validate([
            'id_kegiatan' => 'required|exists:kegiatan,id',
            'id_anggota' => 'required|exists:anggota,id',
            'status' => 'required|in:hadir,izin,sakit,alfa',
            'keterangan' => 'nullable|string',
        ]);

        // Cek apakah sudah absen
        $cek = m_kehadiran::where('id_kegiatan', $request->id_kegiatan)
                          ->where('id_anggota', $request->id_anggota)
                          ->first();

        if ($cek) {
            return back()->with('error', 'Kamu sudah melakukan absensi untuk kegiatan ini.');
        }

        // Simpan data absensi
        m_kehadiran::create([
            'id_kegiatan' => $request->id_kegiatan,
            'id_anggota' => $request->id_anggota,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/kalender-kegiatan')->with('success', 'Absensi berhasil dikirim.');
    }

    // Tampilkan daftar absensi yang perlu diverifikasi dan yang sudah diverifikasi
    public function listVerifikasi()
    {
        $id_pembina = auth()->user()->id;

        $ekskul = DB::table('ekskul')
            ->where('id_pembina', $id_pembina)
            ->pluck('id_ekskul');

        // Absensi yang belum diverifikasi
        $belum = DB::table('kehadiran')
            ->join('anggota', 'kehadiran.id_anggota', '=', 'anggota.id')
            ->join('users', 'anggota.id_user', '=', 'users.id')
            ->join('kegiatan', 'kehadiran.id_kegiatan', '=', 'kegiatan.id')
            ->whereIn('anggota.id_ekskul', $ekskul)
            ->where('kehadiran.diverifikasi', 0)
            ->select('kehadiran.*', 'users.name as nama', 'kegiatan.nama_kegiatan')
            ->get();

        // Absensi yang sudah diverifikasi
        $sudah = DB::table('kehadiran')
            ->join('anggota', 'kehadiran.id_anggota', '=', 'anggota.id')
            ->join('users', 'anggota.id_user', '=', 'users.id')
            ->join('kegiatan', 'kehadiran.id_kegiatan', '=', 'kegiatan.id')
            ->whereIn('anggota.id_ekskul', $ekskul)
            ->where('kehadiran.diverifikasi', 1)
            ->select('kehadiran.*', 'users.name as nama', 'kegiatan.nama_kegiatan')
            ->get();

        return view('v_verifikasi_kehadiran', compact('belum', 'sudah'));
    }

    // Verifikasi satu absensi berdasarkan ID
    public function verifikasi($id)
    {
        DB::table('kehadiran')
            ->where('id_kehadiran', $id)
            ->update(['diverifikasi' => 1, 'updated_at' => now()]);

        return redirect()->back()->with('success', 'Kehadiran berhasil diverifikasi.');
    }

    // Rekap kehadiran untuk siswa (yang login)
    public function rekapSiswa()
    {
        $id_user = auth()->user()->id;
        $anggota = m_anggota::where('id_user', $id_user)->first();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan.');
        }

        // Hitung total kehadiran berdasarkan status
        $rekap = m_kehadiran::where('id_anggota', $anggota->id)
            ->where('diverifikasi', 1)
            ->selectRaw('
                SUM(CASE WHEN status = "hadir" THEN 1 ELSE 0 END) as total_hadir,
                SUM(CASE WHEN status = "izin" THEN 1 ELSE 0 END) as total_izin,
                SUM(CASE WHEN status = "sakit" THEN 1 ELSE 0 END) as total_sakit,
                SUM(CASE WHEN status = "alfa" THEN 1 ELSE 0 END) as total_alfa
            ')
            ->first();

        // Ambil list absensi per kegiatan
        $kehadiran_list = m_kehadiran::with('kegiatan')
            ->where('id_anggota', $anggota->id)
            ->where('diverifikasi', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.v_rekapkehadiran', compact('rekap', 'anggota', 'kehadiran_list'));
    }

    // Verifikasi massal kehadiran berdasarkan input array ID
    public function massVerifikasi(Request $request)
    {
        $ids = $request->input('ids', []);

        if (count($ids) == 0) {
            return redirect()->back()->with('error', 'Pilih data kehadiran terlebih dahulu.');
        }

        DB::table('kehadiran')
            ->whereIn('id_kehadiran', $ids)
            ->update([
                'diverifikasi' => 1,
                'updated_at' => now()
            ]);

        return redirect()->back()->with('success', 'Berhasil memverifikasi kehadiran terpilih.');
    }
}
