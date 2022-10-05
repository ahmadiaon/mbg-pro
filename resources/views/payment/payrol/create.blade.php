@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="row">
            <div class="col-12">
                <form action="/payrol/payment-employee/store" method="POST">
                    @csrf
                    <input type="hidden"  name="uuid" id="uuid" value="{{ $uuid }}">
                    <div class="min-height-200px">
                        <!-- Identitas Karyawan -->
                        <div class="row">
                            <div class="col-5">
                                <div class="pd-20 card-box mb-20">
                                    <div class="clearfix">
                                        <div class="pull-left">
                                            <h4 class="text-blue h4">Tentang Pembayaran</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Tanggal</label>
                                                <input name="date" id="date"  type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group ">
                                                <label for="">Diketahui</label>
                                                <select class="custom-select2"  style="width:100%" name="known_employee_uuid" id="known_employee_uuid">
                                                    @if ($employees)
                                                        @foreach ($employees as $employee)
                                                            <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                                        @endforeach
                                                    @endif
                                                    <option value="">pilih</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group ">
                                                <label for="">Disetujui</label>
                                                <select class="custom-select2"  style="width:100%" name="approve_employee_uuid" id="approve_employee_uuid">
                                                    @if ($employees)
                                                        @foreach ($employees as $employee)
                                                            <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                                        @endforeach
                                                    @endif
                                                    <option value="">pilih</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group ">
                                                <label for="">Dibuat</label>
                                                <select class="custom-select2"  style="width:100%" name="create_employee_uuid" id="create_employee_uuid">
                                                    @if ($employees)
                                                        @foreach ($employees as $employee)
                                                            <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                                        @endforeach
                                                    @endif
                                                    <option value="">pilih</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group ">
                                                <label for="">Group Pembayaran</label>
                                                <select class="custom-select2"  style="width:100%" name="payment_group_uuid" id="payment_group_uuid">
                                                    @if ($payment_groups)
                                                        @foreach ($payment_groups as $value)
                                                            <option value="{{$value->uuid}}">{{ $value->payment_group}}</option>
                                                        @endforeach
                                                    @endif
                                                    <option value="">pilih</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12"> 
                                            <div class="form-group ">
                                                <label for="">Keterangan</label>
                                                <textarea class="form-control"  name="description" id="description" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-7">
                                <div class="pd-20 card-box mb-20">
                                    <div class="clearfix">
                                        <div class="pull-left">
                                            <h4 class="text-blue h4">Karyawan</h4>
                                        </div>
                                    </div>
                                    <div class="karyawan">
                                        <div class="row" id="row-people-1">
                                            <div class="col-8" id="col-8-1">
                                                <div class="form-group">
                                                    <label for="">Karyawan</label>
                                                    <input type="hidden" id="payment-employee-uuid-1" name="payment-employee-uuid-1">
                                                    <select  class="custom-select2" style="width:100%" name="employee_uuid-people-1" id="employee_uuid-people-1">
                                                        @if ($employees)
                                                            @foreach ($employees as $employee)
                                                                <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                                            @endforeach
                                                        @endif
                                                        <option value="">pilih</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group ">
                                                    <label for="">Harga</label>
                                                    <input onchange="storePaymentEmployee(1)" type="text" class="form-control" name="value-1" id="value-1">
                                                </div>
                                            </div>                                       
                                        </div>
                                        {{-- 2 --}}
                                        <div class="row" id="row-people-2">
                                            <div class="col-8" id="col-8-people-2">
                                                <div class="form-group">
                                                    <label for="">Karyawan</label>
                                                    <input type="hidden" id="payment-employee-uuid-2" name="payment-employee-uuid-2">
                                                    <select class="custom-select2" style="width:100%" name="employee_uuid-people-2" id="employee_uuid-people-2">
                                                        @if ($employees)
                                                            @foreach ($employees as $employee)
                                                                <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                                            @endforeach
                                                        @endif
                                                        <option value="">pilih</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group ">
                                                    <label for="">Harga</label>
                                                    <input onchange="storePaymentEmployee(2)" type="text" class="form-control" name="value-2" id="value-2">
                                                </div>
                                            </div>                                       
                                        </div>
                                          {{-- 3 --}}
                                          <div class="row" id="row-people-3">
                                            <div class="col-8" id="col-8-people-3">
                                                <div class="form-group">
                                                    <label for="">Karyawan</label>
                                                    <input type="hidden" id="payment-employee-uuid-3" name="payment-employee-uuid-3">
                                                    <select class="custom-select2" style="width:100%" name="employee_uuid-people-3" id="employee_uuid-people-3">
                                                        @if ($employees)
                                                            @foreach ($employees as $employee)
                                                                <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                                            @endforeach
                                                        @endif
                                                        <option value="">pilih</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group ">
                                                    <label for="">Harga</label>
                                                    <input onchange="storePaymentEmployee(3)" type="text" class="form-control" name="value-3" id="value-3">
                                                </div>
                                            </div>                                       
                                        </div>
                                          {{-- 4 --}}
                                          <div class="row" id="row-people-4">
                                            <div class="col-8" id="col-8-people-4">
                                                <div class="form-group">
                                                    <label for="">Karyawan</label>
                                                    <input type="hidden" id="payment-employee-uuid-4" name="payment-employee-uuid-4">
                                                    <select class="custom-select2" style="width:100%" name="employee_uuid-people-4" id="employee_uuid-people-4">
                                                        @if ($employees)
                                                            @foreach ($employees as $employee)
                                                                <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                                            @endforeach
                                                        @endif
                                                        <option value="">pilih</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group ">
                                                    <label for="">Harga</label>
                                                    <input onchange="storePaymentEmployee(4)" type="text" class="form-control" name="value-4" id="value-4">
                                                </div>
                                            </div>                                       
                                        </div>
                                        {{-- 5 --}}
                                        <div class="row" id="row-people-5">
                                            <div class="col-8" id="col-8-people-5">
                                                <div class="form-group">
                                                    <label for="">Karyawan</label>
                                                    <input type="hidden" id="payment-employee-uuid-5" name="payment-employee-uuid-5">
                                                    <select class="custom-select2" style="width:100%" name="employee_uuid-people-5" id="employee_uuid-people-5">
                                                        @if ($employees)
                                                            @foreach ($employees as $employee)
                                                                <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                                            @endforeach
                                                        @endif
                                                        <option value="">pilih</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group ">
                                                    <label for="">Harga</label>
                                                    <input onchange="storePaymentEmployee(5)" type="text" class="form-control" name="value-5" id="value-5">
                                                </div>
                                            </div>                                       
                                        </div>
                                        {{-- 6 --}}
                                        <div class="row" id="row-people-6">
                                            <div class="col-8" id="col-8-people-6">
                                                <div class="form-group">
                                                    <label for="">Karyawan</label>
                                                    <input type="hidden" id="payment-employee-uuid-6" name="payment-employee-uuid-6">
                                                    <select class="custom-select2" style="width:100%" name="employee_uuid-people-6" id="employee_uuid-people-6">
                                                        @if ($employees)
                                                            @foreach ($employees as $employee)
                                                                <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                                            @endforeach
                                                        @endif
                                                        <option value="">pilih</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group ">
                                                    <label for="">Harga</label>
                                                    <input onchange="storePaymentEmployee(6)" type="text" class="form-control" name="value-6" id="value-6">
                                                </div>
                                            </div>                                       
                                        </div>
                                        {{-- 7 --}}
                                        <div class="row" id="row-people-7">
                                            <div class="col-8" id="col-8-people-7">
                                                <div class="form-group">
                                                    <label for="">Karyawan</label>
                                                    <input type="hidden" id="payment-employee-uuid-7" name="payment-employee-uuid-7">
                                                    <select class="custom-select2" style="width:100%" name="employee_uuid-people-7" id="employee_uuid-people-7">
                                                        @if ($employees)
                                                            @foreach ($employees as $employee)
                                                                <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                                            @endforeach
                                                        @endif
                                                        <option value="">pilih</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group ">
                                                    <label for="">Harga</label>
                                                    <input onchange="storePaymentEmployee(7)" type="text" class="form-control" name="value-7" id="value-7">
                                                </div>
                                            </div>                                       
                                        </div>
                                        {{-- 8 --}}
                                        <div class="row" id="row-people-8">
                                            <div class="col-8" id="col-8-people-8">
                                                <div class="form-group">
                                                    <label for="">Karyawan</label>
                                                    <input type="hidden" id="payment-employee-uuid-8" name="payment-employee-uuid-8">
                                                    <select class="custom-select2" style="width:100%" name="employee_uuid-people-8" id="employee_uuid-people-8">
                                                        @if ($employees)
                                                            @foreach ($employees as $employee)
                                                                <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                                            @endforeach
                                                        @endif
                                                        <option value="">pilih</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group ">
                                                    <label for="">Harga</label>
                                                    <input onchange="storePaymentEmployee(8)" type="text" class="form-control" name="value-8" id="value-8">
                                                </div>
                                            </div>                                       
                                        </div>
                                        {{-- 9 --}}
                                        <div class="row" id="row-people-9">
                                            <div class="col-8" id="col-8-people-9">
                                                <div class="form-group">
                                                    <label for="">Karyawan</label>
                                                    <input type="hidden" id="payment-employee-uuid-9" name="payment-employee-uuid-9">
                                                    <select class="custom-select2" style="width:100%" name="employee_uuid-people-9" id="employee_uuid-people-9">
                                                        @if ($employees)
                                                            @foreach ($employees as $employee)
                                                                <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                                            @endforeach
                                                        @endif
                                                        <option value="">pilih</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group ">
                                                    <label for="">Harga</label>
                                                    <input onchange="storePaymentEmployee(9)" type="text" class="form-control" name="value-9" id="value-9">
                                                </div>
                                            </div>                                       
                                        </div>
                                        {{-- 10 --}}
                                        <div class="row" id="row-people-10">
                                            <div class="col-8" id="col-8-people-10">
                                                <div class="form-group">
                                                    <label for="">Karyawan</label>
                                                    <input type="hidden" id="payment-employee-uuid-10" name="payment-employee-uuid-10">
                                                    <select class="custom-select2" style="width:100%" name="employee_uuid-people-10" id="employee_uuid-people-10">
                                                        @if ($employees)
                                                            @foreach ($employees as $employee)
                                                                <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                                            @endforeach
                                                        @endif
                                                        <option value="">pilih</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group ">
                                                    <label for="">Harga</label>
                                                    <input onchange="storePaymentEmployee(10)" type="text" class="form-control" name="value-10" id="value-10">
                                                </div>
                                            </div>                                       
                                        </div>
                                        {{-- 11 --}}
                                        <div class="row" id="row-people-11">
                                            <div class="col-8" id="col-8-people-11">
                                                <div class="form-group">
                                                    <label for="">Karyawan</label>
                                                    <input type="hidden" id="payment-employee-uuid-11" name="payment-employee-uuid-11">
                                                    <select class="custom-select2" style="width:100%" name="employee_uuid-people-11" id="employee_uuid-people-11">
                                                        @if ($employees)
                                                            @foreach ($employees as $employee)
                                                                <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                                            @endforeach
                                                        @endif
                                                        <option value="">pilih</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group ">
                                                    <label for="">Harga</label>
                                                    <input onchange="storePaymentEmployee(11)" type="text" class="form-control" name="value-11" id="value-11">
                                                </div>
                                            </div>                                       
                                        </div>
                                        {{-- 12 --}}
                                        <div class="row" id="row-people-12">
                                            <div class="col-8" id="col-8-people-12">
                                                <div class="form-group">
                                                    <label for="">Karyawan</label>
                                                    <input type="hidden" id="payment-employee-uuid-12" name="payment-employee-uuid-12">
                                                    <select class="custom-select2" style="width:100%" name="employee_uuid-people-12" id="employee_uuid-people-12">
                                                        @if ($employees)
                                                            @foreach ($employees as $employee)
                                                                <option value="{{$employee->uuid}}">{{ $employee->name}}</option>
                                                            @endforeach
                                                        @endif
                                                        <option value="">pilih</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group ">
                                                    <label for="">Harga</label>
                                                    <input onchange="storePaymentEmployee(12)" type="text" class="form-control" name="value-12" id="input-people-12">
                                                </div>
                                            </div>                                       
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-group text-center">
                                                <button id="button-add" type="button" onclick="show(2)" class="add_button btn btn-success">Duplicate</button>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group text-center">
                                                <button type="submit" id="button-add" style="width: 100%" type="button" class="add_button btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            
        </div>
          
            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Bootstrap 4 Admin Template By
                <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
            </div>
    </div>
