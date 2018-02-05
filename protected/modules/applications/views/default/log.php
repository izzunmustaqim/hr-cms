<?php  $id = Yii::app()->getRequest()->getParam('id');$type = Yii::app()->getRequest()->getParam('type'); ?>
<div class="page-container">
    <div class="page-header clearfix">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mt-0 mb-5">Applications Details</h4>
                <p class="text-muted mb-0">registered applications details</p>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>
    <div class="page-content container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="widget">
                    <div class="widget-heading">
                        <h3 class="widget-title">Application Details</h3>
                    </div>
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtMovieTitle">Name</label>
                                    <input class="form-control" type="text" maxlength="100" value="<?php echo $data['name'];?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ddlGenge">Category</label>
                                    <input class="form-control" type="text" maxlength="100" value="<?php echo $category[0]['title'];?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="widget">
                    <div class="widget-heading">
                        <h3 class="widget-title">Email Log Details <?php echo $type_desc[0]['title'];?> </h3>
                    </div>
                    <div class="widget-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr style="background-color: #1d539d; color: #fff;">
                                    <th style="width:5%">#</th>
                                    <th>Date Time</th>
                                    <th style="text-align: center;">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1;foreach($log_e as $log_e){?>
                                    <tr>
                                        <th scope="row"><?php echo $i;?></th>
                                        <td><?php echo $log_e['date']?></td>
                                        <td align="center"><?php ($log_e['status'] == 1) ? $status = "Sent" : $status = "Failed"; echo $status; ?></td>
                                    </tr>
                                <?php $i++;} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
