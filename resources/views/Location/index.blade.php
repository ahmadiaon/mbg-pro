@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 " >
        <div class="row pd-20">
            <div class="col-3">
                <h4 class="text-blue h4">Database Lokasi</h4>
            </div>
            <div class="col-9 text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        {{-- <a href="/purchase-order/create"> --}}
                        <button onclick="createCoalFrom()" class="btn btn-primary mr-10">Tambah</button>
                        {{-- </a>                      --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-20" id="tablePrivilege">
            <table id="table-location" class="display nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama Lokasi</th>
                        <th>Tanggal Awal</th>
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
                <form action="/database/location/store" id="form-location" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="uuid" id="uuid" class="form-control">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Lokasi
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Lokasi</label>
                            <input type="text" name="location" id="location" class="form-control">
                            <div class="invalid-feedback" id="req-location">
                                Data tidak boleh kosong
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="">tanggal mulai</label>
                                    <input type="date" name="date_start" id="date_start" class="form-control">
                                    <div class="invalid-feedback" id="req-date_start">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">tanggal selesai</label>
                                    <input type="date" name="date_end" id="date_end" class="form-control">
                                    <div class="invalid-feedback" id="req-date_end">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" onclick="store('location')" class="btn btn-primary">
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
        showDataTableAction('database/location/data', ['location','date_start','date_end'], 'location')
        function createCoalFrom(){
            $('#createCoalFrom').modal('show');
            $('#form-location')[0].reset();
        }
       function store(idForm){
            if(isRequired(['location','date_start'])    > 0){ return false; }
            var isStored = globalStore(idForm)            
       }
       function deleteData(uuid){
            let _url = '/database/location/delete'
            
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('location')
       }
       function editData(uuid){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/database/location/show";
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
                    $('#location').val(data.location)  
                    $('#date_start').val(data.date_start)  
                    $('#date_end').val(data.date_end)  
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
