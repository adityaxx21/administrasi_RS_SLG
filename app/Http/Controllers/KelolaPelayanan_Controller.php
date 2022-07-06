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
}
