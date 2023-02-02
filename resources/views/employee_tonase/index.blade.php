@extends('template.admin.main_privilege')
@section('content')
    <div class="mb-30">
        <div class="row">
            
            <div class="col-7 mb-10">
                <div  class="card-box pd-20"  id="the-filter-employee-tonase">
                   
                        <h4 class="text-blue h4">Filter</h4>
                    <div class="form-group row">
                        <label class="col-md-4">Asal Batu</label>
                        <div class="col-md-8 ">
                            <div class="row coal-from">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input onchange="checkedAllCoalFrom()" type="checkbox"
                                            class="custom-control-input" id="checked-all-coal-from">
                                        <label class="custom-control-label"
                                            for="checked-all-coal-from">Pilih
                                            Semua</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <label class="col-md-auto" for="is_combined">Gabungkan Asal Batu :</label>
                        <div class="col-md-auto">
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input " id="is_combined"
                                    name="is_combined">
                                <label class="custom-control-label" for="is_combined">Gabungkan</label>
                            </div>
                        </div>
                    </div>
                        <button onclick="onSaveFilter()"  type="button" class="col-md-auto btn btn-primary text-rigth">
                            Simpan
                        </button>


                </div>
            </div>
            <div class="col-12">
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="row justify-content-md-center pd-20">
                        <div class="col-md-2">
                            <h4 class="text-blue h4">Tonase</h4>
                        </div>
                        <div class="col-md-1">
                            <h3 id="ritasse">Rit : 30</h3>
                        </div>
                        <div class="col text-right">
                            <div class="btn-group">
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                                        data-toggle="dropdown" aria-expanded="false" id="btn-year">
                                        <span class="caret"></span>
                                    </button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" onclick="refreshTable(2021,null)" href="#">2021</a>
                                        <a class="dropdown-item" onclick="refreshTable(2022,null)" href="#">2022</a>
                                        <a class="dropdown-item" onclick="refreshTable(2023,null)" href="#">2023</a>
                                    </div>
                                </div>
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                                        data-toggle="dropdown" aria-expanded="false" id="btn-month" value="">
                                        <span class="caret"></span>
                                    </button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" onclick="refreshTable(null, 1 )" href="#">Januari</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 2 )"
                                            href="#">Februari</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 3 )" href="#">Maret</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 4 )" href="#">April</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 5 )" href="#">Mei</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 6 )" href="#">Juni</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 7 )" href="#">Juli</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 8 )" href="#">Agustus</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 9 )"
                                            href="#">September</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 10 )"
                                            href="#">Oktober</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 11 )"
                                            href="#">November</a>
                                        <a class="dropdown-item" onclick="refreshTable(null, 12 )"
                                            href="#">Desember</a>
                                    </div>
                                </div>
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-secondary dropdown-toggle waves-effect"
                                        data-toggle="dropdown" aria-expanded="false" id="btn-day" value="Perbulan">
                                        <span id="btn-day" class="caret"></span>
                                    </button>

                                    <div class="dropdown-menu">
                                        <a id="each-month" class="dropdown-item" onclick="refreshTable(null, null,null)"
                                            href="#">Perbulan</a>

                                        <div class="row">
                                            <div class="col-3">
                                                <div class="btn-group-vertical" id="ten-one">
                                                    {{-- tanggal 1- 10 --}}
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="btn-group-vertical" id="ten-two">
                                                    {{-- tanggal 11-20 --}}
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="btn-group-vertical" id="ten-three">
                                                    {{-- tanggal 20-akhir --}}
                                                </div>
                                            </div>
                                        </div>

                                        <label for=""></label>
                                    </div>
                                </div>
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle waves-effect"
                                        data-toggle="dropdown" aria-expanded="false">
                                        Menu <span class="caret"></span>
                                    </button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/tonase/create">Tambah</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#modal-filter">Filter</a>
                                        <a class="dropdown-item" id="btn-template"disabled
                                            href="/user/absensi/export/">Template</a>
                                        <a class="dropdown-item" id="btn-import" data-toggle="modal"
                                            data-target="#import-modal" href="">Import</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>                    

                    <div id="the-table">
                        <div class="pb-20" id="employee-tonase">

                        </div>
                    </div>
                </div>
                <!-- Simple Datatable End -->
            </div>
        </div>
    </div>

    <!-- Simple Datatable End -->
    <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-import" action="/tonase/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import Tonase</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih Tonase</label>
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

    <div class="modal fade customscroll" id="modal-filter" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Filter Data
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="bottom" title="" data-original-title="Close Modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-0">
                    <div class="task-list-form">
                        <ul>
                            <li>
                                <form>
                                    <div class="form-group row">
                                        <label class="col-md-4">Asal Batu</label>
                                        <div class="col-md-8 ">
                                            <div class="row coal-from">
                                                <div class="col-12">
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input onchange="checkedAllCoalFrom()" type="checkbox"
                                                            class="custom-control-input" id="checked-all-coal-from">
                                                        <label class="custom-control-label"
                                                            for="checked-all-coal-from">Pilih
                                                            Semua</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <label class="col-md-auto" for="is_combined">Gabungkan Asal Batu :</label>
                                        <div class="col-md-auto">
                                            <div class="custom-control custom-checkbox mb-5">
                                                <input type="checkbox" class="custom-control-input " id="is_combined"
                                                    name="is_combined">
                                                <label class="custom-control-label" for="is_combined">Gabungkan</label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="onSaveFilter()" data-dismiss="modal" type="button" class="btn btn-primary">
                        Simpan
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
       
        let nik_employee = @json($nik_employee);


        let filter;
        let is_combined;
        let companies = @json($companies);
        let arr_coal_from = [];


        function firstEmployeeHourMeter() {
            filter = {
                arr_coal_from: [],
                is_combined: true
            }
            $('#btn-year').html(arr_date_today.year);
            $('#btn-month').val(arr_date_today.month);
            $('#btn-month').html(monthName(arr_date_today.month));
            $('#btn-day').html("Perbulan");
            $('#btn-export').attr('href', '/tonase/export/' + arr_date_today.year + '-' + arr_date_today.month)
            $('#btn-template').attr('href', '/tonase/template/' + arr_date_today.year + '-' + arr_date_today.month)
            setDatesMonth();
            arr_date_today.day = null;


            let element_coal_from = '';
            companies.forEach(element => {
                element_coal_from = element_coal_from + `<optgroup label="${element.company}">`;
                element.coal_froms.forEach(element_coal_froms => {
                    element_coal_from = element_coal_from +
                        `<option  value="${element_coal_froms.uuid}" >${element_coal_froms.coal_from}</option>`;
                    $('.coal-from').append(`<div class="col-auto">
                                                    <div class="custom-control custom-checkbox mb-5">
                                                        <input onchange="setFilterCoalFrom()" type="checkbox" class="custom-control-input element-coal-from" value="${element_coal_froms.uuid}"
                                                            id="${element_coal_froms.uuid}" name="${element_coal_froms.uuid}">
                                                        <label class="custom-control-label" for="${element_coal_froms.uuid}">${element_coal_froms.coal_from}</label>
                                                    </div>
                                                </div>`);
                });
                element_coal_from = element_coal_from + `</optgroup>`;
            });

            $('#is_combined').prop('checked', true);
            filter.is_combined = true;

            showDataTableUserTonase()
        }

        function checkedAllCoalFrom() {
            let isAllChecked = $('#checked-all-coal-from')[0].checked;
            // console.log(isAllChecked);
            if (isAllChecked) {
                $('.element-coal-from').prop('checked', true);
            } else {
                $('.element-coal-from').prop('checked', false);
            }
            setFilterCoalFrom()
        }

        function setFilterCoalFrom() {
            var checkedValue = $('.element-coal-from:checked').val();
            arr_coal_from = [];
            companies.forEach(element => {
                element.coal_froms.forEach(element_coal_froms => {
                    var checkedValue = $(`#${element_coal_froms.uuid}:checked`).val();
                    if (checkedValue) {
                        arr_coal_from.push(checkedValue)
                    }
                });
            });
        }

        function onSaveFilter() {
            let isCombined = $('#is_combined')[0].checked;
            // console.log(isAllChecked);
            if (isCombined) {
                is_combined = true;
            } else {
                is_combined = false
            }

            filter.arr_coal_from = arr_coal_from;
            filter.is_combined = is_combined;

            showDataTableUserTonase()
        }

        firstEmployeeHourMeter();


        function showDataTableUserTonase() {
            $('#employee-tonase').empty()
            let element_head_coal_from = ``;
            if (!filter.is_combined) {
                element_head_coal_from = `<th>Asal Batu</th>`;
            }

            var table_element = ` 
                                            <table id="table-employee-tonase" class="display nowrap stripe hover table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Rit</th>
                                                        <th>Ton</th>
                                                        ${element_head_coal_from}
                                                        <th>Ton + Bonus</th>
                                                        <th class="datatable-nosort">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>`;

            $('#employee-tonase').append(table_element);

            let data = [];
            data.push(element_profile_employee)

            let dataTable = [
                'ritase',
            ];

            dataTable.forEach(element => {
                var dataElement = {
                    data: element,
                    name: element
                }
                data.push(dataElement)
            });



            var el_2 = {
                mRender: function(data, type, row) {
                    // console.log(row)

                    let num = parseFloat(row.sum_tonase_value);
                    let num_ = num.toFixed(3);
                    return num_;
                }
            };
            data.push(el_2)

            var el_2 = {
                mRender: function(data, type, row) {
                    // console.log(row)

                    let num = parseFloat(row.sum_tonase_full_value);
                    let num_ = num.toFixed(3);
                    return num_;
                }
            };
            data.push(el_2)

            if (!filter.is_combined) {
                var el_2 = {
                    mRender: function(data, type, row) {
                        // console.log(row)
                        return row.coal_from_uuid;
                    }
                };
                data.push(el_2)
            }

            var el_1 = {
                mRender: function(data, type, row) {
                    let element_action = '';
                    element_action = `
                                <div class="form-inline"> 
                                    <a href="/tonase/show/${row.nik_employee}/${arr_date_today.year}-${arr_date_today.month}">
                                        <button  type="button" class="btn btn-primary mr-1  py-1 px-2">
                                            <small>detail</small>
                                        </button>
                                    </a>
                                </div>`;
                    return element_action;
                }
            };
            data.push(el_1)
            // console.log(filter)

            $('#table-employee-tonase').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: {
                    url: '/tonase/data',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        year: arr_date_today.year,
                        month: arr_date_today.month,
                        day: arr_date_today.day,
                        filter: filter,
                        nik_employee: nik_employee
                    },
                    type: 'POST',
                },
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api();
                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ?
                            i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column(1)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total over this page
                    pageTotal = api
                        .column(1, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    console.log(total);
                    $('#ritasse').text('Rit:' + total)
                },
                columns: data
            });
        }

        function refreshTable(val_year = null, val_month = null, val_day) {
            console.log('refreshTable');
            if (val_year) {
                arr_date_today.year = val_year;
                $('#btn-year').html(val_year);
            }
            if (val_month) {
                arr_date_today.month = val_month;
                $('#btn-month').html(monthName(arr_date_today.month));
                $('#btn-month').val(val_month);
            }

            if (val_day) {
                $('#btn-day').html(val_day);
                arr_date_today.day = val_day;
                showDataTableUserTonase();
                return false;
            }
            $('#btn-export').attr('href', '/tonase/export/' + arr_date_today.year + '-' + arr_date_today.month)
            $('#btn-template').attr('href', '/tonase/template/' + arr_date_today.year + '-' + arr_date_today.month)
            arr_date_today.day = null;
            $('#btn-day').html("Perbulan");
            setDatesMonth()
            showDataTableUserTonase();
        }

        function setDatesMonth() {
            var date = new Date(),
                y = arr_date_today.year,
                m = arr_date_today.month;
                m = m+1
            var firstDay = new Date(y, m, 1);
            var lastDay = new Date(y, m + 1, 0);
            $('#ten-one').empty();
            $('#ten-two').empty();
            $('#ten-three').empty();
            for (let a = 1; a <= 10; a++) {
                $('#ten-one').append(
                    `<button onclick="refreshTable(null, null, ${a})"  type="button" class="btn btn-sm btn-primary">${a}</button>`
                );
            }
            for (let b = 11; b <= 20; b++) {
                $('#ten-two').append(
                    `<button onclick="refreshTable(null, null, ${b})" type="button" class="btn btn-sm btn-primary">${b}</button>`
                );
            }
            for (let c = 21; c <= lastDay.getDate(); c++) {
                $('#ten-three').append(
                    `<button onclick="refreshTable(null, null, ${c})" type="button" class="btn btn-sm btn-primary">${c}</button>`
                );
            }
        }




        // function setNikEmployee(nik) {
        //     nik_employee = nik;

        //     if (year_month_day) {
        //         _url = '/tonase/detail/' + nik_employee + '/' + year_month_day;
        //     } else {
        //         _url = '/tonase/detail/' + nik_employee + '/' + year_month;
        //     }



        //     console.log('_url : ' + _url);
        //     console.log('nik_employee : ' + nik_employee);
        //     console.log('year_month : ' + year_month);
        //     console.log('year_month_day : ' + year_month_day);
        //     window.location.href = _url;


        // }
    </script>
@endsection
