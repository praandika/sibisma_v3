        <div class="modal-body">

          <div class="container">

            

            <input type="hidden" name="kode_dealer" value="{{ $home }}">
            <input type="text" name="id_unit" id="id_unit">

            <div class="row">

              <div class="col-lg-6 col-md-7 col-sm-9">

              <div class="form-group has-feedback">

                <a href="" data-toggle="modal" data-target="#myModal">

                <input type="text" class="form-control" placeholder="Nama Unit" name="nama" id="unit" required="required">

                <span class="fa fa-pencil form-control-feedback"></span>

                </a>

              </div>

            </div>

            </div>

            

            <div class="row">

            <div class="col-lg-6 col-md-7 col-sm-9">

              <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Jenis Unit" name="jenis" id="jenis" required="required">

                <span class="fa fa-info form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6 col-md-7 col-sm-9">

              <div class="form-group has-feedback">

                <select name="warna" class="js-example-basic-single">

                  <option></option>

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

                <input type="text" class="form-control" placeholder="Tahun" name="tahun" required="required">

                <span class="fa fa-calendar form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6 col-md-7 col-sm-9">

              <div class="form-group has-feedback">

                <input type="number" class="form-control" placeholder="Stok" name="stok" id="stok" required="required" value="0">

                <span class="fa fa-motorcycle form-control-feedback"></span>

              </div>

            </div>

            </div>



            <div class="row">

            <div class="col-lg-6 col-md-7 col-sm-9">

              <div class="form-group has-feedback">

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

          <button class="btn btn-primary round-custom-2" type="submit" name="add"><i class="fa fa-floppy-o"></i> Simpan</button>

          <button class="btn btn-warning round-custom-1" type="reset" name="reset"><i class="fa fa-repeat"></i> Reset</button>

        </div>