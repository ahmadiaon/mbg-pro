{{-- loading modal --}}


<div class="modal fade" id="loading-modal"   role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <br>
            <br>
            <div class="modal-body text-center">
                <div class="spinner-grow text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-secondary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-success" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-danger" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-warning" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-info" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-light" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-dark" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <br>
            <br>
        </div>
    </div>
</div>
{{-- success modal --}}
<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h3 class="mb-20">Data Tersimpan</h3>
                <div class="mb-30 text-center">
                    <img src="{{ env('APP_URL') }}vendors/images/success.png" />
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" onclick="stopLoading()" data-dismiss="modal">
                    Done
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="success-modal-id" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h3 class="mb-20">Data Tersimpan</h3>
                <div class="mb-30 text-center">
                    <img src="{{ env('APP_URL') }}vendors/images/success.png" />
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" id="btn-success-modal-id" class="btn btn-primary" data-dismiss="modal">
                    Done
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="message-modal-id" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h3 class="mb-20 blue-text">Pesan:</h3>
                <p id="message-text">ini pemberitaannya</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" id="btn-message-modal-id" onclick="stopLoading()" class="btn btn-primary"  data-dismiss="modal">
                    ok
                </button>
            </div>
        </div>
    </div>
</div>
{{-- modal confirm delete --}}
<div id="confirm-modalv" class="modal fade">
    <div class="modal-dialog  modal-sm modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="icon-copy ion-android-delete"></i>
                </div>
                
                <h4 class="modal-title w-100">Hapus Data?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin Untuk Mengahapus data ini?</p>
            </div>
            <div class="modal-footer justify-content-center row">
                <button type="button" class="col btn btn-secondary" data-dismiss="modal">Batal</button>
                <button onclick="deleteConfirmed()" type="button" class="col btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<div id="confirm-modal-async" class="modal fade">
    <div class="modal-dialog  modal-sm modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="icon-copy ion-android-delete"></i>
                </div>
                <input type="hidden" name="code_data_delete" id="code_data_delete" >
                <h4 class="modal-title w-100">Hapus Data?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin Untuk Mengahapus data ini?</p>
            </div>
            <div class="modal-footer justify-content-center row">
                <button type="button" class="col btn btn-secondary" data-dismiss="modal">Batal</button>
                <button onclick="deleteThisData()" type="button" class="col btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

{{-- modal confirm delete --}}
<div id="confirm-modal-delete" class="modal fade">
    <div class="modal-dialog  modal-sm modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="icon-copy ion-android-delete"></i>
                </div>
                
                <h4 class="modal-title w-100">Hapus Data?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p><b id="message-delete-confirm"></b></p>
                <input type="text" name="uuid-delete-confirm" id="uuid-delete-confirm">
                <input type="text" name="url-delete-confirm" id="url-delete-confirm">
            </div>
            <div class="modal-footer justify-content-center row">
                <button type="button" class="col btn btn-secondary" data-dismiss="modal">Batal</button>
                <button onclick="deleteDataConfirmed()" type="button" class="col btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body text-center font-18">
                    
                    <h4 class="padding-top-30 mb-30 weight-500">
                        <input type="hidden" id="uuid_delete" name="uuid_delete">
                        <input type="hidden" id="url_delete" name="url_delete">
                        <input type="hidden" id="table_reload" name="table_reload">
                        Are you sure you want to continue?
                    </h4>
                    
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto">
                        <div class="col-6">
                            <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal">
                                <i class="fa fa-times"></i>
                            </button>
                            NO
                        </div>
                        <div class="col-6">
                            <button  onclick="deleteConfirmed()"  type="button" class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal">
                                <i class="fa fa-check"></i>
                            </button>
                            YES
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



{{-- alert modal --}}
<div class="modal fade" id="alert-modal" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content bg-danger text-white">
            <div class="modal-body text-center">
                <h3 class="text-white mb-15">
                    <i class="fa fa-exclamation-triangle"></i> Error !!
                </h3>
                <p>
                    Error data tidak tersimpan
                </p>
                <button type="button" onclick="stopLoading()" class="btn btn-light" data-dismiss="modal">
                    Ok
                </button>
            </div>
        </div>
    </div>
</div>

{{-- modal add create payment-group --}}
<div class="modal fade" id="modal-create-payment-group"   role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/database/payment-group/store" id="form-payment-group" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="uuid" id="uuid">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Payment-group
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="payment_group" id="payment_group" class="form-control">
                        <div class="invalid-feedback" id="req-payment_group">
                            Data tidak boleh kosong
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <div class="row justify-content-md-center">
                            <div class="col-12 text-center mb-5">
                                <h4 class="mb-5">Data Status</h4>
                            </div>
                            <div class="col-auto">
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio"  id="Aktif" checked name="status_data"
                                        class="custom-control-input" value="Aktif"  />
                                    <label class="custom-control-label" for="Aktif"  >Aktif</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio"  id="Non-Aktif" name="status_data"
                                        class="custom-control-input" value="Non Aktif"  />
                                    <label class="custom-control-label" for="Non-Aktif"  >Non Aktif</label>
                                </div>
                            </div>
                          </div>
                    </div> --}}
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" onclick="storeWithValidate('payment-group')" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
