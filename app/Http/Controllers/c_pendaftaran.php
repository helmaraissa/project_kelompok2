<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PendaftaranBerhasil;
use App\Mail\AkunDiterimaMail;
use App\Models\m_pendaftaran;
use App\Models\m_ekskul;
use App\Models\m_user;

class c_pendaftaran extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:pendaftarans,email',
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:50|unique:pendaftarans,nis',
            'kelas' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'id_ekskul' => 'required|exists:ekskul,id_ekskul'
        ]);

        $data = [
            'email' => $request->email,
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'id_ekskul' => $request->id_ekskul,
            'status' => 'menunggu'
        ];

        // Simpan ke DB
        $this->m_pendaftaran->addData($data);

        // Kirim email notifikasi ke user
        Mail::to($request->email)->send(new PendaftaranBerhasil($request->nama));

        return redirect()->back()->with('success', 'Pendaftaran berhasil! Silakan cek email.');
    }

    public function create()
    {
        // Ambil data ekskul dari model / DB
        $ekskul = \DB::table('ekskul')->get();

        // Kirim ke view pendaftaran
        return view('v_pendaftaran', compact('ekskul'));
    }
    protected $m_pendaftaran;

    // Menginisialisasi model agar bisa digunakan berkali-kali dalam controller
    public function __construct()
    {
        $this->m_pendaftaran = new m_pendaftaran();
    }

    public function index()
    {
        $user = Auth::user();
        $id_pembina = $user->id;

        // Ambil hanya pendaftaran ke ekskul yang dibina user
        $pendaftarans = DB::table('pendaftarans')
            ->join('ekskul', 'pendaftarans.id_ekskul', '=', 'ekskul.id_ekskul')
            ->where('ekskul.id_pembina', $id_pembina)
            ->select('pendaftarans.*', 'ekskul.nama_ekskul') 
            ->get();

        return view('pembina/v_datapendaftaran', ['pendaftarans' => $pendaftarans]);
    }

    // Tampilkan form tambah
    public function add()
    {
        return view('pembina/v_addpendaftaran');
    }

    // Simpan data baru
    public function insert(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:50|unique:pendaftarans,nis',
            'kelas' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'id_ekskul' => 'required|exists:ekskul,id_ekskul', // ✅
        ]);

        $data = [
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'id_ekskul' => $request->id_ekskul, // ✅
            'status' => 'menunggu',
        ];

        $this->m_pendaftaran->addData($data);
        return redirect()->route('pendaftaran')->with('pesan', 'Data pendaftaran berhasil ditambahkan!');
    }

    // Edit & Update
    public function edit($id)
    {
        $data = ['pendaftaran' => $this->m_pendaftaran->detailData($id)];
        return view('pembina/v_editpendaftaran', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak',
        ]);

        // Update status pendaftaran
        $this->m_pendaftaran->editData($id, ['status' => $request->status]);

        if ($request->status === 'diterima') {
            $pendaftar = $this->m_pendaftaran->detailData($id);

            if (!$pendaftar) {
                return redirect()->route('pendaftaran')->with('error', 'Data pendaftar tidak ditemukan.');
            }

            // Cari user berdasarkan email
            $user = \App\Models\m_user::where('username', $pendaftar->email)->first();

            // Jika belum ada user, buat akun
            if (!$user) {
                $password_plain = $pendaftar->tgl_lahir; // contoh password: tanggal lahir
                $password_hashed = Hash::make($password_plain);

                $user = \App\Models\m_user::create([
                    'name' => $pendaftar->nama,
                    'username' => $pendaftar->email,
                    'role' => 'siswa',
                    'password' => $password_hashed,
                ]);

                // Kirim email akun baru
                try {
                    Mail::to($pendaftar->email)->send(new AkunDiterimaMail(
                        $pendaftar->nama,
                        $pendaftar->email,
                        $password_plain
                    ));
                } catch (\Exception $e) {
                    \Log::error('Gagal kirim email akun diterima: ' . $e->getMessage());
                }
            }

            // Cek apakah sudah ada di anggota
            $sudahAnggota = DB::table('anggota')
                ->where('nis', $pendaftar->nis)
                ->where('id_ekskul', $pendaftar->id_ekskul)
                ->exists();

            // Insert ke tabel anggota jika belum ada
            if (!$sudahAnggota) {
                DB::table('anggota')->insert([
                    'nama' => $pendaftar->nama,
                    'nis' => $pendaftar->nis,
                    'kelas' => $pendaftar->kelas,
                    'tgl_lahir' => $pendaftar->tgl_lahir,
                    'jenis_kelamin' => $pendaftar->jenis_kelamin,
                    'alamat' => $pendaftar->alamat,
                    'id_ekskul' => $pendaftar->id_ekskul,
                    'status_keanggotaan' => 'aktif',
                    'tanggal_gabung' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_user' => $user->id,
                ]);
            }
        }

        return redirect()->route('pendaftaran')->with('pesan', 'Status pendaftaran berhasil diperbarui!');
    }

    public function massUpdate(Request $request)
    {
        $ids = $request->input('ids');
        $status = $request->input('status_action');

        if (!$ids || !$status) {
            return redirect()->back()->with('pesan', 'Tidak ada data yang dipilih atau status kosong.');
        }

        foreach ($ids as $id) {
            // Update status
            $this->m_pendaftaran->editData($id, ['status' => $status]);

            if ($status === 'diterima') {
                $pendaftar = $this->m_pendaftaran->detailData($id);
                if (!$pendaftar) continue;

                // Buat user jika belum ada
                $user = \App\Models\m_user::where('username', $pendaftar->email)->first();
                if (!$user) {
                    $password_plain = $pendaftar->tgl_lahir;
                    $password_hashed = \Hash::make($password_plain);

                    $user = \App\Models\m_user::create([
                        'name' => $pendaftar->nama,
                        'username' => $pendaftar->email,
                        'role' => 'siswa',
                        'password' => $password_hashed,
                    ]);

                    try {
                        Mail::to($pendaftar->email)->send(new AkunDiterimaMail(
                            $pendaftar->nama,
                            $pendaftar->email,
                            $password_plain
                        ));
                    } catch (\Exception $e) {
                        \Log::error('Gagal kirim email mass update: ' . $e->getMessage());
                    }
                }

                // Tambahkan ke anggota jika belum
                $sudahAnggota = DB::table('anggota')
                    ->where('nis', $pendaftar->nis)
                    ->where('id_ekskul', $pendaftar->id_ekskul)
                    ->exists();

                if (!$sudahAnggota) {
                    DB::table('anggota')->insert([
                        'nama' => $pendaftar->nama,
                        'nis' => $pendaftar->nis,
                        'kelas' => $pendaftar->kelas,
                        'tgl_lahir' => $pendaftar->tgl_lahir,
                        'jenis_kelamin' => $pendaftar->jenis_kelamin,
                        'alamat' => $pendaftar->alamat,
                        'id_ekskul' => $pendaftar->id_ekskul,
                        'status_keanggotaan' => 'aktif',
                        'tanggal_gabung' => now(),
                        'created_at' => now(),
                        'updated_at' => now(),
                        'id_user' => $user->id ?? null,
                    ]);
                }
            }
        }

        return redirect()->back()->with('pesan', 'Mass update berhasil dilakukan.');
    }

    public function delete($id)
    {
        $this->m_pendaftaran->deleteData($id);
        return redirect()->route('pendaftaran')->with('pesan', 'Data pendaftaran berhasil dihapus!');
    }
}
