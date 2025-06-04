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

        // Langkah 1: Sinkronisasi hanya untuk ekskul yang dibina
        $pendaftarans = DB::table('pendaftarans')
            ->join('ekskul', 'pendaftarans.id_ekskul', '=', 'ekskul.id_ekskul')
            ->where('pendaftarans.status', 'diterima')
            ->where('ekskul.id_pembina', $id_pembina)
            ->select('pendaftarans.*')
            ->get();

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
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Ambil data anggota yang aktif dan dibina oleh user
        $anggota = DB::table('anggota')
            ->join('ekskul', 'anggota.id_ekskul', '=', 'ekskul.id_ekskul')
            ->leftJoin('users', 'ekskul.id_pembina', '=', 'users.id')
            ->select('anggota.*', 'ekskul.nama_ekskul', 'users.name as nama_pembina')
            ->where('ekskul.id_pembina', $id_pembina)
            ->where('anggota.status_keanggotaan', 'aktif')
            ->get();

        return view('pembina.v_dataanggota', ['anggota' => $anggota]);
    }

    public function dataAnggotaSiswa()
    {
        $user = Auth::user();

        $anggota = DB::table('anggota')
            ->join('ekskul', 'anggota.id_ekskul', '=', 'ekskul.id_ekskul')
            ->select('anggota.*', 'ekskul.nama_ekskul')
            ->where('anggota.nis', $user->username)
            ->where('anggota.status_keanggotaan', 'aktif')
            ->get();

        return view('anggota.v_dataanggota', compact('anggota'));
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
}
