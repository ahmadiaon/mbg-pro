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
                            <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                                data-toggle="dropdown" aria-expanded="false" id="btn-day" value="Perbulan">
                                <span id="btn-day" class="caret"></span>
                            </button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" onclick="refreshTable(null, null )" href="#">Perbulan</a>

                                <div class="row">
                                    <div class="col-3">
                                        <div class="btn-group-vertical" id="ten-one">
                                            {{-- tanggal 1- 10 --}}
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="btn-group-vertical" id="ten-two">
                                            {{-- tanggal 11-20 --}}
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="btn-group-vertical" id="ten-three">
                                            {{-- tanggal 20-akhir --}}
                                        </div>
                                    </div>
                                </div>

                                <label for=""></label>
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
                            <th>Value Full</th>
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
@endsection

@section('js')
    <script>
        console.log('employee_hour_meter_day index');
        let nik_employee = @json($nik_employee);
        console.log(nik_employee)


        let year;
        let month;
        let v_year;
        let v_month;
        let _ur;

        function firstEmployeeHourMeter() {
            year = arr_date_today.year;
             month = arr_date_today.month;
             v_year = arr_date_today.year;
             v_month = arr_date_today.month;
             
            $('#btn-year').html(arr_date_today.year);
            $('#btn-month').val(arr_date_today.month);
            $('#btn-month').html(monthName(arr_date_today.month));
            setDatesMonth();
            showDataTableEmployeeHourMeteDay()
            $('#btn-day').html("Perbulan");
            $('#btn-export').attr('href', '/hour-meter/export/' +arr_date_today.year+'-'+ arr_date_today.month)
        }
        firstEmployeeHourMeter()

        function showDataTableEmployeeHourMeteDay() {
            $('#employee-hour-meter-day').empty()
            let for_nik_employee = `<th>Action</th>`;
            if(nik_employee){
                for_nik_employee ='';
            }
            $('#employee-hour-meter-day').append(`
            <table id="table-employee-hour-meter" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Value Full</th>
                            ${for_nik_employee}
                        </tr>
                    </thead>
                </table>
            `)
            let data = [];
            // from global
            data.push(element_profile_employee);
            var elem = {
                mRender: function(data, type, row) {
                    let cc = Number(row.hour_meter_full_value);
                    cc = cc.toFixed(2);
                    return `<button type="button" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="right"
								title="jumlah slip :${row.count_hour_meter}, hm tanpa bonus : ${row.hour_meter_value}">
								${cc}
							</button>`
                }
            };
            data.push(elem)

            var elements = {
                mRender: function(data, type, row) {
                    let element_action = '';
                    if (row.hour_meter_uuid) {
                        element_action = `
									<div class="form-inline"> 
										<a href="/hour-meter/show/${row.hour_meter_uuid}">
											<button  type="button" class="btn btn-primary mr-1  py-1 px-2">
												<small>detail</small>
											</button>
										</a>
									</div>`;
                    } else {
                        element_action = `
									<div class="form-inline"> 
										<a href="/hour-meter/show/${row.uuid}/${arr_date_today.year+'-'+arr_date_today.month}">
											<button  type="button" class="btn btn-primary mr-1  py-1 px-2">
												<small>detail</small>
											</button>
										</a>
									</div>`;
                    }
                    return element_action;
                }
            };
            if(!nik_employee){
                data.push(elements)
            }
            
            console.log('arr_date_today')
            console.log(arr_date_today)
            $('#' + 'table-employee-hour-meter').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: {
                    url: '/hour-meter/data',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        year:arr_date_today.year,
                        month:arr_date_today.month,
                        day:arr_date_today.day,
                        employee_uuid: nik_employee
                    },
                    type: 'POST',
                },
                columns: data
            });
        }

        function setDatesMonth() {
            var date = new Date(),
                y = arr_date_today.year,
                m = arr_date_today.month - 1;
            var firstDay = new Date(y, m, 1);
            var lastDay = new Date(y, m + 1, 0);
            $('#ten-one').empty();
            $('#ten-two').empty();
            $('#ten-three').empty();
            for (let a = 1; a <= 10; a++) {
                $('#ten-one').append(
                    `<button onclick="refreshTable(null, null, ${a})"  type="button" class="btn btn-sm btn-primary">${a}</button>`
                );
            }
            for (let b = 11; b <= 20; b++) {
                $('#ten-two').append(
                    `<button onclick="refreshTable(null, null, ${b})" type="button" class="btn btn-sm btn-primary">${b}</button>`
                );
            }
            for (let c = 21; c <= lastDay.getDate(); c++) {
                $('#ten-three').append(
                    `<button onclick="refreshTable(null, null, ${c})" type="button" class="btn btn-sm btn-primary">${c}</button>`
                );
            }
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

            if (val_day) {
                $('#btn-day').html(val_day);
                arr_date_today.day = val_day;
                showDataTableEmployeeHourMeteDay();
                return false;
            }
            $('#btn-export').attr('href', '/hour-meter/export/' +arr_date_today.year+'-'+ arr_date_today.month)
            arr_date_today.day = null;
            $('#btn-day').html("Perbulan");
            setDatesMonth()
            showDataTableEmployeeHourMeteDay();
            setDateSession(year, month);
        }
  
    </script>
@endsection
