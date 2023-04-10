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
                                    <li  class="breadcrumb-item">
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
                                @if (session('dataUser')->edit_file_user)
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#createFile">
                                        <i class="icon-copy ion-folder"></i> Edit
                                    </button>
                                @endif
                            </div>
                            <div class="profile-skills">
                                <h5 class="mb-20 h5 text-blue">Key Skills</h5>
                                <h6 class="mb-5 font-14">HTML</h6>
                                <div class="progress mb-20" style="height: 6px">
                                    <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h6 class="mb-5 font-14">Css</h6>
                                <div class="progress mb-20" style="height: 6px">
                                    <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h6 class="mb-5 font-14">jQuery</h6>
                                <div class="progress mb-20" style="height: 6px">
                                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h6 class="mb-5 font-14">Bootstrap</h6>
                                <div class="progress mb-20" style="height: 6px">
                                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @dd($data) --}}
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                        <div class="card-box height-100-p overflow-hidden">
                            <div class="profile-tab height-100-p">
                                <div class="tab height-100-p">
                                    <ul class="nav nav-tabs customtab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#detail"
                                                role="tab">Detail</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#background"
                                                role="tab">Background</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#karyawan"
                                                role="tab">Karyawan</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <!-- karyawan Tab start -->
                                        <div class="tab-pane fade show active" id="detail" role="tabpanel">
                                            <div class="pd-20">
                                                <div class="profile-detail">
                                                    <div class="row">
                                                        <div class="col-md-8 col-sm-12">
                                                            <h5>Detail Profile</h5>
                                                        </div>
                                                        @if (session('dataUser')->edit_user_detail)
                                                            <div class="col-md-4 col-sm-12 text-right">
                                                                <a href="/user/detail/{{ $nik_employee }}/edit"
                                                                    class="bg-light-blue btn text-blue weight-500 index-employee-user-detail"><i
                                                                        class="ion-plus-round"></i> Edit perlu nik</a>
                                                            </div>
                                                        @endif

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
                                                            @if (session('dataUser')->edit_user_detail)
                                                                <div class="col-md-4 col-sm-12 text-right">
                                                                    <a href="/user-address/detail/{{ $nik_employee }}/edit"
                                                                        class="bg-light-blue btn text-blue weight-500 index-employee-user-address"><i
                                                                            class="ion-plus-round"></i> Edit</a>
                                                                </div>
                                                            @endif
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
                                                                <a href="/user-health/detail/{{ $nik_employee }}/edit"
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
                                        <div class="tab-pane fade" id="karyawan" role="tabpanel">
                                            <div class="pd-20">
                                                <div class="profile-detail">
                                                    <div class="row">
                                                        <div class="col-md-8 col-sm-12">
                                                            <h5>Detail Karyawan</h5>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 text-right">
                                                            <a href="/user-employee/detail/{{ $nik_employee }}/edit"
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
                                                <div class="faq-wrap">
                                                    <div id="accordion">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <button class="btn btn-block collapsed"
                                                                    data-toggle="collapse" data-target="#faq2">
                                                                    Karyawan Salary
                                                                </button>
                                                            </div>
                                                            <div id="faq2" class="collapse"
                                                                data-parent="#accordion">
                                                                <div class="card-body">
                                                                    <div class="profile-info">
                                                                        <ul>
                                                                            <li>
                                                                                <div class="row">
                                                                                    <div class="col-auto">
                                                                                        <span>Gajih Pokok:</span>
                                                                                    </div>
                                                                                    <div class="col text-right">
                                                                                        Rp. <b
                                                                                            class="index-employee-salary">tidak
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
                                        <div class="tab-pane fade" id="background" role="tabpanel">
                                            <div class="profile-detail">
                                                <div class="col-lg-12 col-md-12 mb-2">
                                                    <div class="pd-5 card-box">
                                                        <div class="row">
                                                            <div class="col-md-8 col-sm-12">
                                                                <h5>Keluarga</h5>
                                                            </div>
                                                            <div class="col-md-4 col-sm-12 text-right">
                                                                <a href="/user-dependent/detail/{{ $nik_employee }}/edit"
                                                                    class="bg-light-blue btn text-blue weight-500 index-employee-user-dependent"><i
                                                                        class="ion-plus-round"></i>Edit</a>
                                                            </div>
                                                        </div>
                                                        <div class="tab">
                                                            <ul class="nav nav-tabs" role="tablist">

                                                                <li class="nav-item index-employee-father_name-hide">
                                                                    <a class="nav-link text-blue active" data-toggle="tab"
                                                                        href="#father" role="tab"
                                                                        aria-selected="false">Ayah</a>
                                                                </li>
                                                                <li class="nav-item index-employee-mother_name-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#mother" role="tab"
                                                                        aria-selected="false">Ibu</a>
                                                                </li>
                                                                <li class="nav-item index-employee-couple_name-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#couple" role="tab"
                                                                        aria-selected="false">Pasangan</a>
                                                                </li>

                                                                <li
                                                                    class="nav-item index-employee-mother_in_law_name-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#mother_in_law" role="tab"
                                                                        aria-selected="false">Ibu Mertua</a>
                                                                </li>
                                                                <li
                                                                    class="nav-item index-employee-father_in_law_name-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#father_in_law" role="tab"
                                                                        aria-selected="false">Ayah Mertua</a>
                                                                </li>
                                                                <li class="nav-item index-employee-child1_name-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#child1" role="tab"
                                                                        aria-selected="false">Anak 1</a>
                                                                </li>
                                                                <li class="nav-item index-employee-child2_name-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#child2" role="tab"
                                                                        aria-selected="false">Anak 2</a>
                                                                </li>
                                                                <li class="nav-item index-employee-child3_name-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#child3" role="tab"
                                                                        aria-selected="false">Anak 3</a>
                                                                </li>

                                                            </ul>
                                                            <div class="tab-content">

                                                                <div class="tab-pane fade show active" id="father"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nama</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-father_name">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-father_gender">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tempat Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-father_place_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tgl. Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-father_date_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Pendidikan</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-father_education">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane fade " id="mother"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nama</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-mother_name">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-mother_gender">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tempat Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-mother_place_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tgl. Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-mother_date_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Pendidikan</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-mother_education">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane fade" id="couple"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nama</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-couple_name">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-couple_gender">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tempat Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-couple_place_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tgl. Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-couple_date_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Pendidikan</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-couple_education">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane fade" id="mother_in_law"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nama</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-mother_in_law_name">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-mother_in_law_gender">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tempat Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-mother_in_law_place_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tgl. Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-mother_in_law_date_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Pendidikan</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-mother_in_law_education">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane fade" id="father_in_law"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nama</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-father_in_law_name">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-father_in_law_gender">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tempat Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-father_in_law_place_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tgl. Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-father_in_law_date_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Pendidikan</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-father_in_law_education">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane fade" id="child1"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nama</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-child1_name">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-child1_gender">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tempat Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-child1_place_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tgl. Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-child1_date_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Pendidikan</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-child1_education">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane fade" id="child2"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nama</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-child2_name">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-child2_gender">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tempat Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-child2_place_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tgl. Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-child2_date_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Pendidikan</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-child2_education">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane fade" id="child3"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nama</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-child3_name">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-child3_gender">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tempat Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-child3_place_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Tgl. Lahir</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-child3_date_birth">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Pendidikan</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-child3_education">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- education --}}
                                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                                    <div class="pd-5 card-box">
                                                        <div class="row">
                                                            <div class="col-md-8 col-sm-12">
                                                                <h5>Pendidikan</h5>
                                                            </div>
                                                            <div class="col-md-4 col-sm-12 text-right">
                                                                <a href="/user-education/detail/{{ $nik_employee }}/edit"
                                                                    class="bg-light-blue btn text-blue weight-500 index-employee-user-education"><i
                                                                        class="ion-plus-round"></i>Edit</a>
                                                            </div>
                                                        </div>
                                                        <div class="tab">
                                                            <ul class="nav nav-tabs" role="tablist">
                                                                <li class="nav-item ">
                                                                    <a class="nav-link text-blue active" data-toggle="tab"
                                                                        href="#sd" role="tab"
                                                                        aria-selected="false">Sekolah
                                                                        Dasar</a>
                                                                </li>
                                                                <li class="nav-item  index-employee-smp_name-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#smp" role="tab"
                                                                        aria-selected="false">SMP</a>
                                                                </li>
                                                                <li class="nav-item  index-employee-sma_name-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#sma" role="tab"
                                                                        aria-selected="false">SMA</a>
                                                                </li>
                                                                <li class="nav-item  index-employee-ptn_name-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#ptn" role="tab"
                                                                        aria-selected="false">PTN</a>
                                                                </li>
                                                                <li class="nav-item  index-employee-dll_name-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#dll" role="tab"
                                                                        aria-selected="false">Dll</a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade show active" id="sd"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nama Sekolah</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-sd_name">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Alamat Sekolah</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-sd_place">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Tahun Lulus</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-sd_year">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="smp"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nama Sekolah</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-smp_name">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Alamat Sekolah</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-smp_place">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Tahun Lulus</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-smp_year">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="sma"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nama Sekolah</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-sma_name">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Alamat Sekolah</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-sma_place">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Tahun Lulus</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-sma_year">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="ptn"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nama Sekolah</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-ptn_name">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Alamat Sekolah</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-ptn_place">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Tahun Lulus</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-ptn_year">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="dll"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nama Sekolah</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-dll_name">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Alamat Sekolah</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-dll_place">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Tahun Lulus</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-dll_year">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- license --}}
                                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                                    <div class="pd-5 card-box">
                                                        <div class="row">
                                                            <div class="col-md-8 col-sm-12">
                                                                <h5>Lisensi</h5>
                                                            </div>
                                                            <div class="col-md-4 col-sm-12 text-right">
                                                                <a href="/user-license/detail/{{ $nik_employee }}/edit"
                                                                    class="bg-light-blue btn text-blue weight-500 index-employee-user-dependent"><i
                                                                        class="ion-plus-round"></i>Edit</a>
                                                            </div>
                                                        </div>
                                                        <div class="tab">
                                                            <ul class="nav nav-tabs" role="tablist">
                                                                <li class="nav-item ">
                                                                    <a class="nav-link text-blue active" data-toggle="tab"
                                                                        href="#sim_a" role="tab"
                                                                        aria-selected="false">Sim A</a>
                                                                </li>
                                                                <li class="nav-item index-employee-sim_b1-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#sim_b1" role="tab"
                                                                        aria-selected="false">Sim B1</a>
                                                                </li>
                                                                <li class="nav-item index-employee-sim_b2-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#sim_b2" role="tab"
                                                                        aria-selected="false">Sim B2</a>
                                                                </li>
                                                                <li class="nav-item index-employee-sim_c-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#sim_c" role="tab"
                                                                        aria-selected="false">Sim C</a>
                                                                </li>
                                                                <li class="nav-item index-employee-sim_d-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#sim_d" role="tab"
                                                                        aria-selected="false">Sim D</a>
                                                                </li>
                                                                <li class="nav-item index-employee-sim_a_umum-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#sim_a_umum" role="tab"
                                                                        aria-selected="false">Sim A Umum</a>
                                                                </li>
                                                                <li class="nav-item index-employee-sim_b1_umum-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#sim_b1_umum" role="tab"
                                                                        aria-selected="false">Sim B1 Umum</a>
                                                                </li>
                                                                <li class="nav-item index-employee-sim_b2_umum-hide">
                                                                    <a class="nav-link text-blue" data-toggle="tab"
                                                                        href="#sim_b2_umum" role="tab"
                                                                        aria-selected="false">Sim B2 Umum</a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade show active" id="sim_a"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nomor Sim</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-sim_a">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Masa Berlaku</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-date_end_sim_a">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade" id="sim_b"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nomor Sim</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-sim_b">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Masa Berlaku</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-date_end_sim_b">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade" id="sim_b1"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nomor Sim</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-sim_b1">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Masa Berlaku</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-date_end_sim_b1">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade" id="sim_b2"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nomor Sim</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-sim_b2">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Masa Berlaku</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-date_end_sim_b2">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade" id="sim_c"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nomor Sim</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-sim_c">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Masa Berlaku</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-date_end_sim_c">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade" id="sim_d"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nomor Sim</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text class="index-employee-sim_d">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Masa Berlaku</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-date_end_sim_d">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade" id="sim_b1_umum"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nomor Sim</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-sim_b1_umum">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Masa Berlaku</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-date_end_sim_b1_umum">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade" id="sim_b2_umum"
                                                                    role="tabpanel">
                                                                    <div class="pd-10">
                                                                        <dl class="row">
                                                                            <dt class="col-sm-3">Nomor Sim</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-sim_b2_umum">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                            <dt class="col-sm-3">Masa Berlaku</dt>
                                                                            <dd class="col-sm-9">
                                                                                <text
                                                                                    class="index-employee-date_end_sim_b2_umum">tidak
                                                                                    ada</text>
                                                                            </dd>
                                                                        </dl>
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

        let nik_employee = @json($nik_employee);
        // cg('aaa',nik_employee)

        function firstShowEmployee(nik_employee) {
            let premis = @json($premis);
            $('#element-premi').empty();
            premis.forEach(premi_element => {
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
