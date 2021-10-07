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
		@if($home == "AA0101")
		<img src="{{ asset('dist/img/rpt_header_sentral.png') }}" alt="" width="725">
		@elseif($home == "AA0102")
		<img src="{{ asset('dist/img/rpt_header_bmm.png') }}" alt="" width="725">
		@elseif($home == "AA0104")
		<img src="{{ asset('dist/img/rpt_header_ud.png') }}" alt="" width="725">
		@elseif($home == "AA0105")
		<img src="{{ asset('dist/img/rpt_header_tts.png') }}" alt="" width="725">
		@elseif($home == "AA0106")
		<img src="{{ asset('dist/img/rpt_header_imbo.png') }}" alt="" width="725">
		@elseif($home == "AA0107")
		<img src="{{ asset('dist/img/rpt_header_mandiri.png') }}" alt="" width="725">
		@elseif($home == "AA0108")
		<img src="{{ asset('dist/img/rpt_header_wr.png') }}" alt="" width="725">
		@elseif($home == "AA0109")
		<img src="{{ asset('dist/img/rpt_header_sunset.png') }}" alt="" width="725">
		@elseif($home == "AA0104F")
		<img src="{{ asset('dist/img/rpt_header_fss.png') }}" alt="" width="725">
		@else
		<h3>Error Header Tidak menemukan kode dealer</h3>
		@endif
	</div>
	<br>
<!-- Body -->
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<h2><strong>Total Stok : {{ $stok }}</strong></h2>
			</div>
			<table class="table table-bordered display tbreport">
				<thead>
					<tr>
						<th>No</th>
						<th>Unit</th>
						<th>Warna</th>
						<th>Stok</th>
						<th>Jenis</th>
						<th>Tahun</th>
					</tr>
				</thead>										
				<tbody> 
					@php ($no = 1)
					@foreach($data as $o)
					<tr>
						<td>{{ $no++ }}</td>
						<td>{{ $o->nama_motor }}</td>
						@include('template.tdwarna')
						<td>{{ $o->stok }}</td>
						<td>{{ $o->jenis }}</td>
						<td>{{ $o->tahun }}</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
@endsection