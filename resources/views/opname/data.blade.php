@extends('layout.app')

@section('title','$title')



@section('content')

<div class="row">

  <div class="col-lg-3 col-xs-12">

    <!-- small box -->

    <div class="small-box bg-green">

      <div class="inner">

        <h3>{{ $stok }} <sup style="font-size: 20px">Unit</sup></h3>



        <p>Stok {{ $dealer }}</p>

      </div>

      <div class="icon">

        <i class="ion ion-stats-bars"></i>

      </div>

      <a href="#" class="small-box-footer">Bisma Group</a>

    </div>

  </div>



    <div class="col-xs-12">

      <div class="box">

        <div class="box-header">

          <div class="row">

            <div class="col-md-6 col-sm-6 col-lg-6" align="left">

              <h3 class="box-title"><strong><i class="fa fa-briefcase"></i> {{ $title }}</strong></h3>

            </div>

          </div>

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <form action="{{ URL('opname/copname') }}" method="POST">

          {{ csrf_field() }}



          @include('template.input_opname')

          

          <div class="row hidden-xs">

            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" align="left">

              <a class="btn btn-info round-custom-1" href="{{ URL('opname/riwayat',$home) }}"><i class="fa fa-clock-o"></i> Riwayat</a>

            </div>

            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-success round-custom-2" type="submit" name="simpan" id="button-simpan"><i class="fa fa-check"></i> Simpan</button>

            </div>           

          </div>



          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12 col-sm-12" align="right">

              <a class="btn btn-info round-custom-2" href="{{ URL('opname/riwayat',$home) }}"><i class="fa fa-clock-o"></i> Riwayat</a>

              <button class="btn btn-success round-custom-1" type="submit" name="simpan" id="button-simpan"><i class="fa fa-check"></i> Simpan</button>

            </div>

          </div><br>



          </form>



          <form action="{{ URL('opname/dopname') }}" method="POST">

          {{ csrf_field() }}

          <!-- TABEL -->

          <div class="table-responsive">

            <table id="tableIn" class="table table-bordered table-striped table-hover">

              <thead>

                  <tr>

                    @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

                    <th><input type="checkbox" id="checkAll"> <label for="checkAll">#</label></th>

                    @else

                    <th>#</th>

                    @endif

                    <th>Tanggal Opname</th>

                    <th>Unit</th>

                    <th>Warna</th>

                    <th>Tahun</th>

                    <th>Stok Sistem</th>

                    <th>Stok Opname</th>

                    <th>Selisih</th>

                  </tr>

                  </thead>

                  <tbody>

                  @php ($no = 1)

                  @foreach($opname as $o)

                  <tr>

                    <td><input type="checkbox" id="checkData" name="pilih[]" value="{{ $o->id_opname }}">{{ $no++ }}</td>

                    <td>{{ $o->tanggal_opname }}</td>

                    <td>{{ $o->nama_motor }}</td>

                    @include('template.tdwarna')

                    <td>{{ $o->tahun }}</td>

                    <td>{{ $o->stok_sistem }}</td>

                    <td>{{ $o->stok_opname }}</td>

                    <td>{{ $o->selisih }}</td>

                  </tr>

                  @endforeach

                  </tbody>

            </table>

          </div>   

          <!-- END TABEL -->

          @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

          <button class="btn btn-danger round-custom-1" onclick="return tanya('Yakin hapus data ini?')"><i class="fa fa-trash"></i> Hapus Terpilih</button>

          @endif

          </form>

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