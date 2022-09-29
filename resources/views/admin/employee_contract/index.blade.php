@extends('layout.main_tables')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">

                    <div class="row">
                        <div class="col-6">
                            <h4 class="text-blue h4">Data People</h4>
                        </div>
                        <div class="col">
                            <div class="mb-0 float-right">
                                <a href="/admin/people/create" class="btn btn-primary">add</a>
                            </div>
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

                                <th class="">Nomor Kontrak</th>
                                <th class="">NIK Karyawan</th>
                                <th class="">Nama</th>
                                <th class="">Jabatan</th>
                                <th class="">Tgl. Mulai</th>
                                <th class="">Tgl. Selesai</th>
                                <th class="">Left</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- Simple Datatable End -->

            <!-- Export Datatable End -->
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
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
            ajax: '{!! route('employee-contract-data') !!}',
            columns: [
                { data: 'contract_number', name: 'contract_number' },
                { data: 'nik_employee', name: 'nik_employee' },
                { data: 'name', name: 'name' },
                { data: 'position', name: 'position' },
                { data: 'date_start_contract', name: 'date_start_contract' },
                { data: 'date_end_contract', name: 'date_end_contract' },
                { data: 'days_left', name: 'days_left' },
                { data: 'action', name: 'action' }
            ]
        });
    });
</script>
@endsection