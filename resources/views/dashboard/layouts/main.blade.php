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
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="vendors/scripts/dashboard.js"></script>
</body>
</html>
