@extends('template.admin.main_privilege')

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
                <table id="table-employee-hour-meter" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Absen</th>
                            <th>HM</th>
                            <th>Tonase</th>
                            <th>Pembayaran</th>
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
        $('#btn-year').html(arr_year_month[0]);
        $('#btn-month').html(months[arr_year_month[1]]);
        $('#btn-month').val(arr_year_month[1]);
        $('#btn-export').attr('href', '/hour-meter/export/' + year_month)

        // $.ajax({
        //         url: '/allowance/data',
        //         type: "POST",
        //         data:  {
        //                 _token: $('meta[name="csrf-token"]').attr('content'),
        //                 year_month: year_month,
        //             },
        //         success: function(response) {
        //             $('#success-modal').modal('show')
		// 			console.log(response)
		// 			// $('#table-'+idForm).DataTable().ajax.reload();
        //         },
        //         error: function(response) {
        //             alertModal()					
		// 		}
        //     });


        let _url = 'hour-meter/data/' + year_month;
        showDataTableEmployeeHourMeterMonth(_url, ['amount_pay','amount_hm','amount_tonase','count_tonase_full_value','amount_value_payment'],
            'table-employee-hour-meter')

        function showDataTableEmployeeHourMeterMonth(url, dataTable, id) {
            $('#tablePrivilege').remove();
            var table_element = ` 
            <div class="pb-20" id="tablePrivilege">
                <table id="table-employee-hour-meter" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Absen</th>
                            <th>HM</th>
                            <th>Tonase</th>
                            <th>Pembayaran</th>
                            <th>Pembayaran</th>
                        </tr>
                    </thead>
                </table>
            </div>`;

            console.log('year_month : '+year_month);

            $('#the-table').append(table_element);
            let data = [];
            var elements = {
                mRender: function(data, type, row) {
                    if (row.photo_path == null) {
                        row.photo_path = '/vendors/images/photo4.jpg';
                    }
                    if (row.photo_path == null) {
                        row.photo_path = '/vendors/images/photo4.jpg';
                    }
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
                ajax: {
                    url: '/allowance/data',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        year_month: year_month,
                    
                    },
                    type: 'POST',

                },
                columns: data
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
            year_month = v_year + '-' + v_month;
            $('#btn-export').attr('href', 'hour-meter/data/' + year_month)
            let _url = 'hour-meter/data/' + year_month;
            showDataTableEmployeeHourMeterMonth(_url, ['amount_pay','amount_hm','amount_tonase','count_tonase_full_value','amount_value_payment'],
                'table-employee-hour-meter')
        }
    </script>
@endsection

{{-- 
<th>Karyawan</th>
<th>Absensi</th>
<th>HM</th>
<th>Tonase</th>
<th>Mobilisasi</th>
<th>Loading</th> --}}
