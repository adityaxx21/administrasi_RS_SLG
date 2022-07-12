<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaPelayanan_Controller extends Controller
{
    public function kelolaPelayanan()
    {
        // fungsi untuk menampilkan data jenis - jenis pelayanan
        $data['pelayanan'] = DB::table('tb_jenis_pelayanan')->where('is_deleted',1)->get();
        return view('admin.kelolaPelayanan',$data);
    }

    public function kelolaPelayanan_detail($id)
    {
        // fungsi untuk menampilkan detail data jenis - jenis pelayanan berdasarkan id
        $data['data'] = DB::table('tb_jenis_pelayanan')->where('id',$id)->first();
        return response()->json($data);
    }
    public function kelolaPelayanan_post(Request $request)
    {
        // fungsi untuk menambahkan data pelayanan
        $get_data = array(
            'jenis_pelayanan'=>$request->jenis_pelayanan,
            'satuan_waktu'=>$request->satuan_waktu,
            'biaya'=>$request->biaya
        );
        DB::table('tb_jenis_pelayanan')->insert($get_data);

        return redirect('/kelolaPelayanan');
    }
    public function kelolaPelayanan_update(Request $request)
    {
        // fungsi untuk memeprbarui data pelayanan
        $get_data = array(
            'jenis_pelayanan'=>$request->jenis_pelayanan_update,
            'satuan_waktu'=>$request->satuan_waktu_update,
            'biaya'=>$request->biaya_update
        );
         DB::table('tb_jenis_pelayanan')->where('id',$request->id_data_update)->update($get_data);
        return redirect('/kelolaPelayanan');
    }
    public function kelolaPelayanan_delete(Request $request)
    {
        // fungsi untuk menghapus data pelayanan
        DB::table('tb_jenis_pelayanan')->where('id',$request->id_hapus)->update(['is_deleted'=>0]);

        return redirect('/kelolaPelayanan');
    }

    public function laporanPelayanan(Request $request)
    {
        // $data['search'] = $request->input('search');
        // // pencarian data jika diinputkan
        // $date = $data['date'] !== "" ? ['tb_transaksi.tanggal_kedatangan', 'LIKE', $data['date'] . '%'] : "";
        // $date_end = $data['date_end'] !== "" ?  [$data['date'],$data['date_end']] : "";
        $data['date'] = $request->min;
        $data['date_end'] = $request->max;
        // $cond="";
        if ( $data['date'] != null &&  $data['date_end'] != null) {
            $cond = [[$data['date']],$data['date_end']];
            $data['pelayanan'] = DB::table('tb_transaksi_pelayanan')
            ->selectRaw('tb_transaksi_pelayanan.*,
                tb_instansi.nama_instansi as nama_instansi,
                tb_jenis_pelayanan.jenis_pelayanan as jenis_pelayanan,
                tb_jenis_pelayanan.satuan_waktu as satuan_waktu,
                tb_text_status.style as style,
                tb_text_status.text as text')
            ->leftJoin('tb_instansi', 'tb_instansi.id', '=', 'tb_transaksi_pelayanan.id_instansi')
            ->leftJoin('tb_jenis_pelayanan', 'tb_jenis_pelayanan.id', '=', 'tb_transaksi_pelayanan.id_jenis_pelayanan')
            ->leftJoin('tb_text_status', 'tb_text_status.id_status', '=', 'tb_transaksi_pelayanan.id_status_pembayaran')
            ->orderBy('tb_transaksi_pelayanan.id', 'ASC')
            ->where('tb_transaksi_pelayanan.is_deleted', 1)
            ->whereBetween('tb_transaksi_pelayanan.updated_at',$cond)
            ->groupByRaw('tb_transaksi_pelayanan.id')
            ->get();
        } else{
            $data['pelayanan'] = DB::table('tb_transaksi_pelayanan')
            ->selectRaw('tb_transaksi_pelayanan.*,
                tb_instansi.nama_instansi as nama_instansi,
                tb_jenis_pelayanan.jenis_pelayanan as jenis_pelayanan,
                tb_jenis_pelayanan.satuan_waktu as satuan_waktu,
                tb_text_status.style as style,
                tb_text_status.text as text')
            ->leftJoin('tb_instansi', 'tb_instansi.id', '=', 'tb_transaksi_pelayanan.id_instansi')
            ->leftJoin('tb_jenis_pelayanan', 'tb_jenis_pelayanan.id', '=', 'tb_transaksi_pelayanan.id_jenis_pelayanan')
            ->leftJoin('tb_text_status', 'tb_text_status.id_status', '=', 'tb_transaksi_pelayanan.id_status_pembayaran')
            ->orderBy('tb_transaksi_pelayanan.id', 'ASC')
            ->where('tb_transaksi_pelayanan.is_deleted', 1)
            ->groupByRaw('tb_transaksi_pelayanan.id')
            ->get();
        }

        return view('admin.laporanPelayanan',$data);
    }
}
