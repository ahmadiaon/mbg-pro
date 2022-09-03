@extends('dashboard.manage.layouts.table')
@section('container')
<div class="card-box mb-30">
    <div class="pd-20" style="padding-bottom: 60px;">
        <h4 style="position: absolute;" class="text-blue h4">Data Youtube</h4>
        <a href="/youtube/create">
            <p class="btn btn-primary float-right">Tambah Youtube</p>
        </a>
    </div>
    @if(session()->has('success'))

    <div class="alert alert-primary alert-dismissible fade show mb-20" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
    <div class="pb-20">
        <table id="myTablse" class="table table-stripped">
            <thead>
                <tr>
                    <th width="20%">Judul</th>
                    <th width="30%">Link</th>
                    <th width="15%">Aktif</th>
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
                <h4 class="padding-top-30 mb-30 weight-500">Are you suhfdddre you want to Delete this Youtube?</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                            onclick="myClose()"><i class="fa fa-times"></i></button>
                        NO
                    </div>
                    <div class="col-6">
                        <form id="form_id" action="/slides/10" method="post" class="d-inline">
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
        ajax: '{!! route('youtube-data') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'url', name: 'url' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' }
        ]
    });
});

</script>
<script>
    function myFunction(name,job) {
        // document.getElementById("demo").innerHTML = "Welcome " + name + ", the " + job + ".";
        $("#myModal").modal('show');
        var action  = "/youtube/"+name;
        document.getElementById("form_id").action = action;
        console.log(name);
    }
    function myClose() {
        $("#myModal").modal('hide');
    }
</script>
@endsection
