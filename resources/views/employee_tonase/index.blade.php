@extends('template.admin.main_privilege')
@section('content')
    <div class="mb-30">

        <div class="row">

            {{-- form tonase --}}
            <div class="col-md-7 row ">
                <div class="col-12 mb-1">
                    <form class="mb-20" action="/tonase/store" id="form-tonase" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-box pd-20" id="the-filter-employee-tonase">
                            <h4 class="text-blue h4">Tambah data</h4>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="">Karyawan</label>
                                    <select name="employee_uuid" id="employee_uuid"
                                        class="custom-select2 form-control employees">
                                        <option value="">karyawan</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Tanggal</label>
                                    <input type="date" class="form-control" name="date" id="date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">No tiket</label>
                                    <input type="text" class="form-control" name="tiket_number" id="tiket_number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Tonase</label>
                                    <input type="text" class="form-control" name="tonase_value" id="tonase_value">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Rit</label>
                                    <input type="text" class="form-control" name="ritase" value="1" id="ritase">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3" for="">Perusahaan</label>
    
                                <input type="hidden" id="company_uuid" name="company_uuid">
                                <div class="col-md-9 row" id="companies-form">
    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3" for="">Rute</label>
                                <input type="hidden" id="coal_from_uuid" name="coal_from_uuid">
                                <div class="col-md-9 row" id="element-coal-from">
    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="button" onclick="storeTonase('tonase','')"
                                        class="btn btn-primary text-right">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card-box pd-20 mt-10" id="description-tonase">
                        <h4 class="text-blue h4">Deskripsi</h4>
                        <div class="row  pd-20">
                            <div class="form-group row">
                                <label class="col-6" for="">Total Tonase</label>
                                <input class="form-control col-6" disabled type="text" id="total-tonase" name="" value="4000">                               
                            </div>
                            <div class="form-group row">
                                <label class="col-6" for="">Total Ritase</label>
                                <input class="form-control col-6" disabled type="text" id="total-ritase" name="" value="100">                               
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            {{-- form filter --}}
            <div class="col-md-5 mb-10">
                <div class="card-box pd-20" id="the-filter-employee-tonase">
                    <h4 class="text-blue h4">Filter</h4>
                    <div class="form-group mb-20">
                        <div class="form-group row">
                            <label class="col-auto">Asal Batu</label>
                            <div class="col text-right custom-control custom-checkbox mb-5">
                                <input onchange="checkedAll('coal-from')" type="checkbox" class="custom-control-input"
                                    id="checked-all-coal-from">
                                <label class="custom-control-label" for="checked-all-coal-from">Pilih
                                    Semua</label>
                            </div>
                            <div class="col-auto custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input " id="is_combined" name="is_combined">
                                <label class="custom-control-label" for="is_combined">Gabungkan</label>
                            </div>
                        </div>

                        <div class="row coal-from">

                        </div>
                    </div>
                    <div class="form-group row mb-20">
                        <label class="col-auto" for="">Perusahaan</label>
                        <div class="col text-right custom-control custom-checkbox mb-5">
                            <input onchange="checkedAll('company')" type="checkbox" class="custom-control-input"
                                id="checked-all-company">
                            <label class="custom-control-label" for="checked-all-company">Pilih
                                Semua</label>
                        </div>
                        <div class="col-12 row company-filter">

                        </div>
                    </div>
                    <div class="form-group row mb-5">
                        <label class="col-auto" for="">Site</label>
                        <div class="col text-right custom-control custom-checkbox mb-5">
                            <input onchange="checkedAll('site_uuid')" type="checkbox" class="custom-control-input"
                                id="checked-all-site_uuid">
                            <label class="custom-control-label" for="checked-all-site_uuid">Pilih
                                Semua</label>
                        </div>
                        <div class="col-12 row site-filter">

                        </div>
                    </div>

                    {{-- rentang wAKTU --}}
                    <div class="form-group row">
                        <label class="col-md-12 text-center">Rentang Waktu</label>
                        <div class="col-md-6">
                            <select onchange="loopDateFilter()" style="width: 100%;" name="date_start_filter_tonase"
                                id="date_start_filter_tonase" class="custom-select2 form-control">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select style="width: 100%;" name="date_end_filter_tonase" id="date_end_filter_tonase"
                                class="custom-select2 form-control">
                            </select>
                        </div>
                    </div>

                    <button onclick="onSaveFilter()" type="button" class="col-md-auto btn btn-primary text-rigth">
                        Simpan
                    </button>
                </div>
            </div>

  
            
            <div class="col-12">
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="row justify-content-md-center pd-20">
                        <div class="col-md-2">
                            <h4 class="text-blue h4">Tonase</h4>
                        </div>
                        <div class="col text-right">
                            <div class="btn-group">
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                                        data-toggle="dropdown" aria-expanded="false" id="btn-year">
                                        <span class="caret"></span>
                                    </button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" onclick="refreshTable(2021,null)"
                                            href="#">2021</a>
                                        <a class="dropdown-item" onclick="refreshTable(2022,null)"
                                            href="#">2022</a>
                                        <a class="dropdown-item" onclick="refreshTable(2023,null)"
                                            href="#">2023</a>
                                    </div>
                                </div>
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                                        data-toggle="dropdown" aria-expanded="false" id="btn-month" value="">
                                        <span class="caret"></span>
                                    </button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" onclick="refreshTable(null, 1 )"
                                            href="#">Januari</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 2 )"
                                            href="#">Februari</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 3 )"
                                            href="#">Maret</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 4 )"
                                            href="#">April</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 5 )" href="#">Mei</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 6 )" href="#">Juni</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 7 )" href="#">Juli</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 8 )"
                                            href="#">Agustus</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 9 )"
                                            href="#">September</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 10 )"
                                            href="#">Oktober</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 11 )"
                                            href="#">November</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 12 )"
                                            href="#">Desember</a>
                                    </div>
                                </div>
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                                        data-toggle="dropdown" aria-expanded="false" id="btn-day" value="Perbulan">
                                        <span id="btn-day" class="caret"></span>
                                    </button>

                                    <div class="dropdown-menu">
                                        <a id="each-month" class="dropdown-item" onclick="refreshTable(null, null)"
                                            href="#">Perbulan</a>

                                        <div class="row">
                                            <div class="col-3">
                                                <div class="btn-group-vertical" id="ten-one">
                                                    {{-- tanggal 1- 10 --}}
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="btn-group-vertical" id="ten-two">
                                                    {{-- tanggal 11-20 --}}
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="btn-group-vertical" id="ten-three">
                                                    {{-- tanggal 20-akhir --}}
                                                </div>
                                            </div>
                                        </div>

                                        <label for=""></label>
                                    </div>
                                </div>
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle waves-effect"
                                        data-toggle="dropdown" aria-expanded="false">
                                        Menu <span class="caret"></span>
                                    </button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/tonase/create">Tambah</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#modal-filter">Filter</a>
                                        <a class="dropdown-item" id="btn-template"disabled
                                            href="/user/absensi/export/">Template</a>
                                        <a class="dropdown-item" id="btn-import" data-toggle="modal"
                                            data-target="#import-modal" href="">Import</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="the-table">
                        <div class="pb-20" id="employee-tonase">

                        </div>
                    </div>
                </div>
                <!-- Simple Datatable End -->
            </div>
        </div>

    </div>
    <!-- Simple modal import -->
    <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-import" action="/tonase/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import Tonase</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih Tonase</label>
                            <input name="uploaded_file" type="file"
                                class="form-control-file form-control height-auto" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" onclick="startLoading()" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Simple form tonase-->
    <div class="modal fade" id="modal-form-tonase" role="dialog" aria-labelledby="import-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="/tonase/store" id="form-modal-tonase" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="uuid" id="modal-uuid">
                <input type="text" name="employee_uuid" id="modal-employee_uuid">
                <input type="date" name="date" id="modal-date">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="text-blue h4" id="exampleModalLongTitle">Form tonase</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/tonase/store" id="form-tonase" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">No tiket</label>
                                    <input type="text" class="form-control" name="tiket_number"
                                        id="modal-tiket_number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Tonase</label>
                                    <input type="text" class="form-control" name="tonase_value"
                                        id="modal-tonase_value">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Rit</label>
                                    <input type="text" class="form-control" name="ritase" value="1"
                                        id="modal-ritase">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3" for="">Perusahaan</label>

                                <input type="hidden" id="modal-form-company_uuid" name="company_uuid">
                                <div class="col-md-9 row" id="modal-companies-form">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3" for="">Rute</label>
                                <input type="hidden" id="modal-coal_from_uuid" name="coal_from_uuid">
                                <div class="col-md-9 row" id="modal-element-coal-from">

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" onclick="storeTonase('modal-tonase','modal-')" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
        var end = new Date(arr_date_today.year, arr_date_today.month, 0);
        let nik_employee = @json($nik_employee);
        let arr_coal_from = [];
        let arr_company_uuid = [];
        let is_combined = true;
        let value_checkbox = {
            'company': null,
            'site_uuid': null,
            'coal-from': null
        };
        let old_filter;

        let arr_filter = {
            'company': [],
            'site_uuid': [],
            'coal-from': []
        };
        let filter = {
            'value_checkbox': [],
            'is_combined': is_combined,
            'arr_filter': {
                'company': [],
                'site_uuid': [],
                'coal-from': []
            },
            'date_filter': {
                date_start_filter_tonase: formatDate(start),
                date_end_filter_tonase: formatDate(end),
            },
            nik_employee: nik_employee
        };


        function chooseCoalFrom(uuid,modal) {
            $(`#${modal}coal_from_uuid`).val(uuid);
        }

        function chooseCompany(company_uuid,modal) {
            $(`#${modal}coal_from_uuid`).val('');
            $(`#${modal}element-coal-from`).empty();
            let arr_coal_from = data_database.data_company_obj[company_uuid]['coal_from'];

            cg('arr_coal_from', arr_coal_from);

            Object.values(arr_coal_from).forEach(coal_from_uuid_element => {
                $(`#${modal}element-coal-from`).append(`
                    <div class="col-md-auto">
                        <div class="custom-control custom-radio mb-5">
                            <input onchange="chooseCoalFrom('${coal_from_uuid_element.uuid}','${modal}')" type="radio"  id="${modal}id-coal-${coal_from_uuid_element.uuid}" name="coal_from_uuid"
                                class="custom-control-input" value="${coal_from_uuid_element.uuid}"  />
                            <label class="custom-control-label" for="${modal}id-coal-${coal_from_uuid_element.uuid}"  >${coal_from_uuid_element.coal_from}</label>
                        </div>
                    </div>`);
             
                $(`#${modal}coal_from_uuid`).val(coal_from_uuid_element.uuid);
            });

            $(`#${modal}id-coal-${company_uuid}`).attr('checked', true);
            $(`#${modal}company_uuid`).val(company_uuid);
            return false;
        }

        function storeTonase(idForm,modal) {
            if(!modal){
                if (isRequiredCreate(['date', 'employee_uuid', 'tonase_value']) > 0) {
                    return false;
                }
            }            

            globalStoreNoTable(idForm).then((data_value_) => {
                data_value_element = data_value_.data;

                cg('response', data_value_);
                return false;
                cg('data_value_element',
                    `#${data_value_element.employee_uuid}-${data_value_element.date}-${data_value_element.hour_meter_price_uuid}`
                );
                if (data_value_element) {
                    $(`#${data_value_element.employee_uuid}-${data_value_element.date}-${data_value_element.hour_meter_price_uuid}`)
                        .prepend(`
                        <div class="mb-1 col-md-12 text-center" id="${data_value_element.uuid}">
                             <button onclick="editHM('${data_value_element.employee_uuid}-${data_value_element.date}-${data_value_element.hour_meter_price_uuid}','${data_value_element.value}')" type="button" class="mb-1 btn btn-outline-primary">${data_value_element.value}</button>
                        </div>    
                     `);
                    $('#sa-custom-position').click();
                }
            })

        }


        function loopDateFilter() {
            cg('loopDateFilter', arr_date_today);
            var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
            var end = new Date(arr_date_today.year, arr_date_today.month, 0);
            cg(start, end);

            var loop = new Date(start);

            let date_start_filter_tonase = $('#date_start_filter_tonase').val();
            $(`#date_end_filter_tonase`).empty();
            if (!date_start_filter_tonase) {
                $(`#date_start_filter_tonase`).empty();
            }

            cg('date_start_filter_tonase', date_start_filter_tonase);
            cg('loop', loop)
            var loop_date_start = new Date(date_start_filter_tonase);
            if (loop_date_start) {
                loop_date_start.setDate(loop_date_start.getDate() - 1);
            }
            while (loop <= end) {
                // cg('stert', loop);
                if (date_start_filter_tonase) {
                    if (loop >= loop_date_start) {
                        $(`#date_end_filter_tonase`).prepend(` <option>${formatDate(loop)}</option>`)
                    }
                } else {
                    $(`#date_start_filter_tonase`).append(` <option>${formatDate(loop)}</option>`);
                    $(`#date_end_filter_tonase`).prepend(` <option>${formatDate(loop)}</option>`)
                }
                var newDate = loop.setDate(loop.getDate() + 1);
                loop = new Date(newDate);
            }
            // $('#date_start_filter_tonase').val(formatDate(start));
            $('#date_end_filter_tonase').val(formatDate(end));
        }

        function modalFormTonase(employee_uuid, date, uuid, tiket_number, tonase_value, company_uuid, coal_from_uuid ) {
           if(uuid){
                $(`#modal-uuid`).val(uuid);
                $(`#modal-tonase_value`).val(tonase_value);         
                $(`#modal-tiket_number`).val(tiket_number);    
                $(`#modal-${company_uuid}`).attr('checked', true);  
                chooseCompany(`${company_uuid}`, 'modal-');
                chooseCoalFrom(`${coal_from_uuid}`,'modal-')
           }
            $(`#modal-form-tonase`).modal('show');
            $(`#modal-employee_uuid`).val(employee_uuid);
            $(`#modal-date`).val(date);   
        }


        let year;
        let month;
        let v_year;
        let v_month;
        let _ur;



        function firstEmployeeHourMeter() {
            let arrrr = [];
            Object.values(data_database.data_companies).forEach(company_uuid_element => {
                if (company_uuid_element.uuid != 'MBLE') {
                    $('#companies-form').append(`
                        <div class="col-md-auto">
                            <div class="custom-control custom-radio mb-5">
                                <input onchange="chooseCompany('${company_uuid_element.uuid}','')" type="radio"  id="${company_uuid_element.uuid}" name="company"
                                    class="custom-control-input" value="${company_uuid_element.uuid}"  />
                                <label class="custom-control-label" for="${company_uuid_element.uuid}"  >${company_uuid_element.company}</label>
                            </div>
                        </div>`);

                        $('#modal-companies-form').append(`
                        <div class="col-md-auto">
                            <div class="custom-control custom-radio mb-5">
                                <input onchange="chooseCompany('${company_uuid_element.uuid}','modal-')" type="radio"  id="modal-${company_uuid_element.uuid}" name="company"
                                    class="custom-control-input" value="${company_uuid_element.uuid}"  />
                                <label class="custom-control-label" for="modal-${company_uuid_element.uuid}" >${company_uuid_element.company}</label>
                            </div>
                        </div>`);
                }
                $('.company-filter').append(`
                    <div class="col-auto">
                        <div class="custom-control custom-checkbox mb-5">
                            <input onchange="changeChecked('filter-company-${company_uuid_element.uuid}','${company_uuid_element.uuid}', 'company')" type="checkbox" class="custom-control-input element-company" value="${company_uuid_element.uuid}"
                                id="filter-company-${company_uuid_element.uuid}" name="filter-company-${company_uuid_element.uuid}">
                            <label class="custom-control-label" for="filter-company-${company_uuid_element.uuid}">${company_uuid_element.company}</label>
                        </div>
                    </div>
                `);
                arrrr.push(company_uuid_element.uuid);
            });
            value_checkbox['company'] = arrrr;
            arrrr = [];
            Object.values(data_database.data_employees).forEach(employee_uuid_element => {
                $('.employees').append(`
                    <option value="${employee_uuid_element.nik_employee}">${employee_uuid_element.name} - ${employee_uuid_element.position}</option>
                `);

            });

            Object.values(data_database.data_atribut_sizes.site_uuid).forEach(site_uuid_element => {
                $('.site-filter').append(`
                    <div class="col-auto">
                        <div class="custom-control custom-checkbox mb-5">
                            <input onchange="changeChecked('filter-site_uuid-${site_uuid_element.uuid}','${site_uuid_element.uuid}', 'site_uuid')" type="checkbox" class="custom-control-input element-site_uuid" value="${site_uuid_element.uuid}"
                                id="filter-site_uuid-${site_uuid_element.uuid}" name="filter-site_uuid-${site_uuid_element.uuid}">
                            <label class="custom-control-label" for="filter-site_uuid-${site_uuid_element.uuid}">${site_uuid_element.name_atribut}</label>
                        </div>
                    </div>
                `);
                arrrr.push(site_uuid_element.uuid);
            });
            value_checkbox['site_uuid'] = arrrr;


            
            arrrr = [];
            Object.values(data_database.data_coal_froms).forEach(coal_from_element => {
                $('.coal-from').append(`<div class="col-auto">
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input onchange="changeChecked('filter-coal-from-${coal_from_element.uuid}','${coal_from_element.uuid}', 'coal-from')"  type="checkbox" class="custom-control-input element-coal-from" value="${coal_from_element.uuid}"
                                                            id="filter-coal-from-${coal_from_element.uuid}" name="filter-coal-from-${coal_from_element.uuid}">
                                                        <label class="custom-control-label" for="filter-coal-from-${coal_from_element.uuid}">${coal_from_element.coal_from}</label>
                                                    </div>
                                                </div>`);
                arrrr.push(coal_from_element.uuid);
            });
            value_checkbox['coal-from'] = arrrr;
            filter.value_checkbox = value_checkbox;

            loopDateFilter();

            // showDataTableUserTonase();
            // return false;



            $('#btn-year').html(arr_date_today.year);
            $('#btn-month').val(arr_date_today.month);
            $('#btn-month').html(monthName(arr_date_today.month));
            $('#btn-day').html("Perbulan");
            $('#btn-export').attr('href', '/tonase/export/' + arr_date_today.year + '-' + arr_date_today.month)
            $('#btn-template').attr('href', '/tonase/template/' + arr_date_today.year + '-' + arr_date_today.month)
            setDatesMonth();
            arr_date_today.day = null;


            let element_coal_from = '';


            $('#is_combined').prop('checked', true);
            filter.is_combined = true;

            cg('filter one', filter);
            showDataTableUserTonase();
            // onSaveFilter();
        }

        function checkedAll(name) {
            cg('name', name);
            let isAllChecked = $('#checked-all-' + name)[0].checked;
            if (isAllChecked) {
                arr_filter[name] = value_checkbox[name];
                $('.element-' + name).prop('checked', true);

            } else {
                $('.element-' + name).prop('checked', false);
                arr_filter[name] = [];
            }
            cg('arr_coal_from', arr_filter);
        }

        function changeChecked(idEl_, uuid, name) {
            cg('name', name);
            let value_id = $(`input[type='checkbox'][name='${idEl_}']:checked`).val();
            if (value_id) {
                arr_filter[name].push(value_id);
            } else {
                const index = arr_filter[name].indexOf(uuid);
                const x = arr_filter[name].splice(index, 1);
            }
            cg('arr_filter', arr_filter);
        }


        function onSaveFilter() {
            let isCombined = $('#is_combined')[0].checked;
            // console.log(isAllChecked);
            if (isCombined) {
                is_combined = true;
            } else {
                is_combined = false
            }

            let date_filter = {
                date_start_filter_tonase: $('#date_start_filter_tonase').val(),
                date_end_filter_tonase: $('#date_end_filter_tonase').val(),
            };
            filter.date_filter = date_filter;
            filter.arr_filter = arr_filter;

            filter.is_combined = is_combined;
            showDataTableUserTonase()
        }

        function deleteThisRitase(uuid) {
            $(`#${uuid}`).remove()
        }

        firstEmployeeHourMeter();


        function showDataTableUserTonase() {
            $('#employee-tonase').empty()
            let element_head_coal_from = ``;
            if (!filter.is_combined) {
                element_head_coal_from = `<th>Asal Batu</th>`;
            }

            var start = new Date(filter.date_filter.date_start_filter_tonase);
            var end = new Date(filter.date_filter.date_end_filter_tonase);
            var loop = new Date(start);
            let el_date_header = ``;

            let arr_date = [];
            while (loop <= end) {
                el_date_header = `${el_date_header}<th>${formatDateArr(loop).day}</th>`;
                arr_date.push(formatDate(loop));
                //don't remove it
                var newDate = loop.setDate(loop.getDate() + 1);
                loop = new Date(newDate);
            }


            var table_element = ` 
                                            <table id="table-employee-tonase" class="display nowrap stripe hover table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Detail data karyawan</th>
                                                        <th>Rit</th>
                                                        <th>Ton</th>
                                                        ${element_head_coal_from}                                                      
                                                        ${el_date_header}
                                                    </tr>
                                                </thead>
                                            </table>`;

            $('#employee-tonase').append(table_element);
            cg('filter dekat ajax', arr_filter);





            let data = [];
            data.push(element_profile_employee_session)

            let dataTable = [
                'count_tonase', 'sum_tonase'
            ];

            dataTable.forEach(element => {
                var dataElement = {
                    data: element,
                    name: element
                }
                data.push(dataElement)
            });

            if (!filter.is_combined) {
                var element_date = {
                    mRender: function(data, type, row) {
                        return '-'
                    }
                };
                data.push(element_date);
            }


            arr_date.forEach(element_data => {
                var element_date = {
                    mRender: function(data, type, row) {
                        
                        let element_ton = ``;
                        let el_head = ``;
                        let el_tail = ``;
                        let el_button_new = `
                        <button type="button" onclick="modalFormTonase('${row.employee_uuid}','${element_data}', '','','','','')" class="mt-2 btn btn-light btn-block">
                            tambah <i class="icon-copy bi bi-plus-circle"></i>
                        </button>`;
                        if (row['data'][element_data]) {

                            el_tail = `       
                                        </div>
                                    </div>
                                </div>`;
                            let data_foreach = row['data'][element_data];
                            let sum_date = 0;
                            let count_date = 0;
                            data_foreach.forEach(element => {
                                // cg('element', element);
                                sum_date = parseInt(sum_date) + parseInt(element.tonase_value);
                                count_date++;
                                let tiket_num = '-';
                                if (element.tiket_number) {
                                    tiket_num = element.tiket_number;
                                }
                                element_ton = `${element_ton}

                                    <div class="card mb-1" id="${element.uuid}">
                                        <div  class="card-body mb-0">
                                            <div class="row">
                                                <div onclick="modalFormTonase('${element.employee_uuid}','${element_data}', '${element.uuid}','${element.tiket_number}', '${element.tonase_value}', '${element.company_coal}','${element.coal_from_uuid}')" class="col-3">
                                                    <small class="text-muted">No tiket :</small>                                        
                                                </div>
                                                <div onclick="modalFormTonase('${element.employee_uuid}','${element_data}', '${element.uuid}','${element.tiket_number}', '${element.tonase_value}', '${element.company_coal}','${element.coal_from_uuid}')" class="col col-lg- d-block text-right">
                                                    <p class="">
                                                        ${tiket_num}
                                                    </p>
                                                </div>
                                                <div  data-toggle="tooltip" data-placement="right" title="klik to edit" onclick="modalFormTonase('${element.employee_uuid}','${element_data}', '${element.uuid}','${element.tiket_number}', '${element.tonase_value}', '${element.company_coal}','${element.coal_from_uuid}')" class="col-8 text-center">
                                                    <h5 class="text-blue h4">
                                                        ${element.tonase_value}
                                                    </h5>
                                                </div>
                                                <div class="col-4 text-right">                                        
                                                    <button onclick="deleteThisRitase('${element.uuid}')" class="btn btn-danger btn-sm">
                                                        <i class="icon-copy bi bi-trash3"></i>
                                                    </button>                                        
                                                </div>
                                                <div onclick="modalFormTonase('${element.employee_uuid}','${element_data}', '${element.uuid}','${element.tiket_number}', '${element.tonase_value}', '${element.company_coal}','${element.coal_from_uuid}')" class="col-12">
                                                    <small class="text-muted">${data_database['data_coal_froms'][element.coal_from_uuid]['coal_from']}</small>
                                                </div>
                                            </div>                                
                                        </div>
                                    </div>
                            
                            `;

                            });

                            el_head = `
                            <div class="faq-wrap">
                                <div id="faq-${row.employee_uuid}-${element_data}">
                                   
                                        <div class="card-header mb-2">
                                            <button
                                            style="white-space: nowrap;"
                                                class="btn btn-block collapsed"
                                                data-toggle="collapse"
                                                data-target="#${row.employee_uuid}-${element_data}"
                                            >
                                            ${sum_date} MT / ${count_date} Rit
                                            </button>
                                        </div>
                
                                         <div id="${row.employee_uuid}-${element_data}" class="collapse" data-parent="#faq-${row.employee_uuid}-${element_data}">                                
                                `;

                        }

                        return `
                        ${el_head}
                        ${element_ton}
                        ${el_tail}
                        ${el_button_new}
                        `
                    }
                };
                data.push(element_date);
            });


            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/tonase/data',
                type: "POST",
                data: {
                    _token: _token,
                    filter: filter,
                },
                success: function(response) {
                    cg('response', response)
                    let data_datatable = response.data.datatable;
                    $('#total-ritase').val(response['data']['data_total']['ritase']);
                    $('#total-tonase').val(response['data']['data_total']['tonase']);
                    $('#table-employee-tonase').DataTable({
                        scrollX: true,
                        serverSide: false,
                        data: data_datatable,
                        columns: data
                    });
                },
                error: function(response) {
                    alertModal()
                }
            });

            return false;
        }

        function refreshTable(val_year = null, val_month = null, val_day) {
            console.log('refreshTable');
            year = arr_date_today.year;
            month = arr_date_today.month;

            if (val_year) {
                arr_date_today.year = val_year
                $('#btn-year').html(arr_date_today.year);
            }
            if (val_month) {
                arr_date_today.month = val_month;
                $('#btn-month').html(monthName(arr_date_today.month));
                $('#btn-month').val(arr_date_today.month);
            }

            if (val_day) {
                $('#btn-day').html(val_day);
                arr_date_today.day = val_day;
                showDataTableUserTonase();
                return false;
            }
            $('#btn-template').attr('href', '/tonase/template/' + arr_date_today.year + '-' + arr_date_today.month)
            arr_date_today.day = null;
            $('#btn-day').html("Perbulan");
            $(`#date_start_filter_tonase`).empty();
            $(`#date_start_filter_tonase`).val(null);
            loopDateFilter();
            setDatesMonth();
            onSaveFilter();
            setDateSession(year, month);
        }

        function setDatesMonth() {
            var date = new Date(),
                y = arr_date_today.year,
                m = arr_date_today.month;
            m = m + 1
            var firstDay = new Date(y, m, 1);
            var lastDay = new Date(y, m + 1, 0);
            $('#ten-one').empty();
            $('#ten-two').empty();
            $('#ten-three').empty();
            for (let a = 1; a <= 10; a++) {
                $('#ten-one').append(
                    `<button onclick="refreshTable(null, null, ${a})"  type="button" class="btn btn-sm btn-primary">${a}</button>`
                );
            }
            for (let b = 11; b <= 20; b++) {
                $('#ten-two').append(
                    `<button onclick="refreshTable(null, null, ${b})" type="button" class="btn btn-sm btn-primary">${b}</button>`
                );
            }
            for (let c = 21; c <= lastDay.getDate(); c++) {
                $('#ten-three').append(
                    `<button onclick="refreshTable(null, null, ${c})" type="button" class="btn btn-sm btn-primary">${c}</button>`
                );
            }
        }
    </script>
@endsection
