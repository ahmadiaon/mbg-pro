@extends('template.admin.main_privilege')
@section('content')
    <div class="mb-30">
        <div class="row">
            <div class="col-12">
                <!-- Simple Datatable start -->
                <div class="card-box  mb-30">
                    <form action="/formula/store" id="form-formula" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="pd-20">
                            <div class="row">
                                <div class="col">
                                    <h4 class="text-blue h4">Formula {{ $formula->formula_name }}</h4>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Simple Datatable End -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <form action="/database/formula/store" id="form-formula" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="uuid" value="{{ $formula->uuid}}">
                <div class="row" id="the-formula">
                    
                    
                </div>
                <input type="hidden" id="count_group_formula" name="count_group_formula">
                <input type="hidden" id="count_variable_count" name="count_variable_count">
            </form>
            </div>
        </div>
    </div>

    {{-- modal add user privilege --}}
    <div class="modal fade" id="symbol-group-formula" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="employee-payment-debt/store" id="form-employee-payment-debt" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="uuid" id="uuid" class="form-control">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Nama Satuan
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Satuan</label>
                                    <select onselect="addElementMathGroupFormula()" class="form-control " name="symbol_group_formula" id="symbol_group_formula">
                                        <option value="-">-</option>
                                        <option value="+">+</option>
                                        <option value="x">x</option>
                                        <option value="/">/</option>
                                    </select>
                                    <div class="invalid-feedback" id="req-payment_other_uuid">
                                        Data tidak boleh kosong
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" onclick="addElementMathGroupFormula()" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        let count_group_formula = 0;
        let count_variable_count =0;

        let group_formulas = @json($group_formulas);
        let variables = @json($variables);
        console.log(group_formulas.length);
        if(group_formulas.length >= 1){
            group_formulas.forEach(element => {
                    count_group_formula++;
                    if(element.group_formula_symbol){
                        let group_formula_symbol = `
                        <div id="group-symbol-${count_group_formula}" class="col-md-12 text-center">
                            <div class="card-box  mb-30 pd-20">
                                <h1>${element.group_formula_symbol}</h1>
                                <input value="${element.group_formula_symbol}" name="group_symbol-${count_group_formula}" id="symbol_group_formula-${count_group_formula}">
                            </div>
                        </div>`;
                        $('#the-formula').append(group_formula_symbol);
                    }

                    let element_group = `
                    <div id="group-formula-${count_group_formula}" class="col-md-12">
                        <div class="card-box  mb-30">
                            
                                <div class="pd-20">
                                    <div id="formula-group-${count_group_formula}" class="row">
                                        <div class="col-12">
                                            <h4 class="text-blue h4">Group Formula ${count_group_formula}</h4>
                                        </div>`;

                    let variable_counts = element.variable_counts;
                    count_variable_count = 0;
                    console.log(variable_counts);

                    variable_counts.forEach(element_variable_count => {
                        count_variable_count++;
                        if(element_variable_count.symbol_count){
                            element_group = element_group+ `
                            <div class="col-12 variable-${count_group_formula}-${count_variable_count}" >
                                <div  class="form-group">
                                    <label for="">Perhitungan ${element_variable_count.order_number}</label>
                                    <select class=" form-control " name="symbol_count-${count_group_formula}-${count_variable_count}"
                                        id="symbol_count-${count_group_formula}-${count_variable_count}">

                                        <option ${(element_variable_count.symbol_count == '-')?'selected' : ''} value="-">-</option>
                                        <option ${(element_variable_count.symbol_count == '+')?'selected' : ''} value="+">+</option>
                                        <option ${(element_variable_count.symbol_count == 'x')?'selected' : ''} value="x">x</option>
                                        <option ${(element_variable_count.symbol_count == '/')?'selected' : ''} value="/">/</option>

                                    </select>
                                </div>
                            </div>`;
                        }

                        element_group = element_group+ `
                        <div class="col-12 variable-${count_group_formula}-${count_variable_count}">
                            <div id="variable-${count_group_formula}-${count_variable_count}" class="form-group">
                                <label for="">Variable ${element_variable_count.order_number}</label>
                                <select onchange="value_nilai(${count_group_formula},${count_variable_count})"  class=" form-control variable" name="variable_uuid-${count_group_formula}-${count_variable_count}"
                                    id="variable_uuid-${count_group_formula}-${count_variable_count}">`;

                                    variables.forEach(element_variable => {
                                        console.log(element_variable.uuid)
                                        element_group = element_group+`<option ${(element_variable.uuid == element_variable_count.variable_uuid)?'selected':''} value="${element_variable.uuid}">${element_variable.variable_name}</option>`;
                                    });
                                    
                        element_group = element_group+`
                                </select>`;
                                if(element_variable_count.variable_uuid == 'NILAI'){
                                    element_group = element_group +
                                    `   <div class="form-group value_value_variable-${count_group_formula}-${count_variable_count}">
                                            <label for="">Nilai ${count_variable_count}</label>
                                            <input value="${element_variable_count.value_value_variable}" class="form-control" name="value_value_variable-${count_group_formula}-${count_variable_count}" id="value_value_variable-${count_group_formula}-${count_variable_count}">
                                        </div>`;
                                }
                        element_group = element_group+
                            `</div>
                        </div>
                        `;
                    });

                    element_group = element_group+
                                    `</div>
                                    <div class="button-group text-right">
                                        <button id="btn-delete-variable-${count_group_formula}" type="button" onclick="deleteVariable(${count_group_formula},${count_variable_count})"
                                            class="btn btn-danger">Hapus variable</button>
                                        <button id="btn-add-variable-${count_group_formula}" type="button" onclick="addVariable(${count_group_formula},${count_variable_count})"
                                            class="btn btn-secondary">Tambah variable</button>
                                    </div>
                                </div>
                        </div>
                    </div>`;

                    $('#the-formula').append(element_group);
            });
        }else{
            count_variable_count = 1;
            let element_math = `
                   
                    <div id="group-formula-${count_group_formula+1}" class="col-md-12">
                        <div class="card-box  mb-30">
                                <div class="pd-20">
                                    <div id="formula-group-${count_group_formula+1}" class="row">
                                        <div class="col-12">
                                            <h4 class="text-blue h4">Group Formula ${count_group_formula+1}</h4>
                                        </div>
                                        <div class="col-12 variable-${count_group_formula+1}-${count_variable_count}">
                                            <div id="variable-${count_group_formula+1}-${count_variable_count}" class="form-group">
                                                <label for="">Variable ${count_variable_count}</label>
                                                <select onchange="value_nilai(${count_group_formula+1},${count_variable_count})" class=" form-control " name="variable_uuid-${count_group_formula+1}-${count_variable_count}"
                                                    id="variable_uuid-${count_group_formula+1}-${count_variable_count}">
                                                    <option value="">Pilih variable</option>
                                                    @foreach ($variables as $variable)
                                                        <option value="{{ $variable->uuid }}">{{ $variable->variable_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>`;

                 

                element_math = element_math +
                                   ` </div>
                                    <div class="button-group text-right">
                                        <button id="btn-delete-variable-${count_group_formula+1}" type="button" onclick="deleteVariable(${count_group_formula+1},${count_variable_count})"
                                            class="btn btn-danger">Hapus</button>
                                        <button  id="btn-add-variable-${count_group_formula+1}" type="button" onclick="addVariable(${count_group_formula+1},${count_variable_count})"
                                            class="btn btn-secondary">Tambah</button>
                                    </div>
                                </div>

                        </div>
                    </div>
                    `;
            $('#the-formula').append(element_math);
            console.log('0');
        }
        let button_add = `<div class="col-md-12">
                        <div class="card-box  mb-30 pd-20">
                            <div class="button-group text-right">
                                <button type="button" onclick="deleteGroupFormula()" class="btn btn-danger">Hapus</button>
                                <button type="button" onclick="addGroupFormula()" class="btn btn-secondary">Tambah</button>
                                <button onclick="funcStore()" type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>`;
        $('#the-formula').append(button_add); 
        function addGroupFormula() {
            $('#symbol-group-formula').modal('show');
            
        }
        function value_nilai(group, variable){
            console.log(group);
            
            let value = $('#variable_uuid-'+group+'-'+variable).val();
            // console.log(value);
            if(value == 'NILAI'){
                console.log('nilai');
                let element_value =`
                <div class="form-group value_value_variable-${group}-${variable}">
                    <label for="">Nilai ${variable}</label>
                    <input class="form-control" name="value_value_variable-${group}-${variable}" id="value_value_variable-${group}-${variable}">
                </div>
                `;
                $('#variable-'+group+'-'+variable).append(element_value);
            }else{
                $('.value_value_variable-'+group+'-'+variable).remove();
                console.log('lain nilai');
            }


        }

        function addElementMathGroupFormula(){
            count_variable_count = 1;
            console.log(count_group_formula);
            let symbol_group_formula = $('#symbol_group_formula').val();
            let element_math = `
                    <div id="group-symbol-${count_group_formula+1}" class="col-md-12 text-center">
                        <div class="card-box  mb-30 pd-20">
                            <h1>${symbol_group_formula}</h1>
                            <input value="${symbol_group_formula}" name="group_symbol-${count_group_formula+1}" id="symbol_group_formula-${count_group_formula+1}">
                        </div>
                    </div>
                    <div id="group-formula-${count_group_formula+1}" class="col-md-12">
                        <div class="card-box  mb-30">
                         
                                <div class="pd-20">
                                    <div id="formula-group-${count_group_formula+1}" class="row">
                                        <div class="col-12">
                                            <h4 class="text-blue h4">Group Formula ${count_group_formula+1}</h4>
                                        </div>
                                        <div class="col-12">
                                            <div id="variable-${count_group_formula+1}-${count_variable_count}" class="form-group">
                                                <label for="">Variable ${count_variable_count}</label>
                                                <select  onchange="value_nilai(${count_group_formula+1},${count_variable_count})" class=" form-control " name="variable_uuid-${count_group_formula+1}-${count_variable_count}"
                                                    id="variable_uuid-${count_group_formula+1}-${count_variable_count}">
                                                    @foreach ($variables as $variable)
                                                        <option value="{{ $variable->uuid }}">{{ $variable->variable_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="button-group text-right">
                                        <button id="btn-delete-variable-${count_group_formula+1}" type="button" onclick="deleteVariable(${count_group_formula+1},${count_variable_count})"
                                            class="btn btn-danger">Hapus</button>
                                        <button  id="btn-add-variable-${count_group_formula+1}" type="button" onclick="addVariable(${count_group_formula+1},${count_variable_count})"
                                            class="btn btn-secondary">Tambah</button>
                                    </div>
                                </div>

                        </div>
                    </div>
                    `;
            $('#group-formula-'+count_group_formula).after(element_math);
            count_group_formula++;
            $('#symbol-group-formula').modal('hide');
        }
        function deleteGroupFormula(){
            if(count_group_formula == 1){
                console.log(count_group_formula);
            }else{
                console.log(count_group_formula);
                $('#group-formula-'+count_group_formula).remove();
                $('#group-symbol-'+count_group_formula).remove();
                count_group_formula--;
            }
            
        }

        function funcStore(){
            $('#count_variable_count').val(count_variable_count);
            $('#count_group_formula').val(count_group_formula);
        }



        function addVariable(group, variable){
            group = group;
            variable = variable+1;
            let element_variable_element = `
            <div class="col-12 variable-${group}-${variable}" >
                <div id="varible-${group}-${variable}" class="form-group">
                    <label for="">Perhitungan ${variable}</label>
                    <select class=" form-control " name="symbol_count-${group}-${variable}"
                        id="symbol_count-${group}-${variable}">

                        <option  value="-">-</option>
                        <option  value="+">+</option>
                        <option  value="x">x</option>
                        <option  value="/">/</option>

                    </select>
                </div>
            </div>
            <div class="col-12 variable-${group}-${variable}">
                <div id="variable-${group}-${variable}" class="form-group">
                    <label for="">Variable ${variable}</label>
                    <select onchange="value_nilai(${group},${variable})" class=" form-control variable" name="variable_uuid-${group}-${variable}"
                        id="variable_uuid-${group}-${variable}">`;
                        variables.forEach(element_variable => {
                            element_variable_element = element_variable_element+`<option  value="${element_variable.uuid}">${element_variable.variable_name}</option>`;
                        });
                        
            element_variable_element = element_variable_element+`
                    </select>
                </div>
            </div>
            `;

            $('#formula-group-'+group).append(element_variable_element);
            count_group_formula = group;
            count_variable_count = variable;
            $('#btn-delete-variable-'+group).attr("onclick", "deleteVariable("+group+","+variable+")");
            $('#btn-add-variable-'+group).attr("onclick", "addVariable("+group+","+variable+")");
           
            console.log(group+'-'+variable);
        }

        function deleteVariable(group, variable){
            $('.variable-'+group+'-'+variable).remove();
            count_group_formula--;
            variable = variable-1;
            $('#btn-delete-variable-'+group).attr("onclick", "deleteVariable("+group+","+variable+")");
            $('#btn-add-variable-'+group).attr("onclick", "addVariable("+group+","+variable+")");
            console.log(group+'-'+variable);
        }
    </script>
@endsection
