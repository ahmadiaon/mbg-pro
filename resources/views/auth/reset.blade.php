@include('dashboard.layouts.head')

<body>
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login-admin">
                    <img src="{{ env('APP_URL') }}/vendors/images/digi.png" alt="">
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="/login-admin">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ env('APP_URL') }}/vendors/images/forgot-password.png" alt="">
                </div>
                <div class="col-md-6">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Reset Password</h2>
                        </div>
                        @if(session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade mb-3 show" role="alert">
                            {{ session('loginError') }}

                        </div>
                        @endif
                        <h6 class="mb-20">Enter your new password, confirm and submit</h6>
                        <form action="/new-password" method="post">
                            @csrf
                            <input type="hidden" name="uuid" value="{{ $admin->uuid }}">
                            <div class="input-group custom">
                                <input type="text" name="password" class="form-control form-control-lg"
                                    placeholder="New Password">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="text" name="confirm" class="form-control form-control-lg"
                                    placeholder="Confirm New Password">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="input-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block"
                                            href="index.html">Submit</button>
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
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
</body>

</html>
