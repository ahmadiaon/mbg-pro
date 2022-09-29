@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">

        <div class="pd-20 col-10 card-box mb-30">
            <div class="pd-20">
                <div class="row">
                    <div class="col-6">
                        <h4 class="text-blue h4">Over Burden Engineer</h4>
                    </div>
                    <div class="col">
                        <div class="mb-0 float-right">
                            <a href="/admin-ob/create" class="btn-block" type="button">
                                <button class="btn btn-primary">Add</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-20 ">
                <table id="myTablse" class="table table-stripped">
                    <thead>
                        <tr>
                            <th class="">Date</th>
                            <th class="">Checker</th>
                            <th class="">Shift</th>
                            <th>Action</th>
                        </tr>
                    </thead>
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
    $(function() {
        $('#myTablse').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('ob-data') !!}',
            columns: [
                { data: 'date', name: 'date' },
                { data: 'name', name: 'name' },
                { data: 'shift', name: 'shift' },
                { data: 'action', name: 'action' }
            ]
        });
    });
</script>
@endsection