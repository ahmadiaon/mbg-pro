@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Daftar karywan Keluar</h4>
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
                                <a class="dropdown-item" onclick="refreshTable(2024,null , null)" href="#">2024</a>
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
                                <a class="dropdown-item" onclick="createCoalFrom()" href="#">Tambah</a>
                                <a class="dropdown-item" id="btn-export"disabled
                                    href="/employee-out/export">Export</a>
                                <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                    href="">Import</a>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div>
        <div id="the-table">
            <div class="pb-20" id="employee-out">
                <table id="table-employee-out" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal Keluar</th>
                            <th>Alasan</th>
                            <th>Dokumen</th>
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
            <form id="form-import" action="/employee-out/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import Karyawan Keluar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih Karyawan Keluar</label>
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
    {{-- modal create  --}}
    <div class="modal fade" id="createModal" role="dialog" aria-labelledby="import-modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-employee-out" action="/employee-out/store" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Karyawan Keluar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Pilih Karyawan</label>
                            <select style="width: 100%;" name="employee_uuid" id="employee_uuid"
                                class="custom-select2 form-control">
                                <option value="">karyawan</option>
                            </select>
                            <div class="invalid-feedback" id="req-employee_uuid">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Status Keluar</label>
                            <select class="form-control" name="out_status" id="out_status">
                          
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Keluar</label>
                            <input class="form-control" type="date" name="date_out" id="date_out">
                        </div>
                        <div class="invalid-feedback" id="req-date_out">
                            Data tidak boleh kosong
                        </div>
                        <div class="form-group">
                            <label for="">Dokument</label>
                            <input type="hidden" class="form-control" name="document_out_name" id="document_out_name">
                            <input accept=".pdf" id="document_out" name="document_out" class="form-control"
                                type="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" onclick="storePO()" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- modal create with show dokument  --}}
    <div class="modal fade bs-example-modal-lg" id="createModald" role="dialog" style="width:100%"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Karyawan Keluar
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            {{-- <div class="form-group">
                                <label for="">Pilih Karyawan</label>
                                <select style="width: 100%;" name="employee_uuids" id="employee_uuids"
                                    class="custom-select2 form-control">
                                    <option value="">karyawan</option>
                                </select>
                                <div class="invalid-feedback" id="req-employee_uuid">
                                    Data tidak boleh kosong
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Keluar</label>
                                <input class="form-control" type="date">
                            </div>
                            <div class="form-group">
                                <label for="">Dokument</label>
                                <input accept=".pdf" id="document_out" name="document_out" onchange="showDocument()"
                                    class="form-control" type="file">
                            </div> --}}
                        </div>
                        <div class="col-md-7">
                            <div style="text-align: center;">
                                <iframe id="iframe-pdf" src="/file/user/123.pdf" style="width:100%; height:500px;"
                                    frameborder="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Dokumen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <iframe id="path_doc" src="" style="width:100%; height:500px;"
                            frameborder="0"></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
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


        function firstIndexEmployeeOut() {
            cg('arr', arr_date_today);
            let year = arr_date_today.year;
            let month = arr_date_today.month;
            let v_year = arr_date_today.year;
            let v_month = arr_date_today.month;
            let _url = 'user/absensi/data/' + arr_date_today.year + '-' + arr_date_today.month;

            Object.values(data_database.data_employees).forEach(element => {
                var elements = `<option value="${element.uuid}">${element.name} - ${element.position}</option>`;
                // console.log(element);
                $('#employee_uuid').append(elements);
            });
            Object.values(data_database.data_atribut_sizes.status_out).forEach(element_out_status => {
                var elements = `<option value="${element_out_status.uuid}">${element_out_status.name_atribut}</option>`;
                $('#out_status').append(elements);
            });

            $('#btn-year').html(arr_date_today.year);
            $('#btn-month').html(months[parseInt(arr_date_today.month)]);
            $('#btn-month').val(arr_date_today.month);
            showDataTableEmployeeOut( 'table-employee-out')
        }
        firstIndexEmployeeOut();


        function storePO() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/employee-out/store";
            var document_out = $('#document_out')[0].files;

            let muchErr = isRequired(['employee_uuid', 'date_out'])
            console.log('req' + muchErr)

            if (muchErr > 0) {
                return false;
            }

            var form = $('#form-employee-out')[0];
            // console.log(form);
            var form_data = new FormData(form);
            // console.log(form_data);
            $.ajax({
                url: _url,
                type: "POST",

                //   dataType    : 'json',
                contentType: false,
                processData: false,
                data: form_data,
                success: function(response) {
                    data = response.data

                    console.log(response);
                    $('#success-modal').modal('show')
                    $('#table-employee-out').DataTable().ajax.reload();
                },
                error: function(response) {
                    console.log(response)
                }
            });
        }

        function showdoc(path) {
            $('#path_doc').attr("src", "{{ env('APP_URL') }}file/karyawan_keluar/" + path)
            $('#doc').modal('show')
        }

        function createCoalFrom() {
            $('#createModal').modal('show');
            $('#form-employee-out')[0].reset();
        }

        // function showDataTableEmployeeOut(url, dataTable, id) {
        function showDataTableEmployeeOut(id) {

            $('#employee-out').remove();
            var table_element = ` 
            <div class="pb-20" id="employee-out">
                <table id="table-employee-out" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal Keluar</th>
                            <th>Alasan</th>
                            <th>Dokumen</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>`;

            $('#the-table').append(table_element);

            let data = [];

            data.push(element_profile_employee)

            let dataTable = [
                'date_out',
                'out_status'
            ]

            dataTable.forEach(element => {
                var dataElement = {
                    data: element,
                    name: element
                }
                data.push(dataElement)
            });

            var elements_doc = {
                mRender: function(data, type, row) {
                    let btn;
                    if (row.document_path != null) {
                        btn = `<div class="form-inline">
                                                        <button type="button" onclick="showdoc('${row.document_path}')" class="btn btn-sm btn-primary mr-1">Dokumen</button>
                                                    </div>`;
                    } else {
                        btn = 'kosong';
                    }
                    return btn;
                }
            };
            data.push(elements_doc)

            var element_action = {
                mRender: function(data, type, row) {
                    // console.log(row)
                    return `
									<div class="form-inline"> 
										<button onclick="editData('` + row.uuid + `')" type="button" class="btn btn-secondary mr-1  py-1 px-2">
											<i class="icon-copy ion-gear-b"></i>
										</button>
										<button onclick="deleteData('` + row.uuid + `')" type="button" class="btn btn-danger mr-1  py-1 px-2">
											<i class="icon-copy ion-trash-b"></i>
										</button>
									</div>`
                }
            };
            data.push(element_action)

            $('#' + id).DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: {
                    url: '/employee-out/data',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        year_month: arr_date_today.year+'-'+arr_date_today.month
                    },
                    type: 'POST',

                },
                columns: data
            });
        }

        function deleteData(uuid) {
            let _url = '/employee-out/delete'

            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('employee-out')
        }

        function refreshTable(val_year = null, val_month = null, val_day) {
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
            showDataTableEmployeeOut( 'table-employee-out')
            setDateSession(year, month);
        }
    </script>
@endsection
