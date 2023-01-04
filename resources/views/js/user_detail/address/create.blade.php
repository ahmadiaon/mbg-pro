<script>
   

    function firstCreateUserAddress(user_detail_uuid) {
        $('#user_detail_uuid-address').val(user_detail_uuid)
        stopLoading();
        setValue('/user-address/data/' + user_detail_uuid, 'user-address');
    }

    function storeUserAddress(idForm) {
        if (isRequiredCreate(['kabupaten']) > 0) {
            return false;
        }
        globalStoreNoTable(idForm).then((data) => {
            let user = data.data; 
            $('#btn-success-modal-id').attr('onclick',
                `choosePage("create-user-dependent",  "${user.user_detail_uuid}")`);
            stopLoading();
            $('#success-modal-id').modal('show')
        })
    }
</script>