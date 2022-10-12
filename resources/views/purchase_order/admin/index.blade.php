@extends('template.admin.main')
@section('css')
    <style>
        .modal-confirm {
            color: #636363;
            width: 400px;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            text-align: center;
            font-size: 14px;
        }

        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }

        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }

        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }

        .modal-confirm .modal-body {
            color: #999;
        }

        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            padding: 10px 15px 25px;
        }

        .modal-confirm .modal-footer a {
            color: #999;
        }

        .modal-confirm .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f15e5e;
        }

        .modal-confirm .icon-box i {
            color: #f15e5e;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }

        .modal-confirm .btn,
        .modal-confirm .btn:active {
            color: #fff;
            border-radius: 4px;
            background: #60c7c1;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            border-radius: 3px;
            margin: 0 5px;
        }

        .modal-confirm .btn-secondary {
            background: #c1c1c1;
        }

        .modal-confirm .btn-secondary:hover,
        .modal-confirm .btn-secondary:focus {
            background: #a8a8a8;
        }

        .modal-confirm .btn-danger {
            background: #f15e5e;
        }

        .modal-confirm .btn-danger:hover,
        .modal-confirm .btn-danger:focus {
            background: #ee3535;
        }

        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }
    </style>
@endsection
@section('content')
    <div class="card-box mb-30 ">
        <div class="row mb-30 pd-20">
            <div class="col-3">
                <h4 class="text-blue h4">Pembayaran</h4>
            </div>
            <div class="col-9 text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <a href="/purchase-order/create">
                            <button class="btn btn-primary mr-10">Tambah</button>
						</a>                     
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-20">
            <table id="myTablse" class="display nowrap pd-10" style="width:100%">
                <thead>
                    <tr>
                        <th>Nomor PO</th>
                        <th>Tanggal</th>
                        <th>Dokumen</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Simple Datatable End -->
    <!-- Modal -->
    <div class="modal fade" id="doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Document</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>                    
                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <iframe id="path_doc" src="" style="width:100%; height:500px;" frameborder="0"></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- delete modal --}}
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="icon-copy ion-android-delete"></i>
                    </div>
                    <input type="hidden" id="uuid" name="uuid">
                    <h4 class="modal-title w-100">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button onclick="deleteItem()" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- success modal --}}
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Data Tersimpan</h3>
                    <div class="mb-30 text-center">
                        <img src="{{ env('APP_URL') }}vendors/images/success.png" />
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        Done
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $( document ).ready(function() {
            $('.sorting_1').addClass('table-plus')
            
        });
        function showdoc(path) {
            $('#path_doc').attr("src", "{{ env('APP_URL') }}purchase/pdf/" + path)
            $('#doc').modal('show')
        }
        $(function() {
            $('#myTablse').DataTable({
                processing: true,
                // responsive: true,
                serverSide: true,
                ajax: '{{ url(env('APP_URL') . 'purchase-order/data') }}',
                columns: [{
                        data: 'po_number',
                        name: 'po_number'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'document',
                        name: 'document'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        });

        function deleteItem() {
            var uuid = $('#uuid').val()
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/purchase-order/delete";

            $.ajax({
                url: _url,
                type: "POST",

                data: {
                    uuid: uuid,
                    _token: _token
                },
                success: function(response) {
                    data = response.data
                    console.log('deleted')
                    $('#myModal').modal('hide')
                    $('#success-modal').modal('show')
                    window.location.href = "/purchase-order"
                    console.log(data)
                },
                error: function(response) {
                    console.log(response)
                }
            });
        }

        function confirmDelete(uuid) {
            console.log(uuid);
            $('#myModal').modal('show')
            $('#uuid').val(uuid)
        }
    </script>
@endsection
