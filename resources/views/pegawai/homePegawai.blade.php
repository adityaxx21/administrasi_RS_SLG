@extends('pegawai.layout')
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
                <!-- Vertically centered modal -->
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
                            <form class="modal-body" method="POST" id="add_data" action="/pegawai_post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_pegawai" id="id_pegawai"
                                    value="{{ $pegawai[0]->id_pegawai }}">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Penyelenggaraan Pelatihan</label>
                                    <div class="input-group mb-3">
                                        <select class="custom-select" id="keperluan" name="keperluan">
                                            <option value="Ex House">Ex House</option>
                                            <option value="In House">In House</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="inputGroupSelect02">Options</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tema Pelatihan</label>
                                    <input type="text" class="form-control" id="tema_pelatihan" name="tema_pelatihan"
                                        aria-describedby="emailHelp" placeholder="Narasumber">
                                </div>
                                <div class="form-group">
                                    <label for="waktu_pelaksanaan" class="label-form">Waktu Pelaksanaan</label>
                                    <input id="waktu_pelaksanaan" class="date-picker form-control" placeholder="dd-mm-yyyy"
                                        type="date" required="required" onfocus="this.type='date'"
                                        onclick="this.type='date'" onkeyup="" name="waktu_pelaksanaan" value="">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Narasumber</label>
                                    <input type="text" class="form-control" id="narasumber" name="narasumber"
                                        aria-describedby="emailHelp" placeholder="Narasumber">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sasaran Pelatihan</label>
                                    <input type="text" class="form-control" id="sasaran_pelatihan"
                                        name="sasaran_pelatihan" aria-describedby="emailHelp"
                                        placeholder="Masukan Alamat Instansi">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Jabatan</label>
                                    <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan"
                                        aria-describedby="emailHelp" placeholder="Masukan Alamat Instansi">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jumlah Peserta</label>
                                    <input type="text" class="form-control" id="jumlah_peserta" name="jumlah_peserta"
                                        aria-describedby="emailHelp" placeholder="Masukan Alamat Instansi">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Materi</label>
                                    <input type="text" class="form-control" id="materi" name="materi"
                                        aria-describedby="emailHelp" placeholder="Masukan Alamat Instansi">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Indikator Kebutuhan</label>
                                    <input type="text" class="form-control" id="indikator_kebutuhan"
                                        name="indikator_kebutuhan" aria-describedby="emailHelp"
                                        placeholder="Masukan Alamat Instansi">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Anggaran</label>
                                    <input type="text" class="form-control" id="anggaran" name="anggaran"
                                        aria-describedby="emailHelp" placeholder="Masukan Alamat Instansi">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Periode Evaluasi</label>
                                    <div class="input-group mb-3">
                                        <select class="custom-select" id="periode_evaluasi" name="periode_evaluasi">
                                            <option value="1 Bulan Setelah Pelatihan Diselenggarakan">1 Bulan Setelah
                                                Pelatihan Diselenggarakan</option>
                                            <option value="3 Bulan Setelah Pelatihan Diselenggarakan">3 Bulan Setelah
                                                Pelatihan Diselenggarakan</option>
                                            <option value="6 Bulan Setelah Pelatihan Diselenggarakan">6 Bulan Setelah
                                                Pelatihan Diselenggarakan</option>
                                            <option value="12 Bulan Setelah Pelatihan Diselenggarakan">12 Bulan Setelah
                                                Pelatihan Diselenggarakan</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="inputGroupSelect02">Options</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gambar_instansi_update">File Pendukung 1</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="berkas1" name="berkas1"
                                            onchange="input_gb('1','berkas1')">
                                        <label class="custom-file-label" for="berkas1" id="change_name1">Choose
                                            file</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gambar_instansi_update">File Pendukung 2</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="berkas2" name="berkas2"
                                            onchange="input_gb('2','berkas2')">
                                        <label class="custom-file-label" for="berkas2" id="change_name2">Choose
                                            file</label>
                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" onclick="$('#add_data').submit()">Save</button>
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
                            <form class="modal-body" method="POST" id="update_data" action="/pegawai_update"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_pegawai_update" id="id_pegawai_update"
                                    >
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Penyelenggaraan Pelatihan</label>
                                    <div class="input-group mb-3">
                                        <select class="custom-select" id="keperluan_update" name="keperluan_update">
                                            <option value="Ex House">Ex House</option>
                                            <option value="In House">In House</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="inputGroupSelect02">Options</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tema Pelatihan</label>
                                    <input type="text" class="form-control" id="tema_pelatihan_update"
                                        name="tema_pelatihan_update" aria-describedby="emailHelp"
                                        placeholder="Narasumber">
                                </div>
                                <div class="form-group">
                                    <label for="waktu_pelaksanaan" class="label-form">Waktu Pelaksanaan</label>
                                    <input id="waktu_pelaksanaan_update" class="date-picker form-control"
                                        placeholder="dd-mm-yyyy" type="date" required="required"
                                        onfocus="this.type='date'" onclick="this.type='date'" onkeyup=""
                                        name="waktu_pelaksanaan_update" value="">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Narasumber</label>
                                    <input type="text" class="form-control" id="narasumber_update"
                                        name="narasumber_update" aria-describedby="emailHelp" placeholder="Narasumber">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sasaran Pelatihan</label>
                                    <input type="text" class="form-control" id="sasaran_pelatihan_update"
                                        name="sasaran_pelatihan_update" aria-describedby="emailHelp"
                                        placeholder="Masukan Alamat Instansi">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Jabatan</label>
                                    <input type="text" class="form-control" id="nama_jabatan_update"
                                        name="nama_jabatan_update" aria-describedby="emailHelp"
                                        placeholder="Masukan Alamat Instansi">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jumlah Peserta</label>
                                    <input type="text" class="form-control" id="jumlah_peserta_update"
                                        name="jumlah_peserta_update" aria-describedby="emailHelp"
                                        placeholder="Masukan Alamat Instansi">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Materi</label>
                                    <input type="text" class="form-control" id="materi_update" name="materi_update"
                                        aria-describedby="emailHelp" placeholder="Masukan Alamat Instansi">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Indikator Kebutuhan</label>
                                    <input type="text" class="form-control" id="indikator_kebutuhan_update"
                                        name="indikator_kebutuhan_update" aria-describedby="emailHelp"
                                        placeholder="Masukan Alamat Instansi">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Anggaran</label>
                                    <input type="text" class="form-control" id="anggaran_update"
                                        name="anggaran_update" aria-describedby="emailHelp"
                                        placeholder="Masukan Alamat Instansi">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Periode Evaluasi</label>
                                    <div class="input-group mb-3">
                                        <select class="custom-select" id="periode_evaluasi_update"
                                            name="periode_evaluasi_update">
                                            <option value="1 Bulan Setelah Pelatihan Diselenggarakan">1 Bulan Setelah
                                                Pelatihan Diselenggarakan</option>
                                            <option value="3 Bulan Setelah Pelatihan Diselenggarakan">3 Bulan Setelah
                                                Pelatihan Diselenggarakan</option>
                                            <option value="6 Bulan Setelah Pelatihan Diselenggarakan">6 Bulan Setelah
                                                Pelatihan Diselenggarakan</option>
                                            <option value="12 Bulan Setelah Pelatihan Diselenggarakan">12 Bulan Setelah
                                                Pelatihan Diselenggarakan</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="inputGroupSelect02">Options</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gambar_instansi_update">File Pendukung 1</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="berkas3" name="berkas3"
                                            onchange="input_gb('3','berkas3')">
                                        <label class="custom-file-label" for="berkas3" id="change_name3">Choose
                                            file</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gambar_instansi_update">File Pendukung 2</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="berkas4" name="berkas4"
                                            onchange="input_gb('4','berkas4')">
                                        <label class="custom-file-label" for="berkas4" id="change_name4">Choose
                                            file</label>
                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" onclick="$('#update_data').submit()">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Keperluan</th>
                                <th>Verifikasi 1</th>
                                <th>Verifikasi 2</th>
                                <th>Verifikasi 3</th>
                                <th>Berkas</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawai as $key => $item)
                                <tr>
                                    <th>{{ $item->id }}</th>
                                    <th>{{ $item->keperluan }}</th>
                                    @foreach ($style as $value)
                                        @if ($item->verifikasi_1 == $value->id_status)
                                            <th> <span class="{{ $value->style }}">{{ $value->text }}</span> </th>
                                        @endif
                                    @endforeach
                                    @foreach ($style as $value)
                                        @if ($item->verifikasi_2 == $value->id_status)
                                            <th> <span class="{{ $value->style }}">{{ $value->text }}</span> </th>
                                        @endif
                                    @endforeach
                                    @foreach ($style as $value)
                                        @if ($item->verifikasi_3 == $value->id_status)
                                            <th> <span class="{{ $value->style }}">{{ $value->text }}</span> </th>
                                        @endif
                                    @endforeach

                                    <th>
                                        @if ($item->verifikasi_1 == 10 && $item->verifikasi_2 == 10 && $item->verifikasi_3 == 10)
                                            <button type="button" class="btn btn-success"
                                                onclick="window.open('/surat/'.{{ $item->id }},)"><i
                                                    class="fas fa-file fa-sm "></i>
                                            </button>
                                        @endif
                                    </th>

                                    <th>
                                        <button type="button" class="btn btn-warning"
                                            onclick="get_data({{ $item->id }})"
                                            {{ $item->verifikasi_1 == 12 || $item->verifikasi_2 == 12 || $item->verifikasi_3 == 12 ? '' : 'disabled' }}><i
                                                class="fas fa-edit fa-sm "></i>
                                            Update</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="reject_form({{ $item->id }})"
                                            {{ $item->verifikasi_3 == 10 ? 'disabled' : '' }}><i
                                                class="fas fa-ban fa-sm "></i>
                                            Hapus</button>
                                    </th>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <form id="submit_it" action="/pegawai_delete" hidden method="post">
                @csrf
                <input type="text" id="id_delete" name="id_delete">
            </form>
        </div>
        <script>
            var id_data;
            var role;
            var gambar;

            function reject_form(id) {
                $('#id_delete').val(id);
                $('#submit_it').submit();
            }

            function input_gb(i, id) {
                gambar = $('#' + id).val().replace(/C:\\fakepath\\/i, '')
                $("#change_name" + i).html(gambar);
            }

            function get_data(id) {
                id_data = id;
                $(function() {
                    $("#waktu_pelaksanaan_update").datepicker({
                        dateFormat: "yy-mm-dd",
                        changeMonth: true,
                        changeYear: true
                    });
                });
                $('#updateData').modal('show');
                $.ajax({
                    type: 'GET',
                    url: "/find_data_pegawai/" + id,
                    success: function(data) {

                        if ($.isEmptyObject(data.error)) {
                            // alert(data.data.tema_pelatihan);
                            $('#id_pegawai_update').val(id);
                            $('#keperluan_update').val(data.data.keperluan);
                            $('#tema_pelatihan_update').val(data.data.tema_pelatihan);
                            $('#waktu_pelaksanaan_update').val(data.data.waktu_pelaksanaan);
                            alert(data.data.waktu_pelaksanaan);
                            $('#narasumber_update').val(data.data.narasumber);
                            $('#sasaran_pelatihan_update').val(data.data.sasaran_pelatihan);
                            $('#nama_jabatan_update').val(data.data.nama_jabatan);
                            $('#jumlah_peserta_update').val(data.data.jumlah_peserta);
                            $('#materi_update').val(data.data.materi);
                            $('#indikator_kebutuhan_update').val(data.data.indikator_kebutuhan);
                            $('#anggaran_update').val(data.data.anggaran);
                            $('#periode_evaluasi_update').val(data.data.periode_evaluasi);

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
