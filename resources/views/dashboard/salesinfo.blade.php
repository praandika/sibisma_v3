<!-- Info Penjualan -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
        <div class="card card-stats card-round">
            <a type="button" data-toggle="modal" data-target="#saleTahun" style="cursor: pointer">
                <div class="card-body ">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Penjualan {{ $tahun }}</p>
                                <h4 class="card-title">{{ number_format($yearSale , 0, ',', '.') }} Unit</h4>
                                <span class="text-danger">
                                    -3%
                                    <i class="fa fa-chevron-down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
        <div class="card card-stats card-round">
            <div class="card-body ">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-calendar-minus"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Penjualan {{ $bln }}</p>
                            <h4 class="card-title">{{ number_format($monthSale , 0, ',', '.') }} Unit</h4>
                            <span class="text-danger">
                                -3%
                                <i class="fa fa-chevron-down"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
        <div class="card card-stats card-round">
            <div class="card-body ">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Penjualan Hari Ini</p>
                            <h4 class="card-title">{{ number_format($daySale , 0, ',', '.') }} Unit</h4>
                            <span class="text-danger">
                                -3%
                                <i class="fa fa-chevron-down"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Info Penjualan -->

<!-- Chart Section 1 -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                {!! $chartJualbyDealer->container() !!}
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                {!! $chartJual->container() !!}
            </div>
        </div>
    </div>
</div>
<!-- END Chart Section 1 -->