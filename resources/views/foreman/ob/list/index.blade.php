@extends('layout_adm.main')

@section('content')
{{-- @dd($over_burden->checker_employee_id) --}}
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="pd-20 col-12  mb-30">
            <div class="row">
                {{-- list ob --}}
                <div class="col-7 mr-20">
                    <div class="card-box mb-30">
                        <div class="pd-20">
                            <h4 class="text-blue h4">List BCM Operator OB</h4>
                        </div>
                        <div class="pb-20">
                            <table class="data-table table stripe hover nowrap">
                                <thead>
                                    <tr>
                                        <th>Operator</th>
                                        <th>Unit</th>
                                        <th>BCM</th>
                                        <th>Ritasi</th>
                                        <th class="datatable-nosort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($over_burden_lists as $over_burden_list)
                                    <tr>
                                        <td class="table-plus">{{ $over_burden_list->name }}</td>
                                        <td>{{ $over_burden_list->vehicle_code }} - {{ $over_burden_list->number }}</td>
                                        <td>{{ $over_burden_list->over_burden_time }}</td>
                                        <td>{{ $over_burden_list->vehicle_code_excavator }} - {{
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


@endsection