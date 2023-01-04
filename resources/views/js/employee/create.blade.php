<script>
    function firstCreateUserEmployee(uuid) {
        $('#user_detail_uuid-user-employee').val(uuid);
        $('#long_contract').val('12');

        stopLoading();

        newValue()
        let date_now = new Date();
        let day = padToDigits(2, date_now.getDate());
        let month = padToDigits(2, date_now.getMonth() + 1);
        let year = date_now.getFullYear();
        let today = year + '-' + month + '-' + day;
        $('#date_start_contract').val(today);
        setValue('/user-employee/data/' + uuid, 'user-employee');

    }

    function storeUserEmployee(idForm) {
        if (isRequiredCreate(['nik_employee']) > 0) {
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

    function newValue() {
        console.log('newValue')
        let company = $('#company_uuid').val();
        let contract_status = $('#contract_status').val();
        let date_start_contract = $('#date_start_contract').val();
        let contract_number = $('#contract_number').val();
        let date_now = new Date(date_start_contract);

        if (date_start_contract == ''){
            date_now = new Date();
        }

        let long_contract = $('#long_contract').val();
        let date_end_contract = $('#date_end_contract').val();

        let day = padToDigits(2, date_now.getDate());
        let month = padToDigits(2, date_now.getMonth() + 1);
        let year = date_now.getFullYear();

        let today = year + '-' + month + '-' + day;
        const next_date_now = new Date(today);
        next_date_now.setMonth(next_date_now.getMonth() + parseInt(long_contract) + 1);
        let next_day = padToDigits(2, next_date_now.getDate());
        let next_month = padToDigits(2, next_date_now.getMonth());
        let next_year = next_date_now.getFullYear();
        let next_today = next_year + '-' + next_month + '-' + next_day;
        $('#date_start_contract').val(today);
        $('#date_start-user-employee').val(today);
        $('#date_end_contract').val(next_today);


        let month_romawi = monthRomawi[parseInt(month)];
        if (contract_number == null) {
            contract_number = '001';

        }
        contract_number = padToDigits(3, contract_number)

        let next_contract_number = contract_number + '/' + contract_status + '/' + company + '/' + month_romawi + '/' +
            year;
        $('#contract_number_full').val(next_contract_number);

        let nik_employee = company + '-' + getLastNdigits(year, 2) + month + padToDigits(3, contract_number);
        console.log(nik_employee);
        $('#nik_employee').val(nik_employee);

    }
</script>