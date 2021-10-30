<!-- Chart Section 2 -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                {!! $chartUnitTerlaris->container() !!}
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                {!! $chartStokTerbanyak->container() !!}
            </div>
        </div>
    </div>
</div>
<!-- END Chart Section 2 -->

<!-- Chart Section 3 -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                Multiple Bar line Chart Stok Masuk & Stok Keluar/Laku + ratio Stok
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                {!! $chartService->container() !!}
            </div>
        </div>
    </div>
</div>
<!-- END Chart Section 3 -->