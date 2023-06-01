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
                                    <div class="card-header row">

                                        <div class="col-auto" id="head-form-1">
                                            <h4 id="form-1" class="mb-20 h4 text-blue">Tambah Jenis Form </h4>
                                        </div>

                                        <div class="col-auto">
                                            <i onclick="editTitle('1')" class="icon-copy dw dw-edit2"></i>
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
                                        <h4 class="mb-20 h4 text-blue">Tambah Jenis Form </h4>
                                    </div>
                                    <div class="card-body">
                                        <button class="btn btn-success">simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




    <div class="card-box pb-10">
        <div class="h5 pd-20 mb-0">Recent Patient</div>
        <table class="data-table table nowrap">
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
@endsection

@section('js')
    <script>
        let variable_support_for_post_create_form = {
            form_number: []
        };
        let form_number = 0;
        let optionSourceField = '';

        Object.values(data_database.data_atribut_sizes.source_field).forEach(element => {
            optionSourceField =
                `${optionSourceField} <option value="${element.uuid}">${element.name_atribut}</option>`;
        });

        function addField() {
            $(`#form-button-add`).before(`
            <div class="row" id="field-form-${form_number}">
                <div class="col-md-5 form-group">
                    <input type="text" class="form-control" name="field_description-${form_number}" id="field_description-${form_number}" placeholder="nama field">
                </div>
                <div class="col-md-5 form-group">
                    <select name="source_field-${form_number}" id="source_field-${form_number}"
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
            cg('i am on add field', 'null');
            $(`#source_field-${form_number}`).select2();

            variable_support_for_post_create_form.form_number.push(form_number);

            // variable_support_for_post_create_form.form_number.[variable_support_for_post_create_form.form_number.indexOf(form_number)] = form_number;
            cg('variable_support_for_post_create_form', variable_support_for_post_create_form);

            variable_support_for_post_create_form['form_number'][form_number] = {
                source_field: 'description',

            }
            cg('variable_support_for_post_create_form', variable_support_for_post_create_form);
            form_number++;
        }

        function deleteField(id_form) {
            cg('del;e', id_form);
            variable_support_for_post_create_form['form_number'][id_form] = null;
            cg('variable_support_for_post_create_form', variable_support_for_post_create_form);
            $(`#field-form-${id_form}`).remove();
        }

        function saveForm() {   
            let field_required = [];

            $.each(variable_support_for_post_create_form.form_number, function(index, value) {
                if (value) {
                    field_description = $(`#field_description-${index}`).val();
                    value.field_description = field_description;
                    value = value;
                    field_required.push(`field_description-${index}`)
                }
                cg(field_description, value);
            });


            if (isRequiredCreate(field_required) > 0) {
                return false;
            }
        }

        function editTitle(form_id) {
            form_number = form_id;
            let val = $(`#head-form-${form_id}`).text();
            val = val.replace(/^\s+|\s+$|\s+(?=\s)/g, "");
            cg('val', val);
            $(`#head-form-${form_id}`).empty();
            $(`#head-form-${form_id}`).append(
                ` <input type="text" class="form-control mb-2" placeholder="Nama Form" onkeypress="return enterKeyPressed(event)" name="form-${form_id}" value="${val}" id="form-${form_id}">`
            );
        }

        function enterKeyPressed(event) {
            if (event.keyCode == 13) {
                $(`#form-${form_number}`).attr('type', 'hidden');
                $(`#form-${form_number}`).val();
                $(`#head-form-${form_number}`).append(`
                    <h4 id="form-${form_number}" class="mb-20 h4 text-blue">${$(`#form-${form_number}`).val()} </h4>
                `);
                return true;
            }
        }
    </script>
@endsection