</div>
@section('js')
<script>
    
    x = document.getElementById("row-people-2");
    x.style.display = "none";
    a = document.getElementById("row-people-3");
    a.style.display = "none";
    b = document.getElementById("row-people-4");
    b.style.display = "none";
    c = document.getElementById("row-people-5");
    c.style.display = "none";
    d = document.getElementById("row-people-6");
    d.style.display = "none";
    e = document.getElementById("row-people-7");
    e.style.display = "none";
    f = document.getElementById("row-people-8");
    f.style.display = "none";
    g = document.getElementById("row-people-9");
    g.style.display = "none";
    h = document.getElementById("row-people-10");
    h.style.display = "none";
    j = document.getElementById("row-people-11");
    j.style.display = "none";
    k = document.getElementById("row-people-12");
    k.style.display = "none";

    function getPayment(uuid){
        let _token   = $('meta[name="csrf-token"]').attr('content');
		let _url = "/payrol/payment/show/";

        $.ajax({
              url: _url,
              type: "POST",
              data: {
				uuid: uuid,
                _token: _token
              },
              success: function(response) {
                data = response.data
				$('#uuid').val(data.uuid)
                $('#payment_group_uuid').val(data.payment_group_uuid),
                $('#date').val(data.date),
                $('#known_employee_uuid').val(data.known_employee_uuid).trigger("change"),
                $('#approve_employee_uuid').val(data.approve_employee_uuid).trigger("change"),
                $('#create_employee_uuid').val(data.create_employee_uuid).trigger("change"),
                $('#description').val(data.description),

                $('#payment_group_uuid').attr("onchange", "storePayment()"),
                $('#date').attr("onchange", "storePayment()"),
                $('#known_employee_uuid').attr("onchange", "storePayment()"),
                $('#approve_employee_uuid').attr("onchange", "storePayment()"),
                $('#create_employee_uuid').attr("onchange", "storePayment()"),
                $('#description').attr("onchange", "storePayment()")
                // console.log(data)
              },
              error: function(response) {
                console.log(response)
              }
            });
    }
    function getPaymentEmployee(uuid){
        let _token   = $('meta[name="csrf-token"]').attr('content');
		let _url = "/payrol/payment-employee/show/";

        $.ajax({
              url: _url,
              type: "POST",
              data: {
				payment_uuid: uuid,
                _token: _token
              },
              success: function(response) {
                data = response.data
                var ke = 1;
                data.forEach(element => {

                
                    var i = "row-people-"+ke;
                    $('#employee_uuid-people-'+ke).val(element.employee_uuid).trigger("change"),
                    $('#value-'+ke).val(element.value),
                    x = document.getElementById(i);
                    x.style.display = "";
                    ke = ke+1;
                    $("#button-add").attr("onclick","show("+ke+")");
                });
				// $('#uuid').val(data.uuid)
                // $('#payment_group_uuid').val(data.payment_group_uuid),
                // $('#date').val(data.date),
                // $('#known_employee_uuid').val(data.known_employee_uuid).trigger("change"),
                // $('#approve_employee_uuid').val(data.approve_employee_uuid).trigger("change"),
                // $('#create_employee_uuid').val(data.create_employee_uuid).trigger("change"),
                // $('#description').val(data.description),

                // $('#payment_group_uuid').attr("onchange", "storePayment()"),
                // $('#date').attr("onchange", "storePayment()"),
                // $('#known_employee_uuid').attr("onchange", "storePayment()"),
                // $('#approve_employee_uuid').attr("onchange", "storePayment()"),
                // $('#create_employee_uuid').attr("onchange", "storePayment()"),
                // $('#description').attr("onchange", "storePayment()"),
              },
              error: function(response) {
                console.log(response)
              }
            });
    }
    var uuid = @json($uuid);
    if(uuid == ''){
        console.log('uuid');
            $('#payment_group_uuid').attr("onchange", "storePayment()"),
            $('#date').attr("onchange", "storePayment()"),
            $('#known_employee_uuid').attr("onchange", "storePayment()"),
            $('#approve_employee_uuid').attr("onchange", "storePayment()"),
            $('#create_employee_uuid').attr("onchange", "storePayment()"),
            $('#description').attr("onchange", "storePayment()")
    }else{
        console.log(uuid);
        getPayment(uuid);   
        getPaymentEmployee(uuid);
    }

    
    

    
    function show(ke){
        var i = "row-people-"+ke;
        x = document.getElementById(i);
        x.style.display = "";
        ke = ke+1;
        $("#button-add").attr("onclick","show("+ke+")");
    }

    function storePaymentEmployee(i){
        console.log(i);
        let _token   = $('meta[name="csrf-token"]').attr('content');
		let _url = "/payrol/payment-employee/store";
        let employee_uuid = $('#employee_uuid-people-'+i).val();
        let value = $('#value-'+i).val();
        let payment_employee_uuid = $('#payment-employee-uuid-'+i).val();
        console.log(value)

        $.ajax({
              url: _url,
              type: "POST",
              data: {
                uuid :payment_employee_uuid,
				payment_uuid: $('#uuid').val(),
                employee_uuid: employee_uuid,
                value: value,
                _token: _token
              },
              success: function(response) {
                data = response.data
				$('#payment-employee-uuid-'+i).val(data.uuid)
                console.log(response)
              },
              error: function(response) {
                console.log(response)
              }
            });

    }

    function storePayment(){
        let _token   = $('meta[name="csrf-token"]').attr('content');
		let _url = "/payrol/payment/store";

        $.ajax({
              url: _url,
              type: "POST",
              data: {
				uuid: $('#uuid').val(),
                payment_group_uuid: $('#payment_group_uuid').val(),
                date: $('#date').val(),
                known_employee_uuid: $('#known_employee_uuid').val(),
                approve_employee_uuid: $('#approve_employee_uuid').val(),
                create_employee_uuid: $('#create_employee_uuid').val(),
                description: $('#description').val(),
                _token: _token
              },
              success: function(response) {
                data = response.data
				$('#uuid').val(data.uuid)
                console.log(response)
              },
              error: function(response) {
                console.log(response)
              }
            });

    }

</script>
@endsection