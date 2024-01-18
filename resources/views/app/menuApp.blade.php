@extends('app.layouts.main')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Contact Directory</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Contact Directory
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-10">
            <div class="pull-left">
                <h4 class="text-blue h4">Manage Form</h4>
                <p>Tambah atau edit form</p>
            </div>
            <div class="pull-right">
                <a href="#basic-form1" class="btn btn-primary btn-sm scroll-click" rel="content-y" data-toggle="collapse"
                    role="button">Reset</a>
            </div>
        </div>
        <form>
            <div class="profile-info">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Nama Form</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" type="text" placeholder="Johnny Brown">
                    </div>
                    <div class="col-sm-12 col-md-1">
                        <button class="btn btn-danger">del</button>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Jenis Menu</label>
                    <div class="col-sm-12 col-md-4">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="options" id="option2" autocomplete="off" checked="">
                                Menu
                            </label>
                            <label class="btn btn-outline-primary active">
                                <input type="radio" name="options" id="option3" autocomplete="off">
                                Sub Menu
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-1">
                        <button class="btn btn-danger">del</button>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Nama Menu</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" placeholder="Search Here" type="search">
                    </div>
                    <div class="col-sm-12 col-md-1">
                        <button class="btn btn-danger">del</button>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Jenis Form</label>
                    <div class="col-sm-12 col-md-4">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="jenis-form" id="single" value="single" autocomplete="off" checked="">
                                Single Form
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="jenis-form" id="multi" value="multi" autocomplete="off">
                                Multi Form
                            </label>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-1">
                        <button class="btn btn-danger">del</button>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Nama Jenis Form</label>
                    <div class="col-sm-12 col-md-4">
                        <input name="name-jenis-form" id="name-jenis-form" class="form-control" placeholder="Masukan kelompok Form" type="search">
                    </div>
                    <div class="col-sm-12 col-md-1">
                        <button class="btn btn-danger">del</button>
                    </div>
                </div>
            </div>
            <div class="profile-info">
            </div>
        </form>
        <button class="btn btn-sm btn-primary">x</button>
    </div>

    <div class="faq-wrap">
        <h4 class="mb-30 h4 text-blue padding-top-10">Collapse example</h4>

        <div class="padding-bottom-30">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-block" data-toggle="collapse" data-target="#faq-manage-database">
                        <h4 class="text-blue h4">Buat Baru Tabel</h4>
                    </button>
                </div>
                <div id="faq-manage-database" class="collapse show">
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Nama Tabel</label>
                                <div class="col-sm-12 col-md-10">
                                    <input id="description_table" class="form-control" type="text"
                                        placeholder="Masukan Nama Tabel .." />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Group Tabel</label>
                                <div class="col-sm-12 col-md-10">
                                    <select class="custom-select2 form-control" id="GROUP-DATABASE" name="state"
                                        style="width: 100%; height: 38px">
                                        <option value="">pilihan</option>
                                    </select>
                                </div>
                            </div>
                            <div id="divFields">
                                <div class="row" id="field-1">
                                    <div class="col-sm-12 col-md-3 mb-10">
                                        <label for="">Nama field</label>
                                        <input class="form-control" id="description_field-1" name="description_field-1"
                                            type="text" placeholder="Exc. Karyawan" />
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-10">
                                        <label for="">Jenis isian</label>
                                        <select onchange="onChangeInputType(1)" class="custom-select2 form-control" name="value_field-1" id="value_field-1"
                                            style="width: 100%; height: 38px">

                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-1">
                                        <label for="">Hapus</label>
                                        <button onclick=btnDeleteField(1) class="btn btn-danger">
                                            <i class="icon-copy dw dw-delete-3"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-7 col-sm-12 mb-30 ">
                                        <div class="card  bg-ligth card-box">
                                            <div class="card-body">
                                                <h5 class="card-title  text-center pd-5">Identitas</h5>
                                                <div class="row" id="field-1">
                                                    <div class="col-sm-12 col-md-5 mb-10">
                                                        <label for="">Nama field</label>
                                                        <input class="form-control" id="description_field-1" name="description_field-1"
                                                            type="text" placeholder="Exc. Karyawan" />
                                                    </div>
                                                    <div class="col-sm-12 col-md-5 mb-10">
                                                        <label for="">Jenis isian</label>
                                                        <select onchange="onChangeInputType(1)" class="custom-select2 form-control" name="value_field-1" id="value_field-1"
                                                            style="width: 100%; height: 38px">
                
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-2">
                                                        <label for="">Hapus</label>
                                                        <button onclick=btnDeleteField(1) class="btn btn-danger">
                                                            <i class="icon-copy dw dw-delete-3"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-12  text-center">
                                                        <button onclick="btnAddField()" type="button" class="btn btn-lg btn-primary">
                                                            tambah field <i class="icon-copy bi bi-plus-square"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>                                
                            </div>
                            


                            <div class="form-group row">
                                <div class="col-sm-12 col-md-6  text-center">
                                    <button onclick="btnAddField()" type="button" class="btn btn-lg btn-primary">
                                        tambah field <i class="icon-copy bi bi-plus-square"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="btn-list">
                                <button type="button" onclick="btnSaveTable()" class="btn btn-info btn-lg">
                                    simpan
                                </button>
                            </div>
                            <div class="form-group row">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq2-2">
                        Daftar Database
                    </button>
                </div>
                <div id="faq2-2" class="collapse">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                        accusamus terry richardson ad squid. 3 wolf moon officia
                        aute, non cupidatat skateboard dolor brunch. Food truck
                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                        sunt aliqua put a bird on it squid single-origin coffee
                        nulla assumenda shoreditch et. Nihil anim keffiyeh
                        helvetica, craft beer labore wes anderson cred nesciunt
                        sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                        Leggings occaecat craft beer farm-to-table, raw denim
                        aesthetic synth nesciunt you probably haven't heard of them
                        accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script_javascript')
    <script>
        let header_data = {
                "jenis_menu": {

                    "menu": {
                        "PERUSAHAAN": {
                            "UUID": "PERUSAHAAN",
                            "DESCRIPTION": "Perusahaan"
                        }
                    },
                    "sub-menu": {
                        "STATUS-ABSEN": {
                            "UUID": "STATUS-ABSEN",
                            "DESCRIPTION": "Status Absen"
                        },
                        "JENIS-KELAMIN": {
                            "UUID": "JENIS-KELAMIN",
                            "DESCRIPTION": "Jenis Kelamin"
                        },
                    }
                },
                "nama_form": {
                    'EMPLOYEES': {
                        "UUID": "EMPLOYEES",
                        "DESCRIPTION": "Data Karyawan"
                    }
                }
            }

            conLog('header data', header_data);

        
        
    </script>
    <script>
        $(document).ready(function() {
            // Initial check to set the initial state
            toggleInput();

            // Listen for changes in the radio button selection
            $('input[name="jenis-form"]').change(function() {
                // When the radio button changes, call the function to toggle the input
                toggleInput();
            });

            function toggleInput() {
                // Get the value of the selected radio button
                var selectedValue = $('input[name="jenis-form"]:checked').val();

                // Enable or disable the input based on the selected value
                $('#name-jenis-form').prop('disabled', selectedValue === 'single');
            }
        });
    </script>

@endsection()
