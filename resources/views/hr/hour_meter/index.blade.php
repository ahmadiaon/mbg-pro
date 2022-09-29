@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">

        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <div class="row">
                    <div class="col-6">
                        <h4 class="text-blue h4">Data Absen</h4>
                    </div>
                    <div class="col-4">
                        <div class="col-lg-6 col-md-12 col-sm-12">

                            <div class="btn-group">
                                <button type="button" class="btn btn-light">1</button>
                                <button type="button" class="btn btn-dark">2 <i
                                        class="icon-copy ion-ios-upload-outline"></i></button>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-light -toggle waves-effect"
                                        aria-expanded="false">
                                        <div class="row">
                                            <div class="col-5">
                                                Eksport
                                            </div>
                                            <div class="col-6">
                                                <i class="icon-copy ion-ios-upload-outline"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-light dropdown-toggle waves-effect"
                                        data-toggle="dropdown" aria-expanded="false">
                                        {{ $month_name }}<span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/admin-hr/absensi/1">Januari</a>
                                        <a class="dropdown-item" href="/admin-hr/absensi/2">Februari</a>
                                        <a class="dropdown-item" href="/admin-hr/absensi/3">Maret</a>
                                        <a class="dropdown-item" href="/admin-hr/absensi/4">April</a>
                                        <a class="dropdown-item" href="/admin-hr/absensi/5">Mei</a>
                                        <a class="dropdown-item" href="/admin-hr/absensi/6">Juni</a>
                                        <a class="dropdown-item" href="/admin-hr/absensi/7">Juli</a>
                                        <a class="dropdown-item" href="/admin-hr/absensi/8">Agustus</a>
                                        <a class="dropdown-item" href="/admin-hr/absensi/9">September</a>
                                        <a class="dropdown-item" href="/admin-hr/absensi/10">Oktober</a>
                                        <a class="dropdown-item" href="/admin-hr/absensi/11">November</a>
                                        <a class="dropdown-item" href="/admin-hr/absensi/12">Desember</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="button" onclick="addUnit()" class="btn" data-bgcolor="#3d464d"
                            data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(61, 70, 77);">
                            <i class="icon-copy fa fa-download" aria-hidden="true"></i> Uploud absen
                        </button>
                    </div>
                </div>
            </div>
            @if(session()->has('success'))
            <div class="alert alert-primary" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="pb-20">
                <table id="myTablse" class="table table-stripped">
                    <thead>
                        <tr>
                            <th class="">NIK Karyawan</th>
                            <th class="">Nama</th>
                            <th class="">Jabatan</th>
                            <th class="">DS</th>
                            <th class="">TA</th>
                            <th class="">TC</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- Simple Datatable End -->




        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
</div>


{{-- modal add unit --}}
<div class="modal fade" data-backdrop="false" id="add_unit_modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Upload Absensi
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>

            <div class="modal-body">
                <form action="/admin-hr/absensi" method="post" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <label>Select File to Upload <small class="warning text-muted">{{__('Please upload only
                                Excel (.xlsx or .xls) files')}}</small></label>
                        <div class="input-group">
                            <input type="file" required class="form-control" name="uploaded_file" id="uploaded_file">

                            <div class="input-group-append" id="button-addon2">
                                <button class="btn btn-primary square" type="submit"><i class="ft-upload mr-1"></i>
                                    Upload</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>


        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function addUnit() {
        $('#id_unit').val('');
        $('#unit').val('');
        $('#add_unit_modal').modal('show');

    }
</script>
<script>
    $(function() {
        $('#myTablse').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! url('http://192.168.8.80:8000/admin-hr/absensi-data/'.$month) !!}',
            columns: [
                { data: 'nik_employee', name: 'nik_employee' },
                { data: 'name', name: 'name' },
                { data: 'position', name: 'position' },
                { data: 'count_ds', name: 'count_ds' },
                { data: 'count_ta', name: 'count_ta' },
                { data: 'count_tc', name: 'count_tc' },
                { data: 'action', name: 'action' }
            ]
        });
    });
</script>
@endsection