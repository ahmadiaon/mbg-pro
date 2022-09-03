@extends('dashboard.layouts.main')
@section('container')
<div class="row">
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <div class="d-flex flex-wrap align-items-center">
                <div class="progress-data">
                    <div id="chart"></div>
                </div>
                <div class="widget-data">
                    <div class="h4 mb-0">{{$user}}</div>
                    <div class="weight-600 font-14">User</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <div class="d-flex flex-wrap align-items-center">
                <div class="progress-data">
                    <div id="chart2"></div>
                </div>
                <div class="widget-data">
                    <div class="h4 mb-0">{{$business}}</div>
                    <div class="weight-600 font-14">UMKM</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <div class="d-flex flex-wrap align-items-center">
                <div class="progress-data">
                    <div id="chart3"></div>
                </div>
                <div class="widget-data">
                    <div class="h4 mb-0">{{$community}}</div>
                    <div class="weight-600 font-14">Community</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 mb-30">
        <div class="card-box height-100-p widget-style1">
            <div class="d-flex flex-wrap align-items-center">
                <div class="progress-data">
                    <div id="chart4"></div>
                </div>
                <div class="widget-data">
                    <div class="h4 mb-0">{{$tour}}</div>
                    <div class="weight-600 font-14">Wisata</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-8 mb-30">
        <div class="card-box height-100-p pd-20">
            <h2 class="h4 mb-20">Activity</h2>
            <div id="chart5"></div>
        </div>
    </div>
    <div class="col-xl-4 mb-30">
        <div class="card-box height-100-p pd-20">
            <h2 class="h4 mb-20">Lead Target</h2>
            <div id="chart6"></div>
        </div>
    </div>
</div>
@endsection
