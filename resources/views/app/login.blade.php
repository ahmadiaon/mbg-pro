<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Login | MBG</title>



    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="/vendors/styles/style.css" />
    <script src="/vendors/scripts/core.js"></script>
    <script src="/vendors/scripts/script.min.js"></script>
    <script src="/vendors/scripts/process.js"></script>
    <script src="/vendors/scripts/layout-settings.js"></script>
    @include('app.layouts.addOn.mainScript')
</head>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.html">
                    <img src="/vendors/images/deskapp-logo.svg" alt="" />
                </a>
            </div>
        </div>
    </div>
    
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    {{-- <img src="/vendors/images/gambar-mb.png" alt="" /> --}}
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Login To MBG-Online</h2>
                        </div>
                        <form action="/web/login" method="post" id="form-login" enctype="multipart/form-data">
                            @csrf
                            <label class="weight-600">NIK Karyawan</label>
                            <div class="input-group custom">
                                <input type="text" id="nik_employee" name="nik_employee" oninput="inputNIK()"
                                    class="@error('nik_employee') is-invalid @enderror form-control form-control-lg"
                                    placeholder="NRP Contoh. MBLE-0422003" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="row pb-30 not-found" style="display: none;">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <a href="#">NIK tidak ditemukan</a>
                                    </div>
                                </div>
                            </div>

                            <label class="weight-600 ktp"style="display: none;">NIK KTP</label>
                            <div class="input-group custom ktp"style="display: none;">
                                <input type="text" id="nik_number" name="nik_number"
                                    class="@error('nik_number') is-invalid @enderror insertValue form-control form-control-lg"
                                    placeholder="NIK KTP Contoh 62131111324556" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>

                            <label class="weight-600 pin"style="display: none;">PIN</label>
                            <input type="hidden" name="pin" id="pin">
                            <div class="input-group custom pin"style="display: none;">
                                <div class="form-group justify-center row updatePinForm pd-20">
                                    <div class="col-sm-12 col-md-12 btn-group">
                                        <input name="pinNumber-1" maxlength="1" id="pinNumber-1"
                                            class="pinNumber form-control mr-1" type="number">
                                        <input name="pinNumber-2" maxlength="1" id="pinNumber-2"
                                            class="pinNumber  form-control mr-1" type="number">
                                        <input name="pinNumber-3" maxlength="1" id="pinNumber-3"
                                            class="pinNumber  form-control mr-1" type="number">
                                        <input name="pinNumber-4" maxlength="1" id="pinNumber-4"
                                            class="pinNumber  form-control mr-1" type="number">
                                        <input name="pinNumber-5" maxlength="1" id="pinNumber-5"
                                            class="pinNumber  form-control mr-1" type="number">
                                        <input name="pinNumber-6" maxlength="1" id="pinNumber-6"
                                            class="pinNumber  form-control" type="number">
                                    </div>
                                </div>

                            </div>

                            <div class="row pb-30 not-match" style="display: none;">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <a href="#">Validasi Login Gagal</a>
                                    </div>
                                </div>
                            </div>



                            <div class="row pb-30 descLogin">
                                <div class="col-12">
                                    <div class="forgot-password">
                                        <a href="#">Gunakan NIK Karayawan sebagai user</a>
                                    </div>
                                </div>
                            </div>
                            <div id="id_loadingLogin" class="row pb-30 loadingLogin" style="display: none;">
                                <div class="col-12 text-center">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <div class="input-group mb-0">
                                        <button type="button" id="btnSubmit" onclick="cekAvailableEmployee()"
                                            class="btn btn-outline-primary btn-lg btn-block">
                                            Login
                                        </button>
                                        {{-- <button type="submit">submit</button> --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <script>
        if (localStorage.getItem('ui_dataset')) {
            localStorage.clear();
        }
        if (@json(session('user_authentication'))) {
            sessionStorage.clear();
        }
    </script>
    <script src="/vendors/scripts/core.js"></script>
    <script src="/vendors/scripts/script.min.js"></script>
    <script src="/vendors/scripts/process.js"></script>
    <script src="/vendors/scripts/layout-settings.js"></script>
    <script>
        console.log(localStorage.getItem('ui_dataset'));
        console.log(@json(session('user_authentication')))
    </script>
    <script>
        function inputNIK() {
            console.log('inputNIK');
            $('#nik_number').val("");
            $('.pinNumber').val("");
            $(`.ktp`).hide();
            $(`.pin`).hide();

        }

        // $("#btnSubmit").click(function(event) {

        // });

        async function cekAvailableEmployee() {


            // return false;
            $(`.not-found`).hide();
            $('.not-match').hide();

            let _token = $('meta[name="csrf-token"]').attr('content');
            var pinInsert = getPinInsert();
            $.ajax({
                url: '/web/login/available',
                type: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // Add other custom headers if needed
                },
                async: true,
                beforeSend: function() {
                    console.log('before')
                    $(`#id_loadingLogin`).show();
                },
                data: JSON.stringify({
                    _token: _token,
                    nik_employee: $(`#nik_employee`).val(),
                    pin: pinInsert,
                    nik_number: $(`#nik_number`).val()
                }),
                success: function(response) {
                    console.log(response)
                    if (response.data) {
                        console.log(response.data)
                        if (typeof(response.data) == 'object') {

                            if (response.data.status == 'success') {
                                console.log(response.data)
                                $('#pin').val(pinInsert);
                                console.log('response login');
                                console.log(response);
                                // return false;
                                window.location.href = '/web/menu';
                                // refreshSession();
                                let date_today_new = getDateTodayArr();

                                conLog('date_today_new', date_today_new);
                                // setDateSession(date_today_new.year, date_today_new.month);
                                // localStorage.setItem('arr_date_today', );
                                return false;


                                // window.location.href = '/web/profile';
                            } else {
                                $('.not-match').show()
                                $('#nik_number').val("");
                                $('.pinNumber').val("");
                            }

                        } else {
                            $(`.ktp`).hide();
                            $(`.pin`).hide();
                            $(`.${response.data}`).show()
                        }
                    } else {
                        $(`.not-found`).show();
                    }
                },
                complete: function() {
                    // Always hide the loading indicator after the AJAX call completes
                    $('.loadingLogin').hide();
                },
                error: function(response) {
                    conLog('error', response)
                    //alertModal()
                }
            });
            // $(`#id_loadingLogin`).empty();
        }

        function getPinInsert() {
            return `${getInputValue('pinNumber-1')}${getInputValue('pinNumber-2')}${getInputValue('pinNumber-3')}${getInputValue('pinNumber-4')}${getInputValue('pinNumber-5')}${getInputValue('pinNumber-6')}`;
        }

        function getInputValue(idElement) {
            return $(`#${idElement}`).val();
        }
    </script>
    {{-- pin max --}}
    <script>
        $(document).ready(function() {

            // Menggunakan event input untuk mengawasi perubahan pada input
            // $(".pinNumber").input(function() {
            $('#form-login').on('input', '.pinNumber', function() {
                // Mendapatkan nilai input
                var inputValue = $(this).val();

                // Pindah ke input berikutnya jika digit telah dimasukkan
                var sanitizedValue = $(this).val().replace(/[^0-9]/g, '');

                // Menetapkan nilai bersih kembali ke input
                $(this).val(sanitizedValue);
                inputValue = $(this).val();
                if (inputValue.length === 1) {
                    $(this).next('.pinNumber').focus();
                }
            });
        });
        conLog('s', 's')
    </script>
</body>

</html>
