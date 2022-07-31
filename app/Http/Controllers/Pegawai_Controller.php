<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;

class Pegawai_Controller extends Controller
{
    // Fungsi ini dipa
    var $location = "pegawai";
    public function index(Request $request)
    {
        $data['date'] = $request->min;
        $data['date_end'] = $request->max;
        $data['status_'] = $request->status;
        if ($data['status_'] != null) {
            $stat = [['tb_pegawai.is_deleted', 1], ['tb_pegawai.verifikasi_3', $data['status_']]];
        } else {
            $stat = [['tb_pegawai.is_deleted', 1]];
        }
        if ($data['date'] != null &&  $data['date_end'] != null) {
            $cond = [[$data['date']], $data['date_end']];
            $data['pegawai'] = DB::table('tb_pegawai')
                ->selectRaw('tb_pegawai.*,
                    tb_user.nama as nama,
                    tb_user.username as username')
                ->leftJoin('tb_user', 'tb_user.id', '=', 'tb_pegawai.id_pegawai')
                ->orderBy('tb_pegawai.id', 'ASC')
                ->where($stat)
                ->whereBetween('tb_pegawai.updated_at', $cond)
                ->groupByRaw('tb_pegawai.id')
                ->get();
        } else {
            $data['pegawai'] = DB::table('tb_pegawai')
                ->selectRaw('tb_pegawai.*,
                    tb_user.nama as nama,
                    tb_user.username as username')
                ->leftJoin('tb_user', 'tb_user.id', '=', 'tb_pegawai.id_pegawai')
                ->orderBy('tb_pegawai.id', 'ASC')
                ->where($stat)
                ->groupByRaw('tb_pegawai.id')
                ->get();
        }
        // Berfungsi untuk menampilkan data pengajuan inhouse atau exhouse dari database
        $data['status'] = DB::table('tb_text_status')->where([['id_status', '>=', '10'], ['id_status', '<=', '12']])->get();

        $data['style'] = DB::table('tb_text_status')->where('is_deleted', 1)->get();
        // print_r($data['pegawai']);
        return view('pegawai.homePegawai', $data);
    }
    public function find_data($id)
    {
        // fungsi ajax untuk menampilkan detail data dari salah satu pengajuan berdasarkan id jika akan dilakukan pengupdate an
        $data['data'] = DB::table('tb_pegawai')->where('id', $id)->first();
        $data['data']->waktu_pelaksanaan = date("Y-m-d", strtotime($data['data']->waktu_pelaksanaan));
        return response()->json($data);
    }
    public function index_post(Request $request)
    {
        // berfungsi untuk menambahkan pengajuan surat ex/in house
        $get_data = [
            'id_pegawai' => $request->id_pegawai,
            'keperluan' => $request->keperluan,
            'tema_pelatihan' => $request->tema_pelatihan,
            'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
            'narasumber' => $request->narasumber,
            'sasaran_pelatihan' => $request->sasaran_pelatihan,
            'nama_jabatan' => $request->nama_jabatan,
            'materi' => $request->materi,
            'indikator_kebutuhan' => $request->indikator_kebutuhan,
            'jumlah_peserta' => $request->jumlah_peserta,
            'anggaran' => $request->anggaran,
            'periode_evaluasi' => $request->periode_evaluasi,
            'created_at' => date("Y-m-d H:i:s")
        ];
        $get_data = $this->doc_input($request->berkas1, $get_data, 1);
        $get_data = $this->doc_input($request->berkas2, $get_data, 2);
        $get_data = $this->doc_input($request->berkas3, $get_data, 3);
        // print_r( $get_data);
        DB::table('tb_pegawai')->insert($get_data);
        return redirect('/pegawai');
    }

    public function index_update(Request $request)
    {
        // berfungsi untuk memperbarui salah satu pengajuan dan disimpan dalam table tb_pegawai
        $id = $request->id_pegawai_update;
        $get_data = [
            'keperluan' => $request->keperluan_update,
            'tema_pelatihan' => $request->tema_pelatihan_update,
            'waktu_pelaksanaan' => $request->waktu_pelaksanaan_update,
            'narasumber' => $request->narasumber_update,
            'sasaran_pelatihan' => $request->sasaran_pelatihan_update,
            'nama_jabatan' => $request->nama_jabatan_update,
            'materi' => $request->materi_update,
            'indikator_kebutuhan' => $request->indikator_kebutuhan_update,
            'anggaran' => $request->anggaran_update,
            'periode_evaluasi' => $request->periode_evaluasi_update,
            'jumlah_peserta_update' => $request->jumlah_peserta_update,
            'verifikasi_1' => 11,
            'verifikasi_2' => 11,
            'verifikasi_3' => 11,
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $get_data = $this->doc_input($request->berkas4, $get_data, 1);
        $get_data = $this->doc_input($request->berkas5, $get_data, 2);
        $get_data = $this->doc_input($request->berkas6, $get_data, 3);

        DB::table('tb_pegawai')->where('id', $id)->update($get_data);
        return redirect('/pegawai');
    }

    public function index_delete(Request $request)
    {
        // berfungsi untuk mengahapus salah satu data pengajuan suran in / ex berdasarkan idnya
        $id = $request->id_delete;
        DB::table('tb_pegawai')->where('id', $id)->update(['is_deleted' => 0]);
        return redirect('/pegawai');
    }

    // Jangan dimasukan laporan
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
        // fungsi pembuatan surat berdasarkan detail - detail yang diambil dari tb_pegawai
        // output dari fungsi ini berupa pdf
        $data['pegawai'] = DB::table('tb_pegawai')->where('id', $id)->first();
        // print_r($data['pegawai']);
        $view = view("invoice.surat", $data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $customPaper = array(0, 0, 700, 750);
        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('a4', 'potrait');
        $dompdf->setPaper($customPaper);

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("Surat Permohonan");

        return view('invoice.surat', $data);
    }

   
}
