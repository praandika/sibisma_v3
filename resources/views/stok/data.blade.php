@extends('layout.app')

@section('title','$title')



@section('content')

<div class="row">

    <div class="col-xs-12">

      <div class="box">

      	<div class="box-header">

          <div class="row">

            <div class="col-md-9" align="left">

              <h3 class="box-title">Tabel {{ $title }} | <strong><i class="fa fa-motorcycle"></i> {{ $stok }} Unit</strong></h3>

            </div>

          </div>

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

          <div class="row hidden-xs">

            <div class="col-lg-6 col-md-6 col-sm-6" align="left">

               <button class="btn btn-success round-custom-1" data-toggle="modal" data-target="#myData"><i class="fa fa-plus"></i> Tambah</button>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6" align="right">

               <a href="{{ URL('report/stok/excel',$home) }}" class="btn btn-success round-custom-2"><i class="fa fa-file-excel-o"></i> Export Excel</a>

               <a href="{{ URL('report/stok/print',$home) }}" class="btn btn-primary round-custom-1"><i class="fa fa-print"></i> Cetak</a>

            </div>

          </div>



          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-lg-12 col-md-12 col-sm-12" align="left">

               <button class="btn btn-success round-custom-2" data-toggle="modal" data-target="#myData"><i class="fa fa-plus"></i> Tambah</button>

               <a href="{{ URL('report/stok/excel',$home) }}" class="btn btn-flat btn-success"><i class="fa fa-file-excel-o"></i> Export Excel</a>

               <a href="{{ URL('report/stok/print',$home) }}" class="btn btn-primary round-custom-1"><i class="fa fa-print"></i> Cetak</a>

            </div>

          </div>

         <br><br>

          @endif

          <form action="{{ URL('stok/dstok') }}" method="POST">

          {{ csrf_field() }}

          

          @include('template.tb_stok')


          @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

          <button class="btn btn-danger round-custom-1" onclick="return tanya('Yakin hapus data ini?')"><i class="fa fa-trash"></i> Hapus Terpilih</button>

          @endif

          </form>

        </div>

      </div>

  </div>

</div>

<!-- ========================================================== -->

<!-- Modal Tambah Stok -->

<div class="modal fade" id="myData" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Tambah {{$title}}</h4>

          </div>

          <div class="col-lg-1">

            <!-- Button Close -->

            <button class="close" type="button" data-dismiss="modal">&times;</button>

            <!-- End Button Close -->

          </div>

        </div>

      </div>

      <!-- End Header Modal -->

           <!-- Modal Body -->

      <form action="{{URL('stok/cstok')}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}



      @include('modal.stok')



      </form>

      <!-- End Modal Footer -->

      

    </div>

  </div>

</div>

<!-- End Modal -->

<!-- =================================================================== -->



<!-- ========================================================== -->

@foreach($data as $o)

<!-- Modal Edit Admin -->

<div class="modal fade" id="myEdit{{ $o->id_stok }}" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Edit {{$title}}</h4>

          </div>

          <div class="col-lg-1">

            <!-- Button Close -->

            <button class="close" type="button" data-dismiss="modal">&times;</button>

            <!-- End Button Close -->

          </div>

        </div>

      </div>

      <!-- End Header Modal -->



      <!-- Modal Body -->

      <form action="{{URL('stok/ustok')}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}



        @include('modal.edit_stok')



      </form>

      <!-- End Modal Footer -->

      

    </div>

  </div>

</div>

<!-- End Modal -->

<!-- =================================================================== -->

@endforeach



@include('modal.unit')

@include('modal.detail_stok')





@endsection

@section('script')

<script>

  $(function () {

    $('#myTable').DataTable({

      "aLengthMenu": [[50, 75, -1], [50, 75, "All"]],

      "iDisplayLength": 50

    })

  })



  $(function () {

    $('#myTable1').DataTable({

      "aLengthMenu": [[50, 75, -1], [50, 75, "All"]],

      "iDisplayLength": 50

    })

  })

</script>



<script>

  $(document).ready(function() {

    $('.warna-example').select2({

      placeholder: "Pilih Warna",

      allowClear: true

    });

  });

</script>



<script>

  $("#checkAll").click(function () {

  $('input:checkbox').not(this).prop('checked', this.checked);

});

</script>



<script type="text/javascript">

  //passing data ke input text

  $(document).on('click', '.klik', function (e){

    document.getElementById("unit").value = $(this).attr('data-unit');

    document.getElementById("jenis").value = $(this).attr('data-jenis');

    document.getElementById("id_unit").value = $(this).attr('data-id_unit');

    $('#myModal').modal('hide');

  });

</script>

@endsection