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
                                <a class="dropdown-item" href="/hour-meter/create">Tambah</a>
                                <form action="/allowance/data" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="from" value="export">
                                    <input type="hidden" id="export-year_month" name="year_month" value="2022-10">
                                    <button type="submit" class="dropdown-item">Export</button>
                                </form>

                                <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                    href="">Import</a>
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

    <div class="modal fade bs-example-modal-lg" id="modal-description-allowance" tabindex="-1" role="dialog"
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
                            return toValueRupiah(row['allowance']['gajih_pokok']['value']);
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
                        paging: false,
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

            let user_show = dataTaa[uuid]
            $('.employee-description').empty()
            for (var key in user_show) {
                $('.employee-description').append(`
                <dt class="col-sm-3">${user_show[key]['name']}</dt>
                    <dd class="col-sm-3">
                        ${user_show[key]['value']}
                    </dd>
                `)
                console.log(user_show[key]['name']);

                // header_element = `<th>${user_show[key]}</th>`;
                // $('#header-table').append(header_element);
                // arr_identities.push(key);
            }
            $('#modal-description-allowance').modal('show');
            // console.log(user_show)
            // user_show.forEach(element => {
            //     console.log(element)
            // });
        }

        let year_month = @json($year_month);
        let arr_year_month = year_month.split("-")
        let v_year = $('#btn-year').html();
        let v_month = $('#btn-month').val();

        var date = new Date(),
            y = date.getFullYear(),
            m = date.getMonth();
        var lastDay = new Date(y, m + 1, 0);
        let day_month = lastDay.getDate();
        let moreData;
        let hour_meter_prices = @json($hour_meter_prices);
        let companies = @json($companies);
        let premis = @json($premis);
        let dataTaa;





        // refreshTable();


        function showDataTableEmployeeHourMeterMonth(url, dataTable, id) {
            $.ajax({
                url: '/allowance/data',
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    year_month: year_month,
                    from: 'allowance'
                },
                success: function(response) {
                    // $('#success-modal').modal('show')

                    dataTaa = response.message
                    // console.log(dataTaa)
                    // $('#table-'+idForm).DataTable().ajax.reload();
                },
                error: function(response) {
                    alertModal()
                }
            });

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

            console.log('year_month : ' + year_month);

            $('#the-table').append(table_element);
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
            data_column.push(element_profile_employee);

            arr_identities.forEach(element_identity => {
                elements = {
                    mRender: function(data, type, row) {
                        if (row.employee_uuid == 'MBLE-0321100005') {

                            // console.log(row);
                        }
                        return row[element_identity];
                    }
                };
                data_column.push(elements);
            });

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
            data_column.push(elements)



            // return false;


            let urls = '{{ env('APP_URL') }}' + url
            console.log(urls)
            $('#' + id).DataTable({
                scrollX: true,
                scrollY: "400px",
                paging: false,
                // fixedColumns: {
                //     leftColumns: 2
                // },
                serverSide: false,
                ajax: {
                    url: '/allowance/data',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        year_month: year_month,
                        from: 'allowance'
                    },
                    type: 'POST',
                },

                columns: data_column
            });
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

            // showDataTableEmployeeHourMeterMonth('hour-meter/data/2022-04', ['nik_employee', 'name'],
            //     'table-employee-hour-meter')
        }
    </script>
@endsection
