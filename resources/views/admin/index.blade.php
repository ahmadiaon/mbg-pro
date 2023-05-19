@extends('template.admin.main_privilege')

@section('content')
    <div class="title pb-20">
        <h2 class="h3 mb-0">Sumary</h2>
    </div>

    <div class="row pb-10">
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark" id="count-department">0</div>
                        <div class="font-14 text-secondary weight-500">
                            Department
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf">
                            <i class="icon-copy dw dw-calendar1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark" id="count-position">124,551</div>
                        <div class="font-14 text-secondary weight-500">
                            Jabatan
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#ff5b5b">
                            <span class="icon-copy ti-heart"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark" id="count-employee">400+</div>
                        <div class="font-14 text-secondary weight-500">
                            Total Karyawan Aktif
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon">
                            <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark" id="count-employee-out">$50,000</div>
                        <div class="font-14 text-secondary weight-500">Karyawan Out</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#09cc06">
                            <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white pd-20 card-box mb-30">
        <h4 class="h4 text-blue">Flow Keluar Masuk Karyawan</h4>
        <div id="chart3"></div>
    </div>



    <div class="bg-white pd-20 card-box mb-30">
        <div class="" id="chart5"></div>
    </div>
@endsection


@section('js')
    <script src="/src/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="/src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
    {{-- <script src="https://code.highcharts.com/highcharts-3d.js"></script> --}}
    <script src="/src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>

    <script>
        let department = @json($arr_department);
        let count_department = department.length;
        data_positions = data_database['data_positions'];
        data_departments = data_database['data_departments'];

        $('#count-position').text(Object.keys(data_positions).length);
        $('#count-department').text(Object.keys(data_departments).length);
        $('#count-employee').text(Object.keys(data_database['data_employees']).length - Object.keys(data_database[
            'data_employee_out']).length);
        $('#count-employee-out').text(Object.keys(data_database['data_employee_out']).length);
        let aa = [
            ['AppleSSs', 29.9, false],
            ['Pears', 80, false],
            ['Oranges', 106.4, false],
            ['Plums', 129.2, false],
            ['Bananas', 144.0, false],
            ['Peaches', 176.0, false],
            ['Prunes', 135.6, true, true],
            ['Avocados', 148.5, false]
        ];


        console.log(aa);
        Highcharts.chart('chart5', {
            title: {
                text: 'Karyawan per DEPARTEMEN'
            },
            xAxis: {
                categories: ['Jan', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                    'Dec'
                ]
            },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: department,
                showInLegend: true
            }]
        });

        let year_month = @json($year_month);
        year_month = '2022-10';
        let data_value = [];
        let data_name = [];
        let data_name_json;
        let data_value_json;

        let data_value_jso = [10, 15, 12, 20, 18, 26, 24, 25, 20, 25, 22, 30, 30]
        let data_for_grafik_flow_employee = @json($data_for_grafik_flow_employee);
        cg('data_for_grafik_flow_employee',data_for_grafik_flow_employee);

        var options3 = {
            series: [{
                name: 'Total',
                data: data_for_grafik_flow_employee['data_total']
            }, {
                name: 'Karywan Aktif',
                data: data_for_grafik_flow_employee['data_aktif']
            }, {
                name: 'Masuk',
                data: data_for_grafik_flow_employee['data_in']
            }, {
                name: 'Keluar',
                data: data_for_grafik_flow_employee['data_out']
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false,
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '25%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: data_for_grafik_flow_employee['month'],
            },
            yaxis: {
                title: {
                    text: 'Jumlah Karyawan'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return  val + " Orang"
                    }
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#chart3"), options3);
        chart.render();
    </script>
@endsection
