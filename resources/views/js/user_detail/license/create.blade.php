<script>
    function firstCreateUserLicense(pageId, user_detail_uuid) {
        stopLoading();
        console.log('firstCreateUserAddress');
        $(`#user_detail_uuid-${pageId}`).val(user_detail_uuid)
        setValue('/user-license/data/' + user_detail_uuid, 'user-license');
        if ($(`#isEdit-${pageId}`).val() == null) {
            $('.create-user-employee-back').hide();
        } else {
            $(`#uuid-${pageId}`).val(user_detail_uuid)
            $('.create-user-employee-back').attr('onclick', `choosePage('show-employee','${user_detail_uuid}')`);
        }
    }

    function storeUserLicense(idForm) {
        // if (isRequiredCreate(['sim_b2_umum']) > 0) {
        //     return false;
        // }
        globalStoreNoTable(idForm).then((data) => {
            let user = data.data;
            if ($('#isEdit-create-' + idForm).val()) {
                employees[user.employee_uuid] = user
                $('#btn-success-modal-id').attr('onclick',
                    `choosePage("show-employee",  "${user.employee_uuid}")`);
            } else {
                $('#btn-success-modal-id').attr('onclick',
                    `choosePage("create-user-health",  "${user.user_detail_uuid}")`);
            }
            stopLoading();
            $('#success-modal-id').modal('show')
        })
    }
</script>
