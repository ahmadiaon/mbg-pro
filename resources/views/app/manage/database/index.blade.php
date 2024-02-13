@extends('app.layouts.main')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Manage Database</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/web/menu">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Menu
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class=" card-box mb-30">
        <div class="pd-20 clearfix mb-10">
            <div class="pull-left">
                <h4 class="text-blue h4">DATABASE Table</h4>
            </div>
            <div class="pull-right" hidden>
                <a href="#basic-form1" id="basic-form1" class="btn btn-primary btn-sm scroll-click" rel="content-y"
                    data-toggle="collapse" role="button">Reset</a>
            </div>
        </div>
        <div class="" id="datatable">
            <table class="data-table table stripe hover nowrap" id="table-datatable">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Name</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-plus">
                            <div class="name-avatar d-flex align-items-center pr-2 card-box pl-2">
                                <div class="avatar mr-2 flex-shrink-0">
                                    <img src="/vendors/images/photo5.jpg" class="border-radius-100 box-shadow"
                                        width="50" height="50" alt="">
                                </div>
                                <div class="txt">
                                    <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                        style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">PT. MBLE |
                                        HAULING</span>
                                    <div class="font-14 weight-600">Dr. Callie Reed</div>
                                    <div class="font-12 weight-500">MBLE-0422003</div>
                                    <div class="font-12 weight-500" data-color="#b2b1b6" style="color: rgb(178, 177, 182);">
                                        Service Maintenance
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <a onclick="editUser('MBLE-0422003')" class="btn btn-primary" href="#"><i
                                    class="dw dw-edit2"></i> Edit</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-10">
            <div class="pull-left">
                <h4 class="text-blue h4">Field Form</h4>
                <p>Tambah atau edit form</p>
            </div>
            <div class="pull-right" hidden>
                <a href="#basic-form1" id="basic-form1" class="btn btn-primary btn-sm scroll-click" rel="content-y"
                    data-toggle="collapse" role="button">Reset</a>
            </div>
        </div>
        <form id="fields">
            <div class="row profile-info" id="field-form">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Nama Field</label>
                        <input type="text" class="form-control description_field" id="description_field-1">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-2">
                    <div class="form-group">
                        <label>Type Data Field</label>
                        <select style="width: 100%;" onchange="selectSource(1)" name="type_data_field-1"
                            id="type_data_field-1" class="custom-select2 form-control type-data">
                            <option value="">Tipe Data Field</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20 clearfix mb-10">
            <div class="pull-left">
                <h4 class="text-blue h4">Data Table</h4>
                <p>Tambah atau edit form</p>
            </div>
            <div class="pull-right" hidden>
                <a href="#basic-form1" id="basic-form1" class="btn btn-primary btn-sm scroll-click" rel="content-y"
                    data-toggle="collapse" role="button">Reset</a>
            </div>
        </div>
        <div class="" id="datatable-data">
            <table class="data-table table stripe hover nowrap" id="table-datatable-data">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Name</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-plus">
                            <div class="name-avatar d-flex align-items-center pr-2 card-box pl-2">
                                <div class="avatar mr-2 flex-shrink-0">
                                    <img src="/vendors/images/photo5.jpg" class="border-radius-100 box-shadow"
                                        width="50" height="50" alt="">
                                </div>
                                <div class="txt">
                                    <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                        style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">PT. MBLE |
                                        HAULING</span>
                                    <div class="font-14 weight-600">Dr. Callie Reed</div>
                                    <div class="font-12 weight-500">MBLE-0422003</div>
                                    <div class="font-12 weight-500" data-color="#b2b1b6"
                                        style="color: rgb(178, 177, 182);">
                                        Service Maintenance
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <a onclick="editUser('MBLE-0422003')" class="btn btn-primary" href="#"><i
                                    class="dw dw-edit2"></i> Edit</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection()

