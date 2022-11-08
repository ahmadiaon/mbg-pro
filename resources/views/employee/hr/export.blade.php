@extends('template.admin.main_privilege')
@section('content')
    <div class="card-box mb-30">
        <form action="/user/export" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row pd-20" id="table-list">

            </div>
            <div class="row justify-content-md-center pd-20">
                <div class="col-auto">
                    {{-- <a href="/user/export-action"> --}}
                        <button type="submit" class="btn btn-primary">export</button>
                    {{-- </a> --}}
                </div>
            </div>
        </form>
    </div>
@endsection




@section('js')
<script>
    let data = @json($data);
    let column = data.column_tables.employees;
    let tables = data.tables;
    let user_detail_delete_column = ['user_detail_uuid','is_last','id','uuid','created_at', 'updated_at'];
    $('#table-list').empty();
    tables.forEach(element => {
        let element_table = `<div class="col-md-12">
                <div class="form-group text-center" id="${element}">
                    <label class="weight-600">${element}</label>

                </div>
            </div>`;
        $('#table-list').append(element_table);
        let column_tables = data.column_tables[element];
        column_tables = deleteColumn(column_tables,user_detail_delete_column);
        column_tables.forEach(column_name => {
            let element_column_name = `
                    <div class="row" id="column-${element}">
                        <div class="col-md-3 text-right">
                            <label class="weight-800 mt-2" >${column_name}</label>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="only-null-${element}-${column_name}" name="${element}-${column_name}" value="only-null" class="custom-control-input" />
                                <label class="custom-control-label" for="only-null-${element}-${column_name}">Hanya Kosong</label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="only-be-${element}-${column_name}" value="only-be" name="${element}-${column_name}" class="custom-control-input" />
                                <label class="custom-control-label" for="only-be-${element}-${column_name}">Hanya ada</label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-radio mb-5">
                                <input checked type="radio" id="all-${element}-${column_name}" value="all" name="${element}-${column_name}" class="custom-control-input" />
                                <label class="custom-control-label" for="all-${element}-${column_name}">Semua</label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-radio mb-5">
                                <input  type="radio" value="off" id="off-${element}-${column_name}" name="${element}-${column_name}" class="custom-control-input" />
                                <label class="custom-control-label" for="off-${element}-${column_name}">Dimatikan</label>
                            </div>
                        </div>
                    </div>`;
            $('#'+element).append(element_column_name);
            
        });
    });
    // deleteColumn(user_detail_delete_column);


    function deleteColumn(the_column, arr_column_delete) {
        arr_column_delete.forEach(element => {
            the_column.splice(the_column.indexOf(element), 1);
        });
        return the_column;
    }
</script>
@endsection
