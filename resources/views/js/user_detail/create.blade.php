<script>
    function firstCreateUserDetail(uuid) {

        $('#religion_uuid').empty();
        religions.forEach(religion_element => {
            $('#religion_uuid').append(
                `<option value="${religion_element.uuid}">${religion_element.religion}</option>`);
        });
        if (uuid == null) {
            $('.create-user-employee-back').hide();
        } else {
            $('.create-user-employee-back').attr('onclick', `choosePage('show-employee','${uuid}')`);
        }
        setValue('/user/data/' + uuid, 'user-detail');
    }

    function storeUserDetail(idForm) {
        if (isRequiredCreate(['name']) > 0) {
            return false;
        }
        globalStoreNoTable(idForm).then((data) => {
            let user = data.data;
            console.log(response);
            stopLoading();
            if ($('#uuid-' + idForm).val()) {
                employees[user.employee_uuid] = user
                $('#btn-success-modal-id').attr('onclick', `choosePage("show-employee",  "${user.employee_uuid}")`);
            } else {
                $('#btn-success-modal-id').attr('onclick',
                `choosePage("create-user-address",  "${user.uuid}")`);
            }
            $('#success-modal-id').modal('show')
        })

    }
</script>
