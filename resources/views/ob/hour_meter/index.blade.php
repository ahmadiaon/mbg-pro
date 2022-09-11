@extends('layout_adm.main')

@section('content')
{{-- @dd($over_burden->checker_employee_id) --}}
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">


            <div class="container px-0">
                @foreach($flits as $flit)
                <h4 class="mb-30 mt-30 text-blue h4 text-center">Flit Excavator :{{ $flit->vehicle_code }}-{{
                    $flit->number }}</h4>
                <div class="row">
                    @if($over_burden_operators->isNotEmpty())
                    @foreach($over_burden_operators as $over_burden_operator)
                    @if($over_burden_operator->over_burden_flit_uuid == $flit->uuid)
                    <div class="col-md-4 mb-30">
                        <form action="/admin-ob/hour-meter" id="hour-meter-{{ $over_burden_operator->uuid }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="uuid" value="{{ $over_burden_operator->uuid }}">
                            <input type="hidden" name="idOB" value="{{ $idOB}}">
                            <input type="hidden" name="vehicle_uuid" value="{{ $over_burden_operator->vehicle_uuid}}">
                            <div class="card-box pricing-card-style2">
                                <div class="pricing-card-header">
                                    <div class="left">
                                        <h5>{{$over_burden_operator->name}}</h5>
                                        <p> {{ $over_burden_operator->NIK_employee }}</p>
                                    </div>
                                    <div class="right">
                                        <div class="pricing-price"> {{ $over_burden_operator->vehicle_code }}<span> {{
                                                $over_burden_operator->number }}</span></div>
                                    </div>
                                </div>
                                <div class="pricing-card-body">
                                    <div class="pricing">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col">
                                                        Position
                                                    </div>
                                                    <div class="col ">
                                                        <div class="float-right">
                                                            {{ $over_burden_operator->position }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-6">
                                                        HM start
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="float-right">
                                                            <input class="form-control" type="text" name="hm_start"
                                                                value="{{ ($over_burden_operator->hm_start != null)?$over_burden_operator->hm_start:$over_burden_operator->hour_meter }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col">
                                                        HM stop
                                                    </div>
                                                    <div class="col ">
                                                        <div class="float-right">
                                                            <input class="form-control" type="text" name="hm_stop"
                                                                value="{{$over_burden_operator->hm_stop }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col">
                                                        HM Value
                                                    </div>
                                                    <div class="col ">
                                                        <div class="float-right">
                                                            <input class="form-control" type="text" name="hm_value"
                                                                value="{{$over_burden_operator->hm_value }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col">
                                                        HM Dibayar
                                                    </div>
                                                    <div class="col ">
                                                        <div class="float-right">
                                                            <input class="form-control" type="text" name="hm_pay"
                                                                value="{{$over_burden_operator->hm_pay }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li></li>
                                            <li>
                                                <div class="row">
                                                    <div class="col">
                                                        Time Start
                                                    </div>
                                                    <div class="col ">
                                                        <div class="float-right">
                                                            <select class="form-control" name="time_start"
                                                                id="time_start">
                                                                @for($i=0; $i< 24;$i++) @if($i<10) <option {{
                                                                    ('0'.$i.':00:00'==$over_burden_operator->
                                                                    time_start)?
                                                                    'selected':''}} value="{{ $i }}:00">{{ $i}}:00
                                                                    </option>
                                                                    @else
                                                                    <option {{ ($i.':00:00'==$over_burden_operator->
                                                                        time_start)? 'selected':''}} value="{{ $i
                                                                        }}:00">{{ $i}}:00
                                                                    </option>
                                                                    @endif

                                                                    @endfor

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col">
                                                        Time Stop
                                                    </div>
                                                    <div class="col ">
                                                        <div class="float-right">
                                                            <select class="form-control" name="time_stop"
                                                                id="time_stop">
                                                                @for($i=0; $i< 24;$i++) @if($i<10) <option {{
                                                                    ('0'.$i.':00:00'==$over_burden_operator->time_stop)?
                                                                    'selected':''}} value="{{ $i }}:00">{{ $i}}:00
                                                                    </option>
                                                                    @else
                                                                    <option {{ ($i.':00:00'==$over_burden_operator->
                                                                        time_stop)? 'selected':''}} value="{{ $i
                                                                        }}:00">{{ $i}}:00
                                                                    </option>
                                                                    @endif

                                                                    @endfor

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col">
                                                        Pit Name
                                                    </div>
                                                    <div class="col ">
                                                        <div class="float-right">
                                                            <select name="pit_uuid"
                                                                class="form-control theSelect theSelect4" id="pit_uuid">
                                                                @foreach($pits as $pit)
                                                                @if($over_burden->pit_uuid== $pit->uuid)
                                                                <option value="{{ $pit->uuid }}" selected>{{
                                                                    $pit->pit_name }}
                                                                </option>
                                                                @else
                                                                <option value="{{ $pit->uuid }}">{{ $pit->pit_name }}
                                                                </option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="cta">
                                    <a onclick="document.forms['hour-meter-{{ $over_burden_operator->uuid }}'].submit();"
                                        style="cursor: pointer" class="btn btn-primary btn-rounded btn-lg">Unsave</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif



                    @endforeach
                    @else
                    <div class="col-lg-12 col-md-6 col-sm-12 mb-30 text-center">
                        <h2>Empety Operator</h2>
                    </div>
                    @endif
                </div>
                @endforeach

            </div>
            <div class="container px-0">

                <h4 class="mb-30 mt-30 text-blue h4 text-center">Unit Support</h4>
                <div class="row">
                    @if($over_burden_operator_supports->isNotEmpty())
                    @foreach($over_burden_operator_supports as $over_burden_operator_support)
                    <div class="col-md-4 mb-30">
                        <form action="/admin-ob/hour-meter" id="hour-meter-{{ $over_burden_operator_support->uuid }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="uuid" value="{{ $over_burden_operator_support->uuid }}">
                            <input type="hidden" name="idOB" value="{{ $idOB}}">
                            <input type="hidden" name="vehicle_uuid"
                                value="{{ $over_burden_operator_support->vehicle_uuid}}">
                            <div class="card-box pricing-card-style2">
                                <div class="pricing-card-header">
                                    <div class="left">
                                        <h5>{{$over_burden_operator_support->name}}</h5>
                                        <p> {{ $over_burden_operator_support->NIK_employee }}</p>
                                    </div>
                                    <div class="right">
                                        <div class="pricing-price"> {{ $over_burden_operator_support->vehicle_code
                                            }}<span> {{
                                                $over_burden_operator_support->number }}</span></div>
                                    </div>
                                </div>
                                <div class="pricing-card-body">
                                    <div class="pricing">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col">
                                                        Position
                                                    </div>
                                                    <div class="col ">
                                                        <div class="float-right">
                                                            {{ $over_burden_operator_support->position }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-6">
                                                        HM start
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="float-right">
                                                            <input class="form-control" type="text" name="hm_start"
                                                                value="{{ ($over_burden_operator_support->hm_start != null)?$over_burden_operator_support->hm_start:$over_burden_operator_support->hour_meter }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col">
                                                        HM stop
                                                    </div>
                                                    <div class="col ">
                                                        <div class="float-right">
                                                            <input class="form-control" type="text" name="hm_stop"
                                                                value="{{$over_burden_operator_support->hm_stop }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col">
                                                        HM Value
                                                    </div>
                                                    <div class="col ">
                                                        <div class="float-right">
                                                            <input class="form-control" type="text" name="hm_value"
                                                                value="{{$over_burden_operator_support->hm_value }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col">
                                                        HM Dibayar
                                                    </div>
                                                    <div class="col ">
                                                        <div class="float-right">
                                                            <input class="form-control" type="text" name="hm_pay"
                                                                value="{{$over_burden_operator_support->hm_pay }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li></li>
                                            <li>
                                                <div class="row">
                                                    <div class="col">
                                                        Time Start
                                                    </div>
                                                    <div class="col ">
                                                        <div class="float-right">
                                                            <select class="form-control" name="time_start"
                                                                id="time_start">
                                                                @for($i=0; $i< 24;$i++) @if($i<10) <option {{
                                                                    ('0'.$i.':00:00'==$over_burden_operator_support->
                                                                    time_start)?
                                                                    'selected':''}} value="{{ $i }}:00">{{ $i}}:00
                                                                    </option>
                                                                    @else
                                                                    <option {{
                                                                        ($i.':00:00'==$over_burden_operator_support->
                                                                        time_start)? 'selected':''}} value="{{ $i
                                                                        }}:00">{{ $i}}:00
                                                                    </option>
                                                                    @endif

                                                                    @endfor

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col">
                                                        Time Stop
                                                    </div>
                                                    <div class="col ">
                                                        <div class="float-right">
                                                            <select class="form-control" name="time_stop"
                                                                id="time_stop">
                                                                @for($i=0; $i< 24;$i++) @if($i<10) <option {{
                                                                    ('0'.$i.':00:00'==$over_burden_operator_support->
                                                                    time_stop)?
                                                                    'selected':''}} value="{{ $i }}:00">{{ $i}}:00
                                                                    </option>
                                                                    @else
                                                                    <option {{
                                                                        ($i.':00:00'==$over_burden_operator_support->
                                                                        time_stop)? 'selected':''}} value="{{ $i
                                                                        }}:00">{{ $i}}:00
                                                                    </option>
                                                                    @endif

                                                                    @endfor

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col">
                                                        Pit Name
                                                    </div>
                                                    <div class="col ">
                                                        <div class="float-right">
                                                            <select name="pit_uuid"
                                                                class="form-control theSelect theSelect4" id="pit_uuid">
                                                                @foreach($pits as $pit)
                                                                @if($over_burden->pit_uuid== $pit->uuid)
                                                                <option value="{{ $pit->uuid }}" selected>{{
                                                                    $pit->pit_name }}
                                                                </option>
                                                                @else
                                                                <option value="{{ $pit->uuid }}">{{ $pit->pit_name }}
                                                                </option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="cta">
                                    <a onclick="document.forms['hour-meter-{{ $over_burden_operator_support->uuid }}'].submit();"
                                        style="cursor: pointer" class="btn btn-primary btn-rounded btn-lg">Unsave</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endforeach
                    @else
                    <div class="col-lg-12 col-md-6 col-sm-12 mb-30 text-center">
                        <h2>Empety Support</h2>
                    </div>
                    @endif
                </div>


            </div>
            <div class="pd-20 col-12  mb-30">
                <div class="row">

                    {{-- add operator --}}
                    <div class="col-5">
                        <div class="card-box  pd-20">

                            <h4 class="text-center">Add Driver</h4>
                            <form action="/admin-ob/add-operator" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="shift_time" value="{{ $over_burden->shift }}">
                                <input type="hidden" name="ob_uuid" value="{{ $idOB}}">
                                <input type="hidden" name="over_burden_uuid" value="{{  $over_burden->uuid}}">
                                <div class="form-group">
                                    <label>Operator</label>
                                    <div class="row">
                                        <div class="col-11">
                                            <select name="operator_employee_uuid" class="form-control selecOperator"
                                                id="operator_employee_uuid">
                                                @foreach($employees as $employee)
                                                @if(old('operator_employee_uuid' ) == $employee->uuid)
                                                <option value="{{ $employee->uuid }}" selected>{{ $employee->name }}
                                                </option>
                                                @else
                                                <option value="{{ $employee->uuid }}">{{ $employee->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <div class="row">
                                                <div class="col-11">
                                                    <select class="form-control theSelect2" name="vehicle_uuid"
                                                        id="vehicle_uuid">
                                                        @foreach($vehicles as $vehicle)
                                                        <option value="{{ $vehicle->uuid }}">
                                                            {{ $vehicle->vehicle_code }} - {{ $vehicle->number }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kapasitas</label>
                                            <div class="row">
                                                <div class="col-11">
                                                    <select class="form-control" name="capacity" id="capacity">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Excavator Flit</label>
                                    <div class="row">
                                        <div class="col-11">
                                            <select class="form-control theSelect2" name="over_burden_flit_uuid"
                                                id="over_burden_flit_uuid">

                                                @if($flits->isNotEmpty())
                                                @foreach($flits as $flit)
                                                <option value="{{ $flit->uuid }}">
                                                    {{ $flit->vehicle_code }} - {{ $flit->number }}
                                                </option>
                                                @endforeach
                                                @else
                                                <option value="">
                                                    Tambah Flit terlebih dahulu
                                                </option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <a href="/ob/setup">
                                    <button type="button" class="btn btn-secondary">Batal</button>
                                </a>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                    {{-- add excavator --}}
                    <div class="col-4">
                        <div class="card-box  pd-20">
                            <h4 class="text-center">Add Excavator</h4>
                            <form action="/admin-ob/flit" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="over_burden_uuid" value="{{ $over_burden->uuid}}">
                                <div class="form-group">
                                    <label>Operator</label>
                                    <div class="row">
                                        <div class="col-11">
                                            <select name="excavator_employee_uuid" class="form-control selecOperator"
                                                id="excavator_employee_id">
                                                @foreach($employees as $employee)
                                                @if(old('employee_uuid' ) == $employee->uuid)
                                                <option value="{{ $employee->uuid }}" selected>{{ $employee->name }}
                                                </option>
                                                @else
                                                <option value="{{ $employee->uuid }}">{{ $employee->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label>Excavator</label>
                                            <div class="row">
                                                <div class="col-11">
                                                    <select class="form-control theSelect2"
                                                        name="excavator_vehicle_uuid" id="excavator_vehicle_uuid">
                                                        @foreach($excavators as $excavator)
                                                        <option value="{{ $excavator->uuid }}">
                                                            {{ $excavator->vehicle_code }} - {{ $excavator->number }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Kapasitas</label>
                                            <div class="row">
                                                <div class="col-11">
                                                    <select class="form-control" name="ex_capacity" id="ex_capacity">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a href="/ob/setup">
                                    <button type="button" class="btn btn-secondary">Batal</button>
                                </a>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Bootstrap 4 Admin Template By
                <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ env('APP_URL') }}vendors/scripts/dashboard3.js"></script>

<script>

</script>
@endsection