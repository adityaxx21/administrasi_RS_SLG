@extends('instansi.layout')
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
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Instansi</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <script>
                                var biaya;
                                var satuan_waktu
                            </script>
                            <form class="modal-body" method="POST" id="add_data" action="/instansi"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="id_instansi" name="id_instansi"
                                    value="{{$data_instansi->id }}">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Jenis</label>
                                    <div class="input-group mb-3">
                                        <select class="custom-select" id="jenis_pelayanan" name="jenis_pelayanan"
                                            onchange="input_data($('#jenis_pelayanan').val())">
                                            @foreach ($jenis_pelayanan as $key => $item)
                                                <option value="{{ $item->id }}">{{ $item->jenis_pelayanan }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="inputGroupSelect02">Options</label>
                                        </div>
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

                <div class="table-responsive" style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Jenis Pelayanan</th>
                                <th>Jumlah Pelayanan</th>
                                <th>Total Biaya Pelayanan</th>
                                <th>Nota</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instansi as $item)
                                <tr>
                                    <th>{{$item->id}}</th>
                                    <th>{{ $item->jenis_pelayanan }}</th>
                                    <th>{{ $item->jumlah_pelayanan }}</th>
                                    <th>{{ $item->total_biaya_pelayanan }}</th>
                                    <th>
                                        @if ($item->id_status_pembayaran == 0)
                                            <button type="button" class="btn btn-success"
                                                onclick="window.open('invoice/{{ $item->id }}','_blank' )"><i
                                                    class="fas fa-file fa-sm "></i>
                                            </button>
                                        @endif
                                    </th>
                                    <th><span class="{{ $item->style }}">{{ $item->text }}</span> </th>

                                    <th>
                                        {{-- <button type="button" class="btn btn-success"
                                            onclick="success_form({{ $item->id }})"
                                            {{ $item->id_status_pembayaran != 1 ? 'disabled' : '' }}><i
                                                class="fas fa-check fa-sm "></i>
                                            Bayar</button> --}}
                                        <button type="button" class="btn btn-warning"
                                            onclick="location.replace('/instansi/tambahData/'+{{$item->id}})" {{ $item->id_status_pembayaran != 0 && $item->id_status_pembayaran != 2 ? '' : 'disabled' }}><i class="fas fa-edit fa-sm "></i>
                                            Update</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="reject_form({{ $item->id }})"
                                            {{ $item->id_status_pembayaran != 0 && $item->id_status_pembayaran != 2 ? '' : 'disabled' }}><i
                                                class="fas fa-ban fa-sm "></i>
                                            Hapus</button>
                                    </th>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
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
                    url: "/find_data/" + id,
                    success: function(data) {

                        if ($.isEmptyObject(data.error)) {
                            // alert(data.data.owner);
                            $('#id_data').val(id);
                            $('#nama_pendaftar_update').val(data.data.nama_pendaftar);
                            $('#nama_instansi_update').val(data.data.nama_instansi);
                            $('#alamat_instansi_update').val(data.data.alamat_instansi);
                            $('#email_update').val(data.data.email);
                            $('#username_update').val(data.data.username);
                            $('#jenis_instansi_update').val(data.data.role)
                            // $('#'+data.data.role).attr('selected');
                            // role = data.data.role;


                            // $('#jenis_instansi_update option:eq(1)');
                            // const text = data.data.role;
                            // const $select = document.querySelector('#jenis_instansi_update');
                            // const $options = Array.from($select.options);
                            // const optionToSelect = $options.find(item => item.text === text);
                            // $select.value = optionToSelect.value;
                            // alert(role);
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });
            }
        </script>
    </div>
@endsection
