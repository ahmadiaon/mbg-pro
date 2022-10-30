@extends('template.admin.main_privilege')
@section('css')

<link rel="stylesheet" type="text/css" href="/src/plugins/cropperjs/dist/cropper.css" />
@endsection

@section('content')
<div class="mb-30">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="card-box height-100-p overflow-hidden">
            <div class="profile-tab height-100-p">
                <div class="tab height-100-p">
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#timeline"
                                role="tab">Timeline</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Tasks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#setting" role="tab">Settings</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Timeline Tab start -->
                        <div class="tab-pane fade show active pd-20" id="timeline" role="tabpanel">
                            <form action="/safety/store" method="POST">
                                @csrf
                                <input type="text" name="isEdit" id="isEdit" value="">
                                <input type="text" name="nik_employee" id="nik_employee" value="">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="text-blue h4">Nomor Lisensi</h4>
                                    </div>
                                    @if(session('success'))
                                    <div class="pull-right">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Data Tersimpan</strong> 
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Jenis Atribut</label>
                                                    <input disabled class="form-control" value="ID Card">
                                                    @error('group_license')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>No Reg</label>
                                                    <input name="no_reg"
                                                        class="form-control @error('no_reg') is-invalid @enderror"
                                                        value="{{ old('no_reg') }}" id="no_reg" placeholder="MP-001"
                                                        type="text">
                                                    <div class="invalid-feedback" id="req-no_reg">
                                                        Data tidak boleh kosong
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tgl. Diperoleh</label>
                                                    <input name="date"
                                                        class="form-control @error('date') is-invalid @enderror"
                                                        value="{{ old('date') }}" id="date" 
                                                        type="date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Jenis Atribut</label>
                                                    <input disabled class="form-control" value="Rompi">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="selectpicker form-control " name="rompi_status" id="rompi_status">
                                                        <option value="Diperoleh">Diperoleh</option>
                                                        <option value="Belum diperoleh">Belum diperoleh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tgl. Diperoleh</label>
                                                    <input name="rompi_date"
                                                    class="form-control @error('rompi_date') is-invalid @enderror"
                                                    value="{{ old('rompi_date') }}" id="rompi_date" 
                                                    type="date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Jenis Atribut</label>
                                                    <input disabled class="form-control" value="Helm">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Warna Helm</label>
                                                    <select class="selectpicker form-control " name="helm_color" id="helm_color">
                                                        <option value="">Belum diperoleh</option>
                                                        @foreach ($unit_warna as $helm)
                                                        <option value="{{ $helm->uuid}}">{{ $helm->uuid}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tgl. Diperoleh</label>
                                                    <input name="helm_date"
                                                        class="form-control @error('helm_date') is-invalid @enderror"
                                                        value="{{ old('helm_date') }}" id="helm_date" placeholder="Muara Teweh"
                                                        type="date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Jenis Atribut</label>
                                                    <input disabled class="form-control" value="Sepatu">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Ukuran Sepatu</label>
                                                    <select class="selectpicker form-control " name="boots_size" id="boots_size">
                                                        <option value="">Belum diperoleh</option>
                                                        @foreach ($unit_angka as $helm)
                                                        <option value="{{ $helm->uuid}}">{{ $helm->uuid}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tgl. Diperoleh</label>
                                                    <input name="boots_date"
                                                        class="form-control @error('boots_date') is-invalid @enderror"
                                                        value="{{ old('boots_date') }}" id="boots_date" placeholder="Muara Teweh"
                                                        type="date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Jenis Atribut</label>
                                                    <input disabled class="form-control" value="Orange">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Ukuran Orange</label>
                                                    <select class="selectpicker form-control " name="orange_size" id="orange_size">
                                                        <option value="">Belum diperoleh</option>
                                                        @foreach ($unit_huruf as $helm)
                                                        <option value="{{ $helm->uuid}}">{{ $helm->uuid}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tgl. Diperoleh</label>
                                                    <input name="orange_date"
                                                        class="form-control @error('orange_date') is-invalid @enderror"
                                                        value="{{ old('orange_date') }}" id="orange_date" placeholder="Muara Teweh"
                                                        type="date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Jenis Atribut</label>
                                                    <input disabled class="form-control" value="Biru">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Ukuran Kemeja Biru</label>
                                                    <select class="selectpicker form-control " name="blue_size" id="blue_size">
                                                        <option value="">Belum diperoleh</option>
                                                        @foreach ($unit_huruf as $helm)
                                                        <option value="{{ $helm->uuid}}">{{ $helm->uuid}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tgl. Diperoleh</label>
                                                    <input name="blue_date"
                                                        class="form-control @error('blue_date') is-invalid @enderror"
                                                        value="{{ old('blue_date') }}" id="blue_date" placeholder="Muara Teweh"
                                                        type="date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Jenis Atribut</label>
                                                    <input disabled class="form-control" value="Kaos">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Ukuran Kaos</label>
                                                    <select class="selectpicker form-control " name="shirt_size" id="shirt_size">
                                                        <option value="">Belum diperoleh</option>
                                                        @foreach ($unit_huruf as $helm)
                                                        <option value="{{ $helm->uuid}}">{{ $helm->uuid}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tgl. Diperoleh</label>
                                                    <input name="shirt_date"
                                                        class="form-control @error('shirt_date') is-invalid @enderror"
                                                        value="{{ old('shirt_date') }}" id="shirt_date" placeholder="Muara Teweh"
                                                        type="date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Jenis Atribut</label>
                                                    <input disabled class="form-control" value="Mekanik">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Ukuran Kemeja Biru</label>
                                                    <select class="selectpicker form-control " name="mekanik_size" id="mekanik_size">
                                                        <option value="">Belum diperoleh</option>
                                                        @foreach ($unit_huruf as $helm)
                                                        <option value="{{ $helm->uuid}}">{{ $helm->uuid}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tgl. Diperoleh</label>
                                                    <input name="mekanik_date"
                                                        class="form-control @error('mekanik_date') is-invalid @enderror"
                                                        value="{{ old('mekanik_date') }}" id="mekanik_date" placeholder="Muara Teweh"
                                                        type="date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-mb-12  text-right">
                                            <button type="submit" class="btn btn-primary mt-30 ">Next Step</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Timeline Tab End -->
                        <!-- Tasks Tab start -->
                        <div class="tab-pane fade" id="tasks" role="tabpanel">
                            <div class="pd-20 card-box mb-30">
                                <!-- Content -->
                                <div class="row">
                                    <div class="col-md-5" id="prev-image">
                                        <div class="form-group ">   
                                            <div class="da-card box-shadow">
                                                <div class="da-card-photo">
                                                    <img id="galery-view"
                                                        src="{{ env('APP_URL') }}vendors/images/default.jpg"
                                                        alt="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-8" id="imagess">
                                        <!-- <h3>Demo:</h3> -->
                                        <div class="img-container">
                                            <img src="{{ env('APP_URL') }}vendors/images/default.jpg" id="image" alt="Picture" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3">
                                        <!-- <h3>Preview:</h3> -->
                                        <div class="docs-preview clearfix">
                                            <div class="img-preview preview-lg"></div>
                                            <div class="img-preview preview-md"></div>
                                            <div class="img-preview preview-sm"></div>
                                            <div class="img-preview preview-xs"></div>
                                        </div>
                
                                        <!-- <h3>Data:</h3> -->
                                        <!-- <h3>Data:</h3> -->
                                        <div class="docs-data" >
                                            <div class="input-group input-group-sm">   
                                                <input type="hidden" class="form-control" id="dataX" placeholder="x" />
                                            </div>
                                            <div class="input-group input-group-sm">
                                                <input type="hidden" class="form-control" id="dataY" placeholder="y" />
                                            </div>
                                            <div class="input-group input-group-sm">
                                                <input type="hidden" class="form-control" id="dataWidth" placeholder="width" />
                                            </div>
                                            <div class="input-group input-group-sm">
                                               
                                                <input type="hidden" class="form-control" id="dataHeight" placeholder="height" />
                                                
                                                
                                                
                                            </div>
                                            <div class="input-group input-group-sm">
                                               
                                               
                                               
                                                <input type="hidden" class="form-control" id="dataRotate" placeholder="rotate" />
                                                
                                                
                                                
                                            </div>
                                            <div class="input-group input-group-sm">
                                               
                                               
                                               
                                                <input type="hidden" class="form-control" id="dataScaleX" placeholder="scaleX" />
                                            </div>
                                            <div class="input-group input-group-sm">
                                               
                                               
                                               
                                                <input type="hidden" class="form-control" id="dataScaleY" placeholder="scaleY" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row" id="actions">
                                    <div class="col-sm-12 col-md-12 col-lg-9 docs-buttons">
                                        <div class="btn-group">
                                            <label onclick="shows()" class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                                <input  type="file" class="sr-only" id="inputImage" name="file"
                                                    accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff" />
                                                <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
                                                    <span class="fa fa-upload"></span>
                                                </span>
                                            </label>
                                              <button type="button" class="btn btn-success" data-method="getCroppedCanvas"
                                                data-option='{ "maxWidth": 4096, "maxHeight": 4096 }'>
                                                <span class="docs-tooltip" data-toggle="tooltip"
                                                    title="cropper.getCroppedCanvas({ maxWidth: 4096, maxHeight: 4096 })">
                                                    Simpan Gambar
                                                </span>
                                            </button> 
                                        </div>
                
                                        <div class="btn-group btn-group-crop">
                                          
                                            <div class="col-sm-2 col-md-2 col-lg-2 docs-toggles" >
                                                <!-- <h3>Toggles:</h3> -->
                                                <div class="btn-group d-flex flex-wrap" data-toggle="buttons">
                                                    <label class="btn btn-primary"  id="clickhere" onclick="hides()">
                                                        <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio"
                                                            value="0.6666666666666666" />
                                                        <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 2 / 3">
                                                            Show
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>                                   
                                        </div>

                                       
                
                                        <!-- Show the cropped image in modal -->
                                        <div class="modal fade docs-cropped" id="getCroppedCanvasModal" role="dialog" aria-hidden="true"
                                            aria-labelledby="getCroppedCanvasTitle" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="/safety/image-store" method="POST" enctype="multipart/form-data" id="form-upload-image">
                                                   @csrf
                                                        <input type="text" name="nik_employee" id="nik_employee_image">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="getCroppedCanvasTitle">
                                                            Cropped
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body" id="image-canvas">
                                                      
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <a class="btn btn-primary" id="download" onclick="globalStore('upload-image')" href="javascript:void(0);"
                                                            download="cropped.jpg">Upload & Download</a>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- /.docs-buttons -->
                
                                    
                                    <!-- /.docs-toggles -->
                                </div>
                            </div>
                        </div>
                        <!-- Tasks Tab End -->
                        <!-- Setting Tab start -->
                        <div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
                            <div class="profile-setting">
                                <form>
                                    <ul class="profile-edit-list row">
                                        <li class="weight-500 col-md-6">
                                            <h4 class="text-blue h5 mb-20">
                                                Edit Your Personal Setting
                                            </h4>
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input class="form-control form-control-lg" type="text" />
                                            </div>
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input class="form-control form-control-lg" type="text" />
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control form-control-lg" type="email" />
                                            </div>
                                            <div class="form-group">
                                                <label>Date of birth</label>
                                                <input class="form-control form-control-lg date-picker"
                                                    type="text" />
                                            </div>
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <div class="d-flex">
                                                    <div class="custom-control custom-radio mb-5 mr-20">
                                                        <input type="radio" id="customRadio4"
                                                            name="customRadio"
                                                            class="custom-control-input" />
                                                        <label class="custom-control-label weight-400"
                                                            for="customRadio4">Male</label>
                                                    </div>
                                                    <div class="custom-control custom-radio mb-5">
                                                        <input type="radio" id="customRadio5"
                                                            name="customRadio"
                                                            class="custom-control-input" />
                                                        <label class="custom-control-label weight-400"
                                                            for="customRadio5">Female</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select class="selectpicker form-control form-control-lg"
                                                    data-style="btn-outline-secondary btn-lg"
                                                    title="Not Chosen">
                                                    <option>United States</option>
                                                    <option>India</option>
                                                    <option>United Kingdom</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>State/Province/Region</label>
                                                <input class="form-control form-control-lg" type="text" />
                                            </div>
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input class="form-control form-control-lg" type="text" />
                                            </div>
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input class="form-control form-control-lg" type="text" />
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Visa Card Number</label>
                                                <input class="form-control form-control-lg" type="text" />
                                            </div>
                                            <div class="form-group">
                                                <label>Paypal ID</label>
                                                <input class="form-control form-control-lg" type="text" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customCheck1-1" />
                                                    <label class="custom-control-label weight-400"
                                                        for="customCheck1-1">I agree to receive notification
                                                        emails</label>
                                                </div>
                                            </div>
                                            <div class="form-group mb-0">
                                                <input type="submit" class="btn btn-primary"
                                                    value="Update Information" />
                                            </div>
                                        </li>
                                        <li class="weight-500 col-md-6">
                                            <h4 class="text-blue h5 mb-20">
                                                Edit Social Media links
                                            </h4>
                                            <div class="form-group">
                                                <label>Facebook URL:</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    placeholder="Paste your link here" />
                                            </div>
                                            <div class="form-group">
                                                <label>Twitter URL:</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    placeholder="Paste your link here" />
                                            </div>
                                            <div class="form-group">
                                                <label>Linkedin URL:</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    placeholder="Paste your link here" />
                                            </div>
                                            <div class="form-group">
                                                <label>Instagram URL:</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    placeholder="Paste your link here" />
                                            </div>
                                            <div class="form-group">
                                                <label>Dribbble URL:</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    placeholder="Paste your link here" />
                                            </div>
                                            <div class="form-group">
                                                <label>Dropbox URL:</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    placeholder="Paste your link here" />
                                            </div>
                                            <div class="form-group">
                                                <label>Google-plus URL:</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    placeholder="Paste your link here" />
                                            </div>
                                            <div class="form-group">
                                                <label>Pinterest URL:</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    placeholder="Paste your link here" />
                                            </div>
                                            <div class="form-group">
                                                <label>Skype URL:</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    placeholder="Paste your link here" />
                                            </div>
                                            <div class="form-group">
                                                <label>Vine URL:</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    placeholder="Paste your link here" />
                                            </div>
                                            <div class="form-group mb-0">
                                                <input type="submit" class="btn btn-primary"
                                                    value="Save & Update" />
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- Setting Tab End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')


    
<script src="{{ env('APP_URL') }}src/plugins/cropperjs/dist/cropper.js"></script>
<script src="{{ env('APP_URL') }}src/plugins/cropperjs/dist/cropper-init.js"></script>

<script>
    
    function hides(){
        $('#prev-image').hide();
        $('#imagess').show();
    }
    function clicked(){
        console.log('herer');
        $('#clickhere').click()

    }
    // $('#aspectRatio4').click();
    $('#imagess').hide();
    function shows(){
        // $('#clickhere').click();
        console.log('udin');
        $('#prev-image').hide();
        $('#imagess').show();
        $('#clickhere').click()
        // $('#prev-image').hide();
    }
    
    function clicc(){
        $('#clickhere').click();
        $('#image-canvas').children("canvas").attr('id','ii');
        let image_data_url = document.querySelector("#ii").toDataURL();
        console.log(image_data_url);
        // $('#image-file').val(image_data_url)

    }
    function globalStore(idForm){

        $('#image-canvas').children("canvas").attr('id','ii');
        let image_data_url = document.querySelector("#ii").toDataURL();
        console.log('   ');
        console.log(image_data_url);
        // $('#image-file').val(image_data_url);


			let _url = $('#form-'+idForm).attr('action');

            var form = $('#form-'+idForm)[0];
            var form_data = new FormData(form);

            form_data.append('userpic', image_data_url);
			startLoading();
            $.ajax({
                url: _url,
                type: "POST",
                contentType: false,
                processData: false,
                data: form_data,
                success: function(response) {
                    $('#success-modal').modal('show')
					console.log(response)
					// $('#table-'+idForm).DataTable().ajax.reload();
                },
                error: function(response) {
                    alertModal()					
				}
            });
		}

    
</script>
@endsection
@section('js_ready')
let datas = @json($data);
console.log('data');
console.log(datas);

if(datas.photo_path){
    $('#galery-view').attr('src', '/'+datas.photo_path);
    $('#image').attr('src', '/'+datas.photo_path);
}

function firsts(){
    let no_reg_suggest;
    let no_reg = @json($no_reg);
    let data = @json($data);
    let year_month = @json($year_month);
    if(data.company_uuid != null){
        let company = data.company_uuid;
        {{-- let no_reg_suggest = "MP-"+company+"-"+no_reg+"-"; --}}
        
        let full_contract_number ='000' +no_reg;
        no_reg_suggest = "MP-"+company+"-"+full_contract_number.substr(-3)+"-"+year_month;
        console.log(no_reg_suggest);
    }else{
        no_reg_suggest ="MP-MBLE-001-"+year_month;
    }
    $('#no_reg').val(no_reg_suggest);
    {{-- $().val(); --}}
}
firsts();
function edit(){
    let data = @json($data);
    
    console.log(data);

    $('#isEdit').val(data.isEdit)  
    $('#nik_employee').val(data.nik_employee)  
    $('#nik_employee_image').val(data.nik_employee)  
   
    $('#user_detail_uuid').val(data.user_detail_uuid)  
    if(data){
        if(data.blue_size){
            $('#blue_size').val(data.blue_size)  
            $('#blue_date').val(data.blue_date)  
        } 
        if(data.no_reg_full){
            $('#no_reg').val(data.no_reg_full)  
        } 
        if(data.date){
            $('#date').val(data.date)  
        } 
        if(data.date){
            $('#date').val(data.date)  
        } 
        if(data.rompi_status){
            $('#rompi_status').val(data.rompi_status)  
            console.log(data.rompi_date);
            $('#rompi_date').val(data.rompi_date)  
        } 
        if(data.helm_color){
            $('#helm_color').val(data.helm_color)  
            $('#helm_date').val(data.helm_date)  
        } 
        if(data.boots_size){
            $('#boots_size').val(data.boots_size)  
            $('#boots_date').val(data.boots_date)  
        } 
        if(data.shirt_size){
            $('#shirt_size').val(data.shirt_size)  
            $('#shirt_date').val(data.shirt_date)  
        } 
        if(data.mekanik_size){
            $('#mekanik_size').val(data.mekanik_size)  
            $('#mekanik_date').val(data.mekanik_date)  
        } 
        if(data.orange_size){
            $('#orange_size').val(data.orange_size)  
            $('#orange_date').val(data.orange_date)  
        } 
        $('#user_license_uuid').val(data.uuid)  
    }
     
} 
let data = @json($data);
if(data){
    edit();
}
@endsection