@extends('layout.main_tables')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Department</h4>
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


            <div class="row">
                {{-- kiri --}}
                <div class="col-6">
                    {{-- Departement Table --}}
                    <div class="card-box mb-30">
                        <div class="pd-20">

                            <div class="row">
                                <div class="col-6">
                                    <h4 class="text-blue h4">List Department</h4>
                                </div>
                                <div class="col">
                                    <button type="button" onclick="addDepartment()"
                                        class="btn float-right btn-outline-primary">
                                        <i class="icon-copy bi bi-plus-square-fill pr-30"></i>Add
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="pd-20 card-box mb-20">
                            <div class="pb-20">
                                <table id="departmentTable" class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th width="80%" class="table-plus datatable">Name</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                </table>

                            </div>
                        </div>
                    </div>
                    {{-- Departement Table Ende --}}

                    {{-- vihicle Table --}}
                    <div class="card-box mb-30">
                        <div class="pd-20">

                            <div class="row">
                                <div class="col-6">
                                    <h4 class="text-blue h4">List Vehicle</h4>
                                </div>
                                <div class="col">
                                    <button type="button" onclick="addvehicle()"
                                        class="btn float-right btn-outline-primary">
                                        <i class="icon-copy bi bi-plus-square-fill pr-30"></i>Add
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="pd-20 card-box mb-20">
                            <div class="pb-20">
                                <table id="vehicleTable" class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th width="10%" class="table-plus datatable">Code</th>
                                            <th width="30%" class="table-plus datatable">Number</th>
                                            <th width="40%" class="table-plus datatable">Unit Group</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- vihicle Table End --}}

                    {{-- unit Table --}}
                    <div class="card-box mb-30">
                        <div class="pd-20">

                            <div class="row">
                                <div class="col-6">
                                    <h4 class="text-blue h4">List Unit</h4>
                                </div>
                                <div class="col">
                                    <button type="button" onclick="addUnit()"
                                        class="btn float-right btn-outline-primary">
                                        <i class="icon-copy bi bi-plus-square-fill pr-30"></i>Add
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="pd-20 card-box mb-20">
                            <div class="pb-20">
                                <table id="unitTable" class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th width="80%" class="table-plus datatable">Name</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- unit Table End --}}
                    {{-- unit Group Table --}}
                    <div class="card-box mb-30">
                        <div class="pd-20">

                            <div class="row">
                                <div class="col-6">
                                    <h4 class="text-blue h4">List Unit Group</h4>
                                </div>
                                <div class="col">
                                    <button type="button" onclick="addGroup_unit()"
                                        class="btn float-right btn-outline-primary">
                                        <i class="icon-copy bi bi-plus-square-fill pr-30"></i>Add
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="pd-20 card-box mb-20">
                            <div class="pb-20">
                                <table id="unit_groupTable" class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th width="40%" class="table-plus datatable">Name</th>
                                            <th width="20%" class="table-plus datatable">Capacity</th>
                                            <th width="20%" class="table-plus datatable">Unit</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- unit Group Table End --}}
                    {{-- unit Vehicle Group --}}
                    <div class="card-box mb-30">
                        <div class="pd-20">

                            <div class="row">
                                <div class="col-6">
                                    <h4 class="text-blue h4">List Vehicle Group</h4>
                                </div>
                                <div class="col">
                                    <button type="button" onclick="addvehicle_group()"
                                        class="btn float-right btn-outline-primary">
                                        <i class="icon-copy bi bi-plus-square-fill pr-30"></i>Add
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="pd-20 card-box mb-20">
                            <div class="pb-20">
                                <table id="vehicle_groupTable" class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th width="30%" class="table-plus datatable">Name Group</th>
                                            <th width="20%" class="table-plus datatable">Code</th>

                                            <th width="30%" class="table-plus datatable">Unit Group</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- unit Vehicle Group End --}}
                </div>
                {{-- end kiri --}}

                {{-- kanan --}}
                <div class="col-6">
                    {{-- tabel group vehicle --}}
                    <div class="card-box mb-30">
                        <div class="pd-20">

                            <div class="row">
                                <div class="col-6">
                                    <h4 class="text-blue h4">List Position</h4>
                                </div>
                                <div class="col">
                                    <button type="button" onclick="addPosition()"
                                        class="btn float-right btn-outline-primary">
                                        <i class="icon-copy bi bi-plus-square-fill pr-30"></i>Add
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="pd-20 card-box mb-20">
                            <div class="pb-20">
                                <table id="positionTable" class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th class="table-plus datatable">Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- end tabel group vehicle --}}

                    {{-- tabel religion --}}
                    <div class="card-box mb-30">
                        <div class="pd-20">

                            <div class="row">
                                <div class="col-6">
                                    <h4 class="text-blue h4">List Religion</h4>
                                </div>
                                <div class="col">
                                    <button disabled="disabled" type="button" onclick="addPosition()"
                                        class="btn float-right btn-outline-primary">
                                        <i class="icon-copy bi bi-plus-square-fill pr-30"></i>Add
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="pd-20 card-box mb-20">
                            <div class="pb-20">
                                <table id="religionTable" class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th width="80%" class="table-plus datatable">Name</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- end tabel religion --}}
                </div>
                {{-- end kanan --}}
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


