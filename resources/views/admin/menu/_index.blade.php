@extends('layout.main_table')
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
                    <h4 class="text-blue h4">Data People</h4>
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6">
                            <p class="mb-0 right">
                                you can find more options <a href="create">Add</a>
                                <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="pb-20">
                    <table id="myTable" class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Name</th>
                                <th>Age</th>
                                <th>Office</th>
                                <th>Address</th>
                                <th>Start Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peoples as $people)
                            <tr>
                                <td class="table-plus">Andrea J. Cagle</td>
                                <td>18</td>
                                <td>Gemini</td>
                                <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
                                <td>29-03-2018</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Simple Datatable End -->

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
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
@endsection