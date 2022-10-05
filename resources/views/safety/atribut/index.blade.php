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
							<h4 class="text-blue h4">Atribut Safety</h4>
						</div>
						<div class="pb-20">
							<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">Name</th>
                                        <th>Group</th>
                                        <th>Varian</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="table-plus">Baju Orange</td>
										<td>Baju</td>
										<td>S, M, XL, XXL, XXXL</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
                                </tbody>
							</table>
						</div>
					</div>
					<!-- Simple Datatable End -->
            </div>
          </div>
          <div class="row">
            <div class="col-6">
                <!-- Simple Datatable start -->
					<div class="card-box mb-30">
						<div class="pd-20">
							<h4 class="text-blue h4">Varian/Ukuran Atribut</h4>
						</div>
						<div class="pb-20">
							<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">Name</th>
                                        <th>Group</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="table-plus">Gloria F. Mead</td>
										<td>25</td>
										
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
                                </tbody>
							</table>
						</div>
					</div>
					<!-- Simple Datatable End -->
            </div>
            <div class="col-6">
                <!-- Simple Datatable start -->
					<div class="card-box mb-30">
						<div class="pd-20">
							<h4 class="text-blue h4">Atribut Group</h4>
						</div>
						<div class="pb-20">
							<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
                                        <th>Group</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Sepatu</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
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