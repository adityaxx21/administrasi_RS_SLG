@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail  Pelayanan</h1>


        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4" style="padding: 10px">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail  Pelayanan</h6>
            </div>

            <table style="margin: 10px">
                <thead>

                </thead>
                <tbody style="text-align: left">
                    <tr>
                        <td style="width:20%">
                            <h4>Nama Pendaftar </h4>
                        </td>
                        <td>
                            <h4>: {{ $instansi->nama_pendaftar }}</h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:20%">
                            <h4>Nama Instansi
                        </td>
                        <td>
                            <h4>: {{ $instansi->nama_instansi }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:20%">
                            <h4>Jenis Pelayanan
                        </td>
                        <td>
                            <h4>: {{ $instansi->jenis_pelayanan }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:20%">
                            <h4>Durasi Pelayanan
                        </td>
                        <td>
                            <h4>: {{ $instansi->durasi_pelayanan }} {{ $instansi->satuan_waktu }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:20%">
                            <h4>Jumlah Pelayanan
                        </td>
                        <td>
                            <h4>: {{ $instansi->jumlah_pelayanan }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:20%">
                            <h4>Total Biaya Pelayanan
                        </td>
                        <td>
                            <h4>: Rp. {{ $instansi->total_biaya_pelayanan }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:20%">
                            <h4>Kode Pembayaran
                        </td>
                        <td>
                            <h4>: {{ $instansi->kode_pembayaran }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:20%">
                            <h4>Metode Pembayaran
                        </td>
                        <td>
                            <h4>: {{ $instansi->metode_pembayaran }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width:20%">
                            <h4>Bukti Pembayaran : </h4>
                        </td>
                        <td> <img src="{{ URL::asset($instansi->bukti_pembayaran) }}" alt="" srcset=""> </td>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $item)
                            <tr>
                                <th>{{ $item->nama_siswa }}</th>
                                <th>{{ $item->nomor_induk }}</th>
                                <th>{{ $item->jenis_kelamin }}</th>
                                <th><button type="button" class="btn btn-success trgt_download"
                                        onclick="download('{{$item->berkas1}}')" {{$item->berkas1 == null ? "hidden" : ""}}><i class="fas fa-file fa-sm "></i>
                                    </button> </th>
                                <th><button type="button" class="btn btn-success"
                                    onclick="download('{{$item->berkas2}}')" {{$item->berkas2 == null ? "hidden" : ""}}><i class="fas fa-file fa-sm "></i>
                                    </button> </th>
                                <th><button type="button" class="btn btn-success"
                                        onclick="download('{{$item->berkas3}}')" {{$item->berkas3 == null ? "hidden" : ""}}><i class="fas fa-file fa-sm "></i>
                                    </button> </th>
                                    <th><button type="button" class="btn btn-success"
                                        onclick="download('{{$item->berkas4}}')" {{$item->berkas4 == null ? "hidden" : ""}}><i class="fas fa-file fa-sm "></i>
                                    </button> </th>
                                    <th><button type="button" class="btn btn-success"
                                        onclick="download('{{$item->berkas5}}')" {{$item->berkas5 == null ? "hidden" : ""}}><i class="fas fa-file fa-sm "></i>
                                    </button> </th>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
                </table>
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
            function reject_form(id) {
                $('#id_data').val(id);
                $('#status').val(3);
                alert($('#status').val());
                $('#submit_it').submit();
            }
        </script>
    </div>
@endsection
