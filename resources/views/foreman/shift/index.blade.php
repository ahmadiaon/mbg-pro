@extends('layout_adm.main')
@section('content')
<div class="main-container">

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
            <div class="card-box pd-30 pt-10 height-100-p">
                <h2 class="mb-30 h4">Choose Checker</h2>
                <form action="/ob-add" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Choose Checker</label>
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
                    <div class="form-group">
                        <label>Shift Start</label>
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
                    <a href="/ob/setup">
                        <button type="button" class="btn btn-secondary">Batal</button>
                    </a>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12 mb-30">
            <div class="card-box pd-30 pt-10 height-100-p">
                <h2 class="mb-30 h4">List Shift</h2>

            </div>
        </div>
    </div>
    <div class="xs-pd-20-10 pd-ltr-20">
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