<div class="ks-container">

    <!--<div class="ks-column ks-sidebar ks-info">
        <div class="ks-wrapper">
            <ul class="nav nav-pills nav-stacked">
                <li class="nav-item dropdown">
                    <a class="nav-link"  href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="ks-icon fa fa-dashboard"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"  href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="ks-icon fa fa-cubes"></span>
                        <span>Staff</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php /*echo Yii::app()->request->baseUrl; */?>/recruitment/default/list">Recruitment List</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>-->

    <div class="ks-column ks-page">
        <!-- BEGIN DASHBOARD HEADER -->
        <div class="ks-header ks-header-with-addon">
            <section class="ks-title">
                <h3>Dashboard</h3>

                <div class="ks-controls">
                    <nav class="breadcrumb ks-default">
                        <a class="breadcrumb-item ks-breadcrumb-icon" href="#">
                            <span class="fa fa-home ks-icon"></span>
                        </a>
                        <span class="breadcrumb-item active" href="#">Dashboard</span>
                    </nav>

                    <button class="btn btn-primary-outline ks-light ks-header-addon-block-toggle" data-block-toggle=".ks-header-with-addon > .ks-addon">Addon</button>
                </div>
            </section>
        </div>
        <!-- END DASHBOARD HEADER -->

        <!-- BEGIN DASHBOARD CONTENT -->
        <div class="ks-content">
            <div class="ks-body">
                <div class="container-fluid ks-rows-section">
                                                  <button type="button"  class="btn btn-outline btn-danger btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/dashboard/default/manual/file/HR-CMS User Manual.docx'"> Download User Manual</button>
                   <!--<div class="row ks-widgets-collection">
                        <div class="col-lg-3">
                            <div class="ks-dashboard-widget ks-widget-amount-statistics ks-info">
                                <div class="ks-statistics">
                                    <span class="ks-amount" data-count-up="3119">0</span>
                                    <span class="ks-text">Total Recruitment Accepted</span>
                                </div>
                                <div class="ks-percent ks-down"><span class="ks-text">5%</span></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="ks-dashboard-widget ks-widget-amount-statistics ks-success">
                                <div class="ks-statistics">
                                    <span class="ks-amount" data-count-up="8201">0</span>
                                    <span class="ks-text">Total Offer Letter</span>
                                </div>
                                <div class="ks-percent ks-up"><span class="ks-text">6%</span></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="ks-dashboard-widget ks-widget-amount-statistics ks-purple">
                                <div class="ks-statistics">
                                    <span class="ks-amount" data-count-up="8201">0</span>
                                    <span class="ks-text">Total Claim</span>
                                </div>
                                <div class="ks-percent ks-up"><span class="ks-text">6%</span></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="ks-dashboard-widget ks-widget-amount-statistics ks-white">
                                <div class="ks-statistics">
                                    <span class="ks-amount" data-count-up="8201">0</span>
                                    <span class="ks-text">Total Staff</span>
                                </div>
                                <div class="ks-percent ks-up"><span class="ks-text">6%</span></div>
                            </div>
                        </div>
                    </div>-->
                   <!-- <div class="row ks-widgets-collection">
                        <div class="col-lg-12">
                            <div class="card panel panel-table">
                                <h5 class="card-header">
                                    New Staff join for the Past 60 days
                                </h5>
                                <div class="card-block ks-scrollable" data-height="290">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="1">#</th>
                                            <th>Search Terms</th>
                                            <th width="100">Views</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td scope="row">1</td>
                                            <td>The Dark Knight Rises (Google Russia)</td>
                                            <td class="ks-color-success ks-text-bold">317,233</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">2</td>
                                            <td>The Dark Knight Rises (Google Russia)</td>
                                            <td class="ks-color-success ks-text-bold">317,233</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">3</td>
                                            <td>The Dark Knight Rises (Google Russia)</td>
                                            <td class="ks-color-success ks-text-bold">317,233</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">4</td>
                                            <td>The Dark Knight Rises (Google Russia)</td>
                                            <td class="ks-color-success ks-text-bold">317,233</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">5</td>
                                            <td>The Dark Knight Rises (Google Russia)</td>
                                            <td class="ks-color-success ks-text-bold">317,233</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">6</td>
                                            <td>The Dark Knight Rises (Google Russia)</td>
                                            <td class="ks-color-success ks-text-bold">317,233</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">7</td>
                                            <td>The Dark Knight Rises (Google Russia)</td>
                                            <td class="ks-color-success ks-text-bold">317,233</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">8</td>
                                            <td>The Dark Knight Rises (Google Russia)</td>
                                            <td class="ks-color-success ks-text-bold">317,233</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">9</td>
                                            <td>The Dark Knight Rises (Google Russia)</td>
                                            <td class="ks-color-success ks-text-bold">317,233</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">10</td>
                                            <td>The Dark Knight Rises (Google Russia)</td>
                                            <td class="ks-color-success ks-text-bold">317,233</td>
                                        </tr>
                                        </tbody>
                                    </table>-->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row ks-widgets-collection">
                        <div class="col-lg-6">
                           <!-- <div id="ks-bar-chart-panel" class="card panel">
                                <h5 class="card-header">
                                    Bar chart

                                    <div class="ks-controls">
                                        <a href="#" class="ks-control">
                                            <span class="ks-icon fa fa-minus"></span>
                                        </a>
                                        <a href="#" class="ks-control">
                                            <span class="ks-icon fa fa-repeat"></span>
                                        </a>
                                        <a href="#" class="ks-control">
                                            <span class="ks-icon fa fa-expand"></span>
                                        </a>
                                        <a href="#" class="ks-control">
                                            <span class="ks-icon fa fa-close"></span>
                                        </a>
                                    </div>
                                </h5>
                                <div class="card-block">
                                    <div id="ks-bar-chart" data-height="260"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div id="ks-line-chart-panel" class="card panel">
                                <h5 class="card-header">
                                    Line chart

                                    <div class="ks-controls">
                                        <a href="#" class="ks-control">
                                            <span class="ks-icon fa fa-minus"></span>
                                        </a>
                                        <a href="#" class="ks-control">
                                            <span class="ks-icon fa fa-repeat"></span>
                                        </a>
                                        <a href="#" class="ks-control">
                                            <span class="ks-icon fa fa-expand"></span>
                                        </a>
                                        <a href="#" class="ks-control">
                                            <span class="ks-icon fa fa-close"></span>
                                        </a>
                                    </div>
                                </h5>
                                <div class="card-block">
                                    <div id="ks-line-chart" data-height="260"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ks-widgets-collection">
                        <div class="col-lg-6">
                            <div class="card panel">
                                <h5 class="card-header">
                                    Pie Chart
                                </h5>
                                <div class="card-block" data-height="251">
                                    <div id="ks-pie-chart2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card panel">
                                <h5 class="card-header">
                                    Pie Chart
                                </h5>
                                <div class="card-block" data-height="251">
                                    <div id="ks-pie-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>-->
        <!-- END DASHBOARD CONTENT -->
    </div>
</div>