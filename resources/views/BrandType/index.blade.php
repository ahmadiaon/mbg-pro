@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-3">
                <h4 class="text-blue h4">Daftar Type Brand</h4>
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
            <table id="table-brand-type" class="display nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama Brand</th>
                        <th>Type Brand</th>
                        <th>Group Unit</th>
                        <th>Kapasitas</th>
                        <th>Satuan</th>
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
                <form action="/logistic/brand-type/store" id="form-brand-type" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="uuid" id="uuid" class="form-control">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Brand
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Brand</label>
                            <select class=" form-control " name="brand_uuid" id="brand_uuid">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->uuid }}">{{ $brand->brand }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="req-brand_uuid">
                                Data tidak boleh kosong
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Type Brand</label>
                            <input type="text" name="type" id="type" class="form-control">
                            <div class="invalid-feedback" id="req-type">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Group Unit</label>
                                    <select class=" form-control " name="group_vehicle_uuid"
                                        id="group_vehicle_uuid">
                                        @foreach ($group_vehicles as $gu)
                                            <option value="{{ $gu->uuid }}">{{ $gu->group_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="req-group_vehicle_uuid">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Ukuran</label>
                                    <select class=" form-control " name="vehicle_hm_uuid"
                                        id="vehicle_hm_uuid">
                                        <option value="hm">HM</option>
                                        <option value="km">KM</option>
                                    </select>
                                    <div class="invalid-feedback" id="req-vehicle_hm_uuid">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kapasitas</label>
                                    <input type="text" name="capacity" id="capacity" class="form-control">
                                    <div class="invalid-feedback" id="req-capacity">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Satuan</label>
                                    <select class=" form-control " name="atribut_size_uuid"
                                        id="atribut_size_uuid">
                                        @foreach ($atribut_sizes as $as)
                                            <option value="{{ $as->uuid }}">{{ $as->uuid }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="req-atribut_size_uuid">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                        </div>






                        {{-- <div class="row">
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
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" onclick="store('brand-type')" class="btn btn-primary">
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
        showDataTableAction('logistic/brand-type/data', ['brand', 'type', 'group_name', 'capacity', 'atribut_size_uuid'],
            'brand-type')

        function createCoalFrom() {
            $('#createCoalFrom').modal('show');
            $('#form-brand-type')[0].reset();
        }

        function store(idForm) {
            if (isRequired(['atribut_size_uuid', 'group_vehicle_uuid','vehicle_hm_uuid', 'capacity', 'type', 'brand_uuid', 'date_start']) >
                0) {
                return false;
            }
            var isStored = globalStore(idForm)
        }

        function deleteData(uuid) {
            let _url = '/logistic/brand-type/delete'

            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('brand-type')
        }

        function editData(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/logistic/brand-type/show";
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
                    $('#type').val(data.type)
                    $('#brand_uuid').val(data.brand_uuid).trigger('changge')
                    $('#capacity').val(data.capacity)
                    $('#group_vehicle_uuid').val(data.group_vehicle_uuid).trigger('changge')
                    $('#vehicle_hm_uuid').val(data.vehicle_hm_uuid).trigger('changge')
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
