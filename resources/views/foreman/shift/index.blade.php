@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">

                    <div class="row">
                        <div class="col-6">
                            <h4 class="text-blue h4">List Shift</h4>
                        </div>
                        <div class="col">
                            <div class="mb-0 float-right">
                                <a href="/foreman/shifts/create" class="btn btn-primary">add</a>
                            </div>
                        </div>
                    </div>
                    <p class="mb-0">
                        you can find more options
                        <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a>
                    </p>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Name</th>
                                <th>Age</th>
                                <th>Office</th>
                                <th>Address</th>
                                <th>Start Date</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-plus">Gloria F. Mead</td>
                                <td>25</td>
                                <td>Sagittarius</td>
                                <td>2829 Trainer Avenue Peoria, IL 61602</td>
                                <td>29-03-2018</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                            href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                            <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Simple Datatable End -->
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
</script>
@endsection