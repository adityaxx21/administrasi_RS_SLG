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
                    <form class="row" action="/laporanPelayanan" id="submit_it" method="get">
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

                <div class="table-responsive" style="text-overflow:ellipsis;white-space:nowrap;">

                    <table class="table table-bordered" id="laporan" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <td class="text-center">ID</td>
                                <td class="text-center">NAMA INSTANSI</td>
                                <td class="text-center">JENIS PELAYANAN</td>
                                <td class="text-right">DURASI PELAYANAN</td>
                                <td class="text-right">Jumlah Pendaftar</td>
                                <td class="text-right">TANGGAL PELAYANAN</td>
                                <td class="text-right">STATUS PEMBAYARAN</td>
                                <td class="text-right">TOTAL PEMBAYARAN</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelayanan as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama_instansi }}</td>
                                    <td>{{ $item->jenis_pelayanan }}</td>
                                    <td>{{ $item->durasi_pelayanan }} {{$item->satuan_waktu}}</td>
                                    <td>{{ $item->jumlah_pelayanan }}</td>
                                    <td>{{ date("d-m-Y", strtotime($item->updated_at))}}</td>
                                    <td><span class="{{$item->style}}">{{$item->text}}</span>  </td>
                                    <td>Rp. {{ $item->total_biaya_pelayanan }}</td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    </table>
                </div>
            </div>
        </div>
        <script>
            // var minDate, maxDate;

            // Custom filtering function which will search data in column four between two values
        </script>
    </div>
@endsection
