<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\m_lomba;
use App\Models\m_ekskul;
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

    public function add()
    {
        $user = Auth::user();

        // Ambil hanya ekskul yang dibina pembina yang login
        $ekskul = DB::table('ekskul')
            ->where('id_pembina', $user->id)
            ->first(); // hanya satu ekskul

        // Anggota hanya dari ekskul bimbingan
        $anggota = DB::table('anggota')
            ->where('id_ekskul', $ekskul->id_ekskul)
            ->get();

        return view('pembina.v_addlomba', compact('ekskul', 'anggota'));
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
        ]);

        $data = $request->only(['id_anggota', 'id_ekskul', 'nama_kegiatan', 'kejuaraan', 'tanggal', 'lokasi']);

        if ($request->hasFile('file_sertifikat') && $request->file('file_sertifikat')->isValid()) {
            $file = $request->file('file_sertifikat');
            $filename = time() . '_sertifikat_' . $file->getClientOriginalName();
            $file->storeAs('public/sertifikat', $filename);
            $data['file_sertifikat'] = $filename;
        }

        if ($request->hasFile('foto_kegiatan') && $request->file('foto_kegiatan')->isValid()) {
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
        $user = Auth::user();

        $lomba = $this->m_lomba->detailData($id_lomba);

        // Ambil ekskul yang dibina pembina login
        $ekskul = DB::table('ekskul')
            ->where('id_pembina', $user->id)
            ->first();

        $anggota = DB::table('anggota')
            ->where('id_ekskul', $ekskul->id_ekskul)
            ->get();

        return view('pembina.v_editlomba', compact('lomba', 'ekskul', 'anggota'));
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

        if ($request->hasFile('file_sertifikat') && $request->file('file_sertifikat')->isValid()) {
            $file = $request->file('file_sertifikat');
            $filename = time() . '_sertifikat_' . $file->getClientOriginalName();
            $file->storeAs('public/sertifikat', $filename);
            $data['file_sertifikat'] = $filename;
        }

        if ($request->hasFile('foto_kegiatan') && $request->file('foto_kegiatan')->isValid()) {
            $foto = $request->file('foto_kegiatan');
            $foto_name = time() . '_foto_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto_kegiatan', $foto_name);
            $data['foto_kegiatan'] = $foto_name;
        }

        $this->m_lomba->editData($id_lomba, $data);
        return redirect()->route('lomba')->with('pesan', 'Data lomba berhasil diupdate!');
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
            ->whereNotNull('foto_kegiatan')
            ->orderByDesc('tanggal')
            ->get();

        return view('v_index', ['dataLombaPopup' => $lomba]);
    }
}
