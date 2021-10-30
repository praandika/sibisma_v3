<!-- Rangking -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
        <div class="card card-stats card-primary card-round">
            <div class="card-body skew-shadow">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <strong><i class="icon-trophy"></i> 1</strong>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        @if(count($rank1)==0)
                            <div class="numbers">
                                <p class="card-category">Unit belum terjual</p>
                                <h4 class="card-title">0 Unit</h4>
                            </div>
                        @else
                            @foreach($rank1 as $o)
                            <div class="numbers">
                                <p class="card-category">{{ $o->nama_dealer }}</p>
                                <h4 class="card-title"> {{ $o->jumlah }} Unit</h4>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
        <div class="card card-stats card-info card-round">
            <div class="card-body bubble-shadow">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <strong><i class="icon-badge"></i> 2</strong>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        @if(count($rank2)==0)
                            <div class="numbers">
                                <p class="card-category">Unit belum terjual</p>
                                <h4 class="card-title">0 Unit</h4>
                            </div>
                        @else
                            @foreach($rank2 as $o)
                            <div class="numbers">
                                <p class="card-category">{{ $o->nama_dealer }}</p>
                                <h4 class="card-title"> {{ $o->jumlah }} Unit</h4>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
        <div class="card card-stats card-secondary card-round">
            <div class="card-body curves-shadow">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <strong><i class="icon-badge"></i> 3</strong>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        @if(count($rank3)==0)
                            <div class="numbers">
                                <p class="card-category">Unit belum terjual</p>
                                <h4 class="card-title">0 Unit</h4>
                            </div>
                        @else
                            @foreach($rank3 as $o)
                            <div class="numbers">
                                <p class="card-category">{{ $o->nama_dealer }}</p>
                                <h4 class="card-title"> {{ $o->jumlah }} Unit</h4>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Ranking -->
