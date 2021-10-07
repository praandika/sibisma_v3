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

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

    <div class="box">

      <div class="box-header">

        <div class="row">

          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" align="left">

          <h3 class="box-title"><strong><i class="fa fa-search"></i> Cari Laporan</strong></h3>

          </div>

        </div>

      </div>



      <div class="box-body">

        <form action="{{ URL('report/cari') }}" method="GET">

        {{ csrf_field() }}

        <div class="row">

          <div class="col-md-4">

            <div class="form-group has-feedback">

              <input type="text" class="form-control" id="datepicker" name="tanggal" placeholder="Pilih Tanggal" readonly="readonly" value="{{ $tgl }}" value="{{ old('tanggal') }}">

              <span class="fa fa-calendar form-control-feedback"></span>

            </div>

          </div>

          <div class="col-md-2">

            <button class="btn btn-success btn-flat"><i class="fa fa-search"></i> Cari</button>

          </div>

        </div>

      </form>

      </div>

    </div>

  </div> 

</div>

@if((Session::get('akses') == "super") OR (Session::get('akses') == "owner") OR (Session::get('akses') == "viewer"))

<!-- SENTRAL================================================================== -->

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

      	<div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Sentral</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy01" data-clipboard-action="copy" data-clipboard-target="#report01" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied01" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Sentral</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy01x" data-clipboard-action="copy" data-clipboard-target="#report01" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied01x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report01">

          <p>*Lap. Stok Sentral {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <!-- STOK AWAL -->

          <p><strong></strong></p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY01 }}</strong>

          <p>

          @foreach($MY01 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC01 }}</strong>

          <p>

          @foreach($MC01 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK01 }}</strong>

          <p>

          @foreach($K01 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

            <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ01 }}</strong>

          <p>

          @foreach($J01 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS01 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          <!-- STOK AKHIR -->

          <p><strong></strong></p>

          </div>

        </div>

      </div>

    </div>



<!-- BMM =============================================================================== -->

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Cokro</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy02" data-clipboard-action="copy" data-clipboard-target="#report02" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied02" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Cokro</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy02x" data-clipboard-action="copy" data-clipboard-target="#report02" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied02x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report02">

          <p>*Lap. Stok BMM {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <!-- STOK AWAL -->

          <p><strong></strong></p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY02 }}</strong>

          <p>

          @foreach($MY02 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC02 }}</strong>

          <p>

          @foreach($MC02 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK02 }}</strong>

          <p>

          @foreach($K02 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ02 }}</strong>

          <p>

          @foreach($J02 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS02 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          <!-- STOK AKHIR -->

          <p><strong></strong></p>

          </div>

        </div>

      </div>

  </div>

</div>

<!--  -->

<!--  -->

<!--  -->

<!-- HASANUDDIN================================================================== -->

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Hasanuddin</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy04" data-clipboard-action="copy" data-clipboard-target="#report04" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied04" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Hasanuddin</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy04x" data-clipboard-action="copy" data-clipboard-target="#report04" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied04x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report04">

          <p>*Lap. Stok UD {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <!-- STOK AWAL -->

          <p><strong></strong></p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY04 }}</strong>

          <p>

          @foreach($MY04 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC04 }}</strong>

          <p>

          @foreach($MC04 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK04 }}</strong>

          <p>

          @foreach($K04 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ04 }}</strong>

          <p>

          @foreach($J04 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS04 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          <!-- STOK AKHIR -->

          <p><strong></strong></p>

          </div>

        </div>

      </div>

    </div>



<!-- TTS =============================================================================== -->

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma TTS</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy05" data-clipboard-action="copy" data-clipboard-target="#report05" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied05" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma TTS</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy05x" data-clipboard-action="copy" data-clipboard-target="#report05" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied05x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report05">

          <p>*Lap. Stok TTS {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <!-- STOK AWAL -->

          <p><strong></strong></p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY05 }}</strong>

          <p>

          @foreach($MY05 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC02 }}</strong>

          <p>

          @foreach($MC05 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK05 }}</strong>

          <p>

          @foreach($K05 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ05 }}</strong>

          <p>

          @foreach($J05 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS05 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          <!-- STOK AKHIR -->

          <p><strong></strong></p>

          </div>

        </div>

      </div>

  </div>

</div>

<!--  -->

<!--  -->

<!--  -->

<!-- IMB6================================================================== -->

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Imam Bonjol</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy06" data-clipboard-action="copy" data-clipboard-target="#report06" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied06" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Imam Bonjol</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy06x" data-clipboard-action="copy" data-clipboard-target="#report06" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied06x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report06">

          <p>*Lap. Stok Imbo {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <!-- STOK AWAL -->

          <p><strong></strong></p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY06 }}</strong>

          <p>

          @foreach($MY06 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC06 }}</strong>

          <p>

          @foreach($MC06 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK06 }}</strong>

          <p>

          @foreach($K06 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ06 }}</strong>

          <p>

          @foreach($J06 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS06 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          <!-- STOK AKHIR -->

          <p><strong></strong></p>

          </div>

        </div>

      </div>

    </div>



<!-- MANDIRI =============================================================================== -->

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Mandiri</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy07" data-clipboard-action="copy" data-clipboard-target="#report07" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied07" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Mandiri</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy07x" data-clipboard-action="copy" data-clipboard-target="#report07" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied07x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report07">

          <p>*Lap. Stok Mandiri {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <!-- STOK AWAL -->

          <p><strong></strong></p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY07 }}</strong>

          <p>

          @foreach($MY07 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC07 }}</strong>

          <p>

          @foreach($MC07 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK07 }}</strong>

          <p>

          @foreach($K07 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ07 }}</strong>

          <p>

          @foreach($J07 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS07 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          <!-- STOK AKHIR -->

          <p><strong></strong></p>

          </div>

        </div>

      </div>

  </div>

</div>

<!--  -->

<!--  -->

<!--  -->

<!-- WR SURPATMAN================================================================== -->

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma WR Supratman</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy08" data-clipboard-action="copy" data-clipboard-target="#report08" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied08" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma WR Supratman</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy08x" data-clipboard-action="copy" data-clipboard-target="#report08" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied08x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report08">

          <p>*Lap. Stok WR Supratman {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <!-- STOK AWAL -->

          <p><strong></strong></p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY08 }}</strong>

          <p>

          @foreach($MY08 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC08 }}</strong>

          <p>

          @foreach($MC08 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK08 }}</strong>

          <p>

          @foreach($K08 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ08 }}</strong>

          <p>

          @foreach($J08 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS08 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          <!-- STOK AKHIR -->

          <p><strong></strong></p>

          </div>

        </div>

      </div>

    </div>

<!--  -->

<!--  -->

<!--  -->

<!-- Sunset Road =============================================================================== -->

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Sunset Road</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy09" data-clipboard-action="copy" data-clipboard-target="#report09" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied09" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Sunset Road</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy09x" data-clipboard-action="copy" data-clipboard-target="#report09" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied09x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report09">

          <p>*Lap. Stok Sunset {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <!-- STOK AWAL -->

          <p><strong></strong></p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY09 }}</strong>

          <p>

          @foreach($MY09 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC09 }}</strong>

          <p>

          @foreach($MC09 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK09 }}</strong>

          <p>

          @foreach($K09 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ09 }}</strong>

          <p>

          @foreach($J09 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS09 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          <!-- STOK AKHIR -->

          <p><strong></strong></p>

          </div>

        </div>

      </div>

  </div>

</div>

<!--  -->

<!--  -->

<!--  -->

<!-- FSS =============================================================================== -->

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Flagship Shop</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy04F" data-clipboard-action="copy" data-clipboard-target="#report04F" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied04F" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Flagship Shop</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy04Fx" data-clipboard-action="copy" data-clipboard-target="#report04F" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied04Fx" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report04F">

          <p>*Lap. Stok FSS {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <!-- STOK AWAL -->

          <p><strong></strong></p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY04F }}</strong>

          <p>

          @foreach($MY04F as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC04F }}</strong>

          <p>

          @foreach($MC04F as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK04F }}</strong>

          <p>

          @foreach($K04F as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ04F }}</strong>

          <p>

          @foreach($J04F as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS04F as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          <!-- STOK AKHIR -->

          <p><strong></strong></p>

          </div>

        </div>

      </div>

  </div>

</div>

@elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0101"))

<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Sentral</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy01" data-clipboard-action="copy" data-clipboard-target="#report01" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied01" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Sentral</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy01x" data-clipboard-action="copy" data-clipboard-target="#report01" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied01x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report01">

          <p>*Lap. Stok Sentral {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY01 }}</strong>

          <p>

          @foreach($MY01 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC01 }}</strong>

          <p>

          @foreach($MC01 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK01 }}</strong>

          <p>

          @foreach($K01 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

            <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ01 }}</strong>

          <p>

          @foreach($J01 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS01 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          </div>

        </div>

      </div>

    </div>

</div>

@elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0102"))

<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Cokro</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy02" data-clipboard-action="copy" data-clipboard-target="#report02" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied02" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Cokro</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy02x" data-clipboard-action="copy" data-clipboard-target="#report02" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied02x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report02">

          <p>*Lap. Stok BMM {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY02 }}</strong>

          <p>

          @foreach($MY02 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC02 }}</strong>

          <p>

          @foreach($MC02 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK02 }}</strong>

          <p>

          @foreach($K02 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ02 }}</strong>

          <p>

          @foreach($J02 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS02 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          </div>

        </div>

      </div>

  </div>

</div>

@elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0104"))

<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Hasanuddin</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy04" data-clipboard-action="copy" data-clipboard-target="#report04" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied04" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Hasanuddin</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy04x" data-clipboard-action="copy" data-clipboard-target="#report04" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied04x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report04">

          <p>*Lap. Stok UD {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY04 }}</strong>

          <p>

          @foreach($MY04 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC04 }}</strong>

          <p>

          @foreach($MC04 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK04 }}</strong>

          <p>

          @foreach($K04 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ04 }}</strong>

          <p>

          @foreach($J04 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS04 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          </div>

        </div>

      </div>

    </div>

</div>

@elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0105"))

<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma TTS</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy05" data-clipboard-action="copy" data-clipboard-target="#report05" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied05" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma TTS</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy05x" data-clipboard-action="copy" data-clipboard-target="#report05" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied05x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report05">

          <p>*Lap. Stok TTS {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY05 }}</strong>

          <p>

          @foreach($MY05 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC02 }}</strong>

          <p>

          @foreach($MC05 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK05 }}</strong>

          <p>

          @foreach($K05 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ05 }}</strong>

          <p>

          @foreach($J05 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS05 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          </div>

        </div>

      </div>

  </div>

</div>

@elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0106"))

<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Imam Bonjol</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy06" data-clipboard-action="copy" data-clipboard-target="#report06" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied06" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Imam Bonjol</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy06x" data-clipboard-action="copy" data-clipboard-target="#report06" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied06x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report06">

          <p>*Lap. Stok Imbo {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY06 }}</strong>

          <p>

          @foreach($MY06 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC06 }}</strong>

          <p>

          @foreach($MC06 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK06 }}</strong>

          <p>

          @foreach($K06 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ06 }}</strong>

          <p>

          @foreach($J06 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS06 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          </div>

        </div>

      </div>

    </div>

</div>

@elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0107"))

<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Mandiri</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy07" data-clipboard-action="copy" data-clipboard-target="#report07" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied07" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Mandiri</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy07x" data-clipboard-action="copy" data-clipboard-target="#report07" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied07x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report07">

          <p>*Lap. Stok Mandiri {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY07 }}</strong>

          <p>

          @foreach($MY07 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC07 }}</strong>

          <p>

          @foreach($MC07 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK07 }}</strong>

          <p>

          @foreach($K07 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ07 }}</strong>

          <p>

          @foreach($J07 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS07 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          </div>

        </div>

      </div>

  </div>

</div>

@elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0108"))

<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma WR Supratman</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy08" data-clipboard-action="copy" data-clipboard-target="#report08" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied08" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma WR Supratman</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy08x" data-clipboard-action="copy" data-clipboard-target="#report08" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied08x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report08">

          <p>*Lap. Stok WR Supratman {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY08 }}</strong>

          <p>

          @foreach($MY08 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC08 }}</strong>

          <p>

          @foreach($MC08 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK08 }}</strong>

          <p>

          @foreach($K08 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ08 }}</strong>

          <p>

          @foreach($J08 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS08 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          </div>

        </div>

      </div>

    </div>

</div>

@elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0109"))

<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Sunset Road</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy09" data-clipboard-action="copy" data-clipboard-target="#report09" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied09" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Bisma Sunset Road</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy09x" data-clipboard-action="copy" data-clipboard-target="#report09" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied09x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report09">

          <p>*Lap. Stok Sunset {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY09 }}</strong>

          <p>

          @foreach($MY09 as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC09 }}</strong>

          <p>

          @foreach($MC09 as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK09 }}</strong>

          <p>

          @foreach($K09 as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ09 }}</strong>

          <p>

          @foreach($J09 as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS09 as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          </div>

        </div>

      </div>

  </div>

</div>

@elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0104F"))

<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

      <div class="box">

        <div class="box-header">

          <!-- HIDDEN XS -->

          <div class="row hidden-xs">

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Flagship Shop</strong></h3>

            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

              <button class="btn btn-flat btn-success" id="btncopy04F" data-clipboard-action="copy" data-clipboard-target="#report04F" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-primary" id="btncopied04F" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- VISIBLE XS -->

          <div class="row hidden-sm hidden-md hidden-lg hidden-xl">

            <div class="col-xs-12">

              <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> Flagship Shop</strong></h3>

            </div>

            <br><br>

            <div class="col-xs-12">

              <button class="btn btn-flat btn-block btn-success" id="btncopy04Fx" data-clipboard-action="copy" data-clipboard-target="#report04F" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

              <button class="btn btn-flat btn-block btn-primary" id="btncopied04Fx" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

            </div>

          </div>

          <!-- ========================= -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div id="report04F">

          <p>*Lap. Stok FSS {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>

          <hr>



          <!-- MASUK YIMM -->

          <strong>Masuk YIMM : {{ $QMY04F }}</strong>

          <p>

          @foreach($MY04F as $o)

          {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- MASUK CABANG -->

          <strong>Masuk Cabang : {{ $QMC04F }}</strong>

          <p>

          @foreach($MC04F as $o)

          <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->qty_in }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- KELUAR -->

          <strong>Keluar : {{ $QK04F }}</strong>

          <p>

          @foreach($K04F as $o)

          <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->qty_out }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }}

          <br>

          @endforeach

          </p>

          <br>



          <!-- TERJUAL -->

          <strong>Terjual : {{ $QJ04F }}</strong>

          <p>

          @foreach($J04F as $o)

          {{ $o->qty }} | {{ $o->nama_motor }} {{ $o->warna }} | {{ $o->tahun }} ( {{ serialize_to_string($o->leasing) }} )

          <br>

          @endforeach

          </p>

          <br>



          <!-- FAKTUR SERVICE -->

          @foreach($FS04F as $o)

          <p>

            <strong>Faktur : {{ $o->faktur }}</strong>

            <br>

            <strong>Service : {{ $o->service }}</strong>

          </p>

          @endforeach

          <hr>



          </div>

        </div>

      </div>

  </div>

