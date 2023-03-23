@extends('template.admin.main_privilege')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-2"><span class="border"></span>
               
            </div>
            <div class="col-md-auto">
            </div>
            <div class="col col-lg-2">
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col col-lg-2"><span class="border"></span>
            </div>
            <div class="col-md-auto">
            </div>
            <div class="col col-lg-2">
            </div>
        </div>
        <div class="row">
            <div class="col">
                1 of 3
            </div>
            <div class="col-md-auto">
                Variable width content
            </div>
            <div class="col col-lg-2">
                3 of 3
            </div>
        </div>
    </div>

    <div class="mb-30">
        <div class="row">
            <div class="col-12">
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">List Karyawan</h4>
                    </div>
                    <div class="pb-20">
                        <table id="table-user-privilege" class="display nowrap stripe hover table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Helm </br> Sepatu</th>
                                    <th>Baju </br>Orange</th>
                                    <th>Baju</br> Biru</th>
                                    <th>Kaos</th>
                                    <th>Mekanik</th>
                                    <th>Action</th>
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
        function showDataTableUserPrivilege(url, dataTable, id) {
            let data = [];
            var elements = {
                mRender: function(data, type, row) {
                    if (row.photo_path == null) {
                        row.photo_path = '/vendors/images/photo4.jpg';
                    }
                    if (row.photo_path == null) {
                        row.photo_path = '/vendors/images/photo4.jpg';
                    }
                    return `<div class="name-avatar d-flex align-items-center">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="${row.photo_path}" class="border-radius-100 shadow" width="40"
												height="40" alt="" />
										</div>
										<div class="txt">
											<div class="weight-600">${row.name}</div>
											<small>${row.position}</small></br>
											<small>${row.nik_employee}</small>
										</div>
									</div>`
                }
            };
            data.push(elements)
            var helm_color = {
                mRender: function(data, type, row) {
                    let helm_color = '';
                    if (row.helm_color == null) {
                        helm_color = '-';
                    } else {
                        if (row.helm_color == null) {
                            helm_color = '-';
                        } else {
                            helm_color = row.helm_color;
                        }
                    }
                    let boots_size = '';
                    if (row.boots_size == null) {
                        boots_size = '-';
                    } else {
                        if (row.boots_size == null) {
                            boots_size = '-';
                        } else {
                            boots_size = row.boots_size;
                        }
                    }

                    return `
									<span>
										${helm_color} / ${boots_size}
									</span>`
                }
            };
            data.push(helm_color)
            dataTable.forEach(element => {
                var dataElement = {
                    data: element,
                    name: element
                }
                data.push(dataElement)
            });



            // var orange_size = {
            // 		mRender: function (data, type, row) {
            // 			let orange_sizes = '';
            // 			if(row.user_safety == null){
            // 				orange_sizes = '-';
            // 			}else{
            // 				if(row.user_safety.orange_size == null){
            // 					orange_sizes = '-';
            // 				}else{
            // 					orange_sizes = row.user_safety.orange_size;
            // 				}
            // 			}
            // 			return `
        // 						<span>
        // 							${orange_sizes}
        // 						</span>`
            // 		}
            // 	};
            // data.push(orange_size)

            // var blue_size = {
            // 		mRender: function (data, type, row) {
            // 			let blue_sizes = '';
            // 			if(row.user_safety == null){
            // 				blue_sizes = '-';
            // 			}else{
            // 				if(row.user_safety.blue_size == null){
            // 					blue_sizes = '-';
            // 				}else{
            // 					blue_sizes = row.user_safety.blue_size;
            // 				}
            // 			}
            // 			return `
        // 						<span>
        // 							${blue_sizes}
        // 						</span>`
            // 		}
            // 	};
            // data.push(blue_size)

            // var shirt_size = {
            // 		mRender: function (data, type, row) {
            // 			let shirt_sizes = '';
            // 			if(row.user_safety == null){
            // 				shirt_sizes = '-';
            // 			}else{
            // 				if(row.user_safety.shirt_size == null){
            // 					shirt_sizes = '-';
            // 				}else{
            // 					shirt_sizes = row.user_safety.shirt_size;
            // 				}
            // 			}
            // 			return `
        // 						<span>
        // 							${shirt_sizes}
        // 						</span>`
            // 		}
            // 	};
            // data.push(shirt_size)

            // var mekanik_size = {
            // 		mRender: function (data, type, row) {
            // 			let mekanik_sizes = '';
            // 			if(row.user_safety == null){
            // 				mekanik_sizes = '-';
            // 			}else{
            // 				if(row.user_safety.mekanik_size == null){
            // 					mekanik_sizes = '-';
            // 				}else{
            // 					mekanik_sizes = row.user_safety.mekanik_size;
            // 				}
            // 			}
            // 			return `
        // 						<span>
        // 							${mekanik_sizes}
        // 						</span>`
            // 		}
            // 	};
            // data.push(mekanik_size)

            // var boots_size = {
            // 		mRender: function (data, type, row) {
            // 			let boots_sizes = '';
            // 			if(row.user_safety == null){
            // 				boots_sizes = '-';
            // 			}else{
            // 				if(row.user_safety.boots_size == null){
            // 					boots_sizes = '-';
            // 				}else{
            // 					boots_sizes = row.user_safety.boots_size;
            // 				}
            // 			}
            // 			return `
        // 						<span>
        // 							${boots_sizes}
        // 						</span>`
            // 		}
            // 	};
            // data.push(boots_size)

            var elements = {
                mRender: function(data, type, row) {

                    return `
									<div class="form-inline"> 
										<a href="/safety/edit/${row.nik_employee}">
											<button  type="button" class="btn btn-secondary mr-1  py-1 px-2">
												<small>APD</small>
											</button>
										</a>
										<a href="/safety/edit/${row.nik_employee}">
											<button  type="button" class="btn btn-primary mr-1  py-1 px-2">
												<small>Permit</small>
											</button>
										</a>
									</div>`
                }
            };
            data.push(elements)
            let urls = '{{ env('APP_URL') }}' + url
            console.log(urls)
            $('#' + id).DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: urls,
                columns: data
            });
        }
        showDataTableUserPrivilege('safety/data', ['orange_size', 'blue_size', 'shirt_size', 'mekanik_size'],
            'table-user-privilege')
    </script>
@endsection
