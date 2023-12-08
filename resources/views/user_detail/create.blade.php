@extends('template.admin.main_privilege')

@section('content')
    <div id="create-user-detail" class="children-content mb-20">
        <form action="/app/user/detail/store" id="form-user-detail" method="POST" enctype="multipart/form-data">
            @csrf
            
            <input type="text" name="uuid" id="uuid-create-user-detail">
            <input type="text" name="date_start" id="date_start">
            <input type="text" name="date_end" id="date_end">
            <div class="min-height-200px card-box pd-20 ">
                <div class="mb-20">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4 mb-20">Data Identitas</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 card-box mb-20 mr-20">
                            <div class="form-group">
                                <label>Nama</label>
                                <input name="name" class="form-control" value="" id="name"
                                    placeholder="Ahmadi Alpasyri" type="text">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input name="nik_number" class="form-control" value="" id="nik_number"
                                            placeholder="6210000" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Nomor Kartu Keluarga</label>
                                            <input name="kk_number" class="form-control" value="" id="kk_number"
                                                placeholder="62111" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kewarganegaraan</label>
                                        <select name="citizenship" id="citizenship" class=" form-control">
                                           
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <select name="religion_uuid" id="religion_uuid" class=" form-control">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                        <input name="place_of_birth" class="form-control" value="" id="place_of_birth"
                                            placeholder="Muara Teweh" type="text">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input name="date_of_birth" id="date_of_birth" class="form-control"
                                            placeholder="Select Date" type="date" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Golongan Darah</label>
                                        <select name="blood_group" id="blood_group" class="form-control">
                                           

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="status"class=" form-control">
                                            <option value="Lajang">
                                                Lajang</option>
                                            <option value="Menikah">
                                                Menikah</option>
                                            <option value="Duda">
                                                Duda
                                            </option>
                                            <option value="Janda">
                                                Janda</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" id="gender" class=" form-control">
                                           
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 card-box">
                            <div class=" mt-20 mb-30 pd-20">
                                {{-- norek --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor Rekening</label>
                                            <input name="financial_number" class="form-control " value=""
                                                id="financial_number" placeholder="000" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Rekening</label>
                                            <input name="financial_name" class="form-control " value=""
                                                id="financial_name" placeholder="Ahmadi" type="text">
                                        </div>
                                    </div>
                                </div>
                                {{-- nohap --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nomor Handphone</label>
                                            <input name="phone_number" class="form-control" value=""
                                                id="phone_number" placeholder="Nomor HP" type="text">
                                        </div>
                                    </div>
                                </div>
                                {{-- npwp --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nomor NPWP</label>
                                            <input name="npwp_number" class="form-control" value=""
                                                id="npwp_number" placeholder="Nomor NPWP" type="text">
                                        </div>
                                    </div>
                                </div>
                                {{-- bpjs --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>BPJS Ketenagakerjaan</label>
                                            <input name="bpjs_ketenagakerjaan" class="form-control" value=""
                                                id="bpjs_ketenagakerjaan" placeholder="Muara Teweh" type="text">

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label>BPJS kesehatan</label>
                                            <input name="bpjs_kesehatan" class="form-control" value=""
                                                id="bpjs_kesehatan" placeholder="Muara Teweh" type="text">

                                        </div>
                                    </div>
                                </div>

                                <button type="button" onclick="storeUserDetail('user-detail')"
                                    class="btn btn-primary mt-30 mb-20 float-right">Simpan</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        function firstCreateUserDetail() {
            let uuid = @json(session('recruitment-user'))['detail']['nik_employee'];
            cg('session', @json(session('recruitment-user')));
            if(uuid != null){
                setValue('/get/data/' + uuid, 'user-detail');
            }
        }

        function storeUserDetail(idForm) {
            if (isRequiredCreate(['name', 'nik_number', 'kk_number']) > 0) {
                return false;
            }
            globalStoreNoTable(idForm).then((data) => {
                let user = data.data;
               
                stopLoading();
                $('#success-modal-id').modal('show');
            })
        }

        $('#religion_uuid').empty();
        Object.values(data_database.data_atribut_sizes.religion_uuid).forEach(religion_element => {
            $('#religion_uuid').append(
                `<option value="${religion_element.uuid}">${religion_element.name_atribut}</option>`);
        });

        Object.values(data_database.data_atribut_sizes.citizenship).forEach(citizenship_element => {
            $('#citizenship').append(
                `<option value="${citizenship_element.uuid}">${citizenship_element.name_atribut}</option>`);
        });

        Object.values(data_database.data_atribut_sizes.gender).forEach(gender_element => {
            $('#gender').append(
                `<option value="${gender_element.uuid}">${gender_element.name_atribut}</option>`);
        });

        Object.values(data_database.data_atribut_sizes.blood_group).forEach(blood_group_element => {
            $('#blood_group').append(
                `<option value="${blood_group_element.uuid}">${blood_group_element.name_atribut}</option>`);
        });
        
        cg('session first', @json(session('recruitment-user')));
        if (@json(session('recruitment-user')) != null) {
            firstCreateUserDetail();
        }
    </script>
@endsection
