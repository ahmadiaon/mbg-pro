@extends('dashboard.manage.layouts.main_without_js')
@section('container')
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="">
            <h4 class="text-blue h4">Edit Gallery</h4>
            <p class="mb-30">Silahkan Lengkapi data dibawah ini</p>
            <form action="/galleries/{{ $gallery->id }}" method="post" id="main_form" enctype="multipart/form-data">
                @method('put')
                @csrf


                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Tipe Media</label>
                            <select name="type" class="custom-select col-12">
                                <option value="image" selected="">Gambar</option>
                            </select>
                        </div>
                    </div>
                    {{-- <input type="text" name="aaa" value="aaaa"> --}}
                    {{-- <input type="hidden" name="oldImage" value="{{ $gallery->name }}"> --}}
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label id="GFG">Silahkan Masukan Gambar </label>
                            <div class="custom-file">
                                <input type="hidden" name="oldImage" value="{{ $gallery->name }}">
                                <input onchange="previewImage(this.value)" name="content" id="file" type="file"
                                    class="custom-file-input  @error('content') is-invalid @enderror">
                                <label id="III" class="custom-file-label">{{ $gallery->path }}</label>
                                <div class="da-card-photo">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col col-lg-8">
                                                <img class="rounded mt-3 img-thumbnail d-block" id="showImage"
                                                    src="/{{ $gallery->path }}" alt="">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Metode</label>
                            <select name="method" class="custom-select col-12" onchange="choseFile(this.value);">
                                <option value="file" selected="">Upload</option>
                                {{-- <option value="text">Url</option> --}}
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="custom-select col-12">
                                <option {{ $gallery->status == 1 ? "selected" :"" }} value="1" selected="">Aktif
                                </option>
                                <option {{ $gallery->status == 0 ? "selected" :"" }} value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Nama Media</label>
                            <input required value="{{ old('name', $gallery->name) }}" name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="/galleries">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script>
    function choseFile (element) {
        var classes = "file";
        document.getElementById("file").type = element;
        if(element == "text"){
            element = "Masukan URL";
            classes = "form-control";
        }else{
            element = "Pilih File";
            classes = "form-control";
        }
        document.getElementById('GFG').innerHTML
                = element;
                document.getElementById("file").className = classes;
    }
</script>
<script>
    function previewImage(element){

        const image = document.querySelector('#file');
        const imgPreview = document.querySelector('#showImage');

        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }

        document.getElementById('III').innerHTML
                = element;
    }
</script>
@endsection
