@extends('app.layouts.main')

@section('content')
    <div class="faq-wrap">
        <div id="accordion">
            <div class="card">
                <div class="card-header">
                    <button id="btn-list-detail-absensi" class="btn btn-block collapsed" data-toggle="collapse"
                        data-target="#list-detail-absensi">
                        Ringkasan Informasi
                    </button>
                </div>
                <div id="list-detail-absensi" class="collapse" data-parent="#accordion">
                    <div class="">
                        <div class="row pd-20">
                            <div class="col-auto">
                                <h4 class="text-blue h4">Filter Data</h4>
                            </div>
                            <div class="col text-right">
                                <div class="btn-group">
                                    <a class="btn btn-primary" onclick="reportOpenModalReportStatusAbsen()"
                                        id="btn-export-dialy" href="#">Filter Jenis detail-absensi</a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-20" id="datatable-data-detail-absensi">
                            <div id="chart6"></div>


                        </div>

                    </div>
                </div>

            </div>

            <div class="card">
                <div class="card-header">
                    <button class="btn btn-block" data-toggle="collapse" data-target="#data-table-manage-absensi">
                        data table absensi karyawan
                    </button>
                </div>

                <div id="data-table-manage-absensi" class="collapse show" data-parent="#accordion">
                    <div class="row pd-20">
                        <div class="col-auto">
                            <h4 class="text-blue h4">Absensi Karyawan</h4>
                        </div>
                        <div class="col text-right">
                            <div class="btn-group">
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                                        data-toggle="dropdown" aria-expanded="false" id="btn-year">
                                        <span class="caret"></span>
                                    </button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" onclick="refreshTable('2021',null)" href="#">2021</a>
                                        <a class="dropdown-item" onclick="refreshTable('2022',null)" href="#">2022</a>
                                        <a class="dropdown-item" onclick="refreshTable('2023',null)" href="#">2023</a>
                                        <a class="dropdown-item" onclick="refreshTable('2024',null)" href="#">2024</a>
                                        <a class="dropdown-item" onclick="refreshTable('2025',null)" href="#">2025</a>
                                    </div>
                                </div>
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                                        data-toggle="dropdown" aria-expanded="false" id="btn-month" value="">
                                        <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" onclick="refreshTable(null, '01' )"
                                            href="#">Januari</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, '02' )"
                                            href="#">Februari</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, '03' )"
                                            href="#">Maret</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, '04' )"
                                            href="#">April</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, '05' )" href="#">Mei</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, '06' )" href="#">Juni</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, '07' )" href="#">Juli</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, '08' )"
                                            href="#">Agustus</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, '09' )"
                                            href="#">September</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, '10' )"
                                            href="#">Oktober</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, '11' )"
                                            href="#">November</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, '12' )"
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
                                            onclick="openModalKehadiran()">Buat Ketidakhadiran</a>
                                        <a class="dropdown-item" onclick="exportAbsen()" id="btn-export"
                                            href="#">Lap.
                                            Bulanan</a>
                                        <a class="dropdown-item" onclick="openModalExportDialy()" id="btn-export-dialy"
                                            href="#">Dialy
                                            Report</a>
                                        <a class="dropdown-item" onclick="reportOpenModalReportStatusAbsen()"
                                            id="btn-export-dialy" href="#">Lap. Ketidakhadiran</a>
                                        <a class="dropdown-item" id="btn-import" data-toggle="modal"
                                            data-target="#import-modal" href="">Import</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="mb-20" id="datatable-data">
                        <table class="data-table table hover multiple-select-row nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">Name</th>
                                    <th>Total</th>
                                    <th>Absensi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>

            <div class="card">
                <div class="card-header">
                    <button id="btn-list-ketidakhadiran" class="btn btn-block collapsed" data-toggle="collapse"
                        data-target="#list-ketidakhadiran">
                        List Ketidakhadiran
                    </button>
                </div>
                <div id="list-ketidakhadiran" class="collapse" data-parent="#accordion">
                    <div class="">
                        <div class="row pd-20">
                            <div class="col-auto">
                                <h4 class="text-blue h4">Filter Data</h4>
                            </div>
                            <div class="col text-right">
                                <div class="btn-group">
                                    <a class="btn btn-primary" onclick="reportOpenModalReportStatusAbsen()"
                                        id="btn-export-dialy" href="#">Filter Jenis Kehadiran</a>

                                </div>
                            </div>
                        </div>
                        <div class="mb-20" id="datatable-data-ketidakhadiran">
                            <table class="data-table table stripe hover nowrap" id="table-datatable-data-ketidakhadiran">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort">data tabel</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>

                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <button id="btn-list-persetujuan" class="btn btn-block collapsed" data-toggle="collapse"
                        data-target="#list-persetujuan">
                        List Persetujuan
                    </button>
                </div>
                <div id="list-persetujuan" class="collapse" data-parent="#accordion">
                    <div class="">
                        <div class="row pd-20">
                            <div class="col-auto">
                                <h4 class="text-blue h4">Filter Data</h4>
                            </div>
                            <div class="col text-right">
                                <div class="btn-group">
                                    <a class="btn btn-primary" onclick="reportOpenModalReportStatusAbsen()"
                                        id="btn-export-dialy" href="#">Filter Jenis Persetujuan</a>

                                </div>
                            </div>
                        </div>
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

        <div id="after-import">
            <h4 id="" class="mb-20 h4 text-blue">Import Absensi</h4>
        </div>



        <!-- Modal edit live-->
        <div class="modal fade" id="modal-show-fingger" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                        <label>Riwayat cek log</label>
                        <input class="form-control cek_log-show" disabled cols="10" rows="3">
                        <input class="form-control cek_log-show" type="hidden" name="cek_log-show" id="cek_log-show"
                            cols="10" rows="3">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="absen_description-show" id="absen_description-show" cols="30"
                            rows="10"></textarea>
                        <div id="button-status_absen">
                            {{-- status absen --}}
                        </div>
                        <input type="hidden" name="" id="employee_uuid-show">
                        <input type="hidden" name="" id="date-show">
                        <label class="button-status_absen_uuid mt-3 feature-HR">Ubah Status
                            Absen</label>
                        <div class="row justify-content-md-center button-status_absen_uuid feature-HR"
                            id="button-status_absen_uuid">
                            <div class="col-auto">

                            </div>
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

        <!-- import -->
        <div class="modal fade" id="import-modal" role="dialog" aria-labelledby="import-modalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form id="form-import" action="/user/absensi/import" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Import
                                Absensi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Pilih Absensi</label>
                                <input autofocus name="uploaded_file" type="file"
                                    class="form-control-file form-control height-auto" />
                            </div>
                            <div class="form-group row date-setup">
                                <div class="col-6">
                                    <label>Mulai tanggal</label>
                                    <select onchange="loopDate()" name="date_absen_start" style="width: 100%"
                                        id="date_absen_start" class="custom-select2 form-control">

                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Sampai tanggal</label>
                                    <select name="date_absen_end" style="width: 100%" id="date_absen_end"
                                        class="custom-select2 form-control">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" onclick="exportAbsensiTable('import')"
                                class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- after import --}}
        <div class="modal fade bd-example-modal-xl" id="after-import" tabindex="-1" role="dialog"
            aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="card-box mb-30 ">
                        <div class="row pd-20">
                            <div class="col-auto">
                                <h4 class="text-blue h4">Absensi Karyawans</h4>
                            </div>
                            <div class="col text-right">
                                <div class="btn-group">
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect"
                                            data-toggle="dropdown" aria-expanded="false">
                                            Menu <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" id="btn-export" onclick="exportEmployee()"
                                                href="#">Export Karyawan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="datatable-data-after-import">
                            <table id="table-fingger-identified" class="display nowrap stripe hover table"
                                style="width:100%">
                                <thead>
                                    <tr id="header-table-fingger-identified">
                                        <th>Detail Data Karyawan</th>
                                        <th>Nama fingger</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>



                    </div>
                </div>
            </div>
        </div>

        <!-- Update FIngger -->
        <div class="modal fade" id="update-fingger-modal" role="dialog" aria-labelledby="import-modalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form id="form-update-fingger" action="/user/absensi/store-fingger" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update
                                Fingger</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama pada mesin</label>
                                <input name="employee_uuid" id="employee_uuid" type="text"
                                    class="form-control-file form-control height-auto" />
                            </div>
                            <div class="form-group">
                                <label>Karyawan</label>
                                <select name="nik_employee" id="nik_employee" style="width: 100%"
                                    class="custom-select2 form-control employees">

                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" onclick="storeFingger('update-fingger')"
                                class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal laporan sesuai status absen-->
        <div class="modal fade" id="modal-report-status-absen" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            PILIH STATUS ABSEN
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <form autocomplete="off" id="form-absen" action="/user/absensi/store-dialy" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Pilih status absen</label>
                                <select id="status-absen-filter"
                                    class="selectpicker form-control multiple-select-status-absen" data-size="5"
                                    data-style="btn-outline-primary" multiple data-actions-box="true"
                                    data-selected-text-format="count">

                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button onclick="reportAbsensi_x('filter')" type="button" class="btn btn-secondary">
                                Hanya Filter
                            </button>
                            <button onclick="reportAbsensi_x('unduh')" type="button" class="btn btn-primary">
                                Unduh Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <span></span>

        <!-- Modal KEHADIRAN-->
        <div class="modal fade" id="modal-kehadiran" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Buat Ketidakhadiran
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
                            Tutup
                        </button>
                        <button id="storeDataKehadiran" onclick="storePersetujuan('KEHADIRAN', 'DECLINE')" type="button"
                            class="btn persetujuan btn-danger">
                            Tolak
                        </button>
                        <button id="storeDataKehadiran" onclick="storePersetujuan('KEHADIRAN','ACC')" type="button"
                            class="btn persetujuan btn-primary">
                            Setujui
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal ketidakhadiran-->
        <div class="modal fade" id="export-dialy" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Form Ketidakhadiran
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <form autocomplete="off" id="form-absen" action="/user/absensi/store-dialy" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            {{-- karyawan --}}
                            <div class="form-group">
                                <label for="">Pilih Tanggal</label>
                                <input type="date" class="form-control" name="date_dialy" id="date_dialy">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Close
                            </button>
                            <button onclick="dailyReportWeb()" type="button" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection()

    @section('script_javascript')
        <script>
            // chart 4
        </script>
        <script>
            $('#after-import').hide();

            let database_datatable = {};

            database_datatable['show-fields'] = [{
                'code_field': "detail_absen",
                'code_table_field': "ABSENSI_COUNT",
                'description_field': "Total Absensi",
                'full_code_field': 'ABSENSI-COUNT_ABSEN',
                'tipe_data_field': "ABSENSI_COUNT"
            }, ];

            $('.date-setup').attr('hidden', false);
            $('#btn-export-template').attr('href', '/user/absensi/export-template/' + arr_date_today.year + '-' +
                arr_date_today.month);

            Object.entries(db['public']['DATABASE-ABSENSI']).forEach(([key, values]) => {
                $(`#button-status_absen_uuid`).append(`
                    <button onclick="storeUpdateAbsenDay('${key}')" style="background-color: ${db['public']['DATABASE-ABSENSI'][key]['WARNA-ABSENSI']}" class="btn mr-2 mb-2">${key}</button>
                `);
            });

            Object.entries(db['public']['public_value']['KARYAWAN']).forEach(([key, values]) => {
                $(`.employees`).append(`
                    <option value="${key}">${values['FULL-NAME']}</option>
                `);
            });

            Object.entries(db['public']['public_value']['DATABASE-JENIS-PEMBAYARAN-ABSENSI']).forEach(([keys,
                math_element
            ]) => {
                $('.math').append(`<div class="col-auto">
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input onchange="changeChecked('filter-math-${keys}','${keys}', 'math')" type="checkbox" class="custom-control-input element-math" value="${keys}"
                                                        id="filter-math-${keys}" name="filter-math-${keys}">
                                                        <label class="custom-control-label" for="filter-math-${keys}">${math_element['JENIS-PEMBAYARAN-ABSENSI']}</label>
                                                    </div>
                                                </div>`);

                $('.multiple-select-status-absen').append(`
                    <optgroup label="${keys}" id="${keys}">
                     
                    </optgroup>`);
            });

            $(`#TIDAK-DIBAYAR`).append(
                `<option value="unknown_absen">? - Tidak diketahui</option>`
            );
            // conLog('ui_dataset', ui_dataset.ui_dataset.user_authentication);

            Object.entries(db['public']['DATABASE-ABSENSI']).forEach(([kes, data_status_absen_element]) => {
                $(`#${data_status_absen_element['JENIS-PEMBAYARAN-ABSEN']}`).append(
                    `<option value="${kes}">${kes} | ${data_status_absen_element['KETERANGAN-ABSEN']}</option>`
                );
            });


            function reportAbsensi_x(type) {
                let status_absen_filter = $('#status-absen-filter').val();
                let filteredData = filterObject(getDataFilteredKaryawan(), db['db']['database_data']['ABSENSI_COUNT']);

                conLog('filteredData', filteredData);
                $.ajax({
                    url: '/user/absensi/reportUnAbsen',
                    type: "POST",
                    headers: {
                        'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login,
                    },
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        filteredData: JSON.stringify(filteredData),
                        filter_absensi: default_filter_absensi,
                        status_absen_filter: status_absen_filter
                    },
                    success: function(response) {
                        cg('responssssssse', response);
                        let status_absen = '';
                        stopLoading();
                        Object.values(db['public']['DATABASE-ABSENSI']).forEach(element => {
                            status_absen =
                                `${status_absen} <option value="${element['KODE-ABSEN']}">${element['KODE-ABSEN']}</option>`;
                        });

                        $('#datatable-data-ketidakhadiran').empty();
                        let row_data_datatable = [];
                        let header_table_element = ``;
                        var element_card = {
                            mRender: function(data, type, row) {
                                return `
                            <div class="row">
                                <div class="col-md-4 mb-1">
                                ${emmp(row.nik_employee)}
                                </div>
                                <div class="col-md-8 pd-2 ">
                                    <form action="" id="form-ketidakhadiran-${row.nik_employee}-${row.date_start}" enctype="multipart/form-data">
                                         <input value="${row.nik_employee}" type="hidden" name="ketidakhadiran-NRP" id="">
                                        <div class="card-box row">
                                            <div class="col-md-3">
                                                <span class="badge badge-pill badge-sm mb-2"
                                                    data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                    style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">Tanggal
                                                    Mulai</span>
                                                <div class="font-14 weight-600">
                                                    <input class="form-control form-control-sm" value="${row.date_start}"
                                                        type="date" name="ketidakhadiran-date_start" id="">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <span class="badge badge-pill mb-2 badge-sm"
                                                    data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                    style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">Lama</span>
                                                <input class="form-control  form-control-sm" type="text" value="${row.long_day}"
                                                    name="ketidakhadiran-long_day" id="">
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <span class="badge badge-pill mb-2 badge-sm"
                                                    data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                    style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">Status
                                                    Absen</span>
                                                <select class="form-control" name="ketidakhadiran-staus_absen_uuid" >
                                                ${status_absen}
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <span class="badge badge-pill mb-2 badge-sm"
                                                    data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                    style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">Kererangan</span>
                                                <div class="font-14 weight-600">
                                                    <input class="form-control name="ketidakhadiran-description_absen" form-control-sm"
                                                        type="text" id="">
                                                </div>
                                            </div>
                                            <div class="col-md-1 mb-2">
                                                <span class="badge badge-pill mb-2 badge-sm"
                                                    data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                    style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">File</span>

                                                {{-- <span class="badge badge-pill mb-2 badge-sm"
                                                    data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                    style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">Save</span> --}}
                                                <br>
                                                <button type="button" class="btn btn-primary btn-sm"><i
                                                        class="icon-copy bi bi-paperclip"></i></button>
                                                <button type="button" onclick="storeListAbsensi('form-ketidakhadiran-${row.nik_employee}-${row.date_start}')" class="btn btn-primary btn-sm"><i
                                                        class="icon-copy bi bi-send-fill"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            `;
                            }
                        };
                        row_data_datatable.push(element_card);

                        // ============ create header table
                        header_table_element = `                    
                        <table id="table-datatable-data-ketidakhadiran" class="display nowrap stripe hover table" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">List Data Ketidakhadiran</th>
                                </tr>
                            </thead>
                        </table>
                    `;
                        $('#datatable-data-ketidakhadiran').append(header_table_element);
                        // ============ create header table

                        // ====== D A T A    F O R    D A T A T A B L E ===
                        $('#table-datatable-data-ketidakhadiran').DataTable({
                            scrollX: true,
                            // scrollY: "600px",
                            paging: true,
                            serverSide: false,
                            data: response.message,
                            columns: row_data_datatable
                        });
                        if ('filter' == type) {
                            return false;
                        }

                        // return false;
                        var dlink = document.createElement("a");
                        dlink.href = `/${response.data}`;
                        dlink.setAttribute("download", "");
                        dlink.click();
                    },
                    error: function(response) {
                        cg('response', response)
                        // alertModal()
                    }
                });
            }

            function getWithNewData() {
                conLog('getWithNewData', 'getWithNewData');
                $('#datatable-data').empty();
                $('#datatable-data').append(loading_e);

                let data_table_for_absensi = getDataFilteredKaryawan();
                // conLog('data_table_for_absensi',data_table_for_absensi);
                conLog('default_filter_absensi', default_filter_absensi);

                default_filter_absensi.from = null;

                $.ajax({
                    url: '/web/pengelolaan/absensi/getAbsenEmployee',
                    type: "POST",
                    headers: {
                        'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login,
                    },
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        default_filter_absensi: default_filter_absensi
                    },
                    success: function(response) {
                        conLog('response', response);      

                        // conLog('default_filter_absensi',default_filter_absensi)
                        detail_absensi = response['data']['data_absensi'];
                        db['db']['database_data']['ABSENSI_COUNT'] = detail_absensi;
                        data_ketidakhadiran = response['data']['data_ketidakhadiran'];
                        data_data_persetujuan = response['data']['data_persetujuan'];

                        let row_data_datatable = [];
                        let header_table_element = '';
                        let data_grafik = processingAbsensi();
                        $('#datatable-data-detail-absensi-chart').empty();
                        // conLog('data_grafik',data_grafik);
                        $('#datatable-data-detail-absensi-chart').append(`<div id="chart6"></div>`);

                        Highcharts.chart('chart6', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Monthly Absensi'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                categories: [
                                    'Oktober',
                                ],
                                crosshair: true
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Jumlah Karyawan'
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                }
                            },
                            series: data_grafik['data']
                        });

                        database_datatable['show-fields'].forEach(field_table => {
                            let code_field = field_table['code_field'];
                            let type_data_field = field_table['tipe_data_field'];
                            let data_code_table = field_table['code_table_field'];

                            // ============ create header table
                            header_table_element =
                                `${header_table_element} <th> ${field_table['description_field']} ${default_filter_absensi['date_end']} </th>`
                            // ============ create header table
                            var element_card = {
                                mRender: function(data, type, row) {
                                    let detail_properties = null;
                                    try {
                                        detail_properties = detail_absensi[row];
                                    } catch (error) {

                                    }
                                    let data_show = showFieldData(type_data_field, data_code_table,
                                        code_field,
                                        toUUID(row), detail_properties
                                    );
                                    return data_show;
                                }
                            };
                            row_data_datatable.push(element_card);
                        });

                        // ============ create header table
                        header_table_element = `                    
                            <table hidden id="table-datatable-data" class="display nowrap stripe hover table" style="width:100%">
                                <thead>
                                    <tr>
                                        ${header_table_element}
                                    </tr>
                                </thead>
                            </table>
                        `;
                        $('#datatable-data').append(header_table_element);
                        // ============ create header table
                        conLog('aa','bb')
                        // return false;
                        // ====== D A T A    F O R    D A T A T A B L E ===
                        let xxx = $('#table-datatable-data').DataTable({
                            scrollX: true,
                            scrollY: "600px",
                            paging: true,
                            serverSide: false,
                            data: data_table_for_absensi,
                            columns: row_data_datatable
                        });

                        var table = $('#table-datatable-data').DataTable();

                        $('.loading-content').hide();
                        $('#table-datatable-data').removeAttr("hidden");
                        $('#table-datatable-data').show();



                        createDatatablePersetujuanAbsen();

                    },
                    error: function(response) {
                        conLog('response', response)
                        alertModal()
                    }
                });

                // stopLoading();
            }

            function dailyReportWeb() {
                let date_dialy = $('#date_dialy').val();
                let filteredData = filterObject(getDataFilteredKaryawan(), db['db']['database_data']['ABSENSI_COUNT']);

                $.ajax({
                    url: '/web/pengelolaan/absensi/daily-report',
                    type: "POST",
                    headers: {
                        'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login,
                    },
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        date_dialy: date_dialy,
                        default_filter_absensi: default_filter_absensi
                    },
                    success: function(response) {
                        conLog('response daily report', response);
                        // return false;

                        var dlink = document.createElement("a");
                        dlink.href = `/${response.data}`;
                        dlink.setAttribute("download", "");
                        dlink.click();
                    },
                    error: function(response) {
                        conLog('response', response)
                        alertModal()
                    }
                });
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
                if(val_month != null){
                    setDateSession(val_year, val_month);
                }
                
                $('#FILTER-RANGE').val(setRangeDate(formatDate(start), formatDate(end))).trigger(
                    'change');
                    conLog('default_filter_absensi refresh table', default_filter_absensi);
                getWithNewData();

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
        </script>

        <script>
            //show data absen


            function openModalExportDialy() {
                let dt_today = getDateTodayArr();

                $('#date_dialy').val(`${dt_today.year}-${dt_today.month}-${dt_today.day}`);
                $('#export-dialy').modal('show');
            }

            function storeUpdateAbsenDay(status_absen_code) {
                let employee_uuid = $('#employee_uuid-show').val();
                $.ajax({
                    url: '/web/pengelolaan/absensi/store-single',
                    type: "POST",
                    headers: {
                        'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login
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
                        conLog('DETAIL ', $('#date-show').val());
                        try {
                            detail_absensi[employee_uuid][$('#date-show').val()]['status_absen_uuid'] =
                                status_absen_code;
                        } catch (error) {
                            detail_absensi[employee_uuid][$('#date-show').val()] = {};
                            detail_absensi[employee_uuid][$('#date-show').val()]['status_absen_uuid'] =
                                status_absen_code;
                        }


                        let data_properties = detail_absensi[employee_uuid];
                        conLog('default_filter_absensi',default_filter_absensi)
                        if (data_properties) {
                            conLog('data_properties',data_properties);
                            const startDate = new Date(default_filter_absensi.date_start);
                            const endDate = new Date(default_filter_absensi.date_end);

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
                                console.log(detail_absen_current_date.status_absen_uuid);
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
            function exportAbsen() {
                startLoading();
                let filteredData = getDataFilteredKaryawan().reduce((acc, index) => {
                    if (db['db']['database_data']['ABSENSI_COUNT'].hasOwnProperty(index)) {
                        acc[index] = db['db']['database_data']['ABSENSI_COUNT'][index];
                    }
                    return acc;
                }, {});

                conLog('filteredData', filteredData);

                $.ajax({
                    url: '/user/absensi/export+data',
                    type: "POST",
                    headers: {
                        'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login,
                        'default-filter-absensi': default_filter_absensi
                    },
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        data_absensi: JSON.stringify(filteredData),
                        filter_absensi: default_filter_absensi,
                    },
                    success: function(response) {
                        cg('response', response);
                        var dlink = document.createElement("a");
                        dlink.href = `/${response.data}`;
                        dlink.setAttribute("download", "");
                        dlink.click();
                        stopLoading();
                    },
                    error: function(response) {
                        cg('err export', response)
                        alertModal()
                    }
                });
            }

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



            function exportAbsensiTable(idForm) {
                startLoading();
                $('#after-import').empty();

                let data_column = [];
                let data_null_employees_column = [];
                let data_absen;
                $('#after-import').append(`
                <div class="card-box mb-30 ">
                    <div class="row pd-20">
                        <div class="col-auto">
                            <h4 class="text-blue h4">Absensi Karyawan</h4>
                        </div>
                        <div class="col text-right">
                            <div class="btn-group">
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown"
                                        aria-expanded="false">
                                        Menu <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" id="btn-export" onclick="exportEmployee()"  href="#">Export Karyawan</a>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
            
                    <table id="table-have-employees" class="display nowrap stripe hover table" style="width:100%">
                        <thead>
                            <tr id="header-table-have-employees">
                                <th>Detail Data Karyawan</th>
                                <th>Nama fingger</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            
            
                <div class="card-box mb-30 ">
                    <div class="row pd-20">
                        <div class="col-auto">
                            <h4 class="text-blue h4">Absensi Karyawan belum terkonfigurasi</h4>
                        </div>
                        <div class="col text-right">
                            <div class="btn-group">
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown"
                                        aria-expanded="false">
                                        Menu <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" id="btn-export" href="/user/absensi/export/">Export + Data</a>
                                        <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                            href="">Import</a>
                                    </div>
                                </div>
            
                            </div>
                        </div>
                    </div>
            
                    <table id="table-null-employees" class="display nowrap stripe hover table" style="width:100%">
                        <thead>
                            <tr id="header-table-null-employees">
                                <th>Nama fingger</th>
                                <th>Detail Data Karyawan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            `);





                let date_absen_start = $('#date_absen_start').val();
                let _url = $('#form-' + idForm).attr('action');
                var form = $('#form-' + idForm)[0];
                var form_data = new FormData(form);
                conLog('form_data', idForm);

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
                            conLog('ui_user', ui_dataset);
                            if (!(ui_dataset.ui_dataset.user_authentication.feature).includes('SUPERADMIN')) {
                                $('#loading-modal').modal('hide');
                                stopLoading();
                                return false;
                            }

                            after_import_data = response.data;
                            conLog('after_import_after_absen', after_import_data);
                            let data_absen = response.data;

                            let name_fingger_unknown = {
                                mRender: function(data, type, row) {
                                    return row
                                }
                            };
                            data_null_employees_column.push(name_fingger_unknown);
                            name_fingger_unknown = {
                                mRender: function(data, type, row) {
                                    return `   <button onclick="updateFingger('${row}', '')" type="button" class="btn btn-secondary mr-1  py-1 px-2">
											<i class="icon-copy ion-gear-b"></i>
										</button>`
                                }
                            };
                            data_null_employees_column.push(name_fingger_unknown)

                            // return false;
                            let nrp = {
                                mRender: function(data, type, row) {
                                    return emmp(row);
                                }
                            };

                            data_column.push(nrp);
                            nrp = {
                                mRender: function(data, type, row) {
                                    return data_absen.identification[row][
                                        'machine_id'
                                    ];
                                }
                            };
                            data_column.push(nrp);


                            var end = new Date(data_absen['have_employees']['configuration']['end_date']);
                            var loop = new Date(data_absen['have_employees']['configuration']['first_date']);
                            let x = 1;

                            let variable_header = [];
                            while (loop < end) {
                                let format_date_day = formatDate(loop);
                                variable_header.push(format_date_day);
                                $(`#header-table-have-employees`).append(` <th>${format_date_day}</th>`);
                                $(`#header-table-null-employees`).append(` <th>${format_date_day}</th>`);

                                element_profile_empl = {
                                    mRender: function(data, type, row) {
                                        let status_absen = "-";
                                        let status_absen_ceklog = "-";
                                        try {
                                            status_absen = data_absen.have_employees['detail'][row][
                                                    format_date_day
                                                ]
                                                ['status_absen_uuid'];
                                            status_absen_ceklog = data_absen.have_employees['detail'][
                                                row
                                            ][
                                                format_date_day
                                            ]['cek_log'];
                                            if (status_absen == null) {
                                                status_absen = '-';
                                            }

                                            if (!status_absen_ceklog) {
                                                status_absen_ceklog = '-';
                                            }
                                        } catch (error) {
                                            status_absen = '-';
                                            status_absen_ceklog = '-';
                                        }

                                        return `<div>
                                                <h4 class="mb-0 h4">${status_absen}</h4>                              
                                                    <small>${status_absen_ceklog}</small>                             
                                            </div>`
                                    }
                                };

                                element_profile_null_empl = {
                                    mRender: function(data, type, row) {
                                        let status_absen = "-";
                                        let status_absen_ceklog = "-";

                                        try {
                                            status_absen = data_absen.null_employees[row][
                                                    'data'
                                                ][format_date_day]
                                                ['status_absen_uuid'];

                                            status_absen_ceklog = data_absen.null_employees[row]['data']
                                                [
                                                    format_date_day
                                                ]
                                                ['cek_log'];

                                            if (status_absen == null) {
                                                status_absen = '-';
                                            }

                                            if (!status_absen_ceklog) {
                                                status_absen_ceklog = '-';
                                            }
                                        } catch (error) {
                                            status_absen = '-';
                                            status_absen_ceklog = '-';
                                        }
                                        // cg(row.employee_uuid,data_absen.null_employees[row.employee_uuid]);

                                        return `<div>
                                                <h4 class="mb-0 h4">${status_absen}</h4>                              
                                                    <small>${status_absen_ceklog}</small>                             
                                            </div>`
                                    }
                                };

                                data_column.push(element_profile_empl);
                                data_null_employees_column.push(element_profile_null_empl)


                                var newDate = loop.setDate(loop.getDate() + 1);
                                loop = new Date(newDate);
                            }
                            let have_employees = Object.keys(data_absen['have_employees']['detail']);
                            conLog('have_employees', have_employees)

                            $(`#table-have-employees`).DataTable({
                                scrollX: true,
                                data: have_employees,
                                columns: data_column,
                            });

                            let data_null_employees =[] ;

                            if(data_absen['null_employees']){
                                data_null_employees = Object.keys(data_absen['null_employees']);
                            }

                            conLog('data_null_employees', data_null_employees);

                            $(document).ready(function() {
                                $(`#table-null-employees`).DataTable({
                                    scrollX: true,
                                    data: data_null_employees,
                                    columns: data_null_employees_column,
                                });
                            });

                            cg('variable_header', variable_header);




                            $('#after-import').show();
                            return false;
                            getDataAbsensi();
                            // response.data.
                            // refreshTableAfterImport();
                            return false;
                            window.location.href = "/user/absensi/after-import";
                        }
                        $('#loading-modal').modal('hide');
                    },
                    error: function(response) {
                        cg('errr', response);
                        alertModal()
                    }
                });
            }

            function updateFingger(employee_uuid, nik_employee) {
                cg(employee_uuid, nik_employee);
                $('#employee_uuid').val(employee_uuid);
                $('#update-fingger-modal').modal('show');
            }

            function reportOpenModalReportStatusAbsen() {
                let button = document.getElementById('btn-list-ketidakhadiran');
                button.click();
                $('#modal-report-status-absen').modal('show');
            }

            function storeFingger(idForm) {
                if (isRequiredCreate(['employee_uuid']) > 0) {
                    return false;
                }

                globalStoreNoTable(idForm).then((data) => {
                    console.log('data store employees')
                    let user = data.data;
                    console.log(data);
                    stopLoading();
                    $('#success-modal-id').modal('show')
                })
            }
        </script>

        <script>
            async function storeListAbsensi(id_list_form) {
                var form = document.getElementById(id_list_form);
                var formData = new FormData(form);


                formData.forEach((value, key) => {
                    console.log(key, value);
                });
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                // return false;
                try {
                    $.ajax({
                        url: '/web/pengelolaan/absensi/post/list',
                        type: "POST",
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            // $('#loading-modal').modal('hide');
                            conLog('responseess', response);
                        },
                        error: function(response) {
                            cg('errr', response);
                            // alertModal()
                        }
                    });

                } catch (error) {
                    console.error('Error:', error);
                    alert('File upload failed due to network error.');
                }
            }
        </script>

        {{-- kehadiran --}}
        <script>
            function openModalKehadiran() {
                $(`#form-kehadiran`).empty();
                createFormFieldTable('form-kehadiran', 'KEHADIRAN');
                $(`#modal-kehadiran`).modal('show');
                $("#mySelect").select2({
                    //here my options
                }).on("select2:opening",
                    function() {
                        $("#modal-kehadiran").removeAttr("tabindex", "-1");
                    }).on("select2:close",
                    function() {
                        $("#modal-kehadiran").attr("tabindex", "-1");
                    }
                );
            }
        </script>
    @endsection

    @section('js_ready')
        refreshTable();
    @endsection

    @section('src_javascript')
        <script src="/src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
        <script src="/src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
    @endsection()
