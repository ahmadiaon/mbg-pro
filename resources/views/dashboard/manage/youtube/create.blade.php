@extends('dashboard.manage.layouts.form')
@section('container')
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="">
            <h4 class="text-blue h4">Tambah Slide</h4>
            <p class="mb-30">Silahkan Lengkapi data dibawah ini</p>
            <form action="/youtube" method="post" id="main_form">
                @csrf
                <div class="form-group">
                    <label>Nama Media</label>
                    <input autofocus name="name" class="form-control   @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" type="text" placeholder="Masukan Nama">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>URL</label>
                    <input autofocus name="url" class="form-control   @error('url') is-invalid @enderror"
                        value="{{ old('url') }}" type="text" placeholder="Masukan URL Youtube">
                    @error('url')
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
