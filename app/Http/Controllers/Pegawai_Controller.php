<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf; 
class Pegawai_Controller extends Controller
{
    var $location = "pegawai";
    public function index()
    {
        $data['pegawai'] = DB::table('tb_pegawai')
            ->selectRaw('tb_pegawai.*,
                    tb_user.nama as nama,
                    tb_user.username as username')
            ->leftJoin('tb_user', 'tb_user.id', '=', 'tb_pegawai.id_pegawai')
            ->orderBy('tb_pegawai.id', 'ASC')
            ->where('tb_pegawai.is_deleted', 1)
            ->groupByRaw('tb_pegawai.id')
            ->get();
        $data['style'] = DB::table('tb_text_status')->where('is_deleted',1)->get();
        // print_r($data['pegawai']);
       return view('pegawai.homePegawai',$data);
    }
    public function find_data($id)
    {
        $data['data'] = DB::table('tb_pegawai')->where('id',$id)->first();
        $data['data']->waktu_pelaksanaan = date("Y-m-d", strtotime($data['data']->waktu_pelaksanaan));
        return response()->json($data);
    }
    public function index_post(Request $request)
    {
        $get_data = [
            'id_pegawai' => $request->id_pegawai,
            'keperluan' => $request->keperluan,
            'tema_pelatihan' => $request->tema_pelatihan,
            'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
            'narasumber' => $request->narasumber,
            'sasaran_pelatihan' => $request->sasaran_pelatihan,
            'nama_jabatan' => $request->nama_jabatan,
            'jumlah_peserta' => $request->jumlah_peserta,
            'materi' => $request->materi,
            'indikator_kebutuhan' => $request->indikator_kebutuhan,
            'anggaran' => $request->anggaran,
            'periode_evaluasi' => $request->periode_evaluasi,
            'created_at' => date("Y-m-d H:i:s")
        ];
        $get_data = $this->doc_input( $request->berkas1, $get_data, 1);
        $get_data = $this->doc_input( $request->berkas2, $get_data, 2);
        // print_r( $get_data);
        DB::table('tb_pegawai')->insert($get_data);
        return redirect('/pegawai');
    }

    public function index_update(Request $request)
    {
        $id = $request->id_pegawai_update;
        $get_data = [
            'keperluan' => $request->keperluan_update,
            'tema_pelatihan' => $request->tema_pelatihan_update,
            'waktu_pelaksanaan' => $request->waktu_pelatihan_update,
            'narasumber' => $request->narasumber_update,
            'sasaran_pelatihan' => $request->sasaran_pelatihan_update,
            'nama_jabatan' => $request->nama_jabatan_update,
            'jumlah_peserta' => $request->jumlah_peserta_update,
            'materi' => $request->materi_update,
            'indikator_kebutuhan' => $request->nama_jabatan_update,
            'anggaran' => $request->nama_jabatan_update,
            'periode_evaluasi' => $request->nama_jabatan_update,
            'verifikasi_1' => 11,
            'verifikasi_2' => 11,
            'verifikasi_3' => 11,
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $get_data = $this->doc_input( $request->berkas3, $get_data, 1);
        $get_data = $this->doc_input( $request->berkas4, $get_data, 2);

        DB::table('tb_pegawai')->where('id',$id)->update($get_data);
        return redirect('/pegawai');
    }

    public function index_delete(Request $request)
    {
        $id = $request->id_delete;
        DB::table('tb_pegawai')->where('id',$id)->update(['is_deleted'=>0]);
        return redirect('/pegawai');
    }

    public function doc_input($data, $get_data, $i)
    {
        try {
            $name_img =  $data->getClientOriginalName();
        } catch (\Throwable $th) {
            $name_img = "";
        }
        if (!empty($name_img)) {
            $img_loc = "/storage/doc/" . $this->location . "/";
            $img_save = "/public/doc/" . $this->location . "/";

            $data->storeAs($img_save, $name_img);
            $get_data = array_merge($get_data, array('berkas' . $i =>  $img_loc . $name_img));
        }
        return $get_data;
    }

    public function surat($id)
    {
        $data['pegawai'] = DB::table('tb_pegawai')->where('id',$id)->first();
        $view = view("invoice.surat", $data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $customPaper = array(0,0,1100,750);
        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('a4', 'landscape');
        $dompdf->setPaper($customPaper);

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("Surat Permohonan");

        return view('invoice.surat',$data);
    }
}
