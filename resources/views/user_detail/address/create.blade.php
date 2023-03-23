@extends('template.admin.main_privilege')

@section('content')
    <div class="the-content">
        <div id="create-user-address" class="children-content">
            <form action="/app/user/address/store" id="form-user-address" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="uuid" id="uuid-create-user-address">
                <input type="text" name="user_detail_uuid" id="user_detail_uuid-create-user-address">
                <div class="min-height-200px">
                    <div class="pd-20 card-box mb-20">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Alamat Karyawan</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>POH</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="poh_uuid" id="poh_uuid" class="selectpicker form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Kabupaten</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="kabupaten" class="form-control " value="" id="kabupaten"
                                        placeholder="" type="text">
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="provinsi" class="form-control " value="" id="provinsi"
                                        placeholder="" type="text">
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="kecamatan" class="form-control " value="" id="kecamatan"
                                        placeholder="" type="text">
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Desa</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="desa" class="form-control " value="" id="desa" placeholder=""
                                        type="text">
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>RT</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input name="rt" class="form-control " value="" id="rt" placeholder=""
                                        type="text">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>RW</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input name="rw" class="form-control " value="" id="rw" placeholder=""
                                        type="text">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group text-right">
                                    <button type="button"
                                        class="btn btn-secondary  mr-10 create-user-employee-back">Back</button>
                                    <button type="button" onclick="storeUserAddress('user-address')"
                                        class="btn btn-primary">Simpan</button>
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

        function firstCreateUserAddress() {
            let uuid = @json(session('recruitment-user'))['detail']['nik_employee'];
            cg('uuid', uuid);
            if(uuid != null){
                setValue('/get/data/' + uuid, 'user-address');
            }
        }

        function storeUserAddress(idForm) {
            if (isRequiredCreate(['kabupaten']) > 0) {
                return false;
            }
            globalStoreNoTable(idForm).then((data) => {
                let user = data.data;
                cg('user',user);
                stopLoading();
                $('#success-modal-id').modal('show');
            })
        }

        $('#poh_uuid').empty();
        Object.values(data_database.data_atribut_sizes.poh_uuid).forEach(poh_element => {
            $('#poh_uuid').append(
                `<option value="${poh_element.uuid}">${poh_element.name_atribut}</option>`);
        });
        if (@json(session('recruitment-user')) != null) {
            firstCreateUserAddress();
        }
    </script>
@endsection
