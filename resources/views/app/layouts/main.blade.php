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

    @yield('src_css')
    <script src="/vendors/scripts/core.js"></script>
    <script src="/vendors/scripts/script.min.js"></script>
    <script src="/vendors/scripts/process.js"></script>
    <script src="/vendors/scripts/layout-settings.js"></script>

    @yield('src_javascript')
    @include('app.layouts.addOn.mainScript')

    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="/src/plugins/datatables/css/responsive.bootstrap4.min.css" />
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
                <a href="https://github.com/ahmadiaon" target="_blank">ahma.id</a>
            </div>
        </div>
    </div>


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

    <!-- js -->
    @yield('script_javascript')
    <script>
        console.log('doc start');
        $('#main-content').hide();
        // startLoading();
    </script>

    <script>
        $(document).ready(function() {
            console.log('doc ready');
            $('#loading-modal').hide();
            $('#main-content').show();
        });


        let current_url = window.location.href;
        let header_active = 'profile';
        let myArray = current_url.split("/");
        header_active = myArray[4];
        $('#title').text(`${capitalizeEachWord(header_active)} | MGB`);
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

        conLog('link', `a[href="/${myArray[3]}/${myArray[4]}/${myArray[5]}"]`)
    </script>
    <script>
        $('.user-name').text(`${ui_dataset.ui_dataset.user_authentication.user_details.name}`);
    </script>
</body>

</html>
