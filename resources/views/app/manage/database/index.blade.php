@extends('app.layouts.main')
@section('src_css')
    <link rel="stylesheet" type="text/css" href="/src/plugins/jquery-asColorPicker/dist/css/asColorPicker.css" />
@endsection()

@section('src_script_javascript')
    <script src="/src/plugins/jquery-asColor/dist/jquery-asColor.js"></script>
    <script src="/src/plugins/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="/src/plugins/jquery-asColorPicker/jquery-asColorPicker.js"></script>
    <script src="/vendors/scripts/colorpicker.js"></script>
@endsection()

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
                <h4 class="text-blue h4">Daftar Tabel-tabel</h4>
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
    <div class="row pd-20">
        <div id="form-parent" class="pd-20 card-box mb-30 col-md-7 col-sm-12">
            <div class="clearfix mb-10">
                <div class="pull-left">
                    <h4 id="table-description" class="text-blue h4">Field Form</h4>
                    <p>Tambahkan data pada form-form berikut</p>
                </div>
                <div class="pull-right" hidden>
                    <a href="#basic-form1" id="basic-form1" class="btn btn-primary btn-sm scroll-click" rel="content-y"
                        data-toggle="collapse" role="button">Reset</a>
                </div>
            </div>
            <form id="fields">
                <div class="row profile-info" id="field-form">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Nama Field</label>
                            <input type="text" class="form-control description_field" id="description_field-1">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-2">
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

        <div class="faq-wrap col-md-7 col-sm-12" hidden>
            <h4 class="mb-20 h4 text-blue">Sub Form</h4>
            <div id="sub-form">

            </div>
        </div>
    </div>




    <div class="card-box mb-30">
        <div class="pd-20 clearfix mb-10">
            <div class="pull-left">
                <h4 id="text-form-description" class="text-blue h4">Data Table</h4>
                <input type="text" class="form-control" id="id-code_table" >
            </div>
            <div class="pull-right">
                <a href="#basic-form1" id="basic-form1" class="btn btn-primary btn-sm scroll-click" rel="content-y"
                    data-toggle="collapse" role="button">Reset</a>
            </div>

        </div>
        <div class="row pd-20">
            <div class="col-md-6 col-sm-12">FILTER</div>
            <div class="col-md-6 col-sm-12 text-right">
                <button onclick="filterDatatable()" class="btn btn-primary">Filter Kolom</button>
            </div>
        </div>

        <div class="" id="datatable-data">
            <table class="data-table table stripe hover nowrap" id="table-datatable-data">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">data tabel</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-plus">
                            <div class="name-avatar d-flex align-items-center pr-2 card-box pl-2">

                                <div class="txt">

                                    <div class="font-12 weight-500" data-color="#b2b1b6"
                                        style="color: rgb(178, 177, 182);">
                                        Silhkan pilih tabel diatas
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade customscroll" id="modal-filter" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header mb-10">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Filter Driver
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="bottom" title="" data-original-title="Close Modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-0 mt-20">
                    <div class="task-list-form">
                        <input type="text" name="filter-name" id="filter-name">
                        <div class="" id="datatable-filter">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-save-filter" class="btn btn-primary">
                        Filter
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script_javascript')
    <script>
        function filterDatatable(){
            let code_table = $('#code_table').val();
            $.ajax({
                url: '/api/mbg/manage/database/get-table',
                type: "POST",
                headers: {
                    'auth_login': ui_dataset.ui_dataset.user_authentication.auth_login
                    // Add other custom headers if needed
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    code_table: code_table
                },
                success: function(response) {
                    conLog('response get-table', response);
                    reCreateFilterTable(code_table, response.data);
                    $('#modal-filter').modal('show');
                },
                error: function(response) {
                    conLog('error', response);
                    stopLoading();
                }
            });
            // reCreateFilterTable(code_table, response.data);
            $('#modal-filter').modal('show');

        }
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
                                <div class="icon" onclick="actionCard('${data.code_table}')" data-color="#00eccf" role="button"  style="color: rgb(0, 236, 207);" >
                                    <i class="icon-copy bi bi-gear"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
        }

        function cardFormField(id_field, data_field) {
            let element_field = '';
            let element_input_field_ = ``;
            switch (data_field.type_data_field) {
                case 'TEXT':
                    element_input_field_ =
                        `<input type="text" class="form-control" name="${data_field.code_field}" id="${data_field.code_field}">`;
                    element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field}</label>
                                ${element_input_field_}
                            </div>
                        </div>`;
                    $(`#${id_field}`).append(element_field)
                    break;
                case 'DARI-TABEL':
                    //looping data table source
                    let data_source_this_field = db['db']['database_data_source'][data_field.full_code_field];
                    let element_option_data_source = ``;
                    Object.values(db['db']['database_data'][data_source_this_field.table_data_source]).forEach(

                        data_data_source => {
                            // conLog('data_data_source', data_data_source);
                            element_option_data_source =
                                `${element_option_data_source} <option value="${data_data_source[data_source_this_field.field_get_data_source]['code_data']}">${data_data_source[data_source_this_field.field_get_data_source]['value_data']}</option>`
                        });

                    element_input_field_ = `
                                                <select style="width: 100%;" name="${data_field.code_field}" id="${data_field.code_field}" class="custom-select2 form-control">
                                                    <option value="">Pilih Data</option>
                                                    ${element_option_data_source}
                                                </select>
                                            `;

                    element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field}</label>
                                ${element_input_field_}
                            </div>
                        </div>`;

                    $(`#${id_field}`).append(element_field)
                    $(`#${data_field.code_field}`).select2();
                    break;
                case 'Color':

                    element_input_field_ =

                        `<input type="color" onchange="setColor('${data_field.code_field}')" class="form-control-color form-control" name="${data_field.code_field}" id="${data_field.code_field}" value="#f56767" />`;
                    element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field}</label>
                                <div class="row">
                                    <div class="col-6">
                                        ${element_input_field_}
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="color-${data_field.code_field}" value="#f56767" />
                                    </div>
                                </div>                                
                            </div>
                        </div>`;
                    $(`#${id_field}`).append(element_field)
                    break;
                case 'DATE':
                    element_input_field_ =
                        `<input type="date" class="form-control" name="${data_field.code_field}" id="${data_field.code_field}">`;
                    element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field}</label>
                                ${element_input_field_}
                            </div>
                        </div>`;
                    $(`#${id_field}`).append(element_field)
                    break;
                case 'hidden':
                    element_input_field_ =
                        `<input type="text" disabled class="form-control" name="${data_field.code_field}" id="${data_field.code_field}">`;
                    element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field}</label>
                                ${element_input_field_}
                            </div>
                        </div>`;
                    $(`#${id_field}`).append(element_field)
                    break;
                default:
                    break;
            }
        }

        function setColor(id_field) {
            $('#color-' + id_field).val($('#' + id_field).val());
        }

        async function actionCard(code_table) {
            // filterDatatable(code_table)

            /*
            1. field form
            2. header,
            3. datatable
            4.
            
            


            */

            let db_fields = db['db']['database_field'][code_table];            
            let table_childs = db['db']['data_table_child'][code_table]; 

            $(`#field-form`).empty();

            $(`#table-description`).text(db['db']['database_table'][code_table]['description_table']);
            $(`#text-form-description`).text(db['db']['database_table'][code_table]['description_table']);
            $(`#id-code_table`).val(code_table);

            $.ajax({
                url: '/api/mbg/manage/database/get-table',
                type: "POST",
                headers: {
                    'auth_login': ui_dataset.ui_dataset.user_authentication.auth_login
                    // Add other custom headers if needed
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    code_table: code_table
                },
                success: function(response) {
                    conLog('response get-table', response);

                    if(response.data.all_fields){
                        Object.values(response.data.all_fields).forEach(field => {
                            cardFormField('field-form', field);
                        });
                    }
                    

                    // conLog('arr _', Object.values(response.data.all_fields));
                    // reCreateFilterTable(code_table, response.data);
                    // $('#modal-filter').modal('show');
                },
                error: function(response) {
                    conLog('error', response);
                    stopLoading();
                }
            });




            //=========== create field form
                // === create table fields
            Object.values(db_fields).forEach(field => {
                cardFormField('field-form', field);
            });
                // === create table fields

            $(`#field-form`).append(`
                <div class="col-md-12 col-sm-12 text-right">
                    <button type="button" onclick="storeDataTable('${code_table}')" class="btn btn-primary" id="save-from-table" data-dismiss="modal">
                        Simpan
                    </button>
                </div>
            `);


            if (table_childs) {
                $(`#sub-form`).empty();
                $('.faq-wrap').attr('hidden', false);

                conLog('table childs', table_childs);

                table_childs.forEach(element => {
                    $(`#sub-form`).append(`
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq-${element}">
                                    ${db['db']['database_table'][element]['description_table']}
                                </button>
                            </div>
                            <div id="faq-${element}" class="collapse" data-parent="#sub-form">
                                <div id="fields-${element}" class="card-body">
                                    
                                </div>
                            </div>
                        </div>
                    `);
                    db_fields = db['db']['database_field'][element];
                    Object.values(db_fields).forEach(field => {
                        cardFormField('fields-' + element, field);
                    });
                    $(`#fields-${element}`).append(`
                        <div class="col-md-12 col-sm-12 text-right">
                            <button disabled type="button" onclick="storeDataTable('${element}')" class="btn btn-primary" id="save-from-table" data-dismiss="modal">
                                Simpan ${db['db']['database_table'][element]['description_table']}
                            </button>
                        </div>
                    `);
                });
            } else {

                $('.faq-wrap').attr('hidden', true);
            }
            //=========== create field form


            refreshTableData(code_table);

        }

        function reCreateFilterTable(code_table, data_table) {
            conLog('recreate filter datatable',code_table);
            rowDataFilterTable = [];
            let headerTableFilter = `<th>
                                        <div class="dt-checkbox no-sort">
                                            <input onchange="selectAllFilter()"
                                                type="checkbox"
                                                name="select_all-filter"
                                                value="0"
                                                id="select-all-filter"
                                            />
                                            <span class="dt-checkbox-label"></span>
                                        </div>
                                    </th>
                                    <th> Nama Field</th>
                                    <th> Tabel</th>
                                    `;
            headerTableFilter = `                    
                    <table id="table-datatable-filter" class="checkbox-datatable nowrap stripe hover table" style="width:100%">
                        <thead>
                            <tr>
                                ${headerTableFilter}
                            </tr>
                        </thead>
                    </table>
                `;
            $('#datatable-filter').empty();
            $('#filter-name').val(code_table);

            $('#datatable-filter').append(headerTableFilter);

            var checkbox_card_element = {
                mRender: function(data, type, row) {

                    let isChecked = "";
                    // if (data_filter['data'][part_filter]) {
                    //     isChecked = ((data_filter['data'][part_filter]).filter(item => item === row).length > 0) ?
                    //         "checked" : "";
                    // }
                    return `<input value="${row}" type="checkbox" ${isChecked} class="datatable-filter editor-active dt-checkbox no-sort">`
                }
            };

            rowDataFilterTable.push(checkbox_card_element);

            // fields description
            var fields_description_element = {
                mRender: function(data, type, row) {
                    return row.description_field;
                }
            };
            rowDataFilterTable.push(fields_description_element);

            // table name
            var table_description_element = {
                mRender: function(data, type, row) {
                    return data_table['all_table'][row.code_table_field]['description_table'];
                }
            };
            rowDataFilterTable.push(table_description_element);

            $('#table-datatable-filter').DataTable({
                paging: false,
                // scrollY: true,
                scrollX: true,
                scrollY: "400px",

                responsive: true,
                serverSide: false,
                data: data_table['arr_fields'],
                columns: rowDataFilterTable
            });
        }

        function selectAllFilter() {
            var isChecked = $('#select-all-filter').prop('checked');
            $('.datatable-filter').prop('checked', isChecked);

        }



        function storeDataTable(code_table) {
            // fields
            var formDataArray = $("#fields").serializeArray();
            let db_table = db['db']['database_table'][code_table];

            conLog('formDataArray', formDataArray);
            conLog('db_table', db_table);
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
                    showModalSuccess();
                    refreshTableData(code_table);

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

        async function deleteThisData() {
            let uuid_data = $('#code_data_delete').val();
            $.ajax({
                url: '/api/mbg/manage/database/delete-data-database',
                type: "POST",
                headers: {
                    'auth_login': ui_dataset.ui_dataset.user_authentication.auth_login
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    uuid_data: uuid_data
                },
                success: function(response) {
                    conLog('data deleted', response);
                    if (response) {
                        $('#confirm-modal-async').modal('hide');
                        $(`#${uuid_data}`).parent().parent().remove();

                        refreshSession();
                        actionCard(code_table)
                        refreshTableData(code_table);
                    }
                },
                error: function(response) {
                    console.log(response)
                }
            });
        }

        refreshTable();

        function refreshTableData(code_table) {
            let row_data_datatable = [];
            let header_table_element = '';
            let header_table_field = [];

            let the_table = db['db']['database_table'][code_table];

            CL(the_table);

            Object.values(db['db']['database_field'][code_table]).forEach(field_table => {
                
                // ============ create header table
                header_table_field.push(field_table['description_field']);
                // ============ create header table


                // conLog('field_table', field_table)
                // add row data datatable


                // ======== default Value Datatable
                var element_card = {
                    mRender: function(data, type, row) {
                        conLog('row', row)
                        let datas = row[field_table['code_field']] ? row[field_table['code_field']][
                            'value_data'
                        ] : null
                        return datas;
                    }
                };

                // ======== default Value Datatable

                // ======== switch kind of data type

                if (field_table['type_data_field'] == 'Color') {
                    var element_card = {
                        mRender: function(data, type, row) {
                            // conLog('row', row)
                            let datas = row[field_table['code_field']] ? row[field_table['code_field']][
                                'value_data'
                            ] : 'kosong';
                            let color = row[field_table['code_field']] ? row[field_table['code_field']][
                                'value_data'
                            ] : '#ffffff';
                            return `
                                <div class="row">
                                    <div class="col-4">
                                        <input type="color"  class="form-control-color form-control"  value="${color}" />
                                    </div>
                                    <div class="col-8">
                                        <input disabled type="text" class="form-control" name="" id="" value="${datas}">
                                    </div>
                                </div>
                            `;
                        }
                    };
                } else {
                    var element_card = {
                        mRender: function(data, type, row) {
                            // conLog('row', row)
                            let datas = row[field_table['code_field']] ? row[field_table['code_field']][
                                'value_data'
                            ] : null
                            return datas;
                        }
                    };
                }

                // ======== switch kind of data type
                row_data_datatable.push(element_card);
            });

            //row dari field primary ambil uuid_datanya


            // add row data datatable
            var employees_card_element = {
                mRender: function(data, type, row) {
                    return `<div class="table-actions">
                                <a href="#" onclick="editDataForm('${row[the_table['primary_table']]['uuid_data']}')" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-edit2"></i></a>
                                <a href="#" onclick="deleteForm('${row[the_table['primary_table']]['uuid_data']}')"  data-color="#e95959" style="color: rgb(233, 89, 89);"><i class="icon-copy dw dw-delete-3"></i></a>
                            </div>`;
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
