@extends('template.admin.main_privilege')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Daftar Lowongan</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Daftar Lowongan
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <h4 class="mb-10 mt-30 text-blue h4">Lamar berdasarkan Posisi</h4>
    <div class="row">

        <div class="col-md-12 mb-30">
            <form action="/app/user/apply/store" id="form-position-apply" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="employee_uuid" class="employee_uuid">

                <div class="card-box pricing-card-style2">
                    <div class="pricing-card-header">
                        <div class="left">
                            <h5>Pilih Posisi</h5>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Daftar Posisi</label>
                        <select name="position_uuid" style="width: 100%" id="position_uuid"
                            class="custom-select2 form-control data_positions">
                        </select>
                    </div>
                    <div id="btn-position-apply">
                        
                    </div>
                </div>
            </form>
        </div>
    </div>

    <h4 class="mb-30 mt-30 text-blue h4">Daftar Lowongan</h4>
    <div class="row list-recruitment">

    </div>

    <!-- Simple Datatable End -->
    {{-- modal add user privilege --}}
@endsection

@section('js')
    <script>
        function firstFormRecruitment() {
           
            let button_free_position = ` <a href="/recruitment/up">
                            <button type="button" 
                            class="btn btn-primary btn-rounded btn-lg">Registrasi</button>
                        </a>`;
            let uuid = @json(session('recruitment-user'));
            cg('ahmadi', @json(session('recruitment-user')));           
            if(uuid){
                button_free_position = `<button type="button" onclick="store('position-apply')"
                            class="btn btn-primary btn-rounded btn-lg">Lamar Sekarang</button>`;
                     
                uuid = @json(session('recruitment-user'));
                uuid = uuid.detail.nik_number;
            }

            $(`#btn-position-apply`).empty();
            $(`#btn-position-apply`).append(button_free_position);

            $('.employee_uuid').val(uuid);
            let post_data = {
                uuid: 'ini uuid'
            }
            cg('da', data_database);
            let data_positions = Object.values(data_database.data_positions);
            data_positions.forEach(position_element => {
                $('.data_positions').append(
                    `<option value="${position_element.uuid}">${position_element.position}</option>`);
            });
            
            getPPK();
            return false;
           

            let data_employees = data_database.data_employees;
            Object.values(data_employees).forEach(employees_element => {

                $('.data_employees').append(
                    `<option value="${employees_element.nik_employee}">${employees_element.name}-${employees_element.position}</option>`
                );
            });

            let status_recruitment = Object.values(data_database.data_atribut_sizes['status_recruitment']);
            cg('status recruitment', status_recruitment);
            status_recruitment.forEach(status_recruitment_element => {
                $('.status_recruitment').append(
                    `<option value="${status_recruitment_element.uuid}">${status_recruitment_element.name_atribut}</option>`
                );
            });
            let data_companies = @json(session('data_companies'));
        }

        firstFormRecruitment();

        function getPPK(){
            let uuid = @json(session('recruitment-user'));
            let nik  = '';
            if(uuid){
                nik = uuid.detail.uuid;
            }
            getData('/recruitment/data').then((data_value_element) => {
                data_user = data_value_element.data;
                cg('data recruitment' ,data_value_element );
                data_user.forEach(element => {
                    let data_status = 'disabled';
                    if (element.status_recruitment == 'open_recruitment') {
                        data_status = ''
                    }
                    let button_porpos_this_ppk = '';
                    if(uuid){
                        button_porpos_this_ppk = `<button ${data_status} type="button" onclick="store('recruitment-apply-${element.uuid}')"
                                        class="btn btn-primary btn-rounded btn-lg">Lamar Sekarang</button>`;
                    }else{
                        button_porpos_this_ppk = `
                        <a href="/recruitment/up">
                            <button type="button" 
                            class="btn btn-primary btn-rounded btn-lg">Registrasi</button>
                        </a>
                                        `;
                    }
                    
                   
                   
                    let element_data_recruitment = `
                    <div class="col-md-4 mb-30">
                        <form action="/app/user/apply/store" id="form-recruitment-apply-${element.uuid}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="employee_uuid" value="${nik}" class="employee_uuid" >
                            <input type="hidden" name="recruitment_uuid" value="${element.uuid}">
                            <div class="card-box pricing-card-style2">
                                <div class="pricing-card-header">
                                    <div class="left">
                                        <h5>${data_database.data_positions[element.position_uuid]['position']}</h5>
                                    </div>
                                    <div class="right">
                                        <div class="pricing-price">${element.much_recruitment}<span>orang</span></div>
                                    </div>
                                </div>
                                <div class="pricing-card-body">
                                    <div class="pricing-points">
                                        <ul>
                                            <li>Surat Lamaran Kerja</li>
                                            <li>KTP (.pdf)</li>
                                            <li>CV (.pdf)</li>
                                            <li>dokumen lainnya (.pdf)</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="cta">
                                    ${button_porpos_this_ppk}
                                </div>
                            </div>
                        </form>
                    </div>`;
                    $('.list-recruitment').append(element_data_recruitment);
                });
            });
        }



        function store(idForm) {
            if (isRequiredCreate(['date_start', 'position_uuid', 'company_uuid', 'much_recruitment']) > 0) {
                return false;
            }
            var isStored = globalStore(idForm)
        }
    </script>
@endsection
