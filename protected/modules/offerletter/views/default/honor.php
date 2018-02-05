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
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/offerletter" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-calendar-o"></span>  Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/offerletter/default/add" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-calendar-o"></span>  New Offer Letter
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/offerletter/default/list" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-database"></span>  Offer Letter List
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/offerletter/default/honoradd" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-linode"></span>  New Honorific
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/offerletter/default/honor" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-linode"></span>  Honorific List
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="ks-nav-body">
                    <table id="ks-datatable" class="table table-striped table-bordered" width="100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>Code</th>
                            <th style="text-align: center">Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;foreach($data as $data){ ?>
                            <tr>
                                <td align="center"><?php echo $i?></td>
                                <td><?php echo $data['title']?></td>
                                <td><?php echo $data['title_code']?></td>
                                <td align="center">Active</td>
                                <td align="center">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="window.location='<?php echo Yii::app()->baseURL; ?>/offerletter/default/honoradd/id/<?php echo $data['id']?>'">Edit</button>
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