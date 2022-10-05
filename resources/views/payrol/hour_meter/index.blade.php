@extends('layout_adm.main')
@section('content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">

        <div class="pd-20 col-12 card-box mb-30">
            <div class="pd-20">
                <div class="row">
                    <div class="col-3">
                        <h4 class="text-blue h4">Hour Meter</h4>
                    </div>
                    <div class="col-9 text-right">
                        <div class="btn-group">
                           
                            <select
                                    class="selectpicker form-control mr-5"
                                    data-size="5"
                                    data-style="btn-outline-success"
                                    data-selected-text-format="count"
                                    multiple
                                >
                                @foreach($hour_meter_pricees as $price)
                                        <option selected>{{ $price->name}}</option>
                                    @endforeach
                                </select>
                            <div class="btn-group dropdown">
                                <button
                                    type="button"
                                    class="btn btn-light dropdown-toggle waves-effect"
                                    data-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    2022 <span class="caret"></span>
                                </button>
                                
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/payrol/month/9/export">2021</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter" href="">2022</a>
                                </div>
                            </div>
                            <div class="btn-group dropdown">
                                <button
                                    type="button"
                                    class="btn btn-light dropdown-toggle waves-effect"
                                    data-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    September <span class="caret"></span>
                                </button>
                                
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/payrol/hour-meter/2022-08">Agustus</a>
                                    <a class="dropdown-item" href="/payrol/hour-meter/2022-09">September</a>
                                    <a class="dropdown-item" href="/payrol/hour-meter/2022-10">Oktober</a>
                                </div>
                            </div>
                            <div class="btn-group dropdown">
                                <button
                                    type="button"
                                    class="btn btn-light dropdown-toggle waves-effect"
                                    data-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Menu <span class="caret"></span>
                                </button>
                                
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/payrol/month/9/export">Export</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter" href="">Import</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-20 ">
                <table id="myTablse" class="table table-stripped">
                    <thead>
                        <tr>
                            <th class="">NIK Karyawan</th>
                            <th class="">Name</th>
                            <th class="">Jabatan</th>
                            <th class="datatable-nosort sorting_disabled"> 
                                <form  class="form-inline">
                                @foreach($hour_meter_pricees as $price)
                                   <label  class="col-md-1 mr-1 text-center" name="" id="">{{ $price->name}}</label>
                                @endforeach
                                </form>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <form action="/payrol/month/9/import" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Import Data HM</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Pilih File HM</label>
                <input name="uploaded_file"
                    type="file"
                    class="form-control-file form-control height-auto"
                />
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </div>
    </form>
    </div>
  </div>
{{-- @dd($month) --}}
@endsection
@section('js')
<script>
     $(".theSelect2").select2();
</script>
<script>
    $(function() {
        $('#myTablse').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url(env('APP_URL').'payrol/dataHourMeterMonth/'.$month) }}',
            // ajax:  '{!! url(env('APP_URL').'payrol/dataHourMeterMonth/'.$month) !!}',
            columns: [
                { data: 'nik_employee', name: 'nik_employee' },
                { data: 'name', name: 'name' },
                { data: 'position', name: 'position' },
                { data: 'input', name: 'input' },
                { data: 'action', name: 'action' }
            ]
        });
    });
</script>
<script>
    function createPost(employee_uuid, hour_meter_price_uuid) {
        var value = document.getElementById(employee_uuid+hour_meter_price_uuid).value;
        var month = 9;
        var _url = "/payrol/store";
        let _token   = $('meta[name="csrf-token"]').attr('content');
        console.log(employee_uuid,hour_meter_price_uuid,month,value,_token)

        $.ajax({
              url: _url,
              type: "POST",
              data: {
                employee_uuid: employee_uuid,
                hour_meter_price_uuid: hour_meter_price_uuid,
                month:month,
                value:value,
                _token: _token
              },
              success: function(response) {
                console.log(response)
              },
              error: function(response) {
                console.log('udin')
                // $('#departmentError').text(response.responseJSON.errors.description);
              }
            });

    }
    
</script>
<script>
    function ChangeHref(){
    document.getElementById("a").setAttribute("onclick", "location.href='http://religiasatanista.ro'");
    }
    </script>
@endsection