<script>
    function firstCreateUserEducation(pageId, user_detail_uuid) {
        $(`#user_detail_uuid-${pageId}`).val(user_detail_uuid);
        console.log('firstCreateUserAddress');
        stopLoading();
        setValue('/user-education/data/' + user_detail_uuid, 'user-education');
        if ($(`#isEdit-${pageId}`).val() == null) {
            $('.create-user-employee-back').hide();
        } else {
            $(`#uuid-${pageId}`).val(user_detail_uuid)
            $('.create-user-employee-back').attr('onclick', `choosePage('show-employee','${user_detail_uuid}')`);
        }
    }

    function storeUserEducation(idForm) {
        if (isRequiredCreate(['sd_name']) > 0) {
            return false;
        }
        globalStoreNoTable(idForm).then((data) => {
            let user = data.data;
            console.log(data);
            if ($('#isEdit-create-' + idForm).val()) {
                employees[user.employee_uuid] = user
                $('#btn-success-modal-id').attr('onclick',
                    `choosePage("show-employee",  "${user.employee_uuid}")`);
            } else {
                $('#btn-success-modal-id').attr('onclick',
                    `choosePage("create-user-license",  "${user.user_detail_uuid}")`);
            }
            stopLoading();
            $('#success-modal-id').modal('show')
        })
    }
</script>
