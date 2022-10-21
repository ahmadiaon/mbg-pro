{{-- 
    /admin-hr/licences
    
--}}
@extends('template.admin.main_privilege')
@section('content')
    <div class="pd-20 card-box mb-20">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Riwayat Kesehatan Karyawan</h4>
            </div>
        </div>
        <form action="/user-health/store" method="POST">
            @csrf
            <input type="text" name="isEdit" id="isEdit" value="">
            <input type="text" name="user_health_uuid" id="user_health_uuid" value="">
            <input type="text" name="nik_employee" id="nik_employee" value="">
            <input type="text" name="user_detail_uuid" id="user_detail_uuid" value="{{ $user_detail_uuid }}">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="form-group">
                        <label>Penyakit/Kecelakaan/Gejala</label>
                        <input name="name_health" id="name_health" class="form-control @error('name_health') is-invalid @enderror"
                            value="{{ old('name_health') }}" id="name_health" placeholder="Asma" type="text">
                        @error('name_health')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Tahun</label>
                        <input class="form-control @error('year') is-invalid @enderror"
                            value="{{ old('year') }}" name="year" id="year" placeholder="2012"
                            type="text">
                        @error('year')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>RS/Puskesmas</label>
                        <input name="health_care_place"
                            class="form-control @error('health_care_place') is-invalid @enderror"
                            value="{{ old('health_care_place') }}" id="health_care_place" placeholder="RS Mitra Barito"
                            type="text">
                        @error('health_care_place')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Lama (Bulan)</label>
                        <input name="long" class="form-control @error('long') is-invalid @enderror"
                            value="{{ old('long') }}" id="long" placeholder="12" type="text">
                        @error('long')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Sembuh</label>
                        <select name="status_health"
                            class="selectpicker form-control @error('status_health') is-invalid @enderror">
                            <option value="Sembuh" {{ old('status_health') == 'Sembuh' ? 'selected' : '' }}>Sembuh
                            </option>
                            <option value="Belum Sembuh" {{ old('status_health') == 'Belum Sembuh' ? 'selected' : '' }}>
                                Belum Sembuh
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary mt-10 float-right">Next Step</button>
                </div>
            </div>
    </div>
    </form>


    </div>
@endsection

@section('js_ready')
function edit(){
    let data = @json($data);
    let user_healths = data.user_health;
    $('#user_detail_uuid').val(data.user_detail_uuid)
    $('#nik_employee').val(data.nik_employee)
    if(user_healths){
        $('#user_health_uuid').val(data.uuid)
      
        $('#isEdit').val(data.isEdit)
       
        
        $('#name_health').val(data.name_health)        
        $('#year').val(data.year)        
        $('#health_care_place').val(data.health_care_place)    
        $('#long').val(data.long)    
        $('#status_health').val(data.status_health)  
    }
    

    console.log(data);
} 
let data = @json($data);
if(data){
    console.log('udin');
    console.log(data);
    edit();
}
@endsection