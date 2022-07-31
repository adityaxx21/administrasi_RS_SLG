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
                    <div class="col-4">
                        <div class="form-group">
                            <label for="min" class="label-form">Tanggal Mulai</label>
                            <input id="min" name="min" class="date-picker form-control" placeholder="dd-mm-yyyy"
                                type="date" required="required" onfocus="this.type='date'" onclick="this.type='date'"
                                onkeyup="" name="min" value="{{ $date }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="max" class="label-form">Tanggal Selesai</label>
                            <input id="max" name="max" class="date-picker form-control" placeholder="dd-mm-yyyy"
                                type="date" required="required" onfocus="this.type='date'" onclick="this.type='date'"
                                onkeyup="" name="max" value="{{ $date_end }}">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="max" class="label-form">Filter Stastus</label>
                            <select class="form-select form-control" name="status">
                                <option value="">[No Filter]</option>

                                @foreach ($status as $item)
                                    <option value="{{ $item->id_status }}" style="{{ $item->style }}"
                                        {{ $status_ == $item->id_status ? 'selected' : '' }}>{{ $item->text }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="form-group">
                            <label for="max" class="label-form">Search :</label>
                            <br>
                            <button type="button" class="btn btn-primary form-control"
                                onclick="$('#submit_it').submit()"><i class="fas fa-search fa-sm "></i>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive" style="text-overflow:ellipsis;white-space:nowrap;">

                    <table class="table table-bordered" id="laporan" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <td class="text-center">Id</td>
                                <td class="text-center">Nama Pegawai</td>
                                <td class="text-center">Penyelenggaraan Pelatihan</td>
                                <td class="text-center">Tema Pelatihan</td>
                                <td class="text-center">Waktu Pelaksanaan</td>
                                <td class="text-center">Narasumber</td>
                                <td class="text-center">Sasaran Pelatihan</td>
                                <td class="text-center">Nama Jabatan</td>
                                <td class="text-center">Jumlah Peserta</td>
                                <td class="text-center">Materi</td>
                                <td class="text-center">Indikator Kebutuhan</td>
                                <td class="text-center">Anggaran</td>
                                <td class="text-center">Periode Evaluasi</td>
                                <td class="text-center">Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawai as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{ $item->keperluan }}</td>
                                    <td>{{ $item->tema_pelatihan }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->waktu_pelaksanaan)) }}</td>
                                    <td>{{ $item->narasumber }}</td>
                                    <td>{{ $item->sasaran_pelatihan }}</td>
                                    <td>{{ $item->nama_jabatan }}</td>
                                    <td>{{ $item->jumlah_peserta }}</td>
                                    <td>{{ $item->materi }}</td>
                                    <td>{{ $item->indikator_kebutuhan }}</td>
                                    <td>Rp. {{ $item->anggaran }}</td>
                                    <td>{{ $item->periode_evaluasi }}</td>
                                    @foreach ($style as $value)
                                        @if ($item->verifikasi_3 == $value->id_status)
                                            @if ($item->verifikasi_3 != 12)
                                                <th> <span class="{{ $value->style }}">{{ $value->text }}</span>
                                                </th>
                                            @else
                                                <th> <span class="{{ $value->style }}">{{ $value->text }}
                                                        {{ $item->msg_fail }}</span> </th>
                                            @endif
                                        @endif
                                    @endforeach


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
