<script>
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

    conLog('udin', localStorage.getItem('ui_dataset'));
    if (localStorage.getItem('ui_dataset')) {
        conLog('not null', localStorage.getItem('ui_dataset'));
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

    conLog('ui_dataset after set date', JSON.parse(localStorage.getItem('ui_dataset')));

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
            $('#loading-modal').modal('hide')
            $('.modal').modal('hide')
        }

    function startLoading() {
        $('#loading-modal').modal('show')
    }
</script>
