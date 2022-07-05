<?php

use App\Http\Controllers\Admin_Controller;
use App\Http\Controllers\Instansi_Controller;
use App\Http\Controllers\KonfirmasiPembayaran_Controller;
use App\Http\Controllers\Pegawai_Controller;
use App\Http\Controllers\Register_Controller;
use App\Http\Controllers\Verifikator_Controller;
use Illuminate\Support\Facades\Route;

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

// Register
// Route::get('/register', [Register_Controller::class, 'register']);
Route::get('/login', [Register_Controller::class, 'loginAdmin']);
Route::get('/logout', [Register_Controller::class, 'logout']);

Route::post('/login', [Register_Controller::class, 'loginAdmin_post']);
// Register End



// Admin Page

Route::get('/admin', [Admin_Controller::class, 'index']);
Route::post('/admin', [Admin_Controller::class, 'tambah_data']);
Route::post('/delete_instansi', [Admin_Controller::class, 'delete_instansi']);
Route::get('/find_data/{id}', [Admin_Controller::class, 'find_data']);
Route::post('/updateAkun', [Admin_Controller::class, 'update_data']);
Route::get('/konfirmasi_pembayaran', [KonfirmasiPembayaran_Controller::class, 'index']);
Route::post('/konfirmasi_pembayaran', [KonfirmasiPembayaran_Controller::class, 'index_post']);
Route::get('/konfirmasi_pembayaran/detail/{id}', [KonfirmasiPembayaran_Controller::class, 'detail_pelayanan']);
// Admin Page End


// Instansi Page 
Route::get('/instansi', [Instansi_Controller::class, 'index']);
Route::post('/instansi', [Instansi_Controller::class, 'index_post']);
Route::get('/instansi/tambahData/{id}', [Instansi_Controller::class, 'tambahData']);
Route::post('/instansi/tambahData', [Instansi_Controller::class, 'tambahData_post']);
Route::post('/tambahSiswa_post', [Instansi_Controller::class, 'tambahSiswa_post']);
Route::post('/bayar', [Instansi_Controller::class, 'bayar']);
Route::post('/hapus_pelayanan', [Instansi_Controller::class, 'hapus_pelayanan']);
Route::post('/hapus_siswa', [Instansi_Controller::class, 'hapus_siswa']);

// Route::get('/instansi', [Admin_Controller::class, 'index']);

// Instansi Page End



// Pegawai Page
Route::get('/pegawai', [Pegawai_Controller::class, 'index']);
Route::get('/find_data_pegawai/{id}', [Pegawai_Controller::class, 'find_data']);
Route::post('/pegawai_post', [Pegawai_Controller::class, 'index_post']);
Route::post('/pegawai_update', [Pegawai_Controller::class, 'index_update']);
Route::post('/pegawai_delete', [Pegawai_Controller::class, 'index_delete']);




// Pegawai Page End


// Verifikator
Route::get('/verifikasi', [Verifikator_Controller::class, 'index']);
Route::post('/verifikasi_post', [Verifikator_Controller::class, 'index_post']);
// Verifikator End

// Invoice 
Route::get('/invoice/{id}', [Instansi_Controller::class, 'invoice']);
Route::get('/surat/{id}', [Pegawai_Controller::class, 'surat']);
// End Invoice