<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonfirmasiPembayaran_Controller extends Controller
{
    var $location = "KonfirmasiPembayaran";
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
            ->where('tb_transaksi_pelayanan.is_deleted', 1)
            ->groupByRaw('tb_transaksi_pelayanan.id')
            ->get();

        // $data['siswa'] = DB::table('tb_siswas')->where([['is_deleted',1],['id_pelayanan',$data[])

        return view('admin.konfirmasiPembayaran', $data);
    }

    public function index_post(Request $request)
    {
       $id = $request->id_data;
       $status = $request->status;
       DB::table('tb_transaksi_pelayanan')->where('id',$id)->update(['id_status_pembayaran'=>$status]);
        return redirect('konfirmasi_pembayaran');
    }

    public function detail_pelayanan($id)
    {
        $data['instansi'] = DB::table('tb_transaksi_pelayanan')
        ->selectRaw('tb_transaksi_pelayanan.*,
                tb_instansi.nama_pendaftar as nama_pendaftar,
                tb_instansi.nama_instansi as nama_instansi,
                tb_jenis_pelayanan.jenis_pelayanan as jenis_pelayanan')
        ->leftJoin('tb_instansi', 'tb_instansi.id', '=', 'tb_transaksi_pelayanan.id_instansi')
        ->leftJoin('tb_jenis_pelayanan', 'tb_jenis_pelayanan.id', '=', 'tb_transaksi_pelayanan.id_jenis_pelayanan')
        ->orderBy('tb_transaksi_pelayanan.id', 'ASC')
        ->where([['tb_transaksi_pelayanan.is_deleted', 1],['tb_transaksi_pelayanan.id',$id]])
        ->groupByRaw('tb_transaksi_pelayanan.id')
        ->get();

        $data['siswa'] = DB::table('tb_siswa')->where([['is_deleted',1],['id_pelayanan',$id]]);
        return view('admin.detail_konfirmasi_', $data);
    }
}
