@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Absensi Karyawan </h4>
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
                            <a class="dropdown-item" onclick="refreshTable(null, 01 )" href="#">Januari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 02 )" href="#">Februari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 03 )" href="#">Maret</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 04 )" href="#">April</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 05 )" href="#">Mei</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 06 )" href="#">Juni</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 07 )" href="#">Juli</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 08 )" href="#">Agustus</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 09 )" href="#">September</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 10 )" href="#">Oktober</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 11 )" href="#">November</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 12 )" href="#">Desember</a>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false">
                            Menu <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="btn-export" href="/user/absensi/export/">Export + Data</a>
                            <a class="dropdown-item" id="btn-export-template" href="/user/absensi/export-template/">Export
                                Template</a>
                            <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                href="">Import</a>
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
                            <th>Nama</th>
                            <th>Dibayar</th>
                            <th>Potongan</th>
                            <th>Alpha</th>
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
            <form id="form-import" action="/user/absensi/import" method="post" enctype="multipart/form-data">
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
        let year;
        let month;
        let v_year;
        let v_month;
        let _ur;



        function firstIndexEmployeeAbsen() {

            let year = arr_date_today.year;
            let month = arr_date_today.month;
            let v_year = arr_date_today.year;
            let v_month = arr_date_today.month;
            let _url = 'user/absensi/data/' + arr_date_today.year + '-' + arr_date_today.month;

            $('#btn-year').html(arr_date_today.year);
            $('#btn-month').html(months[parseInt(arr_date_today.month)]);
            $('#btn-month').val(arr_date_today.month);
            $('#btn-export').attr('href', '/user/absensi/export/' + arr_date_today.year + '-' + arr_date_today.month)
            $('#btn-export-template').attr('href', '/user/absensi/export-template/' + arr_date_today.year + '-' +
                arr_date_today.month)
            showDataTableEmployeeAbsen(_url, ['pay', 'cut', 'A'], 'table-privilege')
        }
        firstIndexEmployeeAbsen();

        function showDataTableEmployeeAbsen(url, dataTable, id) {
            $('#tablePrivilege').remove();
            var table_element = ` 
                                         <div class="pb-20" id="tablePrivilege">
                                            <table id="table-privilege" class="display nowrap stripe hover table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Dibayar</th>
                                                        <th>Potongan</th>                                                        
                                                        <th>Alpa</th>     
                                                         <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>`;

            $('#the-table').append(table_element);
            let data = [];

            data.push(element_profile_employee)

            dataTable.forEach(element => {
                var dataElement = {
                    data: element,
                    name: element
                }
                data.push(dataElement)
            });

            var elements = {
                mRender: function(data, type, row) {
                    return `
									<div class="form-inline"> 
                                        <a href="/user/absensi/detail/${ v_year}-${ v_month}/${row.nik_employee}">
										<button type="button" class="btn btn-secondary mr-1  py-1 px-2">
											<i class="dw dw-edit2"></i>
										</button>
                                        </a>
									</div>`
                }
            };
            data.push(elements)

            let urls = '/' + url
            console.log(urls)
            $('#' + id).DataTable({
                processing: true,
                // columnDefs: [
                //                     { "visible": false, "targets": 3 }
                //                 ],
                serverSide: false,
                responsive: true,
                ajax: urls,
                columns: data
            });
        }

        function refreshTable(val_year = null, val_month = null) {
            if (val_year) {
                v_year = arr_date_today.year = val_year;
                $('#btn-year').html(val_year);
            }
            cg
            if (val_month) {
                v_month = arr_date_today.month = val_month;
                $('#btn-month').html(monthName(arr_date_today.month));
                $('#btn-month').val(val_month);
            }

            $('#btn-export').attr('href', '/user/absensi/export/' + arr_date_today.year + '-' + arr_date_today.month)
            $('#btn-export-template').attr('href', '/user/absensi/export-template/' + arr_date_today.year + '-' +
                arr_date_today.month)
            let _url = 'user/absensi/data/' + arr_date_today.year + '-' + arr_date_today.month;
            showDataTableEmployeeAbsen(_url, ['pay', 'cut', 'A'], 'table-privilege')
            setDateSession(arr_date_today.year, arr_date_today.month);
        }
    </script>
@endsection
