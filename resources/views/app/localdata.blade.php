@extends('app.layouts.main')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Local Data</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/web/menu">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Menu
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    {{-- datatable --}}
    <!-- Simple Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20 row">
            <h4 class="col-auto text-blue h4">Manage User</h4>
            <div class="col text-right">
                <div class="btn-group">
                    <button class="btn btn-primary" id="btn-store-menu">Tambah</button>
                </div>
            </div>
        </div>
        <div class="pb-20" id="datatable">
            <table class="data-table table stripe hover nowrap" id="table-datatable">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Menu</th>
                        <th class="table-plus">Order</th>
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
                            1
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
    <div class="modal fade" id="modal-store-menu" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header row">
                    <h4 class="modal-title col-auto" id="myLargeModalLabel">
                        Form Kelola Menu
                    </h4>

                    <div class="col text-right">
                        <div class="btn-group">
                            <button id="delete-menu" class="btn btn-danger"><i class="dw dw-delete-3"></i></button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">
                                <i class="icon-copy bi bi-x-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <form autocomplete="off" id="form-store-menu" action="/api/mbg/manage/menu" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- jenis cuti --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Nama Menu</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" class="menu" name="uuid" id="uuid">
                                    <input type="text" name="description" id="description" class="form-control menu"
                                        placeholder="">
                                </div>
                            </div>
                        </div>


                        {{-- jenis cuti --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Urutan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="number_sort" id="number_sort" class="form-control menu"
                                        placeholder="">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button id="store-menu" type="button" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection()

@section('script_javascript')
    <script>
        
        $(document).ready(function() {
            refreshTable();
            $('button[id="btn-store-menu"]').click(function() {
                $('.menu').val("");
                $('#modal-store-menu').modal('show');
                $('#delete-menu').hide();
            });

            $('button[id="delete-menu"]').click(function() {
                $.ajax({
                    url: '/api/mbg/manage/menu/delete',
                    type: "POST",
                    async: false,
                    headers: {
                        'x-auth-login': @json(session('user_authentication'))
                        // Add other custom headers if needed
                    },
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        uuid: $('#uuid').val(),
                    },
                    success: function(response) {
                        showModalSuccess();
                        refreshTable();
                    },
                    error: function(response) {
                        conLog('error', response)
                    }
                });
            });
        });
    </script>
@endsection()
