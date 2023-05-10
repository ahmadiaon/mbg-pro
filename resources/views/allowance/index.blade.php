@extends('template.admin.main_privilege')
@section('css')
    <style>
        .DTFC_LeftBodyLiner {
            background: white !important;
            overflow: hidden !important;
        }
    </style>
@endsection

@section('content')
    <div class="mb-20 row">
        {{-- form filter --}}
        <div class="col-md-5 mb-10">
            <div class="card-box pd-20" id="the-filter-employee-tonase">
                <h4 class="text-blue h4">Filter</h4>

                <div class="form-group row mb-20">
                    <label class="col-auto" for="">Perusahaan</label>
                    <div class="col text-right custom-control custom-checkbox mb-5">
                        <input onchange="checkedAll('company')" type="checkbox" class="custom-control-input"
                            id="checked-all-company">
                        <label class="custom-control-label" for="checked-all-company">Pilih
                            Semua</label>
                    </div>
                    <div class="col-12 justify-content-md-center row company-filter">

                    </div>
                </div>

                <div class="form-group row mb-20">
                    <label class="col-auto" for="">Site</label>
                    <div class="col text-right custom-control custom-checkbox mb-5">
                        <input onchange="checkedAll('site_uuid')" type="checkbox" class="custom-control-input"
                            id="checked-all-site_uuid">
                        <label class="custom-control-label" for="checked-all-site_uuid">Pilih
                            Semua</label>
                    </div>
                    <div class="col-12 justify-content-md-center row site-filter">

                    </div>
                </div>
                <button onclick="onSaveFilter()" type="button" class="col-md-auto btn btn-primary text-rigth">
                    Simpan
                </button>
            </div>
        </div>
    </div>

    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Pendapatan Karyawan perbulan</h4>
            </div>
            @if (empty($nik_employee))
                <div class="col text-right">
                    <div class="btn-group">
                        <div class="btn-group dropdown">
                            <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                                data-toggle="dropdown" aria-expanded="false" id="btn-year">
                                <span class="caret"></span>
                            </button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" onclick="refreshTable(2021,null , null)" href="#">2021</a>
                                <a class="dropdown-item" onclick="refreshTable(2022,null , null)" href="#">2022</a>
                                <a class="dropdown-item" onclick="refreshTable(2023,null , null)" href="#">2023</a>
                            </div>
                        </div>
                        <div class="btn-group dropdown">
                            <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                                data-toggle="dropdown" aria-expanded="false" id="btn-month" value="">
                                <span class="caret"></span>
                            </button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" onclick="refreshTable(null, 1, null )" href="#">Januari</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 2, null )" href="#">Februari</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 3, null )" href="#">Maret</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 4, null )" href="#">April</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 5, null )" href="#">Mei</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 6, null )" href="#">Juni</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 7, null )" href="#">Juli</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 8, null )" href="#">Agustus</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 9, null )" href="#">September</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 10, null )" href="#">Oktober</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 11, null )" href="#">November</a>
                                <a class="dropdown-item" onclick="refreshTable(null, 12, null )" href="#">Desember</a>
                            </div>
                        </div>
                        <div class="btn-group dropdown">
                            <button type="date" class="btn btn-primary dropdown-toggle waves-effect"
                                data-toggle="dropdown" aria-expanded="false">
                                Menu <span class="caret"></span>
                            </button>

                            <div class="dropdown-menu">
                          
                                <a class="dropdown-item" id="btn-import" onclick="exportTable()"
                                    href="#">Export</a>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div>

        <div id="the-table">
            <div class="pb-20" id="tablePrivilege">
                <table id="table-employee-hour-meter" class="stripe row-border order-column nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>7</th>
                            <th>8</th>
                            <th>8</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="modal-description-allowance" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        detail pendapatan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <dl class="row employee-description">
                        <dt class="col-sm-3">Description lists</dt>
                        <dd class="col-sm-9">
                            A description list is perfect for defining terms.
                        </dd>

                     
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="modal-description-allowance-base" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        detail pendapatan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <dl class="row employee-description">
                        <dt class="col-sm-3">Description lists</dt>
                        <dd class="col-sm-9">
                            A description list is perfect for defining terms.
                        </dd>

                        <dt class="col-sm-3">Euismod</dt>
                        <dd class="col-sm-9">
                            <p>
                                Vestibulum id ligula porta felis euismod semper eget
                                lacinia odio sem nec elit.
                            </p>
                            <p>Donec id elit non mi porta gravida at eget metus.</p>
                        </dd>

                        <dt class="col-sm-3">Malesuada porta</dt>
                        <dd class="col-sm-9">
                            Etiam porta sem malesuada magna mollis euismod.
                        </dd>

                        <dt class="col-sm-3 text-truncate">
                            Truncated term is truncated
                        </dt>
                        <dd class="col-sm-9">
                            Fusce dapibus, tellus ac cursus commodo, tortor mauris
                            condimentum nibh, ut fermentum massa justo sit amet risus.
                        </dd>

                        <dt class="col-sm-3">Nesting</dt>
                        <dd class="col-sm-9">
                            <dl class="row">
                                <dt class="col-sm-4">Nested definition list</dt>
                                <dd class="col-sm-8">
                                    Aenean posuere, tortor sed cursus feugiat, nunc augue
                                    blandit nunc.
                                </dd>
                            </dl>
                        </dd>
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let data_datable = [];
        
        let dataTaa;
        let database_payrol;
        let value_checkbox = {
            'company': null,
            'site_uuid': null,
        };

        let arr_filter = {
            'company': [],
            'site_uuid': []
        };

        let filter = {
            'value_checkbox': [],
            'arr_filter': {
                'company': [],
                'site_uuid': []
            },
            'date': arr_date_today
        };


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
            filter.arr_filter = arr_filter;
            filter.date = arr_date_today;
            cg('onSaveFilter', filter);
            showTable();
            // showDataTableEmployeePayment()
        }

        function firstIndex() {
            let arrrr = [];
            Object.values(data_database.data_companies).forEach(company_uuid_element => {
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
            filter.value_checkbox = value_checkbox;

            onSaveFilter();
            $('#btn-year').html(arr_date_today.year);
            $('#btn-month').html(months[parseInt(arr_date_today.month)]);
            $('#btn-month').val(arr_date_today.month);
        }

        firstIndex();

        function showTable() {
            $('#tablePrivilege').remove();
            var table_element = ` 
                <div class="pb-20" id="tablePrivilege">
                    <table id="table-employee-hour-meter" class="display nowrap stripe hover table" cellspacing="0" style="width:100%">
                        <thead>
                            <tr id="header-table">
                            
                            </tr>
                        </thead>
                    </table>
                </div>`;


            $('#the-table').append(table_element);
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/allowance/data-filter',
                type: "POST",
                data: {
                    _token: _token,
                    filter: filter
                },
                success: function(response) {
                    cg('response', response)
                    let data_datable_O = response.data.employee_this_month_uuid;
                    dataTaa = data_datable_O;
                    database_payrol = response.data.database_payrol;
                    data_datable = [];
                    Object.values(data_datable_O).forEach(element => {
                        data_datable.push(element);
                    });

                    let data_column = [];

                    let identities = {
                        date_start_contract: 'TMK',
                        salary_netto_adjust: 'Gajih Bersih',
                    };

                    let header_element = '';
                    let elements = '';

                    let arr_identities = [];
                    $('#header-table').append(`<th>Karyawan</th>`);
                    for (var key in identities) {
                        header_element = `<th>${identities[key]}</th>`;
                        $('#header-table').append(header_element);
                        arr_identities.push(key);
                    }
                    $('#header-table').append(`<th>Action</th>`);
                    // return false;
                    data_column.push(element_profile_employee_database_payrol);

                    let el_table = {
                        mRender: function(data, type, row) {
                            return row.date_start_contract;
                        }
                    };
                    data_column.push(el_table);

                    el_table = {
                        mRender: function(data, type, row) {
                            return toValueRupiah(row['item_payrol']['gajih_bersih']);
                        }
                    };
                    data_column.push(el_table);

                    elements = {
                        mRender: function(data, type, row) {
                            return `
                                <div class="form-inline"> 
                                    <button onclick="modalDescription('${row.nik_employee}')" type="button" class="btn btn-secondary mr-1  py-1 px-2">
                                        <i class="icon-copy ion-gear-b"></i>
                                    </button>
                                </div>`
                        }
                    };
                    data_column.push(elements);

                    $('#table-employee-hour-meter').DataTable({
                        scrollX: true,
                        scrollY: "600px",
                        paging: true,
                        // fixedColumns: {
                        //     leftColumns: 2
                        // },
                        serverSide: false,
                        data: data_datable,
                        columns: data_column
                    });


                },
                error: function(response) {
                    // alertModal()
                }
            });
        }

        let data_user = [];

        function modalDescription(uuid) {

            let user_show = dataTaa[uuid]['item_payrol'];
            cg('user_show',user_show);
            $('.employee-description').empty()
            $('.employee-description').append(`
                <div class="col-sm-6" id="item_detail_karyawan">
                    <dt class="col-sm-12 text-center">IDENTITAS</dt>
                </div>`);

            let item_detail_karyawan = database_payrol['item_detail_karyawan'];
            
            item_detail_karyawan.forEach(element => {
                if(user_show[element]){
                    $('#item_detail_karyawan').append(`
                    <div class="col-sm-12 row">
                        <dt class="col-6">${element}</dt>
                            <dd class="col-6">
                                ${user_show[element]}
                            </dd>
                    </div>
                    `)
                }                
            });
            $('.employee-description').append(`
                <div class="col-6 row" id="detail_payrol">
                   
                </div>`);

            $('#detail_payrol').append(`
                <div class="col-12 faq-wrap" >
                    <h5 class="mb-20 h5 text-blue">Total Dibayar Rp. ${toValueRupiah(user_show['gajih_bersih'])}</h5>
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block" data-toggle="collapse" data-target="#item_pendapatan_kotor">
                                    GAJIH KOTOR
                                </button>
                            </div>
                            <div class="collapse show" data-parent="#accordion">
                                <div  id="item_pendapatan_kotor" class="card-body row">
                                
                                </div>
                                <footer class="blockquote-footer mb-5 ml-10">
									<b>${toValueRupiah(user_show['gajih_kotor'])}</b>
								</footer>
                            </div>
                        </div>

                      
                    </div>
                </div>               
                `);

            let arr_gajih_kotor = database_payrol['item_pendapatan_kotor'];
            
            arr_gajih_kotor.forEach(element => {
                if(user_show[element]){
                    $('#item_pendapatan_kotor').append(`
                    <div class="col-md-12 row">
                        <dt class="col-6">${element}</dt>
                            <dd class="col-6">
                                ${toValueRupiah(user_show[element])}
                            </dd>
                    </div>
                    `)
                }                
            });

            

            if(user_show['pengurang_pendapatan'] > 0){
                $('#accordion').append(
                    `
                    <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block" data-toggle="collapse" data-target="#item_pengurang_pendapatan">
                                    PENGURANG PENDAPATAN
                                </button>
                            </div>
                            <div class="collapse show" data-parent="#accordion">
                                <div  id="item_pengurang_pendapatan" class="card-body row">
                                
                                </div>
                                <footer class="blockquote-footer mb-5 ml-10">
									<b>${toValueRupiah(user_show['pengurang_pendapatan'])}</b>
								</footer>
                            </div>
                        </div>
                    `
                );
                let item_pengurang_pendapatan = database_payrol['item_pengurang_pendapatan'];
   
                item_pengurang_pendapatan.forEach(element => {
                    if(user_show[element]){
                        $('#item_pengurang_pendapatan').append(`
                        <div class="col-md-12 row">
                            <dt class="col-7">${element}</dt>
                                <dd class="col-5">
                                    ${toValueRupiah(user_show[element])}
                                </dd>
                        </div>
                        `)
                    }                
                });
            }

            if(user_show['premi'] > 0){
                $('#accordion').append(
                    `
                    <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block" data-toggle="collapse" data-target="#pay_premies">
                                    Detail Premi
                                </button>
                            </div>
                            <div class="collapse show" data-parent="#accordion">
                                <div  id="pay_premies" class="card-body row">
                                
                                </div>
                                <footer class="blockquote-footer mb-5 ml-10">
									<b>${toValueRupiah(user_show['premi'])}</b>
								</footer>
                            </div>
                        </div>
                    `
                );
                let pay_premies = database_payrol['pay_premies'];
   
                pay_premies.forEach(element => {
                    if(user_show[element]){
                        $('#pay_premies').append(`
                        <div class="col-md-12 row">
                            <dt class="col-6">${element}</dt>
                                <dd class="col-6">
                                    ${toValueRupiah(user_show[element])}
                                </dd>
                        </div>
                        `)
                    }                
                });
            }

            if(user_show['hour_meter'] > 0){
                $('#accordion').append(
                    `
                    <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block" data-toggle="collapse" data-target="#hour_meter_item">
                                    Detail HM
                                </button>
                            </div>
                            <div class="collapse show" data-parent="#accordion">
                                <div  id="hour_meter_item" class="card-body row">
                                
                                </div>
                                <footer class="blockquote-footer mb-5 ml-10">
									<b>${toValueRupiah(user_show['hour_meter'])}</b>
								</footer>
                            </div>
                        </div>
                    `
                );
                let hour_meter_item = database_payrol['hour_meter_item'];
                        cg('hour_meter_item', user_show);
                hour_meter_item.forEach(element => {
                    if(user_show['hour_'+element]){
                        $('#hour_meter_item').append(`
                        <div class="col-md-12 row">
                            <dt class="col-6">${toValueRupiah(element)} X ${user_show['hour_'+element]} </dt>
                                <dd class="col-6">
                                    Total HM ${toValueRupiah(user_show['pay_'+element])}
                                </dd>
                        </div>
                        `)
                    }                
                });
            }
            
            if(user_show['tonase'] > 0){
                $('#accordion').append(
                    `
                    <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block" data-toggle="collapse" data-target="#rute_hauling">
                                    Hauling
                                </button>
                            </div>
                            <div class="collapse show" data-parent="#accordion">
                                <div  id="rute_hauling" class="card-body row">
                                
                                </div>
                                <footer class="blockquote-footer mb-5 ml-10">
									<b>${toValueRupiah(user_show['tonase'])}</b>
								</footer>
                            </div>
                        </div>
                    `
                );
                let rute_hauling = database_payrol['rute_hauling'];
                        cg('rute_hauling', user_show);
                rute_hauling.forEach(element => {
                    cg('rute_hauling', element);
                    if(user_show['much_'+element]){
                        $('#rute_hauling').append(`
                        <div class="col-md-12 row">
                            <dt class="col-6">Rute ${database_payrol['name_rute_hauling_'+element]} : ${user_show['much_'+element]} MT </dt>
                                <dd class="col-4">
                                    ${toValueRupiah(user_show['pay_'+element])}
                                </dd>
                        </div>
                        `)
                    }                
                });
            }
            cg('xxxxx', dataTaa[user_show['nik_employee']]);

         
            
            // for (var key in user_show) {
            //     // cg('key',key);
            //     $('.employee-description').append(`
            //     <dt class="col-sm-3">${key}</dt>
            //         <dd class="col-sm-3">
            //             ${user_show[key]}
            //         </dd>
            //     `)
            // }
            $('#modal-description-allowance').modal('show');
        }

        function refreshTable(val_year = null, val_month = null) {
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
            onSaveFilter();
            setDateSession(year, month);
        }

        function exportTable() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            cg('data_datable', data_datable);
            let data_ex = JSON.stringify(data_datable);
            $.ajax({
                url: '/allowance/export',
                type: "POST",
                data: {
                    _token: _token,
                    data_export: data_ex,
                },
                success: function(response) {
                    cg('response', response);
                    var dlink = document.createElement("a");
                    dlink.href = `/${response.data}`;
                    dlink.setAttribute("download", "");
                    dlink.click();
                },
                error: function(response) {
                    alertModal()
                }
            });
        }

    </script>
@endsection
