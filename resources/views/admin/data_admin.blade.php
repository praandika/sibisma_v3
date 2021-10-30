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

          <button class="btn btn-success round-custom-1" data-toggle="modal" data-target="#myData"><i class="fa fa-plus"></i> Tambah</button><br><br>

          <div class="table-responsive">

        	<table id="myTable" class="table table-bordered table-striped table-hover">

        		<thead>

                <tr>

                  <th>#</th>

                  <th>Nama Admin</th>

                  <th>Username</th>

                  <th>Hak Akses</th>

                  <th>Dealer</th>

                  <th>Kode</th>

                  <th>Aksi</th>

                </tr>

                </thead>

                <tbody>

                @php ($no = 1)

                @foreach($data as $o)

                <tr>

                	<td>{{ $no++ }}</td>

                	<td>{{ $o->name }}</td>

                	<td>{{ $o->username }}</td>

                	<td>{{ $o->akses }}</td>

                	<td>{{ $o->dealer }}</td>

                  <td>{{ $o->kode_dealer }}</td>

                  <td>

                    <abbr title="Edit"><button class="btn btn-primary round-custom-2" data-toggle="modal" data-target="#myEdit{{ $o->id }}"><i class="fa fa-pencil"></i></button></abbr>

                    <abbr title="Ubah Password"><button class="btn btn-flat btn-warning" data-toggle="modal" data-target="#myPass{{ $o->id }}"><i class="fa fa-lock"></i></button></abbr>

                    <abbr title="Hapus"><a href="{{URL('admin/delete',$o->id)}}" class="btn btn-danger round-custom-1" onclick="return tanya('Yakin hapus data {{ $o->username }}?')"><i class="fa fa-trash"></i></a></abbr>

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

<div class="modal fade" id="myEdit{{ $o->id }}" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Edit Admin</h4>

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

      <form action="{{URL('admin/update')}}" method="POST">

        {{ csrf_field() }}

        <div class="modal-body">

          <div class="container">

            <input type="hidden" name="id" value="{{ $o->id }}">

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Nama" name="nama" required="required" value="{{ $o->name }}">

                <span class="fa fa-pencil form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Username" name="user" required="required" value="{{ $o->username }}">

                <span class="fa fa-user form-control-feedback"></span>

              </div>

            </div>

            </div>

            

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <select class="form-control" name="dealer" required="required">

                    @if($o->dealer == "AA0101")

                    <option value="{{ $o->dealer }}">Dealer : Bisma Sentral</option>

                    @elseif($o->dealer == "AA0102")

                    <option value="{{ $o->dealer }}">Dealer : Bisma Cokro</option>

                    @elseif($o->dealer == "AA0104")

                    <option value="{{ $o->dealer }}">Dealer : Bisma Hasanuddin</option>

                    @elseif($o->dealer == "AA0105")

                    <option value="{{ $o->dealer }}">Dealer : Bisma TTS</option>

                    @elseif($o->dealer == "AA0106")

                    <option value="{{ $o->dealer }}">Dealer : Bisma Imbo</option>

                    @elseif($o->dealer == "AA0107")

                    <option value="{{ $o->dealer }}">Dealer : Bisma Mandiri</option>

                    @elseif($o->dealer == "AA0108")

                    <option value="{{ $o->dealer }}">Dealer : Bisma WR Supratman</option>

                    @elseif($o->dealer == "AA0109")

                    <option value="{{ $o->dealer }}">Dealer : Bisma Sunset</option>

                    @elseif($o->dealer == "AA0104F")

                    <option value="{{ $o->dealer }}">Dealer : Bisma Flagship Shop</option>

                    @elseif($o->dealer == "group")

                    <option value="{{ $o->dealer }}">Dealer : Group</option>

                    @else

                    <option value="{{ $o->dealer }}">Error!!</option>

                    @endif

                    <option disabled="disabled">--------------------</option>

                    <option value="group">Group</option>

                    <option value="AA0101">Bisma Sentral</option>

                    <option value="AA0102">Bisma Cokro</option>

                    <option value="AA0104">Bisma Hasanuddin</option>

                    <option value="AA0105">Bisma TTS</option>

                    <option value="AA0106">Bisma Imbo</option>

                    <option value="AA0107">Bisma Mandiri</option>

                    <option value="AA0108">Bisma WR Supratman</option>

                    <option value="AA0109">Bisma Sunset</option>

                    <option value="AA0104F">Bisma Flagship Shop</option>

                </select>

                <span class="fa fa-home form-control-feedback"></span>

              </div>

            </div>

            </div>

            

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <select class="form-control" name="akses" required="required">

                    <option value="{{ $o->akses }}">Hak Akses : {{ $o->akses }}</option>

                    <option disabled="disabled">--------------------</option>

                    <option value="super">Super</option>

                    <option value="admin">Admin</option>

                    <option value="viewer">Viewer</option>

                </select>

                <span class="fa fa-shield form-control-feedback"></span>

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

@foreach($data as $o)

<!-- Modal Edit Admin -->

<div class="modal fade" id="myPass{{ $o->id }}" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Edit Admin <strong>{{ $o->name }}</strong></h4>

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

      <form action="{{URL('admin/updatepass')}}" method="POST">

        {{ csrf_field() }}

        <div class="modal-body">

          <div class="container">

            <input type="hidden" name="id" value="{{ $o->id }}">

            <input type="hidden" name="user" value="{{ $o->username }}">

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="password" class="form-control" placeholder="Password Lama" name="passLama" required="required">

                <span class="fa fa-lock form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="password" class="form-control" placeholder="Password Baru" name="passBaru" required="required">

                <span class="fa fa-lock form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="password" class="form-control" placeholder="Konfirmasi Password" name="confirm" required="required">

                <span class="fa fa-lock form-control-feedback"></span>

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

<!-- Modal Tambah Admin -->

<div class="modal fade" id="myData" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Tambah Admin</h4>

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

      <form action="{{URL('admin/store')}}" method="POST">

        {{ csrf_field() }}

        <div class="modal-body">

          <div class="container">



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Nama" name="nama" required="required">

                <span class="fa fa-pencil form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Username" name="user" required="required">

                <span class="fa fa-user form-control-feedback"></span>

              </div>

            </div>

            </div>

            

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <select class="form-control" name="dealer" required="required">

                    <option value="group">Group</option>

                    <option value="AA0101">Bisma Sentral</option>

                    <option value="AA0102">Bisma Cokro</option>

                    <option value="AA0104">Bisma Hasanuddin</option>

                    <option value="AA0105">Bisma TTS</option>

                    <option value="AA0106">Bisma Imbo</option>

                    <option value="AA0107">Bisma Mandiri</option>

                    <option value="AA0108">Bisma WR Supratman</option>

                    <option value="AA0109">Bisma Sunset</option>

                    <option value="AA0104F">Bisma Flagship Shop</option>

                </select>

                <span class="fa fa-home form-control-feedback"></span>

              </div>

            </div>

            </div>

            

            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <select class="form-control" name="akses" required="required">

                    <option value="super">Super</option>
                    <option value="admin">Admin</option>
                    <option value="viewer">Viewer</option>

                </select>

                <span class="fa fa-shield form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="password" class="form-control" placeholder="Password" name="pass" required="required">

                <span class="fa fa-lock form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6">

              <div class="form-group has-feedback">

                <input type="password" class="form-control" placeholder="Konfirmasi Password" name="confirm" required="required">

                <span class="fa fa-lock form-control-feedback"></span>

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

      "iDisplayLength": 50

    })

  })

</script>

@endsection