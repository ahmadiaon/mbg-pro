@extends('layout_adm.main')

@section('content')
{{-- @dd($over_burden->checker_employee_id) --}}
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="container px-0">
                @foreach($over_burden_flits as $flit)
                <h4 class="mb-30 mt-30 text-blue h4 text-center">Flit Excavator :{{ $flit->group_code }}-{{
                    $flit->number }}</h4>
                <div class="row">
                    @if($over_burden_operators->isNotEmpty())
                    @foreach($over_burden_operators as $over_burden_operator)
                    @if($over_burden_operator->over_burden_flit_uuid == $flit->uuid)
                    <div class="col-md-4 mb-30">
                        <form action="/foreman/hour-meter" id="hour-meter-{{ $over_burden_operator->uuid }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="uuid" value="{{ $over_burden_operator->uuid}}">
                            <input type="hidden" name="over_burden_uuid" value="{{ $over_burden->uuid}}">
                            <input type="hidden" name="vehicle_uuid" value="{{ $over_burden_operator->vehicle_uuid}}">
                            <input type="hidden" name="over_burden_operator_uuid" value="{{ $over_burden_operator->over_burden_operator_uuid}}">
                            <div class="card-box pricing-card-style2">
                                <div class="pricing-card-header">
                                    <div class="left">
                                        <h5>{{$over_burden_operator->name}}</h5>
                                        <p> {{ $over_burden_operator->nik_employee }}</p>
                                    </div>
                                    <div class="right">
                                        <div class="pricing-price"> {{ $over_burden_operator->group_code }}<span> {{
                                                $over_burden_operator->number }}</span></div>
                                    </div>
                                </div>
                                <div class="pricing-card-body">
                                    <div class="pricing">
                                        <ul class="mb-10">
                                           
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
                                                    
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-2">
                                                        Time Start
                                                    </div>
                                                    <div class="col-4">
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
                                                    <div class="col-2">
                                                        Time Stop
                                                    </div>
                                                    <div class="col-4">
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

                                        </ul>
                                        <div class="row mt-10">
                                            <div class="col-4">
                                                <div class="text-center">
                                                    Operator<br />
                                                    {{-- @dd($over_burden_operator) --}}
                                                    @if($over_burden_operator->datetime_operator_approve)
                                                        <i class="icon-copy fi-check"></i>
                                                    @else
                                                        <i class="icon-copy fa fa-clock-o" aria-hidden="true"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="text-center">
                                                    Checker<br />
                                                    @if($over_burden_operator->datetime_checker_approve)
                                                        <i class="icon-copy fi-check"></i>
                                                    @else
                                                        <i class="icon-copy fa fa-clock-o" aria-hidden="true"></i>
                                                    @endif
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="cta">
                                    @if($over_burden_operator->datetime_foreman_approve)
                                    <a onclick="document.forms['hour-meter-{{ $over_burden_operator->uuid }}'].submit();"
                                        style="cursor: pointer" class="btn btn-success btn-rounded btn-lg ">Disetujui</a>
                                    @else
                                    <a onclick="document.forms['hour-meter-{{ $over_burden_operator->uuid }}'].submit();"
                                        style="cursor: pointer" class="btn btn-warning btn-rounded btn-lg ">Setujui ?</a>
                                    @endif
                                   
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
                    @foreach($over_burden_operator_supports as $over_burden_operator)
                    <div class="col-md-4 mb-30">
                        <form action="/foreman/hour-meter" id="hour-meter-{{ $over_burden_operator->uuid }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="uuid" value="{{ $over_burden_operator->uuid }}">
                            <input type="hidden" name="over_burden_uuid" value="{{ $over_burden->uuid}}">
                            <input type="hidden" name="vehicle_uuid" value="{{ $over_burden_operator->vehicle_uuid}}">
                            <div class="card-box pricing-card-style2">
                                <div class="pricing-card-header">
                                    <div class="left">
                                        <h5>{{$over_burden_operator->name}}</h5>
                                        <p> {{ $over_burden_operator->nik_employee }}</p>
                                    </div>
                                    <div class="right">
                                        <div class="pricing-price"> {{ $over_burden_operator->group_code }}<span> {{
                                                $over_burden_operator->number }}</span></div>
                                    </div>
                                </div>
                                <div class="pricing-card-body">
                                    <div class="pricing">
                                        <ul>
                                           
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
                    @endforeach
                    @else
                    <div class="col-lg-12 col-md-6 col-sm-12 mb-30 text-center">
                        <h2>Empety Support</h2>
                    </div>
                    @endif
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