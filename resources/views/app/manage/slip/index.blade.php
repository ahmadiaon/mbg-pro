@extends('app.layouts.main')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Manage Slip Gaji</h4>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <form id="fileForm" class="card-box pd-20" action="/web/manage/slip" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <h5 class="h5">Bulan / Tahun </h5>
                    <p>
                        bulan dan tahun upah yang di bayar
                    </p>
                    <input name="month-year" id="month-year" class="form-control month-picker" placeholder="Select Month"
                        type="text">
                </div>
                <div class="form-group">
                    <label>File slip .pdf</label>
                    <input class="form-control" type="file" id="fileInput" name="file[]" multiple>
                </div>
                <div id="successMessage" style="display: none;">
                    <p>PDF files uploaded successfully.</p>
                </div>
                <button type="button" onclick="uploadFiles()" class="btn btn-primary" id="uploadBtn">Upload</button>
            </form>
        </div>

    </div>
@endsection()

@section('script_javascript')
    <script>
        async function uploadFiles() {
            var fileInput = document.getElementById('fileInput');
            var files = fileInput.files;
            var maxSize = 4 * 1024 * 1024; // 20 MB
            var currentSize = 0;
            $('#successMessage').hide();
            startLoading();

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var formData = new FormData();
                var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                formData.append('_token', csrfToken);
                formData.append('file[]', file);
                // formData.append('file', file);
                formData.append('month-year', $(`#month-year`).val());
                await $.ajax({
                    url: '/web/manage/slip',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        let slips = response.data;
                        CL(i);
                    },
                    contentType: false,
                    processData: false,
                });
            }
            $('#successMessage').show();
            stopLoading();
        }
    </script>
@endsection()
