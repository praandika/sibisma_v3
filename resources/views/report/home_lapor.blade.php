@extends('layout.app')
@section('title','$title')

@section('content')

@if(Session::get('login') AND (Session::get('akses')=='viewer'))
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
    <a href="{{ URL('lapor/'.$home.'') }}">
        <div class="info-box bg-blue">

        <span class="info-box-icon"><i class="fa fa-home"></i></span>



        <div class="info-box-content">

            <span class="info-box-text">{{ $home }}</span>

            <span class="info-box-number">{{ $dealer }}</span>



            <div class="progress">

            <div class="progress-bar" style="width: 100%"></div>

            </div>

                <span class="progress-description">

                <i class="fa fa-pencil"></i> Buat Lap. Stok

                </span>

        </div>

        <!-- /.info-box-content -->

        </div>

        <!-- /.info-box -->
        </a>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <a href="{{ URL('lapor/AA0101') }}">
        <div class="info-box bg-blue">

        <span class="info-box-icon"><i class="fa fa-home"></i></span>



        <div class="info-box-content">

            <span class="info-box-text">AA0101</span>

            <span class="info-box-number">Bisma Sentral</span>



            <div class="progress">

            <div class="progress-bar" style="width: 100%"></div>

            </div>

                <span class="progress-description">

                <i class="fa fa-pencil"></i> Buat Lap. Stok

                </span>

        </div>

        <!-- /.info-box-content -->

        </div>

        <!-- /.info-box -->
        </a>

    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <a href="{{ URL('lapor/AA0102') }}">
        <div class="info-box bg-blue">

        <span class="info-box-icon"><i class="fa fa-home"></i></span>



        <div class="info-box-content">

            <span class="info-box-text">AA0102</span>

            <span class="info-box-number">Bisma Cokro</span>



            <div class="progress">

            <div class="progress-bar" style="width: 100%"></div>

            </div>

                <span class="progress-description">

                <i class="fa fa-pencil"></i> Buat Lap. Stok

                </span>

        </div>

        <!-- /.info-box-content -->

        </div>

        <!-- /.info-box -->
        </a>

    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <a href="{{ URL('lapor/AA0104') }}">
        <div class="info-box bg-blue">

        <span class="info-box-icon"><i class="fa fa-home"></i></span>



        <div class="info-box-content">

            <span class="info-box-text">AA0104</span>

            <span class="info-box-number">Bisma Hasanuddin</span>



            <div class="progress">

            <div class="progress-bar" style="width: 100%"></div>

            </div>

                <span class="progress-description">

                <i class="fa fa-pencil"></i> Buat Lap. Stok

                </span>

        </div>

        <!-- /.info-box-content -->

        </div>

        <!-- /.info-box -->
        </a>

    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <a href="{{ URL('lapor/AA0105') }}">
        <div class="info-box bg-blue">

        <span class="info-box-icon"><i class="fa fa-home"></i></span>



        <div class="info-box-content">

            <span class="info-box-text">AA0105</span>

            <span class="info-box-number">Bisma TTS</span>



            <div class="progress">

            <div class="progress-bar" style="width: 100%"></div>

            </div>

                <span class="progress-description">

                <i class="fa fa-pencil"></i> Buat Lap. Stok

                </span>

        </div>

        <!-- /.info-box-content -->

        </div>

        <!-- /.info-box -->
        </a>

    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <a href="{{ URL('lapor/AA0106') }}">
        <div class="info-box bg-blue">

        <span class="info-box-icon"><i class="fa fa-home"></i></span>



        <div class="info-box-content">

            <span class="info-box-text">AA0106</span>

            <span class="info-box-number">Bisma Imbo</span>



            <div class="progress">

            <div class="progress-bar" style="width: 100%"></div>

            </div>

                <span class="progress-description">

                <i class="fa fa-pencil"></i> Buat Lap. Stok

                </span>

        </div>

        <!-- /.info-box-content -->

        </div>

        <!-- /.info-box -->
        </a>

    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <a href="{{ URL('lapor/AA0107') }}">
        <div class="info-box bg-blue">

        <span class="info-box-icon"><i class="fa fa-home"></i></span>



        <div class="info-box-content">

            <span class="info-box-text">AA0107</span>

            <span class="info-box-number">Bisma Mandiri</span>



            <div class="progress">

            <div class="progress-bar" style="width: 100%"></div>

            </div>

                <span class="progress-description">

                <i class="fa fa-pencil"></i> Buat Lap. Stok

                </span>

        </div>

        <!-- /.info-box-content -->

        </div>

        <!-- /.info-box -->
        </a>

    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <a href="{{ URL('lapor/AA0108') }}">
        <div class="info-box bg-blue">

        <span class="info-box-icon"><i class="fa fa-home"></i></span>



        <div class="info-box-content">

            <span class="info-box-text">AA0108</span>

            <span class="info-box-number">Bisma WR Supratman</span>



            <div class="progress">

            <div class="progress-bar" style="width: 100%"></div>

            </div>

                <span class="progress-description">

                <i class="fa fa-pencil"></i> Buat Lap. Stok

                </span>

        </div>

        <!-- /.info-box-content -->

        </div>

        <!-- /.info-box -->
        </a>

    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <a href="{{ URL('lapor/AA0109') }}">
        <div class="info-box bg-blue">

        <span class="info-box-icon"><i class="fa fa-home"></i></span>



        <div class="info-box-content">

            <span class="info-box-text">AA0109</span>

            <span class="info-box-number">Bisma Sunset Road</span>



            <div class="progress">

            <div class="progress-bar" style="width: 100%"></div>

            </div>

                <span class="progress-description">

                <i class="fa fa-pencil"></i> Buat Lap. Stok

                </span>

        </div>

        <!-- /.info-box-content -->

        </div>

        <!-- /.info-box -->
        </a>

    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <a href="{{ URL('lapor/AA0104F') }}">
        <div class="info-box bg-blue">

        <span class="info-box-icon"><i class="fa fa-home"></i></span>



        <div class="info-box-content">

            <span class="info-box-text">AA0104F</span>

            <span class="info-box-number">Bisma Flagship Shop</span>



            <div class="progress">

            <div class="progress-bar" style="width: 100%"></div>

            </div>

                <span class="progress-description">

                <i class="fa fa-pencil"></i> Buat Lap. Stok

                </span>

        </div>

        <!-- /.info-box-content -->

        </div>

        <!-- /.info-box -->
        </a>

    </div>
</div>
@endif
@endsection