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
      if (session()->get('role') == 1003) {
         $cond = [['tb_pegawai.verifikasi_1', 11], ['tb_pegawai.is_deleted', 1]];
      } elseif (session()->get('role') == 1004) {
         $cond = [['tb_pegawai.verifikasi_1', 10], ['tb_pegawai.verifikasi_2', 11], ['tb_pegawai.is_deleted', 1]];
      } elseif (session()->get('role') == 1005) {
         $cond = [['tb_pegawai.verifikasi_1', 10], ['tb_pegawai.verifikasi_2', 10], ['tb_pegawai.verifikasi_3', 11], ['tb_pegawai.is_deleted', 1]];
      }

      $data['date'] = $request->min;
      $data['date_end'] = $request->max;

      if ($data['date'] != null &&  $data['date_end'] != null) {
         $date = [[$data['date']], $data['date_end']];

         $data['pegawai'] = DB::table('tb_pegawai')
            ->selectRaw('tb_pegawai.*,
          tb_user.nama as nama,
          tb_user.nomor_induk as nomor_induk')
            ->leftJoin('tb_user', 'tb_user.id', '=', 'tb_pegawai.id_pegawai')
            ->orderBy('tb_pegawai.id', 'ASC')
            ->where($cond)
            ->whereBetween('tb_pegawai.waktu_pelaksanaan', $date)
            ->groupByRaw('tb_pegawai.id')
            ->get();
      } else {
         $data['pegawai'] = DB::table('tb_pegawai')
            ->selectRaw('tb_pegawai.*,
               tb_user.nama as nama,
               tb_user.nomor_induk as nomor_induk')
            ->leftJoin('tb_user', 'tb_user.id', '=', 'tb_pegawai.id_pegawai')
            ->orderBy('tb_pegawai.id', 'ASC')
            ->where($cond)
            ->groupByRaw('tb_pegawai.id')
            ->get();
      }


      $data['style'] = DB::table('tb_text_status')->where([['is_deleted', 1], ['id_status', '>=', 10]])->get();
      return view('verifikator.homeVerifikator', $data);
   }

   public function index_post(Request $request)
   {
      // Berfungsi untuk memverifikasi apakah berkas layak atau tidak
      if (session()->get('role') == 1003) {
         $get_data = ['verifikasi_1' => $request->verifikasi];
      } elseif (session()->get('role') == 1004) {
         $get_data = ['verifikasi_2' => $request->verifikasi];
      } elseif (session()->get('role') == 1005) {
         $get_data = ['verifikasi_3' => $request->verifikasi];
      }
      $get_data = array_merge($get_data, array('msg_fail' =>  $request->msg_fail));

      //  echo (session()->get('role'));
      DB::table('tb_pegawai')->where('id', $request->id_data)->update($get_data);
      return redirect('/verifikasi');
   }
}
