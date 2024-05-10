<script>
    let db = JSON.parse(localStorage.getItem('DATABASE'));


    let COLOR_BOOTSTRAP = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
    var monthRomawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    var months = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    let color_button = {
        alpa: 'danger',
        pay: 'primary',
        unpay: 'secondary',
        cut: 'warning'
    };

    const KONSTANTA = [];
    KONSTANTA['tb_karyawan'] = 'NRP';
    KONSTANTA['Input Autocomplite'] = 'INPUT-AUTOCOMPLITE';
    KONSTANTA['Input Autocomplite'] = 'INPUT-AUTOCOMPLITE';
    var name_days_sort = new Array(7);
    name_days_sort[0] = "Mig";
    name_days_sort[1] = "Sen";
    name_days_sort[2] = "Sel";
    name_days_sort[3] = "Rab";
    name_days_sort[4] = "Kam";
    name_days_sort[5] = "Jum";
    name_days_sort[6] = "Sab";

    let GLOBAL_DATA_EXPORT = {};

    let ui_dataset = {
        ui_dataset: {
            ui_date: null,
            user_authentication: null
        }
    }

    let arr_date_today = @json(session('year_month'));








    if (!arr_date_today) {
        // arr_date_today = getDateTodayArr();

        // cg('kosong', arr_date_today);
        setDateSession(getDateTodayArr()['year'], getDateTodayArr()['month']);
        cg('kosong', @json(session('year_month')));
    }

    cg('arr_date_today', arr_date_today)

    function cg(message, data) {
        console.log(message + ':');
        console.log(data);
    }

    if (localStorage.getItem('ui_dataset')) {
        // conLog('not null', localStorage.getItem('ui_dataset'));
        ui_dataset = JSON.parse(localStorage.getItem('ui_dataset'));
    }

    if (ui_dataset.ui_dataset.user_authentication == null) {
        ui_dataset.ui_dataset.user_authentication = @json(session('user_authentication'));
    }

    if (ui_dataset.ui_dataset.ui_date == null) {
        let date_now = new Date();
        let day = padToDigits(2, date_now.getDate());
        let month = padToDigits(2, date_now.getMonth() + 1);
        let year = date_now.getFullYear();

        ui_dataset.ui_dataset.ui_date = {
            "day": day,
            "month": month,
            "year": year
        }
        localStorage.setItem('ui_dataset', JSON.stringify(ui_dataset));
    }

    function CL(data_string) {
        console.log(Object.keys({
            data_string
        })[0]);
        console.log(data_string);
    }

    function optionSelect(table_code, field_get, filter_data) {
        conLog('table_code', table_code)
        let element_option_data_source = ``;

        if (db['public']['public_value'][table_code]) {
            switch (field_get) {
                case "NRP":
                    Object.entries(db['public']['public_value'][table_code]).forEach(([key, element]) => {
                        element_option_data_source =
                            `${element_option_data_source}<option value="${key}">${element[field_get]} | ${element["NAMA-KARYAWAN"]} | ${(element["JABATAN"])?element["JABATAN"]:'-'} | ${(element["DEPARTEMEN"])?element["DEPARTEMEN"]:'-'}</option>`;
                    });
                    break;

                default:
                    Object.entries(db['public']['public_value'][table_code]).forEach(([key, element]) => {
                        element_option_data_source =
                            `${element_option_data_source}<option value="${element[field_get]}">${element[field_get]}</option>`;
                    });
                    break;
            }

        } else {
            element_option_data_source = `<option value="">Tidak ada data</option>`;
        }

        return element_option_data_source;
    }



    function truncateString(str, maxLength) {
        if (str.length > maxLength) {
            return str.slice(0, maxLength) + "...";
        }
        return str;
    }

    function autocompleteNew(inp, arr) {
        var currentFocus;
        conLog('inp', inp);
        inp.addEventListener("input", function(e) {
            let id_element = this.id;
            var a, b, i, val = this.value;
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");

            a.setAttribute("class", "autocomplete-items");
            this.parentNode.appendChild(a);
            conLog('ths', this.id)
            for (i = 0; i < arr.length; i++) {
                if (arr[i].value_data.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    b = document.createElement("DIV");
                    b.innerHTML = "<strong>" + arr[i].value_data.substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].value_data.substr(val.length);
                    b.addEventListener("click", function(e) {
                        inp.value = this.getElementsByTagName("input")[0].value;
                        conLog('ssssssss', inp)
                        document.getElementById("code-autocomplite-" + id_element).value = this
                            .getElementsByTagName("input")[1].value;;
                        closeAllLists();
                    });
                    b.innerHTML +=
                        `<input id="prediction-value_data-${i}-${id_element}" type="text" value="${arr[i].value_data}">`;
                    b.innerHTML +=
                        `<input id="prediction-code_data-${i}-${id_element}" type="text" value="${arr[i].code_data}">`;
                    a.appendChild(b);
                }
            }
        });
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                currentFocus++;
                addActive(x);
            } else if (e.keyCode == 38) {
                currentFocus--;
                addActive(x);
            } else if (e.keyCode == 13) {
                e.preventDefault();
                if (currentFocus > -1) {
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            if (!x) return false;
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        document.addEventListener("click", function(e) {
            closeAllLists(e.target);
        });
    }

    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function(e) {
            closeAllLists(e.target);
        });
    }

    // =============================================================================================================== DATABASE DATATABLE==
    function cardEmployees(nik_employee) {
        return `
                <div class="name-avatar d-flex align-items-center pr-2 card-box pl-2">
                    <div class="avatar mr-2 flex-shrink-0">
                        <img src="/vendors/images/photo5.jpg" class="border-radius-100 box-shadow"
                            width="50" height="50" alt="">
                    </div>
                    <div class="txt">
                        <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                            style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">${db['employees'][nik_employee]['company']} |
                            ${db['employees'][nik_employee]['department']}</span>
                        <div class="font-14 weight-600">${db['employees'][nik_employee]['name']}</div>
                        <div class="font-12 weight-500">${db['employees'][nik_employee]['nik_employee_with_space']}</div>
                        <div class="font-12 weight-500" data-color="#b2b1b6" style="color: rgb(178, 177, 182);">
                            ${db['employees'][nik_employee]['position']}
                        </div>
                    </div>
                </div>
            `;
    }

    function cardEmployeesDB(nik_employee) {
        return `
                <div class="name-avatar d-flex align-items-center pr-2 card-box pl-2">
                    <div class="avatar mr-2 flex-shrink-0">
                        <img src="/vendors/images/photo5.jpg" class="border-radius-100 box-shadow"
                            width="50" height="50" alt="">
                    </div>
                    <div class="txt">
                        <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                            style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">${db['employees'][nik_employee]['company']} |
                            ${db['employees'][nik_employee]['department']}</span>
                        <div class="font-14 weight-600">${db['employees'][nik_employee]['name']}</div>
                        <div class="font-12 weight-500">${db['employees'][nik_employee]['nik_employee_with_space']}</div>
                        <div class="font-12 weight-500" data-color="#b2b1b6" style="color: rgb(178, 177, 182);">
                            ${db['employees'][nik_employee]['position']}
                        </div>
                    </div>
                </div>
            `;
    }

    function getDataTable(code_data, filter) {

        let data_table_filtered = [];
        if (db['public'][code_data]) {
            let is_includes = true;
            Object.entries(db['public'][code_data]).forEach(([key, value]) => {
                is_includes = true;
                filter.forEach(i_filter => {
                    if (!(i_filter.array_filter).includes(value[i_filter.field])) {
                        is_includes = false;
                        return;
                    }
                });
                if (is_includes) {
                    data_table_filtered.push(key)
                }
            });
        }

        return data_table_filtered;
    }

    function emmp(primary_key_data) {

        // let bg = '';
        // if (data_database['data_employee_out'][row.nik_employee]) {
        //     bg = 'bg-warning';
        // }

        //ini yang di kirim NRP
        try {
            KONSTANTA['table_code_perusahaan'] = 'PERUSAHAAN';
            KONSTANTA['table_code_karyawan'] = 'KARYAWAN';
            KONSTANTA['table_code_DEPARTEMEN'] = 'DEPARTEMEN';
            KONSTANTA['table_code_DIVISI'] = 'DIVISI';
            KONSTANTA['table_code_JABATAN'] = 'JABATAN';
            KONSTANTA['table_code_PROJECT'] = 'PROJECT';
            KONSTANTA['table_code_NAMA'] = 'KARYAWAN';
            let data_employee = db['public'][KONSTANTA['table_code_karyawan']][primary_key_data];

            // conLog('data_employee', primary_key_data)
            let employee_detail = {};
            employee_detail['NRP'] = primary_key_data; //DESCRIPTION
            employee_detail['PERUSAHAAN'] = (db['public'][KONSTANTA['table_code_perusahaan']][data_employee[
                'PERUSAHAAN']]['NAMA-PERUSAHAAN-PENDEK']) ? db['public'][KONSTANTA['table_code_perusahaan']][
                data_employee['PERUSAHAAN']
            ]['NAMA-PERUSAHAAN-PENDEK'] : "-";
            employee_detail['DEPARTEMEN'] = (db['public'][KONSTANTA['table_code_DEPARTEMEN']][data_employee[
                'DEPARTEMEN']]) ? db['public'][KONSTANTA['table_code_DEPARTEMEN']][data_employee['DEPARTEMEN']][
                'DEPARTEMEN'
            ] : "-";
            employee_detail['DIVISI'] = (db['public'][KONSTANTA['table_code_DIVISI']][data_employee['DIVISI']]) ? db[
                'public'][KONSTANTA['table_code_DIVISI']][data_employee['DIVISI']]['DIVISI'] : "-";
            employee_detail['JABATAN'] = (db['public'][KONSTANTA['table_code_JABATAN']][data_employee['JABATAN']]) ? db[
                'public'][KONSTANTA['table_code_JABATAN']][data_employee['JABATAN']]['JABATAN'] : "-";
            employee_detail['PROJECT'] = (db['public']
                    [KONSTANTA['table_code_PROJECT']]
                    [data_employee['PROJECT']]) ?
                db['public']
                [KONSTANTA['table_code_PROJECT']]
                [data_employee['PROJECT']]
                ['NAMA-PROJECT-PENDEK'] : "-";

            //  conLog('employee_detail',employee_detail)
            return `
        <div  class="name-avatar d-flex align-items-center pr-2 card-box pl-2">
            <div class="avatar mr-2 flex-shrink-0">
                <img src="/vendors/images/photo5.jpg" class="border-radius-100 box-shadow"
                    width="50" height="50" alt="">
            </div>
            <div class="txt">
                <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                    style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">${employee_detail['PERUSAHAAN']} |
                    ${employee_detail['PROJECT']}|${employee_detail['DIVISI']}</span>
                <div class="font-14 weight-600">${data_employee['NAMA-KARYAWAN']}</div>
                <div class="font-12 weight-500">${primary_key_data}</div>
                <div class="font-12 weight-500" data-color="#b2b1b6" style="color: rgb(178, 177, 182);">
                    ${employee_detail['JABATAN']}
                </div>
            </div>
        </div>
    `;
        } catch (error) {
            return null;
        }

    }

    function showFieldData(type_data, table_data, field_data, primary_key_data, data_properties = null) {
        let value_data_table;

        // conLog('data_source', data_source);
        // conLog('primary_key_data', primary_key_data);
        // // conLog('code_table_data_source', code_table_data_source);
        // // conLog('field_get_data_source', field_get_data_source);
        // conLog('table_data', table_data);
        // conLog('field_data', field_data);
        // conLog('satu', db['public'][table_data])

        // CL(data_properties);
        if (!GLOBAL_DATA_EXPORT['data']) {
            GLOBAL_DATA_EXPORT['data'] = {};
        }

        if (!GLOBAL_DATA_EXPORT['data'][primary_key_data]) {
            GLOBAL_DATA_EXPORT['data'][primary_key_data] = {};
        }

        if (!GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data]) {
            GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = {};
        }

        if (field_data == KONSTANTA['tb_karyawan']) {
            GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = db['public']['public_value']['KARYAWAN'][
                primary_key_data
            ]['NRP'];
            return emmp(primary_key_data);
        }

        if (type_data == 'TEXT') {
            value_data_table = (db['db']['database_data'][table_data][primary_key_data]) ? db['db']['database_data'][
                table_data
            ][primary_key_data][
                field_data
            ][
                'value_data'
            ] : null;

            GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = value_data_table;
            return value_data_table;
        }
        // conLog(field_data, primary_key_data);
        switch (type_data) {
            case 'DARI-TABEL':
                let full_code_field = table_data + "-" + field_data;
                let data_field_returned = primary_key_data;


                if (db['db']['database_data_source'][full_code_field]) {
                    let data_source = db['db']['database_data_source'][full_code_field];
                    let code_table_data_source = data_source['table_data_source'];
                    let field_get_data_source = data_source['field_get_data_source'];


                    //table, to get primary,
                    // conLog('data_source', data_source);

                    // conLog('code_table_data_source', code_table_data_source);
                    // conLog('field_get_data_source', field_get_data_source);
                    // conLog('table_data', table_data);
                    // conLog('field_data', field_data);
                    // conLog('satu', db['public'][table_data])
                    if (!db['public'][table_data]) {
                        value_data_table = null;
                    } else {
                        value_data_table = (db['public'][table_data][primary_key_data]) ? db['public'][table_data][
                            primary_key_data
                        ][
                            field_data
                        ] : null;

                        value_data_table = (db['db']['database_data'][table_data][primary_key_data][field_data][
                            'value_data'
                        ]) ? toUUID(db['db']['database_data'][table_data][primary_key_data][field_data][
                            'value_data'
                        ]) : null;
                        if (value_data_table) {
                            // conLog('base data', toUUID(value_data_table)); //[][field_get_data_source]['value_data']
                            try {
                                if (field_get_data_source == KONSTANTA['tb_karyawan']) {
                                    GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = db['public'][
                                        'public_value'
                                    ]['KARYAWAN'][primary_key_data]['NRP'];
                                    return emmp(toUUID(value_data_table));
                                    break;
                                }
                                value_data_table = data_field_returned = db['public'][code_table_data_source][
                                    toUUID(value_data_table)
                                ][
                                    field_get_data_source
                                ];
                            } catch (error) {
                                value_data_table = null;
                            }
                        }
                    }
                    GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = value_data_table;
                }
                return data_field_returned;
                break;
            case 'COLOR':
                let datas = primary_key_data ? primary_key_data : '-';
                let color = primary_key_data ? primary_key_data : '#ffffff';
                value_data_table = (db['db']['database_data'][table_data][primary_key_data]) ? db['db'][
                        'database_data'
                    ]
                    [table_data][primary_key_data][
                        field_data
                    ][
                        'value_data'
                    ] : null;
                GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = value_data_table;
                return `<div class="font-12 text-center" width="100px" 
                                style="background-color: ${value_data_table};">
                                ${value_data_table}
                            </div>
                            `;
                break;
            case 'DETAIL_ABSENSI':
                GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = primary_key_data;
                return `<div class="row justify-content-md-center">
                                    <div class="col-12 justify-content-md-center"><sup>09</sup></div>
                                    <div class="col-12 justify-content-md-center">
                                        
                                        <div type="button" name="status_absen_uuid" class="bg-primary" id="status_absen_uuid-text-2024-04-09-MBLE-210493">
                                            <sup>09</sup> OFF                                            
                                        </div>   
                                    </div>
                                </div>`;
                return `<div class="row">
                            <div class="col-2 row" style="background-color: #e7fd00;">
                                <div class="card-box col-md-6 col-sm-6" style="background-color: #e7fd00;">
                                    <h6>DS</h6>
                                </div>
                                <div class="card-box col-md-6 col-sm-6 row" style="background-color: #f90606;">
                                    <span class="badge badge-pill badge-sm col-12 badge-primary">Sen</span>
                                    <span class="badge badge-pill badge-sm col-12 badge-warning">17-04</span>
                                </div>
                            </div>
                            <div class="col-2 row" style="background-color: #e7fd00;">
                                <div class="card-box col-md-6 col-sm-6" style="background-color: #e7fd00;">
                                    <h6>DS</h6>
                                </div>
                                <div class="card-box col-md-6 col-sm-6 row" style="background-color: #f90606;">
                                    <span class="badge badge-pill badge-sm col-12 badge-primary">Sen</span>
                                    <span class="badge badge-pill badge-sm col-12 badge-warning">17-04</span>
                                </div>
                            </div>
		                </div>
                        
                        `;
                break;
            case 'ABSENSI_COUNT':
                GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = primary_key_data;
                let count_absen_element = ``;
                let count_absensi = {};
                let element_count_absen = ``;
                let element_detail_absen = ``;
                let element_two_column =``;
                // conLog('data_properties', data_properties);
                if (data_properties) {
                    const startDate = new Date(filter_absensi.date_start);
                    const endDate = new Date(filter_absensi.date_end);



                    let currentDate = new Date(startDate);
                    while (currentDate <= endDate) {
                        let date_current = formatDate(currentDate);
                        let detail_absen_current_date = {
                            absen_description: null,
                            cek_log: '-',
                            color: "#544545",
                            date: date_current,
                            employee_uuid: null,
                            status_absen_uuid: "-",
                            uuid: null
                        }
                        if (data_properties[date_current]) {
                            detail_absen_current_date = data_properties[date_current];
                        }else{
                            detail_absensi[primary_key_data][date_current] = detail_absen_current_date;
                        }
                        let obj_current_date = getDateObj(currentDate);
                        // console.log(detail_absen_current_date);
                        if(count_absensi[detail_absen_current_date.status_absen_uuid]){
                            count_absensi[detail_absen_current_date.status_absen_uuid]++;
                        }else{
                            count_absensi[detail_absen_current_date.status_absen_uuid] = 1;
                        }
                        element_detail_absen += `<div id="element_absen-${primary_key_data}-${date_current}" class="col-auto mb-1">
                                                    <div onclick="manageAbsensiDay('${primary_key_data}', '${date_current}')" style=" background-color: ${db['public']['DATABASE-ABSENSI'][detail_absen_current_date.status_absen_uuid]['WARNA-ABSENSI']}" class="name-avatar d-flex align-items-center pr-2 card-box pl-2">
                                                        <div class="txt text-center">
                                                            <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                                style=" background-color: rgb(231, 235, 245);">${getFirstCharDay(currentDate)} ${obj_current_date.day}-${obj_current_date.month}</span>
                                                            <div class="font-14  weight-600">${detail_absen_current_date.status_absen_uuid}</div>
                                                        </div>
                                                    </div>
                                                </div>`;

                        // Move to the next day
                        currentDate.setDate(currentDate.getDate() + 1);
                    }
                    Object.entries(count_absensi).forEach(([key,values]) => {
                        element_count_absen += `<div class="col-auto mb-1">
                                                    <button style=" background-color: ${db['public']['DATABASE-ABSENSI'][key]['WARNA-ABSENSI']}" class="btn font-14  weight-600 ">${key} : ${values}</button>
                                                </div>`;
                    });
                    element_two_column = `<div class="col-md-2 col-sm-12">
                                    <div class="row">
                                        ${element_count_absen}
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 row ">
                                    ${element_detail_absen}
                                </div>`;

                } else {
                    element_two_column = ` <div class="col-md-9 col-sm-12"> 
                                            <div class="alert alert-secondary" role="alert">
                                                Data tidak ditemukan.
                                            </div>
                                        </div>`;
                }
                return `    <div id="row-absensi-${primary_key_data}" class="row justify-content-md-center">
                                <div class="col-md-3 col-sm-12 mb-2">
                                    ${emmp(primary_key_data)}
                                </div>
                                ${element_two_column}
                                
                            </div>
                        `;
                break;
            default:
                let xxx = null;
                try {
                    xxx = db['db']['database_data'][table_data][primary_key_data][
                        field_data
                    ][
                        'value_data'
                    ];
                } catch (error) {
                    xxx = primary_key_data;
                }

                GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = xxx;

                return xxx;
        }

    }

    // =============================================================================================================== END DATABASE DATATABLE==

    function getDateToday() {
        // console.log('getDateToday')
        let date_now = new Date();
        let day = padToDigits(2, date_now.getDate());
        let month = padToDigits(2, date_now.getMonth() + 1);
        let year = date_now.getFullYear();

        let today = year + '-' + month + '-' + day;
        return today;
    }

    function addDays(date, days) {
        date.setDate(date.getDate() + days);
        return date;
    }

    function setRangeDate(date_start, date_end) {
        let dateTanggalWaktuBerangkat = new Date(date_start)
        let day = padToDigits(2, dateTanggalWaktuBerangkat.getDate());
        let month = padToDigits(2, dateTanggalWaktuBerangkat.getMonth() + 1);
        let year = dateTanggalWaktuBerangkat.getFullYear();
        let stringDateStart = `${month}/${day}/${year}`;

        let dateEnd = new Date(date_end)
        let day_end = padToDigits(2, dateEnd.getDate());
        let month_end = padToDigits(2, dateEnd.getMonth() + 1);
        let year_end = dateEnd.getFullYear();
        let stringDateEnd = `${month_end}/${day_end}/${year_end}`;
        let range = `${stringDateStart} - ${stringDateEnd}`;
        return range;
    }

    function dateToString(the_date) {
        let dateTanggalWaktuBerangkat = new Date(the_date)
        let day = padToDigits(2, dateTanggalWaktuBerangkat.getDate());
        let month = padToDigits(2, dateTanggalWaktuBerangkat.getMonth() + 1);
        let year = dateTanggalWaktuBerangkat.getFullYear();

        return `${day} ${months[dateTanggalWaktuBerangkat.getMonth() + 1]} ${year}`
    }

    function dateToTime(the_date) {
        var dateObject = new Date(the_date);
        var hours = dateObject.getHours();
        var minutes = dateObject.getMinutes();
        return padZero(hours) + ":" + padZero(minutes);
    }

    function parseDateString(dateString, format) {
        // Split the format string into parts
        var parts = format.split(/[^\w]+/);
        // Split the date string into corresponding parts
        var dateParts = dateString.split(/[^\w]+/);
        // Initialize variables to hold parsed date values
        var year, month, day;

        // Iterate over the format parts
        for (var i = 0; i < parts.length; i++) {
            // Check each part of the format
            switch (parts[i]) {
                case 'yyyy':
                case 'yy':
                    year = parseInt(dateParts[i], 10);
                    break;
                case 'mm':
                    month = parseInt(dateParts[i], 10) - 1; // Month is zero-based in JavaScript Date object
                    break;
                case 'dd':
                    day = parseInt(dateParts[i], 10);
                    break;
                    // Add more cases for other date components if needed
            }
        }

        // Create a Date object using the parsed values
        var date = new Date(year, month, day);

        // Check if the parsed date is valid
        if (!isNaN(date.getTime())) {
            return date;
        } else {
            return null; // Return null if the date string couldn't be parsed
        }
    }

    function getFirstCharDay(currentDate) {
        const daysOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        // Mendapatkan nama hari pada tanggal saat ini
        const currentDay = daysOfWeek[currentDate.getDay()];

        // Mengambil huruf pertama dari nama hari
        return firstLetterOfDay = currentDay.charAt(0);
    }

    function countBetweenDate(date_from, date_until) {
        var date1 = new Date(date_from); //from
        var date2 = new Date(date_until); //until

        var Difference_In_Time = date2.getTime() - date1.getTime();
        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
        return Difference_In_Days;
    }

    function formatDate(d) {

        var month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
        return [year, month, day].join('-');
    }

    function padZero(number) {
        return number < 10 ? "0" + number : number;
    }

    function toUUID(the_text) {
        const regex = /[^a-zA-Z0-9&]/g;
        // Ganti semua simbol dengan tanda dash ("-")
        const resultString = the_text.replace(regex, "-");
        return resultString.toUpperCase();
    }

    function setUIdate(param_ui_year = ui_dataset.ui_dataset.ui_date.year, param_ui_month = ui_dataset.ui_dataset
        .ui_date.month,
        param_ui_day = ui_dataset.ui_dataset.ui_date.day) {
        conLog('run function', 'setUIdate')
        if (param_ui_day == null) {
            param_ui_day = ui_dataset.ui_dataset.ui_date.day
        }
        if (param_ui_month == null) {
            param_ui_month = ui_dataset.ui_dataset.ui_date.month
        }
        if (param_ui_year == null) {
            param_ui_year = ui_dataset.ui_dataset.ui_date.year
        }
        ui_dataset.ui_dataset.ui_date = {
            "day": param_ui_day,
            "month": param_ui_month,
            "year": param_ui_year
        }
        setUImonthYear()
        localStorage.setItem('ui_dataset', JSON.stringify(ui_dataset));
    }

    function getEndDate(val_year, val_month) {
        var date = new Date(),
            y = val_year,
            m = val_month - 1;
        var lastDay = new Date(y, m + 1, 0);
        return lastDay;
    }

    function getDateTodayArr() {
        console.log('getDateToday')
        let date_now = new Date();
        let day = padToDigits(2, date_now.getDate());
        let month = padToDigits(2, date_now.getMonth() + 1);
        let year = date_now.getFullYear();

        let today = year + '-' + month + '-' + day;
        var arr = {
            "day": day,
            "month": month,
            "year": year
        };
        return arr;
    }

    function getDateObj(currentDate) {
        let date_now = currentDate;
        let day = padToDigits(2, date_now.getDate());
        let month = padToDigits(2, date_now.getMonth() + 1);
        let year = date_now.getFullYear();

        let today = year + '-' + month + '-' + day;
        var arr = {
            "day": day,
            "month": month,
            "year": year
        };
        return arr;
    }

    function getEndDate(val_year, val_month) {
        var date = new Date(),
            y = val_year,
            m = val_month - 1;
        var lastDay = new Date(y, m + 1, 0);
        return lastDay;
    }

    function getFirstDate(val_year, val_month) {
        var date = new Date(),
            y = val_year,
            m = val_month - 1;
        var firstDay = new Date(y, m, 1);
        return firstDay;
    }

    function setDateSession(year, month) {
        cg('set-date-session', arr_date_today);
        if (!arr_date_today) {
            arr_date_today = getDateTodayArr();
            $.ajax({
                url: '/support/set-date',
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    year: arr_date_today.year,
                    month: arr_date_today.month,
                },
                success: function(response) {
                    // $('#success-modal').modal('show')
                    cg('/support/set-date', response);
                    arr_date_today.day = response.data.day;
                    arr_date_today.month = response.data.month;
                    arr_date_today.year = response.data.year;
                    // cg('arr_data', arr_date_today);
                },
                error: function(response) {
                    alertModal()
                }
            });
            cg('when not', arr_date_today);
        } else {
            if (year == arr_date_today.year && parseInt(month) == parseInt(arr_date_today.month)) {
                cg('same', 'same');
            } else {
                $.ajax({
                    url: '/support/set-date',
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        year: arr_date_today.year,
                        month: arr_date_today.month,
                    },
                    success: function(response) {
                        // $('#success-modal').modal('show')
                        cg('/support/set-date', response);
                        arr_date_today.day = response.data.day;
                        arr_date_today.month = response.data.month;
                        arr_date_today.year = response.data.year;
                        // cg('arr_data', arr_date_today);
                    },
                    error: function(response) {
                        alertModal()
                    }
                });
            }
        }
    }

    async function deleteForm(id_form) {
        conLog('id delete', id_form);
        $('#code_data_delete').val(id_form);
        $('#confirm-modal-async').modal('show');
    }

    function conLog(identify, data) {
        //  console.log("============================================================");
        console.log(identify);
        console.log(data);
        //  console.log("============================================================");
    }

    function padToDigits(much, num) {
        // console.log('padToDigits')
        return num.toString().padStart(much, '0');
    }

    function getLocalStorage(key) {
        if (!localStorage.getItem(key)) {
            return null;
        } else {
            return localStorage.getItem(key);
        }
    }

    function setUImonthYear() {
        $('#btn-year').html(ui_dataset.ui_dataset.ui_date.year);
        $('#btn-month').html(months[parseInt(ui_dataset.ui_dataset.ui_date.month)]);
        //$('#btn-month').val(arr_date_today.month);
    }

    function isRequiredCreate(id) {
        var err = 0;

        id.forEach(element => {
            if ($('#' + element).val() == "") {
                console.log(element)
                $('#req-' + element).remove();
                $('#' + element).after(` <code id="req-${element}">Data tidak boleh kosong</code>`);
                err++
            } else {
                $('#req-' + element).remove()
            }
        });
        return err;
    }

    function ajaxGet(dataUrl) {
        $.ajax({
            url: dataUrl,
            type: "GET",
            success: function(data) {
                conLog('success ajaxGet', data)
            }
        });
    }

    function capitalizeEachWord(str) {
        return str.replace(/\b\w/g, function(match) {
            return match.toUpperCase();
        });
    }



    // ================================= UI
    function stopLoading() {
        console.log('stop loading')
        $('#loading-modal').hide()
        $('.modal').modal('hide')
    }

    function startLoading() {
        $('#loading-modal').modal('show')
    }

    function showModalSuccess(data) {
        $('#success-modal').modal('show');
    }

    function setValueInput(idElement, valElement) {
        $(`#${idElement}`).val(valElement);
    }

    function getInputValue(idElement) {
        return $(`#${idElement}`).val();
    }
