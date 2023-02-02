<!DOCTYPE html>
<html>

<head>
    @include('template.admin.head.basic')

    @if (!empty($layout['head_form']))
        @include('template.admin.head.form')
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
        cg('null', 'null');
        let arr_date_today = @json(session('year_month'));
        if (!arr_date_today) {
            arr_date_today = getDateTodayArr();
        }

        cg('aa', arr_date_today)

        function cg(message, data) {
            console.log(message + ':');
            console.log(data);
        }

        function setDateSession(year, month) {
            arr_date_today = @json(session('year_month'));
            if (!arr_date_today) {
                let arr_date_today = getDateTodayArr();
            } else {
                if (year == arr_date_today.year && parseInt(month) == parseInt(arr_date_today.month)) {
                    cg('same', 'same');
                } else {
                    $.ajax({
                        url: '/support/set-date',
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            year: year,
                            month: month,
                        },
                        success: function(response) {
                            $('#success-modal').modal('show')
                            console.log(response)
                            arr_date_today = @json(session('year_month'));
                            cg('arr_data', arr_date_today.year);
                        },
                        error: function(response) {
                            alertModal()
                        }
                    });
                }
            }


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

        function isRequiredCreate(id) {
            var err = 0;

            id.forEach(element => {
                if ($('#' + element).val() == "") {
                    console.log(element)
                    $('#' + element).after(` <code id="req-${element}">Data tidak boleh kosong</code>`);
                    err++
                } else {
                    $('#req-' + element).remove()
                }
            });
            return err;
        }
    </script>
    <script>
        let isDeleted = false;
        var element_profile_employee = {
            mRender: function(data, type, row) {
                if (row.photo_path == null) {
                    row.photo_path = '/vendors/images/photo4.jpg';
                }
                if (row.photo_path == null) {
                    row.photo_path = '/vendors/images/photo4.jpg';
                }
                return `<div class="name-avatar d-flex align-items-center">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="${row.photo_path}" class="border-radius-100 shadow" width="40"
												height="40" alt="" />
										</div>
										<div class="txt">
											<div class="weight-600">${row.name}</div>
											<small>${row.position}</small></br>
											<small>${row.nik_employee}</small>
										</div>
									</div>`
            }
        };








        function choosePage(pageId, data) {


            let idAppendElement = pageId;
            $('.children-content').hide();
            $('#' + idAppendElement).show();
            // runFirstFunction
            switch (idAppendElement) {
                case 'create-user-detail':
                    firstCreateUserDetail(data);
                    break;
                case 'create-user-dependent':
                    firstCreateUserDependent(pageId, data);
                    break;
                case 'create-user-address':
                    firstCreateUserAddress(pageId, data);
                    break;
                case 'create-user-education':
                    firstCreateUserEducation(pageId, data);
                    break;
                case 'create-user-license':
                    firstCreateUserLicense(pageId, data);
                    break;
                case 'create-user-health':
                    firstCreateUserHealth(pageId, data);
                    break;
                case 'create-user-employee':
                    firstCreateUserEmployee(pageId, data);
                    break;
                case 'create-employee-salary':
                    firstCreateEmployeeSalary(pageId, data);
                    break;
                case 'index-employee':
                    firstIndexEmployee(data);
                    break;
                case 'show-employee':
                    firstShowEmployee(data);
                    break;
                default:
                    return false;
            }
        }


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
                    console.log(data);
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
            let data_user
            getData(url).then((data_value_element) => {
                data_user = data_value_element.data;
                // console.log(data_user);
                if (data_user) {
                    for (var key in data_user) {
                        if (data_user[key] != null) {
                            $('#' + key).val(data_user[key]).trigger('change.select2')
                            if (data_user[key] == 'Ya') {
                                $('#' + key).attr('checked', 'checked').trigger('change')
                            }
                        }

                    }
                    $('#uuid-' + table).val(data_user.uuid)
                    $('#date_start-' + table).val(data_user.date_start)

                } else {
                    console.log('data : null, from:user-education-single')
                }
                if ($('#date_start-' + table).val() == '') {
                    console.log(table)
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
                serverSide: true,
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
            $('.modal').modal('hide')
        }

        function startLoading() {
            console.log('start loading')
            $('#loading-modal').modal('show')
        }

        function alertModal() {
            console.log('start loading')
            $('#alert-modal').modal('show')
        }

        function modalCreateGlobal(id) {
            $('#modal-create-' + id).modal('show')
            $('#form-' + id)[0].reset();
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
                    alert(JSON.stringify(response.data));
                    console.log(response);
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
            console.log('getLastNdigits')
            return Number(String(number).slice(-n));
        }


        var monthRomawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        var months = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
            "November", "Desember"
        ];

        function monthName(month) {
            return months[parseInt(month)]
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
        });
    </script>

</body>

</html>
