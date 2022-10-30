@extends('template.admin.main_privilege')
@section('content')
    <div class="mb-30">
        <div class="row">
            <div class="col-12">
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="row pd-20">
                        <div class="col-auto">
                            <h4 class="text-blue h4">Tonase</h4>
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
                        <div class="pb-20" id="tablePrivilege">
                            <table id="table-tonase" class="display nowrap stripe hover table">
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
                        </div>
                    </div>
                </div>
                <!-- Simple Datatable End -->
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        let year_month = @json($year_month);
        let arr_year_month = year_month.split("-")
        $('#btn-year').html(arr_year_month[0]);
        $('#btn-month').html(months[arr_year_month[1]]);
        $('#btn-month').val(arr_year_month[1]);
        $('#btn-export').attr('href', '/tonase/export/' + year_month)
        reloadTable(year_month)


        function showDataTableUserPrivilege(url, dataTable, id) {
            let data = [];
            var elements = {
                mRender: function(data, type, row) {
                    // console.log('aaa')
                    // console.log(row)					
                    return `${row.name} <small>${row.position}</small>`
                }
            };
            data.push(elements)
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
                                    <button onclick="editHm('` + row.ritase + `')" type="button" class="btn btn-secondary">
                                        <i class="dw dw-edit2"></i>
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
                ajax: urls,
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
                                            <table id="table-tonase" class="display nowrap stripe hover table" style="width:100%">
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

            $('#btn-export').attr('href', 'tonase/data/' + year_month)
            console.log('year:' + year_month)
            let _url = 'tonase/data/' + year_month;
            showDataTableUserPrivilege(_url, ['ritase', 'total_sell', 'total_sells'], 'table-tonase')
        }
    </script>
@endsection
