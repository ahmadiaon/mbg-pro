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
						<div class="pd-20">
							<h4 class="text-blue h4">List Karyawan</h4>
						</div>
						<div class="pb-20">
							<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">Name</th>
                                        <th>NIK</th>
										<th>Gajih Pokok</th>
                                        <th>Premi BK</th>
										<th>Premi BK</th>
										<th>Kaos</th>
										<th>Mekanik</th>
										<th>Sepatu</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="table-plus">Ahmadi</td>
										<td>MBLE-20220828001</td>
										<td>Putih</td>
										<td>S</td>
										<td>M</td>
										<td>-</td>
										<td>-</td>
										<td>6</td>
										<td>
											<a class="dropdown-item" href="#">
														<i class="dw dw-edit2"></i> Edit 
											</a>
										</td>
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
</script>
@endsection