@extends('layout.app')

@section('title','$title')



@section('content')



<div class="col-md-12">

    <div class="box box-primary box-solid">

        <div class="box-header with-border">

            <h3 class="box-title"><i class="fa fa-print"></i> Print</h3>



            <div class="box-tools pull-right">

            	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

                </button>

            </div>

              <!-- /.box-tools -->

        </div>

            <!-- /.box-header -->

        <div class="box-body">

            @foreach($tahun as $o)
            <a href="{{ URL('report/unit/print',$o->tahun) }}" style="color:#ffffff;">
            <div class="col-lg-3 col-xs-6">

	          <!-- small box -->

	          <div class="small-box bg-blue">

	            <div class="inner" style="padding-left:10px;">

	              <h3>{{ $o->tahun }}</h3>



	              <p>Unit</p>

	            </div>

	            <div class="icon">

	              <i class="fa fa-print"></i>

	            </div>

	            <a href="{{ URL('report/unit/print',$o->tahun) }}" class="small-box-footer" style="color: #FCD916;">

	            	<strong><i>Cetak</strong> Daftar Unit </i><i class="fa fa-print"></i>

	            </a>

	          </div>

	        </div>
          </a>

            @endforeach

        </div>

            <!-- /.box-body -->

    </div>

          <!-- /.box -->

</div>



<!-- ====================================================== -->



<div class="col-md-12">

    <div class="box box-success box-solid">

        <div class="box-header with-border">

            <h3 class="box-title"><i class="fa fa-file-excel-o"></i> Export Excel</h3>



            <div class="box-tools pull-right">

            	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

                </button>

            </div>

              <!-- /.box-tools -->

        </div>

            <!-- /.box-header -->

        <div class="box-body">

            @foreach($tahun as $o)
            <a href="{{ URL('report/unit/excel',$o->tahun) }}" style="color:#ffffff;">
            <div class="col-lg-3 col-xs-6">

	          <!-- small box -->

	          <div class="small-box bg-green">

	            <div class="inner" style="padding-left:10px;">

	              <h3>{{ $o->tahun }}</h3>



	              <p>Unit</p>

	            </div>

	            <div class="icon">

	              <i class="fa fa-file-excel-o"></i>

	            </div>

	            <a href="{{ URL('report/unit/excel',$o->tahun) }}" class="small-box-footer" style="color: #FCD916;">

	            	<strong><i>Export</strong> Daftar Unit </i><i class="fa fa-file-excel-o"></i>

	            </a>

	          </div>

	        </div>
          </a>
            @endforeach

        </div>

            <!-- /.box-body -->

    </div>

          <!-- /.box -->

</div>



<!-- ================================================= -->



<div class="col-md-12">

    <div class="box box-warning box-solid">

        <div class="box-header with-border">

            <h3 class="box-title"><i class="fa fa-eye"></i> Preview</h3>



            <div class="box-tools pull-right">

            	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

                </button>

            </div>

              <!-- /.box-tools -->

        </div>

            <!-- /.box-header -->

        <div class="box-body">

            @foreach($tahun as $o)
            <a href="{{ URL('report/unit/view',$o->tahun) }}" style="color:#ffffff">
            <div class="col-lg-3 col-xs-6">

	          <!-- small box -->

	          <div class="small-box bg-orange">

	            <div class="inner" style="padding-left:10px;">

	              <h3>{{ $o->tahun }}</h3>



	              <p>Unit</p>

	            </div>

	            <div class="icon">

	              <i class="fa fa-motorcycle"></i>

	            </div>

	            <a href="{{ URL('report/unit/view',$o->tahun) }}" class="small-box-footer">

	            	<strong><i>View</strong> Daftar Unit </i><i class="fa fa-eye"></i>

	            </a>

	          </div>

	        </div>
          </a>
            @endforeach

        </div>

            <!-- /.box-body -->

    </div>

          <!-- /.box -->

</div>

@endsection