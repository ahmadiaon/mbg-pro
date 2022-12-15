@extends('template.admin.main_privilege')

@section('content')
<div class="mb-30">
    <div class="row">
      <div class="col-md-8">
          <!-- Simple Datatable start -->
              <div class="card-box mb-30">
                  <div class="pd-20">
                      <h4 class="text-blue h4">Status Absen</h4>
                  </div>
                  <div class="pb-20">
                    <table id="table-status-absen" class="display nowrap stripe hover table" style="width:100%">
                          <thead>
                              <tr>
                                  <th class="table-plus datatable-nosort">Kode</th>
                                  <th>Deskripsi</th>
                                  <th>Pembayaran</th>
                                  <th class="datatable-nosort">Action</th>
                              </tr>
                          </thead>
                      </table>
                  </div>
              </div>
              <!-- Simple Datatable End -->
      </div>
      <div class="col-md-4">
          <!-- Simple Datatable start -->
              <div class="card-box">
                  <div class="pd-20">
                      <form action="/database/status-absen" id="status_absen">
                          @csrf
                          <input type="hidden" value="" name="uuid" id="uuid">
                          <div class="row">
                              <div class="col-7">
                                  <h4 class="text-blue h4">Status Absen</h4>
                                  <p>detail status absen</p>
                              </div>
                              <div class="col-5 text-right">
                                  <button onclick="create()" type="button" class="btn btn-primary">new</button>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="">Deskripsi</label>
                              <input type="text"  name="status_absen_description" id="status_absen_description" class="form-control" name="" id="">
                          </div>
                          <div class="row">
                              <div class="col-4">
                                  <div class="form-group">
                                      <label for="">Kode</label>
                                      <input type="text" class="form-control" name="status_absen_code" id="status_absen_code">
                                  </div>
                              </div>
                              <div class="col-8">
                                  <div class="form-group">
                                      <label for="">Pembayaran</label>
                                      <select name="math" id="math" class="form-control" id="">
                                          <option value="pay">pay</option>
                                          <option value="unpay">unpay</option>
                                          <option value="cut">cut</option>
                                          <option value="A">A</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="">tanggal mulai</label>
                              <input type="date" name="use_start" id="use_start" class="form-control" name="" id="">
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
@endsection

@section('js')
<script>
     showDataTable('database/absen-data', ['status_absen_code','status_absen_description','math','action'], 'table-status-absen')
	
     function create(){
		$('#uuid').val('');
		$('#status_absen_code').val('');
		$('#status_absen_description').val('');
		$('#math').val('');
		$('#use_start').val('');
		$('#use_end').val('');
	}

	function store(){		
        let _token   = $('meta[name="csrf-token"]').attr('content');
		let _url = $('#status_absen').attr('action');

		$.ajax({
              url: _url,
              type: "POST",
              data: {
				uuid : $('#uuid').val(),
				status_absen_code : $('#status_absen_code').val(),
				status_absen_description : $('#status_absen_description').val(),
				math : $('#math').val(),
				use_start : $('#use_start').val(),
				use_end : $('#use_end').val(),
                _token: _token
              },
              success: function(response) {
                console.log("response")
                console.log(response)
                $('#success-modal').modal('show')
                console.log(response)
                $('#table-status-absen').DataTable().ajax.reload();
              },
              error: function(response) {
                console.log(response)
              }
            });
	}
	function edit(uuid){
		let _token   = $('meta[name="csrf-token"]').attr('content');
		let _url = '/database/absen/'+uuid+'/edit';

		$.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    if(response) {
						data = response.data
						$('#uuid').val(data.uuid),
						$('#status_absen_code').val(data.status_absen_code),
						$('#status_absen_description').val(data.status_absen_description),
						$('#math').val(data.math),
						$('#use_start').val(data.use_start),
						$('#use_end').val(data.use_end),
                        console.log(data.id)
                    }
                }
            });
	}
    function deletePrivilege(uuid){
            let _url = '/database/absen/delete'
            $('#confirm-modal').modal('show')
            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#table_reload').val('status-absen')
       }
</script>
@endsection