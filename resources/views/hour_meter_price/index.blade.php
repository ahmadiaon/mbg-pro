@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 " >
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Harga HM </h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">  
                    <button onclick="showCreateModal()" class="btn btn-secondary">Tambah</button>              
                    
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false">
                            Menu <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="btn-export" href="/database/hour-meter-price/export">Export</a>
                            <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                href="">Import</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="pb-20" id="tablePrivilege">
            <table id="table-privilege" class="display nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Kode Excel</th>
                        <th>Value</th>
                        <th class="datatable-nosort">Action</th>
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
                <form action="/database/hour-meter-price/store" id="form-privilege" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="uuid" id="uuid">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Hour Meter Price
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="hour_meter_name" id="hour_meter_name" class="form-control">
                            <div class="invalid-feedback" id="req-hour_meter_name">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Excell</label>
                            <input type="text" name="key_excel" id="key_excel" class="form-control">
                            <div class="invalid-feedback" id="req-key_excel">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="text" name="hour_meter_value" id="hour_meter_value" class="form-control">
                            <div class="invalid-feedback" id="req-hour_meter_value">
                                Data tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <div class="row pd-10">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">tanggal mulai</label>
                                <input type="date" name="use_start" id="use_start" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">tanggal selesai</label>
                                <input type="date" class="form-control" name="use_end" id="use_end">
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



       <!-- Simple Datatable End -->
       <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
       aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <form id="form-import" action="/database/hour-meter-price/import" method="post" enctype="multipart/form-data">
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
        showDataTable('database/hour-meter-price/data', ['hour_meter_name','key_excel','hour_meter_value','action'], 'table-privilege')
        function showCreateModal(){
            $('#createModal').modal('show')
            $('#form-privilege')[0].reset();
        }
       function store(idForm){
            if(isRequired(['hour_meter_name','key_excel','hour_meter_value','use_start'])    > 0){ return false; }
            var isStored = globalStore(idForm)            
       }
       function deletePrivilege(uuid){
            let _url = '/database/hour-meter-price/delete'
            $('#confirm-modal').modal('show')
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#table_reload').val('privilege')
       }
       function editPrivilege(uuid){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/database/hour-meter-price/show";
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
                    $('#hour_meter_name').val(data.hour_meter_name)      
                    $('#key_excel').val(data.key_excel)   
                    $('#hour_meter_value').val(data.hour_meter_value)    
                    $('#use_start').val(data.use_start)    
                    $('#use_end').val(data.use_end)    
                    $('#createModal').modal('show')  
                },
                error: function(response) {
                    console.log(response)
                    alertModal()	
                }
            });
       }
       
    </script>
@endsection
