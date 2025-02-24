<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title id="title">Online - MBG</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />


    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="/vendors/styles/style.css" />

    <link rel="stylesheet" type="text/css" href="/src/plugins/switchery/switchery.min.css" />
    <!-- bootstrap-tagsinput css -->
    <link rel="stylesheet" type="text/css" href="/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" />
    <!-- bootstrap-touchspin css -->
    <link rel="stylesheet" type="text/css" href="/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css" />
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/css/responsive.bootstrap4.min.css" />

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
    <style>
        /* Ensure the select element takes full width of its container */
        .multi-wrap-select-wrapper {
            width: 100%;
        }

        .multi-wrap-select {
            width: 100%;
        }
    </style>


    @yield('src_css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script src="/vendors/scripts/core.js"></script>
    <script src="/vendors/scripts/Chart.js"></script>
    <script src="/vendors/scripts/script.min.js"></script>
    <script src="/vendors/scripts/process.js"></script>
    <script src="/vendors/scripts/layout-settings.js"></script>

    @yield('src_javascript')
    @include('app.layouts.addOn.mainScript')

    <script src="/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <script src="/vendors/scripts/datatable-setting.js"></script>

</head>

<body>



    {{-- HEADER --}}
    @include('app.layouts.partials.header')


    {{-- SIDEBAR LEFT --}}
    @include('app.layouts.partials.leftSideBar')
    <div class="mobile-menu-overlay"></div>

    <div class="main-container" id="main-content">
        <div hidden class="maincontent e-general-filter pd-ltr-20 xs-pd-20-10 mt-20">
            <div class="card-box pd-20">
                <div class="row">
                    <form class="col-md-6">
                        <div class="row mb-20">
                            <div class="col-auto">
                                <h5 class="mb-20 h5 text-blue">General Filter</h5>
                            </div>
                            <div class="col text-right">
                                <div class="spinner-grow text-primary refresh-data" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <button type="button" onclick="refreshSession()" class="btn btn-primary">Refresh
                                    Database</button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-3 col-form-label">Perusahaan</label>
                            <div class="col-sm-12 col-md-9">
                                <button type="button" onclick="filterDatatable('PERUSAHAAN')"
                                    class=" form-control pemilik_batu btn btn-secondary filter">
                                    <div class="row">
                                        <div class="col-6 text-left text-white">
                                            Filter Perusahaan
                                        </div>
                                        <div class="col-6 text-right">
                                            <i class="icon-copy bi bi-funnel"></i>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-3 col-form-label">Project</label>
                            <div class="col-sm-12 col-md-9">
                                <button type="button" onclick="filterDatatable('PROJECT')"
                                    class=" form-control PROJECT btn btn-secondary filter">
                                    <div class="row">
                                        <div class="col-6 text-left text-white">
                                            Filter Project
                                        </div>
                                        <div class="col-6 text-right">
                                            <i class="icon-copy bi bi-funnel"></i>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-3 col-form-label">Departemen</label>
                            <div class="col-sm-12 col-md-9">
                                <button type="button" onclick="filterDatatable('DEPARTEMEN')"
                                    class=" form-control DEPARTEMEN btn btn-secondary filter">
                                    <div class="row">
                                        <div class="col-6 text-left text-white">
                                            Filter Departemen
                                            <div class="div"></div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <i class="icon-copy bi bi-funnel"></i>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-3 col-form-label">Divisi</label>
                            <div class="col-sm-12 col-md-9">
                                <button type="button" onclick="filterDatatable('DIVISI')"
                                    class=" form-control DEPARTEMEN btn btn-secondary filter">
                                    <div class="row">
                                        <div class="col-6 text-left text-white">
                                            Filter Divisi
                                            <div class="div"></div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <i class="icon-copy bi bi-funnel"></i>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-3 col-form-label">Jabatan</label>
                            <div class="col-sm-12 col-md-9">
                                <button type="button" onclick="filterDatatable('JABATAN')"
                                    class=" form-control DEPARTEMEN btn btn-secondary filter">
                                    <div class="row">
                                        <div class="col-6 text-left text-white">
                                            Filter Jabatan
                                            <div class="div"></div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <i class="icon-copy bi bi-funnel"></i>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-3 col-form-label">Karyawan</label>
                            <div class="col-sm-12 col-md-9">
                                <button type="button" onclick="filterDatatable('KARYAWAN')"
                                    class=" form-control DEPARTEMEN btn btn-secondary filter">
                                    <div class="row">
                                        <div class="col-6 text-left text-white">
                                            Filter Karyawan
                                            <div class="div"></div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <i class="icon-copy bi bi-funnel"></i>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-3 col-form-label">Status Aktif</label>
                            <div class="col-sm-12 col-md-9">
                                <select class="selectpicker form-control" id="STATUS-KARYAWAN" data-size="5"
                                    data-style="btn-outline-secondary" multiple="" data-max-options="3"
                                    tabindex="-98">
                                    <optgroup label="Condiments">
                                        <option id="status-karyawan-AKTIVE" value="AKTIVE">Aktive</option>
                                        <option id="status-karyawan-PHK-BULAN-INI" value="PHK-BULAN-INI">PHK Bulan ini
                                        </option>
                                        <option id="status-karyawan-PHK" value="PHK">PHK</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-6 form-text">
                                Tanggal <br>(mm/dd/yyyy - mm/dd/yyyy)
                            </label>
                            <div class="col-sm-12 col-md-6">
                                <input class="form-control datetimepicker-range" id="FILTER-RANGE"
                                    name="filter_range" type="text" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row pd-20">
                            <button onclick="saveGeneralFilter()" type="button"
                                class="btn btn-primary b-block col-md-12" href="">
                                Simpan </button>

                        </div>
                    </form>
                </div>
            </div>


        </div>
        <div class="pd-ltr-20 xs-pd-20-10">

            <div class="loading-content text-center">
                <div class="d-flex justify-content-center align-items-center vh-100">
                    <div class="text-center">
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-secondary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-success" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-danger" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-warning" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-info" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-light" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-dark" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>

                </div>
                <div class="footer-wrap pd-20 mb-20 card-box">
                    MBG - Online Created By
                    <a href="https://github.com/ahmadiaon" target="_blank">ahma.id </a>
                    Perlu Bantuan hubungi <a href="https://wa.me/6281255897044"><i
                            class="icon-copy bi bi-telephone-fill"></i></a>
                </div>

            </div>
            <div hidden class="maincontent min-height-200px">
                @yield('content')
            </div>
            <div hidden class="maincontent footer-wrap pd-20 mb-20 card-box">
                MBG - Online Created By
                <a href="https://github.com/ahmadiaon" target="_blank">ahma.id </a>
                Perlu Bantuan hubungi <a href="https://wa.me/6281255897044"><i
                        class="icon-copy bi bi-telephone-fill"></i></a>
            </div>
        </div>
    </div>

    {{-- modal loading --}}
    <div class="modal fade" id="loading-modal" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <br>
                <br>
                <div class="modal-body text-center">
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-success" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-warning" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-info" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-light" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>
    </div>

    {{-- modal loading --}}
    <div class="modal fade" id="loading-modal-start" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <br>
                <br>
                <div class="modal-body text-center">
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-success" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-warning" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-info" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-light" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>
    </div>




    {{-- success modal --}}
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Data Tersimpan</h3>
                    <div class="mb-30 text-center">
                        <img src="{{ env('APP_URL') }}vendors/images/success.png" />
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" onclick="stopLoading()" data-dismiss="modal">
                        Done
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal confirm delete --}}
    <!-- Confirmation modal -->
    <div class="modal fade" id="delete-confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500">
                        Are you sure you want to continue?
                    </h4>
                    <input type="text" class="form-control" disabled name="code_data_delete"
                        id="code_data_delete">
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto">
                        <div class="col-6">
                            <button type="button"
                                class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal">
                                <i class="fa fa-times"></i>
                            </button>
                            NO
                        </div>
                        <div class="col-6">
                            <button id="btn-delete-confirmed" type="button"
                                class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal">
                                <i class="fa fa-check"></i>
                            </button>
                            YES
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- modal confirm delete datatable --}}
    <div id="confirm-modal-async" class="modal fade">
        <div class="modal-dialog  modal-sm modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="icon-copy ion-android-delete"></i>
                    </div>
                    <input type="hidden" name="code_data_delete" id="code_data_delete">
                    <h4 class="modal-title w-100">Hapus Data?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda Yakin Untuk Mengahapus data ini?</p>
                </div>
                <div class="modal-footer justify-content-center row">
                    <button type="button" class="col btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button onclick="deleteThisData()" type="button" class="col btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade bs-example-modal-lg" id="pdfModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Show File
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfIframe" src="" style="width:100%; height:600px;"
                        frameborder="0"></iframe>
                    <div id="imageContainer"></div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" type="button" class="btn btn-secondary">
                        Batal
                    </button>
                    <button id="id_download_file" type="button" class="btn btn-primary">
                        Unduh
                    </button>
                </div>
            </div>
        </div>
    </div>



    {{-- filter data modal filter absensi_filter --}}
    <div class="modal fade customscroll" id="modal-general-filter" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header mb-10">
                    <h5 class="modal-title" id="filter-table-name">
                        Filter Driver
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        data-toggle="tooltip" data-placement="bottom" title=""
                        data-original-title="Close Modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-0 mt-20">
                    <div class="task-list-form">
                        <input type="hidden" name="general-filter-name" id="general-filter-name">
                        <div class="" id="datatable-general-filter">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="filterSave()" id="btn-save-filter" class="btn btn-primary">
                        Simpan Filter
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- js -->
    @yield('src_script_javascript')
    @yield('script_javascript')


    <script>
        let current_url = window.location.href;
        let header_active = 'profile';
        let myArray = current_url.split("/");
        header_active = myArray[4];

        header_active = myArray[5];
        header_active = myArray.at(-1);
        if (header_active.indexOf('#') !== -1) {
            header_active = header_active.replace('#', '');
        }
        $('#title').text(`${capitalizeEachWord(header_active)} | MBG`);
        $(`#${header_active}`).addClass('active');

        if (myArray.length == 6) {
            header_active = myArray[5];
            header_active = header_active.replace('#', '');

            // console.log(header_active);
            // $(`#${header_active}`).addClass('active');
            var element = document.querySelector(`a[href="/${myArray[3]}/${myArray[4]}/${myArray[5]}"]`);

            // Check if the element was found
            if (element) {
                // Add a class to the element
                element.classList.add('active');
                // console.log(element);
            } else {
                // console.log("Element not found");
            }
        }
        $('.user-name').text(`${ui_dataset.ui_dataset.user_authentication.user_details.name}`);

        if (!db) {
            try {
                refreshSession();
            } catch (error) {
                db = null;
            }

            conLog('db', db);

        }
        if (getLocalStorage('filter_absen')) {
            filter_absensi = getLocalStorage('filter_absen');
        } else {
            setLocalStorage('filter_absen', default_filter_absensi);
            filter_absensi = default_filter_absensi;
        }

        // cg('arr_date_today-----------1', arr_date_today);
        conLog('ui_dataset', ui_dataset);
        // cg('arr_date_today-----------1', arr_date_today);
        // conLog('filter_absensi', filter_absensi);
        // =========================================================================================================
        // Initialize Select2
        $('.multi-wrap-select').select2({
            templateResult: formatOptionText,
            templateSelection: formatOptionText
        });

        // Function to limit text length based on container width
        function formatOptionText(option) {
            if (!option.id) {
                return option.text;
            }
            let text = option.text;
            let $tempDiv = $('<div>').css({
                'width': $('.multi-wrap-select-wrapper').width(),
                'font-size': '16px',
                'line-height': '1.5',
                'visibility': 'hidden',
                'white-space': 'nowrap',
                'position': 'absolute'
            }).text(text).appendTo('body');

            while ($tempDiv.width() > $('.multi-wrap-select-wrapper').width()) {
                text = text.substring(0, text.length - 1);
                $tempDiv.text(text + '...');
            }
            $tempDiv.remove();
            return text + '...';
        }

        function hideLoadingContent() {
            $('.loading-content').hide();
        }
        $('.refresh-data').hide();

        $(document).ready(function() {
            // conLog('ready getwithnewdata', 'ready getwithnewdata');
            hideLoadingContent();
            $('.maincontent').removeAttr("hidden");
            $('.maincontent').show();

            if (ui_dataset.ui_dataset.user_authentication.role == 1) {

                $('#btn-general-filter').hide();
            }
            $(".e-general-filter").hide();
            $("#btn-general-filter").click(function() {
                $(".e-general-filter").toggle();

                // Update the badge text depending on visibility
                let isVisible = $(".e-general-filter").is(":visible");
                $("#badge").text(isVisible ? "Hide" : "Show");
            });

            default_filter_absensi['statusKaryawan'].forEach(element => {
                $(`#status-karyawan-${element}`).prop('selected', true);
            });

            $('#FILTER-RANGE').val(setRangeDate(formatDate(start), formatDate(end))).trigger(
                'change');
            setUIdate(ui_dataset.ui_dataset.ui_date.year, ui_dataset.ui_dataset.ui_date.month, ui_dataset.ui_dataset
                .ui_date.day);
            @yield('js_ready')
            stopLoading();
        });
    </script>
</body>

</html>
