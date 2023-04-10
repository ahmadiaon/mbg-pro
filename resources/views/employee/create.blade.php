@extends('template.admin.main_privilege')

@section('content')
    <div class="the-content">

        <div id="create-user-employee" class="children-content">
            <form action="/app/user/employee/store" id="form-user-employee" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="isEdit" id="isEdit-create-user-employee">
                <input type="text" name="user_detail_uuid" id="user_detail_uuid-create-user-employee">
                <input type="text" name="uuid" id="uuid-create-user-employee">
                <div class="min-height-200px">

                    <!-- Identitas Karyawan -->
                    <div class="pd-20 card-box mb-20">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Identitas Karyawan</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Perusahaan</label>
                                    <select name="company_uuid" onchange="newValue()" id="company_uuid"
                                        class="form-control">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Department</label>
                                    <select name="department_uuid" id="department_uuid" style="width: 100%"
                                        class="custom-select2 form-control">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <select name="position_uuid" style="width: 100%" id="position_uuid"
                                            class="custom-select2 form-control">
                                        </select>
                                    </div>
                                </div>
                            </div>





                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Kontrak Status</label>
                                                            <select onchange="newValue()" name="contract_status"
                                                                id="contract_status" class="form-control">

                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Employee Status</label>
                                                            <select name="employee_status" id="employee_status"
                                                                class="form-control">

                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <label>Roster</label>
                                                                <select id="roaster_uuid" name="roaster_uuid"
                                                                    class="form-control">

                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 row">
                                                        <div class="form-group col-6">
                                                            <label>Tanggal Masuk</label>
                                                            <input onblur="newValue()" id="date_document_contract"
                                                                name="date_document_contract" class="form-control"
                                                                placeholder="Select Date" type="date" />
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label>Site</label>
                                                            <select id="site_uuid" name="site_uuid" class="form-control">

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>Tgl Mulai Kontrak</label>
                                                            <input onblur="newValue()" id="date_start_contract"
                                                                name="date_start_contract" class="form-control"
                                                                placeholder="Select Date" type="date" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Lama</label>
                                                            <input onblur="newValue()" id="long_contract"
                                                                name="long_contract" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>Kontrak Berakhir</label>
                                                            <input id="date_end_contract" type="date"
                                                                name="date_end_contract" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">No Kontrak</label>
                                            <div class="row">
                                                <div class="col-2">
                                                    <input onblur="newValue()" type="text" name="contract_number"
                                                        id="contract_number" class="form-control">
                                                </div>
                                                <div class="col-10">
                                                    <input type="text" name="contract_number_full"
                                                        id="contract_number_full" class="form-control">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">NIK Karyawan</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="text" name="nik_employee" id="nik_employee"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Nama Fingger</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="text" id="machine_id" name="machine_id"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Group Pajak</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <select name="tax_status_uuid" id="tax_status_uuid"
                                                        class="form-control">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <label class="weight-600">Keikutsertaan BPJS</label>
                                        <div class="row mb-20">
                                            <div class="col-auto">
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input onchange="setChecked('is_bpjs_kesehatan')" type="checkbox"
                                                        class="custom-control-input" id="is_bpjs_kesehatan">
                                                    <label class="custom-control-label" for="is_bpjs_kesehatan">
                                                        kesehatan</label>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input onchange="setChecked('is_bpjs_ketenagakerjaan')"
                                                        type="checkbox" class="custom-control-input"
                                                        id="is_bpjs_ketenagakerjaan">
                                                    <label class="custom-control-label" for="is_bpjs_ketenagakerjaan">
                                                        Ketenagakerjaan</label>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input"
                                                        onchange="setChecked('is_bpjs_pensiun')" id="is_bpjs_pensiun">
                                                    <label class="custom-control-label" for="is_bpjs_pensiun"> Hari
                                                        Tua</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group date_start">
                                                    <label for="">Tanggal Mulai Berlaku</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="date" name="date_start" id="date_start-user-employee"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group text-right">
                                                    <button type="button"
                                                        class="btn btn-secondary  mr-10 create-user-employee-back">Back</button>
                                                    <button type="button" onclick="storeUserEmployee('user-employee')"
                                                        class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function firstCreateUserEmployee(pageId) {
            let uuid = @json(session('recruitment-user'))['detail']['nik_employee'];

            Object.values(data_database.data_companies).forEach(company_element => {
                $('#company_uuid').append(
                    `<option value="${company_element.uuid}">${company_element.company}</option>`);
            });

            Object.values(data_database.data_positions).forEach(position_element => {
                $('#position_uuid').append(
                    `<option value="${position_element.uuid}">${position_element.position}</option>`);
            });
            Object.values(data_database.data_departments).forEach(department_element => {
                $('#department_uuid').append(
                    `<option value="${department_element.uuid}">${department_element.department}</option>`);
            });


            Object.values(data_database.data_atribut_sizes.contract_status).forEach(contract_status_element => {
                $('#contract_status').append(
                    `<option value="${contract_status_element.uuid}">${contract_status_element.name_atribut}</option>`
                );
            });

            Object.values(data_database.data_atribut_sizes.tax_status).forEach(tax_status_element => {
                $('#tax_status_uuid').append(
                    `<option value="${tax_status_element.uuid}">${tax_status_element.name_atribut}</option>`);
            });

            Object.values(data_database.data_atribut_sizes.employee_status).forEach(employee_status_element => {
                $('#employee_status').append(
                    `<option value="${employee_status_element.uuid}">${employee_status_element.name_atribut}</option>`
                );
            });

            Object.values(data_database.data_atribut_sizes.roaster_uuid).forEach(roaster_uuid_element => {
                $('#roaster_uuid').append(
                    `<option value="${roaster_uuid_element.uuid}">${roaster_uuid_element.name_atribut}</option>`
                );
            });
            Object.values(data_database.data_atribut_sizes.site_uuid).forEach(site_uuid_element => {
                $('#site_uuid').append(
                    `<option value="${site_uuid_element.uuid}">${site_uuid_element.name_atribut}</option>`
                );
            });

            console.log(uuid)
            $('#user_detail_uuid-create-user-employee').val(uuid);
            $('#long_contract').val('3');

            stopLoading();


            let date_now = new Date();
            let day = padToDigits(2, date_now.getDate());
            let month = padToDigits(2, date_now.getMonth() + 1);
            let year = date_now.getFullYear();
            let today = year + '-' + month + '-' + day;

            if (uuid != null) {
                // cg('a','a')
                setValue('/get/data/' + uuid, 'user-employee');
            }
        }

        function storeUserEmployee(idForm) {
            if (isRequiredCreate(['nik_employee']) > 0) {
                return false;
            }

            globalStoreNoTable(idForm).then((data) => {
                console.log('data store employees')
                let user = data.data;
                console.log(data);

                stopLoading();
                $('#success-modal-id').modal('show')
            })
        }

        function newValue() {
            console.log('newValue')

            let company = $('#company_uuid').val();
            let contract_status = $('#contract_status').val();
            let date_start_contract = $('#date_start_contract').val();
            let contract_number = $('#contract_number').val();
            let date_now = new Date(date_start_contract);

            if (date_start_contract == '') {
                date_now = new Date();
            }

            let long_contract = $('#long_contract').val();
            let date_end_contract = $('#date_end_contract').val();

            let day = padToDigits(2, date_now.getDate());
            let month = padToDigits(2, date_now.getMonth() + 1);
            let year = date_now.getFullYear();

            let today = year + '-' + month + '-' + day;
            console.log(today)
            const next_date_now = new Date(today);
            console.log('next_date_now')
            console.log(next_date_now)
            let long = parseInt(long_contract);
            console.log('long')
            console.log(long)
            next_date_now.setMonth(next_date_now.getMonth() + long);
            console.log(next_date_now)
            let next_day = padToDigits(2, next_date_now.getDate());
            let next_month = padToDigits(2, next_date_now.getMonth() + 1);
            console.log(next_month)
            let next_year = next_date_now.getFullYear();
            let next_today = next_year + '-' + next_month + '-' + next_day;
            console.log(next_today)


            $('#date_start_contract').val(today);
            $('#date_start-user-employee').val(today);
            $('#date_end_contract').val(next_today);


            let month_romawi = monthRomawi[parseInt(month)];
            if (contract_number == null) {
                contract_number = '001';
            }

            contract_number = padToDigits(3, contract_number)

            let next_contract_number = contract_number + '/' + contract_status + '/' + company + '/' + month_romawi + '/' +
                year;
            $('#contract_number_full').val(next_contract_number);

            let nik_employee = company + '-' + getLastNdigits(year, 2) + month + padToDigits(3, contract_number);
            console.log(nik_employee);
            let user_detail_uuid_create_user_employee = $('#machine_id').val();
            if (!user_detail_uuid_create_user_employee) {
                $('#nik_employee').val(nik_employee);
            }


        }

        firstCreateUserEmployee('create-user-employee');
    </script>
@endsection
