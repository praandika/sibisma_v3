@extends('layout.app')

@section('title','$title')

@section('css')
	<style>
		.round-2{
			border-radius: 0 50px 50px 0;
		}
	</style>
@endsection

@section('content')

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-4">
    <div class="info-box">
      <!-- Apply any bg-* class to to the icon to color it -->
      <span class="info-box-icon bg-green"><i class="fa fa-motorcycle"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total {{ $cariUnit }}</span>
        <span class="info-box-number">{{ $sumUnit }} Unit</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-xs-12 col-sm-12 col-md-4">
    <div class="info-box">
      <!-- Apply any bg-* class to to the icon to color it -->
      <span class="info-box-icon bg-blue"><i class="fa fa-home"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Lokasi {{ $cariUnit }}</span>
        <span class="info-box-number">{{ $sumDealer }} Dealer</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-xs-12 col-sm-12 col-md-4">
    <div class="info-box">
      <!-- Apply any bg-* class to to the icon to color it -->
      <span class="info-box-icon bg-yellow"><i class="fa fa-tint"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">{{ $cariUnit }}</span>
        <span class="info-box-number">{{ $sumWarna }} Warna</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>

<div class="row">

    <div class="col-xs-12">

      <div class="box">

      	<div class="box-header">

          <div class="row">

          	<div class="col-md-12" align="left">

              <h3 class="box-title"><i class="fa fa-search"></i> Pencarian " {{ $cariUnit }} "</h3>

            </div>

          </div>

        </div>

        <div class="box-body">

        	<form action="{{ URL('inventory/cari') }}" method="GET">

        	{{ csrf_field() }}

        	<div class="row">

      		<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">

              <div class="form-group has-feedback">

                <!-- <input type="text" class="form-control" id="unit" name="cariUnit" placeholder="Cari Unit" value="{{ $cariUnit }}" style="border-color: green; box-shadow: 0px 0px 5px;">

                <span class="fa fa-search form-control-feedback"></span> -->

                <select name="cariUnit" id="unit" class="js-example-basic-multiple-unit form-control" style="border-color: green; box-shadow: 0px 0px 5px;">

					          <option></option>
					
                  @foreach($dataUnit as $o)

                    <option value="{{ $o->nama_motor }}">{{ $o->nama_motor }}</option>

                  @endforeach

                </select>

              </div>

            </div>

            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
              <div class="form-group has-feedback" style="font-size: 100px;">
                <select name="cariWarna" id="warna" class="js-example-basic-multiple-warna form-control">

                  <option></option>

                  @foreach($dataWarna as $o)

                  <option value="{{ $o->warna }}">{{ $o->warna }}</option>

                  @endforeach

                </select>
              </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">

            	<button class="btn btn-success round-2"><i class="fa fa-search"></i> Cari</button>

            </div> 	

          </div>

          </form>

          <hr>

          

          <div class="col-md-12">

          <div class="row">

            <div class="table-responsive">

            <table id="tableIn" class="table table-bordered table-striped table-hover">

              <thead>

                  <tr>

                    <th>#</th>

                    <th>Unit</th>

                    <th>Warna</th>

                    <th>Stok</th>

                    <th>Tahun</th>

                    <th>Lokasi</th>

                    <th>Jenis</th>

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

                    <td>{{ $o->tahun }}</td>

                    <td>{{ $o->nama_dealer }}</td>

                    <td>{{ $o->jenis }}</td>

                  </tr>

                  @endforeach

                  </tbody>

            </table>

          </div> 

          </div>

          </div>

        </div>

      </div>

    </div>

</div>

@endsection

@section('script')

<script>

  $(function () {

    $('#tableIn').DataTable({

      "aLengthMenu": [[50, 75, -1], [50, 75, "All"]],
      "iDisplayLength": 50

    });

  })

</script>

<script>

  $(document).ready(function() {

    $('.js-example-basic-multiple-unit').select2({

      placeholder: "Cari Unit",

      allowClear: true

    });

  });

  $(document).ready(function() {

    $('.js-example-basic-multiple-warna').select2({

      placeholder: "Cari Warna",

      allowClear: true

    });

  });

</script>

@endsection