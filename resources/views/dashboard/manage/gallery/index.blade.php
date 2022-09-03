@extends('dashboard.manage.layouts.main_gallery')
@section('container')
<!-- Simple Datatable start -->
<div class="gallery-wrap">

    <div class="row lg-6">
        <div class="col-md-5">
            <h5 class="h4 text-blue mb-10">Galleries of DigiPark</h5>
            <p class="mb-30">Find amazing Images</p>
        </div>
        <div class="col-md-5">
            <form action="/galleries">
                <div class="input-group mb-3">
                    <input name="search" type="text" class="form-control" placeholder="Search..." aria-label="Search..."
                        aria-describedby="button-addon2" value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <a href="galleries/create">
                <div class="input-group mb-3">
                    <button class="btn btn-primary" type="submit">+New Galerry</button>
                </div>
            </a>
        </div>
    </div>



    <ul class="row">
        @foreach($galleries as $gallery)
        <li class="col-lg-4 col-md-6 col-sm-12">
            <div class="da-card box-shadow">
                <div class="da-card-photo">
                    <img src="/{{ $gallery->path }}" alt="">
                    <div class="da-overlay">
                        <div class="da-social">
                            <h5 class="mb-10 color-white pd-20">{{ $gallery->name }}</h5>
                            <ul class="clearfix">
                                <li><a href="/{{ $gallery->path }}" data-fancybox="images"><i
                                            class="fa fa-picture-o"></i></a></li>
                                <li><a href="/galleries/{{ $gallery->id}}/edit"><i
                                            class="icon-copy dw dw-pencil-1"></i></a></li>
                                <li>
                                    <a nohref onclick="myFunction({{ $gallery->id }})">
                                        <form action="/galleries/{{ $gallery->id }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <i class="icon-copy dw dw-trash"></i>
                                            <button id="subs{{ $gallery->id }}"
                                                class="btn btn-outline-none text-decoration-none"
                                                onclick="return confirm('Are You Sure?')"></button>
                                        </form>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="da-card-content">
                    <h5 class="h5 mb-10">{{ $gallery->name }} <a href="/galleries/{{ $gallery->id}}/edit"><i
                                            class="icon-copy dw dw-pencil-1"></i></a></h5>
                    <p class="mb-0"></p>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>
<div class="d-flex justify-content-center mb-4">
    {{ $galleries->links() }}
</div>
<!-- Fade-in effect -->
<!-- Modal Media -->
<div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Media Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Tipe Media</label>
                                <select class="custom-select col-12">
                                    <option selected="">Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Nama Media</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Metode</label>
                                <select class="custom-select col-12">
                                    <option selected="">Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Url</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="custom-select col-12">
                                    <option selected="">Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    function myFunction(id) {
           document.getElementById("subs"+id).click();
        }
</script>
@endsection
