@extends('template.admin.main_privilege')
@section('css')
    <style>
        .modal-confirm {
            color: #636363;
            width: 400px;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            text-align: center;
            font-size: 14px;
        }

        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }

        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }

        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }

        .modal-confirm .modal-body {
            color: #999;
        }

        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            padding: 10px 15px 25px;
        }

        .modal-confirm .modal-footer a {
            color: #999;
        }

        .modal-confirm .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f15e5e;
        }

        .modal-confirm .icon-box i {
            color: #f15e5e;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }

        .modal-confirm .btn,
        .modal-confirm .btn:active {
            color: #fff;
            border-radius: 4px;
            background: #60c7c1;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            border-radius: 3px;
            margin: 0 5px;
        }

        .modal-confirm .btn-secondary {
            background: #c1c1c1;
        }

        .modal-confirm .btn-secondary:hover,
        .modal-confirm .btn-secondary:focus {
            background: #a8a8a8;
        }

        .modal-confirm .btn-danger {
            background: #f15e5e;
        }

        .modal-confirm .btn-danger:hover,
        .modal-confirm .btn-danger:focus {
            background: #ee3535;
        }

        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="min-height-200px">
                <!-- Identitas Karyawan -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="pd-20 card-box mb-20">
                            <div class="clearfix mb-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="text-blue h4">Detail Purchase Order</h4>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="btn-group">
                                            <div class="btn-group dropdown">
                                                <a href="/purchase-order/create">
                                                    <button class="btn btn-secondary mr-10">Reset</button>
                                                </a>
                                                <a href="#" onclick="storePO()">
                                                    <button class="btn btn-success">Simpan</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="" enctype="multipart/form-data" id="upload_form" method="POST">
                                @csrf
                                <input type="hidden" name="uuid" id="uuid" value="{{ $uuid }}">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group ">
                                            <label for="">Nomor PO</label>
                                            <input type="text" class="form-control" name="po_number" id="po_number">
                                            <div class="invalid-feedback" id="req-po_number">
                                                Data tidak boleh kosong
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tanggal Update</label>
                                            <input name="date" id="date" type="date" class="form-control">
                                            <div class="invalid-feedback" id="req-date">
                                                Data tidak boleh kosong
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="">Dokumen PO <a id="po_path" class="ml-20"
                                                    href="#">lihat</a></label>
                                            <input type="hidden" class="form-control" name="po_path" id="po_path">
                                            <div class="invalid-feedback" id="req-po_file">
                                                Data tidak boleh kosong
                                            </div>
                                            <input type="file" class="form-control" name="po_file" id="po_file">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Surat Jalan <a id="travel_document_path" class="ml-20"
                                                    href="#">lihat</a></label>
                                            <input name="travel_document_path" id="travel_document_path" type="hidden"
                                                class="form-control">
                                            <input name="td_file" id="td_file" placeholder="udin" type="file"
                                                class="form-control">
                                                <div class="invalid-feedback" id="req-td_file">
                                                    Data tidak boleh kosong
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label for="">Keterangan</label>
                                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                                            <div class="invalid-feedback" id="req-description">
                                                Data tidak boleh kosong
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="title">
                                <h4>Gallery</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Gallery
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-6 text-right">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addGalerry">
                                Tambah Gambar <i class="icon-copy fi-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="gallery-wrap">
                    <ul class="row" id="galeries">
                    </ul>
                </div>
            </div>
        </div>


    </div>
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="icon-copy ion-android-delete"></i>
                    </div>
                    <input type="hidden" id="galery_uuids" name="galery_uuids">
                    <h4 class="modal-title w-100">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button onclick="deleteGalery()" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

        <!-- Modal HTML -->
        <div id="addGalerry" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">                   
                        <form action="" enctype="multipart/form-data" id="upload_galery" method="POST">
                            @csrf
                            <input type="hidden" name="purchase_order_uuid" id="purchase_order_uuid" value="">
                            <input type="hidden" name="galery_uuid" id="galery_uuid" value="">
                            <div class="clearfix">
                                <div class="row">
                                    <div class="col-3">
                                        <h4 class="text-blue h4">Galery</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="karyawan">
                                <div class="row" id="row-people-12">
                                    <div class="col-md-12" id="col-md-8-people-12">
                                        <div class="form-group">
                                            <label for="">Judul</label>
                                            <input type="text" id="title" class="form-control"
                                                name="title">
                                            <div class="invalid-feedback" id="req-title">
                                                Masukan Judul terlebih dahulu
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label for="">Gambar</label>
                                            <input onchange="previewImage()" name="image_galery" id="image_galery"
                                                placeholder="udin" type="file" class="form-control mb-10">
                                            <div class="invalid-feedback" id="req-image_galery">
                                                Masukan Judul terlebih dahulu
                                                </div>    
                                            <div class="da-card box-shadow">
                                                <div class="da-card-photo">
                                                    <img id="galery-view"
                                                        src="{{ env('APP_URL') }}vendors/images/default.jpg"
                                                        alt="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                
                    <div class="modal-footer justify-content-center">
                        <button onclick="resetGalery()" type="button" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                        <button onclick="storeGalery()" type="button" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- Modal -->
    <div class="modal fade" id="doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Dokumen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <iframe id="path_doc" src="" style="width:100%; height:500px;"
                            frameborder="0"></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- success modal --}}
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Data Tersimpan</h3>
                    <div class="mb-30 text-center">
                        <img src="{{ env('APP_URL') }}vendors/images/success.png" />
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        Done
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function showdoc(path) {
            $('#path_doc').attr("src", "{{ env('APP_URL') }}purchase/pdf/" + path)
            $('#doc').modal('show')
        }

        function getPayment(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/purchase-order/show";

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    uuid: uuid,
                    _token: _token
                },
                success: function(response) {
                    data = response.data.purchase_orders
                    galeries = response.data.galeries
                    console.log(response)
                    $('#po_number').val(data.po_number),
                        $('#date').val(data.date),
                        $('#travel_document_path').val(data.travel_document_path).trigger("change"),
                        $('#po_path').val(data.po_path).trigger("change"),
                        $('#description').val(data.description),
                        $('#purchase_order_uuid').val(data.uuid)
                    $("#po_path").attr("onclick", "showdoc('" + data.po_path + "')");
                    $("#travel_document_path").attr("onclick", "showdoc('" + data.travel_document_path + "')");
                    if (galeries) {
                        console.log('udin')
                        galeries.forEach(element => {
                            var new_image = `<li class="col-lg-4 col-md-6 col-sm-12" id="${element.uuid}">
                                        <div class="da-card box-shadow">
                                            <div class="da-card-photo">
                                                <img src="{{ env('APP_URL') }}purchase/image/${element.galery_path}" alt="" />
                                                <div class="da-overlay">
                                                    <div class="da-social">
                                                        <h5 class="mb-10 color-white pd-20">${element.title}</h5>
                                                        <ul class="clearfix">
                                                            <li>
                                                                <a class="btn" href="{{ env('APP_URL') }}purchase/image/${element.galery_path}"
                                                                    data-fancybox="images">
                                                                    <i class="fa fa-picture-o"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a onclick="confirmDeleteGalery('${element.uuid}')" class="btn" href="#myModal"data-toggle="modal"><i class="icon-copy ion-android-delete"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>`;
                            $('#galeries').append(new_image);
                        });
                    } else {
                        console.log(galeries)
                    }
                },
                error: function(response) {
                    console.log(response)
                }
            });
        }
        var uuid = @json($uuid);
        if (uuid == '') {
            console.log('uuid');
        } else {
            console.log(uuid);
            getPayment(uuid);
        }


        function storePO() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/purchase-order/store";
            var po_file = $('#po_file')[0].files;

            let muchErr =isRequired(['po_number','date','description','td_file','po_file'])
            console.log('req'+muchErr)

            if(muchErr > 0){
                return false;
            }

            var form = $('#upload_form')[0];
            console.log(form);
            var form_data = new FormData(form);
            console.log(form_data);
            $.ajax({
                url: _url,
                type: "POST",

                //   dataType    : 'json',
                contentType: false,
                processData: false,
                data: form_data,
                success: function(response) {
                    data = response.data
                    $('#purchase_order_uuid').val(data.uuid)
                    $('#uuid').val(data.uuid)
                    
                    $('#success-modal').modal('show')
                },
                error: function(response) {
                    console.log(response)
                }
            });
        }

        function storeGalery() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/galery/store";
            let complite = false;

            let mucherr =isRequired(['title','image_galery'])
            console.log('req'+mucherr)

            if(mucherr > 0){
                return false;
            }else{
                var form = $('#upload_galery')[0];
            console.log(form);
            var form_data = new FormData(form);
            console.log('form_data');
            $.ajax({
                url: _url,
                type: "POST",

                //   dataType    : 'json',
                contentType: false,
                processData: false,
                data: form_data,
                success: function(response) {
                    data = response.data
                    console.log(data)
                    $('#galery_uuid').val(data.galery_uuid)

                    var new_image = `<li class="col-lg-4 col-md-6 col-sm-12" id="${data.galery_uuid}" >
                                        <div class="da-card box-shadow">
                                            <div class="da-card-photo">
                                                <img src="{{ env('APP_URL') }}purchase/image/${data.galery_path}" alt="" />
                                                <div class="da-overlay">
                                                    <div class="da-social">
                                                        <h5 class="mb-10 color-white pd-20">` +
                        data.title + `</h5>
                                                        <ul class="clearfix">
                                                            <li>
                                                                <a class="btn" href="{{ env('APP_URL') }}purchase/image/${data.galery_path}"
                                                                    data-fancybox="images">
                                                                    <i class="fa fa-picture-o"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a onclick="confirmDeleteGalery('${data.galery_uuid}')" class="btn" href="#myModal"data-toggle="modal"><i class="icon-copy ion-android-delete"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>p
                                                </div>
                                            </div>
                                        </div>
                                    </li>`;
                    $('#galeries').append(new_image);
                    $('#galery-view').attr("src", "{{ env('APP_URL') }}vendors/images/default.jpg")
                    $('#success-modal').modal('show')
                    console.log(data);
                    resetGalery();
                },
                error: function(response) {
                    console.log(response)
                }
            });
            }
            
        }

        function previewImage() {
            const image = document.querySelector('#image_galery');
            const imgPreview = document.querySelector('#galery-view');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function resetGalery() {
            $('#galery_uuid').val('');
            $('#image_galery').val('');
            $('#title').val('');
        }

        function deleteGalery() {
            var galery_uuids = $('#galery_uuids').val()
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/galery/delete";

            $.ajax({
                url: _url,
                type: "POST",

                data: {
                    uuid: galery_uuids,
                    _token: _token
                },
                success: function(response) {
                    data = response.data
                    console.log('deleted')
                    $('#myModal').modal('hide')
                    $('#success-modal').modal('show')
                    $("#" + galery_uuids).remove();
                    console.log(data)
                },
                error: function(response) {
                    console.log(response)
                }
            });
        }

        function confirmDeleteGalery(uuid) {
            console.log(uuid);
            $('#galery_uuids').val(uuid)
        }

        function editGalery(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/galery/show/";

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    uuid: uuid,
                    _token: _token
                },
                success: function(response) {
                    data = response.data.purchase_orders
                    galeries = response.data.galeries
                    console.log(response)
                    $('#po_number').val(data.po_number),
                        $('#date').val(data.date),
                        $('#travel_document_path').val(data.travel_document_path).trigger("change"),
                        $('#po_path').val(data.po_path).trigger("change"),
                        $('#description').val(data.description),
                        $('#purchase_order_uuid').val(data.uuid)
                    if (galeries) {
                        console.log('udin')

                    } else {
                        console.log(galeries)
                    }
                },
                error: function(response) {
                    console.log(response)
                }
            });
        }
    </script>
@endsection
