<script>
    function firstCreateUserHealth(uuid) {
        $('#user_detail_uuid-user-health').val(uuid);
        stopLoading();
        setValue('/user-health/data/' + uuid, 'user-health');
    }

    function storeUserHealth(idForm) {
        if (isRequiredCreate(['name_health']) > 0) {
            return false;
        }
        globalStoreNoTable(idForm).then((data) => {
            let user = data.data;
            console.log(data);

            $('#btn-success-modal-id').attr('onclick',
                `choosePage("create-user-employee",  "${user.user_detail_uuid}")`);
            stopLoading();
            $('#success-modal-id').modal('show')
        })
    }
</script>