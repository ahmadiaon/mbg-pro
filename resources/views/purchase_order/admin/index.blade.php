@extends('template.admin.main_privilege')
@section('content')
    <div class="card-box mb-30 ">
        <div class="row mb-30 pd-20">
            <div class="col-3">
                <h4 class="text-blue h4">Pembayaran</h4>
            </div>
            @if (!empty(session('dataUser')->create_purchase_order))
            <div class="col-9 text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <a href="/purchase-order/create">
                            <button class="btn btn-primary mr-10">Tambah</button>
						</a>                     
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="pb-20">
            <table id="table-user-privilege"  class="display nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        <th>Nomor PO</th>
                        <th>Tanggal</th>
                        <th>Dokumen</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Simple Datatable End -->
    <!-- Modal -->
    <div class="modal fade" id="doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Document</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>                    
                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <iframe id="path_doc" src="" style="width:100%; height:500px;" frameborder="0"></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- delete modal --}}
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="icon-copy ion-android-delete"></i>
                    </div>
                    <input type="hidden" id="uuid" name="uuid">
                    <h4 class="modal-title w-100">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button onclick="deleteItem()" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- success modal --}}
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Data Tersimpan</h3>
                    <div class="mb-30 text-center">
                        <img src="{{ env('APP_URL') }}vendors/images/success.png" />
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        Done
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function showDataTableUserPrivilege(url,dataTable,id){	
			let data	=[];
            let datas = @json(session('dataUser'));
                        console.log(datas);
			
			dataTable.forEach(element => {
				var dataElement = {data: element, name:element}
				data.push(dataElement)
			});
            var elements_doc = {
					mRender: function (data, type, row) {       
                        console.log(row)               
                           let btn =  `<div class="form-inline">
                                                        <button type="button" onclick="showdoc('${row.po_path}')" class="btn btn-sm btn-primary mr-1">Lihat PO</button>
                                                        <button type="button" onclick="showdoc('${row.travel_document_path}')" class="btn btn-sm btn-primary">Lihat SJ</button>
                                                    </div>`;
						return btn;
					}
				};
			data.push(elements_doc)
			
			var elements = {
					mRender: function (data, type, row) {                      
                           let btn_edit =  `<a class="mr-2" href="/purchase-order/show/${row.uuid}">
                                                <button type="button" class="btn btn-secondary  py-1 px-2" data-toggle="tooltip" data-placement="bottom"
                                                title="Lihat detail">
                                                <i class="dw dw-edit2"></i>
                                                </button>
                                            </a>`;
                            let btn_show = `<a class="mr-2" href="/purchase-order/detail/${row.uuid}">
                                                    <button type="button" class="btn btn-success  py-1 px-2" data-toggle="tooltip" data-placement="bottom"
                                                    title="Edit data">
                                                    <i class="icon-copy bi bi-eye"></i>
                                                    </button>
                                                </a>`;
                            let btn_delete = `<button onclick="confirmDelete('${row.uuid}')"  type="button" class="btn btn-danger  py-1 px-2" data-toggle="tooltip" data-placement="bottom"
                                                            title="Hapus Data">
                                                            <i class="icon-copy dw dw-trash"></i>
                                                        </button>`;

                            let datas = @json(session('dataUser'));
                            let group_btn ='';
                            if(typeof datas.read_purchase_order  !== "undefined" ){
                                group_btn = group_btn+btn_show
                            }
                            if(typeof datas.edit_purchase_order !== "undefined" ){
                                group_btn = group_btn+btn_edit
                            }
                            if(typeof datas.delete_purchase_order !== "undefined" ){
                                group_btn = group_btn+btn_delete
                            }
               
						
						return `<div class="form-inline"> `+
										group_btn
									+`</div>`
					}
				};
			data.push(elements)

			let urls = '{{env('APP_URL')}}'+url
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
        showDataTableUserPrivilege('purchase-order/data', ['po_number', 'date'], 'table-user-privilege')
        
        $( document ).ready(function() {
            $('.sorting_1').addClass('table-plus')
            
        });
        function showdoc(path) {
            $('#path_doc').attr("src", "{{ env('APP_URL') }}purchase/pdf/" + path)
            $('#doc').modal('show')
        }

        function deleteItem() {
            var uuid = $('#uuid').val()
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/purchase-order/delete";

            $.ajax({
                url: _url,
                type: "POST",

                data: {
                    uuid: uuid,
                    _token: _token
                },
                success: function(response) {
                    data = response.data
                    console.log('deleted')
                    $('#myModal').modal('hide')
                    $('#success-modal').modal('show')
                    window.location.href = "/purchase-order"
                    console.log(data)
                },
                error: function(response) {
                    console.log(response)
                }
            });
        }

        function confirmDelete(uuid) {
            console.log(uuid);
            $('#myModal').modal('show')
            $('#uuid').val(uuid)
        }
    </script>
@endsection
