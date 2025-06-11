<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class m_kehadiran extends Model
{
    protected $table = 'kehadiran';
    protected $primaryKey = 'id_kehadiran';
    public $timestamps = true;

    protected $fillable = [
        'id_kegiatan',
        'id_anggota',
        'status',
        'keterangan',
        'diverifikasi'
    ];

    public function anggota()
    {
        return $this->belongsTo(m_anggota::class, 'id_anggota');
    }

    public function kegiatan()
    {
        return $this->belongsTo(m_kegiatan::class, 'id_kegiatan');
    }
}
