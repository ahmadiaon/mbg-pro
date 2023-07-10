@extends('template.admin.main_privilege')

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
                                            <h4 id="form-1" class="mb-20 h4 text-blue">Tambah Jenis Form </h4>
                                            <input type="hidden" class="form-control mb-2" placeholder="Nama Form"
                                                name="form-title" value="" id="form-title">
                                        </div>
                                        <div class="col-auto">
                                            <button onclick="editTitle('1')" class="btn btn-block btn-sm  btn-primary">
                                                <i class="icon-copy dw dw-edit2"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body" id="form-1">
                                        <button id="form-button-add" class="btn btn-primary"
                                            onclick="addField()">tambah</button>
                                        <button class="btn btn-success" onclick="saveForm()">Simpan Form</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="card-box pd-10">
                                    <div class="card-header form-control">
                                        <h4 class="mb-20 h4 text-blue" id="form-title-done">Tambah Jenis Form </h4>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="row" id="form-done">

                                            </div>
                                        </form>

                                        <button type="button" class="btn btn-success">simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card-box pb-10 mb-20">
        <div class="h5 pd-20 mb-0">Table-table</div>
        <table id="table-form" class="table nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Kode Form</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Kode Form</th>
                    <th>Name</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="row  pd-20">
        <div class="col-md-6 pd-20 card-box pb-10 mb-20">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h4 id="title-form" class="mb-20 h4 text-blue">Form Kegiatan</h4>
                    </div>
                </div>
                <div class="col-md-12" id="form-choose-place">

                </div>
            </div>
        </div>
    </div>




    <div class="card-box pb-10">
        <div class="row pd-20">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>DataTable</h4>
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
        <table id="xxx" class="data-table table nowrap">
            <thead>
                <tr>
                    <th class="table-plus">Name</th>
                    <th>Gender</th>
                    <th>Weight</th>
                    <th>Assigned Doctor</th>
                    <th>Admit Date</th>
                    <th>Disease</th>
                    <th class="datatable-nosort">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="table-plus">
                        <div class="name-avatar d-flex align-items-center">
                            <div class="avatar mr-2 flex-shrink-0">
                                <img src="vendors/images/photo4.jpg" class="border-radius-100 shadow" width="40"
                                    height="40" alt="" />
                            </div>
                            <div class="txt">
                                <div class="weight-600">Jennifer O. Oster</div>
                            </div>
                        </div>
                    </td>
                    <td>Female</td>
                    <td>45 kg</td>
                    <td>Dr. Callie Reed</td>
                    <td>19 Oct 2020</td>
                    <td>
                        <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7">Typhoid</span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                            <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="table-plus">
                        <div class="name-avatar d-flex align-items-center">
                            <div class="avatar mr-2 flex-shrink-0">
                                <img src="vendors/images/photo5.jpg" class="border-radius-100 shadow" width="40"
                                    height="40" alt="" />
                            </div>
                            <div class="txt">
                                <div class="weight-600">Doris L. Larson</div>
                            </div>
                        </div>
                    </td>
                    <td>Male</td>
                    <td>76 kg</td>
                    <td>Dr. Ren Delan</td>
                    <td>22 Jul 2020</td>
                    <td>
                        <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7">Dengue</span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                            <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="table-plus">
                        <div class="name-avatar d-flex align-items-center">
                            <div class="avatar mr-2 flex-shrink-0">
                                <img src="vendors/images/photo6.jpg" class="border-radius-100 shadow" width="40"
                                    height="40" alt="" />
                            </div>
                            <div class="txt">
                                <div class="weight-600">Joseph Powell</div>
                            </div>
                        </div>
                    </td>
                    <td>Male</td>
                    <td>90 kg</td>
                    <td>Dr. Allen Hannagan</td>
                    <td>15 Nov 2020</td>
                    <td>
                        <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7">Infection</span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                            <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="table-plus">
                        <div class="name-avatar d-flex align-items-center">
                            <div class="avatar mr-2 flex-shrink-0">
                                <img src="vendors/images/photo9.jpg" class="border-radius-100 shadow" width="40"
                                    height="40" alt="" />
                            </div>
                            <div class="txt">
                                <div class="weight-600">Jake Springer</div>
                            </div>
                        </div>
                    </td>
                    <td>Female</td>
                    <td>45 kg</td>
                    <td>Dr. Garrett Kincy</td>
                    <td>08 Oct 2020</td>
                    <td>
                        <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7">Covid
                            19</span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                            <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="table-plus">
                        <div class="name-avatar d-flex align-items-center">
                            <div class="avatar mr-2 flex-shrink-0">
                                <img src="vendors/images/photo1.jpg" class="border-radius-100 shadow" width="40"
                                    height="40" alt="" />
                            </div>
                            <div class="txt">
                                <div class="weight-600">Paul Buckland</div>
                            </div>
                        </div>
                    </td>
                    <td>Male</td>
                    <td>76 kg</td>
                    <td>Dr. Maxwell Soltes</td>
                    <td>12 Dec 2020</td>
                    <td>
                        <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7">Asthma</span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                            <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="table-plus">
                        <div class="name-avatar d-flex align-items-center">
                            <div class="avatar mr-2 flex-shrink-0">
                                <img src="vendors/images/photo2.jpg" class="border-radius-100 shadow" width="40"
                                    height="40" alt="" />
                            </div>
                            <div class="txt">
                                <div class="weight-600">Neil Arnold</div>
                            </div>
                        </div>
                    </td>
                    <td>Male</td>
                    <td>60 kg</td>
                    <td>Dr. Sebastian Tandon</td>
                    <td>30 Oct 2020</td>
                    <td>
                        <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7">Diabetes</span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                            <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="table-plus">
                        <div class="name-avatar d-flex align-items-center">
                            <div class="avatar mr-2 flex-shrink-0">
                                <img src="vendors/images/photo8.jpg" class="border-radius-100 shadow" width="40"
                                    height="40" alt="" />
                            </div>
                            <div class="txt">
                                <div class="weight-600">Christian Dyer</div>
                            </div>
                        </div>
                    </td>
                    <td>Male</td>
                    <td>80 kg</td>
                    <td>Dr. Sebastian Tandon</td>
                    <td>15 Jun 2020</td>
                    <td>
                        <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7">Diabetes</span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                            <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="table-plus">
                        <div class="name-avatar d-flex align-items-center">
                            <div class="avatar mr-2 flex-shrink-0">
                                <img src="vendors/images/photo1.jpg" class="border-radius-100 shadow" width="40"
                                    height="40" alt="" />
                            </div>
                            <div class="txt">
                                <div class="weight-600">Doris L. Larson</div>
                            </div>
                        </div>
                    </td>
                    <td>Male</td>
                    <td>76 kg</td>
                    <td>Dr. Ren Delan</td>
                    <td>22 Jul 2020</td>
                    <td>
                        <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7">Dengue</span>
                    </td>
                    <td>

                        <div class="table-actions">
                            <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                            <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- modal new activity --}}
    <div class="modal fade" id="modal-new-activity" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
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
                    <select name="table" id="table" onchange="selectTableSource()" class="custom-select2 form-control select-table"
                        style="width: 100%;">
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
                    <button type="button" class="btn btn-primary" onclick="saveFromTable()">
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

        function saveFromTable(){
            let table_name = $('#table').val();
            let field_source = $('#field_source').val();
            let field_get = $('#field_get').val();
            cg('form_number on save from table', form_number);
            from_table_data[form_number-1] = {
                table_name:table_name,
                field_source:field_source,
                field_get:field_get
            };


            cg('from_table_data',from_table_data);
        }

        function selectSource(id_form) {
            let val_option_source_field = $(`#source_field-${id_form}`).val();
            switch (val_option_source_field) {
                case 'from_table':
                    cg('from_table','from_table');
                    $('#modal-from_table').modal('show');
                    return false;
                    // code block
                    break;
                case 'y':
                    cg('y','y');
                    return false;
                    // code block
                    break;
                default:
                cg('default','default');
                    return false;
                    // code block
            }
            cg('val_option_source_field', val_option_source_field);
        }

        function deleteField(id_form) {
            cg('delelete', id_form);
            variable_support_for_post_create_form['form_number'][id_form - 1] = null;
            cg('variable_support_for_post_create_form', variable_support_for_post_create_form);
            $(`#field-form-${id_form}`).remove();
        }

        function saveForm() {
            if (isRequiredCreate(['form-title']) > 0) {
                return false;
            }
            let field_required = [];
            cg('form_field before', form_field);

            db_insert = form_field.field = [];
            let db_field = [];


            db_insert = [{
                    table_name: 'tb_activity',
                    field: 'activity_code',
                    value_field: form_field.form_code,
                    code_data: form_field.form_code,
                    sub_code_data: null,
                    type_data: 'tb_activity'
                },
                {
                    table_name: 'tb_activity',
                    field: 'activity_name',
                    value_field: form_field.form_name,
                    code_data: form_field.form_code,
                    sub_code_data: null,
                    type_data: 'tb_activity'
                },
            ];

            if (variable_support_for_post_create_form.form_number.length > 0) {
                $.each(variable_support_for_post_create_form.form_number, function(index, index_element) {
                    if (index_element) {
                        field_description = $(`#field_description-${index_element}`).val();
                        source_field = $(`#source_field-${index_element}`).val();
                        if (field_description && source_field) {                           
                            if(source_field == 'from_table'){
                                source_field= {};
                                source_field.from_table = from_table_data[index_element];
                            }
                            let data_field = [{
                                table_name: 'table_field',
                                field: field_description,
                                value_field: source_field,
                                code_data: form_field.form_code,
                                sub_code_data: index,
                                type_data: source_field
                            }];
                            db_insert = $.merge(db_insert, data_field);
                        }
                    }
                });
                form_field.field = db_insert;

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

            cg('from_table_data',from_table_data)
            cg('form_field', form_field)
        }

        function editTitle(form_id) {
            form_number = form_id;
            let val = $(`#head-form-title`).text();
            val = val.replace(/^\s+|\s+$|\s+(?=\s)/g, "");
            cg('val', val);
            $(`#head-form-title`).empty();
            $(`#head-form-title`).append(
                ` <input autofocus type="text" class="form-control mb-2" placeholder="Nama Form" onkeypress="return enterKeyPressed(event)" name="form-title" value="${val}" id="form-title">`
            );
            $('#form-title').trigger("focus");
        }

        function enterKeyPressed(event) {
            if (event.keyCode == 13) {
                $(`#form-title`).attr('type', 'hidden');
                $(`#form-title`).val();
                $(`#head-form-title`).append(`
                    <h4 id="form-title" class="mb-20 h4 text-blue">${$(`#form-title`).val()} </h4>
                `);
                form_field.form_name;
                form_field.form_name = $(`#form-title`).val();
                form_field.form_code = toUUID($(`#form-title`).val());
                return true;
            }
        }

        function selectTableSource(){
            let table_source = $(`#table`).val();
            table_field_source = table_field[table_source];
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
            Object.keys(table_field).forEach(table_names => {
                cg('table_names',table_names);
                $('.select-table').append(`<option value="${table_names}">${table_names}</option>`);
            });

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


                    let count_much_use = 0;
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
            cg('form_code_choose', all_table);

            $(`#form-choose-place`).empty();
            $(`#title-form`).text(all_table['tb_activity'][form_code_choose]['activity_name']);

            let el_form = '';
            let item_field_form = all_table['table_field'][form_code_choose];
            cg('item_field_form', item_field_form)
            Object.keys(item_field_form).forEach(element => {
                el_form = `
                         ${el_form}    
                        <div class="col-md-12 col-sm-12 form-group">
                            <label for="">${element}</label>
                            <input type="${item_field_form[element]}" class="form-control" name="" id="">
                        </div>                                       
                    `;
            });

            $(`#form-choose-place`).append(el_form);
            $(`#form-choose-place`).append(`
                <div class="col-md-12 col-sm-12 form-group text-right">
                    <button onclick="storeActivity()" type="button" class="btn btn-primary text-right">
                        Save
                    </button>
                </div>   
            `);
            $(`#form-choose-place`).append(`
                <div class="col-md-12 col-sm-12 form-group text-right">
                    <input type="text" class="form-control" name="code_data" id="" value="${all_table['tb_activity'][form_code_choose]['activity_code']}">
                </div>   
            `);

            $('#modal-new-activity').modal('hide');


            // 'FORM-STATUS-UNIT-LV': [
            //     code_data: {
            //         tanggal: '28-08-2000',
            //         jam: '08:00'
            //     },
            //     code_data: {
            //         tanggal: '28-08-2000',
            //         jam: '08:00'
            //     }
            // ]
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
                        table_name:'employees',
                        table_field_source:'MBLE-0422003',
                        table_field_get:'Ahmadi | ETL Dev|MBLE|PL|MBLE-0422003'
                    },
                    unit: 'LV-100'
                }
            }
        }
        cg('tt', tabless)
    </script>
@endsection
