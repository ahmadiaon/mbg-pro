<div class="left-side-bar">
    {{-- //BRAND LOGO --}}
    @include('template.admin.brand')
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-house"></span><span class="mtext">Data Karyawan</span>
                    </a>
                    <ul class="submenu">
                        <li><a class="{{ $layout['active'] == 'karyawan' ? 'active' : '' }}"
                                href="/admin-hr">Karyawan</a>
                        </li>
                        <li><a class="{{ $layout['active'] == 'monitoring' ? 'active' : '' }}"
                                href="/admin-hr/monitoring">Monitoring PKWT</a>
                        </li>
						<li><a class="{{ $layout['active'] == 'monitoring' ? 'active' : '' }}"
							href="/admin-hr/monitoring">Monitoring Cuti</a>
						</li>
                    </ul>
                </li>              
            </ul>
        </div>
    </div>
</div>
