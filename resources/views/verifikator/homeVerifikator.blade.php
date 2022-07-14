@extends('verifikator.layout')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>


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
                <form class="row" action="/verifikasi" id="submit_it" method="get">
                    <div class="col">
                        <div class="form-group">
                            <label for="min" class="label-form">Tanggal Mulai</label>
                            <input id="min" name="min" class="date-picker form-control" placeholder="dd-mm-yyyy" type="date"
                                required="required" onfocus="this.type='date'" onclick="this.type='date'" onkeyup=""
                                name="min" value="{{$date}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="max" class="label-form">Tanggal Selesai</label>
                            <input id="max" name="max" class="date-picker form-control" placeholder="dd-mm-yyyy" type="date"
                                required="required" onfocus="this.type='date'" onclick="this.type='date'" onkeyup=""
                                name="max" value="{{$date_end}}">
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-group">
                        <label for="max" class="label-form">Search :</label>
                        <button type="button" class="btn btn-primary form-control" onclick="$('#submit_it').submit()"><i class="fas fa-search fa-sm "></i>
                        </button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive" style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Pegawai</th>
                                <th>Nomor Induk</th>
                                <th>Keperluan</th>
                                <th>Kasi</th>
                                <th>Kabid</th>
                                <th>Disposisi Kepegawaian</th>
                                <th>Berkas 1</th>
                                <th>Berkas 2</th>
                                <th>Berkas 3</th>
                                <th>Waktu Pelaksanaan</th>
                                <th></th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawai as $key => $item)
                                <tr>
                                    <th>{{ $item->nama }}</th>
                                    <th>{{ $item->nomor_induk }}</th>
                                    <th>{{ $item->keperluan }}</th>
                                    @foreach ($style as $value)
                                        @if ($item->verifikasi_1 == $value->id_status)
                                            <th> <span class="{{ $value->style }}">{{ $value->text }}</span> </th>
                                        @endif
                                        @if ($item->verifikasi_2 == $value->id_status)
                                            <th> <span class="{{ $value->style }}">{{ $value->text }}</span> </th>
                                        @endif
                                        @if ($item->verifikasi_3 == $value->id_status)
                                            <th> <span class="{{ $value->style }}">{{ $value->text }}</span> </th>
                                        @endif
                                    @endforeach
                                    <th>
                                        <button type="button" class="btn btn-success"
                                            onclick="window.open('{{ URL::asset($item->berkas1) }}', '_blank');"><i
                                                class="fas fa-file fa-sm "></i>
                                        </button>
                                    </th>
                                    <th>
                                        <button type="button" class="btn btn-success"
                                            onclick="window.open('{{ URL::asset($item->berkas2) }}', '_blank');"><i
                                                class="fas fa-file fa-sm "></i>
                                        </button>
                                    </th>
                                    <th>
                                        <button type="button" class="btn btn-success"
                                            onclick="window.open('{{ URL::asset($item->berkas3) }}', '_blank');"><i
                                                class="fas fa-file fa-sm "></i>
                                        </button>
                                    </th>
                                    <th>
                                        {{date('d-m-Y', strtotime($item->waktu_pelaksanaan))}}
                                    </th>
                                    <th>
                                        <button type="button" class="btn btn-success"
                                            onclick=" sumbit_it({{ $item->id }},10)"><i class="fas fa-edit fa-sm "></i>
                                            Setujui</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick=" sumbit_it({{ $item->id }},12)"><i class="fas fa-ban fa-sm "></i>
                                            Tolak</button>
                                    </th>


                                    {{-- <th>
                                        <button type="button" class="btn btn-success"
                                            onclick="success_form({{ $item->id }})"
                                            {{ $item->id_status_pembayaran != 1 ? 'disabled' : '' }}><i
                                                class="fas fa-check fa-sm "></i>
                                            Bayar</button>
                                        <button type="button" class="btn btn-warning"
                                            onclick="$('#updateData').modal('show');"><i class="fas fa-edit fa-sm "></i>
                                            Update</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="reject_form({{ $item->id }})"
                                            {{ $item->id_status_pembayaran != 1 ? 'disabled' : '' }}><i
                                                class="fas fa-ban fa-sm "></i>
                                            Hapus</button>
                                    </th> --}}
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataTitle" style="display: none;"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width:50%">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Instansi</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form class="modal-body" method="POST" id="add_data" action="/verifikasi_post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="verifikasi" id="verifikasi">
                            <input type="hidden" name="id_data" id="id_data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alasan Penolakan</label>
                                <input type="text" class="form-control" id="msg_fail" name="msg_fail"
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
        <script>
            function sumbit_it(id, status) {
                $('#verifikasi').val(status);
                $('#id_data').val(id);
                // alert($('#verifikasi').val());
                if (status == 12) {
                    $('#tambahData').modal('show');
                } else {
                    $('#add_data').submit()
                }
            }
        </script>
    </div>
@endsection
