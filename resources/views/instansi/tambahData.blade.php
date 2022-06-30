@extends('instansi.layout')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Transaiksi Pelayanan</h1>


        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4" style="padding: 10px">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Home</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Profile</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                        aria-controls="contact" aria-selected="false">Contact</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card shadow mb-4" style="padding: 10px">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Transaiksi Pelayanan</h6>
                    </div>
                    <form class="modal-body" method="POST" id="add_data" action="/instansi/tambahData"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id_instansi" name="id_instansi" value="{{ $instansi->id_instansi }}">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jenis</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" id="jenis_pelayanan" name="jenis_pelayanan"
                                    onchange="input_data($('#jenis_pelayanan').val())">
                                    @foreach ($jenis_pelayanan as $key => $item)
                                        <option value="{{ $item->id }}"
                                            {{ $instansi->id_jenis_pelayanan == $item->id ? 'Selected' : '' }}>
                                            {{ $item->jenis_pelayanan }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <label class="input-group-text" for="inputGroupSelect02">Options</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Durasi Pelayanan</label>
                                        <input type="text" class="form-control" id="nama_pendaftar_update"
                                            name="nama_pendaftar_update" aria-describedby="emailHelp"
                                            placeholder="Masukan Nama Pendaftar" value="{{ $instansi->nama_pendaftar }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Satuan Waktu</label>
                                        <input type="text" class="form-control" id="nama_pendaftar_update"
                                            name="nama_pendaftar_update" aria-describedby="emailHelp"
                                            placeholder="Masukan Nama Pendaftar" value=" {{ $instansi->nama_instansi }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Biaya Per Orang</label>
                                        <input type="text" class="form-control" id="nama_pendaftar_update"
                                            name="nama_pendaftar_update" aria-describedby="emailHelp"
                                            placeholder="Masukan Nama Pendaftar" value=" {{ $instansi->nama_instansi }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Pendaftar</label>
                                        <input type="text" class="form-control" id="nama_pendaftar_update"
                                            name="nama_pendaftar_update" aria-describedby="emailHelp"
                                            placeholder="Masukan Nama Pendaftar" value="{{ $instansi->nama_pendaftar }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Instansi</label>
                                        <input type="text" class="form-control" id="nama_pendaftar_update"
                                            name="nama_pendaftar_update" aria-describedby="emailHelp"
                                            placeholder="Masukan Nama Pendaftar" value=" {{ $instansi->nama_instansi }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header py-3" style="margin-bottom: 10px">
                                <div class="row">
                                    <div class="col">
                                    
                                    </div>
                                    <div class="col text-right"> 
                                        <button class="d-none d-sm-inline-block btn btn-sm btn-white shadow-sm"
                                            onclick="location.replace('/instansi');"><i class="fas fa-arrow-left fa-sm "></i> Kembali </button>
                                            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                            onclick=" $('#tambahData').modal('show');"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Siswa</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card shadow mb-4" style="padding: 10px">

                        <div class="card-header py-3" style="margin-bottom: 10px">
                            <div class="row">
                                <div class="col">
                                    <h6 class="m-0 font-weight-bold text-primary" style="margin: 10px">Detail Siswa</h6>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive" style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;">

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <div>

                                </div>
                                <thead>
                                    <tr>
                                        <th>Nama Pendaftar</th>
                                        <th>Nomor Induk</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Berkas 1</th>
                                        <th>Berkas 2</th>
                                        <th>Berkas 3</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $item)
                                        <tr>
                                            <th>{{ $item->nama_siswa }}</th>
                                            <th>{{ $item->nomor_induk }}</th>
                                            <th>{{ $item->jenis_kelamin }}</th>
                                            <th><button type="button" class="btn btn-success"
                                                    onclick="success_form({{ $item->id }})"><i
                                                        class="fas fa-file fa-sm "></i>
                                                </button> </th>
                                            <th><button type="button" class="btn btn-success"
                                                    onclick="success_form({{ $item->id }})"><i
                                                        class="fas fa-file fa-sm "></i>
                                                </button> </th>
                                            <th><button type="button" class="btn btn-success"
                                                    onclick="success_form({{ $item->id }})"><i
                                                        class="fas fa-file fa-sm "></i>
                                                </button> </th>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                        </div>
                        <div class="card-header py-3" style="margin-bottom: 10px">
                            <div class="row">
                                <div class="col">
                                
                                </div>
                                <div class="col text-right"> 
                                    <button class="d-none d-sm-inline-block btn btn-sm btn-white shadow-sm"
                                        onclick="location.replace('/instansi');"><i class="fas fa-arrow-left fa-sm "></i> Kembali </button>
                                        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                        onclick=" $('#tambahData').modal('show');"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Siswa</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>



        </div>

        
        <style>
            .dataTables_filter {
                text-align: right;
            }
        </style>
        <div class="card-body">

        </div>
        <form id="submit_it" action="/konfirmasi_pembayaran" hidden method="post">
            @csrf
            <input type="text" id="id_data" name="id_data">
            <input type="text" id="status" name="status">
        </form>
    </div>
    <script>
        var id_data;
        var role;
        var gambar;

        function input_gb(i, id) {
            gambar = $('#' + id).val().replace(/C:\\fakepath\\/i, '')
            $("#change_name" + i).html(gambar);
        }

        // function success_form(id) {
        //     $('#id_data').val(id);
        //     $('#status').val(0);
        //     $('#submit_it').submit();
        // }
        function reject_form(id) {
            $('#id_data').val(id);
            $('#status').val(3);
            alert($('#status').val());
            $('#submit_it').submit();
        }
    </script>
    </div>
@endsection
