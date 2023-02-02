@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Departement </h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">  
                    <button onclick="createCoalFrom()" class="btn btn-secondary">Tambah</button>              
                    
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false">
                            Menu <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="btn-export" href="/database/atribut-size/export">Export</a>
                            <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                href="">Import</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="pb-20" id="tablePrivilege">
            <table id="table-atribut-size" class="display nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        <th>Satuan</th>
                        <th>Group</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Simple Datatable End -->
    {{-- modal add user privilege --}}
    <div class="modal fade" id="createCoalFrom" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/database/atribut-size/store" id="form-atribut-size" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Satuan
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Satuan</label>
                            <input type="text" name="uuid" id="uuid" class="form-control">
                            <div class="invalid-feedback" id="req-uuid">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Group Satuan</label>
                            <select name="size" id="size" class="form-control">
                                <option value="huruf">Huruf</option>
                                <option value="angka">Angka</option>
                                <option value="unit">Unit</option>
                            </select>
                            <div class="invalid-feedback" id="req-size">
                                Data tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" onclick="store('atribut-size')" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <!-- Simple Datatable End -->
     <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <form id="form-import" action="/database/atribut-size/import" method="post" enctype="multipart/form-data">
             @csrf
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Import Data</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="form-group">
                         <label>Pilih File</label>
                         <input name="uploaded_file" type="file"
                             class="form-control-file form-control height-auto" />
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                     <button type="submit" onclick="startLoading()" class="btn btn-primary">Upload</button>
                 </div>
             </div>
         </form>
     </div>
 </div>
@endsection

@section('js')
    <script>
        showDataTableAction('database/atribut-size/data', ['uuid', 'size'], 'atribut-size')

        function createCoalFrom() {
            $('#createCoalFrom').modal('show');
            $('#form-atribut-size')[0].reset();
        }

        function store(idForm) {
            if (isRequired(['size', 'uuid']) > 0) {
                return false;
            }
            var isStored = globalStore(idForm)
        }

        function deleteData(uuid) {
            let _url = '/database/atribut-size/delete'

            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('atribut-size')
        }

        function editData(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/database/atribut-size/show";
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
                    $('#uuid').val(data.uuid)
                    $('#size').val(data.size)
                    $('#createCoalFrom').modal('show')
                },
                error: function(response) {
                    console.log(response)
                    alertModal()
                }
            });
        }
    </script>
@endsection
