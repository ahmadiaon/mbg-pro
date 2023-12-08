<div class="left-side-bar">
    <div class="brand-logo">
        <a href="profile">
            <img src="/vendors/images/mbg_logo.png" width="636"  alt="" class="dark-logo" />
            <img src="/vendors/images/mbg_logo.png" alt="" width="636"  class="light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="/web/profile" id="profile" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-user-o"></span><span class="mtext">Profile</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" id="pendapatan"  class="dropdown-toggle">
                        <span class="micon fa fa-book"></span><span class="mtext">Pendapatan</span>
                    </a>
                    <ul class="submenu">
                        <li><a id="absensi"  class="" href="/web/pendapatan/absensi">Absensi</a></li>
                        <li><a id="slip"  href="/web/pendapatan/slip">Slip Gaji</a></li>
                    </ul>
                </li>
                @if (!empty(session('user_authentication')->user_privileges->superadmin))
                <li>
                    <a href="/superadmin/database" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-database"></span><span class="mtext">Manage Database</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="/logout" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-logout"></span><span class="mtext">Keluar</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>