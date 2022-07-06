<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Register_Controller extends Controller
{
    public function redirect()
    {
      return redirect('/login');
    }
    public function loginAdmin(Request $request)
    {
        // fungsi untuk masuk halaman login
        return view('register.login');
    }
    public function loginAdmin_post(Request $request)
    {
        // fungsi ini dipakai untuk melakukan login oleh user, admin, pegawai dan verifikator
        //  penggunaan md5 untuk mengamankan password agar terenkripsi
        // dari login tersebut akan menyimpan data berupa username dan role pada session
        $username = $request->username;
        $password = md5($request->password);
        $data = DB::table('tb_user')->where([['username', $username], ['password', $password], ['is_deleted', 1]])->first();
        try {
            if (isset($data->role)) {
                session(['username' =>  $username]);
                session(['role' => $data->role]);
                print_r($data);
                if ($data->role == 1001) {
                    return redirect('/admin');
                } else if ($data->role == 1002) {
                    return redirect('/pegawai');
                } else if ($data->role >= 1003 && $data->role <= 1005) {
                    return redirect('/verifikasi');
                }
            } else {
                $data = DB::table('tb_instansi')->where([['username', $username], ['password', $password], ['is_deleted', 1]])->first();
                print_r($data);
                if ($data->role) {
                    session(['username' => $username]);
                    session(['role' => $data->role]);
                    if ($data->role == 2001) {
                        return redirect('/instansi');
                    }
                }
            }
        } catch (\Throwable $th) {
            return view('register.login');

        }
       
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
