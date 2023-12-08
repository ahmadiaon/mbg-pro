@extends('layouts.main')

@section('src_css')
<link rel="stylesheet" type="text/css" href="/src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="/src/plugins/datatables/css/responsive.bootstrap4.min.css" />
	
@endsection

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Menu</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Menu
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row  justify-content-md-center">
        {{-- search bar --}}
        <div class="col-md-6 col-sm-12 mb-20">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Recipient's username"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button"><i class="icon-copy ion-search"></i></button>
                </div>
            </div>
        </div>

       
        <div class="col-md-12 col-sm-12">
            <div class="container px-0">
                <div class="row">
                    <div class="col-md-4 mb-30">
                        <div class="card-box pricing-card ">
                            <div class="pricing-icon">
                                <img src="vendors/images/icon-Cash.png" alt="" />
                            </div>
                            <div class="price-title">DATABASE</div>
                            <div id="database-menu">

                            </div>

                          
                            <div class="cta">
                                <a href="#" onclick="chooseTableDatabase('code_data')" class="btn btn-primary btn-rounded btn-lg">More Detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-30">
                        <div class="card-box pricing-card mt-30 mb-30">
                            <div class="pricing-icon">
                                <img src="vendors/images/icon-debit.png" alt="" />
                            </div>
                            <div class="price-title">expert</div>
                            <div class="pricing-price"><sup>$</sup>199<sub>/mo</sub></div>
                            <div class="text">
                                Card servicing<br />
                                for 6month
                            </div>
                            <div class="cta">
                                <a href="#" class="btn btn-primary btn-rounded btn-lg">More Detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-30">
                        <div class="card-box pricing-card mt-30 mb-30">
                            <div class="pricing-icon">
                                <img src="vendors/images/icon-online-wallet.png" alt="" />
                            </div>
                            <div class="price-title">experience</div>
                            <div class="pricing-price"><sup>$</sup>599<sub>/yr</sub></div>
                            <div class="text">
                                Card servicing<br />
                                for 1year
                            </div>
                            <div class="cta">
                                <a href="#" class="btn btn-primary btn-rounded btn-lg">More Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('src_javascript')

<script src="/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="/vendors/scripts/datatable-setting.js"></script>
@endsection

@section('script_javascript')
<script>

    function chooseTableDatabase(code_data){
        $('#database-menu').append(`
            <div class="card-box">
                <!-- Simple Datatable start -->
				<div class="mb-30">
					<div class="">
						<h4 class="text-blue h4">Data Table Simple</h4>
						<p class="mb-0">
							you can find more options
							<a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a>
						</p>
					</div>
					<div class="">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Name</th>
									
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="table-plus"><span class="badge badge-primary">Primary</span></td>
								
								</tr>
								<tr>
                                    <td class="table-plus"><span class="badge badge-primary">Primary</span></td>
									
								</tr>
								<tr>
                                    <td class="table-plus"><span class="badge badge-primary">Primary</span></td>
									
								</tr>
								<tr>
                                    <td class="table-plus"><span class="badge badge-primary">Primary</span></td>
								
								</tr>
								<tr>
                                    <td class="table-plus"><span class="badge badge-primary">Primary</span></td>
								
								</tr>
								<tr>
                                    <td class="table-plus"><span class="badge badge-primary">Primary</span></td>
									
								</tr>
								<tr>
                                    <td class="table-plus"><span class="badge badge-primary">Primary</span></td>
									
								</tr>
								<tr>
                                    <td class="table-plus"><span class="badge badge-primary">Primary</span></td>
									
								</tr>
								<tr>
                                    <td class="table-plus"><span class="badge badge-primary">Primary</span></td>
									
								</tr>
								<tr>
                                    <td class="table-plus"><span class="badge badge-primary">Primary</span></td>
									
								</tr>
								<tr>
                                    <td class="table-plus"><span class="badge badge-primary">Primary</span></td>
									
								</tr>
								<tr>
                                    <td class="table-plus"><span class="badge badge-primary">Primary</span></td>
									
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- Simple Datatable End -->
            </div>
        `);
    }

    ajaxGet('/refresh/localdata');


</script>
@endsection


