@extends('template.admin.main_simple')
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
    <div class="mb-20">
        <div class="faq-wrap">
            <div id="accordion">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-block" data-toggle="collapse" id="btn-group-form" data-target="#faq1">
                            PILIH FORM
                        </button>
                    </div>
                    <div id="faq1" class="collapse show" data-parent="#accordion">
                        <div class="pd-10 row">
                            <div class="col-md-5 mb-5">
                                <div class="card-box pd-10">
                                    <h4  id="form-1" class="mb-20 h4 text-blue">Group Form </h4>
                                    <div class="row">
                                        <div class="col-9" id="head-form-title">
                                            <select onchange="fromTable('GROUP-FORM', 'table')" name="GROUP-FORM"
                                                id="GROUP-FORM" class="custom-select2 form-control GROUP-FORM"
                                                style="width: 100%;">
                                                <option value="">Pilih Group Form</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="card-box pd-10">
                                    <div class="card-header form-control">
                                        <h4 class="mb-20 h4 text-blue" id="form-title-done">Pilih Form</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-warning" id="forms-group-form">

                                        </div>
                                        <select name="select-forms-group-form" id="select-forms-group-form"
                                            class="custom-select2 form-control" style="width: 100%;">
                                            <option value="">Pilih Kegiatan</option>
                                        </select>

                                        <button type="button" class="btn btn-success mt-5">simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row  pd-20">
        <div class="col-md-6 pd-20 card-box pb-10 mb-20">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h4 id="title-form" class="mb-20 h4 text-blue">Form Kegiatan</h4>
                    </div>
                </div>
                <form action="/activity/store-data" method="POST" id="form-activity-data" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 row" id="form-choose-place">

                    </div>
                </form>
            </div>
        </div>
    </div>




    <div class="card-box pb-10 mb-20">
        <div class="row pd-20">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4 id="header-table_name" class="mb-20 h4 text-blue">Deskripsi tb_activity</h4>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="dropdown">
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        Menu
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" onclick="openNewActivity()" href="#">Tambah Kegiatan</a>
                        <a class="dropdown-item" href="#">xxx</a>
                        <a class="dropdown-item" href="#">yyyy</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="datatable-element">

        </div>
    </div>

    {{-- modal new activity --}}
    <div class="modal fade" id="modal-new-activity" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Pilih Jenis Kegiatan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" id="much-use-form">

                    </div>
                    <select onchange="selectFrom('')" name="activity" id="activity"
                        class="custom-select2 form-control select-activity" style="width: 100%;">
                        <option value="">Pilih Kegiatan</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary">
                        Laporkan Kegiatan
                    </button>
                </div>
            </div>
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
                        class="custom-select2 form-control select-table" style="width: 100%;">
                        <option value="">Pilih tabel</option>
                    </select>
                </div>
                <div class="modal-body">
                    <label for="field_source">Kolom Rujukan</label>
                    <select name="field_source" id="field_source" class="custom-select2 form-control select-field_source"
                        style="width: 100%;">
                        <option value="">Pilih kolom</option>
                    </select>
                </div>
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="saveFromTable()">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let table_field = @json(session('table_field'));
        let variable_support_for_post_create_form = {
            form_number: []
        };
        let all_table;
        let all_table_description = {};
        let data_insert_form_table;
        let form_field = {};
        let from_table_data = {};
        let form_number = 0;
        let db_insert = [];
        let optionSourceField = '';

        Object.values(data_database.data_atribut_sizes.source_field).forEach(element => {
            optionSourceField =
                `${optionSourceField} <option value="${element.uuid}">${element.name_atribut}</option>`;
        });

        function showForm(arrData) {
            $('#forms-group-form').empty();
            $('#select-forms-group-form').empty();
            arrData.forEach(element => {
                let table_name = data_database['data_datatable_database']['database']['data-table']['tb_activity'][
                    element
                ]['activity_code'];
                let collor_rand = random_item(COLOR_BOOTSTRAP);
                $(`#forms-group-form`).append(
                    `<span onclick="chooseForm('${table_name['code_data']}')" class="btn badge badge-${collor_rand} mb-1 mr-2">${table_name['description']}</span>`
                );
                $('#select-forms-group-form').append(
                    `<option value="${table_name['code_data']}">${table_name['description']}</option>`
                );
                // cg('element',table_name);
            });
        }

        function selectFrom() {

            cg('ac', $('#activity').val());
        }

        function fromTable(name_group, type_data) {
            let data_value = $(`#${name_group}`).val();
            let data_select = data_database['data_datatable_database']['database']['data-search'][name_group][data_value];
            cg(data_value, data_select);
            if (data_select) {
                showForm(data_select);
            }
        }

        function openNewActivity() {
            cg('modal new activity', 'modal new activity');
            $(`#modal-new-activity`).modal('show');
        }

        function addField() {
            cg('form_number', form_number);
            $(`#form-button-add`).before(`
            <div class="row" id="field-form-${form_number}">
                <div class="col-md-5 form-group">
                    <input type="text" class="form-control" name="field_description-${form_number}" id="field_description-${form_number}" placeholder="nama field">
                </div>
                <div class="col-md-5 form-group">
                    <select name="source_field-${form_number}" 
                        id="source_field-${form_number}"
                        onchange="selectSource(${form_number})"
                        class="s2 form-control">
                        <option value="">pilih jenis inputan</option>
                        ${optionSourceField}
                    </select>
                </div>
                <div class="col-md-2 form-group">
                    <button onclick="deleteField(${form_number})" class="btn btn-danger">
                        <i class="icon-copy dw dw-delete-3"></i>
                    </button>
                </div>
            </div>
            `);

            $(`#source_field-${form_number}`).select2();


            variable_support_for_post_create_form.form_number.push(form_number);
            form_number++;
        }

        function saveFromTable() {
            let table_name = $('#table').val();
            let field_source = $('#field_source').val();
            let field_get = $('#field_get').val();
            cg('form_number on save from table', form_number);
            from_table_data[form_number - 1] = {
                table_name: table_name,
                field_source: field_source,
                field_get: field_get
            };
            cg('from_table_data', from_table_data);
        }

        function selectSource(id_form) {
            let val_option_source_field = $(`#source_field-${id_form}`).val();
            switch (val_option_source_field) {
                case 'from_table':
                    cg('from_table', 'from_table');
                    $('#modal-from_table').modal('show');
                    return false;
                    // code block
                    break;
                case 'y':
                    cg('y', 'y');
                    return false;
                    // code block
                    break;
                default:
                    cg('default', 'default');
                    return false;
                    // code block
            }
            cg('val_option_source_field', val_option_source_field);
        }

        function deleteField(id_form) {
            cg('delelete', id_form);
            variable_support_for_post_create_form['form_number'][id_form] = null;
            cg('variable_support_for_post_create_form', variable_support_for_post_create_form);
            $(`#field-form-${id_form}`).remove();
        }

        

       

        function selectTableSource() {
            let table_source = $(`#table`).val();
            table_field_source = data_database['data_datatable_database']['database']['data-schema'][table_source];
            $('#field_source').empty();
            $('#field_get').empty();
            table_field_source.forEach(element => {
                $('#field_source').append(`
                     <option value="${element}">${element}</option>
                `);
                $('#field_get').append(`
                     <option value="${element}">${element}</option>
                `);
            });
            cg('table_field_source', table_field_source);
        }

        function allTable() {
            $('.select-table').empty();
            $('.select-table').append('<option value="">Pilih tabel</option>');
            Object.keys(data_database['data_datatable_database']['database']['data-schema']).forEach(table_names => {
                $('.select-table').append(`<option value="${table_names}">${table_names}</option>`);
            });

            Object.values(data_database['data_datatable_database']['database']['data-table']['GROUP-FORM']).forEach(
                table_names => {
                    let form_desc = table_names['NAME-GROUP-FORM'];
                    $('.GROUP-FORM').append(`<option value="${form_desc.code_data}">${form_desc.value_field}</option>`);
                });

            let count_much_use = 0;
            $('#activity').append('<option value="">Pilih tabel</option>');
            Object.values(data_database['data_datatable_database']['database']['data-table']['tb_activity']).forEach(
                table_description => {
                    if (count_much_use < 10) {
                        let collor_rand = random_item(COLOR_BOOTSTRAP);
                        $(`#much-use-form`).append(
                            `<span onclick="chooseForm('${table_description['activity_code']['code_data']}')" class="btn badge badge-${collor_rand} mb-1 mr-2">${table_description['activity_code']['description']}</span>`
                        );
                        count_much_use++;
                    }
                    $('#activity').append(
                        `<option value="${table_description['activity_code']['code_data']}">${table_description['activity_code']['description']}</option>`
                    );
                });
            return false;

            // cg('table_field', table_field);
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/activity/all-table',
                type: "POST",
                data: {
                    _token: _token
                },
                success: function(response) {
                    cg('response', response);

                    let data_datatable = response.data.tb_activity;
                    all_table = response.data;

                    cg('data_datatable', data_datatable);

                    return false;

                    let to_data_datatable = Object.values(data_datatable);
                    $('#table-form').DataTable({
                        data: to_data_datatable,
                        columns: [{
                                data: 'activity_code',
                            },
                            {
                                data: 'activity_name',
                            }
                        ],
                    });


                    count_much_use = 0;
                    Object.values(data_datatable).forEach(data_table => {
                        if (count_much_use < 10) {
                            let collor_rand = random_item(COLOR_BOOTSTRAP);
                            $(`#much-use-form`).append(
                                `<span onclick="chooseForm('${data_table.activity_code}')" class="btn badge badge-${collor_rand} mb-1 mr-2">${data_table.activity_name}</span>`
                            );
                            count_much_use++;
                        }

                        $('#activity').append(
                            ` <option value="${data_table.activity_code}">${data_table.activity_name}</option>`
                        );
                    });
                    return false;


                },
                error: function(response) {
                    console.log(response)
                }
            });
        }

        allTable();


        function chooseForm(form_code_choose) {
            cg('choose form','choedrfo');
            $(`#form-choose-place`).empty();
            $(`#title-form`).text(data_database['data_datatable_database']['database']['data-table']['tb_activity'][
                form_code_choose
            ]['activity_code']['description']);

            let el_form = '';
            let item_field_form = data_database['data_datatable_database']['database']['data-table']['table_field'][
                form_code_choose
            ];
            $('#btn-group-form').click();

            Object.values(item_field_form).forEach(element_field_form => {
                switch (element_field_form.value_field) {
                    case 'from_table':
                        let data_source = data_database['data_datatable_database']['database']['data-table'][
                            'data_sources'
                        ][element_field_form.code_data][element_field_form.field];


                        let data_table_source = data_database['data_datatable_database']['database']['data-table'][
                            data_source.table_name
                        ];
                        // cg('data_source', data_source);
                        // cg(data_source.table_name, data_table_source);
                        // return false;
                        
                        let option_data_table_source = '';
                        Object.values(data_table_source).forEach(item_table_source => {
                            option_data_table_source =
                                `${option_data_table_source} 
                                        <option value="${item_table_source[data_source.field_source]['code_data']}">${item_table_source[data_source.field_get]['value_field']}</option>`;
                        });
                        cg('field get', data_source.field_get);
                        el_form = `                                
                                <div class="col-md-12 col-sm-12 form-group">
                                    <label for="">${element_field_form.description}</label> 
                                    <select name="${element_field_form.field}" id="${element_field_form.field}" class="custom-select2 form-control"
                                        style="width: 100%;">
                                        <option value="">Pilih data</option>
                                        <option value="">Tambah Data</option>
                                        ${option_data_table_source}
                                    </select>  
                                </div>                                       
                            `;
                        $(`#form-choose-place`).append(el_form);
                        $(`#${element_field_form.field}`).select2();
                        break;
                    case '':
                        // code block
                        break;
                    default:
                        el_form = `                           
                            <div class="col-md-12 col-sm-12 form-group">
                                <label for="">${element_field_form.description}</label>
                                <input type="${element_field_form.value_field}" class="form-control" name="${element_field_form.field}" id="${element_field_form.field}">
                            </div>                                       
                        `;
                        $(`#form-choose-place`).append(el_form);
                }
            });


            $(`#form-choose-place`).append(`
                <div class="col-md-12 col-sm-12 form-group text-right">
                    <button onclick="storeData()" type="button" class="btn btn-primary text-right">
                        Save Data
                    </button>
                </div>   
            `);
            $(`#form-choose-place`).append(`
                <div class="col-md-12 col-sm-12 form-group text-right">
                    <input type="text" class="form-control" name="table_name" id="" value="${data_database['data_datatable_database']['database']['data-table']['tb_activity'][
                form_code_choose
            ]['activity_code']['code_data']}">
                </div>   
            `);

            $('#modal-new-activity').modal('hide');

            let table_structure = data_database['data_datatable_database']['database']['data-table']['table_field'][
                form_code_choose
            ];
            let data_tb_activity = data_database['data_datatable_database']['database']['data-table']['tb_activity'][
                form_code_choose
            ];
            $('#header-table_name').text(`Data ${data_tb_activity['activity_code']['description']}`);

            $('#datatable-element').empty();

            $('#header-table-datatable').empty();
            let header_table = '';
            Object.values(table_structure).forEach(element => {
                cg('table_structure', element)
                header_table = `${header_table}  <th>${element.description}</th>`;
            });
            header_table = `${header_table}  <th>ACTION</th>`;
            let element_table = `
            <table id="table-datatable-activity" class="display table nowrap" style="width:100%">
                <thead>
                    <tr id="header-table-datatable">
                       ${header_table}
                    </tr>
                </thead>
            </table>`;
            $('#datatable-element').append(element_table);


            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/activity/get-data-table',
                type: "POST",
                data: {
                    _token: _token,
                    data: {
                        table_name: form_code_choose
                    }
                },
                success: function(response) {
                    let data = [];
                    let data_for_datatable = response.data;
                    let variable_code_data = '';

                    Object.values(table_structure).forEach(element => {
                        var element_date = {
                            mRender: function(data, type, row) {
                                // cg('1', row)
                                let value_return =  row[element.field]['value_field'];
                                variable_code_data = element.field;
                                cg('variable_code_data', variable_code_data);
                                switch (element.value_field) {
                                    case 'from_table':                                        
                                        let data_source = data_database[
                                            'data_datatable_database']['database'][
                                            'data-table'
                                        ][
                                            'data_sources'
                                        ][form_code_choose][element.field];

                                        value_return = data_database[
                                            'data_datatable_database']['database'][
                                            'data-table'
                                        ][
                                            data_source.table_name
                                        ][row[element.field]['value_field']][data_source
                                            .field_get
                                        ]['value_field'];
                                        break;
                                    default:
                                        value_return =  row[element.field]['value_field'];
                                        break;
                                }
                                return value_return;
                            }
                        };
                        data.push(element_date);
                    });

                    let element_action = {
                        mRender: function(data, type, row) {
                            cg('row', row);
                            let btn = `
                                <div class="table-actions" id="${row[variable_code_data]['code_data']}">
									<a href="#" data-color="#265ed7">
                                        <i onclick="editForm('${row[variable_code_data]['code_data']}')" class="btn btn-sm btn-warning icon-copy dw dw-edit2"></i>
                                    </a>
									<a href="#delete" onclick="deleteForm('${row[variable_code_data]['code_data']}')" data-color="#e95959"><i class="btn btn-sm btn-danger icon-copy dw dw-delete-3"></i></a>
								</div>`;
                            return btn;
                        }
                    };

                    data.push(element_action)



                    $('#table-datatable-activity').DataTable({
                        paging: true,
                        serverSide: false,
                        responsive:true,
                        data: data_for_datatable,
                        columns: data
                    });
                    // new DataTable('#table-datatable-activity');

                },
                error: function(response) {
                    console.log(response)
                }
            });

            return false;
        }

        function storeData() {
            globalStoreNoTable('activity-data').then((data_value_element) => {
                cg('data_value_element', data_value_element);
            });
        }
    </script>
@endsection
