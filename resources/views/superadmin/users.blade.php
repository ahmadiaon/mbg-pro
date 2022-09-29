@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="row">
        <div class="col-sm-8 card-box pb-10">
            <div class="h5 pd-20 mb-0">List Users</div>
            @if(session()->has('success'))
            <div class="alert alert-primary" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12 col-md-6"></div>
                    <div class="col-sm-12 col-md-6"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-strippeddata-table table nowrap dataTable no-footer dtr-inline"
                            id="usersTable" role="grid">
                            <thead>
                                <tr role="row">
                                    <th class="table-plus sorting_asc" tabindex="0" aria-controls="DataTables_Table_0"
                                        rowspan="1" colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending">Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Gender: activate to sort column ascending">NIK RI
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Gender: activate to sort column ascending">NIK Employee
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Weight: activate to sort column ascending">Level</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Assigned Doctor: activate to sort column ascending">
                                        Status Pass</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Assigned Doctor: activate to sort column ascending">
                                        Action</th>

                                </tr>
                            </thead>


                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-5"></div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function() {
        $('#usersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('users-data') !!}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'nik_number', name: 'nik_number' },
                { data: 'nik_employee', name: 'nik_employee' },
                { data: 'group', name: 'group' },
                { data: 'statusPass', name: 'statusPass' },
                { data: 'action', name: 'action' },
               
            ]
        });
    });
    function changeLevelEmployee(id){
        console.log(id);
    }
</script>
@endsection