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
        @include('employee.index')
        @include('employee.show')
        @include('employee.salary.create')







    </div>
@endsection

@section('js')
    
    @include('js.user_detail.dependent.create')
    @include('js.user_detail.address.create')
    @include('js.user_detail.education.create')
    @include('js.user_detail.license.create')
    @include('js.user_detail.health.create')
    @include('js.employee.create')
    @include('js.employee.index')
    @include('js.employee.show')
    @include('js.employee.salary.create')










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
        

        let roasters = @json($roasters);
        roasters.forEach(roaster_element => {
            $('#roaster_uuid').append(`<option value="${roaster_element.uuid}">${roaster_element.name}</option>`);
        });

        let tax_statuses = @json($tax_statuses);
        tax_statuses.forEach(tax_status_element => {
            $('#tax_status_uuid').append(
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
            $('#list-premi').append(`
            <div class="row">
                <div class="col-auto">
                    <span>Premi ${premi_element.premi_name}:</span>
                </div>
                <div class="col text-right">
                    Rp. <b class="index-employee-${premi_element.uuid}" >tidak ada</b>
                </div>
            </div> 
            `);
        })

        let religions = @json($religions);
        let employees;
        choosePage('index-employee', null);
    </script>
@endsection
