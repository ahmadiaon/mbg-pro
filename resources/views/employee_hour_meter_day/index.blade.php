@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">HM karywan</h4>
                @if (session()->has('messageErr'))
                    <p>Error</p>
                @endif
            </div>

            <div class="col text-right">

                <div class="btn-group">
                    <button onclick="openModalFilter()" class="btn btn-success">Filter</button>
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false" id="btn-year">
                            <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="refreshTable(2021,null , null)" href="#">2021</a>
                            <a class="dropdown-item" onclick="refreshTable(2022,null , null)" href="#">2022</a>
                            <a class="dropdown-item" onclick="refreshTable(2023,null , null)" href="#">2023</a>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false" id="btn-month" value="">
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


                    @if (empty($nik_employee))
                        <div class="btn-group dropdown">
                            <button type="date" class="btn btn-primary dropdown-toggle waves-effect"
                                data-toggle="dropdown" aria-expanded="false">
                                Menu <span class="caret"></span>
                            </button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/hour-meter/create">Tambah</a>
                                <a class="dropdown-item" id="btn-export"disabled href="/user/absensi/export/">Export</a>
                                <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                    href="">Import</a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
        <div id="the-table">
            <div class="pb-20" id="employee-hour-meter-day">
                <table id="table-employee-hour-meter" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jumlah Slip</th>
                            <th>Total HM</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Simple Datatable End -->
    <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-import" action="/hour-meter/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import Absensi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih Absensi</label>
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

    <!-- Modal filter-->
    <div class="modal fade customscroll" id="modal-filter" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Filter Data
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="bottom" title="" data-original-title="Close Modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-0">
                    <form>
                        <div class="task-list-form">
                            <ul>
                                <li>
                                    <div class="form-group row">
                                        <label class="col-md-4">Asal Site</label>
                                        <div class="col-md-8 ">
                                            <div class="row site_uuid">
                                                <div class="col-12">
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input onchange="checkedAllCoalFrom()" type="checkbox"
                                                            class="custom-control-input" id="checked-all-site_uuid">
                                                        <label class="custom-control-label"
                                                            for="checked-all-site_uuid">Pilih
                                                            Semua</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- rentang waktu --}}
                                    <div class="form-group row">
                                        <label class="col-md-12 text-center">Rentang Waktu</label>
                                        <div class="col-md-6">
                                            <select onchange="loopDateFilter()" style="width: 100%;"
                                                name="date_start_filter_hm" id="date_start_filter_hm"
                                                class="custom-select2 form-control">
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select style="width: 100%;" name="date_end_filter_hm"
                                                id="date_end_filter_hm" class="custom-select2 form-control">
                                            </select>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button onclick="onSaveFilter()" data-dismiss="modal" type="button" class="btn btn-primary">
                        Simpan
                    </button>
                    <button on type="button" class="btn btn-secondary" data-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
        var end = new Date(arr_date_today.year, arr_date_today.month, 0);
        let nik_employee = @json(session('dataUser')->nik_employee);
        let data_show_type = 'real';
        let data_datable = [];
        let filter = {
            arr_site_uuid: null,
            data_show_type: data_show_type,
            date_filter: {
                date_start_filter_hm: formatDate(start),
                date_end_filter_hm: formatDate(end),
            },
            nik_employee: nik_employee
        };


        let year;
        let month;

        var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
        var end = new Date(arr_date_today.year, arr_date_today.month, 0);

        function openModalFilter() {
            $('#modal-filter').modal('show');
        }

        function checkedAllCoalFrom() {
            let isAllChecked = $('#checked-all-site_uuid')[0].checked;
            // console.log(isAllChecked);
            if (isAllChecked) {
                $('.element-site_uuid').prop('checked', true);
            } else {
                $('.element-site_uuid').prop('checked', false);
            }
            setFilterChecked()
        }

        function setFilterChecked() {
            var checkedValue = $('.element-site_uuid:checked').val();
            let arr_site_uuid = [];
            Object.values(data_database.data_atribut_sizes.site_uuid).forEach(site_uuid_element => {
                var checkedValue = $(`#${site_uuid_element.uuid}:checked`).val();
                if (checkedValue) {
                    arr_site_uuid.push(checkedValue)
                }
            });
            filter.arr_site_uuid = arr_site_uuid;
        }

        function onSaveFilter() {
            let date_filter = {
                date_start_filter_hm: $('#date_start_filter_hm').val(),
                date_end_filter_hm: $('#date_end_filter_hm').val(),
            };
            filter.date_filter = date_filter;
            cg('filter', filter);
            showDataTableEmployeeHourMeteDay();
        }

        function loopDateFilter() {
            cg('loopDateFilter', arr_date_today);
            var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
            var end = new Date(arr_date_today.year, arr_date_today.month, 0);
            cg(start, end);

            var loop = new Date(start);

            let date_start_filter_hm = $('#date_start_filter_hm').val();
            $(`#date_end_filter_hm`).empty();
            $(`#date_start_filter_hm`).empty();

            cg('date_start_filter_hm', date_start_filter_hm);
            cg('loop', loop)
            while (loop <= end) {
                // cg('stert', loop);
                if (date_start_filter_hm) {
                    var loop_date_start = new Date(date_start_filter_hm);
                    if (loop >= loop_date_start) {
                        $(`#date_end_filter_hm`).prepend(` <option>${formatDate(loop)}</option>`)
                    }
                } else {
                    $(`#date_start_filter_hm`).append(` <option>${formatDate(loop)}</option>`);
                    $(`#date_end_filter_hm`).prepend(` <option>${formatDate(loop)}</option>`)
                }

                var newDate = loop.setDate(loop.getDate() + 1);
                loop = new Date(newDate);
            }
            $('#date_end_filter_hm').val(formatDate(end));
        }


        function firstEmployeeHourMeter() {
            Object.values(data_database.data_atribut_sizes.site_uuid).forEach(site_uuid_element => {
                $('.site_uuid').append(`<div class="col-auto">
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input onchange="setFilterChecked()" type="checkbox" class="custom-control-input element-site_uuid" value="${site_uuid_element.uuid}"
                                                            id="${site_uuid_element.uuid}" name="${site_uuid_element.name_atribut}">
                                                        <label class="custom-control-label" for="${site_uuid_element.uuid}">${site_uuid_element.name_atribut}</label>
                                                    </div>
                                                </div>`);
            });
            loopDateFilter();
            year = arr_date_today.year;
            month = arr_date_today.month;

            $('#btn-year').html(arr_date_today.year);
            $('#btn-month').val(arr_date_today.month);
            $('#btn-month').html(monthName(arr_date_today.month));
            showDataTableEmployeeHourMeteDay()
        }
        firstEmployeeHourMeter()

        function showDataTableEmployeeHourMeteDay() {
            $('#employee-hour-meter-day').empty()

            let for_nik_employee = `<th>Action</th>`;
            if (!dataUser.create_employee_hour_meter) {
                for_nik_employee = '';
            }
            $('#employee-hour-meter-day').append(`
            <table id="table-employee-hour-meter" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Karyawan</th>
                            <th>Jumlah Slip</th>
                            <th>Total HM</th>
                            <th>Total HM Bonus</th>
                        </tr>
                    </thead>
                </table>
            `);


            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/hour-meter/data',
                type: "POST",
                data: {
                    _token: _token,
                    filter: filter
                },
                success: function(response) {
                    cg('response', response);
                    let data_datable_obj = response.data.datatable;
                    data_datable = [];
                    let hm_price = null;
                    let data = [];

                    data.push(element_profile_employee_session);
                    let dataTable = [
                        'count_slip_hm', 'sum_hm', 'sum_hm_bonus'
                    ];

                    dataTable.forEach(element => {
                        var dataElement = {
                            data: element,
                            name: element
                        }
                        data.push(dataElement)
                    });
                    cg('datatable', response);

                    if (data_datable_obj) {
                        Object.values(data_datable_obj).forEach(element_data_datable_obj => {
                            data_datable.push(element_data_datable_obj);
                        });
                    }
                    cg('datatable', data_datable);
                    $('#table-employee-hour-meter').DataTable({
                        scrollX: true,
                        serverSide: false,
                        data: data_datable,
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
            $('#btn-export').attr('href', '/hour-meter/export');
            arr_date_today.day = null;

            setDateSession(year, month);

            cg('refreshTable', arr_date_today);
            $('#date_start_filter_hm').val(null);
            loopDateFilter();
            onSaveFilter()
        }
    </script>
@endsection
