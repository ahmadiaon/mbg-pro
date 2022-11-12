{{-- 
   /admin-hr/experience
    
--}}
@extends('template.admin.main_privilege')
@section('content')
    <div class="card-box mb-30">
        <form action="/user-employee/store" method="POST">
            @csrf

            <input type="text" name="user_detail_uuid" id="user_detail_uuid" value="{{$user_detail_uuid}}">
            <input type="text" name="machine_id" id="machine_id" value="{{$machine_id}}">
            <div class="min-height-200px">

                <!-- Identitas Karyawan -->
                <div class="pd-20 card-box mb-20">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Identitas Karyawan</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="pd-20 card-box mb-30">
                                <div class="row">
                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Company</label>
                                            <select onchange="nikChangge()" name="company_uuid" id="company_uuid" class="selectpicker form-control">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Contract Status</label>
                                                <select onchange="nikChangge()" name="contract_status" id="contract_status"
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
                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
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
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Tanggal Mulai Kontrak</label>
                                            <input onchange="changeEnd()" id="date_start_contract"
                                                name="date_start_contract"
                                                class="form-control"
                                                placeholder="Select Date" type="date" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Lama</label>
                                            <input onkeyup="changeEnd()" id="long_contract" name="long_contract"
                                                class="form-control  @error('long_contract') is-invalid @enderror"
                                                value="{{ old('long_contract',  $long ) }}" type="text" />
                                            @error('long_contract')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Kontrak Berakhir</label>
                                            <input id="date_end_contract" name="date_end_contract"
                                                class="form-control  @error('date_end_contract') is-invalid @enderror"
                                                value="{{ old('date_end_contract',  $date_add ) }}"
                                                placeholder="Select Date" type="date" />
                                            @error('date_end_contract')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="nik_employee-form">
                                    <label>NIK Employeeeee</label>
                                    <input onkeyup="cekNikEmployee()" name="nik_employee"
                                        class="form-control @error('nik_employee') is-invalid @enderror"
                                        value="{{ old('nik_employee') }}" id="nik_employee"
                                        placeholder="6210000" type="text">
                                        
                                </div>
                                <div class="form-group">
                                    <label>Contract Number</label>
                                    <input  name="contract_number"
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
                        <div class="col-md-6">
                            <div class="pd-20 card-box mb-30">
                               
                                <div class="row">
                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
                                  
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
@endsection




@section('js')


<script>
    function cekNikEmployee(){
        let nik_employee = $('#nik_employee').val();

        $.ajax({
                url: '/user-employee/cekNikEmployee',
                type: "POST",
                data:  {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        nik_employee: nik_employee
                    },
                success: function(response) {
                    data = response.data
					console.log(data)
                    if(data){
                        $('#nik_employee-forms').remove();
                        let ddat = `
                        <p id="nik_employee-forms" class="">
                                          <code>nik sudah ada</code>
                                        </p>
                                    `;
                        $('#nik_employee-form').append(ddat);
                        console.log('aaaaaa');
                    }else{
                        $('#nik_employee-forms').remove();
                        console.log('bbbb');
                    }

					// $('#table-'+idForm).DataTable().ajax.reload();
                },
                error: function(response) {
                    alertModal()					
				}
            });

        console.log(nik_employee);
    }
    
    function changeEnd(){
        var inputVal = $("#date_start_contract").val();
        var long = $("#long_contract").val();
        var someDate = new Date(inputVal);
        console.log('date start :'+ inputVal);
        console.log('long :'+long);
        
        someDate.setMonth(someDate.getMonth() + parseInt(long));
        let month_s =someDate.getMonth()+1;
        let dd = someDate.getDate();

        if (dd < 10) dd = '0' + dd;
        let full_month ='00' +month_s;
        let date_suggest = someDate.getFullYear()+'-'+full_month.substr(-2)+'-'+dd;
        console.log('date_suggest ss:'+date_suggest)
        $("#date_end_contract").val(String(date_suggest));    
    }

    function nikChangge(){
        var monthRomawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
        var contract_status = document.getElementById("contract_status").value;
        let company = $('#company_uuid').val()
        let today = @json($date_now);
        $("#date_start_contract").val(today);
        let month = today.charAt(5)+today.charAt(6);

        let year = today.charAt(0)+today.charAt(1)+today.charAt(2)+today.charAt(3);
        let month_number = parseInt(month);
        let contract_number = @json($contract_number);
        let full_contract_number ='000' +contract_number;
        let contract_number_suggest = full_contract_number.substr(-3)+'/'+contract_status+'/'+company+'/'+monthRomawi[month_number-1]+'/'+year;
        let nik_employee = @json($nik_employee);

        let nik_employee_suggest = company+'-'+today.charAt(2)+today.charAt(3)+today.charAt(5)+today.charAt(6)+nik_employee;
        $("#nik_employee").val(nik_employee_suggest);
        $("#contract_number").val(contract_number_suggest);
    }
    
</script>
@endsection

@section('js_ready')
var monthRomawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
var contract_status = document.getElementById("contract_status").value;
let company = $('#company_uuid').val()
let today = @json($date_now);
$("#date_start_contract").val(today);
let month = today.charAt(5)+today.charAt(6);

let year = today.charAt(0)+today.charAt(1)+today.charAt(2)+today.charAt(3);
let month_number = parseInt(month);
let contract_number = @json($contract_number);
let full_contract_number ='000' +contract_number;
let contract_number_suggest = full_contract_number.substr(-3)+'/'+contract_status+'/'+company+'/'+monthRomawi[month_number-1]+'/'+year;
let nik_employee = @json($nik_employee);

let nik_employee_suggest = company+'-'+today.charAt(2)+today.charAt(3)+today.charAt(5)+today.charAt(6)+nik_employee;
$("#nik_employee").val(nik_employee_suggest);
$("#contract_number").val(contract_number_suggest);

console.log('pkwt :')

changeEnd();
@endsection