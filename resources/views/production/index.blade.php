@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Laporan Produksi</h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false" id="btn-year">
                            <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="refreshTable(2021,null)" href="#">2021</a>
                            <a class="dropdown-item" onclick="refreshTable(2022,null)" href="#">2022</a>
                            <a class="dropdown-item" onclick="refreshTable(2023,null)" href="#">2023</a>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false" id="btn-month" value="">
                            <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="refreshTable(null, 1 )" href="#">Januari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 2 )" href="#">Februari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 3 )" href="#">Maret</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 4 )" href="#">April</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 5 )" href="#">Mei</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 6 )" href="#">Juni</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 7 )" href="#">Juli</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 8 )" href="#">Agustus</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 9 )" href="#">September</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 10 )" href="#">Oktober</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 11 )" href="#">November</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 12 )" href="#">Desember</a>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false">
                            Menu <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="btn-create" data-toggle="modal"
                                data-target="#employee-production">Tambah</a>
                            <a class="dropdown-item" id="btn-export"disabled href="/production/export/">Export</a>
                            <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                href="">Import</a>
                            {{-- <a class="dropdown-item" id="btn-import-mobilisasi" data-toggle="modal"
                                data-target="#import-modal-loading" href="">Import loading</a> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="the-table">
            <div class="pb-20" id="production">

            </div>
        </div>
    </div>
    <!-- Simple Datatable End -->

    <!-- Simple Datatable End -->
    <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-import" action="/production/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import Production</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih File Production</label>
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

    <!-- Simple ADD -->
    <div class="modal fade" id="employee-production" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-employee-production" action="/production/create" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-content pd-20">
                    <input type="text" name="uuid" id="uuid">
                    <div class="form-group">
                        <label for="">Premi</label>
                        <select class="selectpicker form-control" name="premi_uuid" id="premi_uuid">
                            @foreach ($premis as $premi)
                                <option value="{{ $premi->uuid }}">{{ $premi->premi_name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="req-premi_uuid">
                            Data tidak boleh kosong
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="date_production" id="date_production" class="form-control"
                            value="{{ $today }}">
                        <div class="invalid-feedback" id="req-date_production">
                            Data tidak boleh kosong
                        </div </div>

                        <div class="form-group">
                            <label for="">Nilai</label>
                            <input type="text" class="form-control" name="value_production" id="value_production"
                                value="">
                            <div class="invalid-feedback" id="req-value_production">
                                Data tidak boleh kosong
                            </div </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" onclick="store('employee-production')"
                                    class="btn btn-primary">Upload</button>
                            </div>
                        </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
        var end = new Date(arr_date_today.year, arr_date_today.month, 0);

        let filter = {
            'date_filter': {
                date_start_filter_range: formatDate(start),
                date_end_filter_range: formatDate(end),
            }
        };

        $('#btn-year').html(arr_date_today.year);
        $('#btn-month').html(months[parseInt(arr_date_today.month)]);
        $('#btn-month').val(arr_date_today.month);


        let year_month = @json($year_month);
        let arr_year_month = year_month.split("-");


        function deleteData(uuid) {
            let _url = '/production/delete'

            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('table-production')
        }

        function store(idForm) {
            if (isRequired(['premi_uuid', 'date_production', 'value_production']) > 0) {
                return false;
            }
            var isStored = globalStore(idForm)
            showDataTableProduction()
        }


        function showDataTableProduction() {
            $('#production').empty();
            var table_element = ` 
                <table id="table-production" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Premi</th>
                            <th>Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>`;
            $('#production').append(table_element);
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/production/data',
                type: "POST",
                data: {
                    _token: _token,
                    filter: filter
                },
                success: function(response) {
                    cg('response', response)
                    let data = [];
                    var el_value = {
                        mRender: function(data, type, row) {

                            return `${row.premi_name}
						MT
                        `
                        }
                    }

                    data.push(el_value)

                    var el_value = {
                        mRender: function(data, type, row) {

                            return `${row.value_production}
						MT
                        `
                        }
                    }

                    data.push(el_value)

                    var elements = {
                        mRender: function(data, type, row) {

                            return `
						<div class="form-inline"> 							
							<button onclick="editData('${row.uuid}')"  type="button" class="btn btn-primary mr-1  py-1 px-2">
								<small>edit</small>
							</button>							
							<button onclick="deleteData('${row.uuid}')"  type="button" class="btn btn-danger mr-1  py-1 px-2">
								<small>Hapus</small>
							</button>
						</div>`
                        }
                    };
                    data.push(elements);

                    let data_datatable = response.data.data_datatable;
                    $('#table-production').DataTable({
                        scrollX: true,
                        serverSide: false,
                        data: data_datatable,
                        columns: data
                    });
                },
                error: function(response) {
                    // alertModal()
                }
            });
            return false;
        }

        function refreshTable(val_year = null, val_month = null) {
            year = arr_date_today.year;
            month = arr_date_today.month;

            if (val_year) {
                arr_date_today.year = val_year
                $('#btn-year').html(arr_date_today.year);
            }

            if (val_month) {
                arr_date_today.month = val_month;
                $('#btn-month').html(monthName(arr_date_today.month));
                $('#btn-month').val(arr_date_today.month);
            }
            setDateSession(year, month);
        }


        function editData(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/production/show";
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
                        $('#premi_uuid').val(data.premi_uuid)
                    $('#date_production').val(data.date_production)
                    $('#value_production').val(data.value_production)



                    $('#employee-production').modal('show')
                },
                error: function(response) {
                    console.log(response)
                    alertModal()
                }
            });
        }
        showDataTableProduction()
    </script>
@endsection
