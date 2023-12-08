<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Login | MBG</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" type="text/css" href="/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="/vendors/styles/style.css" />
</head>
<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.html">
                    <img src="vendors/images/deskapp-logo.svg" alt="" />
                </a>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="/vendors/images/gambar-mb.png" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Login To MBG-Online</h2>
                        </div>
                        <form action="/web/login" method="post" enctype="multipart/form-data">
							@csrf
                            <div class="input-group custom">
                                <input type="text" name="username" class="@error('username') is-invalid @enderror form-control form-control-lg" placeholder="NRP Contoh. MBLE-0422003" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>								
                            </div>
                            <div class="input-group custom">
                                <input type="text" class="@error('username') is-invalid @enderror form-control form-control-lg" name="password" placeholder="NIK KTP Conth, 6212341234567890" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
							@error('username')
								<div class="row pb-30">
									<div class="col-12">
										<div class="">
											<a href="#">Data Tidak Sesuai</a>
										</div>
									</div>                                
								</div>
                            @enderror
							@if (session()->has('isError'))
								<div class="row pb-30">
									<div class="col-12">
										<div class="">
											<a href="#">Data Tidak Sesuai</a>
										</div>
									</div>                                
								</div>
							@enderror
                            <div class="row pb-30">
                                <div class="col-12">
									<div class="forgot-password">
                                        <a href="#">Gunakan NIK Karayawan sebagai user dan NIK kependudukan sebagai password</a>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
										<button type="submit"  class="btn btn-outline-primary btn-lg btn-block">
											Login
										</button>
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
