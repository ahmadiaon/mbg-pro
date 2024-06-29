@extends('template.admin.main_privilege')

@section('content')
    <div class="faq-wrap">
        <div id="accordion">
            <div class="mb-20">
                <div class="card-header mb-10">
                    <button class="btn btn-block" data-toggle="collapse" data-target="#faq1">
                        <h4 class="text-blue h4">Filter</h4>
                    </button>
                </div>
                <div id="faq1" class="collapse show" data-parent="#accordion">
                    <div class="row clearfix">
                        <div class="col-md-6 mb-10">
                            <div class="card-box pd-20" id="the-filter-employee-tonase">
                                <div class="card-header weight-500">
                                    <h4 class="text-blue h4">Filter</h4>
                                </div>
                                {{-- perusahaan --}}
                                <div class="form-group row mb-20">
                                    <label class="col-md-auto" for="">Perusahaan</label>
                                    <div class="col text-right custom-control custom-checkbox mb-5">
                                        <input onchange="checkedAll('company')" type="checkbox" class="custom-control-input"
                                            id="checked-all-company">
                                        <label class="custom-control-label" for="checked-all-company">Pilih
                                            Semua</label>
                                    </div>
                                    <div class="col-12 row company-filter justify-content-md-center">

                                    </div>
                                </div>

                                {{-- site --}}
                                <div class="form-group row mb-20">
                                    <label class="col-md-auto" for="">Site</label>
                                    <div class="col text-right custom-control custom-checkbox mb-5">
                                        <input onchange="checkedAll('site_uuid')" type="checkbox"
                                            class="custom-control-input" id="checked-all-site_uuid">
                                        <label class="custom-control-label" for="checked-all-site_uuid">Pilih
                                            Semua</label>
                                    </div>
                                    <div class="col-12 row site-filter justify-content-md-center">

                                    </div>
                                </div>

                                {{-- divisi --}}
                                <div class="form-group row mb-20">
                                    <label class="col-md-4" for="">Departemen</label>
                                    <div class="col-md-8 custom-control custom-checkbox pr-5">
                                        <select name="department_uuid" id="department_uuid"
                                            class="custom-select2 form-control employees">
                                            <option value="">Filter by departemen</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- jabatan --}}
                                <div class="form-group row mb-20">
                                    <label class="col-md-4" for="">Jabatan</label>
                                    <div class="col-md-8 custom-control custom-checkbox pr-5">
                                        <select name="position_uuid" id="position_uuid"
                                            class="custom-select2 form-control employees">
                                            <option value="">Filter by position</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Kondisi Data --}}
                                <div class="form-group row mb-20">
                                    <label class="col-3" for="">karyawan</label>
                                    <div class="col-md-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="employee_out" name="join_status"
                                                class="custom-control-input" value="==" />
                                            <label class="custom-control-label" for="employee_out">Keluar</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="employee_in" name="join_status"
                                                class="custom-control-input" value="!=" />
                                            <label class="custom-control-label" for="employee_in">Masuk</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input checked type="radio" id="join_status_off" name="join_status"
                                                class="custom-control-input" value="off" />
                                            <label class="custom-control-label" for="join_status_off">Off</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- status  --}}
                                <div class="form-group row mb-20">
                                    <label class="col-md-5" for="">rentang waktu </label>
                                    <input class="col-6 form-control datetimepicker-range" placeholder="Select Month"
                                        name="date_range_this_time_in_out" id="date_range_this_time_in_out"
                                        type="text" />
                                </div>


                                {{-- Kondisi Data --}}
                                <div class="form-group row mb-20">
                                    <label class="col-3" for="">Status</label>
                                    <div class="col-md-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="employee_ok" name="status_data"
                                                class="custom-control-input" value="!=" />
                                            <label class="custom-control-label" for="employee_ok">Karyawan</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="employee_gone" name="status_data"
                                                class="custom-control-input" value="==" />
                                            <label class="custom-control-label" for="employee_gone">Keluar</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input checked type="radio" id="status_data_off" name="status_data"
                                                class="custom-control-input" value="off" />
                                            <label class="custom-control-label" for="status_data_off">Off</label>
                                        </div>
                                    </div>
                                </div>
                                {{-- status  --}}
                                <div class="form-group row mb-20">
                                    <label class="col-md-5" for="">rentang waktu</label>
                                    <input class="col-6 form-control" placeholder="Select Month" name="date_range_in_out"
                                        id="date_range_in_out" type="date" />
                                </div>

                                {{-- jabatan --}}
                                <div class="form-group row mb-20">
                                    <label class="col-md-3" for="">karyawan</label>
                                    <div class="col-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="Training" name="employee_status"
                                                class="custom-control-input" value="Training" />
                                            <label class="custom-control-label" for="Training">Training</label>
                                        </div>
                                    </div>
                                    <div class="col-uto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="Profesional" name="employee_status"
                                                class="custom-control-input" value="Profesional" />
                                            <label class="custom-control-label" for="Profesional">Profesional</label>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="custom-control custom-radio mb-5">
                                            <input checked type="radio" id="employee_status_off" name="employee_status"
                                                class="custom-control-input" value="off" />
                                            <label class="custom-control-label" for="employee_status_off">Off</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- status kontrak --}}
                                <div class="form-group row mb-20">
                                    <label class="col-md-3" for="">status</label>
                                    <div class="col-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="PKWT" name="contract_status"
                                                class="custom-control-input" value="PKWT" />
                                            <label class="custom-control-label" for="PKWT">PKWT</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="PKWTT" name="contract_status"
                                                class="custom-control-input" value="PKWTT" />
                                            <label class="custom-control-label" for="PKWTT">PKWTT</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input checked type="radio" id="contract_status_off" name="contract_status"
                                                class="custom-control-input" value="off" />
                                            <label class="custom-control-label" for="contract_status_off">Off</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- status kontrak saat ini --}}
                                <div class="form-group row mb-20">
                                    <label class="col-md-3" for="">kontrak</label>
                                    {{-- <div class="col-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="luarsa" name="status_join"
                                                class="custom-control-input" value="!=" />
                                            <label class="custom-control-label" for="luarsa">Luarsa</label>
                                        </div>
                                    </div> --}}
                                    <div class="col-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="kadaluarsa" name="status_join"
                                                class="custom-control-input" value="==" />
                                            <label class="custom-control-label" for="kadaluarsa">Kadaluarsa</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input checked type="radio" id="status_join_off" name="status_join"
                                                class="custom-control-input" value="off" />
                                            <label class="custom-control-label" for="status_join_off">Off</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- status  --}}
                                <div class="form-group row mb-20">
                                    <label class="col-md-5" for="">rentang waktu</label>
                                    <input class="col-6 form-control datetimepicker-range" placeholder="Select Month"
                                        name="date_range" id="date_range" type="text" />
                                </div>

                                {{-- status kontrak saat ini --}}
                                <div class="form-group row mb-20">
                                    <label class="col-3" for="">Tampilan</label>
                                    <div class="col-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="detail" name="show_type"
                                                class="custom-control-input" value="detail" />
                                            <label class="custom-control-label" for="detail">Detail</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input checked type="radio" id="simple" name="show_type"
                                                class="custom-control-input" value="simple" />
                                            <label class="custom-control-label" for="simple">Simpel</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="show_type_off" name="show_type"
                                                class="custom-control-input" value="off" />
                                            <label class="custom-control-label" for="show_type_off">Off</label>
                                        </div>
                                    </div>
                                </div>

                                <button onclick="onSaveFilter()" type="button"
                                    class="col-md-auto btn btn-primary text-rigth">
                                    Simpan
                                </button>
                            </div>
                        </div>
                        <div class="col-6 ">
                            <div class="card pd-10">
                                <div class="card-header pb-20">
                                    <h4 class="text-blue h4">Filter</h4>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="the-content">
        <div id="index-employee" class="children-content">
            <div class="card-box mb-30 ">
                <div class="row pd-20">
                    <div class="col-auto">
                        <h4 class="text-blue h4">Daftar Karyawan</h4>

                    </div>
                    <div class="col text-right" <div class="btn-group">
                        <div class="btn-group dropdown">
                            <button onclick="exportDataFull()" type="date" class="btn btn-danger">
                                Export Data <span class="caret"></span>
                            </button>
                        </div>
                        @if (!empty(session('dataUser')->create_employee))
                            <div class="btn-group dropdown">
                                <a href="/user/detail">
                                    <button class="btn btn-secondary" aria-expanded="false">
                                        Tambah Karyawan <span class="caret"></span>
                                    </button>
                                </a>
                            </div>
                        @endif
                        <div class="btn-group dropdown">
                            <button type="date" class="btn btn-primary dropdown-toggle waves-effect"
                                data-toggle="dropdown" aria-expanded="false">
                                Menu <span class="caret"></span>
                            </button>

                            <div class="dropdown-menu">
                                @if (!empty(session('dataUser')->superadmin))
                                    <a class="dropdown-item" id="btn-export" href="/user/delete/">Hapus Karywan
                                    </a>
                                @endif
                                <a class="dropdown-item" id="btn-export" href="/user/export-simple/">Template Simpel
                                </a>
                                <a class="dropdown-item" id="btn-export" href="/user/export-full">Template Full
                                </a>
                                <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                    href="">Import</a>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="pb-20" id="table-user">

                </div>
            </div>
            <!-- Simple Datatable End -->

            {{-- modal add user privilege --}}
            <div class="modal fade bs-example-modal-lg" id="createModal" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">
                                Eksport Data Karyawan
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>



                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <select name="" id="">

                                </select>
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
            <!-- Simple Datatable End -->
            <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <form id="form-import" action="/user/import" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Import Karawan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Pilih Karawan</label>
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
        </div>
    </div>
