<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\m_ekskul;


class m_anggota extends Model
{
    protected $table = 'anggota';
    public $timestamps = false; // Kalau pakai created_at & updated_at, bisa diubah jadi true
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama', 'nis', 'kelas', 'tgl_lahir', 'jenis_kelamin', 'alamat', 'id_ekskul', 'status_keanggotaan', 'tanggal_gabung'
    ];

    // Relasi ke tabel ekskul (id_ekskul)
    public function ekskul()
    {
        return $this->belongsTo(m_ekskul::class, 'id_ekskul', 'id_ekskul');
    }

    // Relasi ke pembina lewat tabel ekskul (pastikan di Ekskul ada relasi ini)
    public function pembina()
    {
        return $this->belongsTo(User::class, 'id_pembina');
    }

    // Mendapatkan semua data anggota dengan join ke tabel ekskul dan pembina
    public function allData()
    {
        return DB::table('anggota')
            ->leftJoin('ekskul', 'anggota.id_ekskul', '=', 'ekskul.id_ekskul')
            ->leftJoin('users', 'ekskul.id_pembina', '=', 'users.id')
            ->select('anggota.*', 'ekskul.nama_ekskul', 'users.name as nama_pembina')
            ->get();
    }

    // Menambahkan data anggota
    public function addData($data)
    {
        // Tambahkan created_at dan updated_at jika tabel memakai timestamp
        $data['created_at'] = now();
        $data['updated_at'] = now();

        return DB::table('anggota')->insert($data);
    }

    public function editData($id_anggota, $data)
    {
        $data['updated_at'] = now();
        return DB::table('anggota')->where('id', $id_anggota)->update($data);
    }

    public function deleteData($id_anggota)
    {
        return DB::table('anggota')->where('id', $id_anggota)->delete();
    }

    public function kehadiran()
    {
    return $this->hasMany(m_kehadiran::class, 'anggota_id');
    }
}
