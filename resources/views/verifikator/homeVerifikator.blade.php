@extends('verifikator.layout')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                onclick=" $('#tambahData').modal('show');"><i class="fas fa-plus fa-sm text-white-50"></i> Buat
                Permohonan</button>


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
                                            onclick="window.open('{{URL::asset($item->berkas1)}}', '_blank');"><i class="fas fa-file fa-sm "></i>
                                        </button>
                                    </th>
                                    <th>
                                        <button type="button" class="btn btn-success"
                                            onclick="window.open('{{URL::asset($item->berkas2)}}', '_blank');"><i class="fas fa-file fa-sm "></i>
                                        </button>
                                    </th>
                                    <th>
                                            <button type="button" class="btn btn-success"
                                                onclick=" sumbit_it({{ $item->id }},10)"><i
                                                    class="fas fa-edit fa-sm "></i>
                                                Setujui</button>
                                            <button type="button" class="btn btn-danger"
                                                onclick=" sumbit_it({{ $item->id }},12)"><i
                                                    class="fas fa-ban fa-sm "></i>
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
            <form action="/verifikasi_post" method="post" id="post_it" hidden>
                @csrf
                <input type="text" name="verifikasi" id="verifikasi" >
                <input type="text" name="id_data" id="id_data">
            </form>
        </div>
        <script>
            function sumbit_it(id, status) {
                $('#verifikasi').val(status);
                $('#id_data').val(id);
                // alert($('#verifikasi').val());
                $('#post_it').submit();       
            }
        </script>
    </div>
@endsection
