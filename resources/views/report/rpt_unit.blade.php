@extends('layout.rpt_app')

@section('title',$title)



@section('content')

<div class="container">

<!-- Header -->

<div class="row">

	<div class="col-md-12">

		<span class="tanggal">Tanggal Print : {{ Carbon\Carbon::parse($tgl)->formatLocalized('%d %B %Y') }}</span>		

	</div>	

</div>



<br>

	<div class="row">

		<img src="{{ asset('dist/img/rpt_stok_bisma_group.png') }}" alt="" width="725">

		<br>

		<center><h2><strong>- Stok : {{ $tahun }} -</strong></h2></center>

	</div>

	<br>

<!-- Body -->

	<div class="row">

		<div class="col-md-12">

			<table class="table table-bordered display tbreport">

				<thead>

					<tr>

						<th class="label-header">Bisma Sentral</th>

					</tr>

					<tr>

						<th>Unit</th>

						<th>Warna</th>

						<th width="10">Stok</th>

					</tr>

				</thead>										

				<tbody> 

					@foreach($sentral as $o)

					<tr>

						<td>{{ $o->nama_motor }}</td>

						<td>{{ $o->warna }}</td>

						<td>{{ $o->stok }}</td>

					</tr>

					@endforeach

				</tbody>

				<tfoot>

					<tr>

						<th></th>

						<th align="right">Total Stok Sentral: </th>

						<th>{{ $aa01 }}</th>

					</tr>

				</tfoot>

			</table>

		</div>

	</div>

	<br>



	<div class="row">

		<div class="col-md-12">

			<table class="table table-bordered display tbreport">

				<thead>

					<tr>

						<th class="label-header">Bisma Cokro</th>

					</tr>

					<tr>

						<th>Unit</th>

						<th>Warna</th>

						<th width="10">Stok</th>

					</tr>

				</thead>										

				<tbody> 

					@foreach($bmm as $o)

					<tr>

						<td>{{ $o->nama_motor }}</td>

						<td>{{ $o->warna }}</td>

						<td>{{ $o->stok }}</td>

					</tr>

					@endforeach

				</tbody>

				<tfoot>

					<tr>

						<th></th>

						<th align="right">Total Stok BMM: </th>

						<th>{{ $aa02 }}</th>

					</tr>

				</tfoot>

			</table>

		</div>

	</div>

	<br>



	<div class="row">

		<div class="col-md-12">

			<table class="table table-bordered display tbreport">

				<thead>

					<tr>

						<th class="label-header">Bisma Hasanuddin</th>

					</tr>

					<tr>

						<th>Unit</th>

						<th>Warna</th>

						<th width="10">Stok</th>

					</tr>

				</thead>										

				<tbody> 

					@foreach($ud as $o)

					<tr>

						<td>{{ $o->nama_motor }}</td>

						<td>{{ $o->warna }}</td>

						<td>{{ $o->stok }}</td>

					</tr>

					@endforeach

				</tbody>

				<tfoot>

					<tr>

						<th></th>

						<th align="right">Total Stok Hasanuddin: </th>

						<th>{{ $aa04 }}</th>

					</tr>

				</tfoot>

			</table>

		</div>

	</div>

	<br>



	<div class="row">

		<div class="col-md-12">

			<table class="table table-bordered display tbreport">

				<thead>

					<tr>

						<th class="label-header">Bisma TTS</th>

					</tr>

					<tr>

						<th>Unit</th>

						<th>Warna</th>

						<th width="10">Stok</th>

					</tr>

				</thead>										

				<tbody> 

					@foreach($tts as $o)

					<tr>

						<td>{{ $o->nama_motor }}</td>

						<td>{{ $o->warna }}</td>

						<td>{{ $o->stok }}</td>

					</tr>

					@endforeach

				</tbody>

				<tfoot>

					<tr>

						<th></th>

						<th align="right">Total Stok TTS: </th>

						<th>{{ $aa05 }}</th>

					</tr>

				</tfoot>

			</table>

		</div>

	</div>

	<br>



	<div class="row">

		<div class="col-md-12">

			<table class="table table-bordered display tbreport">

				<thead>

					<tr>

						<th class="label-header">Bisma Imbo</th>

					</tr>

					<tr>

						<th>Unit</th>

						<th>Warna</th>

						<th width="10">Stok</th>

					</tr>

				</thead>										

				<tbody> 

					@foreach($imbo as $o)

					<tr>

						<td>{{ $o->nama_motor }}</td>

						<td>{{ $o->warna }}</td>

						<td>{{ $o->stok }}</td>

					</tr>

					@endforeach

				</tbody>

				<tfoot>

					<tr>

						<th></th>

						<th align="right">Total Stok Imbo: </th>

						<th>{{ $aa06 }}</th>

					</tr>

				</tfoot>

			</table>

		</div>

	</div>

	<br>



	<div class="row">

		<div class="col-md-12">

			<table class="table table-bordered display tbreport">

				<thead>

					<tr>

						<th class="label-header">Bisma Mandiri</th>

					</tr>

					<tr>

						<th>Unit</th>

						<th>Warna</th>

						<th width="10">Stok</th>

					</tr>

				</thead>										

				<tbody> 

					@foreach($mandiri as $o)

					<tr>

						<td>{{ $o->nama_motor }}</td>

						<td>{{ $o->warna }}</td>

						<td>{{ $o->stok }}</td>

					</tr>

					@endforeach

				</tbody>

				<tfoot>

					<tr>

						<th></th>

						<th align="right">Total Stok Mandiri: </th>

						<th>{{ $aa07 }}</th>

					</tr>

				</tfoot>

			</table>

		</div>

	</div>

	<br>



	<div class="row">

		<div class="col-md-12">

			<table class="table table-bordered display tbreport">

				<thead>

					<tr>

						<th class="label-header">Bisma WR</th>

					</tr>

					<tr>

						<th>Unit</th>

						<th>Warna</th>

						<th width="10">Stok</th>

					</tr>

				</thead>										

				<tbody> 

					@foreach($wr as $o)

					<tr>

						<td>{{ $o->nama_motor }}</td>

						<td>{{ $o->warna }}</td>

						<td>{{ $o->stok }}</td>

					</tr>

					@endforeach

				</tbody>

				<tfoot>

					<tr>

						<th></th>

						<th align="right">Total Stok WR: </th>

						<th>{{ $aa08 }}</th>

					</tr>

				</tfoot>

			</table>

		</div>

	</div>



	<div class="row">

		<div class="col-md-12">

			<table class="table table-bordered display tbreport">

				<thead>

					<tr>

						<th class="label-header">Bisma Sunset</th>

					</tr>

					<tr>

						<th>Unit</th>

						<th>Warna</th>

						<th width="10">Stok</th>

					</tr>

				</thead>										

				<tbody> 

					@foreach($sr as $o)

					<tr>

						<td>{{ $o->nama_motor }}</td>

						<td>{{ $o->warna }}</td>

						<td>{{ $o->stok }}</td>

					</tr>

					@endforeach

				</tbody>

				<tfoot>

					<tr>

						<th></th>

						<th align="right">Total Stok Sunset: </th>

						<th>{{ $aa09 }}</th>

					</tr>

				</tfoot>

			</table>

		</div>

	</div>

	<br>



	<div class="row">

		<div class="col-md-12">

			<table class="table table-bordered display tbreport">

				<thead>

					<tr>

						<th class="label-header">Flagship</th>

					</tr>

					<tr>

						<th>Unit</th>

						<th>Warna</th>

						<th width="10">Stok</th>

					</tr>

				</thead>										

				<tbody> 

					@foreach($fss as $o)

					<tr>

						<td>{{ $o->nama_motor }}</td>

						<td>{{ $o->warna }}</td>

						<td>{{ $o->stok }}</td>

					</tr>

					@endforeach

				</tbody>

				<tfoot>

					<tr>

						<th></th>

						<th align="right">Total Stok Flagship: </th>

						<th>{{ $aa04F }}</th>

					</tr>

				</tfoot>

			</table>

		</div>

	</div>

	<br>



	<h2>Grand Total : {{ $grandtotal }}</h2>							

</div>

@endsection