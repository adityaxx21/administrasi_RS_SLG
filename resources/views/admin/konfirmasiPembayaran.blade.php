@extends('admin.layout')
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
                <!-- Vertically centered modal -->
                {{-- Input Data --}}
                {{-- Update Data --}}
   
                <div>
                    
                </div>
                <div class="table-responsive" style="text-overflow:ellipsis;white-space:nowrap;">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <div>
                           
                        </div>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama Pendaftar</th>
                                <th>Instansi</th>
                                <th>Jenis Pelayanan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instansi as $item)
                                <tr>
                                    
                                    <th>{{ $item->id }}</th>
                                    <th>{{ $item->nama_pendaftar }}</th>
                                    <th>{{ $item->nama_instansi }}</th>
                                    <th>{{ $item->jenis_pelayanan }}</th>
                                    <th><span class="{{$item->style}}">{{$item->text}}</span>  </th>
                                    <th>
                                        <button type="button" class="btn btn-success"
                                            onclick="success_form({{$item->id}})" {{$item->id_status_pembayaran == 0 || $item->id_status_pembayaran == 3 ? 'disabled' : ""}}><i class="fas fa-check fa-sm "></i>
                                            Setujui</button> 
                                        <button type="button" class="btn btn-warning"
                                            onclick="window.open('/konfirmasi_pembayaran/detail/'+{{$item->id}}, '_blank');"><i class="fas fa-edit fa-sm "></i>
                                            Detail</button>         
                                        <button type="button" class="btn btn-danger"
                                            onclick="reject_form({{$item->id}})" {{$item->id_status_pembayaran == 0 || $item->id_status_pembayaran == 3 ? 'disabled' : ""}}><i class="fas fa-ban fa-sm "></i>
                                            Tolak</button>
                                    </th>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    </table>
                </div>
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
            var gambar ;
            function input_gb(i,id) {
                gambar = $('#'+id).val().replace(/C:\\fakepath\\/i, '')
                $("#change_name" + i).html(gambar);
            }

            function success_form(id) {
                $('#id_data').val(id);
                $('#status').val(0);
                $('#submit_it').submit();
            }
            function reject_form(id) {
                $('#id_data').val(id);
                $('#status').val(3);
                alert($('#status').val());
                $('#submit_it').submit();
            }
        </script>
    </div>
@endsection
