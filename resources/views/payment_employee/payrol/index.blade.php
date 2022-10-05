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
							<h4 class="text-blue h4">Status Absen</h4>
						</div>
						<div class="pb-20">
							<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
										<th>NIK</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($payment_employes as $value)
									<tr>
										<td class="table-plus">{{ $value->nik_employee}}</td>
										<td>{{ $value->name}}</td>
                                        <td>{{ $value->position}}</td>
										<td>{{ $value->count}}</td>
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

@endsection