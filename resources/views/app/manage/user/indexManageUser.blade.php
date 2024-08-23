@extends('app.layouts.main')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <a href="/web/menu">
                        <h4>Manage Users</h4>
                    </a>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/web/menu">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="#">Users</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>



    {{-- datatable --}}
    <!-- Simple Datatable start -->
    <div class="card-box mb-30">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Manage User </h4>
            </div>
            <div class="col text-right">
                <div class="btn-group mb-5">
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary">
                            Export
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="importUser()">
                            Import
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-20" id="datatable">
            <table class="data-table table stripe hover nowrap" id="table-datatable">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Name</th>
                        <th class="table-plus datatable-nosort">Perusahaan</th>
                        <th class="table-plus datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-plus">
                            <div class="name-avatar d-flex align-items-center pr-2 card-box pl-2">
                                <div class="avatar mr-2 flex-shrink-0">
                                    <img src="/vendors/images/photo5.jpg" class="border-radius-100 box-shadow"
                                        width="50" height="50" alt="">
                                </div>
                                <div class="txt">
                                    <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                        style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">PT. MBLE |
                                        HAULING</span>
                                    <div class="font-14 weight-600">Dr. Callie Reed</div>
                                    <div class="font-12 weight-500">MBLE-0422003</div>
                                    <div class="font-12 weight-500" data-color="#b2b1b6" style="color: rgb(178, 177, 182);">
                                        Service Maintenance
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a onclick="editUser('MBLE-0422003')" class="btn btn-primary" href="#"><i
                                    class="dw dw-edit2"></i> Edit</a>
                        </td>
                        <td>
                            <a onclick="editUser('MBLE-0422003')" class="btn btn-primary" href="#"><i
                                    class="dw dw-edit2"></i> Edit</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <!-- Simple Datatable End -->





    <!-- Modal edit user-->
    <div class="modal fade" id="modal-edit-user" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Manage User
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <form autocomplete="off" id="form-absen" action="/user/absensi/store-absen" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- karyawan --}}
                        <div class="form-group">
                            <input type="hidden" name="nik_employee" id="nik_employee" value="MBLE-0422003">
                            <div class="name-avatar d-flex align-items-center pr-2 card-box pl-2">
                                <div class="avatar mr-2 flex-shrink-0">
                                    <img src="/vendors/images/photo5.jpg" class="border-radius-100 box-shadow"
                                        width="50" height="50" alt="">
                                </div>
                                <div class="txt">
                                    <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                        id="company_department"
                                        style="color: rgb(38, 94, 215); background-color: rgba(218, 68, 68, 0.96);">PT. MBLE
                                        |
                                        HAULING</span>
                                    <div id="name_modal" class="font-14 weight-600">Dr. Callie Reed</div>
                                    <div id="nik_employee_modal" class="font-12 weight-500">MBLE-0422003</div>
                                    <div id="position_modal" class="font-12 weight-500" data-color="#b2b1b6"
                                        style="color: rgb(178, 177, 182);">
                                        Service Maintenance
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- jenis cuti --}}
                        <div class="form-group">
                            <div class="row mb-20">
                                <div class="col-md-4">
                                    <label for="">No KTP Baru</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="nik_number" id="nik_number" class="form-control"
                                        placeholder="No KTP baru">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Level User</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="level_user" id="level_user" class="form-control"
                                        placeholder="Level User">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button id="storeUser" onclick="editStoreUser()" type="button" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- import -->
    <div class="modal fade" id="modal-import-user" role="dialog" aria-labelledby="import-modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-import-user" action="/user/absensi/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import
                            User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih File</label>
                            <input autofocus name="uploaded_file" type="file"
                                class="form-control-file form-control height-auto" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" onclick="storeImportUser()"
                            class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection()

