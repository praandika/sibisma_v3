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

            <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5 col-xl-5">
              <div class="form-group has-feedback">
                <a href="" data-toggle="modal" data-target="#myStok">
                <input type="text" class="form-control" placeholder="Nama Unit" id="unit1" name="unit" required="required" readonly="readonly" value="{{ old('unit') }}">
                <input type="hidden" id="id_stok" required="required" class="form-control" name="id_stok" value="{{ old('id_stok') }}">
                <span class="fa fa-motorcycle form-control-feedback"></span>
                </a>
              </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
              <div class="form-group has-feedback">
                <select name="leasing[]" id="leasing" class="js-example-basic-multiple form-control" multiple="multiple" required="required">
                  @foreach($leasing as $o)
                    <option value="{{ $o->nama_leasing }}">{{ $o->nama_leasing }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Jenis Unit" name="jenis" id="jenis1" required="required" readonly="readonly" value="{{ old('jenis') }}">
                <span class="fa fa-info form-control-feedback"></span>
              </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2 col-xl-2">
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Tahun" name="tahun" id="tahun" required="required" readonly="readonly" value="{{ old('tahun') }}">
                <span class="fa fa-info form-control-feedback"></span>
              </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 col-xl-3">
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Warna" name="warna" id="warna" required="required" readonly="readonly" value="{{ old('warna') }}">
                <span class="fa fa-tint form-control-feedback"></span>
              </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 col-xl-2">
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Stok" name="stok" id="stok" required="required" readonly="readonly" value="{{ old('stok') }}">
                <span class="fa fa-briefcase form-control-feedback"></span>
              </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 col-xl-2">
              <div class="form-group has-feedback">
                <input type="number" class="form-control" placeholder="Qty" name="qty" id="qty" required="required" value="{{ old('qty') }}" @if(Session::has('autofocus')) autofocus="autofocus" style="border-color: red; box-shadow: 0px 0px 5px red;" @endif onchange="cekStok()">
                <span class="fa fa-check form-control-feedback"></span>
                <span class="help-block label label-danger" id="alert-stok" style="color: #CE2020; font-size: 12px;"></span>
              </div>
            </div>
          </div>