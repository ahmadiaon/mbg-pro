@extends('dashboard.manage.layouts.form')
@section('container')
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="">
            <h4 class="text-blue h4">Edit youtube</h4>
            <p class="mb-30">Silahkan Ubah data dibawah ini</p>
            <form action="/youtube/{{ $youtube->id }}" method="post" id="main_form">
                @method('put')
                @csrf
                <div class="form-group">
                    <label>Nama </label>
                    <input autofocus name="name" class="form-control   @error('name') is-invalid @enderror"
                        value="{{ old('name',$youtube->name) }}" type="text" placeholder="Masukan Nama">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>URL </label>
                    <input autofocus name="url" class="form-control   @error('url') is-invalid @enderror"
                        value="{{ old('url',$youtube->url) }}" type="text" placeholder="Masukan Nama">
                    @error('url')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group ">
                    <label>Status</label>
                    <select name="status" class="form-control  @error('status') is-invalid @enderror">
                        <option value="1" {{ (old("status",$youtube->status) == "1" ? "selected":"") }}>Aktif</option>
                        <option value="0" {{ (old("status",$youtube->status) == "0" ? "selected":"") }}>Tidak Aktif
                        </option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <a href="/youtube/">
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
