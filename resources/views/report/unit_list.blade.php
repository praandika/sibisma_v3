@extends('layout.app')

@section('title','$title')



@section('css')

<style>

	.garis{

		border-top: 1px dashed #1420C5;

	}



	.total{

        color: #AC1A5F;

        font-size: 18px;

        font-style: italic;

        font-weight: bold;

    }



    .garis-footer-1{

        border-top: 6px solid #3C44AD;

    }



    .garis-footer-2{

        border-top: 2px solid #FFFFFF;

    }



    .garis-footer-3{

        border-top: 1px solid #2B2828;

    }

</style>

@endsection



@section('content')

<div class="row">

    <div class="col-xs-12">

      <div class="box">

      	<div class="box-header">

          <div class="row">

          	<div class="col-md-6 col-sm-6 col-lg-6" align="left">

              <h3 class="box-title"><strong><i class="fa fa-sign-in"></i> Stok Bisma Group {{ $tahun }} By Dealer</strong></h3>

            </div>

          </div>

        </div>



        <div class="box-body">

        	<div class="row">

        		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">

        			<h4>

        				<span class="label label-primary">Bisma Sentral</span>

        			</h4>

        			<br>

        			@foreach($sentral as $o)

        			<strong>{{ $o->stok }}</strong> | {{ $o->nama_motor }} | <i><strong>{{ $o->warna }}</strong></i>

					<br>

        			@endforeach

        			<strong class="total">Total : {{ $aa01 }}</strong>

					<hr>

        		</div>



        		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">

        			<h4>

        				<span class="label label-primary">Bisma Cokro</span>

        			</h4>

        			<br>

        			@foreach($bmm as $o)

        			<strong>{{ $o->stok }}</strong> | {{ $o->nama_motor }} | <i><strong>{{ $o->warna }}</strong></i>

					<br>

        			@endforeach

        			<strong class="total">Total : {{ $aa02 }}</strong>

					<hr>

        		</div>

				

				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">

        			<h4>

        				<span class="label label-primary">Bisma Hasanuddin</span>

        			</h4>

        			<br>

        			@foreach($ud as $o)

        			<strong>{{ $o->stok }}</strong> | {{ $o->nama_motor }} | <i><strong>{{ $o->warna }}</strong></i>

					<br>

        			@endforeach

        			<strong class="total">Total : {{ $aa04 }}</strong>

					<hr>

        		</div>

				

				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">

        			<h4>

        				<span class="label label-primary">Bisma TTS</span>

        			</h4>

        			<br>

        			@foreach($tts as $o)

        			<strong>{{ $o->stok }}</strong> | {{ $o->nama_motor }} | <i><strong>{{ $o->warna }}</strong></i>

					<br>

        			@endforeach

        			<strong class="total">Total : {{ $aa05 }}</strong>

					<hr>

        		</div>

        	</div>



        	<div class="garis"></div><br>

        	

        	<div class="row">

        		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">

        			<h4>

        				<span class="label label-primary">Bisma Imbo</span>

        			</h4>

        			<br>

        			@foreach($imbo as $o)

        			<strong>{{ $o->stok }}</strong> | {{ $o->nama_motor }} | <i><strong>{{ $o->warna }}</strong></i>

					<br>

        			@endforeach

        			<strong class="total">Total : {{ $aa06 }}</strong>

					<hr>

        		</div>

				

				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">

        			<h4>

        				<span class="label label-primary">Bisma Mandiri</span>

        			</h4>

        			<br>

        			@foreach($mandiri as $o)

        			<strong>{{ $o->stok }}</strong> | {{ $o->nama_motor }} | <i><strong>{{ $o->warna }}</strong></i>

					<br>

        			@endforeach

        			<strong class="total">Total : {{ $aa07 }}</strong>

					<hr>

        		</div>

				

				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">

        			<h4>

        				<span class="label label-primary">Bisma WR</span>

        			</h4>

        			<br>

        			@foreach($wr as $o)

        			<strong>{{ $o->stok }}</strong> | {{ $o->nama_motor }} | <i><strong>{{ $o->warna }}</strong></i>

					<br>

        			@endforeach

        			<strong class="total">Total : {{ $aa08 }}</strong>

					<hr>

        		</div>

				

				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">

        			<h4>

        				<span class="label label-primary">Bisma Sunset</span>

        			</h4>

        			<br>

        			@foreach($sr as $o)

        			<strong>{{ $o->stok }}</strong> | {{ $o->nama_motor }} | <i><strong>{{ $o->warna }}</strong></i>

					<br>

        			@endforeach

        			<strong class="total">Total : {{ $aa09 }}</strong>

					<hr>

        		</div>

        	</div>



        	<div class="garis"></div><br>



        	<div class="row">

        		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">

        			<h4>

        				<span class="label label-primary">Flagship</span>

        			</h4>

        			<br>

        			@foreach($fss as $o)

        			<strong>{{ $o->stok }}</strong> | {{ $o->nama_motor }} | <i><strong>{{ $o->warna }}</strong></i>

					<br>

        			@endforeach

        			<strong class="total">Total : {{ $aa04F }}</strong>

					<hr>

        		</div>

        	</div>



        	<div class="garis-footer-1"></div>

			<div class="garis-footer-2"></div>

			<div class="garis-footer-3"></div>

			<h3><strong>Grand Total : {{ $grandtotal }}</strong></h3>

			<div class="garis-footer-3"></div>

			<div class="garis-footer-2"></div>

			<div class="garis-footer-1"></div>	



        </div>

      </div>

    </div>

</div>

<hr>

<div class="row">

    <div class="col-xs-12">

      <div class="box">

      	<div class="box-header">

          <div class="row">

          	<div class="col-md-6 col-sm-6 col-lg-6" align="left">

              <h3 class="box-title"><strong><i class="fa fa-sign-in"></i> Stok Bisma Group {{ $tahun }} By Unit</strong></h3>

            </div>

          </div>

        </div>



        <div class="box-body">

        	<div class="row">

        		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

	        		@foreach($data as $o)

	        		<strong>{{ $o->stok }}</strong> | {{ $o->nama_motor }} | <i><strong>{{ $o->warna }}</strong></i>

					<br>

	        		@endforeach

        		</div>

        	</div>

        	<br>



        	<div class="garis-footer-1"></div>

			<div class="garis-footer-2"></div>

			<div class="garis-footer-3"></div>

			<h3><strong>Grand Total : {{ $total }}</strong></h3>

			<div class="garis-footer-3"></div>

			<div class="garis-footer-2"></div>

			<div class="garis-footer-1"></div>	



        </div>

      </div>

    </div>

</div>

@endsection