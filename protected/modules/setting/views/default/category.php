<div class="page-container">
    <div class="page-header clearfix">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mt-0 mb-5">Billing Category <button type="button" class="btn btn-info btn-xs" onclick="window.location='/cms-property/setting/default/addcategory'"> Add New </button> </h4>
                <p class="text-muted mb-0">registered billing category</p>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>
    <div class="page-content container-fluid">

        <!--<div class="row">
            <div class="col-md-12">
                <div class="widget">
                    <div class="widget-heading">
                        <h3 class="widget-title">Testimonials Announcement</h3>
                    </div>
                    <div class="widget-body">
                        <div class="bs-example">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">1. How can i get a testimonials </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true">
                                        <div class="panel-body">
                                            You can get testimonials by joining college event.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">2. I join the event but the testimonials did not appear in portal </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            Do contact student affair department to check your confirmation of participation to be updated in the system
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->

        <div class="row">
            <div class="col-lg-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr style="background-color: #14b3bb; color: #fff;">
                                    <th style="width:5%">#</th>
                                    <th>Category</th>
                                    <th style="text-align: center">Alert</th>
                                    <th style="text-align: center">Day in Month</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i=1;
                                if($data){
                                    foreach($data as $data)
                                    {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i;?></th>
                                            <td><?php echo $data['title']?></td>
                                            <td align="center"><?php ($data['category_alert'] == 1) ? $status = "Yearly/Monthly/Quaterly" : $status = "Fixed"; echo $status; ?></td>
                                            <td align="center"><?php echo $data['category_day']?></td>
                                            <td align="center"><?php ($data['status'] == 1) ? $status = "Active" : $status = "InActive"; echo $status; ?></td>
                                            <td align="center">
                                                <button type="button" class="btn btn-success btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/setting/default/addcategory/id/<?php echo $data['category_id']?>'"> Edit </button>
                                                <button type="button" class="btn btn-danger btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/setting/default/deletecategory/id/<?php echo $data['category_id']?>'"> Delete </button>
                                            </td>
                                        </tr>
                                        <?php $i++; } } else {?>
                                    <tr>
                                        <td scope="row" colspan="4" align="center">Not available</td>
                                    </tr>

                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
