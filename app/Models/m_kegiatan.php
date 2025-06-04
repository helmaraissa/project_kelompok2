<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class m_kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_ekskul',
        'nama_kegiatan',
        'jenis_kegiatan',
        'keterangan',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
    ];

    public function allData()
    {
        return DB::table('kegiatan')
            ->join('ekskul', 'kegiatan.id_ekskul', '=', 'ekskul.id_ekskul')
            ->select('kegiatan.*', 'ekskul.nama_ekskul')
            ->orderBy('tanggal', 'desc')
            ->get();
    }

    public function addData($data)
    {
        DB::table('kegiatan')->insert($data);
    }

    public function deleteData($id)
    {
        DB::table('kegiatan')->where('id', $id)->delete();
    }

    public function ekskul()
    {
        return $this->belongsTo(m_ekskul::class, 'id_ekskul'); // sesuaikan nama foreign key
    }

    public function kehadiran()
    {
        return $this->hasMany(m_kehadiran::class, 'kegiatan_id');
    }
}
