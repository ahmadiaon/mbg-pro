<div id="create-employee-salary" class="children-content">
    <form action="/employee-salary/store" id="form-employee-salary" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="employee_uuid" id="employee_uuid-employee-salary">
        <input type="text" name="uuid" id="uuid-employee-salary">
        <div class="min-height-200px">
            <div class="pd-20 card-box mb-20">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Gajih Karyawan</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-4 col-form-label">Gajih Pokok</label>
                            <div class="col-sm-12 col-md-8">
                                <input id="salary" name="salary" class="form-control" type="text"
                                    placeholder="3559000" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-4 col-form-label">Insentif</label>
                            <div class="col-sm-12 col-md-8">
                                <input id="insentif" name="insentif" class="form-control" type="text"
                                    placeholder="3559000" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-4 col-form-label">Tunjangan</label>
                            <div class="col-sm-12 col-md-8">
                                <input id="tunjangan" name="tunjangan" class="form-control" type="text"
                                    placeholder="3559000" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-4 col-form-label">HM</label>
                            <div class="col-sm-12 col-md-8">
                                <select name="hour_meter_price_uuid" id="hour_meter_price_uuid"
                                    class="custom-select2 form-control">

                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div id="element-premi">

                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-4 col-form-label">Mulai Digunakan</label>
                            <div class="col-sm-12 col-md-8">
                                <input id="date_start-employee-salary" name="date_start" class="form-control"
                                    type="date" placeholder="3559000" />
                            </div>
                        </div>
                        <button type="button" onclick="storeEmployeeSalary('employee-salary')"
                            class="btn btn-primary btn-block">Simpan</button>
                    </div>
                </div>
            </div>
        </div>




    </form>
</div>
