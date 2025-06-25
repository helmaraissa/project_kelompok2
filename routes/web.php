<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\c_home;
use App\Http\Controllers\c_register;
use App\Http\Controllers\c_auth;
use App\Http\Controllers\c_user;
use App\Http\Controllers\c_index;
use App\Http\Controllers\c_ekskul;
use App\Http\Controllers\c_kalender;
use App\Http\Controllers\c_pendaftaran;
use App\Http\Controllers\c_anggota;
use App\Http\Controllers\c_kegiatan;
use App\Http\Controllers\c_lomba;
use App\Http\Controllers\c_kehadiran;
use App\Http\Controllers\c_nilai;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// routes/web.php

Route::get('/', [c_home::class, 'index'])->name('home');

Route::get('/kalender', [KalenderController::class, 'index']);

Route::get('/index', [c_index::class, 'index']);

Route::get('/login', [c_auth::class, 'showLogin'])->name('login');
Route::post('/login', [c_auth::class, 'login']);
Route::post('/logout', [c_auth::class, 'logout'])->name('logout');

Route::get('/register', [c_register::class, 'show'])->name('register');
Route::post('/register', [c_register::class, 'store']);

Route::get('/formpendaftaran', [c_pendaftaran::class, 'create'])->name('v_pendaftaran');
    Route::post('/pendaftaran', [c_pendaftaran::class, 'store'])->name('pendaftaran.store');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/user', [c_user::class, 'index'])->name('user');
    Route::get('/user/add', [c_user::class, 'add'])->name('user.add');
    Route::post('/user/insert', [c_user::class, 'insert'])->name('user.insert');
    Route::get('/user/edit/{id}', [c_user::class, 'edit'])->name('user.edit');
    Route::post('/user/update/{id}', [c_user::class, 'update'])->name('user.update');
    Route::get('/user/delete/{id}', [c_user::class, 'delete'])->name('user.delete');
    Route::post('/user/update-role/{id}', [c_user::class, 'updateRole'])->name('user.update.role');

    Route::get('/ekskul', [c_ekskul::class, 'index'])->name('ekskul');
    Route::get('/ekskul/detail/{id_ekskul}', [c_ekskul::class, 'detail']);
    Route::get('/ekskul/add', [c_ekskul::class, 'add']);
    Route::post('/ekskul/insert', [c_ekskul::class, 'insert']);
    Route::get('/ekskul/edit/{id_ekskul}', [c_ekskul::class, 'edit']);
    Route::post('/ekskul/update/{id_ekskul}', [c_ekskul::class, 'update']);
    Route::get('/ekskul/delete/{id_ekskul}', [c_ekskul::class, 'delete']);

    Route::get('/kegiatan', [c_kegiatan::class, 'index'])->name('kegiatan');

});

