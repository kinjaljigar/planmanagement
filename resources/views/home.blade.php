

@include('header')
<div class="wrapper wrapper-content">
        <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right"><?php echo date('d-m-y'); ?></span>
                                <h5>Customers</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">
									{{$NewCust}}/{{$ClosedCust}}
								</h1>
                                <div class="stat-percent font-bold text-success">{{$CustCount}} <i class="fa fa-bolt"></i></div>
                                <small>Total Customers</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right"><?php echo date('d-m-y'); ?></span>
                                <h5>Del. Boy Trans</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">0/0</h1>
                                <div class="stat-percent font-bold text-info"> <i class="fa fa-level-up"></i></div>
                                <small>With Delivery Boy</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right"><?php echo date('d-m-y'); ?></span>
                                <h5>Dealer</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">106,120</h1>
                                <!--<div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                                <small>New visits</small>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">Total</span>
                                <h5>Bills Pending</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">0</h1>
                                <div class="stat-percent font-bold text-danger"><i class="fa fa-level-down"></i></div>
                                <small>From Current Month</small>
                            </div>
                        </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Bottles/Jugs Taken</h5>
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-white active">This Month</button>
                                        <!--<button type="button" class="btn btn-xs btn-white">Monthly</button>
                                        <button type="button" class="btn btn-xs btn-white">Annual</button>-->
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                <div class="col-lg-9">
                                    <div class="flot-chart">
                                        <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <ul class="stat-list">
                                        <li>
                                            <h2 class="no-margins">2,346</h2>
                                            <small>Total taken by Customers</small>
                                            <!--<div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>-->
                                            <div class="progress progress-mini">
                                                <!--<div style="width: 48%;" class="progress-bar"></div>-->
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">4,422</h2>
                                            <small>Total Taken by Dealiver Boy</small>
                                            <!--<div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>-->
                                            <div class="progress progress-mini">
                                                <!--<div style="width: 60%;" class="progress-bar"></div>-->
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">9,180</h2>
                                            <small>Total Taken by Dealers</small>
                                            <!--<div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i></div>-->
                                            <div class="progress progress-mini">
                                                <!--<div style="width: 22%;" class="progress-bar"></div>-->
                                            </div>
                                        </li>
                                        </ul>
                                    </div>
                                </div>
                                </div>

                            </div>
                        </div>
                    </div>


                <div class="row">
<!--                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Last 15 Collections</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-lin	k">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content ibox-heading">
                                <h3><i class="fa fa-envelope-o"></i> New messages</h3>
                                <small><i class="fa fa-tim"></i> You have 22 new messages and 16 waiting in draft folder.</small>
                            </div>
                            <div class="ibox-content">
                                <div class="feed-activity-list">

                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right text-navy">1m ago</small>
                                            <strong>Monica Smith</strong>
                                            <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</div>
                                            <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                                        </div>
                                    </div>

                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">2m ago</small>
                                            <strong>Jogn Angel</strong>
                                            <div>There are many variations of passages of Lorem Ipsum available</div>
                                            <small class="text-muted">Today 2:23 pm - 11.06.2014</small>
                                        </div>
                                    </div>

                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">5m ago</small>
                                            <strong>Jesica Ocean</strong>
                                            <div>Contrary to popular belief, Lorem Ipsum</div>
                                            <small class="text-muted">Today 1:00 pm - 08.06.2014</small>
                                        </div>
                                    </div>

                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">5m ago</small>
                                            <strong>Monica Jackson</strong>
                                            <div>The generated Lorem Ipsum is therefore </div>
                                            <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                        </div>
                                    </div>


                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">5m ago</small>
                                            <strong>Anna Legend</strong>
                                            <div>All the Lorem Ipsum generators on the Internet tend to repeat </div>
                                            <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                        </div>
                                    </div>
                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">5m ago</small>
                                            <strong>Damian Nowak</strong>
                                            <div>The standard chunk of Lorem Ipsum used </div>
                                            <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                        </div>
                                    </div>
                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">5m ago</small>
                                            <strong>Gary Smith</strong>
                                            <div>200 Latin words, combined with a handful</div>
                                            <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
