<script>
    function firstCreateUserEducation(uuid) {
        $('#user_detail_uuid-user-education').val(uuid);
        stopLoading();
        setValue('/user-education/data/' + uuid, 'user-education');
    }

    function storeUserEducation(idForm) {
        if (isRequiredCreate(['sd_name']) > 0) {
            return false;
        }
        globalStoreNoTable(idForm).then((data) => {
            let user = data.data;
            console.log(data);

            $('#btn-success-modal-id').attr('onclick',
                `choosePage("create-user-license",  "${user.user_detail_uuid}")`);
            stopLoading();
            $('#success-modal-id').modal('show')
        })
    }
</script>