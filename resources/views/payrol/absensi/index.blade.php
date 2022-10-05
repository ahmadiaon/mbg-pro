@extends('layout_adm.main')
@section('content')
<div class="main-container">

        <div class="pd-20 col-12 card-box mb-30">
         
            <div class="row">
                <div class="col-12">
                    <!-- Simple Datatable start -->
                        <div class="mb-30">
                            <div class="row mb-30">
                                <div class="col-3">
                                    <h4 class="text-blue h4">Absensi</h4>
                                </div>
                                <div class="col-9 text-right">
                                    <div class="btn-group">
                                        <div class="btn-group dropdown">
                                            <button
                                                type="button"
                                                class="btn btn-light dropdown-toggle waves-effect"
                                                data-toggle="dropdown"
                                                aria-expanded="false"
                                            >
                                                2022 <span class="caret"></span>
                                            </button>
                                            
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="/payrol/month/9/export">2021</a>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter" href="">2022</a>
                                            </div>
                                        </div>
                                        <div class="btn-group dropdown">
                                            <button
                                                type="button"
                                                class="btn btn-light dropdown-toggle waves-effect"
                                                data-toggle="dropdown"
                                                aria-expanded="false"
                                            >
                                                September <span class="caret"></span>
                                            </button>
                                            
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="/payrol/absensi/month/2022-08">Agustus</a>
                                                <a class="dropdown-item" href="/payrol/absensi/month/2022-09">September</a>
                                                <a class="dropdown-item" href="/payrol/absensi/month/2022-10">Oktober</a>
                                            </div>
                                        </div>
                                        <div class="btn-group dropdown">
                                            <button
                                                type="button"
                                                class="btn btn-light dropdown-toggle waves-effect"
                                                data-toggle="dropdown"
                                                aria-expanded="false"
                                            >
                                                Menu <span class="caret"></span>
                                            </button>
                                            
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="/payrol/absensi/month/export/{{$month}}/export">Export</a>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter" href="">Import</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="pb-20">
                                <table id="myTablse" class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th class="table-plus datatable-nosort">Names</th>
                                            <th>NIK</th>
                                            <th>Pay</th>
                                            <th>Unpay</th>
                                            <th>Cut</th>
                                            <th class="datatable-nosort">Action</th>
                                        </tr>
                                    </thead>
                                
                                </table>
                            </div>
                        </div>
                        <!-- Simple Datatable End -->
                </div>
            </div>
 
            <!-- Simple Datatable End -->
           
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <form action="/payrol/absensi/month/{{$month}}" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Import Absensi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Pilih Absensi</label>
                <input name="uploaded_file"
                    type="file"
                    class="form-control-file form-control height-auto"
                />
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </div>
    </form>
    </div>
  </div>
@endsection

@section('js')

<script>
    $(function() {
        $('#myTablse').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url(env('APP_URL').'payrol/absensi/month-data/'.$month) }}',
            // ajax:  '{!! url(env('APP_URL').'payrol/dataHourMeterMonth/'.$month) !!}',
            columns: [
                { data: 'names', name: 'names' },
                { data: 'nik_employee', name: 'nik_employee' },
                { data: 'DS', name: 'DS' },
                { data: 'DS', name: 'DS' },
                { data: 'DS', name: 'DS' },
                
                { data: 'action', name: 'action' },
            ]
        });
    });
</script>
@endsection