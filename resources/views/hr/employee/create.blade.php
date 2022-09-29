@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        {{-- <form action="/admin-hr/employees/contract/create" method="POST"> --}}
            <form action="/admin-hr/employee" method="POST">
                @csrf

                <input type="hidden" name="user_detail_uuid" id="user_detail_uuid" value="{{$user_detail_uuid}}">
                <input type="hidden" name="machine_id" id="machine_id" value="{{$machine_id}}">
                <div class="min-height-200px">

                    <!-- Identitas Karyawan -->
                    <div class="pd-20 card-box mb-20">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Identitas Karyawan</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="pd-20 card-box mb-30">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select name="department_uuid" class="custom-select2 form-control">
                                                    @foreach($departments as $department)
                                                    @if(old('department_uuid' ) == $department->uuid)
                                                    <option value="{{ $department->uuid }}" selected>{{
                                                        $department->department
                                                        }}
                                                    </option>
                                                    @else
                                                    <option value="{{ $department->uuid }}">{{ $department->department }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @error('department_uuid')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Position</label>
                                                    <select name="position_uuid" class="custom-select2 form-control">
                                                        @foreach($positions as $position)
                                                        @if(old('position_uuid' ) == $position->uuid)
                                                        <option value="{{ $position->uuid }}" selected>{{
                                                            $position->position
                                                            }}
                                                        </option>
                                                        @else
                                                        <option value="{{ $position->uuid }}">{{ $position->position }}
                                                        </option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    @error('position_uuid')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Company</label>
                                                <select name="company_uuid" id="company_uuid" class="selectpicker form-control">
                                                    @foreach($companies as $company)
                                                    @if(old('company_uuid' ) == $company->uuid)
                                                    <option value="{{ $company->uuid }}" selected>{{
                                                        $company->company
                                                        }}
                                                    </option>
                                                    @else
                                                    <option value="{{ $company->uuid }}">{{ $company->name }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @error('company_uuid')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Contract Status</label>
                                                    <select name="contract_status" id="contract_status"
                                                        class="selectpicker form-control @error('contract_status') is-invalid @enderror">
                                                        <option value="PKWT" {{ (old('contract_status')=='PKWT'
                                                            )?'selected':'' }}>PKWT</option>
                                                        <option value="PKWTT" {{ (old('contract_status')=='PKWTT'
                                                            )?'selected':'' }}>PKWTT</option>
                                                    </select>
                                                    @error('contract_status')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Employee Status</label>
                                                <select name="employee_status"
                                                class="selectpicker form-control @error('employee_status') is-invalid @enderror">
                                                <option value="Training" {{ (old('employee_status')=='Training'
                                                    )?'selected':'' }}>Training</option>
                                                <option value="Profesional" {{ (old('employee_status')=='Profesional'
                                                    )?'selected':'' }}>Profesional</option>
                                            </select>
                                            @error('employee_status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Roster</label>
                                                    <select name="roaster_uuid" class="selectpicker form-control">
                                                        @foreach($roasters as $roaster)
                                                        @if(old('roaster_uuid' ) == $roaster->uuid)
                                                        <option value="{{ $roaster->uuid }}" selected>{{
                                                            $roaster->roaster
                                                            }}
                                                        </option>
                                                        @else
                                                        <option value="{{ $roaster->uuid }}">{{ $roaster->name }}
                                                        </option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    @error('roaster_uuid')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label>Tanggal Mulai Kontrak</label>
                                                <input onblur="changeEnd()" id="date_start_contract"
                                                    name="date_start_contract"
                                                    class="form-control date-picker  @error('date_start_contract') is-invalid @enderror"
                                                    value="{{ old('date_start_contract', $date_now) }}"
                                                    placeholder="Select Date" type="text" />
                                                @error('date_start_contract')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label>Lama</label>
                                                <input id="long_contract" name="long_contract"
                                                    class="form-control  @error('long_contract') is-invalid @enderror"
                                                    value="{{ old('long_contract',  $long ) }}" type="text" />
                                                @error('long_contract')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label>Tanggal Berakhir Kontrak</label>
                                                <input id="date_end_contract" name="date_end_contract"
                                                    class="form-control date-picker  @error('date_end_contract') is-invalid @enderror"
                                                    value="{{ old('date_end_contract',  $date_add ) }}"
                                                    placeholder="Select Date" type="text" />
                                                @error('date_end_contract')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>NIK Employee</label>
                                        <input name="nik_employee"
                                            class="form-control @error('nik_employee') is-invalid @enderror"
                                            value="{{ old('nik_employee') }}" id="nik_employee"
                                            placeholder="6210000" type="text">
                                        @error('nik_employee')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Contract Number</label>
                                        <input name="contract_number"
                                            class="form-control @error('contract_number') is-invalid @enderror"
                                            value="{{ old('contract_number') }}" id="contract_number"
                                            placeholder="MBLE-00010001" type="text">
                                        @error('contract_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="pd-20 card-box mb-30">
                                   
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Salary</label>
                                                <input name="salary"
                                                    class="form-control @error('salary') is-invalid @enderror"
                                                    value="{{ old('salary') }}" id="salary"
                                                    placeholder="000" type="text">
                                                @error('salary')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Insentif</label>
                                                <input name="insentif"
                                                    class="form-control @error('insentif') is-invalid @enderror"
                                                    value="{{ old('insentif') }}" id="insentif"
                                                    placeholder="000" type="text">
                                                @error('insentif')
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
                                                <label>Premi BK</label>
                                                <input name="premi_bk"
                                                    class="form-control @error('premi_bk') is-invalid @enderror"
                                                    value="{{ old('premi_bk') }}" id="premi_bk"
                                                    placeholder="000" type="text">
                                                @error('premi_bk')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Premi Non BK</label>
                                                <input name="premi_nbk"
                                                    class="form-control @error('premi_nbk') is-invalid @enderror"
                                                    value="{{ old('premi_nbk') }}" id="premi_nbk"
                                                    placeholder="000" type="text">
                                                @error('premi_nbk')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                      
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Premi RJ</label>
                                                <input name="premi_rj"
                                                    class="form-control @error('premi_rj') is-invalid @enderror"
                                                    value="{{ old('premi_rj') }}" id="premi_rj"
                                                    placeholder="000" type="text">
                                                @error('premi_rj')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Premi Kayu</label>
                                                <input name="premi_kayu"
                                                    class="form-control @error('premi_kayu') is-invalid @enderror"
                                                    value="{{ old('premi_kayu') }}" id="premi_kayu"
                                                    placeholder="000" type="text">
                                                @error('premi_kayu')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Premi MB</label>
                                                <input name="premi_mb"
                                                    class="form-control @error('premi_mb') is-invalid @enderror"
                                                    value="{{ old('premi_mb') }}" id="premi_mb"
                                                    placeholder="000" type="text">
                                                @error('premi_mb')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Tonase</label>
                                                <input name="tonase"
                                                    class="form-control @error('tonase') is-invalid @enderror"
                                                    value="{{ old('tonase') }}" id="tonase"
                                                    placeholder="000" type="text">
                                                @error('tonase')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Insentif HM</label>
                                                <input name="insentif_hm"
                                                    class="form-control @error('insentif_hm') is-invalid @enderror"
                                                    value="{{ old('insentif_hm') }}" id="insentif_hm"
                                                    placeholder="000" type="text">
                                                @error('insentif_hm')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Deposit HM</label>
                                                <input name="deposit_hm"
                                                    class="form-control @error('deposit_hm') is-invalid @enderror"
                                                    value="{{ old('deposit_hm') }}" id="deposit_hm"
                                                    placeholder="000" type="text">
                                                @error('deposit_hm')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                       <button type="submit" class="btn btn-primary mt-30 float-right">Next Step</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>

    <div class="footer-wrap pd-20 mb-20 card-box">
        DeskApp - Bootstrap 4 Admin Template By
        <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
    </div>
</div>

@endsection

@section('js')
<script>
    console.log(zeroFilled = ('000' + 2).substr(-3))
    changeEnd();
    function getNumericMonth(monthAbbr) {
      return (String(["januari", "februari", "maret", "april", "mei", "juni", "juli", "agustus", "september", "oktober", "november", "desember"].indexOf(monthAbbr) + 1).padStart(2, '0'))
    }
    // console.log(getNumericMonth('september'));
    
    function changeEnd(){
        var inputVal = document.getElementById("date_start_contract").value;
        const result = inputVal.trim().split(/\s+/);
        month1 = result[1].toLowerCase();
        var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        
        var month = getNumericMonth(month1)
        var monthRomawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
        console.log(parseInt(month))
        var long = document.getElementById("long_contract").value;
        var contract_status = document.getElementById("contract_status").value;
        
        var company_uuid = document.getElementById("company_uuid").innerText;
        
        var contract =  ('000' + {{$contract_number}}).substr(-3)+"/"+contract_status+"/"+company_uuid+"/"+monthRomawi[parseInt(month)-1]+"/"+result[2]
        var nik_employee = company_uuid+"-"+result[2]+month+result[0]+ ('000' +{{$nik_employee}}).substr(-3)
        var date = new Date(month+' '+result[0]+' '+result[2]);
        $("#contract_number").val(contract);
        $("#nik_employee").val(nik_employee);
        // Add ten days to specified date
        date.setMonth(date.getMonth() + parseInt(long) );

        $("#date_end_contract").val(date.getDate()+' '+months[date.getMonth()]+' '+date.getFullYear());
    }
</script>
@endsection