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
    var name_days_sort = new Array(7);
    name_days_sort[0] = "Mig";
    name_days_sort[1] = "Sen";
    name_days_sort[2] = "Sel";
    name_days_sort[3] = "Rab";
    name_days_sort[4] = "Kam";
    name_days_sort[5] = "Jum";
    name_days_sort[6] = "Sab";

    let ui_dataset = {
        ui_dataset: {
            ui_date: null,
            user_authentication: null
        }
    }

    // conLog('udin', localStorage.getItem('ui_dataset'));
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

    // conLog('ui_dataset after set date', JSON.parse(localStorage.getItem('ui_dataset')));

    function CL(data_string) {
        console.log(data_string);
    }

    function formatDate(d) {

        var month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }

    function truncateString(str, maxLength) {
        if (str.length > maxLength) {
            return str.slice(0, maxLength) + "...";
        }
        return str;
    }

    function getDateToday() {
        console.log('getDateToday')
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

    function padZero(number) {
        return number < 10 ? "0" + number : number;
    }

    function toUUID(the_text) {
        const regex = /[^a-zA-Z0-9]/g;
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

    function formatDate(d) {

        var month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
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
        console.log('padToDigits')
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
                conLog('response localStorage', response);
                CL('db_local_storage');
                CL(@json(session('db_local_storage')));

                localStorage.setItem('DATABASE', JSON.stringify(response.data));
                db = JSON.parse(localStorage.getItem('DATABASE'));
                // showModalSuccess();
            },
            error: function(response) {
                conLog('error', 'localStorage')
                conLog('error', response);
                stopLoading();
            }
        });
    }
</script>
