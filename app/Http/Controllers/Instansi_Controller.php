<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\PDF;

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
            ->where([['tb_transaksi_pelayanan.is_deleted', 1], ['tb_instansi.username', session()->get('username')]])
            ->groupByRaw('tb_transaksi_pelayanan.id')
            ->get();
        $data['data_instansi'] = DB::table('tb_instansi')->where('username', session()->get('username'))->first();
        $data['jenis_pelayanan'] = DB::table('tb_jenis_pelayanan')->where('is_deleted', 1)->get();

        return view('instansi.homeInstansi', $data);
    }

    public function index_post(Request $request)
    {
        $get_data = [
            'id_instansi' => $request->id_instansi,
            'id_jenis_pelayanan' => $request->jenis_pelayanan,
            'created_at' => date("Y-m-d H:i:s")
        ];
        DB::table('tb_transaksi_pelayanan')->insert($get_data);
        $id = DB::table('tb_transaksi_pelayanan')->max('id');
        return redirect('/instansi/tambahData/'.$id);
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
            ->where([['tb_transaksi_pelayanan.is_deleted', 1], ['tb_transaksi_pelayanan.id', $id]])
            ->groupByRaw('tb_transaksi_pelayanan.id')
            ->first();
            // echo($id);
        $data['siswa'] = DB::table('tb_siswa')->where([['is_deleted', 1], ['id_pelayanan', $id]])->get();
        $data['jenis_pelayanan'] = DB::table('tb_jenis_pelayanan')->where('is_deleted', 1)->get();
                      // print_r($data['instansi']);
        return view('instansi.tambahData', $data);
        return response()->json($data);

    }
    public function tambahData_post(Request $request)
    {
        $jumlah_pelayan = $request->jumlah_pelayanan;
        $durasi_pelayanan = $request->durasi_pelayanan;
        $biaya_orang = $request->biaya_orang;
        $id = $request->id_instansi;
        $get_data = [
            'durasi_pelayanan' => $durasi_pelayanan,
            'jumlah_pelayanan' => $jumlah_pelayan,
            'total_biaya_pelayanan' => $durasi_pelayanan * $biaya_orang * $jumlah_pelayan,
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        // print_r($get_data);
        DB::table('tb_transaksi_pelayanan')->where('id', $id)->update($get_data);
        // $id_move = DB::table('tb_transaksi_pelayanan')->max('id');
        return redirect('/instansi/tambahData/' .  $id);
    }


    public function tambahSiswa_post(Request $request)
    {
        $nama_siswa = $request->nama_siswa;
        $nomor_induk = $request->nomor_induk;
        $alamat = $request->alamat;
        $jenis_kelamin = $request->jenis_kelamin;
        $id = $request->id_ins;
        $get_data = [
            'nama_siswa' => $nama_siswa,
            'nomor_induk' => $nomor_induk,
            'alamat' => $alamat,
            'id_pelayanan' => $id,
            'jenis_kelamin' => $jenis_kelamin,
            'created_at' => date("Y-m-d H:i:s"),
        ];

        $get_data = $this->doc_input($request->doc1, $get_data, 1);
        $get_data = $this->doc_input($request->doc2, $get_data, 2);
        $get_data =  $this->doc_input($request->doc3, $get_data, 3);
        DB::table('tb_transaksi_pelayanan')->where('id', $id)->increment('jumlah_pelayanan', 1);
        DB::table('tb_siswa')->insert($get_data);
        // print_r($get_data);
        $data['intansi'] = DB::table('tb_transaksi_pelayanan')->where([['is_deleted', 1], ['id', $id]])->first();
        $data['jenis_pelayanan'] = DB::table('tb_jenis_pelayanan')->where([['is_deleted', 1], ['id',  $data['intansi']->id_jenis_pelayanan]])->first();


        DB::table('tb_transaksi_pelayanan')->where('id', $id)->update(['total_biaya_pelayanan'=>( $data['intansi']->durasi_pelayanan * $data['intansi']->jumlah_pelayanan * $data['jenis_pelayanan']->biaya )]);


        $this->tambahData_post($request);
        return redirect('/instansi/tambahData/' . $id);
    }
    public function bayar(Request $request)
    {
        $metode_pembayaran = $request->metode_pembayaran;
        $kode_bayar = $request->kode_bayar;
        $id = $request->id_inp;
        $get_data = [
            'metode_pembayaran' => $metode_pembayaran,
            'kode_pembayaran' => $kode_bayar,
            'id_status_pembayaran' => 2,
            'created_at' => date("Y-m-d H:i:s"),
        ];
        try {
            $name_img =  $request->bukti_bayar->getClientOriginalName();
        } catch (\Throwable $th) {
            $name_img = "";
        }
        if (!empty($name_img)) {
            $img_loc = "/storage/image/" . $this->location . "/";
            $img_save = "/public/image/" . $this->location . "/";

            $request->bukti_bayar->storeAs($img_save, $name_img);
            $get_data = array_merge($get_data, array('bukti_pembayaran' =>  $img_loc . $name_img));
        }
        // print_r($get_data);
        DB::table('tb_transaksi_pelayanan')->where('id', $id)->update($get_data);
        return redirect('/instansi');
    }

    public function doc_input($data, $get_data, $i)
    {
        try {
            $name_img =  $data->getClientOriginalName();
        } catch (\Throwable $th) {
            $name_img = "";
        }
        if (!empty($name_img)) {
            $img_loc = "/storage/image/" . $this->location . "/";
            $img_save = "/public/image/" . $this->location . "/";

            $data->storeAs($img_save, $name_img);
            $get_data = array_merge($get_data, array('berkas' . $i =>  $img_loc . $name_img));
        }
        return $get_data;
    }


    public function invoice($id)
    {
        $data['instansi'] = DB::table('tb_transaksi_pelayanan')
            ->selectRaw('tb_transaksi_pelayanan.*,
            tb_instansi.nama_pendaftar as nama_pendaftar,
            tb_instansi.nama_instansi as nama_instansi,
            tb_instansi.alamat_instansi as alamat_instansi,
            tb_instansi.email as email_instansi,
            tb_jenis_pelayanan.jenis_pelayanan as jenis_pelayanan,
            tb_jenis_pelayanan.biaya as biaya,
            tb_jenis_pelayanan.satuan_waktu as satuan_waktu,
            tb_text_status.style as style,
            tb_text_status.text as text')
            ->leftJoin('tb_instansi', 'tb_instansi.id', '=', 'tb_transaksi_pelayanan.id_instansi')
            ->leftJoin('tb_jenis_pelayanan', 'tb_jenis_pelayanan.id', '=', 'tb_transaksi_pelayanan.id_jenis_pelayanan')
            ->leftJoin('tb_text_status', 'tb_text_status.id_status', '=', 'tb_transaksi_pelayanan.id_status_pembayaran')
            ->orderBy('tb_transaksi_pelayanan.id', 'ASC')
            ->where([['tb_transaksi_pelayanan.is_deleted', 1], ['tb_transaksi_pelayanan.id', $id]])
            ->groupByRaw('tb_transaksi_pelayanan.id')
            ->first();
        $data['siswa'] = DB::table('tb_siswa')->where([['is_deleted', 1], ['id_pelayanan', $id]])->get();
        $data['jenis_pelayanan'] = DB::table('tb_jenis_pelayanan')->where('is_deleted', 1)->get();

        // print_r($data['jenislaporan']);

        // instantiate and use the dompdf class
        $view = view("invoice.invoice", $data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $customPaper = array(0,0,1100,750);
        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('a4', 'landscape');
        $dompdf->setPaper($customPaper);

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("Laporan Transaksi");
        return view("invoice.invoice", $data);
        // return redirect('/');
    }

    public function hapus_siswa(Request $request)
    {
        $id_hapus = $request->id_hapus;
        $id_data = $request->id_inst;
        DB::table('tb_transaksi_pelayanan')->where('id', $id_data)->decrement('jumlah_pelayanan', 1);
        DB::table('tb_siswa')->where('id',$id_hapus)->update(['is_deleted'=>0]);
        // echo($id_hapus."    ".$id_data);

        // if ( $id_data == 10006) {
        // }
        $data['intansi'] = DB::table('tb_transaksi_pelayanan')->where([['is_deleted', 1], ['id', $id_data]])->first();
        $data['jenis_pelayanan'] = DB::table('tb_jenis_pelayanan')->where([['is_deleted', 1], ['id',  $data['intansi']->id_jenis_pelayanan]])->first();
        // print_r( $data['intansi']);

        DB::table('tb_transaksi_pelayanan')->where('id', $id_data)->update(['total_biaya_pelayanan'=>( $data['intansi']->durasi_pelayanan * $data['intansi']->jumlah_pelayanan * $data['jenis_pelayanan']->biaya )]);



        return redirect('/instansi/tambahData/' . $id_data);
    }
    public function hapus_pelayanan(Request $request)
    {
        $id_hapus = $request->id_hapus;

        DB::table('tb_transaksi_pelayanan')->where('id',$id_hapus)->update(['is_deleted'=>0]);
        // echo($id_hapus."    ".$id_data);

        // if ( $id_data == 10006) {
        // }
      

        return redirect('/instansi');
    }
}
