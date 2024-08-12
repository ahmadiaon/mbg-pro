@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Absensi Karyawans</h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false">
                            Menu <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="btn-export" onclick="exportEmployee()"  href="#">Export Karyawan</a>
                        </div>
                    </div>
                </div>  
            </div>
        </div>

        <table id="table-have-employees" class="display nowrap stripe hover table" style="width:100%">
            <thead>
                <tr id="header-table-have-employees">
                    <th>Detail Data Karyawan</th>
                    <th>Nama fingger</th>
                </tr>
            </thead>
        </table>
    </div>


    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Absensi Karyawan belum terkonfigurasi</h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">
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

        <table id="table-null-employees" class="display nowrap stripe hover table" style="width:100%">
            <thead>
                <tr id="header-table-null-employees">
                    <th>Nama fingger</th>
                    <th>Detail Data Karyawan</th>
                </tr>
            </thead>
        </table>


    </div>

    <!-- Import End -->
    <div class="modal fade" id="import-modal" role="dialog" aria-labelledby="import-modalTitle" aria-hidden="true">
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
                            <input name="uploaded_file" type="file" class="form-control-file form-control height-auto" />
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

    <!-- Update FIngger -->
    <div class="modal fade" id="update-fingger-modal" role="dialog" aria-labelledby="import-modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-update-fingger" action="/user/absensi/store-fingger" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Fingger</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama pada mesin</label>
                            <input name="employee_uuid" id="employee_uuid" type="text"
                                class="form-control-file form-control height-auto" />
                        </div>
                        <div class="form-group">
                            <label>Karyawan</label>
                            <select name="nik_employee" id="nik_employee" style="width: 100%"
                                class="custom-select2 form-control employees">

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" onclick="storeFingger('update-fingger')"
                            class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let data_absen = @json(session('after-import'));
        cg('data_absen', data_absen);
        let have_employees = data_absen['have_employees']['data'];



        let null_employees = data_absen['null_employees'];

        let data_null_employees = [];
        if(null_employees){
            Object.values(null_employees).forEach(null_employee => {
                data_null_employees.push(null_employee);
            });
        }
        

        


        




        let data_column = [];
        let data_null_employees_column = [];

        var element_profile_employeess = {
            mRender: function(data, type, row) {
                cg('row',row)
                // // data_database.data_employees[row.nik_employee]['']
                // if (data_database.data_employees[row.nik_employee]['photo_path'] == null) {
                //     data_database.data_employees[row.nik_employee]['photo_path'] = '/vendors/images/photo4.jpg';
                // }
                if (!data_database.data_employees[row.nik_employee]) {
                    data_database.data_employees[row.nik_employee]['photo_path'] = '/vendors/images/photo4.jpg';
                }
                return `<div class="name-avatar d-flex align-items-center">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="${data_database.data_employees[row.nik_employee]['photo_path']}" class="border-radius-100 shadow" width="40"
												height="40" alt="" />
										</div>
										<div class="txt">
											<div class="weight-600">${data_database.data_employees[row.nik_employee]['name']}</div>
											<small>${data_database.data_employees[row.nik_employee]['position']}</small></br>
											<small>${data_database.data_employees[row.nik_employee]['nik_employee']}</small>
										</div>
									</div>`
            }
        };



        data_column.push(element_profile_employeess);
        // data_column.push(element_profile_employeess);

        // nama fingger
        elements = {
            mRender: function(data, type, row) {
                let emp = row.employee_uuid;
                let mcd = row.machine_id;
                return  emp+"-"+mcd
            }
        };

        data_column.push(elements)

        cg('after import', data_absen);

        var start = new Date(data_absen['have_employees']['configuration']['first_date']);
        var end = new Date(data_absen['have_employees']['configuration']['end_date']);

        var loop = new Date(start);
        let x = 1;

        let variable_header = [];
        while (loop < end) {
            variable_header.push(formatDate(loop));
            var newDate = loop.setDate(loop.getDate() + 1);
            loop = new Date(newDate);
        }
        cg('variable_header', variable_header);

        elements = {
            mRender: function(data, type, row) {
                return row.employee_uuid
            }
        };
        data_null_employees_column.push(elements)
        
        //select2 employees
        elements = {
            mRender: function(data, type, row) {
                return `   <button onclick="updateFingger('${row.employee_uuid}', '')" type="button" class="btn btn-secondary mr-1  py-1 px-2">
											<i class="icon-copy ion-gear-b"></i>
										</button>`
            }
        };
        data_null_employees_column.push(elements)

        variable_header.forEach(element_header => {
            $(`#header-table-have-employees`).append(` <th>${element_header}</th>`);
            $(`#header-table-null-employees`).append(` <th>${element_header}</th>`);

            element_profile_empl = {
                mRender: function(data, type, row) {
                    let status_absen = data_absen.have_employees['detail'][row.nik_employee][element_header]
                        ['status_absen_uuid'];
                    let status_absen_ceklog = data_absen.have_employees['detail'][row.nik_employee][
                        element_header
                    ]['cek_log'];

                    if (status_absen == null) {
                        status_absen = '-';
                    }

                    if (!status_absen_ceklog) {
                        status_absen_ceklog = '-';
                    }
                    return `<div>
                                <h4 class="mb-0 h4">${status_absen}</h4>                              
                                    <small>${status_absen_ceklog}</small>                             
                            </div>`
                }
            };

            element_profile_null_empl = {
                mRender: function(data, type, row) {
                    // cg(row.employee_uuid,data_absen.null_employees[row.employee_uuid]);
                    let status_absen = data_absen.null_employees[row.employee_uuid]['data'][element_header]
                        ['status_absen_uuid'];

                    let status_absen_ceklog = data_absen.null_employees[row.employee_uuid]['data'][
                            element_header
                        ]
                        ['cek_log'];

                    if (status_absen == null) {
                        status_absen = '-';
                    }

                    if (!status_absen_ceklog) {
                        status_absen_ceklog = '-';
                    }
                    return `<div>
                                <h4 class="mb-0 h4">${status_absen}</h4>                              
                                    <small>${status_absen_ceklog}</small>                             
                            </div>`
                }
            };
            data_column.push(element_profile_empl);
            data_null_employees_column.push(element_profile_null_empl)
        });





        $(document).ready(function() {
            $(`#table-have-employees`).DataTable({
                scrollX: true,
                data: have_employees,
                columns: data_column,
            });
        });

        $(document).ready(function() {
            $(`#table-null-employees`).DataTable({
                scrollX: true,
                data: data_null_employees,
                columns: data_null_employees_column,
            });
        });


        function storeFingger(idForm) {
            if (isRequiredCreate(['employee_uuid']) > 0) {
                return false;
            }
            globalStoreNoTable(idForm).then((data) => {
                console.log('data store employees')
                let user = data.data;
                console.log(data);

                stopLoading();
                $('#success-modal-id').modal('show')
            })
        }

        function exportEmployee() {
            cg('data_absen', data_absen);
            
            let data_ex = JSON.stringify(data_absen);
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/user/absensi/export-after-import',
                type: "POST",
                data: {
                    _token: _token,
                    data_ex: data_ex,

                },
                success: function(response) {
                    cg('responses', response);
                    var dlink = document.createElement("a");
                    dlink.href = `/${response.data}`;
                    dlink.setAttribute("download", "");
                    dlink.click();
                    cg('a','b');
                },
                error: function(response) {
                    alertModal()
                }
            });
        }


        function updateFingger(employee_uuid, nik_employee) {
            cg(employee_uuid, nik_employee);
            $('#employee_uuid').val(employee_uuid);
            $('#update-fingger-modal').modal('show');
        }

        // no employee
    </script>
@endsection
