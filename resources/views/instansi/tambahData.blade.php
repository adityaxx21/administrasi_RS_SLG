@extends('instansi.layout')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Transaiksi Pelayanan</h1>


        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4" style="padding: 10px">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Detail Data</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Detail Siswa</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                        aria-controls="contact" aria-selected="false">Bayar</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card shadow mb-4" style="padding: 10px">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Detail Transaiksi Pelayanan</h6>
                        </div>
                        <form class="modal-body" method="POST" id="add_data" action="/instansi/tambahData"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="id_instansi" name="id_instansi" value="{{ $instansi->id }}">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Jenis</label>
                                <div class="input-group mb-3">
                                    <select class="custom-select" id="jenis_pelayanan" name="jenis_pelayanan"
                                        onchange="input()">
                                        @foreach ($jenis_pelayanan as $key => $item)
                                            <option value="{{ $item->id }}"
                                                {{ $instansi->id_jenis_pelayanan == $item->id ? 'Selected' : '' }}>
                                                {{ $item->jenis_pelayanan }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="inputGroupSelect02">Options</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Jumlah Pelayanan</label>
                                            <input type="text" class="form-control" id="jumlah_pelayanan"
                                                name="jumlah_pelayanan" aria-describedby="emailHelp"
                                                placeholder="Durasi Pelayanan" value="{{ $siswa->count() }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Durasi Pelayanan</label>
                                            <input type="text" class="form-control" id="durasi_pelayanan"
                                                name="durasi_pelayanan" aria-describedby="emailHelp"
                                                placeholder="Durasi Pelayanan" value="{{ $instansi->durasi_pelayanan }}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Satuan Waktu</label>
                                            <input type="text" class="form-control" id="satuan_waktu"
                                                name="nama_pendaftar_update" aria-describedby="emailHelp"
                                                placeholder="Masukan Nama Pendaftar"
                                                value=" {{ $instansi->nama_instansi }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Biaya Per Orang</label>
                                            <input type="text" class="form-control" id="biaya_orang"
                                                name="biaya_orang" aria-describedby="emailHelp"
                                                placeholder="Masukan Nama Pendaftar"
                                                value="" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Pendaftar</label>
                                            <input type="text" class="form-control" id="nama_pendaftar_update"
                                                name="nama_pendaftar_update" aria-describedby="emailHelp"
                                                placeholder="Masukan Nama Pendaftar"
                                                value="{{ $instansi->nama_pendaftar }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Instansi</label>
                                            <input type="text" class="form-control" id="nama_pendaftar_update"
                                                name="nama_pendaftar_update" aria-describedby="emailHelp"
                                                placeholder="Masukan Nama Pendaftar"
                                                value=" {{ $instansi->nama_instansi }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Total Biaya</label>
                                    <input readonly type="text" value="{{  $instansi->total_biaya_pelayanan }}"
                                        class="form-control" id="biaya" name="biaya" aria-describedby="emailHelp"
                                        placeholder="Durasi Pelayanan">
                                </div>
                                <div class="card-header py-3" style="margin-bottom: 10px">
                                    <div class="row">
                                        <div class="col">
                                        </div>
                                        <div class="col text-right">
                                            <a href="/instansi" class="d-none d-sm-inline-block btn btn-sm btn-white shadow-sm"
                                           ><i class="fas fa-arrow-left fa-sm "></i>
                                            Kembali </a>
                                            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                                onclick=" $('#add_data').submit();"><i
                                                    class="fas fa-plus fa-sm text-white-50"></i> Ubah Data</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

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
                            <form class="modal-body" method="POST" id="tambah_data" action="/tambahSiswa_post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="id_ins" name="id_ins" value="{{ $instansi->id }}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Siswa</label>
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa"
                                        aria-describedby="emailHelp" placeholder="Masukan Nama Siswa">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Jenis Kelamin</label>
                                    <div class="input-group mb-3">
                                        <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="Perempuan">Perempuan</option>
                                            <option value="Laki - Laki">Laki - Laki</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="inputGroupSelect02">Options</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nomor Induk Siswa</label>
                                    <input type="text" class="form-control" id="nomor_induk" name="nomor_induk"
                                        aria-describedby="emailHelp" placeholder="Masukan Nomor Induk Siswa">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat Instansi</label>
                                    <textarea type="text" class="form-control" id="alamat" name="alamat" aria-describedby="emailHelp"
                                        placeholder="Masukan Alamat Siswa"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="gambar_instansi_update">File Pendukung 1</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="doc1" name="doc1"
                                            onchange="input_gb('1','doc1')">
                                        <label class="custom-file-label" for="doc1" id="change_name1">Choose
                                            file</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gambar_instansi_update">File Pendukung 2</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="doc2" name="doc2"
                                            onchange="input_gb('2','doc2')">
                                        <label class="custom-file-label" for="doc2" id="change_name2">Choose
                                            file</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gambar_instansi_update">File Pendukung 3</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="doc3" name="doc3"
                                            onchange="input_gb('3','doc3')">
                                        <label class="custom-file-label" for="gambar_instansi" id="change_name3">Choose
                                            file</label>
                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" onclick="$('#tambah_data').submit()">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card shadow mb-4" style="padding: 10px">

                        <div class="card-header py-3" style="margin-bottom: 10px">
                            <div class="row">
                                <div class="col">
                                    <h6 class="m-0 font-weight-bold text-primary" style="margin: 10px">Detail Siswa</h6>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive" style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;">

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <div>

                                </div>
                                <thead>
                                    <tr>
                                        <th>Nama Pendaftar</th>
                                        <th>Nomor Induk</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Berkas 1</th>
                                        <th>Berkas 2</th>
                                        <th>Berkas 3</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $item)
                                        <tr>
                                            <th>{{ $item->nama_siswa }}</th>
                                            <th>{{ $item->nomor_induk }}</th>
                                            <th>{{ $item->jenis_kelamin }}</th>
                                            <th>
                                                @if ($item->berkas1 != null)
                                                    <button type="button" class="btn btn-success"
                                                        onclick="success_form({{ $item->berkas1 }})"><i
                                                            class="fas fa-file fa-sm "></i>
                                                    </button>
                                                @endif
                                            </th>
                                            <th>

                                                @if ($item->berkas2 != null)
                                                    <button type="button" class="btn btn-success"
                                                        onclick="success_form({{ $item->berkas2 }})"><i
                                                            class="fas fa-file fa-sm "></i>
                                                    </button>
                                                @endif
                                            </th>
                                            <th>

                                                @if ($item->berkas3 != null)
                                                    <button type="button" class="btn btn-success"
                                                        onclick="success_form({{ $item->berkas3 }})"><i
                                                            class="fas fa-file fa-sm "></i>
                                                    </button>
                                                @endif
                                            </th>
                                            <th>
                                                <button type="button" class="btn btn-warning"
                                                    onclick="success_form({{ $item->berkas3 }})"><i
                                                        class="fas fa-edit fa-sm "></i>update
                                                </button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="success_form({{ $item->berkas3 }})"><i
                                                        class="fas fa-ban fa-sm "></i>delete
                                                </button>
                                            </th>
                                    @endforeach


                                </tbody>
                            </table>

                        </div>
                        <div class="card-header py-3" style="margin-bottom: 10px">
                            <div class="row">
                                <div class="col">

                                </div>
                                <div class="col text-right">
                                    <a class="d-none d-sm-inline-block btn btn-sm btn-white shadow-sm"
                                        href="/instansi"><i class="fas fa-arrow-left fa-sm "></i>
                                        Kembali </a>
                                    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                        onclick=" $('#tambahData').modal('show');"><i
                                            class="fas fa-plus fa-sm text-white-50"></i> Tambah Siswa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card shadow mb-4" style="padding: 10px">

                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Proses Bayar</h6>
                            </div>
                            <form class="modal-body" method="POST" id="bayar_sekarang" action="/bayar"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="id_inp" name="id_inp" value="{{ $instansi->id }}">

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Metode Pembayaran</label>
                                    <div class="input-group mb-3">
                                        <select class="custom-select" id="metode_pembayaran" name="metode_pembayaran">
                                            <option value="Transfer Bank">Transfer Bank </option>
                                            <option value="Dompet Digital">Dompet Digital</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="inputGroupSelect02">Options</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Pembayaran</label>
                                    <textarea type="text" class="form-control" id="kode_bayar" name="kode_bayar" aria-describedby="emailHelp"
                                        placeholder="Masukan Kode Bayar"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="gambar_instansi_update">Upload Bukti Bayar</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="bukti_bayar" name="bukti_bayar"
                                            onchange="input_gb('4','bukti_bayar')">
                                        <label class="custom-file-label" for="bukti_bayar" id="change_name4">Choose
                                            file</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-header py-3" style="margin-bottom: 10px">
                            <div class="row">
                                <div class="col">

                                </div>
                                <div class="col text-right">
                                    <a class="d-none d-sm-inline-block btn btn-sm btn-white shadow-sm"
                                        href="/instansi"><i class="fas fa-arrow-left fa-sm "></i> Kembali </a>
                                    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                        onclick=" $('#bayar_sekarang').submit();"><i class="fas fa-plus fa-sm text-white-50"></i> Bayar Sekarang</button>
                                </div>
                            </div>
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
        var gambar;

        function input_gb(i, id) {
            gambar = $('#' + id).val().replace(/C:\\fakepath\\/i, '')
            $("#change_name" + i).html(gambar);
        }
        var tesss;
        window.addEventListener('DOMContentLoaded', (event) => {
            tesss = JSON.parse(extractContent("{{ $jenis_pelayanan }}"));
            $.each(tesss, function(index, value) {
                if ($('#jenis_pelayanan').val() == value.id) {
                    $('#satuan_waktu').val(value.satuan_waktu);
                    $('#biaya_orang').val(value.biaya);
                }
            });

        });
        const extractContent = (s) => {
            const span = document.createElement('span');
            span.innerHTML = s;
            return span.textContent || span.innerText;
        };

        function input() {
            $.each(tesss, function(index, value) {
                if ($('#jenis_pelayanan').val() == value.id) {
                    $('#satuan_waktu').val(value.satuan_waktu);
                    $('#biaya_orang').val(value.biaya);
                    if ($('#jenis_pelayanan').val() == 10010) {
                        $('#durasi_pelayanan').attr('readonly', true);
                        $('#durasi_pelayanan').val(1);
                    }
                }
            });
        }
        // $(document).ready(function(){
        //     alert('jajaal');

        //     // var tesss = JSON.parse({{ $jenis_pelayanan }});
        //     // alert(tesss);
        //     // console.log(tesss);
        // })
        // var JSONArray = $.parseJSON('{{ $jenis_pelayanan }}');
        // var id_data;
        // var role;
        // var gambar;


        // function intup() {
        //     alert(JSONArray);
        //     console.log("Hello world!");
        // }

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
