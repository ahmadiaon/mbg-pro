@extends('template.admin.main_privilege')

@section('content')
    <div id="create-up" class="children-content">
        <form action="/recruitment/up" id="form-up" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="min-height-200px">
                <div class="pd-20 card-box mb-20">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Validasi Data</h4>
                        </div>
                    </div>
                    

                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-30">
                                <div class="form-group">
                                    <label>No KK</label>
                                    <input name="kk_number" class="form-control" value="" id="kk_number"
                                        placeholder="6231234" type="text">
                                </div>
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input name="nik_number" class="form-control" value="" id="nik_number"
                                        placeholder="62000" type="text">
                                </div>
                                <div class="form-group">
                                    <button type="button" onclick="storeUp('up')" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection

@section('js')
    <script>

        let rec = @json(session('recruitment-user-detail'));
        
        if(rec){
            $('#kk_number').val(rec.kk_number);
            $('#nik_number').val(rec.nik_number);
        }

        function storeUp(idForm) {
            if (isRequiredCreate(['nik_number', 'kk_number']) > 0) {
                return false;
            }

            globalStoreNoTable(idForm).then((data) => {           
                user_data = data.data;
                cg('user-data', user_data);
                // return false;
                if(user_data['user-role'] == 'employee'){
                    goToHere('/login')
                }else{
                    goToHere('/recruitment/me/detail')
                }
                
                stopLoading();
            })

        }
    </script>
@endsection
