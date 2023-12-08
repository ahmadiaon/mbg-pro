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

            <h4 class="mb-20 h4 text-blue">Tambah Jenis Form </h4>
            <div id="accordion">



                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-block" data-toggle="collapse" data-target="#faq1">
                            Tambah Form
                        </button>
                    </div>
                    <div id="faq1" class="collapse show" data-parent="#accordion">
                        <div class="pd-10 row">
                            <div class="col-md-7">
                                <div class="card-box pd-10">
                                    <div class="row">
                                        <div class="col-auto" id="head-form-title">
                                            <h4 onclick="editTitle()" id="form-1" class="mb-20 h4 text-blue">Tambah Jenis
                                                Form </h4>
                                            <input type="hidden" class="form-control mb-2" placeholder="Nama Form"
                                                name="form-title" value="" id="form-title">
                                        </div>
                                        <div class="col-auto">
                                            <button onclick="editTitle()" class="btn btn-block   btn-primary">
                                                <i class="icon-copy dw dw-edit2"></i>
                                            </button>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="group-from">Group Form</label>
                                            <select name="group-form" id="group-form"
                                                class="custom-select2 form-control select-group-form" style="width: 100%;">
                                                <option value="">Pilih Group Form</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-body" id="form-1">
                                        <button id="form-button-add" class="btn btn-primary"
                                            onclick="addField()">tambah</button>
                                        <button class="btn btn-success" onclick="saveForm()">Simpan Form</button>
                                    </div>
                                </div>
                            </div>

                          
                        </div>
                    </div>
                </div>

            </div>
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
                    <select name="activity" id="activity" class="custom-select2 form-control select-activity"
                        style="width: 100%;">
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
    <div class="card-box pb-10 mb-20">
        <div class="row pd-20">
            <div class="col-md-6 col-sm-12">
                <div class="title-form">
                    <h4 id="header-table_name" class="mb-20 h4 text-blue">Deskripsi tb_activity</h4>
                </div>
            </div>
        </div>

        <div id="datatable-element">

        </div>
    </div>

    {{-- modal from_table --}}
    <div class="modal fade" id="modal-from_table" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-primary" id="save-from-table" data-dismiss="modal"
                        onclick="saveFromTable()">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script></script>
    <script>
        let countries = ['Umum', 'PORT'];
        // employee_cuti_groups.forEach(item => {
        //     countries.push(item.name_group_cuti);
        // });

        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }
        // autocomplete(document.getElementById("group-form"), countries);

        /*
        {
            'activity_name':'show',
            'group-form':'show',
            'action': {
                'show',
                'edit',
                'delete'
            }
        }
        */

        function getGroupForm() {

        }

        function showGroupForm() {
            //to group-form list
            let group_form_list = data_database['data_datatable_database']['database']['data-table']['GROUP-FORM'];
            cg('group-form-list', group_form_list);
        }

        showGroupForm();

        function refreshDataTable() {
            let form_code_choose = 'tb_activity';

            $(`#header-table_name`).text(data_database['data_datatable_database']['database']['data-table']['tb_activity'][
                form_code_choose
            ]['activity_code']['description']);


            $('#datatable-element').empty();
            // TABLE STRUCTURE DARI TABLE INI ADALAH TB_ACTIVITY
            let table_structure = data_database['data_datatable_database']['database']['data-table']['table_field'][
                'tb_activity'
            ];

            let header_table = '';
            Object.values(table_structure).forEach(element => {
                cg('table_structure', element)
                if (element.value_field == 'from_table') {
                    cg('TABLE SOURCE', data_database[
                                                    'data_datatable_database']['database'][
                                                    'data-table'
                                                ][
                                                    'data_sources'
                                                ] );
                }
                header_table = `${header_table}  <th>${element.description}
                        <a href="#filter">
                            <i class="icon-copy bi bi-filter-square-fill"></i>
                        </a>
                    </th>`;
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
                        table_name: 'tb_activity'
                    }
                },
                success: function(response) {
                    let data = [];
                    let data_for_datatable = response.data;

                    Object.values(table_structure).forEach(element => {
                        var element_date = {
                            mRender: function(data, type, row) {
                                if (row[element.field]) {
                                    let value_return = row[element.field]['value_field'];
                                    switch (element.value_field) {
                                        case 'from_table':
                                            if (data_database[
                                                    'data_datatable_database']['database'][
                                                    'data-table'
                                                ][
                                                    'data_sources'
                                                ][form_code_choose]) {
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
                                                ][row[element.field]['value_field']][
                                                    data_source
                                                    .field_source
                                                ]['value_field'];
                                            }
                                            break;
                                        default:
                                            value_return = row[element.field]['value_field'];
                                            if (row[element.field]['description']) {
                                                value_return = row[element.field][
                                                    'description'
                                                ];
                                            }
                                            break;
                                    }
                                    return value_return;
                                } else {
                                    return '';
                                }
                            }
                        };
                        data.push(element_date);
                    });

                    let element_action = {
                        mRender: function(data, type, row) {
                            // cg('row', row);
                            let btn = `
                                <div class="table-actions" id="${row.activity_code.value_field}">
									<a href="#" data-color="#265ed7">
                                        <i onclick="editForm('${row.activity_code.value_field}')" class="btn btn-sm btn-warning icon-copy dw dw-edit2"></i>
                                    </a>
									<a href="#delete/${row.activity_code.description}" onclick="deleteForm('${row.activity_code.value_field}')" data-color="#e95959"><i class="btn btn-sm btn-danger icon-copy dw dw-delete-3"></i></a>
								</div>`;
                            return btn;
                        }
                    };

                    data.push(element_action)



                    $('#table-datatable-activity').DataTable({
                        paging: true,
                        serverSide: false,
                        responsive: true,
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



        async function getDataDB(data_type, table_name, code_data) {
            let result;
            let _token = $('meta[name="csrf-token"]').attr('content');
            try {
                let x = await $.ajax({
                    url: '/activity/get-data-table',
                    type: "POST",
                    data: {
                        _token: _token,
                        data: {
                            table_name: table_name,
                            code_data: code_data,
                        }
                    },
                    success: function(response) {
                        cg('response', response);
                        result = response.data;
                    },
                    error: function(response) {
                        console.log(response)
                        result = null;
                    }
                });
                return result;
            } catch (error) {
                cg('error', error);
                return 'err';
            }
        }

        async function editForm(id_form) {
            $('.field-form').remove();
            form_number = 0;
            let data_structure_form = await getDataDB('data', 'table_field', id_form);
            data_structure_form = data_structure_form[0];
            cg('editform', data_structure_form);
            let data_tb_activity = await getDataDB('data', 'tb_activity', id_form);
            data_tb_activity = data_tb_activity[0];

            //data source manage

            $('#form-1').text(`${data_tb_activity.activity_code.description}`);
            $('#form-title').val(`${data_tb_activity.activity_code.description}`);
            $('#group-form').val(`${data_tb_activity['GROUP-FORM']['value_field']}`).trigger('change');
            Object.values(data_structure_form).forEach(element => {
                addField();
                $(`#source_field-${form_number-1}`).attr('onchange', '');
                $(`#source_field-${form_number-1}`).val(element.value_field).trigger('change');
                $(`#source_field-${form_number-1}`).attr('onchange', `selectSource(${form_number-1})`);
                $(`#field_description-${form_number-1}`).val(element.description);
                if (element.value_field == 'from_table') {
                    cg('xx', id_form + '-' + element.field);
                    if (data_database['data_datatable_database']['database']['data-table']['data_sources'][
                            id_form + '-' + element.field
                        ]) {
                        let data_data_source = data_database['data_datatable_database']['database'][
                            'data-table'
                        ]['data_sources'][id_form + '-' + element.field];
                        from_table_data[form_number - 1] = {
                            table_name: data_data_source.table_name,
                            field_source: data_data_source.field_source,
                            field_get: data_data_source.field_get
                        };
                    } else {
                        from_table_data[form_number - 1] = 'empty';
                    }
                }
            });
        }



        refreshDataTable();


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

        function openNewActivity() {
            cg('modal new activity', 'modal new activity');
            $(`#modal-new-activity`).modal('show');
        }

        function addField() {
            cg('form_number', form_number);
            $(`#form-button-add`).before(`
            <div class="row field-form" id="field-form-${form_number}">
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

        function saveFromTable(id_form) {
            let table_name = $('#table').val();
            let field_source = $('#field_source').val();
            let field_get = $('#field_get').val();
            from_table_data[id_form] = {
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
                    $('#save-from-table').attr('onclick', `saveFromTable(${id_form})`)
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

        function saveForm() {

            if (isRequiredCreate(['form-title', 'group-from']) > 0) {
                return false;
            }
            setFormName();

            let field_required = [];

            db_insert = form_field.field = [];
            let db_field = [];

            db_insert = [{
                    table_name: 'tb_activity',
                    field: 'activity_code',
                    value_field: toUUID(form_field.form_code),
                    code_data: form_field.form_code,
                    sub_code_data: null,
                    description: form_field.form_name,
                    type_data: 'tb_activity'
                },
                {
                    table_name: 'tb_activity',
                    field: 'GROUP-FORM',
                    value_field: $('#group-form').val(),
                    code_data: form_field.form_code,
                    sub_code_data: null,
                    description: null,
                    type_data: 'tb_activity'
                },
            ];

            if (variable_support_for_post_create_form.form_number.length > 0) {
                $.each(variable_support_for_post_create_form.form_number, function(index, index_element) {
                    field_description = $(`#field_description-${index_element}`).val();
                    source_field = $(`#source_field-${index_element}`).val();
                    if (field_description && source_field) {
                        if (source_field == 'from_table') {
                            source_field = {};
                            source_field.from_table = from_table_data[index_element];
                        }
                        let data_field = [{
                            table_name: 'table_field',
                            description: field_description,
                            field: toUUID(field_description),
                            value_field: source_field,
                            code_data: form_field.form_code,
                            sub_code_data: index + 1,
                            type_data: source_field
                        }];
                        db_insert = $.merge(db_insert, data_field);
                    }
                });
                form_field.field = db_insert;

                cg('form_field', form_field);
                // return false;
                let _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/activity/store-form',
                    type: "POST",
                    data: {
                        form_field: JSON.stringify(form_field),
                        _token: _token
                    },
                    success: function(response) {
                        cg('response', response)
                    },
                    error: function(response) {
                        console.log(response)
                    }
                });

            }

            let el_form = '';
            $(`#form-title-done`).text(form_field.form_name);
            $(`#form-done`).empty();
            form_field['field'].forEach(element => {
                if (element.table_name == 'field_form') {
                    el_form = `
                         ${el_form}    
                        <div class="col-md-12 col-sm-12 form-group">
                            <label for="">${element.value_field}</label>
                            <input type="${element.type_data}" class="form-control" name="" id="">
                        </div>                                       
                    `;
                }
            });
            $(`#form-done`).append(el_form);

            cg('from_table_data', from_table_data)
            cg('form_field', form_field)
        }

        function editTitle() {
            let val = $(`#head-form-title`).text();
            val = val.replace(/^\s+|\s+$|\s+(?=\s)/g, "");
            $(`#head-form-title`).empty();
            $(`#head-form-title`).append(
                ` <input autofocus type="text" class="form-control mb-2" placeholder="Nama Form"  onkeypress="return enterKeyPressed(event)" name="form-title" value="${val}" id="form-title">`
            );
            $('#form-title').trigger("focus");
        }

        function setFormName() {
            $(`#form-title`).attr('type', 'hidden');
            $(`#form-title`).val();
            $(`#form-title-h4`).remove();
            $(`#head-form-title`).append(`
                    <h4 onclick="editTitle()" id="form-title-h4" class="mb-20 h4 text-blue">${$(`#form-title`).val()} </h4>
                `);
            form_field.form_name;
            form_field.form_name = $(`#form-title`).val();
            form_field.form_code = toUUID($(`#form-title`).val());
        }

        function enterKeyPressed(event) {
            if (event.keyCode == 13) {
                setFormName();
                return true;
            }
        }

        function selectTableSource() {
            let table_source = $(`#table`).val();
            table_field_source = data_database['data_datatable_database']['database']['data-schema'][table_source];
            $('#field_source').empty();
            $('#field_get').empty();
            $('#field_source').append(`
                        <option value="">Pilih Kolom</option>
                    `);
                    $('#field_get').append(`
                        <option value="">Pilih Kolom</option>
                    `);
            if (data_database['data_datatable_database']['database']['data-table']['table_field'][table_source]) {
                let fields = data_database['data_datatable_database']['database']['data-table']['table_field'][
                    table_source
                ];
                // cg('fields', fields)
                Object.values(fields).forEach(element => {
                    $('#field_source').append(`
                        <option value="${element.field}">${element.description}</option>
                    `);
                    $('#field_get').append(`
                        <option value="${element.field}">${element.description}</option>
                    `);
                });
            } else {
                table_field_source.forEach(element => {
                    $('#field_source').append(`
                        <option value="${element}">${element}</option>
                    `);
                    $('#field_get').append(`
                        <option value="${element}">${element}</option>
                    `);
                });
            }
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
                    $('.select-group-form').append(
                        `<option value="${form_desc.code_data}">${form_desc.value_field}</option>`);
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


            cg('tb_activity', data_database['data_datatable_database']['database']['data-table']['tb_activity']);


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

            $(`#form-choose-place`).empty();
            $(`#header-table_name`).text(data_database['data_datatable_database']['database']['data-table']['tb_activity'][
                form_code_choose
            ]['activity_code']['description']);

            let el_form = '';
            let item_field_form = data_database['data_datatable_database']['database']['data-table']['table_field'][
                form_code_choose
            ];

            Object.values(item_field_form).forEach(element_field_form => {
                switch (element_field_form.value_field) {
                    case 'from_table':
                        let data_source = data_database['data_datatable_database']['database']['data-table'][
                            'data_sources'
                        ][element_field_form.code_data + '-' + element_field_form.field];
                        let data_table_source = data_database['data_datatable_database']['database']['data-table'][
                            data_source.table_name
                        ];
                        let option_data_table_source = '';
                        Object.values(data_table_source).forEach(item_table_source => {
                            option_data_table_source =
                                `${option_data_table_source} 
                                        <option value="${item_table_source[data_source.field_source]}">${item_table_source[data_source.field_get]}</option>`;
                        });
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
            return false;
        }

        let tabless = {
            'FORM-STATUS-UNIT-LV': {
                code_data: 'text',
                tanggal: 'date',
                jam: 'time',
                driver: {
                    table: {
                        table_name: 'employees',
                        table_field_source: 'nik_employees',
                        table_field_get: 'full_name',
                    }
                },
                unit: {
                    table: {
                        table_name: 'units',
                        table_field_source: 'number',
                        table_field_get: 'full_number',
                    }
                }
            }
        }

        let data_table = {
            'FORM-STATUS-UNIT-LV': {
                'Loading-tongkang-8-mei-2023': {
                    code_data: 'Loading-tongkang-8-mei-2023',
                    tanggal: '2023-05-08',
                    jam: '08:08',
                    driver: {
                        table_name: 'employees',
                        table_field_source: 'MBLE-0422003',
                        table_field_get: 'Ahmadi | ETL Dev|MBLE|PL|MBLE-0422003'
                    },
                    unit: 'LV-100'
                }
            }
        }
        cg('tt', tabless)

        function storeData() {
            globalStoreNoTable('activity-data').then((data_value_element) => {
                cg('data_value_element', data_value_element);
            });
        }
    </script>
@endsection
