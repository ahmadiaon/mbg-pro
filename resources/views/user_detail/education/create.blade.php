@extends('template.admin.main_privilege')

@section('content')
    <div class="the-content">
        <div id="create-user-education" class="children-content">
            <form action="/app/user/education/store" id="form-user-education" method="POST" enctype="multipart/form-data">
                @csrf        
                <input type="text" name="isEdit" id="isEdit-create-user-education">
                <input type="text" name="uuid" id="uuid-create-user-education">
                <input type="text" name="user_detail_uuid" id="user_detail_uuid-create-user-education">

                <div class="min-height-200px">

                    <!-- Identitas Karyawan -->
                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Pendidikan Karyawan</h4>
                            </div>
                        </div>

                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h6">Sekolah Dasar</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Sekolah</label>
                                    <input name="sd_name" class="form-control" id="sd_name" placeholder="Muara Teweh"
                                        type="text">

                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Daerah</label>
                                    <input name="sd_place" class="form-control" id="sd_place" placeholder="Muara Teweh"
                                        type="text">

                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Lulus Tahun</label>
                                    <input name="sd_year" class="form-control" id="sd_year" placeholder="Muara Teweh"
                                        type="text">

                                </div>
                            </div>
                        </div>

                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h6">Sekolah Menengah Atas Sederajat</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Sekolah</label>
                                    <input name="smp_name" class="form-control" id="smp_name" placeholder="Muara Teweh"
                                        type="text">

                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Daerah</label>
                                    <input name="smp_place" class="form-control" id="smp_place" placeholder="Muara Teweh"
                                        type="text">

                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Lulus Tahun</label>
                                    <input name="smp_year" class="form-control" id="smp_year" placeholder="Muara Teweh"
                                        type="text">

                                </div>
                            </div>
                        </div>

                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h6">SMA/Sederajat</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Sekolah</label>
                                    <input name="sma_name" class="form-control" id="sma_name" placeholder="Muara Teweh"
                                        type="text">

                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Daerah</label>
                                    <input name="sma_place" class="form-control" id="sma_place" placeholder="Muara Teweh"
                                        type="text">

                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <input name="sma_jurusan" class="form-control" id="sma_jurusan"
                                        placeholder="Muara Teweh" type="text">

                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Lulus Tahun</label>
                                    <input name="sma_year" class="form-control" id="sma_year" placeholder="Muara Teweh"
                                        type="text">

                                </div>
                            </div>
                        </div>

                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h6">Perguruan Tinggi</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Perguruan Tinggi</label>
                                    <input name="ptn_name" class="form-control" id="ptn_name" placeholder="Muara Teweh"
                                        type="text">

                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Daerah</label>
                                    <input name="ptn_place" class="form-control" id="ptn_place"
                                        placeholder="Muara Teweh" type="text">

                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <input name="ptn_jurusan" class="form-control" id="ptn_jurusan"
                                        placeholder="Muara Teweh" type="text">

                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Lulus Tahun</label>
                                    <input name="ptn_year" class="form-control" id="ptn_year" placeholder="Muara Teweh"
                                        type="text">

                                </div>
                            </div>
                        </div>

                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h6">Lain-lain</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input name="dll_name" class="form-control" id="dll_name" placeholder="Muara Teweh"
                                        type="text">

                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Daerah</label>
                                    <input name="dll_place" class="form-control" id="dll_place"
                                        placeholder="Muara Teweh" type="text">

                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <input name="dll_jurusan" class="form-control" id="dll_jurusan"
                                        placeholder="Muara Teweh" type="text">

                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Lulus Tahun</label>
                                    <input name="dll_year" class="form-control" id="dll_year" placeholder="Muara Teweh"
                                        type="text">

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group text-right">
                                    <button type="button"
                                    class="btn btn-secondary  mr-10 create-user-employee-back">Back</button>
                                    <button type="button" onclick="storeUserEducation('user-education')" class="btn btn-primary mt-10 float-right">Next Step</button>
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
    function firstCreateUserEducation() {
        let uuid = @json(session('recruitment-user'))['detail']['nik_employee'];
            cg('uuid', uuid);
            if(uuid != null){
                setValue('/get/data/' + uuid, 'user-education');
            }
    }

    function storeUserEducation(idForm) {
        if (isRequiredCreate(['sd_name']) > 0) {
            return false;
        }
        globalStoreNoTable(idForm).then((data) => {
            let user = data.data;
            console.log(data);
            stopLoading();
            $('#success-modal-id').modal('show')
        })
    }
    
    firstCreateUserEducation();
</script>

@endsection