@extends('layout.app')

@section('title','$title')



@section('content')

<div class="row">

    <div class="col-xs-12">

      <div class="box">

      	<div class="box-header">

          <div class="row hidden-xs">

            <div class="col-md-6 col-sm-6 col-lg-6" align="left">

              <h3 class="box-title" style="color: #EF2727;"><strong><i class="fa fa-sign-out"></i> {{ $total }} Unit</strong></h3>

            </div>

            <div class="col-md-6 col-sm-6 col-lg-6" align="right">

              <h3 class="box-title"><strong><i class="fa fa-motorcycle"></i> {{ $stok }} Unit</strong></h3>

            </div>

          </div>

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-md-6 col-sm-6 col-lg-6" align="left">

              <h3 class="box-title" style="color: #EF2727;"><strong><i class="fa fa-sign-out"></i> {{ $total }} Unit</strong></h3>

            </div>

            <br>

            <div class="col-md-6 col-sm-6 col-lg-6" align="left">

              <h3 class="box-title"><strong><i class="fa fa-motorcycle"></i> {{ $stok }} Unit</strong></h3>

            </div>

          </div>

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <form action="{{ URL('out/ckeluar') }}" method="POST">

          {{ csrf_field() }}



          @include('template.input_keluar')

          

          <div class="row hidden-xs">

            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" align="left">

              <a class="btn btn-info round-custom-1" href="{{ URL('out/riwayat',$home) }}"><i class="fa fa-clock-o"></i> Riwayat</a>

            </div>

            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-success round-custom-2" type="submit" name="keluar" id="button-simpan" onmouseover="cekStok()"><i class="fa fa-sign-out"></i> Simpan</button>

            </div>           

          </div>



          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12 col-sm-12" align="right">

              <a class="btn btn-info round-custom-2" href="{{ URL('out/riwayat',$home) }}"><i class="fa fa-clock-o"></i> Riwayat</a>

              <button class="btn btn-success round-custom-1" type="submit" name="keluar" id="button-simpan" onmouseover="cekStok()"><i class="fa fa-sign-out"></i> Simpan</button>

            </div>

          </div><br>



          </form>

          <!-- TABEL -->

          <div class="table-responsive">

            <table id="tableIn" class="table table-bordered table-striped table-hover">

              <thead>

                  <tr>

                    <th>#</th>

                    <th>Tanggal Keluar</th>

                    <th>Tujuan</th>

                    <th>Unit</th>

                    <th>Warna</th>

                    <th>Tahun</th>

                    <th>QTY</th>

                    @if(Session::get('akses') == "super" OR Session::get('akses') == "admin")

                    <th>Aksi</th>

                    @endif

                  </tr>

                  </thead>

                  <tbody>

                  @php ($no = 1)

                  @foreach($keluar as $o)

                  <tr>

                    <td>{{ $no++ }}</td>

                    <td>{{ $o->tanggal_keluar }}</td>

                    <td>{{ $o->cabang }}</td>

                    <td>{{ $o->nama_motor }}</td>

                    @include('template.tdwarna')

                    <td>{{ $o->tahun }}</td>

                    <td>{{ $o->qty_out }}</td>

                    @if(Session::get('akses') == "super" OR Session::get('akses') == "admin")

                    <td>

                      <abbr title="Hapus"><a class="btn btn-flat btn-danger" href="{{ URL('out/dkeluar',$o->id_keluar) }}" onclick="return tanya('Yakin hapus {{ $o->nama_motor }} {{ $o->warna }} {{ $o->tahun }}?')"><i class="fa fa-trash"></i></a></abbr>

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

    document.getElementById("id_stok1").value = $(this).attr('data-id_stok');

    document.getElementById("id_stok2").value = $(this).attr('data-id_stok');

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