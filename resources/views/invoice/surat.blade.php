<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>invoice order receipt - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style type="text/css">
        table {
            border-style: double;
            border-width: 3px;
            border-color: white;
        }

        table tr .text2 {
            text-align: right;
            font-size: 13px;
        }

        table tr .text {
            text-align: center;
            font-size: 13px;
        }

        table tr td {
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="countainer center">
        <table >
            <tr >
                <td  style="padding-left:150px">
                    <center>
                        <font size="5"><b>RSUD Simpang Lima Gumul</b></font><br>
                        <font size="2">Bidang Keahlian : Bisnis dan Menejemen - Teknologi informasi dan Komunikasi
                        </font><br>
                        <font size="2"><i>Jl. Galuh Candrakirana, Tugurejo, Kec. Ngasem, Kabupaten Kediri, Jawa Timur 64182</i></font>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr style="width: 820px">
                </td>
            </tr>
            <table width="500">
                <tr>
                    <td class="text2">Kediri, {{  date("d-m-Y", strtotime( $pegawai->created_at))}}</td>
                </tr>
            </table>
        </table>
        <table>
            <tr class="text2">
                <td  width="100">Nomer</td>
                <td width="572">: {{$pegawai->id}}</td>
            </tr>
            <tr>
                <td width="100">Tanggal Pelakasanaan</td>
                <td width="564">:  {{ date("d-m-Y", strtotime( $pegawai->waktu_pelaksanaan))}}</td>
            </tr>
        </table>
        <br>
        <table width="625">
            <tr>
                <td>
                    <font size="2"><b>Kpd yth.<br>DIREKTUR RSUD SLG<br>Up. Plt. KASUBAG SUNGRAM (DIKLAT)</b></font>
                </td>
            </tr>
        </table>
        <br>
        <br>
        </table>
        <table>
            <tr class="text2">
                <td width="200">PENYELENGGARAAN PELATIHAN</td>
                <td width="541">: <b>{{$pegawai->keperluan}}</b></td>
            </tr>
            <tr class="text2">
                <td>TEMA/JENIS PELATIHAN</td>
                <td width="541">: <b>{{$pegawai->tema_pelatihan}}</b></td>
            </tr>
            <tr class="text2">
                <td>NARASUMBER/PENYELENGGARA</td>
                <td width="541">: <b>{{$pegawai->narasumber}}</b></td>
            </tr>
            <tr class="text2">
                <td>SASARAN PELATIHAN</td>
                <td width="541">: <b>{{$pegawai->sasaran_pelatihan}}</b></td>
            </tr>
            <tr class="text2">
                <td>NAMA/JABATAN & JUMLAH PESERTA PELATIHAN</td>
                <td width="541">: <b>{{$pegawai->nama_jabatan}}</b></td>
            </tr>
            <tr class="text2">
                <td>ALASAN/INDIKATOR KEBUTUHAN </td>
                <td width="541">: <b>{{$pegawai->indikator_kebutuhan}}</b></td>
            </tr>
            <tr class="text2">
                <td>ANGGARAN</td>
                <td width="541">: <b>{{$pegawai->anggaran}}</b></td>
            </tr>
            <tr class="text2">
                <td>PERIODE EVALUASI *lingkari yang dipilih</td>
                <td width="541">: <b>{{$pegawai->periode_evaluasi}}</b></td>
            </tr>
        </table>
        <br>
        <table >
            <tr>
                <td width="200" align="center">Kediri, ….................... 2022</td>
            </tr>
            <tr>
                <td class="text" align="left">Menyetujui<br><br><br><br></td>
                <td width="280"> </td>
                <td class="text" align="right"> Yang mengusulkan <br><br><br><br></td>
            </tr>
            <tr>
                <td class="text" align="left"><b>Kabid Penunjang</td>
                <td width="280"> </td>
                <td class="text" align="right" width="100"> <b>Kasi Penunjang Non Klinik<></td>
            </tr>
            <tr>
                <td  class="text" align="left"><b>dr.YAYA MULYANA</b></td>
                <td width="280"> </td>
                <td class="text" align="right"> <b>LELY KUMOLOSARI, S.K.M</b> </td>
            </tr>
            <tr>
                <td class="text" align="left"><b>NIP. 19821213 200901 1 006</b></td>
                <td width="280"> </td>
                <td class="text" align="right"> <b>NIP. 19700419 199603 2 004</b> </td>
            </tr>
        </table>
    </div>
</body>

</html>
