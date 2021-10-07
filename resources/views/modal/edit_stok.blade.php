        <div class="modal-body">

          <div class="container">

            <input type="hidden" name="kode_dealer" value="{{ $home }}">

            <input type="hidden" name="id" value="{{ $o->id_stok }}">

            <div class="row">

              <div class="col-lg-6 col-md-7 col-sm-9">

                <center>

                  <img src="{{ URL('img/'.$o->gambar_id) }}" alt="X" style="width: 290px; height: 240px;">

                </center>

              </div>

            </div>



            <div class="row">

              <div class="col-lg-6 col-md-7 col-sm-9">

              <div class="form-group has-feedback">

                <a href="" data-toggle="modal" data-target="#myModal">

                <label for="unit" style="font-size: 12px;">Nama Unit</label>

                <input type="text" class="form-control" placeholder="Nama Unit" name="nama" id="unit" required="required" value="{{ $o->nama_motor }}">

                <span class="fa fa-motorcycle form-control-feedback"></span>

                </a>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6 col-md-7 col-sm-9">

              <div class="form-group has-feedback">

                <label for="warna" style="font-size: 12px;">Warna</label>

                <select name="warna" class="warna-example">

                  <option value="{{ $o->warna }}">{{ $o->warna }}</option>

                  <option disabled="disabled">------------------------------</option>

                   @foreach($warna as $w)

                    <option value="{{ $w->warna }}">{{ $w->warna }}</option>

                  @endforeach

                </select>

                <span class="fa fa-tint form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6 col-md-7 col-sm-9">

              <div class="form-group has-feedback">

                <label for="jenis" style="font-size: 12px;">Jenis</label>

                <input type="text" class="form-control" placeholder="Jenis Unit" name="jenis" id="jenis" required="required" value="{{ $o->jenis }}">

                <span class="fa fa-info form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6 col-md-7 col-sm-9">

              <div class="form-group has-feedback">

                <label for="tahun" style="font-size: 12px;">Tahun</label>

                <input type="text" class="form-control" id="tahun" placeholder="Tahun" name="tahun" required="required" value="{{ $o->tahun }}">

                <span class="fa fa-calendar form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6 col-md-7 col-sm-9">

              <div class="form-group has-feedback">

                <label for="stok" style="font-size: 12px;">Stok</label>

                <input type="number" class="form-control" id="stok" placeholder="Stok" name="stok" required="required" value="{{ $o->stok }}">

                <span class="fa fa-briefcase form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6 col-md-7 col-sm-9">

              <div class="form-group has-feedback">

                <input type="hidden" name="gambarLama" value="{{ $o->gambar_id }}">

                <input type="checkbox" name="check" id="cek"><label for="cek">Centang jika ingin mengubah gambar</label>

                <input type="file" class="form-control" placeholder="Gambar" name="gambar">

                <span class="fa fa-image form-control-feedback"></span>

              </div>

            </div>

            </div>



          </div>

        </div>

    <!-- End Modal Body -->

    <!-- Modal Footer -->

        <div class="modal-footer">

          <button class="btn btn-primary" type="submit" name="add"><i class="fa fa-floppy-o"></i> Ubah</button>

          <button class="btn btn-warning" type="reset" name="reset"><i class="fa fa-repeat"></i> Reset</button>

        </div>