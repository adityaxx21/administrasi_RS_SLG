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
    if ($data->username != null) {
        session(['username' => $username]);
        session(['role' => $data->role]);
        return redirect('admin');
    }
    else {
        return view('register.login');
    }
   }

}
