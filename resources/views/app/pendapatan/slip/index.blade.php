@extends('app.layouts.main')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Slip Gaji </h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle waves-effect" data-toggle="dropdown"
                            aria-expanded="false" id="btn-year">
                            <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="refreshTable(2021,null,null)" href="#">2021</a>
                            <a class="dropdown-item" onclick="refreshTable(2022,null,null)" href="#">2022</a>
                            <a class="dropdown-item" onclick="refreshTable(2023,null,null)" href="#">2023</a>
                            <a class="dropdown-item" onclick="refreshTable(2024,null,null)" href="#">2024</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="user-list pd-20">
                <ul id="slips">

                    <li class="d-flex align-items-center justify-content-between">
                        <div class="name-avatar d-flex align-items-center pr-2">

                            <div class="txt" id="no-slips">
                                <div class="font-14 weight-600">Tidak ada slip</div>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <div class="modal fade" id="doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Document</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <iframe id="path_doc" src="http://192.168.8.135:8000/file/document/employee/01_ktp_file.pdf"
                            style="width:100%; height:500px;" frameborder="0"></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script_javascript')
    <script>

        function downloadSlip(url_slip) {
            var dlink = document.createElement("a");
            dlink.href = `file/slips/${url_slip}`;
            dlink.setAttribute("download", "");
            dlink.click();
        }


        function refreshTable(ui_year, ui_month, ui_day) {
            setUIdate(ui_year, ui_month, ui_day)
            let _token = $('meta[name="csrf-token"]').attr('content');

            $('#slips').empty()

            conLog('abn', ui_dataset.ui_dataset.user_authentication.auth_login)
            $.ajax({
                url: '/api/mbg/slip/data',
                type: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'auth_login': ui_dataset.ui_dataset.user_authentication.auth_login
                    // Add other custom headers if needed
                },
                data: JSON.stringify({
                    _token: _token,
                    year: ui_dataset.ui_dataset.ui_date.year
                }),
                success: function(response) {
                    let slips = response.data;
                    if (Object.keys(slips).length > 0) {
                        $('#no-slips').remove()
                        slips.forEach(element => {
                            conLog('aa', element);
                            $('#slips').append(`
                                <li class="d-flex align-items-center justify-content-between">
                                <div class="name-avatar d-flex align-items-center pr-2">
                                    <div class="txt">
                                        <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                            style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">${element.month} - ${element.year}</span>
                                        <div class="font-14 weight-600">${months[element.month]}</div>
                                    </div>
                                </div>
                                <div class="cta flex-shrink-0">
                                    <a href="#" onclick="downloadSlip('${element.original_file}')" class="btn btn-sm btn-outline-primary">Unduh</a>
                                    <a href="#" onclick="showdoc('${element.original_file}')" class="btn btn-sm btn-outline-primary">Lihat</a>
                                </div>
                            </li>
                        `);
                            conLog('bbbb', 'sss')
                        });
                    } else {
                        conLog('aaa', 'sss')
                        $('#slips').append(`
                            <div class="txt" id="no-slips">
                                <div class="font-14 weight-600">Tidak ada slip</div>                    
                            </div>
                        `)
                    }
                }
            });

        }

        function showdoc(path) {
            $('#path_doc').attr("src", "{{ env('APP_URL') }}file/slips/" + path)
            $('#doc').modal('show')
        }

        setUImonthYear()
        refreshTable(ui_dataset.ui_dataset.ui_date.year, ui_dataset.ui_dataset.ui_date.month, ui_dataset.ui_dataset.ui_date
            .day)
    </script>
@endsection()
