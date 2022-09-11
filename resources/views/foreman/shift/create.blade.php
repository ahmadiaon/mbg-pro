@extends('layout_adm.main')
@section('content')
<div class="main-container">

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
            <div class="card-box pd-30 pt-10 height-100-p">
                <h2 class="mb-30 h4">Manage Checker</h2>
                <form action="/foreman/shifts" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Choose Checker</label>
                        <div class="row">
                            <div class="col-11">
                                <select name="checker_uuid" class="form-control selecOperator" id="checker_uuid">
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
                    <div class="form-group">
                        <label>Date Start</label>
                        <input name="shift_date_start" id="shift_date_start" onblur="changeEnd()"
                            class="form-control date-picker" placeholder="Select Date" type="text">
                    </div>
                    <div class="form-group">
                        <label>Date End</label>
                        <input name="shift_date_end" id="shift_date_end" class="form-control date-picker"
                            placeholder="Select Date" type="text">
                    </div>
                    <div class="form-group">
                        <label class="weight-600">Shift Time</label>
                        <div class="row">
                            <div class="col-2 mr-10">
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="customRadio1" {{ ($shift_time=='Siang' )?'checked' : '' }}
                                        name="shift_time" value="Siang" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Siang</label>
                                </div>
                            </div>
                            <div class="col-3 mr-20">
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="customRadio3" name="shift_time" {{ ($shift_time=='Malam'
                                        )?'checked' : '' }} value="Malam" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio3">Malam</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
        <div class=" col-sm-8 card-box pb-10">
            <div class="h5 pd-20 mb-0">Checker List</div>
            @if(session()->has('success'))
            <div class="alert alert-primary" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12 col-md-6"></div>
                    <div class="col-sm-12 col-md-6"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="data-table table nowrap dataTable no-footer dtr-inline" id="DataTables_Table_0"
                            role="grid">
                            <thead>
                                <tr role="row">
                                    <th class="table-plus sorting_asc" tabindex="0" aria-controls="DataTables_Table_0"
                                        rowspan="1" colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending">Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Gender: activate to sort column ascending">Date Start
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Weight: activate to sort column ascending">Date End</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Assigned Doctor: activate to sort column ascending">
                                        Shift Time</th>
                                    <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1"
                                        aria-label="Actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($checkers as $checker)
                                <tr role="row" class="odd">
                                    <td class="table-plus sorting_1" tabindex="0">
                                        <div class="name-avatar d-flex align-items-center">
                                            <div class="avatar mr-2 flex-shrink-0">
                                                <img src="{{ env('APP_URL') }}vendors/images/photo8.jpg"
                                                    class="border-radius-100 shadow" width="40" height="40" alt="">
                                            </div>
                                            <div class="txt">
                                                <div class="weight-600">{{ $checker->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $checker->shift_date_start }}</td>
                                    <td>{{ $checker->shift_date_end }}</td>
                                    <td>
                                        <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                            style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">{{
                                            $checker->shift_time }}</span>
                                    </td>
                                    <td>
                                        <div class="table-actions">
                                            <form class="mr-20" id="hour-meter-{{ $checker->id }}"
                                                action="/foreman/hour-meter" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $checker->id }}">
                                                <a onclick="document.forms['hour-meter-{{ $checker->id }}'].submit();"
                                                    style="cursor: pointer" data-color="#265ed7"
                                                    style="color: rgb(187, 210, 36);">
                                                    HM
                                                </a>
                                            </form>
                                            <form class="mr-10" id="over-burden-{{ $checker->id }}"
                                                action="/foreman/over-burden" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $checker->id }}">
                                                <a onclick="document.forms['over-burden-{{ $checker->id }}'].submit();"
                                                    style="cursor: pointer" data-color="#265ed7"
                                                    style="color: rgb(187, 210, 36);">
                                                    OB<i class="icon-copy bi bi-truck"></i>
                                                </a>
                                            </form>
                                            <form class="mr-10" id="shift-{{ $checker->id }}"
                                                action="/foreman/manage-member-list" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $checker->id }}">
                                                <a onclick="document.forms['shift-{{ $checker->id }}'].submit();"
                                                    style="cursor: pointer" data-color="#265ed7"
                                                    style="color: rgb(187, 210, 36);">
                                                    <i class="icon-copy fi-list"></i>
                                                </a>
                                            </form>

                                            <a href="#" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i
                                                    class="icon-copy dw dw-edit2"></i></a>
                                            <a href="#" data-color="#e95959" style="color: rgb(233, 89, 89);"><i
                                                    class="icon-copy dw dw-delete-3"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-5"></div>

                </div>
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
    function getNumericMonth(monthAbbr) {
      return (String(["januari", "februari", "maret", "april", "mei", "juni", "juli", "agustus", "september", "oktober", "november", "desember"].indexOf(monthAbbr) + 1).padStart(2, '0'))
    }

    function changeEnd(){
        var inputVal = document.getElementById("shift_date_start").value;
        const result = inputVal.trim().split(/\s+/);
        month1 = result[1].toLowerCase();
        var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        
        var month = getNumericMonth(month1)

        var long = 6;

        var date = new Date(month+' '+result[0]+' '+result[2]);

        // Add ten days to specified date
        date.setDate(date.getDate() + parseInt(long) );
        $("#shift_date_end").val(date.getDate()+' '+months[date.getMonth()]+' '+date.getFullYear());

        console.log(date);

    }
</script>
@endsection