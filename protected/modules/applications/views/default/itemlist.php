<?php  $id = Yii::app()->getRequest()->getParam('id'); $category_id= Yii::app()->getRequest()->getParam('category'); ?>
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
                        <h3 class="widget-title">Application Type List
                            <button style="float: right" type="button" class="btn btn-info btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/applications/default/summaryfull/id/<?php echo $id; ?>'">  Full Summary  </button>
                            <button style="float: right" type="button" class="btn btn-danger btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/applications/default/addtype/id/<?php echo $id; ?>'">  Add Type  </button>
                        </h3>
                    </div>
                    <div class="widget-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr style="background-color: #1d539d; color: #fff;">
                                    <th style="width:5%">#</th>
                                    <th>Items</th>
                                    <!--<th style="text-align: center">Payment Due</th>-->
                                    <th style="text-align: center">Day Of Reminder</th>
                                    <th style="text-align: center">Payment Paid</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center; width: 36%;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i=1;
                                $item = Itemlist::model()->getItemlist($id);
                                if($item!=NULL){
                                foreach($item as $item){

                                    $checkcountdue = ItemlistDue::model()->findAllByAttributes(array('type_id'=>$item['type_id'],'applications_id'=>$id));
                                    $count_due = count ($checkcountdue);

                                    $checkcountpaid = ItemlistPaid::model()->findAllByAttributes(array('type_id'=>$item['type_id'],'applications_id'=>$id));
                                    $count_paid = count ($checkcountpaid);

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i;?></th>
                                        <td><?php echo $item['title']?></td>
                                        <!--<td align="center"><?php /*echo $count_due;*/?></td>-->
                                        <td align="center"><?php ($item['day'] == NULL ) ? $day = "-" : $day = $item['day']; echo $day; ?></td>
                                        <td align="center"><?php echo $count_paid;?></td>
                                        <td align="center"><?php ($item['status'] == 1) ? $status = "Active" : $status = "InActive"; echo $status; ?></td>
                                        <td align="center">
                                            <!--<button type="button" class="btn btn-success btn-xs" onClick="window.location='<?php /*echo Yii::app()->request->baseUrl; */?>/applications/default/adddue/id/<?php /*echo $item['id']*/?>'">  Add Due  </button>-->
                                            <button type="button" class="btn btn-success btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/applications/default/addtype/id/<?php echo $item['id'];?>/app_id/<?php echo $id?>'">  Edit  </button>
                                            <button type="button" class="btn btn-warning btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/applications/default/addpayment/id/<?php echo $id?>/category/<?php echo $category_id;?>/type/<?php echo $item['type_id'];?>'">  Payment  </button>
                                            <button type="button" class="btn btn-info btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/applications/default/summary/id/<?php echo $id?>/category/<?php echo $category_id;?>/type/<?php echo $item['type_id'];?>'">  Summary  </button>
                                            <button type="button" class="btn btn-success btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/applications/default/log/id/<?php echo $id?>/category/<?php echo $category_id;?>/type/<?php echo $item['type_id'];?>'">  Reminder Log  </button>
                                            <button type="button" class="btn btn-danger btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/applications/default/add/id/<?php echo $item['id']?>'">  Delete  </button>
                                        </td>
                                    </tr>
                                    <?php $i++;}  } else {?>
                                    <tr>
                                        <td colspan="6" style="text-align: center">Item list not available</td>
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
