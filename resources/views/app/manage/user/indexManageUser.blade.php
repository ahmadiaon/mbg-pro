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
        <div class="pb-20">
            <table class="data-table table stripe hover nowrap">
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
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <!-- Simple Datatable End -->





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
                            <label for="">Karyawan</label>
                            <input type="text" name="nik_employee" id="nik_employee" value="MBLE-0422003">
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
        $(document).ready(function() {

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
                    _token: _token,
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
