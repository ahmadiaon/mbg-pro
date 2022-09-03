@include('dashboard.layouts.head')
{{--
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>{{ $title }} |DigiPark</title>
    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/vendors/images/favicon-16x16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="/vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css"
        href="/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="/src/plugins/datatables/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="/vendors/styles/style.css">



    <script>
        window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-119386393-1');
    </script>
</head>
--}}

{{-- --}}

<body>
    @include('dashboard.layouts.sidebar')
    {{--
    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="/">
                <img src="/vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
                <img src="/vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li> a</li>
                    <li> a</li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-house-1"></span><span class="mtext">Pengelolaan</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="/users">Pengguna</a></li>
                            <li><a href="/slides">Slide</a></li>
                            <li><a href="/galleries">Media</a></li>
                            <li><a href="/admin">Admin</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-chat3"></span><span class="mtext">Komunitas</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="/community-registers">Pendaftaran</a></li>
                            <li><a href="/community">Konten</a></li>
                            <li><a href="/community-category">Kategori</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/tour" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-paper-plane1"></span><span class="mtext">Wisata</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-diagram"></span><span class="mtext">UMKM</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="/business">Konten</a></li>
                            <li><a href="/business-category">Kategori</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-apartment"></span><span class="mtext">Financial</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="/financial">Konten</a></li>
                            <li><a href="/financial-loan">Peminjaman</a></li>
                            <li><a href="/registration-loan">Pendaftaran</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-invoice"></span><span class="mtext">Info</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="/news">Berita</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/review" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-browser2"></span><span class="mtext">Ulasan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    --}}
    {{-- --}}
    <div class="mobile-menu-overlay"></div>

    <div class="main-container" style="padding-top: 10px;">
        <div class="pd-ltr-15 xs-pd-20-10">
            <div class="min-height-200px">
                @include('dashboard.layouts.header')
                {{--
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>{{ $title }}</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin-dashboard.php">Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <div class="user-info-dropdown">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <span class="user-icon">
                                            <img src="/vendors/images/photo1.jpg" alt="">
                                        </span>
                                        <span class="user-name">Ross C. Lopez</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="login.html"><i class="dw dw-logout"></i> Log
                                            Out</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                --}}
                {{-- --}}
                @yield('container')
            </div>

            @include('dashboard.layouts.footer')
            {{--
            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit
                    Hingarajiya</a>
            </div>
            --}}
            {{-- --}}
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

    <!-- js -->
    <script src="/vendors/scripts/core.js"></script>
    <script src="/vendors/scripts/script.min.js"></script>
    <script src="/vendors/scripts/process.js"></script>
    <script src="/vendors/scripts/layout-settings.js"></script>
    <script src="/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>


    {{-- @yield('javascript') --}}
    @yield('javascripts')
</body>

</html>
