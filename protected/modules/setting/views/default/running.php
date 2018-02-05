<div class="ks-container">

    <div class="ks-column ks-page">
        <div class="ks-header">
            <section class="ks-title">
                <h3>Offer Letter ( Running No )</h3>

                <div class="ks-controls">
                    <nav class="breadcrumb ks-default">
                        <a class="breadcrumb-item ks-breadcrumb-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard">
                            <span class="fa fa-home ks-icon"></span>
                        </a>
                        <a href="#" class="breadcrumb-item">Dashboard</a>
                        <span class="breadcrumb-item active" href="#">Recruitment</span>
                    </nav>

                    <button class="btn btn-primary-outline ks-light ks-content-nav-toggle" data-block-toggle=".ks-content-nav > .ks-nav">Menu</button>
                </div>
            </section>
        </div>

        <div class="ks-content">
            <div class="ks-body ks-content-nav">
                <div class="ks-nav">
                    <ul class="nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/setting/default/running" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-calendar-o"></span>  Running Number
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/setting/default/holiday" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  Holiday List
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/setting/default/faculty" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-building"></span>  Facuty List
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/setting/default/hod" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-address-card"></span>  HOD List
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/setting/default/honor" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-user-circle-o"></span>  Honorific List
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="ks-nav-body">
                    <table id="ks-datatable" class="table table-striped table-bordered" width="100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th style="text-align: center">Code</th>
                            <th>Description</th>
                            <th style="text-align: center">No.</th>
                            <th style="text-align: center">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;foreach($data as $data){?>
                            <tr>
                                <td align="center"><?php echo $i?></td>
                                <td align="center"><?php echo $data['code']?></td>
                                <td><?php echo $data['description']?></td>
                                <td align="center"><?php echo $this->padnumber($data['number']);?></td>
                                <td align="center"><?php echo ($data['status'] == 1) ? "Active" : "Disabled";?></td>
                            </tr>
                            <?php $i++;} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>