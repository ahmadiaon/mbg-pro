<div class="left-side-bar">
    {{-- //BRAND LOGO --}}
    @include('template.admin.brand')
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                @if (!empty(session('dataUser')->is_login))
                    <li>
                        <a href="/"
                            class="dropdown-toggle no-arrow {{ $layout['active'] == 'index' ? 'active' : '' }}">
                            <span class="micon bi bi-person-square"></span><span class="mtext">Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="/form"
                            class="dropdown-toggle no-arrow {{ $layout['active'] == 'formIndex' ? 'active' : '' }}">
                            <span class="micon bi bi-calendar3"></span><span class="mtext">Form</span>
                        </a>
                    </li>
                    <li>
                        <a href="/activity"
                            class="dropdown-toggle no-arrow {{ $layout['active'] == 'activity' ? 'active' : '' }}">
                            <span class="micon bi bi-calendar3"></span><span class="mtext">Kelola Form</span>
                        </a>
                        <a href="/activity/simple"
                        class="dropdown-toggle no-arrow {{ $layout['active'] == 'activity' ? 'active' : '' }}">
                        <span class="micon bi bi-calendar3"></span><span class="mtext">Simple</span>
                    </a>
                    </li>
                    @if (!empty(session('dataUser')->list_purchase_order))
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-file-earmark-text"></span><span class="mtext">Purchase
                                    Order</span>
                            </a>
                            <ul class="submenu">
                                <li><a class="{{ $layout['active'] == 'list-purchase-order' ? 'active' : '' }}"
                                        href="/purchase-order">List</a></li>
                            </ul>
                        </li>
                    @endif
                    @if (!empty(session('dataUser')->read_list_employee))
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-file-earmark-text"></span><span class="mtext">Karyawan</span>
                            </a>

                            <ul class="submenu">
                                @if (!empty(session('dataUser')->read_list_employee))
                                    <li><a class="{{ $layout['active'] == 'employees-index' ? 'active' : '' }}"
                                            href="/user">Daftar Karyawan</a></li>
                                @endif

                                @if (!empty(session('recruitment-user')))
                                    <li class="dropdown">

                                        <a href="javascript:;"
                                            class="dropdown-toggle {{ $layout['active'] == 'user-education' || $layout['active'] == 'employee-salary' || $layout['active'] == 'user-employee' || $layout['active'] == 'user-document' || $layout['active'] == 'user-license' || $layout['active'] == 'user-health' || $layout['active'] == 'user-dependent' || $layout['active'] == 'user-address' || $layout['active'] == 'user-detail' || $layout['active'] == 'user-address' ? 'active' : '' }}">
                                            <span class="micon bi bi-hdd-stack"></span><span class="mtext">Profil
                                                Detail</span>
                                        </a>
                                        <ul class="submenu">
                                            <li><a class="{{ $layout['active'] == 'user-detail' ? 'active' : '' }}"
                                                    href="/user/detail">Detail</a></li>
                                            {{-- @if (!empty(session('recruitment-user')['detail']['nik_number'])) --}}
                                            <li><a class="{{ $layout['active'] == 'user-address' ? 'active' : '' }}"
                                                    href="/user/address/create">Alamat</a></li>
                                            <li><a class="{{ $layout['active'] == 'user-dependent' ? 'active' : '' }}"
                                                    href="/user/dependent/create">Keluarga</a></li>
                                            <li><a class="{{ $layout['active'] == 'user-education' ? 'active' : '' }}"
                                                    href="/user/education/create">Pendidikan</a></li>
                                            <li><a class="{{ $layout['active'] == 'user-license' ? 'active' : '' }}"
                                                    href="/user/license/create">Lisensi</a></li>
                                            <li><a class="{{ $layout['active'] == 'user-health' ? 'active' : '' }}"
                                                    href="/user/health/create">Kesehatan</a></li>
                                            <li><a class="{{ $layout['active'] == 'user-document' ? 'active' : '' }}"
                                                    href="/user/document/create">Dokumen</a></li>
                                            <li><a class="{{ $layout['active'] == 'user-employee' ? 'active' : '' }}"
                                                    href="/user/employee/create">Kekaryawanan</a></li>
                                            <li><a class="{{ $layout['active'] == 'employee-salary' ? 'active' : '' }}"
                                                    href="/user/salary/create">Penggajihan</a></li>
                                            {{-- @endif --}}
                                            <li><a href="/user/close">
                                                    <div class="clearfix">
                                                        <div class="pull-left">
                                                            tutup
                                                        </div>
                                                        <div class="pull-right">
                                                            <i class="icon-copy fa fa-close" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif

                                {{-- @if (!empty(session('dataUser')->read_employee_contract))
                                    <li><a class="{{ $layout['active'] == 'employees-contract' ? 'active' : '' }}"
                                            href="/employee-contract">Kontrak Karyawan</a></li>
                                @endif --}}
                                @if (!empty(session('dataUser')->read_list_change_employee))
                                    <li><a href="/employee-out"
                                            class="{{ $layout['active'] == 'employee-out' ? 'active' : '' }}"
                                            data-toggle="tooltip" data-placement="right" title="Hour Meter">Karyawan
                                            Keluar</a></li>
                                    <li><a href="/employee-cuti"
                                            class="{{ $layout['active'] == 'employee-cuti' ? 'active' : '' }}"
                                            data-toggle="tooltip" data-placement="right" title="Manajemen Cuti">Cuti</a>
                                    </li>
                                @endif
                                @if (!empty(session('dataUser')->read_list_absensi_employee))
                                    <li><a class="{{ $layout['active'] == 'list-employees-absensi' ? 'active' : '' }}"
                                            href="/user/absensi">Absensi Karyawan</a></li>
                                @endif
                                @if (!empty(session('dataUser')->read_list_change_employee))
                                    {{-- <li><a href="/employee-changge"
                                            class="{{ $layout['active'] == 'employee-changge' ? 'active' : '' }}"
                                            data-toggle="tooltip" data-placement="right"
                                            title="Rotasi, Mutasi, Promosi. Demosi, Pemberhentian dan Pengajuan">Perubahan</a>
                                    </li> --}}
                                    <li><a href="/form-recruitment"
                                            class="{{ $layout['active'] == 'form-recruitment' ? 'active' : '' }}"
                                            data-toggle="tooltip" data-placement="right"
                                            title="Kelola Perekrutan Karyawan">PPK</a>
                                    <li><a href="/applicant"
                                            class="{{ $layout['active'] == 'applicant-index' ? 'active' : '' }}"
                                            data-toggle="tooltip" data-placement="right"
                                            title="Kelola Perekrutan Karyawan">Pelamar</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (!empty(session('dataUser')->read_list_allowance))
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-file-earmark-text"></span><span class="mtext">Allowance</span>
                            </a>

                            <ul class="submenu">
                                @if (!empty(session('dataUser')->create_employee_hour_meter))
                                    <li><a class="{{ $layout['active'] == 'employee-hour-meter' ? 'active' : '' }}"
                                            data-toggle="tooltip" data-placement="right" title="Hour Meter"
                                            href="/hour-meter">HM</a></li>
                                    <li><a class="{{ $layout['active'] == 'employee-tonase' ? 'active' : '' }}"
                                            data-toggle="tooltip" data-placement="right" title="Hour Meter"
                                            href="/tonase">Tonase</a></li>
                                    <li><a class="{{ $layout['active'] == 'employee-payment' ? 'active' : '' }}"
                                            data-toggle="tooltip" data-placement="right" title="Hour Meter"
                                            href="/payment">Borongan</a></li>
                                    <li><a class="{{ $layout['active'] == 'employee-other-payment' ? 'active' : '' }}"
                                            data-toggle="tooltip" data-placement="right" title="Hour Meter"
                                            href="/other-payment">Pembayaran Lainnya</a></li>
                                    <li><a class="{{ $layout['active'] == 'production' ? 'active' : '' }}"
                                            data-toggle="tooltip" data-placement="right" title="Hour Meter"
                                            href="/production">Produksi</a></li>
                                @endif

                                <li><a class="{{ $layout['active'] == 'employee-allowance' ? 'active' : '' }}"
                                        href="/allowance">Total</a></li>
                            </ul>

                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-file-earmark-text"></span><span
                                    class="mtext">Pengurang</span>
                            </a>
                            <ul class="submenu">
                                @if (!empty(session('dataUser')->create_employee_hour_meter))
                                    <li>
                                        <a class="{{ $layout['active'] == 'employee-debt' ? 'active' : '' }}"
                                            data-toggle="tooltip" data-placement="right" title="Hour Meter"
                                            href="/employee-debt">Hutang HO</a>
                                    </li>
                                    <li>
                                        <a class="{{ $layout['active'] == 'employee-deduction' ? 'active' : '' }}"
                                            href="/employee-deduction">Pengurang Lainnya</a>
                                    </li>
                                @endif
                            </ul>
                    @endif

                    @if (!empty(session('dataUser')->read_list_safety))
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-file-earmark-text"></span><span class="mtext">Safety</span>
                            </a>

                            <ul class="submenu">
                                @if (!empty(session('dataUser')->read_list_employee))
                                    <li><a class="{{ $layout['active'] == 'safety-index' ? 'active' : '' }}"
                                            data-toggle="tooltip" data-placement="right"
                                            title="daftar karyawan dan apd yang didapat" href="/safety">List
                                            Karyawan</a></li>
                                @endif
                            </ul>

                        </li>
                    @endif
                    @if (!empty(session('dataUser')->read_list_employee))
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-file-earmark-text"></span><span
                                    class="mtext">Logistik</span>
                            </a>
                            <ul class="submenu">
                                <li><a class="{{ $layout['active'] == 'logistic-store' ? 'active' : '' }}"
                                        data-toggle="tooltip" data-placement="right"
                                        title="daftar karyawan dan apd yang didapat" href="/logistic">Gudang</a></li>

                            </ul>
                        </li>
                    @endif
                    @if (!empty(session('dataUser')->superadmin))
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-bug"></span><span class="mtext">Database</span>
                            </a>
                            @if (!empty(session('dataUser')->superadmin))
                                <ul class="submenu">

                                    <li><a class="{{ $layout['active'] == 'department' ? 'active' : '' }}"
                                            href="/database/department">Departemen</a></li>
                                    <li><a class="{{ $layout['active'] == 'position' ? 'active' : '' }}"
                                            href="/database/position">Jabatan</a></li>
                                    <li><a class="{{ $layout['active'] == 'Location' ? 'active' : '' }}"
                                            href="/database/location">Lokasi</a></li>

                                    <li><a class="{{ $layout['active'] == 'hm-bonus' ? 'active' : '' }}"
                                            href="/database/hm-bonus">Bonus HM</a></li>
                                    {{-- <li><a class="{{ $layout['active'] == 'religion' ? 'active' : '' }}"
                                            href="/database/religion">Agama</a></li> --}}
                                    {{-- <li><a class="{{ $layout['active'] == 'poh' ? 'active' : '' }}"
                                            href="/database/poh">POH</a></li> --}}
                                    {{-- <li><a class="{{ $layout['active'] == 'hour-meter-price' ? 'active' : '' }}"
                                            href="/database/hour-meter-price">Hour Meter</a></li> --}}
                                    <li><a class="{{ $layout['active'] == 'payment-group' ? 'active' : '' }}"
                                            href="/database/payment-group">Payment Group</a></li>
                                    <li><a class="{{ $layout['active'] == 'privilege' ? 'active' : '' }}"
                                            href="/superadmin/privilege">Privilege</a></li>
                                    <li><a class="{{ $layout['active'] == 'user-privilege' ? 'active' : '' }}"
                                            href="/user-privilege">Privilege User</a></li>
                                    <li><a class="{{ $layout['active'] == 'database-status-absen' ? 'active' : '' }}"
                                            href="/database/absen">Status Absen</a></li>
                                    <li><a class="{{ $layout['active'] == 'company' ? 'active' : '' }}"
                                            href="/database/company">Perusahaan</a></li>
                                    <li><a class="{{ $layout['active'] == 'coal-type' ? 'active' : '' }}"
                                            href="/database/coal-type">Tipe Batu</a></li>
                                    <li><a class="{{ $layout['active'] == 'coal-from' ? 'active' : '' }}"
                                            href="/database/coal-from">Asal Batu</a></li>
                                    <li><a class="{{ $layout['active'] == 'premi' ? 'active' : '' }}"
                                            href="/database/premi">Premi</a></li>
                                    {{-- <li><a class="{{ $layout['active'] == 'tax-status' ? 'active' : '' }}"
                                            href="/database/tax-status">Status Pajak</a></li> --}}
                                    {{-- <li><a class="{{ $layout['active'] == 'payment-other' ? 'active' : '' }}"
                                            href="/database/payment-other">Pembayaran Lain</a></li> --}}
                                    <li><a class="{{ $layout['active'] == 'dictionary' ? 'active' : '' }}"
                                            href="/database/dictionary">Kamus</a></li>
                                    <li><a class="{{ $layout['active'] == 'atribut-size' ? 'active' : '' }}"
                                            href="/database/atribut-size">Satuan</a></li>
                                    <li><a class="{{ $layout['active'] == 'variable' ? 'active' : '' }}"
                                            href="/database/variable">Variable</a></li>
                                    <li><a class="{{ $layout['active'] == 'formula' ? 'active' : '' }}"
                                            href="/database/formula">Formula Potongan</a></li>
                                    <li><a class="{{ $layout['active'] == 'formula' ? 'active' : '' }}"
                                        href="/database/export-db">Export DB</a></li>
                                </ul>
                            @endif

                        </li>
                    @endif
                    @if (!empty(session('dataUser')->superadmin))
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-bug"></span><span class="mtext">Unit</span>
                            </a>
                            @if (!empty(session('dataUser')->superadmin))
                                <ul class="submenu">
                                    <li><a class="{{ $layout['active'] == 'brand' ? 'active' : '' }}"
                                            href="/logistic/brand">Daftar Brand</a></li>
                                    <li><a class="{{ $layout['active'] == 'brand-type' ? 'active' : '' }}"
                                            href="/logistic/brand-type">Type Brand</a></li>
                                    <li><a class="{{ $layout['active'] == 'group-vehicle' ? 'active' : '' }}"
                                            href="/logistic/group-vehicle">Daftar Group Unit</a></li>
                                    <li><a class="{{ $layout['active'] == 'logistic-unit' ? 'active' : '' }}"
                                            href="/logistic/unit">Daftar Unit</a></li>
                                    <li><a class="{{ $layout['active'] == 'logistic-status' ? 'active' : '' }}"
                                            href="/logistic/status">Status</a></li>
                                </ul>
                            @endif

                        </li>
                    @endif
                    <li>
                        <a href="/me/{{ session('dataUser')->nik_employee }}"
                            class="dropdown-toggle no-arrow {{ $layout['active'] == 'employees-profile' ? 'active' : '' }}">
                            <span class="micon bi bi-person-square"></span><span class="mtext">Profil</span>
                        </a>
                    </li>
                    <li>
                        <a href="/me/{{ session('dataUser')->nik_employee }}/absensi"
                            class="dropdown-toggle no-arrow {{ $layout['active'] == 'list-employees-absensi' ? 'active' : '' }}">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Absensi</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-bug"></span><span class="mtext">Pendapatan saya</span>
                        </a>
                        {{-- <ul class="submenu">
                            <li><a class="{{ $layout['active'] == 'hour-meter-price-me' ? 'active' : '' }}"
                                    href="/me/{{ session('dataUser')->nik_employee }}/hour-meter">HM</a>
                            </li>
                            <li><a class="{{ $layout['active'] == 'tonase-employee-me' ? 'active' : '' }}"
                                    href="/me/{{ session('dataUser')->nik_employee }}/tonase">Hauling</a>
                            </li>
                        </ul> --}}
                    </li>
                @else
                    <li>
                        <a href="/recruitment/create"
                            class="dropdown-toggle no-arrow {{ $layout['active'] == 'recruitment-create' ? 'active' : '' }}">
                            <span class="micon bi bi-person-square"></span><span class="mtext">Recruitment</span>
                        </a>
                    </li>
                    <li>
                        <a href="/recruitment"
                            class="dropdown-toggle no-arrow {{ $layout['active'] == 'recruitment-index' ? 'active' : '' }}">
                            <span class="micon bi bi-person-square"></span><span class="mtext">Job Open</span>
                        </a>
                    </li>
                    @if (empty(session('recruitment-user')))
                        <li>
                            <a href="/recruitment/up"
                                class="dropdown-toggle no-arrow {{ $layout['active'] == 'recruitment-profile' ? 'active' : '' }}">
                                <span class="micon bi bi-person-square"></span><span class="mtext">Profile
                                    Saya</span>
                            </a>
                        </li>
                    @endif
                    @if (!empty(session('recruitment-user')))
                        <li>
                            <a href="/recruitment/me/apply"
                                class="dropdown-toggle no-arrow {{ $layout['active'] == 'applicant-index' ? 'active' : '' }}">
                                <span class="micon bi bi-person-square"></span><span class="mtext">Lamaran
                                    Saya</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-bug"></span><span class="mtext">Profile</span>
                            </a>
                            <ul class="submenu">
                                <li><a class="{{ $layout['active'] == 'user-detail' ? 'active' : '' }}"
                                        href="/recruitment/me/identity">Identitas</a>
                                </li>
                                <li><a class="{{ $layout['active'] == 'user-address' ? 'active' : '' }}"
                                        href="/recruitment/me/address">Alamat</a>
                                </li>
                                <li><a class="{{ $layout['active'] == 'user-dependent' ? 'active' : '' }}"
                                        href="/recruitment/me/dependent">Keluarga</a>
                                </li>

                                <li><a class="{{ $layout['active'] == 'user-education' ? 'active' : '' }}"
                                        href="/recruitment/me/education">Pendidikan</a>
                                </li>
                                <li><a class="{{ $layout['active'] == 'user-health' ? 'active' : '' }}"
                                        href="/recruitment/me/health">Kesehatan</a>
                                </li>
                                <li><a class="{{ $layout['active'] == 'user-license' ? 'active' : '' }}"
                                        href="/recruitment/me/license">Lisensi</a>
                                </li>
                                <li><a class="{{ $layout['active'] == 'user-document' ? 'active' : '' }}"
                                        href="/recruitment/me/document">File</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</div>
{{-- @dd(session('dataUser')) --}}