{{-- modal add position --}}
<div class="modal fade" data-backdrop="false" id="add_position_modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Position
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>

            <div class="modal-body">
                <form name="userForm">

                    <div class="form-group">
                        {{-- hidden --}}
                        <input type="hidden" name="id_position" id="id_position">
                        <label id="label_position" for="position">Position name</label>
                        <input type="text" class="form-control" name="position" id="position"
                            aria-describedby="emailHelp" placeholder="Enter position name">
                        <span id="positionError" class="alert-message"></span>
                    </div>
                    <button type="submit">add</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="button" onclick="createPosition('/admin/position/')" class="btn btn-primary">
                    Save changes
                </button>
            </div>

        </div>
    </div>
</div>


{{-- modal add vehicle group --}}
<div class="modal fade" data-backdrop="false" id="add_vehicle_group_modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Vehicle Group
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>

            <div class="modal-body">
                <form name="userForm" action="/admin/vehicle_group/" method="POST">
                    @csrf
                    <input type="hidden" name="id_vehicle_group" id="id_vehicle_group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Unit Group</label>
                                <select id="unit_group_id" name="unit_group_id" class="custom-select2 form-control"
                                    name="state" style="width: 100%; height: 38px">

                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Vehicle Group</label>
                                <input name="vehicle_group"
                                    class="form-control @error('vehicle_group') is-invalid @enderror"
                                    value="{{ old('vehicle_group') }}" id="vehicle_group"
                                    placeholder="Enter vehicle_group name" type="text" id="vehicle_group">

                                <span id="vehicle_groupError" class="alert-message"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Code Vehicle</label>
                                <input name="vehicle_code"
                                    class="form-control @error('vehicle_code') is-invalid @enderror"
                                    value="{{ old('vehicle_code') }}" id="vehicle_code"
                                    placeholder="Enter vehicle_code name" type="text" id="vehicle_code">
                                <span id="vehicle_codeError" class="alert-message"></span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">das</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="button" onclick="createvehicle_group('/admin/vehicle_group/')" class="btn btn-primary">
                    Save changes
                </button>
            </div>

        </div>
    </div>
</div>

{{-- modal add vehicle --}}
<div class="modal fade" data-backdrop="false" id="add_vehicle_modal" role="dialog" aria-labelledby="label_vehicle"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <div class="modal-header">
                <h4 class="modal-title" id="label_vehicle">
                    Vehicle
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>

            <div class="modal-body">
                <form name="vehicle_group" action="/admin/vehicle/" method="POST">
                    @csrf
                    <input type="hidden" name="id_vehicle" id="id_vehicle">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Vehicle Group</label>
                                <select id="vehicle_group_id" name="vehicle_group_id" class="form-control">

                                </select>
                            </div>
                        </div>

                    </div>



                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Number Vehicle</label>
                                <input name="number" class="form-control @error('number') is-invalid @enderror"
                                    value="{{ old('number') }}" id="number" placeholder="Enter number name" type="text"
                                    id="number">
                                <span id="numberError" class="alert-message"></span>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">but</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="button" onclick="createvehicle('/admin/vehicle/')" class="btn btn-primary">
                    Save changes
                </button>
            </div>

        </div>
    </div>
</div>


{{-- modal add department --}}
<div class="modal fade" data-backdrop="false" id="add_department_modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Department
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>

            <div class="modal-body">
                <form name="userForm">

                    <div class="form-group">
                        {{-- hidden --}}
                        <input type="hidden" name="id" id="id">
                        <label id="label_department" for="department">Department name</label>
                        <input type="text" class="form-control" name="department" id="department"
                            aria-describedby="emailHelp" placeholder="Enter departmen name">
                        <span id="departmentError" class="alert-message"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="button" onclick="createPost('/admin/department/')" class="btn btn-primary">
                    Save changes
                </button>
            </div>

        </div>
    </div>
</div>



{{-- modal add unit --}}
<div class="modal fade" data-backdrop="false" id="add_unit_modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Unit
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>

            <div class="modal-body">
                <form name="userForm" action="/admin/unit/" method="POST">
                    @csrf
                    <div class="form-group">
                        {{-- hidden --}}
                        <input type="hidden" name="id_unit" id="id_unit">
                        <label id="label_unit" for="unit">unit name</label>
                        <input type="text" class="form-control" name="unit" id="unit" aria-describedby="emailHelp"
                            placeholder="Enter unit name">
                        <span id="unitError" class="alert-message"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="button" onclick="createUnit('/admin/unit/')" class="btn btn-primary">
                    Save changes
                </button>
            </div>

        </div>
    </div>
</div>




