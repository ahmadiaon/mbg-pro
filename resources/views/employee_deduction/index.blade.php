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

                <div class="form-group mb-20">
                    <div class="form-group row">
                        <label class="col-auto">Jenis Pengurang</label>
                        <div class="col text-right custom-control custom-checkbox mb-5">
                            <input onchange="checkedAll('group_deduction_uuid')" type="checkbox"
                                class="custom-control-input" id="checked-all-group_deduction_uuid">
                            <label class="custom-control-label" for="checked-all-group_deduction_uuid">Pilih
                                Semua</label>
                        </div>
                    </div>

                    <div class="row justify-content-md-center group_deduction_uuid">

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
                <h4 class="text-blue h4">Pengurang Pendapatan Karyawan</h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false" id="btn-year">
                            <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="refreshTable(2021,null)" href="#">2021</a>
                            <a class="dropdown-item" onclick="refreshTable(2022,null)" href="#">2022</a>
                            <a class="dropdown-item" onclick="refreshTable(2023,null)" href="#">2023</a>
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
                            <a class="dropdown-item" onclick="modalAddDataEmployeeDeduction()" href="#">Tambah</a>
                            <a class="dropdown-item" id="btn-export"disabled href="/employee-deduction/export/">Export</a>
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
            <div class="pb-20" id="employee-payment">

            </div>
        </div>
    </div>
    <!-- Simple Datatable End -->


    <!-- Simple Datatable End -->
    <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-import" action="/employee-deduction/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih File Pengurang</label>
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

    <!-- Simple Datatable End -->
    <div class="modal fade" id="import-modal-loading" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-import" action="/employee-deduction/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih File Pengurang</label>
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


    {{-- modal add data --}}
    <div class="modal fade" id="modalAddDataEmployeeDeduction" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/employee-deduction/store" id="form-employee-deduction" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="uuid" id="uuid" class="form-control" placeholder="kode item">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Form Pengurang pendapatan
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
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Jenis Pengurang</label>
                                    <a href="/database/atribut-size">
                                        <button type="button" class="btn btn-secondary mr-1  py-1 px-2"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="Tambah Jenis Pembayaran">
                                            <i class="icon-copy bi bi-arrow-up-right"></i>
                                        </button>
                                    </a>

                                    <select class="selectpicker form-control" name="group_deduction_uuid"
                                        id="group_deduction_uuid">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" name="date_employee_deduction" id="date_employee_deduction"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="text" name="value_employee_deduction" id="value_employee_deduction"
                                        class="form-control"  onkeyup="toRupiah(this)" value="Rp. ">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea class="form-control" name="description_deduction_uuid" id="description_deduction_uuid" cols="30"
                                rows="10"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="button" onclick="store('employee-deduction')" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let nik_employee = null;
        let data_uuid = null;
        var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
        var end = new Date(arr_date_today.year, arr_date_today.month, 0);
        let value_checkbox = {
            'company': null,
            'site_uuid': null,
            'group_deduction_uuid': null
        };

        let arr_filter = {
            'company': [],
            'site_uuid': [],
            'group_deduction_uuid': []
        };

        let filter = {
            'value_checkbox': [],
            'is_combined': true,
            'show_type': 'employee',
            'arr_filter': {
                'company': [],
                'site_uuid': [],
                'group_deduction_uuid': []
            },

            'date_filter': {
                date_start_filter_range: formatDate(start),
                date_end_filter_range: formatDate(end),
            },
            nik_employee: nik_employee
        };

        function modalAddDataEmployeeDeduction() {
            $('#modalAddDataEmployeeDeduction').modal('show');
            $('#form-employee-deduction')[0].reset();
            $('#employee_uuid').val(null).trigger('change');
        }

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
            stopLoading();

            let date_filter = {
                date_start_filter_range: $('#date_start_filter_range').val(),
                date_end_filter_range: $('#date_end_filter_range').val(),
            };
            filter.date_filter = date_filter;
            filter.arr_filter = arr_filter;
            filter.show_type = $("input[type='radio'][name='show_type']:checked").val();

            cg('onSaveFilter', filter); $('.modal').modal('hide')
            showDataTableEmployeePaymentDeduction()
        }

        function store(idForm) {
            if (isRequiredCreate(['employee_uuid', 'group_deduction_uuid', 'date_employee_deduction',
                    'value_employee_deduction'
                ]) > 0) {
                return false;
            }
            var isStored = globalStoreNoTable(idForm).then((ses_data) => {
                
                onSaveFilter();
            });

        }

        function editData(uuid) {
            let dataEditDeduction = data_uuid[uuid];
            $('#uuid').val(dataEditDeduction.uuid)
            $('#employee_uuid').val(dataEditDeduction.employee_uuid).trigger('change');
            $('#date_employee_deduction').val(dataEditDeduction.date_employee_deduction) 
            $('#value_employee_deduction').trigger('keyup');
            $('#value_employee_deduction').val(toValueRupiah(dataEditDeduction.value_employee_deduction));
            $('#rupiah-value_employee_deduction').val(dataEditDeduction.value_employee_deduction);
           
            $('#description_deduction_uuid').val(dataEditDeduction.description_deduction_uuid)
            $('#group_deduction_uuid').val(dataEditDeduction.group_deduction_uuid).trigger('change');
            $('#modalAddDataEmployeeDeduction').modal('show')
        }

        function deleteData(uuid) {
            let _url = '/employee-deduction/delete'

            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show');
            onSaveFilter();
        }










        let year;
        let month;
        let v_year;
        let v_month;
        let _ur;

        cg('arr_date_today', arr_date_today);

        function firstIndexEmployeePayment() {
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
            Object.values(data_database.data_employees).forEach(employee_uuid_element => {
                $('.employees').append(`
                    <option value="${employee_uuid_element.nik_employee}">${employee_uuid_element.name} - ${employee_uuid_element.position}</option>
                `);

            });

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

            arrrr = [];
            Object.values(data_database.data_atribut_sizes.group_deduction_uuid).forEach(group_deduction_uuid_element => {
                $('.group_deduction_uuid').append(`
                    <div class="col-auto">
                        <div class="custom-control custom-checkbox mb-5">
                            <input onchange="changeChecked('filter-group_deduction_uuid-${group_deduction_uuid_element.uuid}','${group_deduction_uuid_element.uuid}', 'group_deduction_uuid')" type="checkbox" class="custom-control-input element-group_deduction_uuid" value="${group_deduction_uuid_element.uuid}"
                                id="filter-group_deduction_uuid-${group_deduction_uuid_element.uuid}" name="filter-group_deduction_uuid-${group_deduction_uuid_element.uuid}">
                            <label class="custom-control-label" for="filter-group_deduction_uuid-${group_deduction_uuid_element.uuid}">${group_deduction_uuid_element.name_atribut}</label>
                        </div>
                    </div>
                `);
                $('#group_deduction_uuid').append(`
                    <option value="${group_deduction_uuid_element.uuid}">${group_deduction_uuid_element.name_atribut}</option>
                `);

                arrrr.push(group_deduction_uuid_element.uuid);
            });
            value_checkbox['group_deduction_uuid'] = arrrr;
            filter.value_checkbox = value_checkbox;

            loopDateFilter();
            onSaveFilter();
            $('#btn-year').html(arr_date_today.year);
            $('#btn-month').html(months[parseInt(arr_date_today.month)]);
            $('#btn-month').val(arr_date_today.month);
            return false;




            let year = arr_date_today.year;
            let month = arr_date_today.month;
            let v_year = arr_date_today.year;
            let v_month = arr_date_today.month;



            $('#btn-export').attr('href', '/payment/export/' + arr_date_today.year + '-' + arr_date_today.month)
            showDataTableEmployeePaymentDeduction()
        }


        function showDataTableEmployeePaymentDeduction() {
            $('#employee-payment').empty();
            $('#employee-payment').append(`
                 <table id="table-employee-deduction" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Detail Karyawan</th>
                            <th>Pengurang</th>      
                        </tr>
                    </thead>
                </table>
            `);

            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/employee-deduction/data',
                type: "POST",
                data: {
                    _token: _token,
                    filter: filter
                },
                success: function(response) {
                    cg('response', response);
                    let data = [];
                    let element_ton = ``;
                    data.push(element_profile_employee_session);
                    data_uuid = response.data.data_uuid;
                    var element_data = {
                        mRender: function(data, type, row) {
                            element_ton = ``;
                            let el_head = `
                            <div class="faq-wrap">
                                <div id="faq-${row.employee_uuid}" class="card">                                   
                                        <div class="card-header mb-2">
                                            <button
                                            style="white-space: nowrap;"
                                                class="btn btn-block collapsed"
                                                data-toggle="collapse"
                                                data-target="#${row.employee_uuid}"
                                            >
                                            ${row.count_payment} Pengurang / ${toValueRupiah(row.sum_payment)}
                                            </button>
                                        </div>                
                                         <div id="${row.employee_uuid}" class="collapse" data-parent="#faq-${row.employee_uuid}">                                
                                `;
                            let el_tail = `       
                                        </div>
                                    </div>
                                </div>`;


                            row['data'].forEach(element => {
                                element_ton = `${element_ton}

                                    <div class="card mb-5" id="${element.uuid}">
                                        <div  class="card-body mb-0">
                                            <div class="row">
                                                <h5 class="mt-1 col h4">
                                                    ${element.name_atribut}    
                                                </h5>
                                                <h5 class="mt-2 col text-right text-blue h4">
                                                    ${ toValueRupiah(element.value_employee_deduction)}                                                    
                                                </h5>
                                                
                                            </div>     
                                                <blockquote class="blockquote mb-0 row">
                                                    <p class="col">
                                                        ${element.date_employee_deduction} 
                                                    </p>
                                                    <div class="form-inline"> 
                                                        <button onclick="editData('` + element.uuid + `')" type="button" class="btn btn-secondary mr-1  py-1 px-2">
                                                            <i class="icon-copy ion-gear-b"></i>
                                                        </button>
                                                        <button onclick="deleteData('` + element.uuid + `')" type="button" class="btn btn-danger mr-1  py-1 px-2">
                                                            <i class="icon-copy ion-trash-b"></i>
                                                        </button>
                                                    </div>
                                                    <footer class="col-12 blockquote-footer">
                                                        ${element.description_deduction_uuid}  
                                                    </footer>
                                                </blockquote>  
                                                                                                        
                                        </div>
                                    </div>
                            
                            `;
                            });
                            return `
                                        ${el_head}
                                        ${element_ton}
                                        ${el_tail}
                                        `
                        }
                    }

                    data.push(element_data);


                    let data_datable = response.data.data_datatable;
                    $('#table-employee-deduction').DataTable({
                        scrollX: true,
                        serverSide: false,
                        data: data_datable,
                        columns: data
                    });

                },
                error: function(response) {
                    // alertModal()
                }
            });

        }

        function refreshTable(val_year = null, val_month = null) {
            year = arr_date_today.year;
            month = arr_date_today.month;

            if (val_year) {
                arr_date_today.year = val_year
                $('#btn-year').html(arr_date_today.year);
            }

            if (val_month) {
                arr_date_today.month = val_month;
                $('#btn-month').html(monthName(arr_date_today.month));
                $('#btn-month').val(arr_date_today.month);
            }

            $('#date_start_filter_range').empty();
            $('#date_end_filter_range').empty();
            loopDateFilter();
            onSaveFilter();
            setDateSession(year, month);
        }

        //setup RUN
        firstIndexEmployeePayment();
    </script>
@endsection
