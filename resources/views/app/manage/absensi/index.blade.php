@extends('app.layouts.main')

@section('content')
 

    <div class="faq-wrap">
        <h4 class="mb-20 h4 text-blue">Accordion example</h4>
        <div id="accordion">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-block" data-toggle="collapse" data-target="#filter-manage-absensi">
                        Filter data absesnsi
                    </button>
                </div>
                <div id="filter-manage-absensi" class="collapse" data-parent="#accordion">
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="text-blue h4">Filter</h4>
                                        <p class="mb-30">filter untuk penyesuaian data yang ditampilkan</p>
                                    </div>
                                </div>
                                <form>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-3 col-form-label">Perusahaan</label>
                                        <div class="col-sm-12 col-md-9">
                                            <select class="selectpicker form-control" data-size="5" data-style="btn-outline-warning"
                                                multiple data-actions-box="true" data-selected-text-format="count">
                                                <optgroup label="Condiments">
                                                    <option>Mustard</option>
                                                    <option>Ketchup</option>
                                                    <option>Relish</option>
                                                </optgroup>
                                                <optgroup label="Breads">
                                                    <option>Plain</option>
                                                    <option>Steamed</option>
                                                    <option>Toasted</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-3 col-form-label">Site</label>
                                        <div class="col-sm-12 col-md-9">
                                            <select class="selectpicker form-control" data-size="5" data-style="btn-outline-warning"
                                                multiple data-actions-box="true" data-selected-text-format="count">
                                                <optgroup label="Condiments">
                                                    <option>Mustard</option>
                                                    <option>Ketchup</option>
                                                    <option>Relish</option>
                                                </optgroup>
                                                <optgroup label="Breads">
                                                    <option>Plain</option>
                                                    <option>Steamed</option>
                                                    <option>Toasted</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-3 col-form-label">Status Absen</label>
                                        <div class="col-sm-12 col-md-9">
                                            <select class="selectpicker form-control" data-size="5" data-style="btn-outline-warning"
                                                multiple data-actions-box="true" data-selected-text-format="count">
                                                <optgroup label="Condiments">
                                                    <option>Mustard</option>
                                                    <option>Ketchup</option>
                                                    <option>Relish</option>
                                                </optgroup>
                                                <optgroup label="Breads">
                                                    <option>Plain</option>
                                                    <option>Steamed</option>
                                                    <option>Toasted</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-3 col-form-label">Admin Absen</label>
                                        <div class="col-sm-12 col-md-9">
                                            <select class="selectpicker form-control" data-size="5" data-style="btn-outline-warning"
                                                multiple data-actions-box="true" data-selected-text-format="count">
                                                <optgroup label="Condiments">
                                                    <option>Mustard</option>
                                                    <option>Ketchup</option>
                                                    <option>Relish</option>
                                                </optgroup>
                                                <optgroup label="Breads">
                                                    <option>Plain</option>
                                                    <option>Steamed</option>
                                                    <option>Toasted</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-3 col-form-label">Departemen</label>
                                        <div class="col-sm-12 col-md-9">
                                            <select class="selectpicker form-control" data-size="5" data-style="btn-outline-warning"
                                                multiple data-actions-box="true" data-selected-text-format="count">
                                                <optgroup label="Condiments">
                                                    <option>Mustard</option>
                                                    <option>Ketchup</option>
                                                    <option>Relish</option>
                                                </optgroup>
                                                <optgroup label="Breads">
                                                    <option>Plain</option>
                                                    <option>Steamed</option>
                                                    <option>Toasted</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-3 col-form-label">Jabatan</label>
                                        <div class="col-sm-12 col-md-9">
                                            <select class="selectpicker form-control" data-size="5" data-style="btn-outline-warning"
                                                multiple data-actions-box="true" data-selected-text-format="count">
                                                <optgroup label="Condiments">
                                                    <option>Mustard</option>
                                                    <option>Ketchup</option>
                                                    <option>Relish</option>
                                                </optgroup>
                                                <optgroup label="Breads">
                                                    <option>Plain</option>
                                                    <option>Steamed</option>
                                                    <option>Toasted</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-3 col-form-label">Rentang</label>
                                        <div class="col-sm-12 col-md-9">
                                            <select class="selectpicker form-control" data-size="5" data-style="btn-outline-warning"
                                                multiple data-actions-box="true" data-selected-text-format="count">
                                                <optgroup label="Condiments">
                                                    <option>Mustard</option>
                                                    <option>Ketchup</option>
                                                    <option>Relish</option>
                                                </optgroup>
                                                <optgroup label="Breads">
                                                    <option>Plain</option>
                                                    <option>Steamed</option>
                                                    <option>Toasted</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-4 col-form-label">Dari Tanggal</label>
                                        <div class="col-sm-12 col-md-4">
                                            <input class="form-control" type="date" placeholder="Johnny Brown">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-md-4 col-form-label">Sampai Tanggal</label>
                                        <div class="col-sm-12 col-md-4">
                                            <input class="form-control" type="date" placeholder="Johnny Brown">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#data-table-manage-absensi">
                        data table absensi karyawan
                    </button>
                </div>

                <div id="data-table-manage-absensi" class="collapse show" data-parent="#accordion">
                    <div class="card-body">
                        <div class="pb-20">
                            <table class="data-table table hover multiple-select-row nowrap">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort">Name</th>
                                        <th>Age</th>
                                        <th>Office</th>
                                        <th>Address</th>
                                        <th>Start Date</th>
                                        <th>Salart</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="table-plus">Gloria F. Mead</td>
                                        <td>25</td>
                                        <td>Sagittarius</td>
                                        <td>2829 Trainer Avenue Peoria, IL 61602</td>
                                        <td>29-03-2018</td>
                                        <td>$162,700</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            
        
        </div>
    </div>
@endsection()

@section('script_javascript')
    <script>
        async function uploadFiles() {
            var fileInput = document.getElementById('fileInput');
            var files = fileInput.files;
            var maxSize = 4 * 1024 * 1024; // 20 MB
            var currentSize = 0;
            $('#successMessage').hide();
            startLoading();

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var formData = new FormData();
                var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                formData.append('_token', csrfToken);
                formData.append('file[]', file);
                // formData.append('file', file);
                formData.append('month-year', $(`#month-year`).val());
                await $.ajax({
                    url: '/web/manage/slip',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                });
                $('#successMessage').show();
                stopLoading();
            }
        }
    </script>
@endsection()
