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

          @if(Session::get('akses') == "super")

          <button class="btn btn-success round-custom-1" data-toggle="modal" data-target="#myData"><i class="fa fa-plus"></i> Tambah</button><br><br>

          @endif

          <div class="table-responsive">

        	<table id="myTable" class="table table-bordered table-striped table-hover">

        		<thead>

                <tr>

                  <th>#</th>

                  <th>Kode Dealer</th>

                  <th>Nama Dealer</th>

                  <th>Alamat</th>

                  <th>Kontak</th>

                  <th>Aksi</th>

                </tr>

                </thead>

                <tbody>

                @php ($no = 1)

                @foreach($data as $o)

                <tr>

                	<td>{{ $no++ }}</td>

                	<td>{{ $o->kode_dealer }}</td>

                	<td>{{ $o->nama_dealer }}</td>

                	<td>{{ $o->alamat }}</td>

                	<td>{{ $o->telp }}</td>

                  <td>

                    @if(Session::get('akses') == "super")

                    <abbr title="Edit"><button class="btn btn-primary round-custom-2" data-toggle="modal" data-target="#myEdit{{ $o->id_dealer }}"><i class="fa fa-pencil"></i></button></abbr>

                    @endif

                    <abbr title="Detail"><button class="btn btn-flat btn-warning" data-toggle="modal" data-target="#myDetail{{ $o->id_dealer }}"><i class="fa fa-eye"></i></button></abbr>

                    @if(Session::get('akses') == "super")

                    <abbr title="Hapus"><a href="{{URL('dealer/delete',$o->id_dealer)}}" class="btn btn-danger round-custom-1" onclick="return tanya('Yakin hapus data {{ $o->username }}?')"><i class="fa fa-trash"></i></a></abbr>

                    @endif

                  </td>

                </tr>

                @endforeach

                </tbody>

        	</table>

          </div>

        </div>

      </div>

  </div>

</div>

<!-- ========================================================== -->

@foreach($data as $o)

<!-- Modal Edit Admin -->

<div class="modal fade" id="myEdit{{ $o->id_dealer }}" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

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

      <form action="{{URL('dealer/update')}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="modal-body">

          <div class="container">

            <input type="hidden" name="id" value="{{ $o->id_dealer }}">

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <select name="kode" class="form-control" required="required">

                  <option value="{{ $o->kode_dealer }}">{{ $o->kode_dealer }}</option>

                  <option disabled="disabled">-----------------</option>

                  <option value="AA0101">AA0101</option>

                  <option value="AA0102">AA0102</option>

                  <option value="AA0104">AA0104</option>

                  <option value="AA0105">AA0105</option>

                  <option value="AA0106">AA0106</option>

                  <option value="AA0107">AA0107</option>

                  <option value="AA0108">AA0108</option>

                  <option value="AA0109">AA0109</option>

                  <option value="AA0104F">AA0104F</option>

                </select>

                <span class="fa fa-pencil form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Nama Dealer" name="nama" required="required" value="{{ $o->nama_dealer }}">

                <span class="fa fa-home form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Alamat" name="alamat" required="required" value="{{ $o->alamat }}">

                <span class="fa fa-map-marker form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="No. Telp" name="telp" required="required" value="{{ $o->telp }}">

                <span class="fa fa-phone form-control-feedback"></span>

              </div>

            </div>

            </div>

            

            @if(Session::get('akses') == "super")

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Koordinat" name="koordinat" required="required" value="{{ $o->koordinat }}">

                <span class="fa fa-map-pin form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <input type="checkbox" name="check" id="check"> <label for="check" style="color: #2339C0;">Centang untuk ganti QR CODE</label>

              <input type="hidden" name="qrLama" value="{{ $o->qrcode }}">

              <img src="{{ asset('img/$o->qrcode') }}" alt="" width="200px">

              <input type="file" name="qrcode" class="form-control" value="{{ $o->qrcode }}">

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

@foreach($data as $o)

<!-- Modal Detail Admin -->

<div class="modal fade" id="myDetail{{ $o->id_dealer }}" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Detail <strong>{{ $o->nama_dealer }}</strong></h4>

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

        <div class="modal-body">

          <div class="container">

            <input type="hidden" name="id" value="{{ $o->id_dealer }}">

            

            <div class="row">

              <div class="col-lg-6">

                <div class="mapouter"><div class="gmap_canvas">

                  <iframe width="600" height="300" id="gmap_canvas" src="{{ $o->koordinat }}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">

                    

                  </iframe>

                  <a href="https://www.embedgooglemap.net">embedgooglemap.net</a></div>

                  <style>.mapouter{position:relative;text-align:right;height:300px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:300px;width:100%;}

                  </style>

                </div>

              </div>

            </div>



            <div class="row">

              <div class="col-lg-2">

                <img src="qr/{{$o->qrcode}}" alt="X" width="150">

              </div>

              

              <div class="col-lg-4" style="margin-top: 2%;">

                <table>

                  <tr>

                    <th><i class="fa fa-pencil"></i></th>

                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->kode_dealer }}</label></th>

                  </tr>

                  <tr>

                    <th><i class="fa fa-home"></i></th>

                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->nama_dealer }}</label></th>

                  </tr>

                  <tr>

                    <th><i class="fa fa-map-marker"></i></th>

                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->alamat }}</label></th>

                  </tr>

                  <tr>

                    <th><i class="fa fa-phone"></i></th>

                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->telp }}</label></th>

                  </tr>

                </table>

              </div>

            </div>



          </div>

        </div>

    <!-- End Modal Body -->

      

    </div>

  </div>

</div>

<!-- End Modal -->

<!-- =================================================================== -->

@endforeach

<!-- ========================================================== -->

<!-- Modal Tambah Admin -->

<div class="modal fade" id="myData" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

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

      <form action="{{URL('dealer/store')}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="modal-body">

          <div class="container">



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <select name="kode" class="form-control" required="required">

                  <option value="AA0101">AA0101</option>

                  <option value="AA0102">AA0102</option>

                  <option value="AA0104">AA0104</option>

                  <option value="AA0105">AA0105</option>

                  <option value="AA0106">AA0106</option>

                  <option value="AA0107">AA0107</option>

                  <option value="AA0108">AA0108</option>

                  <option value="AA0109">AA0109</option>

                  <option value="AA0104F">AA0104F</option>

                </select>

                <span class="fa fa-pencil form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Nama Dealer" name="nama" required="required">

                <span class="fa fa-home form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Alamat" name="alamat" required="required">

                <span class="fa fa-map-marker form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="No. Telp" name="telp" required="required">

                <span class="fa fa-phone form-control-feedback"></span>

              </div>

            </div>

            </div>

            

            @if(Session::get('akses') == "super")

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Koordinat" name="koordinat">

                <span class="fa fa-map-pin form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="file" name="qrcode" class="form-control">

                <span class="fa fa-file-image-o form-control-feedback"></span>

              </div>

            </div>

            </div>

            @endif



          </div>

        </div>

    <!-- End Modal Body -->



        <!-- Modal Footer -->

        <div class="modal-footer">

          <button class="btn btn-flat btn-primary" type="submit" name="add"><i class="fa fa-floppy-o"></i> Simpan</button>

          <button class="btn btn-flat btn-warning" type="reset" name="reset"><i class="fa fa-repeat"></i> Reset</button>

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

@endsection