{{-- 
    /admin-hr/licences
    
--}}
@extends('template.admin.main_privilege')
@section('content')
<div class="pd-20 card-box mb-20">
    <form action="/user-license/store" method="POST">
        @csrf
        <input type="text" name="isEdit" id="isEdit" value="">
        <input type="text" name="user_license_uuid" id="user_license_uuid" value="">
        <input type="text" name="nik_employee" id="nik_employee" value="">
        <input type="text" name="user_detail_uuid" value="{{ $user_detail_uuid }}">
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
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="sim_a"
                                class="form-control @error('sim_a') is-invalid @enderror"
                                value="{{ old('sim_a') }}" id="sim_a" placeholder="Muara Teweh"
                                type="text">
                            @error('sim_a')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Kadaluwarsa</label>
                            <input name="date_end_sim_a"
                                class="form-control @error('date_end_sim_a') is-invalid @enderror"
                                value="{{ old('date_end_sim_a') }}" id="date_end_sim_a" placeholder="Muara Teweh"
                                type="date">
                            @error('date_end_sim_a')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jenis SIM</label>
                            <input disabled class="form-control" value="Sim B1">
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="sim_b1"
                                class="form-control @error('sim_b1') is-invalid @enderror"
                                value="{{ old('sim_b1') }}" id="sim_b1" placeholder="Muara Teweh"
                                type="text">
                            @error('sim_b1')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Kadaluwarsa</label>
                            <input name="date_end_sim_b1"
                                class="form-control @error('date_end_sim_b1') is-invalid @enderror"
                                value="{{ old('date_end_sim_b1') }}" id="date_end_sim_b1" placeholder="Muara Teweh"
                                type="date">
                            @error('date_end_sim_b1')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jenis SIM</label>
                            <input disabled class="form-control" value="Sim B2">
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="sim_b2"
                                class="form-control @error('sim_b2') is-invalid @enderror"
                                value="{{ old('sim_b2') }}" id="sim_b2" placeholder="Muara Teweh"
                                type="text">
                            @error('sim_b2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Kadaluwarsa</label>
                            <input name="date_end_sim_b2"
                                class="form-control @error('date_end_sim_b2') is-invalid @enderror"
                                value="{{ old('date_end_sim_b2') }}" id="date_end_sim_b2" placeholder="Muara Teweh"
                                type="date">
                            @error('date_end_sim_b2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jenis SIM</label>
                            <input disabled class="form-control" value="Sim C">
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="sim_c"
                                class="form-control @error('sim_c') is-invalid @enderror"
                                value="{{ old('sim_c') }}" id="sim_c" placeholder="Muara Teweh"
                                type="text">
                            @error('sim_c')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Kadaluwarsa</label>
                            <input name="date_end_sim_c"
                                class="form-control @error('date_end_sim_c') is-invalid @enderror"
                                value="{{ old('date_end_sim_c') }}" id="date_end_sim_c" placeholder="Muara Teweh"
                                type="date">
                            @error('date_end_sim_c')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
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
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="sim_d"
                                class="form-control @error('sim_d') is-invalid @enderror"
                                value="{{ old('sim_d') }}" id="sim_d" placeholder="Muara Teweh"
                                type="text">
                            @error('sim_d')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Kadaluwarsa</label>
                            <input name="date_end_sim_d"
                                class="form-control @error('date_end_sim_d') is-invalid @enderror"
                                value="{{ old('date_end_sim_d') }}" id="date_end_sim_d" placeholder="Muara Teweh"
                                type="date">
                            @error('date_end_sim_d')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jenis SIM</label>
                            <input disabled class="form-control" value="A Umum">
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="sim_a_umum"
                                class="form-control @error('sim_a_umum') is-invalid @enderror"
                                value="{{ old('sim_a_umum') }}" id="sim_a_umum"
                                placeholder="Muara Teweh" type="text">
                            @error('sim_a_umum')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Kadaluwarsa</label>
                            <input name="date_end_sim_a_umum"
                                class="form-control @error('date_end_sim_a_umum') is-invalid @enderror"
                                value="{{ old('date_end_sim_a_umum') }}" id="date_end_sim_a_umum" placeholder="Muara Teweh"
                                type="date">
                            @error('date_end_sim_a_umum')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jenis SIM</label>
                            <input disabled class="form-control" value="B1 Umum">
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="sim_b1_umum"
                                class="form-control @error('sim_b1_umum') is-invalid @enderror"
                                value="{{ old('sim_b1_umum') }}" id="sim_b1_umum"
                                placeholder="Muara Teweh" type="text">
                            @error('sim_b1_umum')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Kadaluwarsa</label>
                            <input name="date_end_sim_b1_umum"
                                class="form-control @error('date_end_sim_b1_umum') is-invalid @enderror"
                                value="{{ old('date_end_sim_b1_umum') }}" id="date_end_sim_b1_umum" placeholder="Muara Teweh"
                                type="date">
                            @error('date_end_sim_b1_umum')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jenis SIM</label>
                            <input disabled class="form-control" value="B2 Umum">
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="sim_b2_umum"
                                class="form-control @error('sim_b2_umum') is-invalid @enderror"
                                value="{{ old('sim_b2_umum') }}" id="sim_b2_umum"
                                placeholder="Muara Teweh" type="text">
                            @error('sim_b2_umum')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Kadaluwarsa</label>
                            <input name="date_end_sim_b2_umum"
                                class="form-control @error('date_end_sim_b2_umum') is-invalid @enderror"
                                value="{{ old('date_end_sim_b2_umum') }}" id="date_end_sim_b2_umum" placeholder="Muara Teweh"
                                type="date">
                            @error('date_end_sim_b2_umum')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-mb-12  text-right">
                    <button type="submit" class="btn btn-primary mt-30 ">Next Step</button>

                </div>
            </div>
        </div>
    </form>
</div>
  
@endsection

@section('js_ready')
function edit(){
    let data = @json($data);
    let user_licenses = data.user_licenses;
    
    console.log(user_licenses);

    $('#isEdit').val(data.isEdit)  
    $('#nik_employee').val(data.nik_employee)  
   
    $('#user_detail_uuid').val(data.user_detail_uuid)  
    if(user_licenses){
        if(user_licenses.sim_a){
            $('#sim_a').val(user_licenses.sim_a)  
            $('#date_end_sim_a').val(user_licenses.date_end_sim_a)  
        } 
      
        if(user_licenses.sim_a_umum){
            $('#sim_a_umum').val(user_licenses.sim_a_umum)  
            $('#date_end_sim_a_umum').val(user_licenses.date_end_sim_a_umum)  
        } 
      
        if(user_licenses.sim_b1){
            $('#sim_b1').val(user_licenses.sim_b1)  
            $('#date_end_sim_b1').val(user_licenses.date_end_sim_b1)  
        } 
      
        if(user_licenses.sim_b1_umum){
            $('#sim_b1_umum').val(user_licenses.sim_b1_umum)  
            $('#date_end_sim_b1_umum').val(user_licenses.date_end_sim_b1_umum)  
        } 
      
        if(user_licenses.sim_b2){
            $('#sim_b2').val(user_licenses.sim_b2)  
            $('#date_end_sim_b2').val(user_licenses.date_end_sim_b2)  
        } 
      
        if(user_licenses.sim_b2_umum){
            $('#sim_b2_umum').val(user_licenses.sim_b2_umum)  
            $('#date_end_sim_b2_umum').val(user_licenses.date_end_sim_b2_umum)  
        } 
      
        if(user_licenses.sim_c){
            $('#sim_c').val(user_licenses.sim_c)  
            $('#date_end_sim_c').val(user_licenses.date_end_sim_c)  
        } 
      
        if(user_licenses.sim_d){
            $('#sim_d').val(user_licenses.sim_d)  
            $('#date_end_sim_d').val(user_licenses.date_end_sim_d)  
        } 
      
        $('#user_license_uuid').val(user_licenses.uuid)  
    }
     
} 
let data = @json($data);
if(data){
    console.log('udin');
    console.log(data);
    edit();
}
@endsection