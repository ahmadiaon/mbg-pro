@extends('layout_adm.main')
@section('content')
<div class="main-container">

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
            <div class="card-box pd-30 pt-10 height-100-p">
                <h2 class="mb-30 h4">Add Member</h2>
                <form action="/foreman/manage-member" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="shift_id" id="" value="{{ $checker->id }}">

                    <input type="hidden" name="shift_uuid" id="" value="{{ $checker->uuid }}">
                    <input type="hidden" name="nik_employee_checker" id="" value="{{ $checker->nik_employee }}">
                    <label for="">Checker : </label>
                    <h5>
                        {{ $checker->name }} | {{ $checker->nik_employee }} | {{ $checker->shift_time }} </h5> <br>
                    <div class="form-group mt-20">
                        <label>Choose Operator/Driver</label>
                        <div class="row">
                            <div class="col-11">
                                <select name="contract_employee_uuid" class="form-control selecOperator"
                                    id="contract_employee_uuid">
                                    @foreach($employees as $employee)
                                    @if(old('contract_employee_uuid' ) == $employee->uuid)
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
                                        colspan="1" aria-label="Gender: activate to sort column ascending">Position
                                    </th>
                                    <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1"
                                        aria-label="Actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($shiftLists)
                                @foreach($shiftLists as $checker)
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
                                    <td>{{ $checker->position }}</td>
                                    <td>
                                        <div class="table-actions">
                                            {{-- <a href="/foreman/manage-unit/{{ $checker->uuid }}"
                                                data-color="#265ed7" style="color: rgb(187, 210, 36);">
                                                <i class="icon-copy fi-list"></i>
                                            </a> --}}
                                            <a href="/foreman/manage-member-list/delete/{{ $checker->nik_employee }}"
                                                data-color="#e95959" style="color: rgb(233, 89, 89);"><i
                                                    class="icon-copy dw dw-delete-3"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr role="row">
                                    <h1>null data</h1>
                                </tr>
                                @endif

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

        var long = 7;

        var date = new Date(month+' '+result[0]+' '+result[2]);

        // Add ten days to specified date
        date.setDate(date.getDate() + parseInt(long) );
        $("#shift_date_end").val(date.getDate()+' '+months[date.getMonth()]+' '+date.getFullYear());

        console.log(date);

    }
</script>
@endsection