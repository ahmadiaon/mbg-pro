@extends('template.admin.main_privilege')
@section('content')
    <div class="mb-30">
        <div class="row">
            <div class="col-12">
                <!-- Simple Datatable start -->
                <div class="card-box  mb-30">
                    <form action="/tonase/store" id="form-tonase" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="uuid" id="uuid">
                        <div class="pd-20">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4 class="text-blue h4">Tambah Tonase Karyawan</h4>
                                </div>
                                <div class="col-md-8">
                                    <div class="button-group text-right">
                                        <button type="button" onclick="resetData()"
                                            class="btn btn-secondary">Reset</button>
                                        <button type="button" onclick="store('tonase')" class="btn btn-primary">
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
                            <div class="row timbangan">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_create_uuid">Pilih Checker</label>
                                        <select name="employee_create_uuid" id="employee_create_uuid"
                                            class="custom-select2 form-control">
                                            <option value="">karyawan</option>
                                        </select>
                                        <div class="invalid-feedback" id="req-employee_create_uuid">
                                            Data tidak boleh kosong
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_know_uuid">Pilih Foreman</label>
                                        <select name="employee_know_uuid" id="employee_know_uuid"
                                            class="custom-select2 form-control">
                                            <option value="">karyawan</option>
                                        </select>
                                        <div class="invalid-feedback" id="req-employee_know_uuid">
                                            Data tidak boleh kosong
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_approve_uuid">Pilih Supervisor</label>
                                        <select name="employee_approve_uuid" id="employee_approve_uuid"
                                            class="custom-select2 form-control">
                                            <option value="">karyawan</option>
                                        </select>
                                        <div class="invalid-feedback" id="req-employee_approve_uuid">
                                            Data tidak boleh kosong
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-md-4 timbangan">
                                    <div class="form-group">
                                        <label for="vehicle_uuid">Pilih Unit</label>
                                        <select name="vehicle_uuid" id="vehicle_uuid" class="custom-select2 form-control">
                                            <option value="">karyawan</option>
                                        </select>
                                        <div class="invalid-feedback" id="req-vehicle_uuid">
                                            Data tidak boleh kosong
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="employee_uuid">Pilih Karyawan</label>
                                        <select name="employee_uuid" id="employee_uuid" class="custom-select2 form-control">
                                            <option value="">karyawan</option>
                                        </select>
                                        <div class="invalid-feedback" id="req-employee_uuid">
                                            Data tidak boleh kosong
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date">Tanggal</label>
                                        <input type="date" name="date" id="date" value="{{ $today }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-md-center timbangan">

                                <div class="col-md-3 text-center">
                                    <div class="form-group">
                                        <label for="date_start">Tanggal Berangkat</label>
                                        <input type="date" name="date_start" id="date_start" value=""
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2 text-center">
                                    <div class="form-group">
                                        <label for="time_start">Waktu Berangkat</label>
                                        <input type="time" name="time_start" id="time_start" value=""
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="form-group">
                                        <label for="date_come">Tanggal Sampai</label>
                                        <input type="date" name="date_come" id="date_come" value=""
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2 text-center">
                                    <div class="form-group">
                                        <label for="time_come">Waktu Sampai</label>
                                        <input type="time" name="time_come" id="time_come" value=""
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            {{-- value --}}
                            <div class="row justify-content-md-center">
                                <div class="col-md-3 ">
                                    <div class="form-group ">
                                        <label for="">Total Rit</label>
                                        <input type="text" class="form-control" name="ritase">

                                    </div>
                                </div>
                                <div class="col-md-3 timbangan">
                                    <div class="form-group">
                                        <label for="">Shift</label>
                                        <div>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label id="lbl-Siang" class="btn btn-outline-primary">
                                                    <input type="radio" name="shift" id="Siang" value="Siang"
                                                        checked="checked" autocomplete="off">
                                                    Siang
                                                </label>
                                                <label id="lbl-Malam" class="btn btn-outline-primary">
                                                    <input type="radio" name="shift" id="Malam" value="Malam"
                                                        autocomplete="off">
                                                    Malam
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="form-group">
                                        <label for="tonase_value">Nilai Tonase</label>
                                        <input onkeyup="fullValue()" type="text" name="tonase_value"
                                            id="tonase_value" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="form-group">
                                        <label for="full_value" class="mr-1">Aktifkan Bonus? </label>
                                        <input type="checkbox" onchange="fullValue()" checked name="isBonusAktive"
                                            class="switch-btn" data-size="small" data-color="#0099ff"
                                            id="isBonusAktive" />
                                        <input type="text" name="tonase_full_value" id="tonase_full_value"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-md-center">
                                <div class="col-3 text-center">
                                    <div class="form-group">
                                        <label class="center">Perusahaan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row justify-content-md-center" id="element-companies">
                                            <input type="hidden" id="hour_meter_price_uuid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-3 text-center">
                                    <div class="form-group">
                                        <h5 class="center">Asal Batu</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" id="coal_from_uuid" name="coal_from_uuid">
                                        <div class="row justify-content-md-center" id="element-coal-from">


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
        <div class="row">
            <div class="col-12">
                <div id="the-table" class="card-box">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Status Absen</h4>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.timbangan').hide();
        let year_month = '';
        let year_month_day = '';
        let nik_employee = '';
        // create 
        let today = @json($today);



        function companies() {
            let companies = @json($companies);
            console.log('companies');
            console.log(companies);
            var i = 0;
            companies.forEach(element => {
                let element_company = `
                                        <div class="col-md-auto">
                                            <div class="custom-control custom-radio mb-5">
                                                <input onchange="chooseCoalFrom('${i}')" type="radio"  id="${element.uuid}" name="company"
                                                    class="custom-control-input" value="${element.uuid}"  />
                                                <label class="custom-control-label" for="${element.uuid}"  >${element.name}</label>
                                            </div>
                                        </div>`;
                $('#element-companies').append(element_company);
                i++;
            });

        }
        companies();

        function chooseCoalFrom(uuid) {
            $("#element-coal-from").empty();
            let companies = @json($companies);
            let coal_from = companies[uuid].coal_from;
            console.log(coal_from);
            coal_from.forEach(element => {
                let element_company = `
                                        <div class="col-md-auto">
                                            <div class="custom-control custom-radio mb-5">
                                                <input onblur="chooseCoalFroms('${element.uuid}')" type="radio"  id="${element.uuid}" name="coal_from"
                                                    class="custom-control-input" value="${element.uuid}"  />
                                                <label class="custom-control-label" for="${element.uuid}"  >${element.coal_from}</label>
                                            </div>
                                        </div>`;
                $('#element-coal-from').append(element_company);
            });
        }


        function chooseCoalFroms(uuid) {
            $('#coal_from_uuid').val(uuid);
        }

        $('#loading').hide();
        function showDataTableUserTonase(url, dataTable, id) {
            $('#tablePrivilege').remove();
            var table_element = ` 
                                        <div class="pb-20" id="tablePrivilege">
                                            <table id="table-tonases" class="display nowrap stripe hover table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Updated</th>
                                                        <th>Name</th>
                                                        <th>Tanggal</th>
                                                        <th>Ton</th>
                                                        <th>Ton + Bonus</th>
                                                        <th>Asal Batu</th>
                                                        <th class="datatable-nosort">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>`;

            $('#the-table').append(table_element);
            let data = [];

            dataTable.forEach(element => {
                var dataElement = {
                    data: element,
                    name: element
                }
                data.push(dataElement)
            });

            var el_1 = {
                mRender: function(data, type, row) {
                    let element_action = '';
                    if (year_month_day != '') {
                        element_action = `
									<div class="form-inline"> 
                                        <a onclick="setNikEmployee('${row.nik_employee}')" href="#">
											<button  type="button" class="btn btn-primary mr-1  py-1 px-2">
												<small>detail</small>
											</button>
										</a>
									</div>`;
                    } else {
                        element_action = `
									<div class="form-inline"> 
										<a onclick="setNikEmployee('${row.nik_employee}')">
											<button  type="button" class="btn btn-primary mr-1  py-1 px-2">
												<small>detail</small>
											</button>
										</a>
									</div>`;
                    }
                    return element_action;
                }
            };
            data.push(el_1)

            $('#' + id).DataTable({
                order: [['0', 'desc']],
                columnDefs: [
                                        { "visible": false, "targets": 0 }
                                    ],
                processing: true,
                serverSide: true,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: {
                    url: '/tonase/data-create',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        year_month: year_month,
                        year_month_day: year_month_day,
                        nik_employee: nik_employee,
                        today: today
                    },
                    type: 'POST',

                },
                success: function(response) {
                    $('#success-modal').modal('show')
					console.log(response)
					// $('#table-'+idForm).DataTable().ajax.reload();
                },
                error: function(response) {
                    alertModal()					
				},
                columns: data
            });
        }

        showDataTableUserTonase('aa', ['updated_at','name','date', 'total_sell', 'total_sells', 'coal_from'], 'table-tonases');

        function store(idForm) {
            console.log(idForm)
            // if(isRequired(['employee_uuid','employee_create_uuid','employee_know_uuid'])    > 0){ return false; }
            var isStored = globalStore(idForm)
            resetData();
            showDataTableUserTonase('aa', ['name','date', 'total_sell', 'total_sells', 'coal_from'], 'table-tonases');
            $('#sa-custom-position').click();
        }

        function getFirst() {
            var employees = @json($employees);
            employees.forEach(element => {
                var elements = `<option value="${element.uuid}">${element.name} - ${element.position}</option>`;
                // console.log(element);
                $('#employee_uuid').append(elements);
                $('#employee_create_uuid').append(elements);
                $('#employee_know_uuid').append(elements);
                $('#employee_approve_uuid').append(elements);
            });
            // console.log(employees)
        }


        function editHm(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/tonase/edit";



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
                    $('#employee_create_uuid').val(data.employee_create_uuid).trigger('change');
                    $('#employee_know_uuid').val(data.employee_know_uuid).trigger('change');
                    $('#employee_approve_uuid').val(data.employee_approve_uuid).trigger('change');
                    $('#full_value').val(data.full_value).trigger('change');
                    $('#' + data.hour_meter_price_uuid).attr('checked', true);
                    $('#' + data.shift).attr('checked', true);
                    $('.btn-outline-primary').attr('class', ' btn btn-outline-primary');
                    $('#lbl-' + data.shift).attr('class', ' btn btn-outline-primary active');
                    $('#value').val(data.value).trigger('change');
                    $('#loading').hide();

                },

                error: function(response) {
                    console.log(response)
                }
            });
        }

        function fullValue() {
            let isBonusAktive = $('#isBonusAktive')[0].checked
            let tonase_full_value
            if (isBonusAktive == true) {
                let value_hm = parseInt($('#tonase_value').val())
                if (value_hm >= 10) {
                    tonase_full_value = value_hm * 0.15
                    tonase_full_value = tonase_full_value + value_hm
                }
                if (value_hm >= 15) {
                    tonase_full_value = value_hm * 0.3 + value_hm
                }
                $('#tonase_full_value').val(tonase_full_value)
                console.log(value_hm)
            } else {
                $('#tonase_full_value').val(parseInt($('#tonase_value').val()))
            }
        }



        function resetData() {
            console.log('resetData')
            $('#uuid').val('')
            $('.btn-outline-primary').attr('class', ' btn btn-outline-primary');
            $('#lbl-Siang').attr('class', ' btn btn-outline-primary active');
            $('#employee_uuid').val('').trigger('change');
        }

       

        $(document).ready(function() {
            // console.log( "ready!" );
            getFirst();
            $('.btn-outline-primary').attr('class', ' btn btn-outline-primary');
            $('#lbl-Siang').attr('class', ' btn btn-outline-primary active');

        });
    </script>
@endsection
