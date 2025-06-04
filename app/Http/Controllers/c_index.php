<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_ekskul;
use App\Models\m_anggota;
use Illuminate\Support\Facades\DB;

class c_index extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'admin') {
            $jumlahEkskul = m_ekskul::count();
            $jumlahAnggota = m_anggota::count();
        } elseif ($user->role == 'pembina') {
            $jumlahEkskul = m_ekskul::where('id_pembina', $user->id)->count();
            $jumlahAnggota = m_anggota::whereHas('ekskul', function($q) use($user) {
                $q->where('id_pembina', $user->id);
            })->count();
            $jumlahSiswa = 0; // misal gak bisa lihat siswa langsung
            $jumlahPembina = 1; // cuma dirinya sendiri
        } elseif ($user->role == 'siswa') {

            $jumlahEkskul = m_ekskul::whereHas('anggota', function($q) use ($user) {

                $q->where('nis', $user->username); // sesuaikan dengan kolom yang cocok

            })->count();

            $jumlahAnggota = 1; // dirinya sendiri

            $jumlahSiswa = 1; // dirinya sendiri

            $jumlahPembina = 0;

        } else {
            // default fallback
            $jumlahEkskul = 0;
            $jumlahAnggota = 0;
            $jumlahSiswa = 0;
            $jumlahPembina = 0;
        }

        return view('v_index', compact('jumlahEkskul', 'jumlahAnggota'));
    }
}
