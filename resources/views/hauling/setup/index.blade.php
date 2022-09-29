@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">


        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row">
                    <div class="col-6">
                        <h4 class="text-blue h4">Hauling</h4>
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
                            <th class="">Date</th>
                            <th class="">Coal From</th>
                            <th class="">Shift 1</th>
                            <th class="">Shift 2</th>
                            <th class="">Calorie</th>
                            <th class="">Type</th>
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