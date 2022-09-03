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
	<!-- buttons for Export datatable -->
	<script src="/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="/src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="/src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="/src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="/src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="/src/plugins/datatables/js/vfs_fonts.js"></script>
	<!-- Datatable Setting js -->
	<script src="src/plugins/fancybox/dist/jquery.fancybox.js"></script>
	<script src="/vendors/scripts/datatable-setting.js"></script>
</body>

</html>
