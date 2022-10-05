@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="row">
            <div class="col-12">
                <form action="/admin-hr" method="POST">
                    @csrf
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
                                                <input type="date" class="form-control">
                                            </div>
                                        
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group ">
                                                <label for="">Diketahui</label>
                                                <select class="custom-select2" style="width:100%" name="known_employee_uuid" id="known_employee_uuid">
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
                                                <select class="custom-select2" style="width:100%" name="approve_employee_uuid" id="approve_employee_uuid">
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
                                                <select class="custom-select2" style="width:100%" name="create_employee_uuid" id="create_employee_uuid">
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
                                                <select class="custom-select2" style="width:100%" name="create_employee_uuid" id="create_employee_uuid">
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
                                                <label for="">Keterangan</label>
                                                <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
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

                                    <div class="row" id="1">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="">Karyawan</label>
                                                <select class="custom-select2" style="width:100%" name="employee_uuid-1" id="employee_uuid-1">
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
                                                <input type="text" class="form-control" name="field1" id="">
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="row" id="1">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="">Karyawan</label>
                                                <select class="custom-select2" style="width:100%" name="employee_uuid-1" id="employee_uuid-1">
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
                                                <input type="text" class="form-control" name="field1" id="">
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="row" id="1">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="">Karyawan</label>
                                                <select class="custom-select2" style="width:100%" name="employee_uuid-1" id="employee_uuid-1">
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
                                                <input type="text" class="form-control" name="field1" id="">
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="row" id="1">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="">Karyawan</label>
                                                <select class="custom-select2" style="width:100%" name="employee_uuid-1" id="employee_uuid-1">
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
                                                <input type="text" class="form-control" name="field1" id="">
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="row" id="1">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="">Karyawan</label>
                                                <select class="custom-select2" style="width:100%" name="employee_uuid-1" id="employee_uuid-1">
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
                                                <input type="text" class="form-control" name="field1" id="">
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="row" id="1">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="">Karyawan</label>
                                                <select class="custom-select2" style="width:100%" name="employee_uuid-1" id="employee_uuid-1">
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
                                                <input type="text" class="form-control" name="field1" id="">
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="row" id="1">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="">Karyawan</label>
                                                <select class="custom-select2" style="width:100%" name="employee_uuid-1" id="employee_uuid-1">
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
                                                <input type="text" class="form-control" name="field1" id="">
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="row" id="1">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="">Karyawan</label>
                                                <select class="custom-select2" style="width:100%" name="employee_uuid-1" id="employee_uuid-1">
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
                                                <input type="text" class="form-control" name="field1" id="">
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="row" id="1">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="">Karyawan</label>
                                                <select class="custom-select2" style="width:100%" name="employee_uuid-1" id="employee_uuid-1">
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
                                                <input type="text" class="form-control" name="field1" id="">
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="row" id="1">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="">Karyawan</label>
                                                <select class="custom-select2" style="width:100%" name="employee_uuid-1" id="employee_uuid-1">
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
                                                <input type="text" class="form-control" name="field1" id="">
                                            </div>
                                        </div>                                       
                                    </div>
                                    
                                    
                                    
                                    <div class="col-12">
                                        <div class="form-group text-center">
                                            <button type="button" class="add_button btn btn-success">tambah</button>
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
    
</script>
<script>
    $(document).ready(function() {
        const box = document.getElementById('1');
        box.style.display = '';
// Defines global identifiers
let
  currentFieldCount = 1,
  totalFieldsCreated = 1;
const
  maxFieldCount = 100,
  addButton = $('.add_button'),
  wrapper = $('.field_wrapper');

// Calls `addField` when addButton is clicked
$(addButton).click(addField);

// Executes anonymous function when `Remove` is clicked, which removes
//   the parent div, and decrements (and logs) `currentFieldCount`
$(wrapper).on('click', '.remove_button', function(e) {
  e.preventDefault();
  $(this).parent('div').remove();
  currentFieldCount--;
  console.log(`currentFieldCount: ${currentFieldCount}`);
});

// Defines the `addField` function
function addField(){

  // Makes sure that `currentFieldCount` and `totalFieldsCreated` 
  //   are not at maximum before proceeding
  if(
    currentFieldCount < maxFieldCount && 
    totalFieldsCreated < Number.MAX_VALUE
  ){

    // Creates an input element, increments `totalFieldsCreated`,
    //   and uses the incremented value in the input's `name` attribute
    const input = document.createElement("input");
    input.type = "text";
    input.name = "field" + ++totalFieldsCreated;
    input.value = "";

    // Creates an anchor element with the `remove_button` class
    const a = document.createElement("a");
    a.href = "javascript:void(0);";
    a.classList.add("remove_button");
    a.title = "remove";
    a.innerHTML = "Remove";
    
    // Adds the new elements to the DOM, and increments `currentFieldCount`
    const div = document.createElement("div");
    div.appendChild(input);
    div.appendChild(a);
    $(wrapper).append(div);
    currentFieldCount++;

    // Logs the new values of both variables 
    console.log(
      `currentFieldCount: ${currentFieldCount},`,
      `totalFieldsCreated ${totalFieldsCreated}`
    );
  }
}
});
</script>
@endsection