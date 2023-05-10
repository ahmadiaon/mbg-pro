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
                    <div class="col-md-6">
                        <select onchange="loopDateFilter()" style="width: 100%;" name="date_start_filter_absen"
                            id="date_start_filter_absen" class="custom-select2 form-control">
                        </select>
                    </div>
                    <div class="col-md-6">
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
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false" id="btn-month" value="">
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
                            <input name="uploaded_file" type="file"
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
                <input type="text" name="" id="employee_uuid-edit-live">
                <input type="text" name="" id="date-edit-live">

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
        let v_year;
        let v_month;
        let _url;
        let dt_end;
        let dt_start;
        let data_datatable;

        let color_button = {
            alpa: 'danger',
            pay: 'primary',
            unpay: 'secondary',
            cut: 'warning'
        };

        let arr_site_uuid = [];
        let arr_status_absen = [];

        function loopDateFilter() {
            cg('loopDateFilter', arr_date_today);
            var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
            var end = new Date(arr_date_today.year, arr_date_today.month, 0);
            cg(start, end);

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

        function exportAbsen() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            cg('data_datatable', data_datatable);
            let data_ex = JSON.stringify(data_datatable);
            $.ajax({
                url: '/user/absensi/export',
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
                },
                error: function(response) {
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
            filter.arr_filter = arr_filter;
            let date_filter = {
                date_start_filter_absen: $('#date_start_filter_absen').val(),
                date_end_filter_absen: $('#date_end_filter_absen').val(),
            };
            filter.date_filter = date_filter;
            cg('filter', filter);
            showDataTable();
        }

        function showDataTable() {
            var start = new Date($('#date_start_filter_absen').val());
            var end = new Date($('#date_end_filter_absen').val());
            $('#tableabsen').remove();
            var loop = new Date(start);
            let el_date_month_header = [];

            let arr_date = [];
            while (loop <= end) {
                el_date_month_header = `${el_date_month_header}<th>${formatDateArr(loop).day}</th>`;
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
                                                        <th>Nama</th>
                                                        <th>Dibayar</th>
                                                        <th>Potongan</th>                                                        
                                                        <th>Alpa</th>     
                                                         <th>Action</th>
                                                         ${el_date_month_header}
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>`;

            $('#the-table').append(table_element);

            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/user/absensi/data-x',
                type: "POST",
                data: {
                    _token: _token,
                    filter: filter
                },
                success: function(response) {
                    data_datatable = response.data.data_filter_math;

                    let for_data_datatable = [];
                    Object.values(data_datatable).forEach(element => {
                        for_data_datatable.push(element);
                    });
                    cg('response', response);
                    let data = [];

                    data.push(element_profile_employee);
                    var element_date = {
                        mRender: function(data, type, row) {
                            return row.absensi.count_pay;
                        }
                    };

                    data.push(element_date);

                    var element_cut = {
                        mRender: function(data, type, row) {
                            return row.absensi.count_cut;
                        }
                    };

                    data.push(element_cut);

                    var element_alpa = {
                        mRender: function(data, type, row) {
                            return row.absensi.count_alpa;
                        }
                    };

                    data.push(element_alpa);

                    var elements = {
                        mRender: function(data, type, row) {
                            return `
									<div class="form-inline"> 
                                        <a href="/user/absensi/detail/${ arr_date_today.year}-${arr_date_today.month}/${row.nik_employee}">
										<button type="button" class="btn btn-secondary mr-1  py-1 px-2">
											<i class="dw dw-edit2"></i>
										</button>
                                        </a>
									</div>`
                        }
                    };
                    data.push(elements);

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
                                        cek_log = row.data[element_data]['cek_log'];
                                    }
                                }

                                return `                                
                                        <button type="button" name="status_absen_uuid" 
                                            onclick="editAbsenLive('status_absen_uuid-text-${uuid}','${row.nik_employee}','${element_data}','${row.machine_id}')"
                                            class="btn btn-${color_button_el}"
                                            id="status_absen_uuid-text-${uuid}">
                                            ${status_absen_el}                                            
                                        </button>                                       
                                        `
                            }
                        };

                        data.push(element_date)
                    });


                    $('#table-absen').DataTable({
                        scrollX: true,
                        scrollY: "600px",
                        paging:false,
                        serverSide: false,
                        data: for_data_datatable,
                        columns: data
                    });
                },
                error: function(response) {
                    alertModal()
                }
            });
        }

        function editAbsenLive(id_element, employee_uuid, date_value, machine_id) {
            let data_emp = data_database['data_employees'][employee_uuid];
            $('#name-date').text(`${data_emp.name} - ${date_value}`);
            $('#employee_uuid-edit-live').val(`${machine_id}`);
            $('#date-edit-live').val(`${date_value}`);
            $('#cek_log-live').val(`${data_datatable[employee_uuid]['data'][date_value]['cek_log']}`);
            $('#button-status_absen_uuid').empty();

            Object.values(data_database.data_status_absens).forEach(element_status_absen => {
                $(`#button-status_absen_uuid`).append(`
                        <button onclick="editStoreLive('${element_status_absen.uuid}')" class="col-2 btn btn-${color_button[element_status_absen.math]} mr-2 mb-1">${element_status_absen.uuid}</button>
                    `);
            });
            cg('xx', `${data_datatable[employee_uuid]['data'][date_value]['cek_log']}`)
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
                    cek_log:$('#cek_log-live').val()
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

            let arrrr = [];

            Object.values(data_database.data_companies).forEach(company_uuid_element => {
                $('.company-filter').append(`
                    <div class="col-auto">
                        <div class="custom-control custom-checkbox mb-5">
                            <input onchange="changeChecked('filter-company-${company_uuid_element.uuid}','${company_uuid_element.uuid}', 'company')" type="checkbox" class="custom-control-input element-company" value="${company_uuid_element.uuid}"
                                id="filter-company-${company_uuid_element.uuid}" name="filter-company-${company_uuid_element.uuid}">
                            <label class="custom-control-label" for="filter-company-${company_uuid_element.uuid}">${company_uuid_element.company}</label>
                        </div>
                    </div>
                `);
                arrrr.push(company_uuid_element.uuid);
            });
            value_checkbox['company'] = arrrr;

            arrrr = [];
            Object.values(data_database.data_atribut_sizes.site_uuid).forEach(site_uuid_element => {
                $('.site-filter').append(`
                    <div class="col-auto">
                        <div class="custom-control custom-checkbox mb-5">
                            <input onchange="changeChecked('filter-site_uuid-${site_uuid_element.uuid}','${site_uuid_element.uuid}', 'site_uuid')" type="checkbox" class="custom-control-input element-site_uuid" value="${site_uuid_element.uuid}"
                                id="filter-site_uuid-${site_uuid_element.uuid}" name="filter-site_uuid-${site_uuid_element.uuid}">
                            <label class="custom-control-label" for="filter-site_uuid-${site_uuid_element.uuid}">${site_uuid_element.name_atribut}</label>
                        </div>
                    </div>
                `);


                arrrr.push(site_uuid_element.uuid);
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
                arrrr.push(math_element.math);
            });
            arrrr.push('unknown_absen');
            value_checkbox['math'] = arrrr;
            filter.value_checkbox = value_checkbox;
            // arr_filter= value_checkbox;


            $('#date_start_absen').val(getDateToday());
            Object.values(data_database.data_status_absens).forEach(data_status_absen_element => {
                $(`#status_absen_uuid`).append(
                    `<option value="${data_status_absen_element.uuid}">${data_status_absen_element.uuid} - ${data_status_absen_element.status_absen_description}</option>`
                );
            });
            Object.values(data_database.data_employees).forEach(data_employee_element => {
                $(`.employees`).append(
                    `<option value="${data_employee_element.machine_id}">${data_employee_element.name} - ${data_employee_element.position}</option>`
                );
            });
            loopDateFilter();
            onSaveFilter();





            year = arr_date_today.year;
            month = arr_date_today.month;
            v_year = arr_date_today.year;
            v_month = arr_date_today.month;
            _url = 'user/absensi/data/' + arr_date_today.year + '-' + arr_date_today.month;

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
                    cg('response', response);
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
