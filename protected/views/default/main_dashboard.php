<!DOCTYPE html>
<html lang="en">

<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8">
    <title>HRCMS - Human Resource Management System</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/assets/fonts/open-sans/styles.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/tether/css/tether.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/jscrollpane/jquery.jscrollpane.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/assets/styles/common.min.css">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/assets/styles/themes/primary.min.css">
    <!-- END THEME STYLES -->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/assets/styles/widgets/panels.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/assets/scripts/charts/area/area.chart.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/assets/scripts/charts/radial-progress/radial-progress.chart.min.css">
</head>
<!-- END HEAD -->

<body class="ks-navbar-fixed ks-sidebar-default ks-sidebar-fixed ks-theme-primary">

<!-- BEGIN HEADER -->
<nav class="navbar ks-navbar">
    <!-- BEGIN HEADER INNER -->
    <!-- BEGIN LOGO -->
    <div href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard" class="navbar-brand">
        <!-- BEGIN RESPONSIVE SIDEBAR TOGGLER -->
        <a href="#" class="ks-sidebar-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
        <a href="#" class="ks-sidebar-mobile-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
        <!-- END RESPONSIVE SIDEBAR TOGGLER -->
        <a href="#" class="ks-logo">HR-CMS</a>

        <!-- BEGIN GRID NAVIGATION -->
        <span class="nav-item dropdown ks-dropdown-grid">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"></a>
            <div class="dropdown-menu ks-info ks-scrollable" aria-labelledby="Preview" data-height="100">
                <div class="ks-scroll-wrapper">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard" class="ks-grid-item">
                        <span class="ks-icon fa fa-dashboard"></span>
                        <span class="ks-text">Dashboard</span>
                    </a>

                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/offerletter" class="ks-grid-item">
                        <span class="ks-icon fa fa-flask"></span>
                        <span class="ks-text">Offer Letter</span>
                    </a>
                   <!--<a href="<?php //echo Yii::app()->request->baseUrl; ?>/staff"  class="ks-grid-item">
                        <span class="ks-icon fa fa-ticket"></span>
                        <span class="ks-text">Staff</span>
                    </a>-->
                    <!--<a href="<?php //echo Yii::app()->request->baseUrl; ?>/recruitment" class="ks-grid-item">
                        <span class="ks-icon fa fa-flask"></span>
                        <span class="ks-text">Recruitment</span>
                    </a>-->
                    <!--<a href="<?php //echo Yii::app()->request->baseUrl; ?>/training"  class="ks-grid-item">
                        <span class="ks-icon fa fa-globe"></span>
                        <span class="ks-text">Training</span>
                    </a>
                    <a href="<?php //echo Yii::app()->request->baseUrl; ?>/permit"  class="ks-grid-item">
                        <span class="ks-icon fa fa-globe"></span>
                        <span class="ks-text">Permit</span>
                    </a>
                    <a href="<?php //echo Yii::app()->request->baseUrl; ?>/attendance"  class="ks-grid-item">
                        <span class="ks-icon fa fa-globe"></span>
                        <span class="ks-text">Attendance</span>
                    </a>
                    <a href="<?php //echo Yii::app()->request->baseUrl; ?>/claim"  class="ks-grid-item">
                        <span class="ks-icon fa fa-calendar-o"></span>
                        <span class="ks-text">Claim</span>
                    </a>
                    <a href="<?php //echo Yii::app()->request->baseUrl; ?>/setting" class="ks-grid-item">
                        <span class="ks-icon fa fa-dashboard"></span>
                        <span class="ks-text">Global Setting</span>
                    </a>-->
                </div>
            </div>
        </span>
        <!-- END GRID NAVIGATION -->
    </div>
    <!-- END LOGO -->

    <!-- BEGIN MENUS -->
    <div class="ks-wrapper">
        <nav class="nav navbar-nav">
            <!-- BEGIN NAVBAR MENU -->
            <div class="ks-navbar-menu">
                <a class="nav-item nav-link" href="#">Dashboard</a>
            </div>
            <!-- END NAVBAR MENU -->

            <!-- BEGIN NAVBAR ACTIONS -->
            <div class="ks-navbar-actions">

                <!-- BEGIN NAVBAR USER -->
                <div class="nav-item dropdown ks-user">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="ks-avatar">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/assets/img/avatars/ava-64.png" width="36" height="36">
                        </span>
                        <span class="ks-info">
                            <span class="ks-name">Robert Dean</span>
                            <span class="ks-description">Premium User</span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Preview">
                        <!--<a class="dropdown-item" href="#">
                            <span class="fa fa-user-circle-o ks-icon"></span>
                            <span>Profile</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <span class="fa fa-wrench ks-icon" aria-hidden="true"></span>
                            <span>Settings</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <span class="fa fa-question-circle ks-icon" aria-hidden="true"></span>
                            <span>Help</span>
                        </a>-->
                        <a class="dropdown-item" href="<?php echo Yii::app()->request->baseUrl; ?>/default/logout">
                            <span class="fa fa-sign-out ks-icon" aria-hidden="true"></span>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
                <!-- END NAVBAR USER -->
            </div>
            <!-- END NAVBAR ACTIONS -->
        </nav>

    </div>
    <!-- END MENUS -->
    <!-- END HEADER INNER -->
