<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_ekskul;
use App\Models\m_anggota;
use App\Models\User;
use App\Models\m_kegiatan;
use App\Models\m_kehadiran;
use App\Models\m_lomba;
use App\Models\m_nilai;
use App\Models\m_pendaftaran;

class c_index extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $role = $user->role;

        if ($role === 'admin') {
            $data = [
                'jumlahEkskul'    => m_ekskul::count(),
                'jumlahKegiatan'  => m_kegiatan::count(),
                'jumlahAnggota'   => m_anggota::count(),
                'jumlahUser'      => User::count(),
                'jumlahSiswa'     => User::where('role', 'siswa')->count(),
                'jumlahPembina'   => User::where('role', 'pembina')->count(),
            ];
        } elseif ($role === 'pembina') {
            $data = [
                'jumlahEkskul'    => m_ekskul::where('id_pembina', $user->id)->count(),
                'jumlahKegiatan'  => m_kegiatan::whereHas('ekskul', function($query) use ($user) {
                    $query->where('id_pembina', $user->id);
                })->count(),
                'jumlahAnggota'   => m_anggota::whereHas('ekskul', function($query) use ($user) {
                    $query->where('id_pembina', $user->id);
                })->count(),
                'jumlahUser'      => User::count(),
                'jumlahSiswa'     => User::where('role', 'siswa')->count(),
                'jumlahPembina'   => User::where('role', 'pembina')->count(),
            ];
        } elseif ($role === 'siswa') {
            $data = [
                'jumlahAnggota' => m_anggota::where('id_user', $user->id)->count(),
            ];
        } else {
            return redirect()->route('home')->with('error', 'Role tidak dikenali.');
        }

        // Ambil data lomba terbaru (acak, limit 4)
        $data['dataLombaPopup'] = \DB::table('lomba')
            ->join('anggota', 'lomba.id_anggota', '=', 'anggota.id')
            ->join('users', 'anggota.id_user', '=', 'users.id')
            ->join('ekskul', 'lomba.id_ekskul', '=', 'ekskul.id_ekskul')
            ->select(
                'lomba.id_lomba',
                'lomba.nama_kegiatan',
                'lomba.kejuaraan',
                'lomba.tanggal',
                'lomba.lokasi',
                'lomba.foto_kegiatan',
                'lomba.file_sertifikat',
                'users.name as nama_siswa',
                'ekskul.nama_ekskul'
            )
            ->orderByDesc('lomba.tanggal')
            ->limit(4)
            ->get();

        return view('v_index', $data);
    }
}
