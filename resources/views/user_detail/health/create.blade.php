@extends('template.admin.main_privilege')

@section('content')
    <div class="the-content">
        <div id="create-user-health" class="children-content">
            <form action="/app/user/health/store" id="form-user-health" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="isEdit" id="isEdit-create-user-health">
                <input type="text" name="uuid" id="uuid-create-user-health" value="">
                <input type="text" name="user_detail_uuid" id="user_detail_uuid-create-user-health">
                <div class="min-height-200px">
                    <div class="pd-20 card-box mb-20">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Identitas Karyawan</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label>Penyakit/Kecelakaan/Gejala</label>
                                    <input name="name_health" id="name_health" class="form-control" id="name_health"
                                        placeholder="Asma" type="text">
                                </div>

                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input class="form-control" name="year" id="year" placeholder="2012" type="text">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>RS/Puskesmas</label>
                                    <input name="health_care_place" class="form-control" id="health_care_place"
                                        placeholder="RS Mitra Barito" type="text">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Lama (Bulan)</label>
                                    <input name="long" class="form-control" id="long" placeholder="12" type="text">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Sembuh</label>
                                    <select name="status_health" class="selectpicker form-control">
                                        <option value="Sembuh">
                                            Sembuh
                                        </option>
                                        <option value="Belum Sembuh">
                                            Belum Sembuh
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group text-right">
                                    <button type="button"
                                        class="btn btn-secondary  mr-10 create-user-employee-back">Back</button>
                                    <button type="button" onclick="storeUserHealth('user-health')"
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
    function firstCreateUserHealth() {
        let uuid = @json(session('recruitment-user'))['detail']['nik_employee'];
            cg('uuid', uuid);
            if(uuid != null){
                setValue('/get/data/' + uuid, 'user-health');
            }
    }

    function storeUserHealth(idForm) {
        if (isRequiredCreate(['kosong']) > 0) {
            return false;
        }
        globalStoreNoTable(idForm).then((data) => {
            let user = data.data;
            console.log(data);          
            stopLoading();
            $('#success-modal-id').modal('show')
        })
    }
    firstCreateUserHealth();
</script>

@endsection
