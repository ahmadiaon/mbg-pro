@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Pembayaran Karyawan</h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false" id="btn-year">
                            <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="refreshTable('2021',null)" href="#">2021</a>
                            <a class="dropdown-item" onclick="refreshTable('2022',null)" href="#">2022</a>
                            <a class="dropdown-item" onclick="refreshTable('2023',null)" href="#">2023</a>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false" id="btn-month" value="">
                            <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="refreshTable(null, 1 )" href="#">Januari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 2 )" href="#">Februari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 3 )" href="#">Maret</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 4 )" href="#">April</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 5 )" href="#">Mei</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 6 )" href="#">Juni</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 7 )" href="#">Juli</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 8 )" href="#">Agustus</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 9 )" href="#">September</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 10 )" href="#">Oktober</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 11 )" href="#">November</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 12 )" href="#">Desember</a>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false">
                            Menu <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a onclick="createEmployeePaymentOther()" class="dropdown-item" href="#">Tambah</a>
                            <a class="dropdown-item" id="btn-export"disabled href="/other-payment/export/">Export</a>
                            <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                                href="">Import</a>
                            {{-- <a class="dropdown-item" id="btn-import-mobilisasi" data-toggle="modal"
                                data-target="#import-modal-loading" href="">Import loading</a> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="the-table">
            <div class="pb-20" id="other-payment">
                <table id="table-other-payment" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Jenis Pembayaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    {{-- modal add user privilege --}}
    <div class="modal fade" id="createEmployeePaymentOther" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="other-payment/store" id="form-other-payment" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="uuid" id="uuid" class="form-control">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Nama Satuan
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Karyawan</label>
                            <select name="employee_uuid" id="employee_uuid" style="width: 100%"
                                class="custom-select2 form-control">
                                <option value="">karyawan</option>
                            </select>
                            <div class="invalid-feedback" id="req-employee_uuid">
                                Data tidak boleh kosong
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Satuan</label>
                                    <a href="/database/payment-other">
                                        <button type="button" class="btn btn-secondary mr-1  py-1 px-2"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="Tambah Jenis Pembayaran">
                                            <i class="icon-copy bi bi-arrow-up-right"></i>
                                        </button>
                                    </a>

                                    <select class="selectpicker form-control " name="payment_other_uuid"
                                        id="payment_other_uuid">
                                        @foreach ($payment_others as $payment_other)
                                            <option value="{{ $payment_other->uuid }}">
                                                {{ $payment_other->payment_other_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="req-payment_other_uuid">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" name="payment_other_date" id="payment_other_date"
                                        class="form-control">
                                    <div class="invalid-feedback" id="req-payment_other_date">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input type="text" name="payment_other_much" id="payment_other_much"
                                        class="form-control">
                                    <div class="invalid-feedback" id="req-payment_other_much">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="text" name="payment_other_value" id="payment_other_value"
                                        class="form-control">
                                    <div class="invalid-feedback" id="req-payment_other_value">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea class="form-control" name="payment_other_description" id="payment_other_description" cols="30"
                                rows="10"></textarea>
                            <div class="invalid-feedback" id="req-payment_other_description">
                                Data tidak boleh kosong
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" onclick="store('other-payment')" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Simple Datatable End -->
    <div class="modal fade" id="import-modal" role="dialog" aria-labelledby="import-modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-import" action="/other-payment/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import Pembayaran Lainnya</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih File Pembayaran Lainnya</label>
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
@endsection

@section('js')
    <script>
        // filter berdasarkan jenis pembayaran
        let year;
        let month;
        let v_year;
        let v_month;
        let _ur;

        cg('arr_date_today', arr_date_today);

        function firstIndexEmployeePaymentOther() {

            let year = arr_date_today.year;
            let month = arr_date_today.month;
            let v_year = arr_date_today.year;
            let v_month = arr_date_today.month;
            let _url = 'other-payment/data/' + arr_date_today.year + '-' + arr_date_today.month;
            var employees = @json($employees);
            employees.forEach(element => {
                var elements = `<option value="${element.uuid}">${element.name} - ${element.position}</option>`;
                $('#employee_uuid').append(elements);
            });

            $('#btn-year').html(arr_date_today.year);
            $('#btn-month').html(months[parseInt(arr_date_today.month)]);
            $('#btn-month').val(arr_date_today.month);
            $('#btn-export').attr('href', '/other-payment/export/' + arr_date_today.year + '-' + arr_date_today.month)
            showDataTableEmployeePaymentOther(_url, 'table-other-payment')
        }
        

        function createEmployeePaymentOther() {
            $('#createEmployeePaymentOther').modal('show');
            $('#form-other-payment')[0].reset();
        }

        function deleteData(uuid) {
            let _url = 'other-payment/delete'

            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('other-payment')
        }

        function store(idForm) {
            if (isRequired(['employee_uuid', 'payment_other_uuid', 'payment_other_description', 'payment_other_value',
                    'payment_other_much', 'payment_other_date'
                ]) > 0) {
                return false;
            }
            var isStored = globalStore(idForm)
        }

        function editData(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/other-payment/show";
            // startLoading();
            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    uuid: uuid,
                    _token: _token
                },
                success: function(response) {
                    stopLoading()
                    data = response.data
                    console.log(data)
                    $('#uuid').val(data.uuid)
                    $('#payment_other_uuid').val(data.payment_other_uuid).trigger('change');
                    $('#payment_other_description').val(data.payment_other_description)
                    $('#payment_other_much').val(data.payment_other_much)
                    $('#payment_other_date').val(data.payment_other_date)
                    $('#payment_other_value').val(data.payment_other_value)
                    $('#employee_uuid').val(data.employee_uuid).trigger('change');
                    $('#createEmployeePaymentOther').modal('show')
                },
                error: function(response) {
                    console.log(response)
                    alertModal()
                }
            });
        }

        function showDataTableEmployeePaymentOther(url, id) {

            $('#other-payment').remove();
            var table_element = ` 
            <div class="pb-20" id="other-payment">
                <table id="table-other-payment" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Jenis Pembayaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>`;

            $('#the-table').append(table_element);
            let data = [];

            let dataTable = [
                'payment_other_date',
                'payment_other_much',
                'payment_other_value',
                'payment_other_total'
            ];
            //user profile
            data.push(element_profile_employee)

            dataTable.forEach(element => {
                var dataElement = {
                    data: element,
                    name: element
                }
                data.push(dataElement)
            });

            // description
            var payment_other_description = {
                mRender: function(data, type, row) {

                    return `<button type="button" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="right"
								title="${row.payment_other_description}">
								${row.payment_other_uuid}
							</button>`
                }
            };
            data.push(payment_other_description)



            var element_action = {
                mRender: function(data, type, row) {
                    return `
									<div class="form-inline"> 
										<button onclick="editData('` + row.uuid + `')" type="button" class="btn btn-secondary mr-1  py-1 px-2">
											<i class="icon-copy ion-gear-b"></i>
										</button>
                                        <button onclick="deleteData('` + row.uuid + `')" type="button" class="btn btn-danger mr-1  py-1 px-2">
											<i class="icon-copy ion-trash-b"></i>
										</button>
									</div>`
                }
            };
            data.push(element_action)

            let urls = '/' + url
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

        function refreshTable(val_year, val_month) {
            cg('ahmadi', arr_date_today);
            year = arr_date_today.year;
            month = arr_date_today.month;

            if (val_year) {
                arr_date_today.year = val_year;
                v_year = arr_date_today.year;
                $('#btn-year').html(val_year);
            }

            if (val_month) {
                v_month = arr_date_today.month = val_month;
                $('#btn-month').html(monthName(arr_date_today.month));
                $('#btn-month').val(val_month);
            }
            $('#btn-export').attr('href', '/other-payment/export/' + arr_date_today.year + '-' + arr_date_today.month)

            let _url = 'other-payment/data/' + arr_date_today.year + '-' + arr_date_today.month;

            showDataTableEmployeePaymentOther(_url, 'table-other-payment')
            setDateSession(year, month);
        }

        //first run
        firstIndexEmployeePaymentOther();
    </script>
@endsection
