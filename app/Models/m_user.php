<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // <-- ini harus diimport
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class m_user extends Authenticatable
{
    protected $table = 'users'; // Menggunakan tabel users untuk model ini

    public $timestamps = true; // Menonaktifkan timestamps (created_at, updated_at)
    
        // Daftar field yang boleh diisi mass assignment
    protected $fillable = [
        'name',       // wajib ada supaya error hilang
        'username',
        'role',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Mendapatkan semua data user
    public function allData()
    {
        return DB::table('users')->get();
    }

    // Menambahkan data user baru
    public function addData($data)
    {
        DB::table('users')->insert($data);
    }

    // Mengedit data user berdasarkan id
    public function editData($id, $data)
    {
        DB::table('users')->where('id', $id)->update($data);
    }

    // Menghapus data user berdasarkan id
    public function deleteData($id)
    {
        DB::table('users')->where('id', $id)->delete();
    }

    

    // Menghitung jumlah user
    public function countData()
    {
        return DB::table('users')->count();
    }
}
