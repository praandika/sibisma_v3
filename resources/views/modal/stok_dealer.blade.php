<div class="modal-body">
<div class="table-responsive">
  <table id="TableStok" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
          <th>#</th>
          <th>Unit</th>
          <th>Warna</th>
          <th>Stok</th>
          <th>Jenis</th>
          <th>Tahun</th>
        </tr>
        </thead>
        <tbody>
        @php ($no = 1)
        @foreach($data as $o)
        <tr class="pilih" 
        data-unit1="{{ $o->nama_motor }}"
        data-warna="{{ $o->warna }}"
        data-stok="{{ $o->stok }}"
        data-jenis1="{{ $o->jenis }}"
        data-tahun="{{ $o->tahun }}"
        data-id_stok="{{ $o->id_stok }}">
          <td>{{ $no++ }}</td>
          <td>{{ $o->nama_motor }}</td>
          @include('template.tdwarna')
          <td>{{ $o->stok }}</td>
          <td>{{ $o->jenis }}</td>
          <td>{{ $o->tahun }}</td>
        </tr>
        @endforeach
        </tbody>
  </table>
</div>
</div>