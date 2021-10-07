@extends('layout.app')

@section('title','$title')



@section('content')

<div class="row">

    <div class="col-xs-12">

      <div class="box">

      	<div class="box-header">

          <div class="row">

          <div class="col-md-6 col-sm-6 col-lg-6">

              <abbr title="Kembali"><a class="btn btn-primary round-custom-1" href="{{ URL('opname/stok/'.$now.'/'.$home.'') }}"><i class="fa fa-arrow-left"></i> Kembali</a></abbr>

          </div>

          </div>

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <!-- TABEL -->

          <form action="{{ URL('opname/dopname') }}" method="POST">

          {{ csrf_field() }}

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

          <button class="btn btn-flat btn-danger" onclick="return tanya('Yakin hapus data ini?')"><i class="fa fa-trash"></i> Hapus Terpilih</button>

          @endif

        </div>

      </div>

  </div>

</div>



@endsection

@section('script')

<script>

  $(function () {

    $('#tableIn').DataTable({

      "aLengthMenu": [[50, 75, -1], [50, 75, "All"]],

      "iDisplayLength": 50

    })

  })

</script>

@endsection