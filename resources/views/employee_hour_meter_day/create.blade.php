@extends('template.admin.main_privilege')
@section('content')
<div class="mb-30">
    <div class="row">
      <div class="col-12">
          <!-- Simple Datatable start -->
              <div class="card-box  mb-30">
                  <form action="/hour-meter/store" id="form-hour-meter" method="POST" enctype="multipart/form-data">
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
                                      <button type="button" onclick="store('hour-meter')" class="btn btn-primary">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee_checker_uuid">Pilih Checker</label>
                                    <select  name="employee_checker_uuid" id="employee_checker_uuid" class="custom-select2 form-control" >
                                        <option value="">karyawan</option>
                                    </select>
                                    <div class="invalid-feedback" id="req-employee_checker_uuid">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee_foreman_uuid">Pilih Foreman</label>
                                    <select  name="employee_foreman_uuid" id="employee_foreman_uuid" class="custom-select2 form-control" >
                                        <option value="">karyawan</option>
                                    </select>
                                    <div class="invalid-feedback" id="req-employee_foreman_uuid">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee_supervisor_uuid">Pilih Supervisor</label>
                                    <select  name="employee_supervisor_uuid" id="employee_supervisor_uuid" class="custom-select2 form-control" >
                                        <option value="">karyawan</option>
                                    </select>
                                    <div class="invalid-feedback" id="req-employee_supervisor_uuid">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                        </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="employee_uuid">Pilih Karyawan</label>
                                      <select  name="employee_uuid" id="employee_uuid" class="custom-select2 form-control" >
                                          <option value="">karyawan</option>
                                      </select>
                                      <div class="invalid-feedback" id="req-employee_uuid">
                                        Data tidak boleh kosong
                                    </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="date">Tanggal</label>
                                      <input type="date" name="date" id="date" value="2020-09-09" class="form-control">
                                  </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Shift</label>
                                    <div>
                                         <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label id="lbl-Siang" class="btn btn-outline-primary">
                                                <input type="radio" name="shift" id="Siang" value="Siang" checked="checked" autocomplete="off" >
                                                Siang
                                            </label>
                                        
                                            <label id="lbl-Malam" class="btn btn-outline-primary">
                                                <input type="radio" name="shift" id="Malam" value="Malam" autocomplete="off">
                                                Malam
                                            </label>
                                        </div>
                                    </div>
                                   
                                </div>
                                
                              </div>
                              <div class="col-md-4 text-center">
                                  <div class="form-group">
                                      <label for="value">Nilai HM</label>
                                      <input onkeyup="fullValue()" type="text" name="value" id="value" value="" class="form-control">
                                  </div>
                              </div>
                              <div class="col-md-3 text-center">
                                  <div class="form-group">
                                      <label for="full_value" class="mr-1">Aktifkan Bonus? </label>
                                      <input
                                      type="checkbox"
                                      onchange="fullValue()"
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
                                        <input type="hidden" id="hour_meter_price_uuid">
                                          @foreach($hour_meter_prices as $item)
                                          <div class="col-md-2 col-sm-2">
                                              <div class="custom-control custom-radio mb-5">
                                                  <input onchange="updatehour_meter_price_uuid('{{$item->uuid}}')" type="radio"  id="{{$item->uuid}}" name="hour_meter_price_uuid"
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
                      <table id="table-hour-meter" class="display nowrap stripe hover table" >
                          <thead>
                              <tr>
                                  <th class="table-plus datatable-nosort">Name</th>
                                  <th>Tanggal</th>
                                  <th>Nilai HM</th>
                                  <th>HM + Bonus</th>
                                  <th>Harga</th>
                                  <th>Update At</th>
                                  <th class="datatable-nosort">Action</th>
                              </tr>
                          </thead>
                      </table>
                  </div>
              </div>
              <!-- Simple Datatable End -->
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
                    console.log('aaa')
                    console.log(row)					
                    return `${row.name} <small>${row.position}</small>`
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
                                    <button onclick="editHm('`+ row.uuid +`')" type="button" class="btn btn-secondary">
                                        <i class="dw dw-edit2"></i>
                                    </button>
                                </div>`
                }
            };
        data.push(elements)

        let urls = '{{env('APP_URL')}}'+url
        console.log(urls)
            $('#'+id).DataTable({
                order: [['5', 'desc']],
                columnDefs: [
                                        { "visible": false, "targets": 5 }
                                    ],
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
    showDataTableUserPrivilege('hour-meter/data', ['date','value','full_value','hour_meter_value','updated_at'], 'table-hour-meter')
        
	$('#loading').hide();
    function globalStoreHm(idForm){
			let _url = $('#form-'+idForm).attr('action');

            var form = $('#form-'+idForm)[0];
            var form_data = new FormData(form);
			startLoading();
            $.ajax({
                url: _url,
                type: "POST",
                contentType: false,
                processData: false,
                data: form_data,
                success: function(response) {
                    $('#success-modal').modal('show')
					console.log(response)
					$('#table-'+idForm).DataTable().ajax.reload();
                },
                error: function(response) {
                    alertModal()					
				}
            });
		}

    function store(idForm){
        console.log(idForm)
        if(isRequired(['employee_uuid','employee_checker_uuid','employee_foreman_uuid'])    > 0){ return false; }
        var isStored = globalStoreHm(idForm) 
        resetData();
        $('#sa-custom-position').click();           
    }

	function getFirst(){
		var employees = @json($employees);
		employees.forEach(element => {
			var elements = `<option value="${element.uuid}">${element.name} - ${element.position}</option>`;
			// console.log(element);
			$('#employee_uuid').append(elements);
            $('#employee_checker_uuid').append(elements);
            $('#employee_foreman_uuid').append(elements);
            $('#employee_supervisor_uuid').append(elements);
		});
		// console.log(employees)
	}
    function updatehour_meter_price_uuid(uuid){
        $('#hour_meter_price_uuid').val(uuid);
        
    }
	function editHm(uuid){
			let _token   = $('meta[name="csrf-token"]').attr('content');
			let _url = "/hour-meter/edit";

			

			$('#loading').show();

			$.ajax({
              url: _url,
              type: "POST",
              data: {
				uuid: uuid,
                _token: _token
              },
              success: function(response) {
                data = response.data
				console.log('data')
				console.log(data)
                $('#employee_uuid').val(data.employee_uuid).trigger('change');
                $('#uuid').val(data.uuid).trigger('change');
                $('#employee_checker_uuid').val(data.employee_checker_uuid).trigger('change');
                $('#employee_foreman_uuid').val(data.employee_foreman_uuid).trigger('change');
                $('#employee_supervisor_uuid').val(data.employee_supervisor_uuid).trigger('change');
                $('#full_value').val(data.full_value).trigger('change');
                $('#'+data.hour_meter_price_uuid).attr( 'checked', true );
                $('#'+data.shift).attr( 'checked', true );
                $('.btn-outline-primary').attr( 'class', ' btn btn-outline-primary' );
                $('#lbl-'+data.shift).attr( 'class', ' btn btn-outline-primary active' );
                $('#value').val(data.value).trigger('change');
				$('#loading').hide();
				
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
			if(value_hm >= 10){
				full_value = value_hm * 0.15
				full_value = full_value + value_hm
			}
			if(value_hm >= 15){
				full_value = value_hm * 0.3 + value_hm
			}
			$('#full_value').val(full_value)
			console.log(value_hm)
		}else{
			$('#full_value').val(parseInt($('#value').val()))
		}
	}

	

	function resetData(){
		console.log('resetData')
        $('#uuid').val('')
        $('.btn-outline-primary').attr( 'class', ' btn btn-outline-primary' );
        $('#lbl-Siang').attr( 'class', ' btn btn-outline-primary active' );
		$('#employee_uuid').val('').trigger('change');
	}
	$( document ).ready(function() {
		// console.log( "ready!" );
		getFirst();
        $('.btn-outline-primary').attr( 'class', ' btn btn-outline-primary' );
        $('#lbl-Siang').attr( 'class', ' btn btn-outline-primary active' );

	});
	
</script>
@endsection