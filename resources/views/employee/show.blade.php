@extends('template.admin.main_privilege')

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Profile</h4>
                        {{-- @dd($data) --}}
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Profile
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
                        <img src="{{ !empty($data->photo_path) ? '/' . $data->photo_path : '/vendors/images/photo4.jpg' }}"
                            alt="" class="avatar-photo" />
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body pd-5">
                                        <div class="img-container">
                                            <img id="image"
                                                src="{{ !empty($data->photo_path) ? '/' . $data->photo_path : '/vendors/images/photo4.jpg' }}"
                                                alt="Picture" />
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
                    <h5 class="text-center h5 mb-0">{{ $data->name }}</h5>
                    <p class="text-center text-muted font-14">
                        <b>{{ $data->nik_employee }}</b>
                    </p>
                    <div class="profile-info">
                        <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                        <ul>
                            <li>
                                <span>Jabatan:</span>
                                {{ $data->position }}
                            </li>
                            <li>
                                <span>Phone Number:</span>
                                {{ !empty($data->phone_number) ? $data->phone_number : 'belum ada' }}
                            </li>
                            <li>
                                <span>Country:</span>
                                America
                            </li>
                            <li>
                                <span>Address:</span>
                                {{ !empty($data->desa) ? $data->desa : 'belum ada' }}<br />
                                {{ !empty($data->kabupaten) ? $data->kabupaten : 'belum ada' }}
                            </li>
                        </ul>
                    </div>
                    <div class="profile-social">
                        <h5 class="mb-20 h5 text-blue">File Karyawan</h5>                       
                            <button onclick="showdoc()" type="button" id="show-file" class="btn" data-bgcolor="#3b5998" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);">
                                <i class="icon-copy ion-folder"></i> File Karyawan
                            </button>
                            @if(session('dataUser')->edit_file_user)
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createFile">
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
                                    <a class="nav-link active" data-toggle="tab" href="#detail" role="tab">Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#background" role="tab">Background</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#karyawan" role="tab">Karyawan</a>
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
                                                    <a href="/user/{{$data->nik_employee}}/edit" 
                                                        class="bg-light-blue btn text-blue weight-500"><i
                                                            class="ion-plus-round"></i> Edit</a>
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
                                                                <b>{{ $data->name }}</b>
                                                            </div>
                                                        </div>
                                                  
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Nomor KK/NIK:</span>
                                                            </div>
                                                           
                                                            <div class="col text-right">
                                                                <b>{{ $data->kk_number }}</b>/<b>{{ $data->nik_number }}</b>
                                                            </div>
                                                        </div>
                                                  
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Gender:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                <b>{{ $data->gender }}</b>
                                                            </div>
                                                        </div>
                                                  
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Agama:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                <b>   {{ !empty($data->user_religion->religion) ? $data->user_religion->religion : 'belum ada' }}</b>
                                                            </div>
                                                        </div>
                                                  
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Tempat Lahir:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                <b>{{ $data->place_of_birth }}</b>
                                                            </div>
                                                        </div>
                                                  
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Tanggal Lahir:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                <b>{{ $data->date_of_birth }}</b>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Golongan Darah:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                <b>{{ $data->blood_group }}</b>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Status:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                <b>{{ $data->status }}</b>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Nomor Telepon:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->phone_number) ? $data->phone_number : 'belum ada' }}
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
                                                                {{ !empty($data->npwp_number) ? $data->npwp_number : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Rekening BNI:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->financial_number) ? $data->financial_number : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>BPJS Ketenagakerjaan:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->bpjs_ketenagakerjaan) ? $data->bpjs_ketenagakerjaan : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>BPJS Kesehatan:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->bpjs_kesehatan) ? $data->bpjs_kesehatan : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                    </li>                                          
                                                </ul>
                                            </div>
                                            <div class="profile-info">
                                                <h4>Alamat</h4>
                                                <ul>
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Desa/Jalan:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->desa) ? $data->desa : 'belum ada' }}
                                                            </div>
                                                            <div class="col-auto">
                                                            </div>
                                                            <div class="col-auto">
                                                                <span>RT/RW:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->rt) ? $data->rt : '-' }}/{{ !empty($data->rw) ? $data->rw : '-' }}
                                                            </div>
                                                        </div>
                                                    </li> 
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Kecamatan:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->kecamatan) ? $data->kecamatan : 'belum ada' }}
                                                            </div>
                                                            <div class="col-auto">
                                                                <span>Kabupaten:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->kabupaten) ? $data->kabupaten : 'belum ada' }}
                                                            </div>
                                                        </div>

                                                    </li>   
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Provinsi:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->provinsi) ? $data->provinsi : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                    </li>                                             
                                                </ul>
                                            </div>
                                            {{-- kesehatan --}}
                                            <div class="profile-info">
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-12">
                                                        <h5>Riwayat Penyakit</h5>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 text-right">
                                                        <a href="/user-health/{{$data->nik_employee}}/edit"
                                                            class="bg-light-blue btn text-blue weight-500"><i
                                                                class="ion-plus-round"></i> Edit</a>
                                                    </div>
                                                </div>
                                            @if (!empty($data->user_healths->name_health))                                          
                                                <ul>
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Nama Penyakit:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->user_healths->name_health) ? $data->user_healths->name_health : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                        <div class="row">                                                            
                                                            <div class="col-auto">
                                                                <span>Tahun Sakit:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->user_healths->year) ? $data->user_healths->year : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Tempat Penanganan:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->user_healths->health_care_place) ? $data->user_healths->health_care_place : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Lama:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->user_healths->long_health) ? $data->user_healths->long_health.' bulan' : 'belum ada' }} 
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Status Sakit:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->user_healths->status_health) ? $data->user_healths->status_health : 'belum ada' }} 
                                                            </div>
                                                        </div>
                                                    </li>                                          
                                                </ul>      
                                            @else
                                            <div class="pd-10">                    
                                                <dl class="row">
                                                    <dt class="col-sm-3">Tidak Ada</dt>
                                                </dl>
                                            </div>
                                            @endif
                                            
                                        </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <!-- karyawan Tab End -->
                                <!-- karyawan Tab start -->
                                <div class="tab-pane fade" id="karyawan" role="tabpanel">
                                    <div class="pd-20">
                                        <div class="profile-detail">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-12">
                                                    <h5>Detail Karyawan</h5>
                                                </div>
                                                <div class="col-md-4 col-sm-12 text-right">
                                                    <a href="/user-employee/{{$data->nik_employee}}/edit" class="bg-light-blue btn text-blue weight-500">
                                                        <i class="ion-plus-round"></i> Edit
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
                                                                {{ !empty($data->nik_employee) ? $data->nik_employee : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                    </li>  
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Departement:</span>
                                                            </div>                                                           
                                                            <div class="col text-right">
                                                                {{ !empty($data->department) ? $data->department : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                    </li>          
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Posisi:</span>
                                                            </div>                                                           
                                                            <div class="col text-right">
                                                                {{ !empty($data->position) ? $data->position : 'belum ada' }}
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
                                                                {{ !empty($data->contract_number) ? $data->contract_number : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Status Kontrak:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->contract_status) ? $data->contract_status : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Lama Kontrak:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->long_contract) ? $data->long_contract : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Tanggal Mulai Kontrak:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->date_start_contract) ? $data->date_start_contract : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Tanggal Berakhir Kontrak:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->date_end_contract) ? $data->date_end_contract : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Tanggal Dokumen Kontrak:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->date_document_contract) ? $data->date_document_contract : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Status Karyawan:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->employee_status) ? $data->employee_status : 'belum ada' }}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Roaster:</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                {{ !empty($data->roaster) ? $data->employee_status : 'belum ada' }}
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
                                                        <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq2">
                                                            Karyawan Salary
                                                        </button>
                                                    </div>
                                                    <div id="faq2" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="profile-info">
                                                                <ul>
                                                                    <li>
                                                                        <div class="row">
                                                                            <div class="col-auto">
                                                                                <span>Gajih Pokok:</span>
                                                                            </div>
                                                                            <div class="col text-right">
                                                                                {{ !empty($data->employee_salaries->salary) ? 'Rp. '.$data->employee_salaries->salary : 'belum ada' }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-auto">
                                                                                <span>Insentif:</span>
                                                                            </div>
                                                                            <div class="col text-right">
                                                                                {{ !empty($data->employee_salaries->insentif) ? 'Rp. '.$data->employee_salaries->insentif : 'belum ada' }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-auto">
                                                                                <span>Premi BK:</span>
                                                                            </div>
                                                                            <div class="col text-right">
                                                                                {{ !empty($data->employee_salaries->premi_bk) ? 'Rp. '.$data->employee_salaries->premi_bk : 'belum ada' }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-auto">
                                                                                <span>Premi nbk:</span>
                                                                            </div>
                                                                            <div class="col text-right">
                                                                                {{ !empty($data->employee_salaries->premi_nbk) ? 'Rp. '.$data->employee_salaries->premi_nbk : 'belum ada' }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-auto">
                                                                                <span>Premi kayu:</span>
                                                                            </div>
                                                                            <div class="col text-right">
                                                                                {{ !empty($data->employee_salaries->premi_kayu) ? 'Rp. '.$data->employee_salaries->premi_kayu : 'belum ada' }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-auto">
                                                                                <span>Premi MB:</span>
                                                                            </div>
                                                                            <div class="col text-right">
                                                                                {{ !empty($data->employee_salaries->premi_mb) ? 'Rp. '.$data->employee_salaries->premi_mb : 'belum ada' }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-auto">
                                                                                <span>Premi RJ:</span>
                                                                            </div>
                                                                            <div class="col text-right">
                                                                                {{ !empty($data->employee_salaries->premi_rj) ? 'Rp. '.$data->employee_salaries->premi_rj : 'belum ada' }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-auto">
                                                                                <span>Insentif HM:</span>
                                                                            </div>
                                                                            <div class="col text-right">
                                                                                {{ !empty($data->employee_salaries->insentif_hm) ? 'Rp. '.$data->employee_salaries->insentif_hm : 'belum ada' }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-auto">
                                                                                <span>Deposit HM:</span>
                                                                            </div>
                                                                            <div class="col text-right">
                                                                                {{ !empty($data->employee_salaries->deposit_hm) ? 'Rp. '.$data->employee_salaries->deposit_hm : 'belum ada' }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-auto">
                                                                                <span>Tonase:</span>
                                                                            </div>
                                                                            <div class="col text-right">
                                                                                {{ !empty($data->employee_salaries->tonase) ? 'Rp. '.$data->employee_salaries->tonase : 'belum ada' }}
                                                                            </div>
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
                                <!-- karyawan Tab End -->
                                <!-- background Tab start -->
                                <div class="tab-pane fade" id="background" role="tabpanel">                                   
                                    <div class="profile-detail">
                                        <div class="col-lg-12 col-md-12 mb-2">
                                            <div class="pd-5 card-box">
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-12">
                                                        <h5>Keluarga</h5>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 text-right">
                                                        <a href="/user-dependent/{{$data->nik_employee}}/edit"
                                                            class="bg-light-blue btn text-blue weight-500"><i
                                                                class="ion-plus-round"></i> Edit</a>
                                                    </div>
                                                </div>
                                                <div class="tab">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        
                                                        @if(!empty($data->user_dependents->father_name))
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue active" data-toggle="tab" href="#father" role="tab"
                                                                    aria-selected="false">Ayah</a>
                                                            </li>
                                                        @endif
                                                        {{-- @dd($data) --}}
                                                        @if(!empty($data->user_dependents->mother_name))
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#mother" role="tab"
                                                                    aria-selected="false">Ibu</a>
                                                            </li>
                                                        @endif
                                                        @if(!empty($data->user_dependents->couple_name))
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#couple" role="tab"
                                                                    aria-selected="false">Pasangan</a>
                                                            </li>
                                                        @endif
                                                        @if(!empty($data->user_dependents->mother_in_law_name))
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#mother_in_law" role="tab"
                                                                    aria-selected="false">Ibu Mertua</a>
                                                            </li>
                                                        @endif
                                                        @if(!empty($data->user_dependents->father_in_law_name))
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#father_in_law" role="tab"
                                                                    aria-selected="false">Ayah Mertua</a>
                                                            </li>
                                                        @endif
                                                        @if(!empty($data->user_dependents->child1_name))
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#child1" role="tab"
                                                                    aria-selected="false">Anak ke 1</a>
                                                            </li>
                                                        @endif
                                                        @if(!empty($data->user_dependents->child2_name))
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#child2" role="tab"
                                                                    aria-selected="false">Anak ke 2</a>
                                                            </li>
                                                        @endif
                                                        @if(!empty($data->user_dependents->child3_name))
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#child3" role="tab"
                                                                    aria-selected="false">Anak ke 3</a>
                                                            </li>
                                                        @endif
                                                        
                                                    </ul>
                                                    <div class="tab-content">
                                                     
                                                        @if(!empty($data->user_dependents->father_name))                                
                                                        <div class="tab-pane fade show active" id="father" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nama</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->father_name}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->father_gender}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3">Tempat Lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        <p>
                                                                            {{$data->user_dependents->father_place_birth}}
                                                                        </p>
                                                                    </dd>                                        
                                                                    <dt class="col-sm-3">Tanggal lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->father_date_birth}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3 text-truncate">
                                                                        Pendidikan Terakhir
                                                                    </dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->father_education}}
                                                                    </dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!empty($data->user_dependents->father_in_law_name))                                
                                                        <div class="tab-pane fade" id="father_in_law" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nama</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->father_in_law_name}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->father_in_law_gender}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3">Tempat Lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        <p>
                                                                            {{$data->user_dependents->father_in_law_place_birth}}
                                                                        </p>
                                                                    </dd>                                        
                                                                    <dt class="col-sm-3">Tanggal lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->father_in_law_date_birth}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3 text-truncate">
                                                                        Pendidikan Terakhir
                                                                    </dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->father_in_law_education}}
                                                                    </dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!empty($data->user_dependents->mother_in_law_name))                                
                                                        <div class="tab-pane fade" id="mother_in_law" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nama</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->mother_in_law_name}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->mother_in_law_gender}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3">Tempat Lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        <p>
                                                                            {{$data->user_dependents->mother_in_law_place_birth}}
                                                                        </p>
                                                                    </dd>                                        
                                                                    <dt class="col-sm-3">Tanggal lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->mother_in_law_date_birth}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3 text-truncate">
                                                                        Pendidikan Terakhir
                                                                    </dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->mother_in_law_education}}
                                                                    </dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!empty($data->user_dependents->couple_name))                                
                                                        <div class="tab-pane fade" id="couple" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nama</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->couple_name}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->couple_gender}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3">Tempat Lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        <p>
                                                                            {{$data->user_dependents->couple_place_birth}}
                                                                        </p>
                                                                    </dd>                                        
                                                                    <dt class="col-sm-3">Tanggal lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->couple_date_birth}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3 text-truncate">
                                                                        Pendidikan Terakhir
                                                                    </dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->couple_education}}
                                                                    </dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!empty($data->user_dependents->child1_name))                                
                                                        <div class="tab-pane fade" id="child1" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nama</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->child1_name}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->child1_gender}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3">Tempat Lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        <p>
                                                                            {{$data->user_dependents->child1_place_birth}}
                                                                        </p>
                                                                    </dd>                                        
                                                                    <dt class="col-sm-3">Tanggal lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->child1_date_birth}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3 text-truncate">
                                                                        Pendidikan Terakhir
                                                                    </dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->child1_education}}
                                                                    </dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!empty($data->user_dependents->child2_name))                                
                                                        <div class="tab-pane fade" id="child2" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nama</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->child2_name}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->child2_gender}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3">Tempat Lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        <p>
                                                                            {{$data->user_dependents->child2_place_birth}}
                                                                        </p>
                                                                    </dd>                                        
                                                                    <dt class="col-sm-3">Tanggal lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->child2_date_birth}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3 text-truncate">
                                                                        Pendidikan Terakhir
                                                                    </dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->child2_education}}
                                                                    </dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!empty($data->user_dependents->child3_name))                                
                                                        <div class="tab-pane fade" id="child3" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nama</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->child3_name}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->child3_gender}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3">Tempat Lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        <p>
                                                                            {{$data->user_dependents->child3_place_birth}}
                                                                        </p>
                                                                    </dd>                                        
                                                                    <dt class="col-sm-3">Tanggal lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->child3_date_birth}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3 text-truncate">
                                                                        Pendidikan Terakhir
                                                                    </dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->child3_education}}
                                                                    </dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!empty($data->user_dependents->mother_name))                                
                                                        <div class="tab-pane fade" id="mother" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nama</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->mother_name}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Jenis Kelamin</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->mother_gender}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3">Tempat Lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        <p>
                                                                            {{$data->user_dependents->mother_place_birth}}
                                                                        </p>
                                                                    </dd>                                        
                                                                    <dt class="col-sm-3">Tanggal lahir</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->mother_date_birth}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3 text-truncate">
                                                                        Pendidikan Terakhir
                                                                    </dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_dependents->mother_education}}
                                                                    </dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
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
                                                        {{-- @dd($data) --}}
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 text-right">
                                                        <a href="/user-education/{{$data->nik_employee}}/edit" 
                                                            class="bg-light-blue btn text-blue weight-500"><i
                                                                class="ion-plus-round"></i> Edit</a>
                                                    </div>
                                                </div>
                                                <div class="tab">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        
                                                        @if(!empty($data->user_education->sd_name))
                                                            <li class="nav-item ">
                                                                <a class="nav-link text-blue active" data-toggle="tab" href="#sd" role="tab"
                                                                    aria-selected="false">Sekolah Dasar</a>
                                                            </li>
                                                        @endif
                                                        {{-- @dd($data) --}}
                                                        @if(!empty($data->user_education->smp_name))
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#smp" role="tab"
                                                                    aria-selected="false">SMP</a>
                                                            </li>
                                                        @endif
                                                        @if(!empty($data->user_education->sma_name))
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#sma" role="tab"
                                                                    aria-selected="false">SMA</a>
                                                            </li>
                                                        @endif
                                                        @if(!empty($data->user_education->ptn_name))
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#ptn" role="tab"
                                                                    aria-selected="false">PTN</a>
                                                            </li>
                                                        @endif
                                                        @if(!empty($data->user_education->dll_name))
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#dll" role="tab"
                                                                    aria-selected="false">dll</a>
                                                            </li>
                                                        @endif
                                                        
                                                    </ul>
                                                    <div class="tab-content">
                                                        @if(!empty($data->user_education->sd_name))                                
                                                        <div class="tab-pane fade show active" id="sd" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nama Sekolah</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_education->sd_name}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Alamat Sekolah</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_education->sd_place}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3">Tahun Lulus</dt>
                                                                    <dd class="col-sm-9">
                                                                        <p>
                                                                            {{$data->user_education->sd_year}}
                                                                        </p>
                                                                    </dd>                                        
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!empty($data->user_education->smp_name))                                
                                                        <div class="tab-pane fade" id="smp" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nama Sekolah</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_education->smp_name}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Alamat Sekolah</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_education->smp_place}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3">Tahun Lulus</dt>
                                                                    <dd class="col-sm-9">
                                                                        <p>
                                                                            {{$data->user_education->smp_year}}
                                                                        </p>
                                                                    </dd>                                        
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!empty($data->user_education->sma_name))                                
                                                        <div class="tab-pane fade" id="sma" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nama Sekolah</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_education->sma_name}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Alamat Sekolah</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_education->sma_place}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Jurusan</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_education->sma_jurusan}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3">Tahun Lulus</dt>
                                                                    <dd class="col-sm-9">
                                                                        <p>
                                                                            {{$data->user_education->sma_year}}
                                                                        </p>
                                                                    </dd>                                        
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!empty($data->user_education->ptn_name))                                
                                                        <div class="tab-pane fade" id="ptn" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nama Sekolah</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_education->ptn_name}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Alamat Sekolah</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_education->ptn_place}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Jurusan</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_education->ptn_jurusan}}
                                                                    </dd>
                                        
                                                                    <dt class="col-sm-3">Tahun Lulus</dt>
                                                                    <dd class="col-sm-9">
                                                                        <p>
                                                                            {{$data->user_education->ptn_year}}
                                                                        </p>
                                                                    </dd>                                        
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                         
                                         {{-- licence --}}
                                         <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                            <div class="pd-5 card-box">
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-12">
                                                        <h5>License</h5>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 text-right">
                                                        <a href="/user-license/{{$data->nik_employee}}/edit"
                                                            class="bg-light-blue btn text-blue weight-500"><i
                                                                class="ion-plus-round"></i> Edit</a>
                                                    </div>
                                                </div>
                                                <div class="tab">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        
                                                       
                                                            <li class="nav-item ">
                                                                <a class="nav-link text-blue active" data-toggle="tab" href="#sim_a" role="tab"
                                                                    aria-selected="false">SIM A</a>
                                                            </li>
                                                    
                                                        @if(!empty($data->user_licenses->sim_b1))
                                                            <li class="nav-item ">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#sim_b1" role="tab"
                                                                    aria-selected="false">SIM B1</a>
                                                            </li>
                                                        @endif        
                                                        @if(!empty($data->user_licenses->sim_b1_umum))
                                                            <li class="nav-item ">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#sim_b1_umum" role="tab"
                                                                    aria-selected="false">SIM B1 UMUM</a>
                                                            </li>
                                                        @endif     
                                                        @if(!empty($data->user_licenses->sim_b2))
                                                            <li class="nav-item ">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#sim_b2" role="tab"
                                                                    aria-selected="false">SIM B2</a>
                                                            </li>
                                                        @endif     
                                                        @if(!empty($data->user_licenses->sim_b2_umum))
                                                            <li class="nav-item ">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#sim_b2_umum" role="tab"
                                                                    aria-selected="false">SIM B2 UMUM</a>
                                                            </li>
                                                        @endif     
                                                        @if(!empty($data->user_licenses->sim_c))
                                                            <li class="nav-item ">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#sim_c" role="tab"
                                                                    aria-selected="false">SIM C</a>
                                                            </li>
                                                        @endif     
                                                        @if(!empty($data->user_licenses->sim_d))
                                                            <li class="nav-item ">
                                                                <a class="nav-link text-blue" data-toggle="tab" href="#sim_d" role="tab"
                                                                    aria-selected="false">SIM D</a>
                                                            </li>
                                                        @endif     

                                                        
                                                    </ul>
                                                    <div class="tab-content">
                                                                             
                                                        <div class="tab-pane fade show active" id="sim_a" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    @if(!empty($data->user_licenses->sim_a))       
                                                                    <dt class="col-sm-3">Nomor Sim</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_licenses->sim_a}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Tanggal Berakhir</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_licenses->date_end_sim_a}}
                                                                    </dd>  
                                                                    @else
                                                                    <dt class="col-sm-3">Tidak Ada</dt>
                                                                    @endif                                      
                                                                </dl>
                                                            </div>
                                                        </div>
                                                    
                                                        @if(!empty($data->user_licenses->sim_b1))                                
                                                        <div class="tab-pane fade show" id="sim_b1" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nomor Sim</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_licenses->sim_b1}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Tanggal Berakhir</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_licenses->date_end_sim_b1}}
                                                                    </dd>                                         
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!empty($data->user_licenses->sim_b1_umum))                                
                                                        <div class="tab-pane fade show" id="sim_b1_umum" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nomor Sim</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_licenses->sim_b1_umum}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Tanggal Berakhir</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_licenses->date_end_sim_b1_umum}}
                                                                    </dd>                                         
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!empty($data->user_licenses->sim_b2))                                
                                                        <div class="tab-pane fade show" id="sim_b2" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nomor Sim</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_licenses->sim_b2}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Tanggal Berakhir</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_licenses->date_end_sim_b2}}
                                                                    </dd>                                         
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!empty($data->user_licenses->sim_b2_umum))                                
                                                        <div class="tab-pane fade show" id="sim_b2_umum" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nomor Sim</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_licenses->sim_b2_umum}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Tanggal Berakhir</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_licenses->date_end_sim_b2_umum}}
                                                                    </dd>                                         
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!empty($data->user_licenses->sim_c))                                
                                                        <div class="tab-pane fade show" id="sim_c" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nomor Sim</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_licenses->sim_c}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Tanggal Berakhir</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_licenses->date_end_sim_c}}
                                                                    </dd>                                         
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(!empty($data->user_licenses->sim_d))                                
                                                        <div class="tab-pane fade show" id="sim_d" role="tabpanel">
                                                            <div class="pd-10">                    
                                                                <dl class="row">
                                                                    <dt class="col-sm-3">Nomor Sim</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_licenses->sim_d}}
                                                                    </dd>
                                                                    <dt class="col-sm-3">Tanggal Berakhir</dt>
                                                                    <dd class="col-sm-9">
                                                                        {{$data->user_licenses->date_end_sim_d}}
                                                                    </dd>                                         
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        @endif
                                                       
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>                                    
                                </div>
                                <!-- background Tab End -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


     <!-- Modal Edit File User -->
     <div id="createFile" class="modal fade">
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
                                        <input type="text" name="nik_employee_file" id="nik_employee_file" value="{{$data->nik_employee}}">
                                        <input  name="user_file" id="user_file"
                                            placeholder="file karyawan" type="file" class="form-control mb-10">
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
    </div>
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
        function showdoc(path) {
           
            if(@json($data->file_path) == null){
                console.log(@json($data))
                alertModal();
            }else{
                let src_file = $('#path_doc').attr("src","{{  env('APP_URL').'file/user/'.$data->file_path}}");
                console.log(src_file);
                $('#doc').modal('show');
            }           
        }


        function storeFile() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/user-file/store";
           
            var form = $('#upload_file')[0];
            
            var form_data = new FormData(form);
            console.log('form_data');
            console.log(form_data);
            $.ajax({
                url: _url,
                type: "POST",

                //   dataType    : 'json',
                contentType: false,
                processData: false,
                data: form_data,
                success: function(response) {
                    data = response.data
                    console.log(data)
                   
                    $('#success-modal').modal('show')
                    console.log(data);
                },
                error: function(response) {
                    alertModal()
                    console.log(response)
                }
            });
            
            
        }
    </script>
@endsection
@section('js_ready')
let data = @json($data);
console.log(data);
@endsection
