@extends('template.admin.main_privilege')
createCompany
@section('content')
    <div class="card-box mb-30 " >
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">PERUSAHAAN </h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">  
                    <button onclick="createCompany()" class="btn btn-secondary">Tambah</button>              
                    
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false">
                            Menu <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="btn-export" href="/database/company/export">Export</a>
                            <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                href="">Import</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="pb-20" id="tablePrivilege">
            <table id="table-company" class="display nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Perusahaan</th>
                        <th>Kalorie Batu</th>
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
    <div class="modal fade" id="createCompany" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/database/company/store" id="form-company" method="POST" enctype="multipart/form-data">
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
                            <label for="">Nama Pendek</label>
                            <input type="text" name="company" id="company" class="form-control">
                            <div class="invalid-feedback" id="req-company">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Jenis Batu</label>
                                    <select class="selectpicker form-control " name="coal_type_uuid" id="coal_type_uuid">
                                        @foreach ($coal_types as $item)
                                        <option value="{{ $item->uuid}}">{{ $item->type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 hauling_price">
                                <div class="form-group">
                                    <label for="">Harga Hauling</label>
                                    <input type="text" name="default_price" id="default_price" class="form-control">
                                    <div class="invalid-feedback" id="req-default_price">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Nama Perusahaan</label>
                            <input type="text" name="long_company" id="long_company" class="form-control">
                            <div class="invalid-feedback" id="req-long_company">
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
                        <button type="button" onclick="store('company')" class="btn btn-primary">
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
            <form id="form-import" action="/database/company/import" method="post" enctype="multipart/form-data">
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
        showDataTableAction('database/company/data', ['company','long_company','calorie','use_start','use_end'], 'company')
        function createCompany(){
            $('#createCompany').modal('show')
            $('.hauling_price').show()
            $('#form-company')[0].reset();
        }
       function store(idForm){
            if(isRequired(['company','long_company','coal_type_uuid','use_start'])    > 0){ return false; }
            var isStored = globalStore(idForm)            
       }
       function deleteData(uuid){
            let _url = '/database/company/delete'
            
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('company')
       }
       function editData(uuid){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/database/company/show";
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
                    $('#coal_type_uuid').val(data.coal_type_uuid)      
                    $('#company').val(data.company)    
                    $('#long_company').val(data.long_company)  
                    $('.hauling_price').hide()
                    $('#use_start').val(data.use_start)  
                    
                    $('#use_end').val(data.use_end)  
                    $('#createCompany').modal('show')  
                },
                error: function(response) {
                    console.log(response)
                    alertModal()	
                }
            });
       }
       
    </script>
@endsection
