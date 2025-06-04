<?php

namespace App\Http\Controllers;

use App\Models\m_lomba;
use App\Models\m_ekskul;
use App\Models\m_anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_lomba extends Controller
{
    protected $m_lomba;

    public function __construct()
    {
        $this->m_lomba = new m_lomba();
    }

    public function index()
    {
        $data = [
            'lomba' => DB::table('lomba')
                ->leftJoin('ekskul', 'lomba.id_ekskul', '=', 'ekskul.id_ekskul')
                ->leftJoin('anggota', 'lomba.id_anggota', '=', 'anggota.id')
                ->select('lomba.*', 'ekskul.nama_ekskul', 'anggota.nama as nama_siswa')
                ->get(),
        ];

        return view('pembina.v_datalomba', $data);
    }

    public function detail($id_lomba)
    {
        $lomba = $this->m_lomba->detailData($id_lomba);

        return view('pembina.v_detaillomba', compact('lomba'));
    }

    public function add()
    {
        $data = [
            'ekskul' => m_ekskul::all(),
            'anggota' => DB::table('anggota')->get(),
        ];

        return view('pembina.v_addlomba', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'id_anggota' => 'required',
            'id_ekskul' => 'required',
            'nama_kegiatan' => 'required',
            'kejuaraan' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required',
            'file_sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'foto_kegiatan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'id_anggota.required' => 'Anggota wajib dipilih!',
            'id_ekskul.required' => 'Ekstrakurikuler wajib dipilih!',
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi!',
            'kejuaraan.required' => 'Kejuaraan wajib diisi!',
            'tanggal.required' => 'Tanggal wajib diisi!',
            'lokasi.required' => 'Lokasi wajib diisi!',
            'file_sertifikat.mimes' => 'Format file sertifikat harus pdf, jpg, jpeg, atau png!',
            'file_sertifikat.max' => 'Ukuran file sertifikat maksimal 2MB!',
            'foto_kegiatan.image' => 'Foto kegiatan harus berupa gambar!',
            'foto_kegiatan.mimes' => 'Format foto kegiatan harus jpg, jpeg, atau png!',
            'foto_kegiatan.max' => 'Ukuran foto kegiatan maksimal 2MB!',
        ]);

        $data = $request->only(['id_anggota', 'id_ekskul', 'nama_kegiatan', 'kejuaraan', 'tanggal', 'lokasi']);

        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $filename = time() . '_sertifikat_' . $file->getClientOriginalName();
            $file->storeAs('public/sertifikat', $filename);
            $data['file_sertifikat'] = $filename;
        }

        if ($request->hasFile('foto_kegiatan')) {
            $foto = $request->file('foto_kegiatan');
            $foto_name = time() . '_foto_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto_kegiatan', $foto_name);
            $data['foto_kegiatan'] = $foto_name;
        }

        $this->m_lomba->addData($data);

        return redirect()->route('lomba')->with('pesan', 'Data lomba berhasil ditambahkan!');
    }

    public function edit($id_lomba)
    {
        $data = [
            'lomba' => $this->m_lomba->detailData($id_lomba),
            'ekskul' => m_ekskul::all(),
            'anggota' => DB::table('anggota')->get(),
        ];

        return view('pembina.v_editlomba', $data);
    }

    public function update(Request $request, $id_lomba)
    {
        $request->validate([
            'id_anggota' => 'required',
            'id_ekskul' => 'required',
            'nama_kegiatan' => 'required',
            'kejuaraan' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required',
            'file_sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'foto_kegiatan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['id_anggota', 'id_ekskul', 'nama_kegiatan', 'kejuaraan', 'tanggal', 'lokasi']);

        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $filename = time() . '_sertifikat_' . $file->getClientOriginalName();
            $file->storeAs('public/sertifikat', $filename);
            $data['file_sertifikat'] = $filename;
        }

        if ($request->hasFile('foto_kegiatan')) {
            $foto = $request->file('foto_kegiatan');
            $foto_name = time() . '_foto_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto_kegiatan', $foto_name);
            $data['foto_kegiatan'] = $foto_name;
        }

        $result = $this->m_lomba->editData($id_lomba, $data);

        if ($result) {
            return redirect()->route('lomba')->with('pesan', 'Data lomba berhasil diupdate!');
        } else {
            return redirect()->route('lomba')->with('error', 'Data gagal diupdate.');
        }
    }

    public function delete($id_lomba)
    {
        $this->m_lomba->deleteData($id_lomba);
        return redirect()->route('lomba')->with('pesan', 'Data lomba berhasil dihapus!');
    }

    public function gallery()
    {
        $lomba = DB::table('lomba')
            ->leftJoin('ekskul', 'lomba.id_ekskul', '=', 'ekskul.id_ekskul')
            ->leftJoin('anggota', 'lomba.id_anggota', '=', 'anggota.id')
            ->select('lomba.*', 'ekskul.nama_ekskul', 'anggota.nama as nama_siswa')
            ->whereNotNull('foto_kegiatan') // hanya lomba yang punya foto
            ->latest('tanggal')
            ->take(6) // tampilkan 6 foto terbaru
            ->get();

        return view('v_home', compact('lomba'));
    }
}
