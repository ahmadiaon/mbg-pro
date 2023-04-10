@extends('template.admin.main_privilege')
@section('content')
    <div class="mb-30">
        <div class="row">
            <div class="col-12">
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
                        <div class="pd-20">
                            <div class="row">
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_supervisor_uuid">Pilih Supervisor</label>
                                        <select name="employee_supervisor_uuid" id="employee_supervisor_uuid"
                                            class="custom-select2 form-control employees">
                                            <option value="">karyawan</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                        <input type="date" name="date" id="date" value=""
                                            class="form-control">

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
                                                            <input type="radio" name="shift" id="Siang"
                                                                value="Siang" checked="checked" autocomplete="off">
                                                            Siang
                                                        </label>

                                                        <label id="lbl-Malam" class="btn btn-outline-primary">
                                                            <input type="radio" name="shift" id="Malam"
                                                                value="Malam" autocomplete="off">
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
                                                    <input type="checkbox" checked name="is_bonus"
                                                        class="custom-control-input" id="is_bonus" />
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
                </div>
                </form>
            </div>
            <!-- Simple Datatable End -->
        </div>
    </div>
    </div>

    <div class="row table-all-employee-have-hm card-box mb-10">

        <div class="col-md-12 card-header ">
            <div class="row">
                <div class="col">
                    <b>Table Detail HM</b>
                </div>
                <div class="col-auto text-rigth" id="header_card">
                    <div class="row">
                        <i class="icon-copy bi bi-arrow-repeat"></i>
                    </div>
                    <footer class="blockquote-footer">
                        HM
                        <cite class="mr-10" title="Source Title">asli</cite>
                        dari
                        <cite class="mr-10" title="Source Title">1 Januari 2023</cite>
                        sampai
                        <cite class="mr-10" title="Source Title">31 Januari 2023</cite>
                        <a>
                            <i onclick="openModalFilter()" class="ml-3 icon-copy bi bi-gear-fill"></i>
                        </a>
                    </footer>
                </div>
            </div>
        </div>
        <div class="col-md-12" id="employee-hour-meter">
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



    <!-- Modal filter-->
    <div class="modal fade customscroll" id="modal-filter-hour-meter" role="dialog" aria-hidden="true">
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
                    <form>
                        <div class="task-list-form">
                            <ul>
                                <li>
                                    <div class="form-group row">
                                        <label class="col-md-4">Asal Site</label>
                                        <div class="col-md-8 ">
                                            <div class="row site_uuid">
                                                <div class="col-12">
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input onchange="checkedAllSite()" type="checkbox"
                                                            class="custom-control-input" id="checked-all-site_uuid">
                                                        <label class="custom-control-label"
                                                            for="checked-all-site_uuid">Pilih
                                                            Semua</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12 text-center">Tampilan Nilai HM</label>
                                        <div class="col-md-12 text-center row">
                                            <div class="col-6">
                                                <div class="custom-control custom-radio mb-5">
                                                    <input type="radio" id="real" name="data_show_type"
                                                        class="custom-control-input" value="real">
                                                    <label class="custom-control-label" for="real">HM asli</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="custom-control custom-radio mb-5">
                                                    <input type="radio" id="bonus" name="data_show_type"
                                                        class="custom-control-input" value="bonus">
                                                    <label class="custom-control-label" for="bonus">HM berbonus</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- rentang waktu --}}
                                    <div class="form-group row">
                                        <label class="col-md-12 text-center">Rentang Waktu</label>
                                        <div class="col-md-6">
                                            <select onchange="loopDateFilter()" style="width: 100%;"
                                                name="date_start_filter_hm" id="date_start_filter_hm"
                                                class="custom-select2 form-control">
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select style="width: 100%;" name="date_end_filter_hm"
                                                id="date_end_filter_hm" class="custom-select2 form-control">
                                            </select>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button onclick="onSaveFilter()" data-dismiss="modal" type="button" class="btn btn-primary">
                        Simpan
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Tutup
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
        let data_show_type = 'real';
        let data_datable = [];
        let element_before = {
            uuid: null,
            value: 0
        };

        let filter = {
            arr_site_uuid: null,
            data_show_type: data_show_type,
            date_filter: {
                date_start_filter_hm: formatDate(start),
                date_end_filter_hm: formatDate(end),
            },
            nik_employee: nik_employee
        };

        function openModalFilter() {
            $(`#${data_show_type}`).attr('checked', true);
            $('#modal-filter-hour-meter').modal('show');
        }

        function setFilterChecked() {
            var checkedValue = $('.element-site_uuid:checked').val();
            let arr_site_uuid = [];
            Object.values(data_database.data_atribut_sizes.site_uuid).forEach(site_uuid_element => {
                var checkedValue = $(`#${site_uuid_element.uuid}:checked`).val();
                if (checkedValue) {
                    arr_site_uuid.push(checkedValue)
                }
            });
            filter.arr_site_uuid = arr_site_uuid;
        }

        function checkedAllSite() {
            let isAllChecked = $('#checked-all-site_uuid')[0].checked;
            // console.log(isAllChecked);
            if (isAllChecked) {
                $('.element-site_uuid').prop('checked', true);
            } else {
                $('.element-site_uuid').prop('checked', false);
            }
            setFilterChecked()
        }

        function onSaveFilter() {
            data_show_type = $("input[type='radio'][name='data_show_type']:checked").val();
            let date_filter = {
                date_start_filter_hm: $('#date_start_filter_hm').val(),
                date_end_filter_hm: $('#date_end_filter_hm').val(),
            };
            filter.date_filter = date_filter;
            filter.data_show_type = data_show_type;
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
                                                <input type="checkbox" checked 
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

        function employeeChosee(){
            let employee = $('#employee_uuid').val();
            data_emp = data_database.data_employees[employee];
            cg('data emp', data_emp);
            if(data_emp.hour_meter_price_uuid){
                $(`#${data_emp.hour_meter_price_uuid}`).attr('checked', true);
           
            }else{
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

            let element_header_card_hour_meter = `
                       
                                    
                                
                            <footer class="blockquote-footer">
                              
                                HM
                                <cite class="mr-10" title="Source Title">
                                    ${filter.data_show_type}
                                </cite>
                                dari
                                <cite class="mr-10" title="Source Title">
                                    ${getStringDate(filter.date_filter.date_start_filter_hm)}
                                </cite>
                                sampai
                                <cite class="mr-10" title="Source Title">
                                    ${getStringDate(filter.date_filter.date_end_filter_hm)}
                                </cite>
                                <a>
                                    <i onclick="onSaveFilter()" class="icon-copy bi bi-arrow-repeat"></i>
                                </a>
                                <a>
                                    <i onclick="openModalFilter()" class="ml-3 icon-copy bi bi-gear-fill"></i>
                                </a>
                        </footer>`;
            $(`#header_card`).empty();
            $(`#header_card`).append(element_header_card_hour_meter);


            let element_table_hour_meter = `
                    <table id="table-employee-hour-meter" class="display nowrap stripe hover table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Data Karyawan</th>
                                <th>Harga HM</th>
                                <th>Total Slip</th>
                                <th>Total HM</th>
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
                    let data_datable_obj = response.data.datatable;
                    data_datable = [];
                    let hm_price = null;
                    cg('datatable', response);

                    if (data_datable_obj) {
                        Object.values(data_datable_obj).forEach(element_data_datable_obj => {
                            data_datable.push(element_data_datable_obj);
                        });
                    }
                    cg('datatable', data_datable);

                    let data = [];
                    let dataTable = [
                        'hour_meter_price_uuid', 'count_slip_hm', 'sum_hm'
                    ];

                    data.push(element_profile_employee_session)
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
                                            value = `${value} <div class="mb-1 col-md-12 text-center " id="${element_item_date.uuid}" > 
                                                                    <button onclick="editHM('${element_item_date.uuid}','${element_item_date.value}')" type="button" class="btn btn-outline-primary">${element_item_date.value}</button>
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



        $('#isEdit').hide();
        $('#is_edit').remove();
        let employees = @json($employees);
        let hour_meter_prices = @json($hour_meter_prices);
        let year_month = @json($year_month);


        let arr_year_month = year_month.split("-");
        let year = arr_year_month[0];
        let month = arr_year_month[1];


        function updatehour_meter_price_uuid(uuid) {
            $('#hour_meter_price_uuid').val(uuid);
        }

        function firstEmployeeHourMeterCreate() {
            Object.values(data_database.data_atribut_sizes.site_uuid).forEach(site_uuid_element => {
                $('.site_uuid').append(`<div class="col-auto">
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input onchange="setFilterChecked()" type="checkbox" class="custom-control-input element-site_uuid" value="${site_uuid_element.uuid}"
                                                            id="${site_uuid_element.uuid}" name="${site_uuid_element.name_atribut}">
                                                        <label class="custom-control-label" for="${site_uuid_element.uuid}">${site_uuid_element.name_atribut}</label>
                                                    </div>
                                                </div>`);
            });
            $(`#${data_show_type}`).attr('checked', true);
            loopDateFilter();
            onSaveFilter();
            year_month = @json($year_month);
            nik_employee = @json($nik_employee);


            console.log(year_month);
            console.log(nik_employee);
            // $('.employees').empty();
            employees.forEach(element => {
                $('.employees').append(`
                <option value="${element.nik_employee}">${element.name} - ${element.position}</option>
            `)
            });

            hour_meter_prices.forEach(element => {
                $('#hour-meter-prices').append(`
                <div class="col-auto">
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio"  id="${element.uuid}" name="hour_meter_price_uuid" onclick="updatehour_meter_price_uuid('${element.uuid}')"
                            class="custom-control-input"  value="${element.uuid}" />
                        <label class="custom-control-label" for="${element.uuid}"  >${element.hour_meter_name}</label>
                    </div>
                </div>
            `);
            });
            if (nik_employee) {
                console.log('udin')
                $('#employee_uuid').val(nik_employee).trigger('change');
            }
        }

        firstEmployeeHourMeterCreate();






        let _url_data = '';

        function editHm(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/hour-meter/edit";

            $('#isEdit').show();
            $('#isEdit').after(`<input type="text" id="is_edit" value="is_edit" name="is_edit">`);

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    uuid: uuid,
                    _token: _token
                },
                success: function(response) {
                    data = response.data
                    console.log('data')
                    console.log(data)
                    $('#employee_uuid').val(data.employee_uuid).trigger('change');
                    $('#uuid').val(data.uuid).trigger('change');
                    $('#employee_checker_uuid').val(data.employee_checker_uuid).trigger('change');
                    $('#employee_foreman_uuid').val(data.employee_foreman_uuid).trigger('change');
                    $('#employee_supervisor_uuid').val(data.employee_supervisor_uuid).trigger('change');
                    $('#full_value').val(data.full_value).trigger('change');
                    $('#' + data.hour_meter_price_uuid).attr('checked', true);
                    $('#' + data.shift).attr('checked', true);
                    $('.btn-outline-primary').attr('class', ' btn btn-outline-primary');
                    $('#lbl-' + data.shift).attr('class', ' btn btn-outline-primary active');
                    $('#value').val(data.value).trigger('change');
                    $('#date').val(data.date);
                    $('#hour_meter_price_uuid').val(data.hour_meter_price_uuid);

                },

                error: function(response) {
                    console.log(response)
                }
            });
        }

        function fullValue() {
            let is_bonus = $('#is_bonus')[0].checked
            let full_value
            if (is_bonus == true) {
                let value_hm = parseInt($('#value').val())
                full_value = value_hm
                if (value_hm >= 10) {
                    full_value = value_hm * 0.15
                    full_value = full_value + value_hm
                }
                if (value_hm >= 14) {
                    full_value = value_hm * 0.3 + value_hm
                }
                if (value_hm >= 16) {
                    full_value = value_hm * 0.5 + value_hm
                }


                $('#full_value').val(full_value)
                console.log(value_hm)
            } else {
                $('#full_value').val(parseInt($('#value').val()))
            }
        }
        $(document).ready(function() {
            // console.log( "ready!" );
            // getFirst();
            $('.btn-outline-primary').attr('class', ' btn btn-outline-primary');
            $('#lbl-Siang').attr('class', ' btn btn-outline-primary active');

        });
    </script>
@endsection
