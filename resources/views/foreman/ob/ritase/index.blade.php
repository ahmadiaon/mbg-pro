@extends('layout_adm.main')

@section('content')
{{-- @dd($over_burden->checker_employee_id) --}}
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="row clearfix">
                @foreach($over_burden_operators as $over_burden_operator)
                <div class="col-lg-6 col-md-12 col-sm-12 mb-30">
                    <div class="pd-20 card-box">
                        <h5 class="h4 text-blue mb-20">{{$over_burden_operator->group_code}}-{{$over_burden_operator->number}} | {{$over_burden_operator->name }}</h5>
                        <div class="tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a
                                        class="nav-link active text-blue"
                                        data-toggle="tab"
                                        href="#home-{{$over_burden_operator->over_burden_operator_uuid}}"
                                        role="tab"
                                        aria-selected="true"
                                        >BCM</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link text-blue"
                                        data-toggle="tab"
                                        href="#profile-{{$over_burden_operator->over_burden_operator_uuid}}"
                                        role="tab"
                                        aria-selected="false"
                                        >Ritase</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link text-blue"
                                        data-toggle="tab"
                                        href="#contact-{{$over_burden_operator->over_burden_operator_uuid}}"
                                        role="tab"
                                        aria-selected="false"
                                        >Contact</a
                                    >
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div
                                    class="tab-pane fade show active"
                                    id="home-{{$over_burden_operator->over_burden_operator_uuid}}"
                                    role="tabpanel"
                                >
                                    <div class="pd-20">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex
                                        ea commodo consequat. Duis aute irure dolor in
                                        reprehenderit in voluptate velit esse cillum dolore eu
                                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                        non proident, sunt in culpa qui officia deserunt mollit
                                        anim id est laborum.
                                    
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile-{{$over_burden_operator->over_burden_operator_uuid}}" role="tabpanel">
                                    <div class="pd-20">
                                        <div class="row">
                                            @for ($i =0; $i <= 23; $i++)
                                            <div class="col-1">
                                                @foreach($over_burden_operator->ritase as $ritase)
                                                    @if(date('H', strtotime($ritase->over_burden_time)) == $i)
                                                    
                                                         {{-- <b>{{date('H', strtotime($ritase->over_burden_time))}}</b> --}}
                                                            <label for="">{{date('H:i', strtotime($ritase->over_burden_time))}}</label>
                                                  
                                                    @endif
                                                @endforeach   
                                            </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact-{{$over_burden_operator->over_burden_operator_uuid}}" role="tabpanel">
                                    <div class="pd-20">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex
                                        ea commodo consequat. Duis aute irure dolor in
                                        reprehenderit in voluptate velit esse cillum dolore eu
                                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                        non proident, sunt in culpa qui officia deserunt mollit
                                        anim id est laborum.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
                
            </div>
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank"
                >Ankit Hingarajiya</a
            >
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ env('APP_URL') }}vendors/scripts/dashboard3.js"></script>

<script>

</script>
@endsection