@extends('template.admin.main_privilege')
@section('content')
    <!-- Simple Datatable start -->
    <div class="card-box  mb-30">
        <form action="/payment/store" id="form-payment" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="uuid" id="uuid">
            <div class="pd-20">
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="text-blue h4">Tambah Pembayaran</h4>
                    </div>
                    <div class="col-md-8">
                        <div class="button-group text-right">
                            <button type="button" onclick="resetData()" class="btn btn-secondary">Reset</button>
                            <button type="button" onclick="storePayment('payment')" class="btn btn-primary">
                                Simpan
                                <div class="spinner-border" id="loading" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pd-20">
                {{-- diteruskan --}}
                <div class="row timbangan">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="employee_create_uuid">Dibuat Oleh</label>
                            <select name="employee_create_uuid" id="employee_create_uuid"
                                class="custom-select2 form-control">
                                <option value="">karyawan</option>
                            </select>
                            <div class="invalid-feedback" id="req-employee_create_uuid">
                                Data tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="employee_know_uuid">Diketahui Oleh</label>
                            <select name="employee_know_uuid" id="employee_know_uuid" class="custom-select2 form-control">
                                <option value="">karyawan</option>
                            </select>
                            <div class="invalid-feedback" id="req-employee_know_uuid">
                                Data tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="employee_approve_uuid">Disetujui Oleh</label>
                            <select name="employee_approve_uuid" id="employee_approve_uuid"
                                class="custom-select2 form-control">
                                <option value="">karyawan</option>
                            </select>
                            <div class="invalid-feedback" id="req-employee_approve_uuid">
                                Data tidak boleh kosong
                            </div>
                        </div>
                    </div>
                </div>
                {{-- pembayaran keterangan --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-4 col-form-label">Jenis Pembayaran</label>
                            <div class="col-sm-12 col-md-6">
                                <select name="payment_group_uuid" id="payment_group_uuid" class="custom-select2 form-control">
                                    @foreach ($payment_groups as $item)
                                        <option value="{{ $item->uuid}}">{{ $item->payment_group}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <button onclick="modalCreateGlobal('payment-group')" id="create-payment-group" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);">
                                    <i class="icon-copy ion-android-add"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-4 col-form-label">Tanggal</label>
                            <div class="col-sm-12 col-md-8 ">
                                <input class="form-control" type="date" id="date" onchange="setDate()" name="date" placeholder="Johnny Brown" />
                                <div class="invalid-feedback" id="req-date">
                                    Data tidak boleh kosong
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-auto">Lebih dari sehari ? </label>
                                    <div class="col-auto">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="custom-control-input" id="moreThanOneDays">
                                            <label class="custom-control-label" for="moreThanOneDays">Ya</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row moreThanOneDays">
                                    <label class="col-4">Lama </label>
                                    <div class="col-8">
                                        <input onkeyup="setDate()" class="form-control" id="long" name="long" type="text" value="1" />
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row moreThanOneDays">
                            <label class="col-sm-12 col-md-4 col-form-label">Tanggal berakhir</label>
                            <div class="col-sm-12 col-md-8 ">
                                <input onchange="func()" class="form-control" type="date" id="date_end" name="date_end" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="">Keterangan</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                            <div class="invalid-feedback" id="req-description">
                                Data tidak boleh kosong
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <!-- employee payment -->
    <div class="card-box  mb-30">
        <input type="text" name="" id="last_link_absen" value="">
        <div class="pd-20" >
            <div id="employee">
                
                <form method="POST" enctype="multipart/form-data"  enctype="" action="/employee-payment/store" id="form-employee-payment-1" >
                    @csrf
                    <input type="text" name="uuid" id="uuid-1">
                    <div class="row justify-content-md-center" >
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="employee_uuid">Pilih Karyawan</label>
                                <select name="employee_uuid" id="employee_uuid-1" class="custom-select2 form-control">
                                    <option value="">Tambah Pembayaran Terlebih Dahulu</option>
                                </select>
                                <div class="invalid-feedback" id="req-employee_uuid-1">
                                    Data tidak boleh kosong
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date">Value</label>
                                <input type="text" name="value" id="value-1" value=""
                                    class="form-control">
                                <div class="invalid-feedback" id="req-value-1">
                                    Data tidak boleh kosong
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row justify-content-md-center">
                                <div class="col-md-12">
                                    <label class="weight-600 mb-20">Link Absen</label>
                                    <div class="row justify-content-md-center">
                                        
                                        <div class="col-4">
                                            <div class="custom-control custom-radio">
                                                <input  type="radio"  id="DS-1" name="link_absen"
                                                    class="custom-control-input" value="DS"  />
                                                <label class="custom-control-label" for="DS-1"  >DS</label>
                                            
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="custom-control custom-radio">
                                                <input  type="radio"  id="DL-1" name="link_absen"
                                                class="custom-control-input" value="DL"  />
                                                <label class="custom-control-label" for="DL-1"  >DL</label>
                                            
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="custom-control custom-radio">
                                                <input checked type="radio"  id="none-1" name="link_absen"
                                                    class="custom-control-input" value="none"  />
                                                <label class="custom-control-label" for="none-1"  >none</label>
                                            </div>
                                        </div>
                                                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-2 text-center">
                            <label for="date">Action</label>
                            <div class="btn-list text-right">
                                <button onclick="storeEmployeePayment(1)" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);">
                                    <i class="icon-copy fa fa-save" aria-hidden="true"></i>
                                </button>
                                <button onclick="deleteEmployee(1)" type="button" class="btn" data-bgcolor="#c32361" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(223, 8, 8);">
                                    <i class="icon-copy ion-trash-b"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="row justify-content-end">
                <div class="col-auto">
                    <div class="btn-list text-right">
                        <button onclick="duplicateNewEmployee(1)" id="button-duplicate" class="btn btn-success">Duplicate</button>
                        <button onclick="addNewEmployee(1)" id="button-new" class="btn btn-info">Baru</button>
                    </div>
                </div>
            </div>
                
        </div>
    </div>
@endsection
@section('js')
    <script>
        getFirst();
        $('.moreThanOneDays').hide();
        $('#moreThanOneDays').click(function(){
            if($(this).is(":checked")){
                console.log("Checkbox is checked.");
                $('.moreThanOneDays').show();
                if(!payment){
                    $('#long').val('');
                }
            }
            else if($(this).is(":not(:checked)")){
                $('.moreThanOneDays').hide();
                $('#long').val('1');
                setDate();
            }
        });
        let payment = @json($payment);
        if(payment){
            console.log(payment);
            $('#date').val(payment.date);
            $('#description').val(payment.description);
            $('#uuid').val(payment.uuid);
            $('#payment_group_uuid').val(payment.payment_group_uuid).trigger('change');
            $('#employee_approve_uuid').val(payment.employee_approve_uuid).trigger('change');
            $('#employee_create_uuid').val(payment.employee_create_uuid).trigger('change');
            $('#employee_know_uuid').val(payment.employee_know_uuid).trigger('change');
            if(payment.long > 1){
                $('.moreThanOneDays').show();
                $('#date_end').val(payment.date_end);
                $('#long').val(payment.long);
                $('#moreThanOneDays').attr('checked',true);

            }else{
                $('#date_end').val(payment.date_end);
                $('#long').val(payment.long);
            }
        }else{
            console.log('create');
            
        }
        
        let employee_payments = @json($employee_payments);
        if(employee_payments){
            console.log(employee_payments);
            $('#employee').empty();
            let i = 1;
            employee_payments.forEach(element => {
                let elmnt = `
                    <form method="POST" enctype="multipart/form-data"  enctype="" action="/employee-payment/store" id="form-employee-payment-${i}" >
                        @csrf
                        <input type="text" name="uuid" id="uuid-${i}" value="${element.uuid}">
                        <div class="row justify-content-md-center" >
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee_uuid">Pilih Karyawan</label>
                                    <select name="employee_uuid" id="employee_uuid-${i}" class="custom-select2 form-control">
                                        <option value="">Tambah Pembayaran Terlebih Dahulu</option>
                                    </select>
                                    <div class="invalid-feedback" id="req-employee_uuid-${i}">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date">Value</label>
                                    <input type="text" name="value" id="value-${i}" value="${element.value}"
                                        class="form-control">
                                    <div class="invalid-feedback" id="req-value-${i}">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                        <label class="weight-600 mb-20">Link Absen</label>
                                        <div class="row justify-content-md-center">
                                            
                                            <div class="col-4">
                                                <div class="custom-control custom-radio">
                                                    <input ${element.link_absen =='DS'? 'checked':''} type="radio"  id="DS-${i}" name="link_absen"
                                                        class="custom-control-input" value="DS"  />
                                                    <label class="custom-control-label" for="DS-${i}"  >DS</label>
                                                
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="custom-control custom-radio">
                                                    <input ${element.link_absen =='DL'? 'checked':''}  type="radio"  id="DL-${i}" name="link_absen"
                                                    class="custom-control-input" value="DL"  />
                                                    <label class="custom-control-label" for="DL-${i}"  >DL</label>
                                                
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="custom-control custom-radio">
                                                    <input ${element.link_absen =='none'? 'checked':''}  type="radio"  id="none-${i}" name="link_absen"
                                                        class="custom-control-input" value="none"  />
                                                    <label class="custom-control-label" for="none-${i}"  >none</label>
                                                </div>
                                            </div>
                                                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-2 text-center">
                                <label for="date">Action</label>
                                <div class="btn-list text-right">
                                    <button onclick="storeEmployeePayment(${i})" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);">
                                        <i class="icon-copy fa fa-save" aria-hidden="true"></i>
                                    </button>
                                    <button onclick="deleteEmployee(${i})" type="button" class="btn" data-bgcolor="#c32361" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(223, 8, 8);">
                                        <i class="icon-copy ion-trash-b"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    `;
                    $('#employee').append(elmnt);
                    $('#employee_uuid-'+i).empty();
                    
                    let employees = @json($employees);
                            employees.forEach(people => {
                                $('#employee_uuid-'+i).append(
                                    `<option value="${people.uuid}">${people.name} - ${people.position}</option>`
                                )
                            });
                    
                    $('#employee_uuid-'+i).val(element.employee_uuid).trigger('change');
                    $('#button-new').attr('onclick', "addNewEmployee("+i+")");
                    $('#button-duplicate').attr('onclick', "duplicateNewEmployee("+i+")");
                    i++;
                   
            });
        }else{
            console.log('create');

        }
        

        
        function deleteEmployee(id){
            let _url = '/employee-payment/delete'
            let uuid = $('#uuid-'+id).val()
            if(uuid == ''){
                $('#form-employee-payment-'+id).remove();
            }else{
                console.log(uuid);
                $('#confirm-modal').modal('show')
                $('#uuid_delete').val(uuid)
                $('#url_delete').val(_url)
                $('#table_reload').val(id)
            }
        }
        function func() {
            date1 = new Date($('#date').val());
            date2 = new Date($("#date_end").val());
            var milli_secs = date2.getTime() - date1.getTime() ;
             
            // Convert the milli seconds to Days 
            var days = milli_secs / (1000 * 3600 * 24);
            $('#long').val(days);
        }

        function setDate(){
            let date = $('#date').val();
            let long = $('#long').val();
            if(long == null){
                return false;
            }else{
                var someDate = new Date(date);
                console.log('date start :'+ date)
                console.log('long :'+long)
                
                someDate.setDate(someDate.getDate() + parseInt(long)-1);
                let month_s =someDate.getMonth()+1;
                let day_s =someDate.getDate();
                let full_month ='00' +month_s;
                let full_day ='00' +day_s;
                let date_suggest = someDate.getFullYear()+'-'+full_month.substr(-2)+'-'+full_day.substr(-2);
                console.log('date_suggest :'+date_suggest)
                $("#date_end").val(date_suggest);    

            }
            console.log(date)
        }

        function duplicateNewEmployee(id){
            

            let link_absen = $('#last_link_absen').val()
            let value_before = $('#value-'+id).val();
            console.log(value_before);

            let new_val =   parseInt(id)+1;
            $('#button-new').attr('onclick', "addNewEmployee("+new_val+")");
            $('#button-duplicate').attr('onclick', "duplicateNewEmployee("+new_val+")");
            let elmnt = `
            <form method="POST" enctype="multipart/form-data"  enctype="" action="/employee-payment/store" id="form-employee-payment-${new_val}" >
                @csrf
                <input type="text" name="uuid" id="uuid-${new_val}">
                <div class="row justify-content-md-center" >
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="employee_uuid">Pilih Karyawan</label>
                            <select name="employee_uuid" id="employee_uuid-${new_val}" class="custom-select2 form-control">
                                <option value="">Tambah Pembayaran Terlebih Dahulu</option>
                            </select>
                            <div class="invalid-feedback" id="req-employee_uuid-${new_val}">
                                Data tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="date">Value</label>
                            <input type="text" name="value" id="value-${new_val}" value="${value_before}"
                                class="form-control">
                            <div class="invalid-feedback" id="req-value-${new_val}">
                                Data tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <label class="weight-600 mb-20">Link Absen</label>
                                <div class="row justify-content-md-center">
                                    
                                    <div class="col-4">
                                        <div class="custom-control custom-radio">
                                            <input  ${link_absen=='DS'? 'checked':''} type="radio"  id="DS-${new_val}" name="link_absen"
                                                class="custom-control-input" value="DS"  />
                                            <label class="custom-control-label" for="DS-${new_val}"  >DS</label>
                                        
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="custom-control custom-radio">
                                            <input ${link_absen=='DL'? 'checked':''} type="radio"  id="DL-${new_val}" name="link_absen"
                                            class="custom-control-input" value="DL"  />
                                            <label class="custom-control-label" for="DL-${new_val}"  >DL</label>
                                        
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="custom-control custom-radio">
                                            <input ${link_absen=='none'? 'checked':''} type="radio"  id="none-${new_val}" name="link_absen"
                                                class="custom-control-input" value="none"  />
                                            <label class="custom-control-label" for="none-${new_val}"  >none</label>
                                        </div>
                                    </div>
                                                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-2 text-center">
                        <label for="date">Action</label>
                        <div class="btn-list text-right">
                            <button onclick="storeEmployeePayment(${new_val})" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);">
                                <i class="icon-copy fa fa-save" aria-hidden="true"></i>
                            </button>
                            <button onclick="deleteEmployee(${new_val})" type="button" class="btn" data-bgcolor="#c32361" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(223, 8, 8);">
                                <i class="icon-copy ion-trash-b"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            `;

            
            console.log();
            $('#employee').append(elmnt);
            $('#employee_uuid-'+new_val).select2();
            $('#employee_uuid-'+new_val).empty();
            let employees = @json($employees);
                    employees.forEach(element => {
                        $('#employee_uuid-'+new_val).append(
                            `<option value="${element.uuid}">${element.name} - ${element.position}</option>`
                        )
                    });
        }
     
        function addNewEmployee(id){
            console.log(id);
            let new_val =   parseInt(id)+1;

            $('#button-new').attr('onclick', "addNewEmployee("+new_val+")");
            let elmnt = `
            <form method="POST" enctype="multipart/form-data"  enctype="" action="/employee-payment/store" id="form-employee-payment-${new_val}" >
                @csrf
                <input type="text" name="uuid" id="uuid-${new_val}">
                <div class="row justify-content-md-center" >
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="employee_uuid">Pilih Karyawan</label>
                            <select name="employee_uuid" id="employee_uuid-${new_val}" class="custom-select2 form-control">
                                <option value="">Tambah Pembayaran Terlebih Dahulu</option>
                            </select>
                            <div class="invalid-feedback" id="req-employee_uuid-${new_val}">
                                Data tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="date">Value</label>
                            <input type="text" name="value" id="value-${new_val}" value=""
                                class="form-control">
                            <div class="invalid-feedback" id="req-value-${new_val}">
                                Data tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <label class="weight-600 mb-20">Link Absen</label>
                                <div class="row justify-content-md-center">
                                    
                                    <div class="col-4">
                                        <div class="custom-control custom-radio">
                                            <input  type="radio"  id="DS-${new_val}" name="link_absen"
                                                class="custom-control-input" value="DS"  />
                                            <label class="custom-control-label" for="DS-${new_val}"  >DS</label>
                                        
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="custom-control custom-radio">
                                            <input  type="radio"  id="DL-${new_val}" name="link_absen"
                                            class="custom-control-input" value="DL"  />
                                            <label class="custom-control-label" for="DL-${new_val}"  >DL</label>
                                        
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="custom-control custom-radio">
                                            <input checked type="radio"  id="none-${new_val}" name="link_absen"
                                                class="custom-control-input" value="none"  />
                                            <label class="custom-control-label" for="none-${new_val}"  >none</label>
                                        </div>
                                    </div>
                                                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-2 text-center">
                        <label for="date">Action</label>
                        <div class="btn-list text-right">
                            <button onclick="storeEmployeePayment(${new_val})" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);">
                                <i class="icon-copy fa fa-save" aria-hidden="true"></i>
                            </button>
                            <button onclick="deleteEmployee(${new_val})" type="button" class="btn" data-bgcolor="#c32361" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(223, 8, 8);">
                                <i class="icon-copy ion-trash-b"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            `;

            
            $('#button-duplicate').attr('onclick', "duplicateNewEmployee("+new_val+")");
            console.log();
            $('#employee').append(elmnt);
            $('#employee_uuid-'+new_val).select2();
            $('#employee_uuid-'+new_val).empty();
            let employees = @json($employees);
                    employees.forEach(element => {
                        $('#employee_uuid-'+new_val).append(
                            `<option value="${element.uuid}">${element.name} - ${element.position}</option>`
                        )
                    });
        }

        function storePayment(idForm){
			let _url = $('#form-'+idForm).attr('action');
            var form = $('#form-'+idForm)[0];
            var form_data = new FormData(form);
			var err = 0;

			// validated
			for(let [name, value] of form_data) {
				
				console.log('name  : '+name+' value  : '+value);
				if(name != 'uuid' && name != 'employee_approve_uuid' && name != 'employee_create_uuid'&& name != 'employee_know_uuid'){
					if ($('#'+name).val() == "") {
						$('#req-'+name).show();
						err++
					}else{
						$('#req-'+name).hide()
					}
				}
			}
			
			if(err > 0){
                console.log('have err  : ');
				return false;
			}

            // return false;

			startLoading();
            $.ajax({
                url: _url,
                type: "POST",
                contentType: false,
                processData: false,
                data: form_data,
                success: function(response) {
                    $('#success-modal').modal('show')
                    $('#uuid').val(response.data.uuid);
					console.log(response);	 
                    $('#employee_uuid-1').empty();
                    let employees = @json($employees);
                    employees.forEach(element => {
                        $('#employee_uuid-1').append(
                            `<option value="${element.uuid}">${element.name} - ${element.position}</option>`
                        )
                    });
                },
                error: function(response) {
                    alertModal()					
				}
            });
		}

        function storeEmployeePayment(idForm){
            console.log('id : ' + idForm);
            let payment_uuid = $('#uuid').val();

			let _url = $('#form-employee-payment-'+idForm).attr('action');
            console.log('id : ' + _url);
            var form = $('#form-employee-payment-'+idForm)[0];
            var form_data = new FormData(form);
            form_data.append('payment_uuid', payment_uuid);
			var err = 0;
            let link_absen='';
           

			// validated
			for(let [name, value] of form_data) {
				
				console.log('name  : '+name+' value  : '+value);
				if(name != 'uuid'){
					if ($('#'+name+'-'+idForm).val() == "") {
						$('#req-'+name+'-'+idForm).show();
						err++
					}else{
						$('#req-'+name+'-'+idForm).hide()
					}
				}
                if(name == 'link_absen'){
                    link_absen = value;
                }
			}
			
			if(err > 0){
                console.log('have err  : ');
				return false;
			}

            $('#last_link_absen').val(link_absen);

			startLoading();
            $.ajax({
                url: _url,
                type: "POST",
                contentType: false,
                processData: false,
                data: form_data,
                success: function(response) {
                    $('#success-modal').modal('show')
                    $('#uuid-'+idForm).val(response.data.uuid);
					console.log(response)	 
                },
                error: function(response) {
                    alertModal()					
				}
            });
		}



      

        function showDataTableUserPrivilege(url, dataTable, id) {
            let data = [];
            var elements = {
                mRender: function(data, type, row) {
                    // console.log('aaa')
                    // console.log(row)					
                    return `${row.name} <small>${row.position}</small>`
                }
            };
            data.push(elements)
            dataTable.forEach(element => {
                var dataElement = {
                    data: element,
                    name: element
                }
                data.push(dataElement)
            });

            var elements = {
                mRender: function(data, type, row) {

                    return `
                                <div class="form-inline"> 
                                    <button onclick="editHm('` + row.uuid + `')" type="button" class="btn btn-secondary">
                                        <i class="dw dw-edit2"></i>
                                    </button>
                                </div>`
                }
            };
            data.push(elements)

            let urls = '{{ env('APP_URL') }}' + url
            console.log(urls)
            $('#' + id).DataTable({
                order: [
                    ['5', 'desc']
                ],
                columnDefs: [{
                    "visible": false,
                    "targets": 5
                }],
                processing: true,
                serverSide: true,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: urls,
                columns: data
            });
        }

      
        showDataTableUserPrivilege('payment/data', ['date', 'payment_value', 'payment_full_value', 'hauling_price',
            'updated_at'
        ], 'table-payment')

        $('#loading').hide();




        function getFirst() {
            var employees = @json($employees);
            employees.forEach(element => {
                var elements = `<option value="${element.uuid}">${element.name} - ${element.position}</option>`;
                // console.log(element);
                $('#employee_uuid').append(elements);
                $('#employee_create_uuid').append(elements);
                $('#employee_know_uuid').append(elements);
                $('#employee_approve_uuid').append(elements);
            });
            // console.log(employees)
        }

        function updatehour_meter_price_uuid(uuid) {
            $('#hour_meter_price_uuid').val(uuid);

        }

        function editHm(uuid) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let _url = "/payment/edit";



            $('#loading').show();

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    uuid: uuid,
                    _token: _token
                },
                success: function(response) {
                    data = response.data
                    console.log('data')
                    console.log(data)
                    $('#employee_uuid').val(data.employee_uuid).trigger('change');
                    $('#uuid').val(data.uuid).trigger('change');
                    $('#employee_create_uuid').val(data.employee_create_uuid).trigger('change');
                    $('#employee_know_uuid').val(data.employee_know_uuid).trigger('change');
                    $('#employee_approve_uuid').val(data.employee_approve_uuid).trigger('change');
                    $('#full_value').val(data.full_value).trigger('change');
                    $('#' + data.hour_meter_price_uuid).attr('checked', true);
                    $('#' + data.shift).attr('checked', true);
                    $('.btn-outline-primary').attr('class', ' btn btn-outline-primary');
                    $('#lbl-' + data.shift).attr('class', ' btn btn-outline-primary active');
                    $('#value').val(data.value).trigger('change');
                    $('#loading').hide();

                },

                error: function(response) {
                    console.log(response)
                }
            });
        }

        function fullValue() {
            let isBonusAktive = $('#isBonusAktive')[0].checked
            let full_value
            if (isBonusAktive == true) {
                let value_hm = parseInt($('#value').val())
                if (value_hm >= 10) {
                    full_value = value_hm * 0.15
                    full_value = full_value + value_hm
                }
                if (value_hm >= 14) {
                    full_value = value_hm * 0.5 + value_hm
                }
                $('#full_value').val(full_value)
                console.log(value_hm)
            } else {
                $('#full_value').val(parseInt($('#value').val()))
            }
        }



        function resetData() {
            console.log('resetData')
            $('#uuid').val('')
            $('.btn-outline-primary').attr('class', ' btn btn-outline-primary');
            $('#lbl-Siang').attr('class', ' btn btn-outline-primary active');
            $('#employee_uuid').val('').trigger('change');
        }
        $(document).ready(function() {
            // console.log( "ready!" );
            
            $('.btn-outline-primary').attr('class', ' btn btn-outline-primary');
            $('#lbl-Siang').attr('class', ' btn btn-outline-primary active');

        });
    </script>
@endsection
