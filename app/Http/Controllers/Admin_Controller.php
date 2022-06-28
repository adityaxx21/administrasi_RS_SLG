<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin_Controller extends Controller
{
    var $location = "admin";
    public function index(Request $request)
    {
        $data['instansi'] = DB::table('tb_instansi')->where('is_deleted',1)->get();
        return view('admin.homeAdmin',$data);
    }
    // Tambah Data
    public function tambah_data(Request $request)
    {
        $get_data = [
            'nama_pendaftar'=>$request->nama_pendaftar,
            'nama_instansi'=>$request->nama_instansi,
            'alamat_instansi'=>$request->alamat_instansi,
            'username'=>$request->username_instansi,
            'email'=>$request->email_instansi,
            'password'=>$request->password_instansi,
            'role'=>$request->jenis_instansi,
            'created_at'=>$request->date("Y-m-d H:i:s"),
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
        // print_r($get_data);
        DB::table('tb_instansi')->insert($get_data);
        return redirect('/admin');
    }
    // Update Data
    public function update_data(Request $request,$get)
    {
        $get_data = [
            'nama_pendaftar'=>$request->nama_pendaftar,
            'nama_instansi'=>$request->nama_instansi,
            'alamat_instansi'=>$request->alamat_instansi,
            'username'=>$request->username_instansi,
            'email'=>$request->email_instansi,
            'password'=>$request->password_instansi,
            'role'=>$request->jenis_instansi,
            'created_at'=>$request->date("Y-m-d H:i:s"),
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
        // print_r($get_data);
        DB::table('tb_instansi')->insert($get_data);
        return redirect('/admin');
    }
    // Cari Data
    public function find_data($id)
    {
        $data['data'] = DB::table('tb_instansi')->where([['id', $id], ['is_deleted', 1]])->first();
        return Response()->json($data);
    }
}
