@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Pelayanan</h1>


        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4" style="padding: 10px">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Pelayanan</h6>
            </div>

            <table style="margin: 10px">
                <thead>

                </thead>
                <tbody style="text-align: left">
                    <br>
                    <tr>
                        <div class="row">
                            <div class="col-2">
                                <h4>Nama Pendaftar </h4>
                            </div>
                            <div class="col-8">
                                <h4>: {{ $instansi->nama_pendaftar }}</h4>
                            </div>
                        </div>
                    </tr>
                    <tr>
                        <div class="row">
                            <div class="col-2">
                                <h4>Nama Instansi</h4>
                            </div>
                            <div class="col-8">
                                <h4>: {{$instansi->nama_instansi }}</h4>
                            </div>
                        </div>
                    </tr>
                    <tr>
                        <div class="row">
                            <div class="col-2">
                                <h4>Jenis Pelayanan </h4>
                            </div>
                            <div class="col-8">
                                <h4>: {{$instansi->jenis_pelayanan  }}</h4>
                            </div>
                        </div>
                    </tr>
                    <tr>
                        <div class="row">
                            <div class="col-2">
                                <h4>Durasi Pelayanan</h4>
                            </div>
                            <div class="col-8">
                                <h4>:  {{ $instansi->durasi_pelayanan }} {{ $instansi->satuan_waktu }}</h4>
                            </div>
                        </div>
                    </tr>
                    <tr>
                        <div class="row">
                            <div class="col-2">
                                <h4>Jumlah Pendaftar </h4>
                            </div>
                            <div class="col-8">
                                <h4>: {{ $instansi->jumlah_pelayanan }}</h4>
                            </div>
                        </div>
                    </tr>
                    <tr>
                        <div class="row">
                            <div class="col-2">
                                <h4>Total Biaya Pelayanan</h4>
                            </div>
                            <div class="col-8">
                                <h4>: Rp. {{$instansi->total_biaya_pelayanan}} </h4>
                            </div>
                        </div>
                    </tr>
                    <tr>
                        <div class="row">
                            <div class="col-2">
                                <h4>Durasi Pelayanan</h4>
                            </div>
                            <div class="col-8">
                                <h4>:  {{ $instansi->durasi_pelayanan }} {{ $instansi->satuan_waktu }}</h4>
                            </div>
                        </div>
                    </tr>
                    <tr>
                        <div class="row">
                            <div class="col-2">
                                <h4>Bukti Pembayaran </h4>
                            </div>
                            <div class="col-8">
                           
                                <h4> :     <a class="btn btn-primary" href="{{ URL::asset($instansi->bukti_pembayaran) }}" target="_blank"><i class="fas fa-file fa-sm "></i> Lihat Gambar</a>
                            </div>
                        </div>
                    </tr>
                    
                </tbody>
            </table>
            <hr>
            <h3 class="m-0 font-weight-bold text-primary" style="margin: 10px">Tambah Data</h3>
            <div class="table-responsive" style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <div>

                    </div>
                    <thead>
                        <tr>
                            <th>Nama Peserta</th>
                            <th>Nomor Induk</th>
                            <th>Jenis Kelamin</th>
                            <th>Berkas 1</th>
                            <th>Berkas 2</th>
                            <th>Berkas 3</th>
                            <th>Berkas 4</th>
                            <th>Berkas 5</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $item)
                            <tr>
                                <th>{{ $item->nama_siswa }}</th>
                                <th>{{ $item->nomor_induk }}</th>
                                <th>{{ $item->jenis_kelamin }}</th>
                                <th><button type="button" class="btn btn-success trgt_download"
                                        onclick="download('{{ $item->berkas1 }}')"
                                        {{ $item->berkas1 == null ? 'hidden' : '' }}><i class="fas fa-file fa-sm "></i>
                                    </button> </th>
                                <th><button type="button" class="btn btn-success"
                                        onclick="download('{{ $item->berkas2 }}')"
                                        {{ $item->berkas2 == null ? 'hidden' : '' }}><i class="fas fa-file fa-sm "></i>
                                    </button> </th>
                                <th><button type="button" class="btn btn-success"
                                        onclick="download('{{ $item->berkas3 }}')"
                                        {{ $item->berkas3 == null ? 'hidden' : '' }}><i class="fas fa-file fa-sm "></i>
                                    </button> </th>
                                <th><button type="button" class="btn btn-success"
                                        onclick="download('{{ $item->berkas4 }}')"
                                        {{ $item->berkas4 == null ? 'hidden' : '' }}><i class="fas fa-file fa-sm "></i>
                                    </button> </th>
                                <th><button type="button" class="btn btn-success"
                                        onclick="download('{{ $item->berkas5 }}')"
                                        {{ $item->berkas5 == null ? 'hidden' : '' }}><i class="fas fa-file fa-sm "></i>
                                    </button> </th>
                                <th>
                                    @if ($item->id_status != null)
                                        <span
                                            class="{{ $item->style }}">{{ $item->text }}{{ ' ' . $item->msg_fail }}</span>
                                    @endif
                                </th>
                                <th>
                                    <button type="button" class="btn btn-danger"
                                        onclick="reject_form({{$item->id_pelayanan}},{{$item->id}})"><i
                                            class="fas fa-ban fa-sm "></i> Tolak
                                    </button>
                                </th>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
                </table>


                {{-- Hapus Siswa --}}
                <div class="modal fade" id="tolakPeserta" tabindex="-1" aria-labelledby="tolakPesertaTitle" style="display: none;"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width:50%">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Instansi</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form class="modal-body" method="POST" id="add_data" action="/tolakSIswa"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_pelayanan" id="id_pelayanan">
                            <input type="hidden" name="id_data" id="id_data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alasan Penolakan</label>
                                <input type="text" class="form-control" id="msg" name="msg"
                                    aria-describedby="emailHelp" placeholder="Alasan Penolakan">
                            </div>

                        </form>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" onclick="$('#add_data').submit()">Save</button>
                        </div>
                    </div>
                </div>
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
            function download(params) {
                window.open(params, '_blank');
            }

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
            function reject_form(id_pelayanan,id) {
                $('#id_pelayanan').val(id_pelayanan);
                $('#id_data').val(id);
                $('#tolakPeserta').modal('show');
            }
        </script>
    </div>
@endsection
