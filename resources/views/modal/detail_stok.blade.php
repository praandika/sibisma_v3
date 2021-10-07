<!-- ========================================================== -->

@foreach($data as $o)

<!-- Modal Detail Stok -->

<div class="modal fade" id="myDetail{{ $o->id_stok }}" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Detail <strong>{{ $o->nama_motor }}</strong></h4>

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

            <input type="hidden" name="id_stok" value="{{ $o->id_stok }}">

            

            <div class="row">

              <div class="col-lg-3 col-md-4 col-sm-6">

                <img src="{{ URL('img/'.$o->gambar_id) }}" alt="X" style="width: 290px; height: 240px;">

              </div>



              <div class="col-lg-4 col-md-5 col-sm-7" style="margin-top: 2%;">

                <table>

                  <tr>

                    <th><i class="fa fa-home"></i></th>

                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->nama_dealer }}</label></th>

                  </tr>

                  <tr>

                    <th><i class="fa fa-motorcycle"></i></th>

                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->nama_motor }}</label></th>

                  </tr>

                  <tr>

                    <th><i class="fa fa-tint"></i></th>

                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->warna }}</label></th>

                  </tr>

                  <tr>

                    <th><i class="fa fa-info"></i></th>

                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->jenis }}</label></th>

                  </tr>

                  <tr>

                    <th><i class="fa fa-calendar"></i></th>

                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->tahun }}</label></th>

                  </tr>

                </table>



                <h1 style="font-size: 50px; color: #403CDA;"><strong>{{ $o->stok }} Unit</strong></h1>

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