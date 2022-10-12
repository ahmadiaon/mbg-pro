{{-- 
    /admin-hr/licences
    
--}}
@extends('template.admin.main')
@section('content')
<div class="pd-20 card-box mb-20">
    <form action="/admin-hr/licence" method="POST">
        @csrf
        <input type="hidden" name="user_detail_uuid" value="{{ $user_detail_uuid }}">
        <input type="hidden" name="uuid" value="">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Nomor Lisensi</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jenis SIM</label>
                            <input disabled class="form-control" value="Sim A">
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="sim_A"
                                class="form-control @error('sim_A') is-invalid @enderror"
                                value="{{ old('sim_A') }}" id="sim_A" placeholder="Muara Teweh"
                                type="text">
                            @error('sim_A')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jenis SIM</label>
                            <input disabled class="form-control" value="Sim B1">
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="sim_B1"
                                class="form-control @error('sim_B1') is-invalid @enderror"
                                value="{{ old('sim_B1') }}" id="sim_B1" placeholder="Muara Teweh"
                                type="text">
                            @error('sim_B1')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jenis SIM</label>
                            <input disabled class="form-control" value="Sim B2">
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="sim_B2"
                                class="form-control @error('sim_B2') is-invalid @enderror"
                                value="{{ old('sim_B2') }}" id="sim_B2" placeholder="Muara Teweh"
                                type="text">
                            @error('sim_B2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jenis SIM</label>
                            <input disabled class="form-control" value="Sim C">
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="sim_C"
                                class="form-control @error('sim_C') is-invalid @enderror"
                                value="{{ old('sim_C') }}" id="sim_C" placeholder="Muara Teweh"
                                type="text">
                            @error('sim_C')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jenis SIM</label>
                            <input disabled class="form-control" value="Sim D">
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="sim_D"
                                class="form-control @error('sim_D') is-invalid @enderror"
                                value="{{ old('sim_D') }}" id="sim_D" placeholder="Muara Teweh"
                                type="text">
                            @error('sim_D')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jenis SIM</label>
                            <input disabled class="form-control" value="A Umum">
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="sim_A_UMUM"
                                class="form-control @error('sim_A_UMUM') is-invalid @enderror"
                                value="{{ old('sim_A_UMUM') }}" id="sim_A_UMUM"
                                placeholder="Muara Teweh" type="text">
                            @error('sim_A_UMUM')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jenis SIM</label>
                            <input disabled class="form-control" value="B1 Umum">
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="sim_B1_UMUM"
                                class="form-control @error('sim_B1_UMUM') is-invalid @enderror"
                                value="{{ old('sim_B1_UMUM') }}" id="sim_B1_UMUM"
                                placeholder="Muara Teweh" type="text">
                            @error('sim_B1_UMUM')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jenis SIM</label>
                            <input disabled class="form-control" value="B2 Umum">
                            @error('group_license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <label>Nomor SIM</label>
                            <input name="SIM_B2_UMUM"
                                class="form-control @error('SIM_B2_UMUM') is-invalid @enderror"
                                value="{{ old('SIM_B2_UMUM') }}" id="SIM_B2_UMUM"
                                placeholder="Muara Teweh" type="text">
                            @error('SIM_B2_UMUM')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-mb-12  text-right">
                    <button type="submit" class="btn btn-primary mt-30 ">Next Step</button>

                </div>
            </div>
        </div>
    </form>
</div>
  
@endsection
