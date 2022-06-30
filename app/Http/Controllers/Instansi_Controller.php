<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Instansi_Controller extends Controller
{
    var $location = "Instansi";
    public function index(Request $request)
    {
        $data['instansi'] = DB::table('tb_transaksi_pelayanan')
        ->selectRaw('tb_transaksi_pelayanan.*,
                tb_instansi.nama_pendaftar as nama_pendaftar,
                tb_instansi.nama_instansi as nama_instansi,
                tb_jenis_pelayanan.jenis_pelayanan as jenis_pelayanan,
                tb_text_status.style as style,
                tb_text_status.text as text')
        ->leftJoin('tb_instansi', 'tb_instansi.id', '=', 'tb_transaksi_pelayanan.id_instansi')
        ->leftJoin('tb_jenis_pelayanan', 'tb_jenis_pelayanan.id', '=', 'tb_transaksi_pelayanan.id_jenis_pelayanan')
        ->leftJoin('tb_text_status', 'tb_text_status.id_status', '=', 'tb_transaksi_pelayanan.id_status_pembayaran')
        ->orderBy('tb_transaksi_pelayanan.id', 'ASC')
        ->where([['tb_transaksi_pelayanan.is_deleted', 1],['tb_instansi.username',session()->get('username')]])
        ->groupByRaw('tb_transaksi_pelayanan.id')
        ->get();
        $data['jenis_pelayanan'] = DB::table('tb_jenis_pelayanan')->get();

        return view('instansi.homeInstansi',$data);
        
    }

    public function index_post(Request $request)
    {
        $get_data = [
            'id_instansi' => $request->id_instansi,
            'id_jenis_pelayanan' => $request->jenis_pelayanan,
            'created_at' => date("Y-m-d H:i:s")
        ];
        DB::table('tb_transaksi_pelayanan')->insert($get_data);
        return redirect('instansi');
    }

    public function tambahData($id)
    {
        $data['instansi'] = DB::table('tb_transaksi_pelayanan')
        ->selectRaw('tb_transaksi_pelayanan.*,
                tb_instansi.nama_pendaftar as nama_pendaftar,
                tb_instansi.nama_instansi as nama_instansi,
                tb_jenis_pelayanan.jenis_pelayanan as jenis_pelayanan,
                tb_jenis_pelayanan.satuan_waktu as satuan_waktu,
                tb_text_status.style as style,
                tb_text_status.text as text')
        ->leftJoin('tb_instansi', 'tb_instansi.id', '=', 'tb_transaksi_pelayanan.id_instansi')
        ->leftJoin('tb_jenis_pelayanan', 'tb_jenis_pelayanan.id', '=', 'tb_transaksi_pelayanan.id_jenis_pelayanan')
        ->leftJoin('tb_text_status', 'tb_text_status.id_status', '=', 'tb_transaksi_pelayanan.id_status_pembayaran')
        ->orderBy('tb_transaksi_pelayanan.id', 'ASC')
        ->where([['tb_transaksi_pelayanan.is_deleted', 1],['tb_transaksi_pelayanan.id',$id]])
        ->groupByRaw('tb_transaksi_pelayanan.id')
        ->first();
        $data['siswa'] = DB::table('tb_siswa')->where([['is_deleted',1],['id_pelayanan',$id]])->get();
        $data['jenis_pelayanan'] = DB::table('tb_jenis_pelayanan')->get();
        // print_r($data['instansi']);
        return view('instansi.tambahData',$data);

    }
}
