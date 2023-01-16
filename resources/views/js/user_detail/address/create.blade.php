<script>
    function firstCreateUserAddress(pageId, user_detail_uuid) {
        console.log('firstCreateUserAddress');
        $(`#user_detail_uuid-${pageId}`).val(user_detail_uuid)
        stopLoading();
        setValue(`/user-address/data/${user_detail_uuid}`, 'user-address');
        if ($(`#isEdit-${pageId}`).val() == null) {
            $('.create-user-employee-back').hide();
        } else {
            $(`#uuid-${pageId}`).val(user_detail_uuid)
            $('.create-user-employee-back').attr('onclick', `choosePage('show-employee','${user_detail_uuid}')`);
        }
    }

    function storeUserAddress(idForm) {
        if (isRequiredCreate(['kabupaten']) > 0) {
            return false;
        }
        globalStoreNoTable(idForm).then((data) => {
            let user = data.data;
            if ($('#isEdit-create-' + idForm).val()) {
                employees[user.employee_uuid] = user
                $('#btn-success-modal-id').attr('onclick',
                    `choosePage("show-employee",  "${user.employee_uuid}")`);
            } else {
                $('#btn-success-modal-id').attr('onclick',
                    `choosePage("create-user-dependent",  "${user.user_detail_uuid}")`);
            }
            stopLoading();
            $('#success-modal-id').modal('show')
        })
    }
</script>
