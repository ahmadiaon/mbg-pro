@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 " >
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Absensi {{$employee->user_details->name}} - {{$employee->position}}</h4>
            </div>
        </div>
        <div id="the-table">
            {{-- @dd($absens) --}}
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">Date</th>
                            <th>Status</th>
                            <th>Cek Log</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absens as $absen)
                        <tr>
                            {{-- @dd($absen) --}}
                            <td class="table-plus"> {{ $absen['date'] }}</td>
                            <td>
                                <div class="row">
                                    @foreach ($status_absen as $item )
                                    <div class="col-sd-2">
                                        <div class="custom-control custom-radio mb-5">
                                            <input onchange="updateAbsen('{{$item->uuid}}','{{ $absen['date']}}')" {{($absen['status_absen_code'] == $item->status_absen_code)?'checked':'' }} type="radio" id="{{ $absen['date']  }}-{{$item->status_absen_code}}" name="{{ $absen['date']  }}" class="custom-control-input">
                                            <label class="custom-control-label" for="{{ $absen['date']  }}-{{$item->status_absen_code}}">{{$item->status_absen_code}}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                    </div>
                            </td>
                            <td class="table-plus"> {{ $absen['cek_log'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
    <button type="hidden" id="sa-custom-position"></button>
@endsection

@section('js')
<script>
    function updateAbsen(status_absen_uuid,date){
        let employee_uuid = @json($employee->machine_id);
        console.log(status_absen_uuid+date+employee_uuid);
        let _token   = $('meta[name="csrf-token"]').attr('content');
		let _url = "/user/absensi/store";

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                employee_uuid : employee_uuid,
                date : date,
                status_absen_uuid : status_absen_uuid,
                _token: _token
            },
            success: function(response) {
                console.log("response")
                console.log(response);
                $('#sa-custom-position').click();

            },
            error: function(response) {
                alertModal();
                console.log(response);
            }
        });
    }
</script>

@endsection