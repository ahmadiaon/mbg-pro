<!DOCTYPE html>
<html>

<head>
    <title>PHPSpreadsheet in Laravel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
</head>

<body>
    <div class="container">
        <div class="card-header bg-secondary dark bgsize-darken-4 white card-header">
            <h4 class="text-white">Handling Excel Data using PHPSpreadsheet in Laravel</h4>
        </div>
        <div class="row justify-content-centre" style="margin-top: 4%">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bgsize-primary-4 white card-header">
                        <h4 class="card-title">Import Excel Data</h4>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        <br>
                        @endif
                        <form action="/generate-excel" method="post" enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <label>Select File to Upload <small class="warning text-muted">{{__('Please upload only
                                        Excel (.xlsx or .xls) files')}}</small></label>
                                <div class="input-group">
                                    <input type="file" required class="form-control" name="uploaded_file"
                                        id="uploaded_file">

                                    <div class="input-group-append" id="button-addon2">
                                        <button class="btn btn-primary square" type="submit"><i
                                                class="ft-upload mr-1"></i> Upload</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script>
            $(document).ready(function() {
           $('#example').DataTable();
       } );
        </script>
</body>

</html>