{{-- modal add group unit --}}
<div class="modal fade" data-backdrop="false" id="add_unit_group_modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Unit Group
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>

            <div class="modal-body">
                <form name="userForm" action="/admin/unit_group/" method="POST">
                    @csrf
                    <input type="hidden" name="id_unit_group" id="id_unit_group">


                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input name="unit_group" class="form-control @error('unit_group') is-invalid @enderror"
                                    value="{{ old('unit_group') }}" id="unit_group" placeholder="Enter unit_group name"
                                    type="text" id="unit_group">

                                <span id="unit_groupError" class="alert-message"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Unit</label>
                                <select id="unit_id" name="unit_id" class="custom-select form-control">

                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Capacity</label>
                                <input name="capacity" class="form-control @error('capacity') is-invalid @enderror"
                                    value="{{ old('capacity') }}" id="capacity" placeholder="Enter capacity name"
                                    type="text" id="capacity">
                                <span id="capacityError" class="alert-message"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="button" onclick="createUnit_group('/admin/unit_group/')" class="btn btn-primary">
                    Save changes
                </button>
            </div>

        </div>
    </div>
</div>


{{-- modal hapus department --}}
<div class="modal fade" data-backdrop="false" id="department_delete_modal" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">Are you sure you want to Delete this data?</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                            onclick="myClose()"><i class="fa fa-times"></i></button>
                        NO
                    </div>
                    <div class="col-6">
                        <form id="form_id" action="" method="post" class="d-inline">

                            <button type="button" id="delete_this_department"
                                class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-check"></i></button>
                            YES
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal hapus unit--}}
<div class="modal fade" data-backdrop="false" id="unit_delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">Are you sure you want to Delete this data?</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                            onclick="myClose()"><i class="fa fa-times"></i></button>
                        NO
                    </div>
                    <div class="col-6">
                        <form id="form_id" action="" method="post" class="d-inline">

                            <button type="button" id="delete_this_unit"
                                class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-check"></i></button>
                            YES
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- modal hapus position--}}
<div class="modal fade" data-backdrop="false" id="position_delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">Are you sure you want to Delete this data?</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                            onclick="myClose()"><i class="fa fa-times"></i></button>
                        NO
                    </div>
                    <div class="col-6">
                        <form id="form_id" action="" method="post" class="d-inline">

                            <button type="button" id="delete_this_position"
                                class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-check"></i></button>
                            YES
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- modal hapus unit group--}}
<div class="modal fade" data-backdrop="false" id="unit_group_delete_modal" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">Are you sure you want to Delete this data?</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                            onclick="myClose()"><i class="fa fa-times"></i></button>
                        NO
                    </div>
                    <div class="col-6">
                        <form id="form_unit_group" action="" method="post" class="d-inline">

                            <button type="button" id="delete_this_unit_group"
                                class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-check"></i></button>
                            YES
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal hapus vehicle group--}}
<div class="modal fade" data-backdrop="false" id="vehicle_group_delete_modal" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">Are you sure you want to Delete this data?</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                            onclick="myClose()"><i class="fa fa-times"></i></button>
                        NO
                    </div>
                    <div class="col-6">
                        <form id="form_vehicle_group" action="" method="post" class="d-inline">

                            <button type="button" id="delete_this_vehicle_group"
                                class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-check"></i></button>
                            YES
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- modal hapus vehicle --}}
<div class="modal fade" data-backdrop="false" id="vehicle_delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">Are you sure you want to Delete this data?</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                            onclick="myClose()"><i class="fa fa-times"></i></button>
                        NO
                    </div>
                    <div class="col-6">
                        <form id="form_vehicle" action="" method="post" class="d-inline">

                            <button type="button" id="delete_this_vehicle"
                                class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-check"></i></button>
                            YES
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
@include('admin.department.js')
{{-- modal position --}}
<script>
    function addPosition() {
        $('#label_position').text("Add position");
        $('#id_position').val('');
        $('#position').val('');
        $('#add_position_modal').modal('show');
    }
</script>

{{-- modal unit --}}
<script>
    function addUnit() {
        $('#label_unit').text("Add unit");
        $('#id_unit').val('');
        $('#unit').val('');
        $('#add_unit_modal').modal('show');

    }
</script>

{{-- modal vehicle group --}}
<script>
    function addvehicle_group() {
        $('#unit_group_id').empty();
            $.ajax({
                url: '/admin/unit_group-all',
                type: "GET",
                success: function(response) {
                    console.log(response)
                    if(response) {
                        $.each(response.unit_groups, function( index, value ) {
                            console.log(value)
                            $('#unit_group_id').append(`<option value="${value.id}">
                                       ${value.unit_group}
                                  </option>`);
                        });

                    }
                }
            }); 
        $('#label_vehicle_group').text("Add vehicle_group");
        $('#id_vehicle_group').val('');
        $('#vehicle_group').val('');
        $('#vehicle_code').val('');
        $('#add_vehicle_group_modal').modal('show');

    }
</script>

