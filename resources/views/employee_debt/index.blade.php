@extends('template.admin.main_privilege')

@section('content')
    <div class="mb-20 row">
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
                        <label class="col-auto">Status Hutang</label>
                        <div class="col text-right custom-control custom-checkbox mb-5">
                            <input onchange="checkedAll('status_debt')" type="checkbox" class="custom-control-input"
                                id="checked-all-status_debt">
                            <label class="custom-control-label" for="checked-all-status_debt">Pilih
                                Semua</label>
                        </div>
                    </div>

                    <div class="row justify-content-md-center status_debt">

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
                <h4 class="text-blue h4">Hutang Karyawan</h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false">
                            Menu <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a onclick="modalCreateEmployeeDebt()" class="dropdown-item" href="#">Tambah</a>
                            <a class="dropdown-item" id="btn-export"disabled href="/user/absensi/export/">Export</a>
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
            <div class="pb-20" id="employee-debt">

            </div>
        </div>
    </div>


    {{-- modal add employee debt --}}
    <div class="modal fade" id="modalCreateEmployeeDebt" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/employee-debt/store" id="form-employee-debt" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="uuid" id="uuid-employee_debt" class="form-control">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Form Berhutang
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Karyawan</label>
                            <select name="employee_uuid" id="employee_uuid-employee_debt" style="width: 100%"
                                class="custom-select2 form-control employees">
                                <option value="">karyawan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal berhutang</label>

                            <input type="date" name="date_debt" id="date_debt" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Besar hutang</label>

                            <input type="text" name="value_debt" id="value_debt" class="form-control"
                                onkeyup="toRupiah(this)" value="Rp. ">
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">Besar cicilan</label>
                            <div class="col-md-9 row" id="persent-instalment">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Maksimal Cicilan</label>
                            <input type="text" name="max_payment_debt" id="max_payment_debt" class="form-control"
                                onkeyup="toRupiah(this)" value="Rp. " onclick="otherValueMaxPaymentDebt()">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" onclick="store('employee-debt')" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <!-- payment debt -->
    <div class="modal fade" id="modalCreateEmployeePaymentDebt" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/employee-payment-debt/store" id="form-employee-payment-debt" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="uuid" id="uuid-employee_payment_debt" class="form-control">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Form pembayaran hutang
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Karyawan</label>
                            <select name="employee_uuid" id="employee_uuid-employee_payment_debt" style="width: 100%"
                                class="custom-select2 form-control employees">
                                <option value="">karyawan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal berhutang</label>

                            <input type="date" name="date_debt" id="date_debt" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Besar hutang</label>

                            <input type="text" name="value_debt" id="value_debt" class="form-control"
                                onkeyup="toRupiah(this)" value="Rp. ">
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="">Besar cicilan</label>
                            <div class="col-md-9 row" id="persent-instalment">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Maksimal Cicilan</label>
                            <input type="text" name="max_payment_debt" id="max_payment_debt" class="form-control"
                                onkeyup="toRupiah(this)" value="Rp. " onclick="otherValueMaxPaymentDebt()">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" onclick="store('employee-debt')" class="btn btn-primary">
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
            <form id="form-import" action="/employee-debt/import" method="post" enctype="multipart/form-data">
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
        let data_uuid = null;
        let value_checkbox = {
            'company': null,
            'site_uuid': null,
            'status_debt': null
        };

        let arr_filter = {
            'company': [],
            'site_uuid': [],
            'status_debt': []
        };

        let filter = {
            'value_checkbox': [],
            'is_combined': true,
            'show_type': 'employee',
            'arr_filter': {
                'company': [],
                'site_uuid': [],
                'status_debt': []
            },
            nik_employee: nik_employee
        };

        function firstIndex() {
            let arrrr = [];

            let persentInstalmentDebt = [
                20,
                30,
                40,
                null
            ];
            persentInstalmentDebt.forEach(item_persentInstalmentDebt => {
                $('#persent-instalment').append(`
                        <div class="col-md-auto">
                            <div class="custom-control custom-radio mb-5">
                                <input onchange="choosePersentInstalmentDebt('${item_persentInstalmentDebt}')" type="radio"  id="modal-${item_persentInstalmentDebt}" name="persentInstalmentDebt"
                                    class="custom-control-input" value="${item_persentInstalmentDebt}"  />
                                <label class="custom-control-label" for="modal-${item_persentInstalmentDebt}" >${item_persentInstalmentDebt}</label>
                            </div>
                        </div>`);
            });
            
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
            Object.values(data_database.data_atribut_sizes.status_debt).forEach(status_debt_element => {
                $('.status_debt').append(`
                    <div class="col-auto">
                        <div class="custom-control custom-checkbox mb-5">
                            <input onchange="changeChecked('filter-status_debt-${status_debt_element.uuid}','${status_debt_element.uuid}', 'status_debt')" type="checkbox" class="custom-control-input element-status_debt" value="${status_debt_element.uuid}"
                                id="filter-status_debt-${status_debt_element.uuid}" name="filter-status_debt-${status_debt_element.uuid}">
                            <label class="custom-control-label" for="filter-status_debt-${status_debt_element.uuid}">${status_debt_element.name_atribut}</label>
                        </div>
                    </div>
                `);
                $('#status_debt').append(`
                    <option value="${status_debt_element.uuid}">${status_debt_element.name_atribut}</option>
                `);

                arrrr.push(status_debt_element.uuid);
            });
            value_checkbox['status_debt'] = arrrr;
            filter.value_checkbox = value_checkbox;

            onSaveFilter();
            return false;
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
            cg('arr_filter', arr_filter);
        }

        function changeChecked(idEl_, uuid, name) {
            cg('changeChecked name', name);
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
            filter.arr_filter = arr_filter;
            cg('onSaveFilter', filter);
            showDataTable();
        }

        firstIndex();

        function showDataTable() {
            $('#employee-debt').empty();
            $('#employee-debt').append(`
                 <table id="table-employee-debt" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Detail Karyawan</th>
                            <th>Tanggal Berhutang</th>
                            <th>Total Hutang</th>
                            <th>Maksimal Cicilan</th>
                            <th>Sisa Hutang</th>
                            <th>Riwayat Pembayaran</th>
                            <th>Status Hutang</th>      
                        </tr>
                    </thead>
                </table>
            `);

            

            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/employee-debt/data',
                type: "POST",
                data: {
                    _token: _token,
                    filter: filter
                },
                success: function(response) {
                    cg('response', response);
                    
                    return false;
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
                                            ${row.count_payment} Pengurang / Rp. ${row.sum_payment}
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
                                                    Rp. ${element.value_employee_deduction}                                                    
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

        function choosePersentInstalmentDebt(valuePersentInstalmentDebt) {
            cg('valuePersentInstalmentDebt', valuePersentInstalmentDebt);
            if (valuePersentInstalmentDebt != 'null') {
                let valueDebt = $('#rupiah-value_debt').val();
                if (valueDebt) {
                    if ($('#rupiah-max_payment_debt').length == 0) {
                        $(`#max_payment_debt`).attr("name", `rupiah-max_payment_debt`);
                        $(`#max_payment_debt`).after(
                            `
                            <input type="text" name="max_payment_debt"
                                        id="rupiah-max_payment_debt" class="form-control">
                            `
                        );
                    }
                    let valueInstalmentDebt = parseInt(parseInt(valueDebt) * parseInt(valuePersentInstalmentDebt) /
                        100);
                    $('#max_payment_debt').val('Rp. ' + valueInstalmentDebt.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                        '.')).trigger('change');
                    $('#rupiah-max_payment_debt').val(valueInstalmentDebt);

                }
            }
        }

        function otherValueMaxPaymentDebt() {
            $('#modal-null').prop("checked", true);
        }
















        let year_month = @json($year_month);
        let arr_year_month = year_month.split("-")


        function modalCreateEmployeeDebt() {
            $('#modalCreateEmployeeDebt').modal('show');
            $('#form-employee-debt')[0].reset();
        }

        function deleteData(uuid) {
            let _url = 'employee-debt/delete'

            $('#uuid_delete').val(uuid)
            $('#url_delete').val(_url)
            $('#confirm-modal').modal('show')
            $('#table_reload').val('employee-debt')
        }

        function store(idForm) {
            if (isRequiredCreate(['employee_uuid-employee_debt', 'date_debt', 'value_debt', 'max_payment_debt']) > 0) {
                return false;
            }
            var isStored = globalStoreNoTable(idForm);
        }

        function editData(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/employee-debt/show";
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
                    $('#modalCreateEmployeeDebt').modal('show')
                },
                error: function(response) {
                    console.log(response)
                    alertModal()
                }
            });
        }

        function showDataTableUserPrivilege(url, dataTable, id) {
            $('#tablePrivilege').remove();
            var table_element = ` 
            <div class="pb-20" id="tablePrivilege">
                <table id="table-employee-debt" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Total Hutang</th>
                            <th>Sisa Hutang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>`;

            $('#the-table').append(table_element);


            let data = [];

            data.push(element_profile_employee)

            dataTable.forEach(element => {
                var dataElement = {
                    data: element,
                    name: element
                }
                data.push(dataElement)
            });

            var elements = {
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
            data.push(elements)
            let urls = '{{ env('APP_URL') }}' + url
            console.log(urls)
            $('#' + id).DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: '/employee-debt/data',
                columns: data
            });
        }

        function refreshTable(val_year = null, val_month = null) {
            console.log(val_year);
            let v_year = $('#btn-year').html();
            let v_month = $('#btn-month').val();
            console.log(v_month);
            if (val_year) {
                console.log(val_year);
                v_year = val_year;
                $('#btn-year').html(val_year);
            }
            if (val_month) {
                v_month = val_month;
                console.log(val_month);
                $('#btn-month').html(months[val_month]);
                $('#btn-month').val(val_month);
            }
            let year_month = v_year + '-' + v_month;
            reloadTable(year_month)
        }

        function reloadTable(year_month) {

            $('#tablePrivilege').remove();
            var table_element = ` 
            <div class="pb-20" id="tablePrivilege">
                <table id="table-employee-debt" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Total Hutang</th>
                            <th>Sisa Hutang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>`;

            $('#the-table').append(table_element);

            $('#btn-export').attr('href', 'employee-debt/export/' + year_month)
            console.log('year:' + year_month)
            let _url = 'employee-debt/data/' + year_month;
            showDataTableUserPrivilege(_url, ['value_debt', 'remaining_new_debt'],
                'table-employee-debt')
        }
    </script>
@endsection
