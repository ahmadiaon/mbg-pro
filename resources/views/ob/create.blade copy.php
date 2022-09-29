@extends('layout_adm.main')

@section('content')
{{-- @dd($over_burden->checker_employee_id) --}}
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">

        <div class="row">
            <div class="col-3 pd-20 mr-20 card-box mb-30">
                <form action="/ob-add" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="over_burden_id" value="{{ $over_burden->id }}">
                    <div class="form-group">
                        <label>Operator</label>
                        <div class="row">
                            <div class="col-11">
                                <select name="operator_employee_id" class="form-control selecOperator"
                                    id="operator_employee_id">
                                    @foreach($employees as $employee)
                                    @if(old('employee_id' ) == $employee->id)
                                    <option value="{{ $employee->id }}" selected>{{ $employee->name }}
                                    </option>
                                    @else
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
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
                                        <select class="form-control theSelect2" name="vehicle_id" id="vehicle_id">
                                            @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">
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

                    <a href="/ob/setup">
                        <button type="button" class="btn btn-secondary">Batal</button>
                    </a>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>

            <div class="col-8 pd-20 card-box mb-30">
                @if(session()->has('success'))
                <div class="alert alert-primary" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <form action="/ob" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- checker --}}
                        <div class="col-4">
                            <div class="form-group">
                                <label>Checker</label>
                                <div class="row">
                                    <div class="col-11">
                                        <select name="checker_employee_id" class="form-control theSelect2"
                                            id="checker_employee_id">
                                            @foreach($employees as $employee)
                                            @if(old('employee_id', $over_burden->checker_employee_id ) == $employee->id)
                                            <option value="{{ $employee->id }}" selected>{{ $employee->name }}
                                            </option>
                                            @else
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- foreman --}}
                        <div class="col-4">
                            <div class="form-group">
                                <label>Foreman</label>
                                <div class="row">
                                    <div class="col-11">
                                        <select name="foreman_employee_id" class="form-control theSelect3"
                                            id="foreman_employee_id">
                                            @foreach($employees as $employee)
                                            @if(old('employee_id', $over_burden->foreman_employee_id ) == $employee->id)
                                            <option value="{{ $employee->id }}" selected>{{ $employee->name }}
                                            </option>
                                            @else
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- svp --}}
                        <div class="col-4">
                            <div class="form-group">
                                <label>Supervisor</label>
                                <div class="row">
                                    <div class="col-11">
                                        <select name="supervisor_employee_id" class="form-control theSelect4"
                                            id="supervisor_employee_id">
                                            @foreach($employees as $employee)
                                            @if(old('employee_id', $over_burden->supervisor_employee_id) ==
                                            $employee->id)
                                            <option value="{{ $employee->id }}" selected>{{ $employee->name }}
                                            </option>
                                            @else
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- pit --}}
                        <div class="col-4">
                            <div class="form-group">
                                <label>Pit</label>
                                <div class="row">
                                    <div class="col-11">
                                        <select name="pit_id" class="form-control theSelect4" id="pit_id">
                                            @foreach($pits as $pit)
                                            @if(old('pit_id', $over_burden->pit_id ) == $pit->id)
                                            <option value="{{ $pit->id }}" selected>{{ $pit->pit_name }}
                                            </option>
                                            @else
                                            <option value="{{ $pit->id }}">{{ $pit->pit_name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- distance --}}
                        <div class="col-2">
                            <div class="form-group">
                                <label>Distance</label>
                                <input name="distance" type="text"
                                    class="form-control  @error('distance') is-invalid @enderror"
                                    value="{{ old('distance', $over_burden->distance) }}" id="distance">
                                @error('distance')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        {{-- material --}}
                        <div class="col-4">
                            <div class="form-group">
                                <label class="weight-600">Material</label>
                                <div class="row">
                                    <div class="col-2 mr-10">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="customRadio1" {{ ($over_burden->material
                                            == 'OB')?'checked' : '' }} name="material" value="OB"
                                            class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio1">OB</label>
                                        </div>
                                    </div>
                                    <div class="col-3 mr-20">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="customRadio3" name="material" {{
                                                ($over_burden->material == 'Lumpur')?'checked' : '' }}
                                            value="Lumpur"
                                            class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio3">Lumpur</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="ml-10 custom-control custom-radio mb-5">
                                            <input type="radio" id="customRadio2" name="material" {{
                                                ($over_burden->material == 'Top Soil')?'checked' : '' }}
                                            value="Top Soil" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio2">Top Soil</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- distance --}}
                        {{-- <div class="col-2">
                            <div class="form-group">
                                <label>Kapasitas</label>
                                <input name="pre_capacity" type="text"
                                    class="form-control  @error('pre_capacity') is-invalid @enderror"
                                    value="{{ old('pre_capacity', $over_burden->pre_capacity) }}" id="pre_capacity">
                                @error('pre_capacity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div> --}}
                    </div>
                    <a href="/admin/setup">
                        <button type="button" class="btn btn-secondary">Batal</button>
                    </a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>
        <div class="row clearfix">
            @if($over_burden_operators)
            @foreach($over_burden_operators as $over_burden_operator)
            <div class="col-4 pd-20 ">
                <form action="/ob/add-ritase" method="POST">
                    @csrf
                    <input type="hidden" name="over_burden_id" value="{{ $over_burden->id }}">
                    <input type="hidden" name="over_burden_operator_id" value="{{ $over_burden_operator->id }}">
                    <div class="card-box h-100 mr-20 pd-20">
                        <div class="row">
                            <div class="col-7">
                                <h6 class="h5 mb-10">{{ $over_burden_operator->nik_employee }}</h6>
                                <h6 class="h5 mb-10"> {{$over_burden_operator->name }}</h6>
                                <div class="row">
                                    <div class="col">
                                        <p class="mb-0">{{ $over_burden_operator->vehicle_code }}-{{
                                            $over_burden_operator->number
                                            }} </p>
                                    </div>
                                    <div class="col-8">
                                        <a onclick="subBucket('{{ $over_burden_operator->id }}-kapasitas')">
                                            <i class="icon-copy ion-chevron-down"></i>
                                        </a>
                                        <input type="text" name="over_burden_capacity"
                                            id="input-{{ $over_burden_operator->id }}-kapasitas"
                                            value="{{ $over_burden_operator->capacity }}">
                                        <label for="" id="{{ $over_burden_operator->id }}-kapasitas"
                                            class="ml-30 mr-30">{{ $over_burden_operator->capacity }}</label>
                                        <label for=""> Bucket</label>
                                        <a onclick="addBucket('{{ $over_burden_operator->id }}-kapasitas')"
                                            style="cursor: pointer"><i class="icon-copy ion-chevron-up"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="mx-w-150">
                                </div>
                                <button type="submit" class="H-100 btn btn-primary float-right">Add Ritase</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
            @else
            <div class="col-lg-12 col-md-6 col-sm-12 mb-30 text-center">
                <h2>Empety Operator</h2>
            </div>
            @endif
        </div>

        <div class="pd-20 col-6 card-box mb-30">
            <div class="pd-20">
                <div class="row">
                    <div class="col-6">
                        <h4 class="text-blue h4">Data Operator dan Unit</h4>
                    </div>
                    <div class="col">
                        <div class="mb-0 float-right">
                            <a href="/admin/people/create" class="btn btn-primary">add</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-20 ">
                <table id="myTablse" class="table table-stripped">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">Operator</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <td>11</td>
                            <td>11</td>
                            <td>11</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
</div>
@endsection
@section('js')


<script>
    $(".theSelect2").select2();
    $(".theSelect3").select2();
    $(".selecOperator").select2();
    $(".theSelect4").select2();
    
    $(".theSelect5").select2();


    function addBucket(kapasitas){
        labelText = $('#'+kapasitas).text()
        $('#'+kapasitas).text(parseInt(labelText)+1);
        $('#input-'+kapasitas).val(parseInt(labelText)+1);
    }
    function subBucket(kapasitas){
        labelText = $('#'+kapasitas).text()
        $('#'+kapasitas).text(parseInt(labelText)-1);
        $('#input-'+kapasitas).val(parseInt(labelText)-1);
    }
</script>
@endsection