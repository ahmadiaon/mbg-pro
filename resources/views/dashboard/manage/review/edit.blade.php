@extends('dashboard.manage.layouts.form')
@section('container')
<div class="pd-20 card-box mb-30">
    <div class="clearfix mb-20">
        <div class="pull-left">
            <h4 class="text-blue h4">Image Cropper</h4>
        </div>
    </div>
    <!-- Content -->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-7">
            <!-- <h3>Demo:</h3> -->
            <div class="img-container ">
                <img src="{{$review->image_path}}" id="image" alt="Picture" />
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-5">
            <!-- <h3>Data:</h3> -->
            <form action="/review/{{ $review->id }}" method="post" id="main_form" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-7">
                        <div class="form-group">
                            <label>User</label>
                            <input disabled name="facebook" type="text" class="form-control "
                                value="{{ $review->user }}">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-5">
                        <div class="form-group">
                            <label>UMKM</label>
                            <input disabled name="facebook" type="text" class="form-control "
                                value="{{ $review->name }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea disabled required name="content" class=" form-control border-radius-20"
                        placeholder="Enter text ...">{{ $review->user }}</textarea>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-7">
                        <div class="form-group">
                            <label>value</label>
                            <input disabled name="facebook" type="text" class="form-control "
                                value="{{ $review->value }}">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-5">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="custom-select col-12">
                                <option {{ $review->status == 1 ? "selected" :"" }} value="1" selected="">Aktif</option>
                                <option {{ $review->status == 0 ? "selected" :"" }} value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="/review/">
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
