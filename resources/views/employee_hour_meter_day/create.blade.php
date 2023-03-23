@extends('template.admin.main_privilege')
@section('content')
    <div class="mb-30">
        <div class="row">
            <div class="col-12">
                <!-- Simple Datatable start -->
                <div class="card-box  mb-30">
                    <form action="/hour-meter/store" id="form-hour-meter" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="uuid" id="uuid">
                        <div class="pd-20">
                            <div class="row">
                                <div class="col">
                                    <h4 class="text-blue h4">Tambah HM Karyawans</h4>
                                </div>
                                <div class="col text-center">
                                    <div class="alert alert-warning" id="isEdit" role="alert">
                                        Edit Mode !
                                        <input type="text" id="is_edit" value="is_edit" name="is_edit">
                                    </div>
                                </div>
                                <div class="col text-right">
                                    <div class="button-group text-right">
                                        <button type="button" onclick="resetData()"
                                            class="btn btn-secondary">Reset</button>
                                        <button type="button" onclick="store('hour-meter')" class="btn btn-primary">
                                            Simpan
                                            <div class="spinner-border" id="loading" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pd-20">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_checker_uuid">Pilih Checker</label>
                                        <select name="employee_checker_uuid" id="employee_checker_uuid"
                                            class="custom-select2 form-control employees">
                                            <option value="">karyawan</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_foreman_uuid">Pilih Foreman</label>
                                        <select name="employee_foreman_uuid" id="employee_foreman_uuid"
                                            class="custom-select2 form-control employees">
                                            <option value="">karyawan</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_supervisor_uuid">Pilih Supervisor</label>
                                        <select name="employee_supervisor_uuid" id="employee_supervisor_uuid"
                                            class="custom-select2 form-control employees">
                                            <option value="">karyawan</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_uuid">Pilih Karyawan</label>
                                        <select name="employee_uuid" id="employee_uuid"
                                            class="custom-select2 form-control employees">
                                            <option value="">karyawan</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Tanggal</label>
                                        <input type="date" name="date" id="date" value=""
                                            class="form-control">

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row justify-content-md-center">
                                        <div class="col-auto">
                                            <div class="form-group">
                                                <label for="">Shift</label>
                                                <div>
                                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                        <label id="lbl-Siang" class="btn btn-outline-primary">
                                                            <input type="radio" name="shift" id="Siang"
                                                                value="Siang" checked="checked" autocomplete="off">
                                                            Siang
                                                        </label>

                                                        <label id="lbl-Malam" class="btn btn-outline-primary">
                                                            <input type="radio" name="shift" id="Malam"
                                                                value="Malam" autocomplete="off">
                                                            Malam
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-auto text-center">
                                            <div class="form-group">
                                                <label for="value">Nilai HM</label>
                                                <input onkeyup="fullValue()" type="text" name="value" id="value"
                                                    value="" class="form-control">

                                            </div>
                                        </div>
                                        <div class="col-auto text-center">
                                            <div class="form-group">
                                                <label for="full_value" class="mr-1">Aktifkan Bonus? </label>
                                                <input type="checkbox" onchange="fullValue()" checked
                                                    name="isBonusAktive" class="switch-btn" data-size="small"
                                                    data-color="#0099ff" id="isBonusAktive" />
                                                <input type="text" name="full_value" id="full_value"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row justify-content-md-center" id="hour-meter-prices">
                                            <div class="col-12 text-center"><label class="weight-600 ">Harga HM</label>
                                            </div>
                                            <input type="hidden" id="hour_meter_price_uuid">
											
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Simple Datatable End -->
            </div>
        </div>

        <div class="row last-hm">
            <div class="col-sm-12 col-md-2 mb-30">
                <div class="card card-box">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-7">
                                Tgl. 1
                            </div>
                            <div class="col-5 text-right">
                                <div class="btn-group dropdown">
                                    <i class="icon-copy bi bi-gear-fill " data-toggle="dropdown"
                                        aria-expanded="false"></i>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Edit</a>
                                        <a class="dropdown-item" href="#">Hapus</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>
                                full hm : <b>10</b>
                            </p>
                            <footer class="blockquote-footer">
                                slip :
                                <cite title="Source Title">10</cite>
                            </footer>

                        </blockquote>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('js')
    <script>
        $('#isEdit').hide();
        $('#is_edit').remove();
        let employees = @json($employees);
        let hour_meter_prices = @json($hour_meter_prices);
        let year_month = @json($year_month);
        let nik_employee = @json($nik_employee);

        let arr_year_month = year_month.split("-");
        let year = arr_year_month[0];
        let month = arr_year_month[1];

        function getLastHm() {
            
            $.ajax({
                url: '/hour-meter/create/data',
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    year: year,
                    month: month,
                    employee_uuid: nik_employee
                },
                success: function(response) {
                    let data = response.data;
                    console.log('data')
                    console.log(data)
                    $('.last-hm').empty();
                    data.forEach(element => {
                        let date_each = element.date

                        let arr_date_each = date_each.split("-");
                        // console.log(date_each)
                        let last_year = getLastNdigits(arr_date_each[0], 2)
                        let who_is = `<footer class="blockquote-footer">
                                            <cite title="Source Title">${element.name}</cite>
                                        </footer>`;
                        if(nik_employee){
                            who_is =``;
                        }
                        console.log(element.name)
                        $('.last-hm').append(`
                        <div class="col-sm-12 col-md-2 mb-30" id="element-${element.uuid}">
                            <div class="card card-box">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-9">
                                            ${last_year}/${arr_date_each[1]}/${arr_date_each[2]}
                                        </div>
                                        <div class="col-3 text-right">
                                            <div class="btn-group dropdown">
                                                <i class="icon-copy bi bi-gear-fill " data-toggle="dropdown"
                                                aria-expanded="false"></i>
                                                <div class="dropdown-menu">
                                                    <a onclick="editHm('${element.uuid}')" class="dropdown-item" href="#">Edit</a>
                                                    <a onclick="deleteData('${element.uuid}')" class="dropdown-item" href="#">Hapus</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                        ${who_is}
                                        <p>
                                            full hm : <b>${element.full_value}</b>
                                        </p>
                                        <footer class="blockquote-footer">
                                            slip :
                                            <cite title="Source Title">${element.value}</cite>
                                        </footer>

                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        
                        `)
                    });


                    // $('#table-'+idForm).DataTable().ajax.reload();
                },
                error: function(response) {
                    alertModal()
                }
            });
        }

        function updatehour_meter_price_uuid(uuid) {
            $('#hour_meter_price_uuid').val(uuid);
        }





        function firstEmployeeHourMeterCreate() {
            year_month = @json($year_month);
            nik_employee = @json($nik_employee);
            
            
            console.log(year_month);
            console.log(nik_employee);
            // $('.employees').empty();
            employees.forEach(element => {
                $('.employees').append(`
                <option value="${element.nik_employee}">${element.name} - ${element.position}</option>
            `)
            });

            hour_meter_prices.forEach(element => {
                $('#hour-meter-prices').append(`
                <div class="col-auto">
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio"  id="${element.uuid}" name="hour_meter_price_uuid" onclick="updatehour_meter_price_uuid('${element.uuid}')"
                            class="custom-control-input"  value="${element.uuid}" />
                        <label class="custom-control-label" for="${element.uuid}"  >${element.hour_meter_name}</label>
                    </div>
                </div>
            `);
            });
            if(nik_employee){
                console.log('udin')
                $('#employee_uuid').val(nik_employee).trigger('change');
            }
            getLastHm()
        }

        firstEmployeeHourMeterCreate();




        let _url_data = '';


        $('#loading').hide();

        function globalStoreHm(idForm) {
            let _url = $('#form-' + idForm).attr('action');

            var form = $('#form-' + idForm)[0];
            var form_data = new FormData(form);
            startLoading();
            $.ajax({
                url: _url,
                type: "POST",
                contentType: false,
                processData: false,
                data: form_data,
                success: function(response) {
                    $('#success-modal').modal('show')
                    console.log(response.data)
                    let store_data = response.data
                    let date_each = store_data.date

                        let arr_date_each = date_each.split("-");
                        // console.log(date_each)
                        let last_year = getLastNdigits(arr_date_each[0], 2)
                        let who_is = `<footer class="blockquote-footer">
                                            <cite title="Source Title">${store_data.name}</cite>
                                        </footer>`;
                        if(nik_employee){
                            who_is =``;
                        }
                        $(`#element-${store_data.uuid}`).remove();
                        $('.last-hm').prepend(`
                        <div class="col-sm-12 col-md-2 mb-30" id="element-${store_data.uuid}">
                            <div class="card card-box">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-9">
                                            ${last_year}/${arr_date_each[1]}/${arr_date_each[2]}
                                        </div>
                                        <div class="col-3 text-right">
                                            <div class="btn-group dropdown">
                                                <i class="icon-copy bi bi-gear-fill " data-toggle="dropdown"
                                                aria-expanded="false"></i>
                                                <div class="dropdown-menu">
                                                    <a onclick="editHm('${store_data.uuid}')" class="dropdown-item" href="#">Edit</a>
                                                    <a onclick="deleteData('${store_data.uuid}')" class="dropdown-item" href="#">Hapus</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                        ${who_is}
                                        <p>
                                            full hm : <b>${store_data.full_value}</b>
                                        </p>
                                        <footer class="blockquote-footer">
                                            slip :
                                            <cite title="Source Title">${store_data.value}</cite>
                                        </footer>

                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        
                        `)
                },
                error: function(response) {
                    alertModal()
                }
            });
        }

        function store(idForm) {
            console.log(idForm)
            if (isRequiredCreate(['date', 'employee_uuid', 'hour_meter_price_uuid', 'value']) > 0) {
                return false;
            }
            var isStored = globalStoreHm(idForm)
            resetData();

            $('#sa-custom-position').click();
        }



        function editHm(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/hour-meter/edit";

            $('#isEdit').show();
            $('#isEdit').after(`<input type="text" id="is_edit" value="is_edit" name="is_edit">`);

            $('#loading').show();

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    uuid: uuid,
                    _token: _token
                },
                success: function(response) {
                    data = response.data
                    console.log('data')
                    console.log(data)
                    $('#employee_uuid').val(data.employee_uuid).trigger('change');
                    $('#uuid').val(data.uuid).trigger('change');
                    $('#employee_checker_uuid').val(data.employee_checker_uuid).trigger('change');
                    $('#employee_foreman_uuid').val(data.employee_foreman_uuid).trigger('change');
                    $('#employee_supervisor_uuid').val(data.employee_supervisor_uuid).trigger('change');
                    $('#full_value').val(data.full_value).trigger('change');
                    $('#' + data.hour_meter_price_uuid).attr('checked', true);
                    $('#' + data.shift).attr('checked', true);
                    $('.btn-outline-primary').attr('class', ' btn btn-outline-primary');
                    $('#lbl-' + data.shift).attr('class', ' btn btn-outline-primary active');
                    $('#value').val(data.value).trigger('change');
                    $('#date').val(data.date);
                    $('#hour_meter_price_uuid').val(data.hour_meter_price_uuid);
                    $('#loading').hide();

                },

                error: function(response) {
                    console.log(response)
                }
            });
        }

        function fullValue() {
            let isBonusAktive = $('#isBonusAktive')[0].checked
            let full_value
            if (isBonusAktive == true) {
                let value_hm = parseInt($('#value').val())
                full_value = value_hm
                if (value_hm >= 10) {
                    full_value = value_hm * 0.15
                    full_value = full_value + value_hm
                }
                if (value_hm >= 14) {
                    full_value = value_hm * 0.3 + value_hm
                }
                if (value_hm >= 16) {
                    full_value = value_hm * 0.5 + value_hm
                }       


                $('#full_value').val(full_value)
                console.log(value_hm)
            } else {
                $('#full_value').val(parseInt($('#value').val()))
            }
        }



        function resetData() {
            $('#isEdit').hide();
            if(!nik_employee){
                $('#employee_uuid').val('').trigger('change');
            }
            $('#is_edit').remove();
            console.log('resetData')
            $('#uuid').val('')
            $('.btn-outline-primary').attr('class', ' btn btn-outline-primary');
            $('#lbl-Siang').attr('class', ' btn btn-outline-primary active');
            
        }

        $(document).ready(function() {
            // console.log( "ready!" );
            // getFirst();
            $('.btn-outline-primary').attr('class', ' btn btn-outline-primary');
            $('#lbl-Siang').attr('class', ' btn btn-outline-primary active');

        });

        function deleteData(uuid) {
            let _url = '/hour-meter/delete'
            $('#confirm-modal').modal('show')
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#table_reload').val('hour-meter')
            getLastHm();
        }
    </script>
@endsection
