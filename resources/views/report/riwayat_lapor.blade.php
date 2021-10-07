@extends('layout.app')
@section('title','$title')

@section('content')
<!-- Kolom Output -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="box">
            <div class="box-header">

            <!-- HIDDEN XS -->

                <div class="row hidden-xs">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="left">
                        <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> {{ $dealer }}</strong></h3>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" align="right">

                        <button class="btn btn-flat btn-success" id="btncopy01" data-clipboard-action="copy" data-clipboard-target="#report" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

                        <button class="btn btn-flat btn-primary" id="btncopied01" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>
                    </div>
                </div>

                <!-- VISIBLE XS -->

                <div class="row hidden-sm hidden-md hidden-lg hidden-xl">
                    <div class="col-xs-12">
                        <h3 class="box-title" style="color: #2146D0;"><strong><i class="fa fa-file-text"></i> {{ $dealer }}</strong></h3>
                    </div>

                    <br><br>

                    <div class="col-xs-12">

                        <button class="btn btn-flat btn-block btn-success" id="btncopy01x" data-clipboard-action="copy" data-clipboard-target="#report" onclick="return ganti()"><i class="fa fa-clipboard"></i> Salin</button>

                        <button class="btn btn-flat btn-block btn-primary" id="btncopied01x" style="display: none;"><i class="fa fa-check"></i> Tersalin!</button>

                    </div>
                </div>
            <!-- ========================= -->
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <div id="report">
                    <p>*Lap. Stok {{$dealer}} {{ Carbon\Carbon::parse($tgl)->format('d-m-Y') }}*</p>
                    <!-- STOK AWAL -->
                        <p><strong>*Stok Awal : {{ $sa }}*</strong></p>
                        

                    <!-- MASUK YIMM -->
                        <strong>*Masuk YIMM : {{ $sum_yimm }}*</strong>
                        <p>
                            @foreach($yimm as $o)
                                {{ $o->in_qty }} | {{ $o->in_unit }} {{ $o->in_warna }} | {{ $o->in_tahun }}
                                <br>
                            @endforeach
                        </p>
                        <br>

                    <!-- MASUK CABANG -->
                        <strong>*Masuk Cabang : {{ $sum_cabang }}*</strong>
                        <p>
                            @foreach($cabang as $o)
                                <i style="color: #3131CC;">{{ $o->pemasok }}</i> : {{ $o->in_qty }} | {{ $o->in_unit }} {{ $o->in_warna }} | {{ $o->in_tahun }}
                                <br>
                            @endforeach
                        </p>
                        <p>--------------------------</p>
                        <br>

                    <!-- KELUAR -->
                        <strong>*Keluar : {{ $sum_keluar }}*</strong>
                        <p>
                            @foreach($keluar as $o)
                                <i style="color: #3131CC;">{{ $o->cabang }}</i> : {{ $o->out_qty }} | {{ $o->out_unit }} {{ $o->out_warna }} | {{ $o->out_tahun }}
                                <br>
                            @endforeach
                        </p>
                        <p>--------------------------</p>
                        <br>

                    <!-- TERJUAL -->
                        <strong>*Terjual : {{ $sum_laku }}*</strong>
                        <p>
                            @foreach($laku as $o)
                                {{ $o->sale_qty }} | {{ $o->sale_unit }} {{ $o->sale_warna }} | {{ $o->sale_tahun }} ( {{ $o->leasing }} )
                                <br>
                            @endforeach
                        </p>
                        <p>--------------------------</p>
                        

                    <!-- FAKTUR SERVICE -->

                        @foreach($fs as $o)
                        <p>
                            <strong>*Faktur : {{ $o->faktur }}*</strong>
                            <br>
                            <strong>*Service : {{ $o->service }}*</strong>
                        </p>
                        @endforeach
                        

                    <!-- STOK AKHIR -->
                        <p><strong>*Stok Akhir : {{ $sak }}*</strong></p>
                    
                </div>
            </div>
        </div>
    </div>

<!-- DAFTAR RIWAYAT LAPOR -->
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="box">
            <div class="box-header">
                <div class="col-xs-12">
                    <h3 class="box-title"><strong><i class="fa fa-file-text"></i> Riwayat Lapor {{ $dealer }}</strong></h3>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Tanggal Lapor</th>
                                <th>Stok Awal</th>
                                <th>Stok Masuk</th>
                                <th>Stok Keluar</th>
                                <th>Stok Laku</th>
                                <th>Stok Stok Akhir</th>
                            </tr>
                        </thead>

                        <tbody>
                        @php ($no = 1)
                        @foreach($data as $o)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ date('l', strtotime($o->sum_tanggal)) }}</td>
                            <td>
                                <a href="{{ URL('/lapor/riwayat/'.$home.'/'.$o->sum_tanggal.'') }}">{{ $o->sum_tanggal }}</a>
                            </td>
                            <td>{{ $o->stok_awal }}</td>
                            <td>{{ $o->sum_instok }}</td>
                            <td>{{ $o->sum_outstok }}</td>
                            <td>{{ $o->sum_salestok }}</td>
                            <td>{{ $o->stok_akhir }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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
    $(document).ready(function(){

        $("#btncopy01").click(function(){

        $("#btncopied01").show(500);

        $("#btncopy01").hide(500);

        });

    });

    // FOR COL-XS ---------------------

    $(document).ready(function(){

        $("#btncopy01x").click(function(){

        $("#btncopied01x").show(500);

        $("#btncopy01x").hide(500);

        });

    });
</script>
@endsection