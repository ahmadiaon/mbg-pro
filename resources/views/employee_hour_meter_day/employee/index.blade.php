@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">HM Saya</h4>
            </div>
            
            <div class="col text-right">
                <div class="btn-group">
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
                </div>
            </div>
           
        </div>
        <div id="the-table">
            <div class="pb-20" id="tablePrivilege">
                <table id="table-employee-hour-meter" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>HM</th>
                            <th>HM + Bonus</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        let nik_employee = @json($nik_employee);
        if(nik_employee){
            console.log(nik_employee);
        }else{
            console.log('kosong');
        }
        let year_month = @json($year_month);
        let arr_year_month = year_month.split("-")
        $('#btn-year').html(arr_year_month[0]);
        $('#btn-month').html(months[arr_year_month[1]]);
        $('#btn-month').val(arr_year_month[1]);

        var date = new Date(), y = arr_year_month[0], m = arr_year_month[1];
        var firstDay = new Date(y, m, 1);
        var lastDay = new Date(y, m + 1, 0);
        console.log("last day : "+lastDay.getDate());
        
        reloadTable(year_month)


        function showDataTableEmployeeHourMeterMonth(url, dataTable, id) {
            let data = [];
            dataTable.forEach(element => {
                var dataElement = {
                    data: element,
                    name: element
                }
                data.push(dataElement)
            });

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
        function refreshTable(val_year = null, val_month = null, val_day) {
            console.log('val_year :' +val_year+ 'val_month :' +val_month+ 'val_day :' +val_day);
           
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
            
            reloadTable(year_month)
        }



        function reloadTable(year_month) {

            $('#tablePrivilege').remove();
            var table_element = ` 
            <div class="pb-20" id="tablePrivilege">
                <table id="table-employee-hour-meter" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>HM</th>
                            <th>HM + Bonus</th>
                            <th>Harga</th>
                            <th>Shift</th>
                        </tr>
                    </thead>
                </table>
            </div>`;

            $('#the-table').append(table_element);

            console.log('year:' + year_month)
            let _url = 'hour-meter/data/employee-month/'+nik_employee+'/'+year_month;
            console.log(_url);
            showDataTableEmployeeHourMeterMonth(_url, ['date','hour_meter_value','hour_meter_full_value','shift','hour_meter_price'],
            'table-employee-hour-meter')
        }
    </script>
@endsection
