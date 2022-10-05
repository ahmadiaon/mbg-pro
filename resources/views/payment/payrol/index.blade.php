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
                                    <h4 class="text-blue h4">Pembayaran</h4>
                                </div>
                                <div class="col-9 text-right">
                                    <div class="btn-group">
                                        <div class="btn-group dropdown">
                                            <a href="/payrol/payment/create">
                                            <button 
                                         class="btn btn-primary mr-10">Tambah</button></a>
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
                                                <a class="dropdown-item" href="/payrol/hour-meter/2022-08">Agustus</a>
                                                <a class="dropdown-item" href="/payrol/hour-meter/2022-09">September</a>
                                                <a class="dropdown-item" href="/payrol/hour-meter/2022-10">Oktober</a>
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
                                                <a class="dropdown-item" href="/payrol/month/9/export">Export</a>
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
                                            <th class="table-plus datatable-nosort">Tanggal</th>
                                            <th>Kegiatan</th>
                                            <th>Description</th>
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
    <form action="/payrol/absensi/month/2022-09" method="post" enctype="multipart/form-data">
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

  <!-- Large modal -->
<div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">
                Large modal
            </h4>
            <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-hidden="true"
            >
                ×
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" class="form-control">
                    </div>
                   
                </div>
                <div class="col-6">
                    <div class="form-group ">
                        <label for="">Karyawan</label>
                        <select class="custom-select2" style="width:100%" name="employee_uuid" id="employee_uuid">
                            @if ($employees)
                                @foreach ($employees as $employee)
                                    <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                @endforeach
                            @endif
                            <option value="">pilih</option>
                        </select>
                    </div>
                </div>
                <div class="col-12"> 
                    <div class="form-group ">
                        <label for="">Nilai</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group ">
                        <label for="">Diketahui</label>
                        <select class="custom-select2" style="width:100%" name="known_employee_uuid" id="known_employee_uuid">
                            @if ($employees)
                                @foreach ($employees as $employee)
                                    <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                @endforeach
                            @endif
                            <option value="">pilih</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group ">
                        <label for="">Disetujui</label>
                        <select class="custom-select2" style="width:100%" name="approve_employee_uuid" id="approve_employee_uuid">
                            @if ($employees)
                                @foreach ($employees as $employee)
                                    <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                @endforeach
                            @endif
                            <option value="">pilih</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group ">
                        <label for="">Dibuat</label>
                        <select class="custom-select2" style="width:100%" name="create_employee_uuid" id="create_employee_uuid">
                            @if ($employees)
                                @foreach ($employees as $employee)
                                    <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                @endforeach
                            @endif
                            <option value="">pilih</option>
                        </select>
                    </div>
                </div>
                <div class="col-12"> 
                    <div class="form-group ">
                        <select class="custom-select2" style="width:100%" name="" id="">
                            @if ($employees)
                                @foreach ($employees as $employee)
                                    <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                @endforeach
                            @endif
                            <option value="">pilih</option>
                        </select>
                    </div>
                </div>
            </div>
           
        </div>
        <div class="modal-footer">
            <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
            >
                Close
            </button>
            <button type="button" class="btn btn-primary">
                Save changes
            </button>
        </div>
    </div>
</div>
</div>
@endsection

@section('js')

<script>
    $(function() {
        $('#myTablse').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url(env('APP_URL').'payrol/payment/month-data/'.$month) }}',
            // ajax:  '{!! url(env('APP_URL').'payrol/dataHourMeterMonth/'.$month) !!}',
            columns: [
                { data: 'date', name: 'date' },
                { data: 'description', name: 'description' },
                { data: 'payment_group', name: 'payment_group' },
                { data: 'action', name: 'action' },
            ]
        });
    });
</script>
@endsection