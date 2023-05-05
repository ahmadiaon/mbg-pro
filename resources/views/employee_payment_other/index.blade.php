@extends('template.admin.main_privilege')

@section('content')
    <div class="mb-20 row">
        {{-- form filter --}}
        <div class="col-md-5 mb-10">
            <div class="card-box pd-20" id="the-filter-employee-tonase">
                <h4 class="text-blue h4">Filter</h4>

                <div class="form-group row mb-20">
                    <label class="col-auto" for="">Perusahaan</label>
                    <div class="col text-right custom-control custom-checkbox mb-5">
                        <input onchange="checkedAll('company')" type="checkbox" class="custom-control-input"
                            id="checked-all-company">
                        <label class="custom-control-label" for="checked-all-company">Pilih
                            Semua</label>
                    </div>
                    <div class="col-12 justify-content-md-center row company-filter">

                    </div>
                </div>

                <div class="form-group row mb-20">
                    <label class="col-auto" for="">Site</label>
                    <div class="col text-right custom-control custom-checkbox mb-5">
                        <input onchange="checkedAll('site_uuid')" type="checkbox" class="custom-control-input"
                            id="checked-all-site_uuid">
                        <label class="custom-control-label" for="checked-all-site_uuid">Pilih
                            Semua</label>
                    </div>
                    <div class="col-12 justify-content-md-center row site-filter">

                    </div>
                </div>

                {{-- rentang wAKTU --}}
                <div class="form-group row">
                    <label class="col-md-12 text-center">Rentang Waktu</label>
                    <div class="col-md-6">
                        <select onchange="loopDateFilter()" style="width: 100%;" name="date_start_filter_range"
                            id="date_start_filter_range" class="custom-select2 form-control">
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select style="width: 100%;" name="date_end_filter_range" id="date_end_filter_range"
                            class="custom-select2 form-control">
                        </select>
                    </div>
                </div>

                <button onclick="onSaveFilter()" type="button" class="col-md-auto btn btn-primary text-rigth">
                    Simpan
                </button>
            </div>
        </div>
    </div>

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
                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect"
                            data-toggle="dropdown" aria-expanded="false">
                            Menu <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a onclick="createEmployeePaymentOther()" class="dropdown-item" href="#">Tambah</a>
                            <a class="dropdown-item" id="btn-export"disabled href="/other-payment/export">Export</a>
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
              
            </div>
        </div>
    </div>

    {{-- modal add user privilege --}}
    <div class="modal fade" id="createEmployeePaymentOther" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
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
                                class="custom-select2 form-control employees">
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
        let nik_employee = null;
        var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
        var end = new Date(arr_date_today.year, arr_date_today.month, 0);
        let value_checkbox = {
            'company': null,
            'site_uuid': null
        };

        let arr_filter = {
            'company': [],
            'site_uuid': []
        };

        let filter = {
            'value_checkbox': [],
            'show_type': 'employee',
            'arr_filter': {
                'company': [],
                'site_uuid': []
            },

            'date_filter': {
                date_start_filter_range: formatDate(start),
                date_end_filter_range: formatDate(end),
            },
            nik_employee: nik_employee
        };

        function loopDateFilter() {
            cg('loopDateFilter', arr_date_today);
            var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
            var end = new Date(arr_date_today.year, arr_date_today.month, 0);
            cg(start, end);

            var loop = new Date(start);

            let date_start_filter_range = $('#date_start_filter_range').val();
            $(`#date_end_filter_range`).empty();
            if (!date_start_filter_range) {
                $(`#date_start_filter_range`).empty();
            }

            cg('date_start_filter_range', date_start_filter_range);
            cg('loop', loop)
            var loop_date_start = new Date(date_start_filter_range);
            if (loop_date_start) {
                loop_date_start.setDate(loop_date_start.getDate() - 1);
            }
            while (loop <= end) {
                // cg('stert', loop);
                if (date_start_filter_range) {
                    if (loop >= loop_date_start) {
                        $(`#date_end_filter_range`).prepend(` <option>${formatDate(loop)}</option>`)
                    }
                } else {
                    $(`#date_start_filter_range`).append(` <option>${formatDate(loop)}</option>`);
                    $(`#date_end_filter_range`).prepend(` <option>${formatDate(loop)}</option>`)
                }
                var newDate = loop.setDate(loop.getDate() + 1);
                loop = new Date(newDate);
            }
            // $('#date_start_filter_range').val(formatDate(start));
            $('#date_end_filter_range').val(formatDate(end));
        }




        function checkedAll(name) {
            cg('name', name);
            let isAllChecked = $('#checked-all-' + name)[0].checked;
            if (isAllChecked) {
                arr_filter[name] = value_checkbox[name];
                $('.element-' + name).prop('checked', true);

            } else {
                $('.element-' + name).prop('checked', false);
                arr_filter[name] = [];
            }
            cg('arr_coal_from', arr_filter);
        }



        function changeChecked(idEl_, uuid, name) {
            cg('name', name);
            let value_id = $(`input[type='checkbox'][name='${idEl_}']:checked`).val();
            if (value_id) {
                arr_filter[name].push(value_id);
            } else {
                const index = arr_filter[name].indexOf(uuid);
                const x = arr_filter[name].splice(index, 1);
            }
            cg('arr_filter', arr_filter);
        }

        function onSaveFilter() {


            let date_filter = {
                date_start_filter_range: $('#date_start_filter_range').val(),
                date_end_filter_range: $('#date_end_filter_range').val(),
            };
            filter.date_filter = date_filter;
            filter.arr_filter = arr_filter;
            filter.show_type = $("input[type='radio'][name='show_type']:checked").val();

            cg('onSaveFilter', filter);
            showDataTableEmployeePaymentOther()
        }



        // filter berdasarkan jenis pembayaran
        let year;
        let month;
        let v_year;
        let v_month;
        let _ur;

        cg('arr_date_today', arr_date_today);

        function firstIndexEmployeePaymentOther() {
            let arrrr = [];
            Object.values(data_database.data_companies).forEach(company_uuid_element => {
                $('.company-filter').append(`
                    <div class="col-auto">
                        <div class="custom-control custom-checkbox mb-5">
                            <input onchange="changeChecked('filter-company-${company_uuid_element.uuid}','${company_uuid_element.uuid}', 'company')" type="checkbox" class="custom-control-input element-company" value="${company_uuid_element.uuid}"
                                id="filter-company-${company_uuid_element.uuid}" name="filter-company-${company_uuid_element.uuid}">
                            <label class="custom-control-label" for="filter-company-${company_uuid_element.uuid}">${company_uuid_element.company}</label>
                        </div>
                    </div>
                `);
                arrrr.push(company_uuid_element.uuid);
            });
            value_checkbox['company'] = arrrr;
            arrrr = [];
            Object.values(data_database.data_atribut_sizes.site_uuid).forEach(site_uuid_element => {
                $('.site-filter').append(`
                    <div class="col-auto">
                        <div class="custom-control custom-checkbox mb-5">
                            <input onchange="changeChecked('filter-site_uuid-${site_uuid_element.uuid}','${site_uuid_element.uuid}', 'site_uuid')" type="checkbox" class="custom-control-input element-site_uuid" value="${site_uuid_element.uuid}"
                                id="filter-site_uuid-${site_uuid_element.uuid}" name="filter-site_uuid-${site_uuid_element.uuid}">
                            <label class="custom-control-label" for="filter-site_uuid-${site_uuid_element.uuid}">${site_uuid_element.name_atribut}</label>
                        </div>
                    </div>
                `);
                arrrr.push(site_uuid_element.uuid);
            });
            value_checkbox['site_uuid'] = arrrr;
            filter.value_checkbox = value_checkbox;

            Object.values(data_database.data_atribut_sizes.payment_other_uuid).forEach(payment_other_uuid_element => {
                $('#payment_other_uuid').append(`
                        <option value="${payment_other_uuid_element.uuid}">${payment_other_uuid_element.name_atribut}</option>
                `);
            });
            loopDateFilter();
            onSaveFilter();

            year = arr_date_today.year;
            month = arr_date_today.month;
            v_year = arr_date_today.year;
            v_month = arr_date_today.month;
            _url = 'other-payment/data/' + arr_date_today.year + '-' + arr_date_today.month;
            Object.values(data_database.data_employees).forEach(data_employee_element => {
                $(`.employees`).append(
                    `<option value="${data_employee_element.nik_employee}">${data_employee_element.name} - ${data_employee_element.position}</option>`
                );
            });

            $('#btn-year').html(arr_date_today.year);
            $('#btn-month').html(months[parseInt(arr_date_today.month)]);
            $('#btn-month').val(arr_date_today.month);
            
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

        function showDataTableEmployeePaymentOther() {
            $('#other-payment').empty();
            var table_element = ` 
                <table id="table-other-payments" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Data Karyawan</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Jenis Pembayaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>`;

            $('#other-payment').append(table_element);

            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/other-payment/data',
                type: "POST",
                data: {
                    _token: _token,
                    filter: filter,
                    nik_employee: null,
                },
                success: function(response) {
                    cg('response', response);
                    data_datatable = response.data.data_datatable;

                    let data = [];
                    data.push(element_profile_employee_session)

                    let dataTable = [
                        'payment_other_date',
                        'payment_other_much',
                        'payment_other_value',
                        'payment_other_total'
                    ];
                    dataTable.forEach(element => {
                        var dataElement = {
                            data: element,
                            name: element
                        }
                        data.push(dataElement)
                    });

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

                    $('#table-other-payments').DataTable({
                        scrollX: true,
                        serverSide: false,
                        data: data_datatable,
                        columns: data
                    });


                },
                error: function(response) {
                    alertModal()
                }
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
            $('#date_start_filter_range').empty();
            $('#date_end_filter_range').empty();
            loopDateFilter();
            onSaveFilter();
            setDateSession(year, month);
        }

        //first run
        firstIndexEmployeePaymentOther();
    </script>
@endsection
