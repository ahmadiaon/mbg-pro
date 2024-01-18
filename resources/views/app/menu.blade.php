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
                    <a href="/web/pendapatan/absensi" class="mb-2 btn btn-sm btn-outline-warning">absensi</a>
                    <a href="web/pendapatan/slip" class="mb-2 btn btn-sm btn-outline-success">slip</a>
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

    </div>
@endsection()

@section('script_javascript')
    <script></script>
@endsection()
