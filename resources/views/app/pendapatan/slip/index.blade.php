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
                            <a class="dropdown-item" onclick="refreshTable(2024,null,null)" href="#">2024</a> <a class="dropdown-item" onclick="refreshTable(2025,null,null)" href="#">2025</a>
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
                <div class="modal-header" id="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Slip</h4>
                    <button type="button"class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body text-center">
                    <canvas id="pdf-canvas" class="d-block"></canvas>
                    <button id="changeWidth" onclick="changeWidth()"  class="btn btn-secondary">lihat</button>
                    {{-- <div style="text-align: center;">
                        <iframe id="path_doc" src="http://192.168.8.135:8000/file/document/employee/01_ktp_file.pdf"
                            style="width:100%; height:500px;" frameborder="0"></iframe>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script_javascript')
    <script src="/vendors/scripts/pdf.min.js"></script>

    <script>
        function downloadSlip(url_slip, month_year) {
            CL(url_slip)
            var dlink = document.createElement("a");
            dlink.href = `/file/slips/${url_slip}`;
            dlink.setAttribute("download", month_year + ".pdf");
            dlink.download = month_year + ".pdf";
            // document.getElementById("downloadLink").download = "new-file-name.pdf";
            dlink.click();
        }

        function changeWidth(){
            let width_header = $('#modal-header').width();
            $('#pdf-canvas').width(width_header);
            $('#changeWidth').attr('hidden',true)
            CL(width_header);
        }


        function refreshTable(ui_year, ui_month, ui_day) {
            setUImonthYear();
            setUIdate(ui_year, ui_month, ui_day);
            let _token = $('meta[name="csrf-token"]').attr('content');

            $('#slips').empty()

            // conLog('abn', ui_dataset.ui_dataset.user_authentication.auth_login)
            $.ajax({
                url: '/api/mbg/slip/data',
                type: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'x-auth-login': ui_dataset.ui_dataset.user_authentication.auth_login
                    // Add other custom headers if needed
                },
                data: JSON.stringify({
                    _token: _token,
                    year: ui_dataset.ui_dataset.ui_date.year
                }),
                success: function(response) {
                    let slips = response.data;
                    // CL(response);
                    if (Object.keys(slips).length > 0) {
                        $('#no-slips').remove()
                        $('#slips').empty()
                        slips.forEach(element => {
                            // conLog('aa', element);
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
                                    <a href="#" onclick="downloadSlip('${element.original_file}', 'MBG-SLIP-${element.month}-${element.year}')" class="btn btn-sm btn-outline-primary">Unduh</a>
                                    <a href="#" onclick="showdoc('${element.original_file}')" class="btn btn-sm btn-outline-primary">Lihat</a>
                                </div>
                            </li>
                        `);
                            // conLog('bbbb', 'sss')
                        });
                    } else {
                        // conLog('aaa', 'sss')
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
            startLoading();
            $('#path_doc').attr("src", "{{ env('APP_URL') }}file/slips/" + path);
            
            let width_header = $('#modal-header').width();
            conLog('width_header',width_header);
            const pdfUrl = "/file/slips/" + path;
            $('#changeWidth').attr('hidden',false)
            pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
                // Fetch the first page of the PDF
                pdf.getPage(1).then(function(page) {
                    // Set canvas context
                    const canvas = document.getElementById('pdf-canvas');
                    const context = canvas.getContext('2d');

                    // Get the viewport of the page
                    const viewport = page.getViewport({
                        scale: 2
                    });

                    // // Set canvas dimensions
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;

                    // Render the page content into the canvas
                    const renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    page.render(renderContext).promise.then(function() {
                    //     // Convert canvas to image with specified width
                    //     const maxWidth = 100; // Set maximum width
                    //     const aspectRatio = canvas.width / canvas.height;
                    //     const width = Math.min(maxWidth, canvas.width);
                    //     const height = width / aspectRatio;

                    //     // Create new canvas with adjusted dimensions
                    //     const scaledCanvas = document.createElement('canvas');
                    //     const scaledContext = scaledCanvas.getContext('2d');
                    //     scaledCanvas.width = width;
                    //     scaledCanvas.height = height;

                    //     // Draw scaled canvas image
                    //     // scaledContext.drawImage(canvas, 0, 0, width, height);

                    //     // // Convert scaled canvas to data URL
                    //     // const imageDataUrl = scaledCanvas.toDataURL('image/jpeg');

                    //     // // Display image
                    //     // const imageContainer = document.getElementById('img-canvas');
                    //     // const img = new Image();
                    //     // img.src = imageDataUrl;
                    //     // img.width = width;
                    //     // img.height = height;
                    //     // imageContainer.appendChild(img);
                    });
                    $('#pdf-canvas').width(width_header);
                    $('#loading-modal').modal('hide');
                    $('#doc').modal('show');
                    CL($('#modal-header').width());
                });
            });
        }

        setUImonthYear()
        refreshTable(ui_dataset.ui_dataset.ui_date.year, ui_dataset.ui_dataset.ui_date.month, ui_dataset.ui_dataset.ui_date
            .day)
    </script>
@endsection()
