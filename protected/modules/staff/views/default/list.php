<div class="ks-container">

    <div class="ks-column ks-page">
        <div class="ks-header">
            <section class="ks-title">
                <h3>Staff Management</h3>

                <div class="ks-controls">
                    <nav class="breadcrumb ks-default">
                        <a class="breadcrumb-item ks-breadcrumb-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard">
                            <span class="fa fa-home ks-icon"></span>
                        </a>
                        <a href="#" class="breadcrumb-item">Dashboard</a>
                        <span class="breadcrumb-item active" href="#">Staff Management</span>
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
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/staff" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-bandcamp"></span>  Staff Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/staff/default/list" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-id-card-o"></span>  Staff List
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/staff/default/ext" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-microchip"></span>  Staff Extensions
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/staff/default/hod" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-podcast"></span>  Hod List
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="ks-nav-body">
                    <table id="ks-datatable" class="table table-striped table-bordered" width="100%" style="font-size: 9px !important;">
                        <thead>
                        <tr>
                            <!--<th style="text-align: center">No.</th>-->
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;foreach($data as $data){ ?>
                            <tr>
                                <!--<td style="text-align: center"><?php /*echo $i;*/?></td>-->
                                <td><?php echo $data['UserNo'];?></td>
                                <td><?php echo $data['FullName'];?></td>
                                <td><?php echo $data['EmailAddress'];?></td>
                                <td><?php echo $data['DepartmentDesc'];?></td>
                            </tr>
                            <?php $i++;} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>