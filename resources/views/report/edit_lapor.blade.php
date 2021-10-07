@extends('layout.app')
@section('title','$title')

@section('css')
<style>
    .in_input{
        border-color: blue;
    }

    .in_input:focus{
        border-color: blue;
    }

    .out_input{
        border-color: red;
    }

    .out_input:focus{
        border-color: red;
    }

    .sale_input{
        border-color: green;
    }

    .sale_input:focus{
        border-color: green;
    }

    .fs_input{
        border-color: orange;
    }

    .fs_input:focus{
        border-color: orange;
    }
</style>
@endsection

@section('content')
<div class="row">

    <div class="col-xs-12 col-md-12">
        <form action="{{ URL('lapor/ulapor') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" value="{{ $home }}" name="kode_dealer">
        
            <!-- BOX STOK AWAL -->
            <div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6" align="left">
                            <h3 class="box-title"><strong><i class="fa fa-motorcycle"></i> {{ $stok }} Unit</strong></h3>
                        </div>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">

                            <div class="form-group has-feedback">
                                <label for="">Stok Awal:</label>
                                @foreach($sa as $o)
                                <input type="text" class="form-control" placeholder="Stok Awal" name="stok_awal" id="stok_awal" readonly="readonly" value="{{ $o->stok_awal }}">
                                @endforeach

                                <span class="fa fa-briefcase form-control-feedback"></span>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control tanggal_report" id="datepicker" name="tanggal_report" placeholder="Pilih Tanggal" readonly="readonly" value="{{ $tanggal }}" style="border-color: yellow; box-shadow: 0px 0px 5px;">
                                <span class="fa fa-calendar form-control-feedback"></span>
                            </div>

                            <input type="text" id="tglReported" value="{{ $tanggal }}" hidden="hidden">
                        </div>
                    </div>
                </div>
            </div> 
            <!-- BOX STOK AWAL -->

            <!-- STOK MASUK ============================-->
            <div class="box box-primary" id="boxStokIn">
                <div class="box-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6" align="left">
                        <h3 class="box-title" style="color:blue;"><strong><i class="fa fa-in"></i>Stok Masuk</strong></h3>
                        </div>
                    </div>
                </div> <!-- /.box-header -->

                <div class="box-body">
                    <input type="text" name="total_masuk" id="total_masuk" value="0" hidden="hidden">
                    <div class="wrapper-in" id="wrapper-in">
                        <!-- ADD IN -->
                        @foreach($in as $o)
                        <div class="row control-row-in">
                            <hr class="hidden-md hidden-lg hidden-xl">
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">

                                <div class="form-group has-feedback">
                                    <label for="">Pemasok:</label>
                                    <select name="pemasok[]" class="form-control in_input" id="pemasok" autofocus="autofocus" value="{{ $o->pemasok }}" required="required">

                                        <option value="YIMM">YIMM</option>
                                        <option value="Bisma Sentral">Bisma Sentral</option>
                                        <option value="Bisma Cokro">Bisma Cokro</option>
                                        <option value="Bisma Hasanuddin">Bisma Hasanuddin</option>
                                        <option value="Bisma TTS">Bisma TTS</option>
                                        <option value="Bisma Imam Bonjol">Bisma Imam Bonjol</option>
                                        <option value="Bisma Mandiri">Bisma Mandiri</option>
                                        <option value="Bisma WR Supratman">Bisma WR Supratman</option>
                                        <option value="Bisma Sunset Road">Bisma Sunset Road</option>
                                        <option value="Bisma Flagship Shop">Bisma Flagship Shop</option>
                                        <option value="Other Dealer">Other Dealer</option>

                                    </select>

                                    <span class="fa fa-home form-control-feedback"></span>

                                    </div>

                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">

                                    <div class="form-group">
                                        <label for="">Qty:</label>
                                        <input type="number" class="form-control in_input in_stok" placeholder="Qty Masuk" name="in_stok[]" id="in_stok"  value="{{ $o->in_qty }}" required="required">
                                    </div>

                                </div>
                                        
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                    <div class="form-group has-feedback">
                                        <label for="">Nama Unit:</label>
                                        <select name="in_unit[]" id="in_unit" class="form-control in_input" value="{{ $o->in_unit }}" required="required">

                                            @foreach($unit as $o)

                                                <option value="{{ $o->nama_unit }}">{{ $o->nama_unit }}</option>

                                            @endforeach

                                        </select>
                                    </div>

                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">

                                    <div class="form-group has-feedback">
                                    <label for="">Warna:</label>
                                        <select name="in_warna[]" id="in_warna" class="form-control in_input" value="" required="required">
                                            @foreach($warna as $o)
                                                <option value="{{ $o->warna }}">{{ $o->warna }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">

                                    <div class="form-group has-feedback">
                                        <label for="">Tahun:</label>
                                        <input type="text" class="form-control in_input" placeholder="Tahun" name="in_tahun[]" id="in_tahun"  value="" required="required">

                                        <span class="fa fa-info form-control-feedback"></span>
                                    </div>

                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">
                                    <label for="">Remove</label>
                                    <button class="btn btn-danger remove-in" type="button"><i class="fa fa-remove"></i></button>
                                </div>
                        </div>
                        @endforeach
                    <!-- END ADD IN -->
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1" align="right">
                            <button class="btn btn-primary add-more-in" type="button"><i class="fa fa-plus"></i> Tambah Baris</button>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1" align="left">
                            <button class="btn btn-secondary" type="button" id="lanjutKeStokKeluar"><i class="fa fa-caret-right"></i> Lanjut</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BOX STOK MASUK -->

            <!-- STOK KELUAR ============================-->
            <div class="box box-danger" id="boxStokOut" hidden="hidden">
                <div class="box-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6" align="left">
                        <h3 class="box-title" style="color:red;"><strong><i class="fa fa-out"></i>Stok Keluar</strong></h3>
                        </div>
                    </div>
                </div> <!-- /.box-header -->

                <div class="box-body">
                    <input type="text" name="total_keluar" value="0" hidden="hidden">
                    <div class="wrapper-out" id="wrapper-out">
                        <!-- Container input dinamis -->
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1" align="right">
                            <button class="btn btn-primary add-more-out" type="button"><i class="fa fa-plus"></i> Tambah Baris</button>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1" align="left">
                            <button class="btn btn-secondary" type="button" id="kembaliKeStokMasuk"><i class="fa fa-caret-left"></i> Kembali</button>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1" align="right">
                            <button class="btn btn-secondary" type="button" id="lanjutKeStokLaku"><i class="fa fa-caret-right"></i> Lanjut</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BOX STOK KELUAR -->

            <!-- STOK SALE ============================-->
            <div class="box box-success" id="boxStokSale" hidden="hidden">
                <div class="box-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6" align="left">
                        <h3 class="box-title" style="color:green;"><strong><i class="fa fa-out"></i>Stok Laku</strong></h3>
                        </div>
                    </div>
                </div> <!-- /.box-header -->

                <div class="box-body">
                    <input type="text" name="total_laku" value="0" hidden="hidden">
                    <div class="wrapper-sale" id="wrapper-sale">
                        <!-- Container input dinamis -->
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1" align="right">
                            <button class="btn btn-primary add-more-sale" type="button"><i class="fa fa-plus"></i> Tambah Baris</button>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1" align="left">
                            <button class="btn btn-secondary" type="button" id="kembaliKeStokKeluar"><i class="fa fa-caret-left"></i> Kembali</button>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1" align="right">
                            <button class="btn btn-secondary" type="button" id="lanjutKeFS"><i class="fa fa-caret-right"></i> Lanjut</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BOX STOK SALE -->

            <!-- FAKTUR SERVICE ============================-->
            <div class="box box-warning" id="boxFS" hidden="hidden">
                <div class="box-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6" align="left">
                        <h3 class="box-title" style="color:orange;"><strong><i class="fa fa-out"></i>Faktur & Service</strong></h3>
                        </div>
                    </div>
                </div> <!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">

                            <div class="form-group">
                                <label for="">Faktur:</label>
                                <input type="number" class="form-control fs_input" placeholder="Jumlah Faktur" name="faktur" id="faktur" required="required">
                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">

                            <div class="form-group">
                                <label for="">Service:</label>
                                <input type="number" class="form-control fs_input" placeholder="Jumlah Service" name="service" id="service" required="required">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1" align="left">
                            <button class="btn btn-secondary" type="button" id="kembaliKeStokLaku"><i class="fa fa-caret-left"></i> Kembali</button>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1" align="right">
                            <!-- BUTTON SIMPAN -->
                            <button class="btn btn-success" type="submit" name="simpan" id="button-simpan"><i class="fa fa-check"></i> Buat Laporan</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BOX FAKTUR SERVICE -->
        </form>

        <!-- Membuat Form Dinamis Tersembunyi muncul saat klik tombol Add More -->

        <!-- ADD IN -->
        <div class="copy-in hide">
            <div class="row control-row-in">
                <hr class="hidden-md hidden-lg hidden-xl">
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">

                    <div class="form-group has-feedback">
                        <label for="">Pemasok:</label>
                        <select name="pemasok[]" class="form-control in_input" id="pemasok" autofocus="autofocus" value="{{ old('pemasok') }}" required="required">

                            <option disabled="disabled" selected="selected" hidden="hidden">Pilih Pemasok</option>
                            <option value="YIMM">YIMM</option>
                            <option value="Bisma Sentral">Bisma Sentral</option>
                            <option value="Bisma Cokro">Bisma Cokro</option>
                            <option value="Bisma Hasanuddin">Bisma Hasanuddin</option>
                            <option value="Bisma TTS">Bisma TTS</option>
                            <option value="Bisma Imam Bonjol">Bisma Imam Bonjol</option>
                            <option value="Bisma Mandiri">Bisma Mandiri</option>
                            <option value="Bisma WR Supratman">Bisma WR Supratman</option>
                            <option value="Bisma Sunset Road">Bisma Sunset Road</option>
                            <option value="Bisma Flagship Shop">Bisma Flagship Shop</option>
                            <option value="Other Dealer">Other Dealer</option>

                        </select>

                        <span class="fa fa-home form-control-feedback"></span>

                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">

                        <div class="form-group">
                            <label for="">Qty:</label>
                            <input type="number" class="form-control in_input in_stok" placeholder="Qty Masuk" name="in_stok[]" id="in_stok"  value="{{ old('in_stok') }}" required="required">
                        </div>

                    </div>
                            
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                        <div class="form-group has-feedback">
                            <label for="">Nama Unit:</label>
                            <select name="in_unit[]" id="in_unit" class="form-control in_input" value="{{ old('in_unit') }}" required="required">

                                @foreach($unit as $o)

                                    <option value="{{ $o->nama_unit }}">{{ $o->nama_unit }}</option>

                                @endforeach

                            </select>
                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">

                        <div class="form-group has-feedback">
                        <label for="">Warna:</label>
                            <select name="in_warna[]" id="in_warna" class="form-control in_input" value="{{ old('in_warna') }}" required="required">
                                @foreach($warna as $o)
                                    <option value="{{ $o->warna }}">{{ $o->warna }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">

                        <div class="form-group has-feedback">
                            <label for="">Tahun:</label>
                            <input type="text" class="form-control in_input" placeholder="Tahun" name="in_tahun[]" id="in_tahun"  value="{{ old('in_tahun') }}" required="required">

                            <span class="fa fa-info form-control-feedback"></span>
                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">
                        <label for="">Remove</label>
                        <button class="btn btn-danger remove-in" type="button"><i class="fa fa-remove"></i></button>
                    </div>
            </div>
        </div>
        <!-- END ADD IN -->

        <!-- ADD OUT -->
        <div class="copy-out hide">
            <div class="row control-row-out">
                <hr class="hidden-md hidden-lg hidden-xl">
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">

                    <div class="form-group has-feedback">
                        <label for="">Cabang:</label>
                        <select name="cabang[]" class="form-control out_input" id="cabang" autofocus="autofocus" required="required">

                            <option disabled="disabled" selected="selected" hidden="hidden">Pilih Pemasok</option>
                            <option value="YIMM">YIMM</option>
                            <option value="Bisma Sentral">Bisma Sentral</option>
                            <option value="Bisma Cokro">Bisma Cokro</option>
                            <option value="Bisma Hasanuddin">Bisma Hasanuddin</option>
                            <option value="Bisma TTS">Bisma TTS</option>
                            <option value="Bisma Imam Bonjol">Bisma Imam Bonjol</option>
                            <option value="Bisma Mandiri">Bisma Mandiri</option>
                            <option value="Bisma WR Supratman">Bisma WR Supratman</option>
                            <option value="Bisma Sunset Road">Bisma Sunset Road</option>
                            <option value="Bisma Flagship Shop">Bisma Flagship Shop</option>
                            <option value="Other Dealer">Other Dealer</option>

                        </select>

                            <span class="fa fa-home form-control-feedback"></span>

                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">

                    <div class="form-group">
                        <label for="">Qty:</label>
                        <input type="number" class="form-control out_input" placeholder="Qty Keluar" name="out_stok[]" id="out_stok" required="required">
                    </div>

                </div>
                        
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                    <div class="form-group has-feedback">
                        <label for="">Nama Unit:</label>
                        <select name="out_unit[]" id="out_unit" class="form-control out_input" required="required">

                            @foreach($unit as $o)

                                <option value="{{ $o->nama_unit }}">{{ $o->nama_unit }}</option>

                            @endforeach

                        </select>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">

                    <div class="form-group has-feedback">
                        <label for="">Warna:</label>
                            <select name="out_warna[]" id="out_warna" class="form-control out_input" required="required">
                                @foreach($warna as $o)
                                    <option value="{{ $o->warna }}">{{ $o->warna }}</option>
                                @endforeach
                            </select>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">

                    <div class="form-group has-feedback">
                        <label for="">Tahun:</label>
                        <input type="text" class="form-control out_input" placeholder="Tahun" name="out_tahun[]" id="out_tahun" required="required">

                        <span class="fa fa-info form-control-feedback"></span>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">
                    <label for="">Remove</label>
                    <button class="btn btn-danger remove-out" type="button"><i class="fa fa-remove"></i></button>
                </div>

            </div> <!---End Row--->
        </div>
        <!-- END ADD OUT -->

        <!-- ADD SALE -->
        <div class="copy-sale hide">
            <hr class="hidden-md hidden-lg hidden-xl">
            <div class="row control-row-sale">
                <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">

                    <div class="form-group">
                        <label for="">Qty:</label>
                        <input type="number" class="form-control sale_input" placeholder="Qty Laku" name="sale_stok[]" id="sale_stok" required="required">
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                    <div class="form-group has-feedback">
                        <label for="">Nama Unit:</label>
                        <select name="sale_unit[]" id="sale_unit" class="form-control sale_input" required="required">
                            @foreach($unit as $o)
                            <option value="{{ $o->nama_unit }}">{{ $o->nama_unit }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">

                    <div class="form-group has-feedback">
                        <label for="">Warna:</label>
                            <select name="sale_warna[]" id="sale_warna" class="form-control sale_input" required="required">
                                @foreach($warna as $o)
                                    <option value="{{ $o->warna }}">{{ $o->warna }}</option>
                                @endforeach
                            </select>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">

                    <div class="form-group has-feedback">
                        <label for="">Tahun:</label>
                        <input type="text" class="form-control sale_input" placeholder="Tahun" name="sale_tahun[]" id="sale_tahun" required="required">

                        <span class="fa fa-info form-control-feedback"></span>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">

                    <div class="form-group has-feedback">
                        <label for="">Leasing:</label>
                        <input type="text" class="form-control sale_input" placeholder="Leasing" name="leasing[]" id="leasing" required="required">

                        <span class="fa fa-money form-control-feedback"></span>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1">
                    <label for="">Remove</label>
                    <button class="btn btn-danger remove-sale" type="button"><i class="fa fa-remove"></i></button>
                </div>

                </div> <!---End Row--->
        </div>
        <!-- END ADD SALE -->
        
    </div>

</div>
@endsection

@section('script')
<script>

   //Date picker

    $('#datepicker').datepicker({

      format: "yyyy-mm-dd",

      autoclose: true

    })

</script>



<script>

  $(document).ready(function() {

    $('.in_unit-multiple').select2({

      placeholder: "Pilih Unit Masuk",

      allowClear: true

    });

  });

</script>

<script>
    $(document).ready(function() {
      $(".add-more-in").click(function(){ 
          var html = $(".copy-in").html();
          $(".wrapper-in").append(html);
      }); 

      // saat tombol remove dklik control group akan dihapus 
      $("body").on("click",".remove-in",function(){ 
          $(this).parents(".control-row-in").remove();
      });
    });
</script>

<script>
    $(document).ready(function() {
      $(".add-more-out").click(function(){ 
          var html = $(".copy-out").html();
          $(".wrapper-out").append(html);
      });

      // saat tombol remove dklik control group akan dihapus 
      $("body").on("click",".remove-out",function(){ 
          $(this).parents(".control-row-out").remove();
      });
    });
</script>

<script>
    $(document).ready(function() {
      $(".add-more-sale").click(function(){ 
          var html = $(".copy-sale").html();
          $(".wrapper-sale").append(html);
      });

      // saat tombol remove dklik control group akan dihapus 
      $("body").on("click",".remove-sale",function(){ 
          $(this).parents(".control-row-sale").remove();
      });
    });
</script>

<script>
    $(document).ready(function(){

        function cekTanggal(){
            var input = $(".tanggal_report").val();
            var reported = $("#tglReported").val();

            if (input == reported) {
                alert("Tanggal lapor sudah ada!");
            }
        }

        function cekField_in(){
            var pemasok = $("#wrapper-in #pemasok").val();
            var in_stok = $("#wrapper-in #in_stok").val();
            var in_unit = $("#wrapper-in #in_unit").val();
            var in_warna = $("#wrapper-in #in_warna").val();
            var in_tahun = $("#wrapper-in #in_tahun").val();

            if ((pemasok == "") || (in_stok == "") || (in_stok == "0") || (in_unit == "") || (in_warna == "") || (in_tahun == "")) {
                alert("Pastikan field tidak kosong!");
            }else{
                $("#boxStokIn").hide(500);
                $("#boxStokOut").show(500);
            }
        }

        function cekField_out(){
            var cabang = $("#wrapper-out #cabang").val();
            var out_stok = $("#wrapper-out #out_stok").val();
            var out_unit = $("#wrapper-out #out_unit").val();
            var out_warna = $("#wrapper-out #out_warna").val();
            var out_tahun = $("#wrapper-out #out_tahun").val();

            if ((cabang == "") || (out_stok == "") || (out_stok == "0") || (out_unit == "") || (out_warna == "") || (out_tahun == "")) {
                alert("Pastikan field tidak kosong!");
            }else{
                $("#boxStokOut").hide(500);
                $("#boxStokSale").show(500);
            }
        }

        function cekField_sale(){
            var leasing = $("#wrapper-sale #leasing").val();
            var sale_stok = $("#wrapper-sale #sale_stok").val();
            var sale_unit = $("#wrapper-sale #sale_unit").val();
            var sale_warna = $("#wrapper-sale #sale_warna").val();
            var sale_tahun = $("#wrapper-sale #sale_tahun").val();

            if ((leasing == "") || (sale_stok == "") || (sale_stok == "0") || (sale_unit == "") || (sale_warna == "") || (sale_tahun == "")) {
                alert("Pastikan field tidak kosong!");
            }else{
                $("#boxStokSale").hide(500);
                $("#boxFS").show(500);
            }
        }

        $("#lanjutKeStokKeluar").click(function(){
            cekTanggal();
            cekField_in();
        });

        $("#kembaliKeStokMasuk").click(function(){
            $("#boxStokOut").hide(500);
            $("#boxStokIn").show(500);
        });

        $("#lanjutKeStokLaku").click(function(){
            cekTanggal();
            cekField_out();
        });

        $("#kembaliKeStokKeluar").click(function(){
            $("#boxStokSale").hide(500);
            $("#boxStokOut").show(500);
        });

        $("#lanjutKeFS").click(function(){
            cekTanggal();
            cekField_sale();
        });

        $("#kembaliKeStokLaku").click(function(){
            $("#boxFS").hide(500);
            $("#boxStokSale").show(500);
        });

    });
</script>

<script>
    $(function () {

        $('#myTable').DataTable({

        "aLengthMenu": [[50, 75, -1], [50, 75, "All"]],

        "iDisplayLength": 10

        })

    })
</script>
@endsection