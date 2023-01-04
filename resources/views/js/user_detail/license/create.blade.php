<script>
    function firstCreateUserLicense(uuid) {
        stopLoading();
        let user_detail_uuid = uuid;
        $('#user_detail_uuid-user-license').val(user_detail_uuid);
        setValue('/user-license/data/' + user_detail_uuid, 'user-license');
    }

    function storeUserLicense(idForm) {
        // if (isRequiredCreate(['sim_b2_umum']) > 0) {
        //     return false;
        // }
        globalStoreNoTable(idForm).then((data) => {
            let user = data.data; 
            $('#btn-success-modal-id').attr('onclick',
                `choosePage("create-user-health",  "${user.user_detail_uuid}")`);
            stopLoading();
            $('#success-modal-id').modal('show')
        })
    }
</script>