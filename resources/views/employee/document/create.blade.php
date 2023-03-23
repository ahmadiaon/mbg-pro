@extends('template.admin.main_privilege')

@section('content')
    <div class="the-content">

        <div id="create-user-document" class="children-content">
            <form action="/app/user/document/store" id="form-user-document" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="isEdit" id="isEdit-create-user-document">
                <input type="text" name="uuid" id="uuid-create-user-document">
                <input type="text" name="user_detail_uuid" id="user_detail_uuid-create-user-document">
                <div class="min-height-200px">
                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Dokumen</h4>
                            </div>
                        </div>
                        <div class="document-requirment">

                        </div>
                        <div class="clearfix">
                            <div class="pull-right">
                                <button type="button" onclick="storeUserDocument('user-document')" class="full-rigth btn btn-primary mr-20">Simpan</button>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- Dokumen Show -->
    <div class="modal fade" id="doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Document</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>                    
                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <iframe id="path_doc" src="" style="width:100%; height:500px;" frameborder="0"></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function firstCreateUserDocument() {
            cg('data_database', data_database);
            let uuid = @json(session('recruitment-user'))['detail']['nik_employee'];
            cg('uuid', uuid);
            if (uuid != null) {
                setValue('/get/data/' + uuid, 'user-document');
            }

        }

        function clickInputFile() {
            $('#fileinput').trigger('click');
        }

        function storeUserDocument(idForm) {
            globalStoreNoTable(idForm).then((data) => {
                let user = data.data;
                stopLoading();
                $('#success-modal-id').modal('show')
            })
        }

        Object.values(data_database.data_atribut_sizes.requirment).forEach(requirment_file_element => {
            let element_document = `
                        <div class="form-group row">
                            <label class="col-md-2">${requirment_file_element.name_atribut}</label>
                            <div class="col-9">
                                <input class="form-control" name="${requirment_file_element.uuid}" id="${requirment_file_element.uuid}"  type="file" id="fileinput"
                                    placeholder="Johnny Brown" />
                            </div>
                            <div class="col-1">
                                
                                <button type="button" id="show-${requirment_file_element.uuid}" class="btn btn-primary">
                                    <i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
            `;
            $('.document-requirment').append(element_document);
           
        });
        function showdoc(path) {
            $('#path_doc').attr("src", "{{ env('APP_URL') }}file/document/employee/" + path)
            $('#doc').modal('show')
        }

        firstCreateUserDocument();
    </script>
@endsection
