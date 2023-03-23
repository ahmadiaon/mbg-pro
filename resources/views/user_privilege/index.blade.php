@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-3">
                <h4 class="text-blue h4">User Privilege</h4>
            </div>
        </div>
        <div class="pb-20" id="tablePrivilege">
            <table id="table-user-privilege" class="display nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Jabatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Simple Datatable End -->
    {{-- modal add user privilege --}}
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/superadmin/database/store" id="form-privilege" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Add Privilege
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Privilege</label>
                            <input type="text" name="uuid" id="uuid" class="form-control">
                            <div class="invalid-feedback" id="req-uuid">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Privilege</label>
                            <input type="text" name="privilege" id="privilege" class="form-control">
                            <div class="invalid-feedback" id="req-privilege">
                                Data tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" onclick="store('privilege')" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="user-privilege-modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form action="/user-privilege/store" id="form-user-privilege" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-header">
                            Privilege
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="nik_employee" id="nik_employee">
                        <label for="" id="user-privilege-name"></label>
                        <div class="form-group">
                            <div class="row" id="provoleges">
                            @foreach ($privileges as $item)
                                <div class="col-md-4 col-sm-12">
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input value="{{$item->uuid}}" type="checkbox" name="{{$item->uuid}}" class="custom-control-input" id="{{$item->uuid}}">
                                        <label class="custom-control-label" for="{{$item->uuid}}">{{$item->privilege}}</label>
                                    </div>                                
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button onclick="store('user-privilege')" type="button" class="btn btn-primary">
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
        function showDataTableUserPrivilege(url,dataTable,id){	
			let data	=[];
			var elements = {
					mRender: function (data, type, row) {
						if(row.photo_path == null){
							row.photo_path = '/vendors/images/photo4.jpg';
						}
						if(row.photo_path == null){
							row.photo_path = '/vendors/images/photo4.jpg';
						}
						return `<div class="name-avatar d-flex align-items-center">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="${row.photo_path}" class="border-radius-100 shadow" width="40"
												height="40" alt="" />
										</div>
										<div class="txt">
											<div class="weight-600">${row.name}</div>
										</div>
									</div>`
					}
				};
			data.push(elements)
			dataTable.forEach(element => {
				var dataElement = {data: element, name:element}
				data.push(dataElement)
			});
			
			var elements = {
					mRender: function (data, type, row) {
						
						return `
									<div class="form-inline"> 
										<button onclick="editUserPrivilege('`+ row.nik_employee +`')" type="button" class="btn btn-secondary mr-1  py-1 px-2">
											<i class="dw dw-edit2"></i>
										</button>
									</div>`
					}
				};
			data.push(elements)

			let urls = '/user-privilege-data';
			console.log(urls)
				$('#'+id).DataTable({
					processing: true,
					serverSide: true,
					responsive: true,
						rowReorder: {
							selector: 'td:nth-child(2)'
						},
					ajax: urls,
					columns:  data
				});			
		}
        showDataTableUserPrivilege('user-data', ['nik_employee', 'position'], 'table-user-privilege')
        
        function showCreateModal() {
            $('#createModal').modal('show')
            $('#form-privilege')[0].reset();
        }

        function store(idForm) {
            var isStored = globalStore(idForm)
        }

        function deletePrivilege(uuid) {
            let _url = '/superadmin/database/delete'
            $('#confirm-modal').modal('show')
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#table_reload').val('privilege')
        }

        function editUserPrivilege(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/user/nik";      
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
                    data = response.data;
                    console.log(data);
                    $('#nik_employee').val(data.nik_employee)
                    $('#modal-header').text(data.name+' Privilege')
                    $('input:checkbox').removeAttr('checked');
                    data.user_privileges.forEach(element => {
                        $('#'+element.privilege_uuid).attr( 'checked', true )
                    });
                    $('#user-privilege-modal').modal('show')
                },
                error: function(response) {
                    console.log(response)
                    alertModal()
                }
            });
        }
    </script>
@endsection
