{{-- 
   /admin-hr/experience
    
--}}
@extends('template.admin.main_privilege')
@section('content')
    <div class="card-box mb-30">
        <form action="/admin-hr/experience" method="POST">
            @csrf
            <input type="hidden" name="user_detail_uuid" value="{{ $user_detail_uuid }}">
            <div class="min-height-200px">  
                <div class="pd-20 card-box mb-20">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Pengalaman Karyawan</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Perusahaan</label>
                                    <input name="exp_1_name"
                                        class="form-control @error('exp_1_name') is-invalid @enderror"
                                        value="{{ old('exp_1_name') }}" id="exp_1_name" placeholder="Muara Teweh"
                                        type="text">
                                    @error('exp_1_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Posisi/Jabatan</label>
                                    <input name="exp_1_position"
                                        class="form-control @error('exp_1_position') is-invalid @enderror"
                                        value="{{ old('exp_1_position') }}" id="exp_1_position"
                                        placeholder="Muara Teweh" type="text">
                                    @error('exp_1_position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Mulai Kerja</label>
                                    <input name="exp_1_date_start" value="{{ old('exp_1_date_start') }}"
                                        id="exp_1_date_start"
                                        class="form-control month-picker @error('exp_1_date_start') is-invalid @enderror"
                                        placeholder="Januari 2020" type="text" />
                                    @error('exp_1_date_start')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Akhir Kerja</label>
                                    <input name="exp_1_date_end" value="{{ old('exp_1_date_end') }}"
                                        id="exp_1_date_end"
                                        class="form-control month-picker @error('exp_1_date_end') is-invalid @enderror"
                                        placeholder="Januari 2020" type="text" />
                                    @error('exp_1_date_end')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Alasan Berhenti</label>
                                    <input name="exp_1_reason"
                                        class="form-control @error('exp_1_reason') is-invalid @enderror"
                                        value="{{ old('exp_1_reason') }}" id="exp_1_reason"
                                        placeholder="Muara Teweh" type="text">
                                    @error('exp_1_reason')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Perusahaan</label>
                                    <input name="exp_2_name"
                                        class="form-control @error('exp_2_name') is-invalid @enderror"
                                        value="{{ old('exp_2_name') }}" id="exp_2_name" placeholder="Muara Teweh"
                                        type="text">
                                    @error('exp_2_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Posisi/Jabatan</label>
                                    <input name="exp_2_position"
                                        class="form-control @error('exp_2_position') is-invalid @enderror"
                                        value="{{ old('exp_2_position') }}" id="exp_2_position"
                                        placeholder="Muara Teweh" type="text">
                                    @error('exp_2_position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Mulai Kerja</label>
                                    <input name="exp_2_date_start" value="{{ old('exp_2_date_start') }}"
                                        id="exp_2_date_start"
                                        class="form-control month-picker @error('exp_2_date_start') is-invalid @enderror"
                                        placeholder="Januari 2020" type="text" />
                                    @error('exp_2_date_start')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Akhir Kerja</label>
                                    <input name="exp_2_date_end" value="{{ old('exp_2_date_end') }}"
                                        id="exp_2_date_end"
                                        class="form-control month-picker @error('exp_2_date_end') is-invalid @enderror"
                                        placeholder="Januari 2020" type="text" />
                                    @error('exp_2_date_end')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Alasan Berhenti</label>
                                    <input name="exp_2_reason"
                                        class="form-control @error('exp_2_reason') is-invalid @enderror"
                                        value="{{ old('exp_2_reason') }}" id="exp_2_reason"
                                        placeholder="Muara Teweh" type="text">
                                    @error('exp_2_reason')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Perusahaan</label>
                                    <input name="exp_3_name"
                                        class="form-control @error('exp_3_name') is-invalid @enderror"
                                        value="{{ old('exp_3_name') }}" id="exp_3_name" placeholder="Muara Teweh"
                                        type="text">
                                    @error('exp_3_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Posisi/Jabatan</label>
                                    <input name="exp_3_position"
                                        class="form-control @error('exp_3_position') is-invalid @enderror"
                                        value="{{ old('exp_3_position') }}" id="exp_3_position"
                                        placeholder="Muara Teweh" type="text">
                                    @error('exp_3_position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Mulai Kerja</label>
                                    <input name="exp_3_date_start" value="{{ old('exp_3_date_start') }}"
                                        id="exp_3_date_start"
                                        class="form-control month-picker @error('exp_3_date_start') is-invalid @enderror"
                                        placeholder="Januari 2020" type="text" />
                                    @error('exp_3_date_start')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Akhir Kerja</label>
                                    <input name="exp_3_date_end" value="{{ old('exp_3_date_end') }}"
                                        id="exp_3_date_end"
                                        class="form-control month-picker @error('exp_3_date_end') is-invalid @enderror"
                                        placeholder="Januari 2020" type="text" />
                                    @error('exp_3_date_end')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Alasan Berhenti</label>
                                    <input name="exp_3_reason"
                                        class="form-control @error('exp_3_reason') is-invalid @enderror"
                                        value="{{ old('exp_3_reason') }}" id="exp_3_reason"
                                        placeholder="Muara Teweh" type="text">
                                    @error('exp_3_reason')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Perusahaan</label>
                                    <input name="exp_4_name"
                                        class="form-control @error('exp_4_name') is-invalid @enderror"
                                        value="{{ old('exp_4_name') }}" id="exp_4_name" placeholder="Muara Teweh"
                                        type="text">
                                    @error('exp_4_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Posisi/Jabatan</label>
                                    <input name="exp_4_position"
                                        class="form-control @error('exp_4_position') is-invalid @enderror"
                                        value="{{ old('exp_4_position') }}" id="exp_4_position"
                                        placeholder="Muara Teweh" type="text">
                                    @error('exp_4_position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Mulai Kerja</label>
                                    <input name="exp_4_date_start" value="{{ old('exp_4_date_start') }}"
                                        id="exp_4_date_start"
                                        class="form-control month-picker @error('exp_4_date_start') is-invalid @enderror"
                                        placeholder="Januari 2020" type="text" />
                                    @error('exp_4_date_start')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Akhir Kerja</label>
                                    <input name="exp_4_date_end" value="{{ old('exp_4_date_end') }}"
                                        id="exp_4_date_end"
                                        class="form-control month-picker @error('exp_4_date_end') is-invalid @enderror"
                                        placeholder="Januari 2020" type="text" />
                                    @error('exp_4_date_end')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Alasan Berhenti</label>
                                    <input name="exp_4_reason"
                                        class="form-control @error('exp_4_reason') is-invalid @enderror"
                                        value="{{ old('exp_4_reason') }}" id="exp_4_reason"
                                        placeholder="Muara Teweh" type="text">
                                    @error('exp_4_reason')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary mt-10 float-right">Next Step</button>
                            </div>
                        </div>                    
                    </div>       
            </div>
        </form>
    </div>
@endsection