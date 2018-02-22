<div class="ks-container">

    <div class="ks-column ks-page">
        <div class="ks-header">
            <section class="ks-title">
                <h3>Recruitment</h3>

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
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/recruitment" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-calendar-o"></span>  Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/recruitment/default/job" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  New Job Post
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/recruitment/default/joblist" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  Job List
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/recruitment/default/integration" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  Recruitment Integration
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="ks-nav-body">
                    <table id="ks-datatable" class="table table-striped table-bordered" width="100%">
                        <thead>
                        <tr>
                            <th style="text-align: center">No.</th>
                            <th style="text-align: center">Date</th>
                            <th style="text-align: center">Name</th>
                            <th style="text-align: center">ID No.</th>
                            <th style="text-align: center">Status</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;foreach($data as $data){ ?>
                            <tr>
                                <td style="text-align: center"><?php echo $i;?></td>
                                <td style="text-align: center"><?php echo date('d-m-Y',strtotime($data['Date']));?></td>
                                <td style="text-align: center"><?php echo $data['FullName'];?></td>
                                <td style="text-align: center"><?php echo $data['ICPassportNo'];?></td>
                                <td style="text-align: center"><?php echo ($data['StatusId'] == 1) ? "<span class='label label-info label-pill'>Active</span>" : "<span class='label label-primary label-pill'>Inactive</span>";?></td>
                                <td style="text-align: center">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="window.location='<?php echo Yii::app()->baseURL; ?>/recruitment/default/add/id/<?php echo $data['CandidateId']?>'">Edit</button>
                                </td>
                            </tr>
                            <?php $i++;} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>