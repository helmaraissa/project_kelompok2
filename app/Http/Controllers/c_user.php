<?php

namespace App\Http\Controllers;

use App\Models\m_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class c_user extends Controller
{
    public function __construct()
    {
        $this->m_user = new m_user(); // Inisialisasi model m_user
    }

    // Menampilkan semua data user
    public function index()
    {
        $data = [
            'users' => $this->m_user->allData(), // Mendapatkan semua data user
        ];
        return view('admin/v_datauser', $data); // Mengirim data ke view
    }

    // Menampilkan form tambah user
    public function add()
    {
        return view('admin/v_adduser'); // Mengarahkan ke halaman form tambah user
    }

    // Menyimpan data user baru
    public function insert(Request $request) // <- TAMBAHKAN parameter $request
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,pembina,siswa',
        ]);

        // Simpan data
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        \DB::table('users')->insert($data); // atau $this->m_user->insert($data);

        return redirect()->route('user')->with('success', 'Data pengguna berhasil ditambahkan!');
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,pembina,siswa',
        ]);
    
        $user = m_user::find($id); // Pastikan menggunakan model yang benar
    
        if ($user) {
            $user->role = $request->input('role');
            $user->save();
    
            return redirect()->route('user')->with('pesan', 'Role user berhasil diperbarui!');
        }
    
        return redirect()->route('user')->withErrors('User tidak ditemukan!');
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
    
        if (!$user) {
            return redirect()->route('user')->withErrors('User tidak ditemukan!');
        }
    
        return view('admin/v_edituser', ['user' => $user]);
    }

    // Memperbarui data user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'role' => 'required|in:admin,pembina,siswa',
        ]);
    
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
        ];
    
        // Gunakan fungsi editData dari m_user
        $this->m_user->editData($id, $data);
    
        return redirect()->route('user')->with('pesan', 'Data user berhasil diperbarui!');
    }
    

    public function delete($id)
    {
        $this->m_user->deleteData($id); // Hapus langsung
        return redirect()->route('user')->with('pesan', 'Data berhasil dihapus!');
    }
    
}
