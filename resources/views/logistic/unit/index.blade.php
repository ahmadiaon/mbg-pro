@extends('template.admin.main_privilege')
@section('content')
<div class="card-box mb-30 " >
    <div class="row pd-20">
        <div class="col-3">
            <h4 class="text-blue h4">Daftar Unit</h4>
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
        <table id="table-vehicle" class="display nowrap stripe hover table" style="width:100%">
            <thead>
                <tr>
                    
                    <th>Kode</th>
                    <th>Nomor</th>
                    <th>Group</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Brand</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>




    <div class="modal fade customscroll" id="createCoalFrom" tabindex="" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="form-vehicle" action="/logistic/unit" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Unit
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                            data-placement="bottom" title="" data-original-title="Close Modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pd-0">
                        <div class="task-list-form">
                            <ul>
                                <li>
                                    <div class="form-group row">
                                        <label class="col-md-4">Vehicle Type</label>
                                        <div class="col-md-8">
                                            <select onchange="selectBrandType()" class="custom-select2 form-control" name="brand_type_uuid"
                                                id="brand_type_uuid" style="width: 100%; height: 38px">
                                                @if (!empty($brand_types))
                                                    @foreach ($brand_types as $brand_type)
                                                        <option value="{{ $brand_type->uuid }}">
                                                            {{ $brand_type->brand }} - {{ $brand_type->type }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Location</label>
                                        <div class="col-md-8">
                                            <select class="custom-select2 form-control" name="location_uuid"
                                                id="location_uuid" style="width: 100%;">
                                                @if (!empty($locations))
                                                    @foreach ($locations as $location)
                                                        <option value="{{ $location->uuid }}">{{ $location->location }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4">Number</label>
                                        <div class="col-md-8">
                                            <input required type="text" name="number" id="number" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Status</label>
                                        <div class="col-md-8">
                                            <select class="custom-select2 form-control" name="status_uuid" id="status_uuida"
                                                style="width: 100%;">
                                                @if (!empty($statuses))
                                                    @foreach ($statuses as $status)
                                                        <option value="{{ $status->uuid }}">{{ $status->status }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">HM/KM</label>
                                        <div class="col-md-5">
                                            <input required type="text" name="vehicle_track_value" id="vehicle_track_value" class="form-control" value="0" />
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" name="vehicle_hm_uuid" id="vehicle_hm_uuid"
                                                style="width: 100%;">
                                                <option value="hm">HM</option>
                                                <option value="km">KM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Kapasitas</label>
                                        <div class="col-md-4">
                                            <input required type="text" name="capacity" id="capacity" class="form-control" />
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control" name="atribut_size_uuid" id="atribut_size_uuid"
                                                style="width: 100%;">
                                                @if (!empty($atribut_sizes))
                                                @foreach ($atribut_sizes as $atr)
                                                    <option value="{{ $atr->uuid }}">{{ $atr->uuid }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date Start</label>
                                                <input required type="date" name="date_start" id="date_start" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label >Kadaluarsa</label>
                                                <input type="date" name="date_end" id="date_end"  class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button onclick="store('vehicle')" type="button" class="btn btn-primary">
                            Add
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- add task popup End -->
@endsection

@section('js')
    <script>
        let brand_types = @json($brand_types);
        
        function selectBrandType(){
            let brand_type_uuid = $('#brand_type_uuid').val();
            let brand_type = brand_types[brand_type_uuid]
            console.log(brand_type);
            $('#vehicle_hm_uuid').val(brand_type.vehicle_hm_uuid).trigger('changge')
            $('#capacity').val(brand_type.capacity).trigger('changge')
            $('#atribut_size_uuid').val(brand_type.atribut_size_uuid).trigger('changge')
        }

        selectBrandType();
         showDataTableAction('logistic/unit/data', ['group_code','number','group_name','location','status','brand'], 'vehicle')
        function createCoalFrom(){
            $('#createCoalFrom').modal('show');
            $('#form-vehicle')[0].reset();
        }
       function store(idForm){
            if(isRequired(['vehicle','date_start'])    > 0){ return false; }
            var isStored = globalStore(idForm)            
       }
       function deleteData(uuid){
            let _url = '/logistic/unit/delete'
            
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('vehicle')
       }
       function editData(uuid){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/logistic/unit/show";
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
                    let long = (data.vehicle_hm_uuid == 'km')?data.km:data.hm;
                    $('#uuid').val(data.uuid)    
                    $('#brand_type_uuid').val(data.brand_type_uuid).trigger('change.select2')
                    $('#location_uuid').val(data.location_uuid).trigger('change.select2')
                    $('#vehicle_hm_uuid').val(data.vehicle_hm_uuid).trigger('change.select2')
                    $('#vehicle_track_value').val(long)  
                    $('#capacity').val(data.capacity)  
                    $('#number').val(data.number)  
                    $('#date_start').val(data.date_start)  
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
