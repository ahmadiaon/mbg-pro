@extends('template.admin.main_privilege')

@section('content')
    <div class="the-content">
        <div id="index-employee" class="children-content">
            <div class="card-box mb-30 ">
                <div class="row pd-20">
                    <div class="col-auto">
                        <h4 class="text-blue h4">Daftar Karyawana</h4>
                    </div>
                    <div class="col text-right" <div class="btn-group">
                        <div class="btn-group dropdown">
                            <button onclick="exportData()" type="date" class="btn btn-danger" data-toggle="dropdown"
                                aria-expanded="false">
                                Export Data <span class="caret"></span>
                            </button>
                        </div>
                        @if (!empty(session('dataUser')->create_employee))
                            <div class="btn-group dropdown">
                                <button onclick="choosePage('create-user-detail', null)" 
                                    class="btn btn-secondary" aria-expanded="false">
                                    Tambah Karyawan <span class="caret"></span>
                                </button>
                            </div>
                        @endif
                        <div class="btn-group dropdown">
                            <button type="date" class="btn btn-primary dropdown-toggle waves-effect"
                                data-toggle="dropdown" aria-expanded="false">
                                Menu <span class="caret"></span>
                            </button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" id="btn-export" href="/user/export-simple/">Template Simpel
                                </a>
                                <a class="dropdown-item disabled" id="btn-export" href="#">Template Full
                                </a>
                                <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                    href="">Import</a>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="pb-20" id="table-user">
                    <table id="table-privilege" class="display nowrap stripe hover table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Status Karyawan</th>
                                <th>Perusahaan</th>
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
    </div>
@endsection

@section('js')
    <script>
        let filter = {
            employee_status:'Training'
        };

        function showDataTableUser(url, id) {
            let data_ = [];
            let date_today = getDateToday();
            let dataTable= [ 'company_uuid','date_document_contract','date_start_contract','date_end_contract'];
            cg('today',date_today);
            $('#table-user').empty();

            $('#table-user').append(
                ` <table id="table-privilege" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Perusahaan</th>     
                                          
                            <th>Awal Kerja</th>     
                            <th>Awal Kontrak</th>                           
                            <th>Berakhir Kontrak</th>
                              
                            <th>Sisa Hari</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>`
            )

            data_.push(element_profile_employee)

            dataTable.forEach(element => {
                var dataElement = {
                    data: element,
                    name: element
                }
                data_.push(dataElement)
            });
            var elements = {
                mRender: function(data, type, row) {
                    let diff = countBetweenDate(date_today, row.date_end_contract);
                   if(row.contract_status == 'PKWTT'){
                        diff = 'PKWTT';
                   }
                   if(row.date_end_contract == null){
                        diff = 'kosong';
                   }
                   
                    return diff
                }
            };
            data_.push(elements)
            var elements = {
                mRender: function(data, type, row) {
                    return `
                                <div class="form-inline"> 
                                    <button onclick="choosePage('show-employee','` + row.nik_employee + `')" type="button" class="btn btn-info mr-1  py-1 px-2">
                                        <i class="icon-copy ion-android-list"></i>
                                    </button>										
                                </div>`
                }
            };
            data_.push(elements)

            $('#' + id).DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: {
                    url: '/user/data',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        filter: filter
                    },
                    // success: function(response) {
                    //     // $('#success-modal').modal('show')
                    //     console.log(response)
                    // },
                    // error: function(response) {
                    //     alertModal()
                    // },
                    type: 'POST',
                },
                
                    
                columns: data_
            });
        }

        function firstIndexEmployee(data) {
            showDataTableUser('/user/data', 'table-privilege');
        }

        // JS RUN
        firstIndexEmployee();
    </script>
@endsection
