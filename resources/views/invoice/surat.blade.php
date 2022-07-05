<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css"
        integrity="sha384-/frq1SRXYH/bSyou/HUp/hib7RVN1TawQYja658FEOodR/FQBKVqT9Ol+Oz3Olq5" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="text-center mt-5">
        <h1>History Chat Contact Us</h1>
        <h1>Project Land Metaverse</h1>


        <table class="table table-bordered mt-2" style="font-size: 12px">
            <thead class="text-center">
                <tr>
                    <th scope="col" id="ubah">No</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Message</th>
                    <th scope="col">Answere</th>
                </tr>
            </thead>
            <tbody> 
                {{-- @foreach ($mail as $key=>$item)
                <th>{{$key+1}}</th>
                <th>{{$item->username}}</th>
                <th>{{$item->email}}</th>
                <th>{{$item->message}}</th>
                <th>{{$item->answere}}</th>
                @endforeach --}}


            </tbody>
        </table>
        <br>

        <img src="{{ URL::asset('img/logo-RSUD-SLG.png') }}" width="90" height="90">

    </div>
    {{-- <strong style="text-align: left !important;margin-top:20px">Total tiket terjual = {{ $transaksi->count() }}
    <strong style="text-align: left !important;margin-top:20px">Total Pengunjung = {{ $transaksi->count() }} --}}

</body>

</html>
