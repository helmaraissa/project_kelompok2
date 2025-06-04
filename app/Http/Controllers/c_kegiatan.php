<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\m_kegiatan;
use App\Models\m_ekskul;

class c_kegiatan extends Controller
{
    public function __construct()
    {
        $this->m_kegiatan = new m_kegiatan();
    }

    public function index()
    {
        $user = Auth::user();
        $id_pembina = $user->id;

        $kegiatan = DB::table('kegiatan')
            ->join('ekskul', 'kegiatan.id_ekskul', '=', 'ekskul.id_ekskul')
            ->where('ekskul.id_pembina', $id_pembina)
            ->select(
                'kegiatan.id',
                'kegiatan.nama_kegiatan',
                'kegiatan.jenis_kegiatan',
                'kegiatan.keterangan',
                'kegiatan.tanggal',
                'kegiatan.waktu_mulai',
                'kegiatan.waktu_selesai',
                'kegiatan.lokasi',
                'ekskul.nama_ekskul'
            )
            ->get();

        return view('pembina.v_kegiatan', ['kegiatan' => $kegiatan]);
    }

    public function edit($id)
    {
        $kegiatan = m_kegiatan::find($id); // ambil 1 record kegiatan
        $ekskul = m_ekskul::all();

        if (!$kegiatan) {
            return redirect()->route('kegiatan')->with('error', 'Data kegiatan tidak ditemukan');
        }

        return view('pembina.v_editkegiatan', compact('kegiatan', 'ekskul'));
    }

    public function add()
    {
        $data = [
            'ekskul' => m_ekskul::all()
        ];
        return view('pembina.v_addkegiatan', $data);
    }

    public function insert()
    {
        Request()->validate([
            'id_ekskul' => 'required',
            'nama_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
            'tanggal' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'lokasi' => 'required',
        ]);

        $data = [
            'id_ekskul' => Request()->id_ekskul,
            'nama_kegiatan' => Request()->nama_kegiatan,
            'jenis_kegiatan' => Request()->jenis_kegiatan,
            'keterangan' => Request()->keterangan,
            'tanggal' => Request()->tanggal,
            'waktu_mulai' => Request()->waktu_mulai,
            'waktu_selesai' => Request()->waktu_selesai,
            'lokasi' => Request()->lokasi,
        ];

        $this->m_kegiatan->addData($data);
        return redirect()->route('kegiatan')->with('pesan', 'Data berhasil ditambahkan!');
    }

    public function delete($id)
    {
        $this->m_kegiatan->deleteData($id);
        return redirect()->route('kegiatan')->with('pesan', 'Data berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_ekskul' => 'required',
            'nama_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
            'tanggal' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'lokasi' => 'required',
        ]);

        $data = $request->only([
            'id_ekskul',
            'nama_kegiatan',
            'jenis_kegiatan',
            'keterangan',
            'tanggal',
            'waktu_mulai',
            'waktu_selesai',
            'lokasi',
        ]);

        m_kegiatan::where('id', $id)->update($data);
        return redirect()->route('kegiatan')->with('pesan', 'Data berhasil diupdate!');
    }

    public function getKegiatan()
    {
        $data = m_kegiatan::with('ekskul')->get();

        $events = $data->map(function ($item) {
            return [
                'title' => $item->nama_kegiatan . ' - ' . ($item->ekskul->nama_ekskul ?? '-'),
                'start' => $item->tanggal . 'T' . $item->waktu_mulai,
                'end'   => $item->tanggal . 'T' . $item->waktu_selesai,
                'lokasi' => $item->lokasi,
                'jenis_kegiatan' => $item->jenis_kegiatan,
                'keterangan' => $item->keterangan,
                'nama_ekskul' => $item->ekskul->nama_ekskul ?? '-'
            ];
        });

        return response()->json($events);
    }

    public function kalenderSiswa()
    {
        return view('siswa.v_kalender_kegiatan');
    }
}
