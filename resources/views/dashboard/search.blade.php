<div class="row mt--2">
    <!-- Search -->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3"><i class="fas fa-search"></i> Pencarian</h5>
                <h6 class="card-subtitle mb-2 text-muted">Cari unit di semua dealer</h6>
                <form action="{{ URL('inventory/cari') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-3">
                            <select name="cariUnit" id="unit" class="js-example-basic-multiple-unit form-control">
                                <option></option>
                                @foreach($dataUnit as $o)
                                <option value="{{ $o->nama_motor }}">{{ $o->nama_motor }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-3">
                            <select name="cariWarna" id="warna" class="js-example-basic-multiple-warna form-control">
                                <option></option>
                                @foreach($dataWarna as $o)
                                <option value="{{ $o->warna }}">{{ $o->warna }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                            <button class="btn btn-primary btn-round btn-sm"><i
                                    class="fa fa-search"></i>&nbsp;&nbsp;&nbsp; <strong>Cari</strong></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- END Search -->
</div>