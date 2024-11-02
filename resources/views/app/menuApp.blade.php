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
            <div class="fields row profile-info" id="field-form-1">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Nama Field</label>
                        <input type="text" class="form-control description_field" id="description_field-1">
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 mb-2">
                    <div class="form-group">
                        <label>Type Data Field</label>
                        <select style="width: 100%;" onchange="selectSource(1)" name="type_data_field-1"
                            id="type_data_field-1" class="custom-select2 form-control type-data">
                            <option value="">Tipe Data Field</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2 col-sm-12 mb-2">
                    <div class="form-group">
                        <label>Level</label>
                        <select name="level_data_field-1" id="level_data_field-1" class="form-control">
                            <option value="1">1 | Public</option>
                            <option value="2">2 | Admin Divisi</option>
                            <option value="3">3 | HR</option>
                            <option value="4">4 | Manajemen</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="form-group">
                        <label>Urutan</label>
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
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <button type="button" class="btn-block btn btn-primary add-form-field">
                            Tambah
                        </button>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary agrement" onclick="openPersetujuan()"
                            alt="modal">
                            Tambah Persetujuan
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
                        <input class="form-control" id="count_field" type="text" value="1" placeholder="">
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
                        <select style="width: 100%;" onchange="selectParent()" name="parent_table" id="parent_table"
                            class="custom-select2 form-control database-table">
                            <option value="">Pilih Tabel Referensi</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <button type="button" class="col-6 btn btn-primary btn-block create-form">Simpan form</button>
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

    {{-- modal GABUNGAN --}}
    <div class="modal fade" id="modal-GABUNGAN" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Buat Field Gabungan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>

                <div class="modal-body">
                    <input type="text" name="" id="sort-gabungan" value="-1">
                    <div class="row">

                        <div class="col-12 text-center" id="button-add-gabungan">
                            <button onclick="addGabungan()" class="col-12 btn-bloc btn btn-primary">tambah</button>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary" id="save-from-table" data-dismiss="modal"
                        onclick="saveGabunganField()">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal agrement --}}
    <div class="modal fade" id="modal-agrement" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Buat Persetujuan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>

                <div class="modal-body">
                    <input type="text" name="" id="sort-persetujuan" value="0">
                    <div class="row" id="field-kehadiran">

                        <div class="col-12 row row-persetujuan">

                        </div>



                        <div class="col-12 text-center" id="button-add-persetujuan">
                            <button onclick="addPersetujuan()" class="col-12 btn-bloc btn btn-primary">tambah</button>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary" id="save-from-table" onclick="addAgrement()">
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
        let element_option_chosee_table = '';

        let from_table_form = {};
        let gabungan_field = {};
        let persetujuan = {};

        function selectParent() {
            let code_table = $('#parent_table').val();
            CL(db['db']['database_table'][code_table]);
            if (code_table) {
                $('#primary_table').val(db['db']['database_field'][code_table][db['db']['database_table'][code_table][
                    'primary_table'
                ]]['description_field']);
            }
        }

        function addFormField(id_btn) {
            let element_form_field_full = `
                <div class="fields row profile-info" id="field-form-${id_btn}">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Nama Field</label>
                                <input type="text" class="form-control" id="description_field-${id_btn}">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Type Data Field</label>
                                <select onchange="selectSource(${id_btn})" style="width: 100%;" name="type_data_field-${id_btn}" id="type_data_field-${id_btn}" class="s2 form-control type-data">
                                    <option value="">Tipe Data Field</option>
                                    ${element_option_type_data}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Level</label>
                                <select  name="level_data_field-${id_btn}"
                                    id="level_data_field-${id_btn}" class="form-control">
                                    <option value="1">1 | Public</option>
                                    <option value="2">2 | Admin Divisi</option>
                                    <option value="3">3 | HR</option>
                                    <option value="4">4 | Manajemen</option>
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
            conLog('id_form', id_form)
            switch (val_option_source_field) {
                case 'DARI-TABEL':
                    $('#save-from-table').attr('onclick', `saveFromTable(${id_form})`)
                    $('#modal-from_table').modal('show');
                    return false;
                    break;
                case KONSTANTA['Input Autocomplite']:
                    $('#save-from-table').attr('onclick', `saveFromTable(${id_form})`)
                    $('#modal-from_table').modal('show');
                    return false;
                    break;
                case 'GABUNGAN':
                    $('#save-from-table').attr('onclick', `saveFromTable(${id_form})`);
                    $(`#sort-gabungan`).val(-1);
                    $('.gabungan-fields').remove();
                    addGabungan();
                    $('#modal-GABUNGAN').modal('show');
                    return false;
                    break;
                default:
                    return false;
            }
        }

        function selectTableSource() {
            let table_source = $(`#table`).val();

            $('#field_get').empty();
            Object.values(db['db']['database_field_join'][table_source]).forEach(element => {
                $('#field_get').append(`
                        <option value="${element.code_field}">${element.description_field}</option>
                    `);
            });
            return false;
        }


        function saveFromTable(id_form) {
            CL('save data source')
            from_table_form[`data-source-${id_form}`] = {
                table_data_source: $(`#table`).val(),
                field_get_data_source: $(`#field_get`).val(),
                primary_field_data_source: $(`#field_get`).val(),
            }
            CL(from_table_form)
        }

        function openPersetujuan() {
            $(`#modal-agrement`).modal('show');
            let code_table = toUUID($('#description_table').val());
            $('.row-persetujuan').empty();
            if (code_table) {
                if (db['db']['database_persetujuan'][code_table]) {
                    conLog('persetujuan', db['db']['database_persetujuan'][code_table]);
                    let count_persetujuan = 0;
                    Object.values(db['db']['database_persetujuan'][code_table]).forEach(element => {
                        addPersetujuan();
                        $(`#SUPPORT-TABLE-LEVEL-PERSETUJUAN-${count_persetujuan}`).val(element.level).trigger('change');
                        $(`#SUPPORT-TABLE-DESKRIPSI-PERSETUJUAN-${count_persetujuan}`).val(element.description).trigger('change');
                        $(`#SUPPORT-TABLE-GROUP-PERSETUJUAN-${count_persetujuan}`).val(element.grade).trigger('change');
                        $(`#SUPPORT-TABLE-REFERENCE-PERSETUJUAN-${count_persetujuan}`).val(element.reference).trigger('change');
                        count_persetujuan++;
                    });
                }
            }
        }

        function addAgrement() {
            let longPersetujuan = $('#sort-persetujuan').val();
            persetujuan = {};
            for (let countPersetujuan = 0; countPersetujuan < longPersetujuan; countPersetujuan++) {
                conLog('val countPersetujuan', $(`#SUPPORT-TABLE-LEVEL-PERSETUJUAN-${countPersetujuan}`).val());
                if ($(`#SUPPORT-TABLE-LEVEL-PERSETUJUAN-${countPersetujuan}`).val()) {
                    let level_persetujuan = $(`#SUPPORT-TABLE-LEVEL-PERSETUJUAN-${countPersetujuan}`).val();
                    let obj_persetujuan = {};
                    obj_persetujuan = {};
                    obj_persetujuan['grade'] = $(`#SUPPORT-TABLE-GROUP-PERSETUJUAN-${countPersetujuan}`).val();
                    obj_persetujuan['description'] = $(`#SUPPORT-TABLE-DESKRIPSI-PERSETUJUAN-${countPersetujuan}`).val();
                    obj_persetujuan['level'] = $(`#SUPPORT-TABLE-LEVEL-PERSETUJUAN-${countPersetujuan}`).val();
                    obj_persetujuan['reference'] = $(`#SUPPORT-TABLE-REFERENCE-PERSETUJUAN-${countPersetujuan}`).val();
                    persetujuan[level_persetujuan] = obj_persetujuan;
                }
            }
            conLog('persetujuan', persetujuan);

        }

        function addPersetujuan() {
            code_table_reference = toUUID($('#description_table').val());
            let countPersetujuan = $('#sort-persetujuan').val();
            let divPersetujuan = `
                            <div class="col-md-5 persetujuan-${countPersetujuan}">
                                <div class="form-group" id="field-kehadiran-level-persetujuan-${countPersetujuan}">
                                    
                                </div>
                            </div>
                            <div class="col-md-5 persetujuan-${countPersetujuan}">
                                <div class="form-group" id="field-kehadiran-deskripsi-persetujuan-${countPersetujuan}">
                                    
                                </div>
                            </div>
                            <div class="col-md-5 persetujuan-${countPersetujuan}">
                                <div class="form-group" id="field-kehadiran-group-persetujuan-${countPersetujuan}">
                                    
                                </div>
                            </div>
                            <div class="col-md-5 persetujuan-${countPersetujuan}">
                                <div class="form-group" id="field-kehadiran-reference-persetujuan-${countPersetujuan}">
                                    
                                </div>
                            </div>
                            <div class="col-md-2 fa-hover persetujuan-${countPersetujuan}">
                                <div class="form-group" id="field-kehadiran-btn-persetujuan">
                                    <label for="del-persetujuan">Hapus</label>
                                    <button onclick="deletePersetujuan(${countPersetujuan})" type="button" class="btn" data-bgcolor="#bd081c" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(189, 8, 28);">
										<i class="icon-copy bi bi-backspace-fill"></i>
									</button>
                                </div>
                            </div>`;
            $('.row-persetujuan').append(divPersetujuan);
            conLog('elelel', db['db']['database_field']['SUPPORT-TABLE']['LEVEL-PERSETUJUAN']);
            let old_level = db['db']['database_field']['SUPPORT-TABLE']['LEVEL-PERSETUJUAN']['full_code_field'];
            db['db']['database_field']['SUPPORT-TABLE']['LEVEL-PERSETUJUAN']['full_code_field'] = db['db']['database_field']
                ['SUPPORT-TABLE']['LEVEL-PERSETUJUAN']['full_code_field'] + '-' + countPersetujuan;
            let old_deskkripsi = db['db']['database_field']['SUPPORT-TABLE']['DESKRIPSI-PERSETUJUAN']['full_code_field'];
            db['db']['database_field']['SUPPORT-TABLE']['DESKRIPSI-PERSETUJUAN']['full_code_field'] = db['db'][
                'database_field'
            ]['SUPPORT-TABLE']['DESKRIPSI-PERSETUJUAN']['full_code_field'] + '-' + countPersetujuan;
            let old_group = db['db']['database_field']['SUPPORT-TABLE']['GROUP-PERSETUJUAN']['full_code_field'];
            db['db']['database_field']['SUPPORT-TABLE']['GROUP-PERSETUJUAN']['full_code_field'] = db['db']['database_field']
                ['SUPPORT-TABLE']['GROUP-PERSETUJUAN']['full_code_field'] + '-' + countPersetujuan;
            
            let old_reference = db['db']['database_field']['SUPPORT-TABLE']['REFERENCE-PERSETUJUAN']['full_code_field'];
            db['db']['database_field']['SUPPORT-TABLE']['REFERENCE-PERSETUJUAN']['full_code_field'] = db['db']['database_field']
                ['SUPPORT-TABLE']['REFERENCE-PERSETUJUAN']['full_code_field'] + '-' + countPersetujuan;

            conLog('ekekek', db['db']['database_field']['SUPPORT-TABLE']['LEVEL-PERSETUJUAN']);
            cardFormField('field-kehadiran-level-persetujuan-' + countPersetujuan, db['db']['database_field'][
                'SUPPORT-TABLE'
            ]['LEVEL-PERSETUJUAN']);
            cardFormField('field-kehadiran-deskripsi-persetujuan-' + countPersetujuan, db['db']['database_field'][
                'SUPPORT-TABLE'
            ]['DESKRIPSI-PERSETUJUAN']);
            cardFormField('field-kehadiran-group-persetujuan-' + countPersetujuan, db['db']['database_field'][
                'SUPPORT-TABLE'
            ]['GROUP-PERSETUJUAN']);
            cardFormField('field-kehadiran-reference-persetujuan-' + countPersetujuan, db['db']['database_field'][
                'SUPPORT-TABLE'
            ]['REFERENCE-PERSETUJUAN']);
            db['db']['database_field']['SUPPORT-TABLE']['LEVEL-PERSETUJUAN']['full_code_field'] = old_level;
            db['db']['database_field']['SUPPORT-TABLE']['DESKRIPSI-PERSETUJUAN']['full_code_field'] = old_deskkripsi;
            db['db']['database_field']['SUPPORT-TABLE']['GROUP-PERSETUJUAN']['full_code_field'] = old_group;
            db['db']['database_field']['SUPPORT-TABLE']['REFERENCE-PERSETUJUAN']['full_code_field'] = old_reference;

            $('#sort-persetujuan').val(parseInt(countPersetujuan) + 1);
        }

        function deletePersetujuan(countPersetujuan) {
            $(`.persetujuan-${countPersetujuan}`).remove();
        }








        $(document).ready(function() {

            let var_menu = "menu";

            Object.values(db['db']['database_table']).forEach(element => {
                // conLog('xx', element)
                $(`.database-table`).append(`
                        <option value="${element.code_table}">${element.description_table}</option>
                    `);
            });

            Object.entries(db['db']['database_field_join']).forEach(([key, value]) => {
                element_option_chosee_table =
                    `${element_option_chosee_table }  
                    <option value="${key}">${db['db']['database_table'][key]['description_table']}</option>`;
            });


            // menu option
            Object.values(db['db']['menu']).forEach(element => {
                // conLog('xx', element)
                $(`.employees`).append(`
                        <option value="${element.uuid}">${element.description}</option>
                    `);
            });

            // type data option
            Object.entries(db['public']['public_value']['TYPE-DATA']).forEach(([key, value]) => {
                element_option_type_data =
                    `${element_option_type_data }  
                    <option value="${key}">${value['TYPE-DATA']}</option>`;
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

            /*
                user fingger
                    nik
                    user id
                    machine_id granted

                    2 table
                    # table users_fingger

                        nik
                        user_fingger_id
                            code nik|user_fingger
                    # table users_granted_location_fingger
                        nik
                        location_id
                            code nik|user_fingger

                    if user_fingger_id findout
                        if nik location granted




            */

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
                            'level_data_field': $(`#level_data_field-${i+1}`).val(),
                            'sort_field': count_field_form,
                            'code_field': toUUID($(`#description_field-${i+1}`).val()),
                        }
                        if ($(`#type_data_field-${i+1}`).val() == 'DARI-TABEL' || $(
                                `#type_data_field-${i+1}`).val() == KONSTANTA['Input Autocomplite']) {
                            data_field.data_source = from_table_form[`data-source-${i+1}`]
                        }

                        if ($(`#type_data_field-${i+1}`).val() == 'GABUNGAN') {
                            data_field.gabungan = gabungan_field[`gabungan-filed-${i+1}`]
                        }
                        data_form.push(data_field);
                        count_field_form++;
                    }
                }
                form_detail.field = data_form;
                form_detail.persetujuan = persetujuan;
                CL('form_detail');
                CL(form_detail);
                conLog('form_detail', form_detail)
                // return false;

                // S T O R E
                $.ajax({
                    url: '/api/mbg/manage/app/store',
                    type: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login
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
            gabungan_field = {};
            CL(db);
            // Display the ID in the console (you can replace this with your own code)
            console.log('Clicked element ID: ' + elementId);
            let string_primary_table = db['db']['database_table'][elementId]['primary_table'];
            let arr_primary_table = string_primary_table.split(elementId);
            conLog('arr_primary_table', arr_primary_table);
            $('#description_table').val(db['db']['database_table'][elementId]['description_table']);
            $('#primary_table').val(db['db']['database_field'][elementId][db['db']['database_table'][elementId][
                'primary_table'
            ]]['description_field']);
            $('#menu_table').val(db['db']['database_table'][elementId]['menu_table']).trigger('change');
            $('#parent_table').val(db['db']['database_table'][elementId]['parent_table']).trigger('change');

            let edit_data_field = db['db']['database_field'][elementId];
            // deleteFiled(1);
            let arr_field = [];
            Object.values(edit_data_field).forEach(edit_field => {
                arr_field[edit_field.sort_field] = edit_field;
            });
            CL('arr_field');
            CL(arr_field);
            $('.fields').remove();
            arr_field.forEach(edit_field => {
                let countField = parseInt(edit_field.sort_field) + 1;
                let elementAddFieldForm = addFormField(countField);
                $('#count_field').val(countField);
                $('.btn-add-form-field').before(elementAddFieldForm);
                $(`#type_data_field-${countField}`).select2();
                $('#description_field-' + (parseInt(edit_field.sort_field) + 1)).val(edit_field.description_field);
                $('#type_data_field-' + (parseInt(edit_field.sort_field) + 1)).val(edit_field.type_data_field);
                $('#level_data_field-' + (parseInt(edit_field.sort_field) + 1)).val(edit_field.level_data_field);
                $(`#select2-type_data_field-${parseInt(edit_field.sort_field) + 1}-container`).text(edit_field
                    .type_data_field);
                from_table_form = {};
                if (db['db']['database_data_source'][edit_field.full_code_field] !== undefined) {
                    from_table_form[`data-source-${countField}`] = {
                        table_data_source: db['db']['database_data_source'][edit_field.full_code_field][
                            'table_data_source'
                        ],
                        field_get_data_source: db['db']['database_data_source'][edit_field.full_code_field][
                            'field_get_data_source'
                        ]
                    }
                    CL(from_table_form)
                }
                if (db['db']['database_field_show'][edit_field.code_table_field]) {
                    if (db['db']['database_field_show'][edit_field.code_table_field][edit_field.code_field]) {
                        let field_gabungan = {};
                        (db['db']['database_field_show'][edit_field.code_table_field][edit_field.code_field])
                        .forEach(element => {
                            field_gabungan[element.sort_field] = {
                                field_show_code: element.field_show_code,
                                table_show_code: element.table_show_code,
                                split_by: element.split_by,
                                sort_field: element.sort_field,
                            }
                        });
                        gabungan_field[`gabungan-filed-${countField}`] = field_gabungan;
                        conLog('gabungan_field', gabungan_field)
                    }
                }

                $(`#type_data_field-${countField}`).select2();
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


    <script>
        //gabungan
        function addGabungan() {
            let id_form = $('#count_field').val();
            let new_id = parseInt($(`#sort-gabungan`).val()) + 1;
            let element_option_gabungan = ``;
            for (for_fields = 1; for_fields < id_form; for_fields++) {
                try {

                    let value_ = toUUID($(`#description_field-${for_fields}`).val());
                    let description_ = $(`#description_field-${for_fields}`).val();
                    element_option_gabungan =
                        `${element_option_gabungan} <option value="${value_}">${description_}</option>`;
                } catch (error) {

                }
            }

            if ($(`#parent_table`).val()) {
                let parent_table = $(`#parent_table`).val();
                if (db['db']['database_field_join'][parent_table]) {
                    Object.values(db['db']['database_field_join'][parent_table]).forEach(element => {
                        let value_ = element['code_field'];
                        let description_ = element['description_field'];
                        element_option_gabungan =
                            `${element_option_gabungan} <option value="${value_}">${description_}</option>`;
                    });
                }
            }
            $(`#sort-gabungan`).val(new_id)
            $('#button-add-gabungan').before(`
                <div class="col-12 gabungan-fields" id="gabungan-${new_id}">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="table">Tabel Referensi</label>
                                <select name="table_references" id="table_references-${new_id}"
                                    onchange="chooseTableReferenceJoin()" 
                                    class="custom-select2 form-control select-table database-table"
                                    style="width: 100%;">
                                    <option value="">Pilih Field</option>
                                    ${element_option_chosee_table}
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="table">Field</label>
                                <select name="gabungan-fields" id="gabungan-fields-${new_id}" 
                                    class="custom-select2 form-control select-table database-table"
                                    style="width: 100%;">
                                    <option value="">Pilih Field</option>
                                    ${element_option_gabungan}
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="field_get">Pembatas ${new_id}</label>
                                <input type="text" class="form-control" name="gabungan-pembatas-${new_id}" id="gabungan-pembatas-${new_id}">
                            </div>
                        </div>
                        <div class="col-2">
                            <label for="field_get">hapus</label>
                            <button type="button"  onclick="deleteFieldGabungan(${new_id})" class="form-control btn btn-danger btn-delete">
                                <i class="icon-copy dw dw-delete-3"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `);
            $(`#sort-gabungan`).val(new_id);
            $(`#gabungan-fields-${new_id}`).select2();
            $(`#table_references-${new_id}`).select2();
        }

        function chooseTableReferenceJoin() {
            /*
            tujuannya adalah menentukan field untuk field
            */

            let id_field = parseInt($(`#sort-gabungan`).val());
            let code_table = $(`#table_references-${id_field}`).val();
            conLog(id_field, code_table)
            element_option_gabungan = '';
            Object.values(db['db']['database_field_join'][code_table]).forEach(element => {
                let value_ = element['code_field'];
                let description_ = element['description_field'];
                element_option_gabungan =
                    `${element_option_gabungan} <option value="${value_}">${description_}</option>`;
            });
            $(`#gabungan-fields-${id_field}`).append(element_option_gabungan);
            conLog('element_option_gabungan', element_option_gabungan)
        }

        function saveGabunganField() {
            let id_form = $('#count_field').val();
            let count_field_gabungan = $('#sort-gabungan').val();
            conLog('count_field_gabungan', count_field_gabungan)
            let field_gabungan = {};
            let sort_field = 0;
            for (loop_save_gabungan = 0; loop_save_gabungan <= count_field_gabungan; loop_save_gabungan++) {
                if ($(`#gabungan-fields-${loop_save_gabungan}`).val()) {
                    field_gabungan[sort_field] = {
                        field_show_code: $(`#gabungan-fields-${loop_save_gabungan}`).val(),
                        table_show_code: ($(`#table_references-${loop_save_gabungan}`).val()) ? $(
                            `#table_references-${loop_save_gabungan}`).val() :
                        null, //kalau null berrti nnti adalah nama table ini
                        split_by: $(`#gabungan-pembatas-${loop_save_gabungan}`).val(),
                        sort_field: sort_field,
                    }
                    sort_field++;
                }
            }
            gabungan_field[`gabungan-filed-${id_form}`] = field_gabungan;
            conLog('gabungan_field', gabungan_field);
        }

        function deleteFieldGabungan(id_delete) {
            $(`#gabungan-${id_delete}`).remove();
        }
    </script>
@endsection()
