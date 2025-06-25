<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class m_nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';

    protected $fillable = [
        'id_anggota', 'id_ekskul', 'semester',
        'nilai_kehadiran', 'nilai_penguasaan', 'nilai_praktek',
        'nilai_akhir', 'nilai_huruf', 'keterangan',
        'nilai_kategori', 'catatan_penilaian',
    ];

    // ✅ Relasi ke anggota
    public function anggota()
    {
        return $this->belongsTo(\App\Models\m_anggota::class, 'id_anggota');
    }

    // ✅ Relasi ke ekskul (jika diperlukan)
    public function ekskul()
    {
        return $this->belongsTo(\App\Models\m_ekskul::class, 'id_ekskul');
    }

    // ✅ Ambil semua nilai dengan join relasi (manual)
    public static function getAllWithRelasi()
    {
        return DB::table('nilai')
            ->join('anggota', 'nilai.id_anggota', '=', 'anggota.id')
            ->join('ekskul', 'anggota.id_ekskul', '=', 'ekskul.id')
            ->join('users as pembina', 'ekskul.id_pembina', '=', 'pembina.id')
            ->select('nilai.*', 'anggota.nama as nama_siswa', 'anggota.nis', 'ekskul.nama_ekskul')
            ->where('ekskul.id_pembina', auth()->user()->id)
            ->get();
    }

    public static function getAnggotaPembina()
    {
        return DB::table('anggota')
            ->join('ekskul', 'anggota.id_ekskul', '=', 'ekskul.id')
            ->where('ekskul.id_pembina', auth()->user()->id)
            ->select('anggota.*')
            ->get();
    }

    public static function getNilaiLomba($id_anggota, $id_ekskul)
    {
        $lomba = DB::table('lomba')
            ->where('id_anggota', $id_anggota)
            ->where('id_ekskul', $id_ekskul)
            ->count();

        return $lomba > 0 ? 5 : 0;
    }
}
