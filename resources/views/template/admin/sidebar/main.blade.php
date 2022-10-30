<div class="left-side-bar">
	{{-- //BRAND LOGO --}}
    @include('template.admin.brand')
	<div class="menu-block customscroll">
		<div class="sidebar-menu">
			<ul id="accordion-menu">
				
				@if (!empty(session('dataUser')->list_purchase_order))
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon bi bi-file-earmark-text"></span><span class="mtext">Purchase Order</span>
					</a>
					<ul class="submenu">
						<li><a class="{{ $layout['active'] == 'list-purchase-order' ? 'active' : '' }}" href="/purchase-order">List</a></li>
					</ul>
				</li>
				@endif
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon bi bi-file-earmark-text"></span><span class="mtext">Karyawan</span>
					</a>
					
					<ul class="submenu">
						@if (!empty(session('dataUser')->read_list_employee))
							<li><a class="{{ $layout['active'] == 'employees-index' ? 'active' : '' }}" href="/user">Daftar Karyawan</a></li>
						@endif
						@if (!empty(session('dataUser')->read_list_absensi_employee))
							<li><a class="{{ $layout['active'] == 'list-employees-absensi' ? 'active' : '' }}" href="/user/absensi">Absensi Karyawan</a></li>
						@endif
					</ul>

				</li>
				@if(!empty(session('dataUser')->read_list_allowance))
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon bi bi-file-earmark-text"></span><span class="mtext" >Allowance</span>
					</a>
					
					<ul class="submenu">
						
						@if (!empty(session('dataUser')->create_employee_hour_meter))
							<li><a class="{{ $layout['active'] == 'employee-hour-meter' ? 'active' : '' }}" data-toggle="tooltip" data-placement="right"
								title="Hour Meter" href="/hour-meter/create">Hour Meter</a></li>
							<li><a class="{{ $layout['active'] == 'employee-tonase' ? 'active' : '' }}" data-toggle="tooltip" data-placement="right"
								title="Hour Meter" href="/tonase">Tonase</a></li>
							<li><a class="{{ $layout['active'] == 'employee-payment' ? 'active' : '' }}" data-toggle="tooltip" data-placement="right"
								title="Hour Meter" href="/payment">Payment</a></li>
						@endif
					</ul>

				</li>
				@endif

				@if(!empty(session('dataUser')->read_list_safety))
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon bi bi-file-earmark-text"></span><span class="mtext" >Safety</span>
					</a>
					
					<ul class="submenu">
						@if (!empty(session('dataUser')->read_list_employee))
							<li><a class="{{ $layout['active'] == 'safety-index' ? 'active' : '' }}" data-toggle="tooltip" data-placement="right"
								title="daftar karyawan dan apd yang didapat" href="/safety">List Karyawan</a></li>
						@endif
					
					</ul>

				</li>
				@endif
				
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon bi bi-bug"></span><span class="mtext">Database</span>
					</a>
					@if (!empty(session('dataUser')->superadmin))
						<ul class="submenu">
							<li><a class="{{ $layout['active'] == 'hour-meter-price' ? 'active' : '' }}" href="/database/hour-meter-price">Hour Meter</a></li>
							<li><a class="{{ $layout['active'] == 'payment-group' ? 'active' : '' }}" href="/database/payment-group">Payment Group</a></li>
							<li><a class="{{ $layout['active'] == 'privilege' ? 'active' : '' }}" href="/superadmin/privilege">Privilege</a></li>
							<li><a class="{{ $layout['active'] == 'user-privilege' ? 'active' : '' }}" href="/user-privilege">Privilege User</a></li>
							<li><a class="{{ $layout['active'] == 'database-status-absen' ? 'active' : '' }}" href="/database/absen">Status Absen</a></li>
							<li><a class="{{ $layout['active'] == 'coal-from' ? 'active' : '' }}" href="/database/coal-from">Asal Batu</a></li>
						</ul>
					@endif
					
				</li>
				{{-- @endif --}}
			</ul>
		</div>
	</div>
</div>
{{-- @dd(session('dataUser')) --}}