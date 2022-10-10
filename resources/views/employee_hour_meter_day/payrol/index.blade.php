{{-- 
	form link
		-> POST: /payrol/hour-meter-day/store 
	
--}}
@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <!-- Simple Datatable start -->
        <div class="mb-30">
          <div class="row">
            <div class="col-12">
                <!-- Simple Datatable start -->
					<div class="card-box mb-30">
						<form action="" >
							@csrf
							<input type="hidden" name="uuid" id="uuid">
							<div class="pd-20">
								<div class="row">
									<div class="col-md-4">
										<h4 class="text-blue h4">Tambah HM Karyawan</h4>
									</div>
									<div class="col-md-8">
										<div class="button-group text-right">											
											<button type="button" onclick="resetData()" class="btn btn-secondary">Reset</button>
											<button type="button" onclick="storeHM()" id="sa-custom-position" class="btn btn-primary">
												Simpan
												<div class="spinner-border" id="loading" role="status">
													<span class="sr-only">Loading...</span>
												  </div>
											</button>
										</div>
									</div>
								</div>							
							</div>
							<div class="pd-20">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="employee_uuid">Pilih Karyawan</label>
											<select  name="employee_uuid" id="employee_uuid" class="custom-select2 form-control" >
												<option value="">karyawan</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="date">Tanggal</label>
											<input type="date" name="date" id="date" value="2020-09-09" class="form-control">
										</div>
									</div>
									<div class="col-md-3"></div>
									<div class="col-md-4 text-center">
										<div class="form-group">
											<label for="value">Nilai HM</label>
											<input onchange="fullValue()" type="text" name="value" id="value" value="" class="form-control">
										</div>
									</div>
									<div class="col-md-3 text-center">
										<div class="form-group">
											<label for="full_value" class="mr-1">Aktifkan Bonus? </label>
											<input
											type="checkbox"
											checked
											name="isBonusAktive"
											class="switch-btn" data-size="small"
											data-color="#0099ff" id="isBonusAktive"
										/>
											<input type="text" name="full_value" id="full_value" class="form-control">
										</div>
									</div>
									<div class="col-md-3"></div>
									<div class="col-md-12">
										<div class="form-group">
											<label class="weight-600">Harga HM</label>
											<div class="row">
												@foreach($hour_meter_prices as $item)
												<div class="col-md-2 col-sm-2">
													<div class="custom-control custom-radio mb-5">
														<input type="radio"  id="{{$item->uuid}}" name="hour_meter_price_uuid"
															class="custom-control-input" value="{{$item->uuid}}"  />
														<label class="custom-control-label" for="{{$item->uuid}}"  >{{ $item->name}}</label>
													</div>
												</div>
												@endforeach													
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<!-- Simple Datatable End -->
            </div>
          </div>
          <div class="row">
            <div class="col-12">
                <!-- Simple Datatable start -->
					<div class="card-box mb-30">
						<div class="pd-20">
							<h4 class="text-blue h4">Baru ditambahkan</h4>
						</div>
						<div class="pb-20">
							<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">Name</th>
                                        <th>Tanggal</th>
                                        <th>Nilai HM</th>
										<th>HM + Bonus</th>
										<th>Harga</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody id="table-recent-added">
									<tr>
										<td class="table-plus">Ahmadi <small>udin</small></td>
										<td>19 Agustus 2022</td>
										<td>10</td>
										<td>13</td>
										<td>20.000</td>
										<td><div class="table-actions">
											<div class="btn-group">
												<div class="cta flex-shrink-0 mr-2">
													<a href="#" onclick="editDatII()"
														class="btn btn-sm btn-outline-primary"><i
															class="icon-copy ion-edit"></i></a>
												</div>
												<div class="cta flex-shrink-0">
													<a href="#" onclick="toDelete('dat-i-i')"
														class="btn btn-sm btn-outline-danger"><i
															class="icon-copy ion-trash-b"></i></a>
												</div>
											</div>
										</div></td>
									</tr>
                                </tbody>
							</table>
						</div>
					</div>
					<!-- Simple Datatable End -->
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
	$('#loading').hide();

	function getFirst(){
		var employees = @json($employees);
		employees.forEach(element => {
			var elements = `<option value="${element.uuid}">${element.name} - ${element.position}</option>`;
			// console.log(element);
			$('#employee_uuid').append(elements);
		});
		// console.log(employees)
	}
	function storeHM(){
			let _token   = $('meta[name="csrf-token"]').attr('content');
			let _url = "/payrol/hour-meter-day/store";
			let isBonusAktive = $('#isBonusAktive')[0].checked
			let full_value
			if(isBonusAktive == false){
				full_value =  $('#value').val()
			}else{
				full_value =  $('#full_value').val()
			}
			let hour_meter_price_uuid = $("input[name='hour_meter_price_uuid']:checked").val();

			$('#loading').show();

			$.ajax({
              url: _url,
              type: "POST",
              data: {
				uuid: $('#uuid').val(),
                employee_uuid: $('#employee_uuid').val(),
				date: $('#date').val(),
				hour_meter_price_uuid: hour_meter_price_uuid,
                value:  $('#value').val() ,
				full_value: full_value,
                _token: _token
              },
              success: function(response) {
                data = response.data
				employees = data.employees
				hm = data.hm
				console.log(employees)
				$('#loading').hide();
				var element_tr = `<tr>
										<td class="table-plus">${employees.name} - <small>${employees.position}</small></td>
										<td>${hm.date}</td>
										<td>${hm.value}</td>
										<td>${hm.full_value}</td>
										<td>${hm.hour_meter_price_uuid}</td>
										<td><div class="table-actions">
											<div class="btn-group">
												<div class="cta flex-shrink-0 mr-2">
													<a href="#" onclick="editDatII()"
														class="btn btn-sm btn-outline-primary"><i
															class="icon-copy ion-edit"></i></a>
												</div>
												<div class="cta flex-shrink-0">
													<a href="#" onclick="toDelete('dat-i-i')"
														class="btn btn-sm btn-outline-danger"><i
															class="icon-copy ion-trash-b"></i></a>
												</div>
											</div>
										</div></td>
									</tr>`;
									$('#table-recent-added').prepend(element_tr)
              },
			  
              error: function(response) {
                console.log(response)
              }
            });
		}
	function fullValue(){
		let isBonusAktive = $('#isBonusAktive')[0].checked
		let full_value
		if(isBonusAktive == true){
			let value_hm = parseInt($('#value').val())
			if(value_hm > 10){
				full_value = value_hm * 0.3
				full_value = full_value + value_hm
			}
			if(value_hm > 15){
				full_value = value_hm * 0.5 + value_hm
			}
			$('#full_value').val(full_value)
			console.log(value_hm)
		}else{
			$('#full_value').val('')
		}
	}

	

	function resetData(){
		console.log('resetData')
		$('#employee_uuid').val() = '';


	}
	$( document ).ready(function() {
		// console.log( "ready!" );
		getFirst();

	});
	
</script>
@endsection