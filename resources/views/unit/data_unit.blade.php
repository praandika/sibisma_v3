@extends('layout.app')

@section('title','$title')



@section('content')

<div class="row">

    <div class="col-xs-12 col-lg-6">

      <div class="box">

      	<div class="box-header">

          <div class="row">

            <div class="col-md-9" align="left">

              <h3 class="box-title">Tabel Unit</h3>

            </div>

          </div>

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

          <div class="row">

            <div class="col-lg-6" align="left">

               <button class="btn btn-success round-custom-1" data-toggle="modal" data-target="#myData"><i class="fa fa-plus"></i> Tambah</button>

            </div>

          </div>

         <br><br>

          @endif

          <div class="table-responsive">

          	<form action="{{ URL('unit/deleteall') }}" method="POST">

          	{{ csrf_field() }}

        	<table id="myTable" class="table table-bordered table-striped table-hover">

        		<thead>

                <tr>

                  @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

                  <th><input type="checkbox" id="checkAll"> <label for="checkAll">#</label></th>

                  @else

                  <th>#</th>

                  @endif

                  <th>Unit</th>

                  <th>Jenis</th>

                   @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

                  <th>Aksi</th>

                  @endif

                </tr>

                </thead>

                <tbody>

                @php ($no = 1)

                @foreach($data as $o)

                <tr>

                	<td><input type="checkbox" id="checkData" name="pilih[]" value="{{ $o->id_unit }}"> {{ $no++ }}</td>

                	<td>{{ $o->nama_unit }}</td>

                	<td>{{ $o->jenis_unit }}</td>

                  @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

                  <td>

                    <abbr title="Edit"><a class="btn btn-flat btn-primary" data-toggle="modal" data-target="#myEdit{{ $o->id_unit }}"><i class="fa fa-pencil"></i></a></abbr> 

                  </td>

                  @endif

                </tr>

                @endforeach

                </tbody>

        	</table>

          @if(Session::get('akses') == "super")

        	<button class="btn btn-danger round-custom-1" onclick="return tanya('Yakin hapus data ini?')"><i class="fa fa-trash"></i> Hapus Terpilih</button>

          @endif

        	</form>

          </div>

        </div>

      </div>

  </div>



  <div class="col-xs-12 col-lg-6">

      <div class="box">

        <div class="box-header">

          <div class="row">

            <div class="col-md-9" align="left">

              <h3 class="box-title">Tabel Warna</h3>

            </div>

          </div>

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

          <div class="row">

            <div class="col-lg-6" align="left">

               <button class="btn btn-success round-custom-1" data-toggle="modal" data-target="#myWarna"><i class="fa fa-plus"></i> Tambah</button>

            </div>

          </div>

         <br><br>

          @endif

          <div class="table-responsive">

            <form action="{{ URL('warna/deleteall') }}" method="POST">

            {{ csrf_field() }}

          <table id="myTable1" class="table table-bordered table-striped table-hover">

            <thead>

                <tr>

                  @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

                  <th><input type="checkbox" id="checkWarna"> <label for="checkAll">#</label></th>

                  @else

                  <th>#</th>

                  @endif

                  <th>Warna</th>

                   @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

                  <th>Aksi</th>

                  @endif

                </tr>

                </thead>

                <tbody>

                @php ($no = 1)

                @foreach($warna as $o)

                <tr>

                  <td><input type="checkbox" id="checkData" name="check[]" value="{{ $o->id_warna }}"> {{ $no++ }}</td>

                  <td>{{ $o->warna }}</td>

                  @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

                  <td>

                    <abbr title="Edit"><a class="btn btn-flat btn-primary" data-toggle="modal" data-target="#myEditWarna{{ $o->id_warna }}"><i class="fa fa-pencil"></i></a></abbr> 

                  </td>

                  @endif

                </tr>

                @endforeach

                </tbody>

          </table>

          @if(Session::get('akses') == "super")

          <button class="btn btn-danger round-custom-1" onclick="return tanya('Yakin hapus data ini?')"><i class="fa fa-trash"></i> Hapus Terpilih</button>

          @endif

          </form>

          </div>

        </div>

      </div>

  </div>

</div>

<!-- ========================================================== -->

@foreach($data as $o)

<!-- Modal Edit Unit -->

<div class="modal fade" id="myEdit{{ $o->id_unit }}" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Edit Unit</h4>

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

      <form action="{{URL('unit/update')}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="modal-body">

          <div class="container">

            <input type="hidden" name="id" value="{{ $o->id_unit }}">

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Nama Unit" name="nama" required="required" value="{{ $o->nama_unit }}">

                <span class="fa fa-motorcycle form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Jenis Unit" name="jenis" required="required" value="{{ $o->jenis_unit }}">

                <span class="fa fa-pencil form-control-feedback"></span>

              </div>

            </div>

            </div>



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

<!-- Modal Tambah Unit -->

<div class="modal fade" id="myData" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Tambah Unit</h4>

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

      <form action="{{URL('unit/store')}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="modal-body">

          <div class="container">

          	<div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Nama Unit" name="nama" required="required">

                <span class="fa fa-motorcycle form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Jenis Unit" name="jenis" required="required">

                <span class="fa fa-pencil form-control-feedback"></span>

              </div>

            </div>

            </div>



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

@foreach($warna as $o)

<!-- Modal Edit Unit -->

<div class="modal fade" id="myEditWarna{{ $o->id_warna }}" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Edit Warna</h4>

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

      <form action="{{URL('warna/update')}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="modal-body">

          <div class="container">

            <input type="hidden" name="id" value="{{ $o->id_warna }}">

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Warna" name="warna" required="required" value="{{ $o->warna }}">

                <span class="fa fa-tint form-control-feedback"></span>

              </div>

            </div>

            </div>



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

<!-- Modal Tambah Unit -->

<div class="modal fade" id="myWarna" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Tambah Warna</h4>

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

      <form action="{{URL('warna/store')}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="modal-body">

          <div class="container">

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Warna" name="warna" required="required">

                <span class="fa fa-tint form-control-feedback"></span>

              </div>

            </div>

            </div>



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

      "iDisplayLength": 10

    })

  })

</script>

<script>

  $(function () {

    $('#myTable1').DataTable({

      "aLengthMenu": [[50, 75, -1], [50, 75, "All"]],

      "iDisplayLength": 10

    })

  })

</script>



<script>

  $("#checkAll").click(function () {

  $('input:checkbox').not(this).prop('checked', this.checked);

});

</script>



<script>

  $("#checkWarna").click(function () {

  $('input:checkbox').not(this).prop('checked', this.checked);

});

</script>

@endsection