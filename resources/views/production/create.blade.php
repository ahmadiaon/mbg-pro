@extends('template.admin.main_privilege')
@section('content')
    <div class="mb-30">
        <div class="row">
            <div class="col-12">
                <!-- Simple Datatable start -->
                <div class="card-box  mb-30">
                    <form action="/tonase/store" id="form-tonase" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="uuid" id="uuid">
                        <div class="pd-20">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4 class="text-blue h4">Tambah Tonase Karyawan</h4>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group text-right">
                                        <div class="col text-center">
                                            <div class="alert alert-warning" id="isEdit" role="alert">
                                                Edit Mode !
                                            </div>	
                                          </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Premi</label>
                                        <select class="selectpicker form-control" name="premi_uuid" id="premi_uuid">
                                            @foreach ($premis as $premi )
                                            <option value="{{ $premi->uuid}}">{{ $premi->premi_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" class="form-control" value="{{$today}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="">Nilai</label>
                                    <input type="text" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">premi</label>
                                        <button class="btn btn-primary form-control">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Simple Datatable End -->
            </div>
        </div>
     
    </div>
@endsection
@section('js')
    <script>
  
       

        $(document).ready(function() {
          
        });
    </script>
@endsection
