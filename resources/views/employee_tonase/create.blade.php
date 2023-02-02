@extends('template.admin.main_privilege')
@section('content')
    <div class="mb-30">
        {{-- form --}}
        <div class="row">
            <div class="col-12">
                <!-- Simple Datatable start -->
                <div class="card-box  mb-30">
                    <form action="/tonase/store" id="form-tonase" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="uuid" id="uuid">
                        <div class="pd-20">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4 class="text-blue h4">Tambah Tonase Karyawan</h4>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group text-right">
                                        <div class="col text-center">
                                            <div class="alert alert-warning" id="isEdit" role="alert">
                                                Edit Mode !
                                            </div>
                                        </div>
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
                                            class="custom-select2 form-control employees">
                                            <option value="">karyawan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_know_uuid">Pilih Foreman</label>
                                        <select name="employee_know_uuid" id="employee_know_uuid"
                                            class="custom-select2 form-control employees">
                                            <option value="">karyawan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_approve_uuid">Pilih Supervisor</label>
                                        <select name="employee_approve_uuid" id="employee_approve_uuid"
                                            class="custom-select2 form-control employees">
                                            <option value="">karyawan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-md-3 timbangan">
                                    <div class="form-group">
                                        <label for="vehicle_uuid">Pilih Unit</label>
                                        <select name="vehicle_uuid" id="vehicle_uuid"
                                            class="unit custom-select2 form-control">
                                            <option value="">Unit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="employee_uuid">Pilih Karyawan</label>
                                        <select onchange="ritBefore()" name="employee_uuid" id="employee_uuid"
                                            class="employees custom-select2 form-control">
                                            <option value="">karyawan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date">Tanggal</label>
                                        <input onchange="ritBefore()" type="date" name="date" id="date"
                                           class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="employee_uuid">Total Rit Sebelum</label>
                                        <input id="rit-before" name="rit-before" type="text" class="form-control "
                                            disabled value="0">
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
                                        <input onchange="fullValue()" type="text"  class="form-control" id="ritase"
                                            name="ritase" value="1">

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
                                        <input onkeyup="fullValue()" type="number" name="tonase_value"
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
                                        <input type="text" name="company_uuid" id="company_uuid">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row justify-content-md-center" id="element-companies">
                                            
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
                                        <input type="text" id="coal_from_uuid" name="coal_from_uuid">
                                        <div class="row justify-content-md-center" id="element-coal-from">


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-auto">
                                    <div class="button-group">
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
                    </form>
                </div>
                <!-- Simple Datatable End -->
            </div>
        </div>
        {{-- end form --}}
        {{-- table tonase --}}
        <div class="row">
            <div class="col-12">
                <div id="the-table" class="card-box">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Data Tonase</h4>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#isEdit').hide();
        $('.timbangan').hide();
        let rit_before = 0;
        let minBonus = [{
                min_ritase: 5,
                percent: 15
            },
            {
                min_ritase: 6,
                percent: 20
            }
        ];

        let year = @json($year);
        let month = @json($month);
        let nik_employee = @json($nik_employee);

        let arr_count_rit_employee = @json($arr_count_rit_employee);
        let employees = @json($employees);
        let arr_company = @json($arr_company);

        
        


        function firstEmployeeTonaseCreate() {
            employees.forEach(element => {
                $('.employees').append(`
                <option value="${element.nik_employee}">${element.name} - ${element.position}</option>
            `)
            });
            $('#element-companies').empty();
            jQuery.each( arr_company, function( i, val ) {
                cg('element', val.detail)
                let element_company = `
                                        <div class="col-md-auto">
                                            <div class="custom-control custom-radio mb-5">
                                                <input onchange="chooseCompany('${val.detail.uuid}')" type="radio"  id="${val.detail.uuid}" name="company"
                                                    class="custom-control-input" value="${val.detail.uuid}"  />
                                                <label class="custom-control-label" for="${val.detail.uuid}"  >${val.detail.company}</label>
                                            </div>
                                        </div>`;
                $('#element-companies').append(element_company);
            }); 
            if(year){
                arr_date_today.year = year
                // cg(year)
            }   
            if(month){
                arr_date_today.month = month
            }
            
            showDataTableUserTonase('aa', ['updated_at', 'name', 'date', 'tonase_value', 'tonase_full_value', 'coal_from'],
            'table-tonase');

        }

        function chooseCompany(company_uuid){
            $('#coal_from_uuid').val('')
            let arr_coal_from = arr_company[company_uuid]['coal_from'];
            $('#company_uuid').val(company_uuid);
            cg('coal arr_coal_from ', arr_coal_from)
            $("#element-coal-from").empty();
            jQuery.each( arr_coal_from, function( i, coal_from ) {
                // cg('coal from', coal_from)
                let element_company = `
                                        <div class="col-md-auto">
                                            <div class="custom-control custom-radio mb-5">
                                                <input onchange="chooseCoalFrom('${coal_from.uuid}')" type="radio"  id="id-coal-${coal_from.uuid}" name="coal_from_uuid"
                                                    class="custom-control-input" value="${coal_from.uuid}"  />
                                                <label class="custom-control-label" for="id-coal-${coal_from.uuid}"  >${coal_from.coal_from}</label>
                                            </div>
                                        </div>`;
                $('#element-coal-from').append(element_company);
                $('#coal_from_uuid').val(coal_from.uuid);
            });
            $(`#id-coal-${company_uuid}`).attr('checked', true);
        }

        function chooseCoalFrom(uuid) {
            $('#coal_from_uuid').val(uuid);
        }

        $('#loading').hide();

        function showDataTableUserTonase(url, dataTable, id) {
            $('#tablePrivilege').remove();
            var table_element = ` 
                                        <div class="pb-20" id="tablePrivilege">
                                            <table id="table-tonase" class="display nowrap stripe hover table" style="width:100%">
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
                    // console.log(row);
                    element_action = `
                                <div class="form-inline"> 
                                    <a onclick="editEmployeeTonase('${row.uuid}')">
                                        <button  type="button" class="btn btn-primary mr-1  py-1 px-2">
                                            <small>${row.uuid}</small>
                                        </button>
                                    </a>
                                </div>`;
                    return element_action;
                }
            };
            data.push(el_1)

            cg('nik_employee',nik_employee)
            $('#' + id).DataTable({
                order: [
                    ['0', 'desc']
                ],
                columnDefs: [{
                    "visible": false,
                    "targets": 0
                }],
                processing: true,
                serverSide: false,
                responsive: true,                
                paging: false,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: {
                    url: '/tonase/data-create',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        month: arr_date_today.month,
                        year: arr_date_today.year,
                        nik_employee: nik_employee,
                    },
                    type: 'POST',

                },
                error: function(response) {
                    alertModal()
                },
                columns: data
            });
        }        
       
        
        function store(idForm) {
            if (isRequiredCreate(['company_uuid']) > 0) {
                return false;
            }
            globalStore(idForm);
 
            $('#sa-custom-position').click();
        }




        function editEmployeeTonase(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/tonase/edit";
            $('#isEdit').show();

            console.log(uuid);
            // return false;
            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    uuid: uuid,
                    _token: _token
                },
                success: function(response) {
                    data = response.data
                    chooseCompany(data.company_uuid)
                    // return false;
                    $('#employee_uuid').val(data.employee_uuid).trigger('change');
                    $('#uuid').val(data.uuid).trigger('change');
                    $('#ritase').val(data.amount_ritase).trigger('change');
                    $('#date').val(data.date).trigger('change');
                    $('#' + data.company_uuid).attr('checked', true);
                    $('#tonase_value').val(data.total_tonase_value);
                    $('#tonase_full_value').val(data.total_tonase_full_value);
                    
                    $('#coal_from_uuid').val(data.coal_from_uuid);
                    $(`#id-coal-${data.coal_from_uuid}`).attr('checked', true);
                },

                error: function(response) {
                    console.log(response)
                }
            });
        }



        function ritBefore() {
            let employee_uuid = $('#employee_uuid').val();
            let date = $('#date').val();
            if (date && employee_uuid) {
                let arr_date = date.split("-");
                rit_before = 0;
                $('#rit-before').val(rit_before)
                // cg('arr_count_rit_employee', 'none')

                if (typeof(arr_count_rit_employee[employee_uuid]) !== 'undefined') {
                    if (typeof(arr_count_rit_employee[employee_uuid][parseInt(arr_date[0])]) !== 'undefined') {
                        if (typeof(arr_count_rit_employee[employee_uuid][parseInt(arr_date[0])][parseInt(arr_date[1])]) !==
                            'undefined') {
                            if (typeof(arr_count_rit_employee[employee_uuid][parseInt(arr_date[0])][parseInt(arr_date[1])][
                                    parseInt(arr_date[2])
                                ]) !== 'undefined') {
                                cg('define ', arr_count_rit_employee[employee_uuid][parseInt(arr_date[0])][parseInt(
                                    arr_date[1])][parseInt(arr_date[2])])
                                rit_before = arr_count_rit_employee[employee_uuid][parseInt(arr_date[0])][parseInt(arr_date[
                                    1])][parseInt(arr_date[2])]
                                $('#rit-before').val(rit_before)
                            }
                        }
                    }
                }
            }
            fullValue()
        }

        function fullValue() {
            rit_before = $('#rit-before').val();
            rit_now = $('#ritase').val();
            let isBonusAktive = $('#isBonusAktive')[0].checked
            let total_rit = parseFloat(rit_before) + parseFloat(rit_now)
            let value_tonase = $('#tonase_value').val()
            $('#tonase_full_value').val(value_tonase)
            // cg('total rit', total_rit);
            if (isBonusAktive == true) {
                minBonus.forEach(role_bonus => {
                    if ((total_rit > role_bonus.min_ritase) && (value_tonase !== '')) {
                        let full_value = parseFloat(value_tonase) + (value_tonase * role_bonus.percent / 100);
                        $('#tonase_full_value').val(full_value)
                    }
                });
            }
        }


        function resetData() {
            console.log('resetData')
            $('#isEdit').hide();
            $('#uuid').val('')
            $('.btn-outline-primary').attr('class', ' btn btn-outline-primary');
            $('#lbl-Siang').attr('class', ' btn btn-outline-primary active');
            $('#employee_uuid').val('').trigger('change');
        }



        $(document).ready(function() {
            // console.log( "ready!" );
            firstEmployeeTonaseCreate();
            $('.btn-outline-primary').attr('class', ' btn btn-outline-primary');
            $('#lbl-Siang').attr('class', ' btn btn-outline-primary active');
        });

    </script>
@endsection
