@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                onclick=" $('#tambahData').modal('show');"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah
                Pelayanan</button>


        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Instansi</h6>
            </div>
            <style>
                .dataTables_filter {
                    text-align: right;
                }
            </style>
            <div class="card-body">
                <!-- Vertically centered modal -->
                {{-- Input Data --}}
                <div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataTitle"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width:50%">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pelayanan</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form class="modal-body" method="POST" id="add_data" action="/kelolaPelayanan_post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="id_data" name="id_data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jenis Pelayanan</label>
                                    <input type="text" class="form-control" id="jenis_pelayanan" name="jenis_pelayanan"
                                        aria-describedby="emailHelp" placeholder="Masukan Jenis Pelayanan">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Biaya</label>
                                    <input type="text" class="form-control" id="biaya" name="biaya"
                                        aria-describedby="emailHelp" placeholder="Masukan Biaya">
                                </div>
                                <div class="input-group mb-3">
                                    <select class="custom-select" id="satuan_waktu" name="satuan_waktu">
                                            <option value="minggu">minggu</option>
                                            <option value="bulan">bulan</option>
                                            <option value="hari">hari</option>
                                    </select>
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="inputGroupSelect02">Options</label>
                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" onclick="$('#add_data').submit()">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Update Data --}}
                <div class="modal fade" id="updateData" tabindex="-1" aria-labelledby="updateDataTitle"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width:50%">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ubbah Data Pelayanan</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form id="update_form" method="POST" action="/kelolaPelayanan_update" enctype="multipart/form-data"
                                style="
                            margin: 20px;">
                                @csrf
                                <input type="hidden" id="id_data_update" name="id_data_update">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jenis Pelayanan</label>
                                    <input type="text" class="form-control" id="jenis_pelayanan_update" name="jenis_pelayanan_update"
                                        aria-describedby="emailHelp" placeholder="Masukan Jenis Pelayanan">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Biaya</label>
                                    <input type="text" class="form-control" id="biaya_update" name="biaya_update"
                                        aria-describedby="emailHelp" placeholder="Masukan Biaya">
                                </div>
                                <div class="input-group mb-3">
                                    <select class="custom-select" id="satuan_waktu_update" name="satuan_waktu_update">
                                            <option value="minggu">minggu</option>
                                            <option value="bulan">bulan</option>
                                            <option value="hari">hari</option>
                                    </select>
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="inputGroupSelect02">Options</label>
                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" onclick="$('#update_form').submit()">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive" style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Jenis</th>
                                <th>Biaya</th>
                                <th>Satuan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelayanan as $item)
                                <tr>
                                    {{-- <th><img src="{{asset($item->gambar_instansi)}}" alt="" srcset=""></th> --}}
                                    <th>{{ $item->id }}</th>
                                    <th>{{ $item->jenis_pelayanan }}</th>
                                    <th>{{ $item->satuan_waktu }}</th>
                                    <th>{{ $item->biaya }}</th>

                                    <th>
                                        <button type="button" class="btn btn-warning"
                                            onclick="get_data({{ $item->id }})"><i
                                                class="fas fa-file fa-sm "></i> Update
                                        </button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="remove({{ $item->id }})"><i
                                                class="fas fa-ban fa-sm "></i> delete
                                        </button>
                                        
                                    </th>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <form action="/kelolaPelayanan_delete" method="post" id="hapus">
                        @csrf
                        <input type="hidden" id="id_hapus" name="id_hapus">
                    </form>
                </div>
            </div>
        </div>
        <script>
            var id_data;
            var role;
            var gambar;

            function input_gb(i, id) {
                gambar = $('#' + id).val().replace(/C:\\fakepath\\/i, '')
                $("#change_name" + i).html(gambar);
            }

            function get_data(id) {
                id_data = id;

                $('#updateData').modal('show');
                $.ajax({
                    type: 'GET',
                    url: "/kelolaPelayanan_detail/" + id,
                    success: function(data) {

                        if ($.isEmptyObject(data.error)) {
                            // alert("HEllo");
                            $('#id_data_update').val(id);
                            $('#biaya_update').val(data.data.biaya);
                            $('#satuan_waktu_update').val(data.data.satuan_waktu);
                            $('#jenis_pelayanan_update').val(data.data.jenis_pelayanan);
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });
            }

            function remove(id) {
                $('#id_hapus').val(id);
                $('#hapus').submit();
            }
        </script>
    </div>
@endsection
