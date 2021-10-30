@push('after-css')
    <style>
        .tb-row-total{
            background-color: #1572e8;
            color: #fff;
        }

        table tbody tr.tb-row-rangking-1{
            font-weight: bold;
            color: #Be2525;
        }

        table tbody tr.tb-row-rangking-2{
            font-weight: bold;
            color: #D4602b;
        }

        table tbody tr.tb-row-rangking-3{
            font-weight: bold;
            color: #Da8c13;
        }
    </style>
@endpush
<!-- Modal Sale Tahun-->
<div class="modal fade" id="saleTahun" tabindex="-1" role="dialog" aria-labelledby="saleTahunLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saleTahunLabel">Detail Penjualan {{ $tahun }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tbYearSale" class="table table-head-bg-primary">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Nama Dealer</th>
                                <th>Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($no = 1)
                            @foreach($yearSaleDetail as $o)
                                @if($no == 1)
                                <tr class="tb-row-rangking-1">
                                    <td> {{ $no ++ }} <i class="icon-trophy"></i></td>
                                    <td> {{ $o->nama_dealer }} </td>
                                    <td> {{ $o->jumlah }} Unit</td>
                                </tr>
                                @elseif($no == 2)
                                <tr class="tb-row-rangking-2">
                                    <td> {{ $no ++ }} <i class="icon-badge"></i></td>
                                    <td> {{ $o->nama_dealer }} </td>
                                    <td> {{ $o->jumlah }} Unit</td>
                                </tr>
                                @elseif($no == 3)
                                <tr class="tb-row-rangking-3">
                                    <td> {{ $no ++ }} <i class="icon-star"></i></td>
                                    <td> {{ $o->nama_dealer }} </td>
                                    <td> {{ $o->jumlah }} Unit</td>
                                </tr>
                                @else
                                <tr>
                                    <td> {{ $no ++ }}</td>
                                    <td> {{ $o->nama_dealer }} </td>
                                    <td> {{ $o->jumlah }} Unit</td>
                                </tr>
                                @endif
                            @php($total += $o->jumlah)
                            @endforeach
                            <tr class="tb-row-total">
                                <th colspan=2> Total Group</td>
                                <th> {{ $total }} Unit</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                &copy; CRM Bisma {{ $tahun }}
            </div>
        </div>
    </div>
</div>