@endsection

@section('js')
    <script>
        let data_export = null;
        var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
        var end = new Date(arr_date_today.year, arr_date_today.month, 0);

        let database = JSON.parse(localStorage.getItem('DATABASE'));
        $('#date_range_in_out').val(`${formatDate(end)}`);
        $('#date_range_this_time_in_out').val(`${formatDate(start)} - ${formatDate(end)}`);
        $('#date_range').val(`${formatDate(start)} - ${formatDate(end)}`);
        let filter = {
            employee_status: 'Training',
            contract_status: 'off'
        };
        let arr_filter = {
            'company': [],
            'site_uuid': [],
        };
        let value_checkbox = {
            'company': null,
            'site_uuid': null,
            'department_uud': null
        };

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

        function onSaveFilter() {
            // let isCombined = $('#is_combined')[0].checked;
            // // console.log(isAllChecked);
            // if (isCombined) {
            //     is_combined = true;
            // } else {
            //     is_combined = false
            // }
            // filter.is_combined = is_combined;


            var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
            var end = new Date(arr_date_today.year, arr_date_today.month, 0);

            let date_filter = {
                date_start: formatDate(start),
                date_end: formatDate(end)
            };
            filter.date_filter = date_filter;

            filter.arr_filter = arr_filter;
            filter.join_status = $("input[type='radio'][name='join_status']:checked").val();
            filter.employee_status = $("input[type='radio'][name='employee_status']:checked").val();
            filter.contract_status = $("input[type='radio'][name='contract_status']:checked").val();
            filter.show_type = $("input[type='radio'][name='show_type']:checked").val();
            filter.status_join = $("input[type='radio'][name='status_join']:checked").val();
            filter.status_data = $("input[type='radio'][name='status_data']:checked").val();
            filter.date_range = $('#date_range').val();
            filter.date_range_in_out = $('#date_range_in_out').val();
            filter.date_range_this_time_in_out = $('#date_range_this_time_in_out').val();


            filter.department_uuid = $(`#department_uuid`).val();
            filter.position_uuid = $(`#position_uuid`).val();
            cg('filter', filter);


            showDataTableUser();
        }

        function exportDataFull() {
            startLoading();
            let db = JSON.parse(localStorage.getItem('DATABASE'));
            $.ajax({
                url: '/user/export-full',
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    data_export: 'db'
                },
                success: function(response) {
                    cg('response', response);
                    return false;
                    var dlink = document.createElement("a");
                    dlink.href = `/${response.data}`;
                    dlink.setAttribute("download", "");
                    dlink.click();
                    stopLoading();
                },
                error: function(response) {
                    cg('response', response);
                    alertModal()
                }
            });
        }

        function cardEmployees(nik_employee) {
            let bg='';
            if (data_database['data_employee_out'][nik_employee]) {
                bg = 'bg-warning';
            }
            // cg(nik_employee, database['employees'][nik_employee]);
            return `
                <div class="name-avatar d-flex align-items-center pr-2 ${bg} card-box pl-2">
                    <div class="avatar mr-2 flex-shrink-0">
                        <img src="/vendors/images/photo5.jpg" class="border-radius-100 box-shadow"
                            width="50" height="50" alt="">
                    </div>
                    <div class="txt">
                        <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                            style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">${database['employees'][nik_employee]['company']} |
                            ${database['employees'][nik_employee]['department']}</span>
                        <div class="font-14 weight-600">${database['employees'][nik_employee]['name']}</div>
                        <div class="font-12 weight-500">${database['employees'][nik_employee]['nik_employee_with_space']}</div>
                        <div class="font-12 weight-500" data-color="#b2b1b6" style="color: rgb(178, 177, 182);">
                            ${database['employees'][nik_employee]['position']}
                        </div>
                    </div>
                </div>
            `;
        }

        function showDataTableUser() {
            let data = [];
            let dataTable = [

            ];


            let data_table_schema = data_database.table_schema;
            let dictionary = data_database.data_dictionaries;
            let element_header_table_employees = ``;
            // filter.show_type = 'simple';
            if (filter.show_type != 'simple') {
                data_table_schema['employees'].forEach(element_employee_schema => {
                    if (dictionary[element_employee_schema]) {
                        // cg('employees_schema', dictionary[element_employee_schema]['excel']);
                        element_header_table_employees =
                            `${element_header_table_employees} <th> ${dictionary[element_employee_schema]['excel']} </th>`
                    }
                });
            }
            $('#table-user').empty();

            // ${element_header_table_employees}

            let element_table = `
                    <table id="table-user-employees" class="display nowrap stripe hover table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Data karyawan</th>
                                ${element_header_table_employees}
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
            `;

            $('#table-user').append(element_table);



            // datatable
            var employees_card_element = {
                mRender: function(data, type, row) {
                    return cardEmployees(row.nik_employee)
                }
            };
            data.push(employees_card_element);

            if (filter.show_type != 'simple') {
                data_table_schema['employees'].forEach(element_employee_schema => {
                    if (dictionary[element_employee_schema]) {
                        let el = {
                            mRender: function(data, type, row) {
                                return row[element_employee_schema]
                            }
                        }
                        data.push(el)
                    }
                });
            }


            var elements = {
                mRender: function(data, type, row) {
                    return `
                                <div class="form-inline"> 
                                    <button onclick="choosePage('show-employee','` + row.nik_employee + `')" type="button" class="btn btn-info mr-1  py-1 px-2">
                                        <i class="icon-copy ion-android-list"></i>
                                    </button>	
                                    <a href="/user/detail/${row.nik_employee}">
                                        <button type="button" class="btn btn-primary mr-1  py-1 px-2">
                                            <i class="icon-copy fi-book"></i>
                                        </button>		
                                    </a>
                                    <button onclick="deleteData('` + row.nik_employee + `')" type="button" class="btn btn-danger mr-1  py-1 px-2">
											<i class="icon-copy ion-trash-b"></i>
										</button>
                                </div>`
                }
            };
            data.push(elements);

            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/user/data-x',
                type: "POST",
                data: {
                    _token: _token,
                    filter: filter
                },
                success: function(response) {
                    datax = response.data;
                    let data_datable_obj = datax.employee_filter_company_x_site;
                    data_export = data_datable_obj;
                    let data_datable = [];
                    if (data_datable_obj) {
                        Object.values(data_datable_obj).forEach(element_data_datable_obj => {
                            data_datable.push(element_data_datable_obj);
                        });
                    }
                    $('#table-user-employees').DataTable({
                        scrollX: true,
                        scrollY: "700px",
                        paging: false,
                        serverSide: false,
                        data: data_datable,
                        columns: data
                    });

                },

                error: function(response) {
                    console.log(response)
                }
            });
            return false;
        }

        function acceptProposalShow() {
            $('#accept-proposal').modal('show');
        }

        function deleteData(uuid) {
            let _url = '/user/delete/employee'

            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('privilege')
        }

        function firstIndexEmployee(data) {
            let arrrr = [];
            // return false;
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

            // departemen 
            Object.values(data_database.data_departments).forEach(department_uuid_element => {
                $('#department_uuid').append(`
                    <option value="${department_uuid_element.uuid}">${department_uuid_element.department}</option>
                `);
            });
            // jabatan
            Object.values(data_database.data_positions).forEach(position_uuid_element => {
                $('#position_uuid').append(`
                    <option value="${position_uuid_element.uuid}">${position_uuid_element.position}</option>
                `);
            });
            filter.value_checkbox = value_checkbox;


            onSaveFilter()
        }



        // JS RUN
        firstIndexEmployee();

        function exportData() {
            cg('data_export', data_export);
            let data_ex = JSON.stringify(data_export);
            let filter = {
                date_start_filter: '2023-05-01',
                date_end_filter: '2023-05-31',
            };
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/user/export-data',
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
    </script>
@endsection
