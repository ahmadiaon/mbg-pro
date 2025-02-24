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
                <a href="#" id="refresh-table" class="btn btn-primary btn-sm"role="button">refresh</a>
            </div>
        </div>
        <div class="" id="datatable">
            <table class="data-table table stripe hover nowrap" id="table-datatable">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Name</th>
                        <th class="table-plus datatable-nosort">Menu</th>
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
        <div id="form-parent" class="pd-20 card-box mb-30 col-md-6 col-sm-12">
            <div class="clearfix mb-10">
                <div class="pull-left">
                    <h4 id="table-description" class="text-blue h4">Field Form</h4>
                    <p>Tambahkan data pada form-form berikut</p>
                    <input type="text" name="uuid_data" id="uuid_data">
                </div>
                <div class="pull-right">
                    <button onclick="resetForm()" class="btn btn-primary btn-sm">RESET</button>
                </div>
                <div class="pull-right" hidden>
                    <a href="#basic-form1" id="basic-form1" class="btn btn-primary btn-sm scroll-click" rel="content-y"
                        data-toggle="collapse" role="button">Reset</a>
                </div>
            </div>
            <div id="FORM-BASIC" class="">
                <form id="fields" class="header-form" enctype="multipart/form-data">
                    
                </form>
            </div>
        </div>

        <div class="faq-wrap col-md-6 col-sm-12" hidden>
            <h4 class="mb-20 h4 text-blue">Sub Form</h4>
            <div id="sub-form">

            </div>
        </div>
    </div>




    <div class="card-box mb-20">
        <div class="pd-20 clearfix mb-10">
            <div class="pull-left">
                <h4 id="text-form-description" class="text-blue h4">Data Table</h4>
                <input type="text" class="form-control" id="id-code_table">
            </div>
            <div class="pull-right">
                <a href="#" onclick="btnRefreshDataTable()" id="btn-refresh-datatable"
                    class="btn btn-primary btn-sm " role="button">refresh</a>
            </div>
        </div>
        <form action="#" id="FORM-FILTER">
            <div class="row">
                <div class="col-12  mt-10">
                    <div class="row pd-20">
                        {{-- filter --}}
                        <div class="col-md-5 col-sm-12 card-box pt-20 mr-20">
                            <div class="pd-10 clearfix mb-10">
                                <div class="pull-left">
                                    <h4 id="text-filter" class="text-blue h4">Filter</h4>
                                    <input type="hidden" class="form-control" id="id-filter">
                                </div>
                                <div class="pull-right">
                                    <button id="btn-toggle-filter" type="button"
                                        onclick="togleVisibleElement('datatable-filter','btn-toggle-filter')"
                                        class="btn btn-primary btn-sm"><i class="icon-copy bi bi-box-arrow-in-up">
                                        </i>hide</button>
                                    <a href="#" onclick="btnRefreshDataTable()" id="btn-refresh-datatable"
                                        class="btn btn-primary btn-sm " role="button">refresh</a>
                                </div>
                            </div>
                            <div class="pb-20" id="datatable-filter">
                                <table class="data-table table stripe hover nowrap" id="table-datatable-filter">
                                    <thead>
                                        <tr>
                                            <th class="table-plus datatable-nosort">Fields</th>
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
                        {{--  show fields --}}
                        <div class=" col-md-6 col-sm-12 card-box pt-20">
                            <div class="pd-10 clearfix mb-10">
                                <div class="pull-left">
                                    <h4 id="text-field-show" class="text-blue h4">Field show</h4>
                                    <input type="hidden" class="form-control" id="id-filter">
                                </div>
                                <div class="pull-right">
                                    <button id="btn-toggle-field-show" type="button"
                                        onclick="togleVisibleElement('datatable-field-show','btn-toggle-field-show')"
                                        class="btn btn-primary btn-sm"><i class="icon-copy bi bi-box-arrow-in-up">
                                        </i>hide</button>
                                    <a href="#datatable-data" onclick="storeFieldShow()" id="btn-refresh-datatable"
                                        class="btn btn-primary btn-sm " role="button">Update tabel</a>
                                </div>
                            </div>
                            <div class="pb-20" id="datatable-field-show">
                                <table class="data-table table stripe hover nowrap" id="table-datatable-field-show">
                                    <thead>
                                        <tr>
                                            <th class="table-plus datatable-nosort">Fields</th>
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
                    </div>
                </div>

            </div>
        </form>
        <div class="row pd-20">
            <div class="col-md-6 col-sm-12">FILTER</div>
            <div class="col-md-6 col-sm-12 text-right">
                <button class="btn btn-secondary" data-toggle="modal" data-target="#modal-import-datatable"
                    type="button">
                    Import
                </button>
                <button onclick="exportDatatable('simple')" class="btn btn-primary">Export Table</button>
                <button onclick="exportDatatable('full')" class="btn btn-primary">Export Full</button>
                <button onclick="filterDatatable()" class="btn btn-primary">Filter Kolom</button>
            </div>
        </div>

        <div class="mb-20" id="datatable-data">
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

    <div class="modal fade" id="modal-import-datatable" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Import Data Table
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="form-import-datatable" method="POST">
                        <div class="form-group">
                            <label>Pilih data</label>
                            <input name="uploaded_file" type="file"
                                class="form-control-file form-control height-auto" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" onclick="importDatatable()">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="fileInfo"></div>
