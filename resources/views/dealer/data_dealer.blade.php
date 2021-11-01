@extends('layout.app_new')

@section('title','$title')



@section('content')
<div class="row mt--2">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3"><i class="icon-information"></i> Tabel {{ $title }} </h5>
                @if(Session::get('akses') == "admin")
                <div class="mb-3">
                    <button type="button" class="btn btn-round btn-success" data-toggle="modal" data-target="#myData">
                        <i class="fa fa-plus"></i> Tambah
                    </button>
                </div>
                @endif

                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Dealer</th>
                                <th>Nama Dealer</th>
                                <th>Alamat</th>
                                <th>Kontak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($no = 1)
                            @foreach($data as $o)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $o->kode_dealer }}</td>
                                <td>{{ $o->nama_dealer }}</td>
                                <td>{{ $o->alamat }}</td>
                                <td>{{ $o->telp }}</td>
                                <td>
                                    @if(Session::get('akses') == "admin")
                                    <button class="btn btn-icon btn-round btn-primary" data-toggle="modal"
                                        data-target="#myEdit{{ $o->id_dealer }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    @endif
                                    <button class="btn btn-icon btn-round btn-warning" data-toggle="modal"
                                        data-target="#myDetail{{ $o->id_dealer }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    @if(Session::get('akses') == "admin")
                                    <a href="{{URL('dealer/delete',$o->id_dealer)}}" class="btn btn-round btn-danger"
                                        onclick="return tanya('Yakin hapus data {{ $o->username }}?')"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================== -->

@foreach($data as $o)

<!-- Modal Edit Admin -->
<div class="modal fade" id="myEdit{{ $o->id_dealer }}" tabindex="-1" role="dialog"
    aria-labelledby="myEdit{{ $o->id_dealer }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myEdit{{ $o->id_dealer }}Label">Edit {{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{URL('dealer/update')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="container">
                            <input type="hidden" name="id" value="{{ $o->id_dealer }}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <select name="kode" class="form-control" required="required"
                                                aria-describedby="kodedealer">
                                                <option value="{{ $o->kode_dealer }}">{{ $o->kode_dealer }}</option>
                                                <option disabled="disabled">-----------------</option>
                                                <option value="AA0101">AA0101</option>
                                                <option value="AA0102">AA0102</option>
                                                <option value="AA0104">AA0104</option>
                                                <option value="AA0105">AA0105</option>
                                                <option value="AA0106">AA0106</option>
                                                <option value="AA0107">AA0107</option>
                                                <option value="AA0108">AA0108</option>
                                                <option value="AA0109">AA0109</option>
                                                <option value="AA0104F">AA0104F</option>
                                            </select>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="kodedealer"><i
                                                        class="fas fa-pencil-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Nama Dealer"
                                                name="nama" required="required" value="{{ $o->nama_dealer }}"
                                                aria-label="Nama Dealer" aria-describedby="namadealer">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="namadealer"><i
                                                        class="fas fa-warehouse"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Alamat" name="alamat"
                                                required="required" value="{{ $o->alamat }}" aria-label="Alamat"
                                                aria-describedby="alamatdealer">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="alamatdealer"><i
                                                        class="fas fa-map-marked-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="No. Telp" name="telp"
                                                required="required" value="{{ $o->telp }}" aria-label="No. Telp"
                                                aria-describedby="telpdealer">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="telpdealer"><i
                                                        class="fas fa-phone"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(Session::get('akses') == "admin")

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Koordinat"
                                                name="koordinat" required="required" value="{{ $o->koordinat }}"
                                                aria-label="Koordinat" aria-describedby="koordinatdealer">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="koordinatdealer"><i
                                                        class="fas fa-map-pin"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="checkbox" name="check" id="check"> <label for="check"
                                            style="color: #2339C0;">Centang untuk ganti QR CODE</label>
                                        <input type="hidden" name="qrLama" value="{{ $o->qrcode }}">
                                        <img src="{{ asset('img/$o->qrcode') }}" alt="" width="200px">
                                        <div class="input-group mb-3">
                                            <input type="file" name="qrcode" class="form-control"
                                                value="{{ $o->qrcode }}" aria-label="upload"
                                                aria-describedby="uploadfile">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="uploadfile"><i
                                                        class="fas fa-image"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endif

                        </div>
                    </div>

                    <!-- End Modal Body -->

                    <!-- Modal Footer -->

                    <div class="modal-footer">
                        <button type="submit" name="add" class="btn btn-round btn-primary" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Ubah">
                            <i class="fa fa-floppy-o"></i> Ubah
                        </button>

                        <button type="reset" name="reset" class="btn btn-round btn-warning" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Reset">
                            <i class="fa fa-repeat"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End Modal -->

<!-- =================================================================== -->

@endforeach

<!-- ========================================================== -->

@foreach($data as $o)

<!-- Modal Detail Admin -->
<div class="modal fade" id="myDetail{{ $o->id_dealer }}" tabindex="-1" role="dialog"
    aria-labelledby="myDetail{{ $o->id_dealer }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myDetail{{ $o->id_dealer }}Label">Detail {{ $o->nama_dealer }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <input type="hidden" name="id" value="{{ $o->id_dealer }}">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="mapouter">
                                <div class="gmap_canvas">
                                    <iframe width="600" height="300" id="gmap_canvas" src="{{ $o->koordinat }}"
                                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                                    </iframe>

                                    <a href="https://www.embedgooglemap.net">embedgooglemap.net</a></div>

                                <style>
                                    .mapouter {
                                        position: relative;
                                        text-align: right;
                                        height: 300px;
                                        width: 100%;
                                    }

                                    .gmap_canvas {
                                        overflow: hidden;
                                        background: none !important;
                                        height: 300px;
                                        width: 100%;
                                    }

                                </style>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="qr/{{$o->qrcode}}" alt="X" width="150">
                        </div>

                        <div class="col-lg-8" style="margin-top: 2%;">
                            <table>
                                <tr>
                                    <th><i class="fas fa-pencil-alt"></i></th>
                                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->kode_dealer }}</label></th>
                                </tr>

                                <tr>
                                    <th><i class="fa fa-home"></i></th>
                                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->nama_dealer }}</label></th>
                                </tr>

                                <tr>
                                    <th><i class="fa fa-map-marker"></i></th>
                                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->alamat }}</label></th>
                                </tr>

                                <tr>
                                    <th><i class="fa fa-phone"></i></th>
                                    <th>&nbsp;&nbsp;&nbsp;<label for="">{{ $o->telp }}</label></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Modal -->

