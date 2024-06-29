@extends('template.admin.main_privilege')

@section('content')
    <div class="the-content">
        <div id="show-employee" class="children-content">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="title">
                                <h4>Profile</h4>
                            </div>

                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/user" onclick=" choosePage('index-employee', null);">Daftar Karyawan</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <text class="index-employee-nik_employee"></text>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                        <div class="pd-5 card-box height-100-p">
                            <div class="profile-photo">
                                <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i
                                        class="fa fa-pencil"></i></a>
                                <img src="/vendors/images/photo4.jpg" alt="" class="avatar-photo" />
                                <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                    aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body pd-5">
                                                <div class="img-container">
                                                    <img id="image" src="/vendors/images/photo4.jpg" alt="Picture" />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" value="Update" class="btn btn-primary" />
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="text-center h5 mb-0" id="index-employee-name">
                                <text class="index-employee-name"></text>
                            </h5>
                            <p class="text-center text-muted font-14">
                                <b id="index-employee-nik_employee"><text class="index-employee-nik_employee"></text></b>
                            </p>
                            <div class="profile-info">
                                <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                                <ul>
                                    <li>
                                        <span>Jabatan:</span>
                                        <text class="index-employee-position">udin</text>
                                    </li>
                                    <li>
                                        <span>Phone Number:</span>
                                        <text class="index-employee-phone_number">tidak ada</text>
                                    </li>
                                    <li>
                                        <span>Kewarganegaraan:</span>
                                        <text class="index-employee-citizenship">tidak ada</text>
                                    </li>
                                    <li>
                                        <span>Address:</span>
                                        <text class="index-employee-kabupaten">tidak ada</text> <br>
                                        <text class="index-employee-desa">tidak ada</text>
                                        {{-- {{ !empty($data->desa) ? $data->desa : 'belum ada' }}<br />
                                        {{ !empty($data->kabupaten) ? $data->kabupaten : 'belum ada' }} --}}
                                    </li>
                                </ul>
                            </div>
                            <div class="profile-social">
                                <h5 class="mb-20 h5 text-blue">File Karyawan</h5>
                                <button onclick="showdoc()" type="button" id="show-file" class="btn"
                                    data-bgcolor="#3b5998" data-color="#ffffff"
                                    style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);">
                                    <i class="icon-copy ion-folder"></i> File Karyawan
                                </button>
                                {{-- @if (session('dataUser')->edit_file_user) --}}
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#createFile">
                                        <i class="icon-copy ion-folder"></i> Edit
                                    </button>
                                {{-- @endif --}}
                            </div>
                          
                        </div>
                    </div>

                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                        <div class=" height-100-p overflow-hidden">
                            <div class="faq-wrap">
                                <h4 class="mb-20 h4 text-blue">Detail Lainnya</h4>
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header">
                                            <button class="btn btn-block" data-toggle="collapse" data-target="#faq1">
                                                TimeLine Hari kerja
                                            </button>
                                        </div>
                                        <div id="faq1" class="collapse show" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="profile-timeline">
                                                    <div class="timeline-month">
                                                        <h5>Hari Kerja</h5>
                                                    </div>
                                                    <div class="profile-timeline-list">
                                                        <ul>
                                                            <li>
                                                                <div class="date">12 Aug</div>
                                                                <div class="task-name">
                                                                    <i class="ion-android-alarm-clock"></i> 56 Hari
                                                                    Berjalan
                                                                </div>
                                                                <p>
                                                                    Anda sudah bekerja selama 56 hari dari 70 hari kerja
                                                                </p>
                                                                <div class="task-time">14 hari menuju Cuti</div>
                                                            </li>
                                                            <li>
                                                                <div class="date">10 Aug</div>
                                                                <div class="task-name mb-30">
                                                                    <i class="ion-ios-chatboxes"></i> 14 hari
                                                                </div>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="timeline-month mt-20">
                                                        <h5>Jadwal Cuti Selanjutnya</h5>
                                                    </div>
                                                    <div class="profile-timeline-list mb-20">
                                                        <ul>
                                                            <li>
                                                                <div class="date">12 July</div>
                                                                <div class="task-name">
                                                                    <i class="ion-android-alarm-clock"></i> 12 okt - 26 okt
                                                                </div>
                                                                <p>
                                                                    Cuti anda selanjutnya mulai 12 okt sampai 26 okt
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <div class="date">10 July</div>
                                                                <div class="task-name">
                                                                    <i class="ion-ios-chatboxes"></i> 26 Okt
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="timeline-month mt-20">
                                                        <h5>Masa Kontrak</h5>
                                                    </div>
                                                    <div class="profile-timeline-list mb-20">
                                                        <ul>
                                                            <li>
                                                                <div class="date">12 July</div>
                                                                <div class="task-name">
                                                                    <i class="ion-android-alarm-clock"></i> 12 okt - 26 okt
                                                                </div>
                                                                <p>
                                                                    Cuti anda selanjutnya mulai 12 okt sampai 26 okt
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <div class="date">10 July</div>
                                                                <div class="task-name">
                                                                    <i class="ion-ios-chatboxes"></i> 26 Okt
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card">
                                        <div class="card-header">
                                            <button class="btn btn-block collapsed " data-toggle="collapse"
                                                data-target="#faq2">
                                                IDENTITAS DIRI
                                            </button>
                                        </div>
                                        <div id="faq2" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="profile-detail">
                                                    <div class="row">
                                                        {{-- @if (session('dataUser')->edit_user_detail) --}}
                                                            <div class="col-md-4 col-sm-12 text-right">
                                                                <a href="/user/detail//edit"
                                                                    class="bg-light-blue btn text-blue weight-500 index-employee-user-detail"><i
                                                                        class="ion-plus-round"></i> Edit perlu nik</a>
                                                            </div>
                                                        {{-- @endif --}}

                                                    </div>
                                                    <div class="profile-info">
                                                        <ul>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Nama Lengkap:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <b class="index-employee-name">tidak ada</b>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Nomor KK/NIK:</span>
                                                                    </div>

                                                                    <div class="col text-right">
                                                                        <b class="index-employee-kk_number">tidak
                                                                            ada</b>/<b
                                                                            class="index-employee-nik_number">tidak
                                                                            ada</b>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Gender:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <b class="index-employee-gender">tidak ada</b>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Agama:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <b class="index-employee-religion">tidak ada</b>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Tempat Lahir:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <b class="index-employee-place_of_birth">tidak
                                                                            ada</b>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Tanggal Lahir:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <b class="index-employee-date_of_birth">tidak
                                                                            ada</b>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Golongan Darah:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <b class="index-employee-blood_group">tidak
                                                                            ada</b>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Status:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <b class="index-employee-status">tidak ada</b>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Nomor Telepon:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <b class="index-employee-phone_number">tidak
                                                                            ada</b>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    {{-- npwp --}}
                                                    <div class="profile-info">
                                                        <ul>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>NPWP:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <b class="index-employee-npwp_number">tidak ada</b>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Rekening BNI:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <b class="index-employee-financial_number">tidak
                                                                            ada</b>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>BPJS Ketenagakerjaan:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <b class="index-employee-bpjs_ketenagakerjaan">tidak
                                                                            ada</b>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>BPJS Kesehatan:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <b class="index-employee-bpjs_kesehatan">tidak
                                                                            ada</b>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="profile-info">
                                                        <div class="row">
                                                            <div class="col-md-8 col-sm-12">
                                                                <h4>Alamat</h4>
                                                            </div>
                                                            {{-- @if (session('dataUser')->edit_user_detail) --}}
                                                                <div class="col-md-4 col-sm-12 text-right">
                                                                    <a href="/user-address/detail/edit"
                                                                        class="bg-light-blue btn text-blue weight-500 index-employee-user-address"><i
                                                                            class="ion-plus-round"></i> Edit</a>
                                                                </div>
                                                            {{-- @endif --}}
                                                        </div>

                                                        <ul>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Desa/Jalan:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-desa">tidak ada</text>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <span>RT/RW:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-rt">tidak ada</text>
                                                                        /<text class="index-employee-rw">tidak ada</text>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Kecamatan:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-kecamatan">tidak
                                                                            ada</text>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <span>Kabupaten:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-kabupaten">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>

                                                            </li>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Provinsi:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-provinsi">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="profile-info">
                                                        <div class="row">
                                                            <div class="col-md-8 col-sm-12">
                                                                <h5>Riwayat Penyakit</h5>
                                                            </div>
                                                            <div class="col-md-4 col-sm-12 text-right">
                                                                <a href="/user-health/detail/edit"
                                                                    class="bg-light-blue btn text-blue weight-500 index-employee-user-health"><i
                                                                        class="ion-plus-round"></i>perlu nik Edit</a>
                                                            </div>
                                                        </div>

                                                        <ul>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Nama Penyakit:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-name_health">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Tahun Sakit:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-year">tidak ada</text>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Tempat Penanganan:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text
                                                                            class="index-employee-health_care_place">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Lama:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-long">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Status Sakit:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-status_health">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <button class="btn btn-block collapsed" data-toggle="collapse"
                                                data-target="#faq3">
                                                IDENTITAS KARYAWAN
                                            </button>
                                        </div>
                                        <div id="faq3" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="profile-detail">
                                                    <div class="row">
                                                        <div class="col-md-8 col-sm-12">
                                                            <h5>Detail Karyawan</h5>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 text-right">
                                                            <a href="/user-employee/detail/edit"
                                                                class="bg-light-blue btn text-blue weight-500 index-employee-create-employee">
                                                                <i class="ion-plus-round"></i>Edit
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="profile-info">
                                                        <h5 class="h5 text-blue">Detail Karyawan</h5>
                                                        <ul>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>NIK Karyawan:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-nik_employee">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Departement:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-department">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Posisi:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-position">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="profile-info">
                                                        <ul>
                                                            <li>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Nomor Kontrak:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text
                                                                            class="index-employee-contract_number_full">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Status Kontrak:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-contract_status">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Lama Kontrak:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-long_contract">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Tanggal Mulai Kontrak:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text
                                                                            class="index-employee-date_start_contract">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Tanggal Berakhir Kontrak:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text
                                                                            class="index-employee-date_end_contract">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Awal Masuk Kerja:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text
                                                                            class="index-employee-date_document_contract">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Status Karyawan:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-employee_status">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <span>Roaster:</span>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <text class="index-employee-roaster_uuid">tidak
                                                                            ada</text>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <button class="btn btn-block collapsed" data-toggle="collapse"
                                                            data-target="#salary-faq">
                                                            Karyawan Salary
                                                        </button>
                                                    </div>
                                                    <div id="salary-faq" class="collapse">
                                                        <div class="card-body">
                                                            <div class="profile-info">
                                                                <ul>
                                                                    <li>
                                                                        <div class="row">
                                                                            <div class="col-auto">
                                                                                <span>Gajih Pokok:</span>
                                                                            </div>
                                                                            <div class="col text-right">
                                                                                Rp. <b class="index-employee-salary">tidak
                                                                                    ada</b>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-auto">
                                                                                <span>Insentif:</span>
                                                                            </div>
                                                                            <div class="col text-right">
                                                                                Rp. <b
                                                                                    class="index-employee-insentif">tidak
                                                                                    ada</b>
                                                                            </div>
                                                                        </div>
                                                                        <div id="list-premi">
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            {{-- @dd($data->employee_salaries) --}}

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Modal Edit File User -->
            {{-- <div id="createFile" class="modal fade">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <form action="" enctype="multipart/form-data" id="upload_file" method="POST">
                            @csrf
                            <input type="hidden" name="purchase_order_uuid" id="purchase_order_uuid" value="">
                            <input type="hidden" name="galery_uuid" id="galery_uuid" value="">
                            <div class="clearfix">
                                <div class="row">
                                    <div class="col-3">
                                        <h4 class="text-blue h4">File</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="karyawan">
                                <div class="row" id="row-people-12">
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label for="">Pilih File</label>
                                            <input type="text" name="nik_employee_file" id="nik_employee_file"
                                                value="{{ $data->nik_employee }}">
                                            <input name="user_file" id="user_file" placeholder="file karyawan"
                                                type="file" class="form-control mb-10">
                                            <div class="invalid-feedback" id="req-user_file">
                                                Masukan File terlebih dahulu
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                            <button onclick="storeFile()" type="button" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- Modal Lihat File User -->
            <div class="modal fade" id="doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Dokumen</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                        </div>
                        <div class="modal-body">
                            <div style="text-align: center;">
                                <iframe id="path_doc" src="" style="width:100%; height:500px;"
                                    frameborder="0"></iframe>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/src/plugins/cropperjs/dist/cropper.js"></script>
    <script>
        window.addEventListener("DOMContentLoaded", function() {
            var image = document.getElementById("image");
            var cropBoxData;
            var canvasData;
            var cropper;

            $("#modal")
                .on("shown.bs.modal", function() {
                    cropper = new Cropper(image, {
                        autoCropArea: 0.5,
                        dragMode: "move",
                        aspectRatio: 3 / 3,
                        restore: false,
                        guides: false,
                        center: false,
                        highlight: false,
                        cropBoxMovable: false,
                        cropBoxResizable: false,
                        toggleDragModeOnDblclick: false,
                        ready: function() {
                            cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                        },
                    });
                })
                .on("hidden.bs.modal", function() {
                    cropBoxData = cropper.getCropBoxData();
                    canvasData = cropper.getCanvasData();
                    cropper.destroy();
                });
        });

        let nik_employee = 'MBLE-0422003';
        // cg('aaa',nik_employee)

        function firstShowEmployee(nik_employee) {
            $('#element-premi').empty();
            Object.values(data_database.data_premis).forEach(premi_element => {
                console.log(premi_element);
                $('#element-premi').append(`<div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Premi ${premi_element.premi_name}</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input id="${premi_element.uuid}" name="${premi_element.uuid}" class="form-control" type="text" placeholder="3559000" />
                                    </div>
                                </div>`)
                $('#list-premi').append(`
            <div class="row">
                <div class="col-auto">
                    <span>Premi ${premi_element.premi_name}:</span>
                </div>
                <div class="col text-right">
                    Rp. <b class="index-employee-${premi_element.uuid}" >tidak ada</b>
                </div>
            </div> 
            `);
            })
            getData(`/user/get/${nik_employee}`).then((dataShows) => {
                let dataShow = dataShows.data;
                cg('udin', dataShow);
                for (var key in dataShow) {
                    if (dataShow[key] != null) {
                        $('.index-employee-' + key).text(dataShow[key])
                    } else {
                        $('.index-employee-' + key + '-hide').hide()
                    }
                }
            });

            // premis.forEach(element => {
            //     $('.index-employee-' + element.uuid).text(employees[element.uuid])
            // });

            // let dataShow = employees[nik_employee]
            // for (var key in dataShow) {
            //     if (dataShow[key] != null) {
            //         $('.index-employee-' + key).text(dataShow[key])
            //     } else {
            //         $('.index-employee-' + key + '-hide').hide()
            //     }
            // }

            // $('.index-employee-user-detail').attr('onclick',
            // `editProfile('create-user-detail','${dataShow.nik_employee}')`);
            // $('.index-employee-user-address').attr('onclick',
            //     `editProfile('create-user-address','${dataShow.nik_employee}')`);
            // $('.index-employee-user-health').attr('onclick',
            // `editProfile('create-user-health','${dataShow.nik_employee}')`);
            // $('.index-employee-create-employee').attr('onclick',
            //     `editProfile('create-user-employee','${dataShow.nik_employee}')`);
            // $('.index-employee-user-dependent').attr('onclick',
            //     `editProfile('create-user-dependent','${dataShow.nik_employee}')`);
            // $('.index-employee-user-license').attr('onclick',
            //     `editProfile('create-user-license','${dataShow.nik_employee}')`);
            // $('.index-employee-user-education').attr('onclick',
            //     `editProfile('create-user-education','${dataShow.nik_employee}')`);

        }

        firstShowEmployee(nik_employee)


        function editProfile(table, nik_employee) {
            $('#isEdit-' + table).val('true');
            choosePage(table, nik_employee);
        }
    </script>
@endsection
