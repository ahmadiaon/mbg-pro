@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 " >
        <div class="row pd-20">
            <div class="col-3">
                <h4 class="text-blue h4">Formula Potongan</h4>
            </div>
            <div class="col-9 text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        {{-- <a href="/database/formula/create"> --}}
                            {{-- <button  class="btn btn-primary mr-10">Tambah</button> --}}
                        {{-- </a>                      --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-20" id="tablePrivilege">
            <table id="table-formula" class="display nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama Formula</th>
                        <th>Tanggal Awal</th>
                        <th>Kadaluarsa</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Simple Datatable End -->

@endsection

@section('js')
    <script>
        showDataTableAction('database/formula/data', ['formula_name','date_start','date_end'], 'formula')
        function createCoalFrom(){
            $('#createCoalFrom').modal('show');
            $('#form-formula')[0].reset();
        }
       function store(idForm){
            if(isRequired(['formula_name','date_start'])    > 0){ return false; }
            var isStored = globalStore(idForm)            
       }
       function deleteData(uuid){
            let _url = '/database/formula/delete'
            
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('formula')
       }
       function editData(uuid){
            window.location.href = `/database/formula/show/`+uuid;
       }
    </script>
@endsection
