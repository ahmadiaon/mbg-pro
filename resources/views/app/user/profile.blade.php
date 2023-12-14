@extends('app.layouts.main')

@section('content')
<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
        <div class="pd-5 card-box ">
            <div class="profile-photo">
                <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i
                        class="fa fa-pencil"></i></a>
                <img src="/vendors/images/photo4.jpg" alt="" class="avatar-photo" />
                <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                    aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body pd-5">
                                <div class="img-container">
                                    <img id="image" src="/vendors/images/photo4.jpg" alt="Picture" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" value="Update" class="btn btn-primary" />
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="text-center h5 mb-0" id="index-employee-name">
                <text class="index-employee-name"></text>
            </h5>
            <p class="text-center text-muted font-14">
                <b id="index-employee-nik_employee"><text class="index-employee-nik_employee"></text></b>
            </p>
            <div class="profile-info">
                <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                <ul>
                    <li>
                        <span>Jabatan:</span>
                        <text class="index-employee-position">udin</text>
                    </li>
                    <li>
                        <span>Departemen:</span>
                        <text class="index-employee-department">udin</text>
                    </li>
                    <li>
                        <span>Phone Number:</span>
                        <text class="index-employee-phone_number">tidak ada</text>
                    </li>
                    <li>
                        <span>Kewarganegaraan:</span>
                        <text class="index-employee-citizenship">tidak ada</text>
                    </li>
                    <li>
                        <span>Address:</span>
                        <text class="index-employee-kabupaten">tidak ada</text> <br>
                        <text class="index-employee-desa">tidak ada</text>
                        {{-- {{ !empty($data->desa) ? $data->desa : 'belum ada' }}<br />
                        {{ !empty($data->kabupaten) ? $data->kabupaten : 'belum ada' }} --}}
                    </li>
                </ul>
            </div>
            
          
        </div>
    </div>

    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
        <div class=" height-100-p overflow-hidden">
            <div class="faq-wrap">
                <h4 class="mb-20 h4 text-blue">Detail Lainnya</h4>
                <div id="accordion">
                    
                    
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-block collapsed " data-toggle="collapse"
                                data-target="#faq2">
                                IDENTITAS DIRI
                            </button>
                        </div>
                        <div id="faq2" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <div class="profile-detail">
                                    <div class="profile-info">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Nama Lengkap:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <b class="index-employee-name">tidak ada</b>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Nomor KK/NIK:</span>
                                                    </div>

                                                    <div class="col text-right">
                                                        <b class="index-employee-kk_number">tidak
                                                            ada</b>/<b
                                                            class="index-employee-nik_number">tidak
                                                            ada</b>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Gender:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <b class="index-employee-gender">tidak ada</b>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Agama:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <b class="index-employee-religion">tidak ada</b>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Tempat Lahir:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <b class="index-employee-place_of_birth">tidak
                                                            ada</b>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Tanggal Lahir:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <b class="index-employee-date_of_birth">tidak
                                                            ada</b>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Golongan Darah:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <b class="index-employee-blood_group">tidak
                                                            ada</b>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Status:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <b class="index-employee-status">tidak ada</b>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Nomor Telepon:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <b class="index-employee-phone_number">tidak
                                                            ada</b>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    {{-- npwp --}}
                                    <div class="profile-info">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>NPWP:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <b class="index-employee-npwp_number">tidak ada</b>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Rekening BNI:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <b class="index-employee-financial_number">tidak
                                                            ada</b>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>BPJS Ketenagakerjaan:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <b class="index-employee-bpjs_ketenagakerjaan">tidak
                                                            ada</b>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>BPJS Kesehatan:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <b class="index-employee-bpjs_kesehatan">tidak
                                                            ada</b>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="profile-info">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-12">
                                                <h4>Alamat</h4>
                                            </div>
                                        </div>

                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Desa/Jalan:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text class="index-employee-desa">tidak ada</text>
                                                    </div>
                                                    <div class="col-auto">
                                                    </div>
                                                    <div class="col-auto">
                                                        <span>RT/RW:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text class="index-employee-rt">tidak ada</text>
                                                        /<text class="index-employee-rw">tidak ada</text>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Kecamatan:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text class="index-employee-kecamatan">tidak
                                                            ada</text>
                                                    </div>
                                                    <div class="col-auto">
                                                        <span>Kabupaten:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text class="index-employee-kabupaten">tidak
                                                            ada</text>
                                                    </div>
                                                </div>

                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Provinsi:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text class="index-employee-provinsi">tidak
                                                            ada</text>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-block collapsed" data-toggle="collapse"
                                data-target="#faq3">
                                IDENTITAS KARYAWAN
                            </button>
                        </div>
                        <div id="faq3" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <div class="profile-detail">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-12">
                                            <h5>Detail Karyawan</h5>
                                        </div>
                                        {{-- <div class="col-md-4 col-sm-12 text-right">
                                            <a href="/user-employee/detail/{{ session('dataUser')->nik_employee }}/edit"
                                                class="bg-light-blue btn text-blue weight-500 index-employee-create-employee">
                                                <i class="ion-plus-round"></i>Edit
                                            </a>
                                        </div> --}}
                                    </div>
                                    <div class="profile-info">
                                        <h5 class="h5 text-blue">Detail Karyawan</h5>
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>NIK Karyawan:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text class="index-employee-nik_employee">tidak
                                                            ada</text>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Departement:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text class="index-employee-department">tidak
                                                            ada</text>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Posisi:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text class="index-employee-position">tidak
                                                            ada</text>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="profile-info">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Nomor Kontrak:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text
                                                            class="index-employee-contract_number_full">tidak
                                                            ada</text>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Status Kontrak:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text class="index-employee-contract_status">tidak
                                                            ada</text>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Lama Kontrak:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text class="index-employee-long_contract">tidak
                                                            ada</text>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Tanggal Mulai Kontrak:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text
                                                            class="index-employee-date_start_contract">tidak
                                                            ada</text>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Tanggal Berakhir Kontrak:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text
                                                            class="index-employee-date_end_contract">tidak
                                                            ada</text>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Awal Masuk Kerja:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text
                                                            class="index-employee-date_document_contract">tidak
                                                            ada</text>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Status Karyawan:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text class="index-employee-employee_status">tidak
                                                            ada</text>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Roaster:</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <text class="index-employee-roaster_uuid">tidak
                                                            ada</text>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection()

@section('script_javascript')
    <script>
        console.log(localStorage.getItem('ui_dataset'));
        console.log(@json(session('user_authentication')))
        let user_authentication = @json(session('user_authentication'));
        
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
                url: '/api/mbg/employee',
                type: "POST",
                data: {
                    _token: _token,
                    token: user_authentication['auth_login'],
                },
                success: function(response) {
                    conLog('response', response);
                    let dataShow = response.data
                    for (var key in dataShow) {
                        if (dataShow[key] != null) {
                            $('.index-employee-' + key).text(dataShow[key])
                        } else {
                            $('.index-employee-' + key + '-hide').hide()
                        }
                    }
                },
                error: function(response) {
                    conLog('response', response)
                }
            });
    </script>
@endsection()
