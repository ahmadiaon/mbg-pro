@extends('layout.main_menu')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>DataTable</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    DataTable
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <div class="dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                Januari 2018
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Export List</a>
                                <a class="dropdown-item" href="#">Policies</a>
                                <a class="dropdown-item" href="#">View Assets</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">

                    <div class="row">
                        <div class="col-6">
                            <h4 class="text-blue h4">Data People</h4>
                        </div>
                        <div class="col">
                            <div class="mb-0 float-right">
                                <a href="" class="btn btn-primary">add</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="pb-20">
                    <table id="myTablse" class="table table-stripped">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Name</th>
                                <th>Age</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- Simple Datatable End -->

            <!-- Export Datatable End -->
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
            ajax: '{!! route('people-data') !!}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'phone_number', name: 'phone_number' }
            ]
        });
    });
</script>
@endsection