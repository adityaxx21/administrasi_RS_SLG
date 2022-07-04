<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;

class Verifikator_Controller extends Controller
{
   public function index()
   {
    
    if (session()->get('role') == 1003) {
       $cond = [['tb_pegawai.verifikasi_1',11],['tb_pegawai.is_deleted',1]];
    } elseif (session()->get('role') == 1004){
        $cond = [['tb_pegawai.verifikasi_1',10],['tb_pegawai.verifikasi_2',11],['tb_pegawai.is_deleted',1]];
    } elseif (session()->get('role') == 1005) {
        $cond = [['tb_pegawai.verifikasi_1',10],['tb_pegawai.verifikasi_2',10],['tb_pegawai.verifikasi_3',11],['tb_pegawai.is_deleted',1]];
    }

    $data['pegawai'] = DB::table('tb_pegawai')
    ->selectRaw('tb_pegawai.*,
        tb_user.nama as nama,
        tb_user.nomor_induk as nomor_induk')
    ->leftJoin('tb_user', 'tb_user.id', '=', 'tb_pegawai.id_pegawai')
    ->orderBy('tb_pegawai.id', 'ASC')
    ->where($cond)
    ->groupByRaw('tb_pegawai.id')
    ->get();




    $data['style'] = DB::table('tb_text_status')->where([['is_deleted',1],['id_status' ,'>=', 10]])->get();
    return view('verifikator.homeVerifikator',$data);
   }

   public function index_post(Request $request)
   {
     if (session()->get('role') == 1003) {
       $get_data = ['verifikasi_1'=>$request->verifikasi];
     } elseif (session()->get('role') == 1004){
        $get_data = ['verifikasi_2'=>$request->verifikasi];
     } elseif (session()->get('role') == 1005) {
        $get_data = ['verifikasi_3'=>$request->verifikasi];
     }
    //  echo (session()->get('role'));
     DB::table('tb_pegawai')->where('id',$request->id_data)->update($get_data);
     return redirect('/verifikasi');
   }

 
}
