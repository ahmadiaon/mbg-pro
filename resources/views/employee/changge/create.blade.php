@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 pd-20">
       <h4 class="text-blue h4">Perubahan Karyawan</h4>
        
       <div class="row mb-20">
        <div class="col-md-4">
            <h4>Karyawan</h4>
            <div class="form-group">
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <h4>Tanggal Ajuan</h4>
            <div class="form-group">
                <input type="date" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <h4>Jenis Perubahan</h4>
            <div class="form-group">
                <input type="text" class="form-control">
            </div>
        </div>
       </div>
       <div class="row">
        <div class="col-md-6">
            <h4 class="text-blue text-center mb-20">DATA LAMA</h4>
            <div class="form-group">
                <label for="">Jabatan Lama</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <h4 class="text-blue text-center mb-20">DATA BARU</h4>
            <div class="form-group">
                <label for="">Jabatan Baru</label>
                <input type="text" class="form-control">
            </div>
        </div>
       </div>
    </div>

    
   
@endsection

@section('js')
    <script>
   
    </script>
@endsection
