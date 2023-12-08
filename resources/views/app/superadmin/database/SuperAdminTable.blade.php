@extends('layouts.main')

@section('content')
    <div class="faq-wrap">
        <h4 class="mb-30 h4 text-blue padding-top-10">Collapse example</h4>

        <div class="padding-bottom-30">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-block" data-toggle="collapse" data-target="#faq-manage-database">
                        <h4 class="text-blue h4">Buat Baru Tabel</h4>
                    </button>
                </div>
                <div id="faq-manage-database" class="collapse show">
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Nama Tabel</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" type="text" placeholder="Johnny Brown" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Group Tabel</label>
                                <div class="col-sm-12 col-md-10">
                                    <select class="custom-select2 form-control" name="state"
                                        style="width: 100%; height: 38px">
                                        <option value="CA">California</option>
                                        <option value="NV">Nevada</option>
                                        <option value="OR">Oregon</option>
                                        <option value="WA">Washington</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-3 mb-10">
                                    <label for="">Nama field</label>
                                    <input class="form-control" type="text" placeholder="Johnny Brown" />
                                </div>
                                <div class="col-sm-12 col-md-3 mb-10">
                                    <label for="">Jenis isian</label>
                                    <select class="custom-select2 form-control" name="state"
                                        style="width: 100%; height: 38px">
                                        <option value="CA">California</option>
                                        <option value="NV">Nevada</option>
                                        <option value="OR">Oregon</option>
                                        <option value="WA">Washington</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-1">
                                    <label for="">Hapus</label>
                                    <button class="btn btn-danger">
                                        <i class="icon-copy dw dw-delete-3"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="btn-list">
                                <button type="button" class="btn btn-lg btn-primary">
                                    tambah field
                                </button>
                                <button type="button" class="btn btn-info btn-lg">
                                    simpan
                                </button>
                            </div>
                            <div class="form-group row">
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq2-2">
                        Daftar Database
                    </button>
                </div>
                <div id="faq2-2" class="collapse">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                        accusamus terry richardson ad squid. 3 wolf moon officia
                        aute, non cupidatat skateboard dolor brunch. Food truck
                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                        sunt aliqua put a bird on it squid single-origin coffee
                        nulla assumenda shoreditch et. Nihil anim keffiyeh
                        helvetica, craft beer labore wes anderson cred nesciunt
                        sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                        Leggings occaecat craft beer farm-to-table, raw denim
                        aesthetic synth nesciunt you probably haven't heard of them
                        accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