</div>

@endif



@section('script')

<script>

    var clipboard = new ClipboardJS('.btn');



    clipboard.on('success', function(e) {

      console.info('Action:', e.action);

      console.info('Text:', e.text);

      console.info('Trigger:', e.trigger);



      e.clearSelection();

    });



    clipboard.on('error', function(e) {

      console.error('Action:', e.action);

      console.error('Trigger:', e.trigger);

    });

</script>



<script>

   //Date picker

   var now = new Date();

    $('#datepicker').datepicker({

      format: "yyyy-mm-dd",

      autoclose: true,

    });

</script>



<script>

  $(document).ready(function(){

    $("#btncopy01").click(function(){

      $("#btncopied01").show(500);

      $("#btncopy01").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy02").click(function(){

      $("#btncopied02").show(500);

      $("#btncopy02").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy04").click(function(){

      $("#btncopied04").show(500);

      $("#btncopy04").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy05").click(function(){

      $("#btncopied05").show(500);

      $("#btncopy05").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy06").click(function(){

      $("#btncopied06").show(500);

      $("#btncopy06").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy07").click(function(){

      $("#btncopied07").show(500);

      $("#btncopy07").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy08").click(function(){

      $("#btncopied08").show(500);

      $("#btncopy08").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy09").click(function(){

      $("#btncopied09").show(500);

      $("#btncopy09").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy04F").click(function(){

      $("#btncopied04F").show(500);

      $("#btncopy04F").hide(500);

    });

  });



  // FOR COL-XS ---------------------

  $(document).ready(function(){

    $("#btncopy01x").click(function(){

      $("#btncopied01x").show(500);

      $("#btncopy01x").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy02x").click(function(){

      $("#btncopied02x").show(500);

      $("#btncopy02x").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy04x").click(function(){

      $("#btncopied04x").show(500);

      $("#btncopy04x").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy05x").click(function(){

      $("#btncopied05x").show(500);

      $("#btncopy05x").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy06x").click(function(){

      $("#btncopied06x").show(500);

      $("#btncopy06x").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy07x").click(function(){

      $("#btncopied07x").show(500);

      $("#btncopy07x").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy08x").click(function(){

      $("#btncopied08x").show(500);

      $("#btncopy08x").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy09x").click(function(){

      $("#btncopied09x").show(500);

      $("#btncopy09x").hide(500);

    });

  });



  $(document).ready(function(){

    $("#btncopy04Fx").click(function(){

      $("#btncopied04Fx").show(500);

      $("#btncopy04Fx").hide(500);

    });

  });

</script>

@endsection

@endsection