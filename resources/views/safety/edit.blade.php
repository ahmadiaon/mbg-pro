{{-- 
    /admin-hr/licences
    
--}}
@extends('template.admin.main_privilege')
@section('content')
<div class="pd-20 card-box mb-20">
    <form action="/safety/store" method="POST">
        @csrf
        <input type="text" name="isEdit" id="isEdit" value="">
        <input type="text" name="nik_employee" id="nik_employee" value="">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Nomor Lisensi</h4>
            </div>
            @if(session('success'))
            <div class="pull-right">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data Tersimpan</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jenis Atribut</label>
                            <input disabled class="form-control" value="ID Card">
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>No Reg</label>
                            <input name="no_reg"
                                class="form-control @error('no_reg') is-invalid @enderror"
                                value="{{ old('no_reg') }}" id="no_reg" placeholder="MP-001"
                                type="text">
                            <div class="invalid-feedback" id="req-no_reg">
                                Data tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tgl. Diperoleh</label>
                            <input name="date"
                                class="form-control @error('date') is-invalid @enderror"
                                value="{{ old('date') }}" id="date" 
                                type="date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jenis Atribut</label>
                            <input disabled class="form-control" value="Rompi">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="selectpicker form-control " name="rompi_status" id="rompi_status">
                                <option value="Diperoleh">Diperoleh</option>
                                <option value="Belum diperoleh">Belum diperoleh</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tgl. Diperoleh</label>
                            <input name="rompi_date"
                            class="form-control @error('rompi_date') is-invalid @enderror"
                            value="{{ old('rompi_date') }}" id="rompi_date" 
                            type="date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jenis Atribut</label>
                            <input disabled class="form-control" value="Helm">
                            
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Warna Helm</label>
                            <select class="selectpicker form-control " name="helm_color" id="helm_color">
                                <option value="">Belum diperoleh</option>
                                @foreach ($unit_warna as $helm)
                                <option value="{{ $helm->uuid}}">{{ $helm->uuid}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tgl. Diperoleh</label>
                            <input name="helm_date"
                                class="form-control @error('helm_date') is-invalid @enderror"
                                value="{{ old('helm_date') }}" id="helm_date" placeholder="Muara Teweh"
                                type="date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jenis Atribut</label>
                            <input disabled class="form-control" value="Sepatu">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Ukuran Sepatu</label>
                            <select class="selectpicker form-control " name="boots_size" id="boots_size">
                                <option value="">Belum diperoleh</option>
                                @foreach ($unit_angka as $helm)
                                <option value="{{ $helm->uuid}}">{{ $helm->uuid}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tgl. Diperoleh</label>
                            <input name="boots_date"
                                class="form-control @error('boots_date') is-invalid @enderror"
                                value="{{ old('boots_date') }}" id="boots_date" placeholder="Muara Teweh"
                                type="date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jenis Atribut</label>
                            <input disabled class="form-control" value="Orange">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Ukuran Orange</label>
                            <select class="selectpicker form-control " name="orange_size" id="orange_size">
                                <option value="">Belum diperoleh</option>
                                @foreach ($unit_huruf as $helm)
                                <option value="{{ $helm->uuid}}">{{ $helm->uuid}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tgl. Diperoleh</label>
                            <input name="orange_date"
                                class="form-control @error('orange_date') is-invalid @enderror"
                                value="{{ old('orange_date') }}" id="orange_date" placeholder="Muara Teweh"
                                type="date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jenis Atribut</label>
                            <input disabled class="form-control" value="Biru">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Ukuran Kemeja Biru</label>
                            <select class="selectpicker form-control " name="blue_size" id="blue_size">
                                <option value="">Belum diperoleh</option>
                                @foreach ($unit_huruf as $helm)
                                <option value="{{ $helm->uuid}}">{{ $helm->uuid}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tgl. Diperoleh</label>
                            <input name="blue_date"
                                class="form-control @error('blue_date') is-invalid @enderror"
                                value="{{ old('blue_date') }}" id="blue_date" placeholder="Muara Teweh"
                                type="date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jenis Atribut</label>
                            <input disabled class="form-control" value="Kaos">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Ukuran Kaos</label>
                            <select class="selectpicker form-control " name="shirt_size" id="shirt_size">
                                <option value="">Belum diperoleh</option>
                                @foreach ($unit_huruf as $helm)
                                <option value="{{ $helm->uuid}}">{{ $helm->uuid}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tgl. Diperoleh</label>
                            <input name="shirt_date"
                                class="form-control @error('shirt_date') is-invalid @enderror"
                                value="{{ old('shirt_date') }}" id="shirt_date" placeholder="Muara Teweh"
                                type="date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jenis Atribut</label>
                            <input disabled class="form-control" value="Mekanik">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Ukuran Kemeja Biru</label>
                            <select class="selectpicker form-control " name="mekanik_size" id="mekanik_size">
                                <option value="">Belum diperoleh</option>
                                @foreach ($unit_huruf as $helm)
                                <option value="{{ $helm->uuid}}">{{ $helm->uuid}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tgl. Diperoleh</label>
                            <input name="mekanik_date"
                                class="form-control @error('mekanik_date') is-invalid @enderror"
                                value="{{ old('mekanik_date') }}" id="mekanik_date" placeholder="Muara Teweh"
                                type="date">
                        </div>
                    </div>
                </div>
                <div class="col-md-mb-12  text-right">
                    <button type="submit" class="btn btn-primary mt-30 ">Next Step</button>
                </div>
            </div>
        </div>
    </form>
</div>
  
@endsection

@section('js_ready')
function firsts(){
    let no_reg_suggest;
    let no_reg = @json($no_reg);
    let data = @json($data);
    let year_month = @json($year_month);
    if(data.company_uuid != null){
        let company = data.company_uuid;
        {{-- let no_reg_suggest = "MP-"+company+"-"+no_reg+"-"; --}}
        
        let full_contract_number ='000' +no_reg;
        no_reg_suggest = "MP-"+company+"-"+full_contract_number.substr(-3)+"-"+year_month;
        console.log(no_reg_suggest);
    }else{
        no_reg_suggest ="MP-MBLE-001-"+year_month;
    }
    $('#no_reg').val(no_reg_suggest);
    {{-- $().val(); --}}
}
firsts();
function edit(){
    let data = @json($data);
    
    console.log(data);

    $('#isEdit').val(data.isEdit)  
    $('#nik_employee').val(data.nik_employee)  
   
    $('#user_detail_uuid').val(data.user_detail_uuid)  
    if(data){
        if(data.blue_size){
            $('#blue_size').val(data.blue_size)  
            $('#blue_date').val(data.blue_date)  
        } 
        if(data.no_reg_full){
            $('#no_reg').val(data.no_reg_full)  
        } 
        if(data.date){
            $('#date').val(data.date)  
        } 
        if(data.date){
            $('#date').val(data.date)  
        } 
        if(data.rompi_status){
            $('#rompi_status').val(data.rompi_status)  
            console.log(data.rompi_date);
            $('#rompi_date').val(data.rompi_date)  
        } 
        if(data.helm_color){
            $('#helm_color').val(data.helm_color)  
            $('#helm_date').val(data.helm_date)  
        } 
        if(data.boots_size){
            $('#boots_size').val(data.boots_size)  
            $('#boots_date').val(data.boots_date)  
        } 
        if(data.shirt_size){
            $('#shirt_size').val(data.shirt_size)  
            $('#shirt_date').val(data.shirt_date)  
        } 
        if(data.mekanik_size){
            $('#mekanik_size').val(data.mekanik_size)  
            $('#mekanik_date').val(data.mekanik_date)  
        } 
        if(data.orange_size){
            $('#orange_size').val(data.orange_size)  
            $('#orange_date').val(data.orange_date)  
        } 
        $('#user_license_uuid').val(data.uuid)  
    }
     
} 
let data = @json($data);
if(data){
    edit();
}
@endsection