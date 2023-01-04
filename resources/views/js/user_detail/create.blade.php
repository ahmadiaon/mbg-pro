<script>
    function firstCreateUserDetail(uuid){
        
        $('#religion_uuid').empty();
        religions.forEach(religion_element => {
                $('#religion_uuid').append(`<option value="${religion_element.uuid}">${religion_element.religion}</option>`);
            }); 
         setValue('/user/data/' + uuid,'user-detail');      
    }

    function storeUserDetail(idForm) {
        if (isRequiredCreate(['name']) > 0) {
            return false;
        }
        globalStoreNoTable(idForm).then((data) => {
            let user = data.data;                
            stopLoading(); 
            $('#btn-success-modal-id').attr('onclick', `choosePage("create-user-address",  "${user.uuid}")`);    
                  
            $('#success-modal-id').modal('show')           
        })
    }
</script>