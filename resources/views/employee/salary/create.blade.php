@extends('template.admin.main_privilege')

@section('content')
    <div class="the-content">

        <div id="create-employee-salary" class="children-content">
            <form action="/app/user/salary/store" id="form-employee-salary" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="isEdit" id="isEdit-employee-salary">
                <input type="text" name="employee_uuid" id="employee_uuid-create-employee-salary">
                <input type="text" name="uuid" id="uuid-create-employee-salary">
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
<script>
    function firstCreateEmployeeSalary(pageId) {
        
        let  uuid = @json(session('recruitment-user'))['detail']['nik_employee'];
        $('#hour_meter_price_uuid').append(
            `<option value="">Tidak Ada HM</option>`
        );
        Object.values(data_database.data_atribut_sizes.hour_meter_price).forEach(religion_element => {
            $('#hour_meter_price_uuid').append(
                `<option value="${religion_element.uuid}">${religion_element.name_atribut}</option>`);
        });
        let premis = @json($premis);
        $('#element-premi').empty();
        premis.forEach(premi_element => {
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
        $('#employee_uuid-employee-salary').val(uuid);
        
        stopLoading();
        if (uuid != null) {
            console.log('udin petot')
            setValue('/get/data/' + uuid, 'employee-salary');
        }
    }

    function storeEmployeeSalary(idForm) {
        if (isRequiredCreate(['salary']) > 0) {
            return false;
        }
        globalStoreNoTable(idForm).then((data) => {
            let user = data.data;
            console.log(data);
            stopLoading();
            $('#success-modal-id').modal('show')
        })
    }

    firstCreateEmployeeSalary('create-employee-salary');
</script>

@endsection

