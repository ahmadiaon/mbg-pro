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
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Daftar Setup cuti</h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <button type="date" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false">
                            Menu <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="createModalSetup()" href="#">Tambah</a>
                            <a class="dropdown-item" id="btn-export-setup"disabled
                                href="/user/Karyawan Cuti/export/">Export</a>
                            <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                href="">Import</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="the-table-employee-cuti-setup">
            <div class="pb-20" id="parent-employee-cuti-setup">
                <table id="table-employee-cuti-setup" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal Cuti</th>
                            <th>Roaster</th>
                            <th>Group</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
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
        <h4 class="h4 text-blue">Timeline Cuti Karyawan</h4>
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
                                <select style="width: 100%;" name="employee_uuid" id="employee_uuid"
                                    class="custom-select2 form-control">
                                    <option value="">karyawan</option>
                                </select>
                                <div class="invalid-feedback" id="req-employee_uuid">
                                    Data tidak boleh kosong
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Roaster Cuti</label>
                                <select class="form-control" name="roaster_uuid" id="roaster_uuid">
                                    <option value="70">10:2 70 Hari Kerja</option>
                                    <option value="63">9:2 63 Hari Kerja</option>
                                    <option value="56">8:2 56 Hari Kerja</option>
                                </select>
                            </div>
                            <div class="form-group autocomplete">
                                <label for="">Group Cuti</label>
                                <input class="form-control" id="group_cuti_name" type="text" name="group_cuti_name"
                                    placeholder="Country">
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Cuti</label>
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
                <form autocomplete="off" id="form-employee-cuti" action="/employee-cuti/store" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- karyawan --}}
                        <div class="form-group">
                            <label for="">Pilih Karyawan</label>
                            <select onchange="chooseEmployee()" style="width: 100%;" name="employee_uuid"
                                id="employee_uuid-cuti" class="custom-select2 form-control">
                                <option value="">karyawan</option>
                            </select>
                            <div class="invalid-feedback" id="req-employee_uuid-cuti">
                                Data tidak boleh kosong
                            </div>
                        </div>

                        {{-- jadwal cuti --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Jadwal Cuti</label>
                                </div>
                                <div class="col-md-8">
                                    <select onselect="chooseScheduleCuti()" style="width: 100%;" name="schedule_cuti"
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
                                <div class="col-md-4">
                                    <select onchange="choosePoh()" style="width: 100%;" name="poh_uuid" id="poh_uuid"
                                        class="custom-select2 form-control form-poh_uuid
                                        form-poh_uuid">
                                        <option value="dalam-kabupaten">Dalam Kabupaten</option>
                                        <option value="dalam-pulau">Dalam Pulau</option>
                                        <option value="luar-pulau">Luar Pulau</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="kabupaten" id="kabupaten" class="form-control"
                                        placeholder="Kabupaten">
                                    <div class="invalid-feedback" id="req-kabupaten">
                                        Data tidak boleh kosong
                                    </div>
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
                                    <select onchange="chooseMonitoringCuti()" style="width: 100%;" name="monitoring_cuti" id="monitoring_cuti"
                                        class="custom-select2 form-control">
                                        <option value="Sedang Cuti">Sedang Cuti</option>
                                        <option value="Harus Cuti">Harus Cuti</option>
                                        <option value="Selesai Cuti">Selesai Cuti</option>
                                        <option value="Harus Balik">Harus Balik</option>
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
                                    <input type="date" name="date_come_cuti" id="date_come_cuti" class="form-control">
                                   
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

@endsection

@section('js')
    <script>
        let employee_cuti_groups = @json($employee_cuti_groups);

        let countries = employee_cuti_groups;

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
        var data_cutis = @json($cutis);
        var dataaaa = @json($data_cuti);
        var employees_schedule_cuti = @json($employees_schedule_cuti);

        data_cutis.forEach(element => {
            the_start = element.y[0];
            element.y[0] = new Date(the_start).getTime();
            the_end = element.y[1];
            element.y[1] = new Date(the_end).getTime();
        });
    </script>
    <script src="/src/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="/vendors/scripts/apexcharts-setting.js"></script>
    <script>
        var employees = @json($employees);
        employees.forEach(element => {
            var elements = `<option value="${element.uuid}">${element.name} - ${element.position}</option>`;
            // console.log(element);
            $('#employee_uuid').append(elements);
            $('#employee_uuid-cuti').append(elements);
        });

        function chooseEmployee() {
            let employee_uuid = $('#employee_uuid-cuti').val();
            let looping = employees_schedule_cuti[employee_uuid];
            $('.emp').remove();
            looping.forEach(element => {
                $('#schedule_cuti').append(`<option class="emp" value="${element}">${element}</option>`)
            });
            chooseScheduleCuti();
        }

        function chooseScheduleCuti() {
            let schedule_cuti = $('#schedule_cuti').val();
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
            if (poh_uuid == 'dalam-pulau') {
                $('#value_money_cuti').val(250000);
            } else if (poh_uuid == 'luar-pulau') {
                $('#value_money_cuti').val(1000000);
            } else if (poh_uuid == 'dalam-kabupaten') {
                $('#value_money_cuti').val(150000);
            }
        }

        function chooseMonitoringCuti(){
            let monitoring_cuti = $('#monitoring_cuti').val();

        }

        function changeDate() {
            var date1 = $("#date_real_start_cuti").val();
            var date2 = $("#date_real_end_cuti").val();
            var dateStart = new Date(date1);
            var dateEnd = new Date(date2);
            var Difference_In_Time = dateEnd.getTime() - dateStart.getTime();

            // To calculate the no. of days between two dates
            var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

            $('#long_cuti').val(Difference_In_Days);

        }

        



        function changeLong() {
            let long_date = $('#long_cuti').val();
            var date1 = $("#date_real_start_cuti").val();
            var dateStart = new Date(date1);
            let dateEnd = addDays(dateStart, parseInt(long_date));
            let yearDate = dateEnd.getFullYear();
            let monthDate =padToDigits(2, dateEnd.getMonth()+1);
            let dayDate = padToDigits(2,dateEnd.getDate());
            $("#date_real_end_cuti").val(yearDate+'-'+monthDate+'-'+dayDate);
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

        let year_month = @json($year_month);
        let arr_year_month = year_month.split("-")
        $('#btn-year').html(arr_year_month[0]);
        $('#btn-month').html(months[arr_year_month[1]]);
        $('#btn-month').val(arr_year_month[1]);
        $('#btn-day').html("Perbulan");
        $('#btn-export').attr('href', '/employee-cuti/export/' + year_month)
        $('#btn-export-setup').attr('href', '/employee-cuti-setup/export/' + year_month)
        tableEmployeeCutiSetup();
        console.log("last day : " + year_month);

        reloadTable(year_month)

        function createModalSetup() {
            $('#create-modal-employee-cuti-setup').modal('show');
            $('#form-employee-cuti-setup')[0].reset();
        }

        function createEmployeeCuti() {
            $('#create-modal-employee-cuti').modal('show');
            $('#form-employee-cuti')[0].reset();
        }


        function tableEmployeeCutiSetup() {
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
            data.push(element_action)

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
                        year_month: year_month
                    },
                    type: 'POST',

                },
                columns: data
            });
        }

        function showDataTableEmployeeCuti(url, id) {
            $('#parent-employee-cuti').remove();
            var table_element = ` 
            <div class="pb-20" id="parent-employee-cuti">
                <table id="table-employee-cuti" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
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
            $('#btn-export').attr('href', 'employee-cuti/export/' + year_month)
            $('#btn-export-setup').attr('href', 'employee-cuti-setup/export/' + year_month)
           


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
										<button onclick="editData('` + row.uuid + `')" type="button" class="btn btn-secondary mr-1  py-1 px-2">
											<i class="icon-copy ion-gear-b"></i>
										</button>
										<button onclick="deleteData('` + row.uuid + `')" type="button" class="btn btn-danger mr-1  py-1 px-2">
											<i class="icon-copy ion-trash-b"></i>
										</button>
									</div>`
                }
            };
            data.push(element_action)

            console.log(id)
            $('#' + id).DataTable({
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
                        year_month: year_month
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
                    $('#uuid').val(data.uuid),
                        $('#employee_uuid').val(data.employee_uuid).trigger('change');
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

        function deleteData(uuid) {
            let _url = '/employee-cuti/delete'

            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('employee-cuti')
        }

        function refreshTable(val_year = null, val_month = null) {
            let v_year = $('#btn-year').html();
            let v_month = $('#btn-month').val();

            console.log(v_month);
            if (val_year) {
                console.log(val_year);
                v_year = val_year;
                $('#btn-year').html(val_year);
            }
            if (val_month) {
                v_month = val_month;
                console.log(val_month);
                $('#btn-month').html(months[val_month]);
                $('#btn-month').val(val_month);
            }
            year_month = v_year + '-' + v_month;


            reloadTable(year_month)
        }


        function reloadTable(year_month) {
            console.log('year:' + year_month)
            showDataTableEmployeeCuti('url', 'table-employee-cuti')
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
