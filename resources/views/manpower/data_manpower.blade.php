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

          @if((Session::get('akses') == "super") || (Session::get('akses') == "viewer"))

          <button class="btn btn-success round-custom-1" data-toggle="modal" data-target="#myData"><i class="fa fa-plus"></i> Tambah</button><br><br>

          @endif

          <div class="table-responsive">

            <table id="manpowerTable" class="table table-bordered table-striped table-hover">

              <thead>

                <tr>

                  <th>#</th>
                  <th>Dealer</th>
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>Kontak</th>
                  <th>Tanggal Lahir</th>
                  <th>Tanggal Join</th>
                  <th>Status</th>
                  <th>Alamat</th>
                  <th>Aksi</th>

                </tr>

              </thead>

              <tbody>

                @php ($no = 1)

                @foreach($data as $o)

                <tr>

                  <td>{{ $no++ }}</td>

                  <td>{{ $o->nama_dealer }}</td>

                  <td>{{ $o->nama_manpower }}</td>

                  <td>{{ $o->jabatan }}</td>

                  <td>{{ $o->kontak }}</td>
                  <td>{{ $o->tanggal_lahir }}</td>
                  <td>{{ $o->tanggal_join }}</td>
                  <td>{{ $o->status_manpower }}</td>
                  <td>{{ $o->alamat }}</td>

                  <td>

                    @if(Session::get('akses') == "super")

                    <abbr title="Edit"><button class="btn btn-primary round-custom-2" data-toggle="modal"
                        data-target="#myEdit{{ $o->id_manpower }}"><i class="fa fa-pencil"></i></button></abbr>

                    @endif

                    <abbr title="Detail"><button class="btn btn-flat btn-warning" data-toggle="modal"
                        data-target="#myDetail{{ $o->id_manpower }}"><i class="fa fa-eye"></i></button></abbr>

                    @if(Session::get('akses') == "super")

                    <abbr title="Hapus"><a href="{{URL('manpower/delete',$o->id_manpower)}}"
                        class="btn btn-danger round-custom-1"
                        onclick="return tanya('Yakin hapus data {{ $o->nama_manpower }}?')"><i
                          class="fa fa-trash"></i></a></abbr>

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

