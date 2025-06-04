<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class m_ekskul extends Model
{
    protected $table = 'ekskul';

    public $timestamps = false;

    protected $primaryKey = 'id_ekskul'; // Sesuai field yang kamu pakai di form

    protected $fillable = [
        'nama_ekskul',
        'id_pembina',
        'deskripsi',
    ];    

    public function pembina()
    {
        return $this->belongsTo(User::class, 'id_pembina');
    }    
    
    public function allData()
    {
        return DB::table('ekskul')
            ->leftJoin('users', 'ekskul.id_pembina', '=', 'users.id')
            ->select('ekskul.*', 'users.name as nama_pembina')
            ->get();
    }

    public function detailData($id_ekskul)
    {
        return DB::table('ekskul')
            ->leftJoin('users', 'ekskul.id_pembina', '=', 'users.id')
            ->select('ekskul.*', 'users.name as nama_pembina')
            ->where('ekskul.id_ekskul', $id_ekskul)
            ->first();
    }

    public function addData($data)
    {
        DB::table('ekskul')->insert($data);
    }

    public function editData($id_ekskul, $data)
    {
        return DB::table('ekskul')->where('id_ekskul', $id_ekskul)->update($data);
    }      
    
    public function deleteData($id_ekskul)
    {
    DB::table('ekskul')->where('id_ekskul', $id_ekskul)->delete();
    }

    public function countData()
    {
    return DB::table('ekskul')->count();
    }

    public function anggota()
    {
        return $this->hasMany(m_anggota::class, 'id_ekskul', 'id_ekskul');
    }

}
