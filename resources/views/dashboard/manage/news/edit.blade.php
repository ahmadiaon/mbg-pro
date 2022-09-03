@extends('dashboard.manage.layouts.form')
@section('container')
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="">
            <h4 class="text-blue h4">Tambah News</h4>
            <p class="mb-30">Silahkan Lengkapi data dibawah ini</p>
            <form action="/news/{{ $news->id }}" method="post" id="main_form">
                @method('put')
                @csrf
                <div class="form-group">
                    <label>Judul Berita</label>
                    <input required autofocus name="title" class="form-control   @error('title') is-invalid @enderror"
                        value="{{ old('title',$news->title) }}" type="text" placeholder="Masukan Nama Lengkap">
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="html-editor pd-20 card-box mb-30">
                    <h4 class="h4 text-blue">Konten Berita</h4>
                    <textarea required name="content" class="form-control border-radius-0"
                        placeholder="Enter text ...">{{ $news->content}} </textarea>
                </div>
                <div class="form-group">
                    <label>Multiple Select</label>
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
                <div class="form-group ">
                    <label>Status</label>
                    <select required name="status" class="form-control  @error('status') is-invalid @enderror">
                        <option value="1" {{ (old("status",$news->status) == "1" ? "selected":"") }}>Aktif</option>
                        <option value="0" {{ (old("status",$news->status) == "0" ? "selected":"") }}>Tidak Aktif
                        </option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <a href="/news/" class="d-inline">
                        <button type="button" id="modalClose" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                    </a>
                    <button id="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
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
