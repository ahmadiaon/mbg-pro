@extends('app.layouts.main')

@section('content')
    <div class="faq-wrap">
        <h4 class="mb-30 h4 text-blue padding-top-10">Collapse example</h4>

        <div class="padding-bottom-30">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-block" data-toggle="collapse" data-target="#faq-manage-database">
                        <h4 class="text-blue h4">Buat Baru Tabel</h4>
                    </button>
                </div>
                <div id="faq-manage-database" class="collapse show">
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Nama Tabel</label>
                                <div class="col-sm-12 col-md-10">
                                    <input id="description_table" class="form-control" type="text"
                                        placeholder="Masukan Nama Tabel .." />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Group Tabel</label>
                                <div class="col-sm-12 col-md-10">
                                    <select class="custom-select2 form-control" id="GROUP-DATABASE" name="state"
                                        style="width: 100%; height: 38px">
                                        <option value="">pilihan</option>
                                    </select>
                                </div>
                            </div>
                            <div id="divFields">
                                <div class="row" id="field-1">
                                    <div class="col-sm-12 col-md-3 mb-10">
                                        <label for="">Nama field</label>
                                        <input class="form-control" id="description_field-1" name="description_field-1"
                                            type="text" placeholder="Exc. Karyawan" />
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-10">
                                        <label for="">Jenis isian</label>
                                        <select onchange="onChangeInputType(1)" class="custom-select2 form-control" name="value_field-1" id="value_field-1"
                                            style="width: 100%; height: 38px">

                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-1">
                                        <label for="">Hapus</label>
                                        <button onclick=btnDeleteField(1) class="btn btn-danger">
                                            <i class="icon-copy dw dw-delete-3"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-7 col-sm-12 mb-30 ">
                                        <div class="card  bg-ligth card-box">
                                            <div class="card-body">
                                                <h5 class="card-title  text-center pd-5">Identitas</h5>
                                                <div class="row" id="field-1">
                                                    <div class="col-sm-12 col-md-5 mb-10">
                                                        <label for="">Nama field</label>
                                                        <input class="form-control" id="description_field-1" name="description_field-1"
                                                            type="text" placeholder="Exc. Karyawan" />
                                                    </div>
                                                    <div class="col-sm-12 col-md-5 mb-10">
                                                        <label for="">Jenis isian</label>
                                                        <select onchange="onChangeInputType(1)" class="custom-select2 form-control" name="value_field-1" id="value_field-1"
                                                            style="width: 100%; height: 38px">
                
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-2">
                                                        <label for="">Hapus</label>
                                                        <button onclick=btnDeleteField(1) class="btn btn-danger">
                                                            <i class="icon-copy dw dw-delete-3"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12 col-md-12  text-center">
                                                        <button onclick="btnAddField()" type="button" class="btn btn-lg btn-primary">
                                                            tambah field <i class="icon-copy bi bi-plus-square"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>                                
                            </div>
                            


                            <div class="form-group row">
                                <div class="col-sm-12 col-md-6  text-center">
                                    <button onclick="btnAddField()" type="button" class="btn btn-lg btn-primary">
                                        tambah field <i class="icon-copy bi bi-plus-square"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="btn-list">
                                <button type="button" onclick="btnSaveTable()" class="btn btn-info btn-lg">
                                    simpan
                                </button>
                            </div>
                            <div class="form-group row">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq2-2">
                        Daftar Database
                    </button>
                </div>
                <div id="faq2-2" class="collapse">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                        accusamus terry richardson ad squid. 3 wolf moon officia
                        aute, non cupidatat skateboard dolor brunch. Food truck
                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                        sunt aliqua put a bird on it squid single-origin coffee
                        nulla assumenda shoreditch et. Nihil anim keffiyeh
                        helvetica, craft beer labore wes anderson cred nesciunt
                        sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                        Leggings occaecat craft beer farm-to-table, raw denim
                        aesthetic synth nesciunt you probably haven't heard of them
                        accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script_javascript')
    <script>
        // DECLARE
        let countFields = 1;
        let _token = $('meta[name="csrf-token"]').attr('content');
        let dataLocalStorage = getLocalStorage('carColor');
        let value_fieldData;
        let arrayField = [1];

        conLog('localStorage', dataLocalStorage);
        $.ajax({
            url: "/api/superadmin/database",
            type: "GET",
            success: function(data) {
                let dataGroupDatabase = data['data']['GROUP-DATABASE'];
                let dataInputType = data['data']['INPUT-TYPE'];
                conLog('GROUP-DATABASE', dataGroupDatabase)
                Object.entries(dataGroupDatabase).forEach(function([key, value]) {
                    conLog('element', key)
                    $('#GROUP-DATABASE').append(`
                            <option value="${key}">${value[1]}</option>
                    `);
                });
                Object.entries(dataInputType).forEach(function([key, value]) {
                    conLog('element', key)
                    value_fieldData = value_fieldData + `
                        <option value="${key}">${value[1]}</option>
                    `;
                });

                $('#value_field-1').append(value_fieldData);
            }
        });

        function btnDeleteField(idField) {

            var newArrayField = arrayField.filter(function(item) {
                return item !== idField;
            });

            arrayField = newArrayField;
            $(`#field-${idField}`).remove();
        }

        function btnAddField() {
            countFields = countFields + 1;
            arrayField.push(countFields);
            let elementField = `
                            <div class="form-group row" id="field-${countFields}">
                                <div class="col-sm-12 col-md-3 mb-10">
                                    <label for="">Nama field</label>
                                    <input class="form-control" id="description_field-${countFields}" name="description_field-${countFields}" type="text" placeholder="Exc. Karyawan" />
                                </div>
                                <div class="col-sm-12 col-md-3 mb-10">
                                    <label for="">Jenis isian</label>
                                    <select id="onChangeInputType(${countFields})" class="custom-select2 form-control" name="value_field-${countFields}" id="value_field-${countFields}"
                                        style="width: 100%; height: 38px">
                                        ${value_fieldData}
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-1">
                                    <label for="">Hapus</label>
                                    <button onclick=btnDeleteField(${countFields}) class="btn btn-danger">
                                        <i class="icon-copy dw dw-delete-3"></i>
                                    </button>
                                </div>
                            </div>`;
            $('#divFields').append(elementField);
            conLog('array field', arrayField);
        }

        function btnSaveTable() {
            let table_fields = [];

            if (isRequiredCreate(['description_field-1', 'group-from']) > 0) {
                return false;
            }


            



            arrayField.forEach(numberField => {
                let field = {
                    'table_field': numberField,
                    'value_field': $(`#value_field-${numberField}`).val(),
                    'description_field': $(`#description_field-${numberField}`).val(),
                }
                table_fields.push(field);
            });

            let propertiesPost = {
                'database_tables': {
                    'description_table': $(`#description_table`).val(),
                    'group_table': $(`#GROUP-DATABASE`).val(),
                },

                'table_fields':table_fields
            }

            conLog('propertiesPost', propertiesPost)
        }

        function onChangeInputType(idField){
            let value_field = $(`#value_field-${idField}`).val()

            switch (value_field) {
                case 'INPUT-TYPE-0002':
                    conLog('from table','dsa')
                    break;
                default:
                    conLog('default','das')
            }
        }


    </script>
@endsection()
