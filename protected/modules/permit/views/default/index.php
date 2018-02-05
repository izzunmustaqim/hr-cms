<div class="ks-container">


    <div class="ks-column ks-page">
        <!-- BEGIN DASHBOARD HEADER -->
        <div class="ks-header ks-header-with-addon">
            <section class="ks-title">
                <h3>Permit</h3>

                <div class="ks-controls">
                    <nav class="breadcrumb ks-default">
                        <a class="breadcrumb-item ks-breadcrumb-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard">
                            <span class="fa fa-home ks-icon"></span>
                        </a>
                        <a href="#" class="breadcrumb-item">Dashboard</a>
                        <span class="breadcrumb-item active" href="#">Permit</span>
                    </nav>

                    <button class="btn btn-primary-outline ks-light ks-header-addon-block-toggle" data-block-toggle=".ks-header-with-addon > .ks-addon">Addon</button>
                </div>
            </section>
        </div>
        <!-- END DASHBOARD HEADER -->

        <div class="ks-content">
            <div class="ks-body ks-content-nav">
                <div class="ks-nav">
                    <ul class="nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/permit" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-calendar-o"></span>  Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/permit/default/addworking" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  New Working Permit
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/permit/default/working" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  Working Permit List
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/permit/default/addteaching" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  New Teaching Permit
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/permit/default/teaching" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  Teaching Permit List
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="ks-nav-body">

                    <div class="container-fluid ks-rows-section">
                        <div class="row ks-widgets-collection">
                            <div class="col-lg-3">
                                <div class="ks-dashboard-widget ks-widget-amount-statistics ks-info">
                                    <div class="ks-statistics">
                                        <span class="ks-amount" data-count-up="3119">0</span>
                                        <span class="ks-text">Total Working Permit</span>
                                    </div>
                                    <div class="ks-percent ks-down"><span class="ks-text">5%</span></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="ks-dashboard-widget ks-widget-amount-statistics ks-success">
                                    <div class="ks-statistics">
                                        <span class="ks-amount" data-count-up="8201">0</span>
                                        <span class="ks-text">Working Permit Accepted</span>
                                    </div>
                                    <div class="ks-percent ks-up"><span class="ks-text">6%</span></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="ks-dashboard-widget ks-widget-amount-statistics ks-purple">
                                    <div class="ks-statistics">
                                        <span class="ks-amount" data-count-up="8201">0</span>
                                        <span class="ks-text">Working Permit Rejected</span>
                                    </div>
                                    <div class="ks-percent ks-up"><span class="ks-text">6%</span></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="ks-dashboard-widget ks-widget-amount-statistics ks-white">
                                    <div class="ks-statistics">
                                        <span class="ks-amount" data-count-up="8201">0</span>
                                        <span class="ks-text">Working Permit Pending</span>
                                    </div>
                                    <div class="ks-percent ks-up"><span class="ks-text">6%</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="row ks-widgets-collection">
                            <div class="col-lg-3">
                                <div class="ks-dashboard-widget ks-widget-amount-statistics ks-info">
                                    <div class="ks-statistics">
                                        <span class="ks-amount" data-count-up="3119">0</span>
                                        <span class="ks-text">Total Teaching Permit</span>
                                    </div>
                                    <div class="ks-percent ks-down"><span class="ks-text">5%</span></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="ks-dashboard-widget ks-widget-amount-statistics ks-purple">
                                    <div class="ks-statistics">
                                        <span class="ks-amount" data-count-up="8201">0</span>
                                        <span class="ks-text">Teaching Permit Accepted</span>
                                    </div>
                                    <div class="ks-percent ks-up"><span class="ks-text">6%</span></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="ks-dashboard-widget ks-widget-amount-statistics ks-success">
                                    <div class="ks-statistics">
                                        <span class="ks-amount" data-count-up="8201">0</span>
                                        <span class="ks-text">Teaching Permit Rejected</span>
                                    </div>
                                    <div class="ks-percent ks-up"><span class="ks-text">6%</span></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="ks-dashboard-widget ks-widget-amount-statistics ks-white">
                                    <div class="ks-statistics">
                                        <span class="ks-amount" data-count-up="8201">0</span>
                                        <span class="ks-text">Teaching Permit Pending</span>
                                    </div>
                                    <div class="ks-percent ks-up"><span class="ks-text">6%</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="row ks-widgets-collection">
                            <div class="col-lg-12">
                                Will be updated soon
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>