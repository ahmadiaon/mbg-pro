<div id="create-user-health" class="children-content">
    <form action="/user-health/store" id="form-user-health" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="isEdit" id="isEdit" value="">
        <input type="text" name="uuid" id="uuid-user-health" value="">
        <input type="text" name="user_detail_uuid" id="user_detail_uuid-user-health">
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
                        <button type="button" onclick="storeUserHealth('user-health')"
                            class="btn btn-primary mt-10 float-right">Next Step</button>
                    </div>
                </div>

            </div>
        </div>

    </form>
</div>
