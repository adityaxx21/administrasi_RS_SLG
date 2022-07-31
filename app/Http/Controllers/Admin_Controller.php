<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin_Controller extends Controller
{
    var $location = "admin";
    public function index(Request $request)
    {
        // Bagian ini berfungsi untuk menampilkan data - dat instansi serta pengambilan list role dari database
        $data['jenis'] =   DB::table('tb_role')->where([['is_deleted',1],['id','>','2000']])->get();
        $data['instansi'] = DB::table('tb_instansi')
        ->selectRaw('tb_instansi.*,
                    tb_role.role_nama as role_nama')
        ->leftJoin('tb_role','tb_role.id','tb_instansi.role')
        ->where('tb_instansi.is_deleted',1)->get();
        // print_r( $data['instansi']);
        return view('admin.homeAdmin',$data);
    }
    // Tambah Data
    public function tambah_data(Request $request)
    {
        // Bagian ini berfungsi untuk menambahkan data berupa modal yang dipanggil dari halaman admin untuk menambahkan instansi
        // yang nantinya data tersebut akan disimpan pada database
        $get_data = [
            'nama_pendaftar'=>$request->nama_pendaftar,
            'nama_instansi'=>$request->nama_instansi,
            'alamat_instansi'=>$request->alamat_instansi,
            'username'=>$request->username_instansi,
            'email'=>$request->email_instansi,
            'password'=>md5($request->password_instansi),
            'role'=>$request->jenis_instansi,
            'created_at'=>date("Y-m-d H:i:s"),
        ];
        
        try {
            $name_img =  $request->file('gambar_instansi')->getClientOriginalName();
        } catch (\Throwable $th) {
            $name_img = "";
        }
        if (!empty($name_img)) {
            $img_loc = "/storage/image/" . $this->location . "/";
            $img_save = "/public/image/" . $this->location . "/";

            $request->file('gambar_instansi')->storeAs($img_save, $name_img);
            $get_data = array_merge($get_data, array('gambar_instansi' =>  $img_loc . $name_img));
        }
        $get_data = $this->doc_input($request->doc1_insert, $get_data, 1);
        $get_data = $this->doc_input($request->doc2_insert, $get_data, 2);

        // print_r($get_data);
        DB::table('tb_instansi')->insert($get_data);
        return redirect('/admin');
    }
    // Update Data
    public function update_data(Request $request)
    {
        // Berfungsi untuk melakukan perubahan data pada instansi oleh admin berdasarkan dari id instansi tersebut
        if (session()->get('username') == "") {
            return redirect('/login')->with('alert-notif', 'Anda Harus Login Terlebih Dahulu');
        }
        $id =  $request->id_data;
        $password = $request->password_update;
        $get_data = [
            'nama_pendaftar'=>$request->nama_pendaftar_update,
            'nama_instansi'=>$request->nama_instansi_update,
            'alamat_instansi'=>$request->alamat_instansi_update,
            'username'=>$request->username_update,
            'email'=>$request->email_update,
            'role'=>$request->jenis_instansi_update,
            'updated_at'=>$request->date("Y-m-d H:i:s"),
        ];
        if ($password != null) {
            $get_data = array_merge($get_data, ['password' => md5($password)]);
        }
        try {
            $name_img =  $request->file('gambar_instansi_update')->getClientOriginalName();
        } catch (\Throwable $th) {
            $name_img = "";
        }
        if (!empty($name_img)) {
            $img_loc = "/storage/image/" . $this->location . "/";
            $img_save = "/public/image/" . $this->location . "/";

            $request->file('gambar_instansi_update')->storeAs($img_save, $name_img);
            $get_data = array_merge($get_data, array('gambar_instansi' =>  $img_loc . $name_img));
        }
        $get_data = $this->doc_input($request->doc1_update, $get_data, 1);
        $get_data = $this->doc_input($request->doc2_update, $get_data, 2);
        // print_r($get_data);
        // echo($id);
        DB::table('tb_instansi')->where('id',$id)->update($get_data);
        return redirect('/admin');
    }
    // Cari Data
    public function find_data($id)
    {
        // fitur berupa ajax dengan return berupa json yang dipakai untuk mempilkan data pada modal update data instansi
        $data['data'] = DB::table('tb_instansi')->where([['id', $id], ['is_deleted', 1]])->first();
        
        return Response()->json($data);
    }
    public function delete_instansi(Request $request)
    {
        // fungsi untuk menghapus data berdasarkan id pada table 
        DB::table('tb_instansi')->where('id',$request->id_hapus)->update(['is_deleted'=>0]);
        return redirect('/admin');
    }
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

    public function rekap_pelatihan(Request $request)
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

        return view('admin.rekapPelatihan', $data);
    }
}
