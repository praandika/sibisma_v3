<!-- ========================================================== -->

<!-- Modal Unit -->

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Daftar Unit</h4>

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

            <div class="table-responsive">

            <table id="myTable1" class="table table-bordered table-striped table-hover">

              <thead>

                <tr>

                  <th>#</th>

                  <th>Unit</th>

                  <th>Jenis</th>

                </tr>

              </thead>

              <tbody>

                @php ($no = 1)

                @foreach($unit as $o)

                <tr class="klik" data-jenis="{{ $o->jenis_unit }}" data-unit="{{ $o->nama_unit }}" data-id_unit="{{ $o->id_unit }}">

                  <td>{{ $no++ }}</td>

                  <td>{{ $o->nama_unit }}</td>

                  <td>{{ $o->jenis_unit }}</td>

                </tr>

                @endforeach

              </tbody>

            </table>

            </div>

        </div>

    <!-- End Modal Body -->

      

    </div>

  </div>

</div>

<!-- End Modal -->

<!-- =================================================================== -->