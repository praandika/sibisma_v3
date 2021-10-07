<!-- ========================================================== -->

<!-- Modal Login History -->

<div class="modal fade" id="historyLogin" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Header Modal -->

      <div class="modal-header">

        <div class="row">

          <div class="col-lg-11">

            <h4 class="modal-title">Login History</h4>

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

            <th>Username</th>

            <th>Nama</th>

            <th>Login</th>

            <th>Logout</th>

            </tr>

        </thead>

        <tbody>

            @php ($no = 1)

            @foreach($data_user as $o)

            <tr>

            <td>{{ $no++ }}</td>

            <td>{{ $o->username }}</td>

            <td>{{ $o->name }}</td>

            <td>{{ $o->login }}</td>

            <td>{{ $o->logout }}</td>

            </tr>

            @endforeach

        </tbody>

        </table>

        </div>

        </div>

      <!-- End Modal Footer -->

      

    </div>

  </div>

</div>

<!-- End Modal -->

<!-- =================================================================== -->