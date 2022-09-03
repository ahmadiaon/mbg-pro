@include('dashboard.layouts.head')


<body>
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="/">
                    <img src="vendors/images/digi.png" alt="">
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="/">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="vendors/images/forgot-password.png" alt="">
                </div>
                <div class="col-md-6">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Forgot Password</h2>
                        </div>
                        @if(session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade mb-3 show" role="alert">
                            {{ session('loginError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <h6 class="mb-20">Enter your email address to reset your password</h6>
                        <form action="/forgot" method="post">
                            @csrf
                            <div class="input-group custom">
                                <input name="email" type="text" class="form-control form-control-lg"
                                    placeholder="Email">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="fa fa-envelope-o"
                                            aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div class="row align-items-center">


                                <div class="col-5">
                                    <div class="input-group mb-0">
                                        <!--
                                                use code for form submit
                                                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
                                            -->
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="font-16 weight-600 text-center" data-color="#707373">OR</div>
                                </div>
                                <div class="col-5">
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-primary btn-lg btn-block" href="/">Login</a>
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
    <script src="/vendors/scripts/core.js"></script>
    <script src="/vendors/scripts/script.min.js"></script>
    <script src="/vendors/scripts/process.js"></script>
    <script src="/vendors/scripts/layout-settings.js"></script>
</body>

</html>