{{-- modal vehicle --}}
<script>
    function addvehicle() {
        $('#add_vehicle_modal .select2').each(function() {  
        var $p = $(this).parent(); 
        $(this).select2({  
            dropdownParent: $p  
        });  
        });
        $('#vehicle_group_id').empty();
            $.ajax({
                url: '/admin/vehicle_group-all',
                type: "GET",
                success: function(response) {
                    console.log(response)
                    if(response) {
                        console.log('response')
                        $.each(response.vehicle_groups, function( index, value ) {
                            console.log(value)
                            $('#vehicle_group_id').append(`<option value="${value.id}">
                                       ${value.vehicle_group}-${value.vehicle_code}
                                  </option>`);
                        });

                    }
                }
            }); 
        $('#label_vehicle').text("Add vehicle");
        $('#id_vehicle').val('');
        $('#number').val('');
        $('#add_vehicle_modal').modal('show');

    }
</script>

{{-- modal group unit --}}
<script>
    function addGroup_units() {
        $('#label_unit_group').text("Edit unit_group");
        $('#unit_id').empty();
            $.ajax({
                url: '/admin/unit-all',
                type: "GET",
                success: function(response) {
                    console.log(response)
                    if(response) {
                        $.each(response.units, function( index, value ) {
                            console.log("a")
                            $('#unit_id').append(`<option value="${value.id}">
                                       ${value.unit}
                                  </option>`);
                        });

                    }
                }
            }); 
        $('#label_unit_group').text("Add unit group");
        $('#id').val('');
        $('#unit_group').val('');
        $('#add_unit_group_modal').modal('show');

    }
</script>


{{-- modal group unit --}}
<script>
    function addGroup_unit() {
        $('#label_unit_group').text("Edit unit_group");
        $('#unit_id').empty();
            $.ajax({
                url: '/admin/unit-all',
                type: "GET",
                success: function(response) {
                    console.log(response)
                    if(response) {
                        $.each(response.units, function( index, value ) {
                            console.log("a")
                            $('#unit_id').append(`<option value="${value.id}">
                                       ${value.unit}
                                  </option>`);
                        });

                    }
                }
            }); 
        $('#label_unit_group').text("Add unit group");
        $('#id').val('');
        $('#unit_group').val('');
        $('#add_unit_group_modal').modal('show');

    }
</script>


{{-- create vehicle group --}}
<script>
    function createvehicle_group(url_create) {
        var vehicle_group = $('#vehicle_group').val();
        var vehicle_code = $('#vehicle_code').val();
        var unit_group_id = $('#unit_group_id').val();
        
        var id = $('#id_vehicle_group').val();
        let _url = url_create;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let url_edit = "'"+_url
        let end_url = "'"
        $.ajax({
              url: _url,
              type: "POST",
              data: {
                id: id,
                vehicle_group: vehicle_group,
                vehicle_code: vehicle_code,
                unit_group_id: unit_group_id,
                _token: _token
              },
              success: function(response) {
                console.log("response")
                console.log(response)
                var url_go = "'"+_url+"delete/"+"'"
                if(response.code == 200) {
                    if(id != ""){
                        
                        $("#vehicle_groupTable").find('input').each(function(){
                            if($(this).val() == response.data.id){
                                $(this).closest('tr').remove()
                                $('#vehicle_groupTable').prepend('<tr><td>'+response.data.vehicle_group+'</td><td>'+response.data.vehicle_code+'</td><td>'+response.data.unit_group+'</td><td><input type="hidden" value="'+response.data.id+'"> <button onclick="runEditVehicle_group('+response.data.id+','+url_edit+response.data.id+end_url+')" class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button><button onclick="isDeletevehicle_group('+response.data.id+','+url_go+')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button> </td></tr>');
                            }
                            
                        });
                    } else {
                        
                        console.log(url_go)
                        $('#vehicle_groupTable').prepend('<tr><td>'+response.data.vehicle_group+'</td><td>'+response.data.vehicle_code+'</td><td>'+response.data.unit_group+'</td><td><input type="hidden" value="'+response.data.id+'"> <button onclick="runEditVehicle_group('+response.data.id+','+url_edit+response.data.id+end_url+')" class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button><button onclick="isDeletevehicle_group('+response.data.id+','+url_go+')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button> </td></tr>');
                    }
                    $('#vehicle_group').val('');
      
                    $('#add_vehicle_group_modal').modal('hide');
                  }
              },
              error: function(response) {
                $('#vehicle_groupError').text(response.responseJSON.errors.vehicle_group);
                $('#vehicle_codeError').text(response.responseJSON.errors.vehicle_code);
              }
            });
    }
    
</script>

