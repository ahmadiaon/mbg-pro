{{-- 
    /admin-hr
    
--}}
@extends('template.admin.main')
@section('content')
    <div class="card-box mb-30">
        {{-- <form action="/admin-hr/employees/contract/create" method="POST"> --}}
        <form action="/admin-hr/user" method="POST">
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
                                                value="{{ old('nik_number') }}" id="nik_number" placeholder="6210000"
                                                type="text">
                                            @error('nik_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Nomor Kartu Keluarga</label>
                                                <input name="kk_number"
                                                    class="form-control @error('kk_number') is-invalid @enderror"
                                                    value="{{ old('kk_number') }}" id="kk_number" placeholder="62111"
                                                    type="text">
                                                @error('kk_number')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>NPWP</label>
                                    <input name="address" class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address') }}" id="address" placeholder="Jl. Muara Teweh"
                                        type="text">
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kewarganegaraan</label>
                                            <select name="citizenship"
                                                class="selectpicker form-control @error('citizenship') is-invalid @enderror">
                                                <option value="WNI" {{ old('citizenship') == 'WNI' ? 'selected' : '' }}>WNI
                                                </option>
                                                <option value="WNA" {{ old('citizenship') == 'WNA' ? 'selected' : '' }}>WNA
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
                                            <select name="religion_uuid" class="selectpicker form-control">
                                                @foreach ($religions as $religion)
                                                    @if (old('religion_uuid') == $religion->uuid)
                                                        <option value="{{ $religion->uuid }}" selected>
                                                            {{ $religion->religion }}
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
                                    <div class="col-7">
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
                                    <div class="col-5">
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
                                                class="selectpicker form-control @error('blood_group') is-invalid @enderror">
                                                <option value="A" {{ old('blood_group') == 'A' ? 'selected' : '' }}>A
                                                </option>
                                                <option value="B" {{ old('blood_group') == 'B' ? 'selected' : '' }}>B
                                                </option>
                                                <option value="AB" {{ old('blood_group') == 'AB' ? 'selected' : '' }}>
                                                    AB
                                                </option>
                                                <option value="O" {{ old('blood_group') == 'O' ? 'selected' : '' }}>O
                                                </option>
                                                <option value="unknown"
                                                    {{ old('blood_group') == 'unknown' ? 'selected' : '' }}>
                                                    Tak Diketahui</option>
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
                                            <select name="status" id="status"class="selectpicker form-control">
                                                <option value="Lajang" {{ old('status') == 'Lajang' ? 'selected' : '' }}>
                                                    Lajang</option>
                                                <option value="Menikah" {{ old('status') == 'Menikah' ? 'selected' : '' }}>
                                                    Menikah</option>
                                                <option value="Duda" {{ old('status') == 'Duda' ? 'selected' : '' }}>
                                                    Duda
                                                </option>
                                                <option value="Janda" {{ old('status') == 'Janda' ? 'selected' : '' }}>
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
                                            <select name="gender" id="gender" class="selectpicker form-control">
                                                <option value="Laki-laki"
                                                    {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="Perempuan"
                                                    {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
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
                                                value="{{ old('phone_number') }}" id="phone_number" placeholder="000"
                                                type="text">
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
                                        <div class="form-group">
                                            <label>Jenis POH</label>
                                            <select name="poh_uuid" class="selectpicker form-control">
                                                @foreach ($pohs as $poh)
                                                    @if (old('poh_uuid') == $poh->uuid)
                                                        <option value="{{ $poh->uuid }}" selected>{{ $poh->poh }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $poh->uuid }}">{{ $poh->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('poh_uuid')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-group">
                                            <label>Kabupaten/Kota</label>
                                            <input name="kabupaten"
                                                class="form-control @error('kabupaten') is-invalid @enderror"
                                                value="{{ old('kabupaten') }}" id="kabupaten" placeholder="Barito Utara"
                                                type="text">
                                            @error('kabupaten')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group ">
                                            <label>Desa</label>
                                            <input name="desa"
                                                class="form-control @error('desa') is-invalid @enderror"
                                                value="{{ old('desa') }}" id="desa" placeholder="001"
                                                type="text">
                                            @error('desa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>RT</label>
                                            <input name="rt" class="form-control @error('rt') is-invalid @enderror"
                                                value="{{ old('rt') }}" id="rt" placeholder="002"
                                                type="text">
                                            @error('rt')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group ">
                                            <label>RW</label>
                                            <input name="rw" class="form-control @error('rw') is-invalid @enderror"
                                                value="{{ old('rw') }}" id="rw" placeholder="001"
                                                type="text">
                                            @error('rw')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group ">
                                            <label>Kecamatan</label>
                                            <input name="kecamatan"
                                                class="form-control @error('kecamatan') is-invalid @enderror"
                                                value="{{ old('kecamatan') }}" id="kecamatan" placeholder="001"
                                                type="text">
                                            @error('kecamatan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <input name="provinsi"
                                                class="form-control @error('provinsi') is-invalid @enderror"
                                                value="{{ old('provinsi', 'Kalimantan Tengah') }}" id="provinsi"
                                                placeholder="002" type="text">
                                            @error('provinsi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-30 float-right">Next Step</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
