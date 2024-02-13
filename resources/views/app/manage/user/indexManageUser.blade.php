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
        <div class="pd-20">
            <h4 class="text-blue h4">Manage User</h4>
        </div>
        <div class="pb-20" id="datatable">
            <table class="data-table table stripe hover nowrap" id="table-datatable">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Name</th>
                        <th class="datatable-nosort">Action</th>
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
                                    <div class="font-12 weight-500" data-color="#b2b1b6"
                                        style="color: rgb(178, 177, 182);">
                                        Service Maintenance
                                    </div>
                                </div>
                            </div>
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

    <div class="dropdown show">
        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="true">
            <i class="dw dw-more"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list show" x-placement="bottom-end" style="position: absolute; transform: translate3d(-26px, 22px, 0px); top: 0px; left: 0px; will-change: transform;">
            <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
            <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
            <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
        </div>
    </div>



    <!-- Modal ketidakhadiran-->
    <div class="modal fade" id="create-absen" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Ubas Data Akun
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
                                        style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">PT. MBLE |
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
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">No KTP Baru</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="nik_number" id="nik_number" class="form-control"
                                        placeholder="No KTP baru">
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
@endsection()

@section('script_javascript')
    {{-- pin max --}}
    <script>
        let database = JSON.parse(localStorage.getItem('DATABASE'));


        function cardEmployees(nik_employee) {
            return `
                <div class="name-avatar d-flex align-items-center pr-2 card-box pl-2">
                    <div class="avatar mr-2 flex-shrink-0">
                        <img src="/vendors/images/photo5.jpg" class="border-radius-100 box-shadow"
                            width="50" height="50" alt="">
                    </div>
                    <div class="txt">
                        <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                            style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">${database['employees'][nik_employee]['company']} |
                            ${database['employees'][nik_employee]['department']}</span>
                        <div class="font-14 weight-600">${database['employees'][nik_employee]['name']}</div>
                        <div class="font-12 weight-500">${database['employees'][nik_employee]['nik_employee_with_space']}</div>
                        <div class="font-12 weight-500" data-color="#b2b1b6" style="color: rgb(178, 177, 182);">
                            ${database['employees'][nik_employee]['position']}
                        </div>
                    </div>
                </div>
            `;
        }


        $(document).ready(function() {
            //show to list

            // field header table
            let row_data_datatable = [];
            let header_table_element = '';
            let header_table_field = ['Karyawan', 'Action'];



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
                    return cardEmployees(row)
                }
            };
            row_data_datatable.push(employees_card_element);

            var action_button_element = {
                mRender: function(data, type, row) {
                    return `
                            <button onclick="editUser('${row}')" type="button" class="btn btn-primary">
                                <i class="icon-copy bi bi-gear"></i>
                            </button>
                            `
                }
            };
            row_data_datatable.push(action_button_element);

            $.ajax({
                url: '/api/mbg/manage/employees/get',
                type: "POST",
                async: false,
                headers: {
                    'auth_login': @json(session('user_authentication'))
                    // Add other custom headers if needed
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    nik_employee: null
                },
                success: function(response) {
                    let data_datatable = response.data;
                    $('#table-datatable').DataTable({
                        paging: true,
                        serverSide: false,
                        data: data_datatable,
                        columns: row_data_datatable
                    });
                },
                error: function(response) {
                    conLog('error', response)
                    //alertModal()
                }
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
        /*
                        get from database karyawan, list karyawan dari card.

                    */



        function editUser(nik_employee) {

            $('#nik_employee').val(`${nik_employee}`)
            $('#company_department').text(
                `${database['employees'][nik_employee]['company']} | ${database['employees'][nik_employee]['department']}`
                )
            $('#name_modal').text(`${database['employees'][nik_employee]['name']}`)
            $('#nik_employee_modal').text(database['employees'][nik_employee]['nik_employee_with_space'])
            $('#position_modal').text(database['employees'][nik_employee]['position'])

            $('#create-absen').modal('show');
        }

        function editStoreUser() {
            $('#create-absen').modal('show');
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
    </script>
@endsection()
