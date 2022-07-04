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
        // print_r($get_data);
        DB::table('tb_instansi')->insert($get_data);
        return redirect('/admin');
    }
    // Update Data
    public function update_data(Request $request)
    {
        if (session()->get('username') == "") {
            return redirect('/login')->with('alert-notif', 'Anda Harus Login Terlebih Dahulu');
        }
        $id =  $request->id_data;
        $password = $request->password_instansi_update;
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
            $get_data = array_merge($get_data, ['password_update' => md5($password)]);
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
        // print_r($get_data);
        // echo($id);
        DB::table('tb_instansi')->where('id',$id)->update($get_data);
        return redirect('/admin');
    }
    // Cari Data
    public function find_data($id)
    {
        $data['data'] = DB::table('tb_instansi')->where([['id', $id], ['is_deleted', 1]])->first();
        
        return Response()->json($data);
    }
    public function delete_instansi(Request $request)
    {
        DB::table('tb_instansi')->where('id',$request->id_hapus)->update(['is_deleted'=>0]);
        return redirect('/admin');
    }
}
