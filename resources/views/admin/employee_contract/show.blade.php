@extends('layout_adm.main')

@section('content')
<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
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
                        {{-- @dd($employeeData) --}}
                        <h5 class="text-center h5 mb-0">{{ $employeeData['identity']->name}}</h5>
                        <p class="text-center text-muted font-14">
                            {{ $employeeData['employees']->nik_employee }} <br>
                            {{ $employeeData['employees']->department }}-{{$employeeData['employees']->position }}
                        </p>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Identitas Informasi</h5>
                            <ul>
                                <li>
                                    <span>POH</span>
                                    {{ $employeeData['identity']->poh_place }}
                                </li>
                                <li>
                                    <span>Phone Number:</span>
                                    {{ $employeeData['identity']->phone_number }}
                                </li>
                                <li>
                                    <span>Country:</span>
                                    America
                                </li>
                                <li>
                                    <span>Address:</span>
                                    {{ $employeeData['identity']->address }} <br />

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
                                        <a class="nav-link active" data-toggle="tab" href="#timeline"
                                            role="tab">Pengalaman</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Education</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#setting" role="tab">Family</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!-- Timeline Tab start -->
                                    <div class="tab-pane fade show active" id="timeline" role="tabpanel">
                                        <div class="pd-20">
                                            <div class="profile-timeline">

                                                <div class="timeline-month">
                                                    <h5>Employee Experience</h5>
                                                </div>
                                                <div class="profile-timeline-list">
                                                    <ul>
                                                        @foreach($employeeData['experiences'] as $experiences)
                                                        <li>
                                                            <div class="date">{{ $experiences->experience_position }}
                                                            </div>
                                                            <div class="task-name">
                                                                <i class="ion-android-alarm-clock"></i>
                                                                {{$experiences->experience_date_start }} -
                                                                {{$experiences->experience_date_end }}
                                                            </div>
                                                            <p>
                                                                {{ $experiences->experience_position }} On
                                                                {{ $experiences->experience_place_name }}
                                                            </p>
                                                            <div class="task-time">Was {{$experiences->experience_reason
                                                                }}</div>
                                                        </li>
                                                        @endforeach

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
                                                        <h5>Education Employee</h5>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 text-right">
                                                        <a href="task-add" data-toggle="modal" data-target="#task-add"
                                                            class="bg-light-blue btn text-blue weight-500"><i
                                                                class="ion-plus-round"></i> Add</a>
                                                    </div>
                                                </div>
                                                <div class="profile-task-list pb-30">
                                                    <ul>
                                                        @if($employeeData['education']->sd_name)
                                                        <li>
                                                            <div class="task-type">SD Sederajat</div>
                                                            {{ $employeeData['education']->sd_name }} , at
                                                            {{$employeeData['education']->sd_place }}
                                                            <div class="task-assign">
                                                                Graduated at
                                                                <div class="due-date">
                                                                    <span>{{
                                                                        $employeeData['education']->sd_year}}</span>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        @endif
                                                        {{-- SMP --}}
                                                        @if($employeeData['education']->smp_name)
                                                        <li>
                                                            <div class="task-type">SMP Sederajat</div>
                                                            {{ $employeeData['education']->smp_name }} , at
                                                            {{$employeeData['education']->smp_place }}
                                                            <div class="task-assign">
                                                                Graduated at
                                                                <div class="due-date">
                                                                    <span>{{
                                                                        $employeeData['education']->smp_year}}</span>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        @endif
                                                        @if($employeeData['education']->sma_name)
                                                        <li>
                                                            <div class="task-type">SMA Sederajat</div>
                                                            {{ $employeeData['education']->sma_name }} -
                                                            {{ $employeeData['education']->sma_jurusan }} , at
                                                            {{$employeeData['education']->sma_place }}
                                                            <div class="task-assign">
                                                                Graduated at
                                                                <div class="due-date">
                                                                    <span>{{
                                                                        $employeeData['education']->sma_year}}</span>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        @endif
                                                        @if($employeeData['education']->ptn_name)
                                                        <li>
                                                            <div class="task-type">Next Education</div>
                                                            {{ $employeeData['education']->ptn_name }} -
                                                            {{ $employeeData['education']->ptn_jurusan }} , at
                                                            {{$employeeData['education']->ptn_place }}
                                                            <div class="task-assign">
                                                                Graduated at
                                                                <div class="due-date">
                                                                    <span>{{
                                                                        $employeeData['education']->ptn_year}}</span>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        @endif
                                                        @if($employeeData['education']->dll_name)
                                                        <li>
                                                            <div class="task-type">Next Education</div>
                                                            {{ $employeeData['education']->dll_name }} -
                                                            {{ $employeeData['education']->dll_jurusan }} , at
                                                            {{$employeeData['education']->dll_place }}
                                                            <div class="task-assign">
                                                                Graduated at
                                                                <div class="due-date">
                                                                    <span>{{
                                                                        $employeeData['education']->dll_year}}</span>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        @endif
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tasks Tab End -->
                                    <!-- Setting Tab start -->
                                    <div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
                                        <div class="profile-setting">
                                            <div class="xs-pd-20-10 pd-ltr-20">
                                                <div class="card-box pb-10">
                                                    <div class="h5 pd-20 mb-0">Families</div>
                                                    <div id="DataTables_Table_0_wrapper"
                                                        class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-6"></div>
                                                            <div class="col-sm-12 col-md-6"></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <table
                                                                    class="data-table table nowrap dataTable no-footer dtr-inline"
                                                                    id="DataTables_Table_0" role="grid">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="DataTables_Table_0"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Gender: activate to sort column ascending">
                                                                                Family</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="DataTables_Table_0"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Gender: activate to sort column ascending">
                                                                                Name</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="DataTables_Table_0"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Gender: activate to sort column ascending">
                                                                                Gender</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="DataTables_Table_0"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Weight: activate to sort column ascending">
                                                                                Birth Place</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="DataTables_Table_0"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Assigned Doctor: activate to sort column ascending">
                                                                                Birth Date</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="DataTables_Table_0"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Admit Date: activate to sort column ascending">
                                                                                Last Education</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr role="row" class="odd">
                                                                            <td> Mother</td>
                                                                            <td> {{
                                                                                $employeeData['dependents']->mother_name
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->mother_gender
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->mother_place_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->mother_date_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->mother_education
                                                                                }}</td>
                                                                        </tr>
                                                                        <tr role="row" class="odd">
                                                                            <td> Father</td>
                                                                            <td> {{
                                                                                $employeeData['dependents']->father_name
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->father_gender
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->father_place_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->father_date_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->father_education
                                                                                }}</td>
                                                                        </tr>
                                                                        {{-- couple --}}
                                                                        @if( $employeeData['dependents']->couple_name)
                                                                        <tr role="row" class="odd">
                                                                            <td> Couple</td>
                                                                            <td> {{
                                                                                $employeeData['dependents']->couple_name
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->couple_gender
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->couple_place_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->couple_date_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->couple_education
                                                                                }}</td>
                                                                        </tr>
                                                                        @endif
                                                                        {{-- mother in law --}}
                                                                        @if(
                                                                        $employeeData['dependents']->mother_in_law_name)
                                                                        <tr role="row" class="odd">
                                                                            <td> Mother in law</td>
                                                                            <td> {{
                                                                                $employeeData['dependents']->mother_in_law_name
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->mother_in_law_gender
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->mother_in_law_place_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->mother_in_law_date_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->mother_in_law_education
                                                                                }}</td>
                                                                        </tr>
                                                                        @endif
                                                                        {{-- father in law --}}
                                                                        @if(
                                                                        $employeeData['dependents']->father_in_law_name)
                                                                        <tr role="row" class="odd">
                                                                            <td> Father in law</td>
                                                                            <td> {{
                                                                                $employeeData['dependents']->father_in_law_name
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->father_in_law_gender
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->father_in_law_place_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->father_in_law_date_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->father_in_law_education
                                                                                }}</td>
                                                                        </tr>
                                                                        @endif
                                                                        {{-- child 1 --}}
                                                                        @if(
                                                                        $employeeData['dependents']->child1_name)
                                                                        <tr role="row" class="odd">
                                                                            <td> Child</td>
                                                                            <td> {{
                                                                                $employeeData['dependents']->child1_name
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->child1_gender
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->child1_place_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->child1_date_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->child1_education
                                                                                }}</td>
                                                                        </tr>
                                                                        @endif
                                                                        {{-- child 2 --}}
                                                                        @if(
                                                                        $employeeData['dependents']->child2_name)
                                                                        <tr role="row" class="odd">
                                                                            <td> Child</td>
                                                                            <td> {{
                                                                                $employeeData['dependents']->child2_name
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->child2_gender
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->child2_place_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->child2_date_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->child2_education
                                                                                }}</td>
                                                                        </tr>
                                                                        @endif
                                                                        {{-- child 3 --}}
                                                                        @if(
                                                                        $employeeData['dependents']->child3_name)
                                                                        <tr role="row" class="odd">
                                                                            <td> Child</td>
                                                                            <td> {{
                                                                                $employeeData['dependents']->child3_name
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->child3_gender
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->child3_place_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->child3_date_birth
                                                                                }}</td>
                                                                            <td>{{
                                                                                $employeeData['dependents']->child3_education
                                                                                }}</td>
                                                                        </tr>
                                                                        @endif
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-5"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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