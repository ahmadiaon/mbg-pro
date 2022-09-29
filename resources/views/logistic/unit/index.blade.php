@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">


        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row">
                    <div class="col-6">
                        <h4 class="text-blue h4">Vehicle Unit</h4>
                    </div>
                    <div class="col">
                        <div class="mb-0 float-right">
                            <a href="" 
                            data-toggle="modal"
                            data-target="#task-add" class="btn btn-primary">add</a>
                        </div>
                    </div>
                </div>
            </div>
            @if(session()->has('success'))
            <div class="alert alert-primary" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="pb-20">
                <table id="myTablse" class="table table-stripped">
                    <thead>
                        <tr>
                            <th class="">Number</th>
                            <th class="">Group</th>
                            <th class="">Code Group</th>
                            <th class="">Status</th>
                            <th class="">Type</th>
                            <th class="">Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- Simple Datatable End -->




        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
</div>




<div
    class="modal fade customscroll"
    id="task-add"
    tabindex=""
    role="dialog"
>
    <div
        class="modal-dialog modal-dialog-centered"
        role="document"
    >
        <div class="modal-content">
            <form action="/logistic/unit" method="POST">
                @csrf
            <div class="modal-header">
                <h5
                    class="modal-title"
                    id="exampleModalLongTitle"
                >
                    Tasks Add
                </h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                    data-toggle="tooltip"
                    data-placement="bottom"
                    title=""
                    data-original-title="Close Modal"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-0">
                <div class="task-list-form">
                    <ul>
                        <li>
                                <div class="form-group row">
                                    <label class="col-md-4"
                                        >Vehicle Type</label
                                    >
                                    <div class="col-md-8">
                                        <select
                                            class="custom-select2 form-control"
                                            name="brand_type_uuid"
                                            id="brand_type_uuid"
                                            style="width: 100%; height: 38px"
                                        >
                                        @foreach ($brand_types as $brand_type)
                                             <option value="{{ $brand_type->uuid }}">{{ $brand_type->brand }}-{{ $brand_type->type }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4"
                                        >Location</label
                                    >
                                    <div class="col-md-8">
                                        <select
                                            class="custom-select2 form-control"
                                            name="location_uuid"
                                            id="location_uuid"
                                            style="width: 100%;"
                                        >
                                        @foreach ($locations as $location)
                                             <option value="{{ $location->uuid }}">{{ $location->location }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-4"
                                        >Number</label
                                    >
                                    <div class="col-md-8">
                                        <input required
                                            type="text"
                                            name="number"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4"
                                        >Status</label
                                    >
                                    <div class="col-md-8">
                                        <select
                                            class="custom-select2 form-control"
                                            name="status_uuid"
                                            id="status_uuid"
                                            style="width: 100%;"
                                        >
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->uuid }}">{{ $status->status }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label class="col-md-4"
                                        >Date Start</label
                                    >
                                    <div class="col-md-8">
                                        <input required
                                            type="text"
                                            name="date_start"
                                            class="form-control date-picker"
                                        />
                                    </div>
                                </div>
                          
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Add
                </button>
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                >
                    Close
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- add task popup End -->
@endsection

@section('js')

<script>
    $(function() {
        $('#myTablse').DataTable({
            processing: true,
            serverSide: true,
            ajax:'{!! url(env('APP_URL').'logistic/data-unit') !!}',
            columns: [
                { data: 'number', name: 'number' },
                { data: 'group_name', name: 'group_name' },
                { data: 'group_code', name: 'group_code' },
                { data: 'hm_name', name: 'hm_name' },
                { data: 'type', name: 'type' },
                { data: 'type', name: 'type' },
                { data: 'action', name: 'action' }
            ]
        });
    });
</script>
@endsection