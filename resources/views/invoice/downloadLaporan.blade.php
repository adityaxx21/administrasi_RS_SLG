<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>invoice order receipt - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
<!-- BEGIN INVOICE -->
<div class="col-xs-12">
	<div class="grid invoice">
		<div class="grid-body">
			<div class="invoice-title">
				<div class="row">
					<div class="col-xs-12">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-xs-12">
						<h2>Laporan Pelayanan</h2><br>
						<h3>RSUD Simpang Lima Gumul</h3>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<h3>Detail Pendaftaran</h3>
					<table class="table table-striped">
						<thead>
							<tr class="line">
								<td class="text-center"><strong>ID</strong></td>
								<td class="text-center"><strong>NAMA INSTANSI</strong></td>
								<td class="text-center"><strong>JENIS PELAYANAN</strong></td>
								<td class="text-right"><strong>DURASI PELAYNANA</strong></td>
								<td class="text-right"><strong>JUMLAH PELAYNANA</strong></td>
								<td class="text-right"><strong>METODE PEMBAYARAN</strong></td>
								<td class="text-right"><strong>BIAYA PER SATUAN</strong></td>
								<td class="text-right"><strong>SUBTOTAL</strong></td>
							</tr>
						</thead>
						<tbody>
							@foreach ($pelayanan as $key=>$item)
							<tr>
								<td>{{$item=}}</td>
								<td><strong>{{$item->}}</strong><br>{{$item->nomor_induk}}</td>
								<td class="text-center">{{$instansi->durasi_pelayanan}}</td>
								<td class="text-center">{{$instansi->satuan_waktu}}</td>
								<td class="text-right">Rp. {{$instansi->biaya}}</td>
								<td class="text-right">Rp. {{$instansi->biaya * $instansi->durasi_pelayanan}}</td>
							</tr>
							@endforeach
							<tr>
								<td colspan="4">
								</td><td class="text-right"><strong>Total</strong></td>
								<td class="text-right"><strong>Rp. {{$instansi->total_biaya_pelayanan}}</strong></td>
							</tr>
						</tbody>
					</table>
				</div>									
			</div>
		</div>
	</div>
</div>
<!-- END INVOICE -->
</div>

</body>
</html>