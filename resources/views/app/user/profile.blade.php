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
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-block" data-toggle="collapse" data-target="#faq1">
                                Informasi masa kerja
                            </button>
                        </div>
                        <div id="faq1" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <div class="profile-timeline">
                                    <div class="timeline-month mt-20">
                                        <h5>Masa Kerja</h5>
                                    </div>
                                    <div class="profile-timeline-list mb-20">
                                        <ul>
                                            <li>
                                                <div class="date">TMK</div>
                                                <div class="task-name display-tmk">
                                                    <i class="ion-android-alarm-clock"></i> -

                                                </div>
                                                <p class="display-tmk-desc">
                                                    Anda sudah bekerja - tahun - bulan - hari.
                                                </p>
                                            </li>
                                        </ul>
                                        <ul class="display-contract PKWT">
                                            <li>
                                                <div class="date">Mulai <br> Kontrak</div>
                                                <div class="task-name display-start-contract">
                                                    <i class="ion-android-alarm-clock"></i> 12 okt 2023 (24 Bulan)
                                                </div>
                                                <p class="display-start-contract-desc">
                                                    Kontrak berjalan 1 tahun 3 bulan 10 hari.
                                                </p>
                                            </li>
                                            <li>
                                                <div class="date">Akhir <br>Kontrak</div>
                                                <div class="task-name display-end-contract">
                                                    <i class="ion-ios-chatboxes "></i> 26 Okt 2024
                                                </div>
                                                <p class="display-end-contract-desc">
                                                    Kontrak terisa 1 tahun 3 bulan 10 hari.
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    {{--                                     <div class="timeline-month">
                                        <h5>Hari Kerja</h5>
                                    </div>
                                    <div class="profile-timeline-list">
                                        <ul>
                                            <li>
                                                <div class="date">12 Aug</div>
                                                <div class="task-name">
                                                    <i class="ion-android-alarm-clock"></i> 56 Hari
                                                    Berjalan
                                                </div>
                                                <p>
                                                    Anda sudah bekerja selama 56 hari dari 70 hari kerja
                                                </p>
                                                <div class="task-time">14 hari menuju Cuti</div>
                                            </li>
                                            <li>
                                                <div class="date">10 Aug</div>
                                                <div class="task-name mb-30">
                                                    <i class="ion-ios-chatboxes"></i> 14 hari
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="timeline-month mt-20">
                                        <h5>Jadwal Cuti</h5>
                                    </div>
                                    <div class="profile-timeline-list mb-20">
                                        <ul>
                                            <li>
                                                <div class="date">12 July</div>
                                                <div class="task-name">
                                                    <i class="ion-android-alarm-clock"></i> 12 okt - 26 okt
                                                </div>
                                                <p>
                                                    Cuti anda selanjutnya mulai 12 okt sampai 26 okt
                                                </p>
                                            </li>
                                            <li>
                                                <div class="date">10 July</div>
                                                <div class="task-name">
                                                    <i class="ion-ios-chatboxes"></i> 26 Okt
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                     --}}


                                </div>
                            </div>
                        </div>
                    </div>







                    <div class="card" id="identitas-0">
                        <div class="card-header">
                            <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#KARYAWAN">
                                Informasi Identitas diri
                            </button>
                        </div>
                        <div id="KARYAWAN" class="collapse" data-parent="#accordion">
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
        function createFormField(code_table) {
            let code_data = ui_dataset.ui_dataset.user_authentication.employee_uuid;
            // code_table = 'KARYAWAN';
            let arr_table = {};

            let data_for_field_edit = db['public'][code_table][code_data];
            let date_tmk_end = getDateToday();

            conLog('db',db);
            conLog('data_for_field_edit',data_for_field_edit);
            
            data_for_field_edit['TANGGAL-AWAL-KONTRAK'] = excelSerialToDate(data_for_field_edit['TANGGAL-AWAL-KONTRAK']);
            data_for_field_edit['TANGGAL-AKHIR-KONTRAK'] = excelSerialToDate(data_for_field_edit['TANGGAL-AKHIR-KONTRAK']);

            if (data_for_field_edit['STATUS-KERJA'] == 'PHK') {
                $('.display-contract').remove();
                date_tmk_end = excelSerialToDate(data_for_field_edit[
                    'TANGGAL-BERAKHIR-KONTRAK--TBK-STATUS-KERJA']) // format_date
            }



            let count_day_tmk = dateDiff(data_for_field_edit['TANGGAL-MASUK-KERJA--TMK-'], date_tmk_end);


            $(`.display-tmk`).text(toShortStringDate_fromFormatDate(data_for_field_edit['TANGGAL-MASUK-KERJA--TMK-']));

            let text_tmk_desc =
                `Anda sudah bekerja ${count_day_tmk.years} tahun ${count_day_tmk.months} bulan ${count_day_tmk.days} hari.`;
            $(`.display-tmk-desc`).text(text_tmk_desc);


            let count_month_contract = calculateMonthsBetweenDates(excelSerialToDate(data_for_field_edit[
                'TANGGAL-AWAL-KONTRAK']), excelSerialToDate(data_for_field_edit[
                'TANGGAL-AKHIR-KONTRAK']));
            $(`.display-start-contract`).text(
                `${toShortStringDate_fromFormatDate(data_for_field_edit['TANGGAL-AWAL-KONTRAK'])} (${count_month_contract} BULAN)`
            );


            let count_day_contract = dateDiff(excelSerialToDate(data_for_field_edit[
                'TANGGAL-AWAL-KONTRAK']), getDateToday());
            $(`.display-start-contract-desc`).text(
                `Kontrak berjalan ${count_day_contract.years} tahun ${count_day_contract.months} bulan ${count_day_contract.days} hari.`
            );

            $(`.display-end-contract`).text(
                `${toShortStringDate_fromFormatDate(data_for_field_edit['TANGGAL-AKHIR-KONTRAK'])}`);

            let desc_contract = 'tersisa';
            let count_contract;
            if (getDateToday() > data_for_field_edit['TANGGAL-AKHIR-KONTRAK']) {
                desc_contract = 'telat';
                count_contract = dateDiff(data_for_field_edit['TANGGAL-AKHIR-KONTRAK'], getDateToday());
                console.log('lebih besar');

            } else {
                count_contract = dateDiff(getDateToday(), data_for_field_edit['TANGGAL-AKHIR-KONTRAK']);
                console.log('lebih kecil')
            }
            $(`.display-end-contract-desc`).text(
                `Kontrak ${desc_contract} ${count_contract.years} tahun ${count_contract.months} bulan ${count_contract.days} hari.`
            );

            conLog('data_for_field_edit', data_for_field_edit);
            let database_datatable = getValueDatabase_datatable(code_table);

            conLog('database_datatable', database_datatable);
            // === create table fields
            Object.values(database_datatable['fields']).forEach(field => {
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
                    // CL(element);
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
                        cardFormField('fields-' + element, field, 'disabled');

                    });
                    arr_table[element] = count_table;
                    count_table++;
                });
            } else {

                $('.faq-wrap').attr('hidden', true);
            }
            //=========== create field form

            Object.entries(data_for_field_edit).forEach(([index, value]) => {
                // conLog(index, value)
                $(`.${index}`).val(value);
                $(`.show-${index}`).attr('hidden', false);
                $(`.show-${index}`).attr('onclick', `showFile('${value}', '${index}')`);
                // $(`.show-${index}`).show();
            });


            $('.custom-select2').trigger('change');
            $('.secondary_key').val(code_data);
            conLog('arr_table', arr_table)
            if (data_for_field_edit['STATUS-KERJA'] == 'AKTIVE') {
                $(`#identitas-${arr_table['PHK-KARYAWAN']+1}`).remove();
            }


            if(data_for_field_edit['JENIS-KONTRAK'] == 'PKWTT'){
                $('.PKWT').empty();
                $('.PKWT').append(`<li>
                                                <div class="date">Jenis <br> Kontrak</div>
                                                <div class="task-name display-start-contract">
                                                    <i class=""></i> PKWTT
                                                </div>
                                            </li>`)
            }
            $('.form-control').attr('disabled', true);
        }

        createFormField('KARYAWAN');
    </script>
@endsection()
