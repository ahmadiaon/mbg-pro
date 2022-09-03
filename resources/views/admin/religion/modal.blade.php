{{-- modal add position --}}
<div class="modal fade" data-backdrop="false" id="add_position_modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Position
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>

            <div class="modal-body">
                <form name="userForm">

                    <div class="form-group">
                        {{-- hidden --}}
                        <input type="hidden" name="id" id="id">
                        <label id="label_position" for="position">Position name</label>
                        <input type="text" class="form-control" name="position" id="position"
                            aria-describedby="emailHelp" placeholder="Enter position name">
                        <span id="positionError" class="alert-message"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="button" onclick="createPosition('/admin/position/')" class="btn btn-primary">
                    Save changes
                </button>
            </div>

        </div>
    </div>
</div>