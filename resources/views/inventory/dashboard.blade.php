@extends('layout.app_new')

@section('title','$title')

@section('content')

    @include('dashboard.search')
    @include('dashboard.rank')
	@include('dashboard.salesinfo')
    @include('dashboard.otherinfo')

    @include('dashboard.modalsalesinfo')

@endsection

@push('after-script')

    @if($chartJual)

    {!! $chartJual->script() !!}

    @endif

<!--  -->

    @if($chartJualbyDealer)

    {!! $chartJualbyDealer->script() !!}

    @endif

<!--  -->

    @if($chartService)

    {!! $chartService->script() !!}

    @endif

<!--  -->

    @if($chartStokTerbanyak)

    {!! $chartStokTerbanyak->script() !!}

    @endif

<!--  -->

    @if($chartUnitTerlaris)

    {!! $chartUnitTerlaris->script() !!}

    @endif

<!--  -->

    <script>
        $(function () {

            $('#tableIn').DataTable({

                "searching": false,

                "paging": false,

                "lengthChange": false,

                "ordering": false

            })

        })

    </script>

    <script>
        $(document).ready(function () {

            $('.js-example-basic-multiple-unit').select2({

                placeholder: "Cari Unit",

                allowClear: true

            });

        });

        $(document).ready(function () {

            $('.js-example-basic-multiple-warna').select2({

                placeholder: "Cari Warna",

                allowClear: true

            });

        });

    </script>

@endpush
