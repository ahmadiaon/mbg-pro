@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
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
                    <div class="pd-20 card-box height-100-p">
                        <div class="profile-photo">
                            <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i
                                    class="fa fa-pencil"></i></a>
                            <img src="{{ env('APP_URL') }}vendors/images/photo1.jpg" alt="" class="avatar-photo" />
                            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body pd-5">
                                            <div class="img-container">
                                                <img id="image" src="{{ env('APP_URL') }}vendors/images/photo2.jpg"
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
                        <h5 class="text-center h5 mb-0">h5>
                        <p class="text-center text-muted font-14">
                             <br>
                            employee->position }}
                        </p>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                            <ul>
                                <li>
                                    <span>Email Address:</span>
                                    FerdinandMChilds@test.com
                                </li>
                                <li>
                                    <span>Phone Number:</span>
                                    619-229-0054
                                </li>
                                <li>
                                    <span>Country:</span>
                                    America
                                </li>
                                <li>
                                    <span>Address:</span>
                                    1807 Holden Street<br />
                                    San Diego, CA 92115
                                </li>
                            </ul>
                        </div>
                        <div class="profile-social">
                            <h5 class="mb-20 h5 text-blue">Social Links</h5>
                            <ul class="clearfix">
                                <li>
                                    <a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i
                                            class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i
                                            class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i
                                            class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i
                                            class="fa fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn" data-bgcolor="#c32361" data-color="#ffffff"><i
                                            class="fa fa-dribbble"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn" data-bgcolor="#3d464d" data-color="#ffffff"><i
                                            class="fa fa-dropbox"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff"><i
                                            class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn" data-bgcolor="#bd081c" data-color="#ffffff"><i
                                            class="fa fa-pinterest-p"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn" data-bgcolor="#00aff0" data-color="#ffffff"><i
                                            class="fa fa-skype"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="btn" data-bgcolor="#00b489" data-color="#ffffff"><i
                                            class="fa fa-vine"></i></a>
                                </li>
                            </ul>
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
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                    <div class="card-box height-100-p overflow-hidden">
                        <div class="profile-tab height-100-p">
                            <div class="tab height-100-p">
                                <ul class="nav nav-tabs customtab" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tasks" role="tab">Ceklis
                                            APD</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " data-toggle="tab" href="#timeline" role="tab">Timeline</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#setting" role="tab">Settings</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!-- Timeline Tab start -->
                                    <div class="tab-pane fade show" id="timeline" role="tabpanel">
                                        <div class="pd-20">
                                            <div class="profile-timeline">
                                                <div class="timeline-month">
                                                    <h5>August, 2020</h5>
                                                </div>
                                                <div class="profile-timeline-list">
                                                    <ul>
                                                        <li>
                                                            <div class="date">12 Aug</div>
                                                            <div class="task-name">
                                                                <i class="ion-android-alarm-clock"></i> Task
                                                                Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 Aug</div>
                                                            <div class="task-name">
                                                                <i class="ion-ios-chatboxes"></i> Task Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 Aug</div>
                                                            <div class="task-name">
                                                                <i class="ion-ios-clock"></i> Event Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 Aug</div>
                                                            <div class="task-name">
                                                                <i class="ion-ios-clock"></i> Event Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="timeline-month">
                                                    <h5>July, 2020</h5>
                                                </div>
                                                <div class="profile-timeline-list">
                                                    <ul>
                                                        <li>
                                                            <div class="date">12 July</div>
                                                            <div class="task-name">
                                                                <i class="ion-android-alarm-clock"></i> Task
                                                                Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 July</div>
                                                            <div class="task-name">
                                                                <i class="ion-ios-chatboxes"></i> Task Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="timeline-month">
                                                    <h5>June, 2020</h5>
                                                </div>
                                                <div class="profile-timeline-list">
                                                    <ul>
                                                        <li>
                                                            <div class="date">12 June</div>
                                                            <div class="task-name">
                                                                <i class="ion-android-alarm-clock"></i> Task
                                                                Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 June</div>
                                                            <div class="task-name">
                                                                <i class="ion-ios-chatboxes"></i> Task Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 June</div>
                                                            <div class="task-name">
                                                                <i class="ion-ios-clock"></i> Event Added
                                                            </div>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit.
                                                            </p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Timeline Tab End -->
                                    <!-- Tasks Tab start -->
                                    <div class="tab-pane fade show active" id="tasks" role="tabpanel">
                                        <div class="pd-20 profile-task-wrap">
                                            <div class="container pd-0">
                                                <!-- Open Task start -->
                                                <div class="task-title row align-items-center">
                                                    <div class="col-md-8 col-sm-12">
                                                        <h5>No registrasi : Register'
                                                            }}</h5>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 text-right">
                                                        <a href="task-add" data-toggle="modal" data-target="#task-add"
                                                            class="bg-light-blue btn text-blue weight-500"><i
                                                                class="ion-plus-round"></i> Edit</a>
                                                    </div>
                                                </div>
                                                <div class="profile-task-list pb-30">
                                                    <ul>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input disabled type="checkbox"
                                                                class="custom-control-input" id="task-1" />
                                                                <label class="custom-control-label"
                                                                    for="task-1"></label>
                                                            </div>
                                                            <div class="task-type">Helm</div>
                                                            
                                                            <div class="task-assign">
                                                                Assigned to 
                                                                <div class="due-date">
                                                                    date <span>   </span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input disabled type="checkbox" class="custom-control-input"
                                                                id="task-2" />
                                                                <label class="custom-control-label"
                                                                    for="task-2"></label>
                                                            </div>
                                                            <div class="task-type">Rompi</div>
                                                             class="task-assign">
                                                                Assigned to 
                                                                <div class="due-date">
                                                                    date <span>   </span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input disabled type="checkbox"
                                                                class="custom-control-input" id="task-3" />
                                                                <label class="custom-control-label"
                                                                    for="task-3"></label>
                                                            </div>
                                                            <div class="task-type">Sepatu</div>
                                                            Ukuran Sepatu 
                                                            <div class="task-assign">
                                                                Assigned to 
                                                                <div class="due-date">
                                                                    date <span>   </span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- Open Task End -->
                                                <!-- Open Task start -->
                                                <div class="task-title row align-items-center">

                                                    <div class="col-md-8 col-sm-12">
                                                        <h5>Ceklis APD Baju</h5>
                                                    </div>
                                                </div>
                                                <div class="profile-task-list pb-30">
                                                    <ul>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input disabled type="checkbox"
                                                                    class="custom-control-input" id="task-4" />
                                                                <label class="custom-control-label"
                                                                    for="task-4"></label>
                                                            </div>
                                                            <div class="task-type">Kemeja Biru</div>
                                                            Ukuran 
                                                            <div class="task-assign">
                                                                Assigned to 
                                                                <div class="due-date">
                                                                    date <span>   </span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input disabled type="checkbox"
                                                                    class="custom-control-input"
                                                                id="task-5" />
                                                                <label class="custom-control-label"
                                                                    for="task-5"></label>
                                                            </div>
                                                            <div class="task-type">Kemeja Orange</div>
                                                            Ukuran 
                                                            <div class="task-assign">
                                                                Assigned to 
                                                                <div class="due-date">
                                                                    date <span>   </span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" custom-control-input" id="task-6" />
                                                                <label class="custom-control-label"
                                                                    for="task-6"></label>
                                                            </div>
                                                            <div class="task-type">Kaos Olahraga</div>
                                                            Ukuran 
                                                            <div class="task-assign">
                                                                Assigned to 
                                                                <div class="due-date">
                                                                    date <span>   </span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                {{-- kajdflsak --}}
                                                <!-- Close Task start -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tasks Tab End -->
                                    <!-- Setting Tab start -->
                                    <div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
                                        <div class="profile-setting">
                                            <form action="/safety/MBLE-001/store" method="POST">
                                                @csrf

                                                <input type="hidden" name="employee_contract_uuid" id=""
                                                    value="
                                                <input type="hidden" name="uuid" id="" value="
                                                <div class="container">
                                                    <h4 class="text-blue text-center h5 mb-20">
                                                        No Registrasi
                                                    </h4>
                                                    <input type="text" class="w-70 form-control" name="no_reg" id=""
                                                        value="00">
                                                </div>
                                                <ul class="profile-edit-list row">
                                                    <li class="weight-500 col-md-6">
                                                        <h4 class="text-blue h5 mb-20">
                                                            Edit Your Personal Setting
                                                        </h4>
                                                        <div class="form-group">
                                                            <label>Warna Helm</label>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5 mr-10">
                                                                    <input type="radio" value="Putih" id="Putih" ="helm_color" value="Putih"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="Putih">Putih</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-10">
                                                                    <input type="radio" value="Biru" id="Biru"
                                                                        name="helm_color" class="custom-control-input"
                                                                        class="custom-control-label weight-400"
                                                                        for="Biru">Biru</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input ="radio" value="Orange"
                                                                    id="Orange"
                                                                    name="helm_color"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="Orange">Orange</label>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input ="radio" value="Kuning"
                                                                    id="Kuning"
                                                                    name="helm_color"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="Kuning">Kuning</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" value="Hijau"
                                                                    id="Hijau"
                                                                    name="helm_color"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="Hijau">Hijau</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input ="radio" value="Merah"
                                                                    id="Merah"
                                                                    name="helm_color"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="Merah">Merah</label>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input 
                                                                    type="radio" value="" id="None"
                                                                    name="helm_color"
                                                                    class="custom-control-input" value=""/>
                                                                    <label class="custom-control-label weight-400"
                                                                        for="None">None</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Ukuran Sepatu</label>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5 mr-10">
                                                                    <input type="radio" id="6" value="6"name="boots_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="6">6</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="7" value="7"name="boots_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="7">7</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="8" value="8"name="boots_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="8">8</label>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="9" value="9"name="boots_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="9">9</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="10"  value="10"name="boots_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="10">10</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="11"  value="11"name="boots_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="11">11</label>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="12"  value="12"name="boots_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="12">12</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="13"  value="13"name="boots_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="13">13</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input  value="" type="radio" id="None"
                                                                    name="boots_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="None">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Rompi</label>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5 mr-20">
                                                                    <input type="radio"
                                                                    id="rompi_status_checked"
                                                                    name="rompi_status" value="1"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="rompi_status_checked">Checked</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input  value="0" type="radio"
                                                                    id="unchecked"
                                                                    name="rompi_status"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="unchecked">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Country</label>
                                                            <select class="selectpicker form-control form-control-lg"
                                                                data-style="btn-outline-secondary btn-lg"
                                                                title="Not Chosen">
                                                                <option>United States</option>
                                                                <option>India</option>
                                                                <option>United Kingdom</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group mb-0">
                                                            <input type="submit" class="btn btn-primary"
                                                                value="Update Information" />
                                                        </div>
                                                    </li>
                                                    <li class="weight-500 col-md-6">
                                                        <h4 class="text-blue h5 mb-20">
                                                            Baju
                                                        </h4>
                                                        <div class="form-group">
                                                            <label>Ukuran Baju Biru</label>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="S" value="S" name="blue_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="S">S</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="M" value="M" name="blue_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="M">M</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="L" value="L" name="blue_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="L">L</label>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="XL" value="XL" name="blue_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="XL">XL</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="XLL"  value="XLL" name="blue_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="XLL">XLL</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input  value="" type="radio"
                                                                    id="blue_size_none"
                                                                    name="blue_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="blue_size_none">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Ukuran Baju Orange</label>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="orange_blue_S"  value="S" name="orange_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="orange_blue_S">S</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="orange_blue_M"  value="M" name="orange_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="orange_blue_M">M</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="orange_blue_L"  value="L" name="orange_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="orange_blue_L">L</label>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="orange_blue_XL"  value="XL" name="orange_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="orange_blue_XL">XL</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="orange_blue_XLL"  value="XLL" name="orange_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="orange_blue_XLL">XLL</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input value="" type="radio"
                                                                    id="orange_blue_orange_size_none"
                                                                    name="orange_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="orange_blue_orange_size_none">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Ukuran Baju Kaos</label>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="kaos_S"  value="S" name="shirt_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="kaos_S">S</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="kaos_M"  value="M" name="shirt_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="kaos_M">M</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="kaos_L"  value="L" name="shirt_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="kaos_L">L</label>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="kaos_XL"  value="XL" name="shirt_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="kaos_XL">XL</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="kaos_XLL"  value="XLL" name="shirt_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="kaos_XLL">XLL</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input  value="" type="radio"
                                                                    id="kaos_size_none"
                                                                    name="shirt_size"
                                                                    class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="kaos_size_none">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Setting Tab End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
</div>
@endsection
@section('js')

<script src="{{ env('APP_URL') }}src/plugins/cropperjs/dist/cropper.js"></script>
<script>
    window.addEventListener("DOMContentLoaded", function () {
        var image = document.getElementById("image");
        var cropBoxData;
        var canvasData;
        var cropper;

        $("#modal")
            .on("shown.bs.modal", function () {
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
                    ready: function () {
                        cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                    },
                });
            })
            .on("hidden.bs.modal", function () {
                cropBoxData = cropper.getCropBoxData();
                canvasData = cropper.getCanvasData();
                cropper.destroy();
            });
    });
</script>

@endsection