-->
                    <div class="col-lg-4">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Last 15 Collections</h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                            <a class="close-link">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <table class="table table-hover no-margins">
                                            <thead>
                                            <tr>
                                                <th>Collector</th>
                                                <th>Date</th>
                                                <th>Customer</th>
                                                <th>Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td colspan="4">Comming Soon...</td>
                                                
                                            </tr>
                                            <!--<tr>
                                                <td><span class="label label-warning">Canceled</span> </td>
                                                <td><i class="fa fa-clock-o"></i> 10:40am</td>
                                                <td>Monica</td>
                                                <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                                            </tr>
                                            <tr>
                                                <td><small>Pending...</small> </td>
                                                <td><i class="fa fa-clock-o"></i> 01:30pm</td>
                                                <td>John</td>
                                                <td class="text-navy"> <i class="fa fa-level-up"></i> 54% </td>
                                            </tr>
                                            <tr>
                                                <td><small>Pending...</small> </td>
                                                <td><i class="fa fa-clock-o"></i> 02:20pm</td>
                                                <td>Agnes</td>
                                                <td class="text-navy"> <i class="fa fa-level-up"></i> 12% </td>
                                            </tr>
                                            <tr>
                                                <td><small>Pending...</small> </td>
                                                <td><i class="fa fa-clock-o"></i> 09:40pm</td>
                                                <td>Janet</td>
                                                <td class="text-navy"> <i class="fa fa-level-up"></i> 22% </td>
                                            </tr>
                                            <tr>
                                                <td><span class="label label-primary">Completed</span> </td>
                                                <td><i class="fa fa-clock-o"></i> 04:10am</td>
                                                <td>Amelia</td>
                                                <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                                            </tr>
                                            <tr>
                                                <td><small>Pending...</small> </td>
                                                <td><i class="fa fa-clock-o"></i> 12:08am</td>
                                                <td>Damian</td>
                                                <td class="text-navy"> <i class="fa fa-level-up"></i> 23% </td>
                                            </tr>-->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                           </div>
                        </div>
                        <!--<div class="row">-->
                            <div class="col-lg-8">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Top 15 Bills pending</h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                            <a class="close-link">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content">

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table table-hover no-margins">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 1%" class="text-center">No.</th>
                                                        <th>Customer</th>
                                                        <th>Area</th>
                                                        <th>Delivery Boy</th>
                                                        <th>Collector</th>
                                                        <th class="text-center">Last Payment Date</th>
                                                        <th class="text-center">Last Payment Amt</th>
                                                        <th class="text-center">Total Pending Amt</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-center" colspan="8">Comming Soon</td>
                                                        <!--<td> Security doors
                                                            </td>
                                                        <td class="text-center small">16 Jun 2014</td>
                                                        <td class="text-center"><span class="label label-primary">$483.00</span></td>-->

                                                    </tr>
                                                    <!--<tr>
                                                        <td class="text-center">2</td>
                                                        <td> Wardrobes
                                                        </td>
                                                        <td class="text-center small">10 Jun 2014</td>
                                                        <td class="text-center"><span class="label label-primary">$327.00</span></td>

                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">3</td>
                                                        <td> Set of tools
                                                        </td>
                                                        <td class="text-center small">12 Jun 2014</td>
                                                        <td class="text-center"><span class="label label-warning">$125.00</span></td>

                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">4</td>
                                                        <td> Panoramic pictures</td>
                                                        <td class="text-center small">22 Jun 2013</td>
                                                        <td class="text-center"><span class="label label-primary">$344.00</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">5</td>
                                                        <td>Phones</td>
                                                        <td class="text-center small">24 Jun 2013</td>
                                                        <td class="text-center"><span class="label label-primary">$235.00</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">6</td>
                                                        <td>Monitors</td>
                                                        <td class="text-center small">26 Jun 2013</td>
                                                        <td class="text-center"><span class="label label-primary">$100.00</span></td>
                                                    </tr>-->
                                                    </tbody>
                                                </table>
                                            </div>
                                            
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                </div>
<!-- Mainly scripts -->

<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>

<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>

<script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>



<!-- Flot -->

<script src="{{asset('js/plugins/flot/jquery.flot.js')}}"></script>

<script src="{{asset('js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>

<script src="{{asset('js/plugins/flot/jquery.flot.spline.js')}}"></script>

<script src="{{asset('js/plugins/flot/jquery.flot.resize.js')}}"></script>

<script src="{{asset('js/plugins/flot/jquery.flot.pie.js')}}"></script>

<script src="{{asset('js/plugins/flot/jquery.flot.symbol.js')}}"></script>

<script src="{{asset('js/plugins/flot/curvedLines.js')}}"></script>





<!-- Peity -->

<script src="{{asset('js/plugins/peity/jquery.peity.min.js')}}"></script>

<script src="{{asset('js/demo/peity-demo.js')}}"></script>


<script src="{{asset('js/demo/flot-demo.js')}}"></script>


<!-- Custom and plugin javascript -->

<script src="{{asset('js/inspinia.js')}}"></script>



<!-- jQuery UI -->

<script src="{{asset('js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>





<!-- Jvectormap -->

