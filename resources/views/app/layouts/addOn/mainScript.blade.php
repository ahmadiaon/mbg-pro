<!-- jsPDF and html2canvas -->
<script src="/src/scripts/jspdf.umd.min.js"></script>
<script src="/src/scripts/html2canvas.min.js"></script>

<script>
    // ========================================================================= ABSENSI ================================
    var monthRomawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    var months = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    let COLOR_BOOTSTRAP = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
    var monthRomawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    var months = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    var months_3_char = ["", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt",
        "Nov", "Des"
    ];


    var sort_day = {

    }
    let db = {};
    try {
        db = JSON.parse(localStorage.getItem('DATABASE'));
    } catch (error) {
        db = {};
    }

    let color_button = {
        alpa: 'danger',
        pay: 'primary',
        unpay: 'secondary',
        cut: 'warning'
    };

    let status_absen_short = '';
    let code_table_reference = '';
    let code_table_global = '';
    let data_persetujuan;
    let detail_absensi;

    let data_ketidakhadiran = {};
    let data_data_persetujuan = {};

    let filter_absensi = {}


    const KONSTANTA = [];
    KONSTANTA['tb_karyawan'] = 'NRP';
    KONSTANTA['PAGE'] = 'ADMIN';
    KONSTANTA['Input Autocomplite'] = 'INPUT-AUTOCOMPLITE';
    KONSTANTA['Input Autocomplite'] = 'INPUT-AUTOCOMPLITE';
    KONSTANTA['PHK-KARYAWAN'] = 'PHK-KARYAWAN';
    KONSTANTA['DATABASE-JENIS-IZIN'] = 'DATABASE-JENIS-IZIN';
    var name_days_sort = new Array(7);
    name_days_sort[0] = "Mig";
    name_days_sort[1] = "Sen";
    name_days_sort[2] = "Sel";
    name_days_sort[3] = "Rab";
    name_days_sort[4] = "Kam";
    name_days_sort[5] = "Jum";
    name_days_sort[6] = "Sab";

    let loading_e = `<div class="loading-content text-center">
                        <div class="loading-content d-flex justify-content-center align-items-center" style="height: 100px;">
                            <div class="text-center">
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
                        </div>
                    </div>`;

    let GLOBAL_DATA_EXPORT = {};

    let ui_dataset = {
        ui_dataset: {
            ui_date: null,
            user_authentication: null
        }
    }

    let default_filter_absensi = {
        date_start: null,
        date_end: null,
        statusKaryawan: ['AKTIVE', 'PHK-BULAN-INI'],
        PERUSAHAAN: [],
        PROJECT: [],
        DEPARTEMEN: [],
        DIVISI: [],
        KARYAWAN: [],
        JABATAN: [],
    }

    let arr_date_today = {};

    if (JSON.parse(localStorage.getItem('arr_date_today')) != null) {
        // conLog('arr_date_today have local storage from local ', JSON.parse(localStorage.getItem('arr_date_today')));
        arr_date_today = JSON.parse(localStorage.getItem('arr_date_today'));
        // conLog('arr_date_today have local storage ', arr_date_today);
    }

    if (Object.keys(arr_date_today).length == 0) {
        let date_today_new = getDateTodayArr();
        // conLog('date_today_new', date_today_new);
        setDateSession(date_today_new.year, date_today_new.month);
    }

    if (localStorage.getItem('default_filter_absensi')) {
        default_filter_absensi = getLocalStorage('default_filter_absensi');
        conLog('default_filter_absensi dari local', default_filter_absensi)
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


    var start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
    var end = new Date(arr_date_today.year, arr_date_today.month, 0);
    var date_today = new Date();
    if (date_today < end) {
        end = date_today;
    }






    startLoading();

    function setLocalStorage(key_local_storage, data_local_storage) {
        localStorage.setItem(key_local_storage, JSON.stringify(data_local_storage));
    }


    function CL(data_string) {
        console.log(data_string);
    }

    function cg(message, data) {
        console.log(message + ':');
        console.log(data);
    }

    function getDayAbbreviation(dateString) {
        const date = new Date(dateString);
        const options = {
            weekday: 'short'
        }; // Mendapatkan 3 huruf dari nama hari
        return date.toLocaleDateString('id-ID', options);
    }

    function getDateOnly(dateString) {
        const date = new Date(dateString);
        return date.getDate();
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
        // conLog('inp', inp);
        // conLog('arr', arr);
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
        conLog('filter', filter)
        let data_table_filtered = [];
        if (db['public'][code_data]) {
            let is_includes = true;
            Object.entries(db['public'][code_data]).forEach(([key, value]) => {
                is_includes = true;
                filter.forEach(i_filter => {
                    // conLog('i_filter.array_filter', i_filter.array_filter);                    
                    // conLog('value[i_filter.field]', value[i_filter.field]);
                    // conLog('data_table_filtered',data_table_filtered)
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
            let bg_status_employee = 'light'
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
            bg_status_employee = (data_employee['TANGGAL-BERAKHIR-KONTRAK--TBK-']) ? 'warning' : 'light';

            //  conLog('employee_detail',employee_detail)
            return `
                    <div  class="name-avatar bg-${bg_status_employee} d-flex align-items-center pr-2 card-box pl-2">
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
            return primary_key_data;
        }

    }

    function getValueData(primary_key, code_table, field) {
        try {
            return db['db']['database_data'][code_table][primary_key][field];
        } catch (error) {
            return null;
        }

    }

    function getPublicData(id_element, primary_key, field) {

    }

    function manageAbsensiDay(employee_uuid, date_absen) {
        $('#name-date').text(`Absen Tanggal ${date_absen}`);
        try {
            $('#absen_description-show').val(detail_absensi[employee_uuid][date_absen][
                'absen_description'
            ]);
        } catch (error) {
            $('#absen_description-show').val("-");
        }


        if (!(ui_dataset.ui_dataset.user_authentication.feature).includes('HR')) {
            $('.feature-HR').hide();
        }
        // $('#date-edit-live').val(`${date_value}`);
        // let cek_log = '-';
        // if (typeof(data_datatable[employee_uuid]['data'][date_value]) != 'undefined') {
        //     cek_log = data_datatable[employee_uuid]['data'][date_value]['cek_log'];
        // }

        // $('#button-status_absen_uuid').empty();
        let ceklog = '-';
        try {
            ceklog = detail_absensi[employee_uuid][date_absen]['cek_log'];
        } catch (error) {}

        $('#employee_uuid-show').val(`${employee_uuid}`);
        $('#date-show').val(`${date_absen}`);
        $('.cek_log-show').val(`${ceklog}`);
        $('#modal-show-fingger').modal('show');
    }

    function showFieldData(type_data, table_data, field_data, primary_key_data, data_properties = null) {
        let value_data_table;


        // conLog('data_properties', data_properties);

        // conLogs('primary_key_data', primary_key_data);
        // conLog('code_table_data_source', code_table_data_source);
        // conLog('field_get_data_source', field_get_data_source);
        // conLogs('table_data', table_data);
        // conLogs('field_data', field_data);
        // conLogs('type_data', type_data);
        // conLog('satu', db['db']['database_data'][
        //     table_data
        // ])

        try {
            value_data_table = db['db']['database_data'][
                table_data
            ][primary_key_data][
                field_data
            ][
                'value_data'
            ];
        } catch (error) {
            value_data_table = null;
        }

        if (type_data == 'TEXT') {
            if (field_data == KONSTANTA['tb_karyawan']) {

                // try {
                // GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = db['public']['public_value']['KARYAWAN'][
                //     primary_key_data
                // ]['NRP'];
                return emmp(primary_key_data);
                // } catch (error) {
                //     return `-${primary_key_data}`;
                // }

            }
            value_data_table = (db['db']['database_data'][table_data][primary_key_data]) ? db['db']['database_data'][
                table_data
            ][primary_key_data][
                field_data
            ][
                'value_data'
            ] : null;

            // GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = value_data_table;
            return value_data_table;
        }


        let full_code_field = table_data + "-" + field_data;
        let data_field_returned = primary_key_data;
        // conLog('full_code_field', full_code_field);
        switch (type_data) {
            case 'NOMINAL-UANG':
                value_data_table = (db['db']['database_data'][table_data][primary_key_data]) ? db['db']['database_data']
                    [
                        table_data
                    ][primary_key_data][
                        field_data
                    ][
                        'value_data'
                    ] : null;

                // GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = toValueRupiah(value_data_table);
                return toValueRupiah(value_data_table);
                break;
            case 'DARI-TABEL':



                if (db['db']['database_data_source'][full_code_field]) {
                    let data_source = db['db']['database_data_source'][full_code_field];
                    let code_table_data_source = data_source['table_data_source'];
                    let field_get_data_source = data_source['field_get_data_source'];



                    try {
                        value_data_table = (db['public'][table_data][primary_key_data]) ? db['public'][table_data][
                            primary_key_data
                        ][
                            field_data
                        ] : null;
                    } catch (error) {
                        return primary_key_data;
                    }
                    //table, to get primary,
                    // conLog('primary_key_data', primary_key_data);

                    // conLog('code_table_data_source', code_table_data_source);
                    // conLog('field_get_data_source', field_get_data_source);
                    // conLog('table_data', table_data);
                    // conLog('field_data', field_data);
                    // conLog('satu', value_data_table)
                    // conLog('satu', db['public'][table_data])
                    if (!value_data_table) {
                        value_data_table = null;
                    } else {


                        // value_data_table = (db['public'][table_data][primary_key_data]) ? db['public'][table_data][
                        //     primary_key_data
                        // ][
                        //     field_data
                        // ] : null;


                        // conLog('KE DARI TABLE value_data_table', value_data_table);
                        // value_data_table = (db['db']['database_data'][table_data][primary_key_data][field_data][
                        //     'value_data'
                        // ]) ? toUUID(db['db']['database_data'][table_data][primary_key_data][field_data][
                        //     'value_data'
                        // ]) : null;
                        if (value_data_table) {

                            // conLog('DATATABLE', value_data_table);
                            // conLog('base data', toUUID(value_data_table)); //[][field_get_data_source]['value_data']
                            // try {
                            if (code_table_data_source == 'KARYAWAN') {

                                // GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = db['public'][
                                //     'public_value'
                                // ]['KARYAWAN'][value_data_table]['NRP'];
                                // conLog('MASUK', GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data]);
                                return emmp(toUUID(value_data_table));
                                break;
                            }
                            // conLog('primary_key_data', primary_key_data);
                            // conLog('value_data_table_first', value_data_table);

                            try {
                                value_data_table = data_field_returned = db['public'][code_table_data_source][
                                    toUUID(value_data_table)
                                ][
                                    field_get_data_source
                                ];
                            } catch (error) {
                                value_data_table = null;
                            }


                            // conLog('value_data_table_second', value_data_table);
                            // } catch (error) {
                            //     value_data_table = null;
                            // }
                        }
                    }
                    // GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = value_data_table;
                }
                return data_field_returned;
                break;
            case 'INPUT-AUTOCOMPLITE':



                if (db['db']['database_data_source'][full_code_field]) {
                    let data_source = db['db']['database_data_source'][full_code_field];
                    let code_table_data_source = data_source['table_data_source'];
                    let field_get_data_source = data_source['field_get_data_source'];


                    //table, to get primary,
                    // conLog('primary_key_data', primary_key_data);

                    // conLog('code_table_data_source', code_table_data_source);
                    // conLog('field_get_data_source', field_get_data_source);
                    // conLog('table_data', table_data);
                    // conLog('field_data', field_data);
                    // conLog('satu', db['public'][code_table_data_source])
                    if (!db['public'][code_table_data_source]) {
                        value_data_table = null;
                    } else {
                        value_data_table = (db['public'][code_table_data_source][primary_key_data]) ? db['public'][
                            code_table_data_source
                        ][
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

                            // conLog('DATATABLE', value_data_table);
                            // conLog('base data', toUUID(value_data_table)); //[][field_get_data_source]['value_data']
                            // try {
                            if (code_table_data_source == 'KARYAWAN') {

                                // GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = db['public'][
                                //     'public_value'
                                // ]['KARYAWAN'][value_data_table]['NRP'];
                                // conLog('MASUK', GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data]);
                                return emmp(toUUID(value_data_table));
                                break;
                            }
                            // conLog('primary_key_data', primary_key_data);
                            // conLog('value_data_table_first', value_data_table);

                            value_data_table = data_field_returned = db['public'][code_table_data_source][
                                toUUID(value_data_table)
                            ][
                                field_get_data_source
                            ];

                            // conLog('value_data_table_second', value_data_table);
                            // } catch (error) {
                            //     value_data_table = null;
                            // }
                        }
                    }
                    // GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = value_data_table;
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
                // GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = value_data_table;
                return `<div class="font-12 text-center" width="100px" 
                                style="background-color: ${value_data_table};">
                                ${value_data_table}
                            </div>
                            `;
                break;
            case 'DETAIL_ABSENSI':
                // GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = primary_key_data;
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
                // GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = primary_key_data;
                let count_absen_element = ``;
                let count_absensi = {};
                let element_count_absen = ``;
                let element_detail_absen = ``;
                let element_two_column = ``;
                // conLog('data_properties', data_properties);
                // if (data_properties) {
                const startDate = new Date(default_filter_absensi.date_start);
                const endDate = new Date(default_filter_absensi.date_end);



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
                    try {
                        if (data_properties[date_current]) {
                            detail_absen_current_date = data_properties[date_current];
                        }
                    } catch (error) {
                        try {
                            detail_absensi[primary_key_data][date_current] = detail_absen_current_date;
                        } catch (error) {
                            try {
                                detail_absensi[primary_key_data] = {};
                                detail_absensi[primary_key_data][date_current] = detail_absen_current_date;

                            } catch (error) {
                                detail_absensi = {};
                                detail_absensi[primary_key_data] = {};
                                detail_absensi[primary_key_data][date_current] = detail_absen_current_date;

                            }
                        }
                    }
                    let obj_current_date = getDateObj(currentDate);
                    if (count_absensi[detail_absen_current_date.status_absen_uuid] >= 1) {
                        count_absensi[detail_absen_current_date.status_absen_uuid]++;
                    } else {
                        count_absensi[detail_absen_current_date.status_absen_uuid] = 1;
                    }
                    // console.log(detail_absen_current_date.status_absen_uuid);
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
                Object.entries(count_absensi).forEach(([key, values]) => {
                    element_count_absen += `<div class="col-auto mb-1">
                                                    <span class="badge" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                                            style=" background-color: ${db['public']['DATABASE-ABSENSI'][key]['WARNA-ABSENSI']};">
                                                               ${key} : ${values}
                                                    </span></div>`;
                });
                element_count_absen += `<div class="col-12 mb-1">
                                            <button onclick="detailAbsensi('${primary_key_data}')" type="button" id="btn-toggle-absenn-${primary_key_data}"
                                                class="btn btn-sm btn-primary">
                                                detail
                                            </button>
                                        </div>`;
                element_two_column = `  <div class="col-md-2 col-sm-12">
                                            <div class="row">
                                                ${element_count_absen}
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-12 row detail-absensi-${primary_key_data} ">
                                            ${element_detail_absen}
                                        </div>`;


                return `    <div id="row-absensi-${primary_key_data}" class="row justify-content-md-center">
                                <div class="col-md-3 col-sm-12 mb-2">
                                    ${emmp(primary_key_data)}
                                </div>
                                ${element_two_column}
                                
                            </div>
                        `;
                break;

            case 'GABUNGAN':
                // GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = primary_key_data;
                return primary_key_data;
                break;
            case 'DATE':
                // GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = value_data_table;
                if (value_data_table) {
                    return toShortStringDate_fromFormatDate(value_data_table);
                }
                return value_data_table;
                break;
            case 'FILE':
                if (value_data_table) {
                    return `
                    <button onclick="showDocument('${value_data_table}')" type="button" class="btn btn-light" >
                        <i class="bi bi-file-earmark-play-fill"></i>
                    </button>`;
                }
                return value_data_table;
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

                // GLOBAL_DATA_EXPORT['data'][primary_key_data][field_data] = xxx;

                return xxx;
        }
    }

    function processingAbsensi() {

        let countAbsensiEachStatusAbsen = {};
        Object.keys(db['public']['DATABASE-ABSENSI']).forEach(I_KeysDatabaseAbsen => {
            countAbsensiEachStatusAbsen[I_KeysDatabaseAbsen] = 0;
        });

        if (detail_absensi) {
            (default_filter_absensi.KARYAWAN).forEach(I_NRP => {
                if (detail_absensi[I_NRP]) {
                    Object.values(detail_absensi[I_NRP]).forEach(I_data_absensi => {
                        countAbsensiEachStatusAbsen[I_data_absensi['status_absen_uuid']] = parseInt(
                                countAbsensiEachStatusAbsen[I_data_absensi['status_absen_uuid']], 10) +
                            1;
                    });
                }
            });

        }
        let for_grafik_count_absensi = [];

        for (const key in countAbsensiEachStatusAbsen) {
            if (countAbsensiEachStatusAbsen[key] === 0) {
                delete countAbsensiEachStatusAbsen[key];
            }
        }

        Object.entries(countAbsensiEachStatusAbsen).forEach(([I_Key_countAbsensiEachStatusAbsen,
            data_countAbsensiEachStatusAbsen
        ]) => {
            let data_count_absensi_for_grafik = {
                name: I_Key_countAbsensiEachStatusAbsen,
                data: [data_countAbsensiEachStatusAbsen]
            }
            for_grafik_count_absensi.push(data_count_absensi_for_grafik);
        });




        return {
            label: Object.keys(countAbsensiEachStatusAbsen),
            data: for_grafik_count_absensi
        };
    }

    function simpleAbsensi(code_data) {
        $(`#btn-toggle-absenn-${code_data}`).text('detail');
        $(`#btn-toggle-absenn-${code_data}`).attr('onclick', `detailAbsensi('${code_data}')`);

        $(`.detail-absensi-${code_data}`).empty();

        let element_detail_absen = ``;
        let data_properties = detail_absensi[code_data];
        const startDate = new Date(default_filter_absensi.date_start);
        const endDate = new Date(default_filter_absensi.date_end);
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
            }

            let obj_current_date = getDateObj(currentDate);
            element_detail_absen += `<div id="element_absen-${code_data}-${date_current}" class="col-auto mb-1">
                                                    <div onclick="manageAbsensiDay('${code_data}', '${date_current}')" style=" background-color: ${db['public']['DATABASE-ABSENSI'][detail_absen_current_date.status_absen_uuid]['WARNA-ABSENSI']}" class="name-avatar d-flex align-items-center pr-2 card-box pl-2">
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

        let e_datatable_table_detail = ``;
        $(`.detail-absensi-${code_data}`).append(element_detail_absen);
    }

    function detailAbsensi(code_data) {
        $(`#btn-toggle-absenn-${code_data}`).text('simple');
        $(`#btn-toggle-absenn-${code_data}`).attr('onclick', `simpleAbsensi('${code_data}')`);
        let data_properties = null;
        try {
            data_properties = detail_absensi[code_data];
        } catch (error) {

        }


        const startDate = new Date(default_filter_absensi.date_start);
        const endDate = new Date(default_filter_absensi.date_end);

        let currentDate = new Date(startDate);
        $(`.detail-absensi-${code_data}`).empty();
        let data_code_data_absensi = [];
        let data_detail_absen_current_date = {};

        while (currentDate <= endDate) {
            let date_current = formatDate(currentDate);
            data_code_data_absensi.push(formatDate(currentDate))
            let detail_absen_current_date = {
                absen_description: null,
                cek_log: '-',
                color: "#544545",
                date: date_current,
                employee_uuid: null,
                status_absen_uuid: "-",
                uuid: null
            }
            try {
                if (data_properties[date_current]) {
                    detail_absen_current_date = data_properties[date_current];
                }
            } catch (error) {
                try {
                    detail_absensi[code_data][date_current] = detail_absen_current_date;
                } catch (error) {
                    try {
                        detail_absensi[code_data] = {};
                        detail_absensi[code_data][date_current] = detail_absen_current_date;

                    } catch (error) {
                        detail_absensi = {};
                        detail_absensi[code_data] = {};
                        detail_absensi[code_data][date_current] = detail_absen_current_date;

                    }

                }

            }

            data_detail_absen_current_date[formatDate(currentDate)] = detail_absen_current_date;
            currentDate.setDate(currentDate.getDate() + 1);
        }

        let row_data_datatable = [];
        let e_datatable_table_detail = `
                                        <div class="col-12 card-box" >
                                            <table  id="table-detail-absensi-data" class="" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th> DETAIL </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>`;


        $(`.detail-absensi-${code_data}`).append(e_datatable_table_detail);

        var element_card = {
            mRender: function(data, type, row) {
                let element_point_late = '';
                if ((ui_dataset.ui_dataset.user_authentication.feature).includes('HR')) {
                    element_point_late = `
                                        <div class="col-3 d-flex align-items-start">
                                            <small class="text-muted">
                                                P Late
                                            </small>
                                        </div>
                                        <div class="col-9">
                                            <small class="text-muted">
                                                ${data_detail_absen_current_date[row]['late_points']?(toValueRupiah(data_detail_absen_current_date[row]['late_points'] * 12500)):"-"}
                                            </small>
                                        </div>`;
                }

                let warna_bg_absensi = db['public']['DATABASE-ABSENSI'][data_detail_absen_current_date[row][
                    'status_absen_uuid'
                ]]['WARNA-ABSENSI'];
                return `<div class="row card-box mb-2">
                                <div class="col-md-3 col-sm-12 pd-20 text-center">
                                    <div class="card-box">
                                        <div class="font-14  weight-600">${getDayAbbreviation(row)}, ${getDateOnly(row)}</div>
                                        <div id="element_absen-BK-PL-220367-2024-10-02" class="col-auto mb-1">
                                            <div onclick="manageAbsensiDay('BK-PL-220367', '2024-10-02')"
                                                style=" background-color: ${warna_bg_absensi}"
                                                class="name-avatar mb-2 text-center btn ">
                                                <div class="txt text-center">
                                                    <h5>${data_detail_absen_current_date[row]['status_absen_uuid']}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12  pd-20">
                                    <div class="card-box pd-20">
                                        <div class="row name-avatar  pl-2">
                                            <div class="col-5">
                                                <small class="text-muted">
                                                    In
                                                </small>
                                            </div>
                                            <div class="col-7">
                                                <small class="text-muted">
                                                    <cite title="Source Title">${data_detail_absen_current_date[row]['entry']?data_detail_absen_current_date[row]['entry']:"-"}</cite>
                                                </small>
                                            </div>
                                            <div class="col-5 d-flex align-items-start">
                                                <small class="text-muted">
                                                    Mid
                                                </small>
                                            </div>
                                            <div class="col-7">
                                                <small class="text-muted">
                                                    <cite title="Source Title">${data_detail_absen_current_date[row]['mid']?data_detail_absen_current_date[row]['mid']:"-"}</cite>
                                                </small>
                                            </div>
                                            <div class="col-5 d-flex align-items-start">
                                                <small class="text-muted">
                                                    Out
                                                </small>
                                            </div>
                                            <div class="col-7 d-flex align-items-start">
                                                <small class="text-muted">
                                                    <cite class="text-wrap" title="Source Title">${data_detail_absen_current_date[row]['exit']?data_detail_absen_current_date[row]['exit']:"-"}</cite>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 pd-20">
                                    <div class="card-box pd-20">
                                        <div class="row name-avatar ">
                                            <div class="col-5">
                                                <small class="text-muted">
                                                    Work
                                                </small>
                                            </div>
                                            <div class="col-7">
                                                <small class="text-muted">
                                                    <cite title="Source Title">${data_detail_absen_current_date[row]['working_hours']?data_detail_absen_current_date[row]['working_hours']:"-"} h</cite>
                                                </small>
                                            </div>
                                            <div class="col-5 d-flex align-items-start">
                                                <small class="text-muted">
                                                    Late
                                                </small>
                                            </div>
                                            <div class="col-7">
                                                <small class="text-muted">
                                                    <cite title="Source Title">${data_detail_absen_current_date[row]['late_minutes']?data_detail_absen_current_date[row]['late_minutes']:"-"} m</cite>
                                                </small>
                                            </div>

                                            ${element_point_late}
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>`;
            }
        };
        row_data_datatable.push(element_card);

        let xxx = $('#table-detail-absensi-data').DataTable({
            scrollX: true,
            scrollY: "400px",
            paging: false,
            serverSide: false,
            ordering: false,
            data: data_code_data_absensi,
            columns: row_data_datatable
        });

    }

    function modalGeneralFilter() {

    }

    function cardFormField(id_field, data_field, is_disabled = '') {
        // if(ui_dataset.ui_dataset.user_authentication.GRADE ){

        // }
        // conLog('data_field', data_field);
        is_disabled = '';
        if (data_field.level_data_field == 1) {
            is_disabled = '';
        } else {
            is_disabled = 'disabled';
            if (ui_dataset.ui_dataset.user_authentication.FIELD_LEVEL >= 3) {
                is_disabled = '';
            }
        }

        let element_field = '';
        let element_input_field_ = ``;
        let data_source_this_field = db['db']['database_data_source'][
            `${data_field.code_table_field}-${data_field.code_field}`
        ];
        let element_option_data_source = ``;


        switch (data_field.type_data_field) {
            case 'TEXT':
                element_input_field_ =
                    `<input type="text" ${is_disabled} class="form-control ${id_field} ${data_field.code_field}" name="${data_field.code_field}" id="${data_field.code_table_field}-${data_field.code_field}">`;
                element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div id="form-${data_field.full_code_field}" class="form-group">
                                <label>${data_field.description_field}</label>
                                ${element_input_field_}
                            </div>
                        </div>`;
                $(`#${id_field}`).append(element_field)
                break;

            case 'FILE-PDF':
                element_input_field_ =
                    `<input type="file"  ${is_disabled} class="form-control ${id_field} ${data_field.code_field}" name="${data_field.code_field}" id="${data_field.code_table_field}-${data_field.code_field}">`;
                element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field}</label>
                                ${element_input_field_}
                            </div>
                        </div>`;
                $(`#${id_field}`).append(element_field)
                break;
                break;
            case 'FILE':
                element_input_field_ =
                    `<div class="row">
                        <div class="col-8">
                            <input type="file" accept=".pdf, image/*"  ${is_disabled} class="form-control ${id_field} ${data_field.code_table_field} file-${data_field.code_field}" name="${data_field.code_field}" id="${data_field.code_table_field}-${data_field.code_field}">
                        </div>
                        <div class="col-4">
                            <button hidden type="button" id="show-${data_field.code_table_field}-${data_field.code_field}" class="btn show-${data_field.code_field}" data-bgcolor="#00b489" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 180, 137);">
                                <i class="bi bi-file-earmark-play-fill"></i> lihat
                            </button>                            
                        </div>
                    </div>
                    `;
                element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field}</label>
                                ${element_input_field_}
                            </div>
                        </div>`;
                $(`#${id_field}`).append(element_field)
                break;
                break;
            case 'PERSETUJUAN':
                element_input_field_ =
                    `<input type="text" ${is_disabled} class="form-control ${id_field} ${data_field.code_field}" name="${data_field.code_field}" id="${data_field.code_table_field}-${data_field.code_field}">`;
                element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field}</label>
                                ${element_input_field_}
                            </div>
                        </div>`;
                $(`#${id_field}`).append(element_field);
                break;
            case 'DATETIME':
                element_input_field_ =
                    `<input type="text" ${is_disabled} class="form-control ${id_field} datetimepicker ${data_field.code_field}" name="${data_field.code_field}" id="${data_field.code_table_field}-${data_field.code_field}">`;
                element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field} datetime</label>
                                ${element_input_field_}
                            </div>
                        </div>`;
                $(`#${id_field}`).append(element_field)
                break;
                break;
            case 'NOMINAL-UANG':
                element_input_field_ =
                    `<input type="text" onfocus="toRupiah(this)" onkeyup="toRupiah(this)" ${is_disabled} class="form-control ${id_field} ${data_field.code_field}" name="${data_field.code_field}" id="${data_field.code_table_field}-${data_field.code_field}">`;
                element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field} UANF</label>
                                ${element_input_field_}
                            </div>
                        </div>`;
                $(`#${id_field}`).append(element_field)
                break;
                break;
            case 'REFERENCE':
                if (db['db']['database_field'][code_table_reference]) {
                    Object.entries(db['db']['database_field'][code_table_reference]).forEach(
                        ([key, data_data_source]) => {
                            element_option_data_source =
                                `${element_option_data_source} <option value="${key}">${data_data_source['description_field']}</option>`
                        });
                }

                element_input_field_ = `
                            <select ${is_disabled} style="width: 100%;" name="${data_field.code_field}" id="${data_field.full_code_field}" class="${data_field.code_field} custom-select2 ${id_field} form-control">
                                <option value="">Pilih Data</option>
                                ${element_option_data_source}
                            </select>
                        `;

                element_field = `
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>${data_field.description_field}</label>
                            ${element_input_field_}
                        </div>
                    </div>`;

                $(`#${id_field}`).append(element_field)
                $(`#${data_field.full_code_field}`).select2();
                break;
            case 'DARI-TABEL':
                let NRP = "-";
                if (db['db']['database_data'][data_source_this_field.table_data_source]) {
                    let db_data_FULL = db['public']['public_value'][data_source_this_field.table_data_source];
                    let db_data = [];
                    if (data_source_this_field.table_data_source == 'KARYAWAN') {
                        db_data = db['DEFAULT-FILTER']['FILTER']['KARYAWAN'];
                    } else {
                        db_data = Object.keys(db['db']['database_data'][data_source_this_field.table_data_source]);
                    }
                    /*
                        1. hanya departemenyna,
                        2. hanya apa yg di kelolanya,
                        3. yang punya lisensi saja
                        ('KARYAWAN','DEPARTEMEN', 'HRGA')
                        ('KARYAWAN','LISENCE', 'A'),
                        ('KARYAWAN','PROJECT', 'PT. MB'),

                        penggabungan 
                            UNIT => Code Jenis Unit (DT,DZ) + No. Lambung (003,004),
                            Karyawan => NRP | Nama | Jabatan

                        Array ini bisa di gabung,

                        [{
                            'nama field':value,
                            ''
                        },{}]
                    */
                    // conLog('data_source_this_field',data_source_this_field)
                    db_data.forEach(
                        key => {
                            element_option_data_source =
                                `${element_option_data_source} <option value="${key}">${db_data_FULL[key][data_source_this_field.field_get_data_source]}</option>`
                        });
                }

                element_input_field_ = `
                                                <select ${is_disabled} style="width: 100%;" name="${data_field.code_field}" id="${data_field.full_code_field}" class="${data_field.code_field} custom-select2 ${id_field} form-control">
                                                    <option value="">Pilih Data</option>
                                                    ${element_option_data_source}
                                                </select>
                                            `;

                element_field = `
                        <div id="form-${data_field.full_code_field}" class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field}</label>
                                ${element_input_field_}
                            </div>
                        </div>`;

                $(`#${id_field}`).append(element_field);
                $(`#${data_field.full_code_field}`).select2();

                break;
            case KONSTANTA['Input Autocomplite']:
                // conLog('data_field', data_field);
                if (is_disabled == 'disabled') {
                    element_input_field_ =
                        `<input type="text" ${is_disabled} class="form-control ${id_field} ${data_field.code_field}" name="${data_field.code_field}" id="${data_field.code_table_field}-${data_field.code_field}">`;
                    element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field}</label>
                                ${element_input_field_}
                            </div>
                        </div>`;
                    $(`#${id_field}`).append(element_field)
                    break;
                }

                element_input_field_ =

                    `
                        <input type="text" ${is_disabled} name="${data_field.code_field}" id="code-autocomplite-${data_field.code_table_field}-${data_field.code_field}">
                        <input type="text" ${is_disabled} name="description-${data_field.code_field}" class="${data_field.code_field} form-control ${id_field} db-text mb-30" onkeyup="changeInput('${data_field.code_table_field}-${data_field.code_field}')" style=" margin-bottom: 60px;"  id="${data_field.code_table_field}-${data_field.code_field}">`;
                element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group mb-20 h-500">
                                <label>${data_field.description_field}</label>
                                ${element_input_field_}
                            </div>
                        </div>`;
                $(`#${id_field}`).append(element_field)
                let db_text = [];
                if (db['db']['database_data'][data_source_this_field.table_data_source]) {
                    let field_get = db['db']['database_data_source'][data_field.full_code_field];
                    conLog('field_get', field_get);
                    let db_text_ob = Object.values(db['db']['database_data'][data_source_this_field.table_data_source]);
                    db_text_ob.forEach(element => {
                        conLog('element', element)
                        let item_autocomplite = {
                            code_data: toUUID(element[field_get.field_get_data_source]['value_data']),
                            value_data: element[field_get.field_get_data_source]['value_data'],
                        }
                        db_text.push(item_autocomplite);
                    });
                }
                CL(db_text)
                conLog('data_field.code_field', data_field.code_field)

                autocompleteNew(document.getElementById(`${data_field.code_table_field}-${data_field.code_field}`),
                    db_text, data_field.code_field);
                break;
            case 'COLOR':

                element_input_field_ =

                    `<input ${is_disabled} type="color" onchange="setColor('${data_field.code_table_field}-${data_field.code_field}')" class="form-control-color ${id_field} form-control" name="${data_field.code_field}" id="${data_field.code_table_field}-${data_field.code_field}" value="#f56767" />`;
                element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field}</label>
                                <div class="row">
                                    <div class="col-6">
                                        ${element_input_field_}
                                    </div>
                                    <div class="col-6">
                                        <input ${is_disabled} type="text" class="form-control ${id_field}" id="color-${data_field.code_table_field}-${data_field.code_field}" value="#f56767" />
                                    </div>
                                </div>                                
                            </div>
                        </div>`;
                $(`#${id_field}`).append(element_field)
                break;
            case 'DATE':
                element_input_field_ =
                    `<input type="date" ${is_disabled} class="form-control ${id_field} ${data_field.code_field}" name="${data_field.code_field}" id="${data_field.code_table_field}-${data_field.code_field}">`;
                element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div  id="form-${data_field.full_code_field}" class="form-group">
                                <label>${data_field.description_field}</label>
                                ${element_input_field_}
                            </div>
                        </div>`;
                $(`#${id_field}`).append(element_field)
                break;
            case 'hidden':
                element_input_field_ =
                    `<input type="text" ${is_disabled}  class="form-control ${id_field} secondary_key" name="${data_field.code_field}" id="${data_field.code_table_field}-${data_field.code_field}">`;
                element_field = `
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>${data_field.description_field}</label>
                                ${element_input_field_}
                            </div>
                        </div>`;
                $(`#${id_field}`).append(element_field)
                break;
            default:
                break;
        }


    }

    function createFormFieldTable(id_element, code_table) {
        $(`#${id_element}`).empty();
        $(`#${id_element}`).append(`
             <form autocomplete="off" id="FORM-${code_table}"  enctype="multipart/form-data">
                @csrf
                <input hidden type="text" name="code_table" value="${code_table}">
                <input hidden type="text" name="uuid_data" id="uuid_data" value="">
                

            </form>
        `);

        code_table_global = code_table;
        Object.values(db['db']['database_field'][code_table]).forEach(field => {
            cardFormField(`FORM-${code_table}`, field);
        });
        data_persetujuan;

        if (db['db']['database_persetujuan'][code_table]) {

            let db_persetujuan = db['db']['database_persetujuan'][code_table];
            data_persetujuan = db_persetujuan;
            $(`#FORM-${code_table}`).append(`
                    <div class="profile-info bg-light " id="persetujuan-FORM-${code_table}">
                        <div class="text-center">
                            <h6>PERSETUJUAN</h6>
                        </div>
                    </div>
            `);

            for (let countLevel = 1; countLevel <= Object.keys(db['db']['database_data']['DATABASE-LEVEL-PERSETUJUAN'])
                .length; countLevel++) {
                // const element = array[countLevel];
                // conLog('countLevel', countLevel);
                if (db_persetujuan[`LEVEL-${countLevel}`]) {

                    $(`#${code_table}-${db_persetujuan[`LEVEL-${countLevel}`]['reference']}`).attr('onchange',
                        `setValToFieldPersetujuan('${db_persetujuan[`LEVEL-${countLevel}`]['reference']}',this)`);

                    $(`#persetujuan-FORM-${code_table}`).append(`
                        <div class="form-group">
                            <label for="">${db['public']['public_value']['DESKRIPSI-PERSETUJUAN'][db_persetujuan[`LEVEL-${countLevel}`]['description']]['DESKRIPSI-PERSETUJUAN']}</label>
                            <div class="row">
                                <div class="col-9">
                                    <select style="width: 100%;" name="LEVEL-${countLevel}" id="persetujuan-LEVEL-${countLevel}" class="custom-select2 FORM-${code_table} form-control">
                                        
                                        
                                    </select>
                                </div>
                                <div class="col-3"  id="icon-persetujuan-LEVEL-${countLevel}">
                                    <button type="button" class="btn btn-secondary">
                                        <i class="icon-copy bi bi-clock-history"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `);
                }
            }
        }

        Object.values(db['db']['database_field'][code_table]).forEach(field => {
            if (field.code_field == 'NRP') {

                $(`#${field.full_code_field}`).val(ui_dataset.ui_dataset.user_authentication.employee_uuid)
                    .trigger('change');

                if (KONSTANTA['PAGE'] == 'SELF') {
                    conLog('NRP', KONSTANTA['PAGE']);
                    $(`#form-${field.full_code_field}`).hide();
                }
            }
        });



    }

    function setValToFieldPersetujuan(field_reference, value_this) {
        let value_reference = $(value_this).val();
        conLog('value_reference', value_reference);
        if (!value_reference) {
            value_reference = ui_dataset.ui_dataset.user_authentication.nik_employee;
        }

        Object.values(db['db']['database_persetujuan'][code_table_global]).forEach(data_item => {
            if (field_reference == data_item['reference']) {
                $(`#persetujuan-${data_item['level']}`).empty();
                let atasan = db['db']['arr_employees'][
                    'all_employees'
                ];
                let profile = db['public']['KARYAWAN'][value_reference];
                switch (data_item['grade']) { //GROUP PERSETUJUAN PER LEVEL
                    case 'NRP':

                        $(`#persetujuan-${data_item['level']}`).append(
                            `<option selected value="${value_reference}">${db['public']['KARYAWAN'][value_reference]['FULL-NAME']}</option>`
                        );
                        $(`#persetujuan-${data_item['level']}`).select2();

                        break;
                    case 'ATASAN-LANGSUNG':
                        atasan = db['db']['arr_employees'][
                            'all_employees'
                        ];
                        profile = db['public']['KARYAWAN'][value_reference];

                        atasan = innerJoinArrays(atasan, db['db']['arr_employees']['PERUSAHAAN'][profile[
                            'PERUSAHAAN']]);
                        atasan = innerJoinArrays(atasan, db['db']['arr_employees']['PROJECT'][profile[
                            'PROJECT']]);
                        atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][3]
                            .includes(
                                item));

                        if (profile['GRADE'] <= 5) {
                            atasan = innerJoinArrays(atasan, db['db']['arr_employees']['DEPARTEMEN'][
                                profile['DEPARTEMEN']
                            ]);
                            atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][5].includes(
                                item));
                            atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][1]
                                .includes(
                                    item));

                            // return false;
                            if (profile['GRADE'] <= 4) {
                                atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][1]
                                    .includes(
                                        item));
                                if (profile['GRADE'] <= 2) {
                                    atasan = innerJoinArrays(atasan, db['db']['arr_employees']['DIVISI'][
                                        profile['DIVISI']
                                    ]);
                                } else {
                                    atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][3]
                                        .includes(
                                            item));

                                    atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][2]
                                        .includes(
                                            item));
                                }
                            }
                        } else if (profile['GRADE'] <= 7) {
                            atasan = innerJoinArrays(atasan, db['db']['arr_employees']['GRADE'][8]);
                        } else if (profile['GRADE'] <= 9) {
                            atasan = innerJoinArrays(atasan, db['db']['arr_employees']['GRADE'][10]);
                        } else if (profile['GRADE'] <= 11) {
                            atasan = innerJoinArrays(atasan, db['db']['arr_employees']['GRADE'][12]);
                        } else if (profile['GRADE'] <= 13) {
                            atasan = innerJoinArrays(atasan, db['db']['arr_employees']['GRADE'][14]);
                        }
                        atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][11]
                            .includes(
                                item));




                        atasan = atasan.filter(item => !db['db']['arr_employees']['PHK'].includes(
                            item));



                        for (let i = 0; i <= profile['GRADE']; i++) {
                            // conLog(i, db['db']['arr_employees']['GRADE'][i]);
                            try {
                                atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][i].includes(
                                    item));
                            } catch (error) {

                            }
                        }
                        conLog('Atasan Langsung', atasan);


                        let grade_atas = [];
                        atasan.forEach(NRP => {
                            $(`#persetujuan-${data_item['level']}`).append(
                                `<option selected value="${NRP}">${db['public']['KARYAWAN'][NRP]['FULL-NAME']}</option>`
                            );
                        });
                        $(`#persetujuan-${data_item['level']}`).select2();
                        break;
                    case 'HR':
                        atasan = db['db']['arr_employees'][
                            'all_employees'
                        ];
                        profile = db['public']['KARYAWAN'][value_reference];
                        atasan = innerJoinArrays(atasan, db['db']['arr_employees']['PERUSAHAAN'][profile[
                            'PERUSAHAAN']]);
                        // conLog('atasan perusahaan', atasan);
                        atasan = innerJoinArrays(atasan, db['db']['arr_employees']['PROJECT'][profile[
                            'PROJECT']]);
                        atasan = innerJoinArrays(atasan, db['db']['arr_employees']['DEPARTEMEN']['HRGA']);
                        if (atasan.length > 0) {
                            conLog('HR', atasan);
                        } else {
                            atasan = innerJoinArrays(db['db']['arr_employees']['PROJECT']['MBG'], db['db'][
                                'arr_employees'
                            ]['DEPARTEMEN']['HRGA']);
                        }


                        for (let i = 0; i <= 4; i++) {
                            try {
                                atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][i].includes(
                                    item));
                            } catch (error) {

                            }
                        }
                        atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][11]
                            .includes(
                                item));


                        atasan.forEach(NRP => {
                            $(`#persetujuan-${data_item['level']}`).append(
                                `<option selected value="${NRP}">${db['public']['KARYAWAN'][NRP]['FULL-NAME']}</option>`
                            );
                        });
                        $(`#persetujuan-${data_item['level']}`).select2();
                        conLog('HR', atasan);
                        break;
                    case 'MANAGER':
                        atasan = db['db']['arr_employees'][
                            'all_employees'
                        ];
                        profile = db['public']['KARYAWAN'][value_reference];

                        if (profile['GRADE'] <= 7) {
                            atasan = innerJoinArrays(atasan, db['db']['arr_employees']['PERUSAHAAN'][profile[
                                'PERUSAHAAN']]);
                            atasan = innerJoinArrays(atasan, db['db']['arr_employees']['PROJECT'][profile[
                                'PROJECT']]);
                        }
                        for (let i = 0; i <= 7; i++) {
                            try {
                                atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][i].includes(
                                    item));
                            } catch (error) {

                            }
                        }
                        atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][11]
                            .includes(
                                item));
                        atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][13]
                            .includes(
                                item));
                        atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][3]
                            .includes(
                                item));
                        atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][5]
                            .includes(
                                item));
                        atasan = atasan.filter(item => !db['db']['arr_employees']['GRADE'][7]
                            .includes(
                                item));
                        conLog('MANAGER', atasan);
                        atasan.forEach(NRP => {
                            $(`#persetujuan-${data_item['level']}`).append(
                                `<option selected value="${NRP}">${db['public']['KARYAWAN'][NRP]['FULL-NAME']}</option>`
                            );
                        });
                        $(`#persetujuan-${data_item['level']}`).select2();

                        break;
                    default:
                        break;
                }
            }
        });


    }

    function createPersetujuanFieldForm() {

    }

    function storePersetujuan(code_data, value_agreement) {

        $(`#${code_data}-STATUS`).remove();

        $(`#FORM-${code_data}`).append(`
                <input type="text" name="STATUS" id="KEHADIRAN-STATUS" value="${value_agreement}">
        `);
        // return false;   
        storeDataTable(code_data);

    }

    function ajukanIzin(code_data = null) {
        $(`#form-kehadiran`).empty();
        createFormFieldTable('form-kehadiran', 'KEHADIRAN');


        if (code_data) {

            $('#uuid_data').val(code_data);

            let data_ketidakhadiran_edit = data_ketidakhadiran[code_data];
            let data_persetujuan_edit = data_data_persetujuan[code_data];

            conLog('data_ketidakhadiran_edit', data_ketidakhadiran_edit)

            $('#KEHADIRAN-TANGGAL-PENGAJUAN').val(data_ketidakhadiran_edit['tanggal_diajukan']);
            $('#KEHADIRAN-JENIS-KEHADIRAN').val(data_ketidakhadiran_edit['code_jenis_kehadiran']).trigger('change');
            $('#KEHADIRAN-TANGGAL-MULAI').val(data_ketidakhadiran_edit['tanggal_mulai']);
            $('#KEHADIRAN-LAMA').val(data_ketidakhadiran_edit['lama']);
            if (data_ketidakhadiran_edit['dokumen']) {
                // code for file show
            }
            $('#KEHADIRAN-KETERANGAN').val(data_ketidakhadiran_edit['keterangan']);
            $('#KEHADIRAN-NRP').val(data_ketidakhadiran_edit['nrp']).trigger('change');

            if (data_ketidakhadiran_edit['status_absen']) {
                $('#KEHADIRAN-STATUS-ABSEN').val(data_ketidakhadiran_edit['status_absen']).trigger('change');
            } else {
                $('#KEHADIRAN-STATUS-ABSEN').val(db['public']['DATABASE-JENIS-IZIN'][data_ketidakhadiran_edit[
                    'code_jenis_kehadiran']]['STATUS-ABSEN']).trigger('change');
            }


            if (data_ketidakhadiran_edit['dokumen']) {
                $(`.show-DOKUMEN`).attr('hidden', false);
                $(`.show-DOKUMEN`).attr('onclick', `showFile('${data_ketidakhadiran_edit['dokumen']}', 'DOKUMEN')`);
            }

            conLog('data_ketidakhadiran', data_ketidakhadiran[code_data]);
            conLog('data_persetujuan_edit', db['public']['DATABASE-JENIS-IZIN'][data_ketidakhadiran_edit[
                'code_jenis_kehadiran']]['STATUS-ABSEN']);
            let is_lower = true;
            Object.values(data_persetujuan_edit).forEach(item_persetujuan => {
                if (item_persetujuan['status'] == 'ACC') {
                    $(`#icon-persetujuan-${item_persetujuan['level']}`).empty();
                    $(`#icon-persetujuan-${item_persetujuan['level']}`).append(`
                        <button type="button" class="btn btn-success">
                            <i class="icon-copy bi bi-check-lg"></i>
                        </button>
                    `);
                }

                if (item_persetujuan['status'] == 'DECLINE') {
                    $(`#icon-persetujuan-${item_persetujuan['level']}`).empty();
                    $(`#icon-persetujuan-${item_persetujuan['level']}`).append(`
                        <button type="button" class="btn btn-danger">
                            <i class="icon-copy bi bi-x-lg"></i>
                        </button>
                    `);
                }

                $(`#persetujuan-${item_persetujuan['level']}`).empty();
                $(`#persetujuan-${item_persetujuan['level']}`).append(
                    `<option selected value="${item_persetujuan.nrp}">${db['public']['KARYAWAN'][item_persetujuan.nrp]['FULL-NAME']}</option>`
                );
                $(`#persetujuan-${item_persetujuan['level']}`).select2();
                if (!is_lower && item_persetujuan['status']) {
                    $(`.FORM-KEHADIRAN`).attr('disabled', true);
                    $('.persetujuan').attr('hidden', true);
                }
                if (item_persetujuan['nrp'] == ui_dataset.ui_dataset.user_authentication.nik_employee &&
                    is_lower) {
                    is_lower = false;
                }
                if (ui_dataset.ui_dataset.user_authentication.feature.includes('HR')) {
                    is_lower = true;
                }



            });

        }

        if ((ui_dataset.ui_dataset.user_authentication.DEPARTEMEN).includes('HRGA') && ui_dataset.ui_dataset
            .user_authentication.role >= 6) {
            conLog('hr', 'hr');
        } else {
            $('#form-KEHADIRAN-STATUS-ABSEN').attr('hidden', true);
        }
        $('#form-KEHADIRAN-TANGGAL-PENGAJUAN').attr('hidden', true);
        $(`#modal-kehadiran`).modal('show');
    }

    function createDatatablePersetujuanAbsen() {
        conLog('createDatatablePersetujuanAbsen', '-------------------------');
        // 1. empty element
        $('#datatable-data-persetujuan').empty();
        // 1. empty element
        // return false;
        // 2. add header
        let row_data_datatable = [];
        let header_table_element = '';
        let header_table_field = ['Tanggal'];
        header_table_element = '';
        header_table_field.forEach(element => {
            header_table_element = `${header_table_element} <th> ${element} </th>`
        });
        header_table_element = `                    
            <table id="table-datatable-persetujuan" class="nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        ${header_table_element}
                    </tr>
                </thead>
            </table>
        `;
        // return false;
        $('#datatable-data-persetujuan').append(header_table_element);
        // 2. add header 

        // 3. code add data
        let column_design = [];


        card_column = {
            mRender: function(data, type, row) {
                let value_return;
                // conLog('row',row);
                // conLog('data_ketidakhadiran',data_ketidakhadiran)
                // console.log(data_ketidakhadiran[row]['tanggal_mulai']);
                let date_format = parseDate_fromFormatDate(data_ketidakhadiran[row]['tanggal_mulai']);
                var r = name_days_sort[date_format.getDay()];
                let status_absen_HR = data_ketidakhadiran[row]['status_absen'];
                if (!status_absen_HR) {
                    status_absen_HR = '-';
                }
                var status_pembayaran_upah = db['public']
                    ['public_value']
                    ['DATABASE-ABSENSI']
                    [status_absen_HR]
                    ['JENIS-PEMBAYARAN-ABSEN'];

                let keterangan = (data_ketidakhadiran[row]['keterangan']) ?
                    data_ketidakhadiran[row]['keterangan'] : "tidak ada";

                let field_persetujuan = db['db']['database_persetujuan']['KEHADIRAN'];
                let proses_persetujuan = 'tidak ada';
                let bg = 'light';
                if (data_data_persetujuan[row]) {
                    const keys = Object.keys(field_persetujuan);
                    let i = 1;
                    while (i <= keys.length) {
                        const key = keys[i];
                        const value = data_data_persetujuan[row][`LEVEL-${i}`];
                        // conLog('field_persetujuan',);
                        if (!value['status']) {
                            if (value['nrp'] == ui_dataset.ui_dataset.user_authentication.nik_employee) {
                                bg = 'warning';
                            }
                            if (proses_persetujuan == 'tidak ada') {
                                proses_persetujuan = db['public']['public_value'][
                                    'DATABASE-GROUP-PERSETUJUAN'
                                ][field_persetujuan[`LEVEL-${i}`]['grade']]['GROUP-PERSETUJUAN'];

                                if (value['nrp'] == ui_dataset.ui_dataset.user_authentication.nik_employee) {
                                    bg = 'warning';
                                }
                            }

                            // break;
                        } else {
                            if (value['nrp'] == ui_dataset.ui_dataset.user_authentication.nik_employee) {
                                bg = 'warning';
                                if (value['status'] == 'ACC') {
                                    bg = 'info';
                                }

                                if (value['status'] == 'DECLINE') {
                                    bg = 'danger';
                                }
                            }
                        }

                        i++;
                    }
                }


                // let is_lower = true;

                // let data_persetujuan_edit = data_data_persetujuan[row];
                // Object.values(data_persetujuan_edit).forEach(item_persetujuan => {
                //     if (value['nrp'] == ui_dataset.ui_dataset.user_authentication.nik_employee) {
                //         if (value['status'] == 'ACC') {
                //             bg = 'success';
                //         }

                //         if (value['status'] == 'DECLINE') {
                //             bg = 'danger';
                //         }
                //     }
                // });


                // conLog('BG', bg)


                return `<div class="row pd-10">
                    
                            <div class="col-12 row">
                                <div class="col-md-5 col-sm-12 mb-2">
                                    ${emmp(data_ketidakhadiran[row]['nrp'])}
                                </div>
                                <div class="col-md-7 col-sm-12">
                                    <div  class="name-avatar bg-${bg} d-flex align-items-center pr-2 card-box row  pl-2">
                                        <div class="col-12 row ml-1 mt-2 justify-content-between">
                                            <span class="col-auto badge badge-pill badge-sm"
                                            data-bgcolor="#e7ebf5" data-color="#265ed7"
                                            style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">Proses
                                            di ${proses_persetujuan}</span>

                                            <div class="col-auto text-right">
                                                <a class="dropdown-toggle no-arrow" href="javascript:;" >
                                                    <i onclick="ajukanIzin('${row}')" class="icon-copy bi bi-arrow-right"></i>
                                                </a>
                                            </div> 
                                        </div>
                                        <div class="row col-md-6 col-sm-12">       
                                            <div class="col-12 row">
                                                <div class="col-12 font-14 weight-600">${toShortStringDate_fromFormatDate(data_ketidakhadiran[row]['tanggal_mulai'])}, ${r} 
                                                    |<div class="date">${(data_ketidakhadiran[row]['lama'])?data_ketidakhadiran[row]['lama']:""} Hari</div>
                                                </div>
                                                <div class="col-12 font-12 weight-500" >
                                                    ${db['public']['public_value'][KONSTANTA['DATABASE-JENIS-IZIN']][data_ketidakhadiran[row]['code_jenis_kehadiran']]['JENIS-IZIN']}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row col-md-6 col-sm-12 row">
                                            <div class="col-5">
                                                <small class="">
                                                    Pembayaran
                                                </small>
                                            </div>
                                            <div class="col-7">
                                                <small class="">
                                                    <div class="date">${status_pembayaran_upah} (${status_absen_HR})</div>
                                                </small>
                                            </div>
                                            <div class="col-5 d-flex align-items-start">
                                                <small class="">
                                                    Dokumen
                                                </small>
                                            </div>
                                            <div class="col-7">
                                                <small class="">
                                                    <div class="date"><i class="icon-copy bi bi-file-earmark-pdf"></i></span></div>
                                                </small>
                                            </div>
                                            <div class="col-5 d-flex align-items-start">
                                                <small class="">
                                                    Keterangan
                                                </small>
                                            </div>
                                            <div class="col-7 d-flex align-items-start">
                                                <small class="">
                                                    <cite class="text-wrap" title="Source Title">${keterangan}</div>
                                                </small>
                                            </div> 
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>`;
            }
        };
        column_design.push(card_column);
        // 3. code add data

        // 4. data datatable

        // 4. data datatable
        let data_kehadiran_table = (data_ketidakhadiran) ? Object.keys(data_ketidakhadiran) : [];
        conLog('ALL data_ketidakhadiran', data_ketidakhadiran);
        // 5. datatable
        $('#table-datatable-persetujuan').DataTable({
            paging: true,
            responsive: true,
            serverSide: false,
            data: data_kehadiran_table,
            columns: column_design
        });
        // 5. datatable
    }

    function storeDataTable(code_table) {
        conLog('storeDataTable', 'storeDataTable');

        let data_source_this_field = {};
        Object.values(db['db']['database_field'][code_table]).forEach(element => {
            if (element.type_data_field == KONSTANTA['Input Autocomplite']) {
                data_source_this_field[element.full_code_field] = db['db']['database_data_source'][element
                    .full_code_field
                ];
                data_source_this_field[element.full_code_field]['primary_field'] = db['db']['database_table'][
                    data_source_this_field[element.full_code_field]['table_data_source']
                ]['primary_table'];
                data_source_this_field[element.full_code_field]['code_field'] = element.code_field;
            }
        });

        let uuid_data = $('#uuid_data').val();
        var formId = 'FORM-' + code_table; // Construct the form ID dynamically

        let db_table = db['db']['database_table'][code_table];

        var formData;
        try {
            formData = new FormData(document.getElementById(formId));
        } catch (error) {

            formData = new FormData(document.getElementById(`form-id-${code_table}`));
        }

        formData.append('code_table', code_table);
        formData.append('uuid_data', uuid_data);

        if (db['db']['database_field_show'][code_table]) {
            Object.entries(db['db']['database_field_show'][code_table]).forEach(([key_field, fields]) => {
                let value_gabungan = '';
                // conLog('key_field', key_field);
                fields.forEach(items_field => {
                    value_gabungan = value_gabungan + `${items_field.split_by}` + $(
                        `#${code_table}-${items_field.field_show_code}`).val();
                });
                value_gabungan = value_gabungan.slice(1);
                formData.append(key_field, value_gabungan);
            });
        }


        Object.entries(db_table).forEach(([key_field, fields]) => {
            formData.append(`data_table[${key_field}]`, fields);
        });

        formData.append(`data_source_this_field`, JSON.stringify(data_source_this_field));

        // conLog('formData', formData);
        // return false;
        //tidak boleh ke form karena bakal di kasih file,

        $.ajax({
            url: '/web/manage/database/store-database',
            type: 'POST',
            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'user-token-mbg': ui_dataset.ui_dataset.user_authentication.auth_login
            },
            data: formData,
            contentType: false, // Important: prevents jQuery from setting content type header
            processData: false, // Important: prevents jQuery from processing the data
            success: function(response) {
                conLog('response ', response);
                showModalSuccess();
            },
            error: function(response) {
                conLog('error', response);
            }
        });
    }

    async function getFileType(url) {
        const response = await fetch(url, {
            method: 'HEAD'
        });

        return response.headers.get('Content-Type');
    }

    async function convertImageToPdf(imageUrl) {
        const {
            jsPDF
        } = window.jspdf;

        // Create an image element
        const img = new Image();
        img.crossOrigin = 'Anonymous'; // Handle CORS
        img.src = imageUrl;
        conLog('run convert', img);

        return new Promise((resolve, reject) => {
            img.onload = () => {
                // Create a PDF document
                const modalWidth = document.querySelector('.modal-dialog').offsetWidth;

                // Calculate scale factor to fit image in modal width
                const scaleFactor = modalWidth / img.width;

                // Create a PDF document
                const pdf = new jsPDF({
                    orientation: 'landscape',
                    unit: 'px',
                    format: [img.width * scaleFactor, img.height * scaleFactor]
                });

                pdf.addImage(img, 'PNG', 0, 0, img.width * scaleFactor, img.height * scaleFactor);

                // Save the PDF and create a URL for it
                const pdfUrl = URL.createObjectURL(pdf.output('blob'));
                resolve(pdfUrl);
            };

            img.onerror = reject;
        });
    }

    async function showFile(url_file, field) {

        field = url_file;
        url_file = "{{ env('APP_URL') }}file/database/" + url_file;
        $(`#id_cetak_file`).attr('onclick', `downloadFile('${url_file}', '${field}')`);
        $(`#id_download_file`).attr('onclick', `downloadFile('${url_file}', '${field}')`);
        // conLog('url', url_file);
        startLoading();
        try {
            // Determine file type
            const fileType = await getFileType(url_file);
            conLog('fileType', fileType);
            if (fileType === 'application/pdf') {
                // If it's a PDF, display it directly
                document.getElementById('pdfIframe').src = url_file;
                $(`#imageContainer`).attr('hidden', true);
                stopLoading();

            } else if (fileType.startsWith('image/')) {
                $(`#pdfIframe`).attr('hidden', true);
                const imageContainer = document.getElementById('imageContainer');
                imageContainer.innerHTML =
                    `<img src="${url_file}" alt="Image" style="width: 100%; height: 600px;" />`;
            } else {
                alert('Unsupported file type.');
                return;
            }
            stopLoading();
            $('#pdfModal').modal('show');
            return false;
        } catch (error) {
            stopLoading();
            console.error('Error processing file:', error);
        }
    }

    function downloadFile(url_slip, file_name) {
        CL(url_slip)
        var dlink = document.createElement("a");
        dlink.href = `${url_slip}`;
        dlink.setAttribute("download", file_name);
        dlink.download = file_name;
        dlink.click();
    }

    function toNumber(numberOf) {
        return numberOf.replace(/[^0-9]/g, '');
    }

    function toRupiah(arg) {

        let idElement = arg.getAttribute('id');
        let nameElement = arg.getAttribute('name');
        let arr_idElement = idElement.split('rupiah-');
        if ($('#rupiah-' + idElement).length == 0) {
            $(`#${idElement}`).attr("name", `rupiah-${nameElement}`);
            $(`#${idElement}`).after(
                `
        <input type="text" name="${nameElement}"
                    id="rupiah-${idElement}" class="form-control">
        `
            );
        }
        let valueElement = $(`#${idElement}`).val();
        var charFrontElement = valueElement.substr(0, 4);
        var valueNumberElement = valueElement.split('Rp. ')[1];
        if (charFrontElement != 'Rp. ') {
            $(`#${idElement}`).val('Rp. ');
        } else {
            $(`#${idElement}`).val('Rp. ' + toNumber(valueNumberElement).toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                '.'));
            $(`#rupiah-${idElement}`).val(toNumber(valueNumberElement));
        }
        cg('valueElement', $('#rupiah-' + idElement).length);
    }

    function toValueRupiah(numberValue) {
        let float_number = parseFloat(numberValue);
        let _numberValue = parseFloat(float_number.toFixed(0));
        let rupiahFormat = _numberValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        rupiahFormat = 'Rp. ' + rupiahFormat;
        return rupiahFormat;
    }


    function getValueDatabase_datatable(code_table) {
        let database_datatable = [];
        database_datatable['table'] = db['db']['database_table'][code_table];
        database_datatable['fields'] = db['db']['database_field'][code_table];
        database_datatable['show-fields'] = [];
        database_datatable['all-fields'] = db['db']['database_field'][code_table];
        database_datatable['table_childs'] = db['db']['data_table_child'][code_table];
        if (database_datatable['table_childs']) {
            database_datatable['table_childs'].forEach(code_table_child => {
                database_datatable['all-fields'] = $.merge(Object.values(database_datatable['all-fields']),
                    Object.values(
                        db['db']['database_field'][code_table_child]));
            });
        } else {
            database_datatable['all-fields'] = Object.values(db['db']['database_field'][code_table]);
        }

        database_datatable['all-fields-before-clear'] = database_datatable['all-fields'];
        database_datatable['all-fields'] = [];
        database_datatable['all-fields-before-clear'].forEach(element => {
            if (element['type_data_field'] != 'hidden') {
                database_datatable['all-fields'].push(element);
            }

        });
        try {
            Object.values(db['db']['table_show_template'][ui_dataset.ui_dataset.user_authentication.employee_uuid][
                code_table
            ]).forEach(field_show => {
                database_datatable['show-fields'].push(db['db']['database_field'][field_show['code_table']][
                    field_show['code_field']
                ]);
            });
        } catch (error) {
            database_datatable['show-fields'] = Object.values(db['db']['database_field'][code_table])
        }
        return database_datatable;
    }

    function filterObject(arr_key_filtered, data_object) {
        let status_absen_filter = $('#status-absen-filter').val();
        let filteredData = arr_key_filtered.reduce((acc, index) => {
            if (data_object.hasOwnProperty(index)) {
                acc[index] = data_object[index];
            }
            return acc;
        }, {});

        return filteredData;
    }

    function mergeArrays(array1 = [], array2 = []) {

        if (array1.length < 0) {
            return array2

        }
        if (array2.length < 0) {
            return array1

        }

        return [...new Set([...array1, ...array2])];
    }

    function innerJoinArrays(array1, array2) {
        if (array1.length >= 1 && array2.length >= 1) {

            return array1.filter(value => array2.includes(value));

        }
        return [];
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

    function dateDiff(startDate, endDate) {
        // Convert the startDate and endDate to Date objects if they are not already
        startDate = new Date(startDate);
        endDate = new Date(endDate);

        // Initialize the years, months, and days difference
        let yearsDiff = endDate.getFullYear() - startDate.getFullYear();
        let monthsDiff = endDate.getMonth() - startDate.getMonth();
        let daysDiff = endDate.getDate() - startDate.getDate();

        // Adjust the months difference if necessary
        if (monthsDiff < 0) {
            yearsDiff--;
            monthsDiff += 12;
        }

        // Adjust the days difference if necessary
        if (daysDiff < 0) {
            monthsDiff--;
            let previousMonth = new Date(endDate.getFullYear(), endDate.getMonth(), 0);
            daysDiff += previousMonth.getDate();
        }

        return {
            years: yearsDiff,
            months: monthsDiff,
            days: daysDiff
        };
    }

    function calculateMonthsBetweenDates(date1, date2) {
        // Convert the dates to Date objects if they are not already
        const startDate = new Date(date1);
        const endDate = new Date(date2);

        // Get the year and month for both dates
        const startYear = startDate.getFullYear();
        const startMonth = startDate.getMonth();
        const endYear = endDate.getFullYear();
        const endMonth = endDate.getMonth();

        // Calculate the total months difference
        let months = (endYear - startYear) * 12 + (endMonth - startMonth);

        // Adjust if the end date is before the start date in the same month
        if (endDate.getDate() < startDate.getDate()) {
            months--;
        }

        return months;
    }

    function excelSerialToDate(serial) {
        // Excel serial date starts from 1 January 1900
        // JavaScript date starts from 1 January 1970
        if (serial.indexOf('-')) {
            return serial;
        } else {
            const baseDate = new Date(1899, 11, 30); // December 30, 1899
            const newDate = new Date(baseDate.getTime() + serial * 86400000); // 86400000 ms in a day

            // Extract year, month, and day from newDate
            const year = newDate.getFullYear();
            const month = String(newDate.getMonth() + 1).padStart(2, '0'); // Month is zero-indexed
            const day = String(newDate.getDate()).padStart(2, '0');

            // Return in yyyy-mm-dd format
            return `${year}-${month}-${day}`;
        }



    }

    function toShortStringDate_fromFormatDate(formatDates) {
        if (formatDates.includes('-')) {
            // console.log("String contains '-'");
        } else {
            formatDates = excelSerialToDate(formatDates);
        }
        let split_date = formatDates.split('-');

        return `${padToDigits(2, split_date[2])} ${months_3_char[parseInt(split_date[1])]} ${split_date[0]}`;
    }

    function parseDate_fromFormatDate(dateString) {
        // Split the date string into its components
        let parts = dateString.split('-');
        let year = parseInt(parts[0], 10);
        let month = parseInt(parts[1], 10) - 1; // Months are zero-indexed in JavaScript
        let day = parseInt(parts[2], 10);

        // Create and return the Date object
        return new Date(year, month, day);
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
        try {
            const resultString = the_text.replace(regex, "-");
            return resultString.toUpperCase();
        } catch (error) {
            return the_text;
        }

    }

    function UUIDtoStr(str) {
        return str
            .split('-') // Memisahkan string berdasarkan "-"
            .map((word, index) => {
                // Jika bukan kata pertama, ubah huruf pertama menjadi besar
                if (index === 0) {
                    return word.toLowerCase(); // Kata pertama tetap huruf kecil
                }
                return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
            })
            .join(' '); // Menggabungkan kembali menjadi satu string dengan spasi
    }

    function setUIdate(param_ui_year = ui_dataset.ui_dataset.ui_date.year, param_ui_month = ui_dataset.ui_dataset
        .ui_date.month,
        param_ui_day = ui_dataset.ui_dataset.ui_date.day) {
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
        conLog('set ui ui_dataset', ui_dataset)
        setUImonthYear();
        setLocalStorage('ui_dataset', ui_dataset);
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
        // conLog('year', year);
        conLog('set date session', arr_date_today);


        if (year) {
            arr_date_today.year = year;
        }

        if (month) {
            arr_date_today.month = month;
        }
        // cg('set-date-session', arr_date_today);
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
                    arr_date_today.day = response.data.day;
                    arr_date_today.month = response.data.month;
                    arr_date_today.year = response.data.year;
                    // cg('arr_data new', arr_date_today);
                },
                error: function(response) {
                    alertModal()
                }
            });
            // cg('when not', arr_date_today);
        } else {
            if (year == arr_date_today.year && parseInt(month) == parseInt(arr_date_today.month)) {
                // cg('same', 'same');
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
                        arr_date_today.day = response.data.day;
                        arr_date_today.month = response.data.month;
                        arr_date_today.year = response.data.year;
                        // cg('arr_data ubah', arr_date_today);
                    },
                    error: function(response) {
                        alertModal()
                    }
                });
            }
        }
        setUIdate(arr_date_today.year, arr_date_today.month, '01');
        setLocalStorage('arr_date_today', arr_date_today);
        start = new Date(arr_date_today.year, arr_date_today.month - 1, 1);
        end = new Date(arr_date_today.year, arr_date_today.month, 0);
        filter_absensi.date_start = formatDate(start);
        filter_absensi.date_end = formatDate(end);

        default_filter_absensi.date_start = formatDate(start);
        default_filter_absensi.date_end = formatDate(end);
        $('#FILTER-RANGE').val(setRangeDate(formatDate(start), formatDate(end))).trigger(
            'change');
        setLocalStorage('default_filter_absensi', default_filter_absensi);
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

    function conLogs(identify, data) {
        //  console.log("============================================================");
        console.log(identify + " : " + data);
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
            return JSON.parse(localStorage.getItem(key));
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

    function showDocument(url_file) {
        var modal = $('#pdfModal');
        modal.find('#pdfIframe').attr('src', '/file/database/' + url_file); // Set the source of the PDF file
        modal.modal('show'); // Show the modal

        modal.on('hidden.bs.modal', function(event) {
            modal.find('#pdfIframe').attr('src', ''); // Clear the source to stop loading the PDF
        });
    }

    function getDataFilteredKaryawan() {
        //kondisi disni sudah ada kryawan yang terfilter namun perlu di refresh lagi jika filternya update
        // bagaimana supaya efesien dalam filter nya

        let arr_part = [];
        // conLog('getDataFilteredKaryawan', db['DEFAULT-FILTER']['KARYAWAN'])
        Object.entries(db['DEFAULT-FILTER']['KARYAWAN']).forEach(([key_perusahaan, perusahaan]) => {
            if (default_filter_absensi['PERUSAHAAN'].includes(key_perusahaan)) {
                Object.entries(db['DEFAULT-FILTER']['KARYAWAN'][key_perusahaan]).forEach(([key_project,
                    project
                ]) => {
                    if (default_filter_absensi['PROJECT'].includes(key_project)) {
                        Object.entries(db['DEFAULT-FILTER']['KARYAWAN'][key_perusahaan][key_project])
                            .forEach(([key_department, department]) => {
                                if (default_filter_absensi['DEPARTEMEN'].includes(key_department)) {
                                    Object.entries(db['DEFAULT-FILTER']['KARYAWAN'][key_perusahaan][
                                        key_project
                                    ][key_department]).forEach(([key_divisi, divisi]) => {
                                        if (default_filter_absensi['DIVISI'].includes(
                                                key_divisi)) {
                                            Object.entries(db['DEFAULT-FILTER']['KARYAWAN'][
                                                key_perusahaan
                                            ][key_project][key_department][
                                                key_divisi
                                            ]).forEach(([key_jabatan, jabatan]) => {
                                                if (default_filter_absensi[
                                                        'JABATAN'].includes(
                                                        key_jabatan)) {
                                                    arr_part = mergeArrays(arr_part,
                                                        jabatan);
                                                }
                                            });
                                        }
                                    });
                                }
                            });
                    }
                });
            }

        });


        let status_karyawan = [];
        let db_karyawan = db['public']['KARYAWAN'];
        let karyawan_status_karyawan = [];

        let date_end = new Date(default_filter_absensi['date_end']);
        let date_start = new Date(default_filter_absensi['date_start']);

        try {
            status_karyawan = default_filter_absensi.statusKaryawan;
            if (status_karyawan || status_karyawan.length < 3) {
                arr_part.forEach(karyawan => {
                    if (status_karyawan.includes('AKTIVE')) {
                        if (db_karyawan[karyawan]['STATUS-KERJA'] == 'AKTIVE') {
                            karyawan_status_karyawan.push(karyawan);
                            return;
                        }
                    }

                    if (db_karyawan[karyawan]['STATUS-KERJA'] == 'PHK') {
                        if (status_karyawan.includes('PHK')) {
                            karyawan_status_karyawan.push(karyawan);
                            return;
                        }
                        if (status_karyawan.includes('PHK-BULAN-INI')) {
                            let date_phk = new Date(db_karyawan[karyawan][
                                'TANGGAL-BERAKHIR-KONTRAK--TBK-'
                            ]);
                            if (date_phk <= date_end && date_phk >= date_start) {
                                karyawan_status_karyawan.push(karyawan);
                                return;
                            }
                        }
                    }
                });
                // conLog('karyawan_status_karyawan', karyawan_status_karyawan);
            }
        } catch (error) {

        }
        default_filter_absensi['KARYAWAN'] = karyawan_status_karyawan;
        setLocalStorage('default_filter_absensi', default_filter_absensi);
        return karyawan_status_karyawan;
    }

    async function globalStoreNoTable(idForm) {
        let _url = $('#form-' + idForm).attr('action');
        var form = $('#form-' + idForm)[0];
        var form_data = new FormData(form);
        console.log(form_data);
        // return false;
        startLoading();
        return $.ajax({
            url: _url,
            type: "POST",
            contentType: false,
            processData: false,
            data: form_data,
            success: function(response) {
                // alert("Message:"+JSON.stringify(response.message)+"-"+JSON.stringify(response.data));
                console.log(response);
                showModalSuccess();
                // showModalMessage('berhasil');
            },
            error: function(response) {
                alertModal()
            }
        });
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
        console.log('stop loading ---------------------------------------------------')
        $('#loading-modal').hide()
        $('.modal').modal('hide');
        $('#loading-modal').modal('hide')
    }

    function startLoading() {
        conLogs('loading start', '-----------------------------------------------------------------');
        $('#loading-modal').modal('show');
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
<script>
    //============= GENERAL FILTER-==
    function filterSave() {
        let arr_checkbox_filter = [];
        let name_filter = $('#general-filter-name').val();

        var checkboxValues = $('.datatable-filter:checked').map(function() {
            arr_checkbox_filter.push($(this).val());
        }).get();

        default_filter_absensi[name_filter] = arr_checkbox_filter;
        setLocalStorage('default_filter_absensi', default_filter_absensi);
        conLog('local local local',getLocalStorage('default_filter_absensi')) ;
        conLog('default_filter_absensi', default_filter_absensi)
        conLog('name_filter', name_filter)
        conLog('arr_checkbox_filter', arr_checkbox_filter)

        $('#modal-general-filter').modal('hide');
    }

    function saveGeneralFilter() {
        default_filter_absensi['statusKaryawan'] = $(`#STATUS-KARYAWAN`).val();
        let date_range = $('#FILTER-RANGE').val();
        if (date_range) {
            let split_date_range = date_range.split(" - ");
            default_filter_absensi.date_start = formatDate(parseDateString(split_date_range[0], 'mm/dd/yyyy'));
            default_filter_absensi.date_end = formatDate(parseDateString(split_date_range[1], 'mm/dd/yyyy'));
        }
        setLocalStorage('default_filter_absensi', default_filter_absensi);
        conLog('default_filter_absensi', default_filter_absensi)
    }

    function selectAllFilter() {
        var isChecked = $('#select-all-filter').prop('checked');
        $('.datatable-filter').prop('checked', isChecked);
    }

    function filterTableShow(code_table) {
        conLog('filterTableShow', code_table);
        let table_detail = db['db']['database_table'][code_table];
        let table_field = db['db']['database_field'][code_table];
        let data_table_datatable = db['public']['public_value'][code_table];
        $('#general-filter-name').val(code_table);

        let isChecked = "";
        if (default_filter_absensi[code_table].length == filter_absensi[code_table].length) {
            isChecked = "checked";
        }
        let headerTableFilter = `<th>
                                        <div class="dt-checkbox no-sort">
                                            <input onchange="selectAllFilter()"
                                                type="checkbox"
                                                name="select_all-filter"
                                                ${isChecked}
                                                id="select-all-filter"
                                            />
                                            <span class="dt-checkbox-label"></span>
                                        </div>
                                    </th>
                                    <th> ${table_field[table_detail['primary_table']]['description_field']}</th>
                                    `;
        headerTableFilter = `                    
                    <table id="table-datatable-general-filter" class="checkbox-datatable nowrap stripe hover table" style="width:100%">
                        <thead>
                            <tr>
                                ${headerTableFilter}
                            </tr>
                        </thead>
                    </table>
                `;
        $('#datatable-general-filter').empty();
        $('#filter-table-name').text("Filter by " + table_detail['description_table']);
        $('#datatable-general-filter').append(headerTableFilter);


        let row_data_datatable = [];


        var checkbox_card_element = {
            mRender: function(data, type, row) {
                let isChecked = "";
                if (default_filter_absensi[code_table].includes(row)) {
                    isChecked = "checked";
                }
                return `<input value="${row}" type="checkbox" ${isChecked} class="datatable-filter editor-active dt-checkbox no-sort">`
            }
        };

        row_data_datatable.push(checkbox_card_element);

        var element_card = {
            mRender: function(data, type, row) {
                let data_show = showFieldData(table_field[table_detail['primary_table']]['type_data_field'],
                    code_table, table_detail['primary_table'],
                    toUUID(row)
                );
                return data_show;
            }
        };
        row_data_datatable.push(element_card);
        let first_local_filter = getLocalStorage('first-default_filter_absensi');
        // return false;
        $('#table-datatable-general-filter').DataTable({
            paging: false,
            // scrollY: true,
            scrollX: true,
            scrollY: "400px",
            responsive: true,
            serverSide: false,
            data: first_local_filter[code_table],
            columns: row_data_datatable
        });


    }

    function filterDatatable(code_table) {
        filterTableShow(code_table);
        $('#modal-general-filter').modal('show');
    }
</script>
{{-- LOCAL STORAGE --}}
<script>
    async function refreshSession() {
        console.log('SESSION START');
        console.log('======================================================================================');
        $('.refresh-data').show();
        let auth = ui_dataset.ui_dataset.user_authentication.auth_login;
        $.ajax({
            url: '/web/local-storage',
            type: "POST",
            headers: {
                'x-auth-login': auth,
                'X-Auth-Login': auth, // Changed header name
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                auth_login: auth
            },
            success: function(response) {
                // return false;
                status_absen_short = '';

                setLocalStorage('DATABASE', response.data);
                db = response.data;
                conLog('db', db);

                let lo_df_filter_ab = JSON.parse(localStorage.getItem('default_filter_absensi'));

                if (lo_df_filter_ab.PERUSAHAAN.length == 0) {
                    default_filter_absensi = db['DEFAULT-FILTER']['FILTER'];
                    default_filter_absensi.statusKaryawan = lo_df_filter_ab.statusKaryawan;
                    default_filter_absensi.date_start = lo_df_filter_ab.date_start;
                    default_filter_absensi.date_end = lo_df_filter_ab.date_end;
                    // conLog('x - default_filter_absensi', default_filter_absensi);
                    setLocalStorage('default_filter_absensi', default_filter_absensi);
                    setLocalStorage('first-default_filter_absensi', default_filter_absensi);

                }

                Object.values(db['public']['DATABASE-ABSENSI']).forEach(element => {
                    status_absen_short =
                        `${status_absen_short} <option value="${element['KODE-ABSEN']}">${element['KODE-ABSEN']}</option>`;
                });
                KONSTANTA['NRP'] = ui_dataset.ui_dataset.user_authentication.employee_uuid;
                conLog('default_filter_absensi', default_filter_absensi);
                $('.refresh-data').hide();
            },
            error: function(response) {
                conLog('error', response);
                stopLoading();
            }
        });
        console.log('======================================================================================');
        console.log('SESSION END');
    }







    function getLetter(num) {
        var letter = String.fromCharCode(num + 64);
        return letter;
    }

    function monthName(month) {
        return months[parseInt(month)]
    }
</script>