</script>

{{-- LOCAL STORAGE --}}
<script>
    async function refreshSession() {
        $.ajax({
            url: '/web/local-storage',
            type: "POST",
            headers: {
                'auth_login': ui_dataset.ui_dataset.user_authentication.auth_login
                // Add other custom headers if needed
            },
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response) {


                localStorage.setItem('DATABASE', JSON.stringify(response.data));
                db = response.data;
                CL('db');
                CL(db);
                conLog('ui_dataset', ui_dataset)
                // showModalSuccess();
            },
            error: function(response) {
                conLog('error', 'localStorage')
                conLog('error', response);
                stopLoading();
            }
        });
    }

    function setLocalStorage(key_local_storage, data_local_storage) {
        localStorage.setItem(key_local_storage, JSON.stringify(data_local_storage));
    }



    // ========================================================================= ABSENSI ================================
    var monthRomawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    var months = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];

    function getLetter(num) {
        var letter = String.fromCharCode(num + 64);
        return letter;
    }

    function monthName(month) {
        return months[parseInt(month)]
    }

    var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
    var end = new Date(arr_date_today.year, arr_date_today.month, 0);
    var date_today = new Date();
    if (date_today < end) {
        end = date_today;
    }

    let default_filter_absensi = {
        date_start: formatDate(start),
        date_end: formatDate(end),
        PERUSAHAAN: ui_dataset.ui_dataset.user_authentication.PERUSAHAAN,
        PROJECT: ui_dataset.ui_dataset.user_authentication.PROJECT,
        DEPARTEMEN: ui_dataset.ui_dataset.user_authentication.DEPARTEMEN,
        DIVISI: ui_dataset.ui_dataset.user_authentication.DIVISI,
        KARYAWAN: [],
    }
    // setLocalStorage('filter_absen', default_filter_absensi);
    let filter_absensi = {}
    if (getLocalStorage('filter_absen')) {
        filter_absensi = JSON.parse(getLocalStorage('filter_absen'));
    } else {
        setLocalStorage('filter_absen', default_filter_absensi);
        filter_absensi = default_filter_absensi;
    }
</script>