Route::middleware(['auth', 'role:pembina'])->group(function () {
    Route::get('/pendaftaran', [c_pendaftaran::class, 'index'])->name('pendaftaran');
    Route::get('/pendaftaran/add', [c_pendaftaran::class, 'add'])->name('pendaftaran.add');
    Route::post('/pendaftaran/insert', [c_pendaftaran::class, 'insert'])->name('pendaftaran.insert');
    Route::get('/pendaftaran/edit/{id}', [c_pendaftaran::class, 'edit'])->name('pendaftaran.edit');
    Route::post('/pendaftaran/update/{id}', [c_pendaftaran::class, 'update'])->name('pendaftaran.update');
    Route::get('/pendaftaran/delete/{id}', [c_pendaftaran::class, 'delete'])->name('pendaftaran.delete');
    Route::post('/datapendaftaran/mass-update', [c_pendaftaran::class, 'massUpdate'])->name('pendaftaran.mass-update');

    Route::get('/anggota', [c_anggota::class, 'index'])->name('anggota');
    Route::get('/anggota/add', [c_anggota::class, 'add'])->name('anggota.add');
    Route::post('/anggota/insert', [c_anggota::class, 'insert'])->name('anggota.insert');
    Route::get('/anggota/edit/{id}', [c_anggota::class, 'edit'])->name('anggota.edit');
    Route::post('/anggota/update/{id}', [c_anggota::class, 'update'])->name('anggota.update');
    Route::get('/anggota/delete/{id}', [c_anggota::class, 'delete'])->name('anggota.delete');

    Route::get('/kegiatan', [c_kegiatan::class, 'index'])->name('kegiatan');
    Route::get('/kegiatan/add', [c_kegiatan::class, 'add'])->name('kegiatan.add');
    Route::post('/kegiatan/insert', [c_kegiatan::class, 'insert'])->name('kegiatan.insert');
    Route::get('/kegiatan/edit/{id}', [c_kegiatan::class, 'edit'])->name('kegiatan.edit');
    Route::put('/kegiatan/update/{id}', [c_kegiatan::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/delete/{id}', [c_kegiatan::class, 'delete'])->name('kegiatan.delete');
    Route::get('/api/kegiatan', [c_kegiatan::class, 'getKegiatan']);

    Route::get('/lomba', [c_lomba::class, 'index'])->name('lomba');
    Route::get('/lomba/add', [c_lomba::class, 'add'])->name('lomba.add');
    Route::post('/lomba/insert', [c_lomba::class, 'insert'])->name('lomba.insert');
    Route::get('/lomba/edit/{id_lomba}', [c_lomba::class, 'edit'])->name('lomba.edit');
    Route::put('/lomba/update/{id_lomba}', [c_lomba::class, 'update'])->name('lomba.update');
    Route::get('/lomba/delete/{id_lomba}', [c_lomba::class, 'delete']);

    Route::get('kehadiran/verifikasi', [C_Kehadiran::class, 'listVerifikasi']);
    Route::put('kehadiran/verifikasi/{id}', [C_Kehadiran::class, 'verifikasi']);
    Route::put('/kehadiran/mass-verifikasi', [c_kehadiran::class, 'massVerifikasi'])->name('kehadiran.mass-verifikasi');

    Route::get('/kehadiran/verifikasi/{id}', [c_kehadiran::class, 'verifikasi']);

    // Manajemen Nilai oleh Pembina
    Route::get('/nilai', [c_nilai::class, 'index'])->name('nilai');
    Route::get('/nilai/add', [c_nilai::class, 'add'])->name('nilai.add');
    Route::post('/nilai/insert', [c_nilai::class, 'insert'])->name('nilai.insert');
    Route::get('/nilai/edit/{id}', [c_nilai::class, 'edit'])->name('nilai.edit');
    Route::post('/nilai/update/{id}', [c_nilai::class, 'update'])->name('nilai.update');
    Route::get('/nilai/delete/{id}', [c_nilai::class, 'delete'])->name('nilai.delete');
    Route::get('/nilai/detail/{id}', [c_nilai::class, 'detail'])->name('nilai.detail');
    Route::get('/nilai/print/{kelas}', [c_nilai::class, 'printByKelas'])->name('nilai.print.kelas');
});

Route::resource('kehadiran', c_kehadiran::class);

Route::middleware(['auth', 'role:siswa'])->group(function () {
    // Kalender Kegiatan
    Route::get('/kalender-kegiatan', [c_kegiatan::class, 'kalenderSiswa'])->name('kalender.kegiatan');
    Route::get('/kalender-kegiatan/json', [c_kegiatan::class, 'getKegiatan']);

    // Absensi dari Kalender
    Route::get('/kehadiran/siswa/form/{id_kegiatan}', [c_kehadiran::class, 'formSiswa'])->name('kehadiran.form.siswa');
    Route::post('/kehadiran/siswa/simpan', [c_kehadiran::class, 'simpanSiswa'])->name('kehadiran.simpan.siswa');
    Route::get('/rekap-kehadiran', [c_kehadiran::class, 'rekapSiswa']);

    // Lain-lain (opsional)
    Route::get('/anggota-saya', [c_anggota::class, 'anggotaSiswa'])->name('anggota.saya');
    Route::get('/absensi-saya', [c_kehadiran::class, 'kehadiranSiswa'])->name('absensi.saya');
    Route::get('/nilai-saya', [c_anggota::class, 'nilaiSiswa'])->name('nilai.saya');
});



Route::post('/kehadiran/siswa/simpan', [c_kehadiran::class, 'simpanSiswa']);
