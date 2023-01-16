<script>
    function firstCreateEmployeeSalary(uuid) {
        $('#employee_uuid-employee-salary').val(uuid);

        stopLoading();

        setValue('/employee-salary/data/' + uuid, 'employee-salary');

    }

    function storeEmployeeSalary(idForm) {
        if (isRequiredCreate(['salary']) > 0) {
            return false;
        }
        globalStoreNoTable(idForm).then((data) => {
            let user = data.data;
            console.log(data);
            if ($('#uuid-' + idForm).val()) {
                employees[user.employee_uuid] = user
                $('#btn-success-modal-id').attr('onclick',
                    `choosePage("show-employee",  "${user.employee_uuid}")`);
            } else {

                $('#btn-success-modal-id').attr('onclick',
                    `choosePage("index-employee",  "${user.employee_uuid}")`);
            }
            stopLoading();
            $('#success-modal-id').modal('show')
        })
    }
</script>
