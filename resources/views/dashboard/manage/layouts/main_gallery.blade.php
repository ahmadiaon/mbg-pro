@include('dashboard.layouts.head')

<body>
    @include('dashboard.layouts.sidebar')
    <div class="mobile-menu-overlay"></div>
    <div class="main-container" style="padding-top: 10px;">
        <div class="pd-ltr-15 xs-pd-20-10">
            <div class="min-height-200px">
                @include('dashboard.layouts.header')
                @yield('container')
            </div>

            @include('dashboard.layouts.footer')
        </div>
    </div>
    <script src="/vendors/scripts/core.js"></script>
    <script src="/vendors/scripts/script.min.js"></script>
    <script src="/vendors/scripts/process.js"></script>
    <script src="/vendors/scripts/layout-settings.js"></script>
    <!-- fancybox Popup Js -->
    <script src="/src/plugins/fancybox/dist/jquery.fancybox.js"></script>
</body>

</html>
