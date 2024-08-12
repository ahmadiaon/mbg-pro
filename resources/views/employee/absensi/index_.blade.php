@extends('template.admin.main_privilege')

@section('content')
    <div class="mb-20 row">
        <!-- Filter -->
        <div class="col-md-5 mb-10">
            <div class="card-box pd-20" id="the-filter-employee-tonase">
                <h4 class="text-blue h4">Filter Absen</h4>

                <div class="form-group row mb-20">
                    <label class="col-auto" for="">Perusahaan</label>
                    <div class="col text-right custom-control custom-checkbox mb-5">
                        <input onchange="checkedAll('company')" type="checkbox" class="custom-control-input"
                            id="checked-all-company">
                        <label class="custom-control-label" for="checked-all-company">Pilih
                            Semua</label>
                    </div>
                    <div class="col-12 justify-content-md-center row company-filter">

                    </div>
                </div>

                <div class="form-group row mb-20">
                    <label class="col-auto" for="">Site</label>
                    <div class="col text-right custom-control custom-checkbox mb-5">
                        <input onchange="checkedAll('site_uuid')" type="checkbox" class="custom-control-input"
                            id="checked-all-site_uuid">
                        <label class="custom-control-label" for="checked-all-site_uuid">Pilih
                            Semua</label>
                    </div>
                    <div class="col-12 justify-content-md-center row site-filter">

                    </div>
                </div>
                <div class="form-group row mb-20">
                    <label class="col-md-4" for="">Status Absen</label>
                    <div class="col-md-7">

                    </div>
                </div>
                <div class="form-group row mb-20">
                    <label class="col-md-4" for="">Admin Absen</label>
                    <div class="col-md-7" id="admin-fingger-filter">
                        <select id="admin-fingger" class="selectpicker form-control admin-absen" data-size="5"
                            data-style="btn-outline-primary" multiple data-actions-box="true"
                            data-selected-text-format="count">
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4">Status Pembayaran Absen</label>
                    <div class="col-md-8 ">
                        <div class="row math">
                            <div class="col-12  text-right">
                                <div class="custom-control custom-checkbox mb-5">
                                    <input onchange="checkedAll('math')" type="checkbox" class="custom-control-input"
                                        id="checked-all-math">
                                    <label class="custom-control-label" for="checked-all-math">Pilih
                                        Semua</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="custom-control custom-checkbox mb-5">
                                    <input onchange="changeChecked('filter-math-unknown_absen','unknown_absen', 'math')"
                                        type="checkbox" class="custom-control-input element-math" value="unknown_absen"
                                        id="filter-math-unknown_absen" name="filter-math-unknown_absen">
                                    <label class="custom-control-label" for="filter-math-unknown_absen">Tanpa
                                        Keterangan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                {{-- rentang wAKTU --}}
                <div class="form-group row">
                    <label class="col-md-12 text-center">Rentang Waktu</label>
                    <div class="col-md-4">
                        <select onchange="loopDateFilter()" style="width: 100%;" name="date_start_filter_absen"
                            id="date_start_filter_absen" class="custom-select2 form-control">
                        </select>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="alert alert-light" role="alert">
                            sampai
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select style="width: 100%;" name="date_end_filter_absen" id="date_end_filter_absen"
                            class="custom-select2 form-control">
                        </select>
                    </div>
                </div>
                <button onclick="onSaveFilter()" type="button" class="col-md-auto btn btn-primary text-rigth">
                    Simpan
                </button>
            </div>
        </div>
    </div>

    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Absensi Karyawans</h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false" id="btn-year">
                            <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="refreshTable(2021,null)" href="#">2021</a>
                            <a class="dropdown-item" onclick="refreshTable(2022,null)" href="#">2022</a>
                            <a class="dropdown-item" onclick="refreshTable(2023,null)" href="#">2023</a>
                            <a class="dropdown-item" onclick="refreshTable(2024,null)" href="#">2024</a>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                            data-toggle="dropdown" aria-expanded="false" id="btn-month" value="">
                            <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="refreshTable(null, 01 )" href="#">Januari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 02 )" href="#">Februari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 03 )" href="#">Maret</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 04 )" href="#">April</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 05 )" href="#">Mei</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 06 )" href="#">Juni</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 07 )" href="#">Juli</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 08 )" href="#">Agustus</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 09 )" href="#">September</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 10 )" href="#">Oktober</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 11 )" href="#">November</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 12 )" href="#">Desember</a>
                        </div>
                    </div>
                    <div class="btn-group dropdown">

                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect"
                            data-toggle="dropdown" aria-expanded="false">
                            Menu <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="btn-absen" href="#"
                                onclick="openModalAbsen()">Ketidakhadiran</a>
                            <a class="dropdown-item" onclick="exportAbsen()" id="btn-export" href="#">Export +
                                Data</a>
                            <a class="dropdown-item" onclick="openModalExportDialy()" id="btn-export-dialy"
                                href="#">Dialy
                                Report</a>
                            <a class="dropdown-item" onclick="reportOpenModalReportStatusAbsen()" id="btn-export-dialy"
                                href="#">Lap. Tidak Hadir</a>
                            <a class="dropdown-item" onclick="reportExportInOut()" id="btn-export-in-out"
                                href="#">Lap. Tidak Hadir In Out</a>
                            {{-- <a class="dropdown-item" id="btn-export-dialy" href="/user/absensi/dialy-report">Dialy
                                Report</a> --}}
                            <a class="dropdown-item" id="btn-export-template"
                                href="/user/absensi/export-template/">Export
                                Template</a>
                            <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                href="">Import</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                style="color: rgb(215, 38, 177); background-color: rgb(231, 235, 245);">Diajukan</span>
        <div id="the-table">
            <div class="pb-20" id="tableabsen">
                <table id="table-absen" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Dibayar</th>
                            <th>Potongan</th>
                            <th>Alpha</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>

    <!-- import -->
    <div class="modal fade" id="import-modal" role="dialog" aria-labelledby="import-modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-import" action="/user/absensi/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import Absensi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih Absensi</label>
                            <input autofocus name="uploaded_file" type="file"
                                class="form-control-file form-control height-auto" />
                        </div>
                        <div class="form-group row date-setup">
                            <div class="col-6">
                                <label for="">Mulai tanggal</label>
                                <select onchange="loopDate()" name="date_absen_start" style="width: 100%"
                                    id="date_absen_start" class="custom-select2 form-control">

                                </select>
                            </div>
                            <div class="col-6">
                                <label for="">Sampai tanggal</label>
                                <select name="date_absen_end" style="width: 100%" id="date_absen_end"
                                    class="custom-select2 form-control">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" onclick="storeUserDocument('import')"
                            class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal ketidakhadiran-->
    <div class="modal fade" id="create-absen" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Form Ketidakhadiran
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <form autocomplete="off" id="form-absen" action="/user/absensi/store-absen" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- karyawan --}}
                        <div class="form-group">
                            <label for="">Pilih Karyawan</label>
                            <select style="width: 100%;" name="employee_uuid" id="employee_uuid-absen"
                                class="custom-select2 form-control employees">
                                <option value="">karyawan</option>
                            </select>
                        </div>

                        {{-- jenis cuti --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Jenis Absen</label>
                                </div>
                                <div class="col-md-8">
                                    <select style="width: 100%;" name="status_absen_uuid" id="status_absen_uuid"
                                        class="custom-select2 form-control">
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- tanggal cuti --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="">awal absen</label>
                                    <input onkeyup="changeLong()" type="date" class="form-control"
                                        name="date_start_absen" id="date_start_absen">
                                </div>
                                <div class="col-md-2">
                                    <label for="">lama</label>
                                    <input onkeyup="changeLong()" type="text" class="form-control" name="long_absen"
                                        id="long_absen">
                                </div>
                                <div class="col-md-5">
                                    <label for="">akhir absen</label>
                                    <input onkeyup="changeDate()" type="date" class="form-control"
                                        name="date_end_absen" id="date_end_absen">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button onclick="storeAbsenModal('absen')" type="button" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal edit live-->
    <div class="modal fade" id="modal-edit-live" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="name-date">
                        xx
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    {{-- karyawan --}}
                    <input class="form-control" name="" id="cek_log-live" cols="10" rows="3">
                    <div id="button-status_absen">
                        {{-- status absen --}}
                    </div>
                </div>
                <input type="hidden" name="" id="employee_uuid-edit-live">
                <input type="hidden" name="" id="date-edit-live">

                <div class="row justify-content-md-center" id="button-status_absen_uuid">
                    <div class="col-auto">

                    </div>
                </div>


                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ketidakhadiran-->
    <div class="modal fade" id="export-dialy" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Form Ketidakhadiran
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <form autocomplete="off" id="form-absen" action="/user/absensi/store-dialy" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- karyawan --}}
                        <div class="form-group">
                            <label for="">Pilih Tanggal</label>
                            <input type="date" class="form-control" name="date_dialy" id="date_dialy">
                        </div>
                        <div class="form-group row mb-20 justify-content-md-center site-radio" id="">
                            <label class="col-md-12" for="">SITE</label>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button onclick="storeDialyExport()" type="button" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal laporan sesuai status absen-->
    <div class="modal fade" id="modal-report-status-absen" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        PILIH STATUS ABSEN
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <form autocomplete="off" id="form-absen" action="/user/absensi/store-dialy" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih status absen</label>
                            <select id="status-absen-filter"
                                class="selectpicker form-control multiple-select-status-absen" data-size="5"
                                data-style="btn-outline-primary" multiple data-actions-box="true"
                                data-selected-text-format="count">

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button onclick="reportAbsensi_x()" type="button" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let nik_employee = @json(session('dataUser')->nik_employee);
        var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
        var end = new Date(arr_date_today.year, arr_date_today.month, 0);
        let value_checkbox = {
            'company': null,
            'site_uuid': null,
            'math': null
        };

        let arr_filter = {
            'company': [],
            'site_uuid': [],
            'math': []
        };

        let filter = {
            'value_checkbox': [],
            'is_combined': true,
            'show_type': 'employee',
            'arr_filter': {
                'company': [],
                'site_uuid': [],
                'math': []
            },
            'date_filter': {
                date_start_filter_absen: formatDate(start),
                date_end_filter_absen: formatDate(end),
            },
            nik_employee: nik_employee
        };

        


        let year;
        let month;
        let dt_end;
        let dt_start;
        let data_datatable;
        let data_response;



        let arr_site_uuid = [];
        let arr_status_absen = [];

        function storeDialyExport() {
            let site_uuid_dialy = $("input[type='radio'][name='site_uuid_dialy']:checked").val();
            let date_dialy = $('#date_dialy').val();

            cg(site_uuid_dialy, date_dialy);

            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/user/absensi/dialy-report',
                type: "POST",
                data: {
                    _token: _token,
                    site_uuid_dialy: site_uuid_dialy,
                    date_dialy: date_dialy,
                },
                success: function(response) {
                    cg('responses', response);

                    // return false;
                    var dlink = document.createElement("a");
                    dlink.href = `/${response.data}`;
                    dlink.setAttribute("download", "");
                    dlink.click();
                    cg('a', 'b');
                },
                error: function(response) {
                    alertModal()
                }
            });
        }


        function reportOpenModalReportStatusAbsen() {
            $('#modal-report-status-absen').modal('show');
        }

        function reportAbsensi_x() {
            let status_absen_filter = $('#status-absen-filter').val();


            cg('status_absen_filter', status_absen_filter);
            filter.status_absen_filter = status_absen_filter;
            cg('fiiolter', filter);
            // return false;
            startLoading();
            let _token = $('meta[name="csrf-token"]').attr('content');
            cg('data_datatable', data_datatable);
            let data_ex = JSON.stringify(data_datatable);
            $.ajax({
                url: '/user/absensi/reportUnAbsen',
                type: "POST",
                data: {
                    _token: _token,
                    data_export: data_ex,
                    filter: filter
                },
                success: function(response) {
                    cg('response', response);
                    var dlink = document.createElement("a");
                    dlink.href = `/${response.data}`;
                    dlink.setAttribute("download", "");
                    dlink.click();
                    stopLoading();
                },
                error: function(response) {
                    cg('response', response)
                    alertModal()
                }
            });
        }

        function loopDateFilter() {
            cg('loopDateFilter', arr_date_today);
            var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
            var end = new Date(arr_date_today.year, arr_date_today.month, 0);

            var date_today = new Date();


            var loop = new Date(start);


            let date_start_filter_absen = $('#date_start_filter_absen').val();
            $(`#date_end_filter_absen`).empty();
            if (!date_start_filter_absen) {
                $(`#date_start_filter_absen`).empty();
            }
            var loop_date_start = new Date(date_start_filter_absen);
            if (loop_date_start) {
                loop_date_start.setDate(loop_date_start.getDate() - 1);
            }
            while (loop <= end) {
                // cg('stert', loop);
                if (date_start_filter_absen) {
                    if (loop >= loop_date_start) {
                        $(`#date_end_filter_absen`).prepend(` <option>${formatDate(loop)}</option>`)
                    }
                } else {
                    $(`#date_start_filter_absen`).append(` <option>${formatDate(loop)}</option>`);
                    $(`#date_end_filter_absen`).prepend(` <option>${formatDate(loop)}</option>`)
                }


                var newDate = loop.setDate(loop.getDate() + 1);
                loop = new Date(newDate);
            }
            // $('#date_start_filter_absen').val(formatDate(start));
            $('#date_end_filter_absen').val(formatDate(end));
            if (end > date_today) {
                // end = date_today;
                $(`#date_end_filter_absen`).val(formatDate(date_today));
            }
        }

        function checkedAll(name) {
            cg('name', name);
            let isAllChecked = $('#checked-all-' + name)[0].checked;
            if (isAllChecked) {
                arr_filter[name] = value_checkbox[name];
                $('.element-' + name).prop('checked', true);

            } else {
                $('.element-' + name).prop('checked', false);
                arr_filter[name] = [];
            }
            cg('arr_coal_from', arr_filter);
        }

        function changeChecked(idEl_, uuid, name) {
            cg('name', name);
            let value_id = $(`input[type='checkbox'][name='${idEl_}']:checked`).val();

            if (value_id) {
                arr_filter[name].push(value_id);
            } else {
                const index = arr_filter[name].indexOf(uuid);
                const x = arr_filter[name].splice(index, 1);
            }
            cg('arr_filter', arr_filter);
        }

        function openModalAbsen() {
            $('#create-absen').modal('show');
            $('#long_absen').val('1');
            changeLong();
        }

        function openModalExportDialy() {
            let dt_today = getDateTodayArr();




            $('#date_dialy').val(`${dt_today.year}-${dt_today.month}-${dt_today.day}`);
            $('#export-dialy').modal('show');
        }

        function exportAbsen() {
            startLoading();
            let _token = $('meta[name="csrf-token"]').attr('content');
            // cg('data_datatable', data_datatable);
            let data_ex = JSON.stringify(data_datatable);
            let data_other_response = JSON.stringify(data_response['data_response']['data_other_employee']);
            $.ajax({
                url: '/user/absensi/export+data',
                type: "POST",
                data: {
                    _token: _token,
                    data_export: data_ex,
                    data_other_response: data_other_response,
                    filter: filter
                },
                success: function(response) {
                    cg('response', response);
                    // return false;
                    var dlink = document.createElement("a");
                    dlink.href = `/${response.data}`;
                    dlink.setAttribute("download", "");
                    dlink.click();
                    stopLoading();
                },
                error: function(response) {
                    cg('err export', response)
                    alertModal()
                }
            });
        }

        function changeLong() {
            let long_date = $('#long_absen').val();
            var date1 = $("#date_start_absen").val();
            var dateStart = new Date(date1);
            let dateEnd = addDays(dateStart, (parseInt(long_date) - 1));
            let yearDate = dateEnd.getFullYear();
            let monthDate = padToDigits(2, dateEnd.getMonth() + 1);
            let dayDate = padToDigits(2, dateEnd.getDate());
            $("#date_end_absen").val(yearDate + '-' + monthDate + '-' + dayDate);
        }

        function storeAbsenModal(idForm) {
            if (isRequiredCreate(['date_end_absen', 'employee_uuid-absen']) > 0) {
                return false;
            }
            globalStoreNoTable(idForm).then((data) => {
                let user = data.data;
                console.log(user);
                stopLoading();
                $('#success-modal-id').modal('show')
            })
        }

        function changeDate() {
            var date1 = $("#date_start_absen").val();
            var date2 = $("#date_end_absen").val();
            var dateStart = new Date(date1);
            var dateEnd = new Date(date2);
            dateEnd.setDate(dateEnd.getDate() + 1);
            var Difference_In_Time = dateEnd.getTime() - dateStart.getTime();

            // To calculate the no. of days between two dates
            var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

            $('#long_absen').val(Difference_In_Days);

        }


        function onSaveFilter() {

            let admin_fingger = $('#admin-fingger').val();
            cg('admin_fingger', admin_fingger);

            filter.arr_filter = arr_filter;
            let date_filter = {
                date_start_filter_absen: $('#date_start_filter_absen').val(),
                date_end_filter_absen: $('#date_end_filter_absen').val(),
            };
            filter.date_filter = date_filter;
            cg('filter', filter);
            filter.nik_employee = null;
            cg('data_database', data_database);

            showDataTable();
        }

        function showDataTable() {
            var start = new Date($('#date_start_filter_absen').val());
            var end = new Date($('#date_end_filter_absen').val());
            $('#tableabsen').remove();
            var loop = new Date(start);
            let el_date_month_header = [];
            startLoading();
            let arr_date = [];
            while (loop <= end) {
                el_date_month_header = `${el_date_month_header}<th class="no-sort">${formatDateArr(loop).day}</th>`;
                arr_date.push(formatDate(loop));
                //don't remove it
                var newDate = loop.setDate(loop.getDate() + 1);
                loop = new Date(newDate);
            }

            var table_element = ` 
                                         <div class="pb-20" id="tableabsen">
                                            <table id="table-absen" class="display nowrap stripe hover table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th><div class="" style="width:300px">
                                                            <label for="">Nama</label>
                                                        </div></th>  
                                                         ${el_date_month_header}
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>`;

            $('#the-table').append(table_element);

            $.ajax({
                url: '/user/absensi/data-x',
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    filter: filter,
                    admin_absen:$('#admin-fingger').val()
                },
                success: function(response) {
                    cg('response showDataTable', response);
                    // return false;
                    
                    data_response = response.data;
                    data_datatable = response.data.data_filter_math;

                    let for_data_datatable = [];
                    Object.values(data_datatable).forEach(element => {
                        for_data_datatable.push(element);
                    });

                    let data = [];

                    data.push(element_profile_employee);

                    

                    arr_date.forEach(element_data => {
                        var element_date = {
                            mRender: function(data, type, row) {
                                let color_button_el = 'light';
                                let status_absen_el = 'X';
                                let uuid = `${element_data}-${row.machine_id}`;
                                let cek_log = '-';
                                if (row.data) {
                                    if (row.data[element_data]) {
                                        uuid = row.data[element_data]['uuid']
                                        color_button_el = color_button[row.data[element_data][
                                            'math'
                                        ]];
                                        status_absen_el = row.data[element_data][
                                            'status_absen_code'
                                        ];

                                        if (row.data[element_data]['cek_log']) {
                                            cek_log = row.data[element_data]['cek_log'];
                                        }
                                    }
                                }
                                var date_this_data = new Date(element_data);

                                return `     
                                <div class="row justify-content-md-center">
                                    <div class="col-12 justify-content-md-center"><sup>${formatDateArr(date_this_data).day}</sup></div>
                                    <div class="col-12 justify-content-md-center">
                                        <button type="button" name="status_absen_uuid" 
                                            onclick="editAbsenLive('status_absen_uuid-text-${uuid}','${row.nik_employee}','${element_data}','${row.machine_id}')"
                                            class="btn btn-${color_button_el}"
                                            id="status_absen_uuid-text-${uuid}">
                                            ${status_absen_el}                                            
                                        </button>   
                                    </div>
                                </div>                           
                                                                           
                                        `
                            }
                        };

                        data.push(element_date)
                    });


                    $('#table-absen').DataTable({
                        scrollX: true,
                        scrollY: "600px",
                        paging: true,
                        serverSide: false,
                        data: for_data_datatable,
                        columns: data,

                    });
                    stopLoading();
                },
                error: function(response) {
                    cg('response', response)
                    alertModal()
                }
            });

        }

        function editAbsenLive(id_element, employee_uuid, date_value, machine_id) {
            let data_emp = data_database['data_employees'][employee_uuid];
            $('#name-date').text(`${data_emp.name} - ${date_value}`);
            $('#employee_uuid-edit-live').val(`${machine_id}`);
            $('#date-edit-live').val(`${date_value}`);
            let cek_log = '-';
            if (typeof(data_datatable[employee_uuid]['data'][date_value]) != 'undefined') {
                cek_log = data_datatable[employee_uuid]['data'][date_value]['cek_log'];
            }
            $('#cek_log-live').val(`${cek_log}`);
            $('#button-status_absen_uuid').empty();

            Object.values(data_database.data_status_absens).forEach(element_status_absen => {
                $(`#button-status_absen_uuid`).append(`
                        <button onclick="editStoreLive('${element_status_absen.uuid}')" class="col-2 btn btn-${color_button[element_status_absen.math]} mr-2 mb-1">${element_status_absen.uuid}</button>
                    `);
            });
            $('#modal-edit-live').modal('show');
        }

        function editStoreLive(status_absen_uuid) {

            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/user/absensi/store',
                type: "POST",
                data: {
                    _token: _token,
                    employee_uuid: $('#employee_uuid-edit-live').val(),
                    date: $('#date-edit-live').val(),
                    status_absen_uuid: status_absen_uuid,
                    cek_log: $('#cek_log-live').val()
                },
                success: function(response) {
                    cg('response editStoreLive', `status_absen_uuid-text-${response.data.uuid}`);

                    // status_absen_uuid-text-2023-01-05-MBLE-230857

                    $(`#status_absen_uuid-text-${response.data.uuid}`).text(response.data.status_absen_uuid);
                    $(`#status_absen_uuid-text-${response.data.uuid}`).attr('class',
                        `btn btn-${color_button[data_database.data_status_absens[response.data.status_absen_uuid]['math']]}`
                    );
                    stopLoading();
                },
                error: function(response) {
                    alertModal()
                }
            });
        }


        function firstIndexEmployeeAbsen() {

            $.ajax({
                url: '/activity/get-data-table',
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    data: {
                        table_name: "DATABASE-KELOMPOK-ABSEN"
                    },
                },
                success: function(response) {
                    // $('#success-modal').modal('show')
                    let database_kelompok_absen = response.data;
                    // isi pada filter admin
                    Object.values(database_kelompok_absen).forEach(element => {

                        $('#admin-fingger').append(`<option value="${element['NAMA-KELOMPOK']['code_data']}">${element['NAMA-KELOMPOK']['value_field']}</option>`);
                    });
                    
                    
                },
                error: function(response) {
                    cg('error', response);
                    alertModal()
                }
            });

            let arrrr = [];
            cg('aaa', dataUser);
            Object.values(data_database.data_companies).forEach(company_uuid_element => {
                if (dataUser['user_privileges'][`company_privilege_${company_uuid_element.uuid}`]) {
                    arrrr.push(company_uuid_element.uuid);
                    $('.company-filter').append(`
                    <div class="col-auto">
                        <div class="custom-control custom-checkbox mb-5">
                            <input onchange="changeChecked('filter-company-${company_uuid_element.uuid}','${company_uuid_element.uuid}', 'company')" type="checkbox" class="custom-control-input element-company" value="${company_uuid_element.uuid}"
                                id="filter-company-${company_uuid_element.uuid}" name="filter-company-${company_uuid_element.uuid}">
                            <label class="custom-control-label" for="filter-company-${company_uuid_element.uuid}">${company_uuid_element.company}</label>
                        </div>
                    </div>
                `);
                }

            });
            value_checkbox['company'] = arrrr;

            arrrr = [];
            Object.values(data_database.data_atribut_sizes.site_uuid).forEach(site_uuid_element => {
                if (dataUser['user_privileges'][`site_privilege_${site_uuid_element.uuid}`]) {
                    $('.site-filter').append(`
                        <div class="col-auto">
                            <div class="custom-control custom-checkbox mb-5">
                                <input onchange="changeChecked('filter-site_uuid-${site_uuid_element.uuid}','${site_uuid_element.uuid}', 'site_uuid')" type="checkbox" class="custom-control-input element-site_uuid" value="${site_uuid_element.uuid}"
                                    id="filter-site_uuid-${site_uuid_element.uuid}" name="filter-site_uuid-${site_uuid_element.uuid}">
                                <label class="custom-control-label" for="filter-site_uuid-${site_uuid_element.uuid}">${site_uuid_element.name_atribut}</label>
                            </div>
                        </div>
                    `);

                    $('.site-radio').append(`
                        <div class="col-auto">
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="site-radio-${site_uuid_element.uuid}" name="site_uuid_dialy"
                                    class="custom-control-input" value="${site_uuid_element.uuid}" />
                                <label class="custom-control-label" for="site-radio-${site_uuid_element.uuid}">${site_uuid_element.name_atribut}</label>
                            </div>
                        </div>
                    `);

                    arrrr.push(site_uuid_element.uuid);
                }
            });
            value_checkbox['site_uuid'] = arrrr;
            arrrr = [];
            Object.values(data_database.data_math_status_absens).forEach(math_element => {
                $('.math').append(`<div class="col-auto">
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input onchange="changeChecked('filter-math-${math_element.math}','${math_element.math}', 'math')" type="checkbox" class="custom-control-input element-math" value="${math_element.math}"
                                                        id="filter-math-${math_element.math}" name="filter-math-${math_element.math}">
                                                        <label class="custom-control-label" for="filter-math-${math_element.math}">${math_element.math}</label>
                                                    </div>
                                                </div>`);

                $('.multiple-select-status-absen').append(`
                    <optgroup label="${math_element.math}" id="${math_element.math}">
                     
                    </optgroup>`);




                arrrr.push(math_element.math);
            });
            arrrr.push('unknown_absen');
            value_checkbox['math'] = arrrr;
            filter.value_checkbox = value_checkbox;
            // arr_filter= value_checkbox;


            $('#date_start_absen').val(getDateToday());
            $(`#unpay`).append(
                `<option value="unknown_absen">? - Tidak diketahui</option>`
            );
            Object.values(data_database.data_status_absens).forEach(data_status_absen_element => {
                $(`#status_absen_uuid`).append(
                    `<option value="${data_status_absen_element.uuid}">${data_status_absen_element.uuid} - ${data_status_absen_element.status_absen_description}</option>`
                );

                $(`#${data_status_absen_element.math}`).append(
                    `<option value="${data_status_absen_element.uuid}">${data_status_absen_element.uuid} - ${data_status_absen_element.status_absen_description}</option>`
                );

                // $().append();
            });
            Object.values(data_database.data_employees).forEach(data_employee_element => {
                $(`.employees`).append(
                    `<option value="${data_employee_element.machine_id}">${data_employee_element.name} - ${data_employee_element.position}</option>`
                );
            });
            loopDateFilter();
            showDataTable();





            year = arr_date_today.year;
            month = arr_date_today.month;

            $('.date-setup').attr('hidden', false);
            $('#btn-year').html(arr_date_today.year);
            $('#btn-month').html(months[parseInt(arr_date_today.month)]);
            $('#btn-month').val(arr_date_today.month);
            $('#btn-export-template').attr('href', '/user/absensi/export-template/' + arr_date_today.year + '-' +
                arr_date_today.month)
        }

        firstIndexEmployeeAbsen();



        function changeAbsen() {
            $(`#`).empty()
        }

        function storeFileAbsen() {
            $(`.modal-body`).append(`<input type="text" name="" id="">`)
        }

        function storeAbsen(uuid, status_absen_uuid) {
            $(`#status_absen_uuid-${uuid}`).val(status_absen_uuid);
            let idForm = uuid;
            let _url = $('#form-' + idForm).attr('action');
            var form = $('#form-' + idForm)[0];
            var form_data = new FormData(form);
            return $.ajax({
                url: _url,
                type: "POST",
                contentType: false,
                processData: false,
                data: form_data,
                success: function(response) {
                    cg('response', response);
                    $(`#status_absen_uuid-text-${uuid}`).text(response.data.status_absen_uuid);
                    $(`#status_absen_uuid-text-${uuid}`).attr('class',
                        `btn btn-${color_button[data_database.data_status_absens[response.data.status_absen_uuid]['math']]}`
                    );

                },
                error: function(response) {
                    alertModal()
                }
            });

        }

        function storeUserDocument(idForm) {
            startLoading();
            let date_absen_start = $('#date_absen_start').val();
            let _url = $('#form-' + idForm).attr('action');
            var form = $('#form-' + idForm)[0];
            var form_data = new FormData(form);
            $.ajax({
                url: _url,
                type: "POST",
                contentType: false,
                processData: false,
                data: form_data,
                success: function(response) {
                    $('#loading-modal').modal('hide');
                    cg('response', response);
                    // return false;
                    if (response.message == 'excel') {
                        showModalMessage('import success');
                        return false;
                    }

                    if (!date_absen_start) {
                        $('.date-setup').attr('hidden', false);
                        dt_start = response.data.date_absen_start;
                        dt_end = response.data.date_absen_end;
                        loopDate();
                    } else {
                        console.log(response);
                        // return false;
                        window.location.href = "/user/absensi/after-import";
                    }
                },
                error: function(response) {
                    cg('errr', response);
                    alertModal()
                }
            });
        }

        function loopDate() {
            var start = new Date(dt_start);
            var end = new Date(dt_end);

            var loop = new Date(start);

            let date_absen_start = $('#date_absen_start').val();
            if (date_absen_start) {
                $(`#date_absen_end`).empty();
            }

            while (loop <= end) {
                if (date_absen_start) {
                    var loop_date_start = new Date(date_absen_start);
                    if (loop > loop_date_start) {
                        $(`#date_absen_end`).prepend(` <option>${formatDate(loop)}</option>`)
                    }
                } else {
                    $(`#date_absen_start`).append(` <option>${formatDate(loop)}</option>`);
                    $(`#date_absen_end`).prepend(` <option>${formatDate(loop)}</option>`)
                }
                var newDate = loop.setDate(loop.getDate() + 1);
                loop = new Date(newDate);
            }
            $('#date_absen_end').val(dt_end);
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

            $('#btn-export-template').attr('href', '/user/absensi/export-template/' + arr_date_today.year + '-' +
                arr_date_today.month)
            $(`#date_start_filter_absen`).empty();
            $(`#date_start_filter_absen`).val(null);
            loopDateFilter();
            onSaveFilter();
            setDateSession(year, month);
        }
    </script>
@endsection
