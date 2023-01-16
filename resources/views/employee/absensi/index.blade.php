@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 " >
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Absensi Karyawan per bulan</h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <button
                            type="button"
                            class="btn btn-secondary dropdown-toggle waves-effect"
                            data-toggle="dropdown"
                            aria-expanded="false"
                            id="btn-year"
                        >
                             <span class="caret"></span>
                        </button>
                        
                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="refreshTable(2021,null)" href="#">2021</a>
                            <a class="dropdown-item" onclick="refreshTable(2022,null)" href="#">2022</a>                            
                            <a class="dropdown-item" onclick="refreshTable(2023,null)" href="#">2023</a>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <button
                            type="button"
                            class="btn btn-secondary dropdown-toggle waves-effect"
                            data-toggle="dropdown"
                            aria-expanded="false"
                            id="btn-month"
                            value=""
                        >
                             <span class="caret"></span>
                        </button>
                        
                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="refreshTable(null, 01 )" href="#">Januari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 02 )" href="#">Februari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 03 )" href="#">Maret</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 04 )" href="#">April</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 05 )" href="#">Mei</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 06 )" href="#">Juni</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 07 )" href="#">Juli</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 08 )" href="#">Agustus</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 09 )" href="#">September</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 10 )" href="#">Oktober</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 11 )" href="#">November</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 12 )" href="#">Desember</a>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <button
                            type="button"
                            class="btn btn-primary dropdown-toggle waves-effect"
                            data-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Menu <span class="caret"></span>
                        </button>
                        
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="btn-export" href="/user/absensi/export/">Export + Data</a>
                            <a class="dropdown-item" id="btn-export-template" href="/user/absensi/export-template/">Export Template</a>
                            <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal" href="">Import</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div id="the-table">
            <div class="pb-20" id="tablePrivilege">
                <table id="table-privilege" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Dibayar</th>
                            <th>Potongan</th>
                           
                            <th>Nama</th>
                             <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        
    </div>
    <!-- Simple Datatable End -->
    <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="form-import" action="/user/absensi/import" method="post" enctype="multipart/form-data">
            @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Import Absensi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih Absensi</label>
                    <input name="uploaded_file"
                        type="file"
                        class="form-control-file form-control height-auto"
                    />
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" onclick="startLoading()" class="btn btn-primary">Upload</button>
            </div>
          </div>
        </form>
        </div>
      </div>
@endsection

@section('js')
    <script>
        
        let year = @json($year);
        let month = @json($months);
        let v_year;
        let v_month;
        $('#btn-year').html( year);
        $('#btn-month').html( months[month]);
        $('#btn-month').val( month);
        $('#btn-export').attr('href', '/user/absensi/export/'+year+'-'+month)
        $('#btn-export-template').attr('href', '/user/absensi/export-template/'+year+'-'+month)
        // $('#form-import').attr('href', '/user/absensi/import)
        
        let year_month = @json($month);
        console.log('year:'+year_month)
        let _url = 'user/absensi/data/'+year_month;
        showDataTableUserPrivilege(_url, [ 'pay', 'cut','name'], 'table-privilege')

        

        console.log(months);
        function showDataTableUserPrivilege(url,dataTable,id){	
			let data	=[];
			var elements = {
					mRender: function (data, type, row) {
						if(row.photo_path == null){
							row.photo_path = '/vendors/images/photo4.jpg';
						}
						if(row.photo_path == null){
							row.photo_path = '/vendors/images/photo4.jpg';
						}
						return `<div class="name-avatar d-flex align-items-center">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="${row.photo_path}" class="border-radius-100 shadow" width="40"
												height="40" alt="" />
										</div>
										<div class="txt">
											<div class="weight-600">${row.name}</div>
                                            <span>${row.position}</span>
                                            <div class="weight-600">${row.nik_employee}</div>
										</div>
									</div>`
					}
				};
			data.push(elements)
			dataTable.forEach(element => {
				var dataElement = {data: element, name:element}
				data.push(dataElement)
			});
			
			var elements = {
					mRender: function (data, type, row) {
						v_year = $('#btn-year').html();
                        v_month = $('#btn-month').val();
                        v_month = ("0" + v_month).slice(-2);
						return `
									<div class="form-inline"> 
                                        <a href="/user/absensi/detail/${v_year}-${v_month}/${row.nik_employee}">
										<button type="button" class="btn btn-secondary mr-1  py-1 px-2">
											<i class="dw dw-edit2"></i>
										</button>
                                        </a>
									</div>`
					}
				};
			data.push(elements)

			let urls = '{{env('APP_URL')}}'+url
			console.log(urls)
				$('#'+id).DataTable({
					processing: true,
                    columnDefs: [
                                        { "visible": false, "targets": 3 }
                                    ],
					serverSide: false,
					responsive: true,
						rowReorder: {
							selector: 'td:nth-child(2)'
						},
					ajax: urls,
					columns:  data
				});			
		}
       
        function refreshTable(val_year = null, val_month = null){
            console.log(val_year);
            v_year = $('#btn-year').html();
            v_month = $('#btn-month').val();
            console.log(v_month);   
            if(val_year){
                console.log(val_year);    
                v_year = val_year    ;
                $('#btn-year').html( val_year);       
            }
            if(val_month){
                v_month =val_month;
                console.log(val_month);    
                $('#btn-month').html( months[val_month]);          
                $('#btn-month').val(val_month); 
            }
            $('#tablePrivilege').remove();
            var table_element = ` 
                                         <div class="pb-20" id="tablePrivilege">
                                            <table id="table-privilege" class="display nowrap stripe hover table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Dibayar</th>
                                                        <th>Potongan</th>
                                                       
                                                        <th>Nama</th>
                                                         <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>`;
            
             $('#the-table').append(table_element);
            // let year_month = @json($month);
            // console.log('year:'+year_month)
            v_month = ("0" + v_month).slice(-2);
            let year_month = v_year+'-'+v_month;
            $('#btn-export').attr('href', '/user/absensi/export/'+v_year+'-'+v_month)
            $('#btn-export-template').attr('href', '/user/absensi/export-template/'+v_year+'-'+v_month)
            console.log('year:'+year_month)
            let _url = 'user/absensi/data/'+year_month;
            showDataTableUserPrivilege(_url, [ 'pay', 'cut','name'], 'table-privilege')
        }
    </script>
@endsection
