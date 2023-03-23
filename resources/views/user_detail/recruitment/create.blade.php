@extends('template.admin.main_privilege')

@section('content')
    <div class="the-content">
        <div id="create-user-detail" class="children-content">
            <form action="/recruitment/user-detail/store" id="form-user-detail" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="text" name="uuid" id="uuid-user-detail">
                <input type="text" name="isEdit" id="isEdit-create-user-detail">
                <div class="min-height-200px">
                    <div class="pd-20 card-box mb-20">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Identitas</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="pd-20 card-box mb-30">
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
                                                    <input name="kk_number" class="form-control" value=""
                                                        id="kk_number" placeholder="62111" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kewarganegaraan</label>
                                                <select name="citizenship" id="citizenship" class=" form-control">
                                                    <option value="WNI">WNI</option>
                                                    <option value="WNA">WNA</option>
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
                                                <input name="place_of_birth" class="form-control" value=""
                                                    id="place_of_birth" placeholder="Muara Teweh" type="text">
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
                                                    <option value="unknown">
                                                        Tak Diketahui</option>
                                                    <option value="A">A
                                                    </option>
                                                    <option value="B">B
                                                    </option>
                                                    <option value="AB">
                                                        AB
                                                    </option>
                                                    <option value="O">O
                                                    </option>

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
                                                    <option value="Laki-laki">
                                                        Laki-laki</option>
                                                    <option value="Perempuan">
                                                        Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="pd-20 card-box mb-30">
                                    {{-- norek --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nomor Rekening BNI</label>
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
                                        class="btn btn-primary mt-30 float-right">Next
                                        Step</button>
                                    <button type="button"
                                        class="btn btn-secondary mt-30 float-right mr-10 create-user-employee-back">Back</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('js')
    <script>
        let religions = @json($religions);

        function firstCreateUserDetail(uuid) {

            $('#religion_uuid').empty();
            religions.forEach(religion_element => {
                $('#religion_uuid').append(
                    `<option value="${religion_element.uuid}">${religion_element.religion}</option>`);
            });
        }
        firstCreateUserDetail(null)

        function storeUserDetail(idForm) {
            if (isRequiredCreate(['name']) > 0) {
                return false;
            }
            globalStoreNoTable(idForm).then((data) => {
                let user = data.data;
                console.log(user);

                stopLoading();
                if (user.uuid) {
                    _url = '/recruitment/user-address/create'
                    $.ajax({
                        url: _url,
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            uuid:user.uuid
                        },

                        error: function(response) {
                            alertModal()
                        }
                    });
                }
            })

        }
    </script>
@endsection
