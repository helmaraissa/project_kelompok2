<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\m_kehadiran;
use App\Models\m_kegiatan;

class c_kehadiran extends Controller
{
    public function formSiswa($id_kegiatan)
    {
        $id_user = session('id'); // Ambil ID user siswa dari session
        $anggota = DB::table('anggota')->where('id_user', $id_user)->where('status_keanggotaan', 'aktif')->first();

        $kegiatan = DB::table('kegiatan')->where('id', $id_kegiatan)->first();

        if (!$anggota || !$kegiatan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        return view('siswa.v_formkehadiran', compact('kegiatan', 'anggota'));
    }

    public function simpanSiswa(Request $request)
    {
        $request->validate([
            'id_kegiatan' => 'required',
            'id_anggota' => 'required',
            'status' => 'required',
        ]);

        DB::table('kehadiran')->insert([
            'id_kegiatan' => $request->id_kegiatan,
            'id_anggota' => $request->id_anggota,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/')->with('success', 'Kehadiran berhasil dicatat.');
    }

    public function listVerifikasi()
    {
        $id_pembina = session('id_user');
        $ekskul = DB::table('ekskul')->where('id_pembina', $id_pembina)->pluck('id_ekskul');

        $kehadiran = DB::table('kehadiran')
            ->join('anggota', 'kehadiran.id_anggota', '=', 'anggota.id_anggota')
            ->join('siswa', 'anggota.id_siswa', '=', 'siswa.id_siswa')
            ->join('kegiatan', 'kehadiran.id_kegiatan', '=', 'kegiatan.id_kegiatan')
            ->whereIn('anggota.id_ekskul', $ekskul)
            ->where('kehadiran.diverifikasi', 0)
            ->select('kehadiran.*', 'siswa.nama', 'kegiatan.nama_kegiatan')
            ->get();

        return view('kehadiran.v_verifikasi_kehadiran', compact('kehadiran'));
    }

    public function verifikasi($id)
    {
        DB::table('kehadiran')
            ->where('id_kehadiran', $id)
            ->update(['diverifikasi' => 1, 'updated_at' => now()]);

        return redirect()->back()->with('success', 'Kehadiran berhasil diverifikasi.');
    }
}
