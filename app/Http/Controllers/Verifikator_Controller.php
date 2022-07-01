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

   public function verifikasi()
   {
     if ($role == 200) {
        # code...
     }
   }
}
