@extends('layout_adm.main')

@section('content')
{{-- @dd($over_burden->checker_employee_uuid) --}}
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="row clearfix">
            {{-- @dd($over_burden_operators) --}}
            @if($over_burden_operators->isNotEmpty())
            @foreach($over_burden_operators as $over_burden_operator)

            <div class="col-xl-4 col-lg-4 col-md-4 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <form action="/admin-ob/add-ritase" id="ritase-form-{{ $over_burden_operator->uuid }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="over_burden_uuid" value="{{  $over_burden->uuid }}">
                        <input type="hidden" name="over_burden_operator_uuid"
                            value="{{ $over_burden_operator->over_burden_operator_uuid }}">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="weight-700 font-24 text-dark">
                                            {{ $over_burden_operator->group_code }}-
                                            {{ $over_burden_operator->number }}</div>
                                        <div class="font-14 text-secondary weight-500">
                                            {{ $over_burden_operator->nik_employee }} <br> {{$over_burden_operator->name }}
                                        </div>
                                        <div>
                                            <select class="form-control" name="over_burden_flit_uuid"
                                                id="over_burden_flit_uuid">
                                                @if($over_burden_flits->isNotEmpty())
                                                @foreach($over_burden_flits as $flit)
                                                <option value="{{ $flit->uuid }}" {{ ($flit->uuid ==
                                                    $over_burden_operator->over_burden_flit_uuid)?'selected':'' }}>
                                                    {{ $flit->group_code }} - {{ $flit->number }}
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
                                    <div class="col-4 text-center">
                                        <div>
                                            <a onclick="addBucket('{{ $over_burden_operator->uuid }}-kapasitas')"
                                                style="cursor: pointer"><i class="icon-copy ion-chevron-up"></i>
                                            </a>
                                        </div>
                                        <input type="hidden" name="over_burden_capacity"
                                            id="input-{{ $over_burden_operator->uuid }}-kapasitas"
                                            value="{{ $over_burden_operator->capacity }}">
                                        <label for="" id="{{ $over_burden_operator->uuid }}-kapasitas" class="mb-1">{{
                                            $over_burden_operator->capacity }}</label>
                                        <label for=""> Bucket</label>
                                        <div>
                                            <a onclick="subBucket('{{ $over_burden_operator->uuid }}-kapasitas')"
                                                style="cursor: pointer">
                                                <i class="icon-copy ion-chevron-down"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div onclick="document.forms['ritase-form-{{ $over_burden_operator->uuid }}'].submit();"
                                style="cursor: pointer" class="widget-icon">
                                <div class="icon" data-color="#ff5b5b" style="color: rgb(255, 91, 91);">
                                    <i class="icon-copy ion-clock"></i>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-lg-12 col-md-6 col-sm-12 mb-30 text-center">
                <h2>Empety Operator</h2>
            </div>
            @endif
        </div>
        <div class="row">

        </div>
        <div class="pd-20 col-12  mb-30">
            <div class="row">
                {{-- list ob --}}
                <div class="col-7 mr-20">
                    <div class="card-box mb-30">
                        <div class="pd-20">
                            <h4 class="text-blue h4">List Ritasi Over Burdens</h4>
                        </div>
                        <div class="pb-20">
                            <table class="data-table table stripe hover nowrap">
                                <thead>
                                    <tr>
                                        <th>Operator</th>
                                        <th>Unit</th>
                                        <th>Time</th>
                                        <th>Flit</th>
                                        <th class="datatable-nosort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($over_burden_lists as $over_burden_list)
                                    <tr>
                                        <td class="table-plus">{{ $over_burden_list->name }}</td>
                                        <td>{{ $over_burden_list->group_code }} - {{ $over_burden_list->number }}</td>
                                        <td>{{ $over_burden_list->over_burden_time }}</td>
                                        <td>{{ $over_burden_list->group_code_excavator }} - {{
                                            $over_burden_list->number_excavator }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                                    <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Simple Datatable End -->
                </div>
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
<script src="{{ env('APP_URL') }}vendors/scripts/dashboard3.js"></script>

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
    function sub(){
        console.log('pressed')
    }
</script>
@endsection