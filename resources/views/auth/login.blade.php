@include('dashboard.layouts.head')

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login-admin">
                    <img src="{{ env('APP_URL')}}/vendors/images/digi.png" alt="">
                </a>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{ env('APP_URL')}}/vendors/images/login-page-img.png" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Login To DigiPark</h2>
                            @if(session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade mb-3 show" role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                        </div>
                        <form action="/login-admin" method="post">
                            @csrf
                            <div class="input-group custom">
                                <input value="{{ old('phone_number') }}" required autofocus name="phone_number"
                                    type="text"
                                    class="form-control form-control-lg @error('username') is-invalid @enderror"
                                    placeholder="phone_number">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input name="password" type="password" class="form-control form-control-lg"
                                    placeholder="**********">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row pb-30">
                                <div class="col-6">
                                    <div class="forgot-password"><a href="i-am-forgot-login-admin">Forgot Password</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
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
    <script src="{{ env('APP_URL')}}/vendors/scripts/core.js"></script>
    <script src="{{ env('APP_URL')}}/vendors/scripts/script.min.js"></script>
    <script src="{{ env('APP_URL')}}/vendors/scripts/process.js"></script>
    <script src="{{ env('APP_URL')}}/vendors/scripts/layout-settings.js"></script>
</body>

</html>
