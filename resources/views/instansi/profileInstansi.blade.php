@extends('instansi.layout')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Instansi</h1>


        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profile Instansi</h6>
            </div>
            <style>
                .dataTables_filter {
                    text-align: right;
                }
            </style>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{URL::asset($instansi->gambar_instansi)}}" alt="Card image cap">
                            <div class="card-body text-center">
                              <button onclick="$('#gambar').trigger('click'); " class="btn btn-primary">Ubah Gambar</button>
                            </div>
                          </div>
                    </div>
                    <div class="col">
                        <form action="profileInstansi_post" id="update_data" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{$instansi->id}}">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text  bg-primary text-white" style="width:200px" id="basic-addon1">Nama
                                        Pendaftar</span>
                                </div>
                                <input type="text" id="nama_pendaftar" name="nama_pendaftar" class="form-control" value="{{$instansi->nama_pendaftar}}" aria-describedby="basic-addon1" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text  bg-primary text-white" style="width:200px" id="basic-addon1">Nama Instansi</span>
                                </div>
                                <input type="text"  id="nama_instansi" name="nama_instansi" class="form-control" value="{{$instansi->nama_instansi}}" placeholder="TNA" aria-describedby="basic-addon1" value="{{$instansi->nama_pendaftar}}" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white h-50" style="width:200px"
                                        id="basic-addon1">Alamat Instansi</span>
                                </div>
                                <textarea type="text" id="alamat_instansi" name="alamat_instansi" class="form-control"  placeholder="TNA" aria-describedby="basic-addon1" readonly> {{$instansi->alamat_instansi}} </textarea>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text  bg-primary text-white" style="width:200px" id="basic-addon1">Username</span>
                                </div>
                                <input type="text" class="form-control" id="username" name="username" value="{{$instansi->username}}" placeholder="TNA" aria-describedby="basic-addon1" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text  bg-primary text-white" style="width:200px" id="basic-addon1">Email</span>
                                </div>
                                <input type="text" class="form-control" name="email" id="email" value="{{$instansi->email}}" placeholder="TNA" aria-describedby="basic-addon1" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text  bg-primary text-white" style="width:200px" id="basic-addon1">Password</span>
                                </div>
                                <input type="password" class="form-control" name="password"  id="password" placeholder="Kosongkan Jika TIdak Ingin Mengganti Password" aria-describedby="basic-addon1">
                            </div>
                            <input id="gambar" name="gambar" type="file" accept="image/*"  hidden>
                        </form>
                        
                    </div>
                </div>
                
                <div style="text-align: right">
                    <button class="btn btn-primary" onclick="$('#update_data').submit()">Save</button>
                </div>

            </div>
        </div>
    </div>
@endsection
