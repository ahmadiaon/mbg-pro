<div class="left-side-bar">
	{{-- //BRAND LOGO --}}
    @include('template.admin.brand')
	<div class="menu-block customscroll">
		<div class="sidebar-menu">
			<ul id="accordion-menu">
				
				@if (!empty(session('dataUser')->read_purchase_order))
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon bi bi-file-earmark-text"></span><span class="mtext">Purchase Order</span>
					</a>
					<ul class="submenu">
						<li><a class="" href="/purchase-order">List</a></li>
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
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<span class="micon bi bi-bug"></span><span class="mtext">Database</span>
					</a>
					@if (!empty(session('dataUser')->superadmin))
						<ul class="submenu">
							<li><a class="{{ $layout['active'] == 'privilege' ? 'active' : '' }}" href="/superadmin/privilege">Privilege</a></li>
							<li><a class="{{ $layout['active'] == 'user-privilege' ? 'active' : '' }}" href="/user-privilege">Privilege User</a></li>
							<li><a class="{{ $layout['active'] == 'database-status-absen' ? 'active' : '' }}" href="/database/absen">Status Absen</a></li>
						</ul>
					@endif
					
				</li>
				{{-- @endif --}}
			</ul>
		</div>
	</div>
</div>
{{-- @dd(session('dataUser')) --}}