<div class="modal fade" id="myEdit{{ $o->id_manpower }}" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

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

      <form action="{{URL('manpower/update')}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="modal-body">

          <div class="container">

            <input type="hidden" name="id" value="{{ $o->id_manpower }}">

            <div class="row">

              <div class="col-lg-6">

                <div class="form-group has-feedback">

                  <input type="text" class="form-control" placeholder="Nama Manpower" name="nama" required="required" value="{{ $o->nama_manpower }}">

                  <span class="fa fa-user form-control-feedback"></span>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-lg-6">

                <div class="form-group has-feedback">

                  <select name="kode_dealer" class="form-control" required="required">

                    <option value="$o->kode_dealer">$o->kode_dealer</option>

                    <option disabled="disabled">-----------------</option>

                    <option value="AA0101">Bisma Sentral</option>

                    <option value="AA0102">Bisma Cokro</option>

                    <option value="AA0104">Bisma Hasanudin</option>

                    <option value="AA0105">Bisma TTS</option>

                    <option value="AA0106">Bisma Imbo</option>

                    <option value="AA0107">Bisma Mandiri</option>

                    <option value="AA0108">Bisma Supratman</option>

                    <option value="AA0109">Bisma Sunset</option>

                    <option value="AA0104F">Flagship Shop</option>

                  </select>

                  <span class="fa fa-home form-control-feedback"></span>

                </div>

              </div>

            </div>


            <div class="row">

              <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">

                <label for="">Tanggal Lahir</label>

                <div class="form-group has-feedback">

                  <input type="text" class="form-control" id="datepicker1" name="tgl_lahir" placeholder="Tanggal Lahir"
                    readonly="readonly" value="{{ $o->tanggal_lahir }}">

                  <span class="fa fa-calendar form-control-feedback"></span>

                </div>

              </div>

              <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">

                <label for="">Tanggal Join</label>

                <div class="form-group has-feedback">

                  <input type="text" class="form-control" id="datepicker2" name="tgl_join" placeholder="Tanggal Join"
                    readonly="readonly" value="{{ $o->tanggal_join }}">

                  <span class="fa fa-calendar form-control-feedback"></span>

                </div>

              </div>

            </div>


            <div class="row">

              <div class="col-lg-6">

                <div class="form-group has-feedback">

                  <select name="jabatan" class="js-jabatan1 form-control" id="jabatan" required="required">

                    <option value="{{ $o->jabatan }}">{{ $o->jabatan }}</option>
                    <option disabled="disabled">---------------</option>

                    <option value="Owner">Owner</option>
                    <option value="Kepala Toko">Kepala Toko</option>
                    <option value="Akunting">Akunting</option>
                    <option value="Admin Faktur">Admin Faktur</option>
                    <option value="Admin Pajak">Admin Pajak</option>
                    <option value="Admin Samsat">Admin Samsat</option>
                    <option value="Administrasi">Administrasi</option>
                    <option value="CRM">CRM</option>
                    <option value="Kasir">Kasir</option>
                    <option value="Delivery">Delivery</option>
                    <option value="Driver">Driver</option>
                    <option value="Finance">Finance</option>
                    <option value="Finance Supervisor">Finance Supervisor</option>
                    <option value="Salesman">Salesman</option>
                    <option value="Service Counter">Service Counter</option>
                    <option value="Sales Counter">Sales Counter</option>
                    <option value="Sparepart Counter">Sparepart Counter</option>
                    <option value="Sales Supervisor">Sales Supervisor</option>
                    <option value="Service Advisor">Service Advisor</option>
                    <option value="Chief Mechanic">Chief Mechanic</option>
                    <option value="Mechanic">Mechanic</option>
                    <option value="Helper Mechanic">Helper Mechanic</option>
                    <option value="Office Boy">Office Boy</option>
                    <option value="Warehouse">Warehouse</option>

                  </select>

                  <span class="form-control-feedback"></span>

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

                  <input type="text" class="form-control" placeholder="No. HP / Telp" name="kontak" required="required" value="{{ $o->kontak }}">

                  <span class="fa fa-phone form-control-feedback"></span>

                </div>

              </div>

            </div>


            <div class="row">

              <div class="col-lg-6">

                <div class="form-group has-feedback">

                  <select name="status" class="form-control" required="required">

                    <option value="{{ $o->status_manpower }}">{{ $o->status_manpower }}</option>

                    <option disabled="disabled">-----------------</option>

                    <option value="AKTIF">AKTIF</option>

                    <option value="RESIGN">RESIGN</option>

                  </select>

                  <span class="fa fa-pencil form-control-feedback"></span>

                </div>

              </div>

            </div>



            @if(Session::get('akses') == "super")

            <div class="row">

              <div class="col-lg-6">

                <div class="form-group has-feedback">

                  <input type="text" class="form-control" placeholder="Foto" name="foto" required="required"
                    value="{{ $o->foto }}">

                  <span class="fa fa-map-pin form-control-feedback"></span>

                </div>

              </div>

            </div>



            <div class="row">

              <div class="col-lg-6">

                <input type="checkbox" name="check" id="check"> <label for="check" style="color: #2339C0;">Centang untuk
                  ganti Foto</label>

                <input type="hidden" name="fotoLama" value="{{ $o->foto }}">

                <img src="{{ asset('profil/$o->foto') }}" alt="" width="200px">

                <input type="file" name="foto" class="form-control" value="{{ $o->foto }}">

              </div>

            </div>

            @endif



          </div>

        </div>

        <!-- End Modal Body -->



        <!-- Modal Footer -->

        <div class="modal-footer">

          <button class="btn btn-primary round-custom-2" type="submit" name="add"><i class="fa fa-floppy-o"></i>
            Ubah</button>

          <button class="btn btn-warning round-custom-1" type="reset" name="reset"><i class="fa fa-repeat"></i>
            Reset</button>

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

<div class="modal fade" id="myDetail{{ $o->id_manpower }}" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Detail <strong>{{ $o->nama_manpower }}</strong></h4>

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

            <input type="hidden" name="id" value="{{ $o->id_manpower }}">

            <div class="row">

              <div class="col-lg-2">

                <img src="profil/{{$o->foto}}" alt="X" width="150">

              </div>

              

              <div class="col-lg-4" style="margin-top: 2%;">

                <table>

                <tr>

                    <th><i class="fa fa-phone"></i></th>

                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->jabatan }}</label></th>

                </tr>  

                <tr>

                    <th><i class="fa fa-phone"></i></th>

                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->tanggal_join }}</label></th>

                </tr>

                <tr>

                    <th><i class="fa fa-phone"></i></th>

                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->tanggal_lahir }}</label></th>

                </tr>

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

                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->kontak }}</label></th>

                  </tr>

                  <tr>

                    <th><i class="fa fa-phone"></i></th>

                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->status_manpower }}</label></th>

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

