<?php

namespace App\Http\Controllers;

use App\Models\m_kehadiran;
use App\Models\m_anggota;
use App\Models\m_kegiatan;
use Illuminate\Http\Request;

class c_kehadiran extends Controller
{
    public function index()
    {
        $data = m_kehadiran::with(['kegiatan', 'anggota'])->get();
        return view('v_kehadiran', compact('data'));
    }

    public function create()
    {
        $kegiatan = \App\Models\m_kegiatan::all();
        $anggota = \App\Models\m_anggota::all();
        return view('v_kehadiran.create', compact('kegiatan', 'anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kegiatan' => 'required|exists:kegiatan,id',
            'id_anggota' => 'required|exists:anggota,id',
            'status' => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string',
            'diverifikasi' => 'boolean',
        ]);

        m_kehadiran::create($request->all());

        return redirect()->route('v_kehadiran.store')->with('success', 'Absensi berhasil disimpan');
    }
}
