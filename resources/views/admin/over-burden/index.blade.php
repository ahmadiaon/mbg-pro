@extends('layout.main_tables')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="row">
                {{-- kiri ui --}}
                <div class="col-6">
                    <!-- Simple over burden start -->
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
                        <div class="pb-20">
                            <table id="myTablse" class="table table-stripped">
                                <thead>
                                    <tr>

                                        <th class="table-plus datatable-nosort">Name</th>
                                        <th>Phone Number</th>
                                        <th>NIK</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- Simple over burden End -->
                </div>
                <div class="col-6">
                    <div class="card-box mb-30">
                        <div class="pd-20">
                            <form>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input class="form-control date-picker" placeholder="OB Date" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Shift</label>
                                            <select name="shift_ob" id="shift_ob">
                                                <option value="siang">siang</option>
                                                <option value="malam">malam</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="container">
                                        <h6 class="text-center">Kapasitas</h6>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-3">
                                        <div class="form-group">
                                            <select class="custom-select2 form-control" name="state"
                                                style="width: 100%; height: 38px">
                                                <option value="">Excavator</option>
                                                <option value="">DT-001</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <select class="custom-select2 form-control" name="state"
                                                style="width: 100%; height: 38px">
                                                <option value="">Kapasitas</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <select class="custom-select2 form-control" name="state"
                                                style="width: 100%; height: 38px">
                                                <option value="">Carrier</option>
                                                <option value="">DT-001</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <select class="custom-select2 form-control" name="state"
                                                style="width: 100%; height: 38px">
                                                <option value="">Kapasitas</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <select class="custom-select2 form-control" name="state"
                                                style="width: 100%; height: 38px">
                                                <option value="">Carrier</option>
                                                <option value="">DT-001</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <select class="custom-select2 form-control" name="state"
                                                style="width: 100%; height: 38px">
                                                <option value="">Kapasitas</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <select class="custom-select2 form-control" name="state"
                                                style="width: 100%; height: 38px">
                                                <option value="">Carrier</option>
                                                <option value="">DT-001</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <select class="custom-select2 form-control" name="state"
                                                style="width: 100%; height: 38px">
                                                <option value="">Kapasitas</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Material</label>
                                            <select class="custom-select2 form-control" name="state"
                                                style="width: 100%; height: 38px">
                                                <option value="OB">OB</option>
                                                <option value="Top Soil">Top Soil</option>
                                                <option value="Lumpur">Lumpur</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <input class="form-control date-picker" placeholder="Select Date"
                                                type="text" />
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Jarak</label>
                                            <input class="form-control date-picker" placeholder="Select Date"
                                                type="text" />
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div class="card-box mb-10">
                        <div class="pd-20">
                            <div class="row mb-10">
                                <div class="col-2"><button data-backdrop="false" data-toggle="modal"
                                        data-target="#bd-example-modal-lg" class="btn-lg btn-primary"> 6</button></div>
                                <div class="col-2"><button class="btn-lg btn-primary"> 7</button></div>
                                <div class="col-2"><button class="btn-lg btn-primary"> 8</button></div>
                                <div class="col-2"><button class="btn-lg btn-primary"> 9</button></div>
                                <div class="col-2"><button class="btn-lg btn-primary">10</button></div>
                                <div class="col-2"><button class="btn-lg btn-primary">11</button></div>
                            </div>
                            <div class="row">
                                <div class="col-2"><button class="btn-lg btn-primary">12</button></div>
                                <div class="col-2"><button class="btn-lg btn-primary">13</button></div>
                                <div class="col-2"><button class="btn-lg btn-primary">14</button></div>
                                <div class="col-2"><button class="btn-lg btn-primary">15</button></div>
                                <div class="col-2"><button class="btn-lg btn-primary">16</button></div>
                                <div class="col-2"><button class="btn-lg btn-primary">17</button></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box mb-10">
                        <div class="pd-20">
                            <div class="row">
                                <div class="col-4"><label for="">Checker</label>
                                    <div class="from-group">
                                        <select class="select-costum2" name="" id="">
                                            <option value="Ahmadi">Ahmadi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4"><label for="">Foreman</label></div>
                                <div class="col-4"><label for="">Supervisor</label></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Export Datatable End -->
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
</div>


<div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Large modal
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Employee</label>
                            <select class="custom-select2 form-control" name="state" style="width: 100%; height: 38px">
                                <option value="">DT-001</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Unit</label>
                            <select class="custom-select2 form-control" name="state" style="width: 100%; height: 38px">
                                <option value="">DT-001</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kapasitas</label>
                            <select class="custom-select2 form-control" name="state" style="width: 100%; height: 38px">
                                <option value="">DT-001</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2 pd-1"><button class="btn btn-primary ">3</button></div>
                            <div class="col-2 pd-1"><button class="btn btn-primary ">3</button></div>
                            <div class="col-2 pd-1"><button class="btn btn-primary ">3</button></div>
                            <div class="col-2 pd-1"><button class="btn btn-primary ">3</button></div>
                            <div class="col-2 pd-1"><button class="btn btn-primary ">3</button></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2 pd-1"><button class="btn btn-primary ">3</button></div>
                            <div class="col-2 pd-1"><button class="btn btn-primary ">3</button></div>
                            <div class="col-2 pd-1"><button class="btn btn-primary ">3</button></div>
                            <div class="col-2 pd-1"><button class="btn btn-primary ">3</button></div>
                            <div class="col-2 pd-1"><button class="btn btn-primary ">3</button></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2 pd-1"><button class="btn btn-primary ">3</button></div>
                            <div class="col-2 pd-1"><button class="btn btn-primary ">3</button></div>
                            <div class="col-2 pd-1"><button class="btn btn-primary ">3</button></div>
                            <div class="col-2 pd-1"><button class="btn btn-primary ">3</button></div>
                            <div class="col-2 pd-1"><button class="btn btn-primary ">3</button></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-20">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                        </div>
                    </div>
                </div>
                {{-- --}}
                <div class="row mb">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                            <div class="col-2"><button class="btn btn-primary">3</button></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
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
            ajax: '{!! route('people-data') !!}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'nik_number', name: 'nik_number' },
                { data: 'poh_place', name: 'poh_place' },
                { data: 'action', name: 'action' }
            ]
        });
    });
</script>
@endsection