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
                            <a class="dropdown-item"  id="btn-create"  data-toggle="modal" data-target="#employee-production">Tambah</a>
                            <a class="dropdown-item" id="btn-export"disabled href="/user/absensi/export/">Export</a>
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
            <div class="pb-20" id="tablePrivilege">
                <table id="table-employee-production" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Premi</th>
                            <th>Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
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
            <form id="form-employee-production" action="/production/create" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content pd-20">
						<input type="text" name="uuid" id="uuid">
						<div class="form-group">
							<label for="">Premi</label>
							<select class="selectpicker form-control" name="premi_uuid" id="premi_uuid">
								@foreach ($premis as $premi )
								<option value="{{ $premi->uuid}}">{{ $premi->premi_name}}</option>
								@endforeach
							</select>
							<div class="invalid-feedback" id="req-premi_uuid">
								Data tidak boleh kosong
							</div>
						</div>

						<div class="form-group">
						<label for="">Tanggal</label>
						<input type="date" name="date_production"  id="date_production" class="form-control" value="{{$today}}">
						<div class="invalid-feedback" id="req-date_production">
							Data tidak boleh kosong
						</div
						</div>
					
						<div class="form-group">
						<label for="">Nilai</label>
						<input type="text" class="form-control" name="value_production" id="value_production" value="">
						<div class="invalid-feedback" id="req-value_production">
							Data tidak boleh kosong
						</div
						</div>
					
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" onclick="store('employee-production')" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

  
@endsection

@section('js')
    <script>
        let year_month = @json($year_month);
        let arr_year_month = year_month.split("-")
        $('#btn-year').html(arr_year_month[0]);
        $('#btn-month').html(months[arr_year_month[1]]);
        $('#btn-month').val(arr_year_month[1]);
        $('#btn-export').attr('href', '/production/export/' + year_month)
        reloadTable(year_month)

		function deleteData(uuid){
            let _url = '/production/delete'
            
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('employee-production')
       }

	   function store(idForm){
            if(isRequired(['premi_uuid','date_production', 'value_production'])    > 0){ return false; }
            var isStored = globalStore(idForm)            
       }


        function showDataTableUserPrivilege(url, dataTable, id) {
            let data = [];
            dataTable.forEach(element => {
                var dataElement = {
                    data: element,
                    name: element
                }
                data.push(dataElement)
            });


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
            data.push(elements)


            let urls = '{{ env('APP_URL') }}' + url
            console.log(urls)
            $('#' + id).DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: urls,
                columns: data
            });
        }

        function refreshTable(val_year = null, val_month = null) {
            console.log(val_year);
            let v_year = $('#btn-year').html();
            let v_month = $('#btn-month').val();
            console.log(v_month);
            if (val_year) {
                console.log(val_year);
                v_year = val_year;
                $('#btn-year').html(val_year);
            }
            if (val_month) {
                v_month = val_month;
                console.log(val_month);
                $('#btn-month').html(months[val_month]);
                $('#btn-month').val(val_month);
            }
            let year_month = v_year + '-' + v_month;
            reloadTable(year_month)
        }

        function reloadTable(year_month) {

            $('#tablePrivilege').remove();
            var table_element = ` 
            <div class="pb-20" id="tablePrivilege">
                <table id="table-employee-production" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Premi</th>
                            <th>Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>`;
            $('#the-table').append(table_element);
            $('#btn-export').attr('href', 'production/export/' + year_month)
            console.log('year:' + year_month)
            let _url = 'production/data/' + year_month;
            showDataTableUserPrivilege(_url, ['premi_uuid', 'value_production'],
                'table-employee-production')
        }

		function editData(uuid){
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

    </script>
@endsection
