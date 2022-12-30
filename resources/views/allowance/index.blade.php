@extends('template.admin.main_privilege')
@section('css')
<style>
    .DTFC_LeftBodyLiner{
      background : white !important;
      overflow : hidden !important;
    }
</style>
@endsection

@section('content')
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
                                <a class="dropdown-item" id="btn-export"disabled href="/user/absensi/export/">Export</a>
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
@endsection

@section('js')
    <script>

        let year_month = @json($year_month);
        let arr_year_month = year_month.split("-")
        let v_year = $('#btn-year').html();
        let v_month = $('#btn-month').val();

        var date = new Date(), y = date.getFullYear(), m = date.getMonth();
        var lastDay = new Date(y, m + 1, 0);
        let day_month = lastDay.getDate();
        let moreData;
        let hour_meter_prices = @json($hour_meter_prices);
        let companies = @json($companies);
        let premis = @json($premis);

        
        
        $('#btn-year').html(arr_year_month[0]);
        $('#btn-month').html(months[arr_year_month[1]]);
        $('#btn-month').val(arr_year_month[1]);
        $('#btn-export').attr('href', '/hour-meter/export/' + year_month)
        refreshTable();
        function showDataTableEmployeeHourMeterMonth(url, dataTable, id) {

            $('#tablePrivilege').remove();
            var table_element = ` 
            <div class="pb-20" id="tablePrivilege">
                <table id="table-employee-hour-meter" class="display nowrap" cellspacing="0" style="width:100%">
                    <thead>
                        <tr id="header-table">
                           
                        </tr>
                    </thead>
                </table>
            </div>`;

            console.log('year_month : '+year_month);

            $('#the-table').append(table_element);
            let data_column = [];

            let identities = {
                employee_uuid : 'NIK',
                name : 'Nama',
                position : 'Jabatan',
                date_start_contract : 'TMK',
                salary_netto_adjust : 'Gajih Bersih',
                premi_pay_total : 'Premi Total',
                pay_premi_BK : 'Pay Premi BK',
                pay_premi_MB : 'Pay Premi MB',
                salary_payed:'Gajih Dibayar',
                cutted_total:'Total Potongan'
            };

            let header_element='';
            let elements = '';

            let arr_identities = [];
            for (var key in identities) {
                header_element = `<th>${identities[key]}</th>`;
                $('#header-table').append(header_element);
                arr_identities.push(key);
            }
            // return false;

            arr_identities.forEach(element_identity => {
                elements = {
                    mRender: function(data, type, row) {
                        if(row.employee_uuid == 'MBLE-0321100005'){

                            console.log(row);
                        }
                        return row[element_identity];
                    }
                };
                data_column.push(elements);
            });

            $('#header-table').append(`<th>Gajih Pokok</th>`);
            elements = {
                    mRender: function(data, type, row) {
                        return 'Rp.'+row.salary;
                    }
                };
            data_column.push(elements);

            premis.forEach(element => {
                $('#header-table').append(`<th>P-${element.premi_name}</th>`);
                
                elements = {
                        mRender: function(data, type, row) {
                            let premis_ = 0;
                            if(row[element.uuid] === undefined){
                                premis_ =0;
                            }else{
                                premis_  = row[element.uuid]
                            }

                            return premis_;
                        }
                    };
                data_column.push(elements);
            });

            

            // hour_meter_prices.forEach(element => {
            //     $('#header-table').append(`<th>${element.name}</th>`);
                
            //     elements = {
            //             mRender: function(data, type, row) {
            //                 let hm_ = 0;
            //                 if(row[element.uuid] === undefined){
            //                     hm_ =0;
            //                 }else{
            //                     hm_  = row[element.uuid]
            //                 }

            //                 return hm_;
            //             }
            //         };
            //     data_column.push(elements);
            // });


            // companies.forEach(element_tonase => {
            //     $('#header-table').append(`<th>T-${element_tonase.company_uuid}</th>`);
                
            //     element_tonases = {
            //             mRender: function(data, type, row) {
            //                 let tonase_ = 0;
            //                 if(row['tonase_'+element_tonase.uuid] === undefined){
            //                     tonase_ =0;
            //                 }else{
            //                     tonase_  = row['tonase_'+element_tonase.uuid]
            //                 }
            //                 return tonase_;
            //             }
            //         };
            //     data_column.push(element_tonases);
            // });

            // $('#header-table').append(`<th>HM Total</th>`);
            // elements = {
            //         mRender: function(data, type, row) {
            //             // console.log(row)
            //             let hm_pay_total = 0;
            //                 if(row.hm_pay_total === undefined){
            //                     hm_pay_total =0;
            //                 }else{
            //                     hm_pay_total  = row.hm_pay_total
            //                 }
            //                 return hm_pay_total;
            //         }
            //     };
            // data_column.push(elements);

            // $('#header-table').append(`<th>Tonase Total</th>`);
            // elements = {
            //         mRender: function(data, type, row) {
            //             // console.log(row)
            //             let tonase_pay_total = 0;
            //                 if(row.tonase_pay_total === undefined){
            //                     tonase_pay_total =0;
            //                 }else{
            //                     tonase_pay_total  = row.tonase_pay_total
            //                 }

            //                 return tonase_pay_total;
            //         }
            //     };
            // data_column.push(elements);



            let urls = '{{ env('APP_URL') }}' + url
            console.log(urls)
            $('#' + id).DataTable({
                scrollX: true,
                scrollY:        "400px",
                paging:         false,
                // fixedColumns: {
                //     leftColumns: 2
                // },
                serverSide: false,
                ajax: {
                    url: '/allowance/data',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        year_month: year_month,
                        from:'allowance'
                    },
                    type: 'POST',
                },
                columns: data_column
            });
        }

        function refreshTable(val_year = null, val_month = null) {

            console.log('val_year :' + val_year + 'val_month :' + val_month);

            v_year = $('#btn-year').html();
            v_month = $('#btn-month').val();
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
            v_month =  String(v_month).padStart(2, '0')
            lastDay = new Date(v_year, v_month , 0);
            lastDay = lastDay.getDate();
            console.log(lastDay);
            year_month = v_year + '-' + v_month;
            $('#btn-export').attr('href', 'hour-meter/data/' + year_month)
            let _url = 'hour-meter/data/' + year_month;
            showDataTableEmployeeHourMeterMonth(_url, ['nik_employee','name'],
                'table-employee-hour-meter')
        }

        
    </script>
@endsection

