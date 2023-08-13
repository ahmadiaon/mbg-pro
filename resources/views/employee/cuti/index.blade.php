@extends('template.admin.main_privilege')
@section('css')
    <style>
        /*the container must be positioned relative:*/
        .autocomplete {
            position: relative;
        }


        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        /*when hovering an item:*/
        .autocomplete-items div:hover {
            background-color: #e9e9e9;
        }

        /*when navigating through the items using the arrow keys:*/
        .autocomplete-active {
            background-color: DodgerBlue !important;
            color: #ffffff;
        }
    </style>
@endsection

@section('content')
    <div class="faq-wrap">
        <div id="accordion">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-block" data-toggle="collapse" data-target="#faq1">
                        <h4 class="text-blue h4">Daftar Setup cuti</h4>
                    </button>
                </div>
                <div id="faq1" class="collapse show" data-parent="#accordion">
                    <div class="card-box mb-30 ">
                        <div class="row pd-20">
                            <div class="col-auto">
                            </div>
                            <div class="col text-right">
                                <div class="btn-group">
                                    <button onclick="openModalFilter()" class="btn btn-success">Filter</button>
                                    <div class="btn-group dropdown">
                                        <button type="date" class="btn btn-primary dropdown-toggle waves-effect"
                                            data-toggle="dropdown" aria-expanded="false">
                                            Menu <span class="caret"></span>
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" onclick="createModalSetup()" href="#">Tambah</a>
                                            <a class="dropdown-item" id="btn-export-setup"disabled
                                                href="/user/Karyawan Cuti/export/">Export</a>
                                            <a class="dropdown-item" id="btn-import" data-toggle="modal"
                                                data-target="#import-modal" href="">Import</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="the-table-employee-cuti-setup">
                            <div class="pb-20" id="parent-employee-cuti-setup">
                                <table id="table-employee-cuti-setup" class="display nowrap stripe hover table"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Tanggal Awal Bekerja</th>
                                            <th>Roaster</th>
                                            <th>Group</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#cuti-warning">
                        <h4 class="text-blue h4">Daftar peringatan percutian</h4>
                    </button>
                </div>
                <div id="cuti-warning" class="collapse" data-parent="#accordion">
                    <div class="card-box mb-30 ">
                        <div class="row pd-20">
                            <div class="col-auto">
                            </div>
                            <div class="col text-right">
                                <div class="btn-group">
                                    <button onclick="openModalFilter()" class="btn btn-success">Filter</button>
                                    <div class="btn-group dropdown">
                                        <button type="date" class="btn btn-primary dropdown-toggle waves-effect"
                                            data-toggle="dropdown" aria-expanded="false">
                                            Menu <span class="caret"></span>
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" onclick="createModalSetup()" href="#">Tambah</a>
                                            <a class="dropdown-item" id="btn-export-setup"disabled
                                                href="/user/Karyawan Cuti/export/">Export</a>
                                            <a class="dropdown-item" id="btn-import" data-toggle="modal"
                                                data-target="#import-modal" href="">Import</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="the-table-employee-cuti-warning">
                            <div class="pb-20" id="parent-employee-cuti-warning">
                                <table id="table-employee-cuti-warning" class="display nowrap stripe hover table"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Mulai Cuti</th>
                                            <th>Akhir Cuti</th>
                                            <th>Monitoring</th>
                                            <th>Monitoring</th>
                                            <th>Monitoring</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>


    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Daftar karywan Cuti</h4>
            </div>
            @if (empty($nik_employee))
                <div class="col text-right">
                    <div class="btn-group">

                        <div class="btn-group dropdown">
                            <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                                data-toggle="dropdown" aria-expanded="false" id="btn-year">
                                <span class="caret"></span>
                            </button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" onclick="refreshTable(2021,null)" href="#">2021</a>
                                <a class="dropdown-item" onclick="refreshTable(2022,null)" href="#">2022</a>
                                <a class="dropdown-item" onclick="refreshTable(2023,null)" href="#">2023</a>
                            </div>
                        </div>
                        <div class="btn-group dropdown">
                            <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                                data-toggle="dropdown" aria-expanded="false" id="btn-month" value="">
                                <span class="caret"></span>
                            </button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" onclick="refreshTable(null, 1)" href="#">Januari</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 2)" href="#">Februari</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 3)" href="#">Maret</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 4)" href="#">April</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 5)" href="#">Mei</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 6)" href="#">Juni</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 7)" href="#">Juli</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 8)" href="#">Agustus</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 9)" href="#">September</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 10)" href="#">Oktober</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 11)" href="#">November</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 12)" href="#">Desember</a>
                            </div>
                        </div>
                        <div class="btn-group dropdown">
                            <button type="date" class="btn btn-primary dropdown-toggle waves-effect"
                                data-toggle="dropdown" aria-expanded="false">
                                Menu <span class="caret"></span>
                            </button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" onclick="createEmployeeCuti()" href="#">Tambah</a>
                                <a class="dropdown-item" id="btn-export" href="/user/Karyawan Cuti/export/">Export</a>
                                <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                    href="">Import</a>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div>
        <div id="the-table">
            <div class="pb-20" id="parent-employee-cuti">
                <table id="table-employee-cuti" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal Cuti</th>
                            <th>Alasan</th>
                            <th>Dokumen</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <div class="bg-white pd-20 card-box mb-30 overflow-auto">

        <div class="row">
            <h4 class="h4 text-blue col-md-6">Timeline group cuti karyawan</h4>
            <div class="col-md-2 text-rigth form-group row mr-1">
                <select onchange="filterTimeLineGroup()" style="width: 100%;" name="group_cuti_uuid"
                    id="group_cuti_uuid-timeline" class="custom-select2 form-control group_cuti_uuid">
                    <option value="">Group Cuti</option>
                </select>
            </div>
            <div class="col-md-4 text-rigth form-group row">
                <select onchange="filterTimeLineEmployee()" style="width: 100%;" name="employee_uuid"
                    id="employee_uuid-timeline" class="custom-select2 form-control employees">
                    <option value="">Pilih Karyawan</option>
                </select>
            </div>
        </div>
        <div style="width:3000px" id="chart6"></div>
    </div>


    <!-- Simple Datatable End -->
    <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-import" action="/employee-cuti/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import Karyawan Cuti</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih Karyawan Cuti</label>
                            <input name="uploaded_file" type="file"
                                class="form-control-file form-control height-auto" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" onclick="startLoading()" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- cuti setup --}}
    <div class="modal fade" id="create-modal-employee-cuti-setup" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-body">
                <form autocomplete="off" id="form-employee-cuti-setup" action="/employee-cuti-setup/store"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Karyawan Setup Cuti</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Pilih Karyawan</label>
                                <select onchange="chooseEmployeeCutiSetup()" style="width: 100%;" name="employee_uuid"
                                    id="employee_uuid-cuti-setup" class="custom-select2 form-control">
                                    <option value="">karyawan</option>
                                </select>
                                <div class="invalid-feedback" id="req-employee_uuid">
                                    Data tidak boleh kosong
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Roaster Cuti</label>
                                <select class="form-control" name="roaster_uuid" id="roaster_uuid">
                                </select>
                            </div>
                            <div class="form-group autocomplete">
                                <label for="">Group Cuti</label>
                                <input class="form-control" id="group_cuti_name" type="text" name="group_cuti_name"
                                    placeholder="Country">
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Awal Bekerja</label>
                                <input class="form-control" type="date" name="date_start_work" id="date_start_work">
                            </div>
                            <div class="invalid-feedback" id="req-date_start_work">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" onclick="storeSetup('employee-cuti-setup')"
                                class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    {{-- cuti --}}
    <div class="modal fade" id="create-modal-employee-cuti" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Form Cuti
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <form id="form-employee-cuti" action="/employee-cuti/store" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="uuid" id="uuid-cuti">
                    <div class="modal-body">
                        {{-- karyawan --}}
                        <div class="form-group">
                            <label for="">Pilih Karyawan</label>
                            <select onchange="chooseEmployee()" style="width: 100%;" name="employee_uuid"
                                id="employee_uuid-cuti" class="custom-select2 form-control">
                                <option value="">karyawan</option>
                            </select>
                        </div>

                        {{-- jadwal cuti --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Jadwal Cuti</label>
                                </div>
                                <div class="col-md-8">
                                    <select onchange="chooseScheduleCuti()" style="width: 100%;" name="schedule_cuti"
                                        id="schedule_cuti" class="custom-select2 form-control">
                                    </select>
                                    <div class="invalid-feedback" id="req-schedule_cuti">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- jenis cuti --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Jenis Cuti</label>
                                </div>
                                <div class="col-md-8">
                                    <select onchange="chooseStatusCuti()" style="width: 100%;" name="status_cuti"
                                        id="status_cuti" class="custom-select2 form-control">
                                        <option value="cuti">Cuti</option>
                                        <option value="terlambat">Cuti Terlambat</option>
                                        <option value="kompensasi">Kompensasi</option>
                                    </select>
                                    <div class="invalid-feedback" id="req-status_cuti">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- tanggal cuti --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="">awal cuti</label>
                                    <input onkeyup="changeLong()" type="date" class="form-control"
                                        name="date_real_start_cuti" id="date_real_start_cuti">
                                </div>
                                <div class="col-md-2">
                                    <label for="">lama</label>
                                    <input onkeyup="changeLong()" type="text" class="form-control" name="long_cuti"
                                        id="long_cuti">
                                </div>
                                <div class="col-md-5">
                                    <label for="">akhir cuti</label>
                                    <input onkeyup="changeDate()" type="date" class="form-control"
                                        name="date_real_end_cuti" id="date_real_end_cuti">
                                </div>
                            </div>
                        </div>

                        {{-- kompensasi --}}
                        <div class="form-group form-kompensasi_cuti">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Kompensasi</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="kompensasi_cuti" id="kompensasi_cuti"
                                        class="form-control" value="1000000">
                                    <div class="invalid-feedback" id="req-kompensasi_cuti">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- poh --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <select onchange="choosePoh()" style="width: 100%;" name="poh_uuid" id="poh_uuid"
                                        class="custom-select2 form-control form-poh_uuid
                                        form-poh_uuid">

                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <input type="text" name="kabupaten" id="kabupaten" class="form-control"
                                        placeholder="Kabupaten">
                                </div>
                            </div>
                        </div>

                        {{-- uang cuti --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Uang cuti</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="value_money_cuti" id="value_money_cuti"
                                        class="form-control" value="150000">
                                    <div class="invalid-feedback" id="req-value_money_cuti">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- monitoring cuti --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Monitoring Cuti</label>
                                </div>
                                <div class="col-md-8">
                                    <select onchange="chooseMonitoringCuti()" style="width: 100%;" name="monitoring_cuti"
                                        id="monitoring_cuti" class="custom-select2 form-control">
                                    </select>
                                    <div class="invalid-feedback" id="req-monitoring_cuti">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- tanggal balik cuti --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Tanggal Balik</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" name="date_come_cuti" id="date_come_cuti"
                                        class="form-control">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button onclick="storeCuti('employee-cuti')" type="button" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
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

    <!-- Modal filter-->
    <div class="modal fade customscroll" id="modal-filter" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Filter Data
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="bottom" title="" data-original-title="Close Modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-0">
                    <div class="task-list-form">
                        <ul>
                            <li>
                                <select onchange="tableEmployeeCutiSetup()" style="width: 100%;" name="group_cuti_uuid"
                                    id="group_cuti_uuid" class="custom-select2 form-control group_cuti_uuid">
                                    <option value="">Semua group cuti</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // autocomplite
        let employee_cuti_groups = @json($employee_cuti_groups);
        cg('employee_cuti_groups', employee_cuti_groups);
        let countries = [];

        employee_cuti_groups.forEach(item => {
            countries.push(item.name_group_cuti);
        });



        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }

        /*An array containing all the country names in the world:*/


        /*initiate the autocomplete function on the "group_cuti_uuid" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("group_cuti_name"), countries);
    </script>

    <script>
        let filter = {
            group_cuti_uuid: null
        };

        let nik_employee = dataUser.nik_employee;
        var employees_schedule_cuti = @json($employees_schedule_cuti);
        cg('employees_schedule_cuti', employees_schedule_cuti);
    </script>

    <script src="/src/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="/vendors/scripts/apexcharts-setting.js"></script>

    <script>
        let _tokens = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/employee-cuti/data-warning',
            type: "POST",
            data: {
                _token: _tokens,
                filter: filter,
                date: arr_date_today,
                nik_employee: nik_employee,
            },
            success: function(response) {
                cg('responsee', response);
                let for_data_datatable = response.data.arr_warning;
                cg('for_data_datatable', for_data_datatable);
                // return false;
                let data = [];
                data.push(element_profile_employee_session);

                let dataTable = [
                    'date_real_start_cuti',
                    'date_real_end_cuti',
                    'date_schedule_start_cuti',
                    'date_schedule_end_cuti',                   
                    'monitoring_cuti'
                ];

                dataTable.forEach(element => {
                    var dataElement = {
                        data: element,
                        name: element
                    }
                    data.push(dataElement)
                });

                $('#parent-employee-cuti-warning').empty();
                    var table_element = ` 
                    <table id="table-employee-cuti-warning" class="display nowrap stripe hover table"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Aktual Mulai</th>
                                            <th>Aktual Selesai</th>
                                            <th>Jadwal Mulai</th>
                                            <th>Jadwal Akhir</th>
                                            <th>Monitoring</th>
                                        </tr>
                                    </thead>
                                </table>`;

                    $('#parent-employee-cuti-warning').append(table_element);

                $('#table-employee-cuti-warning').DataTable({
                    scrollX: false,
                    scrollY: "600px",
                    paging: false,
                    serverSide: false,
                    data: for_data_datatable,
                    columns: data
                });
            },
            error: function(response) {
                alertModal()
            }
        });

        function firstEmployeeCuti() {
            employee_cuti_groups.forEach(cuti_group_element => {
                $(`.group_cuti_uuid`).append(
                    `<option value="${cuti_group_element.uuid}">${cuti_group_element.name_group_cuti}</option>`
                );
            });
            Object.values(data_database.data_employees).forEach(element => {
                var elements = `<option value="${element.uuid}">${element.name} - ${element.position}</option>`;
                // console.log(element);
                $('#employee_uuid-cuti-setup').append(elements);
                $('#employee_uuid-cuti').append(elements);
                $('.employees').append(elements);
            });

            Object.values(data_database.data_atribut_sizes.roaster_uuid).forEach(roaster_uuid_element => {
                var elements =
                    `<option value="${roaster_uuid_element.uuid}">${roaster_uuid_element.name_atribut}</option>`;

                $('#roaster_uuid').append(elements);
            });

            Object.values(data_database.data_atribut_sizes.poh_uuid).forEach(poh_uuid_element => {
                var elements =
                    `<option value="${poh_uuid_element.uuid}">${poh_uuid_element.name_atribut}</option>`;

                $('#poh_uuid').append(elements);
            });

            Object.values(data_database.data_atribut_sizes.monitoring_cuti).forEach(monitoring_cuti_element => {
                var elements =
                    `<option value="${monitoring_cuti_element.value_atribut}">${monitoring_cuti_element.name_atribut}</option>`;

                $('#monitoring_cuti').append(elements);
            });
            loadChart();

        }

        function loadChart() {



            $('#chart6').empty();
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/employee-cuti/data-timeline',
                type: "POST",
                data: {
                    _token: _token,
                    filter: filter,
                    date: arr_date_today,
                    nik_employee: nik_employee,
                },
                success: function(response) {
                    cg('responsee', response);
                    data_schedule_cuti = response.data.cutis;
                    data_schedule_cuti.forEach(element => {
                        the_start = element.y[0];
                        // cg('the_start',element);
                        element.y[0] = new Date(the_start).getTime();
                        the_end = element.y[1];
                        element.y[1] = new Date(the_end).getTime();
                    });

                    data_real_cuti_timeline = response.data.data_real_cuti_timeline;
                    data_real_cuti_timeline.forEach(element_real_cuti => {
                        the_start = element_real_cuti.y[0];
                        // cg('the_start',element_real_cuti);
                        element_real_cuti.y[0] = new Date(the_start).getTime();
                        the_end = element_real_cuti.y[1];
                        element_real_cuti.y[1] = new Date(the_end).getTime();
                    });

                    let arr_length = data_real_cuti_timeline.length;

                    arr_length = arr_length * 150;
                    cg('arr_length', arr_length)
                    var options6 = {
                        series: [{
                                name: 'Roaster Cuti',
                                data: data_schedule_cuti
                            },
                            {
                                name: 'Pelaksanaan cuti',
                                data: data_real_cuti_timeline
                            },
                        ],

                        chart: {
                            height: 300,
                            type: 'rangeBar',
                            toolbar: {
                                show: false,
                            }
                        },
                        grid: {
                            show: false,
                            padding: {
                                left: 0,
                                right: 0
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                barHeight: '80%'
                            }
                        },
                        xaxis: {
                            type: 'datetime'
                        },
                        stroke: {
                            width: 1
                        },
                        fill: {

                            type: 'solid',
                            opacity: 0.6
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'left'
                        }
                    };



                    var chart = new ApexCharts(document.querySelector("#chart6"), options6);
                    chart.render();
                },
                error: function(response) {
                    alertModal()
                }
            });

        }

        firstEmployeeCuti();

        function openModalFilter() {
            $('#modal-filter').modal('show');
        }

        function filterTimeLineGroup() {
            let group_cuti_uuid = $('#group_cuti_uuid-timeline').val();
            nik_employee = null;
            cg('group_cuti_uuid-timeline', group_cuti_uuid);

            filter.group_cuti_uuid = group_cuti_uuid;
            loadChart();

        }

        function filterTimeLineEmployee() {
            filter.group_cuti_uuid = null;
            nik_employee = $('#employee_uuid-timeline').val();
            loadChart();

        }

        function choseGroupCutiFilter() {
            let group_cuti_uuid = $('#group_cuti_uuid').val()
            $('#modal-filter').modal('hide');

            filter = {
                group_cuti_uuid: group_cuti_uuid
            };
            return filter;

        }

        function chooseEmployeeCutiSetup() {
            let employee_uuid = $('#employee_uuid-cuti-setup').val();
            let data_employee = data_database.data_employees[employee_uuid];
            $(`#roaster_uuid`).val(data_employee.roaster_uuid)
        }

        function chooseEmployee() {
            let employee_uuid = $('#employee_uuid-cuti').val();

            let data_employee = data_database.data_employees[employee_uuid];
            cg('poh', data_employee.poh_uuid);
            $(`#poh_uuid`).val(data_employee.poh_uuid).trigger('change');
            $(`#kabupaten`).val(data_employee.kabupaten);
            cg('data_employee', data_employee);
            let looping = employees_schedule_cuti[employee_uuid];
            cg();
            $('.emp').remove();
            looping.forEach(element => {
                $('#schedule_cuti').append(`<option class="emp" value="${element}">${element}</option>`)
            });

            chooseScheduleCuti();
        }

        function chooseScheduleCuti() {
            let schedule_cuti = $('#schedule_cuti').val();
            cg('chosee', schedule_cuti);
            let schedule_cutiArray = schedule_cuti.split(" sd ");
            $('#date_real_start_cuti').val(schedule_cutiArray[0]);
            $('#date_real_end_cuti').val(schedule_cutiArray[1]);
            console.log(schedule_cutiArray);
            changeDate()

        }

        function chooseStatusCuti() {
            let status_cuti = $('#status_cuti').val()
            if (status_cuti == 'cuti') {
                $('.form-kompensasi_cuti').hide();
            } else {
                $('.form-kompensasi_cuti').show();
            }
        }

        function choosePoh() {
            let poh_uuid = $('#poh_uuid').val();
            cg('choosePoh', data_database.data_atribut_sizes.poh_uuid);
            $('#value_money_cuti').val(data_database.data_atribut_sizes.poh_uuid[poh_uuid]['value_atribut']);
        }

        function chooseMonitoringCuti() {
            let monitoring_cuti = $('#monitoring_cuti').val();

        }

        function changeDate() {
            var date1 = $("#date_real_start_cuti").val();
            var date2 = $("#date_real_end_cuti").val();
            var dateStart = new Date(date1);
            var dateEnd = new Date(date2);
            var Difference_In_Time = dateEnd.getTime() - dateStart.getTime();

            // To calculate the no. of days between two aaadates
            var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

            $('#long_cuti').val(Difference_In_Days + 1);

        }

        {
            'form-code-data': 'code-data':{
                'field-name':'value-field'
            },
            'FORM-STATUS-UNIT' : 'xxxyyyzzz':{
                'TANGGAL':'10/10/2023',

            }
        }




        function changeLong() {
            let long_date = $('#long_cuti').val();
            var date1 = $("#date_real_start_cuti").val();
            var dateStart = new Date(date1);
            let dateEnd = addDays(dateStart, (parseInt(long_date) - 1));
            let yearDate = dateEnd.getFullYear();
            let monthDate = padToDigits(2, dateEnd.getMonth() + 1);
            let dayDate = padToDigits(2, dateEnd.getDate());
            $("#date_real_end_cuti").val(yearDate + '-' + monthDate + '-' + dayDate);
        }

        function storeSetup(idForm) {
            if (isRequired(['premi_name', 'date_start']) > 0) {
                return false;
            }
            var isStored = globalStore(idForm)
        }

        function storeCuti(idForm) {
            if (isRequired(['premi_name', 'date_start']) > 0) {
                return false;
            }
            var isStored = globalStore(idForm)
        }


        chooseStatusCuti();

        $('#btn-year').html(arr_date_today.year);
        $('#btn-month').html(months[parseInt(arr_date_today.month)]);
        $('#btn-month').val(arr_date_today.month);
        $('#btn-export').attr('href', '/employee-cuti/export/' + arr_date_today.year + '-' + arr_date_today.month)
        $('#btn-export-setup').attr('href', '/employee-cuti-setup/export/' + arr_date_today.year + '-' + arr_date_today
            .month)
        tableEmployeeCutiSetup();
        reloadTable(arr_date_today.year + '-' + arr_date_today.month)

        function createModalSetup() {
            $('#create-modal-employee-cuti-setup').modal('show');
            $('#form-employee-cuti-setup')[0].reset();
        }

        function createEmployeeCuti() {
            $('#create-modal-employee-cuti').modal('show');
            $('#form-employee-cuti')[0].reset();
        }


        function tableEmployeeCutiSetup() {
            // persiapan table employee cuti setup 
            $('#parent-employee-cuti-setup').empty();
            let element_table_cuti_setup = `
                                <table id="table-employee-cuti-setup" class="display nowrap stripe hover table"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Tanggal Awal Bekerja</th>
                                            <th>Roaster</th>
                                            <th>Group</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>`;
            $('#parent-employee-cuti-setup').append(element_table_cuti_setup);
            let data = [];
            var element_employee = {
                mRender: function(data, type, row) {
                    if (row.photo_path == null) {
                        row.photo_path = '/vendors/images/photo4.jpg';
                    }
                    if (row.photo_path == null) {
                        row.photo_path = '/vendors/images/photo4.jpg';
                    }
                    return `<div class="name-avatar d-flex align-items-center">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="${row.photo_path}" class="border-radius-100 shadow" width="40"
												height="40" alt="" />
										</div>
										<div class="txt">
											<div class="weight-600">${row.name}</div>
                                            <small>${row.position}</small></br>
											<small>${row.nik_employee}</small>
										</div>
									</div>`
                }
            };
            data.push(element_employee)

            let dataTable = [
                'date_start_work',
                'roaster_uuid',
                'name_group_cuti'
            ]

            dataTable.forEach(element => {
                var dataElement = {
                    data: element,
                    name: element
                }
                data.push(dataElement)
            });

            var element_action = {
                mRender: function(data, type, row) {
                    // console.log(row)
                    return `
									<div class="form-inline"> 
										<button onclick="editDataSetup('` + row.uuid + `')" type="button" class="btn btn-secondary mr-1  py-1 px-2">
											<i class="icon-copy ion-gear-b"></i>
										</button>
										<button onclick="deleteDataSetup('` + row.uuid + `')" type="button" class="btn btn-danger mr-1  py-1 px-2">
											<i class="icon-copy ion-trash-b"></i>
										</button>
									</div>`
                }
            };
            data.push(element_action);

            $('#table-employee-cuti-setup').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: {
                    url: '/employee-cuti-setup/data',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        filter: choseGroupCutiFilter()
                    },
                    type: 'POST',
                },
                columns: data
            });
        }

        function showDataTableEmployeeCuti() {
            $('#parent-employee-cuti').remove();
            var table_element = ` 
            <div class="pb-20" id="parent-employee-cuti">
                <table id="table-employee-cuti" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Karyawan Cuti</th>
                            <th>Tanggal Cuti</th>
                            <th>Lama</th>
                            <th>Tanggal Balik</th>
                            <th>Jenis Cuti</th>
                            <th>Status Cuti</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>`;

            $('#the-table').append(table_element);
            $('#btn-export').attr('href', 'employee-cuti/export/' + arr_date_today.year + '-' + arr_date_today.month)
            $('#btn-export-setup').attr('href', 'employee-cuti-setup/export/' + arr_date_today.year + '-' + arr_date_today
                .month)



            let data = [];
            var element_employee = {
                mRender: function(data, type, row) {
                    if (row.photo_path == null) {
                        row.photo_path = '/vendors/images/photo4.jpg';
                    }
                    if (row.photo_path == null) {
                        row.photo_path = '/vendors/images/photo4.jpg';
                    }
                    return `<div class="name-avatar d-flex align-items-center">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="${row.photo_path}" class="border-radius-100 shadow" width="40"
												height="40" alt="" />
										</div>
										<div class="txt">
											<div class="weight-600">${row.name}</div>
                                            <small>${row.position}</small></br>
											<small>${row.nik_employee}</small>
										</div>
									</div>`
                }
            };
            data.push(element_employee)

            let dataTable = [
                'date_real_start_cuti',
                'long_cuti',
                'date_real_end_cuti',
                'status_cuti',
                'monitoring_cuti'
            ]

            dataTable.forEach(element => {
                var dataElement = {
                    data: element,
                    name: element
                }
                data.push(dataElement)
            });
            var element_action = {
                mRender: function(data, type, row) {
                    return `
									<div class="form-inline"> 
										<button onclick="editDataEmployeeCuti('` + row.uuid + `')" type="button" class="btn btn-secondary mr-1  py-1 px-2">
											<i class="icon-copy ion-gear-b"></i>
										</button>
										<button onclick="deleteDataEmployeeCuti('` + row.uuid + `')" type="button" class="btn btn-danger mr-1  py-1 px-2">
											<i class="icon-copy ion-trash-b"></i>
										</button>
									</div>`
                }
            };
            data.push(element_action)

            $('#table-employee-cuti').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: {
                    url: '/employee-cuti/data',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        date: arr_date_today
                    },
                    type: 'POST',

                },
                columns: data
            });
        }

        function editDataSetup(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/employee-cuti-setup/show";
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
                    $('#employee_uuid-cuti-setup').val(data.employee_uuid).trigger('change');
                    $('#date_start_work').val(data.date_start_work)
                    $('#roaster_uuid').val(data.roaster_uuid).trigger('change');
                    $('#group_cuti_name').val(data.name_group_cuti)
                    $('#create-modal-employee-cuti-setup').modal('show')
                },
                error: function(response) {
                    console.log(response)
                    alertModal()
                }
            });
        }

        function deleteDataEmployeeCuti(uuid) {
            let _url = '/employee-cuti/delete'

            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('employee-cuti')
        }

        function editDataEmployeeCuti(uuid) {

            $.ajax({
                url: '/employee-cuti/show/' + uuid,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    let data = res.data;
                    cg('res', res)
                    let schdl = `${data.date_schedule_start_cuti} sd ${data.date_schedule_end_cuti}`;
                    $('#employee_uuid-cuti').val(data.employee_uuid).trigger('change');
                    $('#schedule_cuti').val(schdl).trigger('change');
                    $('#status_cuti').val(data.status_cuti).trigger('change');
                    $('#date_real_start_cuti').val(data.date_real_start_cuti).trigger('change');
                    $('#long_cuti').val(data.long_cuti).trigger('change');
                    $('#date_real_end_cuti').val(data.date_real_end_cuti).trigger('change');
                    $('#kompensasi_cuti').val(data.kompensasi_cuti).trigger('change');
                    let data_em = data_database.data_employees[data.employee_uuid];
                    $('#poh_uuid').val(data_em.poh_uuid).trigger('change');
                    $('#kabupaten').val(data_em.kabupaten).trigger('change');
                    $('#value_money_cuti').val(data.value_money_cuti).trigger('change');
                    $('#monitoring_cuti').val(data.monitoring_cuti).trigger('change');
                    $('#date_come_cuti').val(data.date_come_cuti).trigger('change');
                    $('#uuid-cuti').val(data.uuid).trigger('change');

                    $('#create-modal-employee-cuti').modal('show');
                }
            });
        }

        function refreshTable(val_year = null, val_month = null) {
            cg('refreshtable', arr_date_today);
            year = arr_date_today.year;
            month = arr_date_today.month;

            if (val_year) {
                arr_date_today.year = val_year
                $('#btn-year').html(arr_date_today.year);
            }
            if (val_month) {
                arr_date_today.month = val_month;
                $('#btn-month').html(monthName(arr_date_today.month));
                $('#btn-month').val(arr_date_today.month);
            }

            $('#btn-export').attr('href', '/user/absensi/export/' + arr_date_today.year + '-' + arr_date_today.month)
            $('#btn-export-template').attr('href', '/user/absensi/export-template/' + arr_date_today.year + '-' +
                arr_date_today.month)
            let _url = 'user/absensi/data/' + arr_date_today.year + '-' + arr_date_today.month;
            // showDataTableEmployeeAbsen(_url, ['pay', 'cut', 'A'], 'table-absen')
            setDateSession(year, month);


            reloadTable(arr_date_today.year + '-' + arr_date_today.month)
        }


        function reloadTable(year_month) {
            showDataTableEmployeeCuti()
        }

        function deleteDataSetup(uuid) {
            let _url = '/employee-cuti-setup/delete'

            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('employee-cuti-setup')
        }
    </script>
@endsection
