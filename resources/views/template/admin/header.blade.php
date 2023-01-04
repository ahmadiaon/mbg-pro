<div class="header">
	<div class="header-left">
		<div class="menu-icon bi bi-list"></div>
	</div>
	<div class="header-right">
		<div class="user-notification">
			<div class="dropdown">
				<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
					<i class="icon-copy dw dw-notification"></i>
					<span class="badge notification-active"></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<div class="notification-list mx-h-350 customscroll">
						<ul>
							<li>
								<a href="#">
									<img src="{{ env('APP_URL') }}vendors/images/mbg-logo.png" alt="" />
									<h3>Pengumuman Terbaru</h3>
									<p>
										Galery Terbaru telah terupdate, silahkan lihat
									</p>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="user-info-dropdown mr-20">
			<div class="dropdown">
				<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
					<span class="user-icon">
						<img src="{{ env('APP_URL') }}vendors/images/mbg-logo.png" alt="" />
					</span>
					
					<span class="user-name">{{ (!empty(session('dataUser')->name))?session('dataUser')->name:''}}</span>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
					<a class="dropdown-item" href="#"><i class="dw dw-user1"></i> Profile</a>
					<a class="dropdown-item" href="/login"><i class="dw dw-logout"></i> Logout</a>
				</div>
			</div>
		</div>
	
	</div>
</div>
{{-- @dd() --}}