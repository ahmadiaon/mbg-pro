@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 pd-20">
       <h4 class="text-blue h4">Perubahan Karyawan</h4>
        
       <div class="row">
        <div class="col-md-6">
            <h4>Data Lama</h4>
            <div class="form-group">
                <label for="">Karyawan</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <h4>Data Baru</h4>
            <div class="form-group">
                <label for="">Karyawan</label>
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
