@extends('admin.layout')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <script>
                    var jenis_pelayanan = [];
                    var jumlah_pelayanan = new Array(12).fill(0);
                </script>
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
                                    <script>
                                        jenis_pelayanan.push("{{ $item->jenis_pelayanan }}");
                                    </script>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama_instansi }}</td>
                                    <td>{{ $item->jenis_pelayanan }}</td>
                                    <td>{{ $item->durasi_pelayanan }} {{ $item->satuan_waktu }}</td>
                                    <td>{{ $item->jumlah_pelayanan }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->updated_at)) }}</td>
                                    <td><span class="{{ $item->style }}">{{ $item->text }}</span> </td>
                                    <td>Rp. {{ $item->total_biaya_pelayanan }}</td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    </table>
                </div>
            </div>
        </div>

        {{-- Chart JS --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pelayanan Paling Diminati</h6>
            </div>
            <div class="card-body" width="60" height="200">
                <canvas id="myChart" width="200" height="60"></canvas>
                <script>
                    var list_pelayanan = ['Praktek Lapangan DI / SMA Sederajat', 'Praktek Lapangan DIII', 'Praktek Lapangan DIV / SI',
                        'Praktek Lapangan S2', 'Magang DI / SMA Sederajat', 'Magang DIII', 'Magang DIV / SI', 'Magang DIV / SI',
                        'Magang S2', 'Studi Banding antar Instansi', 'UJI Kopetensi',
                        'Pelayanan Penelitian / Pengambilan Kasus DI / SMA Sederajat',
                        'Pelayanan Penelitian / Pengambilan Kasus DIII', 'Pelayanan Penelitian / Pengambilan Kasus DIV / SI',
                        'Pelayanan Penelitian / Pengambilan Kasus S2'
                    ];
                    
                    jenis_pelayanan.forEach((element, index) => {
                        list_pelayanan.forEach((element1, index1) => {
                           if (element1 == element) {
                            jumlah_pelayanan[index1] =  jumlah_pelayanan[index1] + 1
                           }
                        })
                    });
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: list_pelayanan,
                            datasets: [{
                                label: '# of Jumlah Pelayanan',
                                data: jumlah_pelayanan,
                                backgroundColor: [
                                    'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                    'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                    'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                    'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                    'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                    'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                    'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                    'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                    'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                    'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                    'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                    'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                    'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                    'rgba({{ rand(0, 255) }}, {{ rand(0, 255) }}, {{ rand(0, 255) }}, 0.2)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>


    </div>
@endsection
