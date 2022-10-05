<!DOCTYPE html>
<html>
@include('template.admin.head.datatable')	
@include('template.admin.head.head')
    
	<body>
		@include('layout_adm.header')

		@include('layout_adm.public_purchase_order_sidebar')
		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				@yield('content')
				<div class="footer-wrap pd-20 mb-20 card-box">
					DeskApp - Bootstrap 4 Admin Template By
					<a href="https://github.com/dropways" target="_blank"
						>Ankit Hingarajiya</a
					>
				</div>
			</div>
		</div>
		<!-- js -->
		<script src="{{env('APP_URL')}}vendors/scripts/core.js"></script>
		<script src="{{env('APP_URL')}}vendors/scripts/script.min.js"></script>
		<script src="{{env('APP_URL')}}vendors/scripts/process.js"></script>
		<script src="{{env('APP_URL')}}vendors/scripts/layout-settings.js"></script>
		<!-- Slick Slider js -->
		<script src="{{env('APP_URL')}}src/plugins/slick/slick.min.js"></script>
		<!-- bootstrap-touchspin js -->
		<script src="{{env('APP_URL')}}src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>

        @include('template.admin.javascript.datatable')

		@yield('js')
	</body>
</html>
