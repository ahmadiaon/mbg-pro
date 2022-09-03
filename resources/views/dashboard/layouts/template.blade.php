@include('dashboard.layouts.head')

<body>

    @include('dashboard.layouts.sidebar')

	<div class="mobile-menu-overlay"></div>
    <div class="main-container" style="padding-top: 10px;">
        <div class="pd-ltr-15">
            @include('dashboard.layouts.header')
            @yield('container')
            @include('dashboard.layouts.footer')
        </div>
    </div>
	<!-- js -->

	<!-- Datatable Setting js -->

    @yield('javascripts')
</body>

</html>
