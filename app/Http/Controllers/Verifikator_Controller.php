<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;

class Verifikator_Controller extends Controller
{
   public function index(Request $request)
   {
      //  Berfungsi untuk menentukan urutan verifikasi, dari Kasi, Kabid, Disposisi Kepegawaian
      //  Urutan mulai Kasi setelah verifikasi akan dilanjutkan oleh Kabid dan Disposisi Kepegawaian

      $data['date'] = $request->min;
      $data['date_end'] = $request->max;
      $data['status_'] = $request->status;

      if ($data['status_'] != null) {
         $stat = [['tb_pegawai.is_deleted', 1], ['tb_pegawai.verifikasi_3',$data['status_']]]; 
      } else {
         $stat = [['tb_pegawai.is_deleted', 1]]; 
      }

      // if else disini berguna untuk melakukan filter sesuai data awal dan akhir yang diinputkan, dika data sesuai akan menampilkan return sesuai input sedang jika tidak sesuai hanya 
      // akan  menampilkan data awal sebelum difilter, untuk range sendiri dengan range  sehingga jika input 1 juni - 6 juni maka data yang ditampilkan 1 juni - 5 juni 
      if ($data['date'] != null &&  $data['date_end'] != null) {
         $date = [[$data['date']], $data['date_end']];

         $data['pegawai'] = DB::table('tb_pegawai')
            ->selectRaw('tb_pegawai.*,
          tb_user.nama as nama,
          tb_user.nomor_induk as nomor_induk,
          tb_text_status.style as style,
          tb_text_status.text as text')
            ->leftJoin('tb_user', 'tb_user.id', '=', 'tb_pegawai.id_pegawai')
            ->leftJoin('tb_text_status', 'tb_text_status.id_status', '=', 'tb_pegawai.verifikasi_3')
            ->orderBy('tb_pegawai.id', 'ASC')
            ->where( $stat)
            ->whereBetween('tb_pegawai.waktu_pelaksanaan', $date)
            ->groupByRaw('tb_pegawai.id')
            ->get();
      } else {
         $data['pegawai'] = DB::table('tb_pegawai')
            ->selectRaw('tb_pegawai.*,
               tb_user.nama as nama,
               tb_user.nomor_induk as nomor_induk,
               tb_text_status.style as style,
              tb_text_status.text as text')
            ->leftJoin('tb_user', 'tb_user.id', '=', 'tb_pegawai.id_pegawai')
            ->leftJoin('tb_text_status', 'tb_text_status.id_status', '=', 'tb_pegawai.verifikasi_3')
            ->orderBy('tb_pegawai.id', 'ASC')
            ->where( $stat)
            ->groupByRaw('tb_pegawai.id')
            ->get();
      }
      $data['style'] = DB::table('tb_text_status')->where([['id_status','>=','10'],['id_status','<=','12']])->get();

      // print_r($data['pegawai']);
      return view('verifikator.homeVerifikator', $data);
   }

   public function index_post(Request $request)
   {
      // Berfungsi untuk memverifikasi apakah berkas layak atau tidak
      $get_data = array(
         'verifikasi_1' => $request->verifikasi,
         'verifikasi_2' => $request->verifikasi,
         'verifikasi_3' => $request->verifikasi,
         'msg_fail' =>  $request->msg_fail
      );
      DB::table('tb_pegawai')->where('id', $request->id_data)->update($get_data);
      return redirect('/verifikasiPengajuan');
   }
}
