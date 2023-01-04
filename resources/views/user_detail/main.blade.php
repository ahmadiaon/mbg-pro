@extends('template.admin.main_privilege')

@section('content')
    <div class="the-content">
        @include('user_detail.create')
        @include('user_detail.dependent.create')
        @include('user_detail.address.create')
        @include('user_detail.education.create')
        @include('user_detail.license.create')
        @include('user_detail.health.create')
        @include('employee.create')


        <div id="create-employee-salary" class="children-content">
            <form action="/employee-salary/store" id="form-employee-salary" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="employee_uuid" id="employee_uuid-employee-salary">
                <input type="text" name="uuid" id="uuid-employee-salary">
                <div class="min-height-200px">
                    <div class="pd-20 card-box mb-20">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Gajih Karyawan</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Gajih Pokok</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input id="salary" name="salary" class="form-control" type="text"
                                            placeholder="3559000" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Insentif</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input id="insentif" name="insentif" class="form-control" type="text"
                                            placeholder="3559000" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Tunjangan</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input id="tunjangan" name="tunjangan" class="form-control" type="text"
                                            placeholder="3559000" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">HM</label>
                                    <div class="col-sm-12 col-md-8">
                                        <select name="hour_meter_price_uuid" id="hour_meter_price_uuid"
                                            class="custom-select2 form-control">

                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div id="element-premi">

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Mulai Digunakan</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input id="date_start-employee-salary" name="date_start" class="form-control"
                                            type="date" placeholder="3559000" />
                                    </div>
                                </div>
                                <button type="button" onclick="storeEmployeeSalary('employee-salary')"
                                    class="btn btn-primary btn-block">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>




            </form>
        </div>





    </div>
@endsection

@section('js')
    @include('js.user_detail.create')
    @include('js.user_detail.dependent.create')
    @include('js.user_detail.address.create')
    @include('js.user_detail.education.create')
    @include('js.user_detail.license.create')
    @include('js.user_detail.health.create')
    @include('js.employee.create')



    <script>
        function firstCreateEmployeeSalary(uuid) {
            $('#employee_uuid-employee-salary').val(uuid);

            stopLoading();

            setValue('/employee-salary/data/' + uuid, 'employee-salary');

        }

        function storeEmployeeSalary(idForm) {
            if (isRequiredCreate(['salary']) > 0) {
                return false;
            }
            globalStoreNoTable(idForm).then((data) => {
                let user = data.data;
                console.log(data);

                $('#btn-success-modal-id').attr('onclick',
                    `choosePage("create-employee-salary",  "${user.employee_uuid}")`);
                stopLoading();
                $('#success-modal-id').modal('show')
            })
        }
    </script>












    <script>
        let pohs;
        if (@json($pohs)) {
            pohs = @json($pohs);
            pohs.forEach(poh_element => {
                $('#poh_uuid').append(`<option value="${poh_element.uuid}">${poh_element.name}</option>`);
            });
        }
        let companies = @json($companies);
        companies.forEach(company_element => {
            $('#company_uuid').append(
                `<option value="${company_element.uuid}">${company_element.company}</option>`);
        });
        let positions = @json($positions);
        positions.forEach(position_element => {
            $('#position_uuid').append(
                `<option value="${position_element.uuid}">${position_element.position}</option>`);
        });
        let departments = @json($departments);
        departments.forEach(department_element => {
            $('#department_uuid').append(
                `<option value="${department_element.uuid}">${department_element.department}</option>`);
        });

        let roasters = @json($roasters);
        roasters.forEach(roaster_element => {
            $('#roaster_uuid').append(`<option value="${roaster_element.uuid}">${roaster_element.name}</option>`);
        });

        let tax_statuses = @json($tax_statuses);
        tax_statuses.forEach(tax_status_element => {
            $('#tax_status').append(
                `<option value="${tax_status_element.uuid}">${tax_status_element.tax_status_name}</option>`);
        });

        let hour_meter_prices = @json($hour_meter_prices);
        $('#hour_meter_price_uuid').append(
                `<option value="">Tidak Ada HM</option>`
                );
        hour_meter_prices.forEach(hour_meter_price_element => {
            $('#hour_meter_price_uuid').append(
                `<option value="${hour_meter_price_element.uuid}">${hour_meter_price_element.key_excel}</option>`
                );
        });
        let premis = @json($premis);
        $('#element-premi').empty();
        premis.forEach(premi_element => {
            console.log(premi_element);
            $('#element-premi').append(`<div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Premi ${premi_element.premi_name}</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input id="${premi_element.uuid}" name="${premi_element.uuid}" class="form-control" type="text" placeholder="3559000" />
                                    </div>
                                </div>`)
        })

        let religions = @json($religions);
        choosePage('create-employee-salary', 'MBLE-2301001');
    </script>
@endsection
