@extends('app.layouts.main')

@section('content')
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
                            <a class="dropdown-item" onclick="refreshTable(2021,null,null)" href="#">2021</a>
                            <a class="dropdown-item" onclick="refreshTable(2022,null,null)" href="#">2022</a>
                            <a class="dropdown-item" onclick="refreshTable(2023,null,null)" href="#">2023</a>
                            <a class="dropdown-item" onclick="refreshTable(2024,null,null)" href="#">2024</a> <a class="dropdown-item" onclick="refreshTable(2025,null,null)" href="#">2025</a>
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

                </div>
            </div>
        </div>
        <div id="the-table" class="row pd-20">
            <div class="col-md-5 card-box pt-10 mb-10">
                <h5 class="mb-20 h5 text-blue">Total Absensi</h5>
                <div class="row mb-3" id="total-absensi">

                </div>

            </div>
        </div>

    </div>
    <button type="hidden" id="sa-custom-position"></button>

    <!-- Modal edit live-->
    <div class="modal fade" id="modal-edit-live" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="name-date">
                        xx
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    {{-- karyawan --}}
                    <input class="form-control" name="" disabled id="cek_log-live" cols="10" rows="3">
                    <div id="button-status_absen">
                        {{-- status absen --}}
                    </div>
                </div>


                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script_javascript')
    <script>
        conLog('ui_dataset', ui_dataset)
        let variable_local;
        let data_absensi = null;
        let count_absensi = {};




        function refreshTable(ui_year, ui_month, ui_day) {
            setUIdate(ui_year, ui_month, ui_day)
            let _token = $('meta[name="csrf-token"]').attr('content');

            let today = new Date()
            let date_start = ui_dataset.ui_dataset.ui_date.year + '-' + ui_dataset.ui_dataset.ui_date.month + '-01';
            let date_end_day = ui_dataset.ui_dataset.ui_date.year + '-' + ui_dataset.ui_dataset.ui_date.month + '-' +
                getEndDate(ui_dataset.ui_dataset.ui_date.year, ui_dataset.ui_dataset.ui_date.month).getDate();

            let date_date_end_day = new Date(date_end_day);

            if (date_date_end_day > today) {
                date_end_day = formatDate(today);
            }

            const startDate = new Date(date_start);
            const endDate = new Date(date_end_day);


            $('#total-absensi').empty();
            let element_detail_absen = '';
            let currentDate = new Date(startDate);
            while (currentDate <= endDate) {
                let date_current = formatDate(currentDate);
                let obj_current_date = getDateObj(currentDate);
                element_detail_absen = `<div id="element_absen-${date_current}" class="col-auto mb-1">
                                                    <div onclick="" style="  background-color: #feec2a"  class="name-avatar d-flex align-items-center pr-2 card-box pl-2">
                                                        <div class="txt text-center">
                                                            <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                                style=" background-color: rgb(231, 235, 245);">${getFirstCharDay(currentDate)} </span>
                                                            <div class="font-14  weight-600">${obj_current_date.day}-${obj_current_date.month}</div>
                                                        </div>
                                                    </div>
                                                </div>`;
                $('#total-absensi').append(element_detail_absen);

                conLogs('date', date_current)

                currentDate.setDate(currentDate.getDate() + 1);
            }
            return false;



            let row_data_datatable = [];
            let header_table_element = '';
            let header_table_field = ['Tanggal', 'Absen', 'Fingger', 'Keterangan'];

            $('#datatable-data').empty();

            // create header table                    
            header_table_field.forEach(element => {
                header_table_element = `${header_table_element} <th> ${element} </th>`
            });
            header_table_element = `                    
                        <table id="table-datatable" class="nowrap stripe hover table" style="width:100%">
                            <thead>
                                <tr>
                                    ${header_table_element}
                                </tr>
                            </thead>
                        </table>
                    `;
            $('#datatable-data').append(header_table_element);

            //add row data datatable
            var employees_card_element = {
                mRender: function(data, type, row) {
                    let value_return;
                    value_return = (data_absensi[row]['date_show']) ? data_absensi[row]['date_show'] : "";
                    return value_return;
                }
            };
            row_data_datatable.push(employees_card_element);
            var employees_card_element = {
                mRender: function(data, type, row) {
                    let status_absen_code = '-';
                    let color_button_status_absen = 'ligth'

                    if (data_absensi[row]) {
                        status_absen_code = data_absensi[row]['status_absen_uuid'];

                    }
                    return `<div class=""><button class="mb-10 btn" style="background-color: ${data_absensi[row]['color']};">${status_absen_code}</button></div>`;
                }
            };
            row_data_datatable.push(employees_card_element);
            var employees_card_element = {
                mRender: function(data, type, row) {
                    let value_return;
                    value_return = (data_absensi[row]['cek_log']) ? data_absensi[row]['cek_log'] : "";
                    return value_return;
                }
            };
            row_data_datatable.push(employees_card_element);
            var employees_card_element = {
                mRender: function(data, type, row) {
                    let value_return;
                    value_return = (data_absensi[row]['absen_description']) ? data_absensi[row][
                        'absen_description'
                    ] : "";
                    return value_return;
                }
            };
            row_data_datatable.push(employees_card_element);

            let data_datatable = [];



            /*
                1. remove table
                2. create table
                3. create data
            */



            $.ajax({
                url: '/api/mbg/absensi',
                type: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login
                    // Add other custom headers if needed
                },
                data: JSON.stringify({
                    _token: _token,
                    date_start: ui_dataset.ui_dataset.ui_date.year + '-' + ui_dataset.ui_dataset.ui_date
                        .month + '-01',
                    date_end: date_end_day,
                }),
                success: function(response) {
                    data_absensi = null;
                    count_absensi = {};
                    $('#row-absen').append(`
                         <div class="col-12 py-1">
                            <div class="card-box card-box px-2 mb-10">
                                <div class="form-group mb-10">
                                    <label for="">Tidak ditemukan</label>
                                </div>
                            </div>
                        </div>`);
                    if (response['data']) {
                        data_absensi = response['data'][ui_dataset.ui_dataset.user_authentication
                            .nik_employee
                        ];
                        conLog('data_absensi', data_absensi)
                        $('#row-absen').empty()
                        if (response['data'][ui_dataset.ui_dataset.user_authentication.nik_employee]) {
                            var loop = new Date(date_start);
                            var date_end = new Date(date_end_day);
                            let cek_logs;
                            while (loop <= date_end) {
                                let status_absen_code = '-';
                                let color_button_status_absen = '';
                                var r = name_days_sort[loop.getDay()];

                                if (!data_absensi[formatDate(loop)]) {
                                    data_absensi[formatDate(loop)] = {
                                        absen_description: "Tidak ada data",
                                        cek_log: "Tidak ada data",
                                        color: null,
                                        date: formatDate(loop),
                                        edited: "",
                                        employee_uuid: "MBLE-0422003",
                                        id: 83573,
                                        math: "",
                                        status_absen_code: "-",
                                        status_absen_description: "Tidak ada data",
                                        status_absen_uuid: "-",
                                    }
                                }
                                status_absen_code = data_absensi[formatDate(loop)]['status_absen_uuid'];

                                color_button_status_absen = db['public']['DATABASE-ABSENSI'][data_absensi[
                                    formatDate(loop)]['status_absen_uuid']]['WARNA-ABSENSI'];

                                data_absensi[formatDate(loop)]['date_show'] =
                                    `${toShortStringDate_fromFormatDate(formatDate(loop))}, ${r}`;
                                data_absensi[formatDate(loop)]['color'] = color_button_status_absen;

                                if (!data_absensi[formatDate(loop)]) {
                                    cek_logs = "kosong";
                                } else {
                                    cek_logs = data_absensi[formatDate(loop)]['cek_log'];
                                }




                                $('#row-absen').append(`
                                    <div class="col-auto py-1">
                                        <div class="card-box card-box px-2 mb-10">
                                            <div class="form-group mb-10">
                                                <label for="">${loop.getDate()} ${r}</label>
                                                <div class=""><button onclick="showCeklog('${formatDate(loop)}')" class="mb-10 btn " style="background-color: ${color_button_status_absen};">${status_absen_code}</button></div>
                                            </div>
                                        </div>
                                    </div>`);


                                if (!count_absensi[status_absen_code]) {
                                    count_absensi[status_absen_code] = 1;
                                } else {
                                    count_absensi[status_absen_code] = count_absensi[status_absen_code] + 1;
                                }
                                data_datatable.push(formatDate(loop));
                                var newDate = loop.setDate(loop.getDate() + 1);
                                loop = new Date(newDate);

                            }


                        }

                    }


                    $('#table-datatable').DataTable({
                        paging: true,
                        responsive: true,
                        serverSide: false,
                        data: data_datatable,
                        columns: row_data_datatable
                    });
                    $('#total-absensi').empty();

                    let count_range_date = parseInt(countBetweenDate(new Date(date_start), new Date(
                        date_end_day)));
                    count_range_date = count_range_date + 1;

                    Object.entries(count_absensi).forEach(([count_index, count_item]) => {

                        const percentage = (count_item / count_range_date) * 100;

                        let elementssss = `
                                <div class="col-10">
                                    <div class="badge" style="background-color: ${db['public']['DATABASE-ABSENSI'][count_index]['WARNA-ABSENSI']};" role="badge">
                                        ${count_index} (${db['public']['DATABASE-ABSENSI'][count_index]['KETERANGAN-ABSEN']})
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="badge" style="background-color: ${db['public']['DATABASE-ABSENSI'][count_index]['WARNA-ABSENSI']};" role="badge">
                                        <b>${count_item}</b>
                                    </div>
                                </div>
                                <div class="col-12 mt-1">
                                    <div class="progress mb-20" style="height: 6px">
                                        <div class="progress-bar" role="progressbar" style="width: ${percentage}%" aria-valuenow="${count_item}"
                                            aria-valuemin="0" aria-valuemax="${count_range_date}"></div>
                                    </div>
                                </div>`;

                        $('#total-absensi').append(elementssss);
                    });

                },
                error: function(response) {
                    conLog('response', response)
                    //alertModal()
                }
            });
        }

        setUImonthYear()
        refreshTable(ui_dataset.ui_dataset.ui_date.year, ui_dataset.ui_dataset.ui_date.month, ui_dataset.ui_dataset
            .ui_date
            .day)


        function showCeklog(date_absen) {
            console.log(variable_local);
            $('#name-date').text(`${date_absen}`);
            if (data_absensi[date_absen]) {
                $('#cek_log-live').val(`${data_absensi[date_absen]['cek_log']}`);
            } else {

                $('#cek_log-live').val(`tidak ada data ceklog`);
            }
            $('#modal-edit-live').modal('show');
        }
    </script>
@endsection()