@section('script_javascript')
    {{-- pin max --}}
    <script>
        let database = JSON.parse(localStorage.getItem('DATABASE'));


        $(document).ready(function() {
            //show to list

            // field header table
            let row_data_datatable = [];
            let header_table_element = '';
            let header_table_field = [
                'Karyawan',
                'Perusahaan',
                'Project',
                'Department',
                'Divisi',
                'Feature',
            ];



            /*
                1. clear table
                2. create header
                3. add row
            
            */


            //  clear table  
            $('#datatable').empty();

            // create header table                    
            header_table_field.forEach(element => {
                header_table_element = `${header_table_element} <th> ${element} </th>`
            });

            header_table_element = `                    
                            <table id="table-datatable" class="display nowrap stripe hover table" style="width:100%">
                                <thead>
                                    <tr>
                                        ${header_table_element}
                                    </tr>
                                </thead>
                            </table>
                        `;

            $('#datatable').append(header_table_element);



            //add row data datatable
            var employees_card_element = {
                mRender: function(data, type, row) {
                    return emmp(row)
                }
            };
            row_data_datatable.push(employees_card_element);


            var company_element = {
                mRender: function(data, type, row) {
                    return `<div class="row">
                                <div class="col-12 mb-10">
                                    <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7" style="color: rgba(10, 11, 2, 0.97); background-color: rgba(237, 255, 46, 0.97);">PT. MB</span>
                                </div>
                                <div class="col-12 mb-10">
                                    <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7" style="color: rgba(10, 11, 2, 0.97); background-color: #f56767;">PT. MBLE</span>
                                </div>
                                <div class="col-12">
                                    <span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7" style="color: rgba(10, 11, 2, 0.97); background-color: rgba(237, 255, 46, 0.97);">Ubah <i class="icon-copy bi bi-arrow-counterclockwise"></i></span>
                                </div>
                            </div>`;


                }
            };
            row_data_datatable.push(company_element);

            var project_element = {
                mRender: function(data, type, row) {
                    return `<span  onclick="editUser('${row}')" class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7" style="color: rgba(10, 11, 2, 0.97); background-color: rgba(237, 255, 46, 0.97);">Ubah NIK</span>`;
                }
            };
            row_data_datatable.push(project_element);

            var department_element = {
                mRender: function(data, type, row) {
                    return `<span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7" style="color: rgba(10, 11, 2, 0.97); background-color: rgba(237, 255, 46, 0.97);">Ubah</span>`;
                }
            };
            row_data_datatable.push(department_element);

            var divisi_element = {
                mRender: function(data, type, row) {
                    return `<span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7" style="color: rgba(10, 11, 2, 0.97); background-color: rgba(237, 255, 46, 0.97);">Ubah</span>`;
                }
            };
            row_data_datatable.push(divisi_element);
            var feature_element = {
                mRender: function(data, type, row) {
                    return `<span class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7" style="color: rgba(10, 11, 2, 0.97); background-color: rgba(237, 255, 46, 0.97);">Ubah</span>`;
                }
            };
            row_data_datatable.push(feature_element);

            data_datatable = Object.keys(db['db']['database_data']['KARYAWAN']);
            $('#table-datatable').DataTable({
                paging: true,
                serverSide: false,
                data: data_datatable,
                columns: row_data_datatable
            });


            // Menggunakan event input untuk mengawasi perubahan pada input
            $('#form-user').on('input', '.pinNumber', function() {
                // Mendapatkan nilai input
                var inputValue = $(this).val();

                // Pindah ke input berikutnya jika digit telah dimasukkan
                var sanitizedValue = $(this).val().replace(/[^0-9]/g, '');

                // Menetapkan nilai bersih kembali ke input
                $(this).val(sanitizedValue);
                inputValue = $(this).val();
                if (inputValue.length === 1) {
                    $(this).next('.pinNumber').focus();
                }
            });
        });
    </script>

    <script>
        function editUser(nik_employee) {

            conLog('nik_employee', db['public']['public_value']['KARYAWAN'][nik_employee])
            $('#nik_employee').val(`${nik_employee}`)
            $('#company_department').text(
                `${db['public']['public_value']['KARYAWAN'][nik_employee]['NAMA-KARYAWAN']}`
            )
            $('#name_modal').text(`${db['public']['public_value']['KARYAWAN'][nik_employee]['NAMA-KARYAWAN']}`)
            $('#nik_number').val(`${db['public']['public_value']['KARYAWAN'][nik_employee]['NIK-KTP']}`)
            $('#nik_employee_modal').text(db['public']['public_value']['KARYAWAN'][nik_employee]['NRP'])
            $('#position_modal').text(db['public']['public_value']['KARYAWAN'][nik_employee]['JABATAN'])

            $('#modal-edit-user').modal('show');
        }

        function editStoreUser() {
            $('#modal-edit-user').modal('show');
            startLoading();
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/api/mbg/manage/users/edit',
                type: "POST",
                async: false,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    nik_employee: $(`#nik_employee`).val(),
                    nik_number: $(`#nik_number`).val()
                },
                success: function(response) {
                    conLog('response', response)
                    showModalSuccess();



                },
                error: function(response) {
                    conLog('error', response)
                    //alertModal()
                }
            });
        }

        function importUser() {
            $('#modal-import-user').modal('show');
        }

        function storeImportUser(){
            var form = $('#form-import-user')[0];
            var form_data = new FormData(form);
            $.ajax({
                url: '/web/manage/import-user',
                type: "POST",
                contentType: false,
                processData: false,
                data: form_data,
                success: function(response) {
                    $('#loading-modal').modal('hide');
                    conLog('response', response);
                    
                    $('#loading-modal').modal('hide');
                },
                error: function(response) {
                    conLog('errr', response);
                }
            });
        }
    </script>
@endsection()
