@extends('template.admin.main_simple')
@section('css')
    <style>
        /*the container must be positioned relative:*/
        .autocomplete {
            position: relative;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        /*when hovering an item:*/
        .autocomplete-items div:hover {
            background-color: #e9e9e9;
        }

        /*when navigating through the items using the arrow keys:*/
        .autocomplete-active {
            background-color: DodgerBlue !important;
            color: #ffffff;
        }
    </style>
@endsection
@section('content')
    <div class="mb-20">
        <div class="faq-wrap">
            <div id="accordion">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-block" data-toggle="collapse" id="btn-group-form" data-target="#faq1">
                            PILIH FORM
                        </button>
                    </div>
                    <div id="faq1" class="collapse show" data-parent="#accordion">
                        <div class="pd-10 row">
                            <div class="col-md-5 mb-5">
                                <div class="card-box pd-10">
                                    <h4 id="form-1" class="mb-20 h4 text-blue">Group Form </h4>
                                    <div class="row">
                                        <div class="col-9" id="head-form-title">
                                            <select onchange="fromTable('GROUP-FORM', 'table')" name="GROUP-FORM"
                                                id="GROUP-FORM" class="custom-select2 form-control GROUP-FORM"
                                                style="width: 100%;">
                                                <option value="">Pilih Group Form</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="card-box pd-10">
                                    <div class="card-header form-control">
                                        <h4 class="mb-20 h4 text-blue" id="form-title-done">Pilih Form</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="" id="forms-group-form">

                                        </div>
                                        <select name="select-forms-group-form" id="select-forms-group-form"
                                            class="custom-select2 form-control" style="width: 100%;">
                                            <option value="">Pilih Kegiatan</option>
                                        </select>

                                        <button type="button" class="btn btn-success mt-5">simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row  pd-20">
        <div class="col-md-6 pd-20 card-box pb-10 mb-20">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h4 id="title-form" class="mb-20 h4 text-blue">Form Kegiatan</h4>
                    </div>
                </div>
                <form action="/activity/store-data" method="POST" id="form-activity-data" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 row" id="form-choose-place">

                    </div>
                </form>
            </div>
        </div>
    </div>




    <div class="card-box pb-10 mb-20">
        <div class="row pd-20">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4 id="header-table_name" class="mb-20 h4 text-blue">Deskripsi tb_activity</h4>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="dropdown">
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        Menu
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" onclick="openNewActivity()" href="#">Tambah Kegiatan</a>
                        <a class="dropdown-item" href="#">xxx</a>
                        <a class="dropdown-item" href="#">yyyy</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="datatable-element">

        </div>
    </div>

    {{-- modal new activity --}}
    <div class="modal fade" id="modal-new-activity" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Pilih Jenis Kegiatan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" id="much-use-form">

                    </div>
                    <select onchange="selectFrom('')" name="activity" id="activity"
                        class="custom-select2 form-control select-activity" style="width: 100%;">
                        <option value="">Pilih Kegiatan</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary">
                        Laporkan Kegiatan
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal from_table --}}
    <div class="modal fade" id="modal-from_table" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Data Dari Table
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <label for="table">Table Rujukan</label>
                    <select name="table" id="table" onchange="selectTableSource()"
                        class="custom-select2 form-control select-table" style="width: 100%;">
                        <option value="">Pilih tabel</option>
                    </select>
                </div>
                <div class="modal-body">
                    <label for="field_source">Kolom Rujukan</label>
                    <select name="field_source" id="field_source" class="custom-select2 form-control select-field_source"
                        style="width: 100%;">
                        <option value="">Pilih kolom</option>
                    </select>
                </div>
                <div class="modal-body">
                    <label for="field_get">Kolom diambil</label>
                    <select name="field_get" id="field_get" class="custom-select2 form-control select-field_get"
                        style="width: 100%;">
                        <option value="">Pilih kolom</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="saveFromTable()">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        //get tables from database
        
        
    </script>
@endsection
