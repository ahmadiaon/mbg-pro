@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Daftar perubahan karywan</h4>
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
                                <a class="dropdown-item" href="/employee-changge/create">Tambah</a>
                                <a class="dropdown-item" id="btn-export"disabled href="/employee-changge/export/">Export</a>
                                <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                    href="">Import</a>
                                <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#createModald"
                                    href="">Tambah + Data</a>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div>
        <div id="the-table">
            <div class="pb-20" id="tablePrivilege">
                <table id="table-employee-out" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal Perubahan</th>
                            <th>Status</th>
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
            <form id="form-import" action="/employee-changge/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import Perubahan Karyawan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih Perubahan Karyawan</label>
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
            <form id="form-employee-changge" action="/employee-changge/store" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Perubahan Karyawan</h5>
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
                                <option value="Resign">Resign</option>
                                <option value="S-PHK">S-PHK</option>
                                <option value="Pensiun">Pensiun</option>
                                <option value="Meninggal Dunia">Meninggal Dunia</option>
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
                    <div class="form-group">
                        <label>Multiple Select</label>
                        <select class="custom-select2 form-control" multiple="multiple" style="width: 100%">
                            <optgroup label="Alaskan/Hawaiian Time Zone">
                                <option value="AK">Alaska</option>
                                <option value="HI">Hawaii</option>
                            </optgroup>
                            <optgroup label="Pacific Time Zone">
                                <option value="CA">California</option>
                                <option value="NV">Nevada</option>
                                <option value="OR">Oregon</option>
                                <option value="WA">Washington</option>
                            </optgroup>
                            <optgroup label="Mountain Time Zone">
                                <option value="AZ">Arizona</option>
                                <option value="CO">Colorado</option>
                                <option value="ID">Idaho</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NM">New Mexico</option>
                                <option value="ND">North Dakota</option>
                                <option value="UT">Utah</option>
                                <option value="WY">Wyoming</option>
                            </optgroup>
                        </select>
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
        var employees = @json($employees);
        employees.forEach(element => {
            var elements = `<option value="${element.uuid}">${element.name} - ${element.position}</option>`;
            // console.log(element);
            $('#employee_uuid').append(elements);
        });


        let year_month = @json($year_month);
        let arr_year_month = year_month.split("-")
        $('#btn-year').html(arr_year_month[0]);
        $('#btn-month').html(months[arr_year_month[1]]);
        $('#btn-month').val(arr_year_month[1]);
        $('#btn-day').html("Perbulan");
        $('#btn-export').attr('href', '/employee-changge/export/' + year_month)

        console.log("last day : " + year_month);

        reloadTable(year_month)

        $.ajax({
            url: '/employee-out/data',
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                year_month: year_month
            },
            success: function(response) {
                console.log(response)
            },
            error: function(response) {
                alertModal()
            }
        });


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

        // function showDataTableEmployeeHourMeterMonth(url, dataTable, id) {
        function showDataTableEmployeeHourMeterMonth(url, id) {
            console.log(year_month)
            let data = [];

            var element_employee = {
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
            data.push(element_employee)

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
                    console.log(row)
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
                        year_month: year_month
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
                <table id="table-employee-out" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal Perubahan</th>
                            <th>Status</th>
                            <th>Dokumen</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>`;

            $('#the-table').append(table_element);
            $('#btn-export').attr('href', 'employee-changge/export/' + year_month)
            console.log('year:' + year_month)
            showDataTableEmployeeHourMeterMonth('url', 'table-employee-out')
        }
    </script>
@endsection
