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
        // fungsi untuk menampilkan pelayanan pada user instansi
        // dimana akan menampilkan seluruh proses pelayanan oleh instansi tersebut

        // tabel dibawah merupakan left join dari beberapa tabel berdasarkan id nya
        $data['date'] = $request->min;
        $data['date_end'] = $request->max;
        $data['status_'] = $request->status;
        if ($data['status_'] != null) {
            $stat = [['tb_transaksi_pelayanan.is_deleted', 1], ['tb_instansi.username', session()->get('username')],['tb_transaksi_pelayanan.id_status_pembayaran',$data['status_']]]; 
        } else {
            $stat = [['tb_transaksi_pelayanan.is_deleted', 1], ['tb_instansi.username', session()->get('username')]]; 
        }
        if ($data['date'] != null &&  $data['date_end'] != null) {
            $cond = [[$data['date']], $data['date_end']];
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
                ->where($stat)
                ->whereBetween('tb_transaksi_pelayanan.updated_at', $cond)
                ->groupByRaw('tb_transaksi_pelayanan.id')
                ->get();
        } else {
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
                ->where($stat)

                ->groupByRaw('tb_transaksi_pelayanan.id')
                ->get();
        }
        $data['status'] = DB::table('tb_text_status')->where('id_status','<','10')->get();
        $data['data_instansi'] = DB::table('tb_instansi')->where('username', session()->get('username'))->first();
        $data['jenis_pelayanan'] = DB::table('tb_jenis_pelayanan')->where('is_deleted', 1)->get();

        // print_r($data['instansi']);
        return view('instansi.homeInstansi', $data);
    }

    public function index_post(Request $request)
    {
        // bagian ini berfungsi untuk membuat data pelayanan baru
        $get_data = [
            'id_instansi' => $request->id_instansi,
            'id_jenis_pelayanan' => $request->jenis_pelayanan,
            'created_at' => date("Y-m-d H:i:s")
        ];
        DB::table('tb_transaksi_pelayanan')->insert($get_data);
        $id = DB::table('tb_transaksi_pelayanan')->max('id');
        return redirect('/instansi/tambahData/' . $id);
    }

    public function tambahData($id)
    {
        // fungsi ini menampilkan data dari pelayanan yang dipilih oleh instansi
        // tabel dibawah merupakan left join dari beberapa tabel transaksi_pelayanan berdasarkan id nya
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

        // sedangkan tabel dibawah ini untuk menampilkan list siswa dan jenis pelayanan
        $data['siswa'] = DB::table('tb_siswa')
            ->selectRaw('tb_siswa.*,
                    tb_text_status.style as style,
                    tb_text_status.text as text')
            ->leftJoin('tb_text_status', 'tb_text_status.id_status', '=', 'tb_siswa.id_status')
            ->where([['tb_siswa.is_deleted', 1], ['tb_siswa.id_pelayanan', $id]])->get();
        $data['jenis_pelayanan'] = DB::table('tb_jenis_pelayanan')->where('is_deleted', 1)->get();
        // print_r($data['instansi']);
        return view('instansi.tambahData', $data);
        return response()->json($data);
    }
    public function tambahData_post(Request $request)
    {
        // fungsi ini dipakai untuk melakukan perubahan data untuk menambahkan nilai dari durasi pelayanan serta biaya
        // output dari fungsi ini berupa pemberian nilai berdasarkan inputan instansi pada jumlah peserta, durasi, serta total biaya

        $jumlah_pelayan = $request->jumlah_pelayanan;
        $durasi_pelayanan = $request->durasi_pelayanan;
        $biaya_orang = $request->biaya_orang;
        $satuan_waktu = $request->satuan_waktu;
        $id = $request->id_instansi;
        $get_data = [
            'durasi_pelayanan' => $durasi_pelayanan,
            'jumlah_pelayanan' => $jumlah_pelayan,
            'total_biaya_pelayanan' => $durasi_pelayanan * $biaya_orang * $jumlah_pelayan,
            'tanggal_mulai' => date("Y-m-d H:i:s", strtotime($request->min)), 
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        // $durasi_pelayanan = '+'.$durasi_pelayanan.' week';
        echo ($durasi_pelayanan);
        if ($satuan_waktu == "minggu") {
            $get_data = array_merge($get_data, array('tanggal_selesai' =>  date("Y-m-d H:i:s", strtotime($request->min.'+'.$durasi_pelayanan.' week'))));
            
        } elseif ($satuan_waktu == "bulan") {
            $get_data = array_merge($get_data, array('tanggal_selesai' =>  date("Y-m-d H:i:s", strtotime($request->min.'+'.$durasi_pelayanan.' month'))));

        } elseif ($satuan_waktu == "hari"){
            $get_data = array_merge($get_data, array('tanggal_selesai' =>  date("Y-m-d H:i:s", strtotime($request->min.'+'.$durasi_pelayanan.' day'))));

        }
        // print_r($get_data);
        DB::table('tb_transaksi_pelayanan')->where('id', $id)->update($get_data);
        // $id_move = DB::table('tb_transaksi_pelayanan')->max('id');
        return redirect('/instansi/tambahData/' .  $id);
    }


    public function tambahSiswa_post(Request $request)
    {
        // fungsi ini dipakai untuk menambahkan peserta berdasarkan inputan dari instansi, hasil output dari proses ini adalah penambahan data pada
        // tabel tb_transaksi_pelayanan untuk Jumlah Pendaftar serta penambahan peserta pada tb_siswa
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
        $cond = DB::table('tb_siswa')->where([['id_pelayanan', $id], ['nomor_induk', $nomor_induk]])->first();
        if ($cond != null) {
            // echo( $cond->nomor_induk);
            return redirect('/instansi/tambahData/' . $id)->with('alert-notif', 'ID sudah terdaftar');
        }

        // $get_data = $this->doc_input($request->doc1, $get_data, 1);
        // $get_data = $this->doc_input($request->doc2, $get_data, 2);
        $get_data =  $this->doc_input($request->doc3_insert, $get_data, 3);
        $get_data =  $this->doc_input($request->doc4_insert, $get_data, 4);
        $get_data =  $this->doc_input($request->doc5_insert, $get_data, 5);
        DB::table('tb_transaksi_pelayanan')->where('id', $id)->increment('jumlah_pelayanan', 1);
        DB::table('tb_siswa')->insert($get_data);
        // print_r($get_data);
        $data['intansi'] = DB::table('tb_transaksi_pelayanan')->where([['is_deleted', 1], ['id', $id]])->first();
        $data['jenis_pelayanan'] = DB::table('tb_jenis_pelayanan')->where([['is_deleted', 1], ['id',  $data['intansi']->id_jenis_pelayanan]])->first();


        DB::table('tb_transaksi_pelayanan')->where('id', $id)->update(['total_biaya_pelayanan' => ($data['intansi']->durasi_pelayanan * $data['intansi']->jumlah_pelayanan * $data['jenis_pelayanan']->biaya)]);


        $this->tambahData_post($request);
        return redirect('/instansi/tambahData/' . $id);
    }

    public function bayar(Request $request)
    {
        // fungsi ini dipakai untuk menginputkan data transfer untuk rs berupa transfer bank atau dompet digital
        // dari proses ini akan menyimpan beberapa data serta foto dari invoice yang dikirimkan instansi
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

    // Tidak perlu diinputkan di laporan
    public function doc_input($data, $get_data, $i)
    {
        // berfungsi sebagai fungsi tambahan untuk input dikumen
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
        // Berfungsi mencetak invoice satelah admin menyetuji pendaftaran peserta pada suatu jenis pelayanan oleh instansi
        // output berupa pdf yang berisi detail pelayanan dan siswa
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
        $customPaper = array(0, 0, 1100, 750);
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
        // Menghapus siswa jika dianggap tidak sesuai
        $id_hapus = $request->id_hapus;
        $id_data = $request->id_inst;
        DB::table('tb_transaksi_pelayanan')->where('id', $id_data)->decrement('jumlah_pelayanan', 1);
        DB::table('tb_siswa')->where('id', $id_hapus)->update(['is_deleted' => 0]);
        // echo($id_hapus."    ".$id_data);

        // if ( $id_data == 10006) {
        // }
        $data['intansi'] = DB::table('tb_transaksi_pelayanan')->where([['is_deleted', 1], ['id', $id_data]])->first();
        $data['jenis_pelayanan'] = DB::table('tb_jenis_pelayanan')->where([['is_deleted', 1], ['id',  $data['intansi']->id_jenis_pelayanan]])->first();
        // print_r( $data['intansi']);

        DB::table('tb_transaksi_pelayanan')->where('id', $id_data)->update(['total_biaya_pelayanan' => ($data['intansi']->durasi_pelayanan * $data['intansi']->jumlah_pelayanan * $data['jenis_pelayanan']->biaya)]);



        return redirect('/instansi/tambahData/' . $id_data);
    }

    public function find_data($id)
    {
        $data['data'] = DB::table('tb_siswa')->where('id', $id)->first();
        return response()->json($data);
    }

    public function tambahSiswa_update(Request $request)
    {
        // Menghapus siswa jika dianggap tidak sesuai

        $id = $request->id_siswa_update;
        $nama_siswa = $request->nama_siswa_update;
        $nomor_induk = $request->nomor_induk_update;
        $alamat = $request->alamat_update;
        $jenis_kelamin = $request->jenis_kelamin_update;
        $id_ins = $request->id_ins_update;
        $get_data = [
            'nama_siswa' => $nama_siswa,
            'nomor_induk' => $nomor_induk,
            'alamat' => $alamat,
            'jenis_kelamin' => $jenis_kelamin,
            'created_at' => date("Y-m-d H:i:s"),
            'id_status' => ''
        ];
        $cond = DB::table('tb_siswa')->where([['id_pelayanan', $id_ins], ['nomor_induk', $nomor_induk]])->count();
        if ($cond > 1) {
            // echo( $cond->nomor_induk);
            return redirect('/instansi/tambahData/' . $id_ins)->with('alert-notif', 'ID sudah terdaftar');
        }

        // $get_data = $this->doc_input($request->doc1_update, $get_data, 1);
        // $get_data = $this->doc_input($request->doc2_update, $get_data, 2);
        $get_data =  $this->doc_input($request->doc3_update, $get_data, 3);
        $get_data =  $this->doc_input($request->doc4_update, $get_data, 4);
        $get_data =  $this->doc_input($request->doc5_update, $get_data, 5);
        DB::table('tb_siswa')->where('id', $id)->update($get_data);
        // print_r($get_data);
        // echo ($cond);
        return redirect('/instansi/tambahData/' . $id_ins);
    }

    public function hapus_pelayanan(Request $request)
    {
        // Menghapus pelayanan oleh instansi jika dianggap tidak dipakai
        $id_hapus = $request->id_hapus;

        DB::table('tb_transaksi_pelayanan')->where('id', $id_hapus)->update(['is_deleted' => 0]);

        return redirect('/instansi');
    }

    public function profileInstansi()
    {
        // FUngsi ini berguna untuk menampilkan data dari user instansi yang akan ditampilkan pada halaman profileInstansi
        $data['instansi'] = DB::table('tb_instansi')->where('username', session()->get('username'))->first();
        return view('instansi.profileInstansi', $data);
    }

    public function profileInstansi_post(Request $request)
    {
        // Fungsi post yang dilakukan untuk melakukan perubahan pada dua hal, yakni password serta gambar sesuai id dari user instansi tersebut
        $password = $request->password;
        $id = $request->id;
        $get_data = [];
        try {
            $name_img =  $request->gambar->getClientOriginalName();
        } catch (\Throwable $th) {
            $name_img = "";
        }
        if (!empty($name_img)) {
            $img_loc = "/storage/image/" . $this->location . "/";
            $img_save = "/public/image/" . $this->location . "/";

            $request->gambar->storeAs($img_save, $name_img);
            $get_data = array_merge($get_data, array('gambar_instansi' =>  $img_loc . $name_img));
        }
        if ($password != null) {
            $get_data = array_merge($get_data, array('password' =>  md5($password)));
        }
        // print_r($get_data);
        // echo ($id);
        if ($get_data != null) {
            DB::table('tb_instansi')->where('id', $id)->update($get_data);
        }

        return redirect('/profileInstansi');
    }
}