<!-- Modal Tambah Manpower -->

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

      <form action="{{URL('manpower/store')}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="modal-body">

          <div class="container">

            <div class="row">

              <div class="col-lg-6">

                <div class="form-group has-feedback">

                  <input type="text" class="form-control" placeholder="Nama Manpower" name="nama" required="required">

                  <span class="fa fa-user form-control-feedback"></span>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-lg-6">

                <div class="form-group has-feedback">

                  <select name="kode_dealer" class="form-control" required="required">

                    @if($home == null)

                    <option>Pilih Dealer</option>

                    <option disabled="disabled">-----------------</option>

                    <option value="AA0101">Bisma Sentral</option>

                    <option value="AA0102">Bisma Cokro</option>

                    <option value="AA0104">Bisma Hasanudin</option>

                    <option value="AA0105">Bisma TTS</option>

                    <option value="AA0106">Bisma Imbo</option>

                    <option value="AA0107">Bisma Mandiri</option>

                    <option value="AA0108">Bisma Supratman</option>

                    <option value="AA0109">Bisma Sunset</option>

                    <option value="AA0104F">Flagship Shop</option>

                    @else

                    <option value="{{ $home }}">{{ $dealer }}</option>

                    @endif

                  </select>

                  <span class="fa fa-home form-control-feedback"></span>

                </div>

              </div>

            </div>


            <div class="row">

              <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">

                <label for="">Tanggal Lahir</label>

                <div class="form-group has-feedback">

                  <input type="text" class="form-control" id="datepicker1" name="tgl_lahir" placeholder="Tanggal Lahir"
                    readonly="readonly" value="{{ $now }}">

                  <span class="fa fa-calendar form-control-feedback"></span>

                </div>

              </div>

              <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">

                <label for="">Tanggal Join</label>

                  <div class="form-group has-feedback">

                    <input type="text" class="form-control" id="datepicker2" name="tgl_join" placeholder="Tanggal Join"
                      readonly="readonly" value="{{ $now }}">

                    <span class="fa fa-calendar form-control-feedback"></span>

                  </div>

                </div>

            </div>


              <div class="row">

                <div class="col-lg-6">

                  <div class="form-group has-feedback">

                    <select name="jabatan" class="js-jabatan1 form-control" id="jabatan" required="required">

                      <option></option>

                      <option value="Owner">Owner</option>
                      <option value="Kepala Toko">Kepala Toko</option>
                      <option value="Akunting">Akunting</option>
                      <option value="Admin Faktur">Admin Faktur</option>
                      <option value="Admin Pajak">Admin Pajak</option>
                      <option value="Admin Samsat">Admin Samsat</option>
                      <option value="Administrasi">Administrasi</option>
                      <option value="CRM">CRM</option>
                      <option value="Kasir">Kasir</option>
                      <option value="Delivery">Delivery</option>
                      <option value="Driver">Driver</option>
                      <option value="Finance">Finance</option>
                      <option value="Finance Supervisor">Finance Supervisor</option>
                      <option value="Salesman">Salesman</option>
                      <option value="Service Counter">Service Counter</option>
                      <option value="Sales Counter">Sales Counter</option>
                      <option value="Sparepart Counter">Sparepart Counter</option>
                      <option value="Sales Supervisor">Sales Supervisor</option>
                      <option value="Service Advisor">Service Advisor</option>
                      <option value="Chief Mechanic">Chief Mechanic</option>
                      <option value="Mechanic">Mechanic</option>
                      <option value="Helper Mechanic">Helper Mechanic</option>
                      <option value="Office Boy">Office Boy</option>
                      <option value="Warehouse">Warehouse</option>

                    </select>

                    <span class="form-control-feedback"></span>

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

                      <input type="text" class="form-control" placeholder="No. HP / Telp" name="kontak"
                        required="required">

                      <span class="fa fa-phone form-control-feedback"></span>

                    </div>

                  </div>

                </div>


                <div class="row">

                  <div class="col-lg-6">

                    <div class="form-group has-feedback">

                      <select name="status" class="form-control" required="required">

                        <option>Pilih Status</option>

                        <option disabled="disabled">-----------------</option>

                        <option value="AKTIF">AKTIF</option>

                        <option value="RESIGN">RESIGN</option>

                      </select>

                      <span class="fa fa-pencil form-control-feedback"></span>

                    </div>

                  </div>

                </div>



                @if(Session::get('akses') == "super")

                <div class="row">

                  <div class="col-lg-6">

                    <div class="form-group has-feedback">

                      <label for="">Unggah Foto Manpower</label>

                      <input type="file" name="foto" class="form-control" placeholder="Unggah Foto Manpower">

                      <span class="fa fa-file-image-o form-control-feedback"></span>

                      <small style="color: red;">Bisa dikosongkan jika belum ada foto</small>

                    </div>

                  </div>

                </div>

                @endif



              </div>

            </div>

            <!-- End Modal Body -->



            <!-- Modal Footer -->

            <div class="modal-footer">

              <button class="btn btn-flat btn-primary" type="submit" name="add"><i class="fa fa-floppy-o"></i>
                Simpan</button>

              <button class="btn btn-flat btn-warning" type="reset" name="reset"><i class="fa fa-repeat"></i>
                Reset</button>

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
  $(document).ready(function () {
    $('#manpowerTable').DataTable({
      "aLengthMenu": [[50, 75, -1], [50, 75, "All"]],

      "iDisplayLength": 50
    });
  });
</script>

<script>

   //Date picker

   var now = new Date();

    $('#datepicker1').datepicker({

      format: "yyyy-mm-dd",

      autoclose: true,

    });

    $('#datepicker2').datepicker({

      format: "yyyy-mm-dd",

      autoclose: true,

    });

</script>

<script>

  $(document).ready(function() {

    $('.js-jabatan1').select2({

      placeholder: "Pilih Jabatan",

      allowClear: true,

    });

  });

</script>

@endsection