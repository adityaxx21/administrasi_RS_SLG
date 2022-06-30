<?php

use App\Http\Controllers\Admin_Controller;
use App\Http\Controllers\Instansi_Controller;
use App\Http\Controllers\KonfirmasiPembayaran_Controller;
use App\Http\Controllers\Register_Controller;
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
Route::post('/login', [Register_Controller::class, 'loginAdmin_post']);
// Register End



// Admin Page

Route::get('/admin', [Admin_Controller::class, 'index']);
Route::post('/admin', [Admin_Controller::class, 'tambah_data']);
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
// Route::get('/instansi', [Admin_Controller::class, 'index']);

// Instansi Page End



// Pegawai Page

// Pegawai Page End


