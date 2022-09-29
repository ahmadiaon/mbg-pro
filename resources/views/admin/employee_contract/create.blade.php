@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <form action="/admin-hr/employees/contract/store" method="POST">
            @csrf
            <div class="min-height-200px">
                <!-- Identitas Karyawan -->
                <div class="pd-20 card-box mb-20">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Data Karyawan</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <div class="pd-20 card-box mb-30">
                                <input type="hidden" name="employee_id" value="{{ $employee->employee_id }}">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name',$employee->name) }}" id="name"
                                        placeholder="Ahmadi Alpasyri" type="text">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>NIK Karyawan</label>
                                            <input name="nik_employee"
                                                class="form-control @error('nik_employee') is-invalid @enderror"
                                                value="{{ old('nik_employee',$employee->nik_employee) }}"
                                                id="nik_employee" placeholder="6210000" type="text">
                                            @error('nik_employee')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Nomor PKWT</label>
                                                <input name="contract_number"
                                                    class="form-control @error('contract_number') is-invalid @enderror"
                                                    value="{{ old('contract_number') }}" id="contract_number"
                                                    placeholder="62111" type="text">
                                                @error('contract_number')
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
                                        <label>Status Kontrak</label>
                                        <select name="contract_status"
                                            class="form-control @error('contract_status') is-invalid @enderror">
                                            <option value="PKWT" {{ (old('contract_status')=='PKWT' )?'selected':'' }}>
                                                PKWT
                                            </option>
                                            <option value="PKWTT" {{ (old('contract_status')=='PKWTT' )?'selected':''
                                                }}>
                                                PKWTT
                                            </option>
                                        </select>
                                        @error('contract_status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Status Karyawan</label>
                                            <select name="employee_status"
                                                class="form-control @error('employee_status') is-invalid @enderror">
                                                <option value="Training" {{ (old('employee_status')=='Training'
                                                    )?'selected':'' }}>
                                                    Training
                                                </option>
                                                <option value="Profesional" {{ (old('employee_status')=='Profesional'
                                                    )?'selected':'' }}>
                                                    Profesional
                                                </option>
                                            </select>
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
                                                value="{{ old('date_end_contract',  $date_sub ) }}"
                                                placeholder="Select Date" type="text" />
                                            @error('date_end_contract')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-3">
                            <div class="pd-20 card-box mb-30">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input name="" class="form-control @error('') is-invalid @enderror"
                                        value="{{ old('',$employee->nik_employee) }}" id=""
                                        placeholder="Ahmadi Alpasyri" type="text">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="" class="form-control @error('') is-invalid @enderror"
                                        placeholder="NIK RI" type="text">
                                    @error('')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Level User</label>
                                    <select name="group" id="">

                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </div>
                    <div class="row">

                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection


@section('js')
<script>
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

        var long = document.getElementById("long_contract").value;
        console.log(long)

        var date = new Date(month+' '+result[0]+' '+result[2]);

        // Add ten days to specified date
        date.setDate(date.getDate() + parseInt(long) );

        // console.log(date);
        // console.log(date.getDate());
        // console.log(date.getMonth());
        
        // console.log(date.getFullYear());
        // console.log(date.getDate()+' '+months[date.getMonth()]+' '+date.getFullYear())
        $("#date_end_contract").val(date.getDate()+' '+months[date.getMonth()]+' '+date.getFullYear());

    }
</script>
@endsection