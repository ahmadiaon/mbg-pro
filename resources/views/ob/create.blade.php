@extends('layout_adm.main')

@section('content')
{{-- @dd($over_burden->checker_employee_id) --}}
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20 ">

        <div class="modal-content mb-30">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Setup Over Burden
                </h4>
                @if($id)
                <div class="alert alert-primary" role="alert">
                    Has done setup
                    <a href="/admin-ob/hour-meter/{{ $id }}">
                        <button type="button" class="btn btn-primary">
                            HM <span class="icon-copy ti-dashboard"></span>
                        </button>
                    </a>
                    <a href="/admin-ob/ritasi/{{ $id }}">
                        <button type="button" class="btn" data-bgcolor="#00b489" data-color="#ffffff"
                            style="color: rgb(255, 255, 255); background-color: rgb(0, 180, 137);">
                            ritasi <i class="icon-copy dw dw-truck"></i>
                        </button>
                    </a>
                </div>

                @endif

            </div>
            <form action="/admin-ob" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <div class="row">
                        {{-- checker --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Checker</label>
                                <div class="row">
                                    <div class="col-lg-11">
                                        <select name="checker_employee_id" class="form-control theSelect theSelect2"
                                            id="checker_employee_id">
                                            @foreach($employees as $employee)
                                            @if(old('employee_id', $checker ) == $employee->id)
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
                        <div class="col-6">
                            <div class="form-group">
                                <label>Foreman</label>
                                <div class="row">
                                    <div class="col-11">
                                        <select name="foreman_employee_id" class="form-control theSelect theSelect3"
                                            id="foreman_employee_id">
                                            @foreach($employees as $employee)
                                            @if(old('employee_id', $foreman ) == $employee->id)
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
                        <div class="col-6">
                            <div class="form-group">
                                <label>Supervisor</label>
                                <div class="row">
                                    <div class="col-11">
                                        <select name="supervisor_employee_id" class="form-control theSelect theSelect4"
                                            id="supervisor_employee_id">
                                            @foreach($employees as $employee)
                                            @if(old('employee_id', $supervisor) ==
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

                        {{-- pit --}}
                        <div class="col-6">
                            <div class="form-group">
                                <label>Pit</label>
                                <div class="row">
                                    <div class="col-11">
                                        <select name="pit_id" class="form-control theSelect theSelect4" id="pit_id">
                                            @foreach($pits as $pit)
                                            @if(old('pit_id' ) == $pit->id)
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

                        <div class="col-2">
                            <label for="">Tanggal</label>
                            <input name="date" id="date" value="{{ $today }}" onblur="convertDate()"
                                class="form-control date-picker" placeholder="Select Date" type="text">
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label class="weight-600">Shift</label>
                                <div class="row">
                                    <div class="col-3 mr-20">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="customRadio5" {{ ($shifts=='Siang' )? 'checked' :''
                                                }} name="shift" value="Siang" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio5">Siang</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="ml-10 custom-control custom-radio mb-5">
                                            <input type="radio" id="customRadio6" {{ ($shifts=='Malam' )? 'checked' :''
                                                }} name="shift" value="Malam" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio6">Malam</label>
                                        </div>
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
                                    value="{{ old('distance', $distance) }}" id="distance">
                                @error('distance')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        {{-- material --}}
                        <div class="col-5">
                            <div class="form-group">
                                <label class="weight-600">Material</label>
                                <div class="row">
                                    <div class="col-2 mr-10">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="customRadio1" {{ ($material=='OB' )? 'checked' :''
                                                }} name="material" value="OB" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio1">OB</label>
                                        </div>
                                    </div>
                                    <div class="col-3 mr-20">
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="customRadio3" {{ ($material=='Lumpur' )? 'checked'
                                                :'' }} name="material" value="Lumpur" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio3">Lumpur</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="ml-10 custom-control custom-radio mb-5">
                                            <input type="radio" id="customRadio2" {{ ($material=='Top Soil' )? 'checked'
                                                :'' }} name="material" value="Top Soil" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio2">Top Soil</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" placeholder="Catatan" name="note" id="" cols="30"
                                rows="10">{{ $note }}</textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
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
    function getNumericMonth(monthAbbr) {
      return (String(["januari", "februari", "maret", "april", "mei", "juni", "juli", "agustus", "september", "oktober", "november", "desember"].indexOf(monthAbbr) + 1).padStart(2, '0'))
    }
    function convertDate(){
        var inputVal = document.getElementById("date").value;
        const result = inputVal.trim().split(/\s+/);
        month1 = result[1].toLowerCase();
        var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        
        var month = getNumericMonth(month1)
        var dateNew = result[0]+'-'+month+'-'+result[2]
        $("#date").val(dateNew);
    }
</script>
@endsection