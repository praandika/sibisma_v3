@extends('layout.app')

@section('title','$title')



@section('content')

<div class="row">

    <div class="col-xs-12">

      <div class="box">

      	<div class="box-header">

          <div class="row">

            <div class="col-md-9" align="left">

              <h3 class="box-title">Tabel {{ $title }}</h3>

            </div>

          </div>

          

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div class="row">

            <div class="col-md-6" align="left">

              <form action="{{ URL('report/riilcari') }}" method="GET">

                {{ csrf_field() }}

                <div class="row">

                  <div class="col-md-4">

                    <div class="form-group has-feedback">

                      <input type="text" class="form-control" id="datepicker1" name="awal" placeholder="Pilih Tanggal" readonly="readonly" value="{{ $now }}" value="{{ old('now') }}">

                      <span class="fa fa-calendar form-control-feedback"></span>

                    </div>

                  </div>

                  <div class="col-md-4">

                    <div class="form-group has-feedback">

                      <input type="text" class="form-control" id="datepicker2" name="akhir" placeholder="Pilih Tanggal" readonly="readonly" value="{{ $now }}" value="{{ old('now') }}">

                      <span class="fa fa-calendar form-control-feedback"></span>

                    </div>

                  </div>

                  <div class="col-md-2">

                    <button class="btn btn-success round-custom-1"><i class="fa fa-search"></i> Cari</button>

                  </div>

                </div>

              </form>

            </div>



            <div class="col-md-6" align="right">

              <a href="{{ URL('report/riil/excel/'.$awal.'/'.$akhir.'') }}" class="btn btn-success round-custom-2"><i class="fa fa-file-excel-o"></i> Export Excel</a>

            </div>

          </div>

          <div class="table-responsive">

        	<table id="myTable" class="table table-bordered table-striped table-hover">

        		<thead>

                <tr>

                  <th>Kode Dealer</th>

                  <th>Tanggal_Jual</th>

                  <th>Nama Motor</th>

                  <th>QTY</th>

                </tr>

                </thead>

                <tbody>

                @php ($no = 1)

                @foreach($data as $o)

                <tr>

                  <td>{{ $o->dealer_kode }}</td>

                  <td>{{ $o->tanggal_jual }}</td>

                  <td>{{ $o->nama_motor }}</td>

                  <td>{{ $o->qty }}</td>

                </tr>

                @endforeach

                </tbody>

        	</table>

          </div>

        </div>

      </div>

  </div>

</div>

@endsection

@section('script')

<script>

  $(function () {

    $('#myTable').DataTable({

      "aLengthMenu": [[50, 75, -1], [50, 75, "All"]],

      "iDisplayLength": 50

    })

  })

</script>



<script>

  $("#checkAll").click(function () {

  $('input:checkbox').not(this).prop('checked', this.checked);

});

</script>



<script>

  $('#datepicker1').datepicker({

    format: "yyyy-mm-dd",

    autoclose: true

  });



  $('#datepicker2').datepicker({

    format: "yyyy-mm-dd",

    autoclose: true

  });

</script>

@endsection