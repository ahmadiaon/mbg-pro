@extends('app.layouts.main')


@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Absensi </h4>
            </div>
            <div class="col text-right">
                <div class="btn-group mb-5">
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
        
        <div class="row col-md-6 col-sm-12">
        </div>  
        
        <div id="the-table" class="row pd-20">
            <div class="col-md-5 card-box pt-10 mb-10">
                <h5 class="mb-20 h5 text-blue">Total Absensi</h5>
                <div class="row mb-3" id="total-absensi">
                    <div class="col-10">
                        <div class="badge badge-primary" role="badge">
                            DS (Day Shift)
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="badge badge-primary" role="badge">
                            <b>10</b>
                        </div>
                    </div>
                    <div class="col-12 mt-1">
                        <div class="progress mb-20" style="height: 6px">
                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <h5 class="mb-20 h5 text-blue">Menu Kehadiran</h5>
                <div class="btn-list mb-20">
                    <button type="button" onclick="ajukanIzin()" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"
                        style="color: rgb(255, 255, 255); background-color: rgb(199, 201, 71);">
                        <i class="icon-copy bi bi-calendar-minus"></i> ajukan izin
                    </button>
                    {{-- <button type="button" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"
                        style="color: rgb(255, 255, 255); background-color: rgb(29, 161, 242);">
                        <i class="icon-copy bi bi-envelope-plus"></i> upload keterangan sakit
                    </button>
                    <button type="button" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"
                        style="color: rgb(255, 255, 255); background-color: rgb(0, 123, 181);">
                        <i class="icon-copy bi bi-calendar2-x-fill"></i> ajukan keterangan bekerja
                    </button>
                    <button type="button" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"
                        style="color: rgb(255, 255, 255); background-color: rgb(244, 111, 48);">
                        <i class="icon-copy bi bi-calendar3-range"></i> ajukan cuti
                    </button> --}}
                </div>

            </div>
            <div class="col-md-7">
                <div class="faq-wrap">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block" data-toggle="collapse"
                                    data-target="#filter-manage-absensi">
                                    Absensi Bulanan
                                </button>
                            </div>
                            <div id="filter-manage-absensi" class="collapse show" data-parent="#accordion">

                                <div class="row pd-20">
                                    <div class="col-6">
                                        <label>Pilih Tampilan</label>
                                    </div>
                                    <div class="col-6 text-right">
                                        <div class="btn-group btn-group-toggle text-left" data-toggle="buttons">
                                            <label class="btn btn-outline-secondary mb-5">
                                                <input type="radio" name="options" id="list" autocomplete="off"
                                                    checked="">
                                                <i class="icon-copy bi bi-list"></i>
                                            </label>
                                            <label class="btn btn-outline-secondary active mb-5">
                                                <input type="radio" name="options" id="grid" autocomplete="off">
                                                <i class="icon-copy bi bi-grid-fill"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div id="display-grid" class="display-grid pd-20" id="tablePrivilege">
                                    <div class="row" id="row-absen">
                                        <div class="col-auto mb-5 card-box pd-2 mr-3">
                                            <div class="form-group">
                                                <label for="">1 sen</label>
                                                <div class=""><button class="btn btn-primary">DS</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="display-list" id="table-list">
                                    <div class="mb-20" id="datatable-data">
                                        <table class="data-table table hover nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="table-plus datatable-nosort">Tanggal</th>
                                                    <th class="table-plus datatable-nosort">Status</th>
                                                    <th class="table-plus datatable-nosort">Fingger</th>
                                                    <th class="table-plus datatable-nosort">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="">
                                                        Senin, 01 Mey 2024
                                                    </td>
                                                    <td class="">
                                                        <div class=""><button class="btn btn-primary">DS</button>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        ['10:10','20:20']
                                                    </td>
                                                    <td class="">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block" data-toggle="collapse"
                                    data-target="#wrap-list-ketidakhadiran">
                                    List Ketidakhadiran
                                </button>
                            </div>
                            <div id="wrap-list-ketidakhadiran" class="collapse show" data-parent="#accordion">
                                <div class="display-list" id="table-list-persetujuan">
                                    <div class="mb-20" id="datatable-data-persetujuan">
                                        <table class="data-table table hover nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="table-plus datatable-nosort">Tanggal</th>
                                                    <th class="table-plus datatable-nosort">Status</th>
                                                </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>

    </div>
    {{-- <button type="hidden" id="sa-custom-position"></button> --}}

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
                    <input class="form-control" name="" disabled id="cek_log-live" cols="10"
                        rows="3">
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

    {{-- modal izin --}}
    <div class="modal fade" id="modal-kehadiran" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Ajukan Izin
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-kehadiran" id="form-kehadiran">


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button id="storeDataKehadiran" type="button" onclick="storeDataTable('KEHADIRAN')"
                        class="btn persetujuan btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script_javascript')
    <script>
        // IZIN
        KONSTANTA['PAGE'] = 'SELF';

        // function pilihJenisIzin(CODE_DATA) {
        //     let propJenisIzin = db['public']['DATABASE-JENIS-IZIN'][CODE_DATA];
        //     if (propJenisIzin['LAMA-IZIN-MAKSIMAL']) {
        //         $('#label-lama-izin').text(`Lama Izin | max. ${propJenisIzin['LAMA-IZIN-MAKSIMAL']}`)
        //     }
        // }
    </script>

    <script>
        let variable_local;
        let data_absensi = null;
        let count_absensi = {};

        function refreshTable(ui_year, ui_month, ui_day) {
            setDateSession(ui_year, ui_month);
            let nrp = ui_dataset.ui_dataset.user_authentication.nik_employee;

            let _token = $('meta[name="csrf-token"]').attr('content');
            $('#row-absen').empty();

            let row_data_datatable = [];
            let header_table_element = '';
            let header_table_field = ['DETAIL'];

            $('#datatable-data').empty();
            $('#datatable-data').append(`
                                        <div class="detail-absensi-${nrp} ">
                                            
                                        </div>
                `);

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

            default_filter_absensi.from = 'EMPLOYEE';
            conLog('default_filter_absensi', default_filter_absensi);

            $.ajax({
                url: '/web/pengelolaan/absensi/getAbsenEmployee',
                type: "POST",
                headers: {
                    'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login,
                },
                data: {
                    _token: _token,
                    default_filter_absensi: default_filter_absensi,
                },
                success: function(response) {
                    conLog('response', response);
                    data_absensi = null;
                    count_absensi = {};

                    detail_absensi = response['data']['data_absensi']
                    data_ketidakhadiran = response['data']['data_ketidakhadiran'];
                    data_data_persetujuan = response['data']['data_persetujuan'];

                    detailAbsensi(nrp);
                    $('#row-absen').append(`
                             <div class="col-12 py-1">
                                <div class="card-box card-box px-2 mb-10">
                                    <div class="form-group mb-10">
                                        <label for="">Tidak ditemukan</label>
                                    </div>
                                </div>
                            </div>`);
                    if (response['data']['data_absensi']) {
                        data_absensi = response['data']['data_absensi'][ui_dataset.ui_dataset
                            .user_authentication.nik_employee
                        ];
                        // conLog('data_absensi', data_absensi)
                        $('#row-absen').empty()
                        if (response['data']['data_absensi'][ui_dataset.ui_dataset.user_authentication
                                .nik_employee
                            ]) {
                            var loop = new Date(default_filter_absensi.date_start);
                            var date_end = new Date(default_filter_absensi.date_end);
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
                    $('#total-absensi').empty();

                    let count_range_date = parseInt(countBetweenDate(new Date(default_filter_absensi
                        .date_start), new Date(
                        default_filter_absensi.date_end)));
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


                    createDatatablePersetujuanAbsen();


                },
                error: function(response) {
                    conLog('response', response)
                    //alertModal()
                }
            });
            stopLoading();
        }


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

    <script>
        $(document).ready(function() {
            $('#display-grid').hide();
            $('#table-list').show();

            $('input[name="options"]').change(function() {
                if ($('#grid').is(':checked')) {
                    $('#display-grid').show();
                    $('#table-list').hide();
                } else if ($('#list').is(':checked')) {
                    $('#display-grid').hide();
                    $('#table-list').show();
                }
            });
            // setUImonthYear()
            refreshTable(ui_dataset.ui_dataset.ui_date.year, ui_dataset.ui_dataset.ui_date.month, ui_dataset
                .ui_dataset.ui_date
                .day);
            // Initialize Select2
            $('.multi-wrap-select').select2({
                width: '100%', // Ensure the select2 takes full width
                templateResult: formatOptionText,
                templateSelection: formatOptionText
            });

            $('.status-absen-filter').select2({
                width: '100%', // Ensure the select2 takes full width
                templateResult: formatOptionText,
                templateSelection: formatOptionText
            });

            // Function to limit text length based on container width
            function formatOptionText(option) {
                if (!option.id) {
                    return option.text;
                }
                let text = option.text;
                let $tempDiv = $('<div>').css({
                    'width': $('.modal-dialog').width(), // use modal's width
                    'font-size': '16px',
                    'line-height': '1.5',
                    'visibility': 'hidden',
                    'white-space': 'nowrap',
                    'position': 'absolute'
                }).text(text).appendTo('body');
                return text;
            }
        });
    </script>
@endsection()
@section('src_javascript')
    <script src="/src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
    <script src="/src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
@endsection()
