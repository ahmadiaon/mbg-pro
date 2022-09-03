@extends('dashboard.manage.layouts.table')
@section('container')
<div class="card-box mb-30">
    <div class="pd-20" style="padding-bottom: 60px;">
        <h4 style="position: absolute;" class="text-blue h4">Data {{ $title }}</h4>
    </div>
    <div class="pb-20">
        <table id="myTablse" class="table table-stripped">
            <thead>
                <tr>
                    <th width="20%">Nama</th>
                    <th width="5%">Umur</th>
                    <th width="20%">No HP</th>
                    <th width="10%">Instagram</th>
                    <th width="30%">Komunitas</th>
                    <th width="12%">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
{{-- modal hapus --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">Are you sure you want to Delete this Registers?</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                            onclick="myClose()"><i class="fa fa-times"></i></button>
                        NO
                    </div>
                    <div class="col-6">
                        <form id="form_id" action="" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-check"></i></button>
                            YES
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascripts')
<script>
    $(function() {
    $('#myTablse').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('bank-loan-data') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'name', name: 'name' },
            { data: 'name', name: 'name' },
            { data: 'name', name: 'name' },
            { data: 'name', name: 'name' },
            { data: 'action', name: 'action' }
        ]
    });
});

</script>
<script>
    function myFunction(name,job) {
        // document.getElementById("demo").innerHTML = "Welcome " + name + ", the " + job + ".";
        $("#myModal").modal('show');
        var action  = "/bank-loan/"+name;
        document.getElementById("form_id").action = action;
        console.log(name);
    }
    function myClose() {
        $("#myModal").modal('hide');
    }
</script>
@endsection
