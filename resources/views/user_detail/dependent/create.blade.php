<div id="create-user-dependent" class="children-content mb-30">
    <form action="/user-dependent/store" id="form-user-dependent" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="user_detail_uuid" id="user_detail_uuid">
        <input type="text" name="isEdit" id="isEdit" value="">
        <div class="min-height-200px">
            <!-- Identitas Karyawan -->
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Tanggungan Keluarga</h4>
                </div>
            </div>
            <div class="pd-20 card-box mb-20">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h6">Ibu Kandung</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input name="mother_name" class="form-control" id="mother_name"
                                placeholder="Muara Teweh" type="text">

                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="mother_gender" id="mother_gender" class="selectpicker form-control">
                                <option value="Laki-laki">
                                    Laki-laki</option>
                                <option selected value="Perempuan">
                                    Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Tempat</label>
                            <input name="mother_place_birth" class="form-control" id="mother_place_birth"
                                placeholder="Muara Teweh" type="text">

                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input name="mother_date_birth" id="mother_date_birth" class="form-control"
                                placeholder="Select Date" type="date" />


                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Pendidikan</label>
                            <input name="mother_education" class="form-control" id="mother_education"
                                placeholder="Muara Teweh" type="text">
                        </div>
                    </div>
                </div>

                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h6">Ayah Kandung</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input name="father_name" class="form-control" id="father_name"
                                placeholder="Nama Ayah" type="text">

                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="father_gender" id="father_gender" class="selectpicker form-control">
                                <option value="Laki-laki">
                                    Laki-laki</option>
                                <option value="Perempuan">
                                    Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Tempat</label>
                            <input name="father_place_birth" class="form-control" id="father_place_birth"
                                placeholder="Muara Teweh" type="text">

                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input name="father_date_birth" id="father_date_birth" class="form-control"
                                placeholder="Select Date" type="date" />


                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Pendidikan</label>
                            <input name="father_education" class="form-control" id="father_education"
                                placeholder="Muara Teweh" type="text">

                        </div>
                    </div>
                </div>

            </div>
            {{-- TIDAK  L A J A N G --}}
            <div id="married" class="pd-20 card-box">
                {{-- hr --}}
                {{-- M E N I K A H --}}
                <div id="out_law">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h6">Ibu Mertua</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input name="mother_in_law_name" class="form-control" id="mother_in_law_name"
                                    placeholder="Nama Ibu mertua" type="text">

                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="mother_in_law_gender" id="mother_in_law_gender"
                                    class="selectpicker form-control">
                                    <option value="Laki-laki">
                                        Laki-laki</option>
                                    <option selected value="Perempuan">
                                        Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Tempat</label>
                                <input name="mother_in_law_place_birth" class="form-control"
                                    id="mother_in_law_place_birth" placeholder="Muara Teweh" type="text">

                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input name="mother_in_law_date_birth" id="mother_in_law_date_birth"
                                    class="form-control" placeholder="Select Date" type="date" />


                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Pendidikan</label>
                                <input name="mother_in_law_education" class="form-control"
                                    id="mother_in_law_education" placeholder="SMA" type="text">

                            </div>
                        </div>
                    </div>

                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h6">Ayah Mertua</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input name="father_in_law_name" class="form-control" id="father_in_law_name"
                                    placeholder="Nama ayah mertua" type="text">

                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="father_in_law_gender" id="father_in_law_gender"
                                    class="selectpicker form-control">
                                    <option selected value="Laki-laki">
                                        Laki-laki</option>
                                    <option value="Perempuan">
                                        Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Tempat</label>
                                <input name="father_in_law_place_birth" class="form-control"
                                    id="father_in_law_place_birth" placeholder="Muara Teweh" type="text">

                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input name="father_in_law_date_birth" id="father_in_law_date_birth"
                                    class="form-control" placeholder="Select Date" type="date" />


                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Pendidikan</label>
                                <input name="father_in_law_education" class="form-control"
                                    id="father_in_law_education" placeholder="SMA" type="text">

                            </div>
                        </div>
                    </div>

                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h6">Istri/Suami</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input name="couple_name" class="form-control" id="couple_name"
                                    placeholder="Nama Pasangan" type="text">

                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="couple_gender" id="couple_gender"
                                    class="selectpicker form-control">
                                    <option value="Laki-laki">
                                        Laki-laki</option>
                                    <option value="Perempuan">
                                        Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Tempat</label>
                                <input name="couple_place_birth" class="form-control" id="couple_place_birth"
                                    placeholder="Muara Teweh" type="text">

                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input name="couple_date_birth" id="couple_date_birth" class="form-control"
                                    placeholder="Select Date" type="date" />


                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Pendidikan</label>
                                <input name="couple_education" class="form-control" id="couple_education"
                                    placeholder="SMA" type="text">

                            </div>
                        </div>
                    </div>
                </div>
                {{-- END MENIKAH ========= --}}
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h6">Anak ke- 1</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input name="child1_name" class="form-control" id="child1_name"
                                placeholder="Nama Anak" type="text">

                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="child1_gender" id="child1_gender" class="selectpicker form-control">
                                <option value="Laki-laki">Laki-laki
                                </option>
                                <option value="Perempuan">Perempuan
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Tempat</label>
                            <input name="child1_place_birth" class="form-control" id="child1_place_birth"
                                placeholder="Muara Teweh" type="text">

                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input name="child1_date_birth" id="child1_date_birth" class="form-control"
                                placeholder="Select Date" type="date" />


                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Pendidikan</label>
                            <input name="child1_education" class="form-control" id="child1_education"
                                placeholder="SMA" type="text">

                        </div>
                    </div>
                </div>

                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h6">Anak ke 2</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input name="child2_name" class="form-control" id="child2_name" placeholder="Nama"
                                type="text">

                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="child2_gender" id="child2_gender" class="selectpicker form-control">
                                <option value="Laki-laki">Laki-laki
                                </option>
                                <option value="Perempuan">Perempuan
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Tempat</label>
                            <input name="child2_place_birth" class="form-control" id="child2_place_birth"
                                placeholder="Muara Teweh" type="text">

                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input name="child2_date_birth" id="child2_date_birth" class="form-control"
                                placeholder="Select Date" type="date" />


                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Pendidikan</label>
                            <input name="child2_education" class="form-control" id="child2_education"
                                placeholder="SMA" type="text">

                        </div>
                    </div>
                </div>

                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h6">Anak ke 3</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input name="child3_name" class="form-control" id="child3_name" placeholder="Nama"
                                type="text">

                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="child3_gender" class="selectpicker form-control">
                                <option value="Laki-laki">Laki-laki
                                </option>
                                <option value="Perempuan">Perempuan
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Tempat</label>
                            <input name="child3_place_birth" class="form-control" id="child3_place_birth"
                                placeholder="Muara Teweh" type="text">

                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input name="child3_date_birth" id="child3_date_birth" class="form-control"
                                placeholder="Select Date" type="date" />


                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Pendidikan</label>
                            <input name="child3_education" class="form-control" id="child3_education"
                                placeholder="SMA" type="text">

                        </div>
                    </div>
                </div>

            </div>
            {{-- END --}}
            <div class="card-box mb-20 text-right">
                <button type="button" onclick="storeUserDependent('user-dependent')"
                    class="btn btn-primary mt-30 text-right mr-20 mb-20">Next Step</button>
            </div>
        </div>
    </form>
</div>