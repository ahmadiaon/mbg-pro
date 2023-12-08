<!DOCTYPE html>
<html>

<head>
    @include('template.admin.head.basic')

    @if (!empty($layout['head_form']))
        {{-- @include('template.admin.head.form') --}}
    @endif

    @if (!empty($layout['head_datatable']))
        @include('template.admin.head.datatable')
    @endif
    @yield('css')
    @include('template.admin.javascript.basic')

    @if (!empty($layout['head_datatable']))
        @include('template.admin.javascript.datatable')
    @endif

    @if (!empty($layout['head_form']))
        @include('template.admin.javascript.form')
    @endif

    <script>
        let COLOR_BOOTSTRAP = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
        let color_button = {
            alpa: 'danger',
            pay: 'primary',
            unpay: 'secondary',
            cut: 'warning'
        };
        function random_item(items) {
            return items[Math.floor(Math.random() * items.length)];
        }

        let data_database = @json(session('data_database'));
        let dataUser = @json(session('dataUser'));
        let arr_date_today = @json(session('year_month'));

        function cg(message, data) {
            console.log(message + ':');
            console.log(data);
        }
    </script>

</head>

<body>
    {{-- // HEADER --}}
    @include('template.admin.header')
    {{-- // RIGHT SIDE BAR --}}
    @include('template.admin.right')

    @include('template.admin.sidebar.main')


    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- //CONTENT --}}
                @yield('content')
            </div>
            {{-- // FOOTER --}}
            @include('template.admin.footer')
        </div>
    </div>
    <!-- welcome modal start -->
    @include('template.admin.modal')

    <!-- welcome modal end -->
    {{-- //BASIC JS --}}


    @yield('js')
    <script>
        $(document).ready(function() {
            @yield('js_ready')
            // cg('dataUser', @json(session('dataUser')));
            // Object.values(data_database.data_employees).forEach(employee_element => {
            //     $('.employees').append(
            //         `<option value="${employee_element.nik_employee}">${employee_element.name} - ${employee_element.position} | ${employee_element.company_uuid}-${employee_element.site_uuid}</option>`
            //     );
            // });

            // Object.values(data_database.data_companies).forEach(item_company => {
            //     $('.company_uuid-select2').append(
            //         `<option value="${item_company.uuid}">${item_company.long_company}</option>`
            //     );
            // });

            // Object.values(data_database.data_atribut_sizes.site_uuid).forEach(item_site => {
            //     $('.site_uuid-select2').append(
            //         `<option value="${item_site.uuid}">${item_site.name_atribut}</option>`
            //     );
            // });

        });
    </script>
</body>
<script>
    // if (!arr_date_today) {
    //     setDateSession(getDateTodayArr()['year'], getDateTodayArr()['month']);
    //     cg('kosong', @json(session('year_month')));
    // }

   

    function padToDigits(much, num) {
        console.log('padToDigits')
        return num.toString().padStart(much, '0');
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

    function isRequired(id) {
        var err = 0;
        console.log(id)
        id.forEach(element => {
            if ($('#' + element).val() == "") {
                $('#req-' + element).show();
                err++
            } else {
                $('#req-' + element).hide()
            }
        });
        return err;
    }

    function toUUID(the_text) {
        const regex = /[^a-zA-Z0-9]/g;
        // Ganti semua simbol dengan tanda dash ("-")
        const resultString = the_text.replace(regex, "-");
        return resultString.toUpperCase();
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


    async function deleteThisData() {
        let code_data = $('#code_data_delete').val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/activity/delete-data-table',
            type: "POST",
            data: {
                _token: _token,
                data: {
                    code_data: code_data
                }
            },
            success: function(response) {
                cg('xxx', response);
                if (response) {
                    $('#confirm-modal-async').modal('hide');
                    $(`#${code_data}`).parent().parent().remove();
                }
            },
            error: function(response) {
                console.log(response)
            }
        });

        cg('code_data', code_data);
    }
</script>

<script>
    let isDeleted = false;


    function addDays(date, days) {
        date.setDate(date.getDate() + days);
        return date;
    }

    function addmonths(date, month) {
        date.setDate(date.getMonth() + month);
        return date;
    }

    async function getData(url) {
        return $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                let data = res.data;

            }
        });
    }

    async function getPostData(url, post_data) {

        let _token = $('meta[name="csrf-token"]').attr('content');
        post_data['_token'] = _token;
        return $.ajax({
            url: url,
            type: 'POST',
            data: post_data,
            dataType: 'json',
            success: function(res) {
                let data = res.data;
                if (data) {
                    cg('getData', data)
                } else {
                    cg('getData', 'get null')
                }
            }
        });

    }


    function setChecked(idElement) {
        console.log('setChecked')
        let idElName = idElement + '-' + idElement;
        $('#' + idElName).remove();
        if ($("#" + idElement).prop('checked') == true) {
            $('#' + idElement).after(`<input type="hidden" name="${idElement}"  id="${idElName}"  value="Ya">`)
        } else {
            $('#' + idElement).after(`<input type="hidden" name="${idElement}"  id="${idElName}"  value="Tidak">`)
        }
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

    function setValue(url, table) {
        console.log('setValue')
        let data_user;
        getData(url).then((data_value_element) => {
            data_user = data_value_element.data;
            cg('set value', data_user);
            if (data_user) {
                for (var key in data_user) {
                    if (data_user[key] != null) {
                        let type_input = $('#' + key).attr('type');
                        if (type_input == 'file') {
                            let fileInput = document.getElementById(key);
                            cg(key, data_user[key]);
                            // Create a new File object
                            let myFile = new File(['Hello World!'], data_user[key], {
                                type: 'text/plain',
                                lastModified: new Date(),
                            });
                            $('#show-' + key).attr("onclick", "showdoc('" + data_user[key] + "')");

                            // Now let's create a DataTransfer to get a FileList
                            let dataTransfer = new DataTransfer();
                            dataTransfer.items.add(myFile);
                            fileInput.files = dataTransfer.files;
                        } else {
                            $('#' + key).val(data_user[key]).trigger('change.select2')
                            if (data_user[key] == 'Ya') {
                                $('#' + key).attr('checked', 'checked').trigger('change')
                            }
                        }
                    }

                }
                $('#uuid-create-' + table).val(data_user.uuid)
                $('#date_start-' + table).val(data_user.date_start)
            }
            if (typeof(ud_uuid) != 'undefined') {
                $('#user_detail_uuid-create-' + table).val(data_user.nik_number)
            }

            if (!$(`#isEdit-create-${table}`).val()) {
                $('.create-user-employee-back').hide();
            }
            if ($('#date_start-' + table).val() == '') {
                $('#date_start-' + table).val(getDateToday());
            }

        });

        return data_user;
    }





    function showDataTable(url, dataTable, id) {
        let data = [];
        dataTable.forEach(element => {
            var dataElement = {
                data: element,
                name: element
            }
            data.push(dataElement)
        });

        let urls = '{{ env('APP_URL') }}' + url
        console.log(urls)
        $('#' + id).DataTable({
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

    function showDataTableAction(url, dataTable, id) {
        let data = [];
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
                                <button onclick="editData('` + row.uuid + `')" type="button" class="btn btn-secondary mr-1  py-1 px-2">
                                    <i class="icon-copy ion-gear-b"></i>
                                </button>
                                <button onclick="deleteData('` + row.uuid + `')" type="button" class="btn btn-danger mr-1  py-1 px-2">
                                    <i class="icon-copy ion-trash-b"></i>
                                </button>
                            </div>`
            }
        };
        data.push(elements)

        let urls = '{{ env('APP_URL') }}' + url
        console.log(urls)
        $('#table-' + id).DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            ajax: urls,
            columns: data
        });
    }

    function stopLoading() {
        console.log('stop loading')
        $('#loading-modal').modal('hide')
        $('.modal').modal('hide')
    }

    function startLoading() {
        console.log('start loading')
        $('#loading-modal').modal('show')
    }

    function alertModal() {
        $('#alert-modal').modal('show')
    }

    function formatDate(d) {

        var month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }

    function formatDateArr(d) {

        var month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return {
            year: year,
            month: month,
            day: day
        };
    }

    function modalCreateGlobal(id) {
        $('#modal-create-' + id).modal('show')
        $('#form-' + id)[0].reset();
    }
    //new
    function showModalSuccess(data) {
        $('#success-modal').modal('show');
    }

    async function deleteForm(id_form) {
        $('#code_data_delete').val(id_form);
        $('#confirm-modal-async').modal('show');
    }

    function globalStore(idForm) {
        let _url = $('#form-' + idForm).attr('action');
        var form = $('#form-' + idForm)[0];
        var form_data = new FormData(form);
        console.log(form_data)
        startLoading();
        $.ajax({
            url: _url,
            type: "POST",
            contentType: false,
            processData: false,
            data: form_data,
            success: function(response) {
                $('#success-modal').modal('show')
                console.log(response)
                $('#table-' + idForm).DataTable().ajax.reload();
            },
            error: function(response) {
                alertModal()
            }
        });
    }

    async function globalStoreNoTable(idForm) {
        let _url = $('#form-' + idForm).attr('action');
        var form = $('#form-' + idForm)[0];
        var form_data = new FormData(form);
        // console.log(form_data)
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
                showModalMessage('berhasil');
            },
            error: function(response) {
                alertModal()
            }
        });
    }

    function storeWithValidate(idForm) {
        console.log('storeWithValidate')
        let _url = $('#form-' + idForm).attr('action');
        var form = $('#form-' + idForm)[0];
        var form_data = new FormData(form);
        var err = 0;

        for (let [name, value] of form_data) {

            // console.log('name  : '+name+' value  : '+value);
            if (name != 'uuid') {
                if ($('#' + name).val() == "") {
                    $('#req-' + name).show();
                    err++
                } else {
                    $('#req-' + name).hide()
                }
            }
        }
        if (err > 0) {
            return false;
        }

        $('#modal-create-' + idForm).modal('hide');
        startLoading();
        $.ajax({
            url: _url,
            type: "POST",
            contentType: false,
            processData: false,
            data: form_data,
            success: function(response) {
                $('#success-modal').modal('show')
                console.log(response)
                $('#table-' + idForm).DataTable().ajax.reload();



                $('#payment_group_uuid').append(`<option value="${response.data.uuid}">
                               ${response.data.payment_group}
                          </option>`);

            },
            error: function(response) {
                alertModal()
            }
        });
    }

    function deleteConfirmed() {
        console.log('deleteConfirmed')
        var uuid = $('#uuid_delete').val()
        let _token = $('meta[name="csrf-token"]').attr('content');
        let _url = $('#url_delete').val();
        let idTable = $('#table_reload').val();

        $('#confirm-modal').modal('hide')
        startLoading();
        $.ajax({
            url: _url,
            type: "POST",

            data: {
                uuid: uuid,
                _token: _token
            },
            success: function(response) {
                $('#success-modal').modal('show')
                $('#table-' + idTable).DataTable().ajax.reload();
                $('#form-employee-payment-' + idTable).remove();
                console.log('response delete :')
                $('#element-' + uuid).remove();

                console.log(response)
            },
            error: function(response) {
                console.log(response)
                alertModal()
            }
        });
    }

    function getLastNdigits(number, n) {
        // console.log('getLastNdigits')
        return Number(String(number).slice(-n));
    }

    function showModalMessage(message) {
        $('#message-text').text(message);
        $('#message-modal-id').modal('show');

        stopLoading();
    }

    function countBetweenDate(date_from, date_until) {
        var date1 = new Date(date_from); //from
        var date2 = new Date(date_until); //until

        var Difference_In_Time = date2.getTime() - date1.getTime();
        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
        return Difference_In_Days;

    }

    function toNumber(numberOf) {
        return numberOf.replace(/[^0-9]/g, '');
    }

    function toRupiah(arg) {

        let idElement = arg.getAttribute('id');
        let arr_idElement = idElement.split('rupiah-');
        if ($('#rupiah-' + idElement).length == 0) {
            $(`#${idElement}`).attr("name", `rupiah-${idElement}`);
            $(`#${idElement}`).after(
                `
            <input type="text" name="${idElement}"
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

    function deleteDataConfirmed() {
        let _token = $('meta[name="csrf-token"]').attr('content');
        let uuid_delete = $('#uuid-delete-confirm').val();
        let url_delete = $('#url-delete-confirm').val();

        $.ajax({
            url: url_delete,
            type: "POST",
            data: {
                _token: _token,
                uuid: uuid_delete
            },
            success: function(response) {
                cg('response', response);
                showModalMessage('Data terhapus');
            },
            error: function(response) {
                alertModal()
            }
        });
    }

    function deleteDataModalShow(uuid, contentDelete, urlDelete) {
        $('#message-delete-confirm').text(contentDelete);
        $('#uuid-delete-confirm').val(uuid);
        $('#url-delete-confirm').val(urlDelete);
        $('#confirm-modal-delete').modal('show');
        return false;
    }


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

    function getStringDate(date) {
        let arr_date = date.split('-');
        return `${arr_date[2]} ${monthName(arr_date[1])} ${arr_date[0]}`;
    }

    // if (typeof(data_database) == 'undefined') {
    //     cg('data_database', 'undefined')
    //     if (typeof(@json(session('data_database'))) == 'undefined') {
    //         cg('data_database', 'undefined')
    //     } else {
    //         cg('data_database', data_database)
    //         getData('/support/setSessionDatabase');
    //         getData('/support/setSessionDatabase').then((ses_data) => {
    //             cg('ses_data', ses_data);
    //         });
    //         location.reload();
    //         data_database = @json(session('data_database'));
    //     }
    //     cg('data_database', data_database);
    // } else if (data_database == null) {
    //     cg('else data_database', data_database);
    //     getData('/support/setSessionDatabase');
    //     location.reload();
    // }
    cg('data_database', data_database);
</script>

</html>
