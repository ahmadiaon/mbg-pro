@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        {{-- <form action="/admin-hr/employees/contract/create" method="POST"> --}}
            <form action="/admin-hr/education" method="POST">
                @csrf
                <input type="hidden" name="user_detail_uuid" value="{{ $user_detail_uuid }}">
                <div class="min-height-200px">

                    <!-- Identitas Karyawan -->
                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Pendidikan Karyawan</h4>
                            </div>
                        </div>
                       
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="text-blue h6">Sekolah Dasar</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5 col-sm-12">
                                    <div class="form-group">
                                        <label>Nama Sekolah</label>
                                        <input name="sd_name"
                                            class="form-control @error('sd_name') is-invalid @enderror"
                                            value="{{ old('sd_name') }}" id="sd_name" placeholder="Muara Teweh"
                                            type="text">
                                        @error('sd_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Daerah</label>
                                        <input name="sd_place"
                                            class="form-control @error('sd_place') is-invalid @enderror"
                                            value="{{ old('sd_place') }}" id="sd_place" placeholder="Muara Teweh"
                                            type="text">
                                        @error('sd_place')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Lulus Tahun</label>
                                        <input name="sd_year"
                                            class="form-control @error('sd_year') is-invalid @enderror"
                                            value="{{ old('sd_year') }}" id="sd_year" placeholder="Muara Teweh"
                                            type="text">
                                        @error('sd_year')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="text-blue h6">Sekolah Menengah Atas Sederajat</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5 col-sm-12">
                                    <div class="form-group">
                                        <label>Nama Sekolah</label>
                                        <input name="smp_name"
                                            class="form-control @error('smp_name') is-invalid @enderror"
                                            value="{{ old('smp_name') }}" id="smp_name" placeholder="Muara Teweh"
                                            type="text">
                                        @error('smp_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Daerah</label>
                                        <input name="smp_place"
                                            class="form-control @error('smp_place') is-invalid @enderror"
                                            value="{{ old('smp_place') }}" id="smp_place" placeholder="Muara Teweh"
                                            type="text">
                                        @error('smp_place')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Lulus Tahun</label>
                                        <input name="smp_year"
                                            class="form-control @error('smp_year') is-invalid @enderror"
                                            value="{{ old('smp_year') }}" id="smp_year" placeholder="Muara Teweh"
                                            type="text">
                                        @error('smp_year')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="text-blue h6">SMA/Sederajat</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Nama Sekolah</label>
                                        <input name="sma_name"
                                            class="form-control @error('sma_name') is-invalid @enderror"
                                            value="{{ old('sma_name') }}" id="sma_name" placeholder="Muara Teweh"
                                            type="text">
                                        @error('sma_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Daerah</label>
                                        <input name="sma_place"
                                            class="form-control @error('sma_place') is-invalid @enderror"
                                            value="{{ old('sma_place') }}" id="sma_place" placeholder="Muara Teweh"
                                            type="text">
                                        @error('sma_place')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Jurusan</label>
                                        <input name="sma_jurusan"
                                            class="form-control @error('sma_jurusan') is-invalid @enderror"
                                            value="{{ old('sma_jurusan') }}" id="sma_jurusan" placeholder="Muara Teweh"
                                            type="text">
                                        @error('sma_jurusan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Lulus Tahun</label>
                                        <input name="sma_year"
                                            class="form-control @error('sma_year') is-invalid @enderror"
                                            value="{{ old('sma_year') }}" id="sma_year" placeholder="Muara Teweh"
                                            type="text">
                                        @error('sma_year')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="text-blue h6">Perguruan Tinggi</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Nama Perguruan Tinggi</label>
                                        <input name="ptn_name"
                                            class="form-control @error('ptn_name') is-invalid @enderror"
                                            value="{{ old('ptn_name') }}" id="ptn_name" placeholder="Muara Teweh"
                                            type="text">
                                        @error('ptn_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Daerah</label>
                                        <input name="ptn_place"
                                            class="form-control @error('ptn_place') is-invalid @enderror"
                                            value="{{ old('ptn_place') }}" id="ptn_place" placeholder="Muara Teweh"
                                            type="text">
                                        @error('ptn_place')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Jurusan</label>
                                        <input name="ptn_jurusan"
                                            class="form-control @error('ptn_jurusan') is-invalid @enderror"
                                            value="{{ old('ptn_jurusan') }}" id="ptn_jurusan" placeholder="Muara Teweh"
                                            type="text">
                                        @error('ptn_jurusan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Lulus Tahun</label>
                                        <input name="ptn_year"
                                            class="form-control @error('ptn_year') is-invalid @enderror"
                                            value="{{ old('ptn_year') }}" id="ptn_year" placeholder="Muara Teweh"
                                            type="text">
                                        @error('ptn_year')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="text-blue h6">Lain-lain</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input name="dll_name"
                                            class="form-control @error('dll_name') is-invalid @enderror"
                                            value="{{ old('dll_name') }}" id="dll_name" placeholder="Muara Teweh"
                                            type="text">
                                        @error('dll_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Daerah</label>
                                        <input name="dll_place"
                                            class="form-control @error('dll_place') is-invalid @enderror"
                                            value="{{ old('dll_place') }}" id="dll_place" placeholder="Muara Teweh"
                                            type="text">
                                        @error('dll_place')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Jurusan</label>
                                        <input name="dll_jurusan"
                                            class="form-control @error('dll_jurusan') is-invalid @enderror"
                                            value="{{ old('dll_jurusan') }}" id="dll_jurusan" placeholder="Muara Teweh"
                                            type="text">
                                        @error('dll_jurusan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Lulus Tahun</label>
                                        <input name="dll_year"
                                            class="form-control @error('dll_year') is-invalid @enderror"
                                            value="{{ old('dll_year') }}" id="dll_year" placeholder="Muara Teweh"
                                            type="text">
                                        @error('dll_year')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary mt-10 float-right">Next Step</button>
                                </div>
                            </div>
                    </div>
                </div>
            </form>
    </div>

    <div class="footer-wrap pd-20 mb-20 card-box">
        DeskApp - Bootstrap 4 Admin Template By
        <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
    </div>
</div>

@endsection

@section('js')
</script>

@endsection