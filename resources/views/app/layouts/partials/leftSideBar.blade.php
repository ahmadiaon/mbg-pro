<div class="left-side-bar">
    <div class="brand-logo">
        <a href="profile">
            <img src="/vendors/images/mbg_logo.png" width="636" alt="" class="dark-logo" />
            <img src="/vendors/images/mbg_logo.png" alt="" width="636" class="light-logo" />
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
                <li>
                    <a href="/web/menu" id="menu" class="dropdown-toggle no-arrow">
                        {{-- <i class="icon-copy bi bi-app"></i> --}}
                        <span class="micon bi bi-app"></span><span class="mtext">Menu</span>
                    </a>
                </li>
                <li>
                    <a href="/web/file" id="file" class="dropdown-toggle no-arrow">
                        {{-- <i class="icon-copy bi bi-app"></i> --}}
                        <span class="micon bi bi-files"></span><span class="mtext">FILE</span>
                    </a>
                </li>


                @if (session('user_authentication')['role'] > 1)
                    {{-- @if (in_array('HR', session('user_authentication')['feature']))
                        <li class="dropdown">
                            <a href="human-resource:;" id="hr" class="dropdown-toggle">
                                <span class="micon bi bi-calendar-range"></span><span class="mtext">Human
                                    Resource</span>
                            </a>

                            <ul class="submenu">
                                @if (in_array('HR', session('user_authentication')['feature']))
                                    <li><a id="karyawan" class="" href="/web/hr/karyawan">Karyawan</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif --}}

                    <li class="dropdown">
                        <a href="javascript:;" id="pengelolaan" class="dropdown-toggle">
                            <span class="micon bi bi-calendar-range"></span><span class="mtext">Kehadiran</span>
                        </a>

                        <ul class="submenu">
                            
                            <li><a id="absensi" class="" href="/web/pengelolaan/absensi">Absensi</a></li>
                            @if (in_array('CUTI', session('user_authentication')['feature']))
                                <li><a id="roaster-kerja" class="" href="/web/pengelolaan/roaster-kerja">Roaster
                                        Kerja</a></li>
                            @endif
                            @if (!empty(in_array('SUPERADMIN', session('user_authentication')['feature'])))
                                <li><a id="file-fingger" class="" href="/web/pengelolaan/file-fingger">File
                                        Fingger</a></li>
                            @endif

                        </ul>
                    </li>

                    <li class="dropdown">

                        @if (in_array('RECRUITMENT', session('user_authentication')['feature']))
                            <a href="javascript:;" id="recruitment" class="dropdown-toggle">
                                <span class="micon bi bi-grid-1x2-fill"></span><span class="mtext">Rekruitment</span>
                            </a>
                            <ul class="submenu">
                                <li><a id="recruitment" class=""
                                        href="/web/recruitment/recruitment">Rekruitment</a></li>
                            </ul>
                        @endif
                    </li>
                @endif


                <li class="dropdown">
                    <a href="javascript:;" id="pendapatan" class="dropdown-toggle">
                        <span class="micon fa fa-book"></span><span class="mtext">Pendapatan</span>
                    </a>
                    <ul class="submenu">
                        <li><a id="absensi" class="" href="/web/pendapatan/absensi">Absensi</a></li>
                        <li><a id="slip" href="/web/pendapatan/slip">Slip Gaji</a></li>                        
                        <li><a id="slip" href="/web/pendapatan/roaster-kerja">Roaster Kerja</a></li>
                    </ul>
                </li>
                @if (!empty(in_array('SUPERADMIN', session('user_authentication')['feature'])))
                    <li>
                        <a href="/superadmin/database" class="dropdown-toggle no-arrow">
                            <span class="micon fa fa-database"></span><span class="mtext">Manage Database</span>
                        </a>
                    </li>
                @endif


                @if (!empty(in_array('SUPERADMIN', session('user_authentication')['feature'])))
                    <li class="dropdown">
                        <a href="javascript:;" id="pengelolaan" class="dropdown-toggle">
                            <span class="micon bi bi-menu-button-wide"></span><span class="mtext">Database</span>
                        </a>
                        <ul class="submenu">
                            <li><a id="slip" href="/web/manage/slip">Slip Gaji </a></li>
                            @if (!empty(in_array('SUPERADMIN', session('user_authentication')['feature'])))
                                <li><a id="slip" href="/web/manage/users">Users </a></li>
                                <li><a id="slip" href="/web/manage/app">Aplikasi </a></li>
                                <li><a id="slip" href="/web/manage/menu">Menu </a></li>
                                <li><a id="slip" href="/web/manage/agrement">Persetujuan </a></li>
                                <li><a id="slip" href="/web/manage/database">Database </a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                <li>
                    <a href="/web/logout" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-logout"></span><span class="mtext">Keluar</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
