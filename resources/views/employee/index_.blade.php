<div id="index-employee" class="children-content">
    <div class="card-box mb-30 ">
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Daftar Karyawan</h4>
            </div>
            <div class="col text-right" <div class="btn-group">
                <div class="btn-group dropdown">
                    <button onclick="exportData()" type="date" class="btn btn-danger" data-toggle="dropdown"
                        aria-expanded="false">
                        Export Data <span class="caret"></span>
                    </button>
                </div>
                @if (!empty(session('dataUser')->create_employee))
                    <div class="btn-group dropdown">
                        <button onclick="choosePage('create-user-detail', null)" type="date" class="btn btn-secondary"
                            aria-expanded="false">
                            Tambah Karyawan <span class="caret"></span>
                        </button>
                    </div>
                @endif
                <div class="btn-group dropdown">
                    <button type="date" class="btn btn-primary dropdown-toggle waves-effect"
                        data-toggle="dropdown" aria-expanded="false">
                        Menu <span class="caret"></span>
                    </button>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" id="btn-export" href="/user/export-simple/">Template Simpel
                        </a>
                        <a class="dropdown-item disabled" id="btn-export" href="#">Template Full
                        </a>
                        <a class="dropdown-item" id="btn-import" data-toggle="modal" data-target="#import-modal"
                            href="">Import</a>
                    </div>
                </div>

            </div>
        </div>


        <div class="pb-20" id="tablePrivilege">
            <table id="table-privilege" class="display nowrap stripe hover table" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Status Karyawan</th>
                        <th>Perusahaan</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Simple Datatable End -->

    {{-- modal add user privilege --}}
    <div class="modal fade bs-example-modal-lg" id="createModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Eksport Data Karyawan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select name="" id="">

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple Datatable End -->
    <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form-import" action="/user/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import Karawan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih Karawan</label>
                            <input name="uploaded_file" type="file"
                                class="form-control-file form-control height-auto" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" onclick="startLoading()" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>