@extends('layout.app')

@section('title','$title')



@section('content')

<div class="row">

    <div class="col-xs-12 col-lg-12">

      <div class="box">

      	<div class="box-header">

          <div class="row">

            <div class="col-md-9" align="left">

              <h3 class="box-title">Tabel Faktur dan Service</h3>

            </div>

          </div>

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

          <div class="row">

            <div class="col-lg-6" align="left">

               <button class="btn btn-success round-custom-1" data-toggle="modal" data-target="#myData"><i class="fa fa-plus"></i> Catat</button>

            </div>

          </div>

         <br><br>

          @endif

          <div class="table-responsive">

          	<form action="{{ URL('fands/deleteall') }}" method="POST">

          	{{ csrf_field() }}

        	<table id="myTable" class="table table-bordered table-striped table-hover">

        		<thead>

                <tr>

                  @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

                  <th><input type="checkbox" id="checkAll"> <label for="checkAll">#</label></th>

                  @else

                  <th>#</th>

                  @endif

                  <th>Tanggal</th>

                  <th>Faktur</th>

                  <th>Service</th>

                  @if(Session::get('akses') == "super")

                  <th>Dealer</th>

                  @endif

                  @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

                  <th>Aksi</th>

                  @endif

                </tr>

                </thead>

                <tbody>

                @php ($no = 1)

                @foreach($data as $o)

                <tr>

                	<td><input type="checkbox" id="checkData" name="pilih[]" value="{{ $o->id_fs }}"> {{ $no++ }}</td>

                	<td>{{ $o->tanggal_fs }}</td>

                  <td>{{ $o->faktur }}</td>

                  <td>{{ $o->service }}</td>

                  @if(Session::get('akses') == "super")

                  <td>{{ $o->dealer_kode }}</td>

                  @endif

                  @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

                  <td>

                    <abbr title="Edit"><a class="btn btn-flat btn-primary" data-toggle="modal" data-target="#myEdit{{ $o->id_fs }}"><i class="fa fa-pencil"></i></a></abbr> 

                  </td>

                  @endif

                </tr>

                @endforeach

                </tbody>

        	</table>

        	<button class="btn btn-danger round-custom-1" onclick="return tanya('Yakin hapus data ini?')"><i class="fa fa-trash"></i> Hapus Terpilih</button>

        	</form>

          </div>

        </div>

      </div>

  </div>

</div>

<!-- ========================================================== -->

@foreach($data as $o)

<!-- Modal Edit Leasing -->

<div class="modal fade" id="myEdit{{ $o->id_fs }}" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Edit Faktur Service</h4>

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

      <form action="{{URL('fands/update')}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="modal-body">

          <div class="container">

            <input type="hidden" name="id" value="{{ $o->id_fs }}">

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" id="datepicker" name="tanggal" placeholder="Pilih Tanggal" readonly="readonly" value="{{ $now }}" required="required">

                <span class="fa fa-calendar form-control-feedback"></span>

              </div>

            </div>  

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="number" class="form-control" placeholder="Jumlah Faktur" name="faktur" required="required" value="{{ $o->faktur }}" required="required">

                <span class="fa fa-file-text form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="number" class="form-control" placeholder="Jumlah Service" name="service" required="required" value="{{ $o->service }}" required="required">

                <span class="fa fa-wrench form-control-feedback"></span>

              </div>

            </div>

            </div>

            @if(Session::get('akses') == "super")



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <select name="dealer" id="dealer" class="form-control" required="required">

                  <option disabled="disabled">Pilih Dealer</option>

                  <option value="AA0101">Bisma Sentral</option>

                  <option value="AA0102">Bisma Cokro</option>

                  <option value="AA0104">Bisma Hasanuddin</option>

                  <option value="AA0105">Bisma TTS</option>

                  <option value="AA0106">Bisma Imam Bonjol</option>

                  <option value="AA0107">Bisma Mandiri</option>

                  <option value="AA0108">Bisma WR Supratman</option>

                  <option value="AA0109">Bisma Sunset Road</option>

                  <option value="AA0104F">Flagship Shop</option>

                </select>

                <span class="fa fa-home form-control-feedback"></span>

              </div>

            </div>

            </div>

            @elseif(Session::get('akses') == "admin")

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" name="dealer" id="dealer" class="form-control" value="{{ Session::get('dealer') }}" readonly="readonly" required="required">

                <span class="fa fa-home form-control-feedback"></span>

              </div>

            </div>

            </div>

            @endif

          </div>

        </div>

    <!-- End Modal Body -->



        <!-- Modal Footer -->

        <div class="modal-footer">

          <button class="btn btn-primary round-custom-2" type="submit" name="add"><i class="fa fa-floppy-o"></i> Ubah</button>

          <button class="btn btn-warning round-custom-1" type="reset" name="reset"><i class="fa fa-repeat"></i> Reset</button>

        </div>

      </form>

      <!-- End Modal Footer -->

      

    </div>

  </div>

</div>

<!-- End Modal -->

<!-- =================================================================== -->

@endforeach

<!-- ========================================================== -->

<!-- Modal Tambah Leasing -->

<div class="modal fade" id="myData" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Tambah Faktur Service</h4>

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

      <form action="{{URL('fands/store')}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="modal-body">

          <div class="container">

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" id="datepicker2" name="tanggal" placeholder="Pilih Tanggal" readonly="readonly" value="{{ $now }}" required="required">

                <span class="fa fa-calendar form-control-feedback"></span>

              </div>

            </div>  

            </div>



          	<div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="number" class="form-control" placeholder="Jumlah Faktur" name="faktur" required="required" required="required">

                <span class="fa fa-file-text form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="number" class="form-control" placeholder="Jumlah Service" name="service" required="required" required="required">

                <span class="fa fa-wrench form-control-feedback"></span>

              </div>

            </div>

            </div>

            @if(Session::get('akses') == "super")

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <select name="dealer" id="dealer" class="form-control" required="required">

                  <option disabled="disabled" selected="selected" hidden="hidden">Pilih Dealer</option>

                  <option value="AA0101">Bisma Sentral</option>

                  <option value="AA0102">Bisma Cokro</option>

                  <option value="AA0104">Bisma Hasanuddin</option>

                  <option value="AA0105">Bisma TTS</option>

                  <option value="AA0106">Bisma Imam Bonjol</option>

                  <option value="AA0107">Bisma Mandiri</option>

                  <option value="AA0108">Bisma WR Supratman</option>

                  <option value="AA0109">Bisma Sunset Road</option>

                  <option value="AA0104F">Flagship Shop</option>

                </select>

                <span class="fa fa-home form-control-feedback"></span>

              </div>

            </div>

            </div>

            @elseif(Session::get('akses') == "admin")

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" name="dealer" id="dealer" class="form-control" value="{{ Session::get('dealer') }}" readonly="readonly" required="required">

                <span class="fa fa-home form-control-feedback"></span>

              </div>

            </div>

            </div>

            @endif

          </div>

        </div>

    <!-- End Modal Body -->



        <!-- Modal Footer -->

        <div class="modal-footer">

          <button class="btn btn-primary round-custom-2" type="submit" name="add"><i class="fa fa-floppy-o"></i> Simpan</button>

          <button class="btn btn-warning round-custom-1" type="reset" name="reset"><i class="fa fa-repeat"></i> Reset</button>

        </div>

      </form>

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

   //Date picker

    $('#datepicker').datepicker({

      format: "yyyy-mm-dd",

      autoclose: true

    })



    //Date picker

    $('#datepicker2').datepicker({

      format: "yyyy-mm-dd",

      autoclose: true

    })

</script>

@endsection