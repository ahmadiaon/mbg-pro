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
                            Total Jabatan
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
                            Total Karyawan
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

    {{-- <div class="row pb-10">
        <div class="col-md-12 mb-20">
            <div class="card-box height-100-p pd-20 overflow-auto">
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
                    <div class="h5 mb-md-0">Rata-rata gajih per jabatan</div>
                    <div class="form-group mb-md-0">
                        <select class="form-control form-control-sm selectpicker">
                            <option value="">Last Week</option>
                            <option value="">Last Month</option>
                            <option value="">Last 6 Month</option>
                            <option value="">Last 1 year</option>
                        </select>
                    </div>
                </div>
                <div style="width:3000px" id="activities-chart"></div>
            </div>
        </div>
    </div> --}}

    
    <div  class="bg-white pd-20 card-box mb-30">
        <div class=""  id="chart5"></div>
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
        $('#count-department').text(count_department)
        console.log(count_department)
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
                categories: ['Jan', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
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

        $.ajax({
                url: '/allowance/data',
                type: "POST",
                data:  {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        year_month: year_month,
                        from: 'index',
                    },
                success: function(response) {
					console.log(response)
					// $('#table-'+idForm).DataTable().ajax.reload();
                },
                error: function(response) {
                    alertModal()					
				}
            });



        $.ajax({
            url: '/allowance/data',
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                year_month: year_month,
                from: 'index',
            },
            success: function(response) {
                console.log(response)
                let data = response.data;
                let max = 0;
                let min = 1000000000;
                for (var key in data) {

                    let v = data[key];
                    data_name.push(v.position)
                    let vall = Math.trunc( v.avg)/1000;
                    vall =  Math.trunc(vall)/1000;
                    data_value.push(vall)

                    if(vall > max){
                        max = Math.trunc( vall)
                    }

                    if(vall < min){
                        min = Math.trunc( vall)
                    }
                }

                var options = {
                    series: [{
                            name: "Avg Gajih",
                            data: data_value
                            // data: [10, 15, 12, 20, 18, 26, 24, 25, 20, 25, 22, 30,30]
                        },
                        // {
                        //     name: "Consultations",
                        //     data: [15, 10, 17, 15, 23, 21, 30, 20, 26, 20, 28, 25]
                        // }
                    ],
                    chart: {
                        height: 300,
                        type: 'line',
                        zoom: {
                            enabled: false,
                        },
                        dropShadow: {
                            enabled: true,
                            color: '#000',
                            top: 18,
                            left: 7,
                            blur: 16,
                            opacity: 0.2
                        },
                        toolbar: {
                            show: false
                        }
                    },
                    colors: ['#f0746c', '#255cd3'],
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        width: [3, 3],
                        curve: 'smooth'
                    },
                    grid: {
                        show: false,
                    },
                    markers: {
                        colors: ['#f0746c', '#255cd3'],
                        size: 5,
                        strokeColors: '#ffffff',
                        strokeWidth: 2,
                        hover: {
                            sizeOffset: 2
                        }
                    },
                    xaxis: {
                        categories:data_name,
                        labels: {
                            style: {
                                colors: '#8c9094'
                            }
                        }
                    },
                    yaxis: {
                        min: min,
                        max: max,
                        labels: {
                            style: {
                                colors: '#8c9094'
                            }
                        }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        floating: true,
                        offsetY: 0,
                        labels: {
                            useSeriesColors: true
                        },
                        markers: {
                            width: 10,
                            height: 10,
                        }
                    }
                };

                var options2 = {
                    series: [{
                        name: 'Week',
                        data: [{
                            x: 'Monday',
                            y: 21
                        }, {
                            x: 'Tuesday',
                            y: 22
                        }, {
                            x: 'Wednesday',
                            y: 10
                        }, {
                            x: 'Thursday',
                            y: 28
                        }, {
                            x: 'Friday',
                            y: 16
                        }, {
                            x: 'Saturday',
                            y: 21
                        }, {
                            x: 'Sunday',
                            y: 13
                        }],
                    }],
                    chart: {
                        height: 70,
                        type: 'bar',
                        toolbar: {
                            show: false,
                        },
                        sparkline: {
                            enabled: true
                        },
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '25px',
                            distributed: true,
                            endingShape: 'rounded',
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: false
                    },
                    xaxis: {
                        type: 'category',
                        lines: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                        labels: {
                            show: false,
                        },
                    },
                    yaxis: [{
                        y: 0,
                        offsetX: 0,
                        offsetY: 0,
                        labels: {
                            show: false,
                        },
                        padding: {
                            left: 0,
                            right: 0
                        },
                    }],
                };

                var options3 = {
                    series: [{
                        name: 'Week',
                        data: [{
                            x: 'Monday',
                            y: 10
                        }, {
                            x: 'Tuesday',
                            y: 8
                        }, {
                            x: 'Wednesday',
                            y: 15
                        }, {
                            x: 'Thursday',
                            y: 12
                        }, {
                            x: 'Friday',
                            y: 20
                        }, {
                            x: 'Saturday',
                            y: 14
                        }, {
                            x: 'Sunday',
                            y: 7
                        }],
                    }],
                    colors: ['#ffffff', '#ffffff', '#ffffff', '#ffffff', '#ffffff', '#ffffff', '#ffffff'],
                    chart: {
                        height: 70,
                        type: 'bar',
                        toolbar: {
                            show: false,
                        },
                        sparkline: {
                            enabled: true
                        },
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '25px',
                            distributed: true,
                            endingShape: 'rounded',
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: false
                    },
                    xaxis: {
                        type: 'category',
                        lines: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                        labels: {
                            show: false,
                        },
                    },
                    yaxis: [{
                        y: 0,
                        offsetX: 0,
                        offsetY: 0,
                        labels: {
                            show: false,
                        },
                        padding: {
                            left: 0,
                            right: 0
                        },
                    }],
                };

                var options4 = {
                    series: [50, 60, 70, 80],
                    chart: {
                        height: 350,
                        type: 'radialBar',
                    },
                    colors: ['#003049', '#d62828', '#f77f00', '#fcbf49', '#e76f51'],
                    plotOptions: {
                        radialBar: {
                            dataLabels: {
                                name: {
                                    fontSize: '22px',
                                },
                                value: {
                                    fontSize: '16px',
                                },
                                total: {
                                    show: true,
                                    label: 'Total',
                                    formatter: function(w) {
                                        return 260
                                    }
                                }
                            }
                        }
                    },
                    labels: ['Flu', 'Covid-19', 'Pheumoniae', 'Diabeties'],
                };

                var chart = new ApexCharts(document.querySelector("#activities-chart"), options);
                chart.render();

                // var chart2 = new ApexCharts(document.querySelector("#appointment-chart"), options2);
                // chart2.render();

                // var chart3 = new ApexCharts(document.querySelector("#surgery-chart"), options3);
                // chart3.render();

                var chart4 = new ApexCharts(document.querySelector("#diseases-chart"), options4);
                chart4.render();

                // datatable init
                $('document').ready(function() {
                    $('.data-table').DataTable({
                        scrollCollapse: false,
                        autoWidth: false,
                        responsive: true,
                        searching: false,
                        bLengthChange: false,
                        bPaginate: true,
                        bInfo: false,
                        columnDefs: [{
                            targets: "datatable-nosort",
                            orderable: false,
                        }],
                        "lengthMenu": [
                            [5, 25, 50, -1],
                            [5, 25, 50, "All"]
                        ],
                        "language": {
                            "info": "_START_-_END_ of _TOTAL_ entries",
                            searchPlaceholder: "Search",
                            paginate: {
                                next: '<i class="ion-chevron-right"></i>',
                                previous: '<i class="ion-chevron-left"></i>'
                            }
                        },
                    });
                });
            },
            error: function(response) {
                alertModal()
            }
        });
        let data_value_jso = [10, 15, 12, 20, 18, 26, 24, 25, 20, 25, 22, 30, 30]
    </script>
@endsection
