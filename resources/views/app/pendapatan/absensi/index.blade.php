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
        <div id="the-table">
            <div class="pb-20" id="tablePrivilege">
                <div class="row pd-20" id="row-absen">
                    <div class="col-auto mb-5 card-box pd-2 mr-3">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto mb-5 mr-3 card-box">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto mb-5 card-box pd-2 mr-3">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto mb-5 mr-3 card-box">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto mb-5 card-box pd-2 mr-3">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto mb-5 mr-3 card-box">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto mb-5 card-box pd-2 mr-3">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto mb-5 mr-3 card-box">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto mb-5 card-box pd-2 mr-3">
                        <div class="form-group">
                            <label for="">1 sen</label>
                            <div class=""><button class="btn btn-primary">DS</button></div>
                        </div>
                    </div>
                    <div class="col-auto mb-5 mr-3 card-box">
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
@endsection()

@section('script_javascript')
    <script>
        conLog('ui_dataset', ui_dataset)
        let variable_local;
        let data_absensi = null;
        function refreshTable(ui_year, ui_month, ui_day) {
            setUIdate(ui_year, ui_month, ui_day)
            let _token = $('meta[name="csrf-token"]').attr('content');

            let today = new Date()
            let date_start = ui_dataset.ui_dataset.ui_date.year + '-' + ui_dataset.ui_dataset.ui_date.month + '-01';
            let date_end_day = ui_dataset.ui_dataset.ui_date.year + '-' + ui_dataset.ui_dataset.ui_date.month + '-' +
                getEndDate(ui_dataset.ui_dataset.ui_date.year, ui_dataset.ui_dataset.ui_date.month).getDate();

            let date_date_end_day = new Date(date_end_day);


            conLog('dates', date_date_end_day)

            if (date_date_end_day > today) {
                date_end_day = formatDate(today);
            }
            conLog('date_end_day', date_end_day)


            $('#row-absen').empty();
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
                    conLog('response', response)
                    data_absensi = null;
                    conLog('data_absensi', data_absensi)
                    $('#row-absen').append(`
                         <div class="col-12 py-1">
                            <div class="card-box card-box px-2 mb-10">
                                <div class="form-group mb-10">
                                    <label for="">Tidak ditemukan</label>
                                </div>
                            </div>
                        </div>`);
                    if (response['data']) {
                        data_absensi = response['data'][ui_dataset.ui_dataset.user_authentication.nik_employee];
                        conLog('data_absensi', data_absensi)
                        $('#row-absen').empty()
                        if (response['data'][ui_dataset.ui_dataset.user_authentication.nik_employee]) {
                            var loop = new Date(date_start);
                            var date_end = new Date(date_end_day);
                            let cek_logs;
                            while (loop <= date_end) {
                                let status_absen_code = '?';
                                let color_button_status_absen = 'ligth'
                                var r = name_days_sort[loop.getDay()];
                                // cg('date', formatDate(loop));
                                if (data_absensi[formatDate(loop)]) {
                                    status_absen_code = data_absensi[formatDate(loop)]['status_absen_code'];
                                    color_button_status_absen = color_button[data_absensi[formatDate(loop)][
                                        'math'
                                    ]]
                                }
                                console.log(formatDate(loop))
                                
                                
                                if(!data_absensi[formatDate(loop)]){
                                    cek_logs =  "kosong";
                                }else{
                                    cek_logs = data_absensi[formatDate(loop)]['cek_log'];
                                }
                                

                                $('#row-absen').append(`
                                    <div class="col-auto py-1">
                                        <div class="card-box card-box px-2 mb-10">
                                            <div class="form-group mb-10">
                                                <label for="">${loop.getDate()} ${r}</label>
                                                <div class=""><button onclick="showCeklog('${formatDate(loop)}')" class="mb-10 btn btn-${color_button_status_absen}">${status_absen_code}</button></div>
                                            </div>
                                        </div>
                                    </div>`);
                                var newDate = loop.setDate(loop.getDate() + 1);
                                loop = new Date(newDate);
                            }
                        }
                    }

                },
                error: function(response) {
                    conLog('response', response)
                    //alertModal()
                }
            });
        }
        setUImonthYear()
        refreshTable(ui_dataset.ui_dataset.ui_date.year, ui_dataset.ui_dataset.ui_date.month, ui_dataset.ui_dataset.ui_date
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
