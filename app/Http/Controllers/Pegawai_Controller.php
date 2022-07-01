<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Pegawai_Controller extends Controller
{
    public function index()
    {
        $data['pegawai'] = DB::table('tb_pegawai')
            ->selectRaw('tb_pegawai.*,
                    tb_user.nama as nama,
                    tb_user.username as username')
            ->leftJoin('tb_user', 'tb_user.id', '=', 'tb_pegawai.id_pegawai')
            ->orderBy('tb_pegawai.id', 'ASC')
            ->where([['tb_pegawai.is_deleted', 1],['tb_user.username',session()->get('username')]])
            ->groupByRaw('tb_user.id')
            ->get();
        $data['style'] = DB::table('tb_text_status')->where('is_deleted',1)->get();
        // print_r($data['pegawai']);
       return view('pegawai.homePegawai',$data);
    }
}
