@extends('app.layouts.main')
@section('src_css')
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libsa/orgchart/2.1.3/css/jquery.orgchart.min.css" />
    <style>
        #chart-container {
            font-family: Arial;
            height: 420px;
            border: 2px dashed #aaa;
            border-radius: 5px;
            overflow: auto;
            text-align: center;
        }

        #github-link {
            position: fixed;
            top: 0px;
            right: 10px;
            font-size: 3em;
        }
    </style>
@endsection()

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Hauling</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/web/menu">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="/web/menu">Menu</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Hauling
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    {{-- FORM INPUT HAULING --}}
    <div class="pd-20 card-box mb-30">
        <div class="row">
            <div class="col">
                <h4 class="text-blue h4">Form Timbangan</h4>
            </div>
            <div class="col text-right">
                <div class="button-group text-right ">
                    <button type="button" id="btn-reset" class="btn btn-secondary mb-10">
                        Reset
                    </button>
                    <button type="button" onclick="muatanTiba()" class="btn btn-primary mb-10">
                        Muatan Tiba
                    </button>
                </div>
            </div>
        </div>
        <form action="" id="form-hauling">
            <div class="profile-info mt-10">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group row" id="group-ID-HAULING">
                            <label class="col-sm-12 col-md-5 col-form-label">ID Hauling</label>
                            <div class="col-sm-12 col-md-7">
                                <input class="form-control" disabled type="text" id="ID-HAULING" name="id_hauling"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="form-group row" id="GROUP-SURAT-JALAN">
                            <label class="col-sm-12 col-md-5 col-form-label">Surat Jalan</label>
                            <div class="col-sm-12 col-md-7">
                                <input class="form-control" type="text" name="surat_jalan" id="SURAT-JALAN" required
                                    placeholder="">
                            </div>
                        </div>
                        <div class="form-group row" id="GROUP-DO">
                            <label class="col-sm-12 col-md-5 col-form-label">DO</label>
                            <div class="col-sm-12 col-md-7">
                                <input class="form-control" type="text" id="DO", name="do" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row" id="GROUP-PO">
                            <label class="col-sm-12 col-md-5 col-form-label">PO</label>
                            <div class="col-sm-12 col-md-7">
                                <input class="form-control" id="PO" name="po" type="text" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group row" id="GROUP-PERUSAHAAN">
                            <label class="col-sm-12 col-md-4 col-form-label">Pemilik Batu</label>
                            <div class="col-sm-12 col-md-8">
                                <select style="width: 100%;" name="pemilik_batu" id="PERUSAHAAN" required
                                    class="custom-select2 form-control PERUSAHAAN">
                                    <option value="">Pilih Perusahaan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="GROUP-PENGIRIM-BATU">
                            <label class="col-sm-12 col-md-4 col-form-label">Pengirim</label>
                            <div class="col-sm-12 col-md-8">
                                <select style="width: 100%;" name="pengirim" id="PENGIRIM-BATU" required
                                    class="custom-select2 form-control PENGIRIM-BATU">
                                    <option value="">Pilih Pengirim</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="GROUP-KODE-BATU">
                            <label class="col-sm-12 col-md-4 col-form-label">Kode Batu</label>
                            <div class="col-sm-12 col-md-8">
                                <select style="width: 100%;" name="kode_batu" id="KODE-BATU" required
                                    class="custom-select2 form-control KODE-BATU">
                                    <option value="">Pilih Kode Batu</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="GROUP-JENIS-BATU">
                            <label class="col-sm-12 col-md-4 col-form-label">Jenis Batu</label>
                            <div class="col-sm-12 col-md-8">
                                <select style="width: 100%;" name="jenis_batu" id="JENIS-BATU" required
                                    class="custom-select2 form-control JENIS-BATU">
                                    <option value="">Pilih jenis batu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <div class="form-group row" id="GROUP-KONDISI-BATU">
                            <label class="col-sm-12 col-md-4 col-form-label">Kondisi Batu</label>
                            <div class="col-sm-12 col-md-8">
                                <select style="width: 100%;" name="kondisi_batu" id="KONDISI-BATU" required
                                    class="custom-select2 form-control KONDISI-BATU-HAULING">
                                    <option value="">Pilih Kondisi Batu</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="GROUP-LOKASI-MUAT">
                            <label class="col-sm-12 col-md-4 col-form-label">Lokasi Muat</label>
                            <div class="col-sm-12 col-md-8">
                                <select style="width: 100%;" name="lokasi_muat" id="LOKASI-MUAT-HAULING" required
                                    class="custom-select2 form-control LOKASI-MUAT-HAULING">
                                    <option value="">Pilih lokasi muat</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="GROUP-LOKASI-DUMPING-HAULING">
                            <label class="col-sm-12 col-md-4 col-form-label">Lokasi Dumping</label>
                            <div class="col-sm-12 col-md-8">
                                <select style="width: 100%;" name="lokasi_dumping" id="LOKASI-DUMPING-HAULING" required
                                    class="custom-select2 form-control LOKASI-DUMPING-HAULING">
                                    <option value="">Pilih lokasi dumping</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="GROUP-LOKASI-STOCKFILE">
                            <label class="col-sm-12 col-md-4 col-form-label">Lokasi Stockpile Jetty</label>
                            <div class="col-sm-12 col-md-8">
                                <select style="width: 100%;" name="lokasi_stockfile" id="LOKASI-STOCKFILE"
                                    class="custom-select2 form-control LOKASI-STOCKFILE">
                                    <option value="">Pilih Kode Batu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-info">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group row" id="GROUP-TANGGAL-BERANGKAT">
                            <label class="col-sm-12 col-md-5 col-form-label">Tanggal Berangkat</label>
                            <div class="col-sm-12 col-md-7">
                                <input class="form-control date-picker" id="TANGGAL-BERANGKAT" name="tanggal_berangkat"
                                    type="text" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row" id="GROUP-JAM-BERANGKAT">
                            <label class="col-sm-12 col-md-5 col-form-label">Jam Berangkat</label>
                            <div class="col-sm-12 col-md-7">
                                <input class="form-control" id="JAM-BERANGKAT" name="jam_berangkat" type="time"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="form-group row" id="GROUP-TANGGAL-TIBA">
                            <label class="col-sm-12 col-md-5 col-form-label">Tanggal Tiba</label>
                            <div class="col-sm-12 col-md-7">
                                <input class="form-control" id="TANGGAL-TIBA" name="tanggal_tiba" type="text"
                                    required placeholder="">
                            </div>
                        </div>
                        <div class="form-group row" id="GROUP-JAM-TIBA">
                            <label class="col-sm-12 col-md-5 col-form-label">Jam Tiba</label>
                            <div class="col-sm-12 col-md-7">
                                <input class="form-control" type="time" placeholder="" id="JAM-TIBA" required
                                    name="jam_tiba">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group row" id="GROUP-BRUTTO">
                            <label class="col-sm-12 col-md-4 col-form-label">Brutto</label>
                            <div class="col-sm-12 col-md-8">
                                <input class="form-control" onkeyup="setNetto()" onchange="setNetto()" id="BRUTTO"
                                    required name="brutto" type="text" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row" id="GROUP-TARRA">
                            <label class="col-sm-12 col-md-4 col-form-label">Tarra</label>
                            <div class="col-sm-12 col-md-8">
                                <input class="form-control" onchange="setNetto()" id="TARRA" name="tarra" required
                                    type="text" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row" id="GROUP-NETTO">
                            <label class="col-sm-12 col-md-4 col-form-label">Netto</label>
                            <div class="col-sm-12 col-md-8">
                                <input class="form-control" id="NETTO" name="netto" type="text" required
                                    placeholder="">
                            </div>
                        </div>


                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group text-center" id="GROUP-CODE-DATA-DRIVER">
                            <label class="">Driver</label>
                            <select style="width: 100%;" name="code_data_driver" id="CODE-DATA-DRIVER" required
                                class="custom-select2 form-control employees">
                                <option value="">Pilih Driver</option>
                            </select>
                        </div>
                        <div class="form-group text-center" id="GROUP-UNIT">
                            <label class="">UNIT</label>
                            <select style="width: 100%;" onchange="chooseUnit()" name="code_data_unit" id="UNIT"
                                required class="custom-select2 form-control units">
                                <option value="">Pilih Unit</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-12">
                                <button type="button" id="btn-store-hauling"
                                    class="btn btn-primary btn-block">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class=" card-box mb-30">
        <div class="pd-20 clearfix mb-10">
            <div class="pull-left">
                <h4 class="text-blue h4">DATABASE Table</h4>
            </div>
            <div class="pull-right" hidden>
                <a href="#basic-form1" id="FILTER-basic-form1" class="btn btn-primary btn-sm scroll-click"
                    rel="content-y" data-toggle="collapse" role="button">Reset</a>
            </div>
        </div>
        <form action="" id="FORM-FILTER">
            <div class="row">
                <div class="col-12  mt-10">
                    <h1 class="pd-20">Filter</h1>
                    <div class="row pd-20">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group row">
                                <small class="col-12 form-text text-muted">
                                    Tanggal (mm/dd/yyyy - mm/dd/yyyy)
                                </small>
                                <div class="col-sm-12 col-md-12">
                                    <input class="form-control datetimepicker-range" id="FILTER-RANGE"
                                        name="filter_range" type="text" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <small class="col-12 form-text text-muted">
                                    Shift
                                </small>
                                <div class="col-sm-12 col-md-12">
                                    <select id="status-absen-filter"
                                        class="selectpicker form-control multiple-select-status-absen" name="shifts"
                                        id="FILTER-SHITFS" data-style="btn-outline-primary" multiple
                                        data-actions-box="true" data-selected-text-format="count">
                                        <option value="Shift 1" selected>Shift 1</option>
                                        <option value="Shift 2" selected>Shift 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <small class="col-md-12 form-text text-muted">
                                    Karyawan
                                </small>
                                <div class="col-md-12">
                                    <button type="button" onclick="filterDatatable('code_data_driver')"
                                        class=" form-control btn code_data_driver btn-secondary filter">
                                        <div class="row">
                                            <div class="col-6 text-left text-white">
                                                Filter driver
                                            </div>
                                            <div class="col-6 text-right">
                                                <i class="icon-copy bi bi-funnel"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <small class="col-12 form-text text-muted">
                                    Unit
                                </small>
                                <div class="col-md-12">
                                    <button type="button" onclick="filterDatatable('code_data_unit')"
                                        class="code_data_unit form-control btn btn-secondary filter">
                                        <div class="row">
                                            <div class="col-6 text-left text-white">
                                                Filter UNIT
                                            </div>
                                            <div class="col-6 text-right">
                                                <i class="icon-copy bi bi-funnel"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group row">
                                <small class="col-12 form-text text-muted">
                                    Perusahaan Pengangkut
                                </small>
                                <div class="col-md-12">
                                    <button type="button" onclick="filterDatatable('company_uuid')"
                                        class=" form-control btn company_uuid btn-secondary filter">
                                        <div class="row">
                                            <div class="col-8 text-left text-white">
                                                Perusahaan pengangkut
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="icon-copy bi bi-funnel"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <small class="col-12 form-text text-muted">
                                    Pemilik Batu
                                </small>
                                <div class="col-md-12">
                                    <button type="button" onclick="filterDatatable('pemilik_batu')"
                                        class=" form-control pemilik_batu btn btn-secondary filter">
                                        <div class="row">
                                            <div class="col-6 text-left text-white">
                                                Filter Pemilik Batu
                                            </div>
                                            <div class="col-6 text-right">
                                                <i class="icon-copy bi bi-funnel"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <small class="col-12 form-text text-muted">
                                    Kode Batu
                                </small>
                                <div class="col-md-12">
                                    <button type="button" onclick="filterDatatable('kode_batu')"
                                        class=" form-control btn btn-secondary filter">
                                        <div class="row">
                                            <div class="col-6 text-left text-white">
                                                Filter Kode Batu
                                            </div>
                                            <div class="col-6 text-right">
                                                <i class="icon-copy bi bi-funnel"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <small class="col-12 form-text text-muted">
                                    Jenis Batu
                                </small>
                                <div class="col-md-12">
                                    <button type="button" onclick="filterDatatable('jenis_batu')"
                                        class=" form-control jenis_batu btn btn-secondary filter">
                                        <div class="row">
                                            <div class="col-6 text-left text-white">
                                                Filter Jenis Batu
                                            </div>
                                            <div class="col-6 text-right">
                                                <i class="icon-copy bi bi-funnel"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group row">
                                <small class="col-12 form-text text-muted">
                                    Kondisi Batu
                                </small>
                                <div class="col-md-12">
                                    <button type="button" onclick="filterDatatable('kondisi_batu')"
                                        class=" form-control btn btn-secondary kondisi_batu filter">
                                        <div class="row">
                                            <div class="col-6 text-left text-white">
                                                Filter Kondisi Batu
                                            </div>
                                            <div class="col-6 text-right">
                                                <i class="icon-copy bi bi-funnel"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <small class="col-12 form-text text-muted">
                                    Lokasi Muat
                                </small>
                                <div class="col-md-12">
                                    <button type="button" onclick="filterDatatable('lokasi_muat')"
                                        class=" form-control btn btn-secondary filter lokasi_muat">
                                        <div class="row">
                                            <div class="col-6 text-left text-white">
                                                Filter Lokasi Muat
                                            </div>
                                            <div class="col-6 text-right">
                                                <i class="icon-copy bi bi-funnel"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <small class="col-12 form-text text-muted">
                                    Lokasi Dumping
                                </small>
                                <div class="col-md-12">
                                    <button type="button" onclick="filterDatatable('lokasi_dumping')"
                                        class=" form-control btn btn-secondary filter lokasi_dumping">
                                        <div class="row">
                                            <div class="col-6 text-left text-white">
                                                Filter Lokasi Dumping
                                            </div>
                                            <div class="col-6 text-right">
                                                <i class="icon-copy bi bi-funnel"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <small class="col-12 form-text text-muted">
                                    Lokasi Stockpile Jetty
                                </small>
                                <div class="col-md-12">
                                    <button type="button" onclick="filterDatatable('lokasi_stockfile')"
                                        class=" form-control btn btn-secondary filter lokasi_stockfile">
                                        <div class="row">
                                            <div class="col-6 text-left text-white ">
                                                Filter Lokasi Stockpile
                                            </div>
                                            <div class="col-6 text-right">
                                                <i class="icon-copy bi bi-funnel"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <div class="button-group text-right ">
                                <button type="button" id="btn-export" class="btn btn-warning mb-10">
                                    Export
                                </button>
                                <button type="button" id="btn-reset-filter" class="btn btn-secondary mb-10">
                                    Reset
                                </button>
                                <button type="button" onclick="storeFilterHauling()" class="btn btn-primary mb-10">
                                    Simpan Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
        <div class="" id="datatable">
            <table class="data-table table stripe hover nowrap" id="table-datatable">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Name</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-plus">
                            <div class="name-avatar d-flex align-items-center pr-2 card-box pl-2">
                                <div class="avatar mr-2 flex-shrink-0">
                                    <img src="/vendors/images/photo5.jpg" class="border-radius-100 box-shadow"
                                        width="50" height="50" alt="">
                                </div>
                                <div class="txt">
                                    <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                        style="color: rgb(224, 37, 37); background-color: rgb(231, 235, 245);">PT. MBLE |
                                        HAULING</span>
                                    <div class="font-14 weight-600">Dr. Callie Reed</div>
                                    <div class="font-12 weight-500">MBLE-0422003</div>
                                    <div class="font-12 weight-500" data-color="#b2b1b6"
                                        style="color: rgb(178, 177, 182);">
                                        Service Maintenance
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <a onclick="editUser('MBLE-0422003')" class="btn btn-primary" href="#"><i
                                    class="dw dw-edit2"></i> Edit</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    {{-- <div class="card-box pd-20">
        <div class="pd-20 clearfix mb-10">
            <div class="pull-left">
                <h4 class="text-blue h4">STRUKTUR ORGANISASI</h4>
            </div>
            <div class="pull-right" hidden>
                <a href="#basic-form1" id="FILTER-basic-form1" class="btn btn-primary btn-sm scroll-click"
                    rel="content-y" data-toggle="collapse" role="button">Reset</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12  mt-10">
                <h1 class="pd-20">Filter</h1>
                <div class="row pd-20">
                    <div class="col-md-12 col-sm-12">
                        <div id="chart-container" style="text-align: left;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-box pd-20">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="sitemap">
                    <h5 class="h5">Multi Level Sitemap</h5>
                    <ul>
                        <li><a href="#">Level 1</a></li>
                        <li><a href="#">Level 1</a></li>
                        <li class="child">
                            <h5 class="h5">KTT</h5>
                            <ul>
                                <li><a href="#">Rahmad Saleh</a></li>
                                <li class="child">
                                    <h5 class="h5">PJO</h5>
                                    <ul>
                                        <li><a href="#">Denny PA Tanjung</a></li>
                                        <li class="child">
                                            <h5 class="h5">HSE Dept.</h5>
                                            <ul>
                                                <li><a href="#">Purwanto</a></li>
                                                <li class="child">
                                                    <h5 class="h5">Staf</h5>
                                                    <ul>
                                                        <li class="child">
                                                            <h5 class="h5">Admin</h5>
                                                            <ul>
                                                                <li><a href="#">Nadia Maulida</a></li>
                                                                <li><a href="#">Achmad Maulana</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="child">
                                                            <h5 class="h5">Pengawas Safety</h5>
                                                            <ul>
                                                                <li><a href="#">Marsianus Julian</a></li>
                                                                <li class="child">
                                                                    <h5 class="h5">Safety Man</h5>
                                                                    <ul>
                                                                        <li><a href="#">Prabowo</a></li>
                                                                        <li><a href="#">Yoga</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="child">
                                                            <h5 class="h5">Pengawas Enviro</h5>
                                                            <ul>
                                                                <li><a href="#">Rizain</a></li>
                                                                <li class="child">
                                                                    <h5 class="h5">Enviro Creq</h5>
                                                                    <ul>
                                                                        <li><a href="#">Bagas</a></li>
                                                                        <li><a href="#">Farhan</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="child">
                            <h5 class="h5">Level 2</h5>
                            <ul>
                                <li><a href="#">Level 2</a></li>
                                <li><a href="#">Level 2</a></li>
                                <li class="child">
                                    <h5 class="h5">Level 3</h5>
                                    <ul>
                                        <li><a href="#">Level 3</a></li>
                                        <li><a href="#">Level 3</a></li>
                                        <li class="child">
                                            <h5 class="h5">Level 3</h5>
                                            <ul>
                                                <li><a href="#">Level 3</a></li>
                                                <li><a href="#">Level 3</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="sitemap">
                    <h5 class="h5">Multi Level Sitemap</h5>
                    <ul>
                        <li><a href="#">Level 1</a></li>
                        <li><a href="#">Level 1</a></li>
                        <li class="child">
                            <h5 class="h5">KTT</h5>
                            <ul>
                                <li><a href="#">Rahmad Saleh</a></li>
                                <li class="child">
                                    <h5 class="h5">PJO</h5>
                                    <ul>
                                        <li><a href="#">Denny PA Tanjung</a></li>
                                        <li class="child">
                                            <h5 class="h5">HSE Dept.</h5>
                                            <ul>
                                                <li><a href="#">Purwanto</a></li>
                                                <li class="child">
                                                    <h5 class="h5">Staf</h5>
                                                    <ul>
                                                        <li class="child">
                                                            <h5 class="h5">Admin</h5>
                                                            <ul>
                                                                <li><a href="#">Nadia Maulida</a></li>
                                                                <li><a href="#">Achmad Maulana</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="child">
                                                            <h5 class="h5">Pengawas Safety</h5>
                                                            <ul>
                                                                <li><a href="#">Marsianus Julian</a></li>
                                                                <li class="child">
                                                                    <h5 class="h5">Safety Man</h5>
                                                                    <ul>
                                                                        <li><a href="#">Prabowo</a></li>
                                                                        <li><a href="#">Yoga</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="child">
                                                            <h5 class="h5">Pengawas Enviro</h5>
                                                            <ul>
                                                                <li><a href="#">Rizain</a></li>
                                                                <li class="child">
                                                                    <div class="card-box row">
                                                                        <div class="col-12">
                                                                            <h5>KTT</h5>
                                                                            <p>Rahmad Saleh</p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="child">
                            <h5 class="h5">Level 2</h5>
                            <ul>
                                <li><a href="#">Level 2</a></li>
                                <li><a href="#">Level 2</a></li>
                                <li class="child">
                                    <h5 class="h5">Level 3</h5>
                                    <ul>
                                        <li><a href="#">Level 3</a></li>
                                        <li><a href="#">Level 3</a></li>
                                        <li class="child">
                                            <h5 class="h5">Level 3</h5>
                                            <ul>
                                                <li><a href="#">Level 3</a></li>
                                                <li><a href="#">Level 3</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade customscroll" id="modal-filter" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header mb-10">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Filter Driver
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="bottom" title="" data-original-title="Close Modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-0 mt-20">
                    <div class="task-list-form">
                        <input type="hidden" name="filter-name" id="filter-name">
                        <div class="" id="datatable-filter">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-save-filter" class="btn btn-primary">
                        Filter
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection()

@section('script_javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.3/js/jquery.orgchart.min.js"></script>
    <script src="/src/plugins/switchery/switchery.min.js"></script>
    <!-- bootstrap-tagsinput js -->
    <script src="/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <!-- bootstrap-touchspin js -->
    <script src="/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
    <script src="/vendors/scripts/advanced-components.js"></script>


    <script>
        let var_menu = "menu";
        let data_hauling;

        let data_filter = {
            data: {},
            list: []
        };

        let data_to_filter_old;


        let row_data_datatable = [];
        let header_table_element = '';

        let database_data_hauling;

        // FILTER

        let rowDataFilterTable = [];
        let data_to_filter = {};


        let header_table_field = ['Driver', 'Unit', 'Muat', 'Dumping', "Aksi"];

        function reCreateTable() {
            row_data_datatable = [];
            header_table_element = ``;

            $('#datatable').empty();

            // create header table                    
            header_table_field.forEach(element => {
                header_table_element = `${header_table_element} <th> ${element} </th>`
            });

            header_table_element = `                    
                    <table id="table-datatable1" class="checkbox-datatable nowrap stripe hover table" style="width:100%">
                        <thead>
                            <tr>
                                ${header_table_element}
                            </tr>
                        </thead>
                    </table>
                `;

            $('#datatable').append(header_table_element);

            //add row data datatable



            var employees_card_element = {
                mRender: function(data, type, row) {
                    return cardEmployees(data_hauling[row]['code_data_driver'])
                }
            };
            row_data_datatable.push(employees_card_element);


            var employees_card_element = {
                mRender: function(data, type, row) {
                    return cardUnit(data_hauling[row]['code_data_unit'])
                }
            };
            row_data_datatable.push(employees_card_element);


            var employees_card_element = {
                mRender: function(data, type, row) {
                    return cardCoalMuat(row)
                }
            };
            row_data_datatable.push(employees_card_element);

            var employees_card_element = {
                mRender: function(data, type, row) {
                    return cardCoal(row)
                }
            };
            row_data_datatable.push(employees_card_element);

            var employees_card_element = {
                mRender: function(data, type, row) {
                    return cardAction(row)
                }
            };
            row_data_datatable.push(employees_card_element);

        }

        function selectAllFilter() {
            var isChecked = $('#select-all-filter').prop('checked');
            $('.datatable-filter').prop('checked', isChecked);

        }

        function reCreateFilterTable(part_filter) {
            rowDataFilterTable = [];
            let headerTableFilter = `<th>
                                        <div class="dt-checkbox no-sort">
                                            <input onchange="selectAllFilter()"
                                                type="checkbox"
                                                name="select_all-filter"
                                                value="0"
                                                id="select-all-filter"
                                            />
                                            <span class="dt-checkbox-label"></span>
                                        </div>
                                    </th>
                                    <th> Nilai</th>
                                    `;
            headerTableFilter = `                    
                    <table id="table-datatable-filter" class="checkbox-datatable nowrap stripe hover table" style="width:100%">
                        <thead>
                            <tr>
                                ${headerTableFilter}
                            </tr>
                        </thead>
                    </table>
                `;
            $('#datatable-filter').empty();
            $('#filter-name').val(part_filter);

            $('#datatable-filter').append(headerTableFilter);


            var checkbox_card_element = {
                mRender: function(data, type, row) {

                    let isChecked = "";
                    if (data_filter['data'][part_filter]) {
                        isChecked = ((data_filter['data'][part_filter]).filter(item => item === row).length > 0) ?
                            "checked" : "";
                    }
                    return `<input value="${row}" type="checkbox" ${isChecked} class="datatable-filter editor-active dt-checkbox no-sort">`
                }
            };

            rowDataFilterTable.push(checkbox_card_element);


            var employees_card_element = {
                mRender: function(data, type, row) {
                    switch (part_filter) {
                        case 'code_data_driver':
                            return cardEmployees(row);
                            break;
                        case 'code_data_unit':
                            return row;
                            break;
                        default:
                            return row;
                            break;
                    }
                }
            };
            rowDataFilterTable.push(employees_card_element);

            $('#table-datatable-filter').DataTable({
                paging: false,
                // scrollY: true,
                scrollX: true,
                scrollY: "400px",

                responsive: true,
                serverSide: false,
                data: data_to_filter[part_filter],
                columns: rowDataFilterTable
            });



        }

        function filterDatatable(part_filter) {
            reCreateFilterTable(part_filter);
            $('#modal-filter').modal('show');
            // $('#select-all-filter').prop('checked', true);
            // selectAllFilter()
        }

        function selectAll() {

            var table = $('#table-datatable1').DataTable();
            var isChecked = $('#select-all').prop('checked');


            var isChecked = $(this).prop('checked');
            // Check or uncheck all checkboxes in the first column
            table.rows().every(function() {
                var rowData = this.data();
                rowData[0] = isChecked;
                this.data(rowData);
            });
        }

        function exportHauling() {
            let site_uuid_dialy = $("input[type='radio'][name='site_uuid_dialy']:checked").val();
            let date_dialy = $('#date_dialy').val();

            $.ajax({
                url: '/web/pendapatan/hauling/export',
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    conLog('responses', response);
                    var dlink = document.createElement("a");
                    dlink.href = `/${response.data}`;
                    dlink.setAttribute("download", "");
                    dlink.click();
                },
                error: function(response) {
                    CL(response);
                }
            });
        }


        $(document).ready(function() {
            // On click event
            $('.datepicker--cell-day').on('click', function() {
                var dataDateValueAttr = $('datepicker--cell datepicker--cell-day -selected-').attr(
                    'data-date');
                console.log('Using attr():', dataDateValueAttr);
            });

            $("#btn-reset").click(function(event) {
                $('#ID-HAULING').prop('disabled', true);
                $('#ID-HAULING').val("").trigger('change');
                $('#UNIT').val("").trigger('change');
                $('#CODE-DATA-DRIVER').val("").trigger('change');
                $('#PO').val("").trigger('change');
                $('#DO').val("").trigger('change');
                $('#BRUTTO').val("").trigger('change');
                $('#NETTO').val("").trigger('change');
                $('#TARRA').val("").trigger('change');
                $('#SURAT-JALAN').val("").trigger('change');
            });



            $("#btn-export").click(function(event) {
                exportHauling();
            });

            $("#btn-store-hauling").click(function(event) {
                // Prevent the form from submitting
                event.preventDefault();

                var emptyFieldIds = [];

                // Check each required field for emptiness
                $(":input[required]").each(function() {
                    if ($(this).val().trim() === "") {
                        // Add the ID to the array if the field is empty
                        emptyFieldIds.push(this.id);
                        $(`#GROUP-${this.id}`).addClass(` has-danger`);
                    }
                });

                // Display an alert with empty field IDs if there are empty fields
                if (emptyFieldIds.length == 0) {
                    storeHauling();
                }
            });

            $("#btn-save-filter").click(function(event) {
                let arr_checkbox_filter = [];
                let name_filter = $('#filter-name').val();
                var checkboxValues = $('.datatable-filter:checked').map(function() {
                    arr_checkbox_filter.push($(this).val());
                }).get();


                if (!(data_filter.list).includes(name_filter)) {
                    data_filter.list.push(name_filter);
                }
                data_filter['data'][name_filter] = arr_checkbox_filter;

                database_data_hauling = [];
                Object.values(data_hauling).forEach(hauling => {

                    let data_filtering = true;
                    (data_filter.list).forEach(item_filter => {
                        occurrences = (data_filter['data'][item_filter]).filter(item =>
                            item === hauling[item_filter]);
                        if (data_filtering) {
                            if (occurrences.length == 0) {
                                data_filtering = false;
                                return;
                            }
                        }
                    });
                    if (data_filtering) {
                        database_data_hauling.push(hauling['id_hauling']);
                    }
                });
                dataFilter(database_data_hauling);
                reCreateTable();
                createDataTable(database_data_hauling);
                $('#modal-filter').modal('hide');
            });

            //set range filter
            let date_time_now = new Date();
            let currentHour = date_time_now.getHours();
            let date_data = date_time_now;

            if (currentHour < 6) {
                date_data = addDays(new Date(), -1);
            }
            $('#FILTER-RANGE').val(setRangeDate(formatDate(date_data), formatDate(addDays(date_data, 1)))).trigger(
                'change');
            storeFilterHauling();




        });
    </script>

    <script></script>

    {{-- set option values --}}
    <script>
        Object.values(db['employees']).forEach(element => {
            $(`.employees`).append(`
                    <option value="${element.nik_employee}">${element.name} | ${element.position} | ${element.nik_employee}</option>
                `);
        });

        // UNIT units
        Object.values(db['db']['database_data']['UNIT']).forEach(element => {
            $(`.units`).append(`
                    <option value="${element['NOMOR-LAMBUNG']['code_data']}">${element['NOMOR-LAMBUNG']['value_data']}</option>
                `);
        });

        // PERUSAHAAN
        Object.values(db['db']['database_data']['PERUSAHAAN']).forEach(element => {
            $(`.PERUSAHAAN`).append(`
                    <option value="${element['NAMA-PERUSAHAAN-PENDEK']['code_data']}">${element['NAMA-PERUSAHAAN-PENDEK']['value_data']}</option>
                `);
        });

        // PERUSAHAAN
        Object.values(db['db']['database_data']['PENGIRIM-BATU']).forEach(element => {
            $(`.PENGIRIM-BATU`).append(`
                    <option value="${element['PENGIRIM-BATU']['code_data']}">${element['PENGIRIM-BATU']['value_data']}</option>
                `);
        });

        Object.values(db['db']['database_data']['KODE-BATU']).forEach(element => {
            $(`.KODE-BATU`).append(`
                    <option value="${element['KODE-BATU']['code_data']}">${element['KODE-BATU']['value_data']}</option>
                `);
        });

        Object.values(db['db']['database_data']['JENIS-BATU']).forEach(element => {
            $(`.JENIS-BATU`).append(`
                    <option value="${element['JENIS-BATU']['code_data']}">${element['JENIS-BATU']['value_data']}</option>
                `);
        });

        Object.values(db['db']['database_data']['KONDISI-BATU-HAULING']).forEach(element => {
            $(`.KONDISI-BATU-HAULING`).append(`
                    <option value="${element['KONDISI-BATU']['code_data']}">${element['KONDISI-BATU']['value_data']}</option>
                `);
        });

        Object.values(db['db']['database_data']['LOKASI-MUAT-HAULING']).forEach(element => {
            $(`.LOKASI-MUAT-HAULING`).append(`
                    <option value="${element['LOKASI-MUAT-HAULING']['code_data']}">${element['LOKASI-MUAT-HAULING']['value_data']}</option>
                `);
        });

        Object.values(db['db']['database_data']['LOKASI-DUMPING-HAULING']).forEach(element => {
            $(`.LOKASI-DUMPING-HAULING`).append(`
                    <option value="${element['LOKASI-DUMPING-HAULING']['code_data']}">${element['LOKASI-DUMPING-HAULING']['value_data']}</option>
                `);
        });

        Object.values(db['db']['database_data']['LOKASI-STOCKFILE']).forEach(element => {
            $(`.LOKASI-STOCKFILE`).append(`
                    <option value="${element['LOKASI-STOCKFILE']['code_data']}">${element['LOKASI-STOCKFILE']['value_data']}</option>
                `);
        });
    </script>

    <script>
        function storeFilterHauling() {
            reCreateTable()
            var formDataArray = $("#FORM-FILTER").serializeArray();
            // S T O R E
            $.ajax({
                url: '/web/pendapatan/hauling/get',
                type: "POST",
                headers: {
                    'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login
                    // Add other custom headers if needed
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    data: formDataArray,
                    id_hauling: null
                },
                success: function(response) {
                    CL('ajax response');
                    CL(response);

                    data_filter = {
                        data: {},
                        list: []
                    };

                    data_hauling = response.data.data;
                    database_data_hauling = response.data.list;
                    dataFilter(database_data_hauling);



                    createDataTable(database_data_hauling);
                },
                error: function(response) {
                    conLog('error', response)
                }
            });

            $('#ID-HAULING').prop('disabled', true);
        }

        function dataFilter(database_data_hauling_filter) {
            // data_to_filter = {};
            let data_field_hauling = {
                'pemilik_batu': 'pemilik_batu',
                'pengirim': 'pengirim',
                'kode_batu': 'kode_batu',
                'jenis_batu': 'jenis_batu',
                'kondisi_batu': 'kondisi_batu',
                'lokasi_muat': 'lokasi_muat',
                'lokasi_dumping': 'lokasi_dumping',
                'lokasi_stockfile': 'lokasi_stockfile',
                'code_data_driver': 'code_data_driver',
                'code_data_unit': 'code_data_unit',
                'company_uuid': 'company_uuid',
            };

            data_to_filter_old = Object.assign({}, data_to_filter);


            Object.values(data_field_hauling).forEach(field => {
                data_to_filter[field] = [];
            });

            database_data_hauling_filter.forEach(id_hauling => {

                id_hauling.company_uuid = db['employees'][data_hauling[id_hauling]['code_data_driver']][
                    'company_uuid'
                ];

                data_hauling[id_hauling]['company_uuid'] = db['employees'][data_hauling[id_hauling][
                    'code_data_driver'
                ]]['company_uuid'];
                Object.values(data_field_hauling).forEach(field => {
                    let single_arr_data = (data_to_filter[field]).filter(item =>
                        item === data_hauling[id_hauling][field]);
                    if (single_arr_data.length == 0) {
                        data_to_filter[field].push(data_hauling[id_hauling][field]);
                    }
                });
            });


            let filter_name = $('#filter-name').val();

            let change_filter = true;

            if (Object.values(data_filter.list).length > 0) {
                (data_filter.list).forEach(field_filter => {
                    if (change_filter == true) {
                        data_to_filter[field_filter] = data_to_filter_old[field_filter];
                    }
                    if (filter_name == field_filter) {
                        change_filter = false;
                    }
                });
            } else {
                data_to_filter_old = Object.assign({}, data_to_filter);
            }
            (data_filter.list).forEach(field_filter => {
                $('.' + field_filter).removeClass('btn-secondary');
                $('.' + field_filter).addClass('btn-primary');
            });

            conLog('data_filter', data_filter);
        }

        function createDataTable(data_for_datatable) {
            $('#table-datatable1').DataTable({
                paging: true,
                responsive: true,
                serverSide: false,
                data: data_for_datatable,
                columns: row_data_datatable
            });
        }

        function shiftChange() {

        }

        function storeHauling() {
            CL('storeHauling');

            $('.has-danger').removeClass('has-danger');
            // return false;
            $('#ID-HAULING').prop('disabled', false);
            var formDataArray = $("#form-hauling").serializeArray();
            // S T O R E
            $.ajax({
                url: '/api/mbg/pendapatan/hauling/store',
                type: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login
                    // Add other custom headers if needed
                },
                data: JSON.stringify({
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    data: formDataArray
                }),
                success: function(response) {
                    CL(response)
                    showModalSuccess();
                    refreshSession();
                    storeFilterHauling();
                    $('#UNIT').val("").trigger('change');
                    $('#CODE-DATA-DRIVER').val("").trigger('change');
                },
                error: function(response) {
                    conLog('error', response)
                    //alertModal()
                }
            });
            $('#ID-HAULING').prop('disabled', true);
            CL(formDataArray);
        }

        function chooseUnit() {
            let idUnit = $(`#UNIT`).val();
            if (idUnit) {
                $('#TARRA').val(db['db']['database_data']['TARA-UNIT'][idUnit]['NILAI-TARA']['value_data']);
                setNetto();
            }

        }

        function setNetto() {
            let brutto = $('#BRUTTO').val();
            let tarra = $('#TARRA').val();

            if (brutto && tarra) {
                $('#NETTO').val(brutto - tarra);
            }
        }

        function muatanTiba() {
            let dateNow = new Date();
            var currentDay = dateNow.getDate();
            var midnight = new Date(dateNow);
            midnight.setHours(0, 0, 0, 0);

            var targetTime = new Date(midnight);
            targetTime.setMinutes(midnight.getMinutes() + 30);

            CL(targetTime);

            var currentHours = dateNow.getHours();
            var currentMinutes = dateNow.getMinutes();

            // Format the time as HH:MM:SS
            var formattedTime = currentHours.toString().padStart(2, '0') +
                ':' +
                currentMinutes.toString().padStart(2, '0');


            let tanggal_tiba =


                `${currentDay.toString().padStart(2, '0')} ${months[dateNow.getMonth()+1]} ${dateNow.getFullYear()}`;
            $('#TANGGAL-TIBA').val(tanggal_tiba);
            $('#JAM-TIBA').val(formattedTime);
            $('#TANGGAL-BERANGKAT').val(tanggal_tiba);
            $('#ID-HAULING').val('');



            if (dateNow < targetTime) {
                let before_currentDay = dateNow.getDate();
                before_currentDay = before_currentDay - 1;
                tanggal_tiba =
                    `${before_currentDay.toString().padStart(2, '0')} ${months[dateNow.getMonth()+1]} ${dateNow.getFullYear()}`;
                $('#TANGGAL-BERANGKAT').val(tanggal_tiba);
            }
        }

        function showConfirmDelete(id_hauling) {
            $('#code_data_delete').val(id_hauling);
            $(`#delete-confirmation-modal`).modal('show');
        }

        $("#btn-delete-confirmed").click(function() {
            let id_delete = $('#code_data_delete').val();
            CL('id_delete');

            $.ajax({
                url: '/api/mbg/pendapatan/hauling/delete',
                type: "POST",
                headers: {
                    'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login
                    // Add other custom headers if needed
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    data: id_delete
                },
                success: function(response) {
                    CL(response)
                    var isStored = refreshSession().then((data_value_element) => {
                        storeFilterHauling();
                        showModalSuccess();
                    });

                },
                error: function(response) {
                    conLog('error', response)
                    //alertModal()
                }
            });
        })

        function showDataEdit(id_hauling) {
            // startLoading();
            $.ajax({
                url: '/api/mbg/pendapatan/hauling/get',
                type: "POST",
                headers: {
                    'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login
                    // Add other custom headers if needed
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    data: null,
                    id_hauling: parseInt(id_hauling)
                },
                success: function(response) {
                    $.each(response.data, function(key, value) {
                        $(`input[name="${key}"]`).val(value).trigger('change');
                        $(`select[name="${key}"]`).val(value).trigger('change');
                    });

                    $(`input[name="tanggal_berangkat"]`).val(dateToString(response.data
                        .tanggal_waktu_berangkat)).trigger('change');
                    $(`input[name="tanggal_tiba"]`).val(dateToString(response.data.tanggal_waktu_tiba)).trigger(
                        'change');
                    $(`input[name="jam_berangkat"]`).val(dateToTime(response.data.tanggal_waktu_berangkat))
                        .trigger('change');
                    $(`input[name="jam_tiba"]`).val(dateToTime(response.data.tanggal_waktu_tiba)).trigger(
                        'change');
                },
                error: function(response) {
                    conLog('error', response)
                }
            });

        }
    </script>


    <script>
        

        function cardCoalMuat(id_hauling) {
            let isPO = data_hauling[id_hauling]['po'] ? `` : 'hidden';
            let po_number = data_hauling[id_hauling]['po'] ? data_hauling[id_hauling]['po'] : null;

            let isDO = data_hauling[id_hauling]['do'] ? `` : 'hidden';
            let do_number = data_hauling[id_hauling]['do'] ? data_hauling[id_hauling]['do'] : null;

            let isSJ = data_hauling[id_hauling]['surat_jalan'] ? `` : 'hidden';
            let surat_jalan_number = data_hauling[id_hauling]['surat_jalan'] ? data_hauling[id_hauling]['surat_jalan'] :
                null;

            var dateObject = new Date(data_hauling[id_hauling]['tanggal_waktu_berangkat']);
            var hours = dateObject.getHours();
            var minutes = dateObject.getMinutes();

            // Format the time as HH:MM
            var formattedTime = padZero(hours) + ":" + padZero(minutes);


            return `
                <div class="name-avatar d-flex align-items-center pr-2 card-box pl-2">
                    <div class="txt">
                        <span ${isSJ} class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                            style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">SJ : ${surat_jalan_number} </span>
                        <span ${isPO} class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                            style="color: rgb(38, 94, 215); background-color: rgb(231, 225, 245);">PO : ${po_number}</span>
                        <span ${isDO} class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                            style="color: rgb(38, 94, 215); background-color: rgb(231, 225, 245);">DO : ${do_number}</span>
                        <div class="font-14 weight-600">${data_hauling[id_hauling]['lokasi_muat']}</div>                        
                        <div class="font-12 weight-500">${data_hauling[id_hauling]['jenis_batu']}</div>
                        <div class="font-12 weight-500" data-color="#b2b1b6" style="color: rgb(178, 177, 182);">
                            ${formattedTime}
                        </div>
                    </div>
                </div>
            `;
        }

        function cardCoal(id_hauling) {
            var dateObject = new Date(data_hauling[id_hauling]['tanggal_waktu_tiba']);
            var hours = dateObject.getHours();
            var minutes = dateObject.getMinutes();

            // Format the time as HH:MM
            var formattedTime = padZero(hours) + ":" + padZero(minutes);

            return `
                <div class="name-avatar d-flex align-items-center pr-2 card-box pl-2">
                    <div class="txt">
                        <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                            style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">${data_hauling[id_hauling]['pemilik_batu']} </span>
                        <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                            style="color: rgb(38, 94, 215); background-color: rgb(231, 225, 245);">${data_hauling[id_hauling]['kode_batu']}</span>
                        <div class="font-14 weight-600">${data_hauling[id_hauling]['netto']} MT</div>
                        <div class="font-12 weight-500">${data_hauling[id_hauling]['lokasi_dumping']}</div>
                        <div class="font-12 weight-500" data-color="#b2b1b6" style="color: rgb(178, 177, 182);">
                            ${formattedTime}
                        </div>
                    </div>
                </div>
            `;
        }

        function cardAction(id_hauling) {
            return `        
                    
                        <div class="col-md-12 text-right" hidden>
                            <i class="icon-copy bi bi-journal-medical"></i>
                        </div>
                        <div class="col-md-12 mt-2">
                            <button onclick="showDataEdit('${id_hauling}')" class="btn btn-sm btn-primary">
                            <i class="icon-copy bi bi-pencil-square"></i>
                            </button>
                        </div>
                        <div class="col-md-12 mt-1">
                            <button onclick="showConfirmDelete('${id_hauling}')" class="btn btn-sm btn-danger ">
                            <i class="icon-copy bi bi-trash3"></i>
                            </button>
                        </div>
            `;
        }

        function cardUnit(id_unit) {
            return `
            <div class="card-box">
                <div class="d-flex flex-wrap pd-10">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">${db['db']['database_data']['UNIT'][id_unit]['NOMOR-LAMBUNG']['value_data']}</div>
                        <div class="font-14 text-secondary weight-500">
                            ${db['db']['database_data']['UNIT'][id_unit]['PERUSAHAAN-PEMILIK-UNIT']['value_data']}
                        </div>
                        <div class="font-12 weight-500" data-color="#b2b1b6" style="color: rgb(178, 177, 182);">
                            ${db['db']['database_data']['TARA-UNIT'][id_unit]['NILAI-TARA']['value_data']} MT
                        </div>
                    </div>
                </div>
            </div>
            `;
        }
    </script>

    <script>
        (function($) {
            $(function() {
                var ds = {
                    'name': 'Lao Lao',
                    'title': 'general manager',
                    'children': [{
                            'name': 'Bo Miao',
                            'title': 'department manager'
                        },
                        {
                            'name': 'Su Miao',
                            'title': 'department manager',
                            'children': [{
                                    'name': 'Tie Hua',
                                    'title': 'senior engineer'
                                },
                                {
                                    'name': 'Hei Hei',
                                    'title': 'senior engineer',
                                    'children': [{
                                            'name': 'Pang Pang',
                                            'title': 'engineer'
                                        },
                                        {
                                            'name': 'Xiang Xiang',
                                            'title': 'UE engineer'
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            'name': 'Hong Miao',
                            'title': 'department manager'
                        },
                        {
                            'name': 'Chun Miao',
                            'title': 'department manager'
                        }
                    ]
                };

                var oc = $('#chart-container').orgchart({
                    'data': ds,
                    'nodeContent': 'title',
                    'direction': 'l2r',
                    'pan': true
                });

            });
        })(jQuery);
    </script>
@endsection()