<script src="{{asset('js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>

<script src="{{asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>



<!-- Sparkline -->

<script src="{{asset('js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>



<!-- Sparkline demo data  -->

<script src="{{asset('js/demo/sparkline-demo.js')}}"></script>



<!-- ChartJS-->

<script src="{{asset('js/plugins/chartJs/Chart.min.js')}}"></script>





<script>

    $(document).ready(function () {





        var lineData = {

            labels: ["January", "February", "March", "April", "May", "June", "July", "Auguset", "September",
                "October", "November", "December"],

            datasets: [

                {

                    label: "Employees",

                    backgroundColor: "rgba(26,179,148,0.5)",

                    borderColor: "rgba(26,179,148,0.7)",

                    pointBackgroundColor: "rgba(26,179,148,1)",

                    pointBorderColor: "#fff",


                },

                {

                    label: "New Courses",

                    backgroundColor: "rgba(220,220,220,0.5)",

                    borderColor: "rgba(220,220,220,1)",

                    pointBackgroundColor: "rgba(220,220,220,1)",

                    pointBorderColor: "#fff",



                }

            ]

        };



        var lineOptions = {

            responsive: true

        };





        var ctx = document.getElementById("lineChart").getContext("2d");

        new Chart(ctx, {type: 'line', data: lineData, options: lineOptions});





        var data1 = [

            [0, 4], [1, 8], [2, 5], [3, 10], [4, 4], [5, 16], [6, 5], [7, 11], [8, 6], [9, 11], [10, 30], [11, 10], [12, 13], [13, 4], [14, 3], [15, 3], [16, 6]

        ];

        var data2 = [

            [0, 1], [1, 0], [2, 2], [3, 0], [4, 1], [5, 3], [6, 1], [7, 5], [8, 2], [9, 3], [10, 2], [11, 1], [12, 0], [13, 2], [14, 8], [15, 0], [16, 0]

        ];

        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [

                data1, data2

            ],

            {

                series: {

                    lines: {

                        show: false,

                        fill: true

                    },

                    splines: {

                        show: true,

                        tension: 0.4,

                        lineWidth: 1,

                        fill: 0.4

                    },

                    points: {

                        radius: 0,

                        show: true

                    },

                    shadowSize: 2

                },

                grid: {

                    hoverable: true,

                    clickable: true,

                    tickColor: "#d5d5d5",

                    borderWidth: 1,

                    color: '#d5d5d5'

                },

                colors: ["#1ab394", "#1C84C6"],

                xaxis: {},

                yaxis: {

                    ticks: 4

                },

                tooltip: false

            }

        );



        var doughnutData = {

            labels: ["App", "Software", "Laptop"],

            datasets: [{

                data: [300, 50, 100],

                backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]

            }]

        };





        var doughnutOptions = {

            responsive: false,

            legend: {

                display: false

            }

        };





        var ctx4 = document.getElementById("doughnutChart").getContext("2d");

        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options: doughnutOptions});



        var doughnutData = {

            labels: ["App", "Software", "Laptop"],

            datasets: [{

                data: [70, 27, 85],

                backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]

            }]

        };





        var doughnutOptions = {

            responsive: false,

            legend: {

                display: false

            }

        };





        var ctx4 = document.getElementById("doughnutChart2").getContext("2d");

        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options: doughnutOptions});





        var d1 = [[1262304000000, 6], [1264982400000, 3057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 24302], [1280620800000, 24237], [1283299200000, 21004], [1285891200000, 12144], [1288569600000, 10577], [1291161600000, 10295]];

        var d2 = [[1262304000000, 5], [1264982400000, 200], [1267401600000, 1605], [1270080000000, 6129], [1272672000000, 11643], [1275350400000, 19055], [1277942400000, 30062], [1280620800000, 39197], [1283299200000, 37000], [1285891200000, 27000], [1288569600000, 21000], [1291161600000, 17000]];



        var data1 = [

            {label: "Data 1", data: d1, color: '#17a084'},

            {label: "Data 2", data: d2, color: '#127e68'}

        ];

        $.plot($("#flot-chart1"), data1, {

            xaxis: {

                tickDecimals: 0

            },

            series: {

                lines: {

                    show: true,

                    fill: true,

                    fillColor: {

                        colors: [{

                            opacity: 1

                        }, {

                            opacity: 1

                        }]

                    },

                },

                points: {

                    width: 0.1,

                    show: false

                },

            },

            grid: {

                show: false,

                borderWidth: 0

            },

            legend: {

                show: false,

            }

        });





    });

</script>



</body>



<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Sep 2017 12:19:48 GMT -->

</html>

