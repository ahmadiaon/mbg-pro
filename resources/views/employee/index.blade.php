@extends('template.admin.main_privilege')

@section('content')
<div class="the-content">
    <div id="index-employee" class="children-content">
        <div class="card-box mb-30 ">
            <div class="row pd-20">
                <div class="col-auto">
                    <h4 class="text-blue h4">Karyawan</h4>
                </div>
                <div class="col text-right"
                    <div class="btn-group">
                        <div class="btn-group dropdown">
                            <button onclick="create()" type="date" class="btn btn-danger" data-toggle="dropdown"
                                aria-expanded="false">
                                Export Data <span class="caret"></span>
                            </button>
                        </div>
                        @if (!empty(session('dataUser')->create_employee))
                            <div class="btn-group dropdown">
                                <button onclick="create()" type="date" class="btn btn-secondary" data-toggle="dropdown"
                                    aria-expanded="false">
                                    Tambah Karyawan <span class="caret"></span>
                                </button>
                            </div>
                        @endif
                        <div class="btn-group dropdown">
                            <button type="date" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown"
                                aria-expanded="false">
                                Menu <span class="caret"></span>
                            </button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" id="btn-export"disabled href="/user/export-simple/">Template Simpel </a>
                                <a class="dropdown-item" id="btn-export"disabled href="/user/export-full/">Template Full </a>
                                <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                    href="">Import</a>
                            </div>
                        </div>

                    </div>
                </div>

            
            <div class="pb-20" id="tablePrivilege">
                <table id="table-privilege" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Status Karyawan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- Simple Datatable End -->

        {{-- modal add user privilege --}}
        <div class="modal fade bs-example-modal-lg" id="createModal" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Eksport Data Karyawan
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="form-group">
                        <select name="" id="">

                        </select>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Simple Datatable End -->
        <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form id="form-import" action="/user/import" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Import Karawan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Pilih Karawan</label>
                                <input name="uploaded_file" type="file"
                                    class="form-control-file form-control height-auto" />
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
    </div>
    <div id="create-user-detail" class="children-content">
        <form action="/user/store" id="form-user-detail" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="user_detail_uuid" id="user_detail_uuid">
            <input type="text" name="isEdit" id="isEdit">

            <div class="min-height-200px">
                <div class="pd-20 card-box mb-20">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Identitas Karyawan</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="pd-20 card-box mb-30">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input name="name" class="form-control" value="" id="name"
                                        placeholder="Ahmadi Alpasyri" type="text">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input name="nik_number" class="form-control" value="" id="nik_number"
                                                placeholder="6210000" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Nomor Kartu Keluarga</label>
                                                <input name="kk_number" class="form-control" value=""
                                                    id="kk_number" placeholder="62111" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kewarganegaraan</label>
                                            <select name="citizenship" id="citizenship"
                                                class="selectpicker form-control">
                                                <option value="WNI">WNI</option>
                                                <option value="WNA">WNA</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <select name="religion_uuid" id="religion_uuid" class="selectpicker form-control">
                                                @foreach ($religions as $religion)
                                                    <option value="{{ $religion->uuid }}">{{ $religion->religion }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input name="place_of_birth" class="form-control" value=""
                                                id="place_of_birth" placeholder="Muara Teweh" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input name="date_of_birth" id="date_of_birth" class="form-control"
                                                placeholder="Select Date" type="date" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Golongan Darah</label>
                                            <select name="blood_group" class="selectpicker form-control">
                                                <option value="unknown">
                                                    Tak Diketahui</option>
                                                <option value="A">A
                                                </option>
                                                <option value="B">B
                                                </option>
                                                <option value="AB">
                                                    AB
                                                </option>
                                                <option value="O">O
                                                </option>

                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" id="status"class="selectpicker form-control">
                                                <option value="Lajang">
                                                    Lajang</option>
                                                <option value="Menikah">
                                                    Menikah</option>
                                                <option value="Duda">
                                                    Duda
                                                </option>
                                                <option value="Janda">
                                                    Janda</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" id="gender" class="selectpicker form-control">
                                                <option value="Laki-laki">
                                                    Laki-laki</option>
                                                <option value="Perempuan">
                                                    Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pd-20 card-box mb-30">
                                {{-- norek --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor Rekening</label>
                                            <input name="financial_number" class="form-control " value=""
                                                id="financial_number" placeholder="000" type="text">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Rekening</label>
                                            <input name="financial_name" class="form-control " value=""
                                                id="financial_name" placeholder="Ahmadi" type="text">

                                        </div>
                                    </div>
                                </div>
                                {{-- nohap --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nomor Handphone</label>
                                            <input name="Nomor HP" class="form-control" value=""
                                                id="Nomor HP" placeholder="Nomor HP" type="text">
                                        </div>
                                    </div>
                                </div>
                                {{-- npwp --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nomor NPWP</label>
                                            <input name="npwp_number" class="form-control" value=""
                                                id="npwp_number" placeholder="Nomor NPWP" type="text">
                                        </div>
                                    </div>
                                </div>
                                {{-- bpjs --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>BPJS Ketenagakerjaan</label>
                                            <input name="bpjs_ketenagakerjaan" class="form-control" value=""
                                                id="bpjs_ketenagakerjaan" placeholder="Muara Teweh" type="text">

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label>BPJS kesehatan</label>
                                            <input name="bpjs_kesehatan" class="form-control" value=""
                                                id="bpjs_kesehatan" placeholder="Muara Teweh" type="text">

                                        </div>
                                    </div>
                                </div>
                                <button type="button" onclick="store('user-detail')"
                                    class="btn btn-primary mt-30 float-right">Next
                                    Step</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
    <script>
        function showDataTableUser(url,dataTable,id){	
			let data	=[];
			
			data.push(element_profile_employee)

			dataTable.forEach(element => {
				var dataElement = {data: element, name:element}
				data.push(dataElement)
			});
			
			var elements = {
					mRender: function (data, type, row) {						
						return `
									<div class="form-inline"> 
										<button onclick="show('`+ row.nik_employee +`')" type="button" class="btn btn-info mr-1  py-1 px-2">
											<i class="icon-copy ion-android-list"></i>
										</button>										
									</div>`
					}
				};
			data.push(elements)

            console.log(url)
				$('#'+id).DataTable({
					processing: true,
					serverSide: false,
					responsive: true,
						rowReorder: {
							selector: 'td:nth-child(2)'
						},
					ajax: url,
					columns:  data
				});			
		}

        showDataTableUser('/user/data', ['employee_status'], 'table-privilege')

        function create() {
            location.href = '/user/create';
        }

        function show(nik_employee) {
            location.href = '/user/profile/' + nik_employee;
        }


    </script>
@endsection
