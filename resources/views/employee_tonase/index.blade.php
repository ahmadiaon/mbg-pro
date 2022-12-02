@extends('template.admin.main_privilege')
@section('content')
    <div class="mb-30">
        <div class="row">
            <div class="col-12">
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="row justify-content-md-center pd-20">
                        <div class="col-md-2">
                            <h4 class="text-blue h4">Tonase</h4>
                        </div>
                        <div class="col-md-4">
                            <select onchange="getSelected()" id="select_coal_froms" class="selectpicker form-control"
                                data-size="5" data-style="btn-outline-primary" multiple data-actions-box="true"
                                data-selected-text-format="count">


                            </select>
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
                                        <a id="each-month" class="dropdown-item" onclick="refreshTable(null, 12 )"
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
                                        <a class="dropdown-item" id="btn-export"disabled
                                            href="/user/absensi/export/">Export</a>
                                        <a class="dropdown-item" id="btn-import" data-toggle="modal"
                                            data-target="#import-modal" href="">Import</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="the-table">
                      
                    </div>
                </div>
                <!-- Simple Datatable End -->
            </div>
            
        </div>
    </div>

    <!-- Simple Datatable End -->
    <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle" aria-hidden="true">
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
                    <input name="uploaded_file"
                        type="file"
                        class="form-control-file form-control height-auto"
                    />
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
        let companies = @json($companies);
        let element_coal_from = '';
        let nik_employee = '';
        companies.forEach(element => {
            element_coal_from = element_coal_from + `<optgroup label="${element.company}">`;
            element.coal_froms.forEach(element_coal_froms => {
                element_coal_from = element_coal_from +
                    `<option  value="${element_coal_froms.uuid}" >${element_coal_froms.coal_from}</option>`;
            });
            element_coal_from = element_coal_from + `</optgroup>`;
        });

        // console.log(element_coal_from);
        $('#select_coal_froms').empty();
        $('#select_coal_froms').append(element_coal_from);
    </script>
    <script>
        let year_month = @json($year_month);
        let arr_year_month = year_month.split("-")
        $('#btn-year').html(arr_year_month[0]);
        $('#btn-month').html(months[arr_year_month[1]]);
        $('#btn-month').val(arr_year_month[1]);
        $('#btn-day').html("Perbulan");
        $('#btn-export').attr('href', '/tonase/export/' + year_month)
        var year_month_day = '';
        var date = new Date(),
            y = arr_year_month[0],
            m = arr_year_month[1];
        $('#each-month').attr('onclick', 'refreshTable(null, '+m+' )')
        var firstDay = new Date(y, m, 1);
        var lastDay = new Date(y, m + 1, 0);
        reloadTable(year_month);


        function showDataTableUserTonase(url, dataTable, id) {
            $('#tablePrivilege').remove();
            var table_element = ` 
                                        <div class="pb-20" id="tablePrivilege">
                                            <table id="table-tonases" class="display nowrap stripe hover table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Rit</th>
                                                        <th>Ton</th>
                                                        <th>Ton + Bonus</th>
                                                        <th class="datatable-nosort">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>`;

            $('#the-table').append(table_element);
            let data = [];
            
            dataTable.forEach(element => {
                var dataElement = {
                    data: element,
                    name: element
                }
                data.push(dataElement)
            });

            var el_1 = {
                mRender: function(data, type, row) {
                    let element_action = '';
                    
                    element_action = `
                                <div class="form-inline"> 
                                    <a onclick="setNikEmployee('${row.nik_employee}')">
                                        <button  type="button" class="btn btn-primary mr-1  py-1 px-2">
                                            <small>detail</small>
                                        </button>
                                    </a>
                                </div>`;
                    
                    return element_action;
                }
            };
            data.push(el_1)

            let vall = $('#select_coal_froms').val();
            let urls = '{{ env('APP_URL') }}' + url;
            setDates(y, m)
            console.log('nik_employee : '+nik_employee);
            console.log('year_month_day:'+year_month_day)
            $('#' + id).DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: {
                    url: '/tonase/data',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        year_month: year_month,
                        year_month_day: year_month_day,
                        filter: vall,
                        nik_employee: nik_employee,
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
                $('#each-month').attr('onclick', 'refreshTable(null, '+v_month+' )')
                v_month = val_month;
                console.log(val_month);
                $('#btn-month').html(months[val_month]);
                $('#btn-month').val(val_month);
            }
            year_month = v_year + '-' + v_month;

            console.log('heressse'+ year_month)
            if (val_day) {
                $('#btn-day').html(val_day);
                let val_all = year_month + '-' + val_day;
                console.log(val_all)
                
                year_month_day = val_all;
                
                eachDay(val_all);
                return false;
            }
            year_month_day = '';
            nik_employee = '';
            $('#btn-day').html("Perbulan");
            setDates(v_year, v_month);

            reloadTable(year_month)
        }

        function setDates(val_year, val_month) {
            var date = new Date(),
                y = val_year,
                m = val_month - 1;
            var firstDay = new Date(y, m, 1);
            var lastDay = new Date(y, m + 1, 0);
            $('#ten-one').empty();
            $('#ten-two').empty();
            $('#ten-three').empty();
            for (let a = 1; a <= 10; a++) {
                $('#ten-one').append(
                    `<button onclick="refreshTable(null, null, ${a})"  type="button" class="btn btn-light">${a}</button>`
                );
            }
            for (let b = 11; b <= 20; b++) {
                $('#ten-two').append(
                    `<button onclick="refreshTable(null, null, ${b})" type="button" class="btn btn-light">${b}</button>`
                );
            }
            for (let c = 21; c <= lastDay.getDate(); c++) {
                $('#ten-three').append(
                    `<button onclick="refreshTable(null, null, ${c})" type="button" class="btn btn-light">${c}</button>`
                );
            }

            console.log("last day : " + lastDay.getDate());
        }

        function eachDay(day) {
            year_month_day = day;
            console.log('year_month_day :' + year_month_day);
           

            $('#btn-export').attr('href', 'hour-meter/data/' + year_month_day)

            showDataTableUserTonase('aa', ['name','ritase', 'total_sell', 'total_sells'], 'table-tonases')
        }

        function getSelected() {
            console.log('get selected');
            // let vall = $('#select_coal_froms').val();

            let _url = 'tonase/data';
            reloadTable(year_month)
        }

        function reloadTable(year_month) {

            $('#tablePrivilege').remove();
            var table_element = ` 
                                         <div class="pb-20" id="tablePrivilege">
                                            <table id="table-tonases" class="display nowrap stripe hover table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Rit</th>
                                                        <th>Ton</th>
                                                        <th>Ton + Bonus</th>
                                                        <th class="datatable-nosort">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>`;

            $('#the-table').append(table_element);

            $('#btn-export').attr('href', 'tonase/export/' + year_month)
            console.log('year:' + year_month)
            let _url = 'tonase/data';
            showDataTableUserTonase(_url, ['name','ritase', 'total_sell', 'total_sells',], 'table-tonases')
        }

        function setNikEmployee(nik){
            nik_employee = nik;

            if(year_month_day){
                _url = '/tonase/detail/'+nik_employee+'/'+year_month_day;
            }else{
                _url = '/tonase/detail/'+nik_employee+'/'+year_month;
            }

           
            
            console.log('_url : '+_url);
            console.log('nik_employee : '+nik_employee);
            console.log('year_month : '+year_month);
            console.log('year_month_day : '+year_month_day);
            window.location.href = _url; 


        }
    </script>
@endsection