{{-- create vehicle --}}
<script>
    function createvehicle(url_create) {
        var number = $('#number').val();
        var vehicle_group_id = $('#vehicle_group_id').val();

        
        var id = $('#id_vehicle').val();
        let _url = url_create;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let url_edit = "'"+_url
        let end_url = "'"
        $.ajax({
              url: _url,
              type: "POST",
              data: {
                id: id,
                number: number,
                vehicle_group_id: vehicle_group_id,
                _token: _token
              },
              success: function(response) {
                console.log("response")
                console.log(response)
                var url_go = "'"+_url+"delete/"+"'"
                if(response.code == 200) {
                    if(id != ""){
                        $("#vehicleTable").find('input').each(function(){
                            if($(this).val() == response.data.id){
                                $(this).closest('tr').remove()
                                $('#vehicleTable').prepend('<tr><td>'+response.data.vehicle_code+'</td><td>'+response.data.number+'</td><td>'+response.data.unit_group+'</td><td><input type="hidden" value="'+response.data.id+'"> <button onclick="runEditVehicle_group('+response.data.id+','+url_edit+response.data.id+end_url+')" class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button><button onclick="isDeletevehicle('+response.data.id+','+url_go+')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button> </td></tr>');
                            }
                        });
                    } else {
                        $('#vehicleTable').prepend('<tr><td>'+response.data.vehicle_code+'</td><td>'+response.data.number+'</td><td>'+response.data.unit_group+'</td><td><input type="hidden" value="'+response.data.id+'"> <button onclick="runEditVehicle_group('+response.data.id+','+url_edit+response.data.id+end_url+')" class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button><button onclick="isDeletevehicle('+response.data.id+','+url_go+')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button> </td></tr>');
                       }
                    $('#vehicle_group').val('');
      
                    $('#add_vehicle_modal').modal('hide');
                  }
              },
              error: function(response) {
                $('#vehicle_groupError').text(response.responseJSON.errors.vehicle_group_id);
                $('#numberError').text(response.responseJSON.errors.number);
              }
            });
    }
    
</script>

{{-- create unit group --}}
<script>
    function createUnit_group(url_create) {
        var unit_group = $('#unit_group').val();
        var capacity = $('#capacity').val();
        var unit_id = $('#unit_id').val();
        var id = $('#id_unit_group').val();
        let _url = url_create;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let url_edit = "'"+_url
        let end_url = "'"
        $('#unit_id').empty();
        console.log(unit_id)
        $.ajax({
              url: _url,
              type: "POST",
              data: {
                id: id,
                unit_group: unit_group,
                capacity: capacity,
                unit_id: unit_id,
                _token: _token
              },
              success: function(response) {
                var url_go = "'"+_url+"delete/"+"'"
                  if(response.code == 200) {
                    if(id != ""){
                        $("#unit_groupTable").find('input').each(function(){
                            if($(this).val() == response.data.id){
                                $(this).closest('tr').remove()
                                $('#unit_groupTable').prepend('<tr><td>'+response.data.unit_group+'</td><td>'+response.data.capacity+'</td><td>'+response.data.unit+'</td><td><input type="hidden" value="'+response.data.id+'"> <button onclick="runEditUnit_group('+response.data.id+','+url_edit+response.data.id+end_url+')" class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button><button onclick="isDeletevehicle_group('+response.data.id+','+url_go+')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button> </td></tr>');
                            }
                        });
                    } else {
                        
                        console.log(url_go)
                        $('#unit_groupTable').prepend('<tr><td>'+response.data.unit_group+'</td><td>'+response.data.capacity+'</td><td>'+response.data.unit+'</td><td><input type="hidden" value="'+response.data.id+'"> <button onclick="runEditUnit_group('+response.data.id+','+url_edit+response.data.id+end_url+')" class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button><button onclick="isDeletevehicle_group('+response.data.id+','+url_go+')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button> </td></tr>');
                    }
                    $('#unit_group').val('');
      
                    $('#add_unit_group_modal').modal('hide');
                  }
              },
              error: function(response) {
                $('#unit_groupError').text(response.responseJSON.errors.unit_group);
                $('#capacityError').text(response.responseJSON.errors.capacity);
              }
            });
    }
    
</script>


{{-- create unit --}}
<script>
    function createUnit(url_create) {
        var unit = $('#unit').val();
        var id = $('#id_unit').val();
        let _url = url_create;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let url_edit = "'"+_url
        let end_url = "'"
        
        $.ajax({
              url: _url,
              type: "POST",
              data: {
                id: id,
                unit: unit,
                _token: _token
              },
              success: function(response) {
                var url_go = "'"+_url+"delete/"+"'"
                  if(response.code == 200) {
                    if(id != ""){
                        
                        $("#unitTable").find('input').each(function(){
                            if($(this).val() == response.data.id){
                                $(this).closest('tr').remove()
                                $('#unitTable').prepend('<tr><td>'+response.data.unit+'</td><td><input type="hidden" value="'+response.data.id+'"> <button onclick="runEditUnit('+response.data.id+','+url_edit+response.data.id+end_url+')" class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button><button onclick="isDeleteUnit('+response.data.id+','+url_go+')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button> </td></tr>');
                            }
                            
                        });
                    } else {
                        
                        console.log(url_go)
                        $('#unitTable').prepend('<tr><td>'+response.data.unit+'</td><td><input type="hidden" value="'+response.data.id+'"> <button onclick="runEditUnit('+response.data.id+','+url_edit+response.data.id+end_url+')" class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button><button onclick="isDeleteUnit('+response.data.id+','+url_go+')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button> </td></tr>');
                    }
                    $('#unit').val('');
      
                    $('#add_unit_modal').modal('hide');
                  }
              },
              error: function(response) {
                $('#unitError').text(response.responseJSON.errors.unit);
              }
            });
    }
    