<!-- =================================================================== -->

@endforeach

<!-- ========================================================== -->

<!-- Modal Tambah Admin -->
<div class="modal fade" id="myData" tabindex="-1" role="dialog" aria-labelledby="myDataLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myDataLabel">Tambah {{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{URL('dealer/store')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <select name="kode" class="form-control" required="required"
                                                aria-label="kode" aria-describedby="kode">
                                                <option value="AA0101">AA0101</option>
                                                <option value="AA0102">AA0102</option>
                                                <option value="AA0104">AA0104</option>
                                                <option value="AA0105">AA0105</option>
                                                <option value="AA0106">AA0106</option>
                                                <option value="AA0107">AA0107</option>
                                                <option value="AA0108">AA0108</option>
                                                <option value="AA0109">AA0109</option>
                                                <option value="AA0104F">AA0104F</option>
                                            </select>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="kode"><i
                                                        class="fas fa-pencil-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Nama Dealer"
                                                name="nama" required="required" aria-label="Nama Dealer"
                                                aria-describedby="nama">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="nama"><i
                                                        class="fas fa-warehouse"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Alamat" name="alamat"
                                                required="required" aria-label="Alamat Dealer"
                                                aria-describedby="alamat">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="alamat"><i
                                                        class="fas fa-map-marked-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="No. Telp" name="telp"
                                                required="required" aria-label="No. Telp" aria-describedby="telp">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="telp"><i
                                                        class="fas fa-phone"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(Session::get('akses') == "admin")

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Koordinat"
                                                name="koordinat" aria-label="Koordinat" aria-describedby="koordinat">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="koordinat"><i
                                                        class="fas fa-map-pin"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="file" name="qrcode" class="form-control"
                                                placeholder="Upload gambar" aria-label="gambar"
                                                aria-describedby="gambar">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="koordinat"><i
                                                        class="fas fa-image"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endif
                        </div>

                    </div>

                    <!-- End Modal Body -->

                    <!-- Modal Footer -->

                    <div class="modal-footer">
                        <button type="submit" name="add" class="btn btn-round btn-primary" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Simpan">
                            <i class="fa fa-floppy-o"></i> Simpan
                        </button>

                        <button type="reset" name="reset" class="btn btn-round btn-warning" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Reset">
                            <i class="fa fa-repeat"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End Modal -->

<!-- =================================================================== -->

@endsection

@push('after-script')

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

</script>

@endpush
