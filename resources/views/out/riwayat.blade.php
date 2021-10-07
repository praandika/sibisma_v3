@extends('layout.app')

@section('title','$title')



@section('content')

<div class="row">

  <div class="col-md-6 col-sm-6 col-xs-12">

    <div class="info-box">

      <span class="info-box-icon bg-red"><i class="ion-log-in"></i></span>



      <div class="info-box-content">

        <span class="info-box-text">Keluar <br>{{ $tgl }}</span>

        <span class="info-box-number">{{ $total }} Unit</span>

      </div>

      <!-- /.info-box-content -->

    </div>

    <!-- /.info-box -->

  </div>



  <div class="col-md-6 col-sm-6 col-xs-12">

    <div class="info-box">

      <span class="info-box-icon bg-blue"><i class="ion-log-in"></i></span>



      <div class="info-box-content">

        <span class="info-box-text">Total Keluar</span>

        <span class="info-box-number">{{ $grandTotal }} Unit</span>

      </div>

      <!-- /.info-box-content -->

    </div>

    <!-- /.info-box -->

  </div>

</div>

<div class="row">

    <div class="col-xs-12">

      <div class="box">

      	<div class="box-header">

          <div class="row">

          <div class="col-md-6 col-sm-6 col-lg-6">

              <abbr title="Kembali"><a class="btn btn-primary round-custom-1" href="{{ URL('out/keluar/'.$now.'/'.$home.'') }}"><i class="fa fa-arrow-left"></i> Kembali</a></abbr>

          </div>

          </div>

        </div>

        <!-- /.box-header -->

        <div class="box-body">

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

                      <abbr title="Hapus"><a class="btn btn-flat btn-danger" href="{{ URL('out/riwayat/delete',$o->id_keluar) }}" onclick="return tanya('Yakin hapus {{ $o->nama_motor }} {{ $o->warna }} {{ $o->tahun }}?')"><i class="fa fa-trash"></i></a></abbr>

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