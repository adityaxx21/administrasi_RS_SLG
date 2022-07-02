<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Verifikator_Controller extends Controller
{
   public function index()
   {
    $data['pegawai'] = DB::table('tb_pegawai')
    ->selectRaw('tb_pegawai.*,
        tb_user.nama as nama,
        tb_user.nomor_induk as nomor_induk')
    ->leftJoin('tb_user', 'tb_user.id', '=', 'tb_pegawai.id_pegawai')
    ->orderBy('tb_pegawai.id', 'ASC')
    ->where('tb_pegawai.is_deleted', 1)
    ->groupByRaw('tb_pegawai.id')
    ->get();
    $data['style'] = DB::table('tb_text_status')->where('is_deleted',1)->get();
    return view('verifikator.homeVerifikator',$data);
   }

   public function index_post(Request $request)
   {
     if (session()->get('role') == 10003) {
       $get_data = ['verifikasi_1'=>$request->verifikasi];
     } elseif (session()->get('role') == 10004){
        $get_data = ['verifikasi_2'=>$request->verifikasi];
     } elseif (session()->get('role') == 10005) {
        $get_data = ['verifikasi_3'=>$request->verifikasi];
     }
     DB::table('tb_pegawai')->where('id',$request->id_data)->update($get_data);
     redirect('/verifikator');
   }
}
