<div id="create-user-employee" class="children-content">
    <form action="/user-employee/store" id="form-user-employee" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="isEdit" id="isEdit-create-user-employee">
        <input type="text" name="user_detail_uuid" id="user_detail_uuid-create-user-employee">
        <input type="text" name="uuid" id="uuid-create-user-employee">
        <div class="min-height-200px">

            <!-- Identitas Karyawan -->
            <div class="pd-20 card-box mb-20">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Identitas Karyawan</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Perusahaan</label>
                            <select name="company_uuid" onchange="newValue()" id="company_uuid" class="form-control">

                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Department</label>
                            <select name="department_uuid" id="department_uuid" style="width: 100%" class="custom-select2 form-control">

                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <select name="position_uuid" style="width: 100%" id="position_uuid" class="custom-select2 form-control">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Kontrak Status</label>
                                                    <select onchange="newValue()" name="contract_status"
                                                        id="contract_status" class="form-control">
                                                        <option value="PKWT">
                                                            PKWT</option>
                                                        <option value="PKWTT">
                                                            PKWTT</option>
                                                        <option value="Pinjaman">
                                                            Pinjaman</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Employee Status</label>
                                                    <select name="employee_status" class="form-control">
                                                        <option value="Training">
                                                            Training</option>
                                                        <option value="Profesional">
                                                            Profesional</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>Roster</label>
                                                        <select id="roaster_uuid" name="roaster_uuid"
                                                            class="form-control">

                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Tanggal Masuk</label>
                                                    <input onkeyup="newValue()" id="date_document_contract"
                                                        name="date_document_contract" class="form-control"
                                                        placeholder="Select Date" type="date" />
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Tgl Mulai Kontrak</label>
                                                    <input onkeyup="newValue()" id="date_start_contract"
                                                        name="date_start_contract" class="form-control"
                                                        placeholder="Select Date" type="date" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Lama</label>
                                                    <input onkeyup="newValue()" id="long_contract" name="long_contract"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Kontrak Berakhir</label>
                                                    <input id="date_end_contract" type="date"
                                                        name="date_end_contract" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">No Kontrak</label>
                                    <div class="row">
                                        <div class="col-2">
                                            <input onkeyup="newValue()" type="text" name="contract_number"
                                                id="contract_number" class="form-control">
                                        </div>
                                        <div class="col-10">
                                            <input type="text" name="contract_number_full" id="contract_number_full"
                                                class="form-control">
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">NIK Karyawan</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="text" name="nik_employee" id="nik_employee"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nama Fingger</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="text" id="machine_id" name="machine_id"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Group Pajak</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <select name="tax_status" id="tax_status" class="form-control">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <label class="weight-600">Keikutsertaan BPJS</label>
                                <div class="row mb-20">
                                    <div class="col-auto">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input onchange="setChecked('is_bpjs_kesehatan')" type="checkbox"
                                                class="custom-control-input" id="is_bpjs_kesehatan">
                                            <label class="custom-control-label" for="is_bpjs_kesehatan">
                                                kesehatan</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input onchange="setChecked('is_bpjs_ketenagakerjaan')" type="checkbox"
                                                class="custom-control-input" id="is_bpjs_ketenagakerjaan">
                                            <label class="custom-control-label" for="is_bpjs_ketenagakerjaan">
                                                Ketenagakerjaan</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input"
                                                onchange="setChecked('is_bpjs_pensiun')" id="is_bpjs_pensiun">
                                            <label class="custom-control-label" for="is_bpjs_pensiun"> Hari
                                                Tua</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group date_start">
                                            <label for="">Tanggal Mulai Berlaku</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="date" name="date_start" id="date_start-user-employee"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group text-right">
                                            <button type="button"
                                                class="btn btn-secondary  mr-10 create-user-employee-back">Back</button>
                                            <button type="button" onclick="storeUserEmployee('user-employee')"
                                                class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
