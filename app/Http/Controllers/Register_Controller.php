<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Register_Controller extends Controller
{
   public function loginAdmin(Request $request)
   {
     return view('register.login');
   }
   public function loginAdmin_post(Request $request)
   {
    $username = $request->username;
    $password = md5($request->password);
    $data = DB::table('tb_user')->where([['username',$username],['password',$password],['is_deleted',1]])->first();
    if (isset($data->role)) {
        session(['username' =>  $username]);
        session(['role' => $data->role]);
        
    }
    else {
    $data = DB::table('tb_instansi')->where([['username',$username],['password',$password],['is_deleted',1]])->first();
    print_r($data);
    if (isset($data->role)) {
            session(['username' => $username]);
            session(['role' => $data->role]);
            
    }    
    }
//     if ($data->role == 1001) {
//         return redirect('admin');
//     } else if($data->role == 1002) {
//         return redirect('pegawai');
//     } else if($data->role == 1003) {
//         return redirect('verifikator_1');
//     }else if($data->role == 1004) {
//         return redirect('verifikator_2');
//     }else if($data->role == 1005) {
//         return redirect('verifikator_3');
//     }else if($data->role == 2001) {
        return redirect('instansi');
//     } else {
//         return view('register.login');
//     }
   }

}
