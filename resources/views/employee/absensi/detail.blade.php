@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Absensi {{ $employee->user_details->name }} - {{ $employee->position }}</h4>
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
                <table id="table-privilege" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Cek Log</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <button type="hidden" id="sa-custom-position"></button>
@endsection

@section('js')
    <script>
        let employees = @json($employee);
        let is = @json($is);
        let data;
        let _url;
        let nik_employee;
        let year_month;
        let el_status_absen;

        nik_employee = @json($nik_employee);
        year_month = @json($year_month);

        reloadTable(year_month)

        function showDataTableUserPrivilege(url, dataTable, id) {
            console.log(dataTable)
            let data = [];
            dataTable.forEach(element => {
                    var dataElement = {
                        data: element,
                        name: element
                    }
                    data.push(dataElement)
                });
            if (is == 'admin') {
          
                var date = {
                    mRender: function(data, type, row) {
                        let status_absens = @json($status_absen);
                        el_status_absen = '';
                        el_status_absen = '<div class="row">';
                        status_absens.forEach(element => {
                            let isChecked = '';
                            if(element.uuid == row.status_absen_uuid){
                                isChecked = 'checked';
                            }else{
                                isChecked = '';
                            }
                            el_status_absen = el_status_absen+ `<div class="col-sd-2">
                                            <div class="custom-control custom-radio">
                                                <input onchange="updateAbsen('${element.uuid}','${row.date}')" ${isChecked} type="radio" id="${row.date}-${element.uuid}" name="${row.date}" class="custom-control-input">
                                                <label class="custom-control-label" for="${row.date}-${element.uuid}">${element.uuid}</label>
                                            </div>
                                        </div>`;
                        });
                        el_status_absen = el_status_absen+ '</div>';
                        return el_status_absen
                    }
                };
                data.push(date)

                var cek_log = {
                    mRender: function(data, type, row) {
                       
                        return row.cek_log;
                    }
                };
                data.push(cek_log)
            }

            let urls = '{{ env('APP_URL') }}' + url
            console.log(urls)
            $('#' + id).DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: urls,
                columns: data
            });
        }

        console.log(employees.machine_id);
        year_month = @json($year_month);
        let arr_year_month = year_month.split("-")
        $('#btn-year').html(arr_year_month[0]);
        $('#btn-month').html(months[arr_year_month[1]]);
        $('#btn-month').val(arr_year_month[1]);

        function refreshTable(val_year = null, val_month = null, val_day) {
            console.log('val_year :' + val_year + 'val_month :' + val_month + 'val_day :' + val_day);

            let v_year = $('#btn-year').html();
            let v_month = $('#btn-month').val();
            console.log(v_month);
            if (val_year) {
                console.log(val_year);
                v_year = val_year;
                $('#btn-year').html(val_year);
            }
            if (val_month) {
                v_month = val_month;
                console.log(val_month);
                $('#btn-month').html(months[val_month]);
                $('#btn-month').val(val_month);
            }
            year_month = v_year + '-' + v_month;


            console.log(year_month);
            $('#tablePrivilege').remove();
            var table_element = ` 
                                         <div class="pb-20" id="tablePrivilege">
                                            <table id="table-privilege" class="display nowrap stripe hover table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                        <th>Cek Log</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>`;
            
             $('#the-table').append(table_element);

            reloadTable(year_month)
        }

        function reloadTable(year_month) {
            if (is == 'me') {
                _url = `user/absensi/data-employee/${year_month}/${nik_employee}`;
                showDataTableUserPrivilege(_url, ['date', 'status_absen_uuid', 'cek_log'], 'table-privilege');
            }else{
                _url = `user/absensi/data-employee/${year_month}/${nik_employee}`;
                showDataTableUserPrivilege(_url, ['date'], 'table-privilege');
            }


        }


        function updateAbsen(status_absen_uuid, date) {
            let employee_uuid = @json($employee->machine_id);
            console.log(status_absen_uuid + date + employee_uuid);
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/user/absensi/store";

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    employee_uuid: employee_uuid,
                    date: date,
                    status_absen_uuid: status_absen_uuid,
                    _token: _token
                },
                success: function(response) {
                    console.log("response")
                    console.log(response);
                    $('#sa-custom-position').click();

                },
                error: function(response) {
                    alertModal();
                    console.log(response);
                }
            });
        }
    </script>
@endsection
