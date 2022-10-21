@extends('template.admin.main_privilege')

@section('content')
    <div class="card-box mb-30 " >
        <div class="row pd-20">
            <div class="col-auto">
                <h4 class="text-blue h4">Absensi {{$employee->user_details->name}} - {{$employee->position}}</h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">
                    <div class="btn-group dropdown">
                        <button
                            type="button"
                            class="btn btn-secondary dropdown-toggle waves-effect"
                            data-toggle="dropdown"
                            aria-expanded="false"
                            id="btn-year"
                        >
                             <span class="caret"></span>
                        </button>
                        
                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="refreshTable(2021,null)" href="#">2021</a>
                            <a class="dropdown-item" onclick="refreshTable(2022,null)" href="#">2022</a>                            
                            <a class="dropdown-item" onclick="refreshTable(2023,null)" href="#">2023</a>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <button
                            type="button"
                            class="btn btn-secondary dropdown-toggle waves-effect"
                            data-toggle="dropdown"
                            aria-expanded="false"
                            id="btn-month"
                            value=""
                        >
                             <span class="caret"></span>
                        </button>
                        
                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="refreshTable(null, 1 )" href="#">Januari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 2 )" href="#">Februari</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 3 )" href="#">Maret</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 4 )" href="#">April</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 5 )" href="#">Mei</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 6 )" href="#">Juni</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 7 )" href="#">Juli</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 8 )" href="#">Agustus</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 9 )" href="#">September</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 10 )" href="#">Oktober</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 11 )" href="#">November</a>
                            <a class="dropdown-item" onclick="refreshTable(null, 12 )" href="#">Desember</a>
                        </div>
                    </div>
                    <div class="btn-group dropdown">
                        <button
                            type="button"
                            class="btn btn-primary dropdown-toggle waves-effect"
                            data-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Menu <span class="caret"></span>
                        </button>
                        
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/payrol/absensi/month/export/{{$month}}/export">Export</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#import-modal" href="">Import</a>
                        </div>
                    </div>
                    
                </div>
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
                                            <input {{($absen['status_absen_code'] == $item->status_absen_code)?'checked':'' }} type="radio" id="{{ $absen['date']  }}-{{$item->status_absen_code}}" name="{{ $absen['date']  }}" class="custom-control-input">
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
@endsection