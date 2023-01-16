<script src="/src/plugins/cropperjs/dist/cropper.js"></script>
    <script>
        window.addEventListener("DOMContentLoaded", function() {
            var image = document.getElementById("image");
            var cropBoxData;
            var canvasData;
            var cropper;

            $("#modal")
                .on("shown.bs.modal", function() {
                    cropper = new Cropper(image, {
                        autoCropArea: 0.5,
                        dragMode: "move",
                        aspectRatio: 3 / 3,
                        restore: false,
                        guides: false,
                        center: false,
                        highlight: false,
                        cropBoxMovable: false,
                        cropBoxResizable: false,
                        toggleDragModeOnDblclick: false,
                        ready: function() {
                            cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                        },
                    });
                })
                .on("hidden.bs.modal", function() {
                    cropBoxData = cropper.getCropBoxData();
                    canvasData = cropper.getCanvasData();
                    cropper.destroy();
                });
        });

        function firstShowEmployee(nik_employee) {
            premis.forEach(element => {
                $('.index-employee-' + element.uuid).text(employees[element.uuid])
            });
            let dataShow = employees[nik_employee]
            for (var key in dataShow) {
                if (dataShow[key] != null) {
                    $('.index-employee-' + key).text(dataShow[key])
                } else {
                    $('.index-employee-' + key + '-hide').hide()
                }
            }

            $('.index-employee-user-detail').attr('onclick', `editProfile('create-user-detail','${dataShow.nik_employee}')`);
            $('.index-employee-user-address').attr('onclick', `editProfile('create-user-address','${dataShow.nik_employee}')`);
            $('.index-employee-user-health').attr('onclick', `editProfile('create-user-health','${dataShow.nik_employee}')`);
            $('.index-employee-create-employee').attr('onclick', `editProfile('create-user-employee','${dataShow.nik_employee}')`);
            $('.index-employee-user-dependent').attr('onclick', `editProfile('create-user-dependent','${dataShow.nik_employee}')`);
            $('.index-employee-user-license').attr('onclick', `editProfile('create-user-license','${dataShow.nik_employee}')`);
            $('.index-employee-user-education').attr('onclick', `editProfile('create-user-education','${dataShow.nik_employee}')`);

        }

        function editProfile(table, nik_employee){
            $('#isEdit-'+table).val('true');
            choosePage(table,nik_employee);
        }
    </script>