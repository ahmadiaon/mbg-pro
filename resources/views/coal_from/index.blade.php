@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 " >
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Asal Batu </h4>
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
                            <a class="dropdown-item" id="btn-export" href="/database/coal-from/export">Export</a>
                            <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                href="">Import</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="pb-20" id="tablePrivilege">
            <table id="table-coal-from" class="display nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        <th>Perusahaan</th>
                        <th>Asal Batu</th>
                        <th>Harga</th>
                        <th>Start Date</th>
                        <th>Kadaluarsa</th>
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
                <form action="/database/coal-from/store" id="form-coal-from" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="uuid" id="uuid" class="form-control">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Asal Batu
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Perusahaan</label>
                            <select class="selectpicker form-control " name="company_uuid" id="company_uuid">
                                @foreach ($companies as $company)
                                <option value="{{ $company->uuid}}">{{ $company->company}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Asal Batu</label>
                            <input type="text" name="coal_from" id="coal_from" class="form-control">
                            <div class="invalid-feedback" id="req-coal_from">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Harga Hauling</label>
                            <input type="text" name="hauling_price" id="hauling_price" class="form-control">
                            <div class="invalid-feedback" id="req-hauling_price">
                                Data tidak boleh kosong
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">tanggal mulai</label>
                             <input type="date" name="use_start" id="use_start" class="form-control">
                            <div class="invalid-feedback" id="req-use_start">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">tanggal selesai</label>
                            <input type="date" name="use_end" id="use_end" class="form-control">
                            <div class="invalid-feedback" id="req-use_end">
                                Data tidak boleh kosong
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" onclick="store('coal-from')" class="btn btn-primary">
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
            <form id="form-import" action="/database/coal-from/import" method="post" enctype="multipart/form-data">
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
        showDataTableAction('database/coal-from/data', ['company','coal_from','hauling_price','use_start','use_end'], 'coal-from')
        function createCoalFrom(){
            $('#createCoalFrom').modal('show')
            $('#form-coal-from')[0].reset();
        }
       function store(idForm){
            if(isRequired(['coal_from','company_uuid','hauling_price','use_start'])    > 0){ return false; }
            var isStored = globalStore(idForm)            
       }
       function deleteData(uuid){
            let _url = '/database/coal-from/delete'
            
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('coal-from')
       }
       function editData(uuid){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/database/coal-from/show";
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
                    $('#company_uuid').val(data.company_uuid).trigger('change')
                    $('#coal_from').val(data.coal_from)  
                    $('#hauling_price').val(data.hauling_price)  
                    $('#use_start').val(data.use_start)  
                    
                    $('#use_end').val(data.use_end)  
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