</script>


{{-- create department --}}
<script>
    function createPost(url_create) {
        var department = $('#department').val();
        var id = $('#id').val();
        let _url = url_create;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let url_edit = "'"+_url
        let end_url = "'"
        
        $.ajax({
              url: _url,
              type: "POST",
              data: {
                id: id,
                department: department,
                _token: _token
              },
              success: function(response) {
                var url_go = "'"+_url+"delete/"+"'"
                  if(response.code == 200) {
                    if(id != ""){
                        
                        $("#departmentTable").find('input').each(function(){
                            if($(this).val() == response.data.id){
                                $(this).closest('tr').remove()
                                $('#departmentTable').prepend('<tr><td>'+response.data.department+'</td><td><input type="hidden" value="'+response.data.id+'"> <button onclick="runEdit('+response.data.id+','+url_edit+response.data.id+end_url+')" class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button><button onclick="isDelete('+response.data.id+','+url_go+')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button> </td></tr>');
                            }
                            
                        });
                    } else {
                        
                        console.log(url_go)
                        $('#departmentTable').prepend('<tr><td>'+response.data.department+'</td><td><input type="hidden" value="'+response.data.id+'"> <button onclick="runEdit('+response.data.id+','+url_edit+response.data.id+end_url+')" class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button><button onclick="isDelete('+response.data.id+','+url_go+')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button> </td></tr>');
                    }
                    $('#department').val('');
      
                    $('#add_department_modal').modal('hide');
                  }
              },
              error: function(response) {
                $('#departmentError').text(response.responseJSON.errors.description);
              }
            });
    }
    
</script>

{{-- create position --}}
<script>
    function createPosition(url_create) {
        
        var position = $('#position').val();
        var id = $('#id_position').val();
        let _url = url_create;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let url_edit = "'"+_url
        let end_url = "'"
        
        $.ajax({
              url: _url,
              type: "POST",
              data: {
                id: id,
                position: position,
                _token: _token
              },
              success: function(response) {
                var url_go = "'"+_url+"delete/"+"'"
                  if(response.code == 200) {
                    if(id != ""){
                        
                        $("#positionTable").find('input').each(function(){
                            if($(this).val() == response.data.id){
                                $(this).closest('tr').remove()
                                $('#positionTable').prepend('<tr><td>'+response.data.position+'</td><td><input type="hidden" value="'+response.data.id+'"> <button onclick="runEditPosition('+response.data.id+','+url_edit+response.data.id+end_url+')" class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button><button onclick="isDeletePosition('+response.data.id+','+url_go+')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button> </td></tr>');
                            }
                            
                        });
                    } else {
                        console.log(response.data.position)
                        $('#positionTable').prepend('<tr><td>'+response.data.position+'</td><td><input type="hidden" value="'+response.data.id+'"> <button onclick="runEditPosition('+response.data.id+','+url_edit+response.data.id+end_url+')" class="btn btn-warning py-1 px-2 mr-1"><i class="icon-copy dw dw-pencil"></i></button><button onclick="isDeletePosition('+response.data.id+','+url_go+')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button> </td></tr>');
                    }
                    $('#position').val('');
      
                    $('#add_position_modal').modal('hide');
                  }
              },
              error: function(response) {
                $('#positionError').text(response.responseJSON.errors.position);
              }
            });
    }
    
</script>


{{-- edit department --}}
<script>
    function runEdit(id,url_edit) {
            $('#label_department').text("Edit Department");
            console.log(url_edit)
            $('.modal-backdrop').remove();
            $('#departmentError').text('');
        
            $.ajax({
                url: url_edit,
                type: "GET",
                success: function(response) {
                    if(response) {
                        $("#id").val(response.id);
                        $("#department").val(response.department);
                        $("#post_id").val(response.id);
                        $('#add_department_modal').modal('show');
                        console.log(response.department)
                    }
                }
            });
          
        }
</script>

{{-- edit unit --}}
<script>
    function runEditUnit(id,url_edit) {
            $('#label_unit').text("Edit unit");
            console.log(url_edit)
            $('.modal-backdrop').remove();
            $('#unitError').text('');
        
            $.ajax({
                url: url_edit,
                type: "GET",
                success: function(response) {
                    if(response) {
                        $("#id_unit").val(response.id);
                        $("#unit").val(response.unit);
                        $("#post_id").val(response.id);
                        $('#add_unit_modal').modal('show');
                        console.log(response.unit)
                    }
                }
            });
          
        }
</script>

{{-- edit position --}}
<script>
    function runEditPosition(id,url_edit) {
            $('#label_position').text("Edit position");
            console.log(url_edit)
            $('.modal-backdrop').remove();
            $('#positionError').text('');
        
            $.ajax({
                url: url_edit,
                type: "GET",
                success: function(response) {
                    if(response) {
                        $("#id_position").val(response.id);
                        $("#position").val(response.position);
                        $('#add_position_modal').modal('show');
                        console.log(response.position)
                    }
                }
            });
          
        }