</nav>
<!-- END HEADER -->

<?php echo $content ?>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/jquery/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/responsejs/response.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/loading-overlay/loadingoverlay.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/tether/js/tether.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/jscrollpane/jquery.jscrollpane.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/jscrollpane/jquery.mousewheel.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/flexibility/flexibility.js"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/assets/scripts/common.min.js"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/d3/d3.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/libs/count-up/count-up.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/assets/scripts/charts/area/area.chart.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/assets/scripts/charts/radial-progress/radial-progress.chart.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/hr/assets/scripts/charts/bar/inline-bar.chart.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function() {
                var memoryRadialProgressChart = new KosmoCharts.RadialProgress('#ks-memory-radial-progress-chart', {
                    lineWidth: 8,
                    size: 50,
                    showAmount: false,
                    amount: 25
                });
                memoryRadialProgressChart.render();

                var cpuRadialProgressChart = new KosmoCharts.RadialProgress('#ks-cpu-radial-progress-chart', {
                    lineWidth: 8,
                    size: 50,
                    showAmount: false,
                    amount: 50
                });
                cpuRadialProgressChart.render();

                google.charts.load('current', {'packages':['corechart', 'bar', 'line']});
                google.charts.setOnLoadCallback(drawBarChart);
                google.charts.setOnLoadCallback(drawLineChart);
                google.charts.setOnLoadCallback(drawPieChart);
                google.charts.setOnLoadCallback(drawPieChart2);
                google.charts.setOnLoadCallback(function () {
                    var data = google.visualization.arrayToDataTable([
                        ['Memory', 'Usages'],
                        [10,  20],
                        [11,  50],
                        [12,  10],
                        [13,  80],
                        [14,  20],
                        [15,  90],
                        [16,  60],
                        [17,  30],
                        [18,  50],
                        [19,  20],
                        [20,  40],
                        [21,  50],
                        [22,  90],
                        [23,  80],
                        [24,  20],
                        [25,  90],
                        [26,  50],
                        [27,  30],
                        [28,  60],
                        [29,  30]
                    ]);

                    var options = {
                        title: null,
                        height: 40,
                        legend: {position: 'none'},
                        backgroundColor: {
                            fill: 'transparent'
                        },
                        chartArea:{
                            left:0,
                            top:0,
                            right: 0,
                            height: 40
                        },
                        lineWidth: 1,
                        colors:['#efc8ea','#f5daf1'],
                        hAxis: {
                            baselineColor: 'none',
                            gridlines: {
                                color: '#fff'
                            }
                        },
                        vAxis: {
                            baselineColor: 'none',
                            maxValue: 115,
                            gridlines: {
                                color: '#e1e5f0'
                            }
                        }
                    };

                    var chart = new google.visualization.AreaChart(document.getElementById('ks-memory-area-chart'));
                    chart.draw(data, options);
                });
                google.charts.setOnLoadCallback(function () {
                    var data = google.visualization.arrayToDataTable([
                        ['CPU', 'Usages'],
                        [10,  30],
                        [11,  50],
                        [12,  10],
                        [13,  80],
                        [14,  20],
                        [15,  90],
                        [16,  60],
                        [17,  30],
                        [18,  50],
                        [19,  20],
                        [20,  40],
                        [21,  50],
                        [22,  90],
                        [23,  80],
                        [24,  20],
                        [25,  90],
                        [26,  50],
                        [27,  30],
                        [28,  60],
                        [29,  30]
                    ]);

                    var options = {
                        title: null,
                        height: 40,
                        legend: {position: 'none'},
                        backgroundColor: {
                            fill: 'transparent'
                        },
                        chartArea:{
                            left:0,
                            top:0,
                            right: 0,
                            height: 40
                        },
                        lineWidth: 1,
                        colors:['#c4cbe1','#ebeef5'],
                        hAxis: {
                            baselineColor: 'none',
                            gridlines: {
                                color: '#fff'
                            }
                        },
                        vAxis: {
                            baselineColor: 'none',
                            maxValue: 115,
                            gridlines: {
                                color: '#e1e5f0'
                            }
                        }
                    };

                    var chart = new google.visualization.AreaChart(document.getElementById('ks-cpu-area-chart'));
                    chart.draw(data, options);
                });

                function drawBarChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Year', 'Sales', 'Expenses', 'Profit'],
                        ['2014', 1000, 400, 200],
                        ['2015', 1170, 460, 250],
                        ['2016', 660, 1120, 300],
                        ['2017', 1030, 540, 350]
                    ]);

                    var options = {
                        chart: {
                            title: 'Company Performance',
                            subtitle: 'Sales, Expenses, and Profit: 2014-2017'
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('ks-bar-chart'));

                    chart.draw(data, options);
                }

                function drawLineChart() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('number', 'Day');
                    data.addColumn('number', 'Guardians of the Galaxy');
                    data.addColumn('number', 'The Avengers');
                    data.addColumn('number', 'Transformers: Age of Extinction');
                    data.addRows([
                        [1,  37.8, 80.8, 41.8],
                        [2,  30.9, 69.5, 32.4],
                        [3,  25.4,   57, 25.7],
                        [4,  11.7, 18.8, 10.5],
                        [5,  11.9, 17.6, 10.4],
                        [6,   8.8, 13.6,  7.7],
                        [7,   7.6, 12.3,  9.6],
                        [8,  12.3, 29.2, 10.6],
                        [9,  16.9, 42.9, 14.8],
                        [10, 12.8, 30.9, 11.6],
                        [11,  5.3,  7.9,  4.7],
                        [12,  6.6,  8.4,  5.2],
                        [13,  4.8,  6.3,  3.6],
                        [14,  4.2,  6.2,  3.4]
                    ]);

                    var options = {
                        chart: {
                            title: 'Box Office Earnings in First Two Weeks of Opening',
                            subtitle: 'in millions of dollars (USD)'
                        }
                    };

                    var chart = new google.charts.Line(document.getElementById('ks-line-chart'));

                    chart.draw(data, options);
                }

                function drawPieChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hou   rs per Day'],
                        ['Work',     11],
                        ['Eat',      2],
                        ['Commute',  2],
                        ['Watch TV', 2],
                        ['Sleep',    7]
                    ]);

                    var options = {
                        title: 'My Daily Activities',
                        height: 242,
                        chartArea: {
                            top: 50,
                            height: 180
                        },
                        titleTextStyle: {
                            color: '#757575',
                            fontSize: 16,
                            bold: false
                        },
                        legend: {
                            alignment: 'center'
                        }
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('ks-pie-chart'));
                    chart.draw(data, options);
                }

                function drawPieChart2() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hou   rs per Day'],
                        ['Work',     11],
                        ['Eat',      2],
                        ['Commute',  2],
                        ['Watch TV', 2],
                        ['Sleep',    7]
                    ]);

                    var options = {
                        title: 'My Daily Activities',
                        height: 242,
                        chartArea: {
                            top: 50,
                            height: 180
                        },
                        titleTextStyle: {
                            color: '#757575',
                            fontSize: 16,
                            bold: false
                        },
                        legend: {
                            alignment: 'center'
                        }
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('ks-pie-chart2'));
                    chart.draw(data, options);
                }

                var barChartBlock = $("#ks-bar-chart-panel .card-block");
                barChartBlock.LoadingOverlay("show");

                var lineChartBlock = $("#ks-line-chart-panel .card-block");
                lineChartBlock.LoadingOverlay("show");

                setTimeout(function () {
                    barChartBlock.LoadingOverlay("hide");
                    lineChartBlock.LoadingOverlay("hide");
                }, 1000);

                var options = {
                    useEasing : true,
                    useGrouping : true,
                    separator : ',',
                    decimal : '.',
                    prefix : '',
                    suffix : ''
                };

                $('.ks-amount[data-count-up]').each(function() {
                    var countUp = parseInt($(this).data('count-up'));
                    (new CountUp(this, 0, 6555, 0, 2, options)).start();
                });
            });
        })(jQuery);
    </script>
    <!-- END DASHBOARD SCRIPTS -->
    <div class="ks-mobile-overlay"></div>

</body>
</html>