@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        {{-- <form action="/admin-hr/employees/contract/create" method="POST"> --}}
            <form action="/admin-hr/employees" method="POST">
                @csrf
                <div class="min-height-200px">

                    <!-- Identitas Karyawan -->
                    <div class="pd-20 card-box mb-20">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Identitas Karyawan</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="pd-20 card-box mb-30">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input name="name" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" id="name" placeholder="Ahmadi Alpasyri"
                                            type="text">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>NIK</label>
                                                <input name="nik_number"
                                                    class="form-control @error('nik_number') is-invalid @enderror"
                                                    value="{{ old('nik_number') }}" id="nik_number"
                                                    placeholder="6210000" type="text">
                                                @error('nik_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Nomor Kartu Keluarga</label>
                                                <input name="kk_number"
                                                    class="form-control @error('kk_number') is-invalid @enderror"
                                                    value="{{ old('kk_number') }}" id="kk_number"
                                                    placeholder="62111" type="text">
                                                @error('kk_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                            <label>Kewarganegaraan</label>
                                            <select name="citizenship"
                                                class="form-control @error('citizenship') is-invalid @enderror">
                                                <option value="WNI" {{ (old('citizenship')=='WNI' )?'selected':'' }}>WNI
                                                </option>
                                                <option value="WNA" {{ (old('citizenship')=='WNA' )?'selected':'' }}>WNA
                                                </option>
                                            </select>
                                            @error('citizenship')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Agama</label>
                                                <select name="religion_uuid" class="form-control">
                                                    @foreach($religions as $religion)
                                                    @if(old('religion_uuid' ) == $religion->uuid)
                                                    <option value="{{ $religion->uuid }}" selected>{{
                                                        $religion->religion
                                                        }}
                                                    </option>
                                                    @else
                                                    <option value="{{ $religion->uuid }}">{{ $religion->religion }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input name="place_of_birth"
                                                    class="form-control @error('place_of_birth') is-invalid @enderror"
                                                    value="{{ old('place_of_birth') }}" id="place_of_birth"
                                                    placeholder="Muara Teweh" type="text">
                                                @error('place_of_birth')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input name="date_of_birth"
                                                    class="form-control date-picker  @error('date_of_birth') is-invalid @enderror"
                                                    value="{{ old('date_of_birth') }}" placeholder="Select Date"
                                                    type="text" />
                                                @error('date_of_birth')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Golongan Darah</label>
                                                <select name="blood_group"
                                                    class="form-control @error('blood_group') is-invalid @enderror">
                                                    <option value="A" {{ (old('blood_group')=='A' )?'selected':'' }}>A
                                                    </option>
                                                    <option value="B" {{ (old('blood_group')=='B' )?'selected':'' }}>B
                                                    </option>
                                                    <option value="AB" {{ (old('blood_group')=='AB' )?'selected':'' }}>
                                                        AB
                                                    </option>
                                                    <option value="O" {{ (old('blood_group')=='O' )?'selected':'' }}>O
                                                    </option>
                                                    <option value="unknown" {{ (old('blood_group')=='unknown'
                                                        )?'selected':'' }}>Tak Diketahui</option>
                                                </select>
                                                @error('blood_group')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="Lajang" {{ (old('status')=='Lajang' )?'selected':''
                                                        }}>
                                                        Lajang</option>
                                                    <option value="Menikah" {{ (old('status')=='Menikah' )?'selected':''
                                                        }}>
                                                        Menikah</option>
                                                    <option value="Duda" {{ (old('status')=='Duda' )?'selected':'' }}>
                                                        Duda
                                                    </option>
                                                    <option value="Janda" {{ (old('status')=='Janda' )?'selected':'' }}>
                                                        Janda</option>
                                                </select>
                                                @error('status')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="Laki-laki" {{ (old('gender')=='Laki-laki'
                                                        )?'selected':'' }}>Laki-laki</option>
                                                    <option value="Perempuan" {{ (old('gender')=='Perempuan'
                                                        )?'selected':'' }}>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="pd-20 card-box mb-30">

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Nomor Rekening</label>
                                                <input name="financial_number"
                                                    class="form-control @error('financial_number') is-invalid @enderror"
                                                    value="{{ old('financial_number') }}" id="financial_number"
                                                    placeholder="000" type="text">
                                                @error('financial_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Nomer Handphone</label>
                                                <input name="phone_number"
                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                    value="{{ old('phone_number') }}" id="phone_number"
                                                    placeholder="000" type="text">
                                                @error('phone_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>BPJS Kesehatan</label>
                                                <input name="bpjs_ketenagakerjaan"
                                                    class="form-control @error('bpjs_ketenagakerjaan') is-invalid @enderror"
                                                    value="{{ old('bpjs_ketenagakerjaan') }}" id="bpjs_ketenagakerjaan"
                                                    placeholder="Muara Teweh" type="text">
                                                @error('bpjs_ketenagakerjaan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label>BPJS Ketenagakerjaan</label>
                                                <input name="bpjs_kesehatan"
                                                    class="form-control @error('bpjs_kesehatan') is-invalid @enderror"
                                                    value="{{ old('bpjs_kesehatan') }}" id="bpjs_kesehatan"
                                                    placeholder="Muara Teweh" type="text">
                                                @error('bpjs_kesehatan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>Jenis POH</label>
                                            <select name="group_poh"
                                                class="form-control @error('group_poh') is-invalid @enderror">
                                                <option value="Dalam Kabupaten" {{ (old('group_poh')=='Dalam Kabupaten'
                                                    )?'selected':'' }}>Dalam Kabupaten</option>
                                                <option value="Dalam Pulau" {{ (old('group_poh')=='Dalam Pulau'
                                                    )?'selected':'' }}>Dalam Pulau</option>
                                                <option value="Luar Pulau" {{ (old('group_poh')=='Luar Pulau'
                                                    )?'selected':'' }}>Luar Pulau</option>
                                            </select>
                                            @error('group_poh')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-7">
                                            <div class="form-group">
                                                <label>POH</label>
                                                <input name="poh_place"
                                                    class="form-control @error('poh_place') is-invalid @enderror"
                                                    value="{{ old('poh_place') }}" id="poh_place"
                                                    placeholder="Barito Utara" type="text">
                                                @error('poh_place')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input name="address"
                                            class="form-control @error('address') is-invalid @enderror"
                                            value="{{ old('address') }}" id="address" placeholder="Jl. Muara Teweh"
                                            type="text">
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- Identitas Karyawan license-->
                    <div class="pd-20 card-box mb-20">
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
                                            <input disabled class="form-control" value="Sim A Umum">
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
                                            <input disabled class="form-control" value="Sim B1 Umum">
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
                                            <input disabled class="form-control" value="Sim B2 Umum">
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
                            </div>
                        </div>

                    </div>

                    <!-- Pendidikan Karyawan -->
                    <div class="pd-20 card-box mb-20">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Pendidikan Karyawan</h4>
                            </div>
                        </div>
                        <div class="pd-20 card-box mb-20">
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
                            </div>

                        </div>


                    </div>
                    <!-- Pendidikan Karyawan End -->
                    <!-- Pengalaman Karyawan -->
                    <div class="pd-20 card-box mb-20">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Pengalaman Karyawan</h4>
                            </div>
                        </div>
                        <div class="pd-20 card-box mb-20 text-black bg-light card-box">
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

                        </div>
                    </div>
                    <!-- Pengalaman Karyawan End -->
                    <!-- Tanggungan Karyawan -->
                    <div class="pd-20 card-box mb-20">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Tanggungan Keluarga</h4>
                            </div>
                        </div>
                        <div class="pd-20 card-box mb-20">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="text-blue h6">Ibu Kandung</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input name="mother_name"
                                            class="form-control @error('mother_name') is-invalid @enderror"
                                            value="{{ old('mother_name') }}" id="mother_name" placeholder="Muara Teweh"
                                            type="text">
                                        @error('mother_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="mother_gender" class="form-control">
                                            <option value="Laki-laki" {{ (old('mother_gender')=='Laki-laki'
                                                )?'selected':'' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ (old('mother_gender')=='Perempuan'
                                                )?'selected':'selected' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Tempat</label>
                                        <input name="mother_place_birth"
                                            class="form-control @error('mother_place_birth') is-invalid @enderror"
                                            value="{{ old('mother_place_birth') }}" id="mother_place_birth"
                                            placeholder="Muara Teweh" type="text">
                                        @error('mother_place_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input name="mother_date_birth" value="{{ old('mother_date_birth') }}"
                                            class="form-control date-picker @error('mother_date_birth') is-invalid @enderror"
                                            placeholder="Select Date" type="text" />

                                        @error('mother_date_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Pendidikan Terakhir</label>
                                        <input name="mother_education"
                                            class="form-control @error('mother_education') is-invalid @enderror"
                                            value="{{ old('mother_education') }}" id="mother_education"
                                            placeholder="Muara Teweh" type="text">
                                        @error('mother_education')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="text-blue h6">Ayah Kandung</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input name="father_name"
                                            class="form-control @error('father_name') is-invalid @enderror"
                                            value="{{ old('father_name') }}" id="father_name" placeholder="Muara Teweh"
                                            type="text">
                                        @error('father_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="father_gender" class="form-control">
                                            <option value="Laki-laki" {{ (old('father_gender')=='Laki-laki'
                                                )?'selected':'selected' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ (old('father_gender')=='Perempuan'
                                                )?'selected':'' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Tempat</label>
                                        <input name="father_place_birth"
                                            class="form-control @error('father_place_birth') is-invalid @enderror"
                                            value="{{ old('father_place_birth') }}" id="father_place_birth"
                                            placeholder="Muara Teweh" type="text">
                                        @error('father_place_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input name="father_date_birth" value="{{ old('father_date_birth') }}"
                                            class="form-control date-picker @error('father_date_birth') is-invalid @enderror"
                                            placeholder="Select Date" type="text" />

                                        @error('father_date_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Pendidikan Terakhir</label>
                                        <input name="father_education"
                                            class="form-control @error('father_education') is-invalid @enderror"
                                            value="{{ old('father_education') }}" id="father_education"
                                            placeholder="Muara Teweh" type="text">
                                        @error('father_education')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="married" class="pd-20 card-box mb-20">
                            {{-- hr --}}
                            <div id="out_law">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="text-blue h6">Ibu Mertua</h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input name="mother_in_law_name"
                                                class="form-control @error('mother_in_law_name') is-invalid @enderror"
                                                value="{{ old('mother_in_law_name') }}" id="mother_in_law_name"
                                                placeholder="Muara Teweh" type="text">
                                            @error('mother_in_law_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select name="mother_in_law_gender" class="form-control">
                                                <option value="Laki-laki" {{ (old('mother_in_law_gender')=='Laki-laki'
                                                    )?'selected':'' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ (old('mother_in_law_gender')=='Perempuan'
                                                    )?'selected':'selected' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Tempat</label>
                                            <input name="mother_in_law_place_birth"
                                                class="form-control @error('mother_in_law_place_birth') is-invalid @enderror"
                                                value="{{ old('mother_in_law_place_birth') }}"
                                                id="mother_in_law_place_birth" placeholder="Muara Teweh" type="text">
                                            @error('mother_in_law_place_birth')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input name="mother_in_law_date_birth"
                                                value="{{ old('mother_in_law_date_birth') }}"
                                                class="form-control date-picker @error('mother_in_law_date_birth') is-invalid @enderror"
                                                placeholder="Select Date" type="text" />

                                            @error('mother_in_law_date_birth')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label>Pendidikan Terakhir</label>
                                            <input name="mother_in_law_education"
                                                class="form-control @error('mother_in_law_education') is-invalid @enderror"
                                                value="{{ old('mother_in_law_education') }}"
                                                id="mother_in_law_education" placeholder="Muara Teweh" type="text">
                                            @error('mother_in_law_education')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="text-blue h6">Ayah Mertua</h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input name="father_in_law_name"
                                                class="form-control @error('father_in_law_name') is-invalid @enderror"
                                                value="{{ old('father_in_law_name') }}" id="father_in_law_name"
                                                placeholder="Muara Teweh" type="text">
                                            @error('father_in_law_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select name="father_in_law_gender" class="form-control">
                                                <option value="Laki-laki" {{ (old('father_in_law_gender')=='Laki-laki'
                                                    )?'selected':'selected' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ (old('father_in_law_gender')=='Perempuan'
                                                    )?'selected':'' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Tempat</label>
                                            <input name="father_in_law_place_birth"
                                                class="form-control @error('father_in_law_place_birth') is-invalid @enderror"
                                                value="{{ old('father_in_law_place_birth') }}"
                                                id="father_in_law_place_birth" placeholder="Muara Teweh" type="text">
                                            @error('father_in_law_place_birth')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input name="father_in_law_date_birth"
                                                value="{{ old('father_in_law_date_birth') }}"
                                                class="form-control date-picker @error('father_in_law_date_birth') is-invalid @enderror"
                                                placeholder="Select Date" type="text" />

                                            @error('father_in_law_date_birth')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label>Pendidikan Terakhir</label>
                                            <input name="father_in_law_education"
                                                class="form-control @error('father_in_law_education') is-invalid @enderror"
                                                value="{{ old('father_in_law_education') }}"
                                                id="father_in_law_education" placeholder="Muara Teweh" type="text">
                                            @error('father_in_law_education')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="text-blue h6">Istri/Suami</h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input name="couple_name"
                                                class="form-control @error('couple_name') is-invalid @enderror"
                                                value="{{ old('couple_name') }}" id="couple_name"
                                                placeholder="Muara Teweh" type="text">
                                            @error('couple_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select name="couple_gender" id="couple_gender" class="form-control">
                                                <option value="Laki-laki" {{ (old('couple_gender')=='Laki-laki'
                                                    )?'selected':'' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ (old('couple_gender')=='Perempuan'
                                                    )?'selected':'' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Tempat</label>
                                            <input name="couple_place_birth"
                                                class="form-control @error('couple_place_birth') is-invalid @enderror"
                                                value="{{ old('couple_place_birth') }}" id="couple_place_birth"
                                                placeholder="Muara Teweh" type="text">
                                            @error('couple_place_birth')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input name="couple_date_birth" value="{{ old('couple_date_birth') }}"
                                                class="form-control date-picker @error('couple_date_birth') is-invalid @enderror"
                                                placeholder="Select Date" type="text" />

                                            @error('couple_date_birth')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label>Pendidikan Terakhir</label>
                                            <input name="couple_education"
                                                class="form-control @error('couple_education') is-invalid @enderror"
                                                value="{{ old('couple_education') }}" id="couple_education"
                                                placeholder="Muara Teweh" type="text">
                                            @error('couple_education')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="text-blue h6">Anak ke- 1</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input name="child1_name"
                                            class="form-control @error('child1_name') is-invalid @enderror"
                                            value="{{ old('child1_name') }}" id="child1_name" placeholder="Muara Teweh"
                                            type="text">
                                        @error('child1_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="child1_gender" class="form-control">
                                            <option value="Laki-laki" {{ (old('child1_gender')=='Laki-laki'
                                                )?'selected':'' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ (old('child1_gender')=='Perempuan'
                                                )?'selected':'' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Tempat</label>
                                        <input name="child1_place_birth"
                                            class="form-control @error('child1_place_birth') is-invalid @enderror"
                                            value="{{ old('child1_place_birth') }}" id="child1_place_birth"
                                            placeholder="Muara Teweh" type="text">
                                        @error('child1_place_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input name="child1_date_birth" value="{{ old('child1_date_birth') }}"
                                            class="form-control date-picker @error('child1_date_birth') is-invalid @enderror"
                                            placeholder="Select Date" type="text" />

                                        @error('child1_date_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Pendidikan Terakhir</label>
                                        <input name="child1_education"
                                            class="form-control @error('child1_education') is-invalid @enderror"
                                            value="{{ old('child1_education') }}" id="child1_education"
                                            placeholder="Muara Teweh" type="text">
                                        @error('child1_education')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="text-blue h6">Anak ke 2</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input name="child2_name"
                                            class="form-control @error('child2_name') is-invalid @enderror"
                                            value="{{ old('child2_name') }}" id="child2_name" placeholder="Muara Teweh"
                                            type="text">
                                        @error('child2_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="child2_gender" class="form-control">
                                            <option value="Laki-laki" {{ (old('child2_gender')=='Laki-laki'
                                                )?'selected':'' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ (old('child2_gender')=='Perempuan'
                                                )?'selected':'' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Tempat</label>
                                        <input name="child2_place_birth"
                                            class="form-control @error('child2_place_birth') is-invalid @enderror"
                                            value="{{ old('child2_place_birth') }}" id="child2_place_birth"
                                            placeholder="Muara Teweh" type="text">
                                        @error('child2_place_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input name="child2_date_birth" value="{{ old('child2_date_birth') }}"
                                            class="form-control date-picker @error('child2_date_birth') is-invalid @enderror"
                                            placeholder="Select Date" type="text" />

                                        @error('child2_date_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Pendidikan Terakhir</label>
                                        <input name="child2_education"
                                            class="form-control @error('child2_education') is-invalid @enderror"
                                            value="{{ old('child2_education') }}" id="child2_education"
                                            placeholder="Muara Teweh" type="text">
                                        @error('child2_education')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="text-blue h6">Anak ke 3</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input name="child3_name"
                                            class="form-control @error('child3_name') is-invalid @enderror"
                                            value="{{ old('child3_name') }}" id="child3_name" placeholder="Muara Teweh"
                                            type="text">
                                        @error('child3_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="child3_gender" class="form-control">
                                            <option value="Laki-laki" {{ (old('child3_gender')=='Laki-laki'
                                                )?'selected':'' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ (old('child3_gender')=='Perempuan'
                                                )?'selected':'' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Tempat</label>
                                        <input name="child3_place_birth"
                                            class="form-control @error('child3_place_birth') is-invalid @enderror"
                                            value="{{ old('child3_place_birth') }}" id="child3_place_birth"
                                            placeholder="Muara Teweh" type="text">
                                        @error('child3_place_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input name="child3_date_birth" value="{{ old('child3_date_birth') }}"
                                            class="form-control date-picker @error('child3_date_birth') is-invalid @enderror"
                                            placeholder="Select Date" type="text" />

                                        @error('child3_date_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Pendidikan Terakhir</label>
                                        <input name="child3_education"
                                            class="form-control @error('child3_education') is-invalid @enderror"
                                            value="{{ old('child3_education') }}" id="child3_education"
                                            placeholder="Muara Teweh" type="text">
                                        @error('child3_education')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Tanggungan Karyawan End -->

                    <!-- Riwayat Kesehatan Karyawan -->
                    <div class="pd-20 card-box mb-20">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Riwayat Kesehatan Karyawan</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Penyakit/Kecelakaan/Gejala</label>
                                    <input name="name_health"
                                        class="form-control @error('name_health') is-invalid @enderror"
                                        value="{{ old('name_health') }}" id="name_health" placeholder="Asma"
                                        type="text">
                                    @error('name_health')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-12">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input name="year_health"
                                        class="form-control @error('year_health') is-invalid @enderror"
                                        value="{{ old('year_health') }}" id="year_health" placeholder="2012"
                                        type="text">
                                    @error('year_health')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
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
                            <div class="col-md-1 col-sm-12">
                                <div class="form-group">
                                    <label>Sembuh</label>
                                    <select name="status_health"
                                        class="form-control @error('status_health') is-invalid @enderror">
                                        <option value="Sembuh" {{ (old('status_health')=='Sembuh' )?'selected':'' }}>
                                            Sembuh
                                        </option>
                                        <option value="Belum Sembuh" {{ (old('status_health')=='Belum Sembuh'
                                            )?'selected':'' }}>Belum Sembuh
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>


                    </div>
                    <!-- Riwayat Kesehatan Karyawan End -->

                    <!-- Pekerjaan Start -->
                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Pekerjaan Karyawan</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-1">

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Departement</label>
                                    <select name="department_uuid" class="custom-select2 form-control">
                                        @foreach($departments as $department)
                                        @if(old('department_uuid' ) == $department->uuid)
                                        <option value="{{ $department->uuid }}" selected>{{ $department->department }}
                                        </option>
                                        @else
                                        <option value="{{ $department->uuid }}">{{ $department->department }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <select name="position_uuid" class="custom-select2 form-control">
                                        @foreach($positions as $position)
                                        @if(old('position_uuid' ) == $position->id)
                                        <option value="{{ $position->uuid }}" selected>{{ $position->position }}
                                        </option>
                                        @else
                                        <option value="{{ $position->uuid }}">{{ $position->position }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>NIK Employee</label>
                                    <input name="nik_employee"
                                        class="form-control @error('nik_employee') is-invalid @enderror"
                                        value="{{ old('nik_employee') }}" id="nik_employee" placeholder="MBLE-29990"
                                        type="text">
                                    @error('nik_employee')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2"></div>
                        </div>

                    </div>
                    <!-- Pekerjaan end -->
                    <!-- Riwayat Kesehatan Karyawan -->
                    <div class="pd-20 card-box mb-20">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Salary Karyawan</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Gaji Pokok</label>
                                    <input name="salary" class="form-control @error('salary') is-invalid @enderror"
                                        value="{{ old('salary') }}" id="salary" placeholder="Muara Teweh" type="text">
                                    @error('salary')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Insentif</label>
                                    <input name="insentif" class="form-control @error('insentif') is-invalid @enderror"
                                        value="{{ old('insentif') }}" id="insentif" placeholder="Muara Teweh"
                                        type="text">
                                    @error('insentif')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Premi BK</label>
                                    <input name="premi_bk" class="form-control @error('premi_bk') is-invalid @enderror"
                                        value="{{ old('premi_bk') }}" id="premi_bk" placeholder="Muara Teweh"
                                        type="text">
                                    @error('premi_bk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Premi NBK</label>
                                    <input name="premi_nbk"
                                        class="form-control @error('premi_nbk') is-invalid @enderror"
                                        value="{{ old('premi_nbk') }}" id="premi_nbk" placeholder="Muara Teweh"
                                        type="text">
                                    @error('premi_nbk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- --}}
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Kayu</label>
                                    <input name="premi_kayu"
                                        class="form-control @error('premi_kayu') is-invalid @enderror"
                                        value="{{ old('premi_kayu') }}" id="premi_kayu" placeholder="Muara Teweh"
                                        type="text">
                                    @error('premi_kayu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>MB</label>
                                    <input name="premi_mb" class="form-control @error('premi_mb') is-invalid @enderror"
                                        value="{{ old('premi_mb') }}" id="premi_mb" placeholder="Muara Teweh"
                                        type="text">
                                    @error('premi_mb')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>RJ</label>
                                    <input name="premi_rj" class="form-control @error('premi_rj') is-invalid @enderror"
                                        value="{{ old('premi_rj') }}" id="premi_rj" placeholder="Muara Teweh"
                                        type="text">
                                    @error('premi_rj')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                        </div>


                    </div>
                    <!-- Riwayat Kesehatan Karyawan End -->
                    <button type="submit" class="btn py-30 btn-success mb-30 btn-lg btn-block">
                        Add Employee
                    </button>
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
<script>
    //  
    $("#married").hide(); 
    const select = document.getElementById('status');
    select.addEventListener('change', function handleChange(event) {
        var status = event.target.value;
        if(status == 'Lajang'){
            $("#married").hide();
        }
        if(status == 'Duda'){
            
            $("#married").show();
            $("#out_law").hide();
        }
        if(status == 'Janda'){
            
            $("#married").show();
            $("#out_law").hide();
        }
        if(status == 'Menikah'){
            console.log('menikah')
            $("#married").show();
            $("#out_law").show();
        }
        console.log(); // 👉️ get selected VALUE
    });
    const select_gender = document.getElementById('gender');
    select_gender.addEventListener('change', function handleChange(event) {
        var status = event.target.value;
        console.log(status)
        if(status == 'Laki-laki'){
            $("#couple_gender option[value='Perempuan']").attr('selected', 'selected');
        }else{
            $("#couple_gender option[value='Laki-laki']").attr('selected', 'selected');
        }
    });
</script>

@endsection