@endsection()

@section('script_javascript')
    <script>
        function togleVisibleElement(id_to_hide, btn_togle_hide) {
            CL($(`#${id_to_hide}`).attr('hidden'));
            if ($(`#${id_to_hide}`).attr('hidden') == 'hidden') {
                $(`#${btn_togle_hide}`).text('show filter');
                $(`#${id_to_hide}`).attr('hidden', null);
            } else {
                $(`#${btn_togle_hide}`).text('hide filter');
                $(`#${id_to_hide}`).attr('hidden', 'hidden');
            }
        }

        function filterDatatable() {
            let code_table = $('#code_table').val();
            $.ajax({
                url: '/api/mbg/manage/database/get-table',
                type: "POST",
                headers: {
                    'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login
                    // Add other custom headers if needed
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    code_table: code_table
                },
                success: function(response) {
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

        function importDatatable() {
            var form = $('#form-import-datatable')[0];
            var form_data = new FormData(form);
            conLog('form_data', form_data);
            //  return false;
            startLoading()
            $.ajax({
                url: '/api/mbg/manage/database/import-datatable',
                type: "POST",
                headers: {
                    'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login
                },
                data: form_data,
                contentType: false,
                processData: false,
                success: function(response) {
                    conLog('responses data import', response);
                    stopLoading();
                },
                error: function(response) {
                    conLog('response err', response)
                }
            });
        }

        function exportDatatable(type_export) {
            conLog('code_data', $('#id-code_table').val())
            conLog('data code_data', db['public']['public_value'][$('#id-code_table').val()]);
            let database_datatable = getValueDatabase_datatable($('#id-code_table').val());
            
            $.ajax({
                url: '/web/manage/database/export-datatable',
                type: "POST",
                headers: {
                    'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    fields: (type_export == "full") ? Object.values(database_datatable['all-fields']) : Object
                        .values(database_datatable['show-fields']),
                    // data_export: db['public']['public_value'][$('#id-code_table').val()],
                    code_table_data: $('#id-code_table').val(),

                },
                success: function(response) {
                    conLog('responses', response);

                    // return false;
                    var dlink = document.createElement("a");
                    dlink.href = `/${response.data}`;
                    dlink.setAttribute("download", "");
                    dlink.click();
                },
                error: function(response) {
                    conLog('response err', response)
                    // alertModal()
                }
            });
        }

        function resetForm() {
            $('#FORM-BASIC').empty();
            $('#uuid_data').val("");
            createFormField($('#id-code_table').val());
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

        function changeInput(code_element) {
            $(`#code-autocomplite-${code_element}`).val(toUUID($(`#${code_element}`).val()));
        }

        function setColor(id_field) {
            $('#color-' + id_field).val($('#' + id_field).val());
        }

        function btnRefreshDataTable() {
            let valTable = $('#btn-refresh-datatable').attr('action');
            valTable = valTable.slice(1);
            refreshTableData(valTable)
            CL(valTable);
        }

        function storeFieldShow() {
            let arr_checkbox_filter = [];
            let obj_checkbox_filter = [];
            var checkboxValues = $('.field-show:checked').map(function() {
                let code_field = $(this).val();
                let code_table_field = $(`#code_table_field-${code_field}`).val();
                arr_checkbox_filter.push(db['db']['database_field'][code_table_field][code_field]);
                obj_checkbox_filter[code_field] = db['db']['database_field'][code_table_field][code_field];
            }).get();
            conLog('arr_checkbox_filter', arr_checkbox_filter);
            conLog('obj_checkbox_filter', obj_checkbox_filter);
            $.ajax({
                url: '/api/mbg/manage/database/store-template',
                type: "POST",
                headers: {
                    'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'show-fields': arr_checkbox_filter,
                    'code_table_get': $('#id-code_table').val(),
                },
            }).done(function(response) {
                conLog('respone', response)
                db['db']['table_show_template'][ui_dataset.ui_dataset.user_authentication.employee_uuid][$(
                    '#id-code_table').val()] = response.data
                refreshSession();
                actionCard($('#id-code_table').val());
            }).fail(function(response) {
                conLog('error', response);
                stopLoading();
                //alertModal()
            });

        }

        function updateFieldShow(code_table) {
            CL('database_datatable');
            let database_datatable = getValueDatabase_datatable(code_table);
            let rowDataFieldShow = [];
            let classChecbox = 'field-show';
            let headerTableFieldShow = `<th>
                                            <div class="dt-checkbox no-sort">
                                                <input onchange="selectAllFilter('${classChecbox}')"
                                                    type="checkbox"
                                                    name="select_all_field_show"
                                                    value="0"
                                                    id="select_all_field_show"
                                                    />
                                                    <span class="dt-checkbox-label"></span>
                                                </div>
                                                </th>
                                            <th> Nama Field</th>
                                        <th> Tabel</th>
                                        `;
            headerTableFieldShow = `                    
                            <table id="table-datatable-field-show" class="checkbox-datatable nowrap stripe hover table" style="width:100%">
                                <thead>
                                    <tr>
                                        ${headerTableFieldShow}
                                    </tr>
                                </thead>
                            </table>
                        `;


            $('#datatable-field-show').empty();
            $('#text-field-show').val(code_table);
            $('#datatable-field-show').append(headerTableFieldShow);

            var checkbox_card_element = {
                mRender: function(data, type, row) {
                    return `
                    <input id="code_table_field-${row.code_field}" value="${row.code_table_field}" type="hidden" class="${classChecbox} editor-active dt-checkbox no-sort">
                    <input id="checbox-${row.code_field}" value="${row.code_field}" type="checkbox" class="${classChecbox} editor-active dt-checkbox no-sort">`
                }
            };

            rowDataFieldShow.push(checkbox_card_element);

            // fields description
            var fields_description_element = {
                mRender: function(data, type, row) {
                    return row.description_field;
                }
            };
            rowDataFieldShow.push(fields_description_element);

            // table name
            var table_description_element = {
                mRender: function(data, type, row) {
                    return db['db']['database_table'][row.code_table_field][
                        'description_table'
                    ];
                }
            };
            rowDataFieldShow.push(table_description_element);

            $('#table-datatable-field-show').DataTable({
                paging: false,
                scrollX: true,
                scrollY: "400px",

                responsive: true,
                serverSide: false,
                data: Object.values(database_datatable['all-fields']),
                columns: rowDataFieldShow
            });

            // checked start
            database_datatable['show-fields'].forEach(item_show_field => {
                $(`#checbox-${item_show_field.code_field}`).prop('checked', 'checked');
            });
        }

        function createFormField(code_table) {
            $('#FORM-BASIC').empty();

            $('#FORM-BASIC').append(`
                <form id="FORM-${code_table}" class="FORM-${code_table} header-form" enctype="multipart/form-data">
                    
                </form>
            `);
            


            let database_datatable = getValueDatabase_datatable(code_table);
            // === create table fields
            Object.values(database_datatable['fields']).forEach(field => {
                cardFormField(`FORM-${code_table}`, field);
            });
            // === create table fields

            $(`#FORM-${code_table}`).append(`
                <div class="col-md-12 col-sm-12 text-right">
                    <button type="button" onclick="storeDataTable('${code_table}')" class="btn btn-primary" id="save-from-table" data-dismiss="modal">
                        Simpan
                    </button>
                </div>
            `);

            //=========== create field child
            if (database_datatable['table_childs']) {
                $(`#sub-form`).empty();
                $('.faq-wrap').attr('hidden', false);
                database_datatable['table_childs'].forEach(element => {
                    /*
                    1. buat form table child di bawah table utama
                    */
                    CL(element)
                    $(`#sub-form`).append(`
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq-${element}">
                                    ${db['db']['database_table'][element]['description_table']}
                                </button>
                            </div>
                            <div id="faq-${element}" class="collapse" data-parent="#sub-form">
                                <form id="FORM-${element}" class="FORM-${element}" enctype="multipart/form-data">
                                    <div id="fields-${element}" class="card-body">
                                    
                                    </div>
                                </form>
                            </div>
                        </div>
                    `);
                    database_datatable['field_childs'] = db['db']['database_field'][element];
                    Object.values(database_datatable['field_childs']).forEach(field => {
                        cardFormField('fields-' + element, field);
                    });
                    $(`#fields-${element}`).append(`
                        <div class="col-md-12 col-sm-12 text-right">
                            <button disabled type="button" onclick="storeDataTable('${element}')" class="btn btn-primary secondary_btn_store" id="save-from-table" data-dismiss="modal">
                                Simpan ${db['db']['database_table'][element]['description_table']}
                            </button>
                        </div>
                    `);
                });
            } else {
                $('.faq-wrap').attr('hidden', true);
            }
            //=========== create field child


            // ========== PERSETUJUAN ========
            if (db['db']['database_persetujuan'][code_table]) {
                $('.faq-wrap').attr('hidden', false);
                $(`#sub-form`).append(`
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq-PERSETUJUAN">
                                    PERSETUJUAN
                                </button>
                            </div>
                            <div id="faq-PERSETUJUAN" class="collapse" data-parent="#sub-form">
                                <form id="FORM-PERSETUJUAN" class="form-PERSETUJUAN" enctype="multipart/form-data">
                                    @csrf
                                    <div id="fields-PERSETUJUAN" class="card-body">
                                    
                                    </div>
                                </form>
                            </div>
                        </div>
                    `);

                Object.values(db['db']['database_persetujuan'][code_table]).forEach(element => {});
            }
            // ========== PERSETUJUAN ========
        }

        async function actionCard(code_table) {
            /*
                1. field form
                2. header,
                3. datatable
            */

            CL('action card')
            GLOBAL_DATA_EXPORT['data'] = {};
            // let database_datatable = getValueDatabase_datatable(code_table);
            $('#btn-refresh-datatable').attr('action', `#${code_table}`);
            // $(`#field-form`).empty();
            // $('#fields').attr('class', `FORM-${code_table}`);
            $('#datatable-data').empty();
            $(`#table-description`).text(db['db']['database_table'][code_table]['description_table']);
            $(`#text-form-description`).text(db['db']['database_table'][code_table]['description_table']);
            $(`#id-code_table`).val(code_table);

            // fields show
            updateFieldShow(code_table);
            createFormField(code_table);
            refreshTableData(code_table);
        }

        function reCreateFilterTable(code_table, data_table) {
            conLog('recreate filter datatable', code_table);
            rowDataFieldShow = [];
            let headerTableFieldShow = `<th>
                                        <div class="dt-checkbox no-sort">
                                            <input onchange="selectAllFilter()"
                                                type="checkbox"
                                                name="select_all_field_show"
                                                value="0"
                                                id="select_all_field_show"
                                            />
                                            <span class="dt-checkbox-label"></span>
                                        </div>
                                    </th>
                                    <th> Nama Field</th>
                                    <th> Tabel</th>
                                    `;
            headerTableFieldShow = `                    
                    <table id="table-datatable-field-show" class="checkbox-datatable nowrap stripe hover table" style="width:100%">
                        <thead>
                            <tr>
                                ${headerTableFieldShow}
                            </tr>
                        </thead>
                    </table>
                `;

            $('#datatable-field-show').empty();
            $('#text-field-show').val(code_table);
            $('#datatable-field-show').append(headerTableFieldShow);

            var checkbox_card_element = {
                mRender: function(data, type, row) {

                    let isChecked = "";
                    return `<input value="${row}" type="checkbox" ${isChecked} class="datatable-filter editor-active dt-checkbox no-sort">`
                }
            };

            rowDataFieldShow.push(checkbox_card_element);

            // fields description
            var fields_description_element = {
                mRender: function(data, type, row) {
                    return row.description_field;
                }
            };
            rowDataFieldShow.push(fields_description_element);

            // table name
            var table_description_element = {
                mRender: function(data, type, row) {
                    return data_table['all_table'][row.code_table_field]['description_table'];
                }
            };
            rowDataFieldShow.push(table_description_element);

            $('#table-datatable-filter').DataTable({
                paging: false,
                // scrollY: true,
                scrollX: true,
                scrollY: "400px",

                responsive: true,
                serverSide: false,
                data: data_table['arr_fields'],
                columns: rowDataFieldShow
            });
        }

        function selectAllFilter(classChecbox) {
            var isChecked = $('#select_all_field_show').prop('checked');
            $(`.${classChecbox}`).prop('checked', isChecked);

        }

        function handleFileInput(event) {
            const input = event.target;
            const fileList = input.files;
            const fileInfo = document.getElementById('fileInfo');

            fileInfo.innerHTML = ''; // Clear previous file info

            for (let i = 0; i < fileList.length; i++) {
                const file = fileList[i];
                const fileDetails = `
            <p>Input Name: ${input.name}</p>
            <p>File Name: ${file.name}</p>
            <p>File Size: ${file.size} bytes</p>
            <p>File Type: ${file.type}</p>
        `;
                fileInfo.innerHTML += fileDetails;
            }
        }

        

        function refreshTable() {
            let row_data_datatable = [];
            let header_table_element = '';
            let header_table_field = ['Description Table', 'Menu', 'Action'];

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
                    return row.description_table
                }
            };
            row_data_datatable.push(employees_card_element);

            var menu_table_element = {
                mRender: function(data, type, row) {
                    return row.menu_table
                }
            };
            row_data_datatable.push(menu_table_element);



            var action_table_element = {
                mRender: function(data, type, row) {
                    return `<button onclick="actionCard('${row.code_table}')"  class="btn btn-sm btn-secondary">
                                <i class="icon-copy bi bi-gear"></i>
                            </button>`;
                }
            };
            row_data_datatable.push(action_table_element);

            let data_datatable = Object.values(db['db']['database_table']);
            $('#table-datatable').DataTable({
                paging: true,
                responsive: true,
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
                    'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login
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
                        actionCard($(`#id-code_table`).val())
                        btnRefreshDataTable();
                        // refreshTableData(code_table);
                    }
                },
                error: function(response) {
                    console.log(response)
                }
            });
        }

        function setGlobalDataExportData() {
            if (GLOBAL_DATA_EXPORT['data'][primary_key_data] === undefined) {
                GLOBAL_DATA_EXPORT['data'] = {}
            }
        }

        refreshTable();




        function refreshTableData(code_table) {
            let row_data_datatable = [];
            let database_datatable = getValueDatabase_datatable(code_table);
            conLog('database_datatable', database_datatable);

            let header_table_element = ``;

            database_datatable['show-fields'].forEach(field_table => {
                let code_field = field_table['code_field'];
                let type_data_field = field_table['type_data_field'];
                let data_code_table = field_table['code_table_field'];

                // ============ create header table
                header_table_element =
                    `${header_table_element} <th> ${field_table['description_field']} </th>`
                // ============ create header table


                // conLog('field_table',field_table);
                // ======== default Value Datatable
                var element_card = {
                    mRender: function(data, type, row) {
                        let code_data = row;
                        let data_show = null;
                        try {
                            // conLog('type_data_field',type_data_field)
                            data_show = showFieldData(type_data_field, data_code_table, code_field,
                                toUUID(code_data)
                            );
                        } catch (error) {
                            // conLog(data_code_table, row);
                            // conLog('code_field', code_field);
                            return data_show;
                        }
                        // if (typeof db['db']['database_data'][data_code_table][code_data] !== 'undefined') {
                        //     if (typeof db['db']['database_data'][data_code_table][code_data][code_field] !==
                        //         'undefined') {
                        //         // conLog('type_data_field',type_data_field)
                        //         data_show = showFieldData(type_data_field, data_code_table, code_field,
                        //             toUUID(code_data)
                        //         );
                        //     }
                        // }
                        return data_show;
                    }
                };
                row_data_datatable.push(element_card);
            });

            let primary_field = database_datatable['table']['primary_table'];
            var employees_card_element = {
                mRender: function(data, type, row) {
                    return `<div class="table-actions">
                                <a href="#" onclick="editDataForm('${row}')" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-edit2"></i></a>
                                <a href="#" onclick="deleteForm('` + db['db']['database_data'][code_table][row][
                        primary_field
                    ]['uuid_data'] + `')"  data-color="#e95959" style="color: rgb(233, 89, 89);"><i class="icon-copy dw dw-delete-3"></i></a>
                            </div>`;
                }
            };

            // ============ create header table
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

            // ============ create header table

            row_data_datatable.push(employees_card_element);
            let data_datatable = [];
            if (db['db']['database_data'][code_table]) {
                data_datatable = Object.keys(db['db']['database_data'][code_table]);
            }
            $('#table-datatable-data').DataTable({
                scrollX: true,
                scrollY: "600px",
                paging: false,
                serverSide: false,
                response: true,
                data: data_datatable,
                columns: row_data_datatable
            });
        }

        function editDataForm(code_data) {
            resetForm();
            let database_datatable = getValueDatabase_datatable($('#id-code_table').val());
            let primary_field = database_datatable['table']['primary_table'];
            conLog('code_data', code_data);
            // conLog('primary_field',primary_field);

            let uuid_data = db['db']['database_data'][$('#id-code_table').val()][code_data][primary_field]['uuid_data'];
            let data_for_field_edit = db['public'][$('#id-code_table').val()][code_data];
            conLog('data_for_field_edit', data_for_field_edit);
            $('#uuid_data').val(uuid_data);

            // === create table fields
            Object.values(database_datatable['fields']).forEach(field => {
                $(`#${field.code_table_field}-${field.code_field}`).val("");
                if (data_for_field_edit[field.code_field]) {
                    $(`#${field.code_table_field}-${field.code_field}`).val(data_for_field_edit[field.code_field])
                        .trigger('change');;
                }
            });
            // === create table fields

            // return false;
            if (database_datatable['table_childs']) {
                database_datatable['table_childs'].forEach(element => {
                    database_datatable['field_childs'] = db['db']['database_field'][element];
                    conLog(element, database_datatable['field_childs']);
                    Object.values(database_datatable['field_childs']).forEach(field => {
                        conLog('code_data', code_data)
                        conLog('fields child', `${field.code_table_field}-${field.code_field}`)
                        if (data_for_field_edit[field.code_field]) {
                            if (data_for_field_edit[field.code_field]) {
                                let value_data = data_for_field_edit[field.code_field];
                                // conLog('have data child', `${field.code_table_field}-${field.code_field}`);



                                if (field.type_data_field == 'FILE') {
                                    conLog('value', value_data);
                                } else if (field.type_data_field == KONSTANTA["Input Autocomplite"]) {
                                    $(`#code-autocomplite-${field.full_code_field}`).val(value_data);
                                    let data_source = db['db']['database_data_source'][field
                                        .full_code_field
                                    ];
                                    $(`#${field.full_code_field}`).val(db['public'][data_source
                                        .table_data_source
                                    ][value_data][data_source.field_get_data_source]);
                                } else {
                                    $(`#${field.code_table_field}-${field.code_field}`).val(value_data);
                                }
                            }
                            $('.custom-select2').trigger('change');
                        }
                    });
                });
                $('.secondary_btn_store').attr('disabled', false);
                $('.secondary_key').val(code_data);
            }
        }
    </script>




















    <script>
        //to delete
        function storeDataTableDatabase(code_table) {
            const fileInputs_element = document.querySelectorAll(`input[type="file"].${code_table}`);

            fileInputs_element.forEach(input => {
                conLog('xx', input);
                input.addEventListener('change', handleFileInput);
            });

            const form = document.getElementById('myForm');
            const formData = new FormData();
            const fileInputs = document.querySelectorAll(`input[type="file"].${code_table}`);
            const fileInfo = document.getElementById('fileInfo');

            fileInfo.innerHTML = ''; // Clear previous file info

            fileInputs.forEach(input => {
                if (input.files.length > 0) {
                    for (let i = 0; i < input.files.length; i++) {
                        formData.append(input.name, input.files[i]);
                    }
                }
            });
            formData.append('code_table_data', code_table);


            // fields
            var formDataArray = $(`.form-${code_table}`).serializeArray();
            // var formDataArray = new FormData(document.getElementById(`#FORM-${code_table}`));
            let db_table = db['db']['database_table'][code_table];
            let data_source_this_field = {};
            Object.values(db['db']['database_field'][code_table]).forEach(element => {
                if (element.type_data_field == KONSTANTA['Input Autocomplite']) {
                    data_source_this_field[element.full_code_field] = db['db']['database_data_source'][element
                        .full_code_field
                    ];
                    data_source_this_field[element.full_code_field]['primary_field'] = db['db']['database_table'][
                        data_source_this_field[element.full_code_field]['table_data_source']
                    ]['primary_table'];
                    data_source_this_field[element.full_code_field]['code_field'] = element.code_field;
                }
            });

            if (db['db']['database_field_show'][code_table]) {
                Object.entries(db['db']['database_field_show'][code_table]).forEach(([key_field, fields]) => {
                    let value_gabungan = '';
                    // conLog('key_field', key_field);
                    fields.forEach(items_field => {
                        value_gabungan = value_gabungan + `${items_field.split_by}` + $(
                            `#${code_table}-${items_field.field_show_code}`).val();
                    });
                    value_gabungan = value_gabungan.slice(1);
                    let new_data_form = {
                        name: key_field,
                        value: value_gabungan
                    }
                    formDataArray.push(new_data_form);
                });
            }

            // conLog('formDataArray', formDataArray);

            // return false;
            // conLog('data_source_this_field', data_source_this_field);
            $.ajax({
                url: '/api/mbg/manage/database/store-database',
                type: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login
                },
                data: JSON.stringify({
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    formData: formDataArray,
                    uuid_data: $('#uuid_data').val(),
                    data_table: db_table,
                    data_source_this_field: data_source_this_field
                }),
                success: function(response) {
                    conLog('response', response);


                    if (db_table['primary_table']) {
                        $('.secondary_btn_store').attr('disabled', false);
                        $('.secondary_key').val(response['data']['data_database_datatable'][db_table[
                            'primary_table']]);
                    }

                    showModalSuccess();

                    $('#uuid_data').val(response.data.uuid_data);
                    formData.append('code_data', response.data.code_data);
                    formData.append('uuid_data', response.data.uuid_data);

                    if (formData) {
                        console.log('asad');
                        $.ajax({
                            url: '/api/mbg/manage/database/store-database-file',
                            method: 'POST',
                            data: formData,
                            success: function(response) {
                                conLog('re', response);
                            },
                            contentType: false,
                            processData: false,
                            error: function(response) {
                                conLog('error', response);
                                //alertModal()
                            }
                        });
                        formData.forEach((value, key) => {
                            if (value instanceof File) {
                                console.log(`Key: ${key}`);
                                console.log(`File Name: ${value.name}`);
                                console.log(`File Size: ${value.size} bytes`);
                                console.log(`File Type: ${value.type}`);
                            } else {
                                console.log(`Key: ${key}`);
                                console.log(`Value: ${value}`);
                            }
                        });
                    } else {
                        console.log('kosong');
                    }
                    refreshSession();

                },
                complete: function() {
                    // Always hide the loading indicator after the AJAX call completes
                    refreshSession();
                    actionCard(code_table)
                },
                error: function(response) {
                    conLog('error', response);
                    stopLoading();
                    //alertModal()
                }
            });




        }
    </script>
@endsection()
