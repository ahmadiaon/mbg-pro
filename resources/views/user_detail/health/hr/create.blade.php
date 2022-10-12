{{-- 
    /admin-hr/licences
    
--}}
@extends('template.admin.main')
@section('content')
<div class="pd-20 card-box mb-20">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Riwayat Kesehatan Karyawan</h4>
        </div>
    </div>
    <form action="/admin-hr/health" method="POST">
        @csrf
        <input type="hidden" name="uuid" value="">
        <input type="hidden" name="user_detail_uuid" value="{{ $user_detail_uuid }}">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="form-group">
                    <label>Penyakit/Kecelakaan/Gejala</label>
                    <input name="name_health"
                        class="form-control @error('name_health') is-invalid @enderror"
                        value="{{ old('name_health') }}" id="name_health" placeholder="Asma" type="text">
                    @error('name_health')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Tahun</label>
                    <input 
                        class="form-control @error('year_health') is-invalid @enderror"
                        value="{{ old('year_health') }}" name="year" id="year_health" placeholder="2012" type="text">
                    @error('year_health')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>RS/Puskesmas</label>
                    <input name="health_care_place"
                        class="form-control @error('health_care_place') is-invalid @enderror"
                        value="{{ old('health_care_place') }}" id="health_care_place"
                        placeholder="RS Mitra Barito" type="text">
                    @error('health_care_place')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <label>Lama (Bulan)</label>
                    <input name="long" class="form-control @error('long') is-invalid @enderror"
                        value="{{ old('long') }}" id="long" placeholder="12" type="text">
                    @error('long')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Sembuh</label>
                    <select name="status_health"
                        class="selectpicker form-control @error('status_health') is-invalid @enderror">
                        <option value="Sembuh" {{ (old('status_health')=='Sembuh' )?'selected':'' }}>Sembuh
                        </option>
                        <option value="Belum Sembuh" {{ (old('status_health')=='Belum Sembuh'
                            )?'selected':'' }}>Belum Sembuh
                        </option>
                    </select>
                </div>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary mt-10 float-right">Next Step</button>
            </div>
        </div>
       
    </div>       
    </form>


</div>
  
@endsection
