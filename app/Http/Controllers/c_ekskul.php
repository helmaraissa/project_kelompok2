<?php

namespace App\Http\Controllers;

use App\Models\m_ekskul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_ekskul extends Controller
{
    public function __construct()
    {
        $this->m_ekskul = new m_ekskul();
    }

    public function index()
    {
        $data = [
            'ekskul' => \DB::table('ekskul')
                ->leftJoin('users', 'ekskul.id_pembina', '=', 'users.id')
                ->select('ekskul.*', 'users.name as nama_pembina')
                ->get(),
        ];
        return view('admin/v_dataekskul', $data);
    }    

    public function detail($id_ekskul)
    {
        $ekskul = \App\Models\m_ekskul::with('pembina')->find($id_ekskul);
    
        return view('admin.v_detailekskul', compact('ekskul'));
    }
    
    public function add()
    {
        $data = [
            'pembina' => DB::table('users')->where('role', 'pembina')->get()
        ];
        return view('admin/v_addekskul', $data);
    }

    public function insert()
    {
        Request()->validate([
            'nama_ekskul' => 'required',
            'id_pembina' => 'required',
            'deskripsi' => 'required',
        ],[
            'nama_ekskul.required' => 'Nama ekstrakurikuler wajib di isi !',
            'id_pembina.required' => 'Pembina wajib dipilih !',
            'deskripsi.required' => 'Deskripsi wajib di isi !',
        ]);
    
        $data = [
            'nama_ekskul' => Request()->nama_ekskul,
            'id_pembina' => Request()->id_pembina,
            'deskripsi' => Request()->deskripsi,
        ];
        $this->m_ekskul->addData($data);
        return redirect()->route('ekskul')->with('pesan', 'Data berhasil ditambahkan !');
    }

    public function edit($id_ekskul)
    {
        $data = [
            'ekskul' => $this->m_ekskul->detailData($id_ekskul),
            'pembina' => DB::table('users')->where('role', 'pembina')->get(),
        ];
    
        return view('admin/v_editekskul', $data);
    }
      

    public function update($id_ekskul)
    {
        Request()->validate([
            'nama_ekskul' => 'required',
            'id_pembina' => 'required',
            'deskripsi' => 'required',
        ], [
            'nama_ekskul.required' => 'Nama ekstrakurikuler wajib di isi !',
            'id_pembina.required' => 'Pembina wajib dipilih !',
            'deskripsi.required' => 'Deskripsi wajib di isi !',
        ]);
    
        $data = [
            'nama_ekskul' => Request()->nama_ekskul,
            'id_pembina' => Request()->id_pembina,
            'deskripsi' => Request()->deskripsi,
        ];
    
        $result = $this->m_ekskul->editData($id_ekskul, $data);
        
        if ($result) {
            return redirect()->route('ekskul')->with('pesan', 'Data berhasil diupdate !');
        } else {
            return redirect()->route('ekskul')->with('error', 'Data gagal diupdate.');
        }
    }    

    public function delete($id_ekskul)
    {

        $ekskul = $this->m_ekskul->detailData($id_ekskul);
        $this->m_ekskul->deleteData($id_ekskul);
        return redirect()->route('ekskul')->with('pesan', 'Data berhasil dihapus !');
    }
}
