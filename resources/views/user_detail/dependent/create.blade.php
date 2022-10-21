{{-- 
    /admin-hr/dependent
    
--}}
@extends('template.admin.main_privilege')
@section('content')
    <div class="mb-30">
        <form action="/user-dependent/store" method="POST">
            @csrf
            <input type="text" name="isEdit" id="isEdit" value="">
            <input type="text" name="user_dependent_uuid" id="user_dependent_uuid" value="">
            <input type="text" name="nik_employee" id="nik_employee" value="">
            <input type="text" name="user_detail_uuid" value="{{ $user_detail_uuid }}">
            <div class="min-height-200px">
                <!-- Identitas Karyawan -->
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
                                    <select name="mother_gender" class="selectpicker form-control">
                                        <option value="Laki-laki" {{ (old('mother_gender')=='Laki-laki' )?'selected':''
                                            }}>Laki-laki</option>
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
                                    <input name="mother_date_birth" id="mother_date_birth" value="{{ old('mother_date_birth') }}"
                                        class="form-control @error('mother_date_birth') is-invalid @enderror"
                                        placeholder="Select Date" type="date" />

                                    @error('mother_date_birth')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Pendidikan</label>
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
                                    <select name="father_gender" class="selectpicker form-control">
                                        <option value="Laki-laki" {{ (old('father_gender')=='Laki-laki'
                                            )?'selected':'selected' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ (old('father_gender')=='Perempuan' )?'selected':''
                                            }}>Perempuan</option>
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
                                    <input name="father_date_birth" id="father_date_birth" value="{{ old('father_date_birth') }}"
                                        class="form-control @error('father_date_birth') is-invalid @enderror"
                                        placeholder="Select Date" type="date" />

                                    @error('father_date_birth')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Pendidikan</label>
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
                    @if($status !="Lajang")
                    <div id="married" class="pd-20 card-box">
                        {{-- hr --}}
                        @if($status == "Menikah")
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
                                        <select name="mother_in_law_gender" class="selectpicker form-control">
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
                                        <input name="mother_in_law_date_birth" id="mother_in_law_date_birth"
                                            value="{{ old('mother_in_law_date_birth') }}"
                                            class="form-control @error('mother_in_law_date_birth') is-invalid @enderror"
                                            placeholder="Select Date" type="date" />

                                        @error('mother_in_law_date_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Pendidikan</label>
                                        <input name="mother_in_law_education"
                                            class="form-control @error('mother_in_law_education') is-invalid @enderror"
                                            value="{{ old('mother_in_law_education') }}" id="mother_in_law_education"
                                            placeholder="Muara Teweh" type="text">
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
                                        <select name="father_in_law_gender" class="selectpicker form-control">
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
                                        <input name="father_in_law_date_birth" id="father_in_law_date_birth"
                                            value="{{ old('father_in_law_date_birth') }}"
                                            class="form-control @error('father_in_law_date_birth') is-invalid @enderror"
                                            placeholder="Select Date" type="date" />

                                        @error('father_in_law_date_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Pendidikan</label>
                                        <input name="father_in_law_education"
                                            class="form-control @error('father_in_law_education') is-invalid @enderror"
                                            value="{{ old('father_in_law_education') }}" id="father_in_law_education"
                                            placeholder="Muara Teweh" type="text">
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
                                            value="{{ old('couple_name') }}" id="couple_name" placeholder="Muara Teweh"
                                            type="text">
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
                                        <select name="couple_gender" id="couple_gender" class="selectpicker form-control">
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
                                        <input name="couple_date_birth" id="couple_date_birth" value="{{ old('couple_date_birth') }}"
                                            class="form-control @error('couple_date_birth') is-invalid @enderror"
                                            placeholder="Select Date" type="date" />

                                        @error('couple_date_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Pendidikan</label>
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
                        @endif
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
                                    <select name="child1_gender" class="selectpicker form-control">
                                        <option value="Laki-laki" {{ (old('child1_gender')=='Laki-laki' )?'selected':''
                                            }}>Laki-laki</option>
                                        <option value="Perempuan" {{ (old('child1_gender')=='Perempuan' )?'selected':''
                                            }}>Perempuan</option>
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
                                    <input name="child1_date_birth" id="child1_date_birth" value="{{ old('child1_date_birth') }}"
                                        class="form-control @error('child1_date_birth') is-invalid @enderror"
                                        placeholder="Select Date" type="date" />

                                    @error('child1_date_birth')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Pendidikan</label>
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
                                    <select name="child2_gender" class="selectpicker form-control">
                                        <option value="Laki-laki" {{ (old('child2_gender')=='Laki-laki' )?'selected':''
                                            }}>Laki-laki</option>
                                        <option value="Perempuan" {{ (old('child2_gender')=='Perempuan' )?'selected':''
                                            }}>Perempuan</option>
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
                                    <input name="child2_date_birth" id="child2_date_birth" value="{{ old('child2_date_birth') }}"
                                        class="form-control @error('child2_date_birth') is-invalid @enderror"
                                        placeholder="Select Date" type="date" />

                                    @error('child2_date_birth')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Pendidikan</label>
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
                                    <select name="child3_gender" class="selectpicker form-control">
                                        <option value="Laki-laki" {{ (old('child3_gender')=='Laki-laki' )?'selected':''
                                            }}>Laki-laki</option>
                                        <option value="Perempuan" {{ (old('child3_gender')=='Perempuan' )?'selected':''
                                            }}>Perempuan</option>
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
                                    <input name="child3_date_birth" id="child3_date_birth" value="{{ old('child3_date_birth') }}"
                                        class="form-control @error('child3_date_birth') is-invalid @enderror"
                                        placeholder="Select Date" type="date" />

                                    @error('child3_date_birth')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Pendidikan</label>
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
                    @endif
                    <div  class="card-box mb-20 text-right">
                        <button type="submit" class="btn btn-primary mt-30 text-right mr-20 mb-20">Next Step</button>
                    </div>
            </div>
        </form>
    </div>
@endsection

@section('js_ready')
function edit(){
    let data = @json($data);
    let user_dependents = data.user_dependents;
       
    $('#user_detail_uuid').val(data.user_detail_uuid)  
    $('#isEdit').val(data.isEdit)  
    $('#nik_employee').val(data.nik_employee)  
  
    $('#user_detail_uuid').val(data.user_detail_uuid)  


    if(user_dependents){
        $('#user_dependent_uuid').val(user_dependents.uuid)  
        if(user_dependents.child3_name){
            $('#child3_name').val(user_dependents.child3_name)  
            $('#child3_date_birth').val(user_dependents.child3_date_birth)  
            $('#child3_education').val(user_dependents.child3_education)  
            $('#child3_gender').val(user_dependents.child3_gender)          
            $('#child3_place_birth').val(user_dependents.child3_place_birth)  
        } 
        if(user_dependents.child2_name){
            $('#child2_name').val(user_dependents.child2_name)  
            $('#child2_date_birth').val(user_dependents.child2_date_birth)  
            $('#child2_education').val(user_dependents.child2_education)  
            $('#child2_gender').val(user_dependents.child2_gender)          
            $('#child2_place_birth').val(user_dependents.child2_place_birth)  
        } 
        if(user_dependents.child1_name){
            $('#child1_name').val(user_dependents.child1_name)  
            $('#child1_date_birth').val(user_dependents.child1_date_birth)  
            $('#child1_education').val(user_dependents.child1_education)  
            $('#child1_gender').val(user_dependents.child1_gender)          
            $('#child1_place_birth').val(user_dependents.child1_place_birth)  
        } 
        if(user_dependents.mother_name){
            $('#mother_name').val(user_dependents.mother_name)  
            $('#mother_date_birth').val(user_dependents.mother_date_birth)  
            $('#mother_education').val(user_dependents.mother_education)  
            $('#mother_gender').val(user_dependents.mother_gender)          
            $('#mother_place_birth').val(user_dependents.mother_place_birth)  
        }  
        if(user_dependents.father_name){
            $('#father_name').val(user_dependents.father_name)  
            $('#father_date_birth').val(user_dependents.father_date_birth)  
            $('#father_education').val(user_dependents.father_education)  
            $('#father_gender').val(user_dependents.father_gender)          
            $('#father_place_birth').val(user_dependents.father_place_birth)  
        } 
        if(user_dependents.couple_name){
            $('#couple_name').val(user_dependents.couple_name)  
            $('#couple_date_birth').val(user_dependents.couple_date_birth)  
            $('#couple_education').val(user_dependents.couple_education)  
            $('#couple_gender').val(user_dependents.couple_gender)          
            $('#couple_place_birth').val(user_dependents.couple_place_birth)  
        } 
        if(user_dependents.mother_in_law_name){
            $('#mother_in_law_name').val(user_dependents.mother_in_law_name)  
            $('#mother_in_law_date_birth').val(user_dependents.mother_in_law_date_birth)  
            $('#mother_in_law_education').val(user_dependents.mother_in_law_education)  
            $('#mother_in_law_gender').val(user_dependents.mother_in_law_gender)          
            $('#mother_in_law_place_birth').val(user_dependents.mother_in_law_place_birth)  
        } 
        if(user_dependents.father_in_law_name){
            $('#father_in_law_name').val(user_dependents.father_in_law_name)  
            $('#father_in_law_date_birth').val(user_dependents.father_in_law_date_birth)  
            $('#father_in_law_education').val(user_dependents.father_in_law_education)  
            $('#father_in_law_gender').val(user_dependents.father_in_law_gender)          
            $('#father_in_law_place_birth').val(user_dependents.father_in_law_place_birth)  
        } 
    }


    


    console.log(data);
} 
let data = @json($data);
if(data){
    console.log('udin');
    console.log(data);
    edit();
}
@endsection