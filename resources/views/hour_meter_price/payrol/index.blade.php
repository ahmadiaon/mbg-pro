@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <!-- Simple Datatable start -->
        <div class="mb-30">
          <div class="row">
            <div class="col-8">
                <!-- Simple Datatable start -->
					<div class="card-box mb-30">
						<div class="pd-20">
							<h4 class="text-blue h4">Harga HM</h4>
						</div>
						<div class="pb-20">
							<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">Name</th>
                                        <th>Kode Excel</th>
                                        <th>Value</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								

								<tbody>
									@foreach($hour_meter_prices as $value)
									<tr>
										<td class="table-plus">{{ $value->name}}</td>
										<td>{{ $value->key_excel}}</td>
										<td>{{ $value->value}}</td>
										<td>
											<a class="dropdown-item" href="#" onclick="edit('{{$value->uuid}}')" >
												<i class="dw dw-edit2"></i> Edit
											</a>
										</td>
									</tr>
									@endforeach
									
                                </tbody>
							</table>
						</div>
					</div>
					<!-- Simple Datatable End -->
            </div>
			<div class="col-4">
                <!-- Simple Datatable start -->
					<div class="card-box">
						<div class="pd-20">
							<form action="/payrol/database/hour-meter-price" id="form-hour-meter-price">
								@csrf
								<input type="hidden" value="" name="uuid" id="uuid">
								<div class="row">
									<div class="col-7">
										<h4 class="text-blue h4">Harga HM</h4>
										<p>detail Harga HM</p>
									</div>
									<div class="col-5 text-right">
										<button onclick="create()" type="button" class="btn btn-primary">new</button>
									</div>
								</div>
								<div class="form-group">
									<label for="">Nama</label>
									<input type="text"  name="name" id="name" class="form-control" >
								</div>
                                <div class="form-group">
									<label for="">Kode Excel</label>
									<input type="text"  name="key_excel" id="key_excel" class="form-control">
								</div>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label for="">Harga</label>
											<input type="text" class="form-control" name="value" id="value">
										</div>
									</div>
									
								</div>
								<div class="form-group">
									<label for="">tanggal mulai</label>
									<input type="date" name="use_start" id="use_start" class="form-control">
								</div>
								<div class="form-group">
									<label for="">tanggal selesai</label>
									<input type="date" class="form-control" name="use_end" id="use_end">
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
@endsection

@section('js')
<script>
	function create(){
		$('#uuid').val('');
		$('#value').val('');
		$('#name').val('');
		$('#use_start').val('');
		$('#use_end').val('');
	}

	function store(){		
        let _token   = $('meta[name="csrf-token"]').attr('content');
		let _url = $('#form-hour-meter-price').attr('action');

		$.ajax({
              url: _url,
              type: "POST",
              data: {
				uuid : $('#uuid').val(),
				value : $('#value').val(),
				name : $('#name').val(),
                key_excel:$('#key_excel').val(),
				use_start : $('#use_start').val(),
				use_end : $('#use_end').val(),
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
		let _token   = $('meta[name="csrf-token"]').attr('content');
		let _url = '/payrol/database/hour-meter-price/'+uuid+'/edit';

		$.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    if(response) {
						data = response.data
						$('#uuid').val(data.uuid),
						$('#value').val(data.value),
						$('#name').val(data.name),
                        $('#key_excel').val(data.key_excel),
						$('#use_start').val(data.use_start),
						$('#use_end').val(data.use_end),
                        console.log(data.id)
                    }
                }
            });
	}
</script>
@endsection