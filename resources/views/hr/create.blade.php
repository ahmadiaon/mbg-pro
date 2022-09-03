@extends('layout_adm.main')
@section('head')
<link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}src/plugins/jquery-steps/jquery.steps.css" />
@endsection
@section('content')
<div class="main-container">
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <h4 class="text-blue h4">Step wizard</h4>
            <p class="mb-30">jQuery Step wizard</p>
        </div>
        <div class="wizard-content">
            <form class="tab-wizard wizard-circle wizard">
                <h5>Personal Info</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name :</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name :</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Address :</label>
                                <input type="email" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number :</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select City :</label>
                                <select class="custom-select form-control">
                                    <option value="">Select City</option>
                                    <option value="Amsterdam">India</option>
                                    <option value="Berlin">UK</option>
                                    <option value="Frankfurt">US</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date of Birth :</label>
                                <input type="text" class="form-control date-picker" placeholder="Select Date" />
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Step 2 -->
                <h5>Job Status</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Job Title :</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Name :</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Job Description :</label>
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Step 3 -->
                <h5>Interview</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Interview For :</label>
                                <input type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Interview Type :</label>
                                <select class="form-control">
                                    <option>Normal</option>
                                    <option>Difficult</option>
                                    <option>Hard</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Interview Date :</label>
                                <input type="text" class="form-control date-picker" placeholder="Select Date" />
                            </div>
                            <div class="form-group">
                                <label>Interview Time :</label>
                                <input class="form-control time-picker" placeholder="Select time" type="text" />
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Step 4 -->
                <h5>Remark</h5>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Behaviour :</label>
                                <input type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Confidance</label>
                                <input type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Result</label>
                                <select class="form-control">
                                    <option>Select Result</option>
                                    <option>Selected</option>
                                    <option>Rejected</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Comments</label>
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>

    <div class="footer-wrap pd-20 mb-20 card-box">
        DeskApp - Bootstrap 4 Admin Template By
        <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
    </div>
</div>

@endsection

@section('js')

<script src="{{ env('APP_URL') }}src/plugins/jquery-steps/jquery.steps.js"></script>
<script src="{{ env('APP_URL') }}vendors/scripts/steps-setting.js"></script>
<script>
    //  
    $("#married").hide(); 
    const select = document.getElementById('status');
    select.addEventListener('change', function handleChange(event) {
        var status = event.target.value;
        if(status == 'Lajang'){
            $("#married").hide();
        }
        if(status == 'Duda'){
            
            $("#married").show();
            $("#out_law").hide();
        }
        if(status == 'Janda'){
            
            $("#married").show();
            $("#out_law").hide();
        }
        if(status == 'Menikah'){
            console.log('menikah')
            $("#married").show();
            $("#out_law").show();
        }
        console.log(); // 👉️ get selected VALUE
    });
    const select_gender = document.getElementById('gender');
    select_gender.addEventListener('change', function handleChange(event) {
        var status = event.target.value;
        console.log(status)
        if(status == 'Laki-laki'){
            $("#couple_gender option[value='Perempuan']").attr('selected', 'selected');
        }else{
            $("#couple_gender option[value='Laki-laki']").attr('selected', 'selected');
        }
    });
</script>

@endsection