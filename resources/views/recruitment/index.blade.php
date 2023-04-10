@extends('template.admin.main_privilege')

@section('content')
    <div class="row">
        <div class="col-12 card-box mb-20">
            <div class="row pd-20">
                <div class="col-auto">
                    <h4 class="text-blue h4">Form Recruitment(PPK) </h4>
                </div>
                <div class="col text-right">
                    <div class="btn-group">
                        <button onclick="createRecruitment()" class="btn btn-secondary">Tambah</button>

                        <div class="btn-group dropdown">
                            <button type="button" class="btn btn-primary dropdown-toggle waves-effect"
                                data-toggle="dropdown" aria-expanded="false">
                                Menu <span class="caret"></span>
                            </button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" id="btn-export" href="/database/recruitment/export">Export</a>
                                <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                    href="">Import</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <table id="table-recruitment" class="display nowrap stripe hover table mb-20" style="width:100%">
                <thead>
                    <tr>
                        <th>Perekrut</th>
                        <th>Posisi</th>
                        <th>Jumlah</th>
                        <th>Tujuan</th>
                        <th>Status</th>//open, close, full
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Simple Datatable End -->
    {{-- modal add user privilege --}}
    <div class="modal fade" id="createRecruitment" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/form-recruitment/store" id="form-recruitment" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="uuid" id="uuid">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Form Recruitment
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Perekrut</label>

                            <select name="employee_recruiter" style="width: 100%" id="employee_recruiter"
                                class="data_employees custom-select2 form-control">
                                <option value="">Kosong</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Tempat Peruntukan</label>
                                    <select name="company_uuid" style="width: 100%" id="company_uuid"
                                        class="data_companies custom-select2 form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="">Jabatan PPK</label>
                                    <select name="position_uuid" style="width: 100%" id="position_uuid"
                                        class="data_positions custom-select2 form-control">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Jumlah  (orang)</label>
                                    <input type="text" name="much_recruitment" id="much_recruitment" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Status PPK</label>
                                    <select name="status_recruitment" id="status_recruitment" class="form-control status_recruitment">

                                    </select>
                                </div>
                            </div>
                        </div>


                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">tanggal mulai</label>
                                    <input type="date" name="date_start" id="date_start" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">tanggal selesai</label>
                                    <input type="date" name="date_end" id="date_end" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" onclick="store('recruitment')" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Simple Datatable End -->
    <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-import" action="/database/recruitment/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih File</label>
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
        function firstFormRecruitment() {
            cg('companies', @json(session('data_companies')));
            data_employees = data_database.data_employees;
            Object.values(data_employees).forEach(employees_element => {
                $('.data_employees').append(
                    `<option value="${employees_element.nik_employee}">${employees_element.name}-${employees_element.position}</option>`
                    );
            });

            let data_positions =   Object.values(data_database.data_positions);
            data_positions.forEach(position_element => {
                $('.data_positions').append(
                    `<option value="${position_element.uuid}">${position_element.position}</option>`);
            });

            let status_recruitment =   Object.values(data_database.data_atribut_sizes['status_recruitment']);
            cg('status recruitment',status_recruitment );
            status_recruitment.forEach(status_recruitment_element => {
                $('.status_recruitment').append(
                    `<option value="${status_recruitment_element.uuid}">${status_recruitment_element.name_atribut}</option>`);
            });

            let data_companies = @json(session('data_companies'));
            data_companies.forEach(company_element => {
                $('.data_companies').append(
                    `<option value="${company_element.uuid}">${company_element.company}</option>`);
            });
            showDataTableRecruitment('recruitment/data', [ 'much_recruitment', 'company_uuid'],
                'recruitment')
        }

        function showDataTableRecruitment(url, dataTable, id) {
            let data = [];
            data.push(element_profile_employee_database);

            var element_position = {
                mRender: function(data, type, row) {
                    cg('',row);
                    return data_database.data_positions[row.position_uuid]['position']
                }
            };
            data.push(element_position);

            var element_much = {
                mRender: function(data, type, row) {
                    return row.much_recruitment
                }
            };
            data.push(element_much);

            var element_company = {
                mRender: function(data, type, row) {
                    return row.company_uuid
                }
            };
            data.push(element_company);

            var element_status = {
                mRender: function(data, type, row) {
                    let status_recruitment = 'Open';
                   
                    return  data_database.data_atribut_sizes['all'][row.status_recruitment]['name_atribut']
                }
            };
            data.push(element_status);

           
            var elements = {
                mRender: function(data, type, row) {
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
            data.push(elements)

            let urls = '{{ env('APP_URL') }}' + url
            console.log(urls)
            $('#table-' + id).DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: urls,
                columns: data
            });
        }

        firstFormRecruitment();

        function createRecruitment() {
            $('#createRecruitment').modal('show');
            $('#form-recruitment')[0].reset();
        }

        function store(idForm) {
            if (isRequiredCreate(['date_start', 'position_uuid', 'company_uuid', 'much_recruitment']) > 0) {
                return false;
            }
            var isStored = globalStore(idForm)
        }

        function deleteData(uuid) {
            let _url = '/form-recruitment/delete'

            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('recruitment')
        }

        function editData(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/form-recruitment/show";
            cg('uuid',uuid);
            // startLoading();
            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    uuid: uuid,
                    _token: _token
                },
                success: function(response) {
                    stopLoading()
                    data = response.data
                    console.log(data)
                    $('#uuid').val(data.uuid)
                    $('#employee_recruiter').val(data.employee_recruiter).trigger("change")
                    $('#company_uuid').val(data.company_uuid).trigger("change")
                    $('#position_uuid').val(data.position_uuid).trigger("change")
                    $('#much_recruitment').val(data.much_recruitment)
                    $('#status_recruitment').val(data.status_recruitment)
                    $('#date_start').val(data.date_start)
                    $('#date_end').val(data.date_end)
                    $('#createRecruitment').modal('show')
                },
                error: function(response) {
                    console.log(response)
                    alertModal()
                }
            });
        }
    </script>
@endsection
