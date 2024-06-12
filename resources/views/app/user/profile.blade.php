@extends('app.layouts.main')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Selamat Datang, <b class="user-name"></b></h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Profile
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-5">
            <div class="faq-wrap">
                <h4 class="mb-20 h4 text-blue">Data diri <b class="user-name"></b></h4>
                <div id="accordion">
                    {{-- <div class="card">
                        <div class="card-header">
                            <button class="btn btn-block" data-toggle="collapse" data-target="#faq1">
                                Informasi masa kerja
                            </button>
                        </div>
                        <div id="faq1" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life
                                accusamus terry richardson ad squid. 3 wolf moon officia
                                aute, non cupidatat skateboard dolor brunch. Food truck
                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                sunt aliqua put a bird on it squid single-origin coffee
                                nulla assumenda shoreditch et. Nihil anim keffiyeh
                                helvetica, craft beer labore wes anderson cred nesciunt
                                sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                Leggings occaecat craft beer farm-to-table, raw denim
                                aesthetic synth nesciunt you probably haven't heard of them
                                accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div> --}}
                    <div class="card" id="identitas-0">
                        <div class="card-header">
                            <button class="btn btn-block" data-toggle="collapse" data-target="#KARYAWAN">
                                Informasi Identitas diri
                            </button>
                        </div>
                        <div id="KARYAWAN" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <form id="fields" class="header-form">
                                    <div class="row profile-info" id="field-form">
                                    </div>
                                </form>
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
        // console.log(localStorage.getItem('ui_dataset'));
        // console.log(@json(session('user_authentication')));

        let user_authentication = @json(session('user_authentication'));
        conLog('user_authentication',user_authentication);
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

    <script>
        function createFormField(code_table) {
            let code_data = db['user']['employee_uuid'];
            // code_table = 'KARYAWAN';
            let arr_table = {};

            let data_for_field_edit = db['public']['public_value'][code_table][code_data];
            conLog('data_for_field_edit', data_for_field_edit);
            let database_datatable = getValueDatabase_datatable(code_table);

            conLog('database_datatable',database_datatable);
            // === create table fields
            Object.values(database_datatable['fields']).forEach(field => {
                field['type_data_field'] = 'TEXT';
                cardFormField('field-form', field, 'disabled');
            });


            if (database_datatable['table_childs']) {
                $(`#sub-form`).empty();
                $('.faq-wrap').attr('hidden', false);
                let count_table = 0;
                
                database_datatable['table_childs'].forEach(element => {
                    /*
                    1. buat form table child di bawah table utama
                    */
                    CL(element);
                    $(`#identitas-${count_table}`).after(`
                        <div id="identitas-${count_table+1}" class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq-${element}">
                                    ${db['db']['database_table'][element]['description_table']}
                                </button>
                            </div>
                            <div id="faq-${element}" class="collapse" data-parent="#accordion">
                                <form class="form-${element}">
                                    <div id="fields-${element}" class="card-body">
                                    
                                    </div>
                                </form>
                            </div>
                        </div>
                    `);
                    database_datatable['field_childs'] = db['db']['database_field'][element];
                    Object.values(database_datatable['field_childs']).forEach(field => {
                        field['type_data_field'] = 'TEXT';
                        cardFormField('fields-' + element, field, 'disabled');
                    });
                    arr_table[element] = count_table;
                    count_table++;
                });
            } else {

                $('.faq-wrap').attr('hidden', true);
            }
            //=========== create field form

            Object.entries(data_for_field_edit).forEach(([index , value]) => {
                $(`.${index}`).val(value);
                // $(`.${index}`).trigger('change');
            });
            $('.custom-select2').trigger('change');
            $('.secondary_key').val(code_data);
            conLog('arr_table',arr_table)
            if(data_for_field_edit['STATUS-KERJA'] == 'Aktive'){
                $(`#identitas-${arr_table['PHK-KARYAWAN']+1}`).remove();
            }
        }

        createFormField('KARYAWAN');
    </script>
@endsection()
