@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 " >
        <div class="row pd-20">
            <div class="col-3">
                <h4 class="text-blue h4">Karyawan</h4>
            </div>
            @if(!empty(session('dataUser')->create_employee))
                <div class="col-9 text-right">
                    <div class="btn-group">
                        <div class="btn-group dropdown">
                            {{-- <a href="/purchase-order/create"> --}}
                            <button onclick="create()" class="btn btn-primary mr-10">Tambah</button>
                            {{-- </a>                      --}}
                        </div>
                    </div>
                </div>
            @endif
            
        </div>
        <div class="pb-20" id="tablePrivilege">
            <table id="table-privilege" class="display nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Jabatan</th>
                        <th>Status Karyawan</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Simple Datatable End -->
    {{-- modal add user privilege --}}
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/superadmin/database/store" id="form-privilege" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Add Privilege
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Privilege</label>
                            <input type="text" name="uuid" id="uuid" class="form-control">
                            <div class="invalid-feedback" id="req-uuid">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Privilege</label>
                            <input type="text" name="privilege" id="privilege" class="form-control">
                            <div class="invalid-feedback" id="req-privilege">
                                Data tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" onclick="store('privilege')" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        showDataTableUser('user-data', ['nik_employee', 'position','employee_status'], 'table-privilege')
        function create(){
            location.href = '/user/create';
        }
       function store(idForm){
            if(isRequired(['uuid','privilege'])    > 0){ return false; }
            var isStored = globalStore(idForm)            
       }
       function deletePrivilege(uuid){
            let _url = '/superadmin/database/delete'
            $('#confirm-modal').modal('show')
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#table_reload').val('privilege')
       }
       function editPrivilege(uuid){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/superadmin/database/show";
            // startLoading();
            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    uuid: uuid,
                    _token: _token
                },
                success: function(response) {
                    stopLoading()
                    data = response.data
                    console.log(data)
                    $('#uuid').val(data.uuid),
                    $('#privilege').val(data.privilege)      
                    $('#createModal').modal('show')  
                },
                error: function(response) {
                    console.log(response)
                    alertModal()	
                }
            });
       }
       function show(nik_employee){
            location.href = '/user/profile/'+nik_employee;
       }
    </script>
@endsection
