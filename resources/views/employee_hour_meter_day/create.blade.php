@extends('template.admin.main_privilege')
@section('content')
    <div class="mb-30">
        <div class="row">
            <div class="col-7">
                <!-- Simple Datatable start -->
                <div class="card-box  mb-30">
                    <form action="/hour-meter/store" id="form-hour-meter" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="uuid" id="uuid">
                        <div class="pd-20">
                            <div class="row">
                                <div class="col">
                                    <h4 class="text-blue h4">Tambah HM Karyawan</h4>
                                </div>
                                <div class="col text-right">
                                    <div class="button-group text-right">
                                        <button type="button" onclick="resetData()"
                                            class="btn btn-secondary">Reset</button>
                                        <button type="button" onclick="storeSingle('hour-meter')" class="btn btn-primary">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pd-20">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee_checker_uuid">Pilih Checker</label>
                                    <select name="employee_checker_uuid" id="employee_checker_uuid"
                                        class="custom-select2 form-control employees">
                                        <option value="">karyawan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee_foreman_uuid">Pilih Foreman</label>
                                    <select name="employee_foreman_uuid" id="employee_foreman_uuid"
                                        class="custom-select2 form-control employees">
                                        <option value="">karyawan</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="employee_supervisor_uuid">Pilih Supervisor</label>
                                    <select name="employee_supervisor_uuid" id="employee_supervisor_uuid"
                                        class="custom-select2 form-control employees">
                                        <option value="">karyawan</option>
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="row pd-20">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_uuid">Pilih Karyawan</label>
                                    <select onchange="employeeChosee()" name="employee_uuid" id="employee_uuid"
                                        class="custom-select2 form-control employees">
                                        <option value="">karyawan</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">Tanggal</label>
                                    <input type="date" name="date" id="date" value="" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row justify-content-md-center">
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <label for="">Shift</label>
                                            <div>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label id="lbl-Siang" class="btn btn-outline-primary">
                                                        <input type="radio" name="shift" id="Siang" value="Siang"
                                                            checked="checked" autocomplete="off">
                                                        Siang
                                                    </label>

                                                    <label id="lbl-Malam" class="btn btn-outline-primary">
                                                        <input type="radio" name="shift" id="Malam" value="Malam"
                                                            autocomplete="off">
                                                        Malam
                                                    </label>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-auto text-center">
                                        <div class="form-group">
                                            <label for="value">Nilai HM</label>
                                            <input onkeyup="fullValue()" type="text" name="value" id="value"
                                                value="" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-auto text-center">
                                        <div class="form-group">
                                            <label class="">Aktifkan bonus ?</label>
                                            <div class="custom-control custom-checkbox mb-5">
                                                <input type="checkbox" checked name="is_bonus" class="custom-control-input"
                                                    id="is_bonus" />
                                                <label class="custom-control-label" for="is_bonus">bonus</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row justify-content-md-center" id="hour-meter-prices">
                                    <div class="col-12 text-center"><label class="weight-600 ">Harga HM</label>
                                    </div>
                                    <input type="hidden" id="hour_meter_price_uuid">
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>

            <!-- Filter -->
            <div class="col-md-5 mb-10">
                <div class="card-box pd-20" id="the-filter-employee-tonase">
                    <h4 class="text-blue h4">Filter</h4>

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

                    <div class="form-group mb-20">
                        <div class="form-group row">
                            <label class="col-auto">Harga HM</label>
                            <div class="col text-right custom-control custom-checkbox mb-5">
                                <input onchange="checkedAll('hour_meter_price')" type="checkbox"
                                    class="custom-control-input" id="checked-all-hour_meter_price">
                                <label class="custom-control-label" for="checked-all-hour_meter_price">Pilih
                                    Semua</label>
                            </div>
                        </div>

                        <div class="row justify-content-md-center hour_meter_price">

                        </div>
                    </div>
                    {{-- rentang wAKTU --}}
                    <div class="form-group row">
                        <label class="col-md-12 text-center">Rentang Waktu</label>
                        <div class="col-md-6">
                            <select onchange="loopDateFilter()" style="width: 100%;" name="date_start_filter_hm"
                                id="date_start_filter_hm" class="custom-select2 form-control">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select style="width: 100%;" name="date_end_filter_hm" id="date_end_filter_hm"
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
    </div>
    </div>


    <!-- Simple Datatable start -->
    <div class="card-box mb-30">
        <div class="row justify-content-md-center pd-20">
            <div class="col-md-2">
                <h4 class="text-blue h4">HM</h4>
            </div>
            <div class="col-10 text-right">
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
                            <a class="dropdown-item" onclick="refreshTable(null, 1 )" href="#">Januari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 2 )" href="#">Februari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 3 )" href="#">Maret</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 4 )" href="#">April</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 5 )" href="#">Mei</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 6 )" href="#">Juni</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 7 )" href="#">Juli</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 8 )" href="#">Agustus</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 9 )" href="#">September</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 10 )" href="#">Oktober</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 11 )" href="#">November</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 12 )" href="#">Desember</a>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                            data-toggle="dropdown" aria-expanded="false" id="btn-day" value="Perbulan">
                            <span id="btn-day" class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a id="each-month" class="dropdown-item" onclick="refreshTable(null, null)"
                                href="#">Perbulan</a>

                            <div class="row">
                                <div class="col-3">
                                    <div class="btn-group-vertical" id="ten-one">
                                        {{-- tanggal 1- 10 --}}
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="btn-group-vertical" id="ten-two">
                                        {{-- tanggal 11-20 --}}
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="btn-group-vertical" id="ten-three">
                                        {{-- tanggal 20-akhir --}}
                                    </div>
                                </div>
                            </div>

                            <label for=""></label>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect"
                            data-toggle="dropdown" aria-expanded="false">
                            Menu <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/tonase/create">Tambah</a>
                            <a class="dropdown-item" id="btn-template"disabled href="/hour-meter/template">Template</a>
                            <a class="dropdown-item" id="btn-template"disabled onclick="exportData()" href="#">Export</a>
                            <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                href="">Import</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="employee-hour-meter">
            <table id="table-employee-hour-meter" class="display nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        <th>Karyawan</th>
                        <th>Harga HM</th>
                        <th>Total Slip</th>
                        <th>Total HM</th>
                        <th>01</th>
                        <th>02</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- impoort modal-->
    <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-import" action="/hour-meter/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih File</label>
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
@endsection
@section('js')
    <script>
        let value_checkbox = {
            'company': null,
            'site_uuid': null,
            'hour_meter_price': null
        };

        let data_table_uuid = [];
        let nik_employee = @json(session('dataUser')->nik_employee);

        var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
        var end = new Date(arr_date_today.year, arr_date_today.month, 0);
        let data_show_type = 'real';
        let data_datable = [];
        let element_before = {
            uuid: null,
            value: 0
        };

        let arr_filter = {
            'company': [],
            'site_uuid': [],
            'hour_meter_price': []
        };


        let filter = {
            'value_checkbox': [],
            'is_combined': true,
            'show_type': 'employee',
            'arr_filter': {
                'company': [],
                'site_uuid': [],
                'haour_meter_price': []
            },
            'data_show_type': data_show_type,
            'date_filter': {
                date_start_filter_hm: formatDate(start),
                date_end_filter_hm: formatDate(end),
            },
            nik_employee: nik_employee
        };





        function loopDateFilter() {
            cg('loopDateFilter', arr_date_today);
            var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
            var end = new Date(arr_date_today.year, arr_date_today.month, 0);
            cg(start, end);

            var loop = new Date(start);

            let date_start_filter_hm = $('#date_start_filter_hm').val();
            $(`#date_end_filter_hm`).empty();
            if (!date_start_filter_hm) {
                $(`#date_start_filter_hm`).empty();
            }

            cg('date_start_filter_hm', date_start_filter_hm);
            cg('loop', loop)
            var loop_date_start = new Date(date_start_filter_hm);
            if (loop_date_start) {
                loop_date_start.setDate(loop_date_start.getDate() - 1);
            }
            while (loop <= end) {
                // cg('stert', loop);
                if (date_start_filter_hm) {
                    if (loop >= loop_date_start) {
                        $(`#date_end_filter_hm`).prepend(` <option>${formatDate(loop)}</option>`)
                    }
                } else {
                    $(`#date_start_filter_hm`).append(` <option>${formatDate(loop)}</option>`);
                    $(`#date_end_filter_hm`).prepend(` <option>${formatDate(loop)}</option>`)
                }
                var newDate = loop.setDate(loop.getDate() + 1);
                loop = new Date(newDate);
            }
            // $('#date_start_filter_hm').val(formatDate(start));
            $('#date_end_filter_hm').val(formatDate(end));
        }

        function refreshTable(val_year = null, val_month = null, val_day) {
            console.log('refreshTable');
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

            if (val_day) {
                $('#btn-day').html(val_day);
                arr_date_today.day = val_day;
                onSaveFilter();
                return false;
            }
            arr_date_today.day = null;
            $('#btn-day').html("Perbulan");
            $(`#date_start_filter_hm`).empty();
            $(`#date_start_filter_hm`).val(null);
            loopDateFilter();
            setDatesMonth();
            onSaveFilter();
            setDateSession(year, month);
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
            cg('name', idEl_);
            let value_id = $(`input[type='checkbox'][name='${idEl_}']:checked`).val();
            if (value_id) {
                arr_filter[name].push(value_id);
            } else {
                const index = arr_filter[name].indexOf(uuid);
                const x = arr_filter[name].splice(index, 1);
            }
            cg('arr_filter', arr_filter);
        }

        function onSaveFilter() {
            data_show_type = $("input[type='radio'][name='data_show_type']:checked").val();
            let date_filter = {
                date_start_filter_hm: $('#date_start_filter_hm').val(),
                date_end_filter_hm: $('#date_end_filter_hm').val(),
            };
            filter.date_filter = date_filter;
            filter.data_show_type = data_show_type;
            filter.arr_filter = arr_filter;

            cg('filter', filter);
            showDataTableEmployeeHourMeteDay();
            // showDataTableEmployeeAbsen('udin', ['pay', 'cut', 'A'], 'table-absen')
        }

        function loopDateFilter() {
            var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
            var end = new Date(arr_date_today.year, arr_date_today.month, 0);


            var loop = new Date(start);

            let date_start_filter_hm = $('#date_start_filter_hm').val();
            if (date_start_filter_hm) {
                $(`#date_end_filter_hm`).empty();
            }

            while (loop <= end) {
                if (date_start_filter_hm) {
                    var loop_date_start = new Date(date_start_filter_hm);
                    if (loop >= loop_date_start) {
                        $(`#date_end_filter_hm`).prepend(` <option>${formatDate(loop)}</option>`)

                    }
                } else {
                    $(`#date_start_filter_hm`).append(` <option>${formatDate(loop)}</option>`);
                    $(`#date_end_filter_hm`).prepend(` <option>${formatDate(loop)}</option>`)
                }
                var newDate = loop.setDate(loop.getDate() + 1);
                loop = new Date(newDate);
            }
            $('#date_end_filter_hm').val(formatDate(end));
        }

        function editHM(uuid, value) {
            cg(uuid, uuid);


            $('.form-edit').remove()
            if (element_before.uuid) {
                $(`#${element_before.uuid}`).append(`
                    <button onclick="editHM('${element_before.uuid}','${element_before.value}')" type="button" class="btn btn-outline-primary">${element_before.value}</button>
                `);

            }
            element_before.uuid = uuid;
            element_before.value = value;
            cg('aaa', data_table_uuid);
            data_this = data_table_uuid[uuid];
            let isChecked = '';
            if (data_this['is_bonus'] == 'on') {
                isChecked = 'checked';
            }


            $(`#${uuid}`).empty();
            $(`#${uuid}`).append(`
                                        <form class="form-edit"  id="form-${uuid}" action="/hour-meter/store"  method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row justify-content-center">
                                                <div class="col-12 d-flex flex-row" >
                                                    <input   style="width: 40px;"  type="hidden" name="uuid" id="uuid-${uuid}" class="mr-1 form-control input-hm" value="${uuid}">
                                                    <input  autofocus style="width: 40px;"  type="text" name="value" id="input-${uuid}" class="mr-1 form-control input-hm" value="${value}">
                                                    <button type="button" onclick="storeHM('${uuid}')" class="btn btn-success">
                                                        <i class="icon-copy fa fa-save" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                                <label for="full_value" class="col-12 mr-1">Bonus? </label>
                                                <input type="checkbox" ${isChecked} 
                                                    name="is_bonus" class="col-12"
                                                    data-color="#0099ff" id="is_bonus" />
                                            </div>
                                        </form>
            `);

        }

        function addNewHM(employee_uuid, date_hm, uuid_element, hm_price_uuid) {
            cg(employee_uuid, uuid_element);
            $('.form-edit').remove();
            $(`#add-btn-${uuid_element}`).remove()

            $(`#${employee_uuid}-${date_hm}-${hm_price_uuid}`).append(`
                                    <div class="col" id="${uuid_element}" >
                                        <form class="form-edit" id="form-${uuid_element}" action="/hour-meter/store" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <input type="hidden" name="date" id="uuid-${uuid_element}"  value="${date_hm}">
                                                <input type="hidden" name="employee_uuid" id="employee_uuid-${uuid_element}"  value="${employee_uuid}">
                                                <input type="hidden" name="hour_meter_price_uuid" id="hm-${uuid_element}"  value="${hm_price_uuid}">
                                                <div class="col-12 d-flex flex-row" >
                                                    <input autofocus  style="width: 40px;" type="text" name="value" id="input-${uuid_element}" class="mr-1 form-control input-hm" value="0">
                                                    <button class="btn btn-success" type="button" onclick="storeHM('${uuid_element}')">
                                                        <i class="icon-copy fa fa-save" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                                <label for="full_value" class="col-12 mr-1">bonus : </label>

                                                <input type="checkbox" checked 
                                                    name="is_bonus" class="col-12"
                                                    data-color="#0099ff" id="is_bonus" />
                                            </div>
                                        </form>
                                    </div>
            `);
            let uuid = `${date_hm}-${employee_uuid}-${Math.floor((Math.random() * 1000) + 1)}`;


            $(`#${employee_uuid}-${date_hm}-${hm_price_uuid}`).append(`
                <div class="mb-1" id="add-btn-${uuid}" > 
                    <div onclick="addNewHM('${employee_uuid}','${date_hm}','${uuid}','${hm_price_uuid}')"><i class="icon-copy fa fa-plus-square-o" aria-hidden="true"></i></div>
                </div>    
            `)
        }

        function storeHM(uuid) {
            let value_hm = $(`#input-${uuid}`).val();
            globalStoreNoTable(uuid);

            $('.form-edit').remove();

            if (value_hm > 0) {
                $(`#${uuid}`).append(`
                    <button onclick="editHM('${uuid}','${value_hm}')" type="button" class="mb-1 btn btn-outline-primary">${value_hm}</button>
                `);
            } else {
                $(`#${uuid}`).remove();
            }
            element_before.uuid = null;
            element_before.value = null;
        }

        function storeSingle(idForm) {
            console.log(idForm)
            if (isRequiredCreate(['date', 'employee_uuid', 'hour_meter_price_uuid', 'value']) > 0) {
                return false;
            }

            globalStoreNoTable(idForm).then((data_value_) => {
                data_value_element = data_value_.data;
                cg('data_value_element',
                    `#${data_value_element.employee_uuid}-${data_value_element.date}-${data_value_element.hour_meter_price_uuid}`
                );
                if (data_value_element) {
                    $(`#${data_value_element.employee_uuid}-${data_value_element.date}-${data_value_element.hour_meter_price_uuid}`)
                        .prepend(`
                        <div class="mb-1 col-md-12 text-center" id="${data_value_element.uuid}">
                             <button onclick="editHM('${data_value_element.employee_uuid}-${data_value_element.date}-${data_value_element.hour_meter_price_uuid}','${data_value_element.value}')" type="button" class="mb-1 btn btn-outline-primary">${data_value_element.value}</button>
                        </div>    
                     `);
                    $('#sa-custom-position').click();
                }
            })
        }

        function employeeChosee() {
            let employee = $('#employee_uuid').val();
            data_emp = data_database.data_employees[employee];
            cg('data emp', data_emp);
            if (data_emp.hour_meter_price_uuid) {
                $(`#${data_emp.hour_meter_price_uuid}`).attr('checked', true);

            } else {
                $(`#${data_emp.hour_meter_price_uuid}`).attr('checked', true);
            }

        }


        function showDataTableEmployeeHourMeteDay() {
            var start = new Date(filter.date_filter.date_start_filter_hm);
            var end = new Date(filter.date_filter.date_end_filter_hm);
            $('#employee-hour-meter').empty();
            var loop = new Date(start);
            let el_date_header = ``;

            let arr_date = [];
            while (loop <= end) {
                el_date_header = `${el_date_header}<th>${formatDateArr(loop).day}</th>`;
                arr_date.push(formatDate(loop));
                //don't remove it
                var newDate = loop.setDate(loop.getDate() + 1);
                loop = new Date(newDate);
            }

            let element_table_hour_meter = `
                    <table id="table-employee-hour-meter" class="display nowrap stripe hover table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Data Karyawan</th>
                                <th>Harga HM</th>
                                <th>Total Slip</th>
                                <th>Total HM</th>
                                <th>Total HM Bonus</th>
                                ${el_date_header}
                            </tr>
                        </thead>
                    </table>
            `;


            $('#employee-hour-meter').append(element_table_hour_meter);

            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/hour-meter/data',
                type: "POST",
                data: {
                    _token: _token,
                    filter: filter
                },
                success: function(response) {
                    let data_datable_obj = response.data.data_datatable;
                    data_datable = [];
                    let arr_data_nik = [];
                    let hm_price = null;
                    cg('datatable', response);
                    data_table_uuid = response.data.data_table_uuid;

                    if (data_datable_obj) {
                        Object.values(data_datable_obj).forEach(element_data_datable_obj => {
                            data_datable.push(element_data_datable_obj);
                            arr_data_nik.push(
                                `${element_data_datable_obj['employee_uuid']}-"${element_data_datable_obj['hour_meter_price_uuid']}`
                                );
                        });
                    }
                    cg('datatable', arr_data_nik);

                    let data = [];


                    let dataTable = [
                        'count_slip_hm', 'sum_hm', 'sum_hm_bonus'
                    ];

                    data.push(element_profile_employee_session)

                    let element_hour_meter_price_uuid = {
                        mRender: function(data, type, row) {
                            return toValueRupiah(row.hour_meter_price_uuid);
                        }
                    }
                    data.push(element_hour_meter_price_uuid)



                    dataTable.forEach(element => {
                        var dataElement = {
                            data: element,
                            name: element
                        }
                        data.push(dataElement)
                    });
                    let value = '';

                    arr_date.forEach(element_date => {
                        var element_dates = {
                            mRender: function(data, type, row) {



                                let uuid =
                                    `${element_date}-${row.employee_uuid}-${Math.floor((Math.random() * 1000) + 1)}`;
                                value = '';
                                if (row.date) {
                                    if (row.date[element_date]) {
                                        let data_element_date = row.date[element_date];
                                        value = '';
                                        data_element_date.forEach(element_item_date => {
                                            let colorHM = 'primary';
                                            if (element_item_date.is_bonus == 'on') {
                                                colorHM = 'success';
                                            }
                                            value = `${value} <div class="mb-1 col-md-12 text-center " id="${element_item_date.uuid}" > 
                                                                    <button onclick="editHM('${element_item_date.uuid}','${element_item_date.value}')" type="button" class="btn btn-outline-${colorHM}">${element_item_date.value}</button>
                                                                 </div>`;
                                            hm_price = element_item_date
                                                .hour_meter_price_uuid;
                                        });

                                    }
                                }
                                let hm_price_ = hm_price;
                                return `   <div id="${row.employee_uuid}-${element_date}-${row.hour_meter_price_uuid}" class="row justify-content-center">                            
                                            ${value}  
                                            
                                                    <div class="mb-1" id="add-btn-${uuid}" > 
                                                        <div onclick="addNewHM('${row.employee_uuid}','${element_date}','${uuid}','${row.hour_meter_price_uuid}')"><i class="icon-copy fa fa-plus-square-o" aria-hidden="true"></i></div>
                                                    </div>
                                        `;
                            }
                        };
                        data.push(element_dates)
                    });


                    $('#table-employee-hour-meter').DataTable({
                        scrollX: true,
                        serverSide: false,
                        data: data_datable,
                        columns: data
                    });
                },
                error: function(response) {
                    alertModal()
                }
            });
        }

        function resetData() {
            console.log('resetData')
            $('#employee_uuid').val('').trigger('change');
        }



        function updatehour_meter_price_uuid(uuid) {
            $('#hour_meter_price_uuid').val(uuid);
        }

        function firstEmployeeHourMeterCreate() {
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
            Object.values(data_database.data_employees).forEach(employee_uuid_element => {
                $('.employees').append(`
                    <option value="${employee_uuid_element.nik_employee}">${employee_uuid_element.name} - ${employee_uuid_element.position}</option>
                `);

            });

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
            Object.values(data_database.data_atribut_sizes.hour_meter_price).forEach(hour_meter_price_element => {
                $('.hour_meter_price').append(`
                    <div class="col-auto">
                        <div class="custom-control custom-checkbox mb-5">
                            <input onchange="changeChecked('filter-hour_meter_price-${hour_meter_price_element.uuid}','${hour_meter_price_element.uuid}', 'hour_meter_price')" type="checkbox" class="custom-control-input element-hour_meter_price" value="${hour_meter_price_element.uuid}"
                                id="filter-hour_meter_price-${hour_meter_price_element.uuid}" name="filter-hour_meter_price-${hour_meter_price_element.uuid}">
                            <label class="custom-control-label" for="filter-hour_meter_price-${hour_meter_price_element.uuid}">${hour_meter_price_element.name_atribut}</label>
                        </div>
                    </div>
                `);
                $('#hour-meter-prices').append(`
                    <div class="col-auto">
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio"  id="${hour_meter_price_element.uuid}" name="hour_meter_price_uuid" onclick="updatehour_meter_price_uuid('${hour_meter_price_element.uuid}')"
                                class="custom-control-input"  value="${hour_meter_price_element.uuid}" />
                            <label class="custom-control-label" for="${hour_meter_price_element.uuid}"  >${hour_meter_price_element.name_atribut}</label>
                        </div>
                    </div>
                `);
                $('#hour_meter_price').append(`
                    <option value="${hour_meter_price_element.uuid}">${hour_meter_price_element.name_atribut}</option>
                `);

                arrrr.push(hour_meter_price_element.uuid);
            });
            value_checkbox['hour_meter_price'] = arrrr;
            filter.value_checkbox = value_checkbox;
            $('#btn-year').html(arr_date_today.year);
            $('#btn-month').val(arr_date_today.month);
            $('#btn-month').html(monthName(arr_date_today.month));
            $('#btn-day').html("Perbulan");
            setDatesMonth();
            arr_date_today.day = null;


            $(`#${data_show_type}`).attr('checked', true);
            loopDateFilter();
            onSaveFilter();

        }

        firstEmployeeHourMeterCreate();

        function setDatesMonth() {
            var date = new Date(),
                y = arr_date_today.year,
                m = arr_date_today.month;
            m = m + 1
            var firstDay = new Date(y, m, 1);
            var lastDay = new Date(y, m + 1, 0);
            $('#ten-one').empty();
            $('#ten-two').empty();
            $('#ten-three').empty();
            for (let a = 1; a <= 10; a++) {
                $('#ten-one').append(
                    `<button onclick="refreshTable(null, null, ${a})"  type="button" class="btn btn-sm btn-primary">${a}</button>`
                );
            }
            for (let b = 11; b <= 20; b++) {
                $('#ten-two').append(
                    `<button onclick="refreshTable(null, null, ${b})" type="button" class="btn btn-sm btn-primary">${b}</button>`
                );
            }
            for (let c = 21; c <= lastDay.getDate(); c++) {
                $('#ten-three').append(
                    `<button onclick="refreshTable(null, null, ${c})" type="button" class="btn btn-sm btn-primary">${c}</button>`
                );
            }
        }

        function exportData() {
            // cg('data_export', data_export);            
            let data_ex = JSON.stringify(data_datable);
            
            cg('data_ex', filter);
            // return false;

            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/hour-meter/export',
                type: "POST",
                data: {
                    _token: _token,
                    data_export: data_ex,
                    filter: filter
                },
                success: function(response) {
                   cg('export', response);    
                   var dlink = document.createElement("a");
                    dlink.href = `/${response.data}`;
                    dlink.setAttribute("download", "");
                    dlink.click();              
                },

                error: function(response) {
                    console.log(response)
                }
            });
        }

        $(document).ready(function() {
            // console.log( "ready!" );
            // getFirst();
            $('.btn-outline-primary').attr('class', ' btn btn-outline-primary');
            $('#lbl-Siang').attr('class', ' btn btn-outline-primary active');

        });
    </script>
@endsection
