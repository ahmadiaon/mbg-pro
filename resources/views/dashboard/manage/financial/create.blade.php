@extends('dashboard.layouts.template')
@section('container')
<div class="pd-20 card-box mb-30">
    <div class="clearfix">

        <!-- Form grid Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Konten FInancial Baru</h4>
                </div>

            </div>
            <form action="/bank" method="post" id="main_form">
                @csrf
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <input autofocus name="name" class="form-control   @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" type="text" placeholder="Masukan Nama Bank">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description"
                                class="form-control  @error('description') is-invalid @enderror">{{  old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input name="address" type="text"
                                class="form-control  @error('address') is-invalid @enderror" value="{{ old('name') }}">
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Kabupaten/Kota</label>
                            <input required name="city" type="text"
                                class="form-control  @error('city') is-invalid @enderror" value="Palangka Raya">
                            @error('city')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input required name="province" type="text"
                                class="form-control  @error('province') is-invalid @enderror" value="Kalimantan Tengah">
                            @error('province')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Url Google Maps</label>
                            <input required name="location" type="text"
                                class="form-control  @error('location') is-invalid @enderror"
                                value="{{ old('location') }}" placeholder="url maps">
                            @error('location')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Url Instagram</label>
                            <input required name="instagram" type="text"
                                class="form-control  @error('instagram') is-invalid @enderror">
                            @error('instagram')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Url Facebook</label>
                            <input required name="facebook" type="text"
                                class="form-control  @error('facebook') is-invalid @enderror">
                            @error('facebook')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Url Youtube</label>
                            <input required name="youtube" type="text"
                                class="form-control  @error('youtube') is-invalid @enderror">
                            @error('youtube')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Tampilkan</label>
                            <select required name="status" class="form-control  @error('status') is-invalid @enderror">
                                <option value="1" {{ (old("status")=="1" ? "selected" :"") }}>Aktif</option>
                                <option value="0" {{ (old("status")=="0" ? "selected" :"") }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label>Pilih Logo</label>
                    <select name="logo_path"
                        class="custom-select2 form-control  @error('logo_path') is-invalid @enderror" name="state"
                        style="width: 100%; height: 38px;">
                        <optgroup label="Media dari gallery">
                            <option value="null">Pilih Media</option>
                            @foreach($galleries as $gallery)
                            @if(old('logo_path' ) == $gallery->uuid)
                            <option selected value="{{ $gallery->uuid }}">{{ $gallery->name }}</option>
                            @else
                            <option value="{{ $gallery->uuid }}">{{ $gallery->name }}</option>
                            @endif
                            @endforeach
                        </optgroup>
                    </select>
                    @error('gallery')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Media Financial</label>
                    <input id="selects" name="image_path" type="hidden" value="">
                    <select required id="select-meal-type" class="custom-select2 form-control" multiple="multiple"
                        style="width: 100%;">
                        <option value="null">Pilih Media</option>
                        @foreach($galleries as $gallery)
                        @if(old('gallery' ) == $gallery->uuid)
                        <option selected value="{{ $gallery->uuid }}">{{ $gallery->name }}</option>
                        @else
                        <option value="{{ $gallery->uuid }}">{{ $gallery->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <a href="/bank/">
                        <button type="button" id="modalClose" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                    </a>
                    <button id="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            <div class="collapse collapse-box" id="form-grid-form">
                <div class="code-box">
                    <div class="clearfix">
                        <a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left"
                            data-clipboard-target="#form-grid"><i class="fa fa-clipboard"></i> Copy Code</a>
                        <a href="#form-grid-form" class="btn btn-primary btn-sm pull-right" rel="content-y"
                            data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form grid End -->
    </div>
</div>
@endsection
@section('javascripts')
<script src="/vendors/scripts/core.js"></script>
<script src="/vendors/scripts/script.min.js"></script>
<script src="/vendors/scripts/process.js"></script>
<script src="/vendors/scripts/layout-settings.js"></script>
<!-- switchery js -->
<script src="/src/plugins/switchery/switchery.min.js"></script>
<!-- bootstrap-tagsinput js -->
<script src="/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<!-- bootstrap-touchspin js -->
<script src="/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="/vendors/scripts/advanced-components.js"></script>
<script>
    var options = document.getElementById('select-meal-type').selectedOptions;
    var values = Array.from(options).map(({ value }) => value);


    document.getElementById('submit').onclick = function() {
  var select = document.getElementById('select-meal-type');
  var selected = [...select.options]
                    .filter(option => option.selected)
                    .map(option => option.value);
                    document.getElementById('selects').value = selected;

}
</script>

@endsection
