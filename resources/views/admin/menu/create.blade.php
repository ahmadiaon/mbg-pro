@extends('layout.main_form')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
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
                            <form>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input class="form-control" type="text" placeholder="Ahmadi">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input class="form-control" placeholder="6210000" type="url">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Nomor Kartu Keluarga</label>
                                                <input class="form-control" placeholder="62111" type="url">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label>Kewarganegaraan</label>
                                        <select class="form-control">
                                            <option>WNI</option>
                                            <option>WNA</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <select class="form-control">
                                                <option>Islam</option>
                                                <option>Kristen Protestan</option>
                                                <option>Hindu</option>
                                                <option>Budha</option>
                                                <option>Konghucu</option>
                                                <option>Katolik</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input class="form-control" placeholder="Muara Teweh" type="url">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input class="form-control" value="08/08/2000" type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Golongan Darah</label>
                                            <select class="form-control">
                                                <option>A</option>
                                                <option>B</option>
                                                <option>AB</option>
                                                <option>O</option>
                                                <option>Tak Diketahui</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control">
                                                <option>Lajang</option>
                                                <option>Menikah</option>
                                                <option>Duda</option>
                                                <option>Janda</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control">
                                                <option>Laki-laki</option>
                                                <option>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="pd-20 card-box mb-30">
                            <form>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nomor Rekening</label>
                                            <input class="form-control" placeholder="000" type="text">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nomer Handphone</label>
                                            <input class="form-control" value="08" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Jenis SIM</label>
                                            <select class="form-control">
                                                <option>A</option>
                                                <option>B-1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label>Nomor SIM</label>
                                            <input class="form-control" type="text" placeholder="Ahmadi">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>BPJS Kesehatan</label>
                                            <input class="form-control" placeholder="Muara Teweh" type="url">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group ">
                                            <label>BPJS Ketenagakerjaan</label>
                                            <input class="form-control" placeholder="Muara Teweh" type="url">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>Jenis POH</label>
                                        <select class="form-control">
                                            <option>Dalam Kabupaten</option>
                                            <option>Dalam Pulau</option>
                                            <option>Luar Pulau</option>
                                        </select>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-group">
                                            <label>POH</label>
                                            <input class="form-control" placeholder="Muara Teweh" type="url">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input class="form-control" placeholder="Muara Teweh" type="url">
                                </div>

                            </form>
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
                    <form>
                        <div class="row">
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Sekolah</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Daerah</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Lulus Tahun</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h6">Sekolah Menengah Atas Sederajat</h4>
                        </div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Sekolah</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Daerah</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Lulus Tahun</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h6">SMA/Sederajat</h4>
                        </div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Sekolah</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Daerah</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Lulus Tahun</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h6">Perguruan Tinggi</h4>
                        </div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Perguruan Tinggi</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Daerah</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Lulus Tahun</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h6">Lain-lain</h4>
                        </div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Daerah</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Lulus Tahun</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </form>
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
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h6">SMA/Sederajat</h4>
                        </div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Perusahaan</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Posisi/Jabatan</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Mulai Kerja</label>
                                    <input type="text" class="form-control" placeholder="only month and year" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Akhir Kerja</label>
                                    <input type="text" class="form-control" placeholder="only month and year" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Alasan Berhenti</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Perusahaan</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Posisi/Jabatan</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Mulai Kerja</label>
                                    <input type="text" class="form-control" placeholder="only month and year" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Akhir Kerja</label>
                                    <input type="text" class="form-control" placeholder="only month and year" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Alasan Berhenti</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Perusahaan</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Posisi/Jabatan</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Mulai Kerja</label>
                                    <input type="text" class="form-control" placeholder="only month and year" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Akhir Kerja</label>
                                    <input type="text" class="form-control" placeholder="only month and year" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Alasan Berhenti</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Perusahaan</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Posisi/Jabatan</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Mulai Kerja</label>
                                    <input type="text" class="form-control" placeholder="only month and year" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Akhir Kerja</label>
                                    <input type="text" class="form-control" placeholder="only month and year" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Alasan Berhenti</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </form>
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
                    <form>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control">
                                        <option>Laki-laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Tempat/Tanggal Lahir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h6">Ayah Kandung</h4>
                        </div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control">
                                        <option>Laki-laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Tempat/Tanggal Lahir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="pd-20 card-box mb-20">
                    {{-- hr --}}
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h6">Ibu Mertua</h4>
                        </div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control">
                                        <option>Laki-laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Tempat/Tanggal Lahir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h6">Ayah Mertua</h4>
                        </div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control">
                                        <option>Laki-laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Tempat/Tanggal Lahir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h6">Istri/Suami</h4>
                        </div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control">
                                        <option>Laki-laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Tempat/Tanggal Lahir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h6">Anak ke- 1</h4>
                        </div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control">
                                        <option>Laki-laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Tempat/Tanggal Lahir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h6">Anak ke 2</h4>
                        </div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control">
                                        <option>Laki-laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Tempat/Tanggal Lahir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h6">Anak ke 3</h4>
                        </div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control">
                                        <option>Laki-laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Tempat/Tanggal Lahir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </form>
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
                <form>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Penyakit/Kecelakaan/Gejala</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-12">
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>RS/Puskesmas</label>
                                <input type="text" class="form-control" placeholder="only month and year" />
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <label>Lama (Bulan)</label>
                                <input type="text" class="form-control" placeholder="only month and year" />
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-12">
                            <div class="form-group">
                                <label>Sembuh</label>
                                <select class="form-control">
                                    <option>Ya</option>
                                    <option>Belum</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
            <!-- Riwayat Kesehatan Karyawan End -->

            <!-- Pekerjaan Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Pekerjaan Karyawan</h4>
                    </div>
                </div>
                <form>
                    <div class="row">
                        <div class="col-2">

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Departement</label>
                                <select class="form-control">
                                    <option>IT</option>
                                    <option>WNA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <select class="form-control">
                                    <option>ETL Developer</option>
                                    <option>WNA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
                </form>
            </div>
            <!-- Pekerjaan end -->
            <!-- Riwayat Kesehatan Karyawan -->
            <div class="pd-20 card-box mb-20">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Salary Karyawan</h4>
                    </div>
                </div>
                <form>
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Gaji Pokok</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Insentif</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Premi BK</label>
                                <input type="text" class="form-control" placeholder="only month and year" />
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Premi NBK</label>
                                <input type="text" class="form-control" placeholder="only month and year" />
                            </div>
                        </div>
                        {{-- --}}
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Kayu</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>MB</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>RJ</label>
                                <input type="text" class="form-control" placeholder="only month and year" />
                            </div>
                        </div>

                    </div>
                </form>

            </div>
            <!-- Riwayat Kesehatan Karyawan End -->

        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
</div>
@endsection


@section('js')
<script>
    $(function() {
        $('#myTablse').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('people-data') !!}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'NIK', name: 'NIK' },
                { data: 'address', name: 'address' },
                { data: 'phone_number', name: 'phone_number' }
            ]
        });
    });
</script>
@endsection