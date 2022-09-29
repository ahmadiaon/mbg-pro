@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">


        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row">
                    <div class="col-6">
                        <h4 class="text-blue h4">Monitoring Employee</h4>
                    </div>
                    <div class="col">
                        <div class="mb-0 float-right">
                            <a href="/admin-hr/employees/create" class="btn btn-primary">add</a>
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
                            <th class="">No Reg.</th>
                            <th class="">NIK Karyawan</th>
                            <th class="">Nama</th>
                            <th class=""><i class="icon-copy fi-paw"></i></th>
                            <th class=""><i class="icon-copy ion-ios-person"></i></th>
                            <th class=""><i class="icon-copy fa fa-user-o" aria-hidden="true"></i></th>
                            <th class="">B</th>
                            <th class="">O</th>
                            <th class="">K</th>
                            <th class="">A</th>
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
@endsection

@section('js')
<script>
    $(function() {
        $('#myTablse').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('safety-data') !!}',
            columns: [
                { data: 'no_reg', name: 'no_reg' },
                { data: 'nik_employee', name: 'nik_employee' },
                { data: 'name', name: 'name' },
                { data: 'boots_size', name: 'boots_size' },
                { data: 'helm_color', name: 'helm_color' },
                { data: 'rompi_status', name: 'rompi_status' },
                { data: 'orange_size', name: 'orange_size' },
                { data: 'blue_size', name: 'blue_size' },
                { data: 'shirt_size', name: 'shirt_size' },
                { data: 'action', name: 'action' }
            ]
        });
    });
</script>
@endsection