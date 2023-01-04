@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 " >
        <div class="row pd-20">
            <div class="col-3">
                <h4 class="text-blue h4">Database</h4>
            </div>
            <div class="col-9 text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        {{-- <a href="/purchase-order/create"> --}}
                        <button onclick="modalCreateGlobal('payment-group')" class="btn btn-primary mr-10">Tambah</button>
                        {{-- </a>                      --}}
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
