@extends('template.admin.main_privilege')

@section('content')
    <div class="row">
        <div class="col-12 card-box mb-20">
            <div class="row pd-20">
                <div class="col-auto">
                    <h4 class="text-blue h4">Daftar Pelamar</h4>
                </div>
                <div class="col text-right">
                    <div class="btn-group">

                        <div class="btn-group dropdown">
                            <button type="button" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown"
                                aria-expanded="false">
                                Menu <span class="caret"></span>
                            </button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" id="btn-export" href="/database/recruitment/export">Export</a>
                                <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                    href="">Import</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <table id="table-recruitment" class="display nowrap stripe hover table mb-20" style="width:100%">
                <thead>
                    <tr>
                        <th>Pelamar</th>
                        <th>Posisi</th>
                        <th>Jenis Lamaran</th>
                        <th>Tanggal</th>
                        <th>Dokumen</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Document</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <iframe id="path_doc" src="" style="width:100%; height:500px;" frameborder="0"></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Profil modal -->

    <div class="modal fade bs-example-modal-lg" id="modal-show-profile" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Profile
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class=" overflow-hidden">
                        <div class="profile-tab height-60-p">
                            <div class="tab height-60-p">
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#timeline"
                                            role="tab">Identitas</a>
                                    </li>
                                    <!--
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Latar Belakang</a>
                                            </li>
                                            
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#setting" role="tab">Dokumen</a>
                                            </li>
                                            -->
                                </ul>
                                <div class="tab-content">
                                    <!-- Timeline Tab start -->
                                    <div class="tab-pane fade show active" id="timeline" role="tabpanel">
                                        <div class="">
                                            <div class="">
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
                                                                        ada</b>/<b class="index-employee-nik_number">tidak
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
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Timeline Tab End -->
                                    <!-- Tasks Tab start -->
                                    <div class="tab-pane fade" id="tasks" role="tabpanel">
                                        <div class="pd-20 profile-task-wrap">
                                            <div class="container pd-0">
                                                <!-- Open Task start -->
                                                <div class="task-title row align-items-center">
                                                    <div class="col-md-8 col-sm-12">
                                                        <h5>Open Tasks (4 Left)</h5>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 text-right">
                                                        <a href="task-add" data-toggle="modal" data-target="#task-add"
                                                            class="bg-light-blue btn text-blue weight-500"><i
                                                                class="ion-plus-round"></i> Add</a>
                                                    </div>
                                                </div>
                                                <div class="profile-task-list pb-30">
                                                    <ul>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-1" />
                                                                <label class="custom-control-label"
                                                                    for="task-1"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet, consectetur
                                                            adipisicing elit. Id ea earum.
                                                            <div class="task-assign">
                                                                Assigned to Ferdinand M.
                                                                <div class="due-date">
                                                                    due date <span>22 February 2019</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-2" />
                                                                <label class="custom-control-label"
                                                                    for="task-2"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet.
                                                            <div class="task-assign">
                                                                Assigned to Ferdinand M.
                                                                <div class="due-date">
                                                                    due date <span>22 February 2019</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-3" />
                                                                <label class="custom-control-label"
                                                                    for="task-3"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet, consectetur
                                                            adipisicing elit.
                                                            <div class="task-assign">
                                                                Assigned to Ferdinand M.
                                                                <div class="due-date">
                                                                    due date <span>22 February 2019</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-4" />
                                                                <label class="custom-control-label"
                                                                    for="task-4"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet. Id ea earum.
                                                            <div class="task-assign">
                                                                Assigned to Ferdinand M.
                                                                <div class="due-date">
                                                                    due date <span>22 February 2019</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- Open Task End -->
                                                <!-- Close Task start -->
                                                <div class="task-title row align-items-center">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h5>Closed Tasks</h5>
                                                    </div>
                                                </div>
                                                <div class="profile-task-list close-tasks">
                                                    <ul>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-close-1" checked="" disabled="" />
                                                                <label class="custom-control-label"
                                                                    for="task-close-1"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet, consectetur
                                                            adipisicing elit. Id ea earum.
                                                            <div class="task-assign">
                                                                Assigned to Ferdinand M.
                                                                <div class="due-date">
                                                                    due date <span>22 February 2018</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-close-2" checked="" disabled="" />
                                                                <label class="custom-control-label"
                                                                    for="task-close-2"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet.
                                                            <div class="task-assign">
                                                                Assigned to Ferdinand M.
                                                                <div class="due-date">
                                                                    due date <span>22 February 2018</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-close-3" checked="" disabled="" />
                                                                <label class="custom-control-label"
                                                                    for="task-close-3"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet, consectetur
                                                            adipisicing elit.
                                                            <div class="task-assign">
                                                                Assigned to Ferdinand M.
                                                                <div class="due-date">
                                                                    due date <span>22 February 2018</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-close-4" checked="" disabled="" />
                                                                <label class="custom-control-label"
                                                                    for="task-close-4"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet. Id ea earum.
                                                            <div class="task-assign">
                                                                Assigned to Ferdinand M.
                                                                <div class="due-date">
                                                                    due date <span>22 February 2018</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- Close Task start -->
                                                <!-- add task popup start -->
                                                <div class="modal fade customscroll" id="task-add" tabindex="-1"
                                                    role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                                    Tasks Add
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close"
                                                                    data-toggle="tooltip" data-placement="bottom"
                                                                    title="" data-original-title="Close Modal">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body pd-0">
                                                                <div class="task-list-form">
                                                                    <ul>
                                                                        <li>
                                                                            <form>
                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4">Task
                                                                                        Type</label>
                                                                                    <div class="col-md-8">
                                                                                        <input type="text"
                                                                                            class="form-control" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4">Task
                                                                                        Message</label>
                                                                                    <div class="col-md-8">
                                                                                        <textarea class="form-control"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4">Assigned
                                                                                        to</label>
                                                                                    <div class="col-md-8">
                                                                                        <select
                                                                                            class="selectpicker form-control"
                                                                                            data-style="btn-outline-primary"
                                                                                            title="Not Chosen"
                                                                                            multiple=""
                                                                                            data-selected-text-format="count"
                                                                                            data-count-selected-text="{0} people selected">
                                                                                            <option>Ferdinand M.
                                                                                            </option>
                                                                                            <option>Don H. Rabon
                                                                                            </option>
                                                                                            <option>Ann P. Harris
                                                                                            </option>
                                                                                            <option>
                                                                                                Katie D. Verdin
                                                                                            </option>
                                                                                            <option>
                                                                                                Christopher S.
                                                                                                Fulghum
                                                                                            </option>
                                                                                            <option>
                                                                                                Matthew C. Porter
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row mb-0">
                                                                                    <label class="col-md-4">Due
                                                                                        Date</label>
                                                                                    <div class="col-md-8">
                                                                                        <input type="text"
                                                                                            class="form-control date-picker" />
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:;" class="remove-task"
                                                                                data-toggle="tooltip"
                                                                                data-placement="bottom" title=""
                                                                                data-original-title="Remove Task"><i
                                                                                    class="ion-minus-circled"></i></a>
                                                                            <form>
                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4">Task
                                                                                        Type</label>
                                                                                    <div class="col-md-8">
                                                                                        <input type="text"
                                                                                            class="form-control" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4">Task
                                                                                        Message</label>
                                                                                    <div class="col-md-8">
                                                                                        <textarea class="form-control"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4">Assigned
                                                                                        to</label>
                                                                                    <div class="col-md-8">
                                                                                        <select
                                                                                            class="selectpicker form-control"
                                                                                            data-style="btn-outline-primary"
                                                                                            title="Not Chosen"
                                                                                            multiple=""
                                                                                            data-selected-text-format="count"
                                                                                            data-count-selected-text="{0} people selected">
                                                                                            <option>Ferdinand M.
                                                                                            </option>
                                                                                            <option>Don H. Rabon
                                                                                            </option>
                                                                                            <option>Ann P. Harris
                                                                                            </option>
                                                                                            <option>
                                                                                                Katie D. Verdin
                                                                                            </option>
                                                                                            <option>
                                                                                                Christopher S.
                                                                                                Fulghum
                                                                                            </option>
                                                                                            <option>
                                                                                                Matthew C. Porter
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row mb-0">
                                                                                    <label class="col-md-4">Due
                                                                                        Date</label>
                                                                                    <div class="col-md-8">
                                                                                        <input type="text"
                                                                                            class="form-control date-picker" />
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="add-more-task">
                                                                    <a href="#" data-toggle="tooltip"
                                                                        data-placement="bottom" title=""
                                                                        data-original-title="Add Task"><i
                                                                            class="ion-plus-circled"></i> Add
                                                                        More Task</a>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">
                                                                    Add
                                                                </button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                    Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- add task popup End -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tasks Tab End -->
                                    <!-- Setting Tab start -->
                                    <div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
                                        <div class="profile-info">
                                            <ul class="document-requirment">

                                            </ul>

                                        </div>
                                    </div>
                                    <!-- Setting Tab End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Profil modal -->

    <!-- Simple Datatable End -->
    <div class="modal fade" id="accept-proposal"  role="dialog" aria-labelledby="import-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-accept-proposal" action="/applicant/pending" method="post" enctype="multipart/form-data">
                @csrf
                <input name="uuid" type="text" id="employee_applicant_uuid" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Terima Karyawan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Perusahaan</label>
                            <select name="company_uuid" id="company_uuid"
                                class="custom-select2 form-control company_uuid-select2" style="width: 100%;" >
                                <option value="">Penempatan Perusahaan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Site Penempatan Karyawan</label>
                            <select name="site_uuid" id="site_uuid"
                                class="custom-select2 form-control site_uuid-select2" style="width: 100%;" >
                                <option value="">Penempatan Site</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" onclick="storeAcceptProposal()" class="btn btn-primary">Terima</button>
                    </div>
                </div>
            </form>
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

        function storeAcceptProposal(){
            globalStoreNoTable('accept-proposal').then((data_value_element) => {
                cg('data_value_element', data_value_element);
            });
        }

        function showdoc(path) {
            $('#path_doc').attr("src", "{{ env('APP_URL') }}file/document/employee/" + path)
            $('#doc').modal('show')
        }

        function showProfile(uuid) {
            $('.index-employee-name').text(data_database.data_employee_talents[uuid]['name']);

            let dataShow = data_database.data_employee_talents[uuid];
            cg('udin', dataShow);

            for (var key in dataShow) {
                if (dataShow[key] != null) {
                    $('.index-employee-' + key).text(dataShow[key])
                } else {
                    $('.index-employee-' + key + '-hide').hide()
                }
            }

            $('#modal-show-profile').modal('show');
        }

        function firstFormRecruitment() {

            data_employees = data_database.data_employees;
        
            showDataTableRecruitment('applicant/data', ['much_recruitment', 'company_uuid'],
                'recruitment')
        }

        function showDataTableRecruitment(url, dataTable, id) {
            $.ajax({
                url: '/applicant/data',
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),                       
                    employee_uuid: null
                },
                success: function(response) {
                    cg('data', response);
                    console.log(response);
                },
                error: function(response) {
                    console.log(response)
                }
            });

            // return false;

            let data = [];
            var element_name = {
                mRender: function(data, type, row) {
                    return data_database.data_employee_talents[row.employee_uuid]['name'];
                }
            };
            data.push(element_name);
            var element_position = {
                mRender: function(data, type, row) {
                    return data_database.data_positions[row.position_uuid]['position']
                }
            };
            data.push(element_position);

            var element_kind = {
                mRender: function(data, type, row) {
                    let kind_apply = 'Mandiri';
                    if (row.recruitment_uuid) {
                        kind_apply = 'PPK';
                    }
                    return kind_apply
                }
            };
            data.push(element_kind);

            var element_date = {
                mRender: function(data, type, row) {
                    return row.date_applicant
                }
            };
            data.push(element_date);

            var element_document = {
                mRender: function(data, type, row) {

                    let data_foreach = data_database.data_atribut_sizes.requirment;
                    let btn_documents = '';
                    // cg('people', row);
                    Object.values(data_foreach).forEach(requirment_element => {
                        // cg('name file', data_database.data_employee_talents[row.employee_uuid][requirment_element.uuid]);
                        if (data_database.data_employee_talents[row.employee_uuid][requirment_element
                                .uuid
                            ]) {
                            btn_documents =
                                `${btn_documents}<a onclick="showdoc('${data_database.data_employee_talents[row.employee_uuid][requirment_element.uuid]}')" class="dropdown-item" href="#"><i class="dw dw-eye"></i> ${requirment_element.name_atribut}</a>`;
                        }
                    });

                    let element_btn_action = `
                    <div class="row">
                    <button onclick="showProfile('${row.employee_uuid}')" class="col-auto btn  btn-link">
                        <i class="icon-copy bi bi-person-square"></i>
                    </button>
                    <div class="dropdown col-auto">
											<a class="btn btn-link  dropdown-toggle"
												href="#" role="button" data-toggle="dropdown">
												<i class="icon-copy bi bi-filetype-pdf"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												${btn_documents}
											</div>
										</div>
                                </div>`;
                    return element_btn_action
                }
            };
            data.push(element_document);

            var element_status = {
                mRender: function(data, type, row) {
                    return row.status_applicant
                }
            };
            data.push(element_status);

            var element_action = {
                mRender: function(data, type, row) {
                    let element_btn_action = `<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
												href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="#"><i class="icon-copy ion-ios-telephone-outline"></i> Panggil</a>
												<a class="dropdown-item" onclick="acceptProposalShow('${row.employee_applicant_uuid}')" href="#"><i class="icon-copy ion-ios-bookmarks-outline"></i> Terima</a>
                                                <a class="dropdown-item" href="/user/detail/${row.employee_uuid}"><i class="icon-copy fa fa-sun-o" aria-hidden="true"></i> Edit Data</a>
												<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i>
													Hapus</a>
											</div>
										</div>`;
                    return element_btn_action
                }
            };
            data.push(element_action);
            $.ajax({
                url: '/applicant/data',
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    employee_uuid: null,
                },
                success: function(response) {                  
                    console.log(response)
                  
                },
                error: function(response) {
                    alertModal()
                }
            });

            // return false;


            $('#table-' + id).DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: {
                    url: '/applicant/data',
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        employee_uuid: null,
                    },
                },
                columns: data
            });
        }

        firstFormRecruitment();

        function acceptProposalShow(employee_applicant_uuid){
            cg('employee_applicant_uuid', employee_applicant_uuid);
            $('#employee_applicant_uuid').val(employee_applicant_uuid);
            $('#accept-proposal').modal('show');
        }

        function createRecruitment() {
            $('#createRecruitment').modal('show');
            $('#form-recruitment')[0].reset();
        }

        function store(idForm) {
            if (isRequiredCreate(['date_start', 'position_uuid', 'company_uuid', 'much_recruitment']) > 0) {
                return false;
            }
            var isStored = globalStore(idForm)
        }

        function deleteData(uuid) {
            let _url = '/form-recruitment/delete'

            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('recruitment')
        }

        function editData(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/form-recruitment/show";
            cg('uuid', uuid);
            // startLoading();
            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    uuid: uuid,
                    _token: _token
                },
                success: function(response) {
                    stopLoading()
                    data = response.data
                    console.log(data)
                    $('#uuid').val(data.uuid)
                    $('#employee_recruiter').val(data.employee_recruiter).trigger("change")
                    $('#company_uuid').val(data.company_uuid).trigger("change")
                    $('#position_uuid').val(data.position_uuid).trigger("change")
                    $('#much_recruitment').val(data.much_recruitment)
                    $('#status_recruitment').val(data.status_recruitment)
                    $('#date_start').val(data.date_start)
                    $('#date_end').val(data.date_end)
                    $('#createRecruitment').modal('show')
                },
                error: function(response) {
                    console.log(response)
                    alertModal()
                }
            });
        }
    </script>
@endsection
