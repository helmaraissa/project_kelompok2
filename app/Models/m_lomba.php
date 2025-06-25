<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class m_lomba extends Model
{
    use HasFactory;

    protected $table = 'lomba';

    public $timestamps = false;

    protected $primaryKey = 'id_lomba';

    protected $fillable = [
        'id_anggota',
        'id_ekskul',
        'nama_kegiatan',
        'kejuaraan',
        'tanggal',
        'lokasi',
        'file_sertifikat',
        'foto_kegiatan', 
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class, 'id_ekskul');
    }

    public function allData()
    {
        return DB::table('lomba')
            ->leftJoin('anggota', 'lomba.id_anggota', '=', 'anggota.id_anggota')
            ->leftJoin('ekskul', 'lomba.id_ekskul', '=', 'ekskul.id_ekskul')
            ->select('lomba.*', 'anggota.nama_siswa', 'anggota.nis', 'ekskul.nama_ekskul')
            ->get();
    }

    public function detailData($id_lomba)
    {
        return DB::table('lomba')
            ->leftJoin('anggota', 'lomba.id_anggota', '=', 'anggota.id') // ← sesuaikan juga jika PK-nya 'id'
            ->leftJoin('ekskul', 'lomba.id_ekskul', '=', 'ekskul.id_ekskul')
            ->select('lomba.*', 'anggota.nama', 'anggota.nis', 'ekskul.nama_ekskul') // ← Ganti 'nama_siswa' jadi 'nama'
            ->where('lomba.id_lomba', $id_lomba)
            ->first();
    }

    public function addData($data)
    {
        DB::table('lomba')->insert($data);
    }

    public function editData($id_lomba, $data)
    {
        return DB::table('lomba')->where('id_lomba', $id_lomba)->update($data);
    }

    public function deleteData($id_lomba)
    {
        DB::table('lomba')->where('id_lomba', $id_lomba)->delete();
    }
}
