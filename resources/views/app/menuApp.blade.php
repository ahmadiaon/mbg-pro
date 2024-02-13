@extends('app.layouts.main')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Manage Form</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Manage Form
                        </li>
                    </ol>
                </nav>
            </div>
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
        <form>
            <div class="row profile-info" id="field-form-1">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Nama Field</label>
                        <input type="text" class="form-control description_field" id="description_field-1">
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mb-2">
                    <div class="form-group">
                        <label>Type Data Field</label>
                        <select style="width: 100%;" onchange="selectSource(1)" name="type_data_field-1"
                            id="type_data_field-1" class="custom-select2 form-control type-data">
                            <option value="">Tipe Data Field</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="form-group">
                        <label>Urutan Field</label>
                        <input type="text" class="form-control" id="sort_field" value="1">
                    </div>
                </div>
                <div class="col-md-1 col-sm-6">
                    <div class="form-group">
                        <label>Action</label>
                        <button onclick="deleteFiled(1)" type="button" id="1" name="btn-delete-1"
                            class="form-control btn btn-danger btn-delete">
                            <i class="icon-copy dw dw-delete-3"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center btn-add-form-field">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <button type="button" class="btn-block btn btn-primary add-form-field">
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-10">
            <div class="pull-left">
                <h4 class="text-blue h4">Manage Form</h4>
                <p>Tambah atau edit form</p>
            </div>
            <div class="pull-right" hidden>
                <a href="#basic-form1" id="basic-form1" class="btn btn-primary btn-sm scroll-click" rel="content-y"
                    data-toggle="collapse" role="button">Reset</a>
            </div>
        </div>
        <form>
            <div class="profile-info">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Nama Form</label>
                    <div class="col-sm-12 col-md-4 mb-2">
                        <input class="form-control" type="text" id="description_table" name="description_table"
                            placeholder="Nama Tabel">
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <input class="form-control" id="count_field" type="hidden" value="1" placeholder="">
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Primary</label>
                    <div class="col-sm-12 col-md-4">
                        <input type="text" class="form-control" name="primary_table" id="primary_table">
                        {{-- <select name="" id="" class="form-control">
                            <option value="">Pilih Field Primary</option>
                        </select> --}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Nama Menu</label>
                    <div class="col-sm-12 col-md-4">
                        <select style="width: 100%;" name="menu_table" id="menu_table"
                            class="custom-select2 form-control employees">
                            <option value="">Nama Menu</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Level Table</label>
                    <div class="col-sm-12 col-md-4">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="jenis-form" id="single" value="single"
                                    autocomplete="off" checked="">
                                Primary
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="jenis-form" id="multi" value="multi"
                                    autocomplete="off">
                                Secondary
                            </label>

                        </div>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Referensi Tabel</label>
                    <div class="col-sm-12 col-md-4">
                        <select style="width: 100%;" name="parent_table" id="parent_table"
                            class="custom-select2 form-control database-table">
                            <option value="">Pilih Tabel Referensi</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <button type="button" class="col-6 btn btn-primary btn-block create-form">Create Form</button>
                </div>
            </div>
            <div class="profile-info">
            </div>
        </form>
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

    {{-- modal from_table --}}
    <div class="modal fade" id="modal-from_table" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Data Dari Table
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <label for="table">Table Rujukan</label>
                    <select name="table" id="table" onchange="selectTableSource()"
                        class="custom-select2 form-control select-table database-table" style="width: 100%;">
                        <option value="">Pilih tabel</option>
                    </select>
                </div>
                {{-- <div class="modal-body">
                    <label for="field_source">Kolom Rujukan</label>
                    <select name="field_source" id="field_source" class="custom-select2 form-control select-field_source"
                        style="width: 100%;">
                        <option value="">Pilih kolom</option>
                    </select>
                </div> --}}
                <div class="modal-body">
                    <label for="field_get">Kolom diambil</label>
                    <select name="field_get" id="field_get" class="custom-select2 form-control select-field_get"
                        style="width: 100%;">
                        <option value="">Pilih kolom</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary" id="save-from-table" data-dismiss="modal"
                        onclick="saveFromTable()">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script_javascript')
    <script>
        let element_option_type_data = '';
        let type_data_fields;
        let structure_table;

        let from_table_form = {};
        

        function addFormField(id_btn) {
            let element_form_field_full = `
                <div class="row profile-info" id="field-form-${id_btn}">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Nama Field</label>
                                <input type="text" class="form-control" id="description_field-${id_btn}">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Type Data Field</label>
                                <select onchange="selectSource(${id_btn})" style="width: 100%;" name="type_data_field-${id_btn}" id="type_data_field-${id_btn}" class="s2 form-control type-data">
                                    <option value="">Tipe Data Field</option>
                                    ${element_option_type_data}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <div class="form-group">
                                <label>Urutan Field</label>
                                <input type="text" class="form-control" value="${id_btn}" id="sort_field-${id_btn}">
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-6">
                            <div class="form-group">
                                <label>Action</label>
                                <button onclick="deleteFiled(${id_btn})" type="button" id="${id_btn}" name="btn-delete-${id_btn}"
                                    class="form-control btn btn-danger btn-delete">
                                    <i class="icon-copy dw dw-delete-3"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            return element_form_field_full;
        }

        function deleteFiled(id_field) {
            var clickedButtonId = id_field;
            conLog('btn delete', clickedButtonId);
            $(`#field-form-${clickedButtonId}`).remove();
        }

        function selectSource(id_form) {
            let val_option_source_field = $(`#type_data_field-${id_form}`).val();
            CL(val_option_source_field)
            switch (val_option_source_field) {
                case 'DARI-TABEL':
                    $('#save-from-table').attr('onclick', `saveFromTable(${id_form})`)
                    $('#modal-from_table').modal('show');
                    return false;
                    break;
                default:
                    return false;
            }
        }

        function selectTableSource() {
            let table_source = $(`#table`).val();

            $('#field_get').empty();
            Object.values(db['db']['database_field'][table_source]).forEach(element => {
                $('#field_get').append(`
                        <option value="${element.full_code_field}">${element.description_field}</option>
                    `);
            });
            return false;
        }

        function saveFromTable(id_form) {
            CL('save data source')
            from_table_form[`data-source-${id_form}`] = {
                table_data_source: $(`#table`).val(),
                field_get_data_source: $(`#field_get`).val()
            }
            CL(from_table_form)
        }



        $(document).ready(function() {
            
            refreshSession();

            let var_menu = "menu";

            Object.values(db['db']['database_table']).forEach(element => {
                // conLog('xx', element)
                $(`.database-table`).append(`
                        <option value="${element.code_table}">${element.description_table}</option>
                    `);
            });


            // menu option
            Object.values(db['db']['menu']).forEach(element => {
                // conLog('xx', element)
                $(`.employees`).append(`
                        <option value="${element.uuid}">${element.description}</option>
                    `);
            });
            
            // type data option
            Object.values(db['db']['database_data']['TYPE-DATA']).forEach(element => {
                CL('element');CL(element);
                element_option_type_data =
                    `${element_option_type_data }  
                    <option value="${element['TYPE-DATA-TYPE-DATA']['code_data']}">${element['TYPE-DATA-TYPE-DATA']['value_data']}</option>`;
            });
            $(`.type-data`).append(element_option_type_data);

            $('button[class="btn-block btn btn-primary add-form-field"]').click(function() {
                let countField = $('#count_field').val();
                countField++;
                $('#count_field').val(countField);
                let elementAddFieldForm = addFormField(countField);

                $('.btn-add-form-field').before(elementAddFieldForm);
                $(`#type_data_field-${countField}`).select2();
            });


            //create-form
            $('button[class="col-6 btn btn-primary btn-block create-form"]').click(function() {
                CL('create-from');
                let countField = $('#count_field').val();
                let data_form = [];
                let count_field_form = 0;
                let form_detail = {
                    'description_table': $(`#description_table`).val(),
                    'menu_table': $(`#menu_table`).val(),
                    'primary_table': $(`#primary_table`).val(),
                    'parent_table': $(`#parent_table`).val()
                }
                for (var i = 0; i < countField; i++) {
                    if ($(`#description_field-${i+1}`).val()) {
                        let data_field = {
                            'description_field': $(`#description_field-${i+1}`).val(),
                            'type_data_field': $(`#type_data_field-${i+1}`).val(),
                            'sort_field': count_field_form,
                            'code_field': toUUID($(`#description_field-${i+1}`).val()),
                        }
                        if ($(`#type_data_field-${i+1}`).val() == 'DARI-TABEL') {
                            data_field.data_source = from_table_form[`data-source-${i+1}`]
                        }
                        data_form.push(data_field);
                        count_field_form++;
                    }
                }
                form_detail.field = data_form
                CL(form_detail)


                // S T O R E
                $.ajax({
                    url: '/api/mbg/manage/app/store',
                    type: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'auth_login': ui_dataset.ui_dataset.user_authentication.auth_login
                        // Add other custom headers if needed
                    },
                    data: JSON.stringify({
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        data: form_detail
                    }),
                    success: function(response) {
                        // CL(response)
                        showModalSuccess();
                        refreshSession();
                        refreshTable();
                    },
                    error: function(response) {
                        conLog('error', response)
                        //alertModal()
                    }
                });
            });


            toggleInput();
            $('input[name="jenis-form"]').change(function() {
                toggleInput();
            });

            $('#basic-form1').on('click', function() {
                conLog('xxx', 'yyy');
            });

            function toggleInput() {
                var selectedValue = $('input[name="jenis-form"]:checked').val();
                $('#name-jenis-form').prop('disabled', selectedValue === 'single');
            }
        });
    </script>
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

        function actionCard(element) {
            var elementId = element.id;

            // Display the ID in the console (you can replace this with your own code)
            console.log('Clicked element ID: ' + elementId);
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

            CL(data_datatable);
            // return false;
            $('#table-datatable').DataTable({
                paging: true,
                serverSide: false,
                data: data_datatable,
                columns: row_data_datatable
            });
        }

        refreshTable();
    </script>
@endsection()
