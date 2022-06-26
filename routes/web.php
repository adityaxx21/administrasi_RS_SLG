<?php

use App\Http\Controllers\Admin_Controller;
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
Route::get('/register', [Register_Controller::class, 'register']);
Route::get('/login', [Register_Controller::class, 'login']);
Route::post('/login', [Register_Controller::class, 'login_post']);

// Register End



// Admin Page

Route::get('/admin', [Admin_Controller::class, 'index']);
// Admin Page End


// Instansi Page 


// Instansi Page End



// Pegawai Page

// Pegawai Page End


