@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 " >
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Group Pembayaran </h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">  
                    <button onclick="modalCreateGlobal('payment-group')" class="btn btn-secondary">Tambah</button>              
                    
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false">
                            Menu <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="btn-export" href="/database/payment-group/export">Export</a>
                            <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                href="">Import</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="pb-20" id="tablePrivilege">
            <table id="table-payment-group" class="display nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        <th>Payment Group</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Simple Datatable End -->

    <!-- Simple Datatable End -->
    <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-import" action="/database/payment-group/import" method="post" enctype="multipart/form-data">
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
        showDataTableAction('database/payment-group/data', ['payment_group'], 'payment-group')
        

       function deleteData(uuid){
            let _url = '/database/payment-group/delete'
            $('#confirm-modal').modal('show')
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#table_reload').val('payment-group')
       }
       function editData(uuid){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/database/payment-group/show";
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
                    $('#payment_group').val(data.payment_group)    
                    $('#modal-create-payment-group').modal('show')  
                    return true;
                },
                error: function(response) {
                    console.log(response)
                    alertModal()	
                    return false;
                }
            });
       }
       
    </script>
@endsection
