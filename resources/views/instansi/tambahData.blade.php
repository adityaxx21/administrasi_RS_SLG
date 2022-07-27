@extends('instansi.layout')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Pelayanan</h1>

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
                        aria-controls="profile" aria-selected="false">Tambah Data</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                        aria-controls="contact" aria-selected="false">Detail Pembayaran</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card shadow mb-4" style="padding: 10px">

                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-11">
                                    <h6 class="m-0 font-weight-bold text-primary">Detail Pelayanan</h6>
                                </div>

                                <div class="col-md-1">
                                    <h6 class="m-0 font-weight-bold text-primary">Id :
                                        {{ $instansi->id }}</h6>
                                </div>
                            </div>
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
                                            <label for="exampleInputEmail1">Jumlah Pendaftar</label>
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
                                                placeholder="Masukan Nama Pendaftar" value="" readonly>
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
                                    <input readonly type="text" value="{{$instansi->total_biaya_pelayanan}} " class="form-control"
                                        id="biaya" name="biaya" aria-describedby="emailHelp"
                                        placeholder="Durasi Pelayanan">
                                </div>
                                <div class="card-header py-3" style="margin-bottom: 10px">
                                    <div class="row">
                                        <div class="col">
                                        </div>
                                        <div class="col text-right">
                                            <a href="/instansi"
                                                class="d-none d-sm-inline-block btn btn-sm btn-white shadow-sm"><i
                                                    class="fas fa-arrow-left fa-sm "></i>
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
                                    <label for="exampleInputEmail1">Nama Peserta </label>
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa"
                                        aria-describedby="emailHelp" placeholder="Masukan Nama Peserta">
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
                                    <label for="exampleInputEmail1">Nomor Induk Peserta </label>
                                    <input type="text" class="form-control" id="nomor_induk" name="nomor_induk"
                                        aria-describedby="emailHelp" placeholder="Masukan Nomor Induk Peserta ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat Instansi</label>
                                    <textarea type="text" class="form-control" id="alamat" name="alamat" aria-describedby="emailHelp"
                                        placeholder="Masukan Alamat Peserta "></textarea>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" onclick="$('#tambah_data').submit();">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Update Data --}}
                <div class="modal fade" id="updateData" tabindex="-1" aria-labelledby="updateDataTitle"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width:50%">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Instansi</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form class="modal-body" method="POST" id="update_data" action="/tambahSiswa_update"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="id_ins_update" name="id_ins_update" value="{{ $instansi->id }}">
                                <input type="hidden" id="id_siswa_update" name="id_siswa_update">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Peserta </label>
                                    <input type="text" class="form-control" id="nama_siswa_update" name="nama_siswa_update"
                                        aria-describedby="emailHelp" placeholder="Masukan Nama Peserta ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Jenis Kelamin</label>
                                    <div class="input-group mb-3">
                                        <select class="custom-select" id="jenis_kelamin_update" name="jenis_kelamin_update">
                                            <option value="Perempuan">Perempuan</option>
                                            <option value="Laki - Laki">Laki - Laki</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="inputGroupSelect02">Options</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nomor Induk Peserta </label>
                                    <input type="text" class="form-control" id="nomor_induk_update" name="nomor_induk_update"
                                        aria-describedby="emailHelp" placeholder="Masukan Nomor Induk Peserta ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat Instansi</label>
                                    <textarea type="text" class="form-control" id="alamat_update" name="alamat_update" aria-describedby="emailHelp"
                                        placeholder="Masukan Alamat Peserta "></textarea>
                                </div>
  
                            </form>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" onclick="$('#update_data').submit();">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card shadow mb-4" style="padding: 10px">

                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-11">
                                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
                                </div>

                                <div class="col-md-1">
                                    <h6 class="m-0 font-weight-bold text-primary">Id :
                                        {{ $instansi->id }}</h6>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive" style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;">

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <div>

                                </div>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nama Pendaftar</th>
                                        <th>Nomor Induk</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $item)
                                        <tr>
                                            <th>{{ $item->id }}</th>
                                            <th>{{ $item->nama_siswa }}</th>
                                            <th>{{ $item->nomor_induk }}</th>
                                            <th>{{ $item->jenis_kelamin }}</th>
                                            
                                            <th>
                                                @if ($item->id_status != null)
                                                    <span class="{{ $item->style }}">{{ $item->text }}{{" ".$item->msg_fail }}</span>
                                                @endif
                                            </th>
                                            <th>
                                                <button type="button" class="btn btn-warning"
                                                    onclick="update_siswa({{ $item->id}})"><i
                                                        class="fas fa-edit fa-sm "></i> update
                                                </button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="hapus_siswa({{ $item->id }},{{ $instansi->id }})"><i
                                                        class="fas fa-ban fa-sm "></i> delete
                                                </button>
                                            </th>
                                    @endforeach


                                </tbody>
                            </table>
                            {{-- Hapus Siswa --}}
                            <form action="/hapus_siswa" method="post" id="hapus_siswa">
                                @csrf
                                <input type="hidden" id="id_hapus" name="id_hapus">
                                <input type="hidden" id="id_inst" name="id_inst">

                            </form>
                        </div>
                        <div class="card-header py-3" style="margin-bottom: 10px">
                            <div class="row">
                                <div class="col">

                                </div>
                                <div class="col text-right">
                                    <a class="d-none d-sm-inline-block btn btn-sm btn-white shadow-sm" href="/instansi"><i
                                            class="fas fa-arrow-left fa-sm "></i>
                                        Kembali </a>
                                    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                        onclick=" $('#tambahData').modal('show');"><i
                                            class="fas fa-plus fa-sm text-white-50"></i> Tambah Peserta</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card shadow mb-4" style="padding: 10px">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h6 class="m-0 font-weight-bold text-primary">Detail Pembayaran</h6>
                                    </div>

                                    <div class="col-md-1">
                                        <h6 class="m-0 font-weight-bold text-primary">Id :
                                            {{ $instansi->id }}</h6>
                                    </div>
                                </div>
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
                                        <input type="file" class="custom-file-input" id="bukti_bayar"
                                            name="bukti_bayar" onchange="input_gb('6','bukti_bayar')">
                                        <label class="custom-file-label" for="bukti_bayar" id="change_name6">Choose
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
                                    <a class="d-none d-sm-inline-block btn btn-sm btn-white shadow-sm" href="/instansi"><i
                                            class="fas fa-arrow-left fa-sm "></i> Kembali </a>
                                    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                        onclick=" $('#bayar_sekarang').submit();"><i
                                            class="fas fa-plus fa-sm text-white-50"></i> Bayar Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('alert-notif'))
                <script>
                    alert("{{ session('alert-notif') }}")
                </script>
            @endif

            <span> <b>Syarat Ketentuan File Pendukung, File pendukung yang di perlukan untuk pendaftaran :</b> </span>
            <span> <b>Note : File pendukung berbentuk PDF </b></span>
            <div class="bd-example bd-example-tabs">
                <div class="row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                role="tab" aria-controls="v-pills-home" aria-selected="true">Praktek Lapangan</a>
                            <a class="nav-link active show" id="v-pills-profile-tab" data-toggle="pill"
                                href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                aria-selected="false">Magang </a>
                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages"
                                role="tab" aria-controls="v-pills-messages" aria-selected="false">Uji Kopetensi</a>
                            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings"
                                role="tab" aria-controls="v-pills-settings" aria-selected="false">Pelayanan
                                Penelitian</a>
                            <a class="nav-link" id="v-pills-plis-tab" data-toggle="pill" href="#v-pills-plis"
                                role="tab" aria-controls="v-pills-plis" aria-selected="false">Study Banding Antar
                                Instansi</a>
                        </div>
                    </div>
                    <br> <br>
                    <div class="col-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <p>+ Akreditasi</p>
                                <p>+ Surat rekomendasi dari bakesbangpol</p>
                                <p>+ Invoice</p>
                                <p>+ Laporan</p>
                                <p>+ MOU</p>

                            </div>
                            <div class="tab-pane fade active show" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <p>+ Akreditasi</p>
                                <p>+ Surat rekomendasi dari bakesbangpol</p>
                                <p>+ Invoice</p>
                                <p>+ Laporan</p>
                                <p>+ MOU</p>
                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                aria-labelledby="v-pills-messages-tab">
                                <p>+ Akreditasi</p>
                                <p>+ Surat rekomendasi dari bakesbangpol</p>
                                <p>+ Invoice</p>
                                <p>+ Laporan</p>
                                <p>+ MOU</p>
                            </div>
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                aria-labelledby="v-pills-settings-tab">
                                <p>+ Akreditasi</p>
                                <p>+ Surat rekomendasi dari bakesbangpol</p>
                                <p>+ Invoice</p>
                                <p>+ Laporan</p>
                                <p>+ MOU</p>
                            </div>
                            <div class="tab-pane fade" id="v-pills-plis" role="tabpanel"
                                aria-labelledby="v-pills-plis-tab">
                                <p>+ Proposal</p>
                                <p>+ Invoice</p>
                                <p>+ Laporan</p>
                                <p>+ Surat masuk </p>
                                <p>+ Surat keluar</p>
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
        

        function input_gb(i, id) {
            gambar = $('#' + id).val().replace(/C:\\fakepath\\/i, '')
            $("#change_name" + i).html(gambar);
        }

        function update_gb(i, id) {
            gambar = $('#' + id).val().replace(/C:\\fakepath\\/i, '')
            $("#change_name_" + i).html(gambar);
        }

        function hapus_siswa(id, id_data) {
            $('#id_hapus').val(id);
            $('#id_inst').val(id_data);
            $('#hapus_siswa').submit();
        }

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
        // Update Pengguna
        function update_siswa(id) {
                id_data = id;

                $('#updateData').modal('show');
                $.ajax({
                    type: 'GET',
                    url: "/find_data_siswa/" + id,
                    success: function(data) {

                        if ($.isEmptyObject(data.error)) {
                            // alert(data.data.owner);
                            $('#id_siswa_update').val(id);
                            $('#nama_siswa_update').val(data.data.nama_siswa);
                            $('#jenis_kelamin_update').val(data.data.jenis_kelamin);
                            $('#nomor_induk_update').val(data.data.nomor_induk);
                            $('#alamat_update').val(data.data.alamat);
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
