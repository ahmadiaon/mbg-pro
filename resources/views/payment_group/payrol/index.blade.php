@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <!-- Simple Datatable start -->
        <div class="mb-30">
          <div class="row">
            <div class="col-6">
                <!-- Simple Datatable start -->
					<div class="card-box mb-30">
						<div class="pd-20">
							<h4 class="text-blue h4">Jenis Pembayaran</h4>
						</div>
						<div class="pb-20">
							<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">Payment Group</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($payments as $value)
									<tr>
										<td>{{ $value->payment_group}}</td>
										<td>
											<div class="button-group-inline">
												<button  onclick="edit('{{$value->uuid}}')" class="btn btn-success">edit</button> <button onclick="confirm('{{$value->uuid}}')"  class="btn btn-danger">hapus</button>
											</div>
										</td>
									</tr>
									@endforeach
									
                                </tbody>
							</table>
						</div>
					</div>
					<!-- Simple Datatable End -->
            </div>
			<div class="col-6">
                <!-- Simple Datatable start -->
					<div class="card-box">
						<div class="pd-20">
							<form action="/payrol/database/payment-group" id="payment_groups">
								@csrf
								<input type="hidden" value="" name="uuid" id="uuid">
								<div class="row">
									<div class="col-7">
										<h4 class="text-blue h4">Jenis Pembayaran</h4>
										<p>detail group pembayaran</p>
									</div>
									<div class="col-5 text-right">
										<button onclick="create()" type="button" class="btn btn-primary">new</button>
									</div>
								</div>
								<div class="form-group">
									<label for="">Payment Group</label>
									<input type="text"  name="payment_group" id="payment_group" class="form-control" name="" id="">
								</div>
								<div class="form-group text-right">
									<button type="button" onclick="store()" class="btn btn-primary">Simpan</button>
								</div>
							</form>
						</div>
					</div>
			</div>
          </div>
        </div>
        <!-- Simple Datatable End -->
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
</div>

		<div
			class="modal fade"
			id="confirmation-modal"
			tabindex="-1"
			role="dialog"
			aria-hidden="true">
			<div
				class="modal-dialog modal-dialog-centered"
				role="document"
			>
				<div class="modal-content">
					<div class="modal-body text-center font-18">
						<h4 class="padding-top-30 mb-30 weight-500">
							Are you sure you want to continue?
						</h4>
						<div
							class="padding-bottom-30 row"
							style="max-width: 170px; margin: 0 auto"
						>
							<div class="col-6">
								<button
									type="button"
									class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
									data-dismiss="modal"
								>
									<i class="fa fa-times"></i>
								</button>
								NO
							</div>
							<div class="col-6">
									<input type="hidden" name="delete_uuid" id="delete_uuid">
									<button
										type="button" onclick="deleting()"
										class="btn btn-primary border-radius-100 btn-block confirmation-btn"
										data-dismiss="modal"
									>
										<i class="fa fa-check"></i>
									</button>
								YES
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
@endsection

@section('js')
<script>
	function create(){
		$('#uuid').val('');
		$('#payment_group').val('');
	}

	function store(){		
        let _token   = $('meta[name="csrf-token"]').attr('content');
		let _url = $('#payment_groups').attr('action');

		$.ajax({
              url: _url,
              type: "POST",
              data: {
				uuid : $('#uuid').val(),
				payment_group : $('#payment_group').val(),
                _token: _token
              },
              success: function(response) {
                console.log("response")
                console.log(response)
              },
              error: function(response) {
                console.log(response)
              }
            });
	}
	function edit(uuid){
		console.log(uuid)
		let _token   = $('meta[name="csrf-token"]').attr('content');
		let _url = '/payrol/database/payment-group/'+uuid+'/edit';
		$.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    if(response) {
						data = response.data
						$('#uuid').val(data.uuid),
						$('#payment_group').val(data.payment_group),
                        console.log(data.payment_group)
                    }
                }
            });
	}

	function confirm(uuid){
		let _url = '/payrol/database/payment-group/'+uuid+'/delete';
		console.log(_url)
		$('#confirmation-modal').modal('show');
		$('#delete_uuid').val(uuid);
	}
	function deleting(){
		let uuid = $('#delete_uuid').val();
		let _url = '/payrol/database/payment-group/'+uuid+'/delete';
		location.href =_url;
	}
</script>
@endsection