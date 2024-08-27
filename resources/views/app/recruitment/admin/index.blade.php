@extends('app.layouts.main')

@section('src_css')
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 80px;
            height: 80px;
            animation: spin 2s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection


@section('content')
    <div class="faq-wrap">
        <h4 class="mb-20 h4 text-blue">Recruitment</h4>
        <div id="accordion">

            <div class="card">
                <div class="card-header">
                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#data-table-manage-absensi">
                        Data Recruitment
                    </button>
                </div>

                <div id="data-table-manage-absensi" class="collapse show" data-parent="#accordion">

                    <div class="">
                        <div class="row pd-20">
                            <div class="col-auto">
                                <h4 class="text-blue h4">Recruitment</h4>
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
                                            <a class="dropdown-item" onclick="refreshTable(2024,null)"
                                                href="#">2024</a>
                                        </div>
                                    </div>
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                                            data-toggle="dropdown" aria-expanded="false" id="btn-month" value="">
                                            <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" onclick="refreshTable(null, 01 )"
                                                href="#">Januari</a>
                                            <a class="dropdown-item" onclick="refreshTable(null, 02 )"
                                                href="#">Februari</a>
                                            <a class="dropdown-item" onclick="refreshTable(null, 03 )"
                                                href="#">Maret</a>
                                            <a class="dropdown-item" onclick="refreshTable(null, 04 )"
                                                href="#">April</a>
                                            <a class="dropdown-item" onclick="refreshTable(null, 05 )"
                                                href="#">Mei</a>
                                            <a class="dropdown-item" onclick="refreshTable(null, 06 )"
                                                href="#">Juni</a>
                                            <a class="dropdown-item" onclick="refreshTable(null, 07 )"
                                                href="#">Juli</a>
                                            <a class="dropdown-item" onclick="refreshTable(null, 08 )"
                                                href="#">Agustus</a>
                                            <a class="dropdown-item" onclick="refreshTable(null, 09 )"
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

                                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect"
                                            data-toggle="dropdown" aria-expanded="false">
                                            Menu <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" id="btn-absen" href="#"
                                                onclick="openModalAbsen()">Ketidakhadiran</a>
                                            <a class="dropdown-item" onclick="exportAbsen()" id="btn-export"
                                                href="#">Export +
                                                Data</a>
                                            <a class="dropdown-item" onclick="openModalExportDialy()" id="btn-export-dialy"
                                                href="#">Dialy
                                                Report</a>
                                            <a class="dropdown-item" onclick="reportOpenModalReportStatusAbsen()"
                                                id="btn-export-dialy" href="#">Lap. Tidak Hadir</a>
                                            <a class="dropdown-item" onclick="reportExportInOut()" id="btn-export-in-out"
                                                href="#">Lap. Tidak Hadir In Out</a>
                                            {{-- <a class="dropdown-item" id="btn-export-dialy" href="/user/absensi/dialy-report">Dialy
                                                Report</a> --}}
                                            <a class="dropdown-item" id="btn-export-template"
                                                href="/user/absensi/export-template/">Export
                                                Template</a>
                                            <a class="dropdown-item" id="btn-import" data-toggle="modal"
                                                data-target="#import-modal" href="">Import</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="mb-20" id="datatable-data">
                            <table id="table-datatable-data" class="display nowrap stripe hover table"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort">Tanggal</th>
                                        <th>Nama Lengkap</th>
                                        <th>Posisi</th>
                                        <th>Provinsi</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2024-05-15</td>
                                        <td class="table-plus">Gloria F. Mead</td>
                                        <td>HR Manager</td>
                                        <td>Kalimantan Tengah</td>
                                        <td><span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">Melamar</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline btn-secondary">
                                                <i class="icon-copy bi bi-filetype-pdf"></i>
                                            </button>
                                            <button class="btn btn-outline btn-primary">
                                                <i class="icon-copy bi bi-gear"></i>
                                            </button>
                                            <button class="btn btn-outline btn-success">
                                                <i class="icon-copy bi bi-telephone-forward-fill"></i>
                                            </button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>


    <div id="pdfModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PDF Viewer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="loader" class="loader"></div>
                    <iframe id="pdfViewer" style="display:none;" width="100%" height="500px"></iframe>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="small-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Tindak Lanjut Lamaran
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Silahkan pilih tindak lanjut lamaran ini. 
                    </p>
                    <input type="hidden" name="id_recruitment" id="id_recruitment">
                </div>
                <div class="modal-footer text-center">
                    <div class="btn-list ">
                        <button onclick="updateRecruitment('Disimpan')" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);">
                            <i class="icon-copy bi bi-file-earmark-check"></i> Simpan
                        </button>
                        <button type="button" onclick="updateRecruitment('Ditolak')"  class="btn" data-bgcolor="#bd081c" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(189, 8, 28);">
                            <i class="icon-copy bi bi-file-earmark-excel"></i> Tolak
                        </button>
                        <button data-dismiss="modal" type="button" class="btn" data-bgcolor="#00b489" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 180, 137);">
                            <i class="icon-copy bi bi-x-lg"></i> close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script_javascript')
    <script>
        let detail_absensi;
        let value_checkbox = {
            'company': null,
            'site_uuid': null,
            'math': null
        };

        $('#FILTER-RANGE').val(setRangeDate(formatDate(start), formatDate(end))).trigger(
            'change');

        let arr_filter = {
            'company': [],
            'site_uuid': [],
            'math': []
        };

        let database_datatable = {};
        database_datatable['show-fields'] = [
            // {
            //     'code_field': "NRP",
            //     'code_table_field': "KARYAWAN",
            //     'description_field': "NRP",
            //     'full_code_field': 'KARYAWAN-NRP',
            //     'tipe_data_field': "TEXT"
            // },
            {
                'code_field': "COUNT_ABSEN",
                'code_table_field': "ABSENSI",
                'description_field': "Total Absesnsi",
                'full_code_field': 'ABSENSI-COUNT_ABSEN',
                'tipe_data_field': "ABSENSI_COUNT"
            },
            // {
            //     'code_field': "DETAIL_ABSENSI",
            //     'code_table_field': "ABSENSI",
            //     'description_field': "Detail Absen",
            //     'full_code_field': 'ABSENSI-DETAIL_ABSENSI',
            //     'tipe_data_field': "DETAIL_ABSENSI"
            // },
        ];
        conLog('ui_dataset', ui_dataset);
        conLog('filter_absensi', filter_absensi);

        let year;
        let month;
        let dt_end;
        let dt_start;
        let data_datatable;
        let data_response;
        let after_import_data;

        year = arr_date_today.year;
        month = arr_date_today.month;

        $('.date-setup').attr('hidden', false);
        $('#btn-year').html(arr_date_today.year);
        $('#btn-month').html(months[parseInt(arr_date_today.month)]);
        $('#btn-month').val(arr_date_today.month);
        $('#btn-export-template').attr('href', '/user/absensi/export-template/' + arr_date_today.year + '-' +
            arr_date_today.month);

        Object.entries(db['public']['DATABASE-ABSENSI']).forEach(([key, values]) => {
            $(`#button-status_absen_uuid`).append(`
                    <button onclick="storeUpdateAbsenDay('${key}')" style="background-color: ${db['public']['DATABASE-ABSENSI'][key]['WARNA-ABSENSI']}" class="btn mr-2 mb-2">${key}</button>
                `);
        });

        let arr_site_uuid = [];
        let arr_status_absen = [];


        function getDataAbsensi() {
            let date_range = $('#FILTER-RANGE').val();
            let split_date_range = date_range.split(" - ");
            filter_absensi.date_start = formatDate(parseDateString(split_date_range[0], 'mm/dd/yyyy'));
            filter_absensi.date_end = formatDate(parseDateString(split_date_range[1], 'mm/dd/yyyy'));
            setLocalStorage('filter_absen', filter_absensi);
            conLog('filter_absensi', filter_absensi);
            conLog('default_filter_absensi', default_filter_absensi);
            getWithNewData();
            // if (parseDateString(split_date_range[0], 'mm/dd/yyyy') < start || parseDateString(split_date_range[1],
            //         'mm/dd/yyyy') > end) {
            //     conLog('lewat', 'lewat')

            // } else {
            //     conLog('belum lewat', 'belum lewat')
            //     refreshTableData();
            // }
        }

        function getWithNewData() {
            $.ajax({
                url: '/api/recruitment/get',
                type: "POST",
                headers: {
                    'X-auth_login': ui_dataset.ui_dataset.user_authentication.auth_login
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    conLog('response', response);
                    let data_database_recruitments = response.data;

                    let row_data_datatable = [];
                    conLog('database_datatable', ui_dataset);
                    let header_table_element = '';

                    var element_card_tanggal = {
                        mRender: function(data, type, row) {
                            if (data_database_recruitments[row]['time_propose']) {
                                return data_database_recruitments[row]['time_propose'];
                            }
                            return '';
                        }
                    };
                    row_data_datatable.push(element_card_tanggal);

                    var element_card_full_name = {
                        mRender: function(data, type, row) {
                            if (data_database_recruitments[row]['full_name']) {
                                return data_database_recruitments[row]['full_name'];
                            }
                            return '';
                        }
                    };
                    row_data_datatable.push(element_card_full_name);


                    var element_card_full_name = {
                        mRender: function(data, type, row) {
                            if (data_database_recruitments[row]['position']) {
                                return data_show = showFieldData('TEXT', 'JABATAN',
                                    'JABATAN',
                                    toUUID(data_database_recruitments[row]['position'])
                                );
                            }
                            return '';
                        }
                    };
                    row_data_datatable.push(element_card_full_name);


                    var element_card_provinsi = {
                        mRender: function(data, type, row) {
                            if (data_database_recruitments[row]['provinsi']) {
                                return data_database_recruitments[row]['provinsi'];
                            }
                            return '';
                        }
                    };
                    row_data_datatable.push(element_card_provinsi);


                    var element_card_status = {
                        mRender: function(data, type, row) {
                            if (data_database_recruitments[row]['status']) {
                                if (data_database_recruitments[row]['status'] == 'Diajukan') {
                                    return `<span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">Diajukan</span>`;
                                } else if (data_database_recruitments[row]['status'] == 'Ditolak') {
                                    return `<span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                style="color: rgb(215, 38, 38); background-color: rgb(231, 235, 245);">Ditolak</span>`;
                                } else if (data_database_recruitments[row]['status'] == 'Disimpan') {
                                    return `<span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                style="color: rgb(38, 215, 177); background-color: rgb(231, 235, 245);">Disimpan</span>`;
                                } else {
                                    return `<span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                style="color: rgb(215, 38, 177); background-color: rgb(231, 235, 245);">tidak ada</span>`;
                                }
                                // return data_database_recruitments[row]['status'];
                            }
                            return '';
                        }
                    };
                    row_data_datatable.push(element_card_status);

                    var element_card_file = {
                        mRender: function(data, type, row) {
                            let element_row = ``;
                            if (data_database_recruitments[row]['file']) {
                                element_row = `
                                            <button onclick="openDoc('${data_database_recruitments[row]['file']}')" class="btn btn-outline btn-secondary">
                                                <i class="icon-copy bi bi-filetype-pdf"></i>
                                            </button>`;
                                // return data_database_recruitments[row]['file'];
                            }


                            if (data_database_recruitments[row]['phone_number']) {
                                element_row += `
                                <a target="_blank" href="https://wa.me/${data_database_recruitments[row]['phone_number']}">
                                    <button class="btn btn-outline btn-success">
                                                <i class="icon-copy bi bi-telephone-forward-fill"></i>
                                            </button>
                                        </a>`;
                            }

                            element_row = `${element_row}
                                                <button onclick="showAction('${row}')"  class="btn btn-outline btn-primary">
                                                    <i class="icon-copy bi bi-gear"></i>
                                                </button>
                                            `;
                            return element_row;
                        }
                    };
                    row_data_datatable.push(element_card_file);

                    // ====== D A T A    F O R    D A T A T A B L E ===


                    let data_datatable = [];
                    if (data_database_recruitments) {
                        data_datatable = Object.keys(data_database_recruitments);
                    }

                    $('#table-datatable-data').DataTable({
                        paging: false,
                        serverSide: false,
                        data: data_datatable,
                        columns: row_data_datatable
                    });

                },
                error: function(response) {
                    conLog('response', response)
                    alertModal()
                }
            });
        }

        getWithNewData();

        /*
            mengambil perusahaan yang hanya sesuai dengan yg di beri akses
            looping berdasarkan itu ja

            dri public tpi fi filter dimana? di web atau di server

            di web,
            nentuin kolom field nya 
            kan ada 3 
                - nrp
                - total
                - detail




            menampilkan list karyawan 
                data:
                    - data absesnsi
                    - data karyawan
                    - data filter

            filter ini 
                - tanggal awal & akhir
                - perusahaan
                - departemen
                - karyawan
                - project
                {
                    filter : {
                        [
                            field:departement,
                            array_filter : ['HAULING','HRGA'],
                        ],
                        [
                            field:NRP,
                            array_filter : ['MBLE-0422003'],
                        ],

                    },
                    date_start  : '2024-01-01',
                    date_end    : '2024-01-31',
                }

            
            filter menggunakan data table

            datatable nya,

            - karyawan
            - table biasa di ambil yang menjadikannya primary 
                - table (untuk mendapatkan primary field)
                - ceklis menggunakan code_data
                - public->public_value

        
            
            


        */

        function filterTableShow(code_table) {
            let table_detail = db['db']['database_table'][code_table];
            let table_field = db['db']['database_field'][code_table];
            let data_table_datatable = db['public']['public_value'][code_table];
            $('#filter-name').val(code_table);
            let isChecked = "";
            if (default_filter_absensi[code_table].length == filter_absensi[code_table].length) {
                isChecked = "checked";
            }
            let headerTableFilter = `<th>
                                        <div class="dt-checkbox no-sort">
                                            <input onchange="selectAllFilter()"
                                                type="checkbox"
                                                name="select_all-filter"
                                                ${isChecked}
                                                id="select-all-filter"
                                            />
                                            <span class="dt-checkbox-label"></span>
                                        </div>
                                    </th>
                                    <th> ${table_field[table_detail['primary_table']]['description_field']}</th>
                                    `;
            headerTableFilter = `                    
                    <table id="table-datatable-filter" class="checkbox-datatable nowrap stripe hover table" style="width:100%">
                        <thead>
                            <tr>
                                ${headerTableFilter}
                            </tr>
                        </thead>
                    </table>
                `;
            $('#datatable-filter').empty();
            $('#filter-table-name').text("Filter by " + table_detail['description_table']);
            $('#datatable-filter').append(headerTableFilter);


            let row_data_datatable = [];


            var checkbox_card_element = {
                mRender: function(data, type, row) {
                    let isChecked = "";
                    if (filter_absensi[code_table].includes(row)) {
                        isChecked = "checked";
                    }
                    return `<input value="${row}" type="checkbox" ${isChecked} class="datatable-filter editor-active dt-checkbox no-sort">`
                }
            };

            row_data_datatable.push(checkbox_card_element);

            var element_card = {
                mRender: function(data, type, row) {
                    let data_show = showFieldData(table_field[table_detail['primary_table']]['type_data_field'],
                        code_table, table_detail['primary_table'],
                        toUUID(row)
                    );
                    return data_show;
                }
            };
            row_data_datatable.push(element_card);
            // return false;
            $('#table-datatable-filter').DataTable({
                paging: false,
                // scrollY: true,
                scrollX: true,
                scrollY: "400px",

                responsive: true,
                serverSide: false,
                data: default_filter_absensi[code_table],
                columns: row_data_datatable
            });


        }

        function filterDatatable(code_table) {
            filterTableShow(code_table);
            $('#modal-filter').modal('show');
        }

        function selectAllFilter() {
            var isChecked = $('#select-all-filter').prop('checked');
            $('.datatable-filter').prop('checked', isChecked);

        }

        function filterSave() {
            let arr_checkbox_filter = [];
            let name_filter = $('#filter-name').val();

            var checkboxValues = $('.datatable-filter:checked').map(function() {
                arr_checkbox_filter.push($(this).val());
            }).get();

            filter_absensi[name_filter] = arr_checkbox_filter;
            localStorage.setItem('filter_absen', JSON.stringify(filter_absensi));
            // conLog('filter_absensi', filter_absensi)

            $('#modal-filter').modal('hide');
        }

        function refreshTableAfterImport() {
            $('#datatable-data-after-import').empty();
            let header_table_element = '';
            let row_data_datatable = [];

            let data_datatable_after_import = [];
            // ============ create header table
            header_table_element = `                    
                <table id="table-fingger-identified" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th> NRP </th>
                        </tr>
                    </thead>
                </table>
            `;
            $('#datatable-data-after-import').append(header_table_element);
            // ============ create header table
            var element_card = {
                mRender: function(data, type, row) {
                    let data_show = showFieldData('TEXT',
                        'KARYAWAN', 'NRP',
                        toUUID(row)
                    );
                    return data_show;
                }
            };
            row_data_datatable.push(element_card);
            if (after_import_data['identification']) {

                data_datatable_after_import = Object.keys(after_import_data['identification']);
            }

            conLog('data_datatable_after_import', data_datatable_after_import);

            $('#table-fingger-identified').DataTable({

                scrollX: true,
                scrollY: "600px",
                paging: false,
                serverSide: false,
                data: data_datatable_after_import,
                columns: row_data_datatable
            });
        }

        function refreshTableData() {
            $('#datatable-data').empty();
            let row_data_datatable = [];
            conLog('database_datatable', ui_dataset);
            let header_table_element = '';

            var element_card_tanggal = {
                mRender: function(data, type, row) {

                    return data_show;
                }
            };
            row_data_datatable.push(element_card_tanggal);

            // ============ create header table
            header_table_element = `                    
                <table id="table-datatable-data" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            ${header_table_element}
                        </tr>
                    </thead>
                </table>
            `;
            $('#datatable-data').append(header_table_element);
            // ============ create header table


            // ====== D A T A    F O R    D A T A T A B L E ===

            let filter = [{
                    field: "PERUSAHAAN",
                    array_filter: filter_absensi.PERUSAHAAN,
                },
                {
                    field: "PROJECT",
                    array_filter: filter_absensi.PROJECT,
                },
                {
                    field: "DEPARTEMEN",
                    array_filter: filter_absensi.DEPARTEMEN,
                },
                {
                    field: "DIVISI",
                    array_filter: filter_absensi.DIVISI,
                },
            ];
            let employee_filtereds = getDataTable('KARYAWAN', filter);
            let data_datatable = [];
            if (employee_filtereds) {
                data_datatable = employee_filtereds;
            }

            $('#table-datatable-data').DataTable({
                scrollX: true,
                scrollY: "600px",
                paging: false,
                serverSide: false,
                data: data_datatable,
                columns: row_data_datatable
            });
        }

        function refreshTable(val_year = null, val_month = null) {
            // cg('refreshtable', arr_date_today);
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

            $('#btn-export-template').attr('href', '/user/absensi/export-template/' + arr_date_today.year + '-' +
                arr_date_today.month)
            $(`#date_start_filter_absen`).empty();
            $(`#date_start_filter_absen`).val(null);
            // loopDateFilter();
            // onSaveFilter();
            setDateSession(year, month);
        }

        async function uploadFiles() {
            var fileInput = document.getElementById('fileInput');
            var files = fileInput.files;
            var maxSize = 4 * 1024 * 1024; // 20 MB
            var currentSize = 0;
            $('#successMessage').hide();
            startLoading();

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var formData = new FormData();
                var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                formData.append('_token', csrfToken);
                formData.append('file[]', file);
                // formData.append('file', file);
                formData.append('month-year', $(`#month-year`).val());
                await $.ajax({
                    url: '/web/manage/slip',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                });
                $('#successMessage').show();
                stopLoading();
            }
        }

        $(document).ready(function() {
            // getDataAbsensi();
            conLog('random', @json(session('keys_random')));

        });
    </script>

    <script>
        //show data absen
        function manageAbsensiDay(employee_uuid, date_absen) {
            // let data_emp = data_database['data_employees'][employee_uuid];
            $('#name-date').text(`Absen Tanggal ${date_absen}`);
            $('#absen_description-show').val((detail_absensi[employee_uuid]['detail_absen'][date_absen][
                'absen_description'
            ]) ? detail_absensi[employee_uuid]['detail_absen'][date_absen][
                'absen_description'
            ] : "-");
            // $('#date-edit-live').val(`${date_value}`);
            // let cek_log = '-';
            // if (typeof(data_datatable[employee_uuid]['data'][date_value]) != 'undefined') {
            //     cek_log = data_datatable[employee_uuid]['data'][date_value]['cek_log'];
            // }

            // $('#button-status_absen_uuid').empty();


            conLog('date_absen', detail_absensi);
            $('#employee_uuid-show').val(`${employee_uuid}`);
            $('#date-show').val(`${date_absen}`);
            $('.cek_log-show').val(`${detail_absensi[employee_uuid]['detail_absen'][date_absen]['cek_log']}`);
            $('#modal-show-fingger').modal('show');
        }

        function storeUpdateAbsenDay(status_absen_code) {
            let employee_uuid = $('#employee_uuid-show').val();
            $.ajax({
                url: '/api/mbg/pengelolaan/absensi/store-single',
                type: "POST",
                headers: {
                    'X-auth_login': ui_dataset.ui_dataset.user_authentication.auth_login
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'employee_uuid': employee_uuid,
                    'date': $('#date-show').val(),
                    'status_absen_uuid': status_absen_code,
                    'cek_log': $("#cek_log-show").val(),
                    'absen_description': $("#absen_description-show").val(),

                },
                success: function(response) {
                    // conLog('response', response);

                    let count_absen_element = ``;
                    let count_absensi = {};
                    let element_count_absen = ``;
                    let element_detail_absen = ``;
                    let element_two_column = ``;
                    $(`#row-absensi-${employee_uuid}`).empty();
                    detail_absensi[employee_uuid]['detail_absen'][$('#date-show').val()]['status_absen_uuid'] =
                        status_absen_code;
                    let data_properties = detail_absensi[employee_uuid]['detail_absen'];
                    if (data_properties) {
                        const startDate = new Date(filter_absensi.date_start);
                        const endDate = new Date(filter_absensi.date_end);

                        let currentDate = new Date(startDate);
                        while (currentDate <= endDate) {
                            let date_current = formatDate(currentDate);
                            let detail_absen_current_date = {
                                absen_description: null,
                                cek_log: '-',
                                color: "#544545",
                                date: date_current,
                                employee_uuid: null,
                                status_absen_uuid: "-",
                                uuid: null
                            }
                            if (data_properties[date_current]) {
                                detail_absen_current_date = data_properties[date_current];
                            } else {
                                detail_absensi[employee_uuid][date_current] = detail_absen_current_date;
                            }
                            let obj_current_date = getDateObj(currentDate);
                            // console.log(detail_absen_current_date);
                            if (count_absensi[detail_absen_current_date.status_absen_uuid]) {
                                count_absensi[detail_absen_current_date.status_absen_uuid]++;
                            } else {
                                count_absensi[detail_absen_current_date.status_absen_uuid] = 1;
                            }
                            element_detail_absen += `<div id="element_absen-${employee_uuid}-${date_current}" class="col-auto mb-1">
                                                    <div onclick="manageAbsensiDay('${employee_uuid}', '${date_current}')" style=" background-color: ${db['public']['DATABASE-ABSENSI'][detail_absen_current_date.status_absen_uuid]['WARNA-ABSENSI']}" class="name-avatar d-flex align-items-center pr-2 card-box pl-2">
                                                        <div class="txt text-center">
                                                            <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                                style=" background-color: rgb(231, 235, 245);">${getFirstCharDay(currentDate)} ${obj_current_date.day}-${obj_current_date.month}</span>
                                                            <div class="font-14  weight-600">${detail_absen_current_date.status_absen_uuid}</div>
                                                        </div>
                                                    </div>
                                                </div>`;

                            // Move to the next day
                            currentDate.setDate(currentDate.getDate() + 1);
                        }
                        Object.entries(count_absensi).forEach(([key, values]) => {
                            element_count_absen += `<div class="col-auto mb-1">
                                                    <button style=" background-color: ${db['public']['DATABASE-ABSENSI'][key]['WARNA-ABSENSI']}" class="btn font-14  weight-600 ">${key} : ${values}</button>
                                                </div>`;
                        });
                        element_two_column = `<div class="col-md-2 col-sm-12">
                                    <div class="row">
                                        ${element_count_absen}
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 row ">
                                    ${element_detail_absen}
                                </div>`;

                    } else {
                        element_two_column = ` <div class="col-md-9 col-sm-12"> 
                                            <div class="alert alert-secondary" role="alert">
                                                Data tidak ditemukan.
                                            </div>
                                        </div>`;
                    }
                    $(`#row-absensi-${employee_uuid}`).append(`<div id="row-absensi-${employee_uuid}" class="row justify-content-md-center">
                                    <div class="col-md-3 col-sm-12 mb-2">
                                        ${emmp(employee_uuid)}
                                    </div>
                                    ${element_two_column}
                                </div>
                            `);
                    showModalSuccess();
                },
                error: function(response) {
                    conLog('response', response)
                    alertModal()
                }
            });
        }
    </script>

    <script>
        function loopDate() {
            var start = new Date(dt_start);
            var end = new Date(dt_end);

            var loop = new Date(start);

            let date_absen_start = $('#date_absen_start').val();
            if (date_absen_start) {
                $(`#date_absen_end`).empty();
            }

            while (loop <= end) {
                if (date_absen_start) {
                    var loop_date_start = new Date(date_absen_start);
                    if (loop > loop_date_start) {
                        $(`#date_absen_end`).prepend(` <option>${formatDate(loop)}</option>`)
                    }
                } else {
                    $(`#date_absen_start`).append(` <option>${formatDate(loop)}</option>`);
                    $(`#date_absen_end`).prepend(` <option>${formatDate(loop)}</option>`)
                }
                var newDate = loop.setDate(loop.getDate() + 1);
                loop = new Date(newDate);
            }
            $('#date_absen_end').val(dt_end);
        }

        function storeUserDocument(idForm) {
            startLoading();
            let date_absen_start = $('#date_absen_start').val();
            let _url = $('#form-' + idForm).attr('action');
            var form = $('#form-' + idForm)[0];
            var form_data = new FormData(form);
            conLog('form_data', idForm)
            $.ajax({
                url: _url,
                type: "POST",
                contentType: false,
                processData: false,
                data: form_data,
                success: function(response) {
                    $('#loading-modal').modal('hide');
                    conLog('responseess', response);
                    // return false;
                    if (response.message == 'excel') {
                        showModalMessage('import success');
                        return false;
                    }

                    if (!date_absen_start) {
                        $('.date-setup').attr('hidden', false);
                        $('#loading-modal').modal('hide');
                        dt_start = response.data.date_absen_start;
                        dt_end = response.data.date_absen_end;
                        loopDate();
                    } else {
                        $('#import-modal').modal('hide');
                        $('#after-import').modal('show');
                        after_import_data = response.data;
                        conLog('after_import_after_absen', after_import_data);
                        getDataAbsensi();
                        // response.data.
                        // refreshTableAfterImport();
                        return false;
                        window.location.href = "/user/absensi/after-import";
                    }
                },
                error: function(response) {
                    cg('errr', response);
                    alertModal()
                }
            });
        }

        function showAction(id_recruitment){
            $(`#id_recruitment`).val(id_recruitment);
            $('#small-modal').modal('show');
        }

        function updateRecruitment(status_recruitment){
            console.log('status_recruitment');console.log(status_recruitment);
            $.ajax({
                url: 'http://127.0.0.1:8000/api/recruitment/store',
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id:  $(`#id_recruitment`).val(),
                    status: status_recruitment,
                },
                success: function (response) {
                    console.log(response);
                    
                    showModalSuccess();
                    location.reload();
                    
                },
                error: function (response) {
                    console.log(response);
                }
            });
        }

        function openDoc(name_doc) {
            console.log(name_doc);
            var modal = $('#pdfModal');
            var loader = $('#loader');
            var pdfViewer = $('#pdfViewer');
            pdfViewer.attr('src', '');
            modal.modal('show');
            $.ajax({
                url: '/file/recruitment/' + name_doc, // Replace with your PDF URL
                method: 'GET',
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(data) {
                    var url = URL.createObjectURL(data);
                    pdfViewer.attr('src', url);
                    loader.hide();
                    pdfViewer.show();

                },
                error: function() {
                    loader.hide();
                    alert('Failed to load PDF');
                }
            });
        }
    </script>
@endsection
