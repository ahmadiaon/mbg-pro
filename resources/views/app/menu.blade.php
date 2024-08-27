@extends('app.layouts.main')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <a href="/web/menu">
                        <h4>Menu</h4>
                    </a>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/web/menu">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="/web/menu">Menu</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row mb-20">
        <div class="col-sm-12 col-md-4 mb-20">
            <div class="card card-box">
                <h5 class="card-header weight-500">Pendapatan</h5>
                <div class="card-body">
                    <p class="card-text">
                        Sub menu
                    </p>
                    @if (!empty(session('user_authentication')['user_privileges']['superadmin']))
                        <a href="/web/pendapatan/hauling" class="mb-2 btn btn-sm btn-outline-primary">Hauling</a>
                    @endif
                    <a href="/web/pendapatan/absensi" class="mb-2 btn btn-sm btn-outline-warning">absensi</a>
                    <a href="/web/pendapatan/slip" class="mb-2 btn btn-sm btn-outline-success">slip</a>

                </div>
                <div class="card-footer text-muted"></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mb-20">
            <div class="card card-box mb-20">
                <h5 class="card-header weight-500">Profile</h5>
                <div class="card-body">
                    <p class="card-text">
                        Sub menu
                    </p>
                    <a href="/web/profile" class="mb-2 btn btn-sm btn-outline-primary">Profile</a>
                    <a href="/web/menu/user" class="mb-2 btn btn-sm btn-outline-info">Akun</a>
                </div>
                <div class="card-footer text-muted"></div>
            </div>
        </div>
        @if (!empty(session('user_authentication')['user_privileges']['superadmin']))
            <div class="col-sm-12 col-md-4 mb-20 ">
                <div class="card card-box mb-20">
                    <h5 class="card-header weight-500">Pengelolaan</h5>
                    <div class="card-body">
                        <p class="card-text">
                            Sub menu
                        </p>
                        <a href="/web/manage/hauling" class="mb-2 btn btn-sm btn-outline-primary">Profile</a>
                        <a href="/web/manage/user" class="mb-2 btn btn-sm btn-outline-info">Akun</a>
                        <a href="/web/manage/localdata" class="mb-2 btn btn-sm btn-outline-info">local data</a>
                    </div>
                    <div class="card-footer text-muted"></div>
                </div>
            </div>
        @endif

    </div>

    {{-- warning modal change pin --}}
    <div class="modal fade" id="warning-modal-change-pin" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content bg-warning">
                <div class="modal-body text-center">
                    <h3 class="mb-15">
                        <i class="fa fa-exclamation-triangle"></i> Warning
                    </h3>
                    <p>
                        harap ganti password login anda menggunakan PIN, untuk memudahkan login di kemudian hari.
                    </p>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        batal
                    </button>
                    <a href="/web/menu/user">
                        <button type="button" class="btn btn-success">
                            Ubah
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script_javascript')
    <script>
        CL('database');
        let data_for_looping_menu = [];

        $(document).ready(function() {
            getUserInfo();
        });

        function getUserInfo() {
            if(!ui_dataset.ui_dataset.user_authentication.pin){
                $('#warning-modal-change-pin').modal('show');
            }
        }
    </script>
@endsection()
