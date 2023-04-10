@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 " >
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Bonus HM </h4>
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
                            <a class="dropdown-item" id="btn-export" href="/database/hm-bonus/export">Export</a>
                            <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                href="">Import</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="pb-20" id="tablePrivilege">
            <table id="table-hm-bonus" class="display nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        <th>min hm</th>
                        <th>persen bonus</th>
                        <th>Tanggal Awal</th>
                        <th>Tanggal Kadaluarsa</th>
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
                <form action="/database/hm-bonus/store" id="form-hm-bonus" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="uuid" id="uuid" class="form-control">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Bonus HM
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">min hm atau =</label>
                            <input type="text" name="min_hm" id="min_hm" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">persen hm %</label>
                            <input type="text" name="percent_hm" id="percent_hm" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="">tanggal mulai</label>
                                    <input type="date" name="date_start" id="date_start" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">tanggal selesai</label>
                                    <input type="date" name="date_end" id="date_end" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" onclick="store('hm-bonus')" class="btn btn-primary">
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
            <form id="form-import" action="/database/hm-bonus/import" method="post" enctype="multipart/form-data">
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
        showDataTableAction('database/hm-bonus/data', ['min_hm', 'percent_hm', 'date_start', 'date_end'], 'hm-bonus')
        function createCoalFrom(){
            $('#createCoalFrom').modal('show');
            $('#form-hm-bonus')[0].reset();
        }
       function store(idForm){
            if(isRequiredCreate(['min_hm','percent_hm'])    > 0){ return false; }
            var isStored = globalStore(idForm)            
       }
       function deleteData(uuid){
            let _url = '/database/hm-bonus/delete'
            
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('hm-bonus')
       }
       function editData(uuid){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/database/hm-bonus/show";
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
                    $('#min_hm').val(data.min_hm)  
                    $('#percent_hm').val(data.percent_hm)  
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
