@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-md-6">
                <h4 class="text-blue h4">Absensi </h4>
            </div>
        </div>
    </div>
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Absensi </h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false" id="btn-year">
                            <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="refreshTable(2021,null)" href="#">2021</a>
                            <a class="dropdown-item" onclick="refreshTable(2022,null)" href="#">2022</a>
                            <a class="dropdown-item" onclick="refreshTable(2023,null)" href="#">2023</a>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false" id="btn-month" value="">
                            <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="refreshTable(null, 1 )" href="#">Januari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 2 )" href="#">Februari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 3 )" href="#">Maret</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 4 )" href="#">April</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 5 )" href="#">Mei</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 6 )" href="#">Juni</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 7 )" href="#">Juli</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 8 )" href="#">Agustus</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 9 )" href="#">September</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 10 )" href="#">Oktober</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 11 )" href="#">November</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 12 )" href="#">Desember</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="the-table">
            <div class="pb-20" id="tablePrivilege">
                <div class="row pd-20" id="row-absen">
                    <div class="col-auto  md-2 card-box pd-2 mr-3">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto md-2 mr-3 card-box">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto  md-2 card-box pd-2 mr-3">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto md-2 mr-3 card-box">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto  md-2 card-box pd-2 mr-3">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto md-2 mr-3 card-box">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto  md-2 card-box pd-2 mr-3">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto md-2 mr-3 card-box">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto  md-2 card-box pd-2 mr-3">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto md-2 mr-3 card-box">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <button type="hidden" id="sa-custom-position"></button>
@endsection

@section('js')
    <script>
        let nik_employee = @json(session('dataUser')->nik_employee);
        var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
        var end = new Date(arr_date_today.year, arr_date_today.month, 0);
        let value_checkbox = {
            'company': null,
            'site_uuid': null,
            'math': null
        };

        let arr_filter = {
            'company': [],
            'site_uuid': [],
            'math': []
        };

        let filter = {
            'value_checkbox': [],
            'is_combined': true,
            'show_type': 'employee',
            'arr_filter': {
                'company': [],
                'site_uuid': [],
                'math': []
            },
            'date_filter': {
                date_start_filter_absen: formatDate(start),
                date_end_filter_absen: formatDate(end),
            },
            nik_employee: nik_employee
        };

        function firstIndexEmployeeAbsen() {
            $('#btn-year').html(arr_date_today.year);
            $('#btn-month').html(months[parseInt(arr_date_today.month)]);
            $('#btn-month').val(arr_date_today.month);

            let arrrr = [];

            Object.values(data_database.data_companies).forEach(company_uuid_element => {
                arrrr.push(company_uuid_element.uuid);
            });
            value_checkbox['company'] = arrrr;

            arrrr = [];
            Object.values(data_database.data_atribut_sizes.site_uuid).forEach(site_uuid_element => {
                arrrr.push(site_uuid_element.uuid);
            });
            value_checkbox['site_uuid'] = arrrr;
            arrrr = [];
            Object.values(data_database.data_math_status_absens).forEach(math_element => {
                arrrr.push(math_element.math);
            });
            arrrr.push('unknown_absen');
            value_checkbox['math'] = arrrr;
            filter.value_checkbox = value_checkbox;


            showDataTable();
        }

        function showDataTable() {



            cg('filter', filter);
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/user/absensi/data-x',
                type: "POST",
                data: {
                    _token: _token,
                    filter: filter
                },
                success: function(response) {
                    data_datatable = response.data.data_filter_math;
                    let data_absensi = data_datatable[nik_employee]['data'];
                    cg('data_absensi', data_absensi);
                    
                    let for_data_datatable = [];
                    Object.values(data_datatable).forEach(element => {
                        for_data_datatable.push(element);
                    });
                    cg('response', response);

                    var start = filter.date_filter.date_start_filter_absen;
                    var end =filter.date_filter.date_end_filter_absen;
                    $('#row-absen').empty();
                    var loop = new Date(start);
                    let el_date_month_header = [];

                    cg(loop, end);
                    let arr_date = [];
                    var date_end = new Date(end);
                    while (loop <= date_end) {
                        let status_absen_code = '?';
                        let color_button_status_absen = 'ligth'

                        // cg('date', formatDate(loop));
                        if(data_absensi[formatDate(loop)]){
                            status_absen_code = data_absensi[formatDate(loop)]['status_absen_code'];
                            color_button_status_absen = color_button[data_absensi[formatDate(loop)]['math']]
                        }
                        $('#row-absen').append(`
                         <div class="col-auto  md-2 card-box pd-2 mr-3">
                            <div class="form-group">
                                <label for="">${loop.getDate()} sen</label>
                                <div class=""><button class="btn btn-${color_button_status_absen}">${status_absen_code}</button></div>
                            </div>
                        </div>`);
                        //don't remove it
                        var newDate = loop.setDate(loop.getDate() + 1);
                        loop = new Date(newDate);
                    }
                    cg('arr_date',arr_date);
                },
                error: function(response) {
                    alertModal()
                }
            });
        }

        function refreshTable(val_year = null, val_month = null) {
            cg('refreshtable', arr_date_today);
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
            let date_filter = {
                date_start_filter_absen: `${arr_date_today.year }-${arr_date_today.month}-${getFirstDate(arr_date_today.year ,arr_date_today.month).getDate()}`,
                date_end_filter_absen: `${arr_date_today.year }-${arr_date_today.month}-${getEndDate(arr_date_today.year ,arr_date_today.month).getDate()}`,
            };

            filter.date_filter = date_filter;

            cg('filter', getFirstDate(arr_date_today.year, arr_date_today.month))
            // return false;
            $('#btn-export-template').attr('href', '/user/absensi/export-template/' + arr_date_today.year + '-' +
                arr_date_today.month)
            $(`#date_start_filter_absen`).empty();
            $(`#date_start_filter_absen`).val(null);

            showDataTable();
            setDateSession(year, month);
        }


        firstIndexEmployeeAbsen();
    </script>
@endsection
