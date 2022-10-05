@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <!-- Simple Datatable start -->
        <div class="mb-30">
			
          <div class="row">
            <div class="col-12">
                <!-- Simple Datatable start -->
					<div class="card-box mb-30 ">
						<div class="row mb-30 pd-20">
							<div class="col-3">
								<h4 class="text-blue h4">Pembayaran</h4>
							</div>
							<div class="col-9 text-right">
								<div class="btn-group">
									<div class="btn-group dropdown">
										<a href="/purchase-order/create">
										<button 
									 class="btn btn-primary mr-10">Tambah</button></a>
										<button
											type="button"
											class="btn btn-light dropdown-toggle waves-effect"
											data-toggle="dropdown"
											aria-expanded="false"
										>
											2022 <span class="caret"></span>
										</button>
										
										<div class="dropdown-menu">
											<a class="dropdown-item" href="/payrol/month/9/export">2021</a>
											<a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter" href="">2022</a>
										</div>
									</div>
									<div class="btn-group dropdown">
										<button
											type="button"
											class="btn btn-light dropdown-toggle waves-effect"
											data-toggle="dropdown"
											aria-expanded="false"
										>
											September <span class="caret"></span>
										</button>
										
										<div class="dropdown-menu">
											<a class="dropdown-item" href="/payrol/hour-meter/2022-08">Agustus</a>
											<a class="dropdown-item" href="/payrol/hour-meter/2022-09">September</a>
											<a class="dropdown-item" href="/payrol/hour-meter/2022-10">Oktober</a>
										</div>
									</div>
									<div class="btn-group dropdown">
										<button
											type="button"
											class="btn btn-light dropdown-toggle waves-effect"
											data-toggle="dropdown"
											aria-expanded="false"
										>
											Menu <span class="caret"></span>
										</button>
										
										<div class="dropdown-menu">
											<a class="dropdown-item" href="/payrol/month/9/export">Export</a>
											<a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter" href="">Import</a>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="pb-20">
							<table id="myTablse" class="table table-stripped">
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">Nomor PO</th>
                                        <th>Tanggal</th>
                                        <th>Dokumen</th>
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
        <!-- Simple Datatable End -->
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4> 
        </div>
        <div class="modal-body">
          <div style="text-align: center;">
  <iframe id="path_doc" src="" 
  style="width:100%; height:500px;" frameborder="0"></iframe>
  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



  
@endsection

@section('js')
<script>
	function showdoc(path){
        $('#path_doc').attr("src", "{{env('APP_URL')}}purchase/pdf/"+path)
        $('#doc').modal('show')
    }
 $(function() {
        $('#myTablse').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url(env('APP_URL').'purchase-order/data') }}',
            columns: [
                { data: 'po_number', name: 'po_number' },
                { data: 'date', name: 'date' }, 
				{ data: 'document', name: 'document' },              
                { data: 'action', name: 'action' }
            ]
        });
    });

</script>
@endsection