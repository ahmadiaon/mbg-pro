<script>
   
    function firstCreateUserDependent(get_id) {
        stopLoading();
        let user_detail_uuid = get_id;
        $('#user_detail_uuid').val(user_detail_uuid);
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
    }

    function storeUserDependent(idForm) {
        if (isRequiredCreate(['mother_name', 'father_name']) > 0) {
            return false;
        }
        globalStoreNoTable(idForm).then((data) => {
            let user = data.data;
            console.log(data);

            $('#btn-success-modal-id').attr('onclick',
                `choosePage("create-user-education",  "${user.user_detail_uuid}")`);
            stopLoading();
            $('#success-modal-id').modal('show')
        })
    }
</script>