</script>


{{-- edit unit group--}}
<script>
    function runEditUnit_group(id,url_edit) {
            $('#label_unit_group').text("Edit unit_group");
            console.log(url_edit)
            $('.modal-backdrop').remove();
            $('#unit_groupError').text('');
        
            $.ajax({
                url: url_edit,
                type: "GET",
                success: function(response) {
                    if(response) {
                        console.log(response)
                        $("#id_unit_group").val(response.data.id);
                        $("#unit_group").val(response.data.unit_group);
                        $("#capacity").val(response.data.capacity);
                        $('#unit_id').empty();

                        $.each(response.units, function( index, value ) {
                            if(response.data.id == value.id){
                                $('#unit_id').append(`<option selected value="${value.id}">
                                       ${value.unit}
                                  </option>`);
                            }
                            $('#unit_id').append(`<option value="${value.id}">
                                       ${value.unit}
                                  </option>`);
                        });
                        $('#add_unit_group_modal').modal('show');
                        
                    }
                }
            }); 
        }
</script>

{{-- edit vehicle group--}}
<script>
    function runEditVehicle_group(id,url_edit) {
            $('#label_vehicle_group').text("Edit vehicle_group");
            console.log(url_edit)
            $('.modal-backdrop').remove();
            $('#vehicle_groupError').text('');
        
            $.ajax({
                url: url_edit,
                type: "GET",
                success: function(response) {
                    if(response) {
                        console.log(response)
                        $("#id_vehicle_group").val(response.data.id);
                        $("#vehicle_group").val(response.data.vehicle_group);
                        $("#vehicle_code").val(response.data.vehicle_code);
                        $('#unit_group_id').empty();

                        $.each(response.unit_groups, function( index, value ) {
                            if(response.data.unit_group_id == value.id){
                                $('#unit_group_id').append(`<option selected value="${value.id}">
                                       ${value.unit_group}
                                  </option>`);
                            }
                            $('#unit_group_id').append(`<option value="${value.id}">
                                       ${value.unit_group}
                                  </option>`);
                        });
                        $('#add_vehicle_group_modal').modal('show');
                        
                    }
                }
            }); 
        }
</script>

{{-- edit vehicle --}}
<script>
    function runEditVehicle(id,url_edit) {
            $('#label_vehicle').text("Edit vehicle");
            console.log("url_edit")
            console.log(url_edit)
            $('.modal-backdrop').remove();
            $('#vehicleError').text('');
        
            $.ajax({
                url: url_edit,
                type: "GET",
                success: function(response) {
                    if(response) {
                        console.log("response  : ")
                        console.log(response)
                        $("#id_vehicle").val(response.data.id);
                        $("#number").val(response.data.number);
                        $('#vehicle_group_id').empty();

                        $.each(response.vehicle_groups, function( index, value ) {
                            if(response.data.vehicle_group_id == value.id){
                                $('#vehicle_group_id').append(`<option selected value="${value.id}">
                                       ${value.vehicle_group}-${value.vehicle_code}
                                  </option>`);
                            }
                            $('#vehicle_group_id').append(`<option value="${value.id}">
                                       ${value.vehicle_code}
                                  </option>`);
                        });
                        $('#add_vehicle_modal').modal('show');
                        
                    }
                }
            }); 
        }
</script>


{{-- show all department --}}
<script>
    $(function() {
        $('#departmentTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('department-data') !!}',
            columns: [
                { data: 'department', name: 'department' },
                { data: 'action', name: 'action ' }
            ]
        });
    });
</script>

{{-- Show All position --}}
<script>
    $(function() {
        $('#positionTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('position-data') !!}',
            columns: [
                { data: 'position', name: 'position' },
                { data: 'action', name: 'action ' }
            ]
        });
    });
</script>


{{-- Show All religion --}}
<script>
    $(function() {
        $('#religionTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('religion-data') !!}',
            columns: [
                { data: 'religion', name: 'religion' },
                { data: 'action', name: 'action ' }
            ]
        });
    });
</script>
{{-- Show All vehicle --}}
<script>
    $(function() {
        $('#vehicleTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('vehicle-data') !!}',
            columns: [
                { data: 'vehicle_code', name: 'vehicle_code' },
                { data: 'number', name: 'number' },
                { data: 'unit_group', name: 'unit_group' },
                { data: 'action', name: 'action ' }
            ]
        });
    });
</script>

{{-- Show All unit --}}
<script>
    $(function() {
        $('#unitTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('unit-data') !!}',
            columns: [
                { data: 'unit', name: 'unit' },
                { data: 'action', name: 'action ' }
            ]
        });
    });
</script>

{{-- Show All unit_group --}}
<script>
    $(function() {
        $('#unit_groupTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('unit_group-data') !!}',
            columns: [
                { data: 'unit_group', name: 'unit_group' },
                { data: 'capacity', name: 'capacity' },
                { data: 'unit_group', name: 'unit_group' },
                { data: 'action', name: 'action ' }
            ]
        });
    });
