@extends('template.admin.main_privilege')

@section('content')
    <div class="the-content">

        <div id="create-user-license" class="children-content">
            <form action="/app/user/license/store" id="form-user-license" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="isEdit" id="isEdit-create-user-license">
                <input type="text" name="uuid" id="uuid-create-user-license">
                <input type="text" name="user_detail_uuid" id="user_detail_uuid-create-user-license">
                <div class="min-height-200px">
                    <div class="pd-20 card-box mb-20">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Nomor Lisensi</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Jenis SIM</label>
                                            <input disabled class="form-control" value="Sim A">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Nomor SIM</label>
                                            <input name="sim_a" class="form-control" id="sim_a"
                                                placeholder="Muara Teweh" type="text">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kadaluwarsa</label>
                                            <input name="date_end_sim_a" class="form-control" id="date_end_sim_a"
                                                placeholder="Muara Teweh" type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Jenis SIM</label>
                                            <input disabled class="form-control" value="Sim B1">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Nomor SIM</label>
                                            <input name="sim_b1" class="form-control" id="sim_b1"
                                                placeholder="Muara Teweh" type="text">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kadaluwarsa</label>
                                            <input name="date_end_sim_b1" class="form-control" id="date_end_sim_b1"
                                                placeholder="Muara Teweh" type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Jenis SIM</label>
                                            <input disabled class="form-control" value="Sim B2">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Nomor SIM</label>
                                            <input name="sim_b2" class="form-control" id="sim_b2"
                                                placeholder="Muara Teweh" type="text">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kadaluwarsa</label>
                                            <input name="date_end_sim_b2" class="form-control" id="date_end_sim_b2"
                                                placeholder="Muara Teweh" type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Jenis SIM</label>
                                            <input disabled class="form-control" value="Sim C">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Nomor SIM</label>
                                            <input name="sim_c" class="form-control" id="sim_c"
                                                placeholder="Muara Teweh" type="text">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kadaluwarsa</label>
                                            <input name="date_end_sim_c" class="form-control" id="date_end_sim_c"
                                                placeholder="Muara Teweh" type="date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Jenis SIM</label>
                                            <input disabled class="form-control" value="Sim D">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Nomor SIM</label>
                                            <input name="sim_d" class="form-control" id="sim_d"
                                                placeholder="Muara Teweh" type="text">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kadaluwarsa</label>
                                            <input name="date_end_sim_d" class="form-control" id="date_end_sim_d"
                                                placeholder="Muara Teweh" type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Jenis SIM</label>
                                            <input disabled class="form-control" value="A Umum">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Nomor SIM</label>
                                            <input name="sim_a_umum" class="form-control" id="sim_a_umum"
                                                placeholder="Muara Teweh" type="text">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kadaluwarsa</label>
                                            <input name="date_end_sim_a_umum" class="form-control"
                                                id="date_end_sim_a_umum" placeholder="Muara Teweh" type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Jenis SIM</label>
                                            <input disabled class="form-control" value="B1 Umum">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Nomor SIM</label>
                                            <input name="sim_b1_umum" class="form-control" id="sim_b1_umum"
                                                placeholder="Muara Teweh" type="text">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kadaluwarsa</label>
                                            <input name="date_end_sim_b1_umum" class="form-control"
                                                id="date_end_sim_b1_umum" placeholder="Muara Teweh" type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Jenis SIM</label>
                                            <input disabled class="form-control" value="B2 Umum">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Nomor SIM</label>
                                            <input name="sim_b2_umum" class="form-control" id="sim_b2_umum"
                                                placeholder="Muara Teweh" type="text">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kadaluwarsa</label>
                                            <input name="date_end_sim_b2_umum" class="form-control"
                                                id="date_end_sim_b2_umum" placeholder="Muara Teweh" type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-mb-12">
                                    <div class="form-group text-right">
                                        <button type="button"
                                            class="btn btn-secondary  mr-10 create-user-employee-back">Back</button>
                                        <button type="button" onclick="storeUserLicense('user-license')"
                                            class="btn btn-primary">Simpan</button>
                                    </div>
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
        function firstCreateUserLicense() {
            let uuid = @json(session('recruitment-user'))['detail']['nik_employee'];
            cg('uuid', uuid);
            if (uuid != null) {
                setValue('/get/data/' + uuid, 'user-license');
            }
        }
        function storeUserLicense(idForm) {
            globalStoreNoTable(idForm).then((data) => {
                let user = data.data;        
                let uuid = @json(session('recruitment-user'))['detail']['nik_employee'];

                setValue('/get/data/' + uuid, 'user-license');
                stopLoading();
                $('#success-modal-id').modal('show')
            });
            
            firstCreateUserLicense();
        }
        firstCreateUserLicense();
    </script>
@endsection
