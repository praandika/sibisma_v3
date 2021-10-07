          <input type="hidden" value="{{ $home }}" name="kode_dealer">

          <div class="row">

            @if(Session::has('input'))

            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" id="datepicker" name="tanggal" placeholder="Pilih Tanggal" readonly="readonly" value="{{ Session::get('input.tanggal') }}" value="{{ old('tanggal') }}">

                <span class="fa fa-calendar form-control-feedback"></span>

              </div>

            </div>



            @else

            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" id="datepicker" name="tanggal" placeholder="Pilih Tanggal" readonly="readonly" value="{{ $now }}" value="{{ old('tanggal') }}" style="border-color: yellow; box-shadow: 0px 0px 5px;">

                <span class="fa fa-calendar form-control-feedback"></span>

              </div>

            </div>



            @endif



            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">

              <div class="form-group has-feedback">

                <select name="cabang" class="form-control" @if(Session::has('auto')) autofocus="autofocus" style="border-color: red; box-shadow: 0px 0px 5px red;" @endif>

                  <option disabled="disabled" selected="selected" hidden="hidden">Pilih Tujuan Cabang</option>

                  

                  @if(old('cabang') == "Bisma Sentral")

                  <option value="Bisma Sentral" selected="selected">Bisma Sentral</option>

                  <option value="Bisma Cokro">Bisma Cokro</option>

                  <option value="Bisma Hasanuddin">Bisma Hasanuddin</option>

                  <option value="Bisma TTS">Bisma TTS</option>

                  <option value="Bisma Imam Bonjol">Bisma Imam Bonjol</option>

                  <option value="Bisma Mandiri">Bisma Mandiri</option>

                  <option value="Bisma WR Supratman">Bisma WR Supratman</option>

                  <option value="Bisma Sunset Road">Bisma Sunset Road</option>

                  <option value="Bisma Flagship Shop">Bisma Flagship Shop</option>

                  <option value="YIMM">YIMM</option>



                  @elseif(old('cabang') == "Bisma Cokro")

                  <option value="Bisma Sentral">Bisma Sentral</option>

                  <option value="Bisma Cokro" selected="selected">Bisma Cokro</option>

                  <option value="Bisma Hasanuddin">Bisma Hasanuddin</option>

                  <option value="Bisma TTS">Bisma TTS</option>

                  <option value="Bisma Imam Bonjol">Bisma Imam Bonjol</option>

                  <option value="Bisma Mandiri">Bisma Mandiri</option>

                  <option value="Bisma WR Supratman">Bisma WR Supratman</option>

                  <option value="Bisma Sunset Road">Bisma Sunset Road</option>

                  <option value="Bisma Flagship Shop">Bisma Flagship Shop</option>

                  <option value="YIMM">YIMM</option>



                  @elseif(old('cabang') == "Bisma Hasanuddin")

                  <option value="Bisma Sentral">Bisma Sentral</option>

                  <option value="Bisma Cokro">Bisma Cokro</option>

                  <option value="Bisma Hasanuddin" selected="selected">Bisma Hasanuddin</option>

                  <option value="Bisma TTS">Bisma TTS</option>

                  <option value="Bisma Imam Bonjol">Bisma Imam Bonjol</option>

                  <option value="Bisma Mandiri">Bisma Mandiri</option>

                  <option value="Bisma WR Supratman">Bisma WR Supratman</option>

                  <option value="Bisma Sunset Road">Bisma Sunset Road</option>

                  <option value="Bisma Flagship Shop">Bisma Flagship Shop</option>

                  <option value="YIMM">YIMM</option>



                  @elseif(old('cabang') == "Bisma TTS")

                  <option value="Bisma Sentral">Bisma Sentral</option>

                  <option value="Bisma Cokro">Bisma Cokro</option>

                  <option value="Bisma Hasanuddin">Bisma Hasanuddin</option>

                  <option value="Bisma TTS" selected="selected">Bisma TTS</option>

                  <option value="Bisma Imam Bonjol">Bisma Imam Bonjol</option>

                  <option value="Bisma Mandiri">Bisma Mandiri</option>

                  <option value="Bisma WR Supratman">Bisma WR Supratman</option>

                  <option value="Bisma Sunset Road">Bisma Sunset Road</option>

                  <option value="Bisma Flagship Shop">Bisma Flagship Shop</option>

                  <option value="YIMM">YIMM</option>



                  @elseif(old('cabang') == "Bisma Imam Bonjol")

                  <option value="Bisma Sentral">Bisma Sentral</option>

                  <option value="Bisma Cokro">Bisma Cokro</option>

                  <option value="Bisma Hasanuddin">Bisma Hasanuddin</option>

                  <option value="Bisma TTS">Bisma TTS</option>

                  <option value="Bisma Imam Bonjol" selected="selected">Bisma Imam Bonjol</option>

                  <option value="Bisma Mandiri">Bisma Mandiri</option>

                  <option value="Bisma WR Supratman">Bisma WR Supratman</option>

                  <option value="Bisma Sunset Road">Bisma Sunset Road</option>

                  <option value="Bisma Flagship Shop">Bisma Flagship Shop</option>

                  <option value="YIMM">YIMM</option>



                  @elseif(old('cabang') == "Bisma Mandiri")

                  <option value="Bisma Sentral">Bisma Sentral</option>

                  <option value="Bisma Cokro">Bisma Cokro</option>

                  <option value="Bisma Hasanuddin">Bisma Hasanuddin</option>

                  <option value="Bisma TTS">Bisma TTS</option>

                  <option value="Bisma Imam Bonjol">Bisma Imam Bonjol</option>

                  <option value="Bisma Mandiri" selected="selected">Bisma Mandiri</option>

                  <option value="Bisma WR Supratman">Bisma WR Supratman</option>

                  <option value="Bisma Sunset Road">Bisma Sunset Road</option>

                  <option value="Bisma Flagship Shop">Bisma Flagship Shop</option>

                  <option value="YIMM">YIMM</option>



                  @elseif(old('cabang') == "Bisma WR Supratman")

                  <option value="Bisma Sentral">Bisma Sentral</option>

                  <option value="Bisma Cokro">Bisma Cokro</option>

                  <option value="Bisma Hasanuddin">Bisma Hasanuddin</option>

                  <option value="Bisma TTS">Bisma TTS</option>

                  <option value="Bisma Imam Bonjol">Bisma Imam Bonjol</option>

                  <option value="Bisma Mandiri">Bisma Mandiri</option>

                  <option value="Bisma WR Supratman" selected="selected">Bisma WR Supratman</option>

                  <option value="Bisma Sunset Road">Bisma Sunset Road</option>

                  <option value="Bisma Flagship Shop">Bisma Flagship Shop</option>

                  <option value="YIMM">YIMM</option>



                  @elseif(old('cabang') == "Bisma Sunset Road")

                  <option value="Bisma Sentral">Bisma Sentral</option>

                  <option value="Bisma Cokro">Bisma Cokro</option>

                  <option value="Bisma Hasanuddin">Bisma Hasanuddin</option>

                  <option value="Bisma TTS">Bisma TTS</option>

                  <option value="Bisma Imam Bonjol">Bisma Imam Bonjol</option>

                  <option value="Bisma Mandiri">Bisma Mandiri</option>

                  <option value="Bisma WR Supratman">Bisma WR Supratman</option>

                  <option value="Bisma Sunset Road" selected="selected">Bisma Sunset Road</option>

                  <option value="Bisma Flagship Shop">Bisma Flagship Shop</option>

                  <option value="YIMM">YIMM</option>



                  @elseif(old('cabang') == "Bisma Flagship Shop")

                  <option value="Bisma Sentral">Bisma Sentral</option>

                  <option value="Bisma Cokro">Bisma Cokro</option>

                  <option value="Bisma Hasanuddin">Bisma Hasanuddin</option>

                  <option value="Bisma TTS">Bisma TTS</option>

                  <option value="Bisma Imam Bonjol">Bisma Imam Bonjol</option>

                  <option value="Bisma Mandiri">Bisma Mandiri</option>

                  <option value="Bisma WR Supratman">Bisma WR Supratman</option>

                  <option value="Bisma Sunset Road">Bisma Sunset Road</option>l

                  <option value="Bisma Flagship Shop" selected="selected">Bisma Flagship Shop</option>

                  <option value="YIMM">YIMM</option>

                  

                  @elseif(old('cabang') == "YIMM")

                  <option value="Bisma Sentral">Bisma Sentral</option>

                  <option value="Bisma Cokro">Bisma Cokro</option>

                  <option value="Bisma Hasanuddin">Bisma Hasanuddin</option>

                  <option value="Bisma TTS">Bisma TTS</option>

                  <option value="Bisma Imam Bonjol">Bisma Imam Bonjol</option>

                  <option value="Bisma Mandiri">Bisma Mandiri</option>

                  <option value="Bisma WR Supratman">Bisma WR Supratman</option>

                  <option value="Bisma Sunset Road">Bisma Sunset Road</option>l

                  <option value="Bisma Flagship Shop">Bisma Flagship Shop</option>

                  <option value="YIMM" selected="selected">YIMM</option>

                  

                  @else

                  <option value="Bisma Sentral">Bisma Sentral</option>

                  <option value="Bisma Cokro">Bisma Cokro</option>

                  <option value="Bisma Hasanuddin">Bisma Hasanuddin</option>

                  <option value="Bisma TTS">Bisma TTS</option>

                  <option value="Bisma Imam Bonjol">Bisma Imam Bonjol</option>

                  <option value="Bisma Mandiri">Bisma Mandiri</option>

                  <option value="Bisma WR Supratman">Bisma WR Supratman</option>

                  <option value="Bisma Sunset Road">Bisma Sunset Road</option>

                  <option value="Bisma Flagship Shop">Bisma Flagship Shop</option>

                  <option value="YIMM">YIMM</option>

                  @endif

                </select>

                <span class="fa fa-home form-control-feedback"></span>

              </div>

            </div>



            <!-- HIDDEN SM -->

            <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5 col-xl-5 hidden-sm">

              <div class="form-group has-feedback">

                <a href="" data-toggle="modal" data-target="#myStok">

                <input type="text" class="form-control" placeholder="Nama Unit" id="unit1" name="unit" required="required" readonly="readonly" value="{{ old('unit') }}">

                <input type="hidden" id="id_stok1" required="required" class="form-control" name="id_stok1" value="{{ old('id_stok') }}">

                <span class="fa fa-motorcycle form-control-feedback"></span>

                </a>

              </div>

            </div>

            <!-- END HIDDEN SM -->

          </div>



          <div class="row">

            <!-- VISIBLE SM -->

            <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5 col-xl-5 hidden-xs hidden-md hidden-lg hidden-xl">

              <div class="form-group has-feedback">

                <a href="" data-toggle="modal" data-target="#myStok">

                <input type="text" class="form-control" placeholder="Nama Unit" id="unit1" name="unit" required="required" readonly="readonly" value="{{ old('unit') }}">

                <input type="hidden" id="id_stok2" required="required" class="form-control" name="id_stok" value="{{ old('id_stok') }}">

                <span class="fa fa-motorcycle form-control-feedback"></span>

                </a>

              </div>

            </div>

            <!-- END VISIBLE SM -->

            

            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Jenis Unit" name="jenis" id="jenis1" required="required" readonly="readonly" value="{{ old('jenis') }}">

                <span class="fa fa-info form-control-feedback"></span>

              </div>

            </div>



            <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-xl-2">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Tahun" name="tahun" id="tahun" required="required" readonly="readonly" value="{{ old('tahun') }}">

                <span class="fa fa-info form-control-feedback"></span>

              </div>

            </div>



            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-xl-3">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Warna" name="warna" id="warna" required="required" readonly="readonly" value="{{ old('warna') }}">

                <span class="fa fa-tint form-control-feedback"></span>

              </div>

            </div>



            <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-xl-2">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Stok" name="stok" id="stok" required="required" readonly="readonly" value="{{ old('stok') }}">

                <span class="fa fa-briefcase form-control-feedback"></span>

              </div>

            </div>



            <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-xl-2">

              <div class="form-group has-feedback">

                <input type="number" class="form-control" placeholder="Qty" name="qty" id="qty" required="required" value="{{ old('qty') }}" @if(Session::has('autofocus')) autofocus="autofocus" style="border-color: red; box-shadow: 0px 0px 5px red;" @endif onchange="cekStok()">

                <span class="fa fa-sign-in form-control-feedback"></span>

                <span class="help-block label label-danger" id="alert-stok" style="color: #CE2020; font-size: 12px;"></span>

              </div>

            </div>

          </div>