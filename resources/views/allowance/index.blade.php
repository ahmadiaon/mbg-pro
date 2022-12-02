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
        let nik_employee = '';
        if (nik_employee) {
            console.log(nik_employee);
        } else {
            console.log('kosong');
        }
        let year_month = @json($year_month);
        let arr_year_month = year_month.split("-")
        let v_year = $('#btn-year').html();
        let v_month = $('#btn-month').val();

        var date = new Date(), y = date.getFullYear(), m = date.getMonth();
        var lastDay = new Date(y, m + 1, 0);
        let day_month = lastDay.getDate();
        console.log(day_month);
        let moreData;
        let hour_meter_prices = @json($hour_meter_prices);
        
        
        
        $('#btn-year').html(arr_year_month[0]);
        $('#btn-month').html(months[arr_year_month[1]]);
        $('#btn-month').val(arr_year_month[1]);
        $('#btn-export').attr('href', '/hour-meter/export/' + year_month)
        refreshTable();
        function showDataTableEmployeeHourMeterMonth(url, dataTable, id) {


            // $.ajax({
            //     url: '/allowance/more-data',
            //     type: "POST",
            //     data:  {
            //             _token: $('meta[name="csrf-token"]').attr('content'),
            //             year_month: year_month,
            //         },
            //     success: function(response) {
            //         // $('#success-modal').modal('show')
			// 		console.log(response)
            //         moreData = response.data.hm;
			// 		// $('#table-'+idForm).DataTable().ajax.reload();
            //     },
            //     error: function(response) {
            //         alertModal()					
			// 	}
            // });




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
                nik_employee : 'NIK',
                name : 'Nama',
                position : 'Jabatan',
                date_start_contract : 'TMK',
            };

            


            console.log(identities)
            let header_element='';
            let elements = '';


            let arr_identities = [];
            for (var key in identities) {
                header_element = `<th>${identities[key]}</th>`;
                $('#header-table').append(header_element);
                arr_identities.push(key);
            }

            arr_identities.forEach(element_identity => {
                elements = {
                    mRender: function(data, type, row) {
                        return row[element_identity];
                    }
                };
                data_column.push(elements);
            });

            let long_work_day;



            //  lama bekerja
            header_element = `<th>Lama Bekerja</th>`;
            $('#header-table').append(header_element);
            elements = {
                    mRender: function(data, type, row) {
                        var date1 = new Date(row.date_start_contract);
                        var date2 = new Date(year_month+'-'+lastDay);
                        var Difference_In_Time = date2.getTime() - date1.getTime();
                        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                        long_work_day = Difference_In_Days;
                        return Difference_In_Days;
                    }
                };
            data_column.push(elements);


            // Absensi
            for(let i=1; i<= lastDay; i++){
                header_element = `<th>${i}</th>`;
                $('#header-table').append(header_element);
                elements = {
                    mRender: function(data, type, row) {
                        return  row['day-'+i];
                    }
                };
                data_column.push(elements);
            }


             //  
            $('#header-table').append(`<th>Hari Dibayar</th>`);
            elements = {
                    mRender: function(data, type, row) {
                       return (long_work_day < day_month)?long_work_day:row.pay;
                    }
                };
            data_column.push(elements);
            $('#header-table').append(`<th>Gapok</th>`);
            elements = {
                    mRender: function(data, type, row) {
                        return `Rp. `+row.salary;
                    }
                };
            data_column.push(elements);
            $('#header-table').append(`<th>Gapok Dibayar</th>`);
            elements = {
                    mRender: function(data, type, row) {
                        return (long_work_day < day_month)?'Rp. '+parseFloat(long_work_day * row.salary/day_month).toFixed(2):'Rp. '+row.salary;
                    }
                };
            data_column.push(elements);
            
            hour_meter_prices.forEach(hour_meter_price => {
                $('#header-table').append( `<th>${hour_meter_price.name}</th>`);
                elements = {
                    mRender: function(data, type, row) {
                        return  row[hour_meter_price.uuid];
                    }
                };
                data_column.push(elements);
            });

            // total hm

            $('#header-table').append( `<th>Total HM</th>`);
            elements = {
                mRender: function(data, type, row) {
                    let total_hm= 0;
                    hour_meter_prices.forEach(hm_price => {
                        total_hm = total_hm + hm_price.value * row[hm_price.uuid];
                    });
                    return  total_hm;
                }
            };
            data_column.push(elements);
           total_hm = 0;



            let urls = '{{ env('APP_URL') }}' + url
            console.log(urls)
            $('#' + id).DataTable({
                scrollX: true,
                scrollY:        "400px",
                paging:         false,
                // fixedColumns: {
                //     leftColumns: 2
                // },
                serverSide: true,
                ajax: {
                    url: '/allowance/data',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        year_month: year_month,
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

