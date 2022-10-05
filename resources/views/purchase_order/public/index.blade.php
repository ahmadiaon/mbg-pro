@extends('template.admin.main')


@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>DataTable</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            DataTable
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="dropdown">
                    <a
                        class="btn btn-primary dropdown-toggle"
                        href="#"
                        role="button"
                        data-toggle="dropdown"
                    >
                        January 2018
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Export List</a>
                        <a class="dropdown-item" href="#">Policies</a>
                        <a class="dropdown-item" href="#">View Assets</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Simple Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Dokumentasi Penerimaan Barang PO</h4>
         
        </div>
        <div class="pb-20">
            <table id="myTablse" class="table table-stripped">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Nomor PO</th>
                        <th>Tanggal</th>
                        <th>Dokumen</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
            
            </table>
        </div>
    </div>
    <!-- Simple Datatable End -->
</div>




<!-- Modal -->
<div class="modal fade" id="doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4> 
        </div>
        <div class="modal-body">
          <div style="text-align: center;">
  <iframe id="path_doc" src="" 
  style="width:100%; height:500px;" frameborder="0"></iframe>
  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('js')
<script>
    function showdoc(path){
        $('#path_doc').attr("src", "{{env('APP_URL')}}purchase/pdf/"+path)
        $('#doc').modal('show')
    }
    $(function() {
           $('#myTablse').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ url(env('APP_URL').'purchase-order/data') }}',
               columns: [
                   { data: 'po_number', name: 'po_number' },
                   { data: 'date', name: 'date' }, 
                   { data: 'document', name: 'document' },              
                   { data: 'actionPublic', name: 'actionPublic' }
               ]
           });
       });
   
   </script>
@endsection