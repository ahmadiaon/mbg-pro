@extends('app.layouts.main')

@section('content')
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Manage Slip Gaji</h4>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <form id="pdfUploadForm" class="card-box pd-20" action="/web/manage/slip" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <h5 class="h5">Bulan / Tahun </h5>
                    <p>
                        bulan dan tahun upah yang di bayar
                    </p>
                    <input name="month-year" class="form-control month-picker" placeholder="Select Month" type="text">
                </div>
                <div class="form-group">
                    <label>File slip .pdf</label>
                    <input class="form-control" type="file" name="pdf_files[]" accept=".pdf" multiple>
                </div>
                <div id="successMessage" style="display: none;">
                    <p>PDF files uploaded successfully.</p>
                </div>
                <button type="button" class="btn btn-primary"  id="uploadBtn">Upload</button>
            </form>
        </div>

    </div>

  
@endsection()

@section('script_javascript')
    <script>
        $(document).ready(function() {
            $('#uploadBtn').click(function() {
                
                var formData = new FormData($('#pdfUploadForm')[0]);
                startLoading();
                $.ajax({
                    url: '/web/manage/slip',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // console.log(response);
                        stopLoading();
                        $('#successMessage').show();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection()
