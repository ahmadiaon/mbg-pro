@extends('dashboard.manage.layouts.table')
@section('container')
<div class="card-box mb-30">
    <div class="pd-20" style="padding-bottom: 60px;">
        <h4 style="position: absolute;" class="text-blue h4">Data {{ $title }}</h4>
    </div>
    <div class="pb-20">
        <div class="col-md-12 col-sm-12 text-right">
            <div class="dropdown">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    Selengkapnya
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" data-toggle="modal" data-target="#bd-example-modal-lg" href="#">Kirim
                        Data</a>
                    {{-- <a class="dropdown-item" href="#">Policies</a>
                    <a class="dropdown-item" href="#">View Assets</a> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="pb-20">
        <table id="myTablse" class="table table-stripped">
            <thead>
                <tr>
                    <th width="20%">Nama</th>
                    <th width="5%">Umur</th>
                    <th width="20%">No HP</th>
                    <th width="10%">Instagram</th>
                    <th width="30%">Komunitas</th>
                    <th width="12%">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
{{-- modal hapus --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">Are you sure you want to Delete this Registers?</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                            onclick="myClose()"><i class="fa fa-times"></i></button>
                        NO
                    </div>
                    <div class="col-6">
                        <form id="form_id" action="" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-check"></i></button>
                            YES
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Large modal -->
<div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="/bank-send" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Kirim Data Registrasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <!-- Default Basic Forms Start -->


                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Pilih Bank</label>
                        <div class="col-sm-12 col-md-10">
                            <select name="financial_service_uuid" class="custom-select col-12">
                                <option selected="">Bank Kalteng</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Dari Tanggal</label>
                        <div class="col-sm-12 col-md-10">
                            <input name="date_start" class="form-control date-picker" placeholder="Select Date"
                                type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Sampai Tanggal</label>
                        <div class="col-sm-12 col-md-10">
                            <input name="date_end" class="form-control date-picker" placeholder="Select Date"
                                type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Email Tujuan</label>
                        <div class="col-sm-12 col-md-10">
                            <input name="email" class="form-control" value="bootstrap@example.com" type="email">
                        </div>
                    </div>

                    <div class="collapse collapse-box" id="basic-form1">
                        <div class="code-box">
                            <div class="clearfix">
                                <a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left"
                                    data-clipboard-target="#copy-pre"><i class="fa fa-clipboard"></i> Copy Code</a>
                                <a href="#basic-form1" class="btn btn-primary btn-sm pull-right" rel="content-y"
                                    data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide
                                    Code</a>
                            </div>
                        </div>
                    </div>
                    <!-- Default Basic Forms End -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Kirim Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('javascripts')
<script>
    $(function() {
    $('#myTablse').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('bank-register-data') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'financial_service_uuid', name: 'financial_service_uuid' },
            { data: 'phone_number', name: 'phone_number' },
            { data: 'status', name: 'status' },
            { data: 'profession', name: 'profession' },
            { data: 'action', name: 'action' }
        ]
    });
});

</script>
<script>
    function myFunction(name,job) {
        // document.getElementById("demo").innerHTML = "Welcome " + name + ", the " + job + ".";
        $("#myModal").modal('show');
        var action  = "/bank-register/"+name;
        document.getElementById("form_id").action = action;
        console.log(name);
    }
    function myClose() {
        $("#myModal").modal('hide');
    }
</script>
@endsection
