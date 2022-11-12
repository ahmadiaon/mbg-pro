@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Karyawan</h4>
            </div>
            <div class="col text-right">
                @if (!empty(session('dataUser')->create_employee))
                    <div class="btn-group dropdown">
                        <button onclick="create()" type="date" class="btn btn-secondary" data-toggle="dropdown"
                            aria-expanded="false">
                            Tambah Karyawan <span class="caret"></span>
                        </button>
                    </div>
                @endif
                <div class="btn-group dropdown">
                    <a href="/user/export">
                        <button  type="button" class="btn btn-primary">
                            Export <span class="caret"></span>
                        </button>
                    </a>
                </div>
            </div>

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

    <div class="modal fade bs-example-modal-lg" id="createModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Eksport Data Karyawan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                   <div class="form-group">
                    <select name="" id="">

                    </select>
                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function showModalExport() {
            $('#createModal').modal('show');
        }
        showDataTableUser('user-data', ['nik_employee', 'position', 'employee_status'], 'table-privilege')

        function create() {
            location.href = '/user/create';
        }

        function store(idForm) {
            if (isRequired(['uuid', 'privilege']) > 0) {
                return false;
            }
            var isStored = globalStore(idForm)
        }

        function deletePrivilege(uuid) {
            let _url = '/superadmin/database/delete'
            $('#confirm-modal').modal('show')
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#table_reload').val('privilege')
        }

        function editPrivilege(uuid) {
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

        function show(nik_employee) {
            location.href = '/user/profile/' + nik_employee;
        }
    </script>
@endsection
