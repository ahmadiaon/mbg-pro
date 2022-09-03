@extends('dashboard.manage.layouts.table')
@section('container')

<div class="card-box mb-30">
    <div class="pd-20" style="padding-bottom: 60px;">
        <h4 style="position: absolute;" class="text-blue h4">Data {{ $title }}</h4>


    </div>
    @if(session()->has('success'))
    <div class="alert alert-primary" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <div class="pb-20">
        <table id="myTablse" class="table table-stripped">
            <thead>
                <tr>
                    <th width="30%">User</th>
                    <th width="40%">UMKM</th>
                    <th width="15%">Aktif</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
@section('javascripts')

<script>
    $(function() {
     $('#myTablse').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('review-data') !!}',
         columns: [
             { data: 'user', name: 'user' },
             { data: 'name', name: 'name' },
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
        var action  = "/bank/"+name;
        document.getElementById("form_id").action = action;
        console.log(name);
    }
    function myClose() {
        $("#myModal").modal('hide');
    }
</script>
@endsection
