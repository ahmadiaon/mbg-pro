<!DOCTYPE html>
<html>
<head>
	@include('template.admin.head.basic')

	@if(!empty($layout['head_form']) )
		@include('template.admin.head.form')
	@endif

	@if(!empty($layout['head_datatable']) )
		@include('template.admin.head.datatable')
	@endif
	@yield('css')
</head>
<body>
	{{-- // HEADER --}}
	@include('template.admin.header')
	{{-- // RIGHT SIDE BAR --}}
	@include('template.admin.right')
	{{-- ==================================================================================== side bar ========================================================= --}}
	{{-- //left sidebar navigation --}}
	@if(session('dataUser')->role == 'purchase-order')
		@include('template.admin.sidebar.purchase')
	
	@elseif(session('dataUser')->role == 'purchase-order')
		@include('template.admin.sidebar.purchase')

	@else
		@include('layout_adm.public_purchase_order_sidebar')
	@endif
	{{-- ================================================================================== end side bar ========================================================= --}}


<div class="mobile-menu-overlay"></div>

<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			{{-- //CONTENT --}}
			@yield('content')
			
		</div>
		{{-- // FOOTER --}}
		@include('template.admin.footer')
	</div>
</div>
<!-- welcome modal start -->


<!-- welcome modal end -->
{{-- //BASIC JS --}}
	@include('template.admin.javascript.basic')

	@if(!empty($layout['head_datatable']))
    	@include('template.admin.javascript.datatable')
    @endif

	@if(!empty($layout['head_form']) )
		@include('template.admin.javascript.form')
	@endif
	@yield('js')
</body>

</html>