</script>


{{-- Show All vehicle_group --}}
<script>
    $(function() {
        $('#vehicle_groupTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('vehicle_group-data') !!}',
            columns: [
                { data: 'vehicle_group', name: 'vehicle_group' },
                { data: 'vehicle_code', name: 'vehicle_code' },
                { data: 'unit_group', name: 'unit_group' },
                { data: 'action', name: 'action ' }
            ]
        });
    });
</script>

{{-- js delete department --}}
<script>
    function isDelete(id, url) {
        $('.modal-backdrop').remove();
        $("#department_delete_modal").modal('show');
        var action  = url;
        document.getElementById("form_id").action = action+id;
        var element = document.getElementById("delete_this_department");
        element.onclick = function(event) {
            console.log(url+id);
            let _url = url+id;
            let _token   = $('meta[name="csrf-token"]').attr('content');
        
                $.ajax({
                url: _url,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(response) {
                    console.log(response.data.department)
                    $("#departmentTable tr td:contains("+response.data.department+")").parent().remove();
                }
                });
        }
    }
    function myClose() {
        $("#department_delete_modal").modal('hide');
    }
</script>
{{-- js delete unit --}}
<script>
    function isDeleteUnit(id, url) {
        $('.modal-backdrop').remove();
        $("#unit_delete_modal").modal('show');
        var action  = url;
        document.getElementById("form_id").action = action+id;
        var element = document.getElementById("delete_this_unit");
        element.onclick = function(event) {
            console.log(url+id);
            let _url = url+id;
            let _token   = $('meta[name="csrf-token"]').attr('content');
        
                $.ajax({
                url: _url,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(response) {
                    console.log(response)
                    $("#unitTable tr td:contains("+response.data.unit+")").parent().remove();
                }
                });
        }
    }
    function myClose() {
        $("#unit_delete_modal").modal('hide');
    }
</script>

{{-- js delete position --}}
<script>
    function isDeletePosition(id, url) {
        $('.modal-backdrop').remove();
        $("#position_delete_modal").modal('show');
        var action  = url;
        document.getElementById("form_id").action = action+id;
        var element = document.getElementById("delete_this_position");
        element.onclick = function(event) {
            console.log(url+id);
            let _url = url+id;
            let _token   = $('meta[name="csrf-token"]').attr('content');
        
                $.ajax({
                url: _url,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(response) {
                    console.log(response)
                    $("#positionTable tr td:contains("+response.data.position+")").parent().remove();
                }
                });
        }
    }
    function myClose() {
        $("#position_delete_modal").modal('hide');
    }
</script>

{{-- js delete unit_group --}}
<script>
    function isDeleteUnit_group(id, url) {
        $('.modal-backdrop').remove();
        $("#unit_group_delete_modal").modal('show');
        var action  = url;
        document.getElementById("form_unit_group").action = action+id;
        var element = document.getElementById("delete_this_unit_group");
        element.onclick = function(event) {
            console.log(url+id);
            let _url = url+id;
            let _token   = $('meta[name="csrf-token"]').attr('content');
        
                $.ajax({
                url: _url,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(response) {
                    console.log(response)
                    $("#unit_groupTable tr td:contains("+response.data.unit_group+")").parent().remove();
                }
                });
        }
    }
    function myClose() {
        $("#unit_group_delete_modal").modal('hide');
    }
</script>

{{-- js delete vehicle_group --}}
<script>
    function isDeletevehicle_group(id, url) {
        $('.modal-backdrop').remove();
        $("#vehicle_group_delete_modal").modal('show');
        var action  = url;
        document.getElementById("form_vehicle_group").action = action+id;
        var element = document.getElementById("delete_this_vehicle_group");
        element.onclick = function(event) {
            console.log(url+id);
            let _url = url+id;
            let _token   = $('meta[name="csrf-token"]').attr('content');
        
                $.ajax({
                url: _url,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(response) {
                    console.log(response)
                    $("#vehicle_groupTable tr td:contains("+response.data.vehicle_group+")").parent().remove();
                }
                });
        }
    }
    function myClose() {
        $("#vehicle_group_delete_modal").modal('hide');
    }
</script>


{{-- js delete vehicle --}}
<script>
    function isDeletevehicle(id, url) {
        $('.modal-backdrop').remove();
        $("#vehicle_delete_modal").modal('show');
        var action  = url;
        document.getElementById("form_vehicle").action = action+id;
        var element = document.getElementById("delete_this_vehicle");
        element.onclick = function(event) {
            console.log(url+id);
            let _url = url+id;
            let _token   = $('meta[name="csrf-token"]').attr('content');
        
                $.ajax({
                url: _url,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(response) {
                    console.log(response)
                    $("#vehicleTable tr td:contains("+response.data.number+")").parent().remove();
                }
                });
        }
    }
    function myClose() {
        $("#vehicle_delete_modal").modal('hide');
    }
</script>


@endsection