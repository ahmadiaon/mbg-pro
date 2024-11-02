@extends('app.layouts.main')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>User</h4>
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
                            Akun
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-10">
            <div class="pull-left">
                <h4 class="text-blue h4">Kelola Akun</h4>
                <p>pengelolaan Akun untuk login aplikasi</p>
            </div>
        </div>
        <form id="form-user" method="POST" enctype="multipart/form-data" action="/api/mbg/user">
            <div class="profile-info">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">NIK Karyawan</label>
                    <div class="col-sm-12 col-md-4">
                        <input id="nik_employee" name="nik_employee" class="form-control" type="text"
                            placeholder="Johnny Brown" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">No HP</label>
                    <div class="col-sm-12 col-md-4">
                        <input id="phone_number" name="phone_number" class="form-control" placeholder="tidak ada"
                            type="search">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                    <div class="col-sm-12 col-md-4">
                        <input id="email" name="email" class="form-control" placeholder="tidak ada" type="search">
                    </div>
                </div>
                <div class="form-group row updatePin">
                    <label class="col-sm-12 col-md-2 col-form-label">PIN</label>
                    <div class="row col-sm-12 col-md-4">
                        <div class="col-10">
                            <input name="name-jenis-form" id="name-jenis-form" class="form-control"
                                placeholder="Masukan kelompok Form" type="password" value="******" disabled>
                        </div>
                        <div class="col-2">
                            <input type="hidden" name="valToggle" id="valToggle" value="0">
                            <button type="button" id="btnToggle" class="btn btn-primary">
                                <i id="iconBtnToggle" class="icon-copy bi bi-pencil-square"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label"> </label>
                    <div class="col-sm-12 col-md-4 pd-20 errNotif">
                        <div class="alert alert-danger" role="alert">
                            pin belum sesuai
                        </div>
                    </div>
                </div>

                <div class="form-group row ">
                    <div class="col-sm-12 col-md-6">
                        <div class="col-sm-12 col-md-6 ">
                            <button type="button" id="btnSaveChange" class="btn btn-block btn-primary">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>


            </div>
            <div class="profile-info">
            </div>
        </form>
    </div>
@endsection()

@section('script_javascript')
    {{-- update pin --}}
    <script>
        $(document).ready(function() {

            $("#btnToggle").click(function() {
                if ($("#valToggle").val() == "0") {
                    $("#valToggle").val("1");
                    $('#btnToggle').removeClass();
                    $('#btnToggle').addClass("btn btn-danger")
                    $('#iconBtnToggle').removeClass()
                    $('#iconBtnToggle').addClass("icon-copy bi bi-x-circle-fill")
                    $('.updatePin').after(
                        `
                        <div class="form-group row updatePinForm">
                            <label class="col-sm-12 col-md-2 col-form-label">PIN Baru</label>
                            <div class="col-sm-12 col-md-5" >
                                <div class="input-group custom pin">
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
                            </div>     
                        </div>                       
                        `
                    );
                } else {
                    $("#valToggle").val("0");
                    $('#iconBtnToggle').removeClass()
                    $('#iconBtnToggle').addClass("icon-copy bi bi-pencil-square")
                    $('#btnToggle').removeClass();
                    $('#btnToggle').addClass("btn btn-primary")
                    $('.updatePinForm').remove();
                }
            });
        });
    </script>

    {{-- insert field --}}
    <script>
        $(document).ready(function() {
            $('#form-user').on('click', '#btnSaveChange', function() {
                startLoading();
                var formDataArray = $("#form-user").serializeArray();
                $(`.errNotif`).hide();

                var pinInsert = getPinInsert();
                var objPinInsert = {
                    name: "pin",
                    value: null
                }
                formDataArray.push(objPinInsert);


                if (pinInsert.length > 1) {
                    conLog('formDataArray', 'formDataArray')
                    if (pinInsert.length < 6) {
                        $(`.errNotif`).show();
                        return false;
                    } else if (pinInsert.length == 6) {
                        var objPinInsert = {
                            name: "pin",
                            value: pinInsert
                        }
                        formDataArray.push(objPinInsert);
                    }
                }


                let formData = {};
                formDataArray.forEach(elementField => {
                    formData[elementField.name] = elementField.value
                });

                let _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/api/mbg/user',
                    type: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login
                        // Add other custom headers if needed
                    },
                    data: JSON.stringify({
                        _token: _token,
                        formData: formData
                    }),
                    success: function(response) {
                        showModalSuccess();

                    },
                    error: function(response) {
                        conLog('error', response);
                        stopLoading();
                        //alertModal()
                    }
                });


            });
            $(`.errNotif`).hide();
            getUserInfo();

        });

        function getUserInfo() {
            setValueInput('nik_employee', ui_dataset.ui_dataset.user_authentication.profile.NRP);
            setValueInput('email', ui_dataset.ui_dataset.user_authentication.email);
            setValueInput('phone_number', ui_dataset.ui_dataset.user_authentication.phone_number);
        }

        function getPinInsert() {
            return `${getInputValue('pinNumber-1')}${getInputValue('pinNumber-2')}${getInputValue('pinNumber-3')}${getInputValue('pinNumber-4')}${getInputValue('pinNumber-5')}${getInputValue('pinNumber-6')}`;
        }
    </script>


    {{-- pin max --}}
    <script>
        $(document).ready(function() {
            // Menggunakan event input untuk mengawasi perubahan pada input
            $('#form-user').on('input', '.pinNumber', function() {
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
    </script>
@endsection()
