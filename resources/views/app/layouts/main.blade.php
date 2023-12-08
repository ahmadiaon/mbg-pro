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
   

</head>

<body>


    {{-- HEADER --}}
    @include('app.layouts.partials.header')


    {{-- SIDEBAR LEFT --}}
    @include('app.layouts.partials.leftSideBar')
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
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

    <!-- js -->
	@yield('script_javascript')
    <script>
        let current_url = window.location.href;
        let header_active = 'profile';
        let myArray = current_url.split("/");
        header_active = myArray[4];
        $('#title').text(`${capitalizeEachWord(header_active)} | MGB`);
        $(`#${header_active}`).addClass('active');

        if(myArray.length == 6){
            header_active = myArray[5];
            header_active = header_active.replace('#' ,'');
            $(`#${header_active}`).addClass('active');
        }
        
    </script>
</body>

</html>
