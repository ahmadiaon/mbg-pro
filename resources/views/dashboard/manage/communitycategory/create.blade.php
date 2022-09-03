@extends('dashboard.layouts.template')
@section('container')
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="">
            <h4 class="text-blue h4">Tambah Community Category</h4>
            <p class="mb-30">Silahkan Lengkapi data dibawah ini</p>
            <form action="/community-category" method="post" id="main_form">
                @csrf
                <div class="form-group">
                    <label>Nama Category Community</label>
                    <input autofocus name="category" class="form-control   @error('category') is-invalid @enderror"
                        value="{{ old('category') }}" type="text" placeholder="Masukan Nama Community">
                    @error('category')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Pilih Media</label>
                    <select name="gallery_uuid"
                        class="custom-select2 form-control  @error('gallery') is-invalid @enderror" name="state"
                        style="width: 100%; height: 38px;">
                        <optgroup label="Media dari gallery">
                            <option value="null">Pilih Media</option>
                            @foreach($galleries as $gallery)
                            @if(old('gallery' ) == $gallery->uuid)
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
                <div class="form-group ">
                    <label>Status</label>
                    <select name="status" class="form-control  @error('status') is-invalid @enderror">
                        <option value="1" {{ (old("status")=="1" ? "selected" :"") }}>Aktif</option>
                        <option value="0" {{ (old("status")=="0" ? "selected" :"") }}>Tidak Aktif</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <a href="/business-category/">
                        <button type="button" id="modalClose" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                    </a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
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
@endsection
