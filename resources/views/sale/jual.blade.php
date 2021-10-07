@extends('layout.app')

<?php

function serialize_to_string($serial)

{

    $text = unserialize($serial);

    return implode(', ', $text);

}

?>

@section('title','$title')



@section('content')

<div class="row">

    <div class="col-xs-12">

      <div class="box">

      	<div class="box-header">

          <div class="row hidden-xs">

            <div class="col-md-6 col-sm-6 col-lg-6" align="left">

              <h3 class="box-title" style="color: green;"><strong><i class="fa fa-check"></i> {{ $total }} Unit</strong></h3>

            </div>

            <div class="col-md-6 col-sm-6 col-lg-6" align="right">

              <h3 class="box-title"><strong><i class="fa fa-motorcycle"></i> {{ $stok }} Unit</strong></h3>

            </div>

          </div>

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-md-6 col-sm-6 col-lg-6" align="left">

              <h3 class="box-title" style="color: green;"><strong><i class="fa fa-check"></i> {{ $total }} Unit</strong></h3>

            </div>

            <br>

            <div class="col-md-6 col-sm-6 col-lg-6" align="left">

              <h3 class="box-title"><strong><i class="fa fa-motorcycle"></i> {{ $stok }} Unit</strong></h3>

            </div>

          </div>

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <form action="{{ URL('sale/csale') }}" method="POST">

          {{ csrf_field() }}



          @include('template.input_jual')

          

          <div class="row hidden-xs">

            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" align="left">

              <a class="btn btn-info round-custom-1" href="{{ URL('sale/riwayat',$home) }}"><i class="fa fa-clock-o"></i> Riwayat</a>

            </div>

            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-success round-custom-2" type="submit" name="simpan" onmouseover="cekStok()" id="button-simpan"><i class="fa fa-check"></i> Simpan</button>

            </div>           

          </div>



          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12 col-sm-12" align="right">

              <a class="btn btn-info round-custom-2" href="{{ URL('sale/riwayat',$home) }}"><i class="fa fa-clock-o"></i> Riwayat</a>

              <button class="btn btn-success round-custom-1" type="submit" name="simpan" onmouseover="cekStok()" id="button-simpan"><i class="fa fa-check"></i> Simpan</button>

            </div>

          </div><br>



          </form>

          <!-- TABEL -->

          <div class="table-responsive">

            <table id="tableIn" class="table table-bordered table-striped table-hover">

              <thead>

                  <tr>

                    <th>#</th>

                    <th>Tanggal Jual</th>

                    <th>Unit</th>

                    <th>Warna</th>

                    <th>Tahun</th>

                    <th>QTY</th>

                    <th>Leasing</th>

                    @if(Session::get('akses') == "super" OR Session::get('akses') == "admin")

                    <th>Aksi</th>

                    @endif

                  </tr>

                  </thead>

                  <tbody>

                  @php ($no = 1)

                  @foreach($jual as $o)

                  <tr>

                    <td>{{ $no++ }}</td>

                    <td>{{ $o->tanggal_jual }}</td>

                    <td>{{ $o->nama_motor }}</td>

                    @include('template.tdwarna')

                    <td>{{ $o->tahun }}</td>

                    <td>{{ $o->qty }}</td>

                    <td>{{ serialize_to_string($o->leasing) }}</td>

                    @if(Session::get('akses') == "super" OR Session::get('akses') == "admin")

                    <td>

                      <abbr title="Hapus"><a class="btn btn-flat btn-danger" href="{{ URL('sale/dsale',$o->id_jual) }}" onclick="return tanya('Yakin hapus {{ $o->nama_motor }} {{ $o->warna }} {{ $o->tahun }}?')"><i class="fa fa-trash"></i></a></abbr>

                    </td>

                    @endif

                  </tr>

                  @endforeach

                  </tbody>

            </table>

          </div>   

          <!-- END TABEL -->



        </div>

      </div>

  </div>

</div>



<!-- ========================================================== -->

<!-- Modal Unit Dealer -->

<div class="modal fade" id="myStok" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Daftar Unit {{ $dealer }}</h4>

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



        @include('modal.stok_dealer')



      <!-- End Modal Footer -->

      

    </div>

  </div>

</div>

<!-- End Modal -->

<!-- =================================================================== -->



@endsection

@section('script')

<script>

  $(function () {

    $('#tableIn').DataTable({

      "searching": false,

      "paging": false,

      "lengthChange": false

    })

  })



  $(function () {

    $('#TableStok').DataTable({

      "aLengthMenu": [[50, 75, -1], [50, 75, "All"]],

      "iDisplayLength": 50

    })

  })



  $(function () {

    $('#MyTable1').DataTable({

      "aLengthMenu": [[50, 75, -1], [50, 75, "All"]],

      "iDisplayLength": 50

    })

  })

</script>



<script type="text/javascript">

  //passing data ke input text

  $(document).on('click', '.pilih', function (e){

    document.getElementById("unit1").value = $(this).attr('data-unit1');

    document.getElementById("jenis1").value = $(this).attr('data-jenis1');

    document.getElementById("warna").value = $(this).attr('data-warna');

    document.getElementById("tahun").value = $(this).attr('data-tahun');

    document.getElementById("stok").value = $(this).attr('data-stok');

    document.getElementById("id_stok").value = $(this).attr('data-id_stok');

    $('#myStok').modal('hide');

  });

</script>



<script>

   //Date picker

    $('#datepicker').datepicker({

      format: "yyyy-mm-dd",

      autoclose: true

    })

</script>



<script>

  $(document).ready(function() {

    $('.js-example-basic-multiple').select2({

      placeholder: "Pilih Leasing",

      allowClear: true

    });

  });

</script>



<script>

  function cekStok(){

    var a = document.getElementById("stok").value;

    var b = document.getElementById("qty").value;

    var stok = parseInt(a);

    var qty = parseInt(b);



    if (qty > stok) {

      document.getElementById("alert-stok").innerHTML = "Stok tidak cukup!"

      document.getElementById("button-simpan").disabled = true

    }else if (qty < 0) {

      document.getElementById("alert-stok").innerHTML = "Qty tidak boleh minus!"

      document.getElementById("button-simpan").disabled = true

    }else{

      document.getElementById("alert-stok").innerHTML = ""

      document.getElementById("button-simpan").disabled = false

    }

  }

</script>

@endsection