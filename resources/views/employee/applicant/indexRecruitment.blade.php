@extends('template.admin.main_privilege')

@section('content')
    <div class="row">
        <div class="col-12 card-box mb-20">
            <div class="row pd-20">
                <div class="col-auto">
                    <h4 class="text-blue h4">Daftar Pelamar</h4>
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
                        <th>Posisi</th>
                        <th>Jenis Lamaran</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Document</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>                    
                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <iframe id="path_doc" src="" style="width:100%; height:500px;" frameborder="0"></iframe>
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
        function showdoc(path) {
            $('#path_doc').attr("src", "{{ env('APP_URL') }}file/document/employee/" + path)
            $('#doc').modal('show')
        }

        function firstFormRecruitment() {
            
            data_employees = data_database.data_employees;
            Object.values(data_employees).forEach(employees_element => {
                $('.data_employees').append(
                    `<option value="${employees_element.nik_employee}">${employees_element.name}-${employees_element.position}</option>`
                );
            });

            let data_positions = Object.values(data_database.data_positions);
            data_positions.forEach(position_element => {
                $('.data_positions').append(
                    `<option value="${position_element.uuid}">${position_element.position}</option>`);
            });

            let status_recruitment = Object.values(data_database.data_atribut_sizes['status_recruitment']);
            cg('status recruitment', status_recruitment);
            status_recruitment.forEach(status_recruitment_element => {
                $('.status_recruitment').append(
                    `<option value="${status_recruitment_element.uuid}">${status_recruitment_element.name_atribut}</option>`
                );
            });

            let data_companies = @json(session('data_companies'));
            data_companies.forEach(company_element => {
                $('.data_companies').append(
                    `<option value="${company_element.uuid}">${company_element.company}</option>`);
            });
            showDataTableRecruitment('applicant/data', ['much_recruitment', 'company_uuid'],
                'recruitment')
        }

        function showDataTableRecruitment(url, dataTable, id) {
            let uuid = @json(session('recruitment-user'))['detail']['nik_employee'];
            let data = [];
            var element_position = {
                mRender: function(data, type, row) {
                    return data_database.data_positions[row.position_uuid]['position']
                }
            };
            data.push(element_position);

            var element_kind = {
                mRender: function(data, type, row) {
                    let kind_apply = 'Mandiri';
                    if (row.recruitment_uuid) {
                        kind_apply = 'PPK';
                    }
                    return kind_apply
                }
            };
            data.push(element_kind);

            var element_date = {
                mRender: function(data, type, row) {
                    return row.date_applicant
                }
            };
            data.push(element_date);

            

            var element_status = {
                mRender: function(data, type, row) {
                    return row.status_applicant
                }
            };
            data.push(element_status);

            var element_action = {
                mRender: function(data, type, row) {
                    let element_btn_action = `<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
												href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a  onclick="deleteData('` + row.uuid + `')" class="dropdown-item" href="#"><i class="dw dw-delete-3"></i>
													Delete</a>
											</div>
										</div>`;
                    return element_btn_action
                }
            };
            data.push(element_action);

            

            console.log(uuid)
            $('#table-' + id).DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: {
                    url:'/app/data/applicant',
                    type: "POST",
                    data:  {
                        _token: $('meta[name="csrf-token"]').attr('content'),                       
                        employee_uuid: uuid,
                    },
                },               
                columns: data
            });
        }

        function deleteData(uuid){
            let _url = '/app/applicant/delete';
            
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('recruitment')
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


        function editData(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/form-recruitment/show";
            cg('uuid', uuid);
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
