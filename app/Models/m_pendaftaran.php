<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class m_pendaftaran extends Model
{
    protected $fillable = [
        'email', 'nama', 'nis', 'kelas', 'tgl_lahir',
        'jenis_kelamin', 'alamat', 'id_ekskul', 'status'
    ];

    protected $table = 'pendaftarans'; // Nama tabel yang sesuai
    public $timestamps = true; // Jika pakai created_at dan updated_at

    public function allData()
    {
        return DB::table($this->table)
            ->leftJoin('ekskul', 'pendaftarans.id_ekskul', '=', 'ekskul.id_ekskul')
            ->select('pendaftarans.*', 'ekskul.nama_ekskul as nama_ekskul')
            ->get();
    }

    // Tambah data pendaftaran
public function addData($data)
{
    DB::table('pendaftarans')->insert($data); // pastikan $data['id_ekskul'] ada
}


    // Detail data pendaftaran
    public function detailData($id)
    {
        return DB::table($this->table)->where('id', $id)->first();
    }

    // Edit data pendaftaran
    public function editData($id, $data)
    {
        DB::table($this->table)->where('id', $id)->update($data);
    }

    // Hapus data pendaftaran
    public function deleteData($id)
    {
        DB::table($this->table)->where('id', $id)->delete();
    }

    public function ekskul()
    {
        return $this->belongsTo(m_ekskul::class, 'id_ekskul', 'id_ekskul');
    }
}
