<script>
    function firstCreateEmployeeSalary(pageId,uuid) {
        $('#employee_uuid-employee-salary').val(uuid);
        console.log('udin petot')
        stopLoading();
        setValue('/employee-salary/data/' + uuid, 'employee-salary');
        if ($(`#isEdit-${pageId}`).val() == null) {
            $('.create-user-employee-back').hide();
        } else {
            $(`#uuid-${pageId}`).val(uuid)
            $('.create-user-employee-back').attr('onclick', `choosePage('show-employee','${uuid}')`);
        }
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
