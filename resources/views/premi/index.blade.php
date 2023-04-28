@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 " >
        <div class="row pd-20">
            <div class="col-3">
                <h4 class="text-blue h4">Premi</h4>
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
            <table id="table-premi" class="display nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
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
                <form action="/database/premi/store" id="form-premi" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="uuid" id="uuid" class="form-control">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Premi
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Premi</label>
                            <input type="text" name="premi_name" id="premi_name" class="form-control">
                            <div class="invalid-feedback" id="req-premi_name">
                                Data tidak boleh kosong
                            </div>
                        </div>

                        <div class="form-group">
                            <label for=""> Kalkulasi Batu </label>
                            <div class="row" id="coal-from-company">
                            
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
                        <button type="button" onclick="store('premi')" class="btn btn-primary">
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
        
        Object.values(data_database.data_companies).forEach(company_element => {
                $('#coal-from-company').append(` <div class="col-md-4 col-sm-12">
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input value="${company_element.uuid}" type="checkbox" name="${company_element.uuid}" class="custom-control-input companies" id="${company_element.uuid}">
                                        <label class="custom-control-label" for="${company_element.uuid}">${company_element.company}</label>
                                    </div>                                
                                </div>`);
            });



        showDataTableAction('database/premi/data', ['uuid','premi_name','date_start','date_end'], 'premi')
        function createCoalFrom(){
            $('.companies').prop('checked', '');
            $('#createCoalFrom').modal('show')
            
            $('#form-premi')[0].reset();
        }
       function store(idForm){
            if(isRequired(['premi_name','date_start'])    > 0){ return false; }
            var isStored = globalStore(idForm)            
       }
       function deleteData(uuid){
            let _url = '/database/premi/delete'
            
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('premi')
       }
       function editData(uuid){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/database/premi/show";
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
                    $('#company_uuid').val(data.company_uuid)      
                    $('#premi_name').val(data.premi_name)  
                    $('#hauling_price').val(data.hauling_price)  
                    $('#date_start').val(data.date_start)  
                    $('.companies').prop('checked', false);
                    data.production_premis.forEach(element => {
                        $('#'+element.company_uuid).prop( 'checked', true )
                    });
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
