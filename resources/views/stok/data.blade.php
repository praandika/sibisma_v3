@extends('layout.app_new')

@section('title','$title')

@section('content')

<div class="row mt--2">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3"><i class="icon-information"></i> Tabel {{ $title }} | <strong><i
                            class="fa fa-motorcycle"></i> {{ $stok }} Unit</strong></h5>

                @if(Session::get('akses') == "admin")
                <div class="row .d-none .d-sm-block">
                    <div class="col-lg-6 col-md-6 col-sm-6" align="left">
                        <button class="btn btn-success btn-rounded" data-toggle="modal" data-target="#myData"><i
                                class="icon-plus"></i> Tambah</button>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6" align="right">
                        <a href="{{ URL('report/stok/excel',$home) }}" class="btn btn-success btn-rounded"><i
                                class="fa fa-file-excel-o"></i> Export Excel</a>
                        <a href="{{ URL('report/stok/print',$home) }}" class="btn btn-primary btn-rounded"><i
                                class="fa fa-print"></i> Cetak</a>
                    </div>
                </div>

                <div class="row .d-block .d-sm-none mb-3">
                    <div class="col-lg-12 col-md-12 col-sm-12" align="left">
                        <button class="btn btn-success btn-rounded" data-toggle="modal" data-target="#myData"><i
                                class="icon-plus"></i> Tambah</button>
                        <a href="{{ URL('report/stok/excel',$home) }}" class="btn btn-rounded btn-success"><i
                                class="far fa-file-excel"></i> Export Excel</a>
                        <a href="{{ URL('report/stok/print',$home) }}" class="btn btn-primary btn-rounded"><i
                                class="icon-printer"></i> Cetak</a>
                    </div>
                </div>

                @endif

                <form action="{{ URL('stok/dstok') }}" method="POST">
                    {{ csrf_field() }}

                    @include('template.tb_stok')

                    @if((Session::get('akses') == "super") OR (Session::get('akses') == "admin"))

                    <button class="btn btn-danger btn-rounded" onclick="return tanya('Yakin hapus data ini?')"><i
                            class="icon-trash"></i> Hapus Terpilih</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================== -->

<!-- Modal Tambah Stok -->
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
<!-- LANJUT DISINI YAA -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myData" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- Header Modal -->

            <div class="modal-header">

                <div class="row">

                    <div class="col-lg-11">

                        <h4 class="modal-title"></h4>

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

            <form action="{{URL('stok/cstok')}}" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}



                @include('modal.stok')



            </form>

            <!-- End Modal Footer -->



        </div>

    </div>

</div>

<!-- End Modal -->

<!-- =================================================================== -->



<!-- ========================================================== -->

@foreach($data as $o)

<!-- Modal Edit Admin -->

<div class="modal fade" id="myEdit{{ $o->id_stok }}" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- Header Modal -->

            <div class="modal-header">

                <div class="row">

                    <div class="col-lg-11">

                        <h4 class="modal-title">Edit {{$title}}</h4>

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

            <form action="{{URL('stok/ustok')}}" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}



                @include('modal.edit_stok')



            </form>

            <!-- End Modal Footer -->



        </div>

    </div>

</div>

<!-- End Modal -->

<!-- =================================================================== -->

@endforeach



@include('modal.unit')

@include('modal.detail_stok')





@endsection

@section('script')

<script>
    $(function () {

        $('#myTable').DataTable({

            "aLengthMenu": [
                [50, 75, -1],
                [50, 75, "All"]
            ],

            "iDisplayLength": 50

        })

    })



    $(function () {

        $('#myTable1').DataTable({

            "aLengthMenu": [
                [50, 75, -1],
                [50, 75, "All"]
            ],

            "iDisplayLength": 50

        })

    })

</script>



<script>
    $(document).ready(function () {

        $('.warna-example').select2({

            placeholder: "Pilih Warna",

            allowClear: true

        });

    });

</script>



<script>
    $("#checkAll").click(function () {

        $('input:checkbox').not(this).prop('checked', this.checked);

    });

</script>



<script type="text/javascript">
    //passing data ke input text

    $(document).on('click', '.klik', function (e) {

        document.getElementById("unit").value = $(this).attr('data-unit');

        document.getElementById("jenis").value = $(this).attr('data-jenis');

        document.getElementById("id_unit").value = $(this).attr('data-id_unit');

        $('#myModal').modal('hide');

    });

</script>

@endsection