@section('script_javascript')
    <script>
        function cardTable(data) {
            return `
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">${data.description_table}</div>
                                <div class="font-14 text-secondary weight-500">
                                    ${data.menu_table}
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" id="${data.code_table}" onclick="actionCard(this)" data-color="#00eccf" role="button"  style="color: rgb(0, 236, 207);" >
                                    <i class="icon-copy bi bi-gear"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
        }

        function cardFormField(data_field) {
            let element_field = '';
            let element_input_field_ = ``;
            switch (data_field.type_data_field) {
                case 'TEXT':
                    element_input_field_ =
                        `<input type="text" class="form-control" name="${data_field.full_code_field}" id="${data_field.full_code_field}">`;
                    element_field = `
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field}</label>
                                ${element_input_field_}
                            </div>
                        </div>`;

                    $(`#field-form`).append(element_field)
                    break;
                case 'DARI-TABEL':
                    //looping data table source
                    let data_source_this_field = db['db']['database_data_source'][data_field.full_code_field];
                    let element_option_data_source = ``;
                    Object.values(db['db']['database_data'][data_source_this_field.table_data_source]).forEach(
                        data_data_source => {
                            element_option_data_source =
                                `${element_option_data_source} <option value="${data_data_source[data_source_this_field.field_get_data_source]['code_data']}">${data_data_source[data_source_this_field.field_get_data_source]['value_data']}</option>`
                        });

                    element_input_field_ = `
                                                <select style="width: 100%;" name="${data_field.full_code_field}" id="${data_field.full_code_field}" class="custom-select2 form-control">
                                                    <option value="">Pilih Data</option>
                                                    ${element_option_data_source}
                                                </select>
                                            `;

                    element_field = `
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field}</label>
                                ${element_input_field_}
                            </div>
                        </div>`;

                    $(`#field-form`).append(element_field);
                    $(`#${data_field.full_code_field}`).select2();
                    break;
                default:
                    break;
            }
        }

        function actionCard(element) {
            var code_table = element.id;
            let db_fields = db['db']['database_field'][code_table];
            $(`#field-form`).empty();
            Object.values(db_fields).forEach(field => {
                cardFormField(field)
            });
            $(`#field-form`).append(`
                <div class="col-md-12 col-sm-12 text-right">
                    <button type="button" onclick="storeDataTable('${code_table}')" class="btn btn-primary" id="save-from-table" data-dismiss="modal">
                        Simpan
                    </button>
                </div>
            `);
            refreshTableData(code_table);

        }

        function storeDataTable(code_table) {
            // fields
            var formDataArray = $("#fields").serializeArray();
            let db_table = db['db']['database_table'][code_table];

            conLog('formDataArray',formDataArray);
            conLog('db_table',db_table);
            $.ajax({
                url: '/api/mbg/manage/database/store-database',
                type: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'auth_login': ui_dataset.ui_dataset.user_authentication.auth_login
                },
                data: JSON.stringify({
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    formData: formDataArray,
                    data_table: db_table
                }),
                success: function(response) {
                    conLog('response', response)
                    refreshSession();
                    refreshTableData(code_table);
                    showModalSuccess();

                },
                error: function(response) {
                    conLog('error', response);
                    stopLoading();
                    //alertModal()
                }
            });
        }

        function refreshTable() {
            let row_data_datatable = [];
            let header_table_element = '';
            let header_table_field = ['Description Table'];

            $('#datatable').empty();

            // create header table                    
            header_table_field.forEach(element => {
                header_table_element = `${header_table_element} <th> ${element} </th>`
            });

            header_table_element = `                    
                        <table id="table-datatable" class="display nowrap stripe hover table" style="width:100%">
                            <thead>
                                <tr>
                                    ${header_table_element}
                                </tr>
                            </thead>
                        </table>
                    `;

            $('#datatable').append(header_table_element);

            //add row data datatable
            var employees_card_element = {
                mRender: function(data, type, row) {
                    return cardTable(row)
                }
            };
            row_data_datatable.push(employees_card_element);

            let data_datatable = [];
            Object.values(db['db']['database_table']).forEach(element => {
                data_datatable.push(element);
            });
            $('#table-datatable').DataTable({
                paging: true,
                serverSide: false,
                data: data_datatable,
                columns: row_data_datatable
            });
        }

        refreshTable();

        function refreshTableData(code_table) {
            let row_data_datatable = [];
            let header_table_element = '';
            let header_table_field = [];

            Object.values(db['db']['database_field'][code_table]).forEach(field_table => {
                header_table_field.push(field_table['description_field']);
                // add row data datatable
                var employees_card_element = {
                    mRender: function(data, type, row) {
                        let datas = row[field_table['full_code_field']] ? row[field_table['full_code_field']]['value_data'] : null
                        return datas;
                    }
                };
                row_data_datatable.push(employees_card_element);
            });

            // add row data datatable
            var employees_card_element = {
                mRender: function(data, type, row) {
                    return 'action';
                }
            };
            row_data_datatable.push(employees_card_element);

            $('#datatable-data').empty();

            // create header table                    
            header_table_field.forEach(element => {
                header_table_element = `${header_table_element} <th> ${element} </th>`

            });
            header_table_element = `${header_table_element} <th> Action </th>`

            header_table_element = `                    
                            <table id="table-datatable-data" class="display nowrap stripe hover table" style="width:100%">
                                <thead>
                                    <tr>
                                        ${header_table_element}
                                    </tr>
                                </thead>
                            </table>
                        `;

            $('#datatable-data').append(header_table_element);
            let data_datatable = [];

            CL("code table " + code_table);
            CL(db['db']['database_data']);
            if (db['db']['database_data'][code_table]) {
                Object.values(db['db']['database_data'][code_table]).forEach(element => {
                    data_datatable.push(element);
                });
            }

            // return false;
            $('#table-datatable-data').DataTable({
                paging: true,
                serverSide: false,
                data: data_datatable,
                columns: row_data_datatable
            });
        }
    </script>
@endsection()
