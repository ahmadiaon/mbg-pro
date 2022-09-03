@extends('dashboard.manage.layouts.form')
@section('container')
<div class="pd-20 card-box mb-30">
    <div class="clearfix">

        <!-- Form grid Start -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Konten Tour Baru</h4>
                </div>

            </div>
            <form action="/tour/{{ $tour->id }}" method="post" id="main_form">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Judul</label>
                            <input required name="name" type="text"
                                class="form-control  @error('name') is-invalid @enderror"
                                value="{{ old('name',$tour->name) }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description"
                                class="form-control @error('descreption') is-invalid @enderror">{{ old('description',$tour->description) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input name="address" type="text"
                                class="form-control @error('address') is-invalid @enderror"
                                value="{{ old('address',$tour->address) }}"">
                </div>
            </div>
            <div class=" col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Kabupaten/Kota</label>
                                <input required name="city" type="text"
                                    class="form-control @error('city') is-invalid @enderror"
                                    value="{{ old('city',$tour->city) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <input required name="province" type="text"
                                    class="form-control @error('province') is-invalid @enderror"
                                    value="{{ old('province',$tour->name) }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Url Google Maps</label>
                                <input required name="location" type="text"
                                    class="form-control @error('location') is-invalid @enderror"
                                    value="{{ old('location',$tour->location) }}">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Url Instagram</label>
                                <input name="instagram" type="text"
                                    class="form-control @error('instagram') is-invalid @enderror"
                                    value="{{ old('instagram',$tour->instagram) }}">
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
                                <input name="facebook" type="text"
                                    class="form-control @error('facebook') is-invalid @enderror"
                                    value="{{ old('facebook',$tour->facebook) }}">
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
                                <input name="youtube" type="text"
                                    class="form-control @error('youtube') is-invalid @enderror"
                                    value="{{ old('youtube',$tour->youtube) }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Tampilkan</label>
                                <select required name="status"
                                    class="form-control  @error('status') is-invalid @enderror">
                                    <option value="1" {{ (old("status",$tour->status) == "1" ? "selected":"") }}>Aktif
                                    </option>
                                    <option value="0" {{ (old("status",$tour->status) == "0" ? "selected":"") }}>Tidak
                                        Aktif</option>
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
                        <label>Pilih Media</label>
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
                            @foreach($image_paths as $image_path)
                            <option {{ ($image_path=='"' .$gallery->uuid.'"')? "selected":"" }} value="{{ $gallery->uuid
                                }}">{{ $gallery->name }}</option>
                            @endforeach

                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <a href="/tour/">
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
