<script>
    function firstCreateUserDependent(pageId, user_detail_uuid) {
        console.log('firstCreateUserAddress');
        stopLoading();
        $(`#user_detail_uuid-${pageId}`).val(user_detail_uuid);
        getData('/user/data/' + user_detail_uuid, 'user-detail').then((data) => {
            let data_user = data.data;
            setValue('/user-dependent/data/' + user_detail_uuid);
            // special code
            if (data_user.status == 'Lajang') {
                $('#married').hide();
            } else {
                $('#married').show();
                if (data_user.status != 'Menikah') {
                    $('#out_law').hide();
                }
            }
        })
        if ($(`#isEdit-${pageId}`).val() == null) {
            $('.create-user-employee-back').hide();
        } else {
            $(`#uuid-${pageId}`).val(user_detail_uuid)
            $('.create-user-employee-back').attr('onclick', `choosePage('show-employee','${user_detail_uuid}')`);
        }
    }

    function storeUserDependent(idForm) {
        if (isRequiredCreate(['mother_name', 'father_name']) > 0) {
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
                    `choosePage("create-user-education",  "${user.user_detail_uuid}")`);
            }
            stopLoading();
            $('#success-modal-id').modal('show')
        })
    }
</script>
