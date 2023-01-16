<script>
    function showDataTableUser(url, dataTable, id) {
        let data = [];
        $('#tablePrivilege').empty();
        $('#tablePrivilege').append(
            ` <table id="table-privilege" class="display nowrap stripe hover table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Status Karyawan</th>
                            <th>Perusahaan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>`
        )

        data.push(element_profile_employee)

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
                                    <button onclick="choosePage('show-employee','` + row.nik_employee + `')" type="button" class="btn btn-info mr-1  py-1 px-2">
                                        <i class="icon-copy ion-android-list"></i>
                                    </button>										
                                </div>`
            }
        };
        data.push(elements)

        $('#' + id).DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            ajax: {
                url: '/user/data',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                // success: function(response) {
                //     $('#success-modal').modal('show')
                //     console.log(response)
                // },
                // error: function(response) {
                //     alertModal()
                // },

                type: 'POST',
            },
            columns: data
        });
    }

    function getEmployees(){
        
        $.ajax({
            url: '/user/data',
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response) {
                
                employees = response.message;
                
                console.log(employees)
                return employees;
            },
            error: function(response) {
                alertModal()
            }
        });
    }

    function firstIndexEmployee(data) {
        $.ajax({
            url: '/user/data',
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response) {                
                employees = response.message;
            },
            error: function(response) {
                alertModal()
            }
        });

        showDataTableUser('/user/data', ['employee_status', 'company_uuid'], 'table-privilege');
    }

</script>
