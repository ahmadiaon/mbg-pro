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


    @yield('src_css')
    <script src="/vendors/scripts/core.js"></script>
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
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                @yield('content')
            </div>
            <div class="footer-wrap pd-20 mb-20 card-box">
                MBG - Online Created By
                <a href="https://github.com/ahmadiaon"  target="_blank">ahma.id </a>
                Contact me <a href="https://wa.me/6281255897044"><i class="icon-copy bi bi-telephone-fill"></i></a>
            </div>
        </div>
    </div>

    {{-- modal loading --}}
    <div class="modal fade" id="loading-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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

    <!-- js -->
    @yield('src_script_javascript')
    @yield('script_javascript')
    <script>
        $('#main-content').hide();
    </script>

    <script>
        $(document).ready(function() {
            $('#loading-modal').hide();
            $('#main-content').show();
            CL(db)
        });


        let current_url = window.location.href;
        let header_active = 'profile';
        let myArray = current_url.split("/");
        header_active = myArray[4];
        $('#title').text(`${capitalizeEachWord(header_active)} | MBG`);
        $(`#${header_active}`).addClass('active');

        if (myArray.length == 6) {
            header_active = myArray[5];
            header_active = header_active.replace('#', '');
            // $(`#${header_active}`).addClass('active');
            var element = document.querySelector(`a[href="/${myArray[3]}/${myArray[4]}/${myArray[5]}"]`);

            // Check if the element was found
            if (element) {
                // Add a class to the element
                element.classList.add('active');
                console.log(element);
            } else {
                console.log("Element not found");
            }
        }
    </script>
    <script>
        $('.user-name').text(`${ui_dataset.ui_dataset.user_authentication.user_details.name}`);
    </script>
</body>

</html>
