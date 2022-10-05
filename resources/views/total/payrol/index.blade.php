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
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Absen</th>
                                            <th>HM</th>
                                            
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