@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="col-8">
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Table Simple</h4>
                    <p class="mb-0">
                        you can find more options
                        <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a>
                    </p>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Date</th>
                                <th>Shift</th>
                                <th>Status</th>
                                <th>Cek Log</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <td class="table-plus"></td>
                                <td></td>
                                <td>
                                    <div class="row">
                                        <div class="col-2">
                                            
                                        </div>
                                        <div class="col">
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <form action="/admin-hr/absensi-edit" method="POST"
                                                        id="absensi-">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="">
                                                        <input type="hidden" name="month"
                                                            value="">
                                                        <input type="hidden" name="nik_employee"
                                                            value="">
                                                        <input type="hidden" name="machine_id"
                                                            value="">
                                                        <input type="hidden" name="date_year"
                                                            value="">
                                                        <input type="hidden" name="date_month"
                                                            value="">
                                                        <input type="hidden" name="date_date"
                                                            value="">
                                                        <button type="submit" name="status" value="DS"
                                                            class="dropdown-item">DS</button>
                                                        <button type="submit" name="status" value="TC"
                                                            class="dropdown-item">TC</button>
                                                        <button type="submit" name="status" value="TA"
                                                            class="dropdown-item">TA</button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Simple Datatable End -->
        </div>


        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
</div>

@endsection

@section('js')
@endsection