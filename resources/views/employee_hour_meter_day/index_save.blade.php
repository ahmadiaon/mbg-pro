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
                            <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                                data-toggle="dropdown" aria-expanded="false" id="btn-day" value="Perbulan">
                                <span id="btn-day" class="caret"></span>
                            </button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" onclick="refreshTable(null, 12 )" href="#">Perbulan</a>

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
                <table id="table-employee-hour-meter" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Value Full</th>
                            <th>Harga</th>
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
        console.log('arr_date_today');
        console.log(arr_date_today);

        function firstHourMeter(){
            
        }

        let nik_employee = @json($nik_employee);
        if (nik_employee) {
            console.log(nik_employee);
        } else {
            console.log('kosong');
        }
        let year_month = @json($year_month);
        let arr_year_month = year_month.split("-")
        $('#btn-year').html(arr_year_month[0]);
        $('#btn-month').html(months[arr_year_month[1]]);
        $('#btn-month').val(arr_year_month[1]);
        $('#btn-day').html("Perbulan");
        $('#btn-export').attr('href', '/hour-meter/export/' + year_month)

        var date = new Date(),
            y = arr_year_month[0],
            m = arr_year_month[1];
        var firstDay = new Date(y, m, 1);
        var lastDay = new Date(y, m + 1, 0);
        console.log("last day : " + lastDay.getDate());

        reloadTable(year_month)


        // function showDataTableEmployeeHourMeterMonth(url, dataTable, id) {
        function showDataTableEmployeeHourMeterMonth(url, id) {
            
            let data = [];
            var elements = {
                mRender: function(data, type, row) {
                    if (row.photo_path == null) {
                        row.photo_path = '/vendors/images/photo4.jpg';
                    }
                    if (row.photo_path == null) {
                        row.photo_path = '/vendors/images/photo4.jpg';
                    }
                    // console.log('aaa');
                    return `<div class="name-avatar d-flex align-items-center">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="${row.photo_path}" class="border-radius-100 shadow" width="40"
												height="40" alt="" />
										</div>
										<div class="txt">
											<div class="weight-600">${row.name}</div>
											<small>${row.position}</small></br>
											<small>${row.nik_employee}</small>
										</div>
									</div>`
                }
            };
            data.push(elements);
            var elem = {
                mRender: function(data, type, row) {

                    return `<button type="button" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="right"
								title="jumlah slip :${row.count_hour_meter}, hm tanpa bonus : ${row.hour_meter_value}">
								${row.hour_meter_full_value}
							</button>`
                }
            };
            data.push(elem)
            // dataTable.forEach(element => {
            //     var dataElement = {
            //         data: element,
            //         name: element
            //     }
            //     data.push(dataElement)
            // });
            // description




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
										<a href="/hour-meter/show/${row.uuid}/${year_month}">
											<button  type="button" class="btn btn-primary mr-1  py-1 px-2">
												<small>detail</small>
											</button>
										</a>
									</div>`;
                    }
                    return element_action;
                }
            };
            data.push(elements)
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


            if (val_day) {
                $('#btn-day').html(val_day);
                let val_all = year_month + '-' + val_day;
                console.log(val_all)
                eachDay(val_all);
                return false;
            }

            $('#btn-day').html("Perbulan");
            setDates(v_year, v_month);

            reloadTable(year_month)
        }

        function setDates(val_year, val_month) {
            var date = new Date(),
                y = val_year,
                m = val_month - 1;
            var firstDay = new Date(y, m, 1);
            var lastDay = new Date(y, m + 1, 0);
            $('#ten-one').empty();
            $('#ten-two').empty();
            $('#ten-three').empty();
            for (let a = 1; a <= 10; a++) {
                $('#ten-one').append(
                    `<button onclick="refreshTable(null, null, ${a})"  type="button" class="btn btn-light">${a}</button>`
                );
            }
            for (let b = 11; b <= 20; b++) {
                $('#ten-two').append(
                    `<button onclick="refreshTable(null, null, ${b})" type="button" class="btn btn-light">${b}</button>`
                );
            }
            for (let c = 21; c <= lastDay.getDate(); c++) {
                $('#ten-three').append(
                    `<button onclick="refreshTable(null, null, ${c})" type="button" class="btn btn-light">${c}</button>`
                );
            }

            console.log("last day : " + lastDay.getDate());
        }

        function eachDay(year_month_day) {
            console.log('year_month_day :' + year_month_day);
            $('#tablePrivilege').remove();
            var table_element = ` 
            <div class="pb-20" id="tablePrivilege">
                <table id="table-employee-hour-meter" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Value Full</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>`;

            $('#the-table').append(table_element);

            $('#btn-export').attr('href', 'hour-meter/export/' + year_month_day)

            let _url = 'hour-meter/data-day/' + year_month_day;
            console.log('url:' + _url)
            showDataTableEmployeeHourMeterMonth(_url,
                // showDataTableEmployeeHourMeterMonth(_url, ['hour_meter_price'],
                'table-employee-hour-meter')
        }

        function reloadTable(year_month) {

            $('#tablePrivilege').remove();
            var table_element = ` 
            <div class="pb-20" id="tablePrivilege">
                <table id="table-employee-hour-meter" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Value Full</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>`;

            $('#the-table').append(table_element);

            $('#btn-export').attr('href', 'hour-meter/export/' + year_month)
            console.log('year:' + year_month)
            let _url = 'hour-meter/data/' + year_month;
            console.log(_url);
            showDataTableEmployeeHourMeterMonth(_url,
                // showDataTableEmployeeHourMeterMonth(_url, ['hour_meter_price'],
                'table-employee-hour-meter')
        }
    </script>
@endsection
