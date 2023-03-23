@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-10 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Gudang Logistik </h4>
            </div>
            <div class="col text-right mb20">
                <div class="btn-group">  
                    <button onclick="createCoalFrom()" class="btn btn-secondary">Tambah Rak</button>              
                </div>
            </div>                     
        </div>
        <div class="row pd-20 mb-20">
            <div class="col-12">
                <div class="row justify-content-md-center" id="map-storage">
                    
                </div>    
            </div>  
        </div>
    </div>

  

    <!-- Simple Datatable End -->
    <div class="modal fade" id="createCoalFrom" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/logistic/storage/store" id="form-storage-logistic" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="uuid" id="uuid" class="form-control">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Rak
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Pilih Rak Induk</label>
                            <select name="parent_uuid" id="parent_uuid" style="width: 100%" class="custom-select2 form-control">

                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Jumlah Panjang Rak</label>
                                    <input type="text" name="p_storage" id="p_storage" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Jumlah Lebar Rak</label>
                                    <input type="text" name="l_storage" id="l_storage" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" onclick="store('storage-logistic')" class="btn btn-primary">
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
        function createCoalFrom() {
            $('#createCoalFrom').modal('show');
            $('#form-department')[0].reset();
        }

        function store(idForm) {
            if (isRequiredCreate(['storage_name', 'l_storage', 'p_storage']) > 0) {
                return false;
            }
            var isStored = globalStore(idForm)
        }

        function deleteData(uuid) {
            let _url = '/database/department/delete';
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('department')
        }

        function editData(uuid) {
            cg('udin', 'udin');
        }

        function firstCreateLogisticStorage() {
            let data_storage = @json($data);
            cg('data storage', data_storage);
            remainder = 12 / data_storage.p_storage;
            remainder = Math.floor(remainder);
            $('#uuid').val(data_storage.uuid);
            cg('udin', remainder);
            let num_rak = 1;
            for (let i = 0; i < data_storage.l_storage; i++) {
                cg('data storage', i);
                for (let j = 0; j < data_storage.p_storage; j++) {
                    $('#map-storage').append(`      
                        <div class="pb-20 col-${remainder} ">
                            <a href="/logistic/show/${data_storage.uuid}-${getLetter(num_rak)}">
                                <div class="pb-20 card-box bg-warning text-center">
                                    <h4 class="height-200-p widget-style1 blue-text">${data_storage.storage_name}-${getLetter(num_rak)}</h4>
                                </div>
                            </a>
                        </div>                    
                    `);
                    $(`#parent_uuid`).append(` <option value="${data_storage.storage_name}-${getLetter(num_rak)}">${data_storage.storage_name}-${getLetter(num_rak)}</option>`);
                    num_rak++;
                }
              
            }
        }

        firstCreateLogisticStorage();
    </script>
@endsection
